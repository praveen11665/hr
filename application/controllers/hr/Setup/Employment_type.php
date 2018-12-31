<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employment_type extends MY_Controller
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
    if( $this->acl_permits('HR.employement_type') )
    {
      $view_data = array(
                          'form_heading'        =>    $this->lang->line('employment_form_heading'),
                          'form_title'          =>    $this->lang->line('employment_form_title'),
                          'form_description'    =>    $this->lang->line('employment_form_description'),
                          'list_heading'        =>    $this->lang->line('employment_form_heading'),
                          'list_title'          =>    $this->lang->line('employment_form_title'),
                          'list_description'    =>    $this->lang->line('employment_form_description'),
                          'formUrl'             =>    'hr/Setup/Employment_type/ajaxLoadForm',
                          'list_view'           =>    TRUE,
                          'buttonview'          => TRUE
                        );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Employment Type', 'Last Update', 'Updated by');

      $view_data['dataTableUrl']   =   'hr/Setup/Employment_type/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('employment_form_heading'),
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
      $this->form_validation->set_rules('employment_type_name', 'Employment Type Name', 'required|callback_alpha_dash_space');
      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('employment_type_id') == "")
        {
          $data   = array(
                            'employment_type_name'     =>   $this->input->post('employment_type_name'),
                            'created_on'               =>   date('Y-m-d H:i:s'),
                            'updated_on'               =>   date('Y-m-d H:i:s'),
                            'created_by'               =>   $this->auth_user_id,
                            'updated_by'               =>   $this->auth_user_id
                          );
          $result = $this->mcommon->common_insert('hr_employment_type', $data);

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
          $data         =   array(
                                  'employment_type_name'      => $this->input->post('employment_type_name'),
                                  'updated_on'                => date('Y-m-d H:i:s'),
                                  'updated_by'                => $this->auth_user_id
                                 );
          $where_array  =   array('employment_type_id'  =>  $this->input->post('employment_type_id'));
          $result       = $this->mcommon->common_edit('hr_employment_type', $data, $where_array);

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
        $constraint_array   = array('employment_type_id'   =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_employment_type', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Setup/Employment_type/ajaxLoadForm';
      $this->load->view('hr/Setup/form/Employment_type_form', $Data);
    }
  }

  public function datatable()
  {
    $this->datatables->select('het.employment_type_id, het.employment_type_name, het.updated_on, CONCAT(up.first_name, " ", up.last_name)')
        ->from('hr_employment_type AS het')
        ->join('user_profile as up', 'up.user_id = het.updated_by') 
        ->where('het.is_delete', '0')
        ->edit_column('het.employment_type_id', get_ajax_buttons('$1', 'hr/Setup/Employment_type/'), 'het.employment_type_id');
    $this->datatables->edit_column('het.updated_on', '$1', 'get_date_timeformat(het.updated_on)');
    $this->db->order_by('het.updated_on',DESC);
    echo $this->datatables->generate();
  }

  public function delete($employment_type_id='')
  {
    $data         = array(
                          'is_delete'  => 1,
                          'updated_by' => $this->auth_user_id
                         );
    $where_array  = array('employment_type_id'  => $employment_type_id);
    $result       = $this->mcommon->common_edit('hr_employment_type', $data, $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Setup/Employment_type/'));
    }
  }

  function alpha_dash_space($field)
  {
    if (! preg_match('/^[a-zA-Z\s]+$/', $field)) {
        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
        return FALSE;
    } else {
        return TRUE;
    }
  }
}