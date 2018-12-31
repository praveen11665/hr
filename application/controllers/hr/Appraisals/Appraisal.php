<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appraisal extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Force SSL
		//$this->force_ssl();

		// Load language
		$this->lang->load("hr","english");

		// Load Form and Form Validation
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->lang->load("validation_lang","english");

		// Check the user is loggedin or not
		$this->is_logged_in();
	}

	public function index($Data=array())
  	{
  		if( $this->acl_permits('HR.appraisal') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Appraisals_form_heading'),
								'form_title' 		=> $this->lang->line('Appraisals_page_title'),
								'form_description' 	=> $this->lang->line('Appraisals_form_description'),
								'list_heading' 		=> $this->lang->line('Appraisals_form_heading'),
								'list_title' 		=> $this->lang->line('Appraisals_page_title'),
								'list_description' 	=> $this->lang->line('Appraisals_form_description'),
								'formUrl' 			=> 'hr/Appraisals/Appraisal/ajaxLoadForm',
								'list_view' 		=> TRUE,
	                        	'buttonview'        => TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action','Appraisal Template Title', 'Employee Name', 'Start Date', 'End Date', 'Status', 'goals');

			$view_data['dataTableUrl']   =	 'hr/Appraisals/Appraisal/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Appraisals_page_title'),
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

			$kraArr 				=	$this->input->post('kra');
			$weight_ageArr  		=	$this->input->post('weight_age');
			$scoreArr 				= 	$this->input->post('score');
			$score_earnedArr		= 	$this->input->post('score_earned');
			$appraisal_goal_idArr	=	$this->input->post('appraisal_goal_id');
			//Checking Form Validation
			$this->form_validation->set_rules('naming_series', lang('label_series'), 'required');			
			$this->form_validation->set_rules('employee_name', lang('label_employee_name'), 'required');
			$this->form_validation->set_rules('appraisal_template_id', lang('label_appraisal_template'), 'required');
			$this->form_validation->set_rules('employee_id', lang('label_for_employee'), 'required');
			$this->form_validation->set_rules('appraisal_status_id', lang('label_status'), 'required');
			$this->form_validation->set_rules('start_date', lang('label_start_date'), 'required');
			$this->form_validation->set_rules('end_date', lang('label_end_date'), 'required');
			$this->form_validation->set_rules('company_id', lang('label_company'), 'required');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('appraisal_id') == "")
				{
					$naming         = $this->input->post('naming_series');       
          			$namingSeries   = $this->mcommon->generateSeries($naming,7);

					$data 			= array(
												'naming_series' 			=>$namingSeries,
												'appraisal_template_id' 	=>$this->input->post('appraisal_template_id'),
												'employee_id' 				=>$this->input->post('employee_id'),
												'employee_name' 			=>$this->input->post('employee_name'),
												'appraisal_status_id' 		=>$this->input->post('appraisal_status_id'),
												'start_date'   				=> date('Y-m-d', strtotime($this->input->post('start_date'))),
									            'end_date'   				=> date('Y-m-d', strtotime($this->input->post('end_date'))),

									            'total_score' 				=>$this->input->post('total_score'),
									            'remarks' 					=>$this->input->post('remarks'),
									            'company_id' 				=>$this->input->post('company_id'),
								 				);	
					$result       	= $this->mcommon->common_insert('hr_appraisal', $data);

					$where_array  	= array('transaction_id' => 7);

			        if($result)
			        {
			            $resultupdate = $this->mcommon->dataUpdate('set_naming_series', 'current_value', $where_array); 
			        }

			        foreach ($kraArr as $key => $value) 
			        {
			        	$data_goal   	= array(
												'appraisal_id'          	=> $result,
												'kra' 						=> $kraArr[$key],
												'weight_age' 				=> $weight_ageArr[$key],
												'score' 					=> $scoreArr[$key],
												'score_earned' 				=> $score_earnedArr[$key],
												);

						$result_goal  	= $this->mcommon->common_insert('hr_appraisal_goal', $data_goal);
			        }
					
					if($result_goal)
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
												'appraisal_template_id' 	=>$this->input->post('appraisal_template_id'),
												'employee_id' 				=>$this->input->post('employee_id'),
												'employee_name' 			=>$this->input->post('employee_name'),
												'appraisal_status_id' 		=>$this->input->post('appraisal_status_id'),
												'start_date'   				=> date('Y-m-d', strtotime($this->input->post('start_date'))),
									            'end_date'   				=> date('Y-m-d', strtotime($this->input->post('end_date'))),

									            'total_score' 				=>$this->input->post('total_score'),
									            'remarks' 					=>$this->input->post('remarks'),
									            'company_id' 				=>$this->input->post('company_id'),
								 				);	
					$where_array    	= array('appraisal_id' => $this->input->post('appraisal_id'));
				    $result       		= $this->mcommon->common_edit('hr_appraisal', $data, $where_array);


				    foreach ($kraArr as $key => $value) 
			        {
			        	$data_goal   	= array(
												'kra' 						=> $kraArr[$key],
												'weight_age' 				=> $weight_ageArr[$key],
												'score' 					=> $scoreArr[$key],
												'score_earned' 				=> $score_earnedArr[$key],
												);
			        	if($appraisal_goal_idArr[$key] != "")
			        	{
			        		$where_array_goal		=	array('appraisal_goal_id' => $appraisal_goal_idArr[$key]);
			        		$result_goal       		= 	$this->mcommon->common_edit('hr_appraisal_goal', $data_goal, $where_array_goal);

			        	}

			        }
					
					if($result || $result_goal)
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
				$constraint_array 		=	array('appraisal_id' 	=>	 $pkey_id);
				$Data['tableData']		=	$this->mcommon->records_all('hr_appraisal', $constraint_array);

				$Data['tableDataGoal']	=	$this->mcommon->records_all('hr_appraisal_goal', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Appraisals/Appraisal/ajaxLoadForm';
			$this->load->view('hr/Appraisals/form/Appraisal_form', $Data);
		}
	}

	public function delete($appraisal_id='')
	{
		$where  = array('appraisal_id' => $appraisal_id);
		$result = $this->mcommon->common_delete('hr_appraisal', $where);
		
		if($result)
		{
			$this->session->set_flashdata('msg', 'Deleted Successfully');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('hr/Appraisals/Appraisal'));
		}
	}

	public function datatable()
	{
		//datatable joining 
		$this->datatables->select('a.appraisal_id, at.appraisal_temp_title, e.employee_name, a.start_date, a.end_date, s.status, a.total_score')
    	->from('hr_appraisal as a')
		->join('def_hr_appraisal_status as s', 's.appraisal_status_id = a.appraisal_status_id', 'left')
		->join('hr_appraisal_template as at', 'at.appraisal_template_id = a.appraisal_template_id', 'left')
		->join('hr_employee as e', 'e.employee_id = a.employee_id', 'left')
		->edit_column('a.appraisal_id', get_ajax_buttons('$1', 'hr/Appraisals/Appraisal/'), 'a.appraisal_id');
		$this->datatables->edit_column('a.start_date', '$1', 'get_date_format(a.start_date)');
		$this->datatables->edit_column('a.end_date', '$1', 'get_date_format(a.end_date)');
		echo $this->datatables->generate();
	}

	public function getAppraisalTemplate()
	{
		$appraisal_template_id 		= $this->input->post('appraisal_template_id');
		$constraint_array  	   		= array('appraisal_template_id' => $appraisal_template_id);
		$data['template'] 	   		= $this->mcommon->records_all('hr_appraisal_template_goal', $constraint_array);

		$dataArr['templateContent'] = 	$this->load->view('hr/Appraisals/form/Appraisal_ajax_form',$data,TRUE);
		echo json_encode($dataArr);
	}
}