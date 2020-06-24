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
	private function _login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->db->get_where('user', ['username' => $username])->row_array();
		if ($user) {
			if ($user['is_active'] == 1) {
					
				if (md5($password) == $user['password']) {
					$data = [
						'username' => $user['username'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						# admin
						redirect('admin');
					}elseif ($user['role_id'] == 2) {
						# akuntan
						redirect('akuntan');
					}elseif ($user['role_id'] == 3) {
						# iklan
						redirect('iklan');
					}elseif ($user['role_id'] == 4) {
						# koran
						redirect('koran');
					}else{
						redirect('auth/logout');
					}

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

	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Logout berhasil</div>');
		redirect('auth');

	}
}
