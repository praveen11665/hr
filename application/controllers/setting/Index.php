<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model("menu_model", "menu");
		$items = array();
		$items = $this->menu->getmodulemenus('2');		
		$this->load->library("multi_menu");
		$this->multi_menu->set_items($items);
		$this->is_logged_in();
  	}

	public function index()
	{
		$view_data = array();

		if( $this->require_role('admin, Employee, Manager') )
		{
			$view_data['module_data']	=  $this->mcommon->records_all('acl_categories', array('category_id' => '2'));
			$view_data['module_name']	= 'Setting Module';

			$data = array(
		            	    'title'     => 	'Setting Module',
		                	'content'   =>	$this->load->view('module_index',$view_data,TRUE)
		                );

			$this->load->view($this->dbvars->app_template, $data);
		}
		else
		{
			$data = array(
		            	    'title'     => 	$this->lang->line('login_page_title'),
		                	'content'   =>	$this->load->view('unauthorized',$view_data,TRUE)
		                );
			$this->load->view($this->dbvars->app_template, $data);
		}
	}
}
