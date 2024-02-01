<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* Get User
*/
if (!function_exists('user')){
	function user(){
		$CI =& get_instance();
		$sql = "select * from users where user_name='".$CI->session->userdata('username')."'";
		return $CI->db->query($sql)->row_array();
	}
}
/**
* Get Settings Value
*/
if (! function_exists('settings')) {
	function settings($group='',$var='') {
		$ci = & get_instance();
		if($var!=null || $var!=null){
			$query = $ci->db->query("SELECT * FROM settings WHERE `group`='$group' AND variable='$var'")->row_array();
		}else{
			return $ci->db->query("SELECT * FROM settings WHERE `group`='$group' ORDER BY id ASC")->result_array();
		}
		if($query['value']!=null || $query['value']!=''){
			return $query['value'];
		}else{
			return $query['default'];
		}
	}
}
/**
* Get Produk
*/
if (!function_exists('produk')){
	function produk($id=null,$stok=null,$limit=null){
		$CI =& get_instance();
		if($id!=null){
			return $CI->db->get_where('product',['idproduct'=>$id])->row_array();
		}else{
			if($stok!=null){
				$CI->db->order_by('idproduct', 'desc');
				return $CI->db->get_where('product',['stok<='=>$stok])->result_array();
			}else{
				if($limit!=null){
					$CI->db->limit($limit);
					$CI->db->order_by('idproduct', 'desc');
					return $CI->db->get('product')->result_array();
				}else{
					$CI->db->order_by('idproduct', 'desc');
					return $CI->db->get('product')->result_array();
				}
			}
		}
	}
}
/**
* Get Produk Kategori
*/
if (!function_exists('produk_kategori')){
	function produk_kategori(){
		$CI =& get_instance();
		$CI->db->order_by('idcategory', 'asc');
		return $CI->db->get('product_category')->result_array();
	}
}
/**
* Get Slider
*/
if (!function_exists('slider')){
	function slider(){
		$CI =& get_instance();
		$CI->db->order_by('idslide', 'asc');
		return $CI->db->get('slider')->result_array();
	}
}
// /**
// * Get URL encode
// */
// if (!function_exists('url_enc')){
// 	function url_enc($data){
// 		$CI =& get_instance();
// 		return $CI->encrypt->encode($data);
// 	}
// }
// /**
// * Get URL decode
// */
// if (!function_exists('url_dec')){
// 	function url_dec($data){
// 		$CI =& get_instance();
// 		return $CI->encrypt->decode($data);
// 	}
// }
/**
* Get Provinsi Nama
*/
if (!function_exists('provNama')){
	function provNama($id){
		$CI =& get_instance();
		$data = $CI->db->get_where('provinsi',['id_prov'=>$id])->row();
		return $data->nama;
	}
}
/**
* Get Kabupaten Nama
*/
if (!function_exists('kabNama')){
	function kabNama($id){
		$CI =& get_instance();
		$data = $CI->db->get_where('kabupaten',['id_kab'=>$id])->row();
		return $data->nama;
	}
}
/**
* Get Cart Total
*/
if (!function_exists('cartTotal')){
	function cartTotal($id){
		$CI =& get_instance();
		$data = $CI->db->get_where('cart',['user_id'=>$id])->result_array();
		return $data;
	}
}
/**
* Get Cart SubTotal
*/
if (!function_exists('cartsubTotal')){
	function cartsubTotal($id){
		$CI =& get_instance();
		$CI->db->select('sum(harga*qty) as subtotal');
		$data = $CI->db->get_where('cart',['user_id'=>$id])->row_array();
		return $data['subtotal'];
	}
}
/**
* Get Cart SubTotal
*/
if (!function_exists('cartWeight')){
	function cartWeight($id){
		$CI =& get_instance();
		$CI->db->select('sum(berat*qty) as weight');
		$data = $CI->db->get_where('cart',['user_id'=>$id])->row_array();
		return $data['weight'];
	}
}
/**
* Get Cart SubTotal
*/
if (!function_exists('cartTotals')){
	function cartTotals($id){
		$CI =& get_instance();
		$CI->db->select('sum(harga*qty) as total');
		$data = $CI->db->get_where('cart',['user_id'=>$id])->row_array();
		return $data['total'];
	}
}
/**
* Get Cart Total
*/
if (!function_exists('cartlist')){
	function cartlist($id){
		$CI =& get_instance();
		$CI->db->join('product', 'cart.product_id = product.idproduct', 'left');
		$data = $CI->db->get_where('cart',['user_id'=>$id])->result_array();
		return $data;
	}
}
/**
* Get Testimonial
*/
if (!function_exists('testi')){
	function testi(){
		$CI =& get_instance();
		$CI->db->order_by('idtestimoni', 'asc');
		return $CI->db->get_where('testimonial',['status'=>'Yes'])->result_array();
	}
}
/**
* Get Pembayaran
*/
if (!function_exists('bayar')){
	function bayar($id){
		$CI =& get_instance();
		$CI->db->order_by('idpembayaran', 'desc');
		return $CI->db->get_where('pembayaran',['user_id'=>$id])->result();
	}
}
/**
* Get Detail Order
*/
if (!function_exists('detailOrder')){
	function detailOrder($id){
		$CI =& get_instance();
		$CI->db->join('detail_order', 'detail_order.order_id = pesanan.idorder', 'left');
		$CI->db->join('product', 'detail_order.product_id = product.idproduct', 'left');
		return $CI->db->get_where('pesanan',['idorder'=>$id])->result();
	}
}
/**
* Get Order By Status
*/
if (!function_exists('orderan')){
	function orderan($id,$sts){
		$CI =& get_instance();
		return $CI->db->get_where('pesanan',['user_id'=>$id,'status'=>$sts])->result();
	}
}
/**
* Get Product Terjual
*/
if (!function_exists('jmlTerjual')){
	function jmlTerjual($id){
		$CI =& get_instance();
		$CI->db->select('sum(qty) as terjual');
		return $CI->db->get_where('detail_order',['product_id'=>$id])->row();
	}
}
/**
* Get Produk Image
*/
if (!function_exists('produk_gambar')){
	function produk_gambar($id=null){
		$CI =& get_instance();
		if($id!=null){
			$CI->db->order_by('idImage', 'asc');
			return $CI->db->get_where('product_image',['product_id'=>$id])->result();
		}else{
			$CI->db->order_by('idImage', 'asc');
			return $CI->db->get('product_image')->result();
		}
	}
}
if (! function_exists('timezone_list')) {
	function timezone_list() {
		static $regions = array(DateTimeZone::ASIA);
		$timezones = array();
		foreach( $regions as $region ) {
			$timezones = array_merge($timezones, DateTimeZone::listIdentifiers($region));
		}
		$timezone_offsets = array();
		foreach($timezones as $timezone) {
			$tz = new DateTimeZone($timezone);
			$timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
		}
		asort($timezone_offsets);
		$timezone_list = array();
		foreach( $timezone_offsets as $timezone => $offset ) {
			$offset_prefix = $offset < 0 ? '-' : '+';
			$offset_formatted = gmdate( 'H:i', abs($offset) );
			$pretty_offset = "UTC${offset_prefix}${offset_formatted}";
			$timezone_list[$timezone] = "(${pretty_offset}) $timezone";
		}
		return $timezone_list;
	}
}