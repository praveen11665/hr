<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Training_program extends MY_Controller
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
  		if( $this->acl_permits('HR.training_program') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Training_program_form_heading'),
								'form_title' 		=> $this->lang->line('Training_program_form_title'),
								'form_description' 	=> $this->lang->line('Training_program_form_description'),
								'list_heading' 		=> $this->lang->line('Training_program_form_heading'),
								'list_title' 		=> $this->lang->line('Training_program_form_title'),
								'list_description' 	=> $this->lang->line('Training_program_form_description'),
								'formUrl' 			=> 'hr/Training/Training_program/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview'		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Training Program', 'Trainer Name','Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Training/Training_program/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Training_program_page_title'),
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
			$this->form_validation->set_rules('training_program', 'training_program', 'required');
			$this->form_validation->set_rules('trainer_email', 'trainer_email', 'required');
			$this->form_validation->set_rules('trainer_contact', 'trainer_contact', 'required');

			if ($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('training_program_id') == "")
				{
					$data 		=	array(
											'training_program'  		=> $this->input->post('training_program'),
											'company_id'  				=> $this->input->post('company_id'),
											'def_training_status_id'  	=> $this->input->post('def_training_status_id'),
											'trainer_id'  				=> $this->input->post('trainer_id'),
											'trainer_email'  			=> $this->input->post('trainer_email'),
											//'supplier_id'  				=> $this->input->post('supplier_id'),
											'trainer_email'  			=> $this->input->post('trainer_email'),
											'trainer_contact'  			=> $this->input->post('trainer_contact'),
											'description'  				=> $this->input->post('description'),
											'created_on'       			=> date('Y-m-d H:i:s'),
                                  			'updated_on'            	=> date('Y-m-d H:i:s'),
			                                'created_by'       			=> $this->auth_user_id,
			                                'updated_by'       			=> $this->auth_user_id
									 	);
					$result 	=	$this->mcommon->common_insert('hr_training_program', $data);

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
												'training_program'  		=> $this->input->post('training_program'),
												'company_id'  				=> $this->input->post('company_id'),
												'def_training_status_id'  	=> $this->input->post('def_training_status_id'),
												'trainer_id'  				=> $this->input->post('trainer_id'),
												'trainer_email'  			=> $this->input->post('trainer_email'),
												//'supplier_id'  			=> $this->input->post('supplier_id'),
												'trainer_email'  			=> $this->input->post('trainer_email'),
												'trainer_contact'  			=> $this->input->post('trainer_contact'),
												'description'  				=> $this->input->post('description'),
                                  				'updated_on'            	=> date('Y-m-d H:i:s'),
												'updated_by'       			=> $this->auth_user_id
										 	);
					$where_array 	=	array('training_program_id'  =>	$this->input->post('training_program_id')
											 );
					$result 		=	$this->mcommon->common_edit('hr_training_program', $data, $where_array);

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
				$constraint_array 	=	array('training_program_id' =>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('hr_training_program', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']    =  'hr/Training/Training_program/ajaxLoadForm';
			////$Data['contentUrl']   =	 'hr/Training/Training_program/ajaxTableContentForm';
			$Data['dropdownUrl']  =	 'hr/Training/Training_program/ajaxDropdownPopupForm';
			$this->load->view('hr/Training/form/Training_program_form', $Data);
		}
	}

	public function delete($training_program_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('training_program_id'  =>$training_program_id);
		$result 		=	$this->mcommon->common_edit('hr_training_program', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('hr/Training/Training_program/'));
		}
	}

	public function datatable()
	{
	    $this->datatables->select('a.training_program_id, a.training_program, b.trainer_name, a.updated_on, CONCAT(up.first_name, " ", up.last_name)')
	    ->from('hr_training_program as a')
	   	->join('hr_trainer as b', 'b.trainer_id = a.trainer_id AND b.is_delete = 0')
	    ->join('user_profile as up', 'up.user_id = a.updated_by')     
    	->where('a.is_delete', '0')
	    ->edit_column('a.training_program_id', get_ajax_buttons('$1', 'hr/Training/Training_program/'), 'a.training_program_id')
	    ->edit_column('a.updated_on', '$1', 'get_date_timeformat(a.updated_on)');
	    $this->db->order_by('a.updated_on', DESC);
	    echo $this->datatables->generate();  
    }

  	public function gettrainerdetails()
	{
	    $where_array   =  array(
	                              'trainer_id'     => $this->input->post('trainer_id')
	                            );
	    $getarray      =  array(
	                                  'trainer_email', 
	                                  'trainer_contact'       
	                              );
	    $result= $this->mcommon->specific_fields_records_all('hr_trainer', $where_array, $getarray); 
	       foreach($result as $row)
	       {
	          $option    =   $row;
	       }
	    echo json_encode($option);
	}
}