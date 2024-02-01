<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_m extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function register()
	{
		$data = [
			'user_name' => htmlspecialchars($this->input->post('username', true)),
			'user_password' => password_hash(htmlspecialchars($this->input->post('password1', true)), PASSWORD_DEFAULT),
			'user_fullname' => htmlspecialchars($this->input->post('fullname', true)),
			'user_telp' => htmlspecialchars($this->input->post('telp', true)),
			'user_type' => 'customer',
			'is_active' => 1,
			'is_block' => 0,
			'create_at' => get_dateTime(),
			'create_by' => 1
		];
		$this->db->insert('users', $data);
		
	}
	public function updateLogin($id)
	{
		$data = [
			'last_loggin' => get_dateTime(),
			'ip_address' => get_ip_address()
		];
		$this->db->where('idusers', $id);
		$this->db->update('users', $data);
		
	}
}

/* End of file Auth_m.php */