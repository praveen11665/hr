<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Moduleoperations extends MY_Controller
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
    $viewData['dataTableUrl']     = 'setting/modules/Moduleoperations/datatable';
    $viewData['ActionUrl']        = 'setting/modules/Moduleoperations/formSubmit';
    $viewData['listData']         = '1';
    //Dropdown List Load
    $viewData['moduleDropdown']   = $this->mdrop->moduleDropdown();
    //redirect
    $viewData['message']          = $this->session->flashdata('msg');
    $viewData['alertType']        = $this->session->flashdata('alertType');
    $data = array(
                    'title'     =>  $this->dbvars->app_name.' - '.$this->lang->line('moduleoperations_page_title'),
                    'content'   =>  $this->load->view('setting/modules/moduleoperationform', $viewData, TRUE)
                  );
    $this->load->view($this->dbvars->app_template, $data);
  }

  public function formSubmit($viewData='')
  {
    if(!empty($_POST))
    {
        $this->form_validation->set_rules('category_id', 'Module', 'required');
        $this->form_validation->set_rules('action_code', 'Operation Name', 'required|trim');
        $this->form_validation->set_rules('action_desc', 'Action Description', 'required|trim');

        if($this->form_validation->run() == TRUE)
        {
          $action_code  =  str_replace(' ', '_', strtolower($this->input->post('action_code')));
          if($this->input->post('action_id') == "")
          {
            $data       = array(
                                'action_id'       => $this->input->post('action_id'),
                                'action_code'     => $action_code,
                                'action_desc'     => $this->input->post('action_desc'),
                                'category_id'     => $this->input->post('category_id')
                                );
            $result     = $this->mcommon->common_insert('acl_actions', $data);

            if($result)
            {
              $this->session->set_flashdata('msg', 'Saved Successfully');
              $this->session->set_flashdata('alertType', 'success');
              redirect(base_url('setting/modules/Moduleoperations/add'));
            }
          }
          else
          {
            $data        = array(
                                'action_code'     => $action_code,
                                'action_desc'     => $this->input->post('action_desc'),
                                'category_id'     => $this->input->post('category_id')
                               );

            $where_array = array('action_id' => $this->input->post('action_id'));
            $result      = $this->mcommon->common_edit('acl_actions', $data, $where_array);

            if($result)
            {
                $this->session->set_flashdata('msg', 'Updated Successfully');
                $this->session->set_flashdata('alertType', 'success');
                redirect(base_url('setting/modules/Moduleoperations/add'));
            }
            else
            {
              $this->session->set_flashdata('msg', 'No changes has been done');
              $this->session->set_flashdata('alertType', 'danger');
              redirect(base_url('setting/modules/Moduleoperations/add'));
            }
          }
        }
    }
    $this->loadForm();
  }

  public function datatable()
  {
    $this->datatables ->select('a.action_id, c.category_code, a.action_code, a.action_desc')
                      ->from('acl_actions as a')
                      ->join('acl_categories as c', 'a.category_id = c.category_id');
    $this->datatables ->edit_column('a.action_id', '$1', 'get_buttons(a.action_id, "setting/modules/Moduleoperations/")');
    echo $this->datatables->generate();
  }

  public function add()
  {
    //Acl Permission To Load Form
    if( $this->acl_permits('setting.module_operations_add') )
    {
        $this->loadForm();
    }
    else
    {
      //Unauthorized User Message
      $viewData ='';
      $data     = array(
                        'title'     =>  $this->lang->line('unauth_page_title'),
                        'content'   =>  $this->load->view('unauthorized',$viewData,TRUE)
                       );
      $this->load->view('base/error_template', $data);        
    }   
  }

  public function edit($action_id='')
  {
    //Acl Permission For Edit
    if( $this->acl_permits('setting.module_operations_edit') )
    {
        $constraint_array           = array('action_id' => $action_id);
        $viewData['tabledata']      = $this->mcommon->records_all('acl_actions', $constraint_array);
        $this->loadForm($viewData);
    }
    else
    {
        //Unauthorized User Message
      $viewData ='';
      $data     = array(
                        'title'     =>  $this->lang->line('unauth_page_title'),
                        'content'   =>  $this->load->view('unauthorized',$viewData,TRUE)
                       );
      $this->load->view('base/error_template', $data);        
    }
  }

  public function delete($action_id='')
  {
    //Acl Permission For Delete
    if( $this->acl_permits('setting.module_operations_delete') )
    {

      $where_array = array('action_id' => $action_id);
      $result      = $this->mcommon->common_delete('acl_actions',$where_array);
      if($result)
      {
          $this->session->set_flashdata('msg', 'Deleted Successfully');
          $this->session->set_flashdata('alertType', 'success');
          redirect(base_url('setting/modules/Moduleoperations/add'));
      }
    }
    else
    {
      //Unauthorized User Message
      $viewData='';
      $data = array(
                      'title'     =>  $this->lang->line('unauth_page_title'),
                      'content'   =>  $this->load->view('unauthorized',$viewData,TRUE)
                    );
      $this->load->view('base/error_template', $data);        
    }
  }
}
