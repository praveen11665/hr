<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave_controlpanel extends MY_Controller
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
    if( $this->acl_permits('HR.leave_control_panel') )
    {
      //Redirect
      $view_data = array(
                          'form_heading'      => $this->lang->line('Leave_controlpanel_form_heading'),
                          'form_title'        => $this->lang->line('Leave_controlpanel_form_title'),
                          'form_description'  => $this->lang->line('Leave_controlpanel_form_description'),
                          'list_heading'      => $this->lang->line('Leave_controlpanel_form_heading'),
                          'list_title'        => $this->lang->line('Leave_controlpanel_form_title'),
                          'list_description'  => $this->lang->line('Leave_controlpanel_form_description'),
                          'formUrl'           => 'hr/Leaves_holiday/Leave_controlpanel/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'         => TRUE

                        );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Company', 'Employment type ', 'Branch', 'Department', 'Designation', 'Leave Type');

      $view_data['dataTableUrl']   =   'hr/Leaves_holiday/Leave_controlpanel/datatable';
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
      $this->form_validation->set_rules('company_id', lang('label_company'), 'trim|required');
      $this->form_validation->set_rules('employment_type_id', lang('label_employment_type'), 'trim|required');
      $this->form_validation->set_rules('branch_id', lang('label_branch'), 'trim|required');
      $this->form_validation->set_rules('department_id', lang('label_department'), 'trim|required');
      $this->form_validation->set_rules('designation_id', lang('label_designation'), 'trim|required');
      $this->form_validation->set_rules('leave_type_id', lang('label_leave_type'), 'trim|required');
      $this->form_validation->set_rules('from_date', lang('label_from_date'), 'trim|required');
      $this->form_validation->set_rules('to_date', lang('label_to_date'), 'trim|required');

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('leave_control_panel_id') == "")
        {
          $data     = array(
                              'company_id'       	  => $this->input->post('company_id'),
                              'employment_type_id'  => $this->input->post('employment_type_id'),
                              'branch_id'          	=> $this->input->post('branch_id'),
                              'department_id'       => $this->input->post('department_id'),
                              'designation_id'      => $this->input->post('designation_id'),
                              'from_date'           => date('Y-m-d', strtotime($this->input->post('from_date'))),
                              'to_date'             => date('Y-m-d', strtotime($this->input->post('to_date'))),
                              'leave_type_id'   	  => $this->input->post('leave_type_id'),
                              'carry_forward'       => ($this->input->post('carry_forward'))?'1':'0',
                              'no_of_days' 			    => $this->input->post('no_of_days')
                           );
          $result   = $this->mcommon->common_insert('hr_leave_control_panel', $data);

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
                                'company_id'          => $this->input->post('company_id'),
                                'employment_type_id'  => $this->input->post('employment_type_id'),
                                'branch_id'           => $this->input->post('branch_id'),
                                'department_id'       => $this->input->post('department_id'),
                                'designation_id'      => $this->input->post('designation_id'),
                                'from_date'           => date('Y-m-d', strtotime($this->input->post('from_date'))),
                                'to_date'             => date('Y-m-d', strtotime($this->input->post('to_date'))),
                                'leave_type_id'       => $this->input->post('leave_type_id'),
                                'carry_forward'       => ($this->input->post('carry_forward'))?'1':'0',
                                'no_of_days'          => $this->input->post('no_of_days')
                               );
          $where_array  = array('leave_control_panel_id'  =>$this->input->post('leave_control_panel_id'));
          $result       = $this->mcommon->common_edit('hr_leave_control_panel', $data, $where_array);

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
        $constraint_array   = array('leave_control_panel_id'   =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_leave_control_panel', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Leaves_holiday/Leave_controlpanel/ajaxLoadForm';
      $this->load->view('hr/Leaves_holiday/form/Leave_controlpanel_form', $Data);
    }
  }

  public function delete($leave_control_panel_id)
  {
    $where_array  = array('leave_control_panel_id'  =>$leave_control_panel_id);
    $result     = $this->mcommon->common_delete('hr_leave_control_panel', $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Leaves_holiday/Leave_controlpanel/'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('hlcp.leave_control_panel_id, sc.company_name, het.employment_type_name, hb.branch, hd.department_name, hde.designation_name, hlt.leave_type_name')
    ->from('hr_leave_control_panel AS hlcp')
    ->join('set_company as sc', 'sc.company_id = hlcp.company_id')
    ->join('hr_employment_type as het', 'het.employment_type_id = hlcp.employment_type_id')
    ->join('hr_branch as hb', 'hb.branch_id = hlcp.branch_id')
    ->join('hr_department as hd', 'hd.department_id = hlcp.department_id')
    ->join('hr_designation as hde', 'hde.designation_id = hlcp.designation_id')
    ->join('hr_leave_type as hlt', 'hlt.leave_type_id = hlcp.leave_type_id')
    ->edit_column('hlcp.leave_control_panel_id', get_ajax_buttons('$1', 'hr/Leaves_holiday/Leave_controlpanel/'), 'hlcp.leave_control_panel_id');
    echo $this->datatables->generate();
  }
}