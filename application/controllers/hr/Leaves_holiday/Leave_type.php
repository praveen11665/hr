<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave_type extends MY_Controller
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
    if( $this->acl_permits('HR.leave_type') )
    {
      //Redirect
      $view_data = array(
                          'form_heading'      => $this->lang->line('Leave_type_form_heading'),
                          'form_title'        => $this->lang->line('Leave_type_form_title'),
                          'form_description'  => $this->lang->line('Leave_type_form_description'),
                          'list_heading'      => $this->lang->line('Leave_type_form_heading'),
                          'list_title'        => $this->lang->line('Leave_type_form_title'),
                          'list_description'  => $this->lang->line('Leave_type_form_description'),
                          'formUrl'           => 'hr/Leaves_holiday/Leave_type/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'        => TRUE
                          );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Leave Type Name', 'Maximum Leave Allowed', 'Last Update', 'Updated by');

      $view_data['dataTableUrl']   =   'hr/Leaves_holiday/Leave_type/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Leave_type_form_heading'),
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
      $this->form_validation->set_rules('leave_type_name', lang('label_leave_type_name'), 'trim|required');
      $this->form_validation->set_rules('max_days_allowed', lang('label_maximum_leave_allowed'), 'trim|required');
      
      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('leave_type_id') == "")
        {
          $data     = array(
                              'leave_type_name'  => $this->input->post('leave_type_name'),
                              'max_days_allowed' => $this->input->post('max_days_allowed'),
                              'is_carry_forward' => ($this->input->post('is_carry_forward'))?'1':'0',
                              'is_lwp'           => ($this->input->post('is_lwp'))?'1':'0',
                              'allow_negative'   => ($this->input->post('allow_negative'))?'1':'0',
                              'include_holiday'  => ($this->input->post('include_holiday'))?'1':'0',
                              'created_on'       => date('Y-m-d H:i:s'),
                              'updated_on'       => date('Y-m-d H:i:s'),
                              'created_by'       => $this->auth_user_id,
                              'updated_by'       => $this->auth_user_id
                            );
          $result   = $this->mcommon->common_insert('hr_leave_type', $data);

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
                                'leave_type_name'  => $this->input->post('leave_type_name'),
                                'max_days_allowed' => $this->input->post('max_days_allowed'),
                                'is_carry_forward' => ($this->input->post('is_carry_forward'))?'1':'0',
                                'is_lwp'           => ($this->input->post('is_lwp'))?'1':'0',
                                'allow_negative'   => ($this->input->post('allow_negative'))?'1':'0',
                                'include_holiday'  => ($this->input->post('include_holiday'))?'1':'0',
                                'updated_on'       => date('Y-m-d H:i:s'),
                                'updated_by'       => $this->auth_user_id
                              );
          $where_array  = array('leave_type_id'  =>$this->input->post('leave_type_id'));
          $result       = $this->mcommon->common_edit('hr_leave_type', $data, $where_array);

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
        $constraint_array   = array('leave_type_id'   =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_leave_type', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Leaves_holiday/Leave_type/ajaxLoadForm';
      $this->load->view('hr/Leaves_holiday/form/Leave_type_form', $Data);
    }
  }

  public function delete($leave_type_id)
  {
    $data       = array(
                  'is_delete'  => 1,
                  'updated_by' => $this->auth_user_id
                   );
    $where_array  = array('leave_type_id'  =>$leave_type_id);
    $result     = $this->mcommon->common_edit('hr_leave_type', $data, $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Leaves_holiday/Leave_type/'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('lt.leave_type_id, lt.leave_type_name,  lt.max_days_allowed, lt.updated_on, CONCAT(up.first_name, " ", up.last_name)')
    ->from('hr_leave_type AS lt')
    ->join('user_profile as up', 'up.user_id = lt.updated_by')
    ->where('lt.is_Delete', '0')
    ->edit_column('lt.leave_type_id', get_ajax_buttons('$1', 'hr/Leaves_holiday/Leave_type/'), 'lt.leave_type_id');
    $this->datatables->edit_column('lt.updated_on', '$1', 'get_date_timeformat(lt.updated_on)');
    $this->db->order_by('lt.updated_on',DESC);
    echo $this->datatables->generate();
  }
}