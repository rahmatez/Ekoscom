<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_m extends CI_Model {

	public function productCategoryById($id)
	{
		return $this->db->get_where('product_category',['idcategory'=>$id])->row();
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
	public function delete_permanen($id)
	{
		// $data = [
		// 	"delete_at" => get_dateTime(),
		// 	"delete_by" => user()['idusers'],
		// 	"is_deleted" => 'true'
		// ];
		// $this->db->where('idcategory',$id);
		// $this->db->update('product_category', $data);
		$img = $this->productCategoryById($id);
		if(!empty($img->category_image) && $img->category_image!='default.jpg'){
			@unlink(FCPATH."uploads/category/".$img->category_image);
			$this->db->delete('product_category', ['idcategory'=>$id]);
		}else{
			$this->db->delete('product_category', ['idcategory'=>$id]);
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

/* End of file Category_m.php */
