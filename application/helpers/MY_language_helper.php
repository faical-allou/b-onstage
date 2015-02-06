<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	function load_langs($lang = ''){
		$CI =& get_instance();
		$CI->load->library('session');
		$CI->load->library('input');
		
		if($lang)
			$CI->session->set_userdata('language', $lang);
		else
			$CI->session->set_userdata('language', $CI->input->get_post('hl'));
			
		if( ! $CI->session->userdata('language'))
			$CI->session->set_userdata('language', 'english');
		
		$CI->lang->load('general', $CI->session->userdata('language'));
		$CI->lang->load('form_validation', $CI->session->userdata('language'));
	}
load_langs();