<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// is_logged_in();
		$this->load->model('Wilayah_m');
		// $this->load->library('upload');
	}
	public function index()
	{
		if($this->session->userdata('jabatan') != 'Operator' && $this->session->userdata('jabatan') != 'Kepala Sekolah'){
			$this->session->set_flashdata('msg','Anda tidak dapat mengakses Tambah Guru');
			redirect('welcome/home');
		}
		$data['judul'] = 'Coba wilayah';
		$data['provinsi'] = $this->Wilayah_m->provinsi();
		$data['agama'] = ['Islam','Kristen Protestan','Kristen Katholik','Hindu','Budha','Konghucu'];
		$data['jabatan'] = ['Guru','Operator','Kepala Sekolah'];
		$data['jumlahguru'] = count($this->Guru_m->getAllData());
		$this->load->view('template/header', $data);
		$this->load->view('wilayah', $data);
		$this->load->view('template/footer');
		
	}
	public function ambilData()
	{
		$modul=$this->input->post('modul');
		$id=$this->input->post('id');
		if($modul=="kabupaten"){
			echo $this->Wilayah_m->kabupaten($id);
		}elseif($modul=="layanan"){
			echo $this->Wilayah_m->layanan($id);
		}elseif($modul=="kecamatan"){
			echo $this->Wilayah_m->kecamatan($id);
		}elseif($modul=="kelurahan"){
			echo $this->Wilayah_m->kelurahan($id);
		}
	}
	public function cek(){
		$asal=settings('general','city_from_delivery');
		$tujuan=$this->input->post('kab_id',true);
		$kurir=$this->input->post('kurir',true);
		$layanan=$this->input->post('layanan',true);
		// $data = $this->Wilayah_m->cekongkir($asal,$tujuan,$kurir,$layanan);
		$data = $this->db->get_where('ongkir',['asal'=>$asal,'tujuan'=>$tujuan,'kurir'=>$kurir,'layanan'=>$layanan])->row();
		echo json_encode($data);
	}
	// public function kabupaten($id)
	// {
	// 	if($this->session->userdata('jabatan') != 'Operator' && $this->session->userdata('jabatan') != 'Kepala Sekolah'){
	// 		$this->session->set_flashdata('msg','Anda tidak dapat mengakses Tambah Guru');
	// 		redirect('welcome/home');
	// 	}
	// 	$data['judul'] = 'Coba wilayah';
	// 	$data['provinsi'] = $this->Wilayah_m->kabupaten();
	// 	$data['agama'] = ['Islam','Kristen Protestan','Kristen Katholik','Hindu','Budha','Konghucu'];
	// 	$data['jabatan'] = ['Guru','Operator','Kepala Sekolah'];
	// 	$data['jumlahguru'] = count($this->Guru_m->getAllData());
	// 	$this->load->view('template/header', $data);
	// 	$this->load->view('wilayah', $data);
	// 	$this->load->view('template/footer');
		
	// }

}

/* End of file Wilayah.php */