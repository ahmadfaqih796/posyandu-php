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
      $data['title'] = 'Login';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/login');
      $this->load->view('templates/auth_footer');
   }

   public function registration()
   {
      $this->form_validation->set_rules('name', 'Name', 'required|trim');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
         'is_unique' => 'This email has already registered!'
      ]);
      $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
         'matches' => 'Password dont match!',
         'min_length' => 'Password too short!'
      ]);
      $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]', [
         'matches' => 'Password dont match!',
         'min_length' => 'Password too short!'
      ]);
      if ($this->form_validation->run() == false) {
         $data['title'] = 'Registrasi';
         $this->load->view('templates/auth_header', $data);
         $this->load->view('auth/registration');
         $this->load->view('templates/auth_footer');
      } else {
         $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 1,
         ];
         $this->db->insert('users', $data);
         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulation! your account has been created. Please Login </div>');
         redirect('auth');
      }
   }
}
