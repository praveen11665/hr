<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Index extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->is_logged_in();

		$this->load->model("menu_model", "menu");
		$items = $this->menu->getmodulemenus('4');
		$this->load->library("multi_menu");
		$this->multi_menu->set_items($items);
  }

  public function index($value='')
  {
		if( $this->require_role('admin, Employee, Manager') )
		{
			$view_data['module_data']	=	$this->mcommon->records_all('acl_categories', array('category_id' => '4'));
			$view_data['module_name']='HR Module';
			$data = array(
		            	    'title'     => 	'HR Module',
		                	'content'   =>	$this->load->view('module_index',$view_data,TRUE)
		                );
			$this->load->view($this->dbvars->app_template, $data);
		}
		else
		{
			echo '';
			$view_data='';
			$data = array(
		            	    'title'     => 	$this->lang->line('login_page_title'),
		                	'content'   =>	$this->load->view('unauthorized',$view_data,TRUE)
		                );
			$this->load->view($this->dbvars->app_template, $data);
		}
  }
}
