<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('User_m');
		$this->load->model('Wilayah_m');
		
	}
	

	public function index()
	{	
		$idorder = $this->db->get_where('pesanan',['user_id'=>user()['idusers']])->row();
		// var_dump($idorder->idorder);die;
		if($idorder){
		$data['totalorder']=count($this->db->get_where('pesanan',['user_id'=>user()['idusers']])->result());
		$data['totalproses']=count($this->db->get_where('pesanan',['user_id'=>user()['idusers'],'status'=>'proses'])->result());
		$data['totalpengiriman']=count($this->db->get_where('pesanan',['user_id'=>user()['idusers'],'status'=>'pengiriman'])->result());
		$data['totalbeli']=count($this->User_m->totalBeli(user()['idusers']));
		}else{
			$data['totalorder']=0;
			$data['totalproses']=0;
			$data['totalpengiriman']=0;
			$data['totalbeli']=0;
		}// var_dump($data['barangbeli']);die;
		$data['provinsi'] = $this->Wilayah_m->provinsi();
		$data['profil']=$this->User_m->getProfile(user()['idusers']);
		$data['content'] = 'themes/'.theme_active().'/user_profil';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function alluser()
	{
		$data['title'] = 'All Users';
		$data['users'] = $data['allusers'] = true;
		$data['alluser'] = $this->db->get('users')->result_array();
		$data['content'] = 'backend/alluser';
		$this->load->view('backend/index', $data);
	}
	public function user_profile()
	{
		$data['title'] = 'Update Profile';
		$data['user_profile'] = true;
		$data['update_user'] = $this->db->get_where('users',['idusers'=>user()['idusers']])->row();
		$data['content'] = 'backend/profil';
		$this->load->view('backend/index', $data);
	}
	public function change_password()
	{
		$data['title'] = 'Change Password';
		$data['change_password'] = true;
		$data['update_user'] = $this->db->get_where('users',['idusers'=>user()['idusers']])->row();
		$data['content'] = 'backend/change_password';
		$this->load->view('backend/index', $data);
	}
	public function editpassword(){
		// $this->User_m->register();
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[25]|matches[retype_password]');
		$this->form_validation->set_rules('retype_password', 'Confirm password', 'trim|required|min_length[3]|max_length[25]|matches[password]');
		if ($this->form_validation->run() == TRUE) {
			$data = [
				'user_password' => password_hash(htmlspecialchars($this->input->post('password', true)), PASSWORD_DEFAULT),
				'update_at'=>get_dateTime(),
				'update_by'=>$this->input->post('idusers', true)
			];
			$this->db->where('idusers', $this->input->post('idusers', true));
			$this->db->update('users', $data);
			$this->toastr->success('Your Password Updated');
		} else {
			$this->toastr->error('Password and Retype Password Not Matchs');
		}
		redirect('user/change_password');
	}
	public function editprofil()
	{
		$data = [
			'user_fullname'=>$this->input->post('user_fullname', true),
			'user_telp'=>$this->input->post('user_telp', true),
			'user_url'=>$this->input->post('user_url', true),
			'user_bio'=>$this->input->post('user_bio', true),
			'update_at'=>get_dateTime(),
			'update_by'=>$this->input->post('idusers', true)
		];
		$this->db->where('idusers', $this->input->post('idusers', true));
		$this->db->update('users', $data);
		$this->toastr->success('Your Profile Updated');
		redirect('user/user_profile');
	}
	public function usergroup()
	{
		$data['title'] = 'All Group';
		$data['users'] = $data['usersgroup'] = true;
		$data['usergroup'] = $this->db->get('user_group')->result_array();
		$data['content'] = 'backend/usergroup';
		$this->load->view('backend/index', $data);
	}
	public function useraccess()
	{
		$data['title'] = 'All Access';
		$data['users'] = $data['usersaccess'] = true;
		$data['alluser'] = $this->db->get('users')->result_array();
		$data['content'] = 'backend/alluser';
		$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data = [
			'users_id'=>$this->input->post('users_id', true),
			'fullname'=>$this->input->post('nama', true),
			'telp'=>$this->input->post('telp', true),
			'prov'=>$this->input->post('prov', true),
			'kab'=>$this->input->post('kab', true),
			'kec'=>$this->input->post('kec', true),
			'kodepos'=>$this->input->post('kodepos', true),
			'address'=>$this->input->post('address', true),
			'create_at'=>get_dateTime(),
			'create_by'=>user()['idusers']
		];
		$this->db->insert('user_profile', $data);
		redirect('user');
	}
	public function edit()
	{
		$data = [
			'fullname'=>$this->input->post('nama', true),
			'telp'=>$this->input->post('telp', true),
			'prov'=>$this->input->post('prov', true),
			'kab'=>$this->input->post('kab', true),
			'kec'=>$this->input->post('kec', true),
			'kodepos'=>$this->input->post('kodepos', true),
			'address'=>$this->input->post('address', true),
			'update_at'=>get_dateTime(),
			'update_by'=>$this->input->post('iduser_profile', true)
		];
		$this->db->where('iduser_profile', $this->input->post('iduser_profile', true));
		$this->db->update('user_profile', $data);
		redirect('user');
	}
	public function addTestimoni()
	{
		$data = [
			'user_id'=>$this->input->post('user_id', true),
			'name'=>$this->input->post('nama', true),
			'telp'=>$this->input->post('telp', true),
			'job'=>$this->input->post('job', true),
			'message'=>$this->input->post('message', true),
			'create_at'=>get_dateTime(),
			'create_by'=>user()['idusers']
		];
		$this->db->insert('testimonial', $data);
		redirect('public/testimoni');
	}
	public function addKonfirmasi()
	{
		$config['upload_path']          = './uploads/bukti/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1024;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;
		$config['file_name']           = 'bukti-bayar-'.time();

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('bukti'))
		{
			$this->upload->display_errors();
		}
		else
		{
			$img = $this->upload->data();
			$image = $img['file_name'];
			// var_dump($image);die;
			$this->User_m->addBayar($image);
		}
		// $data = [
		// 	'total'=>$this->input->post('total', true),
		// 	'file'=>$this->input->post('bukti', true),
		// 	'keterangan'=>$this->input->post('keterangan', true),
		// 	'tgl_bayar'=>get_dateTime()
		// ];
		// // var_dump($data);die;
		// $this->db->where('idpembayaran', $this->input->post('idbayar', true));
		// $this->db->update('pembayaran', $data);
		redirect('public/konfirmasi');
	}
	public function editTestimoni()
	{
		$data = [
			'name'=>$this->input->post('nama', true),
			'telp'=>$this->input->post('telp', true),
			'job'=>$this->input->post('job', true),
			'message'=>$this->input->post('message', true),
			'status'=>'No',
			'update_at'=>get_dateTime(),
			'update_by'=>user()['idusers']
		];
		$this->db->where('user_id', $this->input->post('user_id', true));
		$this->db->update('testimonial', $data);
		redirect('public/testimoni');
	}
	public function addNewUser(){
		// $this->User_m->register();
		$data = [
			'user_name' => htmlspecialchars($this->input->post('user_name', true)),
			'user_password' => password_hash(htmlspecialchars($this->input->post('user_password', true)), PASSWORD_DEFAULT),
			'user_fullname' => htmlspecialchars($this->input->post('user_fullname', true)),
			'user_telp' => htmlspecialchars($this->input->post('user_telp', true)),
			'user_type' => htmlspecialchars($this->input->post('user_type', true)),
			'is_active' => 1,
			'is_block' => 0,
			'create_at' => get_dateTime(),
			'create_by' => user()['idusers']
		];
		$this->db->insert('users', $data);
		$this->toastr->success('Created Successfully');
		redirect('user/alluser');
	}
	public function updateUser()
	{
		if($this->input->post('idusers', true)==1){
			$user_type = 'super_user';
		}else{
			$user_type = htmlspecialchars($this->input->post('user_type', true));
		}
		$data = [
			'user_name' => htmlspecialchars($this->input->post('user_name', true)),
			'user_fullname' => htmlspecialchars($this->input->post('user_fullname', true)),
			'user_telp' => htmlspecialchars($this->input->post('user_telp', true)),
			'user_type' => $user_type,
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idusers', $this->input->post('idusers', true));
		$this->db->update('users', $data);
	}
	public function changepassword()
	{
		$data = [
			"user_password"=>password_hash(htmlspecialchars($this->input->post('user_password', true)), PASSWORD_DEFAULT),
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idusers', $this->input->post('idusers', true));
		$this->db->update('users', $data);
		$this->toastr->success('Change Password Successfully');
		redirect('user/alluser');
	}
	public function proses_order()
	{
		//-------------------------Input data order------------------------------
		$data_order = array('code' => 'ODR-'.get_dateTime(),
							'datetime' => get_dateTime(),
							'user_id' => user()['idusers'],
							'subtotal' => $this->input->post('subtotal',true),
							'total_weight' => $this->input->post('weight',true),
							'order_ongkir' => $this->input->post('delivery',true),
							'total_harga' => $this->input->post('carttotal',true),
							'order_prov' => $this->input->post('prov',true),
							'order_kab' => $this->input->post('kab',true),
							'order_kec' => $this->input->post('kec',true),
							'order_kodepos' => $this->input->post('kodepos',true),
							'order_address' => $this->input->post('address',true),
							'order_kurir' => $this->input->post('kurir',true),
							'order_layanan' => $this->input->post('layanan',true),
							'status_bayar' => 'belum lunas',
							'status' => 'pembayaran pending',
							'create_at'=>get_dateTime(),
							'create_by'=>user()['idusers']
						);
							// var_dump($data_order);die;
		$id_order = $this->User_m->tambah_order($data_order);
		//-------------------------Input data pembayaran------------------------------
		$data_bayar = array('order_id' => $id_order,
							'user_id' => user()['idusers'],
							'file' => '',
							'total' => 0,
							'status' => 'pending',
							'keterangan' => '',
							'create_at'=>get_dateTime(),
							'create_by'=>user()['idusers']
						);
							// var_dump($data_order);die;
		$id_bayar = $this->User_m->tambah_bayar($data_bayar);
		//-------------------------Input data detail order-----------------------		
		if ($cart = cartlist(user()['idusers']))
			{
				foreach ($cart as $item)
					{
						$data_detail = array(
							'product_id' => $item['product_id'],
							'order_id' =>$id_order,
							'qty' => $item['qty'],
							'harga' => $item['harga'],			
							'satuan' => $item['satuan'],			
							'berat' => $item['berat'],
							'create_at'=>get_dateTime(),
							'create_by'=>user()['idusers']			
						);
						$proses = $this->User_m->tambah_detail_order($data_detail);
						$this->db->where('idcart', $item['idcart']);
						$this->db->delete('cart');
					}
			}
		//-------------------------Hapus shopping cart--------------------------		
		// $this->cart->destroy();
		
		redirect(base_url('user'),'refresh');
		
	}
	// public function proses_orde()
	// {
	// 	//-------------------------Input data order------------------------------
	// 	$data_order = array('code' => 'ODR-'.get_dateTime(),
	// 						'datetime' => get_dateTime(),
	// 						'user_id' => user()['idusers'],
	// 						'total_harga' => $this->cart->total(),
	// 						'status_bayar' => 'belum lunas',
	// 						'status' => 'pembayaran pending',
	// 						'create_at'=>get_dateTime(),
	// 						'create_by'=>user()['idusers']
	// 					);
	// 						// var_dump($data_order);die;
	// 	$id_order = $this->User_m->tambah_order($data_order);
	// 	//-------------------------Input data pembayaran------------------------------
	// 	$data_bayar = array('order_id' => $id_order,
	// 						'user_id' => user()['idusers'],
	// 						'file' => '',
	// 						'total' => 0,
	// 						'status' => 'pending',
	// 						'keterangan' => '',
	// 						'create_at'=>get_dateTime(),
	// 						'create_by'=>user()['idusers']
	// 					);
	// 						// var_dump($data_order);die;
	// 	$id_bayar = $this->User_m->tambah_bayar($data_bayar);
	// 	//-------------------------Input data detail order-----------------------		
	// 	if ($cart = $this->cart->contents())
	// 		{
	// 			foreach ($cart as $item)
	// 				{
	// 					$data_detail = array(
	// 						'product_id' => $item['id'],
	// 						'order_id' =>$id_order,
	// 						'qty' => $item['qty'],
	// 						'harga' => $item['price'],			
	// 						'satuan' => $item['satuan'],			
	// 						'berat' => $item['berat'],
	// 						'create_at'=>get_dateTime(),
	// 						'create_by'=>user()['idusers']			
	// 					);
	// 					$proses = $this->User_m->tambah_detail_order($data_detail);
	// 				}
	// 		}
	// 	//-------------------------Hapus shopping cart--------------------------		
	// 	$this->cart->destroy();
		
	// 	redirect(base_url('user'),'refresh');
		
	// }
	/**
	* View By Id
	* @return Array
	*/
	public function view()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('users',['idusers'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* View Alamat By Id
	* @return Array
	*/
	public function viewAlamat()
	{
		$id = $this->input->post('id', true);
		$this->db->select('user_profile.*,kabupaten.nama as nama_kab');
		$this->db->join('kabupaten', 'kabupaten.id_kab = user_profile.kab', 'left');
		// $this->db->join('provinsi', 'provinsi.id_prov = user_profile.prov', 'left');
		$data = $this->db->get_where('user_profile',['users_id'=>$id])->row();
		// $data = $this->db->get_where('user_profile',['users_id'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* Blocked By ID
	* @return Boolean
	*/
	public function block()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->User_m->blocked($id[$i]);
			}
		}
	}
	/**
	* Unblocked By ID
	* @return Boolean
	*/
	public function unblock()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->User_m->unblocked($id[$i]);
			}
		}
	}
}

/* End of file User.php */