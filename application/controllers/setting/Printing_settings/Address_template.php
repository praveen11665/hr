<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Address_template extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->is_logged_in();

		$this->load->model("menu_model", "menu");
		$items = $this->menu->all();
		$this->load->library("multi_menu");
		$this->multi_menu->set_items($items);
		$this->lang->load("setting","english");
  	}
  	
  	public function index($data=array())
  	{
  		$data['formUrl'] = 'setting/Master_settings/Country/ajaxLoadForm';

		$view_data = array(
							'form_heading' 		=> $this->lang->line('address_template_form_heading'),
							'form_title' 		=> $this->lang->line('address_template_form_title'),
							'form_description' 	=> $this->lang->line('address_template_form_description'),
							'form_view' 		=> $this->load->view('setting/Printing_settings/form/Address_template_form', $data, TRUE),
							'list_heading' 		=> $this->lang->line('address_template_form_heading'),
							'list_title' 		=> $this->lang->line('address_template_form_title'),
							'list_description' 	=> $this->lang->line('address_template_form_description'),
							'list_view' 		=> ''
						  );
		$data = array(
	            	    'title'     => 	'Setting Module',
	                	'content'   =>	$this->load->view('base_template', $view_data,TRUE)
	                );
		$this->load->view($this->dbvars->app_template, $data);		
	}
}