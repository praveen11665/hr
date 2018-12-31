<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Expense_claim extends MY_Controller
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
    if( $this->acl_permits('HR.expense_claim') )
    {
      //Redirect
      $view_data = array(
                          'form_heading'      => $this->lang->line('Expense_claim_form_heading'),
                          'form_title'        => $this->lang->line('Expense_claim_form_title'),
                          'form_description'  => $this->lang->line('Expense_claim_form_description'),
                          'list_heading'      => $this->lang->line('Expense_claim_form_heading'),
                          'list_title'        => $this->lang->line('Expense_claim_form_title'),
                          'list_description'  => $this->lang->line('Expense_claim_form_description'),
                          'formUrl'           => 'hr/Expense_claims/Expense_claim/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'        => TRUE
                        );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action','Approver status','Employee Name', 'Total Claimed Amount', 'Total Sanctioned Amount', 'Total Amount Reimbursed by');      

      $view_data['dataTableUrl']   =   'hr/Expense_claims/Expense_claim/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Expense_claim_form_heading'),
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

      $expense_dateArr                      = $this->input->post('expense_date');
      $expense_claim_type_idArr             = $this->input->post('expense_claim_type_id');
      $descriptionArr                       = $this->input->post('description');
      $claim_amountArr                      = $this->input->post('claim_amount');
      $sanctioned_amountArr                 = $this->input->post('sanctioned_amount');
      $expense_claim_detail_idArr           = $this->input->post('expense_claim_detail_id');     

      //Checking Form Validation
      $this->form_validation->set_rules('naming_series', lang('label_series'), 'trim|required');
      $this->form_validation->set_rules('employee_id', lang('label_from_employee'), 'trim|required');
      $this->form_validation->set_rules('company_id', lang('label_company'), 'trim|required');
      $this->form_validation->set_rules('expense_claim_status_id', lang('label_status'), 'trim|required');
      $this->form_validation->set_rules('cost_center_id', lang('label_cost_center'), 'trim|required');
      $this->form_validation->set_rules('posting_date', lang('label_posting_date'), 'trim|required');
      $this->form_validation->set_rules('account_id', lang('label_payable_amount'), 'trim|required|numeric');
      //$this->form_validation->set_rules('sanctioned_amount', lang('label_sanctioned'), 'trim|required|numeric');

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('expense_claim_id') == "")
        {
          $naming         = $this->input->post('naming_series');       
          $namingSeries   = $this->mcommon->generateSeries($naming,2);
          $data           = array(
                                'naming_series'                      => $namingSeries,
                                'is_paid'                            => ($this->input->post('is_paid'))?'1':'0',
                                'expense_claim_approval_status_id'   => ($this->input->post('expense_claim_approval_status_id'))?($this->input->post('expense_claim_approval_status_id')): 0, 
                                'user_id'                            => $this->input->post('user_id'),                           
                                'total_claimed_amount'               => $this->input->post('total_claimed_amount'),
                                'total_sanctioned_amount'            => $this->input->post('total_sanctioned_amount'),
                                'posting_date'                       => date('Y-m-d', strtotime($this->input->post('posting_date'))),
                                'employee_id'                        => $this->input->post('employee_id'),
                                'employee_name'                      => $this->input->post('employee_name'),
                                'project_id'                         => $this->input->post('project_id'),
                                'task_id'                            => $this->input->post('task_id'),
                                'total_amount_reimbursed'            => $this->input->post('total_amount_reimbursed'),
                                'remark'                             => $this->input->post('remark'),
                                'company_id'                         => $this->input->post('company_id'),
                                'account_id'                         => $this->input->post('account_id'),
                                'cost_center_id'                     => $this->input->post('cost_center_id'),
                                'expense_claim_status_id'            => $this->input->post('expense_claim_status_id')
                              );

          $result       = $this->mcommon->common_insert('hr_expense_claim', $data);

          $where_array  = array('transaction_id' => 2);

          if($result)
          {
            $resultupdate = $this->mcommon->dataUpdate('set_naming_series', 'current_value', $where_array); 
          }

          foreach ($descriptionArr as $key => $value) 
          {
            $dataDetail         =   array(
                                          'expense_claim_id'        =>  $result,
                                          'expense_date'            =>  date('Y-m-d', strtotime($expense_dateArr[$key])),
                                          'expense_claim_type_id'   =>  $expense_claim_type_idArr[$key],
                                          'description'             =>  $descriptionArr[$key],
                                          'claim_amount'            =>  $claim_amountArr[$key],
                                          'sanctioned_amount'       =>  $sanctioned_amountArr[$key],
                                          );

            $resultDetail       =   $this->mcommon->common_insert('hr_expense_claim_detail', $dataDetail);
          }          

          if($resultupdate)
          {
            $this->session->set_flashdata('msg', 'Saved Successfully');
            $this->session->set_flashdata('alertType', 'success');
            $ajaxResponse['result'] = 'success';
          }
        }
        //Edit function calling
        else
        {
          $data     = array(  
                                'is_paid'                            => ($this->input->post('is_paid'))?'1':'0',
                                'expense_claim_approval_status_id'   => ($this->input->post('expense_claim_approval_status_id'))?($this->input->post('expense_claim_approval_status_id')): 0, 
                                'user_id'                            => $this->input->post('user_id'),                           
                                'total_claimed_amount'               => $this->input->post('total_claimed_amount'),
                                'total_sanctioned_amount'            => $this->input->post('total_sanctioned_amount'),
                                'posting_date'                       => date('Y-m-d', strtotime($this->input->post('posting_date'))),
                                'employee_id'                        => $this->input->post('employee_id'),
                                'employee_name'                      => $this->input->post('employee_name'),
                                'project_id'                         => $this->input->post('project_id'),
                                'task_id'                            => $this->input->post('task_id'),
                                'total_amount_reimbursed'            => $this->input->post('total_amount_reimbursed'),
                                'remark'                             => $this->input->post('remark'),
                                'company_id'                         => $this->input->post('company_id'),
                                'account_id'                         => $this->input->post('account_id'),
                                'cost_center_id'                     => $this->input->post('cost_center_id'),
                                'expense_claim_status_id'            => $this->input->post('expense_claim_status_id') 
                            );
          $where_array  = array('expense_claim_id'  =>$this->input->post('expense_claim_id'));
          $result       = $this->mcommon->common_edit('hr_expense_claim', $data, $where_array);

          foreach ($descriptionArr as $key => $value) 
          {             
            if($expense_claim_detail_idArr[$key] != '')
            {
                $dataDetailUpdate         = array(                                 
                                                  'expense_date'            =>  date('Y-m-d', strtotime($expense_dateArr[$key])),
                                                  'expense_claim_type_id'   =>  $expense_claim_type_idArr[$key],
                                                  'description'             =>  $descriptionArr[$key],
                                                  'claim_amount'            =>  $claim_amountArr[$key],
                                                  'sanctioned_amount'       =>  $sanctioned_amountArr[$key],
                                                );
                $where_array              = array('expense_claim_detail_id'  =>$expense_claim_detail_idArr[$key]);
                $resultDetailUpdate       = $this->mcommon->common_edit('hr_expense_claim_detail', $dataDetailUpdate, $where_array);
            }
            else
            {
              $dataDetail               = array(  
                                                  'expense_claim_id'        =>  $this->input->post('expense_claim_id'),
                                                  'expense_date'            =>  date('Y-m-d', strtotime($expense_dateArr[$key])),
                                                  'expense_claim_type_id'   =>  $expense_claim_type_idArr[$key],
                                                  'description'             =>  $descriptionArr[$key],
                                                  'claim_amount'            =>  $claim_amountArr[$key],
                                                  'sanctioned_amount'       =>  $sanctioned_amountArr[$key],
                                                );

              $resultDetail             = $this->mcommon->common_insert('hr_expense_claim_detail', $dataDetail);
            }
          }

          if($result || $resultDetailUpdate || $resultDetail)
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
        $constraint_array     = array('expense_claim_id'   =>   $pkey_id);
        $Data['tableData']    = $this->mcommon->records_all('hr_expense_claim', $constraint_array);
        $Data['tableData1']   = $this->mcommon->records_all('hr_expense_claim_detail', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']    =  'hr/Expense_claims/Expense_claim/ajaxLoadForm';
      $Data['contentUrl']   =  'hr/Expense_claims/Expense_claim/ajaxTableContentForm ';
      $this->load->view('hr/Expense_claims/form/Expense_claim_form', $Data);
    }
  }

  public function loadamount($value='')
  {
    $claimamount      = $this->input->post('claim_amount');
    $sanctionedamount      = $this->input->post('sanctioned_amount');
    $constraint_array   = array('claim_amount' => $claimamount,
                                'sanctionedamount' => $sanctionedamount);
    $amount      = $this->mcommon->specific_row_value('hr_expense_claim_detail', $constraint_array, 'claim_amount,sanctioned_amount');

    echo $amount;
  } 

  public function delete($expense_claim_id)
  {
    $where_array  = array('expense_claim_id'  =>$expense_claim_id);
    $result      = $this->mcommon->common_delete('hr_expense_claim', $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Expense_claims/Expense_claim/'));
    }
  }

  public function ajaxapproverrejectionDetail($expense_claim_id)
  {
    $isFormLoad = TRUE;

    if($isFormLoad)
    {
      //Get data from table for edit the data
      if($expense_claim_id != '')
      {
        $constraint_array   = array('expense_claim_id'  =>   $expense_claim_id);

        $Data['tableData']          = $this->mcommon->records_all('hr_expense_claim', $constraint_array);
        //$Data['tableDataRejection'] = $this->mcommon->records_all('hr_expense_rejection', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Expense_claims/Expense_claim/ajaxapproverrejectionDetail';
      $this->load->view('hr/Expense_claims/form/ajax_approver_rejection_form', $Data);
    }
  }

  public function datatable()
  {
    $this->datatables->select('p.expense_claim_id, p.expense_claim_approval_status_id, p.employee_name,  p.total_claimed_amount, p.total_sanctioned_amount, p.total_amount_reimbursed')
    ->from('hr_expense_claim AS p')
     ->join('def_hr_expense_claim_approval_status as s', 's.expense_claim_approval_status_id = p.expense_claim_approval_status_id')  
    ->edit_column('p.expense_claim_id', '$1', 'get_ajax_buttons_approver(p.expense_claim_id,hr/Expense_claims/Expense_claim,p.expense_claim_approval_status_id )')
    ->edit_column('p.expense_claim_approval_status_id', '$1', 'get_approver_status(p.expense_claim_approval_status_id)');     
    echo $this->datatables->generate();
  }

  public function ajaxTableContentForm($Data = array())
  {
    $isFormLoad = TRUE;

    if (!empty($_POST)) 
    {
      //This will convert the string to array
      parse_str($_POST['postdata'], $_POST);

      //Checking Form Validation
      
      $this->form_validation->set_rules('description', 'description', 'trim|required');

      if ($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('expense_claim_detail_id') == "")
        {
          $data     = array(
                             'expense_claim_type_id'         => $this->input->post('expense_claim_type_id'),
                             'expense_date'              => date('Y-m-d', strtotime($this->input->post('expense_date'))),
                             //'account_id'                    => $this->input->post('account_id'),
                             'description'                   => $this->input->post('description'),
                             'claim_amount'                  => $this->input->post('claim_amount'),
                             'sanctioned_amount'             => $this->input->post('sanctioned_amount')
                                        
                    );
          $result   = $this->mcommon->common_insert('hr_expense_claim_detail', $data);

          if($result)
          {
            $this->session->set_flashdata('msg', 'Saved Successfully');
            $this->session->set_flashdata('alertType', 'success');
            $ajaxResponse['result'] = 'success';
          }
        }
        else
        {
          $data       = array(
                                'expense_claim_type_id'         => $this->input->post('expense_claim_type_id'),
                                'expense_date'              => date('Y-m-d', strtotime($this->input->post('expense_date'))),
                                //'account_id'                    => $this->input->post('account_id'),
                                'description'                   => $this->input->post('description'),
                                'claim_amount'                  => $this->input->post('claim_amount'),
                                'sanctioned_amount'             => $this->input->post('sanctioned_amount')
                                          
                              );
          $where_array  = array('expense_claim_detail_id'  =>$this->input->post('expense_claim_detail_id')
                       );
          $result     = $this->mcommon->common_edit('hr_expense_claim_detail', $data, $where_array);

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
      if($this->input->get('pkey_id') != '')
      {
        $constraint_array   = array('expense_claim_detail_id' =>   $this->input->get('pkey_id'));
        $Data['tableData']  = $this->mcommon->records_all('hr_expense_claim_detail', $constraint_array);
        //$Data['contentData']  = $this->mcommon->records_all('hr_expense_claim_detail', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Expense_claims/Expense_claim/ajaxTableContentForm';
      $this->load->view('hr/Expense_claims/form/ajax_form/expense_claim_details_form', $Data);
    }
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