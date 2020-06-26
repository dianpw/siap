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
		$this->db->select('account.id_account, login.password, role_account.id_role, login.status');
		$this->db->join('account', 'account.id_login=login.id_login');
		$this->db->join('role_account', 'role_account.id_role=login.id_role');
		$this->db->where('account.username', $post['username']);
		//$this->db->where('login.status', 1);
		$user = $this->db->get('login')->row_array(); 
		
		if ($user) {
			if (password_verify($post["password"], $user["password"])) {
				if ($user["status"] == '0') {
					$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"> Your account is not activated. Please contact your administrator!</div>');
					redirect('singin');
				}
				$id_account = $user['id_account'];
				$role 		= $user['id_role'];
				$log =[
					'id_log' 		=> uniqid(),
					'id_account' 	=> $id_account,
					'log' 			=> htmlspecialchars($post['username']) . ' was successful login on ' . date('l, d-m-Y H:i:s')
				];
				$this->db->insert('log', $log);

				$data = [
					'id_account' 	=> $id_account,
					'role' 			=> $role
				];
				$this->session->set_userdata($data);
				redirect('home');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Wrong password please try again!</div>');
				redirect('signin');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Username not found!</div>');
				redirect('signin');
		}
	}
	
	public function register(){
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
	
	public function getAccount(){
		//SELECT profil.nama, profil.nrg, profil.telp, profil.foto, role_account.role, login.status, account.username
		//FROM `profil`
		//INNER JOIN account ON account.id_account=profil.id_account
		//INNER JOIN login ON login.id_login=account.id_login
		//INNER JOIN role_account ON role_account.id_role=login.id_role
		//WHERE account.id_account='' AND role_account.id_role=''
		$id_account = $this->session->userdata('id_account');
		$id_role = $this->session->userdata('role');
		$this->db->select('profil.nama, profil.nrg, profil.telp, profil.foto, role_account.role, login.status, login.id_login, account.username');
		$this->db->join('account', 'account.id_account=profil.id_account');
		$this->db->join('login', 'login.id_login=account.id_login');
		$this->db->join('role_account', 'role_account.id_role=login.id_role');
		$this->db->where('account.id_account', $id_account);
		$this->db->where('role_account.id_role', $id_role);
		$hasil = $this->db->get('profil'); 
		return $hasil->row_array();
	}

	public function getLogs(){
		$id_account = $this->session->userdata('id_account');
		//SELECT log FROM `log` WHERE id_account='5ef4a12ae5785' ORDER BY update_data DESC
		$this->db->select('log, update_data');
		$this->db->where('id_account', $id_account);
		$this->db->order_by('update_data', 'DESC');
		$hasil = $this->db->get('log'); 
		return $hasil->result();
	}

	public function editProfile(){	
		$post = $this->input->post();
		$profil = $this->getAccount();

		//foto profil		
			var_dump($_FILES["foto"]["name"]);
        if (!empty($_FILES["foto"]["name"])) {
			$foto = $this->_uploadProfil();
        }else{
			$foto = $post["old_foto"];
		}
		
		$data = [
			'nama' => $post["nama"],
			'telp' => $post["telp"],
			'foto' => $foto
		];
		$this->db->where('id_account', $this->session->userdata('id_account'));
		$this->db->update('profil', $data);
		//password
		if (!empty($post["password"]) AND !empty($post["repassword"]) AND $post["password"]=$post["repassword"]) {
			$password = password_hash($post["repassword"], PASSWORD_DEFAULT);
			$login = array(			        
				'password' 		=> $password
			);
			$this->db->where('id_login', $profil['id_login']);
			$this->db->update('login', $login);

			$log =[
				'id_log' 		=> uniqid(),
				'id_account' 	=> $this->session->userdata('id_account'),
				'log' 			=> $profil['username'] . ' was successful change the password on ' . date('l, d-m-Y H:i:s')
			];
			$this->db->insert('log', $log);
        }

	}

	private function _uploadProfil()
    {
		$config['upload_path']          = './assets/dist/img/profile/';
	    $config['allowed_types']        = 'gif|jpg|png|jpeg';
	    $config['file_name']            = $this->session->userdata('id_account');
	    $config['overwrite']			= true;
		$config['max_size']             = 1024; // 1MB

	    $this->load->library('upload', $config);
	    if ($this->upload->do_upload('foto')) {
	        return $this->upload->data("file_name");
	    }    
	    return "default.png";
    }
}