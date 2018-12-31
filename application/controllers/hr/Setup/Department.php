<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department extends MY_Controller
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
    if( $this->acl_permits('HR.department') )
    {
      $view_data = array(
                'form_heading'      => $this->lang->line('department_heading'),
                'form_title'        => $this->lang->line('department_title'),
                'form_description'  => $this->lang->line('department_description'),
                'list_heading'      => $this->lang->line('department_heading'),
                'list_title'        => $this->lang->line('department_title'),
                'list_description'  => $this->lang->line('department_description'),
                'formUrl'           => 'hr/Setup/Department/ajaxLoadForm',
                'list_view'         => TRUE,
                'buttonview'        => TRUE
                );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Department Name', 'Leave Block List', 'Last Update', 'Updated by');

      $view_data['dataTableUrl']   =   'hr/Setup/Department/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('department_heading'),
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
      $this->form_validation->set_rules('department_name', lang('label_department_type'),'required');
      $this->form_validation->set_rules('leave_block_list_id', lang('lable_branch_heading'), 'required');

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('department_id') == "")
        {
          $data     = array(
                            'department_name'      => $this->input->post('department_name'),
                            'leave_block_list_id'  => $this->input->post('leave_block_list_id'),
                            'created_on'           => date('Y-m-d H:i:s'),
                            'updated_on'           => date('Y-m-d H:i:s'),
                            'created_by'           => $this->auth_user_id,
                            'updated_by'           => $this->auth_user_id
                           );
          $result   = $this->mcommon->common_insert('hr_department', $data);

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
         $data          = array(
                                'department_name'      => $this->input->post('department_name'),
                                'leave_block_list_id'  => $this->input->post('leave_block_list_id'),
                                'updated_on'           => date('Y-m-d H:i:s'),
                                'updated_by'           => $this->auth_user_id
                               );
          $where_array  = array('department_id'  =>$this->input->post('department_id'));
          $result       = $this->mcommon->common_edit('hr_department', $data, $where_array);

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
        $constraint_array   = array('department_id'  =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_department', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Setup/Department/ajaxLoadForm';
      $this->load->view('hr/Setup/form/Department_form', $Data);
    }
  }  

  public function delete($department_id='')
  {
    $data         = array(
                            'is_delete'  => 1,
                            'updated_by' => $this->auth_user_id
                         );
    $where_array  = array('department_id'  =>$department_id);
    $result       = $this->mcommon->common_edit('hr_department', $data, $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Setup/Department'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('hd.department_id, hd.department_name, hlb.leave_block_list_name, hd.updated_on, CONCAT(up.first_name, " ", up.last_name)')
    ->from('hr_department AS hd')
    ->join('user_profile as up', 'up.user_id = hd.updated_by')
    ->join('hr_leave_block_list as hlb', 'hlb.leave_block_list_id = hd.leave_block_list_id')
    ->where('hd.is_delete', '0')
    ->edit_column('hd.department_id', get_ajax_buttons('$1', 'hr/Setup/Department/'), 'hd.department_id');
    $this->datatables->edit_column('hd.updated_on', '$1', 'get_date_timeformat(hd.updated_on)');
    $this->db->order_by('hd.updated_on',DESC);
    echo $this->datatables->generate();
  }  
}
?>