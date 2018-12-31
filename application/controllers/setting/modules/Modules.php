<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modules extends MY_Controller 
{
  public function __construct()
  {
    parent::__construct();
        
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
    $viewData['dataTableUrl']  = 'setting/modules/Modules/datatable';
    $viewData['ActionUrl']     = 'setting/modules/Modules/formSubmit';
    $viewData['listData']      = '1';
    //redirect 
    $viewData['message']       = $this->session->flashdata('msg');
    $viewData['alertType']     = $this->session->flashdata('alertType');   

    $data = array(
                    'title'     =>  $this->dbvars->app_name.' - '.$this->lang->line('module_page_title'),
                    'content'   =>  $this->load->view('setting/modules/modules_form', $viewData, TRUE)
                  );
    $this->load->view($this->dbvars->app_template, $data);
  }
  
  public function formSubmit($viewData='')
  {
    if(!empty($_POST))
    {
      //Validation Rules
      $this->form_validation->set_rules('category_code', lang('label_module'), 'required');          
      $this->form_validation->set_rules('category_desc', lang('label_operation_name'), 'required|trim');       
      
      if($this->form_validation->run() == TRUE)
      {

        if($this->input->post('category_id') == "")
        {
          //Insert
          $data       = array(                                              
                              'category_code'   => $this->input->post('category_code'),
                              'category_desc'   => $this->input->post('category_desc'),
                              'module_icon'     => ($this->input->post('module_icon')) ? $this->input->post('module_icon') : '',
                              'created_at'      =>  date('Y-m-d H:i:s')         
                              );
          $result     = $this->mcommon->common_insert('acl_categories', $data);

          if($result)
          {
            //Success Message After Insertion
            $this->session->set_flashdata('msg', 'Saved Successfully');
            $this->session->set_flashdata('alertType', 'success');
            redirect(base_url('setting/modules/Modules/add'));
          }
        }
        else
        { 
          //Update
          $data       = array(                                              
                              'category_code'   => $this->input->post('category_code'),
                              'category_desc'   => $this->input->post('category_desc'),
                              'module_icon'     => ($this->input->post('module_icon')) ? $this->input->post('module_icon') : '',
                              'created_at'      => date('Y-m-d H:i:s')         
                              );
                     
          $where_array = array('category_id' => $this->input->post('category_id'));
          $result      = $this->mcommon->common_edit('acl_categories', $data, $where_array);
   
          if($result)
          {
            //Success Message After Update
              $this->session->set_flashdata('msg', 'Updated Successfully');
              $this->session->set_flashdata('alertType', 'success');
              redirect(base_url('setting/modules/Modules/add'));
          }
          else
          {
            //Message while Submitting Form Without Any Update
            $this->session->set_flashdata('msg', 'No Data Has Been Changed');
            $this->session->set_flashdata('alertType', 'danger');
            redirect(base_url('setting/modules/Modules/add'));
          }  
        }
      }
    }

    $this->loadForm();
  }

  public function datatable()
  {
    $this->datatables ->select('c.category_id, c.category_code, c.category_desc, c.module_icon, ')
                      ->from('acl_categories as c');                                       
    $this->datatables ->edit_column('c.category_id', '$1', 'module_buttons(c.category_id, "setting/modules/Modules/")');
    $this->db->order_by('c.created_at',DESC);
    
    echo $this->datatables->generate();
  }

  public function add()
  {
    //Acl Permission To Load Form
    if( $this->acl_permits('setting.module_add') )
    {
      $this->loadForm();
    }
    else
    {
      //Unauthorized User Message
      $viewData ='';
      $data     = array(
                        'title'     =>  $this->lang->line('unauth_page_title'),
                        'content'   =>  $this->load->view('unauthorized',$viewData, TRUE)
                        );
      $this->load->view('base/error_template', $data);        
    }
  }  

  public function edit($category_id='')
  {
    //Acl Permission For Edit
    if( $this->acl_permits('setting.module_edit') )
    {
        $constraint_array           = array('category_id' => $category_id);             
        $viewData['tabledata']      = $this->mcommon->records_all('acl_categories', $constraint_array);
        $this->loadForm($viewData);
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

  public function delete($category_id='')
  {
    //Acl Permission For Delete
    if( $this->acl_permits('setting.module_delete') )
    {

      $where_array = array('category_id' => $category_id);
      $result      = $this->mcommon->common_delete('acl_categories',$where_array);
      
      if($result)
      {
          $this->session->set_flashdata('msg', 'Deleted Successfully');
          $this->session->set_flashdata('alertType', 'success');
          redirect(base_url('setting/modules/Modules/add'));
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
