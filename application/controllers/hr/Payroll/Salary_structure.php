<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Salary_structure extends MY_Controller
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
  		if( $this->acl_permits('HR.salary_structure') )
    	{
			//Redirect
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Salary_structure_form_heading'),
								'form_title' 		=> $this->lang->line('Salary_structure_form_title'),
								'form_description' 	=> $this->lang->line('Salary_structure_form_description'),
								'list_heading' 		=> $this->lang->line('Salary_structure_form_heading'),
								'list_title' 		=> $this->lang->line('Salary_structure_form_title'),
								'list_description' 	=> $this->lang->line('Salary_structure_form_description'),
								'formUrl' 			=> 'hr/Payroll/Salary_structure/ajaxLoadForm',
								'list_view' 		=> TRUE,						
								'buttonview'		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Company Name', 'Letter Head','Salary Structure','Active','Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Payroll/Salary_structure/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Salary_structure_form_heading'),
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
			
			$employee_idPkeyArr							=	$this->input->post('salary_structure_select_employee_id');
			$employee_idArr								=	$this->input->post('employee_id'); 
			$from_dateArr								=	$this->input->post('from_date');  
			$to_dateArr									=	$this->input->post('to_date');  
			$baseArr									=	$this->input->post('base');  
			$variableArr 								= 	$this->input->post('variable');  

			$EarningsalarycomponentidArr 				= 	$this->input->post('salary_component_id_earing'); 
			$EarningabbrArr 							= 	$this->input->post('abbr_earing');  
			$EarningformulaArr 							= 	$this->input->post('formula_earing');  
			$earning_idArr 								= 	$this->input->post('earning_id');
			$EarningamountArr 							= 	$this->input->post('amount_earing');
			$EarningstatisticalcomponentArr 			= 	$this->input->post('statistical_component_earing');
			
			$deduction_idArr 							= 	$this->input->post('deduction_id');
			$DeductionsalarycomponentidArr 				= 	$this->input->post('salary_component_id_deduction');  
			$DeductionabbrArr 							= 	$this->input->post('abbr_deduction');  
			$DeductionformulaArr 						= 	$this->input->post('formula_deduction');  
			$DeductionamountArr 						= 	$this->input->post('amount_deduction');
			$DeductionstatisticalcomponentArr 			= 	$this->input->post('statistical_component_deduction');	
			
		 	$this->form_validation->set_rules('name', lang('label_name'), 'required');
		 	$this->form_validation->set_rules('company_id', lang('label_company'), 'required');
		 	$this->form_validation->set_rules('salary_structure_is_active_id', lang('label_is_active'), 'required');
		 	$this->form_validation->set_rules('payroll_frequency_id', lang('label_payroll_frequency'), 'required');
			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if ($this->input->post('salary_structure_id') == '') 
				{
					$data   	= array(
											'name'								=> $this->input->post('name'),
											'company_id'						=> $this->input->post('company_id'),
											'salary_structure_is_active_id'		=> $this->input->post('salary_structure_is_active_id'),
											'letter_head_id'					=> $this->input->post('letter_head_id'),
											'payroll_frequency_id'				=> $this->input->post('payroll_frequency_id'),   
											'salary_slip_based_on_timesheet' 	=> ($this->input->post('salary_slip_based_on_timesheet')) ? '1' : '0',
											'salary_component_id'				=> $this->input->post('salary_component_id'),
											'hour_rate'							=> $this->input->post('hour_rate'),
											'mode_of_payment_id'				=> $this->input->post('mode_of_payment_id'), 
											'payment_account'					=> $this->input->post('payment_account'),
											 'created_on'                		=> date('Y-m-d H:i:s'),
			                                'updated_on'                		=> date('Y-m-d H:i:s'),
			                                'created_by'                		=> $this->auth_user_id,
			                                'updated_by'                		=> $this->auth_user_id
									   );
					$this->db->trans_start();
	              	$result 	= $this->mcommon->common_insert('hr_salary_structure',$data);

              		//Salary Structure for a Employee
	              	foreach ($employee_idArr as $key => $value) 
	              	{
		              	$data1 	= array(
			              					'salary_structure_id' 				=> $result,
			              					'employee_id'						=> $employee_idArr[$key],  
			              					'from_date' 						=> date('Y-m-d', strtotime($from_dateArr[$key])),
			              					'to_date' 							=> date('Y-m-d', strtotime($to_dateArr[$key])),
			              					'base' 								=> $baseArr[$key],
			              					'variable'							=> $variableArr[$key],
				              				'created_on'                		=> date('Y-m-d H:i:s'),
			                                'updated_on'                		=> date('Y-m-d H:i:s'),
			                                'created_by'                		=> $this->auth_user_id,
			                                'updated_by'                		=> $this->auth_user_id
		              						);
		              $result1	= $this->mcommon->common_insert('hr_salary_structure_select_employee', $data1);
	              	}

              		//Earnings and for hr_salary_structure
	              	foreach ($EarningsalarycomponentidArr as $key => $value) 
	              	{
		              	$data2 	= array(
			              					'salary_structure_id' 				=> 	$result,
			              					'salary_component_id'				=> 	$EarningsalarycomponentidArr[$key],
			              					'abbr'								=>	$EarningabbrArr[$key],
			              					'statistical_component' 			=>  ($EarningstatisticalcomponentArr[$key]) ? '1' : '0', 
			              					'formula' 							=>	$EarningformulaArr[$key],
			              					//'amount' 							=>	$earningAmount,	
		              					);
		              $result2  = $this->mcommon->common_insert('hr_earning', $data2);
		            }

		            foreach ($DeductionsalarycomponentidArr as $key => $value) 
	              	{
		              	$data3  = array(
			              					'salary_structure_id' 				=> 	$result,
			              					'salary_component_id'				=> 	$DeductionsalarycomponentidArr[$key],
			              					'abbr'								=>	$DeductionabbrArr[$key],
			              					'statistical_component' 			=>  ($DeductionstatisticalcomponentArr[$key]) ? '1' : '0', 
			              					'formula' 							=>	$DeductionformulaArr[$key],
			              					//'amount' 							=>	$deductionAmount,
		              					);
		              	$result3  = $this->mcommon->common_insert('hr_deduction', $data3);
		            }
		            $this->db->trans_complete();

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
					$data   		= 	array(
												'name'								=> $this->input->post('name'),
												'company_id'						=> $this->input->post('company_id'),
												'salary_structure_is_active_id'		=> $this->input->post('salary_structure_is_active_id'),
												'letter_head_id'					=> $this->input->post('letter_head_id'),
												'payroll_frequency_id'				=> $this->input->post('payroll_frequency_id'),   
												'salary_slip_based_on_timesheet' 	=> ($this->input->post('salary_slip_based_on_timesheet')) ? '1' : '0',
											   'salary_component_id'				=> $this->input->post('salary_component_id'),
												'hour_rate'							=> $this->input->post('hour_rate'),
												'mode_of_payment_id'				=> $this->input->post('mode_of_payment_id'), 
												'payment_account'					=> $this->input->post('payment_account'),   
				                                'updated_on'                		=> date('Y-m-d H:i:s'),
				                                'updated_by'                		=> $this->auth_user_id
								 			);

					$this->db->trans_start();
					
					$where_array  	= array('salary_structure_id'  =>$this->input->post('salary_structure_id'));
	              	$result 		= $this->mcommon->common_edit('hr_salary_structure',$data, $where_array);

	              	//Salary Structure for a Employee
	              	foreach ($employee_idArr as $key =>$value) 
	              	{
						$data1 	= array(
											'employee_id'	=>	$employee_idArr[$key],  
											'from_date' 	=>	date('Y-m-d', strtotime($from_dateArr[$key])),
											'to_date' 		=>	date('Y-m-d', strtotime($to_dateArr[$key])),
											'base' 			=>	$baseArr[$key],
											'variable'		=>	$variableArr[$key],
											'updated_on'    => date('Y-m-d H:i:s'),
											'updated_by'    => $this->auth_user_id
		              					);
						if($employee_idPkeyArr[$key] != "")
		           		{
							$where_array  = array('salary_structure_select_employee_id'  => $employee_idPkeyArr[$key]);
			              	$result1    = $this->mcommon->common_edit('hr_salary_structure_select_employee', $data1, $where_array);
			            }
			            else
			            {
			            	$data1 	= array(
				              					'salary_structure_id' 				=> $this->input->post('salary_structure_id'),
				              					'employee_id'						=> $employee_idArr[$key],  
				              					'from_date' 						=> date('Y-m-d', strtotime($from_dateArr[$key])),
				              					'to_date' 							=> date('Y-m-d', strtotime($to_dateArr[$key])),
				              					'base' 								=> $baseArr[$key],
				              					'variable'							=> $variableArr[$key],
					              				'created_on'                		=> date('Y-m-d H:i:s'),
				                                'updated_on'                		=> date('Y-m-d H:i:s'),
				                                'created_by'                		=> $this->auth_user_id,
				                                'updated_by'                		=> $this->auth_user_id
			              					);
			              	$result1	= $this->mcommon->common_insert('hr_salary_structure_select_employee', $data1);
			            }
	              	}

	            	//Earnings 
	              	foreach ($EarningsalarycomponentidArr as $key => $value) 
	              	{
		              	$data2 		= array(
												'salary_component_id'	=> 	$EarningsalarycomponentidArr[$key],
												'abbr'					=>	$EarningabbrArr[$key],
												'statistical_component' =>  ($EarningstatisticalcomponentArr[$key]) ? '1' : '0', 
												'formula' 				=>	$EarningformulaArr[$key],
												//'amount' 				=>	$earningAmount,
		              						);
		              	
		           		if($earning_idArr[$key] != "")
		           		{
		           			$where_array1 = array('earning_id' => $earning_idArr[$key]);
	              			$result2      = $this->mcommon->common_edit('hr_earning', $data2, $where_array1);	
		           		}
		           		else
		           		{
		           			$data2 		= 	array(
					              				'salary_structure_id' 				=> 	$this->input->post('salary_structure_id'),
				              					'salary_component_id'				=> 	$EarningsalarycomponentidArr[$key],
				              					'abbr'								=>	$EarningabbrArr[$key],
				              					'statistical_component' 			=>  ($EarningstatisticalcomponentArr[$key]) ? '1' : '0', 
				              					'formula' 							=>	$EarningformulaArr[$key],
				              					//'amount' 							=>	$earningAmount,
			              						);
		           			$result2    = $this->mcommon->common_insert('hr_earning', $data2);	
		           		}
		            }

		            //Deduction  
		            foreach ($DeductionsalarycomponentidArr as $key => $value) 
	              	{
		              	$data3 		= array(
			              					'salary_component_id'				=> 	$DeductionsalarycomponentidArr[$key],
			              					'abbr'								=>	$DeductionabbrArr[$key],
			              					'statistical_component' 			=>  ($DeductionstatisticalcomponentArr[$key]) ? '1' : '0', 
			              					'formula' 							=>	$DeductionformulaArr[$key],
			              					//'amount' 							=>	$deductionAmount,
		              						);
		              	if($deduction_idArr[$key] != "")
		           		{
							$where_array2 = array('deduction_id' => $deduction_idArr[$key]);
	              			$result3      = $this->mcommon->common_edit('hr_deduction', $data3, $where_array2);	
	              		}
	              		else
	              		{
	              			$data3 		= array(
					              			'salary_structure_id' 				=> 	$this->input->post('salary_structure_id'),
			              					'salary_component_id'				=> 	$DeductionsalarycomponentidArr[$key],
			              					'abbr'								=>	$DeductionabbrArr[$key],
			              					'statistical_component' 			=>  ($DeductionstatisticalcomponentArr[$key]) ? '1' : '0', 
			              					'formula' 							=>	$DeductionformulaArr[$key],
			              					//'amount' 							=>	$deductionAmount,	
		              						);
	              			$result3    = $this->mcommon->common_insert('hr_deduction', $data3);
	              		}
		            }

			        $this->db->trans_complete();

	              	if($result || $result1 || $result2 || $result3)
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
				$constraint_array 	=	array('salary_structure_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('hr_salary_structure', $constraint_array);
				//For Employee
				$Data['tableData1']	=	$this->mcommon->records_all('hr_salary_structure_select_employee', $constraint_array);
				//For Earnings
				$Data['tableData2']	=	$this->mcommon->records_all('hr_earning', $constraint_array,'');
				//For Deduction
				$Data['tableData3']	=	$this->mcommon->records_all('hr_deduction', $constraint_array,'');
			}

			//Ajax Form Load
			$Data['ActionUrl']   	= 	 'hr/Payroll/Salary_structure/ajaxLoadForm';
			//Content form load depend on Detail button
			$Data['contentUrl']   	=	 'hr/Payroll/Salary_structure/EmployeeDetailsForm';
			$Data['contentUrl1']   	=	 'hr/Payroll/Salary_structure/ComponentDeatilsForm';
			$Data['contentUrl2']   	=	 'hr/Payroll/Salary_structure/ajaxTableContentForm3';
			//Dropdown add new form depend on + symboll
			$Data['dropdownUrl']  	=	 'hr/Payroll/Salary_structure/ajaxDropdownLetterHead';
			$Data['dropdownUrllink']=	 'hr/Payroll/Salary_structure/ajaxDropdownSalaryComponent';
			$Data['dropdownUrlMode']=	 'hr/Payroll/Salary_structure/ajaxDropdownModePayment';
			$Data['dropdownUrlAcc']	=	 'hr/Payroll/Salary_structure/aajaxDropdownAccount';

			$this->load->view('hr/Payroll/form/Salary_structure_form', $Data);
		}
	}
	
	public function delete($salary_structure_id='')
  	{
  		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
	    $where_array    =   array('salary_structure_id'  => $salary_structure_id);
		$result 		=	$this->mcommon->common_delete('hr_salary_structure', $where_array);
		$result1 		=	$this->mcommon->common_delete('hr_salary_structure_select_employee', $where_array);

	    if($result || $result1)
	    {
	      //Session for Delete
	      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
	      $this->session->set_flashdata('alertType', 'success');
	      redirect(base_url('hr/Payroll/Salary_structure/'));
	    }
  	}

	public function datatable()
	{
    	$this->datatables->select('at.salary_structure_id,c.company_name, l.letter_head_name,at.name,s.is_active,at.updated_on, CONCAT(up.first_name, " ", up.last_name)')
        ->from('hr_salary_structure AS at')
        ->join('set_company as c','at.company_id=c.company_id','left')
         ->join('user_profile as up', 'up.user_id = at.updated_by')
        ->join('set_letter_head l','at.letter_head_id=l.letter_head_id','left')
        ->join('def_hr_salary_structure_is_active as s','at.salary_structure_is_active_id=s.salary_structure_is_active_id')
        ->join('def_hr_payroll_frquency as p','at.payroll_frequency_id=p.payroll_frequency_id','left')
        ->edit_column('at.salary_structure_id', get_ajax_buttons('$1', 'hr/Payroll/Salary_structure/'), 'at.salary_structure_id');	
        $this->datatables->edit_column('at.updated_on', '$1', 'get_date_timeformat(at.updated_on)');
        echo $this->datatables->generate();
	}

	//Autoload for Abbr in Earning
	public function getsalary_earnabbr()
	{
		$salary_component_id        = $this->input->post('salary_component_id');
		$constraint_array   		= array('salary_component_id' => $salary_component_id);
		$salary_component      		= $this->mcommon->specific_row_value('hr_salary_component', $constraint_array, 'salary_component_abbr');
		echo $salary_component;
	} 

	//Autoload for Abbr in Deduction
	public function getsalary_deductabbr()
	{
		$salary_component_id        = $this->input->post('salary_component_id');
		$constraint_array   		= array('salary_component_id' => $salary_component_id);
		$salary_component      		= $this->mcommon->specific_row_value('hr_salary_component', $constraint_array, 'salary_component_abbr');
		echo $salary_component;
	} 

	public function getToDate()
	{
	 	$FromDate = date('d-m-Y', strtotime($this->input->post('from_date')));
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
	
	/***********************************
			When a Detail Button is clicked in a table this forms will be loaded(i.e)ajaxTableContentForm 						
	******************************************/											
	public function EmployeeDetailsForm($Data = array())
	{
		$isFormLoad = TRUE;

		if (!empty($_POST)) 
		{
			//This will convert the string to array
			parse_str($_POST['postdata'], $_POST);

			//Checking Form Validation
			$this->form_validation->set_rules('base', lang('label_base'), 'required');

			if ($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('salary_structure_select_employee_id') == "")
				{
					$data 		=	array(
			                                'employee_id'        	=> $this->input->post('employee_id'),
			                                'employee_name'        	=> $this->input->post('employee_name'),
			                                'from_date'        		=> date('Y-m-d',strtotime($this->input->post('from_date'))),
			                                'to_date'        		=> date('Y-m-d',strtotime($this->input->post('to_date'))),
			                                'base'        			=> $this->input->post('base'),
			                                'variable'        		=> $this->input->post('variable'),  	                                 
									 	);
					$result 	=	$this->mcommon->common_insert('hr_salary_structure_select_employee', $data);

					if($result)
					{
						$this->session->set_flashdata('msg', 'Saved Successfully');
						$this->session->set_flashdata('alertType', 'success');
						$ajaxResponse['result'] = 'success';
					}
				}
			}
		}
		if($isFormLoad)
		{
			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Payroll/Salary_structure/ajaxTableContentForm';
			$this->load->view('hr/Payroll/form/ajax_form/salary_structure_ajax_table_content1', $Data);
		}
	}

	public function ComponentDeatilsForm($Data = array())
	{
		$isFormLoad = TRUE;

		if (!empty($_POST)) 
		{
			//This will convert the string to array
			parse_str($_POST['postdata'], $_POST);

			//Checking Form Validation
			$this->form_validation->set_rules('amount', lang('amount'), 'required');

			if ($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('training_result_employee_id') == "")
				{
					$data 		=	array(
			                                'salary_component_id'		=> $this->input->post('salary_component_id'),
			                                //'condition'        			=> $this->input->post('condition'),
			                                'amount_based_on_formula'   => ($this->input->post('amount_based_on_formula')) ? '1' : '0',
			                                'formula'        			=> $this->input->post('formula'),
			                                'amount'        			=> $this->input->post('amount'),
			                                'depends_on_lwp'  		 	=> ($this->input->post('depends_on_lwp')) ? '1' : '0',			                                 
									 	);
					$result 	=	$this->mcommon->common_insert('hr_earning', $data);

					if($result)
					{
						$this->session->set_flashdata('msg', 'Saved Successfully');
						$this->session->set_flashdata('alertType', 'success');
						$ajaxResponse['result'] = 'success';
					}
				}				
			}
		}
		if($isFormLoad)
		{
			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Payroll/Salary_structure/ComponentDeatilsForm';
			$this->load->view('hr/Payroll/form/ajax_form/salary_structure_earn_ajax_table_content', $Data);
		}
	}

	public function ajaxTableContentForm3($Data = array())
	{
		$isFormLoad = TRUE;

		if (!empty($_POST)) 
		{
			//This will convert the string to array
			parse_str($_POST['postdata'], $_POST);

			//Checking Form Validation
			$this->form_validation->set_rules('salary_component_id', lang('label_salary_component'), 'required');

			if ($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('training_result_employee_id') == "")
				{
					$data 		=	array(
			                                'salary_component_id'		=> $this->input->post('salary_component_id'),
			                                'condition'        			=> $this->input->post('condition'),
			                                'amount_based_on_formula'   => ($this->input->post('amount_based_on_formula')) ? '1' : '0',
			                                'formula'        			=> $this->input->post('formula'),
			                                'amount'        			=> $this->input->post('amount'),
			                                'depends_on_lwp'  		 	=> ($this->input->post('depends_on_lwp')) ? '1' : '0',			                                 
									 	);
					$result 	=	$this->mcommon->common_insert('hr_salary_detail', $data);

					if($result)
					{
						$this->session->set_flashdata('msg', 'Saved Successfully');
						$this->session->set_flashdata('alertType', 'success');
						$ajaxResponse['result'] = 'success';
					}
				}				
			}
		}
		if($isFormLoad)
		{
			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Payroll/Salary_structure/ajaxTableContentForm3';
			$this->load->view('hr/Payroll/form/ajax_form/salary_structure_deduct_ajax_table_content', $Data);
		}
	}

	/**********************************
		When a Add new popup '+' Symbol is clicked this forms will loaded (i.e)Dropdown Popup Form

	***************************************/

	//Dropdown url Letter Head
	public function ajaxDropdownLetterHead($Data = array())
	{
		$isFormLoad = TRUE;

		if(!empty($_POST))
		{
			//This will convert the string to array
			parse_str($_POST['postdata'], $_POST);

			//Checking Form Validation
			$this->form_validation->set_rules('letter_head_name', lang('label_letter_head_name'), 'required');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if ($this->input->post('letter_head_id') == '') 
				{
					$data  				= array(
												'letter_head_name' 		=> $this->input->post('letter_head_name') ,
												'is_disabled' 			=> ($this->input->post('is_disabled'))?'1':'0',
												'is_default' 			=> ($this->input->post('is_default'))?'1':'0',
												'letter_head_content' 	=> $this->input->post('letter_head_content') ,
												'letter_head_footer' 	=> $this->input->post('letter_head_footer') ,
												'created_by'			=> $this->auth_user_id,
												'created_on'			=> date('Y-m-d H:i:s'),
												'updated_by'			=> $this->auth_user_id,
												);
					$result       		= $this->mcommon->common_insert('set_letter_head', $data);	
				
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
					$data  				= array(
												'letter_head_name' 		=> $this->input->post('letter_head_name') ,
												'is_disabled' 			=> ($this->input->post('is_disabled'))?'1':'0',
												'is_default' 			=> ($this->input->post('is_default'))?'1':'0',
												'letter_head_content' 	=> $this->input->post('letter_head_content') ,
												'letter_head_footer' 	=> $this->input->post('letter_head_footer') ,
												'updated_by'			=> $this->auth_user_id,

												);
					$where_array    	= array('letter_head_id' => $this->input->post('letter_head_id'));
					$result      		= $this->mcommon->common_edit('set_letter_head', $data, $where_array);
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
				$constraint_array 	=	array('letter_head_id' 	=>	 $this->input->get('pkey_id'));
				$Data['tableData']	=	$this->mcommon->records_all('set_letter_head', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   	= 	'setting/Printing_settings/Letter_head/ajaxLoadForm';
			$this->load->view('setting/Printing_settings/form/Letter_head_form', $Data);
		}
	}

	//Dropdown url Salary Component
	public function ajaxDropdownSalaryComponent($Data = array())
	{
	    $isFormLoad = TRUE;

	    if(!empty($_POST))
	    { 
	      //This will convert the string to array
		    parse_str($_POST['postdata'], $_POST);
		        
		        $this->form_validation->set_rules('salary_component', lang('label_name'), 'trim|required');
		        $this->form_validation->set_rules('salary_component_abbr', lang('label_abbreviation'), 'trim|required');
		        $this->form_validation->set_rules('salary_component_type_id', lang('label_type'), 'trim|required');
		        
		        if($this->form_validation->run() == TRUE)
		        {
		          if($this->input->post('salary_component_id') == "")
		          {              
		            //insert function without id
		           $data   = array(   
		                            'salary_component'    				=> $this->input->post('salary_component'),
		                            'salary_component_abbr'    			=> $this->input->post('salary_component_abbr'),    
		                            'salary_component_type_id'			=> $this->input->post('salary_component_type_id'),
		                            'description' 			   			=> $this->input->post('description'),
		                            'created_on'          				=> date('Y-m-d H:i:s'),
		                            'created_by'          				=> $this->auth_user_id,
		                            'updated_by'          				=> $this->auth_user_id
		                            );  
		            $this->db->trans_start();         
			        $result = $this->mcommon->common_insert('hr_salary_component',$data); 

			        $data1  = array(
			        				'salary_component_id'				=> $result,
			        				'company_id'						=> $this->input->post('company_id'),
			        				'default_account' 					=> $this->input->post('default_account'),
			        				'created_on'          				=> date('Y-m-d H:i:s'),
		                            'created_by'          				=> $this->auth_user_id,
		                            'updated_by'          				=> $this->auth_user_id
			        				);
			        $result1 = $this->mcommon->common_insert('hr_salary_component_account', $data1);
			        $this->db->trans_complete();
		            if($result)
		            {
		              $this->session->set_flashdata('msg', 'Saved Successfully');
		              $this->session->set_flashdata('alertType', 'success');
		              //redirect(base_url('sales/Setup/Terms_and_conditions_template/add'));
		              $ajaxResponse['result'] = 'success';
		            }
		          }
		          else
		          {
		            $data = array(
		                        'salary_component'    					=> $this->input->post('salary_component'),
		                        'salary_component_abbr'    				=> $this->input->post('salary_component_abbr'),    
		                        'salary_component_type_id'				=> $this->input->post('salary_component_type_id'),
		                        'description' 			   				=> $this->input->post('description'),
		                        'updated_by'         					=> $this->auth_user_id
		                        );
		            
		            $where_array  = array('salary_component_id' =>    $this->input->post('salary_component_id'));
		            
		            $this->db->trans_start();         
			        $result = $this->mcommon->common_edit('hr_salary_component',$data, $where_array); 
			        $data1  = array(
			        				
			        				'company_id'						=> $this->input->post('company_id'),
			        				'default_account' 					=> $this->input->post('default_account'),
			        				'updated_by'         				=> $this->auth_user_id
			        				);
			        $result1 = $this->mcommon->common_edit('hr_salary_component_account', $data1, $where_array);

			        $this->db->trans_complete();
		            
		            if($result || $result1)
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
				$constraint_array 	=	array('salary_component_id' 	=>	 $this->input->get('pkey_id'));
				$Data['tableData']	=	$this->mcommon->records_all('hr_salary_component', $constraint_array);

				$constraint_array1 	=	array('salary_component_account_id' 	=>	 $this->input->get('pkey_id'));
				$Data['tableData1']	=	$this->mcommon->records_all('hr_salary_component_account', $constraint_array);		
			}

		    //Ajax Form Load
		    $Data['ActionUrl']   	=  'hr/Payroll/Salary_components/ajaxLoadForm';
		    $this->load->view('hr/Payroll/form/Salary_components_form', $Data);
	    }
 	}

	//Dropdown url form for Mode Of Payment
 	public function ajaxDropdownModePayment($Data = array())
	{
		$isFormLoad = TRUE;

		if(!empty($_POST))
		{
			//This will convert the string to array
			parse_str($_POST['postdata'], $_POST);

			//Checking Form Validation
			$this->form_validation->set_rules('mode_of_payment', lang('label_mode_of_payment'), 'required');			
			$this->form_validation->set_rules('mode_of_payment_type_id', lang('label_type'), 'required');

			//$company_idArr      = $this->input->post('company_id[]');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('mode_of_payment_id') == "")
				{
						$data 			= array(
												'mode_of_payment' 		  	=> $this->input->post('mode_of_payment'),
												'mode_of_payment_type_id' 	=> $this->input->post('mode_of_payment_type_id'),
												'created_by'           	  	=> $this->auth_user_id,
				                                'created_on'          	  	=> date('Y-m-d H:i:s'),
				                                'updated_by'              	=> $this->auth_user_id,
				                                'updated_on'              	=> date('Y-m-d H:i:s')
								 				);	
						$result       	= $this->mcommon->common_insert('acc_mode_of_payment', $data);
					
		                $Companydata 	= array(
		                                        'mode_of_payment_id' 		=> $result,
		                                        'company_id'         		=>  $this->input->post('company_id')
		                                    	);
		                $result1 		=   $this->mcommon->common_insert('acc_mode_of_payment_account', $Companydata);

					if($result1)
					{
						$this->session->set_flashdata('msg', 'Saved Successfully');
						$this->session->set_flashdata('alertType', 'success');
						//redirect(base_url('sales/Setup/Terms_and_conditions_template/add'));
						$ajaxResponse['result'] = 'success';
					}
				}
				//Edit function calling
				else
				{
					$data 				= array(
												'mode_of_payment' 		  	=> $this->input->post('mode_of_payment'),
												'mode_of_payment_type_id' 	=> $this->input->post('mode_of_payment_type_id'),
												'create_by'           	  	=> $this->auth_user_id,
				                                'created_on'          	  	=> date('Y-m-d H:i:s'),
				                                'updated_by'              	=> $this->auth_user_id,
				                                'updated_on'              	=> date('Y-m-d H:i:s')
								 				);	
					$result       		= $this->mcommon->common_insert('acc_mode_of_payment', $data);
					
					foreach ($company_idArr as $key => $value) 
		              {
		                $Companydata = array(
	                                        'mode_of_payment_id' 		=> $result,
	                                        'company_id'         		=> $company_idArr[$key],
		                                    );
		                $result1 	=   $this->mcommon->common_insert('acc_mode_of_payment_account', $Companydata);
		              }
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
				$constraint_array 	=	array('mode_of_payment_id' 	=>	 $this->input->get('pkey_id'));
				$Data['tableData']	=	$this->mcommon->records_all('acc_mode_of_payment', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   	= 	'accounts/Setup/Mode_of_payment/ajaxLoadForm';
			$this->load->view('accounts/Setup/form/mode_of_payment_form', $Data);
		}
	}

	//Dropdown for Payment Account
	public function ajaxDropdownAccount($Data = array())
	{
	    $isFormLoad = TRUE;

	    if(!empty($_POST))
	    {
	      //This will convert the string to array
	      parse_str($_POST['postdata'], $_POST);
	        
	        $this->form_validation->set_rules('account_name', lang('label_account_name'), 'trim|required');
	        $this->form_validation->set_rules('tax_rate',lang('label_rate'), 'trim|required');

	        if($this->form_validation->run() == TRUE)
	        {
	          if($this->input->post('account_id') == "")
	          {              
	            //insert function without id
	           $parent_account			=	$this->input->post('parent_account');
	           $data   = array(   
	           					'account_name'				=>	$this->input->post('account_name'),
	                            'is_group'					=>	($this->input->post('is_group'))?'1' : '0',
	                            'company_id'				=>	$this->input->post('company_id'),
	                            'account_root_type_id'		=>	$this->input->post('account_root_type_id'),
	                            'account_report_type_id'	=>	$this->input->post('account_report_type_id'),
	                            'currency_id'				=>	$this->input->post('currency_id'),
	                            'parent_account' 			=>  (empty($parent_account) ? NULL : $parent_account),
	                            'account_account_type_id'	=>	$this->input->post('account_account_type_id'),
	                            'tax_rate'					=>	$this->input->post('tax_rate'),
	                            'account_freeze_account_id'	=>	$this->input->post('account_freeze_account_id'),
	                            'account_balance_must_be_id'=>	$this->input->post('account_balance_must_be_id'),
	                            'created_on'    			=>  date('Y-m-d H:i:s'),
								'created_by'    			=>  $this->auth_user_id,
								'updated_by'				=>  $this->auth_user_id
	                            );           
	            $result = $this->mcommon->common_insert('acc_account',$data); 

	            if($result)
	            {
	              $this->session->set_flashdata('msg', 'Saved Successfully');
	              $this->session->set_flashdata('alertType', 'success');
	              //redirect(base_url('sales/Setup/Terms_and_conditions_template/add'));
	              $ajaxResponse['result'] = 'success';
	            }
	          }
	          else
	          {
	            $data = array(
	            				'account_name'				=>	$this->input->post('account_name'),
	                            'is_group'					=>	$this->input->post('is_group'),
	                            'company_id'				=>	$this->input->post('company_id'),
	                            'account_root_type_id'		=>	$this->input->post('account_root_type_id'),
	                            'account_report_type_id'	=>	$this->input->post('account_report_type_id'),
	                            'currency_id'				=>	$this->input->post('currency_id'),
	                            'parent_account' 			=>  (empty($parent_account) ? NULL : $parent_account),
	                            'account_account_type_id'	=>	$this->input->post('account_account_type_id'),
	                            'tax_rate'					=>	$this->input->post('tax_rate'),
	                            'account_freeze_account_id'	=>	$this->input->post('account_freeze_account_id'),
	                            'account_balance_must_be_id'=>	$this->input->post('account_balance_must_be_id'),
	                        	'updated_by'				=> $this->auth_user_id
	                        );
	            
	            $where_array  = array('account_id' 			=>    $this->input->post('account_id'));
	            
	            $result=$this->mcommon->common_edit('acc_account',$data,$where_array);
	            
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
	        $constraint_array   = array('account_id'  =>   $this->input->get('pkey_id'));
	        $Data['tableData']  = $this->mcommon->records_all('acc_account', $constraint_array);
	      }

	      //Ajax Form Load
	      $Data['ActionUrl']   	=  'accounts/Company_and_accounts/Chart_of_Accounts/ajaxLoadForm';
	      $this->load->view('accounts/Company_and_accounts/form/Chart_of_Accounts_form', $Data);
	    }
	}
}
?>	