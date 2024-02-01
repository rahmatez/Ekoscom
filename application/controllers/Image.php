<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Category_m');
		$this->load->model('Product_m');
		
	}
	

	public function index(){
			$data['title'] = 'All Image Product';
			$data['product'] = $data['image'] = true;
			// $data['list_image'] = $this->Product_m->listImage();
			$data['content'] = 'backend/image';
			$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data = [];
   
		$count = count($_FILES['image']['name']);
    
		for($i=0;$i<$count;$i++){
    
			if(!empty($_FILES['image']['name'][$i])){
    
			$_FILES['file']['name'] = $_FILES['image']['name'][$i];
			$_FILES['file']['type'] = $_FILES['image']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['image']['error'][$i];
			$_FILES['file']['size'] = $_FILES['image']['size'][$i];
  
			$config['upload_path'] = 'uploads/products/'; 
			$config['allowed_types'] = settings('general','file_allowed_types');
			$config['max_size'] = settings('general','upload_max_filesize');
			$config['file_name'] = 'product_image-'.time();
   
			$this->load->library('upload',$config); 
    
			if($this->upload->do_upload('file')){
				$uploadData = $this->upload->data();
				$filename = $uploadData['file_name'];
				$id = $this->input->post('product_id');
				$this->Product_m->insertImage($id,$filename);
				$this->toastr->success('Upload Successfully');
			}else{
				$this->toastr->error('Upload Failed');
			}
			}else{
				$this->toastr->error('No Image Uploaded');
			}
   
		}
		
		redirect('image');
		
	}
	// public function products()
	// {       
	// 	$this->load->library('upload');
	// 	$dataInfo = array();
	// 	$files = $_FILES;
	// 	$cpt = count($_FILES['userfile']['name']);
	// 	for($i=0; $i<$cpt; $i++)
	// 	{           
	// 		$_FILES['userfile']['name']= $files['userfile']['name'][$i];
	// 		$_FILES['userfile']['type']= $files['userfile']['type'][$i];
	// 		$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
	// 		$_FILES['userfile']['error']= $files['userfile']['error'][$i];
	// 		$_FILES['userfile']['size']= $files['userfile']['size'][$i];    

	// 		$this->upload->initialize($this->set_upload_options());
	// 		$this->upload->do_upload();
	// 		$dataInfo[] = $this->upload->data();
	// 	}

	// 	$data = array(
	// 		'name' => $this->input->post('pd_name'),
	// 		'prod_image' => $dataInfo[0]['file_name'],
	// 		'prod_image1' => $dataInfo[1]['file_name'],
	// 		'prod_image2' => $dataInfo[2]['file_name'],
	// 		'created_time' => date('Y-m-d H:i:s')
	// 	);
	// 	$result_set = $this->tbl_products_model->insertUser($data);
	// }

	// private function set_upload_options()
	// {   
	// 	//upload an image options
	// 	$config = array();
	// 	$config['upload_path'] = './resources/images/products/';
	// 	$config['allowed_types'] = 'gif|jpg|png';
	// 	$config['max_size']      = '0';
	// 	$config['overwrite']     = FALSE;

	// 	return $config;
	// }
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
	public function edit()
	{
		$id = $this->input->post('idimage', true);
		$image = $this->input->post('image', true);

		$cek = $this->Product_m->imageById($id);
		if (!empty($_FILES['image']['name'])) {
			if(!empty($cek->image) && $cek->image!='default.jpg'){
				unlink('uploads/products/'.$cek->image);
			}
			$config['upload_path']          = './uploads/products/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 2048;
			$config['file_name']             = 'product_image-'.time();
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image')){
				$this->toastr->error('Image Upload Failed');
				redirect('image');
			}else{
				$gbr = $this->upload->data();
				$data = [
					"image" => $gbr['file_name'],
					"update_at" => get_dateTime(),
					"update_by" => user()['idusers']
				];
				$this->db->where('idImage', $id);
				$this->db->update('product_image', $data);
				$this->toastr->success('Update Successfully');
				redirect('image');
				
			}
		}else{
			$this->toastr->error('No Image Uploaded');
			redirect('image');
		}
	}
	/**
	* Data
	* @return Array
	*/
	private function data() {
		return [
			// 'category_name'=>$this->input->post('category_name', true),
			// 'category_seo'=>slugify($this->input->post('category_name', true)),
			'product_id'=>$this->input->post('product_id', true),
			'image_name'=>upload_image('image'),
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
		$data = $this->db->get_where('product_image',['idImage'=>$id])->row();
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
				$this->Product_m->delete_image($id[$i]);
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

/* End of file Image.php */