<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Profil';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit_profile()
    {
        $data['title'] = 'Edit Profile';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('full_name', 'Full Nama', 'required|trim');
        // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('user/edit_profile', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $full_name = $this->input->post('full_name', true);
            $email = $this->input->post('email', true);

            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'png|jpg';
                $config['max_size'] = 2048;
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('full_name', $full_name);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata('profile', 'Your profile updated successfully!');
            redirect('User');
        }
    }

    public function change_password()
    {
        $data['title'] = 'Change password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('old_password', 'Old password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm password', 'required|trim|min_length[6]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('user/change_password', $data);
            $this->load->view('templates/footer');
        } else {
            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($old_password, $data['user']['password'])) {
                $this->session->set_flashdata('flash1', 'Old password is wrong!');
                redirect('User/change_password');
            } else {
                if ($old_password == $new_password) {
                    $this->session->set_flashdata('flash2', 'The password cannot be the same as before!');
                    redirect('User/change_password');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('flash', 'Your password was successfully updated!');
                    redirect('User');
                }
            }
        }
    }
}
