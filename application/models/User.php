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
}