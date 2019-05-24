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
			
			$this->load->view('auth/login', $data);
		}else{
			
			$this->_login();
		}
	}
	private function _login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->db->get_where('user', ['username' => $username])->row_array();
		if ($user) {
			if ($user['is_active'] == 1) {
					
				if (md5($password) == $user['password']) {
					$data = [
						'username' = $user['username'],
						'role_id' = $user['role_id']
					];
					$this->session->set_userdata($data);
					redirect('user');

				}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password Salah</div>');
				redirect('auth');

				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"> User tidak aktif. silahkan hubungi Administrator</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Login Gagal, Silahkan Coba Lagi!</div>');
			redirect('auth');
		}
	}
}
