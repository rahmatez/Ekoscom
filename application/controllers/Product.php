<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Product_m');
		
	}
	

	public function index()
	{
		$data['title'] = 'All Product';
		$data['product'] = $data['allproduct'] = true;
		$data['content'] = 'backend/product';
		$this->load->view('backend/index', $data);
	}
	public function create()
	{
		$id = _toInteger($this->uri->segment(3));
		$data['edata'] = false;
		$data['title'] = _isNaturalNumber( $id ) ? 'Edit Product' : 'Add New Product';
		$data['edit_stok'] = _isNaturalNumber( $id ) ? 'Readonly' : '';
		if(_isNaturalNumber($id)){
			// $data['title'] = 'Add New Post';
			// $data['post'] = $data['addpost'] = true;
			$data['coba'] = $id;
			$data['edata'] = produk($id);
			// print_r($data);die;
			// $this->load->view('back-end/inc/header',$data);
			// $this->load->view('back-end/post/addpost', $data);
			// $this->load->view('back-end/inc/footer');
		}
		$data['product'] = $data['addproduct'] = true;
		$data['content'] = 'backend/addproduct';
		$this->load->view('backend/index', $data);
	}
	public function createProduct()
	{
		// saveRoutePosts();
		$id = $this->input->post('idproduct', true);
		$img = $this->input->post('old_image', true);
		// print_r($id);die;
		if($this->validation()){
			$data = $this->data();
			// $old_category = $this->input->post('old_post_category', true);
			// $old_tag = $this->input->post('old_post_tag', true);
			// if(!empty($this->input->post('post_category', true))){
			// 	$new_category = implode("+",$this->input->post('post_category', true));
			// 	$data['post_categories'] = $new_category;
			// }else{
			// 	$data['post_categories'] = $old_category;
			// }
			// if(!empty($this->input->post('post_tags', true))){
			// 	$new_tag = implode(",",$this->input->post('post_tags', true));
			// 	$data['post_tags'] = $new_tag;
			// }else{
			// 	$data['post_tags'] = $old_tag;
			// }
			
			if(!empty($id)){
				if (empty($_FILES['image']['name'])) {
					$data['product_image']=$img;
				}else{
					if($img!='default.jpg'){
						unlink('uploads/products/'.$img);
					}
				}
				$data['update_at']=get_dateTime();
				$data['update_by']=user()['idusers'];
				$this->db->where('idproduct',$this->input->post('idproduct', true));
				$this->db->update('product',$data);
				// saveRoutePosts();
				$this->toastr->success('Updated Successfully');
				// $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Updated Successfully</div>',5);
			}else{
				$save = $this->db->insert('product',$data);
				if($save){
					// saveRoutePosts();
					$this->toastr->success('Created Successfully');
					// $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Created Successfully</div>');
				}
			}
			redirect('product?s=all');
		}else{
			$this->toastr->error('<h5>Terjadi Kesalahan</h5>Pastikan semua terisi dengan benar !');
			// $this->toastr->success('Error');
			// $this->toastr->info('Error');
			// $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.validation_errors().'</div>');
			if($id){
				redirect('product/create/'.$id);
			}else{
				redirect('product/create');
			}
		}
		// print_r($old_category);
		// print_r($new_category);
		// die;
		// $data = [
		// 	'post_title'=>$this->input->post('post_title', true),
		// 	'post_content'=>$this->input->post('post_content', true),
		// 	'post_image'=>$this->input->post('post_image', true),
		// 	'satuan'=>$this->session->userdata('username'),
		// 	'post_categories'=>implode("+",$this->input->post('post_category', true)),
		// 	'post_type'=>'post',
		// 	'post_status'=>$this->input->post('post_status', true),
		// 	'post_visibility'=>$this->input->post('post_access', true),
		// 	'post_comment_status'=>$this->input->post('post_comment', true),
		// 	'post_url'=>strtolower($this->input->post('post_title', true)),
		// 	'post_tags'=>implode(",",$this->input->post('post_tags', true)),
		// 	'create_at'=>time(),
		// 	'create_by'=>user()['idusers']
		// ];
		// print_r($data);die;
	}
	public function editImgProduct()
	{
		$id = $this->input->post('idproduct', true);
		$image = $this->input->post('image', true);
		$cek = $this->Product_m->productById($id);
		if (!empty($_FILES['image']['name'])) {
			if(!empty($cek->product_image) && $cek->product_image!='default.jpg'){
				unlink('uploads/products/'.$cek->product_image);
			}
			$config['upload_path']          = './uploads/products/';
			$config['allowed_types']        = settings('general','file_allowed_types');
			$config['max_size']             = settings('general','upload_max_filesize');
			$config['file_name']             = 'product-'.time();
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image')){
				$this->toastr->error('Image Upload Failed');
				redirect('product?s=all');
			}else{
				$gbr = $this->upload->data();
				$data = [
					"product_image" => $gbr['file_name'],
					"update_at" => get_dateTime(),
					"update_by" => user()['idusers']
				];
				$this->db->where('idproduct', $id);
				$this->db->update('product', $data);
				$this->toastr->success('Update Successfully');
				redirect('product?s=all');
				
			}
		}else{
			$this->toastr->error('No Image Uploaded');
			redirect('product?s=all');
		}
	}
	public function restok()
	{
		$id = $this->input->post('idproduct', true);
		$old_stok = $this->input->post('old_stok', true);
		$stok = delMask($this->input->post('stok', true));
		$data = [
			"stok"=>(int)$old_stok+(int)$stok
		];
		$this->db->where('idproduct', $id);
		$this->db->update('product', $data);
		
		redirect('product?s=minim');
		
	}
	/**
	* Data
	* @return Array
	*/
	private function data() {
		return [
			'product_name'=>$this->input->post('product_name', true),
			'category_id'=>$this->input->post('category_id', true),
			'product_seo'=>slugify($this->input->post('product_name', true)),
			'satuan'=>$this->input->post('satuan', true),
			'harga_beli'=>delMask($this->input->post('harga_beli', true)),
			'harga_jual'=>delMask($this->input->post('harga_jual', true)),
			'diskon'=>delMask($this->input->post('diskon', true)),
			'berat'=>delMask($this->input->post('berat', true)),
			'keterangan'=>$this->input->post('keterangan', true),
			'product_image'=>upload_image('products'),
			'stok'=>delMask($this->input->post('stok', true)),
			'create_at'=>get_dateTime(),
			'create_by'=>user()['idusers']
		];
	}
	/**
	* Validation Form
	* @return Boolean
	*/
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('product_name', 'Nama Produk', 'trim|required');
		$val->set_rules('satuan', 'Satuan', 'trim|required');
		$val->set_rules('harga_beli', 'Harga Beli', 'trim|required');
		$val->set_rules('harga_jual', 'Harga Jual', 'trim|required');
		$val->set_rules('berat', 'Berat', 'trim|required');
		$val->set_rules('stok', 'Stok', 'trim|required');
		// $val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
	/**
	* View By Id
	* @return Array
	*/
	public function view()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('product',['idproduct'=>$id])->row();
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
				$this->Posts_m->delete($id[$i]);
			}
		}else{
			$id = $this->input->post('idx');
			for ($i=0; $i < count($id); $i++) { 
				$this->Product_m->delete_permanen($id[$i]);
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

/* End of file Product.php */
