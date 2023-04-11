<?php
class Users_model extends CI_Model
{
    public function editDataUser()
    {
        $data = [
            "full_name" => $this->input->post('full_name', true),
            "email" => $this->input->post('email', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user', $data);
    }
}
