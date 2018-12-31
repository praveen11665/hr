<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loan_application extends MY_Controller
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
  		if( $this->acl_permits('HR.employee_loan_application') )
    	{	
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Loan_application_form_heading'),
								'form_title' 		=> $this->lang->line('Loan_application_form_title'),
								'form_description' 	=> $this->lang->line('Loan_application_form_description'),
								'list_heading' 		=> $this->lang->line('Loan_application_form_heading'),
								'list_title' 		=> $this->lang->line('Loan_application_form_title'),
								'list_description' 	=> $this->lang->line('Loan_application_form_description'),
								'formUrl' 			=> 'hr/Employee_loan/Loan_application/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview' 		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Status', 'Employee Name', 'Company', 'Loan type', 'Loan Amount', 'Repayment method', 'Total Interest', 'Total Payable Amount', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Employee_loan/Loan_application/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Loan_application_page_title'),
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

	public function ajaxLoadForm($pkey_id ='')
	{
		$isFormLoad = TRUE;

		if(!empty($_POST))
		{
			//This will convert the string to array
			parse_str($_POST['postdata'], $_POST);

			//Checking Form Validation
			$this->form_validation->set_rules('posting_date', lang('label_posting_date'), 'required');
			$this->form_validation->set_rules('employee_id', lang('label_employee_code'), 'required');
			$this->form_validation->set_rules('employee_name', lang('label_employee_name'), 'required');
			$this->form_validation->set_rules('company_id', lang('label_company_id'), 'required');
			$this->form_validation->set_rules('loan_type_id', lang('label_loan_type'), 'required');
			//$this->form_validation->set_rules('loan_amount', lang('label_loan_amount'), 'required|callback_maximunLoanAmont|numeric');
			$this->form_validation->set_rules('required_by_date', lang('label_required_by_date'), 'required');
			$this->form_validation->set_rules('reason', lang('label_reason'), 'required');
			$this->form_validation->set_rules('emp_loan_repayment_method_id', lang('label_repayment_method'), 'required');
			//$this->form_validation->set_rules('rate_of_interest', lang('label_rate_of_interest'), 'required');
			//$this->form_validation->set_rules('total_payable_interest', lang('label_total_payable_interest'), 'required');
			$this->form_validation->set_rules('repayment_amount', lang('label_Monthly_repayment_amount'), 'required');
			$this->form_validation->set_rules('repayment_periods', lang('label_Repayment_period_in_months'), 'required');
			//$this->form_validation->set_rules('total_payable_amount', lang('label_total_payable_amount'), 'required');
			$this->form_validation->set_rules('posting_date', lang('label_posting_date'), 'required');

			
			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('employee_loan_application_id') == "")
				{
					$naming         = $this->input->post('naming_series');       
          			$namingSeries   = $this->mcommon->generateSeries($naming,98);
					$data       = array( 
				                        'posting_date'   				=> date('Y-m-d', strtotime($this->input->post('posting_date'))),
				               			'employee_id'   				=> $this->input->post('employee_id'),
										'naming_series' 				=> $namingSeries,
				                        'employee_name'     			=> $this->input->post('employee_name'),
				                        'company_id'  					=> $this->input->post('company_id'),
				                        'loan_type_id'   				=> $this->input->post('loan_type_id'),
				               			'loan_amount'   				=> $this->input->post('loan_amount'),
				                        'required_by_date'   			=> date('Y-m-d', strtotime($this->input->post('required_by_date'))),
				                        'reason'  						=> $this->input->post('reason'),
				                        'emp_loan_repayment_method_id'  => $this->input->post('emp_loan_repayment_method_id'),
				                        'rate_of_interest'   			=> $this->input->post('rate_of_interest'),
				               			'total_payable_interest'		=> $this->input->post('total_payable_interest'),
				                        'repayment_amount'   			=> $this->input->post('repayment_amount'),
				                        'repayment_periods'   			=> $this->input->post('repayment_periods'),
				                        'total_payable_amount'  		=> $this->input->post('total_payable_amount'),
				                        'created_on'  					=> date('Y-m-d H:i:s'),
	                            		'created_by'  					=> $this->auth_user_id,
				                        'updated_on'  					=> date('Y-m-d H:i:s'),
	                            		'updated_by'  					=> $this->auth_user_id
									  );
					
					$result 	 = $this->mcommon->common_insert('hr_employee_loan_application', $data);
					$where_array = array('transaction_id' => 98);

			        if($result)
			        {
			            $resultupdate = $this->mcommon->dataUpdate('set_naming_series', 'current_value', $where_array); 
			        }
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
					if($this->input->post('emp_loan_appliction_status_id') == 2)
					{
						$data       = array( 
				                        'posting_date'   				=> date('Y-m-d', strtotime($this->input->post('posting_date'))),
				               			'employee_id'   				=> $this->input->post('employee_id'),
				                        'employee_name'     			=> $this->input->post('employee_name'),
				                        'emp_loan_appliction_status_id'	=> $this->input->post('emp_loan_appliction_status_id'),
				                        'company_id'  					=> $this->input->post('company_id'),
				                        'loan_type_id'   				=> $this->input->post('loan_type_id'),
				               			'loan_amount'   				=> $this->input->post('loan_amount'),
				                        'required_by_date'   			=> date('Y-m-d', strtotime($this->input->post('required_by_date'))),
				                        'reason'  						=> $this->input->post('reason'),
				                        'emp_loan_repayment_method_id'  => $this->input->post('emp_loan_repayment_method_id'),
				                        'rate_of_interest'   			=> $this->input->post('rate_of_interest'),
				               			'total_payable_interest'		=> $this->input->post('total_payable_interest'),
				                        'repayment_amount'   			=> $this->input->post('repayment_amount'),
				                        'repayment_periods'   			=> $this->input->post('repayment_periods'),
				                        'total_payable_amount'  		=> $this->input->post('total_payable_amount'),
				                        'updated_on'  					=> date('Y-m-d H:i:s'),
				                        'updated_by'  					=> $this->auth_user_id		
									   );
												
						$where_array =	array('employee_loan_application_id'  =>$this->input->post('employee_loan_application_id'));
						$result 	 =	$this->mcommon->common_edit('hr_employee_loan_application', $data, $where_array);

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
					else
					{
						$data 	= array(
										'employee_loan_application_id' 		=> $this->input->post('employee_loan_application_id'),
										'employee_id'   					=> $this->input->post('employee_id'),
										'rejected_by'						=> $this->auth_user_id,
										'rejection_remarks' 				=> $this->input->post('rejection_remarks')
										);
						$where_array =	array('employee_loan_application_id'  =>$this->input->post('employee_loan_application_id'));
						$result 	 =	$this->mcommon->common_insert('hr_emp_loan_application_rejection', $data, $where_array);


						$data       = array( 
				                        'posting_date'   				=> date('Y-m-d', strtotime($this->input->post('posting_date'))),
				               			'employee_id'   				=> $this->input->post('employee_id'),
				                        'employee_name'     			=> $this->input->post('employee_name'),
				                        'emp_loan_appliction_status_id'	=> $this->input->post('emp_loan_appliction_status_id'),
				                        'company_id'  					=> $this->input->post('company_id'),
				                        'loan_type_id'   				=> $this->input->post('loan_type_id'),
				               			'loan_amount'   				=> $this->input->post('loan_amount'),
				                        'required_by_date'   			=> date('Y-m-d', strtotime($this->input->post('required_by_date'))),
				                        'reason'  						=> $this->input->post('reason'),
				                        'emp_loan_repayment_method_id'  => $this->input->post('emp_loan_repayment_method_id'),
				                        'rate_of_interest'   			=> $this->input->post('rate_of_interest'),
				               			'total_payable_interest'		=> $this->input->post('total_payable_interest'),
				                        'repayment_amount'   			=> $this->input->post('repayment_amount'),
				                        'repayment_periods'   			=> $this->input->post('repayment_periods'),
				                        'total_payable_amount'  		=> $this->input->post('total_payable_amount'),
	                            		'updated_by'  					=> $this->auth_user_id		
									   );
												
						$where_array =	array('employee_loan_application_id'  =>$this->input->post('employee_loan_application_id'));
						$result 	 =	$this->mcommon->common_edit('hr_employee_loan_application', $data, $where_array);

						if($result)
						{
							$this->session->set_flashdata('msg', 'Updated Successfully');
							$this->session->set_flashdata('alertType', 'success');
							$ajaxResponse['result'] = 'success';
						}
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
				$constraint_array 	=	array('employee_loan_application_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('hr_employee_loan_application', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Employee_loan/Loan_application/ajaxLoadForm';
			$Data['LoanTypeUrl'] =  'hr/Employee_loan/Loan_type/ajaxLoadForm';
			$Data['namingUrl']   = 	'setting/Master_settings/Naming_series/ajaxLoadForm';
			$this->load->view('hr/Employee_loan/form/Loan_application_form', $Data);
		}
	}

	public function datatable()
    {
        //datatable joining
        $this->datatables ->select('ela.employee_loan_application_id, ela.emp_loan_appliction_status_id, ela.employee_name, sc.company_name, hlt.loan_name, ela.loan_amount, elrm.repayment_method, ela.total_payable_interest, ela.total_payable_amount, ela.updated_on, CONCAT(up.first_name, " ", up.last_name)');
        $this->datatables ->from('hr_employee_loan_application as ela');
        $this->datatables ->join('user_profile as up', 'up.user_id = ela.updated_by');
        $this->datatables ->join('set_company as sc', 'sc.company_id = ela.company_id');
        //$this->datatables ->join('def_hr_emp_loan_appliction_status as elas', 'elas.emp_loan_appliction_status_id = ela.emp_loan_appliction_status_id');
        $this->datatables ->join('hr_loan_type as hlt', 'hlt.loan_type_id = ela.loan_type_id');
        $this->datatables ->join('def_hr_emp_loan_repayment_method as elrm', 'elrm.emp_loan_repayment_method_id = ela.emp_loan_repayment_method_id');
        //$this->datatables ->edit_column('ela.employee_loan_application_id', '$1', 'get_buttons(ela.employee_loan_application_id, "hr/Employee_loan/Loan_application/")'); 
        $this->datatables->edit_column('ela.employee_loan_application_id', '$1', 'get_ajax_buttons_loan(ela.employee_loan_application_id,hr/Employee_loan/Loan_application/,ela.emp_loan_appliction_status_id )');
        $this->datatables->edit_column('ela.emp_loan_appliction_status_id', '$1', 'get_loan_status(ela.emp_loan_appliction_status_id)');
        $this->datatables->edit_column('ela.updated_on', '$1', 'get_date_timeformat(ela.updated_on)');
		$this->db->order_by('ela.updated_on',DESC);
        //$this->datatables->edit_column('ela.employee_loan_application_id', get_ajax_buttons_loan('$1', 'hr/Employee_loan/Loan_application/'), 'ela.employee_loan_application_id');	    

        echo $this->datatables->generate();
    }

    //Load employee name from employee code
    public function getemployeename($value='')
	{
		$employee_id        = $this->input->post('employee_id');
		$constraint_array   = array('employee_id' => $employee_id);
		$result      = $this->mcommon->records_all('hr_employee', $constraint_array);

		foreach ($result as $row)
		{
			$employeeData['employee_name'] = $row->employee_name;
			$employeeData['company_id']	   = $row->company_id;
		}

		echo json_encode($employeeData);
	} 

	//Load loan details from loan type
	public function loadLoanDetails()
	{
		$loan_type_id     = $this->input->post('loan_type_id');
		$constraint_array = array('loan_type_id' => $loan_type_id);  
		$resultData       = $this->mcommon->records_all('hr_loan_type', $constraint_array);

		foreach ($resultData as $row) 
		{
			$loanData   = $row;
		}
		echo json_encode($loanData);
	}

	// Validation for maximum loan cannot axceeds prescribed loan amount
	public function maximunLoanAmont()
	{
		$loan_amount 			= $this->input->get('maximum_loan_amount');
		$loan_type_id 			= $this->input->get('loan_type_id');
		//$loan_amount 			= $this->input->post('loan_amount');
		//$loan_type_id     		= $this->input->post('loan_type_id');
		$constraint_array		= array('loan_type_id' => $loan_type_id); 
		$maximum_loan_amount 	= $this->mcommon->specific_row_value('hr_loan_type', $constraint_array, 'maximum_loan_amount');

		if($loan_amount > $maximum_loan_amount)
		{
			$ajaxResponse['result'] = 'false';
		}
		else
		{
			$ajaxResponse['result'] = 'success';
		}
		echo json_encode($ajaxResponse);
	}

	//Join function for load details of employee loan
	public function employeeLoanJoin($constraint_array)
	{
		$this->db->select('ela.*, c.company_name, lt.loan_name,rp.repayment_method');
		$this->db->join('hr_loan_type as lt', 'lt.loan_type_id = ela.loan_type_id', 'left');
		$this->db->join('set_company as c', 'c.company_id = ela.company_id', 'left');
		$this->db->join('def_hr_emp_loan_repayment_method as rp', 'rp.emp_loan_repayment_method_id = ela.emp_loan_repayment_method_id', 'left');
		//$this->db->join('hr_emp_loan_application_rejection as er', 'er.employee_loan_application_id = ela.employee_loan_application_id');
		$this->db->from('hr_employee_loan_application as ela');
		if(!empty($constraint_array))
		{
			$this->db->where($constraint_array);
		}

		$results = $this->db->get()->result();
		return $results;
	}

	//Load popup for employee loan details
	public function ajaxLoadFormDetail($employee_loan_application_id ='')
	{
		$isFormLoad = TRUE;

		if($isFormLoad)
		{
			//Get data from table for edit the data
			if($employee_loan_application_id != '')
			{
				$constraint_array 	=	array('employee_loan_application_id' 	=>	 $employee_loan_application_id);
				$Data['tableData']	=	$this->employeeLoanJoin($constraint_array);

				$Data['tableDataRejection']	=	$this->mcommon->records_all('hr_emp_loan_application_rejection', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Employee_loan/Loan_application/ajaxLoadFormDetail';
			$this->load->view('hr/Employee_loan/form/ajaxLoadDetailform', $Data);
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

	public function schduleEmiCalculation()
	{
		$viewData['loanAmount'] = '20000';
		$viewData['interest']   = '5';
		$viewData['periods']    = '12';
		
		$this->load->view('hr/Employee_loan/form/schdule_emi_form', $viewData);
	}	
}