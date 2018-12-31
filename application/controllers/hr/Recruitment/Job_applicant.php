<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job_applicant extends MY_Controller
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
    $this->load->library('upload');
    $this->load->library("form_validation");  
  }

  public function index($Data=array())
  {
    if( $this->acl_permits('HR.job_applicant') )
    {   
      $view_data = array(
                            'form_heading'      => $this->lang->line('Job_applicant_form_heading'),
                            'form_title'        => $this->lang->line('Job_applicant_form_title'),
                            'form_description'  => $this->lang->line('Job_applicant_form_description'),
                            'list_heading'      => $this->lang->line('Job_applicant_form_heading'),
                            'list_title'        => $this->lang->line('Job_applicant_form_title'),
                            'list_description'  => $this->lang->line('Job_applicant_form_description'),
                            'formUrl'           => 'hr/Recruitment/Job_applicant/ajaxLoadForm',
                            'list_view'         => TRUE,
                            'buttonview'        => TRUE
                          );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Applicant Name', 'Status', 'Job Opening', 'Email', 'Last Update', 'Updated by');

      $view_data['dataTableUrl']   =   'hr/Recruitment/Job_applicant/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Job_applicant_page_title'),
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
      //parse_str($_POST['postdata'], $_POST);

      $this->form_validation->set_rules('applicant_name', lang('label_applicant_name'), 'trim|required');
      $this->form_validation->set_rules('email_id', lang('label_email_address'), 'trim|required');
      $this->form_validation->set_rules('job_applicant_status_id', lang('label_status'), 'trim|required');
      //$this->form_validation->set_rules('job_opening_id', lang('label_job_opening'), 'trim|required');      
      $this->form_validation->set_rules('cover_letter', lang('label_cover_letter'), 'trim|required');      
      $this->form_validation->set_rules('contact_number', lang('label_contact_number'), 'trim|required|numeric');      
      $this->form_validation->set_rules('total_experience', lang('label_total_experience'), 'trim|required');      
      $this->form_validation->set_rules('current_ctc', lang('label_current_CTC'), 'trim|required');      
      $this->form_validation->set_rules('expected_ctc', lang('label_expected_CTC'), 'trim|required');      
      $this->form_validation->set_rules('technical_skills', lang('label_technical_skills'), 'trim|required');  

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('job_applicant_id') == "")
        {
          if($_FILES['resume_attachment']['name'] != '')
          {
            $config = array();
            $config['upload_path']      = './upload/hr/applicant_profile/';
            $config['allowed_types']    = '*';
            $config['max_size']         = '0';
            $config['max_width']        = '3500';
            $config['max_height']       = '3500';
            $config['max_filename']     = '500';
            $config['overwrite']        = false;
            $this->upload->initialize($config);
            $this->load->library('image_lib');
            $this->load->library('upload', $config);

            if($this->upload->do_upload('resume_attachment'))
            { 
              $this->load->helper('inflector');
              $file_name              =   underscore($_FILES['resume_attachment']['name']);
              $config['file_name']    =   $file_name;
              $image_data['message']  =   $this->upload->data(); 
              $_POST['resume_attachment']      =   "upload/hr/applicant_profile/".$image_data['message']['file_name'];
            } 
            else
            {
              $data['resume_attachment']   = $this->upload->display_errors('<div class="alert alert-error">', '</div>');
              $this->form_validation->set_rules('resume_attachment', $this->upload->display_errors(), 'required');    
              $_POST['resume_attachment']  =   '';
            }
          }
          else
          {
            $_POST['resume_attachment']   =   '';
          }

          $data   = array(   
                            'applicant_name'          => $this->input->post('applicant_name'),
                            'email_id'                => $this->input->post('email_id'),
                            'job_applicant_status_id' => $this->input->post('job_applicant_status_id'),
                            'job_opening_id'          => $this->input->post('job_opening_id'),
                            'cover_letter'            => $this->input->post('cover_letter'),
                            'contact_number'          => $this->input->post('contact_number'),
                            'total_experience'        => $this->input->post('total_experience'), 
                            'resume_attachment'       => $this->input->post('resume_attachment'), 
                            'current_ctc'             => $this->input->post('current_ctc'),
                            'expected_ctc'            => $this->input->post('expected_ctc'),
                            'technical_skills'        => $this->input->post('technical_skills'),
                            'created_on'              => date('Y-m-d H:i:s'),
                            'updated_on'              => date('Y-m-d H:i:s'),
                            'created_by'              => $this->auth_user_id,
                            'updated_by'              => $this->auth_user_id
                          );
          $result = $this->mcommon->common_insert('hr_job_applicant', $data);



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
          if($_FILES['resume_attachment']['name'] != '')
          {
            $config = array();
            $config['upload_path']      = './upload/hr/applicant_profile/';
            $config['allowed_types']    = '*';
            $config['max_size']         = '0';
            $config['max_width']        = '3500';
            $config['max_height']       = '3500';
            $config['max_filename']     = '500';
            $config['overwrite']        = false;
            $this->upload->initialize($config);
            $this->load->library('image_lib');
            $this->load->library('upload', $config);

            if($this->upload->do_upload('resume_attachment'))
            { 
              $this->load->helper('inflector');
              $file_name              =   underscore($_FILES['resume_attachment']['name']);
              $config['file_name']    =   $file_name;
              $image_data['message']  =   $this->upload->data(); 
              $_POST['resume_attachment']      =   "upload/hr/applicant_profile/".$image_data['message']['file_name'];
              $data         = array('resume_attachment'       => $this->input->post('resume_attachment'), );
              $where_array  = array('job_applicant_id'  =>$this->input->post('job_applicant_id'));
              $resultUpload = $this->mcommon->common_edit('hr_job_applicant', $data, $where_array);
            } 
            else
            {
              $data['resume_attachment']   = $this->upload->display_errors('<div class="alert alert-error">', '</div>');
              $this->form_validation->set_rules('resume_attachment', $this->upload->display_errors(), 'required');    
              $_POST['resume_attachment']  =   '';
            }

          }
          $data         = array(   
                                'applicant_name'          => $this->input->post('applicant_name'),
                                'email_id'                => $this->input->post('email_id'),
                                'job_applicant_status_id' => $this->input->post('job_applicant_status_id'),
                                'job_opening_id'          => $this->input->post('job_opening_id'),
                                'cover_letter'            => $this->input->post('cover_letter'),
                                'contact_number'          => $this->input->post('contact_number'),
                                'total_experience'        => $this->input->post('total_experience'), 
                                'current_ctc'             => $this->input->post('current_ctc'),
                                'expected_ctc'            => $this->input->post('expected_ctc'),
                                'technical_skills'        => $this->input->post('technical_skills'),
                                'updated_on'              => date('Y-m-d H:i:s'),
                                'updated_by'              => $this->auth_user_id
                              );
          $where_array  = array('job_applicant_id'  =>$this->input->post('job_applicant_id'));
          $result       = $this->mcommon->common_edit('hr_job_applicant', $data, $where_array);
          /*else
          {
            $data         = array(   
                                  'applicant_name'          => $this->input->post('applicant_name'),
                                  'email_id'                => $this->input->post('email_id'),
                                  'job_applicant_status_id' => $this->input->post('job_applicant_status_id'),
                                  'job_opening_id'          => $this->input->post('job_opening_id'),
                                  'cover_letter'            => $this->input->post('cover_letter'),
                                  'resume_attachment'       => $this->input->post('resume_attachment_update'),
                                  'contact_number'          => $this->input->post('contact_number'),
                                  'total_experience'        => $this->input->post('total_experience'), 
                                  'current_ctc'             => $this->input->post('current_ctc'),
                                  'expected_ctc'            => $this->input->post('expected_ctc'),
                                  'technical_skills'        => $this->input->post('technical_skills'),
                                  'updated_by'              => $this->auth_user_id
                                );
            $where_array  = array('job_applicant_id'  =>$this->input->post('job_applicant_id'));
            $result       = $this->mcommon->common_edit('hr_job_applicant', $data, $where_array);          
          }*/

          if($result || $resultUpload)
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
        $constraint_array   = array('job_applicant_id'   =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_job_applicant', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Recruitment/Job_applicant/ajaxLoadForm';
      $this->load->view('hr/Recruitment/form/Job_applicant_form', $Data);
    }
  }

  public function delete($job_applicant_id)
  {
    $data         = array(
                            'is_delete'  => 1,
                            'updated_by' => $this->auth_user_id
                         );
    $where_array  = array('job_applicant_id'  =>$job_applicant_id);
    $result       = $this->mcommon->common_edit('hr_job_applicant', $data, $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Recruitment/Job_applicant/'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('hja.job_applicant_id, hja.applicant_name, djas.status, hjo.job_title, hja.email_id, hja.updated_on, CONCAT(up.first_name, " ", up.last_name)')
    ->from('hr_job_applicant AS hja')
    ->join('user_profile as up', 'up.user_id = hja.updated_by')
    ->join('def_hr_job_applicant_status as djas', 'djas.job_applicant_status_id = hja.job_applicant_status_id', 'left')
    ->join('hr_job_opening as hjo', 'hjo.job_opening_id = hja.job_opening_id', 'left')
    ->where('hja.is_delete', '0')
    ->edit_column('hja.job_applicant_id', get_ajax_buttons('$1', 'hr/Recruitment/Job_applicant'), 'hja.job_applicant_id');
    $this->datatables->edit_column('hja.updated_on', '$1', 'get_date_timeformat(hja.updated_on)');
    $this->db->order_by('hja.updated_on', DESC);
    echo $this->datatables->generate();
  }
}