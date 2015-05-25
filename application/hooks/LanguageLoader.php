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
		
		$lang_browser = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		switch ($lang_browser) {
			case 'fr': $lang_browser = "french"; break;
			case 'de': $lang_browser = "german"; break;
			default: $lang_browser = "english";
		};

		if ( !$ci->session->userdata('site_lang')){
		$site_lang = $lang_browser;
		}
		else {       
			$site_lang = $ci->session->userdata('site_lang');
		}
		
		
        if ($site_lang) {
           $ci->lang->load('general',$site_lang);
		   $ci->config->set_item('language',$site_lang);
		   $ci->session->set_userdata('lang_loaded', $site_lang);
        } else {
           $ci->lang->load('general','english');
		   $ci->config->set_item('language','english');
		   $ci->session->set_userdata('lang_loaded', 'english');
        }
		
    }
}

?>