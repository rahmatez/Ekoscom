<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_m');
		$this->load->model('Category_m');
		$this->load->model('Wilayah_m');
		$this->load->model('Public_m');
		
	}
	public function index()
	{
		// $this->load->view('welcome_message');
		// $data['title'] = 'Title';
		// $data['description'] = 'D';
		// $data['keywords'] = keywords();
		$data['beranda'] = true;
		$data['content'] = 'themes/'.theme_active().'/home';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function product()
	{
		// $this->load->view('welcome_message');
		// $data['title'] = 'Title';
		// $data['description'] = 'D';
		$data['publicproduct'] = true;
		$data['content'] = 'themes/'.theme_active().'/product';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function category()
	{
		$data['publiccategory'] = true;
		$data['content'] = 'themes/'.theme_active().'/category';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function about()
	{
		$data['publicabout'] = true;
		$data['totalorder'] = count($this->db->get('pesanan')->result());
		$data['totalcustomer'] = count($this->db->get_where('users',['user_type'=>'customer'])->result());
		$data['content'] = 'themes/'.theme_active().'/about';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function detail()
	{
		$data['content'] = 'themes/'.theme_active().'/detailproduct';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function profil()
	{
		is_logged_in();
		$data['content'] = 'themes/'.theme_active().'/user_profil';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function order_total()
	{
		is_logged_in();
		$data['orderan_total']=$this->db->get_where('pesanan',['user_id'=>user()['idusers']])->result();
		$data['content'] = 'themes/'.theme_active().'/order-total';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function order_barang()
	{
		is_logged_in();
		$data['orderan_barang']=$this->Public_m->totalBeli(user()['idusers']);
		$data['content'] = 'themes/'.theme_active().'/order-barang';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function order_proses()
	{
		is_logged_in();
		$data['content'] = 'themes/'.theme_active().'/order-proses';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function order_delivered()
	{
		is_logged_in();
		$data['content'] = 'themes/'.theme_active().'/order-delivered';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function testimoni()
	{
		is_logged_in();
		$data['testi']=$this->db->get_where('testimonial',['user_id'=>user()['idusers']])->row();
		$data['content'] = 'themes/'.theme_active().'/testimoni';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function konfirmasiBayar()
	{
		is_logged_in();
		// $data['testi']=$this->db->get_where('testimonial',['user_id'=>user()['idusers']])->row();
		$data['infobank'] = $this->db->get_where('info',['idinfo'=>1])->row();
		$data['content'] = 'themes/'.theme_active().'/konfirmasi';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function detailproduct()
	{
		$id = _toInteger(decrypt_url($this->uri->segment(2)));
		// var_dump($id);die;
		$data['produk']=$this->Product_m->productById($id);
		$data['content'] = 'themes/'.theme_active().'/detailproduct';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function bycategory()
	{
		$id = _toInteger($this->uri->segment(2));
		$data['kategori']=$this->Category_m->productCategoryById($id);
		$data['produk']=$this->Product_m->productByCategory($id);
		$data['content'] = 'themes/'.theme_active().'/productbycategory';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function cart()
	{
		$data['provinsi'] = $this->Wilayah_m->provinsi();
		$data['datakurir'] = $this->Wilayah_m->kurir();
		$data['content'] = 'themes/'.theme_active().'/cart';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function checkout()
	{
		is_logged_in();
		$data['content'] = 'themes/'.theme_active().'/checkout';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	function add_to_cart(){ //fungsi Add To Cart
		$id=$this->input->post('produk_id');
		$cek_stok=$this->Product_m->productById($id);
		if($cek_stok->stok>=$this->input->post('qty')){
			// $code = 'ODR-'.get_dateTime();
			// $data = array(
			// 	'session' => $code, 
			// 	'product_id' => $this->input->post('produk_id'), 
			// 	'qty' => $this->input->post('qty'), 
			// 	'harga' => $this->input->post('produk_harga')
			// );
			// $this->db->insert('cart',$data);
			// $this->session->set_userdata(['odr'=>$code]);
			
			$data = array(
				'id' => $this->input->post('produk_id'), 
				'gambar' => $this->input->post('produk_gambar'), 
				'name' => $this->input->post('produk_nama'), 
				'price' => $this->input->post('produk_harga'), 
				'satuan' => $this->input->post('produk_satuan'), 
				'weight' => $this->input->post('produk_berat'), 
				'qty' => $this->input->post('qty'), 
			);
			$this->cart->insert($data);
			echo $this->show_cart(); //tampilkan cart setelah added
			// // redirect('welcome/cart');
		}
		
	}
	function add_cart(){ //fungsi Add To Cart
		$id=$this->input->post('produk_id');
		$cek_stok=$this->Product_m->productById($id);
		$cek=$this->Public_m->cartById($id);
		// if($cek_stok->stok>=$this->input->post('qty')){
			if(count($cek)>0){
				$qty = $cek->qty+$this->input->post('qty');
				if($cek_stok->stok>=$qty){
					$data = array(
						'qty' => $qty, 
						'update_at'=>get_dateTime(),
						'update_by'=>user()['idusers']
					);
					$this->db->where('idcart', $cek->idcart);
					$this->db->update('cart',$data);
				}
			}else{
				$data = array(
					'product_id' => $this->input->post('produk_id'), 
					'user_id' => user()['idusers'], 
					'qty' => $this->input->post('qty'), 
					'harga' => $this->input->post('produk_harga'), 
					'satuan' => $this->input->post('produk_satuan'), 
					'berat' => $this->input->post('produk_berat'),
					'create_at'=>get_dateTime(),
					'create_by'=>user()['idusers']
				);
				$this->db->insert('cart',$data);
			}
			// $code = 'ODR-'.get_dateTime();
			// $data = array(
			// 	'session' => $code, 
			// 	'product_id' => $this->input->post('produk_id'), 
			// 	'qty' => $this->input->post('qty'), 
			// 	'harga' => $this->input->post('produk_harga')
			// );
			// $this->db->insert('cart',$data);
			// $this->session->set_userdata(['odr'=>$code]);
			
		// }
		
	}

	// function show_cart(){ //Fungsi untuk menampilkan Cart
	// 	$output = '';
	// 	foreach ($this->Public_m->cartView() as $items) {
	// 		$output .='
	// 		<tr class="text-center">
	// 			<td class="product-remove"><a href="#" id="'.$items['idcart'].'" class="hapus_cart" ><span class="ion-ios-close"></span></a></td>

	// 			<td class="image-prod">
	// 				<div class="img" style="background-image:url('.base_url('uploads/products/').$items['product_image'].');"></div>
	// 			</td>

	// 			<td class="product-name">
	// 				<h3>'.$items['product_name'].'</h3>
	// 				<p>Satuan : '.$items['satuan'].'<br> Berat : '.$items['berat']*$items['qty'].' gram</p>
	// 			</td>

	// 			<td class="price">'.money($items['harga']).'</td>

	// 			<td class="quantity">
	// 				<p class="text-center" style="color:black;">'.$items['qty'].'</p>
					
	// 			</td>

	// 			<td class="total">'.money($items['harga']*$items['qty']).'</td>
	// 		</tr>';
	// 	}
	// 	return $output;
	// }
	function show_cart(){ //Fungsi untuk menampilkan Cart
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='
			<tr class="text-center">
				<td class="product-remove"><a href="#" id="'.$items['rowid'].'" class="hapus_cart" ><span class="ion-ios-close"></span></a></td>

				<td class="image-prod">
					<div class="img" style="background-image:url('.base_url('uploads/products/').$items['gambar'].');"></div>
				</td>

				<td class="product-name">
					<h3>'.$items['name'].'</h3>
					<p>Satuan : '.$items['satuan'].'<br> Berat : '.$items['weight']*$items['qty'].' gram</p>
				</td>

				<td class="price">'.money($items['price']).'</td>

				<td class="quantity">
					<p class="text-center" style="color:black;">'.$items['qty'].'</p>
					
				</td>

				<td class="total">'.money($items['subtotal']).'</td>
			</tr>';
		}
		return $output;
	}

	function load_pesanan(){ //load data cart
		echo $this->show_pesanan();
	}
	function load_total(){ //load data cart
		echo '<span class="icon-shopping_cart"></span>['.count($this->cart->contents()).']';
	}
	function cart_total(){ //load data cart
		echo money($this->cart->total());
	}
	function load_cart(){ //load data cart
		echo $this->show_cart();
	}

	function hapus(){ //fungsi untuk menghapus item cart
		$this->db->where('idcart', $this->input->post('row_id'));
		$this->db->delete('cart');
		
	}
	function hapus_cart(){ //fungsi untuk menghapus item cart
		// $data = array(
		// 	'rowid' => $this->input->post('row_id'),
		// 	'qty' => 0,
		// );
		// $this->cart->update($data);
		// echo $this->show_cart();
		// $this->cart->destroy();
		$this->cart->remove($this->input->post('row_id'));
	}
}
