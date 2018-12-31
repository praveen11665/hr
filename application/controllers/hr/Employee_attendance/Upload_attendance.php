<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload_attendance extends MY_Controller
{
	public function __construct()
  {
    parent::__construct();
    $this->lang->load("validation_lang","english");
    $this->load->helper('url');
    $this->load->helper('form');
    $this->is_logged_in();
    $this->load->model("menu_model", "menu");
    $items = $this->menu->all();
    $this->load->library("multi_menu");
    $this->multi_menu->set_items($items);
    $this->lang->load("hr","english");
    $this->load->library("form_validation");  
  }

  public function index($view_data=array())
  {
    if( $this->acl_permits('HR.upload_attendance') )
    {
      $view_data = array(
                          'form_heading'      => $this->lang->line('Upload_attendance_form_heading'),
                          'form_title'        => $this->lang->line('Upload_attendance_form_title'),
                          'form_description'  => $this->lang->line('Upload_attendance_form_description'),
                          'list_heading'      => $this->lang->line('Upload_attendance_form_heading'),
                          'list_title'        => $this->lang->line('Upload_attendance_form_title'),
                          'list_description'  => $this->lang->line('Upload_attendance_form_description'),
                          'formUrl'           => 'hr/Employee_attendance/Upload_attendance/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'        => TRUE
                        );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('From Date', 'To Date', 'Updated On', 'Updated By');

      $view_data['dataTableUrl']   =  'hr/Employee_attendance/Upload_attendance/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Upload_attendance_page_title'),
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
      $this->form_validation->set_rules('from_date', lang('label_attendance_from_date'), 'required|trim');
      $this->form_validation->set_rules('to_date', lang('label_attendance_to_date'), 'required|trim');
      
      if($_FILES["attendence_file"]["tmp_name"] == '')
      {
        $this->form_validation->set_rules('attendence_file', lang('file'), 'required|trim');
      }

      if($this->form_validation->run() == TRUE) 
      {
        $filename = $_FILES["attendence_file"]["tmp_name"];
        if($_FILES["attendence_file"]["size"] > 0)
        {
          $file = fopen($filename, "r");
          fgets($file);

          $sno              = 0;
          $empNotMatch      = 0;
          $statusNotMatch   = 0;  
          $companyNotMatch  = 0;
          $uploadData       = 0;
          $duplicateData    = 0;
          $employeeArr      = array(); 

          while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
          {
            if ($importdata[0]!=='NAMEING SERIES')
            {
              $naming_series                  = '5_'.stripslashes($importdata[0]);
              $employee_number                = stripslashes($importdata[1]);
              $employee_name                  = stripslashes($importdata[2]);
              $employee_attendance_status     = stripslashes($importdata[3]);
              $attendance_date                = stripslashes(str_replace("+AC0", "", $importdata[4]));
              $company                        = stripslashes($importdata[5]);    
              
              $employee_id      = $this->mcommon->specific_row_value('hr_employee', array('employee_number' => $employee_number), 'employee_id');

              if($employee_id)
              {
                $employee_attendance_status_id  = $this->mcommon->specific_row_value('def_hr_employee_attendance', array('status' => $employee_attendance_status), 'employee_attendance_status_id');

                if($employee_attendance_status_id)
                {
                  $company_id       = $this->mcommon->specific_row_value('set_company', array('company_name' => $company), 'company_id');

                  if($company_id)
                  {
                    $namingSeries   = $this->mcommon->generateSeries($naming_series, 4);

                    $attendenceData   = array( 
                                              'naming_series'                 => $namingSeries,
                                              'employee_id'                   => $employee_id,
                                              'employee_name'                 => $employee_name,
                                              'employee_attendance_status_id' => $employee_attendance_status_id,
                                              'attendance_date'               => date('Y-m-d', strtotime($attendance_date)),
                                              'company_id'                    => $company_id,
                                              'created_on'                    => date('Y-m-d H:i:s'),
                                              'created_by'                    => $this->auth_user_id
                                            );
                    $where_array = array(
                                          'employee_id'     => $employee_id,
                                          'attendance_date' => date('Y-m-d', strtotime($attendance_date))
                                        ); 
                    $count       = $this->mcommon->specific_record_counts('hr_employee_attendance',$where_array);
                    
                    if($count == 0)
                    {
                      $result_insert     = $this->mcommon->common_insert('hr_employee_attendance', $attendenceData);

                      $employeeArr[$sno]              = $importdata;
                      $employeeArr[$sno]['status']    = 'Uploaded';
                      $uploadData                    += 1;
                    }
                    else
                    {
                      $result_edit       = $this->mcommon->common_edit('hr_employee_attendance', $attendenceData,
                      $where_array);

                      $employeeArr[$sno]              = $importdata;
                      $employeeArr[$sno]['status']    = 'Already given attendance on that day';
                      $duplicateData                  += 1;                     
                    }

                    if($result_insert || $result_edit)
                    {
                      $whereArr = array(                                   
                                          'from_date'      => date('Y-m-d', strtotime($this->input->post('from_date'))),
                                          'to_date'        => date('Y-m-d', strtotime($this->input->post('to_date')))
                                        );
                      $isExist  = $this->mcommon->specific_record_counts('hr_employee_upload_attendance', $whereArr);

                      if($isExist == '0')
                      {
                        $data     = array(                                   
                                            'from_date'      => date('Y-m-d', strtotime($this->input->post('from_date'))),
                                            'to_date'        => date('Y-m-d', strtotime($this->input->post('to_date'))),
                                            'created_on'     => date('Y-m-d H:i:s'),
                                            'created_by'     => $this->auth_user_id,
                                         );
                        $result   = $this->mcommon->common_insert('hr_employee_upload_attendance', $data);                  
                      }else
                      {
                        $data     = array(                                   
                                            'from_date'      => date('Y-m-d', strtotime($this->input->post('from_date'))),
                                            'to_date'        => date('Y-m-d', strtotime($this->input->post('to_date'))),
                                            'created_by'     => $this->auth_user_id,
                                         );
                        $result   = $this->mcommon->common_edit('hr_employee_upload_attendance', $data, $whereArr);
                      }
                    }
                  }else
                  {
                    $employeeArr[$sno]               = $importdata;
                    $employeeArr[$sno]['status']     = 'Company does not Matching';
                    $companyNotMatch                 += 1;
                  }
                }else
                {
                  $employeeArr[$sno]               = $importdata;
                  $employeeArr[$sno]['status']     = 'Status does not Matching';
                  $statusNotMatch                 += 1;
                }                
              }else
              {
                $employeeArr[$sno]               = $importdata;
                $employeeArr[$sno]['status']     = 'Employee does not Matching';
                $empNotMatch                    += 1;
              }
            }
            $sno++;
          }                    
          fclose($file);

          $viewData = array(
                        'existMessage'     => '<b>CSV Imported successfully</b>.... Totally <b>' . $uploadData . '</b> data uploaded in which <b>' . $duplicateData . '</b> duplicate data',
                        'alertType'        => 'success',
                        'employeeArr'      => $employeeArr
                      );          
          $this->session->set_flashdata($viewData);
          
          //$this->session->set_flashdata('msg', 'Data Are Imported');
          //$this->session->set_flashdata('alertType', 'success');
          $ajaxResponse['result'] = 'success';
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
        $constraint_array   = array('employee_attendance_id'   =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_employee_attendance', $constraint_array);
      }
      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Employee_attendance/Upload_attendance/ajaxLoadForm';
      $this->load->view('hr/Employee_attendance/form/Upload_attendance_form', $Data);
    }
  }
  
  public function delete($employee_upload_attendance_id)
  {
    $where_array  = array('employee_upload_attendance_id'  =>$employee_upload_attendance_id);
    $result     = $this->mcommon->common_delete('hr_employee_upload_attendance', $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Employee_attendance/Upload_attendance/'));
    }
  }

  public function datatable()
  {
    $this->datatables ->select('a.from_date,a.to_date, a.created_on, CONCAT(up.first_name, " ", up.last_name)');
    $this->datatables->from('hr_employee_upload_attendance as a');
    $this->datatables->join('user_profile as up', 'up.user_id = a.created_by', 'left');  
    $this->datatables->edit_column('a.created_on', '$1', 'get_date_timeformat(a.created_on)'); 
    $this->datatables->edit_column('a.from_date', '$1', 'get_date_format(a.from_date)'); 
    $this->datatables->edit_column('a.to_date', '$1', 'get_date_format(a.to_date)'); 
    $this->db->order_by('a.created_on',DESC);
    //$this->datatables->edit_column('employee_upload_attendance_id', get_ajax_buttons('$1', 'hr/Employee_attendance/Upload_attendance/'), 'employee_upload_attendance_id');
    echo $this->datatables->generate();
  }
}