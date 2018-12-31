<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave_application extends MY_Controller
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
    if( $this->acl_permits('HR.leave_application') )
    {
      //Redirect
      $view_data = array(
                          'form_heading'      => $this->lang->line('Leave_application_page_title'),
                          'form_title'        => $this->lang->line('Holidays_list_leaves_and_holiday'),
                          'form_description'  => $this->lang->line('Holidays_list_leave_application_description'),
                          'list_heading'      => $this->lang->line('Holidays_list_heading'),
                          'list_title'        => $this->lang->line('Holidays_list_leaves_and_holiday'),
                          'list_description'  => $this->lang->line('Holidays_list_leave_application_description'),
                          'formUrl'       => 'hr/Leaves_holiday/Leave_application/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'  => TRUE
                        );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action','Employee Name','Leave Type', 'From Date', 'To Date', 'Total Leave Days', 'Status');

      $view_data['dataTableUrl']   =   'hr/Leaves_holiday/Leave_application/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Leave_application_page_title'),
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
      $this->form_validation->set_rules('leave_type_id', lang('label_leave_type'), 'trim|required');
      //$this->form_validation->set_rules('leave_application_status_id', lang('label_status'), 'trim|required');
      $this->form_validation->set_rules('employee_id', lang('label_employee_id'), 'trim|required');
      $this->form_validation->set_rules('from_date', lang('label_from_date'), 'trim|required');
      $this->form_validation->set_rules('to_date', lang('label_to_date'), 'trim|required');

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        $naming         = $this->input->post('naming_series');       
        $namingSeries   = $this->mcommon->generateSeries($naming,5);

        if($this->input->post('leave_application_id') == "")
        {
          $data     = array(
                              'naming_series'               => $namingSeries,
                              'leave_application_status_id' => ($this->input->post('leave_application_status_id'))? ($this->input->post('leave_application_status_id')): 1,
                              'leave_type_id'               => $this->input->post('leave_type_id'),
                              'leave_balance'               => $this->input->post('leave_balance'),
                              'from_date'                   => date('Y-m-d', strtotime($this->input->post('from_date'))),
                              'to_date'                     => date('Y-m-d', strtotime($this->input->post('to_date'))),
                              'reason'                      => $this->input->post('reason'),
                              'half_day'                    => ($this->input->post('half_day')) ? '1' : '0',
                              'half_day_date'               => date('Y-m-d', strtotime($this->input->post('half_day_date'))),
                              'total_leave_days'            => $this->input->post('total_leave_days'),
                              'employee_id'                 => $this->input->post('employee_id'),
                              'employee_name'               => $this->input->post('employee_name'),
                              'user_id'                     => $this->input->post('user_id'),
                              'leave_approver_name'         => $this->input->post('leave_approver_name'),
                              'posting_date'                => date('Y-m-d', strtotime($this->input->post('posting_date'))),
                              'follow_via_email'            => ($this->input->post('follow_via_email'))?'1':'0',
                              'company_id'                  => $this->input->post('company_id'),
                              'letter_head_id'              => $this->input->post('letter_head_id')
                            );
          $result   = $this->mcommon->common_insert('hr_leave_application', $data);

          if($result)
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
          if($this->input->post('leave_application_status_id') == 2)
          {
            $data         = array(
                                    
                                    'leave_application_status_id' => $this->input->post('leave_application_status_id'),
                                    'leave_type_id'               => $this->input->post('leave_type_id'),
                                    'leave_balance'               => $this->input->post('leave_balance'),
                                    'from_date'                   => date('Y-m-d', strtotime($this->input->post('from_date'))),
                                    'to_date'                     => date('Y-m-d', strtotime($this->input->post('to_date'))),
                                    'reason'                      => $this->input->post('reason'),
                                    'half_day'                    => ($this->input->post('half_day'))?'1':'0',
                                    'half_day_date'               => date('Y-m-d', strtotime($this->input->post('half_day_date'))),
                                    'total_leave_days'            => $this->input->post('total_leave_days'),
                                    'employee_id'                 => $this->input->post('employee_id'),
                                    'employee_name'               => $this->input->post('employee_name'),
                                    'user_id'                     => $this->input->post('user_id'),
                                    'leave_approver_name'         => $this->input->post('leave_approver_name'),
                                    'posting_date'                => date('Y-m-d', strtotime($this->input->post('posting_date'))),
                                    'follow_via_email'            => ($this->input->post('follow_via_email'))?'1':'0',
                                    'company_id'                  => $this->input->post('company_id'),
                                    'letter_head_id'              => $this->input->post('letter_head_id')
                                  );
            $where_array  = array('leave_application_id' => $this->input->post('leave_application_id'));
            $result       = $this->mcommon->common_edit('hr_leave_application', $data, $where_array);

            //Store Leave Attence on Given Date
            $leaveDates = date_range(date('Y-m-d', strtotime($this->input->post('from_date'))), date('Y-m-d', strtotime($this->input->post('to_date'))));           

            foreach ($leaveDates as $key => $leave_date) 
            {
              $attenceData = array( 
                                    //'naming_series'                 => $this->input->post('naming_series'),
                                    'employee_id'                   => $this->input->post('employee_id'),
                                    'employee_name'                 => $this->input->post('employee_name'),
                                    'employee_attendance_status_id' => '2',
                                    'attendance_date'               => date('Y-m-d', strtotime($leave_date)),
                                    'company_id'                    => $this->input->post('company_id'),
                                    'created_on'                    => date('Y-m-d H:i:s'),
                                    'created_by'                    => $this->auth_user_id,
                                  );
              $this->mcommon->common_insert('hr_employee_attendance', $attenceData);
            }

            if($this->input->post('half_day'))
            {
              $attenceEditData = array('employee_attendance_status_id' => '4'); //Half Day
              $this->mcommon->common_edit('hr_employee_attendance', $attenceEditData, array('employee_id' => $this->input->post('employee_id'), 'attendance_date' => date('Y-m-d', strtotime($this->input->post('half_day_date')))));
            }

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
          else
          {
            if($this->input->post('leave_application_status_id') == 3)
            {
              $data   = array(
                              'leave_application_id'           => $this->input->post('leave_application_id'),
                              'employee_id'                    => $this->input->post('employee_id'),
                              'rejected_by'                    => $this->auth_user_id,
                              'rejection_remarks'              => $this->input->post('rejection_remarks')
                            );
              $result =  $this->mcommon->common_insert('hr_emp_leave_rejection', $data);
            }          

            $data         = array(                              
                                    'leave_application_status_id'            => $this->input->post('leave_application_status_id'),
                                    'leave_type_id'               => $this->input->post('leave_type_id'),
                                    'leave_balance'               => $this->input->post('leave_balance'),
                                    'from_date'                   => date('Y-m-d', strtotime($this->input->post('from_date'))),
                                    'to_date'                     => date('Y-m-d', strtotime($this->input->post('to_date'))),
                                    'reason'                      => $this->input->post('reason'),
                                    'half_day'                    => ($this->input->post('half_day'))?'1':'0',
                                    'half_day_date'               => date('Y-m-d', strtotime($this->input->post('half_day_date'))),
                                    'total_leave_days'            => $this->input->post('total_leave_days'),
                                    'employee_id'                 => $this->input->post('employee_id'),
                                    'employee_name'               => $this->input->post('employee_name'),
                                    'user_id'                     => $this->input->post('user_id'),
                                    'leave_approver_name'         => $this->input->post('leave_approver_name'),
                                    'posting_date'                => date('Y-m-d', strtotime($this->input->post('posting_date'))),
                                    'follow_via_email'            => ($this->input->post('follow_via_email'))?'1':'0',
                                    'company_id'                  => $this->input->post('company_id'),
                                    'letter_head_id'              => $this->input->post('letter_head_id')
                                  );
            $where_array  = array('leave_application_id'  =>$this->input->post('leave_application_id'));
            $result       = $this->mcommon->common_edit('hr_leave_application', $data, $where_array);

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
        $constraint_array   = array('leave_application_id'   =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_leave_application', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Leaves_holiday/Leave_application/ajaxLoadForm';
      $this->load->view('hr/Leaves_holiday/form/Leave_application_form', $Data);
    }
  }

  public function delete($leave_application_id)
  {
    $where_array  = array('leave_application_id'  =>$leave_application_id);
    $result      = $this->mcommon->common_delete('hr_leave_application', $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Leaves_holiday/Leave_application/'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('hla.leave_application_id, hla.employee_name, hlt.leave_type_name, hla.from_date, hla.to_date, hla.total_leave_days, hla.leave_application_status_id')
    ->from('hr_leave_application AS hla')
    //->join('set_naming_series as sns', 'sns.naming_series_id = hla.naming_series_id', left)
    ->join('hr_leave_type as hlt', 'hlt.leave_type_id = hla.leave_type_id')
    ->join('def_hr_leave_application_status as hlas', 'hlas.leave_application_status_id = hla.leave_application_status_id')
    //->join('users as u', 'u.user_id = t.updated_by')
    ->edit_column('hla.leave_application_id', '$1', 'get_ajax_buttons_leave(hla.leave_application_id,hr/Leaves_holiday/Leave_application/,hla.leave_application_status_id )')
    ->edit_column('hla.leave_application_status_id', '$1', 'get_leave_status(hla.leave_application_status_id)');
    $this->datatables->edit_column('hla.from_date', '$1', 'get_date_format(hla.from_date)');
    $this->datatables->edit_column('hla.to_date', '$1', 'get_date_format(hla.to_date)');    
    echo $this->datatables->generate();
  }
 
  public function getusername($value='')
  {
    $user_id            = $this->input->post('user_id');
    $constraint_array   = array('user_id' => $user_id);
    $username           = $this->mcommon->specific_row_value('users', $constraint_array, 'username');
    echo $username;
  } 

  public function getleavebalance($value='')
  {
    $leave_type_id   = $this->input->post('total_leaves_allocated');
    $constraint_array         = array('leave_type_id' => $leave_type_id);
    $balance                  = $this->mcommon->specific_row_value('hr_leave_allocation', $constraint_array, 'total_leaves_allocated');
    echo $balance;
  } 

  public function daydiff($value='')
  {
    $from_date    = date('d-m-Y', strtotime($this->input->post('from_date')));
    $NewDate      = date('d-m-Y', strtotime($this->input->post('to_date')));
    $to_date      = date('d-m-Y', strtotime($NewDate . " +1 days"));
    $days         = (strtotime($to_date) - strtotime($from_date))/ (60 * 60 * 24);
    echo  $days; 
  }

  public function halfdaydiff($value='')
  {
    $from_date          = date('d-m-Y', strtotime($this->input->post('from_date')));
    $NewDate            = date('d-m-Y', strtotime($this->input->post('to_date')));
    $to_date            = date('d-m-Y', strtotime($NewDate . " +1 days"));
    $half_day_date      = date('d-m-Y', strtotime($this->input->post('half_day_date')));
    $countingdays       = (strtotime($to_date) - strtotime($from_date))/ (60 * 60 * 24) - (0.5);
    echo  $countingdays; 
  }

  public function maximumLeavedays()
  {
    $total_leave_days      = $this->input->post('total_leave_days');
    $leave_type_id         = $this->input->post('leave_type_id');
    $constraint_array   = array('leave_type_id' => $leave_type_id); 
    $max_days_allowed  = $this->mcommon->specific_row_value('hr_leave_type', $constraint_array, 'max_days_allowed');

    if($total_leave_days > $max_days_allowed)
    {
      $this->form_validation->set_message('maximumLeavedays', 'Leave days cannot exceeds Maximum Leave days');
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }

  public function ajaxleaverejectionDetail($leave_application_id)
  {
    $isFormLoad = TRUE;

    if($isFormLoad)
    {
      //Get data from table for edit the data
      if($leave_application_id != '')
      {
        $constraint_array   = array('leave_application_id'  =>   $leave_application_id);

        $Data['tableData']          = $this->mcommon->records_all('hr_leave_application', $constraint_array);
        $Data['tableDataRejection'] = $this->mcommon->records_all('hr_emp_leave_rejection', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Leaves_holiday/Leave_application/ajaxleaverejectionDetail';
      $this->load->view('hr/Leaves_holiday/form/ajax_leave_rejection_form', $Data);
    }
  }

  public function blockLeaves()
  {
    $startDate    = new DateTime(date('Y-m-d', strtotime($this->input->post('from_date'))));
    $endDate      = new DateTime(date('Y-m-d', strtotime($this->input->post('to_date'))));  
   
    $DateArr  = array();
    $i=0;
    while ($startDate <= $endDate) 
    {
        $DateArr[$i]  = $startDate->format('Y-m-d');
        $startDate->modify('+1 day');
        $i++;
    }
    foreach ($DateArr as $date)
    {
        $constraint_array    =   array('block_date' => $date);
        $count               =   $this->mcommon->specific_record_counts('hr_leave_block_list_date', $constraint_array);
    }

    echo $count;
  }

  /*public function getEmployeeLeaveApprover()
  {
      $employee_id    =   $this->input->post('employee_id');
      $constraint_array   =   array('em.employee_id' => $employee_id);
      $fields      = array("em.employee_name, us.user_id, us.username");
      $joinArrAtt     = array(                    
                        'hr_emp_organization_profile as eop'  =>  'eatt.employee_id = sem.employee_id'
                    );
      $employeeData  =   $this->mcommon->join_records_all($fieldsAtt, 'hr_employee as em', $joinArr, $constraint_array ,'','','');
  }*/
}