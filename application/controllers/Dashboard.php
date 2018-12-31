<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Force SSL
		//$this->force_ssl();

		$this->lang->load("app","english");
		// Form and URL helpers always loaded (just for convenience)

		$this->load->helper('url');
		$this->load->helper('form');
		$this->is_logged_in();
	}

	public function index()
	{
		//Dashboard - Modules
		$view_data 			  = array();
		$view_data['modules'] = $this->mcommon->specific_fields_records_all('acl_categories');

		$data = array(
	            	    'title'     => 	$this->lang->line('dashboard_title'),
	                	'content'   =>	$this->load->view('dashboard',$view_data,TRUE)
	                );
		$this->load->view($this->dbvars->app_template, $data);
	}
}
?>