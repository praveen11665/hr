<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Training_event extends MY_Controller
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
    if( $this->acl_permits('HR.training_event') )
    {
      //Redirect
      $view_data = array(
                          'form_heading'      => $this->lang->line('Training_event_form_heading'),
                          'form_title'        => $this->lang->line('Training_event_form_title'),
                          'form_description'  => $this->lang->line('Training_event_form_description'),
                          'list_heading'      => $this->lang->line('Training_event_form_heading'),
                          'list_title'        => $this->lang->line('Training_event_form_title'),
                          'list_description'  => $this->lang->line('Training_event_form_description'),
                          'formUrl'           => 'hr/Training/Training_event/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'        => TRUE
                        );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Event Name', 'Event Type', 'Event Status', 'Start Time', 'End Time', 'Localtime', 'Last Update', 'Updated by');

      $view_data['dataTableUrl']   =   'hr/Training/Training_event/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Training_event_page_title'),
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

      $employee_idArr             = $this->input->post('employee_id');
      $trainingeventstatusidArr   = $this->input->post('training_event_status_id');
      $attendees_idArr            = $this->input->post('attendees_id');
      //Checking Form Validation
      $this->form_validation->set_rules('event_name', lang('label_event_name'), 'trim|required|callback_alpha_dash_space');
      $this->form_validation->set_rules('training_event_type_id', lang('label_type'), 'trim|required');
      $this->form_validation->set_rules('training_eve_event_status_id', lang('label_event_status'), 'trim|required');
      $this->form_validation->set_rules('trainer_id', lang('label_trainer_name'), 'trim|required');
      $this->form_validation->set_rules('company_id', lang('label_company_name'), 'trim|required');
      $this->form_validation->set_rules('course_id', lang('label_course'), 'trim|required|callback_alpha_dash_space');
      $this->form_validation->set_rules('location', lang('label_location'), 'trim|required|callback_alpha_dash_space');
      $this->form_validation->set_rules('start_time', lang('label_start_date'), 'trim|required');
      $this->form_validation->set_rules('end_time', lang('label_end_date'), 'trim|required');
      $this->form_validation->set_rules('introduction', lang('label_introduction'), 'trim|required');
      //$this->form_validation->set_rules('employee_id[]', lang('label_employee_id'), 'trim|required');
      //$this->form_validation->set_rules('training_event_status_id[]', lang('label_status'), 'trim|required');
      $this->form_validation->set_rules('training_program_id', lang('label_training_program'), 'trim|required');

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('training_event_id') == "")
        {
          $data     = array(
                              'event_name'                    => $this->input->post('event_name'),
                              'training_eve_event_status_id'  => $this->input->post('training_eve_event_status_id'),
                              'training_event_type_id'        => $this->input->post('training_event_type_id'),
                              'trainer_id'                    => $this->input->post('trainer_id'),
                              'training_program_id'           => $this->input->post('training_program_id'),
                              'def_training_level_id'         => $this->input->post('def_training_level_id'),
                              'has_certificate'               => ($this->input->post('has_certificate'))?'1':'0',
                              'trainer_email'                 => $this->input->post('trainer_email'),
                              'contact_number'                => $this->input->post('contact_number'),
                              'company_id'                    => $this->input->post('company_id'),
                              'course_id'                     => $this->input->post('course_id'),
                              'location'                      => $this->input->post('location'),
                              'start_time '                   => date('Y-m-d H:i:s',strtotime($this->input->post('start_time'))),
                              'end_time'                      => date('Y-m-d H:i:s',strtotime($this->input->post('end_time'))),
                              'introduction'                  => $this->input->post('introduction'),
                              'created_on'                    => date('Y-m-d H:i:s'),                              
                              'updated_on'                    => date('Y-m-d H:i:s'),
                              'created_by'                    => $this->auth_user_id,
                              'updated_by'                    => $this->auth_user_id
                            );
          $result   = $this->mcommon->common_insert('hr_training_event', $data);

          foreach ($employee_idArr as $key =>$value) 
          {
              $data1    =   array(  
                                    'training_event_id'         => $result,
                                    'employee_id'               => $employee_idArr[$key],
                                    'send_email'                => ($this->input->post('send_email'))?'1':'0',
                                    'training_event_status_id'  => $trainingeventstatusidArr[$key],
                                  );
              $result1  = $this->mcommon->common_insert('hr_training_event_attendees', $data1);
          }
          if($result1)
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
                              'event_name'                    => $this->input->post('event_name'),
                              'training_eve_event_status_id'  => $this->input->post('training_eve_event_status_id'),
                              'training_event_type_id'        => $this->input->post('training_event_type_id'),
                              'trainer_id'                    => $this->input->post('trainer_id'),
                              'trainer_email'                 => $this->input->post('trainer_email'),
                              'contact_number'                => $this->input->post('contact_number'),
                              'company_id'                    => $this->input->post('company_id'),
                              'course_id'                     => $this->input->post('course_id'),
                              'location'                      => $this->input->post('location'),
                              'training_program_id'           => $this->input->post('training_program_id'),
                              'def_training_level_id'         => $this->input->post('def_training_level_id'),
                              'has_certificate'               => ($this->input->post('has_certificate'))?'1':'0',
                              'start_time '                   => date('Y-m-d H:i:s',strtotime($this->input->post('start_time'))),
                              'end_time'                      => date('Y-m-d H:i:s',strtotime($this->input->post('end_time'))),
                              'introduction'                  => $this->input->post('introduction'),
                              'updated_on'                    => date('Y-m-d H:i:s'),
                              'updated_by'                    => $this->auth_user_id
                              );
          $where_array  = array('training_event_id'  =>$this->input->post('training_event_id'));

          $this->db->trans_start();
          $result   = $this->mcommon->common_edit('hr_training_event', $data, $where_array);

          foreach ($employee_idArr as $key =>$value) 
          {
              $data1    =   array(  
                                    'employee_id'               => $employee_idArr[$key],
                                    'send_email'                => ($this->input->post('send_email'))?'1':'0',
                                    'training_event_status_id'  => $trainingeventstatusidArr[$key],
                                  );
              if($attendees_idArr[$key] != '')
              {
              
                $where_array1   = array('attendees_id'  =>$attendees_idArr[$key]);
                $result1    = $this->mcommon->common_edit('hr_training_event_attendees', $data1,
                $where_array1);
              }
              else
              {
                $data2    =   array(
                                    'training_event_id'         =>  $this->input->post('training_event_id'),
                                    'employee_id'               =>  $employee_idArr[$key],
                                    'send_email'                =>  ($this->input->post('send_email'))?'1':'0',
                                    'training_event_status_id'  =>  $trainingeventstatusidArr[$key],
                                    );
                $result2    = $this->mcommon->common_insert('hr_training_event_attendees', $data2
                );
              }
          }
          $this->db->trans_complete();
          if($result1 || $result2 || $result)
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
        $constraint_array     = array('training_event_id'   =>   $pkey_id);
        $Data['tableData']    = $this->mcommon->records_all('hr_training_event', $constraint_array);
        $Data['contentData']  = $this->mcommon->records_all('hr_training_event_attendees', $constraint_array);

      }

      //Ajax Form Load
      $Data['ActionUrl']   = 'hr/Training/Training_event/ajaxLoadForm';
      $this->load->view('hr/Training/form/Training_event_form', $Data);
    }
  }

  public function delete($training_event_id)
  {
    $data         = array(
                          'is_delete'  => 1,
                          'updated_by' => $this->auth_user_id
                         );
    $where_array  = array('training_event_id'  =>$training_event_id);

    $this->db->trans_start();
    $result       = $this->mcommon->common_edit('hr_training_event', $data, $where_array);
    $result1      = $this->mcommon->common_delete('hr_training_event_attendees', $where_array);
    $this->db->trans_complete();

    if($result1)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Training/Training_event/'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('te.training_event_id, te.event_name, tet.type, tes.status, te.start_time, te.end_time, te.location, te.updated_on, CONCAT(up.first_name, " ", up.last_name)')
    ->from('hr_training_event AS te')
    ->join('def_hr_training_event_type as tet', 'tet.training_event_type_id = te.training_event_type_id')
    ->join('def_hr_training_event_status as tes', 'tes.training_event_status_id = te.training_eve_event_status_id')
    ->join('user_profile as up', 'up.user_id = te.updated_by')
    ->where('te.is_delete', '0')
    ->edit_column('te.training_event_id', get_ajax_buttons('$1', 'hr/Training/Training_event/'), 'te.training_event_id');
    $this->db->order_by('te.updated_on',DESC);
    $this->datatables->edit_column('te.updated_on', '$1', 'get_date_timeformat(te.updated_on)');
    $this->datatables->edit_column('te.start_time', '$1', 'get_date_timeformat(te.start_time)');
    $this->datatables->edit_column('te.end_time', '$1', 'get_date_timeformat(te.end_time)');
    echo $this->datatables->generate();
  }
  
  public function loadDetails()
  {
    $trainer_id       = $this->input->post('trainer_id');
    $constraint_array = array('trainer_id' => $trainer_id);  
    $resultData       = $this->mcommon->records_all('hr_trainer', $constraint_array);

    foreach ($resultData as $row) 
    {
      $trainerData   = $row;
    }
    echo json_encode($trainerData);
    exit();
  } 

  public function alpha_dash_space($field)
  {
    if (! preg_match('/^[a-zA-Z\s]+$/', $field))
    {
        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
        return FALSE;
    } 
    else 
    {
        return TRUE;
    }
  }
}