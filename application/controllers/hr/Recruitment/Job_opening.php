<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job_opening extends MY_Controller
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
    $this->lang->load("validation_lang","english");
    $this->multi_menu->set_items($items);
    $this->lang->load("hr","english");
    $this->load->library("form_validation");  
  }

  public function index($Data=array())
  {
    if( $this->acl_permits('HR.job_opening') )
    { 
      $view_data = array(
                          'form_heading'      => $this->lang->line('Job_opening_form_heading'),
                          'form_title'        => $this->lang->line('Job_opening_form_title'),
                          'form_description'  => $this->lang->line('Job_opening_form_description'),
                          'list_heading'      => $this->lang->line('Job_opening_form_headings'),
                          'list_title'        => $this->lang->line('Job_opening_list_title'),
                          'list_description'  => $this->lang->line('Job_opening_form_description'),
                          'formUrl'           => 'hr/Recruitment/Job_opening/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'        => TRUE
                        );

      $tmpl = array ('table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Job Title', 'Status', 'Description', 'Last Update', 'Updated by');

      $view_data['dataTableUrl']   =   'hr/Recruitment/Job_opening/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Job_opening_page_title'),
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

      $this->form_validation->set_rules('job_title', lang('label_job_title'), 'trim|required');
      $this->form_validation->set_rules('job_opening_status_id', lang('label_status'), 'trim|required');

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('job_opening_id') == "")
        {
          $data   = array(   
                          'job_title'             => $this->input->post('job_title'),
                          'route'                 => $this->input->post('route'),
                          'publish'               => ($this->input->post('publish'))?'1':'0',
                          'job_opening_status_id' => $this->input->post('job_opening_status_id'),
                          'description'           => $this->input->post('description'),
                          'created_on'            => date('Y-m-d H:i:s'),
                          'created_by'            => $this->auth_user_id,
                          'updated_on'            => date('Y-m-d H:i:s'),
                          'updated_by'            => $this->auth_user_id
                         );
          $result   = $this->mcommon->common_insert('hr_job_opening', $data);

          if($result)
          {
            $this->session->set_flashdata('msg', 'Saved Successfully');
            $this->session->set_flashdata('alertType', 'success');
            //redirect(base_url('hr/Recruitment/Job_opening/'));
            $ajaxResponse['result'] = 'success';
          }
        }
        //Edit function calling
        else
        {
          $data         = array(   
                                  'job_title'             => $this->input->post('job_title'),
                                  'route'                 => $this->input->post('route'),
                                  'publish'               => ($this->input->post('publish'))?'1':'0',
                                  'job_opening_status_id' => $this->input->post('job_opening_status_id'),
                                  'description'           => $this->input->post('description'),
                                  'updated_on'            => date('Y-m-d H:i:s'),
                                  'updated_by'            => $this->auth_user_id
                               );
          $where_array  = array('job_opening_id'  =>$this->input->post('job_opening_id'));
          $result       = $this->mcommon->common_edit('hr_job_opening', $data, $where_array);

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
        $constraint_array   = array('job_opening_id'   =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_job_opening', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Recruitment/Job_opening/ajaxLoadForm';
      $this->load->view('hr/Recruitment/form/Job_opening_form', $Data);
    }
  }

  public function delete($job_opening_id)
  {
    $data         = array(
                          'is_delete'  => 1,
                          'updated_by' => $this->auth_user_id
                         );
    $where_array  = array('job_opening_id'  =>$job_opening_id);
    $result       = $this->mcommon->common_edit('hr_job_opening', $data, $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Recruitment/Job_opening/'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('jo.job_opening_id, jo.job_title, djs.status, jo.description, jo.updated_on, CONCAT(up.first_name, " ", up.last_name)')
    ->from('hr_job_opening AS jo')
    ->join('def_hr_job_opening_status as djs', 'djs.job_opening_status_id = jo.job_opening_status_id')
    ->join('user_profile as up', 'up.user_id = jo.updated_by')
    ->where('jo.is_delete', '0')
    ->edit_column('jo.job_opening_id', get_ajax_buttons('$1', 'hr/Recruitment/Job_opening/'), 'jo.job_opening_id');
    $this->datatables->edit_column('jo.updated_on', '$1', 'get_date_timeformat(jo.updated_on)');
    $this->db->order_by('jo.updated_on',DESC);
    echo $this->datatables->generate();
  }
}
