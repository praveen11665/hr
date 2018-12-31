<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Branch extends MY_Controller 
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
    $this->lang->load("hr","english");
    $this->lang->load("validation_lang","english");
    $this->load->library("form_validation"); 
  }

  public function index($Data=array())
  {
    if( $this->acl_permits('HR.branch') )
    {  
      $view_data = array(
                          'form_heading'      => $this->lang->line('Branch_form_heading'),
                          'form_title'        => $this->lang->line('Branch_form_title'),
                          'form_description'  => $this->lang->line('Branch_form_description'),
                          'list_heading'      => $this->lang->line('Branch_form_heading'),
                          'list_title'        => $this->lang->line('Branch_form_title'),
                          'list_description'  => $this->lang->line('Branch_form_description'),
                          'formUrl'           => 'hr/Setup/Branch/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'        => TRUE
                        );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action','Branch', 'Last Update', 'Updated by');

      $view_data['dataTableUrl']   =   'hr/Setup/Branch/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Branch_form_heading'),
                      'content'   =>  $this->load->view('base_template', $view_data,TRUE)
                    );

      $this->load->view($this->dbvars->app_template, $data);
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

  public function ajaxLoadForm($pkey_id='')
  {
    $isFormLoad = TRUE;

    if(!empty($_POST))
    {
      //This will convert the string to array
      parse_str($_POST['postdata'], $_POST);

      //Checking Form Validation
      $this->form_validation->set_rules('branch', 'branch', 'required|callback_alpha_dash_space');

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('branch_id') == "")
        {
          $data     = array(
                            'branch'      => $this->input->post('branch'),
                            'created_on'  => date('Y-m-d H:i:s'),
                            'updated_on'  => date('Y-m-d H:i:s'),
                            'created_by'  => $this->auth_user_id,
                            'updated_by'  => $this->auth_user_id
                           );
          $result   = $this->mcommon->common_insert('hr_branch', $data);

          if($result)
          {
            $this->session->set_flashdata('msg', 'Saved Successfully');
            $this->session->set_flashdata('alertType', 'success');
            $ajaxResponse['result'] = 'success';
          }
        }
        //Edit function calling
        else
        {
          $data         = array(
                                'branch'      =>  $this->input->post('branch'),
                                'updated_on'  => date('Y-m-d H:i:s'),
                                'updated_by'  => $this->auth_user_id
                               );
          $where_array  = array('branch_id'  =>$this->input->post('branch_id'));
          $result       = $this->mcommon->common_edit('hr_branch', $data, $where_array);

          if($result)
          {
            $this->session->set_flashdata('msg', 'Updated Successfully');
            $this->session->set_flashdata('alertType', 'success');
            $ajaxResponse['result'] = 'success';
          }
          else
          {
            $this->session->set_flashdata('msg', 'No data has been changed');
            $this->session->set_flashdata('alertType', 'danger');
            $ajaxResponse['result'] = 'success';
          }
        }
        $isFormLoad = FALSE;
        echo json_encode($ajaxResponse);
      } 
    }

    if($isFormLoad)
    {
      //Get data from table for edit the data
      if($pkey_id != '')
      {
        $constraint_array   = array('branch_id'  =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_branch', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Setup/Branch/ajaxLoadForm';
      $this->load->view('hr/Setup/form/Branch_form', $Data);
    }
  }

  public function delete($branch_id)
  {
    $data         = array(
                            'is_delete'  => 1,
                            'updated_by' => $this->auth_user_id
                         );
    $where_array  = array('branch_id'  =>$branch_id);
    $result       = $this->mcommon->common_edit('hr_branch', $data, $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Setup/Branch/'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('hb.branch_id, hb.branch, hb.updated_on, CONCAT(up.first_name, " ", up.last_name)')
      ->from('hr_branch AS hb')
      ->join('user_profile as up', 'up.user_id = hb.updated_by')     
      ->where('hb.is_delete', '0')
      ->edit_column('hb.branch_id', get_ajax_buttons('$1', 'hr/Setup/Branch/'), 'hb.branch_id')
      ->edit_column('hb.updated_on', '$1', 'get_date_timeformat(hb.updated_on)');
      $this->db->order_by('hb.updated_on',DESC);
      echo $this->datatables->generate('json', '');
  }
  
  public function alpha_dash_space($field)
  {
    if (! preg_match('/^[a-zA-Z\s]+$/', $field))
    {
        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
        return FALSE;
    } 
    else 
    {
        return TRUE;
    }
  } 
}
