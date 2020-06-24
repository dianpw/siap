<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->model("user");
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
    		'required' => 'Email Tidak Boleh Kosong',
    		'valid_email' => 'Format Email tidak Valid'
    	]);
    	$this->form_validation->set_rules('password', 'Password', 'required|trim', [
    		'required' => 'Password Tidak Boleh Kosong'
    	]);

    	if ($this->form_validation->run() == false) {
    		$data['title'] = "Login";
			$this->load->view('auth/login', $data);
    	}else{
    		$this->user->login();
		}
	}

	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Logout berhasil</div>');
		redirect('auth');

	}
}
