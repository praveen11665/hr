<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Salary_slip extends MY_Controller
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
		$this->load->library("form_validation");
		$this->load->library('session'); 
		$this->multi_menu->set_items($items);
		$this->lang->load("hr","english");
	}

	public function index($Data=array())
  	{
  		if( $this->acl_permits('HR.salary_slip') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Salary_slip_form_heading'),
								'form_title' 		=> $this->lang->line('Salary_slip_form_title'),
								//'form_description' 	=> $this->lang->line('Salary_slip_form_description'),
								//'list_heading' 		=> $this->lang->line('Salary_slip_form_heading'),
								//'list_title' 		=> $this->lang->line('Salary_slip_form_title'),
								'list_description' 	=> $this->lang->line('Salary_slip_form_description'),
								'formUrl' 			=> 'hr/Payroll/Salary_slip/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview'		=> TRUE,
								'addNewAsLink'		=> 1
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 		 
			$this->table->set_heading('Action','Employee Name', 'From Date', 'To date', 'Status', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Payroll/Salary_slip/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Salary_slip_form_heading'),
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

	public function ajaxLoadForm($Data = array())
  	{
	    $isFormLoad = TRUE;

	    if(!empty($_POST))
	    {	    	
	      	$EarningsalarydArr 							= 	$this->input->post('salary_slip_earning_id'); 
	      	$EarningsalarycomponentidArr 				= 	$this->input->post('salary_component_id_earing'); 
			$EarningabbrArr 							= 	$this->input->post('abbr_earing');  
			$EarningformulaArr 							= 	$this->input->post('formula_earing');  
			$EarningamountArr 							= 	$this->input->post('amount_earing');
			$EarningstatisticalcomponentArr 			= 	$this->input->post('statistical_component_earing');
			
			$DeductionsalaryArr 						= 	$this->input->post('salary_slip_deduction_id');  
			$DeductionsalarycomponentidArr 				= 	$this->input->post('salary_component_id_deduction');  
			$DeductionabbrArr 							= 	$this->input->post('abbr_deduction');  
			$DeductionformulaArr 						= 	$this->input->post('formula_deduction');  
			$DeductionamountArr 						= 	$this->input->post('amount_deduction');
			$DeductionstatisticalcomponentArr 			= 	$this->input->post('statistical_component_deduction');

			//$Base 										= 	$this->input->post('base');
			$Base 										= 	$this->input->post('base_salary');
			$total_working_days 						= 	$this->input->post('total_working_days');
			$payment_days 								= 	$this->input->post('payment_days');
			$salary_structure_id						=	$this->input->post('salary_structure_id');
			$hour_rate 									= 	$this->input->post('hour_rate');
		  	$total_working_hours 						= 	$this->input->post('total_working_hours');
        	$hour_amount              					=   ($hour_rate*$total_working_hours);

			$daySalary  = $Base/$total_working_days;
			if($hour_rate != '')
  			{
	  			$totalBase  = $Base;
  			}else
  			{
	  			$totalBase  = ($daySalary*$payment_days);
  			}

  			$salaryData = array('base' => $totalBase);
	    	
	    	foreach ($EarningformulaArr as $key => $value) 
	    	{	    		
		    	$calculatedAmountEar[]	= 	eval('return '. strtr($EarningformulaArr[$key], $salaryData).';');
	    	}

			foreach ($calculatedAmountEar as $key => $value) 
			{
				$totalEarnings1   	+=	$calculatedAmountEar[$key];
			}
			
			$totalEarnings = ($totalEarnings1 +$hour_amount);
    		// Calculation for total deduction
	    	foreach ($DeductionformulaArr as $key => $value) 
	    	{
	    		$calculatedAmountDed[] 	= 	eval('return '. strtr($DeductionformulaArr[$key], $salaryData).';');
	    	}
	    	foreach ($calculatedAmountDed as $key => $value) 
			{
				$totalDeduction  				   +=	$calculatedAmountDed[$key];
			}
			$net_total = $totalEarnings - $totalDeduction;

	      	//Checking Form Validation
	        $this->form_validation->set_rules('posting_date', 'posting_date', 'required');
	        $this->form_validation->set_rules('employee_id', 'employee_id', 'required');
	        $this->form_validation->set_rules('bank_name', 'label_employee_bank_name', 'required');
	        $this->form_validation->set_rules('bank_account_no','label_employee_bank_account_number', 'required');
	        $this->form_validation->set_rules('naming_series','label_series', 'required');
	        $this->form_validation->set_rules('salary_slip_status_id','label_status', 'required');
	        $this->form_validation->set_rules('salary_structure_id','label_is_salary_structure', 'required');
	        $this->form_validation->set_rules('start_date','label_start_date', 'required');
	        $this->form_validation->set_rules('end_date','label_end_date', 'required');
	        $this->form_validation->set_rules('payroll_frequency_id', 'label_payroll_frequency', 'required');
		  			
	        if($this->form_validation->run() == TRUE)
	        {
	            if($this->input->post('salary_slip_id') == "")
	            {
	            	$naming         = $this->input->post('naming_series');       
          			$namingSeries   = $this->mcommon->generateSeries($naming,185);
	             	//insert function without id  
	              	$data   = array(
								'naming_series' 		=> $namingSeries,
                                'posting_date'   		=> date('Y-m-d', strtotime($this->input->post('posting_date'))),
                                'employee_id'    	    => $this->input->post('employee_id'),    
                                'employee_name'         => $this->input->post('employee_name'),
                                'designation'           => $this->input->post('designation'),
                                'department'            =>  $this->input->post('department'),
                                'branch' 		     	=> $this->input->post('branch'),
                                'company'               => $this->input->post('company'),
                                'base'               	=> $Base,
                                'letter_head_id' 		=> $this->input->post('letter_head_id'),
                                'start_date'   			=> date('Y-m-d', strtotime($this->input->post('start_date'))),
                                'end_date'   			=> date('Y-m-d', strtotime($this->input->post('end_date'))),
                                'payroll_frequency_id'  => $this->input->post('payroll_frequency_id'),
                                'salary_slip_status_id' => $this->input->post('salary_slip_status_id'),
                                'salary_structure_id'   => $salary_structure_id,
                                'total_working_hours'   => $total_working_hours,
                                'hour_rate'   			=> $hour_rate,
                                'total_working_days'    => $total_working_days,
                                'leave_without_pay' 	=> $this->input->post('leave_without_pay'),
                                'bank_name' 			=> $this->input->post('bank_name'),
                                'bank_account_no' 		=> $this->input->post('bank_account_no'),
                                'payment_days' 		   	=> $this->input->post('payment_days'),
                                'total_holidays'		=> $this->input->post('total_holidays'),
                                'gross_pay' 		   	=> $this->input->post('gross_pay'),
                                'total_deduction' 		=> $this->input->post('total_deduction'),
                                'net_pay' 		   		=> $this->input->post('net_pay'),
                                'rounded_total' 		=> $this->input->post('rounded_total'),
                                'allowed_leaves'		=> $this->input->post('allowed_leaves'),
                                'lop'					=> $this->input->post('lop'),
                                'lop_amount'			=> $this->input->post('lop_amount'),
                                'created_on'    		=> date('Y-m-d H:i:s'),
                                'updated_on'    		=> date('Y-m-d H:i:s'),
								'updated_by'		    => $this->auth_user_id,
								'created_by'    		=> $this->auth_user_id,
                                'salary_slip_based_on_timesheet' => ($this->input->post('salary_slip_based_on_timesheet'))? '1' : '0',
	                             );           
	              	$result = $this->mcommon->common_insert('hr_salary_slip',$data); 
	              	$where_array  	= array('transaction_id' => 185);

			        if($result)
			        {
			            $resultupdate = $this->mcommon->dataUpdate('set_naming_series', 'current_value', $where_array); 
			        }

	          		foreach ($EarningsalarycomponentidArr as $key => $value) 
	              	{
		              	$data2 		= array(
				              					'salary_slip_id' 					=> 	$result,
				              					'salary_structure_id' 				=> 	$salary_structure_id,
				              					'salary_component_id'				=> 	$EarningsalarycomponentidArr[$key],
				              					'abbr'								=>	$EarningabbrArr[$key],
				              					'statistical_component' 			=>  ($EarningstatisticalcomponentArr[$key]) ? '1' : '0', 
				              					'formula' 							=>	$EarningformulaArr[$key],
				              					);
          				if($EarningformulaArr[$key] != '')
          				{          					    
          					$data2['amount']    =   ($calculatedAmountEar[$key]) ? $calculatedAmountEar[$key] : '0';      					
          				}else
          				{
          					$data2['amount']    =   ($EarningamountArr[$key]) ? $EarningamountArr[$key] : '0';
          				}	
		              	$result2    = $this->mcommon->common_insert('hr_salary_slip_earning', $data2);
		            }
		            foreach ($DeductionsalarycomponentidArr as $key => $value) 
	              	{
		              	$data3 		= array(
			              					'salary_slip_id' 					=> 	$result,
			              					'salary_structure_id' 				=> 	$salary_structure_id,
			              					'salary_component_id'				=> 	$DeductionsalarycomponentidArr[$key],
			              					'abbr'								=>	$DeductionabbrArr[$key],
			              					'statistical_component' 			=>  ($DeductionstatisticalcomponentArr[$key]) ? '1' : '0', 
			              					'formula' 							=>	$DeductionformulaArr[$key],
			              					'amount' 							=>	($calculatedAmountDed[$key]) ? $calculatedAmountDed[$key] : '0', 
		              						);
		              	$result3    = $this->mcommon->common_insert('hr_salary_slip_deduction', $data3);
		            }			           

	              	if($result3)
	                {
			            $this->session->set_flashdata('msg', 'Saved Successfully');
			            $this->session->set_flashdata('alertType', 'success');
			            redirect(base_url('hr/Payroll/Salary_slip/'));
			            //$ajaxResponse['result'] = 'success';
			        }
        		}        		
         		else //Edit function calling
	            {	
	                $data   = array(
		                                'posting_date'   		=> date('Y-m-d', strtotime($this->input->post('posting_date'))),
		                                'employee_id'    	    => $this->input->post('employee_id'),    
		                                'employee_name'         => $this->input->post('employee_name'),
		                                'designation'           => $this->input->post('designation'),
		                                'department'            => $this->input->post('department'),
		                                'branch' 		     	=> $this->input->post('branch'),
		                                'company'               => $this->input->post('company'),
		                                'letter_head_id' 		=> $this->input->post('letter_head_id'),
		                                'start_date'   			=> date('Y-m-d', strtotime($this->input->post('start_date'))),
		                                'end_date'   			=> date('Y-m-d', strtotime($this->input->post('end_date'))),
		                                'payroll_frequency_id'  => $this->input->post('payroll_frequency_id'),
		                                'salary_slip_status_id' => $this->input->post('salary_slip_status_id'),
		                                'salary_structure_id'   => $this->input->post('salary_structure_id'),
		                                'total_working_days'    => $this->input->post('total_working_days'),
		                                'leave_without_pay' 	=> $this->input->post('leave_without_pay'),
		                                'bank_name' 			=> $this->input->post('bank_name'),
		                                'bank_account_no' 		=> $this->input->post('bank_account_no'),
		                                'payment_days' 		   	=> $this->input->post('payment_days'),
                                		'total_holidays'		=> $this->input->post('total_holidays'),
		                                'gross_pay' 		   	=> $this->input->post('gross_pay'),
		                                'total_deduction' 		=> $this->input->post('total_deduction'),
		                                'net_pay' 		   		=> $this->input->post('net_pay'),
		                                'rounded_total' 		=> $this->input->post('rounded_total'),
		                                'allowed_leaves'		=> $this->input->post('allowed_leaves'),
		                                'lop'					=> $this->input->post('lop'),
		                                'lop_amount'			=> $this->input->post('lop_amount'),
                                		'updated_on'    		=> date('Y-m-d H:i:s'),
										'updated_by'		    => $this->auth_user_id
	                                ); 

	              	$where_array = array('salary_slip_id' => $this->input->post('salary_slip_id'));	
	              	$result      = $this->mcommon->common_edit('hr_salary_slip', $data, $where_array);

	              	foreach ($EarningsalarycomponentidArr as $key => $value) 
	              	{
		              	$data2 		= array(
				              					'salary_structure_id' 				=> 	$salary_structure_id,
				              					'salary_component_id'				=> 	$EarningsalarycomponentidArr[$key],
				              					'salary_structure_id' 				=> 	$salary_structure_id,
				              					'abbr'								=>	$EarningabbrArr[$key],
				              					'statistical_component' 			=>  ($EarningstatisticalcomponentArr[$key]) ? '1' : '0', 
				              					'formula' 							=>	$EarningformulaArr[$key],
				              					'amount' 							=>	$calculatedAmountEar[$key],	
		              						);
		              if($EarningsalarydArr[$key] != '')
		              {
	              			$where_arrayArr = array('salary_slip_earning_id' => $EarningsalarydArr[$key]);
			              	$result2    	= $this->mcommon->common_edit('hr_salary_slip_earning', $data2, $where_arrayArr);
		              }else
		              {
		              	$data2 		= array(
			              					'salary_slip_id' 					=> 	$this->input->post('salary_slip_id'),
			              					'salary_structure_id' 				=> 	$salary_structure_id,
			              					'salary_component_id'				=> 	$EarningsalarycomponentidArr[$key],
			              					'abbr'								=>	$EarningabbrArr[$key],
			              					'statistical_component' 			=>  ($EarningstatisticalcomponentArr[$key]) ? '1' : '0', 
			              					'formula' 							=>	$EarningformulaArr[$key],
			              					'amount' 							=>	($calculatedAmountEar[$key]) ? $calculatedAmountEar[$key] : '0',	              					
		              						);
		              	$result2    = $this->mcommon->common_insert('hr_salary_slip_earning', $data2);
		              }
		            }
		            
		            foreach ($DeductionsalarycomponentidArr as $key => $value) 
	              	{
		              	$data3 		= array(
			              					'salary_component_id'				=> 	$DeductionsalarycomponentidArr[$key],
			              					'salary_structure_id' 				=> 	$salary_structure_id,
			              					'abbr'								=>	$DeductionabbrArr[$key],
			              					'statistical_component' 			=>  ($DeductionstatisticalcomponentArr[$key]) ? '1' : '0', 
			              					'formula' 							=>	$DeductionformulaArr[$key],
			              					'amount' 							=>	($calculatedAmountDed[$key]) ? $calculatedAmountDed[$key] : '0',	              					
		              						);

			             if($DeductionsalaryArr[$key] != '')
			             {
			             	$where_arrayArr1 = array('salary_slip_deduction_id' => $DeductionsalaryArr[$key]);
			              	$result3    	 = $this->mcommon->common_edit('hr_salary_slip_deduction', $data3,$where_arrayArr1);
			             }
			             else
			             {
			             	$data3 		= array(
			              					'salary_slip_id' 					=> 	$this->input->post('salary_slip_id'),
			              					'salary_structure_id' 				=> 	$salary_structure_id,
			              					'salary_component_id'				=> 	$DeductionsalarycomponentidArr[$key],
			              					'abbr'								=>	$DeductionabbrArr[$key],
			              					'statistical_component' 			=>  ($DeductionstatisticalcomponentArr[$key]) ? '1' : '0', 
			              					'formula' 							=>	$DeductionformulaArr[$key],
			              					'amount' 							=>	($calculatedAmountDed[$key]) ? $calculatedAmountDed[$key] : '0',	              					
		              						);
			              	$result3    = $this->mcommon->common_insert('hr_salary_slip_deduction', $data3);
			             }
		            }

					if($result)
					{
						$this->session->set_flashdata('msg', 'Updated Successfully');
						$this->session->set_flashdata('alertType', 'success');
			            redirect(base_url('hr/Payroll/Salary_slip/'));
					}
					else
					{
						$this->session->set_flashdata('msg', 'No data has been changed');
						$this->session->set_flashdata('alertType', 'danger');
			            redirect(base_url('hr/Payroll/Salary_slip/'));
					}
        		}
		        $isFormLoad = FALSE;
	     	} 
	    }

	    if($isFormLoad)
	    {
	      	//Get data from table for edit the data
	     	//Ajax Form Load
	     	$Data['ActionUrl']   	=  'hr/Payroll/Salary_slip/ajaxLoadForm';
	     	$view_data          	= array(
										'form_heading'            => $this->lang->line('Salary_slip_form_title'),
										//'form_title'              => $this->lang->line('Salary_slip_form_title'),
										//'detail_form_title'       => $this->lang->line('Salary_slip_form_title'),
										//'detail_form_description' => $this->lang->line('Salary_slip_form_description'),
										//'list_title'              => $this->lang->line('Salary_slip_form_title'),
										//'list_description'        => $this->lang->line('Salary_slip_form_description'),
										);		
			
			$view_data['form_view']	= $this->load->view('hr/Payroll/form/Salary_slip_form',$Data,TRUE);
			$data 					= array(
		            	    				'title'     => 	'MEP - '.$this->lang->line('Salary_slip_form_heading'),
											'content'   =>  $this->load->view('base_template', $view_data,TRUE)
											);
			$this->load->view($this->dbvars->app_template, $data);
	    }
  	}

  	public function edit($salary_slip_id='')
	{
		$constraint_array   		= array('salary_slip_id'   =>   $salary_slip_id);
		$Data['tableData']  		= $this->mcommon->records_all('hr_salary_slip', $constraint_array);
		$Data['EarningData']		= $this->mcommon->records_all('hr_salary_slip_earning', $constraint_array,'');
		$Data['DeductionData']		= $this->mcommon->records_all('hr_salary_slip_deduction', $constraint_array,'');
		$Data['ActionUrl']   		= 'hr/Payroll/Salary_slip/ajaxLoadForm';			
        $view_data     				= array('form_heading'            => $this->lang->line('Salary_slip_form_title'));
		
		$view_data['form_view']		= $this->load->view('hr/Payroll/form/Salary_slip_form',$Data,TRUE);
		$template_view 				= array(
												'title'     => 	'MEP - '.$this->lang->line('Salary_slip_form_heading'),
												'content'   =>  $this->load->view('base_template', $view_data,TRUE)
										 	);
		$this->load->view($this->dbvars->app_template, $template_view);
	}

  	public function calculateSalary($timehourrate = '')
	{
        $hour_amount            =  ($hour_rate*$total_working_hours);
		$hour_rate 				= 	$this->input->post('hour_rate');
		$total_working_hours 	= 	$this->input->post('total_working_hours');
		$employee_id  			= 	$this->input->post('employee_id');

		$startDate    			= new DateTime(date('Y-m-d', strtotime($this->input->post('from_date'))));
    	$endDate      			= new DateTime(date('Y-m-d', strtotime($this->input->post('to_date'))));
		$totalDays 	  			= ($endDate->diff($startDate)->format("%a"))+1;
	
    	$DateArr  	  = array();
	    while ($startDate <= $endDate) 
	    {
	        $DateArr[]  = $startDate->format('Y-m-d');
	        $startDate->modify('+1 day');
	    }	      	

	    //Employee Attence Calculations
	    foreach ($DateArr as $row => $value)
    	{
			$constraint_array    = array('attendance_date' =>$value, 'employee_id' => $employee_id);
			$attStatus[]         = $this->mcommon->specific_row_value('hr_employee_attendance', $constraint_array,'employee_attendance_status_id');
    	}

    	//Calculate Leave Allocation for Employee
    	$allocationData  = $this->mcommon->records_all('hr_leave_allocation', array('employee_id' => $employee_id)); 
    	$allocationDates = array();

    	foreach ($allocationData as $row) 
    	{
    		$allocationDates[] = date_range($row->from_date, $row->to_date);
    	}

    	$allocationResult 	  = array();
		foreach ($allocationDates as $array) {
		    $allocationResult = array_unique(array_merge($allocationResult, $array));
		}
    	
		foreach ($allocationResult as $allKey => $allDates) 
		{
			foreach ($DateArr as $dateKey => $selectDate)
    		{				

				if ($selectDate == $allDates)
				{
					$allowedLeaves[]    = $selectDate;
					$allowedLeavesCount += count($selectDate);
				}
			}
		}    	

        $count = array_count_values($attStatus);	
		$employeeWorkingdays['present'] 		= $count[1];
		$employeeWorkingdays['absent']  		= $count[2];
		$employeeWorkingdays['on_leave']  	    = $count[3];
		$employeeWorkingdays['half_day']  	    = $count[4];
		$halfDayWorking  	    				= $count[4] * '0.5';

		//Holiday Days calculations
    	foreach ($DateArr as $row => $date)
    	{
			$holidaylist          	=   $this->mcommon->specific_row_value('hr_emp_employment_details', array('employee_id' => $employee_id),'holiday_list_id');
			$holidaylistArr  		= explode(",", $holidaylist);

			foreach ($holidaylistArr as $holidayKey => $holiday_list_id) 
			{
				$constraint_array  		=   array('holiday_date' =>$date, 'holiday_list_id' => $holiday_list_id, 'is_delete' => '0');
				$attDate[]          	=   $this->mcommon->specific_row_value('hr_holiday_list_holiday', $constraint_array, 'holiday_date');
			}
    	}		 

    	$result 			= array_count_values($attDate);
    	$holidays  			= array_sum($result);
    	$total_working_days = $totalDays - $holidays;
    	$on_leave          	= $employeeWorkingdays['on_leave'];
    	$absent 			= $employeeWorkingdays['absent'] + $halfDayWorking;
    	$payment_days 		= ($employeeWorkingdays['present'] + $on_leave) + $halfDayWorking;   

    	$fields             =     array(
    									"sem.salary_structure_id,GROUP_CONCAT(DISTINCT he.abbr) as earning_abbr ,
    									GROUP_CONCAT(DISTINCT hd.abbr) as deduction_abbr, GROUP_CONCAT(DISTINCT he.formula) as earning_formula, GROUP_CONCAT(DISTINCT hd.formula) as deduction_formula, 
    									sem.base, sem.from_date, 
    									sem.to_date,GROUP_CONCAT(DISTINCT he.salary_component_id) as earning_salary_component, 
    									GROUP_CONCAT(DISTINCT hd.salary_component_id) as deduction_salary_component",FALSE);
         $joinArr           =    array(                                          
                                        'hr_employee_attendance as eatt'     =>     'eatt.employee_id = sem.employee_id',
                                        'hr_salary_structure as st'          =>     'st.salary_structure_id = sem.salary_structure_id',
                                                                                    
                                        'hr_earning as he'                   =>     'he.salary_structure_id = st.salary_structure_id',
                                        'hr_deduction as hd'                 =>     'hd.salary_structure_id = st.salary_structure_id',                                            
                                      );
  		$constraint_array 	=	array('sem.employee_id' => $employee_id);
  		$group_by 			=	array('eatt.employee_id');
  		$employeeData 		= 	$this->mcommon->join_records_all($fields, 'hr_salary_structure_select_employee as sem', $joinArr, $constraint_array ,$group_by);
	
  		$employeeWorkingdays 	= array();

  		//Earning and deduction Calculations
  		foreach ($employeeData->result() as $row) 
  		{
  			$earning_abbr									=	explode(',',$row->earning_abbr);
  			$earning_formula								=	explode(',',$row->earning_formula);
  			$deduction_abbr									=	explode(',',$row->deduction_abbr);
  			$deduction_formula								=	explode(',',$row->deduction_formula);
  			$earning_salary_component 						= 	explode(',',$row->earning_salary_component);
  			$deduction_salary_component 					= 	explode(',',$row->deduction_salary_component);
  			$employeeDataArrEaring 							= 	array_combine($earning_abbr, $earning_formula);	
  			$employeeDataArrDeduction						= 	array_combine($deduction_abbr, $deduction_formula);
  			$employeeWorkingdays['base']   					= 	$row->base;
  			$salaryData1    								= 	array('base' => $row->base);

  			foreach ($earning_abbr as $key => $value) 
	    	{
	    		$employeeWorkingdays['salary_component_abbr_ear'] 	    =  $value;	    		
	    	}

  			foreach ($earning_formula as $key => $value) 
	    	{
	    		$employeeWorkingdays['salary_component_formula_ear']    =  $value;	    		
	    	}

  			// Calculation for total earnings
  			$calculatedAmount  = array();
  			$totalEarnings     = 0;
  			
  			$daySalary  	= $salaryData1['base']/$total_working_days;
  			
  			if($hour_amount != '')
  			{
	  			$totalBase  = $salaryData1['base']	;

  			}else
  			{
	  			$totalBase  = ($daySalary*$payment_days);
  			}	  			

	  		$salaryData = array('base' =>$totalBase);

	    	foreach ($employeeDataArrEaring as $earning_abbr => $earning_formula) 
	    	{	    		
	    		$calculatedAmount[$earning_abbr]	= 	eval('return '. strtr($earning_formula, $salaryData).';');
	    		$totalEarnings   				   +=	$calculatedAmount[$earning_abbr];
	    	}
	    	$employeeWorkingdays['totalEarnings']  	= 	ceil($totalEarnings+$hour_amount);

	    	// Calculation for total deduction
  			$totalDeduction   = 0;
	    	foreach ($employeeDataArrDeduction as $deduction_abbr => $deduction_formula) 
	    	{
	    		
	    		$calculatedAmount[$deduction_abbr] 	= 	eval('return '. strtr($deduction_formula, $salaryData).';');

	    		$totalDeduction                    +=	$calculatedAmount[$deduction_abbr];
	    	}

	    	$employeeWorkingdays['totalDeduction']  	= 	ceil($totalDeduction);

	    	foreach ($earning_salary_component as $key => $value) 
	    	{
	    		$employeeWorkingdays['salary_component_id'] 		=  $value;
	    	}
	    }

	    //Per Day Salary Calculations
		$perDaySalary		 = $employeeWorkingdays['base']/$totalDays;	
		//Per Hour Salary
		$perHourSalary		 = $perDaySalary/8;			

		//CalculateBase
		$baseDates   = $payment_days + $holidays;
		$baseSalary  = $baseDates * $perDaySalary;

		//Calculate Working Hours
		$total_working_hours = $baseDates * 8;
		$hour_rate     	     = $total_working_hours * $perHourSalary;

		//Lose of pay
		$lose_of_pay   = $absent - $allowedLeavesCount;
		$lop 		   = ($lose_of_pay < 0) ? '0' : $lose_of_pay;
		$lop_amount    = $lop * $perDaySalary;

		//Leave Allocations
		$employeeWorkingdays['allowed_leaves']  	 = $allowedLeavesCount;	

		$employeeWorkingdays['lop']  				 = $lop;
		$employeeWorkingdays['lop_amount']  		 = $lop_amount;
    	$employeeWorkingdays['total_working_days']   = $total_working_days;
    	$employeeWorkingdays['payment_days']  		 = $payment_days;
    	$employeeWorkingdays['leave_without_pay']  	 = $absent;
    	$employeeWorkingdays['total_holidays']  	 = $holidays;
    	$employeeWorkingdays['per_day_salary']  	 = $perDaySalary;    	
    	$employeeWorkingdays['per_hour_salary']  	 = $perHourSalary;    	
    	$employeeWorkingdays['base_salary']  		 = $baseSalary - $lop_amount;    	
    	$employeeWorkingdays['total_working_hours']  = $total_working_hours;  
    	$employeeWorkingdays['hour_rate']  		     = $hour_rate; 

 		echo json_encode($employeeWorkingdays);
	}

	public function getComponent()
  	{
  		$salary_structure_id 	= $this->input->post('salary_structure_id');
		$hour_rate 				= $this->input->post('hour_rate');
		$total_working_hours 	= $this->input->post('total_working_hours');
		$hourate 				= $this->input->post('hourate');
		$employee_id 			= $this->input->post('employee_id');
		$base_salary 			= $this->input->post('base_salary');
		$salary_slip_id         = $this->input->post('salary_slip_id');

		//Calculate Base Amount for Employee
		//$Data['baseAmount'] 	= $this->mcommon->specific_row_value('hr_salary_structure_select_employee', array('employee_id' => $employee_id, 'salary_structure_id' => $salary_structure_id), 'base');		
		$Data['baseAmount'] 	= $base_salary;		

  		if($hourate == 1)
  		{
			$constraint_array 			 = array('salary_structure_id' 	=>	$salary_structure_id );
			$salary_component_id    	 = $this->mcommon->specific_row_value('hr_salary_structure', $constraint_array,'salary_component_id');
			$constraint_array1 			 =	array('salary_component_id'=>	$salary_component_id);
			$Data['hour_rate'] 			 = $hour_rate;
			$Data['total_working_hours'] = $total_working_hours;

			$Earning1			 		 = $this->mcommon->records_all('hr_salary_component',$constraint_array1,'');
			$Earning2			 		 = $this->mcommon->records_all('hr_earning', $constraint_array,'');
			$Data['Earning'] 	 		 = array_merge($Earning1,$Earning2);
			$Data['contentUrl1'] 		 = 'hr/Payroll/Salary_structure/ComponentDeatilsForm';
  		}else if($salary_slip_id)
  		{
			$constraint_array   	 = array('salary_slip_id'   =>   $salary_slip_id);
			$Data['earningEditData'] = $this->mcommon->records_all('hr_salary_slip_earning', $constraint_array);
			$Data['contentUrl1']     ='hr/Payroll/Salary_structure/ComponentDeatilsForm';
  		}
  		else
  		{
			$constraint_array      		 = array('salary_structure_id' 	=>	$salary_structure_id );
			$Data['Earning']			 = $this->mcommon->records_all('hr_earning', $constraint_array,'');
			$Data['contentUrl1']   		 ='hr/Payroll/Salary_structure/ComponentDeatilsForm';
  		} 		

  		echo $this->load->view('hr/Payroll/form/Salary_slip_component_details_form', $Data);
	}

	public function getDedComponent()
  	{
  		$salary_structure_id    	=  $this->input->post('salary_structure_id');
  		$employee_id    			=  $this->input->post('employee_id');
		$base_salary 				=  $this->input->post('base_salary');
		$salary_slip_id         	=  $this->input->post('salary_slip_id');

  		//Calculate Base Amount for Employee
		//$Data['baseAmount'] 	= $this->mcommon->specific_row_value('hr_salary_structure_select_employee', array('employee_id' => $employee_id, 'salary_structure_id' => $salary_structure_id), 'base');		
		$Data['baseAmount'] 		= $base_salary;	

		if($salary_slip_id)	
		{
			$constraint_array   	= array('salary_slip_id'   =>   $salary_slip_id);
			$Data['DeductionData']	= $this->mcommon->records_all('hr_salary_slip_deduction', $constraint_array);
		}else
		{
	  		$constraint_array 		=  array('salary_structure_id' 	=>	$salary_structure_id );		
			$Data['Deduction']		=  $this->mcommon->records_all('hr_deduction', $constraint_array);			
		}

		$Data['contentUrl1']   	= 'hr/Payroll/Salary_structure/ComponentDeatilsForm';
  		echo $this->load->view('hr/Payroll/form/Salary_slip_deduction_details_form', $Data);
	}

  	public function loadEmployeeDetails()
  	{
  		$employee_id 		= 	$this->input->post('employee_id');

  		$fields 			= 	array("sem.employee_id,c.company_name, d.department_name, b.branch, dg.designation_name,lh.letter_head_id, sem.salary_structure_id, st.payroll_frequency_id, em.employee_name,sem.base");
  		$joinArr			=	array(
										'hr_employee as em' 				=> 	'em.employee_id = sem.employee_id',
										'set_company as c' 					=>  'c.company_id = em.company_id',
										'hr_emp_job_profile jp'				=>  'jp.employee_id = em.employee_id',
										'hr_department as d'				=> 	'd.department_id = jp.department_id',
							  			'hr_branch as b'					=> 	'b.branch_id = jp.branch_id',
							  			'hr_designation dg'					=> 	'dg.designation_id = jp.designation_id',
							  			'hr_salary_structure as st'			=> 	'st.salary_structure_id = sem.salary_structure_id',
							  			'set_letter_head as lh' 			=> 	'lh.letter_head_id = st.salary_structure_id',
							  			'def_hr_payroll_frquency as pfq' 	=> 	'pfq.payroll_frequency_id = st.salary_structure_id',
  									);
  		$constraint_array 	=	array('sem.employee_id' => $employee_id);

  		$employeeData 		= 	$this->mcommon->join_records_all($fields, 'hr_salary_structure_select_employee as sem', $joinArr, $constraint_array ,'','','');

  		$employeeDataArr 	= array();

  		foreach ($employeeData->result() as $row) 
  		{
  			$employeeDataArr['employee_name']   			= 	$row->employee_name;
  			$employeeDataArr['company_name']   				= 	$row->company_name;
  			$employeeDataArr['department_name']   			= 	$row->department_name;
  			$employeeDataArr['branch']   					= 	$row->branch;
  			$employeeDataArr['designation_name']   			= 	$row->designation_name;
  			$employeeDataArr['letter_head_id']   			= 	$row->letter_head_id;
  			$employeeDataArr['payroll_frequency_id']   		= 	$row->payroll_frequency_id;
  			$employeeDataArr['salary_structure_id']   		= 	$row->salary_structure_id;
  			$employeeDataArr['base']   						= 	$row->base;
  		}

		echo json_encode($employeeDataArr);	
	}

	public function getToDate()
	{
	 	$FromDate = date('Y-m-d', strtotime($this->input->post('posting_date')));
	 	$payroll_frequency_id        = $this->input->post('payroll_frequency_id');
	 	
		switch ($payroll_frequency_id) 
		{
		    case 1 :
					$newEndingDate = date("d-m-Y", strtotime(date("d-m-Y", strtotime($FromDate)) . " + 1 month"));
					echo $newEndingDate; 
			        break;
		    case 2 :
			        $newEndingDate = date("d-m-Y", strtotime(date("d-m-Y", strtotime($FromDate)) . " + 4 month"));
					echo $newEndingDate; 
			        break;
		    case 3:
			        $newEndingDate = date("d-m-Y", strtotime(date("d-m-Y", strtotime($FromDate)) . " + 2 month"));
					echo $newEndingDate; 
			        break;
		     case 4:
			        $newEndingDate = date("d-m-Y", strtotime(date("d-m-Y", strtotime($FromDate)) . " + 7days"));
					echo $newEndingDate; 
			        break;
		  
		    default:
				     $newEndingDate = date('d-m-Y', strtotime($this->input->post('from_date')));
					 echo $newEndingDate; 
		} 
	}

	public function datatable()
    {
        //datatable joining
        $this->datatables ->select('hs.salary_slip_id, hs.employee_name, hs.start_date,hs.end_date, hs.salary_slip_status_id, hs.updated_on, CONCAT(up.first_name, " ", up.last_name)');
        $this->datatables ->from('hr_salary_slip as hs');
        $this->datatables ->join('user_profile as up', 'up.user_id = hs.updated_by');
      	$this->datatables->edit_column('hs.salary_slip_id', '$1', 'get_ajax_buttons_salary_silp(hs.salary_slip_id,hr/Payroll/Salary_slip, hs.salary_slip_status_id)');
        $this->datatables->edit_column('hs.salary_slip_status_id', '$1', 'get_salary_silp_status(hs.salary_slip_status_id)');
        $this->datatables->edit_column('hs.updated_on', '$1', 'get_date_timeformat(hs.updated_on)');
        $this->datatables->edit_column('hs.start_date', '$1', 'get_date_format(hs.start_date)');
        $this->datatables->edit_column('hs.end_date', '$1', 'get_date_format(hs.end_date)');
		$this->db->order_by('hs.updated_on', DESC);
    	//$this->datatables->edit_column('hs.salary_slip_id', get_ajax_buttons_page_form('$1', 'hr/Payroll/Salary_slip/'), 'hs.salary_slip_id');
     	// $this->datatables->edit_column('hs.salary_slip_id', '$1', 'get_salary_silp_status(hs.salary_slip_id)');  
        echo $this->datatables->generate();
    }

    public function ajaxLoadFormDetail($salary_slip_id='')
	{
		$isFormLoad = TRUE;

		if($isFormLoad)
		{
			//Get data from table for edit the data
			if($salary_slip_id)
			{
				$constraint_array 	=	array('salary_slip_id' 	=>	 $salary_slip_id);
				$result				=	$this->mcommon->records_all('hr_salary_slip', $constraint_array);

				foreach ($result as $row)
				{
					$letter_head_id  		= $row->letter_head_id;
					$salary_structure_id  	= $row->salary_structure_id;
					$employee_id  			= $row->employee_id;
				}
				$constraint_array1 				=	array('salary_structure_id' => $salary_structure_id);
				$constraint_array2 				=	array('employee_id' => $employee_id);
				$Data['employeeData']			=	$this->mcommon->records_all('hr_employee', $constraint_array2);
				$Data['tableData']				=	$this->mcommon->records_all('hr_salary_slip', $constraint_array);
				$Data['LetterHeadData']			=	$this->mcommon->records_all('set_letter_head', $letter_head_id);
				$Data['EarningData']			=	$this->mcommon->records_all('hr_salary_slip_earning', $constraint_array);
				$Data['DeductionData']			=	$this->mcommon->records_all('hr_salary_slip_deduction', $constraint_array);
				$Data['StructureData']			=	$this->mcommon->records_all('hr_salary_structure', $constraint_array1);
			}			

			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Payroll/Salary_slip/ajaxLoadFormDetail';
			$this->load->view('hr/Payroll/form/Salary_slip_print_form', $Data);
		}
	}

	/*public function checkdate()
	{
   		$startDate 					= date('Y-m-d', strtotime($this->input->post('start_date')));
   		$endDate   					= date('Y-m-d', strtotime($this->input->post('from_date')));
    	
    	 $DateArr  = array();
	    $i=0;
	    while ($startDate <= $endDate) 
	    {
	        $DateArr[$i]  = $startDate->format('Y-m-d');
	        $startDate->modify('+1 day');
	        $i++;
	    }
	    print_r($DateArr);
	    exit();
    	$employee_id 				= $this->input->post('employee_id');
    	$constraint_array  			= array('employee_id' => $employee_id);
    	 $get_field  				= array('start_date','end_date');
    	$attStatus          		= $this->mcommon->specific_fields_records_all('hr_salary_slip', $constraint_array,$get_field);
    	
    	foreach ($attStatus as $row ) 
    	{
    		$start_date= $row->start_date;
    		
    	}
    	print_r($start_date);
    		exit();
    	$DateArr  = array();

    	while ($startDate <= $endDate) 
	    {
	        $DateArr[]  = $startDate->format('Y-m-d');
	        $startDate->modify('+1 day');
	    }

	    foreach ($DateArr as $row => $value)
    	{
	      
	     
    	}
	}*/
}