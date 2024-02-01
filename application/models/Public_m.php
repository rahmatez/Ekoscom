<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Public_m extends CI_Model {


	public function cartView()
	{
		$this->db->join('product', 'product.idproduct = cart.product_id', 'left');
		return $this->db->get('cart')->result_array();
	}
	public function cartById($id)
	{
		return $this->db->get_where('cart',['product_id'=>$id])->row();
	}
	public function totalBeli($id){
		$this->db->join('detail_order', 'detail_order.order_id = pesanan.idorder', 'left');
		$this->db->join('product', 'detail_order.product_id = product.idproduct', 'left');
		return $this->db->get_where('pesanan',['user_id'=>$id])->result();
	}
}

/* End of file Public_m.php */