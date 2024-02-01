<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	public function addBayar($image)
	{
		$data = [
			'total'=>$this->input->post('total', true),
			'file'=>$image,
			'keterangan'=>$this->input->post('keterangan', true),
			'tgl_bayar'=>get_dateTime()
		];
		// var_dump($data);die;
		$this->db->where('idpembayaran', $this->input->post('idbayar', true));
		$this->db->update('pembayaran', $data);
	}
	public function blocked($id)
	{
		$data = [
			'is_block' => 1
		];
		$this->db->where('idusers', $id);
		$this->db->update('users', $data);
		
	}
	public function unblocked($id)
	{
		$data = [
			'is_block' => 0
		];
		$this->db->where('idusers', $id);
		$this->db->update('users', $data);
		
	}
	public function tambah_order($data)
	{
		$this->db->insert('pesanan', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function tambah_bayar($data)
	{
		$this->db->insert('pembayaran', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function tambah_detail_order($data)
	{
		$this->db->insert('detail_order', $data);
	}
	public function allTransaction()
	{
		$this->db->join('users', 'users.idusers = pesanan.user_id', 'left');
		return $this->db->get('pesanan')->result();
	}
	public function allPayment()
	{
		// $this->db->join('pesanan', 'pesanan.idorder = pembayaran.order_id', 'left');
		$sql ="SELECT pembayaran.*,pesanan.*,pembayaran.status AS verify FROM pembayaran,pesanan WHERE pembayaran.order_id=pesanan.idorder";
		return $this->db->query($sql)->result_array();
	}
	public function detailTransaksi($id){
		// $this->db->join('detail_order', 'detail_order.order_id = pesanan.idorder', 'left');
		$this->db->join('users', 'users.idusers = pesanan.user_id', 'left');
		$this->db->join('user_profile', 'user_profile.users_id = users.idusers', 'left');
		return $this->db->get_where('pesanan',['idorder'=>$id])->row();
	}
	public function getProfile($id){
		$this->db->select('user_profile.*,provinsi.nama as nama_prov,kabupaten.nama as nama_kab');
		$this->db->join('kabupaten', 'kabupaten.id_kab = user_profile.kab', 'left');
		$this->db->join('provinsi', 'provinsi.id_prov = user_profile.prov', 'left');
		return $this->db->get_where('user_profile',['users_id'=>$id])->row();
	}
	public function totalBeli($id){
		$this->db->join('detail_order', 'detail_order.order_id = pesanan.idorder', 'left');
		return $this->db->get_where('pesanan',['user_id'=>$id])->result();
	}
}

/* End of file User_m.php */