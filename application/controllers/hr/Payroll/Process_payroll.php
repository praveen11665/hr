<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Process_payroll extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load("validation_lang","english");
		$this->lang->load("hr","english");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->is_logged_in();
		$this->load->model("menu_model", "menu");
		$items = $this->menu->all();
		$this->load->library("form_validation");
		$this->load->library("multi_menu");
		$this->multi_menu->set_items($items);
	}

	public function index($Data=array())
	{
		if( $this->acl_permits('HR.process_payroll') )
    	{  
			$view_data = array(
			                    'form_heading'    	=> $this->lang->line('Process_payroll_form_heading'),
			                    'form_title'    	=> $this->lang->line('Process_payroll_form_title'),
			                    'form_description'  => $this->lang->line('Process_payroll_form_description'),
			                    'list_heading'    	=> $this->lang->line('Process_payroll_form_heading'),
			                    'list_title'    	=> $this->lang->line('Process_payroll_form_title'),
			                    'list_description'  => $this->lang->line('Process_payroll_form_description'),
			                    'formUrl'       	=> 'hr/Payroll/Process_payroll/ajaxLoadForm',
			                    'list_view'     	=> TRUE,
			                    'buttonview'     	=> TRUE
			                  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading(lang('lable_action'), lang('label_company'),lang('label_branch'), lang('label_department'), lang('label_designation'));

			$view_data['dataTableUrl']   =   'hr/Payroll/Process_payroll/datatable';
			$data = array(
			                'title'     =>  'MEP - '.$this->lang->line('Process_payroll_form_heading'),
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

	public function ajaxLoadForm($process_payroll_id = '')
	{
		$isFormLoad = TRUE;

		if(!empty($_POST))
		{
		  	//This will convert the string to array
		  	parse_str($_POST['postdata'], $_POST);
			$this->form_validation->set_rules('designation_id', lang('label_designation'), 'trim|required');
		  	//Checking Form Validation
			$this->form_validation->set_rules('start_date', lang('label_start_date'), 'required');
			$this->form_validation->set_rules('end_date', lang('label_end_date'), 'required');
			$this->form_validation->set_rules('posting_date', lang('label_posting_date'), 'required');
			$this->form_validation->set_rules('payroll_frquency_id', lang('label_payroll_frequency'), 'trim|required');
			$this->form_validation->set_rules('department_id', lang('label_department'), 'trim|required');
			$this->form_validation->set_rules('branch_id', lang('label_branch'), 'trim|required');
			$this->form_validation->set_rules('company_id', lang('label_company'), 'trim|required');
			/*$this->form_validation->set_rules('project_id', lang('label_project'), 'trim|required');
			$this->form_validation->set_rules('account_id', lang('label_payment_accounts'), 'trim|required');*/

		  	if($this->form_validation->run() == TRUE) 
		  	{
		    	//Insert if not id's are given
			   
		  		if($this->input->post('process_payroll_id') =="")
	            {
				   $data   = array(
	                            	'posting_date' 					 =>  date('Y-m-d', strtotime($this->input->post('posting_date'))),
	                          		'start_date' 					 =>  date('Y-m-d', strtotime($this->input->post('start_date'))),
							        'end_date' 						 =>  date('Y-m-d', strtotime($this->input->post('end_date'))),
							        'designation_id'           		 => $this->input->post('designation_id'),
							        'department_id'           		 => $this->input->post('department_id'),
	                                'branch_id' 		     		 => $this->input->post('branch_id'),
	                                'company_id'               		 => $this->input->post('company_id'), 
	                                'payroll_frequency_id'  		 => $this->input->post('payroll_frquency_id'),
	                                'cost_center_id'  		 		 => $this->input->post('cost_center_id'),
	                                'project_id'  		 			 => $this->input->post('project_id'),
	                                'account_id'  		 			 => $this->input->post('account_account_type_id'),
	                                'salary_slip_based_on_timesheet' => ($this->input->post('salary_slip_based_on_timesheet')) ? 1 : 0,
	                                'created_on'    				 => date('Y-m-d H:i:s'),
									'created_by'    				 => $this->auth_user_id
		                             );           
		        	$result = $this->mcommon->common_insert('hr_process_payroll',$data); 

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
				  	$data   	= array(
						                'posting_date' 					 =>  date('Y-m-d', strtotime($this->input->post('posting_date'))),
		                          		'start_date' 					 =>  date('Y-m-d', strtotime($this->input->post('start_date'))),
								        'end_date' 						 =>  date('Y-m-d', strtotime($this->input->post('end_date'))),
								        'designation_id'           		 => $this->input->post('designation_id'),
								        'department_id'           		 => $this->input->post('department_id'),
		                                'branch_id' 		     		 => $this->input->post('branch_id'),
		                                'company_id'               		 => $this->input->post('company_id'), 
		                                'payroll_frequency_id'  		 => $this->input->post('payroll_frquency_id'),
		                                'cost_center_id'  		 		 => $this->input->post('cost_center_id'),
		                                'project_id'  		 			 => $this->input->post('project_id'),
		                                'account_id'  		 			 => $this->input->post('account_account_type_id'),
	                                	'salary_slip_based_on_timesheet' => ($this->input->post('salary_slip_based_on_timesheet')) ? 1 : 0,
					              	   );    
					$where_array  = array('process_payroll_id'  =>$this->input->post('process_payroll_id'));
					$result 	  = $this->mcommon->common_edit('hr_process_payroll', $data, $where_array);
					//old table name is hr_payroll_process_payroll

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
			if($process_payroll_id != '')
			{
				$constraint_array   = array('process_payroll_id'  =>   $process_payroll_id);
				$Data['tableData']  = $this->mcommon->records_all('hr_process_payroll', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   =  'hr/Payroll/Process_payroll/ajaxLoadForm';
			$this->load->view('hr/Payroll/form/Process_payroll_form', $Data);
		}
	} 

 	public function delete($process_payroll_id='')
	{
		$where_array  = array('process_payroll_id' => $process_payroll_id);
		$result       = $this->mcommon->common_delete('hr_process_payroll', $where_array);
		
		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('hr/Payroll/Process_payroll'));
		}
	}

	public function datatable()
	{
		$this->datatables->select('hpp.process_payroll_id, sc.company_name, hb.branch, hd.department_name, hde.designation_name')
		->from('hr_process_payroll AS hpp')
		->join('set_company as sc', 'sc.company_id = hpp.company_id')
		->join('hr_branch as hb', 'hb.branch_id = hpp.branch_id')
		->join('hr_department as hd', 'hd.department_id = hpp.department_id') 
		->join('hr_designation as hde', 'hde.designation_id = hpp.designation_id')
		->edit_column('hpp.process_payroll_id', get_ajax_buttons('$1', 'hr/Payroll/Process_payroll'), 'hpp.process_payroll_id');
		echo $this->datatables->generate();
	}

	public function bulkEmployeeSalary()
	{
		$branch  		= $this->input->post('branch_id');
		$department 	= $this->input->post('department_id');
		$designation 	= $this->input->post('designation_id');
		$start_date     = date('Y-m-d', strtotime($this->input->post('start_date')));
		$end_date     	= date('Y-m-d', strtotime($this->input->post('end_date')));
		$posting_date   = date('Y-m-d', strtotime($this->input->post('posting_date')));

		$constraint_array 	= 	array('department_id' => $department);	
		$employeeData 		= $this->mcommon->specific_fields_records_all('hr_emp_job_profile', $constraint_array, 'employee_id');	
		foreach ($employeeData as $row) 
		{
			$employeeIdArr  = $row['employee_id'];
			$startDate    	= new DateTime($start_date);
	    	$endDate      	= new DateTime($end_date);
			$totalDays 	  	= ($endDate->diff($startDate)->format("%a"))+1;			

    		$DateArr  = array();
		    while ($startDate <= $endDate) 
		    {
		        $DateArr[]  = $startDate->format('Y-m-d');
		        $startDate->modify('+1 day');
		    }

			unset($attStatus);

		    foreach ($DateArr as $row => $value)
	    	{
	    	  $employee_id 				= 	$employeeIdArr;
		      $constraint_array  		=   array('attendance_date' =>$value, 'employee_id' => $employee_id);
		      $attStatus[]          	=   $this->mcommon->specific_row_value('hr_employee_attendance', $constraint_array,'employee_attendance_status_id');
	    	}
	        $count = array_count_values($attStatus);

			$employeeWorkingdays['present'] 	= $count[1];
			$employeeWorkingdays['absent']  	= $count[2];
			$employeeWorkingdays['on_leave']  	= $count[3];
			$employeeWorkingdays['half_day']  	= $count[4];
			$halfDayWorking  	    			= $count[4] * '0.5';

			//Holiday Days calculations
	    	foreach ($DateArr as $row => $date)
	    	{
				$holidaylist          	=   $this->mcommon->specific_row_value('hr_emp_employment_details', array('employee_id' => $employeeIdArr),'holiday_list_id');
				$holidaylistArr  		= explode(",", $holidaylist);

				foreach ($holidaylistArr as $holidayKey => $holiday_list_id) 
				{
					$constraint_array  		=   array('holiday_date' =>$date, 'holiday_list_id' => $holiday_list_id, 'is_delete' => '0');
					$attDate[]          	=   $this->mcommon->specific_row_value('hr_holiday_list_holiday', $constraint_array, 'holiday_date');
				}
	    	}
	    	
	    	$result 				= array_count_values($attDate);
	    	$holidays  				= array_sum($result);
	    	$total_working_days 	= $totalDays - $holidays;
	    	unset($attDate);
	    	$on_leave          		= $employeeWorkingdays['on_leave'];
	    	$absent 				= $employeeWorkingdays['absent'] + $halfDayWorking;
	    	$payment_days 			= ($employeeWorkingdays['present'] + $on_leave) + $halfDayWorking;

	    	//Calculate Leave Allocation for Employee
	    	$allocationData  = $this->mcommon->records_all('hr_leave_allocation', array('employee_id' => $employeeIdArr)); 
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
						$allowedLeaves[]     = $selectDate;
						$allowedLeavesCount += count($selectDate);
					}
				}
			} 

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
		
	  		$employeeWorkingdays 	= 	array();

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
	  			$salaryData1    								= 	array('Base' => $row->base);
	  			foreach ($earning_abbr as $key => $value) 
		    	{
		    		$employeeWorkingdays['salary_component_abbr_ear'] 		=  $value;
		    		
		    	}

	  			foreach ($earning_formula as $key => $value) 
		    	{
		    		$employeeWorkingdays['salary_component_formula_ear'] 		=  $value;
		    		
		    	}

	  			// Calculation for total earnings
	  			$calculatedAmountEar 	= array();
	  			$calculatedAmountDec 	= array();
	  			$totalEarnings      = 0;

	  			$daySalary  = $salaryData1['Base']/$total_working_days;
	  			
	  			if($hour_amount != '')
	  			{
		  			$totalBase  = $salaryData1['Base']	;

	  			}else
	  			{
		  			$totalBase  = ($daySalary*$payment_days);
	  			}	  			

		  		$salaryData = array('Base' =>$totalBase);
		    	foreach ($employeeDataArrEaring as $earning_abbr => $earning_formula) 
		    	{		    		
		    		$calculatedAmountEar[$earning_abbr]	= 	eval('return '. strtr($earning_formula, $salaryData).';');
		    		
		    		$totalEarnings   				   +=	$calculatedAmountEar[$earning_abbr];
		    		$calculatedAmountEarn[][$earning_abbr]	= 	eval('return '. strtr($earning_formula, $salaryData).';');
		    	}
		    	$employeeWorkingdays['totalEarnings']  		= 	ceil($totalEarnings+$hour_amount);
		    	unset($totalEarnings);

		    	// Calculation for total deduction
	  			$totalDeduction   = 0;
		    	foreach ($employeeDataArrDeduction as $deduction_abbr => $deduction_formula) 
		    	{
		    		
		    		$calculatedAmountDec[$deduction_abbr] 	= 	eval('return '. strtr($deduction_formula, $salaryData).';');

		    		$totalDeduction                    		+=	$calculatedAmountDec[$deduction_abbr];
		    	}

		    	$employeeWorkingdays['totalDeduction']  	= 	ceil($totalDeduction);
		    	unset($totalDeduction);
		    	foreach ($earning_salary_component as $key => $value) 
		    	{
		    		$employeeWorkingdays['salary_component_id'] 		=  $value;

		    	}
		    }

	    	$employeeWorkingdays['total_working_days']  = $total_working_days;
	    	$employeeWorkingdays['payment_days']  		= $payment_days;
	    	$employeeWorkingdays['leave_without_pay']  	= ($absent) ? $absent : '0';

		    $employee_id 		= 	$employeeIdArr;

	  		$fields 			= 	array("sem.employee_id, em.employee_name, em.naming_series, c.company_name, d.department_name, b.branch, dg.designation_name,lh.letter_head_id, sem.salary_structure_id, pfq.payroll_frequency_id, st.name");
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
	  			$employeeDataArr['naming_series']   			= 	$row->naming_series;
	  			$employeeDataArr['company_name']   				= 	$row->company_name;
	  			$employeeDataArr['department_name']   			= 	$row->department_name;
	  			$employeeDataArr['branch']   					= 	$row->branch;
	  			$employeeDataArr['designation_name']   			= 	$row->designation_name;
	  			$employeeDataArr['letter_head_id']   			= 	$row->letter_head_id;
	  			$employeeDataArr['payroll_frequency_id']   		= 	$row->payroll_frequency_id;
	  			$employeeDataArr['salary_structure_id']   		= 	$row->salary_structure_id;
	  		}
	    	
	        $constraint_array 	=	array('salary_structure_id' => $employeeDataArr['salary_structure_id']);
	        $earningArr 		=	$this->mcommon->records_all('hr_earning', $constraint_array);

			//Per Day Salary Calculations
			$perDaySalary		 = $employeeWorkingdays['base']/$totalDays;	
			//Per Hour Salary
			$perHourSalary		 = $perDaySalary/8;	

			//Lose of pay
			$lose_of_pay   = $absent - $allowedLeavesCount;
			$lop 		   = ($lose_of_pay < 0) ? '0' : $lose_of_pay;
			$lop_amount    = $lop * $perDaySalary;				

			//CalculateBase
			$baseDates   		= $payment_days + $holidays;
			$baseSalary  		= ($baseDates * $perDaySalary) - $lop_amount;
            
            $total_working_hours = $baseDates * 8;
			//$hour_rate     	     = $total_working_hours * $perHourSalary;
			$hour_rate     	     = $baseSalary;

		  	$baseSalaryArr  	= array('base' => $baseSalary);	

            //Salary Slip Data
            $dataSalarySlip   	= 	array(
            								//'naming_series' 			=> $namingSeries,
                                			'base'               		=>  $employeeWorkingdays['base'],
			                                'employee_id'    	    	=>  $employee_id,
			                            	'posting_date' 				=>  $posting_date,
			                          		'start_date' 				=>  $start_date,
									        'end_date' 					=>  $end_date,
									        'designation'           	=>  $employeeDataArr['designation_name'],
			                                'branch' 		        	=>  $employeeDataArr['branch'],
			                                'company'               	=>  $employeeDataArr['company_name'],
			                                'employee_name'         	=>  $employeeDataArr['employee_name'],
			                                'department'         		=>  $employeeDataArr['department_name'],
			                                'letter_head_id' 			=> 	$employeeDataArr['letter_head_id'],
			                                'payroll_frequency_id'  	=>  $employeeDataArr['payroll_frequency_id'],
			                                'salary_slip_status_id'  	=> 	'1',
			                                'salary_structure_id'   	=> 	$employeeDataArr['salary_structure_id'],
			                                'total_working_days'    	=> 	$employeeWorkingdays['total_working_days'],
			                                'leave_without_pay' 		=> 	$employeeWorkingdays['leave_without_pay'],
			                                //'bank_name' 				=> 	$this->input->post('bank_name'),
			                                //'bank_account_no' 		=> 	$this->input->post('bank_account_no'),
			                                'payment_days' 		   		=> 	$employeeWorkingdays['payment_days'],
			                                //'gross_pay' 		   		=> 	$gross_pay,
			                                //'total_deduction' 			=> 	$totalDeduction,
			                                //'net_pay' 		   			=> 	$net_pay,
			                                //'rounded_total' 			=> 	round($net_pay),
			                                'total_working_hours'       =>  $total_working_hours,
                                			'hour_rate'   				=> 	$hour_rate,
                                			'total_holidays'			=>  $holidays,
                                			'allowed_leaves'			=>  $allowedLeavesCount,
                                			'lop'						=>  $lop,
                                			'lop_amount'				=>  $lop_amount,
			                                'created_on'    			=> 	date('Y-m-d H:i:s'),
											'updated_by'		    	=> 	$this->auth_user_id,
											'created_by'    			=> 	$this->auth_user_id,
											//'salary_slip_based_on_timesheet' => ($this->input->post('salary_slip_based_on_timesheet'))? '1' : '0',
			                        	);           
	       
	        $result 			= 	$this->mcommon->common_insert('hr_salary_slip',$dataSalarySlip);

	        $totalEarings = '0';
	        foreach ($earningArr as $row) 
	        {
	        	$earnigDataArr['salary_component_id']	=	$row->salary_component_id;
	        	$earnigDataArr['abbr']					=	$row->abbr;
	        	$earnigDataArr['formula']				=	$row->formula;
	        	$calculatedEarnAmount					= 	eval('return '. strtr($row->formula, $baseSalaryArr).';');
	        
              	$dataEarning		= 	array(
				              					'salary_slip_id' 					=> 	$result,
				              					'salary_structure_id' 				=> 	$employeeDataArr['salary_structure_id'],
				              					'salary_component_id'				=> 	$earnigDataArr['salary_component_id'],
				              					'amount'							=> 	$calculatedEarnAmount,
				              					'abbr'								=> 	$earnigDataArr['abbr'],
				              					'formula'							=>	$earnigDataArr['formula']
				              				);	           
              	$resultEarning    	 = 	$this->mcommon->common_insert('hr_salary_slip_earning', $dataEarning);
              	$totalEarings        +=  $calculatedEarnAmount;
            }

            $deductionArr 			=	$this->mcommon->records_all('hr_deduction', $constraint_array);

            $totalDeduction = '0';
            foreach ($deductionArr as $row) 
	        {
	        	$deductionDataArr['salary_component_id']	=	$row->salary_component_id;
	        	$deductionDataArr['abbr']					=	$row->abbr;
	        	$deductionDataArr['formula']				=	$row->formula;
	        	$calculatedDeductionAmount					= 	eval('return '. strtr($row->formula, $baseSalaryArr).';');        	

              	$dataDeduction		= 	array(
				              					'salary_slip_id' 					=> 	$result,
				              					'salary_structure_id' 				=> 	$employeeDataArr['salary_structure_id'],
				              					'salary_component_id'				=> 	$deductionDataArr['salary_component_id'],
				              					'amount'							=> 	$calculatedDeductionAmount,	
				              					'abbr'								=> 	$deductionDataArr['abbr'],	
				              					'formula'							=>	$deductionDataArr['formula']
				              				);
              	$resultDeduction    = 	$this->mcommon->common_insert('hr_salary_slip_deduction', $dataDeduction);
              	$totalDeduction     +=  $calculatedDeductionAmount;
            }

            $gross_pay  		 = $totalEarings + $totalDeduction;
            $net_pay    		 = $gross_pay    - $totalDeduction;

            $dataSalarySlipEditData   	= 	array(
					                                'gross_pay' 		   		=> 	$gross_pay,
					                                'total_deduction' 			=> 	$totalDeduction,
					                                'net_pay' 		   			=> 	$net_pay,
					                                'rounded_total' 			=> 	round($net_pay),
			                        			);
           	$editSlip    				= 	$this->mcommon->common_edit('hr_salary_slip', $dataSalarySlipEditData, array('salary_slip_id' => $result));
		}
	}
}