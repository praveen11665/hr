<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Force SSL
		//$this->force_ssl();

		// Form and URL helpers always loaded (just for convenience)
		$this->load->helper('form');
		$this->lang->load("app","english");
		$this->load->model('auth/recovery_model');
	}
}