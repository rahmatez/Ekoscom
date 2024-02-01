<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_m extends CI_Model {

	public function productById($id)
	{
		return $this->db->get_where('product',['idproduct'=>$id])->row();
	}
	public function imageById($id)
	{
		return $this->db->get_where('product_image',['idImage'=>$id])->row();
	}
	public function productByCategory($id)
	{
		return $this->db->get_where('product',['category_id'=>$id])->result_array();
	}
	public function view($id)
	{
		$this->db->select('post_content');
		return $this->db->get_where('posts', ['idposts'=>$id])->row_array();
	}
	public function delete($id)
	{
		$data = [
			"post_status" => 'delete',
			"delete_at" => time(),
			"delete_by" => user()['idusers']
		];
		$this->db->where('idposts',$id);
		$this->db->update('posts', $data);
	}
	public function listImage(){
		return $this->db->get('product_image')->result();
	}
	public function insertImage($id,$filename)
	{
		$data = [
			"product_id" => $id,
			"image" => $filename,
			"create_at" => get_dateTime(),
			"create_by" => user()['idusers']
		];
		$this->db->insert('product_image', $data);
	}
	public function delete_permanen($id)
	{
		// $data = [
		// 	"delete_at" => get_dateTime(),
		// 	"delete_by" => user()['idusers'],
		// 	"is_deleted" => 'true'
		// ];
		// $this->db->where('idcategory',$id);
		// $this->db->update('product_category', $data);
		$img = $this->productById($id);
		if(!empty($img->product_image) && $img->product_image!='default.jpg'){
			@unlink(FCPATH."uploads/products/".$img->product_image);
			$this->db->delete('product', ['idproduct'=>$id]);
		}else{
			$this->db->delete('product', ['idproduct'=>$id]);
		}
	}
	public function delete_image($id)
	{
		// $data = [
		// 	"delete_at" => get_dateTime(),
		// 	"delete_by" => user()['idusers'],
		// 	"is_deleted" => 'true'
		// ];
		// $this->db->where('idcategory',$id);
		// $this->db->update('product_category', $data);
		$img = $this->imageById($id);
		if(!empty($img->image) && $img->image!='default.jpg'){
			@unlink(FCPATH."uploads/products/".$img->image);
			$this->db->delete('product_image', ['idImage'=>$id]);
		}else{
			$this->db->delete('product_image', ['idImage'=>$id]);
		}
	}
	public function restore($id)
	{
		$data = [
			"post_status" => 'draft',
			"delete_at" => 0,
			"delete_by" => 0
		];
		$this->db->where('idposts',$id);
		$this->db->update('posts', $data);
	}
	public function get_all_routes()
	{
		return $this->db->get_where('posts',['post_status'=>'publish'])->result_array();
	} 
	public function checkByPostId($url)
	{
		return $this->db->get_where('posts',['idposts'=>$url])->result_array();
	}
	public function allPosts()
	{
		$this->db->order_by('idposts', 'desc');
		return $this->db->get('posts')->result_array();
	}
	public function checkPost($data)
	{
		return $this->db->get_where('posts',['post_title'=>$data['post_title']]);
	}
}

/* End of file Product_m.php */