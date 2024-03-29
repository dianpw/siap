<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
    /**
	 * Controller Account
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
        if ($this->session->userdata('id_account') == null){
            redirect('login');
        }

        $data['profil'] = $this->user->getAccount();
        $data['logs'] = $this->user->getLogs();
        if ($this->session->userdata('role') == '5ef49b3c63cff') { //Administrator
            $data['title'] = "Administrator";
            $this->load->view('account/administrator', $data);
        }elseif ($this->session->userdata('role') == '5ef49b44b491f') {//Owner
            $data['title'] = "Owner";
            $this->load->view('account/owner', $data);
        }elseif ($this->session->userdata('role') == '5ef49b4c1eb6b') {//Accounting
            $data['title'] = "Accounting";
            $this->load->view('account/account', $data);
        }elseif ($this->session->userdata('role') == '5ef49b5314fc9') {//Admin
            $data['title'] = "Admin";
            $this->load->view('account/admin', $data);
        }elseif ($this->session->userdata('role') == '5ef49bfeabf92') {//User
            $data['title'] = "User";
            $this->load->view('account/profile', $data);
        }
        //var_dump($data);
    }

    public function up_profile(){
        $status = $this->user->editProfile();
        
        if ($status) {
            redirect('home');
        }else{
            redirect('home');
        }        
    }

    public function profile(){
        
        if ($this->session->userdata('id_account') == null){
            redirect('login');
        }
        $data['profil'] = $this->user->getAccount();
        $data['logs'] = $this->user->getLogs();
        if ($this->session->userdata('role') == '5ef49b3c63cff') { //Administrator
            $data['title'] = "Administrator";
            $this->load->view('account/profile', $data);
        }elseif ($this->session->userdata('role') == '5ef49b44b491f') {//Owner
            $data['title'] = "Owner";
            $this->load->view('account/profile', $data);
        }elseif ($this->session->userdata('role') == '5ef49b4c1eb6b') {//Accounting
            $data['title'] = "Accounting";
            $this->load->view('account/profile', $data);
        }elseif ($this->session->userdata('role') == '5ef49b5314fc9') {//Admin
            $data['title'] = "Admin";
            $this->load->view('account/profile', $data);
        }elseif ($this->session->userdata('role') == '5ef49bfeabf92') {//User
            $data['title'] = "User";
            $this->load->view('account/profile', $data);
        }

    }

}