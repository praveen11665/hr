<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance extends MY_Controller
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

  public function index($Data=array())
  {
    if( $this->acl_permits('HR.attendance') )
    {  
      $view_data = array(
                'form_heading'      => $this->lang->line('attendance_form_heading'),
                'form_title'        => $this->lang->line('attendance_form_title'),
                'form_description'  => $this->lang->line('attendance_form_description'),
                'list_heading'      => $this->lang->line('attendance_form_heading'),
                'list_title'        => $this->lang->line('attendance_form_title'),
                'list_description'  => $this->lang->line('attendance_form_description'),
                'formUrl'           => 'hr/Employee_attendance/Attendance/ajaxLoadForm',
                'list_view'         => TRUE,
                 'buttonview'       => TRUE
                );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Date', 'Employee Name', 'Company', 'Status');

      $view_data['dataTableUrl']   =   'hr/Employee_attendance/Attendance/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('attendance_form_heading'),
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
      $this->form_validation->set_rules('naming_series', lang('label_attendance_series'), 'trim|required');
      $this->form_validation->set_rules('company_id', lang('label_attendance_company'), 'trim|required');
      $this->form_validation->set_rules('employee_id', lang('label_attendance_employee_id'), 'trim|required');
      $this->form_validation->set_rules('employee_attendance_status_id', lang('label_attendance_status'), 'trim|required');   
      $this->form_validation->set_rules('attendance_date', lang('label_attendance_attendance_date'), 'trim|required');	

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given        
        if($this->input->post('employee_attendance_id') == "")
        {
          $naming         = $this->input->post('naming_series');       
          $namingSeries   = $this->mcommon->generateSeries($naming, 4);
          $data   = array( 
  				                'naming_series' 	              => $namingSeries,
  				               	'company_id'   		              => $this->input->post('company_id'),	
  				               	'employee_id'		                => $this->input->post('employee_id'),
  				                'employee_name'   	            => $this->input->post('employee_name'),
  				                'employee_attendance_status_id' => $this->input->post('employee_attendance_status_id'),
  				                'attendance_date'  	            => date('Y-m-d',strtotime($this->input->post('attendance_date'))),
                          'created_by'                    => $this->auth_user_id,
                          'created_on'                    => date('Y-m-d H:i:s')                          
                         );
          $result = $this->mcommon->common_insert('hr_employee_attendance', $data);

          $where_array  = array('transaction_id' => 4);

          if($result)
          {
            $resultupdate = $this->mcommon->dataUpdate('set_naming_series', 'current_value', $where_array); 
          }

          if($resultupdate)
          {
            $this->session->set_flashdata('msg', 'Saved Successfully');
            $this->session->set_flashdata('alertType', 'success');
            $ajaxResponse['result'] = 'success';
          }
        }
        //Edit function calling
        else
        {
          $data          = array( 
  				                        //'naming_series'                 => $this->input->post('naming_series'),
                                  'company_id'                    => $this->input->post('company_id'),  
                                  'employee_id'                   => $this->input->post('employee_id'),
                                  'employee_name'                 => $this->input->post('employee_name'),
                                  'employee_attendance_status_id' => $this->input->post('employee_attendance_status_id'),
                                  'attendance_date'               => date('Y-m-d',strtotime($this->input->post('attendance_date'))) 
                                );                        
          $where_array  = array('employee_attendance_id'  =>$this->input->post('employee_attendance_id'));
          $result       = $this->mcommon->common_edit('hr_employee_attendance', $data, $where_array);

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
        $constraint_array   = array('employee_attendance_id'   =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_employee_attendance', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Employee_attendance/Attendance/ajaxLoadForm';
      $this->load->view('hr/Employee_attendance/form/Attendance_form', $Data);
    }
  }

  public function delete($employee_attendance_id)
  {
    $where_array  = array('employee_attendance_id'  =>$employee_attendance_id);
    $result       = $this->mcommon->common_delete('hr_employee_attendance', $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Employee_attendance/Attendance'));
    }
  }

	public function datatable()
	{
		$this->datatables->select('hea.employee_attendance_id, hea.attendance_date, hea.employee_name, sc.company_name, dea.status')
						 ->from('hr_employee_attendance as hea')
						 ->join('set_company as sc','sc.company_id = hea.company_id')
						 ->join('def_hr_employee_attendance as dea','dea.employee_attendance_status_id = hea.employee_attendance_status_id');
    $this->datatables->edit_column('hea.employee_attendance_id', get_ajax_buttons('$1', 'hr/Employee_attendance/Attendance/'), 'hea.employee_attendance_id');		
    $this->datatables->edit_column('hea.attendance_date', '$1', 'get_date_format(hea.attendance_date)');
    $this->db->order_by('hea.employee_attendance_id', DESC);
		echo $this->datatables->generate();
	}  
}