<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_m extends CI_Model {

	public function allSlide(){
		return $this->db->get('slider')->result();
	}
	public function allTestimoni(){
		return $this->db->get('testimonial')->result();
	}
	public function allService(){
		return $this->db->get('kurir')->result();
	}
	public function allOngkir(){
		return $this->db->get('ongkir')->result();
	}
	public function slideById($id)
	{
		return $this->db->get_where('slider',['idslide'=>$id])->row();
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
		$img = $this->slideById($id);
		if(!empty($img->image) && $img->image!='default.jpg'){
			@unlink(FCPATH."uploads/".$img->image);
			$this->db->delete('slider', ['idslide'=>$id]);
		}else{
			$this->db->delete('slider', ['idslide'=>$id]);
		}
	}
	public function delete_permanenTesti($id)
	{
		$this->db->delete('testimonial', ['idtestimoni'=>$id]);
	}
	public function delete_permanenService($id)
	{
		$this->db->delete('kurir', ['idkurir'=>$id]);
	}
}

/* End of file Plugin_m.php */