<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('User_m');
		
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['content'] = 'backend/home';
		$data['total_product'] = $this->db->get('product')->result();
		$data['total_order'] = $this->db->get('pesanan')->result();
		$data['total_member'] = $this->db->get_where('users',['user_type'=>'customer'])->result();
		$data['total_product_category'] = $this->db->get('product_category')->result();
		$data['alltransaction'] = $this->User_m->allTransaction();
		$this->load->view('backend/index', $data);
	}

}

/* End of file Dashboard.php */