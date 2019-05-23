<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data['title'] = "SIAP Login";
			//$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Login Gagal, Silahkan Coba Lagi!</div>');
			$this->load->view('auth/login', $data);
		}else{
			
			$this->_login();
		}
	}
	private function _login(){
		
	}
}
