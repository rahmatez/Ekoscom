<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah_m extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		// is_logged_in();
	}
	
	public function cekongkir($asal,$tujuan,$kurir,$layanan)
	{	
		return $this->db->get_where('ongkir',['asal'=>$asal,'tujuan'=>$tujuan,'kurir'=>$kurir,'layanan'=>$layanan])->row();
	}
	public function kurir()
	{	
		$this->db->group_by('kode');
		$this->db->order_by('kode ASC');
		return $this->db->get('kurir')->result_array();
	}
	public function provinsi()
	{	
		$this->db->order_by('nama ASC');
		return $this->db->get('provinsi')->result_array();
		
	}
	public function kota()
	{	
		$this->db->order_by('nama ASC');
		return $this->db->get_where('kabupaten')->result_array();
		
	}
	public function distrik()
	{	
		$this->db->order_by('nama ASC');
		return $this->db->get('kecamatan')->result_array();
		
	}
	public function desa()
	{	
		$this->db->order_by('nama ASC');
		return $this->db->get('kelurahan')->result_array();
		
	}
	public function kabupaten($provid)
	{	
		$kabupaten = "<option value='0'>-- Pilih Kota/Kabupaten --</option>";
		$this->db->order_by('nama ASC');
		$kab = $this->db->get_where('kabupaten', ['id_prov'=>$provid]);
		foreach ($kab->result_array() as $data) {
			$kabupaten.="<option value='$data[id_kab]'>$data[nama]</option>";
		}
		return $kabupaten;
	}
	public function layanan($kode)
	{	
		$layanan = "<option value='0'>-- Pilih Layanan --</option>";
		$this->db->order_by('layanan ASC');
		$serv = $this->db->get_where('kurir', ['kode'=>$kode]);
		foreach ($serv->result_array() as $data) {
			$layanan.="<option value='$data[layanan]'>$data[layanan] - $data[keterangan]</option>";
		}
		return $layanan;
	}
	public function kecamatan($kabid)
	{	
		$kecamatan = "<option value='0'>-- Pilih Distrik/Kecamatan --</option>";
		$this->db->order_by('nama ASC');
		$kab = $this->db->get_where('kecamatan', ['kabid'=>$kabid]);
		foreach ($kab->result_array() as $data) {
			$kecamatan.="<option value='$data[idkec]'>$data[nama]</option>";
		}
		// $kecamatan .= "<option value='0'>LAINNYA</option>";
		return $kecamatan;
	}
	public function kelurahan($kecid)
	{	
		$kelurahan = "<option value='0'>-- Pilih Desa/Kelurahan --</option>";
		$this->db->order_by('nama ASC');
		$kab = $this->db->get_where('kelurahan', ['kecid'=>$kecid]);
		foreach ($kab->result_array() as $data) {
			$kelurahan.="<option value='$data[idkel]'>$data[nama]</option>";
		}
		$kelurahan .= "<option value='0'>LAINNYA</option>";
		return $kelurahan;
	}
	

}

/* End of file Wilayah_m.php */
