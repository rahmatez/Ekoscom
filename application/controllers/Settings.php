<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Wilayah_m');
		
	}
	

	public function index()
	{
		$data['title'] = 'General';
		$data['settings'] = $data['general'] = true;
		$data['provinsi'] = $this->Wilayah_m->provinsi();
		$data['content'] = 'backend/general';
		$this->load->view('backend/index', $data);
	}
	public function company_profile()
	{
		$data['title'] = 'Company Profile';
		$data['settings'] = $data['company_profile'] = true;
		$data['content'] = 'backend/company_profile';
		$this->load->view('backend/index', $data);
	}
	public function social_account()
	{
		$data['title'] = 'Social Account';
		$data['settings'] = $data['social_account'] = true;
		$data['content'] = 'backend/social_account';
		$this->load->view('backend/index', $data);
	}
	public function editGeneral()
	{
		// var_dump(date('Y-m-d H:i:s',get_dateTime()));die;
		$data = [
			'value'=>$this->input->post('value', true),
			"updated_at" => get_dateTime(),
			"updated_by" => user()['idusers']
		];
		$this->db->where('id', $this->input->post('id', true));
		$this->db->update('settings', $data);
		$this->toastr->success('Setting Value Updated');
		redirect('settings');
	}
	public function editFavicon()
	{
		$id = $this->input->post('id', true);
		$image = $this->input->post('image', true);
		$cek = $this->db->get_where('settings',['id'=>$id])->row();
		if (!empty($_FILES['image']['name'])) {
			if(!empty($cek->value) && $cek->value!='default.jpg'){
				unlink('uploads/'.$cek->value);
			}
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = settings('general','file_allowed_types');
			$config['max_size']             = settings('general','upload_max_filesize');
			$config['file_name']             = 'favicon-'.time();
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image')){
				$this->toastr->error('Image Upload Failed');
				redirect('settings');
			}else{
				$gbr = $this->upload->data();
				$data = [
					"value" => $gbr['file_name'],
					"updated_at" => get_dateTime(),
					"updated_by" => user()['idusers']
				];
				$this->db->where('id', $id);
				$this->db->update('settings', $data);
				$this->toastr->success('Update Successfully');
				redirect('settings');
				
			}
		}else{
			$this->toastr->error('No Image Uploaded');
			redirect('settings');
		}
	}
	public function editCompanyProfile()
	{
		$data = [
			'value'=>$this->input->post('value', true),
			"updated_at" => get_dateTime(),
			"updated_by" => user()['idusers']
		];
		$this->db->where('id', $this->input->post('id', true));
		$this->db->update('settings', $data);
		$this->toastr->success('Setting Value Updated');
		redirect('settings/company_profile');
	}
	public function editSocialAccount()
	{
		$data = [
			'value'=>$this->input->post('value', true),
			"updated_at" => get_dateTime(),
			"updated_by" => user()['idusers']
		];
		$this->db->where('id', $this->input->post('id', true));
		$this->db->update('settings', $data);
		$this->toastr->success('Setting Value Updated');
		redirect('settings/social_account');
	}
	/**
	* View By Id
	* @return Array
	*/
	public function view()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('settings',['id'=>$id])->row();
		echo json_encode($data);
	}
}

/* End of file Settings.php */