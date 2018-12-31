<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Training_result extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Load language
		$this->lang->load("hr","english");
		$this->lang->load("validation_lang","english");
		// Load Form and Form Validation
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model("menu_model", "menu");
		$this->load->library("multi_menu");
		//$this->multi_menu->set_items($items);
		$items = $this->menu->all();
		// Check the user is loggedin or not
		$this->is_logged_in();
	}

	public function index($Data=array())
  	{
  		if( $this->acl_permits('HR.training_result') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Training_result_form_heading'),
								'form_title' 		=> $this->lang->line('Training_result_form_title'),
								'form_description' 	=> $this->lang->line('Training_result_form_description'),
								'list_heading' 		=> $this->lang->line('Training_result_form_heading'),
								'list_title' 		=> $this->lang->line('Training_result_form_title'),
								'list_description' 	=> $this->lang->line('Training_result_form_description'),
								'formUrl' 			=> 'hr/Training/Training_result/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview'		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Event Name', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Training/Training_result/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Training_result_form_heading'),
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

		if (!empty($_POST)) 
		{
			//This will convert the string to array
			parse_str($_POST['postdata'], $_POST);

			$employee_idArr        			= $this->input->post('employee_id');
            $hoursArr        		 		= $this->input->post('hours');
            $gradeArr        				= $this->input->post('grade');
            $commentsArr        			= $this->input->post('comments');
            $training_result_employee_idArr	= $this->input->post('training_result_employee_id');
			//Checking Form Validation
			$this->form_validation->set_rules('training_event_id', lang('label_event_name'), 'required');

			if ($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('training_result_id') == "")
				{
					$data 		=	array(
											'training_event_id'  	=> $this->input->post('training_event_id'),
											'created_on'       		=> date('Y-m-d H:i:s'),
											'updated_on'       		=> date('Y-m-d H:i:s'),
			                                'created_by'       		=> $this->auth_user_id,
			                                'updated_by'       		=> $this->auth_user_id
									 	);
					$result 	=	$this->mcommon->common_insert('hr_training_result', $data);


					foreach ($hoursArr as $key => $value) 
					{
						$dataEmployee 	=	array(
													'training_result_id'	=>	$result,
													'employee_id'			=>	$employee_idArr[$key],
													'hours'					=>	$hoursArr[$key],
													'grade'					=>	$gradeArr[$key],
													'comments'				=>	$commentsArr[$key]
												 );

						$resultEmployee =	$this->mcommon->common_insert('hr_training_result_employee', $dataEmployee);
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
					$data 			=	array(
												'training_event_id'  	=> $this->input->post('training_event_id'),
												'updated_on'       		=> date('Y-m-d H:i:s'),
												'updated_by'       		=> $this->auth_user_id
										 	);
					$where_array 	=	array('training_result_id'  =>	$this->input->post('training_result_id'));
					$result 		=	$this->mcommon->common_edit('hr_training_result', $data, $where_array);
					
					foreach ($hoursArr as $key => $value) 
					{
						$dataEmployee 		=	array(
														'employee_id'			=>	$employee_idArr[$key],
														'hours'					=>	$hoursArr[$key],
														'grade'					=>	$gradeArr[$key],
														'comments'				=>	$commentsArr[$key]
												 	);
						if($training_result_employee_idArr[$key] != '')
						{
							$where_array1 	=	array('training_result_employee_id'  => $training_result_employee_idArr[$key]);
							$result1 		=	$this->mcommon->common_edit('hr_training_result_employee', $dataEmployee, $where_array1);
							$success[]      = 	$result1;
						}
						else
						{
							$dataEmployee['training_result_id']		=	$this->input->post('training_result_id');
							$resultUpdateEmp 						=	$this->mcommon->common_insert('hr_training_result_employee', $dataEmployee);
						}
					}

					if(in_array("1", $success) || $resultUpdateEmp)
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
				$constraint_array 	=	array('training_result_id' =>	 $pkey_id);
				$Data['tableData1']	=	$this->mcommon->records_all('hr_training_result_employee', $constraint_array);
				$Data['tableData']	=	$this->mcommon->records_all('hr_training_result', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']    =  'hr/Training/Training_result/ajaxLoadForm';
			$Data['contentUrl']   =	 'hr/Training/Training_result/ajaxTableContentForm';
			$Data['dropdownUrl']  =	 'hr/Training/Training_result/ajaxDropdownPopupForm';
			$this->load->view('hr/Training/form/Training_result_form', $Data);
		}
	}

	public function delete($training_result_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
								    'updated_by' => $this->auth_user_id
								 );
		$where_array 	=	array('training_result_id'  => $training_result_id );
		$result 		=	$this->mcommon->common_edit('hr_training_result', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('hr/Training/Training_result/'));
		}
	}

	public function datatable()
	{
	    $this->datatables->select('ht.training_result_id, hte.event_name, ht.updated_on, CONCAT(up.first_name, " ", up.last_name)')
	    ->from('hr_training_result as ht')
	    ->join('hr_training_event as hte', 'hte.training_event_id = ht.training_event_id AND hte.is_delete = 0')
	    ->join('user_profile as up', 'up.user_id = ht.updated_by')     
    	->where('ht.is_delete', '0')
	    //->join('hr_training_result_employee as hre', 'hre.training_result_id = ht.training_result_id')
	    ->edit_column('ht.training_result_id', get_ajax_buttons('$1', 'hr/Training/Training_result/'), 'ht.training_result_id');
	    $this->datatables->edit_column('ht.updated_on', '$1', 'get_date_timeformat(ht.updated_on)');
		$this->db->order_by('ht.updated_on',DESC);
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
			$this->form_validation->set_rules('employee_id', lang('label_employee'), 'required');

			if ($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('training_result_employee_id') == "")
				{
					$data 		=	array(
			                                'employee_id'        	=> $this->input->post('employee_id'),
			                                'employee_name'        	=> $this->input->post('employee_name'),
			                                'hours'        		 	=> $this->input->post('hours'),
			                                'grade'        			=> $this->input->post('grade'),
			                                'comments'        		=> $this->input->post('comments'),  
									 	);
					$result 	=	$this->mcommon->common_insert('hr_training_result_employee', $data);

					if($result)
					{
						$this->session->set_flashdata('msg', 'Saved Successfully');
						$this->session->set_flashdata('alertType', 'success');
						$ajaxResponse['result'] = 'success';
					}
				}
				else
				{
					$data 			=	array(
												'employee_id'        	=> $this->input->post('employee_id'),
				                                'employee_name'        	=> $this->input->post('employee_name'),
				                                'hours'        		 	=> $this->input->post('hours'),
				                                'grade'        			=> $this->input->post('grade'),
				                                'comments'        		=> $this->input->post('comments'),  
										 	 );
					$where_array 	=	array('training_result_employee_id'  =>$this->input->post('training_result_employee_id')
											 );
					$result 		=	$this->mcommon->common_edit('hr_training_result_employee', $data, $where_array);

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
				$constraint_array 	=	array('training_result_employee_id' =>	 $this->input->get('pkey_id'));
				$Data['tableData']	=	$this->mcommon->records_all('hr_training_result_employee', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Training/Training_result/ajaxTableContentForm';
			$this->load->view('hr/Training/form/ajax_form/training_result_ajax_table_content', $Data);
		}
	}

	/*public function ajaxDropdownPopupForm($Data = array())
	{
		$isFormLoad = TRUE;

		if(!empty($_POST))
		{
			//This will convert the string to array
			parse_str($_POST['postdata'], $_POST);

			//Checking Form Validation
			$this->form_validation->set_rules('event_name', lang('label_event_name'), 'trim|required');
			$this->form_validation->set_rules('training_event_type_id', lang('label_trainer_name'), 'trim|required');
			$this->form_validation->set_rules('training_eve_event_status_id', lang('label_trainer_name'), 'trim|required');
			$this->form_validation->set_rules('start_time', lang('label_trainer_name'), 'trim|required');
			$this->form_validation->set_rules('end_time', lang('label_trainer_name'), 'trim|required');
			$this->form_validation->set_rules('location', lang('label_trainer_name'), 'trim|required');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('training_event_id') == "")
				{
					$data     = array(
										'event_name'                    => $this->input->post('event_name'),
										'training_eve_event_status_id'  => $this->input->post('training_eve_event_status_id'),
										'training_event_type_id'        => $this->input->post('training_event_type_id'),
										'trainer_id'                    => $this->input->post('trainer_id'),
										'trainer_email'                 => $this->input->post('trainer_email'),
										'contact_number'                => $this->input->post('contact_number'),
										'company_id'                    => $this->input->post('company_id'),
										'course_id'                     => $this->input->post('course_id'),
										'location'                      => $this->input->post('location'),
										'start_time '                   => date('Y-m-d H:i:s',strtotime($this->input->post('start_time'))),
										'end_time'                      => date('Y-m-d H:i:s',strtotime($this->input->post('end_time'))),
										'introduction'                  => $this->input->post('introduction'),
										'created_on'                    => date('Y-m-d H:i:s'),
										'created_by'                    => $this->auth_user_id,
										'updated_by'                    => $this->auth_user_id
									);
					$result   = $this->mcommon->common_insert('hr_training_event', $data);

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
					$data       = array(
										'event_name'                    => $this->input->post('event_name'),
										'training_eve_event_status_id'  => $this->input->post('training_eve_event_status_id'),
										'training_event_type_id'        => $this->input->post('training_event_type_id'),
										'trainer_id'                    => $this->input->post('trainer_id'),
										'trainer_email'                 => $this->input->post('trainer_email'),
										'contact_number'                => $this->input->post('contact_number'),
										'company_id'                    => $this->input->post('company_id'),
										'course_id'                     => $this->input->post('course_id'),
										'location'                      => $this->input->post('location'),
										'start_time '                   => date('Y-m-d H:i:s',strtotime($this->input->post('start_time'))),
										'end_time'                      => date('Y-m-d H:i:s',strtotime($this->input->post('end_time'))),
										'introduction'                  => $this->input->post('introduction'),
										'updated_by'  => $this->auth_user_id
										);
					$where_array  = array('training_event_id'  =>$this->input->post('training_event_id'));
					$result       = $this->mcommon->common_edit('hr_training_event', $data, $where_array);

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
			$constraint_array   = array('training_event_id'   =>   $this->input->get('pkey_id'));
			$Data['tableData']  = $this->mcommon->records_all('hr_training_event', $constraint_array);
		}

		//Ajax Form Load
		$Data['ActionUrl']   = 'hr/Training/Training_event/ajaxLoadForm';
		$this->load->view('hr/Training/form/Training_event_form', $Data);
		}
	}*/
}