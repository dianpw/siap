<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    /**
	 * Controller Auth
	 *
	 * 
	 * @see maliki.id
	 */

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->model("user");
	}

	public function index(){		
        if ($this->session->userdata('id_account') != null){
            redirect('home');
		}
		
		echo $this->session->userdata('id_account');
		$this->form_validation->set_rules('username', 'Username', 'required|trim', [
    		'required' => 'Username Tidak Boleh Kosong'
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

	public function register(){				
        if ($this->session->userdata('id_account') != null){
            redirect('home');
		}
		echo $this->session->userdata('id_account');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[5]|max_length[10]|is_unique[account.username]', [
    		'required' 		=> 'Username Tidak Boleh Kosong',
    		'is_unique' 	=> 'Username Sudah Terdaftar',
    		'min_length' 	=> 'Username Minimal 5 Karakter',
    		'max_length'	=> 'Username Maksimal 10 Karakter'
    	]);

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
    		'required' 		=> 'Nama Tidak Boleh Kosong'
    	]);

    	$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]|matches[repassword]', [
    		'required' 	    => 'Password Tidak Boleh Kosong',
    		'matches'       => 'Password tidak sama',
    		'min_length'    => 'Password Minimal 5 Karakter'
    	]);

    	$this->form_validation->set_rules('repassword', 'Re-password', 'required|trim',[
    		'required' => 'Re-password Tidak Boleh Kosong'
    	]);

    	if ($this->form_validation->run() == false) {
			$data['title'] = "REGISTER";
    		$this->load->view('auth/register', $data);
    	}else{
    		$this->user->register();
    	}
	}

	public function logout(){
		$this->session->unset_userdata('id_account');
		$this->session->unset_userdata('role');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Logout berhasil</div>');
		redirect('login');

	}
}
