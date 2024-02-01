<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller {

	public function index()
	{
		
	}
	public function backup_database() {
		$this->load->dbutil();
		$prefs = [
			'format' => 'zip',
			'filename' => 'backup-database-on-'.date("Y-m-d H-i-s").'.sql'
		];
		$backup =& $this->dbutil->backup($prefs); 
		$file_name = 'backup-database-on-'. date("Y-m-d-H-i-s") .'.zip';
		$this->zip->download($file_name);
	}
	public function backup_apps() {
		$this->load->library('zip');
		$this->zip->read_dir(FCPATH, false);
		$file_name = 'backup-apps-on-'. date("Y-m-d-H-i-s") .'.zip';
		$this->zip->download($file_name);
	}
}

/* End of file Maintenance.php */