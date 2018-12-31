<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Force SSL
		//$this->force_ssl();

		// Load language
		$this->lang->load("setting","english");
    $this->lang->load("validation_lang","english");

    // Load Form and Form Validation
    $this->load->helper('form');
    $this->load->library('form_validation');

		// Check the user is loggedin or not
		$this->is_logged_in();
	}

	public function loadForm($viewData=array())
  {
    //Page Config
    $viewData['dataTableUrl']     = 'setting/modules/Roles/datatable';
    $viewData['ActionUrl']        = 'setting/modules/Roles/formSubmit';
    $viewData['listData']         = '1';
    //  Load Flashdata message
    $viewData['message']          = $this->session->flashdata('msg');
    $viewData['alertType']        = $this->session->flashdata('alertType');

    // Get Data From acl_category tables
    //$viewData['categoryData']     = $this->mcommon->records_all('acl_categories');
    $viewData['categoryData']     = $this->hrcommon->getCategoryData();
    
    // Get Data From acl_actions tables
    $viewData['actionData']       = $this->mcommon->records_all('acl_actions');  

    $data = array (
                  'title'     =>  $this->dbvars->app_name.' - '.$this->lang->line('role_page_title'),
                  'content'   =>  $this->load->view('setting/modules/roles_form', $viewData, TRUE)
                  );
    $this->load->view($this->dbvars->app_template, $data);
  }

  public function formSubmit($viewData='')
  {
    if(!empty($_POST))
    {	
      //  Validation Rules
      $this->form_validation->set_rules('role_name','Role Name','required');
        
      if($this->form_validation->run() == TRUE)
      {
        if($this->input->post('role_id') == "")
        {
          //Insert
          $field_list = array('role_name' =>  $this->input->post('role_name'));
          $result     = $this->mcommon->common_insert('app_roles', $field_list);

          if($result)
          {
            $actionIdArr      = $this->input->post('action_id');
            $categoryIdArr    = $this->input->post('category_id');

            foreach ($actionIdArr as $key => $val) 
            {
              $field_list = array(
                                  'role_id'       =>  $result,
                                  'action_id'     =>  $actionIdArr[$key],
                                  'category_id'   =>  $categoryIdArr[$key]
                                 );
              $this->mcommon->common_insert('app_roles_actions', $field_list);
            }
            //Session message for added
            $this->session->set_flashdata('msg', 'Saved Successfully');
            $this->session->set_flashdata('alertType','success');
            redirect(base_url('setting/modules/Roles/add'));
          }
        }
        else
        {
          //Update 
          $field_list     = array('role_name' =>  $this->input->post('role_name'));
          $where          = array('role_id'   => $this->input->post('role_id'));
          $result         = $this->mcommon->common_edit('app_roles', $field_list, $where);

          /******
            Role Action Update -- START --
          *******/

            //Delete existing role actions based on this role_id
            $this->mcommon->common_delete('app_roles_actions', $where);
            //Then insert the new role actions for this role_id
            $actionIdArr    = $this->input->post('action_id');
            $categoryIdArr  = $this->input->post('category_id');

            foreach ($actionIdArr as $key => $val) 
            {
              $field_list = array(
                                  'role_id'       =>  $this->input->post('role_id'),
                                  'action_id'     =>  $actionIdArr[$key],
                                  'category_id'   =>  $categoryIdArr[$key]
                                 );

              $result = $this->mcommon->common_insert('app_roles_actions', $field_list);
            }
          /****
            Role Action Update -- END --
          *****/
   
          if($result)
          {
            //Session message for updated
            $this->session->set_flashdata('msg','Updated Successfully');
            $this->session->set_flashdata('alertType','success');
            redirect(base_url('setting/modules/Roles/add'));
          }
          else
          {
            //Session message for updated with no change data's 
            $this->session->set_flashdata('msg','No data changed');
            $this->session->set_flashdata('alertType','danger');
            redirect(base_url('setting/modules/Roles/add'));
          }  
        }
      }
    }
    $this->loadForm();
  }

  //Datatable Create
	function datatable()
	{
		$this->datatables->select('role_id, role_name');
		$this->datatables->from('app_roles');	   
		$this->datatables->edit_column('role_id', '$1','get_buttons(role_id,"setting/modules/Roles/")');
		echo $this->datatables->generate();
	}

  //Load loadform function
  public function add()
  {
    // acl permission access for add
    if( $this->acl_permits('setting.roles_add') )
    {
      $this->loadForm();
    }
    // Unauthorized access view
    else
    {
      $view_data='';
      $data = array(
                      'title'     =>  $this->lang->line('unauth_page_title'),
                      'content'   =>  $this->load->view('unauthorized',$view_data,TRUE)
                    );
      $this->load->view('base/error_template', $data);        
    }
  }

  //Edit Operation
  public function edit($role_id='')
  {
    // acl permission access for edit
    if( $this->acl_permits('setting.roles_edit') )
    {
      $where                          = array('role_id' => $role_id);
      $viewData['appRoleData']        = $this->mcommon->records_all('app_roles',$where);
      $viewData['appRoleActionData']  = $this->mcommon->records_all('app_roles_actions',$where);
      $this->loadForm($viewData);
    }
    // Unauthorized access view
    else
    {
      $view_data='';
      $data = array(
                      'title'     =>  $this->lang->line('unauth_page_title'),
                      'content'   =>  $this->load->view('unauthorized',$view_data,TRUE)
                    );
      $this->load->view('base/error_template', $data);        
    }
  }

  //Delete Operation
  public function delete($role_id='')
  {
    // acl permission access for delete
    if( $this->acl_permits('setting.roles_delete') )
    {
      $where        = array('role_id' => $role_id);
      $result       = $this->mcommon->common_delete('app_roles',$where);

      if ($result) 
      {
        //Session message for delete
        $this->session->set_flashdata('msg', 'Deleted Successfully');
        $this->session->set_flashdata('alertType','success');
        redirect(base_url('setting/modules/Roles/add'));      
      }
    }
    // Unauthorized access view
    else
    {
      $view_data='';
      $data = array(
                      'title'     =>  $this->lang->line('unauth_page_title'),
                      'content'   =>  $this->load->view('unauthorized',$view_data,TRUE)
                    );
      $this->load->view('base/error_template', $data);        
    } 
  } 
}
?>