<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
* Get Active Theme
*/
if (! function_exists('theme_active')) {
	function theme_active() {
		$ci = & get_instance();
		$query = $ci->db->query("SELECT theme_folder FROM themes where is_active='true'");
		$tmp = $query->row_array();
		if ($query->num_rows()>=1){
			return $tmp['theme_folder'];
		}else{
			return 'errors';
		}
	}
}
/**
* Session login 
* @param String
* @return Boolean
*/
function is_logged_in()
{
	$ci =& get_instance();
	if (!$ci->session->userdata('username')) {
		redirect('auth');
	}else{
		$access = $ci->session->userdata('access');
	}
}
/**
* Access for admin
* @param String
* @return Boolean
*/
function admin_access()
{
	$ci =& get_instance();
	if($ci->session->userdata('access') != 'super_user' || $ci->session->userdata('access') != 'administrator' || $ci->session->userdata('access') != 'user'){
		$ci->session->set_flashdata('msg','Anda tidak memiliki akses.');
		redirect('user');
	}
}
/**
* Access for member
* @param String
* @return Boolean
*/
function member_access()
{
	$ci =& get_instance();
	if($ci->session->userdata('access') != 'customer'){
		$ci->session->set_flashdata('msg','Anda tidak memiliki akses.');
		redirect('dashboard');
	}
}
/**
* Is a Natural number, but not a zero  (1,2,3, etc.)
* @param String $n
* @return Boolean
*/
if ( ! function_exists('_isNaturalNumber')) {
	function _isNaturalNumber( $n ) {
	return ($n != 0 && ctype_digit((string) $n));
}
}

/**
* Is Integer
* @param String $n
* @return Boolean
*/
if ( ! function_exists('_toInteger')) {
function _toInteger( $n ) {
	$n = abs(intval(strval($n)));
	return $n;
}
}
/**
* Slugify
* @param String
* @return String
*/
if (! function_exists('slugify')) {
	function slugify( $str ) {
	$lettersNumbersSpacesHyphens = '/[^\-\s\pN\pL]+/u';
	$spacesDuplicateHypens = '/[\-\s]+/';
	$str = preg_replace($lettersNumbersSpacesHyphens, '', $str);
	$str = preg_replace($spacesDuplicateHypens, '-', $str);
	$str = trim($str, '-');
	return strtolower($str);
}
}
/**
* Delete Mask Money
* @param String
* @return String
*/
if (! function_exists('delMask')) {
	function delMask( $str ) {
	return (int)implode('',explode('.',$str));
}
}
/**
* View Format Money
* @param String
* @return String
*/
if (! function_exists('money')) {
	function money( $str ) {
	return number_format($str,0,',','.');
}
}
/**
* Setting View
* @param String
* @return String
*/
if (! function_exists('setview')) {
	function setview( $str ) {
	$lettersNumbersSpacesHyphens = '/[^\-\s\pN\pL]+/u';
	$spacesDuplicateHypens = '/[\-\s]+/';
	$str = preg_replace($lettersNumbersSpacesHyphens, ' ', $str);
	$str = preg_replace($spacesDuplicateHypens, ' ', $str);
	$str = trim($str, ' ');
	return strtoupper($str);
}
}
/**
* Upload Image
*/
if (! function_exists('upload_image')) {
	function upload_image($param='') {
		$CI = &get_instance();
		if($param=='users'){
			$config['upload_path']          = './uploads/users/';
			$config['file_name']           = 'user-'.time();
		}elseif($param=='category'){
			$config['upload_path']          = './uploads/category/';
			$config['file_name']           = 'category-'.time();
			$default						= 'default.jpg';
		}elseif($param=='products'){
			$config['upload_path']          = './uploads/products/';
			$config['file_name']           = 'product-'.time();
			$default						= 'default.jpg';
		}else{
			$config['upload_path']          = './uploads/';
			$config['file_name']           = 'file-'.time();
			$default						= 'default.jpg';
		}
		$config['allowed_types']        = settings('general','file_allowed_types');
		$config['max_size']             = settings('general','upload_max_filesize');
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$CI->load->library('upload', $config);
		if (!empty($_FILES['image']['name'])) {
			if ( ! $CI->upload->do_upload('image')){
				return $CI->upload->display_errors();
			}else{
				$data = $CI->upload->data();
				return $data['file_name'];
			}
		}else{
			return $default;
		}
		// return $CI->m_links->get_links();
	}
}
/**
* Get Date and Time Now
*/
if (! function_exists('get_dateTime')) {
	function get_dateTime() {
		$CI = &get_instance();
		$CI->load->helper('date');
		return now(settings('general','timezone'));
	}
}

/**
* get_ip_address
* @return string
*/
if (! function_exists('get_ip_address')) {
	function get_ip_address() {
		return getenv('HTTP_X_FORWARDED_FOR') ? getenv('HTTP_X_FORWARDED_FOR') : getenv('REMOTE_ADDR');
	}
}

/**
* check_internet_connection
* @return bool
*/
if (! function_exists('check_internet_connection')) {
	function check_internet_connection() {
		return checkdnsrr('google.com');
	}
}

/**
* Get ID Modal
*/
if (! function_exists('idModal')) {
	function idModal($var='') {
		if($var=='timezone'){
			return 'modal_edit_timezone';
		}elseif($var=='favicon'){
			return 'modal_edit_favicon';
		}elseif($var=='city_from_delivery'){
			return 'modal_edit_city_from_delivery';
		}else{
			return 'modal_edit';
		}
	}
}
/**
* Get Links
*/
if (! function_exists('get_links')) {
	function get_links() {
		$CI = &get_instance();
		$CI->load->model('m_links');
		return $CI->m_links->get_links();
	}
}

/**
* Get Post categories
*/
if (! function_exists('get_post_categories')) {
	function get_post_categories($limit = 0) {
		$CI = &get_instance();
		$CI->load->model('m_post_categories');
		return $CI->m_post_categories->get_post_categories($limit);
	}
}

/**
* Get Tags
*/
if (! function_exists('get_tags')) {
	function get_tags() {
		$CI = &get_instance();
		$CI->load->model('m_tags');
		return $CI->m_tags->get_tags();
	}
}

/**
* Get Banners
*/
if (! function_exists('get_banners')) {
	function get_banners() {
		$CI = &get_instance();
		$CI->load->model('m_banners');
		return $CI->m_banners->get_banners();
	}
}

/**
* Get Archive Year
*/
if (! function_exists('get_archive_year')) {
	function get_archive_year() {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_archive_year();
	}
}

/**
* Get Archive
*/
if (! function_exists('get_archives')) {
	function get_archives($year) {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_archives($year);
	}
}

/**
* Get Quotes
*/
if (! function_exists('get_quotes')) {
	function get_quotes() {
		$CI = &get_instance();
		$CI->load->model('m_quotes');
		return $CI->m_quotes->get_quotes();
	}
}

/**
* Get Image Sliders
*/
if (! function_exists('get_image_sliders')) {
	function get_image_sliders() {
		$CI = &get_instance();
		$CI->load->model('m_image_sliders');
		return $CI->m_image_sliders->get_image_sliders();
	}
}

/**
* Get Question
*/
if (! function_exists('get_active_question')) {
	function get_active_question() {
		$CI = &get_instance();
		$CI->load->model('m_questions');
		return $CI->m_questions->get_active_question();
	}
}

/**
* Get Answears
*/
if (! function_exists('get_answers')) {
	function get_answers($question_id) {
		$CI = &get_instance();
		$CI->load->model('m_answers');
		return $CI->m_answers->get_answers($question_id);
	}
}

/**
* Get Recent Posts
*/
if (! function_exists('get_recent_posts')) {
	function get_recent_posts($limit) {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_recent_posts($limit);
	}
}

/**
* Get Popular Posts
*/
if (! function_exists('get_popular_posts')) {
	function get_popular_posts($limit) {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_popular_posts($limit);
	}
}

/**
* Get Post by category
*/
if (! function_exists('get_post_category')) {
	function get_post_category($id, $limit) {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_post_category($id, $limit);
	}
}

if (! function_exists('get_related_posts')) {
	function get_related_posts($get_post_categories, $id) {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_related_posts($get_post_categories, $id);
	}
}

/**
* Get Welcome
*/
if (! function_exists('get_welcome')) {
	function get_welcome() {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_welcome();
	}
}

/**
* Get Video
*/
if (! function_exists('get_recent_video')) {
	function get_recent_video($limit) {
		$CI = &get_instance();
		$CI->load->model('m_videos');
		return $CI->m_videos->get_recent_video($limit);
	}
}

/**
* Get Albums Photo
*/
if (! function_exists('get_albums')) {
	function get_albums($limit) {
		$CI = &get_instance();
		$CI->load->model('m_albums');
		return $CI->m_albums->get_albums($limit);
	}
}

/**
* recursive list
*/
if (!function_exists('recursive_list')) {
	function recursive_list($menus) {
		$str = '';
		foreach ($menus as $menu) {
			$url = base_url() . $menu['menu_url'];
			if ($menu['menu_type'] == 'links') {
				$url = $menu['menu_url'];
			}							
			$str .= '<li>';
			$subchild = recursive_list($menu['child']);
			$str .= anchor($url, $menu['menu_title'].($subchild?' <span class="caret"></span>':''), 'target="'.$menu['menu_target'].'"');
			if ($subchild) {
				$str .= "<ul class='dropdown-menu'>" . $subchild . "</ul>";
			}
			$str .= "</li>";
		}
		return $str;
	}
}