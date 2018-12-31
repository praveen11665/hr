<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loan_accounts extends MY_Controller
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
  		if( $this->acl_permits('HR.employee_loan') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Loan_accounts_form_heading'),
								'form_title' 		=> $this->lang->line('Loan_accounts_form_title'),
								'form_description' 	=> $this->lang->line('Loan_accounts_form_description'),
								'list_heading' 		=> $this->lang->line('Loan_accounts_form_heading'),
								'list_title' 		=> $this->lang->line('Loan_accounts_form_title'),
								'list_description' 	=> $this->lang->line('Loan_accounts_form_description'),
								'formUrl' 			=> 'hr/Employee_loan/Loan_accounts/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview' 		=> FALSE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Status', 'Posting Date', 'Employee ID', 'Company', 'Loan Type', 'Loan Amount', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Employee_loan/Loan_accounts/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Loan_accounts_form_heading'),
		                	'content'   =>	$this->load->view('base_template', $view_data,TRUE)
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
			$payment_dateArr 		=	$this->input->post('payment_date');
			$principal_amountArr	=	$this->input->post('principal_amount');
			$interest_amountArr 	=	$this->input->post('interest_amount');
			$total_amountArr 		=	$this->input->post('total_amount');
			$balance_loan_amountArr 	=	$this->input->post('balance_loan_amount');
			//Checking Form Validation			
			$this->form_validation->set_rules('employee_id', lang('label_employee_id'), 'required');	
			$this->form_validation->set_rules('posting_date', lang('label_posting_date'), 'required');
			$this->form_validation->set_rules('loan_type_id', lang('label_loan_type'), 'required');
			$this->form_validation->set_rules('emp_loan_status_id', lang('label_status'), 'required');
			$this->form_validation->set_rules('company_id', lang('label_company'), 'required');
			$this->form_validation->set_rules('loan_amount', lang('label_loan_amount'), 'numeric|required');
			$this->form_validation->set_rules('mode_of_payment_type_id', lang('label_mode_of_payment'), 'required');
			$this->form_validation->set_rules('payment_account', lang('label_payment_account'), 'required');
			$this->form_validation->set_rules('employee_loan_account', lang('label_employee_loan_account'), 'required');
			$this->form_validation->set_rules('interest_income_account', lang('label_interest_income_account'), 'required');

			/*$this->form_validation->set_rules('principal_amount', lang('label_principal_amount'), 'required');
			$this->form_validation->set_rules('interest_amount', lang('label_interest_amount'), 'required');
			$this->form_validation->set_rules('total_amount', lang('label_total_amount'), 'required');
			$this->form_validation->set_rules('balance_loan_amount', lang('label_balance_loan_amount'), 'required');*/

			if($this->form_validation->run() == TRUE) 
			{								
				$data       = array( 
		                        		'employee_id'   					=> $this->input->post('employee_id'),
				                        'employee_name'     				=> $this->input->post('employee_name'),
				                        'employee_loan_application_id' 		=> $this->input->post('employee_loan_application_id'),
				                        'loan_type_id'   		 			=> $this->input->post('loan_type_id'),
				                        'posting_date'   					=> date('Y-m-d',strtotime($this->input->post('posting_date'))),
				                        'emp_loan_status_id'   				=> $this->input->post('emp_loan_status_id'),
				                        'company_id'  						=> $this->input->post('company_id'),
				                        'repay_from_salary'  				=> ($this->input->post('repay_from_salary')) ? '1' : '0',
				               			'loan_amount'   					=> $this->input->post('loan_amount'),
				                        'disbursement_date'   				=> date('Y-m-d',strtotime($this->input->post('disbursement_date'))),
				                        'rate_of_interest'  				=> $this->input->post('rate_of_interest'),
				                        'emp_loan_repayment_method_id'  				=> $this->input->post('emp_loan_repayment_method_id'),
				                        'mode_of_payment_type_id'  					=> $this->input->post('mode_of_payment_type_id'),
				                        'payment_account'  					=> $this->input->post('payment_account'),
				                        'employee_loan_account'  			=> $this->input->post('employee_loan_account'),
				                        'interest_income_account'  			=> $this->input->post('interest_income_account'),
				                        'repayment_amount'  				=> $this->input->post('repayment_amount'),
				                        'repayment_periods'  				=> $this->input->post('repayment_periods'),
				                        'total_payable_amount'  			=> $this->input->post('total_payable_amount'),
				                        'total_payable_interest'  			=> $this->input->post('total_payable_interest'),
				                        'created_on' 						=> date('Y-m-d H:i:s'),
				                        'created_by'						=> $this->auth_user_id
									);												
					
					$this->db->trans_start();
					$result 		=	$this->mcommon->common_insert('hr_employee_loan', $data, $where_array);
					$data1 			= array('updated_on'  => date('Y-m-d H:i:s'));
					$where_array1	= array(
											'employee_loan_application_id'		=> $this->input->post('employee_loan_application_id')
											);
					$result1 		=	$this->mcommon->common_edit('hr_employee_loan_application', $data1, $where_array1);

					/*$data1 	=	array(
											'employee_loan_id'					=> $result,
											//'employee_loan_application_id' 		=> $this->input->post('employee_loan_application_id'),
											'payment_date'   					=> date('Y-m-d',strtotime($this->input->post('payment_date'))),
											'principal_amount'					=> $this->input->post('principal_amount'),
											'interest_amount'					=> $this->input->post('interest_amount'),
											'total_amount'						=> $this->input->post('total_amount'),
											'balance_loan_amount'				=> $this->input->post('balance_loan_amount'),
											'created_by'						=> $this->auth_user_id
										 );

					$result1 	=	$this->mcommon->common_insert('hr_employee_loan_repayment_schedule', $data1);*/


					foreach ($principal_amountArr as $key => $value) 
					{
						$dataPayment 		=	array(
													'employee_loan_id'					=> $result,
													'employee_loan_application_id' 		=> $this->input->post('employee_loan_application_id'),
													'payment_date'   					=> date('Y-m-d', strtotime($payment_dateArr[$key])),
													'principal_amount'					=> $principal_amountArr[$key],
													'interest_amount'					=> $interest_amountArr[$key],
													'total_amount'						=> $total_amountArr[$key],
													'balance_loan_amount'				=> $balance_loan_amountArr[$key],
													'created_by'						=> $this->auth_user_id
												);

						$resultPayment 	=	$this->mcommon->common_insert('hr_employee_loan_repayment_schedule', $dataPayment);
					}

					$data3 							= array('emp_loan_status_id' => $this->input->post('emp_loan_status_id'));
					$employee_loan_application_id 	= 	$this->input->post('employee_loan_application_id');
					$constraint_array 				= 	array('employee_loan_application_id' => $employee_loan_application_id);
					$result3 						= $this->mcommon->common_edit('hr_employee_loan_application', $data3, $constraint_array);
					$this->db->trans_complete();

					if($resultPayment)
					{
						$this->session->set_flashdata('msg', 'Saved Successfully');
						$this->session->set_flashdata('alertType', 'success');
						$ajaxResponse['result'] = 'success';
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
				$constraint_array 	=	array('employee_loan_application_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('hr_employee_loan_application', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']       = 	'hr/Employee_loan/Loan_accounts/ajaxLoadForm';
			$Data['dropdownUrl']     =	'hr/Employee_loan/Loan_accounts/ajaxDropdownPopupForm';
			$Data['dropdownUrlSec']  =  'hr/Employee_loan/Loan_accounts/ajaxDropdownPopupFormSecond';
			$this->load->view('hr/Employee_loan/form/Loan_accounts_form', $Data);
		}
	}

	public function datatable()
    {
        //datatable joining
        $this->datatables ->select('ela.employee_loan_application_id, ela.emp_loan_status_id, ela.posting_date, ela.employee_name, c.company_name, lt.loan_name, ela.loan_amount, ela.updated_on, CONCAT(up.first_name, " ", up.last_name)')
        ->from('hr_employee_loan_application as ela')
        ->where('ela.emp_loan_appliction_status_id', '2')
        ->join('set_company as c', 'c.company_id = ela.company_id')
        ->join('hr_loan_type as lt', 'lt.loan_type_id = ela.loan_type_id')
        ->join('hr_employee as em', 'em.employee_id = ela.employee_id')
        //->join('hr_employee_loan as el', 'el.employee_loan_application_id = ela.employee_loan_application_id')
        //->join('acc_mode_of_payment as mp', 'mp.mode_of_payment_id = el.mode_of_payment_id')
        //->join('acc_account as ac', 'ac.account_id = el.employee_loan_account', 'left')
        ->join('user_profile as up', 'up.user_id = ela.updated_by')
        ->edit_column('ela.employee_loan_application_id', '$1', 'get_ajax_buttons_loanDetail(ela.employee_loan_application_id,hr/Employee_loan/Loan_accounts/,ela.emp_loan_status_id )')
        ->edit_column('ela.emp_loan_status_id', '$1', 'get_loan_approve_status(ela.emp_loan_status_id)')
        //->edit_column('ela.employee_loan_application_id', '$1', 'get_ajax_buttons_approve_loan(ela.employee_loan_application_id,hr/Employee_loan/Loan_accounts/,el.emp_loan_status_id )')
       	//->edit_column('el.emp_loan_status_id', '$1', 'get_loan_approve_status(el.emp_loan_status_id)')
        ->edit_column('ela.updated_on', '$1', 'get_date_timeformat(ela.updated_on)')
        ->edit_column('ela.posting_date', '$1', 'get_date_format(ela.posting_date)');
		$this->db->order_by('ela.updated_on',DESC);
        echo $this->datatables->generate();
    }

	public function employeeLoanDetailsJoin($constraint_array)
	{
		$this->db->select('el.*, lt.loan_name, rp.repayment_method, c.company_name, mop.type');
		$this->db->join('hr_loan_type as lt', 'lt.loan_type_id = el.loan_type_id', 'left');
		$this->db->join('def_hr_emp_loan_repayment_method as rp', 'rp.emp_loan_repayment_method_id = el.emp_loan_repayment_method_id', 'left');
		$this->db->join('set_company as c', 'c.company_id = el.company_id', 'left');
		$this->db->join('def_acc_mode_of_payment_type as mop', 'mop.mode_of_payment_type_id = el.mode_of_payment_type_id');
		$this->db->from('hr_employee_loan as el');
		if(!empty($constraint_array))
		{
			$this->db->where($constraint_array);
		}

		$results = $this->db->get()->result();
		return $results;
	}

	//Load popup for employee loan details
	public function ajaxLoadFormDetailLoan($employee_loan_application_id)
	{
		$isFormLoad = TRUE;

		if($isFormLoad)
		{
			//Get data from table for edit the data
			if($employee_loan_application_id != '')
			{
				$constraint_array 	=	array('employee_loan_application_id' 	=>	 $employee_loan_application_id);
				$Data['tableData']	=	$this->employeeLoanDetailsJoin($constraint_array);
				$Data['tableDataRepayment']	=	$this->mcommon->records_all('hr_employee_loan_repayment_schedule', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Employee_loan/Loan_application/ajaxLoadFormDetailLoan';
			$this->load->view('hr/Employee_loan/form/ajaxLoadDetailLoanform', $Data);
		}
	}
}