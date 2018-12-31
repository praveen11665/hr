<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HR_settings extends MY_Controller
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
    if( $this->acl_permits('HR.hr_settings') )
    {
      $view_data = array(
                          'form_heading'      => $this->lang->line('Hr_settings_form_heading'),
                          'form_title'        => $this->lang->line('Hr_settings_form_title'),
                          'form_description'  => $this->lang->line('Hr_settings_form_description'),
                          'list_heading'      => $this->lang->line('Hr_settings_form_heading'),
                          'list_title'        => $this->lang->line('Hr_settings_form_title'),
                          'list_description'  => $this->lang->line('Hr_settings_form_description'),
                          'formUrl'           => 'hr/Setup/HR_settings/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'        => TRUE
                        );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading(lang('label_action'), lang('label_retirement_age'), lang('label_employee_records'), lang('label_max_working_hours'), lang('last_update'), lang('updated_by'));

      $view_data['dataTableUrl']   =   'hr/Setup/HR_settings/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Hr_settings_form_heading'),
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
      $this->form_validation->set_rules('retirement_age', lang('label_retirement_age'),'required|numeric');
      $this->form_validation->set_rules('hr_settings_employee_name_id', lang('label_employee_records'),'required');
      $this->form_validation->set_rules('max_working_hours_against_timesheet', lang('label_max_working_hours'),'required');

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('hr_setting_id') == "")
        {
          $data   = array(  
                           'retirement_age'                         => $this->input->post('retirement_age'),
                           'hr_settings_employee_name_id'           => $this->input->post('hr_settings_employee_name_id'),
                           'stop_birthday_reminders'                => ($this->input->post('stop_birthday_reminders'))?'1':'0',
                           'maintain_bill_work_hours_same'          => ($this->input->post('maintain_bill_work_hours_same'))?'1':'0',
                           'include_holidays_in_total_working_days' => ($this->input->post('include_holidays_in_total_working_days'))?'1':'0',
                           'email_salary_slip_to_employee'          => ($this->input->post('email_salary_slip_to_employee'))?'1':'0',
                           'max_working_hours_against_timesheet'    => $this->input->post('max_working_hours_against_timesheet'),
                           'created_on'                             => date('Y-m-d H:i:s'),
                           'created_by'                             => $this->auth_user_id,
                           'updated_on'              => date('Y-m-d H:i:s'),
                           'updated_by'                             => $this->auth_user_id
                         );
          $result = $this->mcommon->common_insert('hr_hr_settings', $data);

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
          $data   = array(  
                           'retirement_age'                         => $this->input->post('retirement_age'),
                           'hr_settings_employee_name_id'           => $this->input->post('hr_settings_employee_name_id'),
                           'stop_birthday_reminders'                => ($this->input->post('stop_birthday_reminders'))?'1':'0',
                           'maintain_bill_work_hours_same'          => ($this->input->post('maintain_bill_work_hours_same'))?'1':'0',
                           'include_holidays_in_total_working_days' => ($this->input->post('include_holidays_in_total_working_days'))?'1':'0',
                           'email_salary_slip_to_employee'          => ($this->input->post('email_salary_slip_to_employee'))?'1':'0',
                           'max_working_hours_against_timesheet'    => $this->input->post('max_working_hours_against_timesheet'),
                           'updated_on'                             => date('Y-m-d H:i:s'),
                           'updated_by'                             => $this->auth_user_id
                         );
          $where_array  = array('hr_setting_id'  =>$this->input->post('hr_setting_id'));
          $result       = $this->mcommon->common_edit('hr_hr_settings', $data, $where_array);

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
        $constraint_array   = array('hr_setting_id'  =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_hr_settings', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Setup/HR_settings/ajaxLoadForm';
      $this->load->view('hr/Setup/form/HR_settings_form', $Data);
    }
  }  

  public function delete($hr_setting_id)
  {
    $data         = array(
                          'is_delete'  => 1,
                          'updated_by' => $this->auth_user_id
                         );
    $where_array  = array('hr_setting_id'  =>$hr_setting_id);
    $result       = $this->mcommon->common_edit('hr_hr_settings', $data, $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Setup/HR_settings/'));
    }
  } 

  public function datatable()
  {
      $this->datatables ->select('hs.hr_setting_id, hs.retirement_age, dhs.employee_name, hs.max_working_hours_against_timesheet, hs.updated_on, CONCAT(up.first_name, " ", up.last_name)')
                        ->from('hr_hr_settings as hs')
                        ->join('user_profile as up', 'up.user_id = hs.updated_by')
                        ->join('def_hr_hr_settings_employee_name as dhs', 'dhs.hr_settings_employee_name_id = hs.hr_settings_employee_name_id')
                        ->where('hs.is_delete', '0')
                        ->edit_column('hs.updated_on', '$1', 'get_date_timeformat(hs.updated_on)')
                        ->edit_column('hs.hr_setting_id', get_ajax_buttons('$1', 'hr/Setup/HR_settings'), 'hs.hr_setting_id');
       $this->db->order_by('hs.updated_on', DESC);                 
      echo $this->datatables->generate();
  }
}