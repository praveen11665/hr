<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave_allocation extends MY_Controller
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
    if( $this->acl_permits('HR.leave_allocation') )
    {
      //Redirect
      $view_data = array(
                          'form_heading'      => $this->lang->line('Leave_Allocation_log_form_heading'),
                          'form_title'        => $this->lang->line('Leave_Allocation_log_form_title'),
                          'form_description'  => $this->lang->line('Leave_Allocation_log_form_description'),
                          'list_heading'      => $this->lang->line('Leave_Allocation_log_form_heading'),
                          'list_title'        => $this->lang->line('Leave_Allocation_log_form_title'),
                          'list_description'  => $this->lang->line('Leave_Allocation_log_form_description'),
                          'formUrl'           => 'hr/Leaves_holiday/Leave_allocation/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'         => TRUE
                        );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Employee Name', 'Leave Type', 'From Date', 'To Date', 'Total Leave Allocated');

      $view_data['dataTableUrl']   =   'hr/Leaves_holiday/Leave_allocation/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Leave_Allocation_log_form_heading'),
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
      $this->form_validation->set_rules('naming_series', lang('label_series'), 'trim|required');
      $this->form_validation->set_rules('employee_id', lang('label_employee'), 'trim|required');    
      $this->form_validation->set_rules('leave_type_id', lang('label_leave_type'), 'trim|required');    
      $this->form_validation->set_rules('description', lang('label_description'), 'trim|required');    
      $this->form_validation->set_rules('from_date', lang('label_from_date'), 'trim|required');    
      $this->form_validation->set_rules('to_date', lang('label_to_date'), 'trim|required');    

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        $naming         = $this->input->post('naming_series');       
        $namingSeries   = $this->mcommon->generateSeries($naming,6);
        if($this->input->post('leave_allocation_id') == "")
        {
          $data     = array(
                              'naming_series'          => $namingSeries,
                              'employee_id'            => $this->input->post('employee_id'),
                              'employee_name'          => $this->input->post('employee_name'),
                              'description'            => $this->input->post('description'),
                              'leave_type_id'          => $this->input->post('leave_type_id'),
                              'from_date'              => date('Y-m-d', strtotime($this->input->post('from_date'))),
                              'to_date'                => date('Y-m-d', strtotime($this->input->post('to_date'))),
                              'new_leaves_allocated'   => $this->input->post('new_leaves_allocated'),
                              'carry_forward'          => ($this->input->post('carry_forward'))?'1':'0',
                              'carry_forwarded_leaves' => $this->input->post('carry_forwarded_leaves'),
                              'total_leaves_allocated' => $this->input->post('total_leaves_allocated'), 
                           );
          $result   = $this->mcommon->common_insert('hr_leave_allocation', $data);

          $where_array  = array('transaction_id' => 6);

          if($result)
          {
            $resultupdate = $this->mcommon->dataUpdate('set_naming_series', 'current_value', $where_array); 
          }

          if($resultupdate)
          {
            $this->session->set_flashdata('msg', 'Saved Successfully');
            $this->session->set_flashdata('alertType', 'success');
            //redirect(base_url('setting/Printing_settings/Printing_heading/add'));
            $ajaxResponse['result'] = 'success';
          }
        }
        //Edit function calling
        else
        {
          $data     = array(
                              'naming_series'          => $namingSeries,
                              'employee_id'            => $this->input->post('employee_id'),
                              'employee_name'          => $this->input->post('employee_name'),
                              'description'            => $this->input->post('description'),
                              'leave_type_id'          => $this->input->post('leave_type_id'),
                              'from_date'              => date('Y-m-d', strtotime($this->input->post('from_date'))),
                              'to_date'                => date('Y-m-d', strtotime($this->input->post('to_date'))),
                              'new_leaves_allocated'   => $this->input->post('new_leaves_allocated'),
                              'carry_forward'          => ($this->input->post('carry_forward'))?'1':'0',
                              'carry_forwarded_leaves' => $this->input->post('carry_forwarded_leaves'),
                              'total_leaves_allocated' => $this->input->post('total_leaves_allocated'),
                           );
          $where_array  = array('leave_allocation_id'  =>$this->input->post('leave_allocation_id'));
          $result     = $this->mcommon->common_edit('hr_leave_allocation', $data, $where_array);

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
        $constraint_array   = array('leave_allocation_id'   =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_leave_allocation', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Leaves_holiday/Leave_allocation/ajaxLoadForm';
      $this->load->view('hr/Leaves_holiday/form/Leave_allocation_form', $Data);
    }
  }

  public function gettotalleavesallocated($value='')
  {
    //$totalleavesallocated      = $this->input->post('total_leaves_allocated');
    //print_r($totalleavesallocated);
    $constraint_array   = array('employee_id' => $this->input->post('employee_id'));
    $totalleavesallocated      = $this->mcommon->specific_row_value('hr_leave_allocation', $constraint_array, 'total_leaves_allocated');
   
    $totalleavedays      = $this->mcommon->specific_row_value('hr_leave_application', $constraint_array, 'total_leave_days');
    //print_r($totalleavedays);
    $calculatingdays = ($totalleavedays - $totalleavedaysallocated);
    echo $calculatingdays;
  } 

  public function delete($leave_allocation_id)
  {
    $where_array  = array('leave_allocation_id'  =>$leave_allocation_id);
    $result     = $this->mcommon->common_delete('hr_leave_allocation', $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Leaves_holiday/Leave_allocation/'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('hla.leave_allocation_id, hla.employee_name, hlt.leave_type_name, hla.from_date, hla.to_date, hla.total_leaves_allocated')
    ->from('hr_leave_allocation AS hla')
    //->join('set_naming_series as sns', 'sns.naming_series_id = hla.naming_series_id')
    ->join('hr_leave_type as hlt', 'hlt.leave_type_id = hla.leave_type_id')
    ->edit_column('hla.leave_allocation_id', get_ajax_buttons('$1', 'hr/Leaves_holiday/Leave_allocation/'), 'hla.leave_allocation_id')
    ->edit_column('hla.from_date', '$1', 'get_date_format(hla.from_date)')
    ->edit_column('hla.to_date', '$1', 'get_date_format(hla.to_date)');
    echo $this->datatables->generate();
  }

  public function loadUnusedLeaves()
  {
    //$carry_forward       = $this->input->post('carry_forward');
    $employee_id      = $this->input->post('employee_id');
    print_r($employee_id);
    $leave_type_id    = $this->input->post('leave_type_id');
    $constraint_array = array('employee_id'   => $employee_id,
                              'leave_type_id' => $leave_type_id
                              );  

    $resultData       = $this->mcommon->specific_row_value('hr_leave_allocation',$constraint_array, 'total_leaves_allocated');
 
    echo $resultData;
  } 
}