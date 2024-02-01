<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Plugin_m');
		$this->load->model('Wilayah_m');
		
	}
	

	public function index()
	{
		$data['title'] = 'All Slide';
		$data['plugin'] = $data['slider'] = true;
		$data['allslide'] = $this->Plugin_m->allSlide();
		$data['content'] = 'backend/slider';
		$this->load->view('backend/index', $data);
	}
	public function testimoni()
	{
		$data['title'] = 'All Testimoni';
		$data['plugin'] = $data['testimoni'] = true;
		$data['alltestimoni'] = $this->Plugin_m->allTestimoni();
		$data['content'] = 'backend/testimonial';
		$this->load->view('backend/index', $data);
	}
	public function kurir()
	{
		$data['title'] = 'All Services';
		$data['plugin'] = $data['kurir'] = true;
		$data['allservice'] = $this->Plugin_m->allService();
		$data['content'] = 'backend/service';
		$this->load->view('backend/index', $data);
	}
	public function ongkir()
	{
		$data['title'] = 'All Postal Fee';
		$data['plugin'] = $data['ongkir'] = true;
		$data['provinsi'] = $this->Wilayah_m->provinsi();
		$data['datakurir'] = $this->Wilayah_m->kurir();
		// $data['dataservice'] = $this->Wilayah_m->service();
		$data['allongkir'] = $this->Plugin_m->allOngkir();
		$data['content'] = 'backend/ongkir';
		$this->load->view('backend/index', $data);
	}
	public function bank()
	{
		$data['title'] = 'Bank Account Information';
		$data['plugin'] = $data['bank'] = true;
		// $data['provinsi'] = $this->Wilayah_m->provinsi();
		// $data['datakurir'] = $this->Wilayah_m->kurir();
		// $data['dataservice'] = $this->Wilayah_m->service();
		$data['infobank'] = $this->db->get_where('info',['idinfo'=>1])->row();
		$data['content'] = 'backend/bank';
		$this->load->view('backend/index', $data);
	}
	public function editInfo()
	{
		$data = [
			'informasi'=>$this->input->post('informasi',true),
			'update_at'=>get_dateTime(),
			'update_by'=>user()['idusers']
		];
		$this->db->where('idinfo', $this->input->post('idinfo',true));
		$this->db->update('info', $data);
		$this->toastr->success('Update Successfully');
		redirect('plugin/bank');
		// var_dump($this->data());
		
	}
	public function addService()
	{
		$this->db->insert('kurir', $this->dataService());
		$this->toastr->success('Created Successfully');
		redirect('plugin/kurir');
		// var_dump($this->data());
		
	}
	public function addOngkir()
	{
		$this->db->insert('ongkir', $this->dataOngkir());
		$this->toastr->success('Created Successfully');
		redirect('plugin/ongkir');
		// var_dump($this->data());
		
	}
	public function addSlide()
	{
		$this->db->insert('slider', $this->data());
		$this->toastr->success('Created Successfully');
		redirect('plugin');
		// var_dump($this->data());
		
	}
	public function editSlide()
	{
		$data = [
			"title"=>$this->input->post('title', true),
			"sub_title"=>$this->input->post('sub_title', true),
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idslide', $this->input->post('idslide', true));
		$this->db->update('slider', $data);
	}
	public function editStatus()
	{
		$data = [
			"status"=>$this->input->post('status', true),
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idtestimoni', $this->input->post('idtestimoni', true));
		$this->db->update('testimonial', $data);
		redirect('plugin/testimoni');
	}
	public function editImgSlide()
	{
		$id = $this->input->post('idslide', true);
		$image = $this->input->post('image', true);
		$cek = $this->Plugin_m->slideById($id);
		if (!empty($_FILES['image']['name'])) {
			if(!empty($cek->image) && $cek->image!='default.jpg'){
				unlink('uploads/'.$cek->image);
			}
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = settings('general','file_allowed_types');
			$config['max_size']             = settings('general','upload_max_filesize');
			$config['file_name']             = 'slide-'.time();
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image')){
				$this->toastr->error('Image Upload Failed');
				redirect('plugin');
			}else{
				$gbr = $this->upload->data();
				$data = [
					"image" => $gbr['file_name'],
					"update_at" => get_dateTime(),
					"update_by" => user()['idusers']
				];
				$this->db->where('idslide', $id);
				$this->db->update('slider', $data);
				$this->toastr->success('Update Successfully');
				redirect('plugin');
				
			}
		}else{
			$this->toastr->error('No Image Uploaded');
			redirect('plugin');
		}
	}
	/**
	* Data
	* @return Array
	*/
	private function data() {
		return [
			'title'=>$this->input->post('title', true),
			'sub_title'=>$this->input->post('sub_title', true),
			'image'=>upload_image(),
			'create_at'=>get_dateTime(),
			'create_by'=>user()['idusers']
		];
	}
	/**
	* Data Service
	* @return Array
	*/
	private function dataService() {
		return [
			'kode'=>$this->input->post('kode', true),
			'nama'=>$this->input->post('nama', true),
			'layanan'=>$this->input->post('layanan', true),
			'keterangan'=>$this->input->post('keterangan', true),
			'create_at'=>get_dateTime(),
			'create_by'=>user()['idusers']
		];
	}
	/**
	* Data Ongkir
	* @return Array
	*/
	private function dataOngkir() {
		return [
			'asal'=>$this->input->post('kabasal', true),
			'tujuan'=>$this->input->post('kabtujuan', true),
			'kode_pos_asal'=>$this->input->post('kode_pos_asal', true),
			'kode_pos_tujuan'=>$this->input->post('kode_pos_tujuan', true),
			'kurir'=>$this->input->post('kurir', true),
			'layanan'=>$this->input->post('layanan', true),
			'biaya'=>delMask($this->input->post('biaya', true)),
			'estimasi'=>$this->input->post('estimasi', true),
			'catatan'=>$this->input->post('catatan', true),
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
		$data = $this->db->get_where('slider',['idslide'=>$id])->row();
		echo json_encode($data);
	}
	public function viewTesti()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('testimonial',['idtestimoni'=>$id])->row();
		echo json_encode($data);
	}
	public function viewService()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('kurir',['idkurir'=>$id])->row();
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
				$this->Plugin_m->delete($id[$i]);
			}
		}else{
			$id = $this->input->post('idx');
			for ($i=0; $i < count($id); $i++) { 
				$this->Plugin_m->delete_permanen($id[$i]);
			}
		}
	}
	public function deleteTesti()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->Plugin_m->delete($id[$i]);
			}
		}else{
			$id = $this->input->post('idx');
			for ($i=0; $i < count($id); $i++) { 
				$this->Plugin_m->delete_permanenTesti($id[$i]);
			}
		}
	}
	public function deleteService()
	{
		
		$id = $this->input->post('idx');
		for ($i=0; $i < count($id); $i++) { 
			$this->Plugin_m->delete_permanenService($id[$i]);
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

/* End of file Plugin.php */
