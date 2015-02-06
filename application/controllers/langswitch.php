<?php
// Switching Between Different Languages
class LangSwitch extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
    }

    function switchLanguage($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
		 redirect($_SERVER['HTTP_REFERER']);
    }
}
?>