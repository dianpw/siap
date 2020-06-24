<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model 
{
    public function login(){
        $post = $this->input->post();
		//SELECT account.id_account, account.username, login.password, role_account.role, profil.nama, profil.foto, profil.nrg
		//FROM `login`
		//INNER JOIN account ON account.id_login=login.id_login
		//INNER JOIN role_account ON role_account.id_role=login.id_role
		//INNER JOIN profil ON profil.id_account=login.id_login
		//WHERE account.username='' AND login.password=''
		$this->db->select('account.id_account, account.username, login.password, role_account.role');
		$this->db->join('role_account', 'role_account.id_role=user.status');
		$this->db->join('status', 'status.id_user = user.id_user');
		$this->db->join('profile', 'profile.id_user=user.id_user');
		$this->db->join('membership', 'membership.id_membership = status.status');
		$this->db->where('user.email', $post['email']);
		$this->db->where('status.valid_until >= ', date('Y-m-d H:i:s',strtotime(Now())));
        $user = $this->db->get('user')->row_array();
        
        
    }
}