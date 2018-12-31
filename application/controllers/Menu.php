<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load("hr","english");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->is_logged_in();

		$this->load->model("menu_model", "menu");
		$items = $this->menu->all();
		$this->load->library("multi_menu");
		$this->multi_menu->set_items($items);
	}

	public function add()
	{
		$this->loadForm();
	}

	public function loadForm($viewData=array())
	{
		//Page Config
		$viewData['dataTableUrl']         		= 'Menu/datatable';
		$viewData['ActionUrl']            		= 'Menu/formSubmit';
		$viewData['listData']             		= '1';

		//Dropdown List Load
		$viewData['moduleDropdown']   			= $this->mdrop->moduleDropdown(); 
		$viewData['parentDropdown']       		= $this->mdrop->parentDropdown();
		$viewData['message']              		= $this->session->flashdata('msg');
		$viewData['alertType']            		= $this->session->flashdata('alertType');

		$data = array(
		'title'     =>  $this->dbvars->app_name.' - '.$this->lang->line('menu_page_title'),
		'content'   =>  $this->load->view('Menu_form', $viewData, TRUE)
		);

		$this->load->view($this->dbvars->app_template, $data);
	}

	public function formSubmit($viewData='')
	{
		if(!empty($_POST))
		{    
			//Form Validation
			$this->form_validation->set_rules('module_id', lang('label_Module'), 'required');
			//$this->form_validation->set_rules('id', lang('label_Parent'), 'required');
			$this->form_validation->set_rules('name', lang('label_Name'), 'required');
			if($this->form_validation->run() == TRUE)
			{
			    $parent = $this->input->post('parent');
			  if($this->input->post('id') == "")
			  {
			    	$data         	= array( 
					                        'module_id'   	=> $this->input->post('module_id'),
				                        	'parent'       	=> (empty($parent)) ? NULL : $parent,
					               			'name'   		=> $this->input->post('name'),
					                        'icon'          => $this->input->post('icon'),
					                        'slug'   		=> $this->input->post('slug'),
					                        'number'  		=> $this->input->post('number'),
			                        		);
			    $result       		= $this->mcommon->common_insert('menus', $data);
			    
			    if($result)
			    {
			      //success message due to session
			      $this->session->set_flashdata('msg', 'Insert Successfully');
			      $this->session->set_flashdata('alertType', 'success');
			      redirect(base_url('Menu/add'));
			    }
			  }
			  else
			  { 
			    //update with id
			    $data         	= array( 
				                        'module_id'   	=> $this->input->post('module_id'),
				                        'parent'       	=> (empty($parent)) ? NULL : $parent,
				                        'name'   		=> $this->input->post('name'),
				                        'icon'          => $this->input->post('icon'),
				                        'slug'   		=> $this->input->post('slug'),
				                        'number'  		=> $this->input->post('number'),
			                        );
			               
			    $where        	= array('id' => $this->input->post('id'));
			    $result       	= $this->mcommon->common_edit('menus', $data, $where);

			    if($result)
			    {
			      //success message due to session
			      $this->session->set_flashdata('msg', 'Updated Successfully');
			      $this->session->set_flashdata('alertType', 'success');
			      redirect(base_url('Menu/add'));
			    }
			    else
			    {
			      //alert message due to session
			      $this->session->set_flashdata('msg', 'No data has been changed');
			      $this->session->set_flashdata('alertType', 'danger');
			      redirect(base_url('Menu/add'));
			    }
			  }
			}
		}

		$this->loadForm();
	}

	public function datatable()
	{
		//datatable joining 
		$this->datatables 	->select('a.category_code, m.parent, m.name, m.icon, m.slug, m.number, m.id')
					    	->from('menus as m')
					    	->where('m.is_active', '1')
							->join('acl_categories as a', 'a.category_id = m.module_id');
		$this->datatables 	->edit_column('m.id', '$1', 'get_buttons(m.id, "Menu/")');


		echo $this->datatables->generate();
	}


	public function edit($id='')
	{ 
		$constraint_array         = array('id' => $id);   
		$viewData['tableData']    = $this->mcommon->records_all('menus',$constraint_array);
		$this->loadForm($viewData);
	}

	public function delete($id='')
	{

		$data       	= 	array('is_active'  => 0);
		$where_array  	= 	array('id' => $id);
		$result 		= 	$this->mcommon->common_edit('menus', $data, $where_array);
		if($result)
		{
			$this->session->set_flashdata('msg', 'Deleted Successfully');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('Menu/add'));
		}
	}
   
	/* parent automatically loading*/
	public function getParent()
	{
	    $parentDropdown  =   $this->mdrop->parentDropdown($this->input->post('module_id'));   
	    $extraAttr="id='id' class='form-control select2'";
		echo form_dropdown('id', $parentDropdown, '', $extraAttr);
	}


}