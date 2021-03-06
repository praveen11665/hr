<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Training_feedback extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Load language
		$this->lang->load("validation_lang","english");
		$this->lang->load("hr","english");
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
  		if( $this->acl_permits('HR.training_feedback') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Training_feedback_form_heading'),
								'form_title' 		=> $this->lang->line('Training_feedback_form_title'),
								'form_description' 	=> $this->lang->line('Training_feedback_form_description'),
								'list_heading' 		=> $this->lang->line('Training_feedback_form_heading'),
								'list_title' 		=> $this->lang->line('Training_feedback_form_title'),
								'list_description' 	=> $this->lang->line('Training_feedback_form_description'),
								'formUrl' 			=> 'hr/Training/Training_feedback/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview'		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Employee Name', 'Training Event', 'Trainer Name', 'Feedback', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Training/Training_feedback/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Training_feedback_form_heading'),
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

			//Checking Form Validation
			$this->form_validation->set_rules('employee_id', lang('label_employee_id'), 'required');
			$this->form_validation->set_rules('training_event_id', lang('label_training_event'), 'required');
			$this->form_validation->set_rules('feedback', lang('label_feedback'), 'required');
			$this->form_validation->set_rules('course_id', lang('label_course'), 'required|callback_alpha_dash_space');

			if ($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('training_feedback_id') == "")
				{
					$data 		=	array(
											'employee_id'  		=> $this->input->post('employee_id'),
			                                'employee_name'     => $this->input->post('employee_name'),
			                                'course_id'         => $this->input->post('course_id'),
			                                'training_event_id' => $this->input->post('training_event_id'),
			                                'trainer_name' 		=> $this->input->post('trainer_name'),
			                                'feedback'        	=> $this->input->post('feedback'), 
			                                'created_on'       	=> date('Y-m-d H:i:s'),
			                                'updated_on'       	=> date('Y-m-d H:i:s'),
                                			'created_by'        => $this->auth_user_id,
                                			'updated_by'        => $this->auth_user_id 
									 	);
					$result 	=	$this->mcommon->common_insert('hr_training_feedback', $data);

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
												'employee_id'  		=> $this->input->post('employee_id'),
				                                'employee_name'     => $this->input->post('employee_name'),
				                                'course_id'         => $this->input->post('course_id'),
				                                'training_event_id' => $this->input->post('training_event_id'),
				                                'trainer_name' 		=> $this->input->post('trainer_name'),
				                                'feedback'        	=> $this->input->post('feedback'),  
				                                'updated_by'       	=> $this->auth_user_id,
			                                	'updated_on'       	=> date('Y-m-d H:i:s'),
									 	     );
					$where_array 	=	array('training_feedback_id'  =>$this->input->post('training_feedback_id'));
					$result 		=	$this->mcommon->common_edit('hr_training_feedback', $data, $where_array);

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
			if($pkey_id != '')
			{
				$constraint_array 	=	array('training_feedback_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('hr_training_feedback', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Training/Training_feedback/ajaxLoadForm';
			$this->load->view('hr/Training/form/Training_feedback_form', $Data);
		}
	}	

	public function delete($training_feedback_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' =>$this->auth_user_id									
							     );
		$where_array 	=	array('training_feedback_id'  => $training_feedback_id );
		$result 		=	$this->mcommon->common_edit('hr_training_feedback', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('hr/Training/Training_feedback/'));
		}
	}

	public function datatable()
	{
	    //Datatable Create
	    $this->datatables->select('htf.training_feedback_id, htf.employee_name, hte.event_name, htf.trainer_name, htf.feedback,htf.updated_on,CONCAT(up.first_name, " ", up.last_name)')
	    ->from('hr_training_feedback as htf')
	    ->join('user_profile as up', 'up.user_id = htf.updated_by')
	    ->join('hr_training_event as hte', 'hte.training_event_id = htf.training_event_id AND hte.is_delete = 0')
	    ->where('htf.is_delete', 0)
	    ->edit_column('htf.training_feedback_id', get_ajax_buttons('$1', 'hr/Training/Training_feedback/'), 'htf.training_feedback_id');
		$this->db->order_by('htf.updated_on',DESC);
		$this->datatables->edit_column('htf.updated_on', '$1', 'get_date_timeformat(htf.updated_on)');
	    echo $this->datatables->generate();  
    }

    public function getTranierName()
  	{
	    $training_event_id       = $this->input->post('training_event_id');
	    $constraint_array 		 = array('training_event_id' => $training_event_id); 
	    $trainer_id       		 = $this->mcommon->specific_row_value('hr_training_event', $constraint_array,'trainer_id');
	    
	    $constraint_array1 = array('trainer_id' => $trainer_id);  
	    $result['trainer_name']       = $this->mcommon->specific_row_value('hr_trainer', $constraint_array1,'trainer_name');									
	    echo json_encode($result);
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