<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_attendance extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
    $this->lang->load("validation_lang","english");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->is_logged_in();
		$this->load->library('form_validation');
		$this->load->model("menu_model", "menu");
		$items = $this->menu->all();
		$this->load->library("multi_menu");
		$this->multi_menu->set_items($items);
		$this->lang->load("hr","english");
  }

  public function index($Data=array())
  {
    if( $this->acl_permits('HR.employee_attendance_tool') )
    {
      $view_data    =   array(
                                'form_heading'      => $this->lang->line('employee_attendance_form_heading'),
                                'form_title'        => $this->lang->line('employee_attendance_form_title'),
                                'form_description'  => $this->lang->line('employee_attendance_form_description'),
                                'list_heading'      => $this->lang->line('employee_attendance_form_heading'),
                                'list_title'        => $this->lang->line('employee_attendance_form_title'),
                                'list_description'  => $this->lang->line('employee_attendance_form_description'),
                                'formUrl'           => 'hr/Employee_attendance/Employee_attendance/ajaxLoadForm',
                                'list_view'         => TRUE,
                                'buttonview'       => TRUE
                              );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Details', 'Date', 'Company', 'Branch', 'Department');

      $view_data['dataTableUrl']   =   'hr/Employee_attendance/Employee_attendance/datatable';
      $viewData['message']       = $this->session->flashdata('msg');
      $viewData['alertType']     = $this->session->flashdata('alertType');
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('employee_attendance_form_heading'),
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
    $branch     =   $this->input->post('branch_id');

    if(!empty($_POST))
    {
      //This will convert the string to array
      parse_str($_POST['postdata'], $_POST);

      //Checking Form Validation      
      $this->form_validation->set_rules('naming_series', lang('label_series'),'required|trim');
      $this->form_validation->set_rules('date', lang('label_date'),'required|trim');
      $this->form_validation->set_rules('department_id', lang('label_department'),'required|trim');
      $this->form_validation->set_rules('branch_id', lang('label_branch'), 'required|trim');
      $this->form_validation->set_rules('company_id', lang('label_company'),'required|trim'); 

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are give      
        if($this->input->post('employee_attendance_tool_id') == "")
        {
          $company_id     = $this->input->post('company_id');
          $date           = date('Y-m-d', strtotime($this->input->post('date')));
          $data           =   array(                                   
                                    'date'            => $date,
                                    'department_id'   => $this->input->post('department_id'),
                                    'branch_id'       => $this->input->post('branch_id'),
                                    'company_id'      => $company_id,
                                    'marked_present'  => $this->input->post('marked_present'),
                                    'marked_absent'   => $this->input->post('marked_absent'),
                                    'marked_half_day' => $this->input->post('marked_half_day'),
                                    'mark_leave'      => $this->input->post('mark_leave'),
                                    'created_on'      => date('Y-m-d H:i:s'),
                                    'created_by'      => $this->auth_user_id,
                                  );
          $result         = $this->mcommon->common_insert('hr_employee_attendance_tool', $data);
          
          $naming         = $this->input->post('naming_series');
          $namingSeries   = $this->mcommon->generateSeries($naming, 4);

          $employee_idArr = $this->input->post('employee_id');

          foreach ($employee_idArr as $employee_id => $attendance_status)
          {
            $employeeName  = $this->mcommon->specific_row_value('hr_employee', array('employee_id' => $employee_id), 'employee_name');

             $dataAtt     =   array(
                                      'employee_id'                   => $employee_id,
                                      'employee_name'                 => $employeeName,
                                      'employee_attendance_status_id' => $attendance_status,
                                      'attendance_date'               => $date,
                                      'company_id'                    => $company_id,
                                      'created_on'                    => date('Y-m-d H:i:s'),
                                      'created_by'                    => $this->auth_user_id
                                    );
             $where_array = array(
                                    'employee_id'     => $employee_id,     
                                    'attendance_date' => $date
                                 );
             $count       = $this->mcommon->specific_record_counts('hr_employee_attendance', $where_array);
          
             if($count == 0)
             {
                $dataAtt['naming_series'] = $namingSeries;
                $result_insert            = $this->mcommon->common_insert('hr_employee_attendance', $dataAtt);
             }
             else
             {
                $result_edit       = $this->mcommon->common_edit('hr_employee_attendance', $dataAtt,$where_array);
             }
          }
          
          $where_array  = array('transaction_id' => 4);

          if($result_insert)
          {
            $resultupdate = $this->mcommon->dataUpdate('set_naming_series', 'current_value', $where_array); 
          } 

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
          $data       = array(
                                'date'            => date('Y-m-d', strtotime($this->input->post('date'))),
                                'department_id'   => $this->input->post('department_id'),
                                'branch_id'       => $this->input->post('branch_id'),
                                'company_id'      => $this->input->post('company_id'),
                                'marked_present'  => $this->input->post('marked_present'),
                                'marked_absent'   => $this->input->post('marked_absent'),
                                'marked_half_day' => $this->input->post('marked_half_day'),
                                'mark_leave'      => $this->input->post('mark_leave') 
                            );
                        
          $where_array  = array('employee_attendance_tool_id'  =>$this->input->post('employee_attendance_tool_id'));
          $result       = $this->mcommon->common_edit('hr_employee_attendance_tool', $data, $where_array);

           $dataAtt       =   array(
                                      'naming_series'                 => $naming_series,
                                      'employee_id'                   => $employee_id,
                                      'employee_attendance_status_id' => $attendance_status,
                                      'attendance_date'               => $date,
                                      'company_id'                    => $company_id,
                                      'created_on'                    => date('Y-m-d H:i:s'),
                                      'updated_on'                    => date('Y-m-d H:i:s'),
                                      'created_by'                    => $this->auth_user_id,
                                      'updated_by'                    => $this->auth_user_id,
                                  );
          $where_array  = array('employee_attendance_id'  =>$this->input->post('employee_attendance_id'));
          $result       = $this->mcommon->common_edit('hr_employee_attendance', $dataAtt, $where_array);

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
        $constraint_array   = array('employee_attendance_tool_id'  =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_employee_attendance_tool', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']     =  'hr/Employee_attendance/Employee_attendance/ajaxLoadForm'; 
      $constraint_array      = array('branch_id' => $this->input->post('branch_id'));
     
      $Data['employeeData']   = $this->mcommon->records_all('hr_emp_job_profile',$constraint_array);
      $Data['employeeName']   = $this->mcommon->records_all('hr_emp_job_profile','');
      $this->load->view('hr/Employee_attendance/form/Employee_attendance_form', $Data);
    }
  }

  public function datatable()
  {
    //datatable joining
    $this->datatables->select('eat.employee_attendance_tool_id, eat.date, sc.company_name, hb.branch, hd.department_name');
    $this->datatables->from('hr_employee_attendance_tool as eat');
    $this->datatables->join('hr_department as hd', 'hd.department_id = eat.department_id');
    $this->datatables->join('hr_branch as hb', 'hb.branch_id = eat.branch_id');
    $this->datatables->join('set_company as sc', 'sc.company_id = eat.company_id');
    $this->datatables ->edit_column('eat.employee_attendance_tool_id', '$1', 'get_ajax_buttons_details(eat.employee_attendance_tool_id,hr/Employee_attendance/Employee_attendance )');
    $this->datatables->edit_column('eat.date', '$1', 'get_date_format(eat.date)');
    $this->db->order_by('eat.employee_attendance_tool_id', DESC);
    //$this->datatables->edit_column('ela.employee_loan_application_id', '$1', 'get_ajax_buttons_loan(ela.employee_loan_application_id,hr/Employee_loan/Loan_application/,ela.emp_loan_appliction_status_id )');

    echo $this->datatables->generate();
  }

  public function delete($employee_attendance_tool_id)
  {
    $where_array  = array('employee_attendance_tool_id'  =>$employee_attendance_tool_id);
    $result       = $this->mcommon->common_delete('hr_employee_attendance_tool', $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Employee_attendance/Employee_attendance/'));
    }
  }

  public function getEmployeeDetails()
  {
    $branch_id     = $this->input->post('branch_id');
    $company_id    = $this->input->post('company_id');
    $department_id = $this->input->post('department_id');
    $date          = date('Y-m-d', strtotime($this->input->post('date')));

    $result =$this->hrcommon->getemployee($branch_id, $company_id, $department_id, '', '1');

    foreach ($result as $key => $value) 
    {
      $checkExisit = $this->mcommon->specific_record_counts('hr_employee_attendance', array('employee_id' =>$value['employee_id'], 'attendance_date' => $date));
      if($checkExisit == '0')
      {
        $data[] = (object) $value;
      }
    }  

    $Data['employeeData'] = $data; 
    $this->load->view('hr/Employee_attendance/form/Employee_content_form', $Data);
  }

  public function loadDetails()
  {
    $presentList    = explode(',', $this->input->post('presentList'));
    $absentList     = explode(',', $this->input->post('absentList'));
    $halfDayList    = explode(',', $this->input->post('halfDayList'));
    $leaveList      = explode(',', $this->input->post('leaveList'));

    $viewData['presentList'] = $this->hrcommon->getemployee('', '', '', $presentList);
    $viewData['absentList']  = $this->hrcommon->getemployee('', '', '', $absentList);
    $viewData['halfDayList'] = $this->hrcommon->getemployee('', '', '', $halfDayList);
    $viewData['leaveList']   = $this->hrcommon->getemployee('', '', '', $leaveList);
 
    $this->load->view('hr/Employee_attendance/form/ajax_employee_attn_status', $viewData);
  } 

  public function ajaxLoadFormDetail($employee_attendance_tool_id)
  {
    $isFormLoad = TRUE;

    if($isFormLoad)
    {
      //Get data from table for edit the data
      if($employee_attendance_tool_id != '')
      {
        $constraint_array       =   array('employee_attendance_tool_id'  => $employee_attendance_tool_id);
        $viewData['tableData']  =   $this->mcommon->records_all('hr_employee_attendance_tool', $constraint_array);

        foreach ($viewData['tableData'] as $row) 
        {
          $presentList    = explode(',', $row->marked_present);
          $absentList     = explode(',', $row->marked_absent);
          $halfDayList    = explode(',', $row->marked_half_day);
          $leaveList      = explode(',', $row->mark_leave);
        }

        $viewData['presentList']  = $this->hrcommon->getemployee('', '', '', $presentList);
        $viewData['absentList']   = $this->hrcommon->getemployee('', '', '', $absentList);
        $viewData['halfDayList']  = $this->hrcommon->getemployee('', '', '', $halfDayList);
        $viewData['leaveList']    = $this->hrcommon->getemployee('', '', '', $leaveList);
      }     

      //Ajax Form Load
      $this->load->view('hr/Employee_attendance/form/ajax_view_details_form', $viewData);
    }
  }
}