<?php
class Language extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    function switch($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect(base_url());
    }
}