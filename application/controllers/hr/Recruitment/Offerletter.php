
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Offerletter extends MY_Controller
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
    if( $this->acl_permits('HR.offer_letter') )
    { 
      $view_data = array(
                          'form_heading'      => $this->lang->line('Offerletter_form_heading'),
                          'form_title'        => $this->lang->line('Offerletter_form_title'),
                          'form_description'  => $this->lang->line('Offerletter_form_description'),
                          'list_heading'      => $this->lang->line('Offerletter_form_heading'),
                          'list_title'        => $this->lang->line('Offerletter_form_title'),
                          'list_description'  => $this->lang->line('Offerletter_form_description'),
                          'formUrl'           => 'hr/Recruitment/Offerletter/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'        => TRUE
                        );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Applicant Name', 'Designation', 'Company', 'Status');

      $view_data['dataTableUrl']   =   'hr/Recruitment/Offerletter/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Offerletter_form_heading'),
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

      $offer_letter_term_idArr        =   $this->input->post('offer_letter_term_id');
      $offer_termArr                  =   $this->input->post('offer_term');
      $valueArr                       =   $this->input->post('value');

	    $this->form_validation->set_rules('job_applicant_id', lang('label_job_applicant'),'trim|required');
	    $this->form_validation->set_rules('offer_letter_status_id', lang('label_status'),'trim|required');
	    $this->form_validation->set_rules('designation_id', lang('label_designation'),'trim|required');
	    $this->form_validation->set_rules('company_id', lang('label_company'),'trim|required');

      if($this->form_validation->run() == TRUE) 
      {
        if($this->input->post('offer_letter_id') == "")
        {
          $data   = array(
                            'job_applicant_id'       => $this->input->post('job_applicant_id'),
                            'applicant_name'         => $this->input->post('applicant_name'),
                            'offer_letter_status_id' => $this->input->post('offer_letter_status_id'),
                            'offer_date'             => date('Y-m-d', strtotime($this->input->post('offer_date'))),
                            'designation_id'         => $this->input->post('designation_id'),
                            'company_id'             => $this->input->post('company_id'),
                            'tc_id'                  => $this->input->post('tc_id'),
                            'terms'                  => $this->input->post('terms')
                         );        

          $result = $this->mcommon->common_insert('hr_offer_letter', $data);

          foreach ($offer_termArr as $key => $value) 
          {
            $dataofferTerm      =   array(
                                          'offer_letter_id'   =>   $result,
                                          'offer_term'        =>   $offer_termArr[$key],
                                          'value'             =>   $valueArr[$key]
                                          );
            $resultOffer = $this->mcommon->common_insert('hr_offer_letter_term', $dataofferTerm);
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
          $data         = array(
                                'job_applicant_id'       => $this->input->post('job_applicant_id'),
                                'applicant_name'         => $this->input->post('applicant_name'),
                                'offer_letter_status_id' => $this->input->post('offer_letter_status_id'),
                                'offer_date'             => date('Y-m-d', strtotime($this->input->post('offer_date'))),
                                'designation_id'         => $this->input->post('designation_id'),
                                'company_id'             => $this->input->post('company_id'),
                                'tc_id'                  => $this->input->post('tc_id'),
                                'terms'                  => $this->input->post('terms')
                               );
          $where_array  = array('offer_letter_id'  =>$this->input->post('offer_letter_id'));
          $result       = $this->mcommon->common_edit('hr_offer_letter', $data, $where_array);

          foreach ($offer_termArr as $key => $value) 
          {

            $dataofferTerm      =   array(
                                          'offer_term'        =>   $offer_termArr[$key],
                                          'value'             =>   $valueArr[$key]
                                          );
            if($offer_letter_term_idArr[$key] !=  '')
            {
              $where_array_offer        =   array('offer_letter_term_id'  =>  $offer_letter_term_idArr[$key]);
              $resultOfferUpdate        =   $this->mcommon->common_edit('hr_offer_letter_term', $dataofferTerm, $where_array_offer);
            }

            else
            {
              $dataofferTerm['offer_letter_id']   =   $this->input->post('offer_letter_id');
              $resultOfferInsert                  =   $this->mcommon->common_insert('hr_offer_letter_term', $dataofferTerm);
            }
          }

          if($result || $resultOfferUpdate || $resultOfferInsert)
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
        $constraint_array     = array('offer_letter_id'   =>   $pkey_id);
        $Data['tableData']    = $this->mcommon->records_all('hr_offer_letter', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Recruitment/Offerletter/ajaxLoadForm';
      $this->load->view('hr/Recruitment/form/Offerletter_form', $Data);
    }
  }

  public function delete($offer_letter_id)
  {
    $where_array  = array('offer_letter_id' => $offer_letter_id);
    $result       = $this->mcommon->common_delete('hr_offer_letter', $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Recruitment/Offerletter/'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('hol.offer_letter_id, hol.applicant_name, hd.designation_name, sc.company_name, dols.status')
    ->from('hr_offer_letter AS hol')
    ->join('hr_designation as hd', 'hd.designation_id = hol.designation_id')
    ->join('set_company as sc', 'sc.company_id = hol.company_id')
    ->join('def_hr_offer_letter_status as dols', 'dols.offer_letter_status_id = hol.offer_letter_status_id')
    ->edit_column('hol.offer_letter_id', get_ajax_buttons('$1', 'hr/Recruitment/Offerletter/'), 'hol.offer_letter_id');
    echo $this->datatables->generate();
  }

  public function getjobapplicantname($value='')
  {
    $job_applicant_id   = $this->input->post('job_applicant_id');
    $constraint_array   = array('job_applicant_id' => $job_applicant_id);
    $applicant_name     = $this->mcommon->specific_row_value('hr_job_applicant', $constraint_array, 'applicant_name');
    echo $applicant_name;
  } 
}	    