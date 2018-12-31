<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Claim_type extends MY_Controller
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
      if( $this->acl_permits('HR.expense_claim_type') )
      {
        //Redirect
         $view_data = array(
                            'form_heading'      => $this->lang->line('Claim_type_form_heading'),
                            'form_title'        => $this->lang->line('Claim_type_form_title'),
                            'form_description'  => $this->lang->line('Claim_type_form_description'),
                            'list_heading'      => $this->lang->line('Claim_type_form_heading'),
                            'list_title'        => $this->lang->line('Claim_type_form_title'),
                            'list_description'  => $this->lang->line('Claim_type_form_description'),
                            'formUrl'           => 'hr/Expense_claims/Claim_type/ajaxLoadForm',
                            'list_view'         => TRUE,
                            'buttonview'        => TRUE
                          );

        $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
        $this->table->set_template($tmpl); 
        $this->table->set_heading('Action', 'Expense_type', 'Description', 'Last Update', 'Updated by');

        $view_data['dataTableUrl']   =   'hr/Expense_claims/Claim_type/datatable';
        $data = array(
                        'title'     =>  'MEP - '.$this->lang->line('Claim_type_form_heading'),
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

      $companyArr                           = $this->input->post('company_id');
      $default_accountArr                   = $this->input->post('default_account');
      $expense_claim_type_accountArr        = $this->input->post('expense_claim_type_account_id');
      //Checking Form Validation
      $this->form_validation->set_rules('naming_series', lang('label_series_name'), 'trim|required');
      $this->form_validation->set_rules('expense_type', lang('label_expense_claim_type'), 'trim|required|callback_alpha_dash_space');
      $this->form_validation->set_rules('description', lang('label_description'), 'trim|required|callback_alpha_dash_space'); 
   

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('expense_claim_type_id') == "")
        {
          $naming         = $this->input->post('naming_series');       
          $namingSeries   = $this->mcommon->generateSeries($naming,101);
          
          $data     = array(
                              'expense_type'           => $this->input->post('expense_type'),
                              'naming_series'          => $namingSeries,
                              'description'            => $this->input->post('description'),
                              'created_on'             => date('Y-m-d H:i:s'),
                              'updated_on'             => date('Y-m-d H:i:s'),
                              'created_by'             => $this->auth_user_id,
                              'updated_by'             => $this->auth_user_id
                           );
          $result   = $this->mcommon->common_insert('hr_expense_claim_type', $data);
          $where_array    = array('transaction_id' => 101);

          if($result)
          {
              $resultupdate = $this->mcommon->dataUpdate('set_naming_series', 'current_value', $where_array); 
          }

          foreach ($companyArr as $key => $value) 
          {
            $dataAccount    = array(
                               'expense_claim_type_id'      => $result,
                               'company_id'                 => $companyArr[$key],
                               'default_account'            => $default_accountArr[$key],
                              );
            $resultAccount  = $this->mcommon->common_insert('hr_expense_claim_account', $dataAccount);
          }

          if($result)
          {
            $this->session->set_flashdata('msg', 'Saved Successfully');
            $this->session->set_flashdata('alertType', 'success');
            //redirect(base_url('setting/Printing_settings/Printing_heading/add'));
            $ajaxResponse['result'] = 'success';
          }
        }
        //Edit function calling
        else
        {
          $data     = array(
                              'expense_type'            => $this->input->post('expense_type'),
                              'description'             => $this->input->post('description'), 
                              'updated_on'              => date('Y-m-d H:i:s'),
                              'updated_by'              => $this->auth_user_id
                            );
          $where_array  = array(
                                'expense_claim_type_id'  => $this->input->post('expense_claim_type_id')
                               );
          $result     = $this->mcommon->common_edit('hr_expense_claim_type', $data, $where_array);

          foreach ($companyArr as $key => $value) 
          {
            if($expense_claim_type_accountArr[$key] != '')
            {
                $dataAccountUpdate          = array(                                 
                                                 'company_id'             => $companyArr[$key],
                                                 'default_account'        => $default_accountArr[$key],
                                                );
                $where_array                = array(
                                                    'expense_claim_type_account_id'  =>$expense_claim_type_accountArr[$key],
                                                   );
                $resultAccountUpdate        = $this->mcommon->common_edit('hr_expense_claim_account', $dataAccountUpdate, $where_array);
            }

            else
            {
                $dataAccountType        = array( 
                                               'expense_claim_type_id'  => $this->input->post('expense_claim_type_id'),                       
                                               'company_id'             => $companyArr[$key],
                                               'default_account'        => $default_accountArr[$key],
                                              );
                
                $resultAccountType      = $this->mcommon->common_insert('hr_expense_claim_account', $dataAccountType);              
            }
          }

          if($result || $resultAccountUpdate || $resultAccountType)
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
        $constraint_array     = array('expense_claim_type_id'   =>   $pkey_id);
        $Data['tableData']    = $this->mcommon->records_all('hr_expense_claim_type', $constraint_array);
        $Data['tableData1']   = $this->mcommon->records_all('hr_expense_claim_account', $constraint_array);
     }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Expense_claims/Claim_type/ajaxLoadForm';
      $this->load->view('hr/Expense_claims/form/Claim_type_form', $Data);
    }
  }

  public function delete($expense_claim_type_id)
  {
    $data       = array(
                  'is_delete'  => 1,
                  'updated_by' => $this->auth_user_id
                   );
    $where_array  = array('expense_claim_type_id'  =>$expense_claim_type_id);
    $result     = $this->mcommon->common_edit('hr_expense_claim_type', $data, $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Expense_claims/Claim_type/'));
    }
  }

  public function datatable()
  {
      $this->datatables->select('p.expense_claim_type_id, p.expense_type,  p.description, p.updated_on, CONCAT(up.first_name, " ", up.last_name)')
      ->from('hr_expense_claim_type AS p')
      ->join('user_profile as up', 'up.user_id = p.updated_by')
      ->where('p.is_Delete', '0')
      ->edit_column('p.expense_claim_type_id', get_ajax_buttons('$1', 'hr/Expense_claims/Claim_type/'), 'p.expense_claim_type_id');
      $this->datatables->edit_column('p.updated_on', '$1', 'get_date_timeformat(p.updated_on)');
      $this->db->order_by('p.updated_on',DESC);
      echo $this->datatables->generate();
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