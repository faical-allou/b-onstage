<?php
// To load the language in every controler
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
		$ci->load->library('session');
        $ci->load->helper('language');
		
		// Clear Lang
		$ci->lang->is_loaded = array();
		$ci->lang->language = array();
		
        $site_lang = $ci->session->userdata('site_lang');
        if ($site_lang) {
           $ci->lang->load('general',$ci->session->userdata('site_lang'));
		   $ci->config->set_item('language',$ci->session->userdata('site_lang'));
		   $ci->session->set_userdata('lang_loaded', $ci->session->userdata('site_lang'));
        } else {
           $ci->lang->load('general','english');
		   $ci->config->set_item('language','english');
		   $ci->session->set_userdata('lang_loaded', 'english');
        }
		
    }
}

?>