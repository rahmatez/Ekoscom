<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Category_m');
		
	}
	

	public function index()
	{
		$data['title'] = 'All Category';
		$data['product'] = $data['category'] = true;
		$data['content'] = 'backend/category';
		$this->load->view('backend/index', $data);
	}
	public function addCategory()
	{
		$this->db->insert('product_category', $this->data());
		$this->toastr->success('Created Successfully');
		redirect('category');
		// var_dump($this->data());
		
	}
	public function editCategory()
	{
		$data = [
			"category_name"=>$this->input->post('category_name', true),
			"category_description"=>$this->input->post('category_description', true),
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idcategory', $this->input->post('idcategory', true));
		$this->db->update('product_category', $data);
	}
	public function editImgCategory()
	{
		$id = $this->input->post('idcategory', true);
		$image = $this->input->post('image', true);
		$cek = $this->Category_m->productCategoryById($id);
		if (!empty($_FILES['image']['name'])) {
			if(!empty($cek->category_image) && $cek->category_image!='default.jpg'){
				unlink('uploads/category/'.$cek->category_image);
			}
			$config['upload_path']          = './uploads/category/';
			$config['allowed_types']        = settings('general','file_allowed_types');
			$config['max_size']             = settings('general','upload_max_filesize');
			$config['file_name']             = 'category-'.time();
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image')){
				$this->toastr->error('Image Upload Failed');
				redirect('category');
			}else{
				$gbr = $this->upload->data();
				$data = [
					"category_image" => $gbr['file_name'],
					"update_at" => get_dateTime(),
					"update_by" => user()['idusers']
				];
				$this->db->where('idcategory', $id);
				$this->db->update('product_category', $data);
				$this->toastr->success('Update Successfully');
				redirect('category');
				
			}
		}else{
			$this->toastr->error('No Image Uploaded');
			redirect('category');
		}
	}
	/**
	* Data
	* @return Array
	*/
	private function data() {
		return [
			'category_name'=>$this->input->post('category_name', true),
			'category_seo'=>slugify($this->input->post('category_name', true)),
			'category_description'=>$this->input->post('category_description', true),
			'category_image'=>upload_image('category'),
			'create_at'=>get_dateTime(),
			'create_by'=>user()['idusers']
		];
	}
	/**
	* View By Id
	* @return Array
	*/
	public function view()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('product_category',['idcategory'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* Delete By ID
	* @return Boolean
	*/
	public function delete()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->Category_m->delete($id[$i]);
			}
		}else{
			$id = $this->input->post('idx');
			for ($i=0; $i < count($id); $i++) { 
				$this->Category_m->delete_permanen($id[$i]);
			}
		}
	}
	/**
	* Restore By ID
	* @return Boolean
	*/
	public function restore()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->Posts_m->restore($id[$i]);
			}
		}
	}
}

/* End of file Category.php */