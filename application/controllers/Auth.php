<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('User');
        }
        $data['title'] = 'Login';

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email']
                    ];
                    $this->session->set_userdata($data);
                    redirect('User');
                } else {
                    $this->session->set_flashdata('error1', 'Wrong password!');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('error2', 'Your email is not yet active');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('error3', 'Email id not registered!');
            redirect('Auth');
        }
    }

    public function register()
    {
        if ($this->session->userdata('email')) {
            redirect('User');
        }
        $data['title'] = 'Register';

        $this->form_validation->set_rules('full_name', 'Full name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'This email is already registered!']);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', ['matches' => 'Passwords are not the same!', 'min_lenght' => 'Password too short!']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('auth/register', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'full_name' => htmlspecialchars($this->input->post('full_name', true)),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'is_active' => 0,
                'created_at' => time()
            ];

            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email'         => $email,
                'token'         => $token,
                'date_created'  => time()
            ];
            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);
            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('register', 'Your account has been successfully registered!! Please check your email for account activation or check your spam email!');
            redirect('Auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'andika99.as48@gmail.com',
            'smtp_pass' => 'kunwjphbakkerosc',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        // tambahan baris jika muncul error ketika mengirim email
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->load->library('email');

        // siapkan emailnya
        $this->email->from('andika99.as48@gmail.com', 'Handika');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Please click the link below to activate your account : <a href="' . base_url() . 'Auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Activation</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Please click the link to reset your password : <a href="' . base_url() . 'Auth/reset_password?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    // tampilkan pesan jika sukses
                    $this->session->set_flashdata('activation4', '' . $email . ' 
                    has been active! please login in your application!');
                    redirect('Auth');
                } else {
                    // hapus 'email' data user yang tidak aktifasi akun
                    $this->db->delete('user', ['email' => $email]);
                    // hapus 'token' data user yang tidak aktifasi akun
                    $this->db->delete('user_token', ['email' => $email]);

                    // tampilkan pesan jika error
                    $this->session->set_flashdata('activation1', 'Sorry, your account activation period has expired!');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('activation2', 'Your account activation failed! wrong token!');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('activation3', 'Your account activation failed! Wrong e-mail!');
            redirect('Auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->set_flashdata('logout', 'You have been logged out!');
        redirect('Auth');
    }

    public function forgot_password()
    {
        $data['title'] = 'Forgot password';

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('auth/forgot_password', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('forgot2', 'Please check your email to reset your password!');
                redirect('Auth/forgot_password');
            } else {
                $this->session->set_flashdata('forgot1', 'Email is not registered or activated!');
                redirect('Auth/forgot_password');
            }
        }
    }

    public function reset_password()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('error1', 'Reset password failed! Wrong token!');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('error2', 'Reset password failed! Wrong email!');
            redirect('Auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $data['title'] = 'Change password';

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat password', 'trim|required|min_length[6]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('auth/change_password', $data);
            $this->load->view('templates/footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', 'Password has been changed! Please login');
            redirect('auth');
        }
    }
}
