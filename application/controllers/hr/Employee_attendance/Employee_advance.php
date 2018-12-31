<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_advance extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
    $this->lang->load("validation_lang","english");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->is_logged_in();
		$this->load->model("menu_model", "menu");
		$items = $this->menu->all();
		$this->load->library("multi_menu");
		$this->multi_menu->set_items($items);
		$this->lang->load("hr","english");
	}

	public function index($Data=array())
  {
    if( $this->acl_permits('HR.employee_advance') )
    {
      $view_data = array(
                'form_heading'      => $this->lang->line('employee_advance_form_heading'),
                'form_title'        => $this->lang->line('employee_advance_form_title'),
                'form_description'  => $this->lang->line('employee_advance_form_description'),
                'list_heading'      => $this->lang->line('employee_advance_list_heading'),
                'list_title'        => $this->lang->line('employee_advance_list_title'),
                'list_description'  => $this->lang->line('employee_advance_list_description'),
                'formUrl'           => 'hr/Employee_attendance/Employee_advance/ajaxLoadForm',
                'list_view'         => TRUE,
                'buttonview'        => TRUE
                );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Posting Date', 'Employee Name', 'Paid Amount', 'Claimed Amount', 'Advance Amount', 'Last Update', 'Updated by');

      $view_data['dataTableUrl']   =   'hr/Employee_attendance/Employee_advance/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('employee_advance_form_heading'),
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
      parse_str($_POST['postdata'], $_POST);
      $this->form_validation->set_rules('employee_id', lang('label_employee'), 'required');
      $this->form_validation->set_rules('naming_series', lang('label_series'), 'required');

      if($this->form_validation->run() == TRUE) 
      {          
        //Insert if not id's are given
        if($this->input->post('emp_advance_id') == "")
        {
          $naming         = $this->input->post('naming_series');       
          $namingSeries   = $this->mcommon->generateSeries($naming,26);
          $data     = array(
                            'naming_series'               =>  $namingSeries,
                            'employee_id'                 =>  $this->input->post('employee_id'),
                            'posting_date'                =>  date('Y-m-d', strtotime($this->input->post('date'))),
                            'purpose'                     =>  $this->input->post('purpose'),
                            'advance_amount'              =>  $this->input->post('advance_amount'),
                            'paid_amount'                 =>  $this->input->post('paid_amount'),
                            'claimed_amount'              =>  $this->input->post('claimed_amount'),
                            'employee_advance_status_id'  =>  $this->input->post('employee_advance_status_id'),
                            'account_id'                  =>  $this->input->post('account_id'),
                            'company_id'                  =>  $this->input->post('company_id'),
                            'mode_of_payment_id'          =>  $this->input->post('mode_of_payment_id'),
                            'created_on'                  =>  date('Y-m-d H:i:s'),
                            'updated_on'                  =>  date('Y-m-d H:i:s'),
                            'created_by'                  =>  $this->auth_user_id,
                            'updated_by'                  =>  $this->auth_user_id
                           );

          $result   = $this->mcommon->common_insert('hr_employee_advance', $data);

          $where_array  = array('transaction_id' => 26);

          if($result)
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
        else
        {
         $data          = array(
                                'employee_id'                 =>  $this->input->post('employee_id'),
                                'posting_date'                =>  date('Y-m-d', strtotime($this->input->post('date'))),
                                'purpose'                     =>  $this->input->post('purpose'),
                                'advance_amount'              =>  $this->input->post('advance_amount'),
                                'paid_amount'                 =>  $this->input->post('paid_amount'),
                                'claimed_amount'              =>  $this->input->post('claimed_amount'),
                                'employee_advance_status_id'  =>  $this->input->post('employee_advance_status_id'),
                                'account_id'                  =>  $this->input->post('account_id'),
                                'company_id'                  =>  $this->input->post('company_id'),
                                'mode_of_payment_id'          =>  $this->input->post('mode_of_payment_id'),
                                'updated_by'                  =>  $this->auth_user_id,
                                'updated_on'                  =>  date('Y-m-d H:i:s'),
                               );
          $where_array  = array('emp_advance_id'  =>$this->input->post('emp_advance_id'));
          $result       = $this->mcommon->common_edit('hr_employee_advance', $data, $where_array);

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
        $constraint_array   = array('emp_advance_id'  =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_employee_advance', $constraint_array);
      }
      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Employee_attendance/Employee_advance/ajaxLoadForm';
      $this->load->view('hr/Employee_attendance/form/Employee_advance_form', $Data);
    }
  }  

  public function delete($emp_advance_id='')
  {
    $data         = array(
                          'is_delete'  => 1,
                          'updated_by' => $this->auth_user_id
                         );
    $where_array  = array('emp_advance_id'  =>$emp_advance_id);
    $result       = $this->mcommon->common_edit('hr_employee_advance', $data, $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Employee_attendance/Employee_advance'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('hed.emp_advance_id, hed.posting_date, he.employee_name, hed.paid_amount, hed.claimed_amount, hed.advance_amount, hed.updated_on, CONCAT(up.first_name, " ", up.last_name)')
    ->from('hr_employee_advance AS hed')
    ->join('hr_employee as he', 'he.employee_id = hed.employee_id')
    ->join('user_profile as up', 'up.user_id = hed.updated_by')
    ->where('hed.is_delete', '0')
    ->edit_column('hsd.emp_advance_id', get_ajax_buttons('$1', 'hr/Employee_attendance/Employee_advance/'), 'hed.emp_advance_id');
    $this->datatables->edit_column('hed.updated_on', '$1', 'get_date_timeformat(hed.updated_on)');
    $this->datatables->edit_column('hed.posting_date', '$1', 'get_date_format(hed.posting_date)');
    $this->db->order_by('hed.updated_on',DESC);
    echo $this->datatables->generate();
  }  
}
?>