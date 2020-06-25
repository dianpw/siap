<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model 
{
    public function login(){
        $post = $this->input->post();
		//SELECT account.id_account, account.username, login.password, role_account.role 
		//FROM `login` 
		//INNER JOIN account ON account.id_login=login.id_login 
		//INNER JOIN role_account ON role_account.id_role=login.id_role 
		//WHERE account.username='' AND login.password=''
		$this->db->select('account.id_account, login.password, role_account.role');
		$this->db->join('account', 'account.id_login=login.id_login');
		$this->db->join('role_account', 'role_account.id_role=login.id_role');
		$this->db->where('account.username', $post['email']);
		$this->db->where('login.status', 1);
        $user = $this->db->get('login')->row_array(); 
	}
	
	public function register()
	{
		$post 			= $this->input->post();
		$id_login	 	= uniqid();
		$id_role 		= '5ef49bfeabf92'; //default role is user
		$id_account		= uniqid();

		$account = [
			'id_account' 	=> $id_account,
			'id_login' 		=> $id_login,
			'username' 		=> htmlspecialchars($post['username'])
		];
		$tambah_account = $this->db->insert('account', $account);

		if ($tambah_account) {
			$login = [
				'id_login' 	=> $id_login,
				'password' 	=> password_hash($post['repassword'], PASSWORD_DEFAULT),
				'id_role' 	=> $id_role,
				'status'	=> '1'
			];
			$tambah_login = $this->db->insert('login', $login);

			if ($tambah_login) {
				$profil = [
					'id_profile' 	=> uniqid(),
					'id_account' 	=> $id_account,
					'nama' 			=> htmlspecialchars($post['nama'])
				];
				$tambah_profil = $this->db->insert('profil', $profil);
				
				if ($tambah_profil) {	
					$log =[
						'id_log' 		=> uniqid(),
						'id_account' 	=> $id_account,
						'log' 			=> htmlspecialchars($post['username']) . ' was successful register on ' . date('l, d-m-Y H:i:s')
					];
					$this->db->insert('log', $log);

					redirect('login');
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Register failed! Nama not valid</div>');
	                redirect('register');
				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Register failed! Password not valid</div>');
	            redirect('register');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Register failed! Username not valid</div>');
	        redirect('register');
		}
	}
}