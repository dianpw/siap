<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model 
{
    public function login(){
        $post = $this->input->post();
		//SELECT user.id_user, profile.username , role_account.id_role, role_account.role, user.email, user.password, membership.nama AS membership, status.valid_until, status.aktif
		//FROM user
		//INNER JOIN role_account ON role_account.id_role=user.status
		//INNER JOIN status ON status.id_user=user.id_user
		//INNER JOIN profile ON profile.id_user=user.id_user
		//INNER JOIN membership ON membership.id_membership=status.status
		//WHERE user.email='dianpw@ymail.com' AND status.valid_until >= now()
		$this->db->select('user.id_user, profile.username , role_account.id_role, role_account.role, user.email, user.password, membership.nama AS membership, status.valid_until, status.aktif');
		$this->db->join('role_account', 'role_account.id_role=user.status');
		$this->db->join('status', 'status.id_user = user.id_user');
		$this->db->join('profile', 'profile.id_user=user.id_user');
		$this->db->join('membership', 'membership.id_membership = status.status');
		$this->db->where('user.email', $post['email']);
		$this->db->where('status.valid_until >= ', date('Y-m-d H:i:s',strtotime(Now())));
        $user = $this->db->get('user')->row_array();
        
        
    }
}