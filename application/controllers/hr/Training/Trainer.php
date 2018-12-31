<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trainer extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Load language
		$this->lang->load("hr","english");
		// Load Form and Form Validation
	    $this->lang->load("validation_lang","english");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model("menu_model", "menu");
		$this->load->library("multi_menu");
		//$this->multi_menu->set_items($items);
		$items = $this->menu->all();
		// Check the user is loggedin or not
   	 	$this->load->library('upload');
		$this->is_logged_in();
	}

	public function index($Data=array())
  	{
  		if( $this->acl_permits('HR.trainer') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Trainer_form_heading'),
								'form_title' 		=> $this->lang->line('Trainer_form_title'),
								'form_description' 	=> $this->lang->line('Trainer_form_description'),
								'list_heading' 		=> $this->lang->line('Trainer_form_heading'),
								'list_title' 		=> $this->lang->line('Trainer_form_title'),
								'list_description' 	=> $this->lang->line('Trainer_form_description'),
								'formUrl' 			=> 'hr/Training/Trainer/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview'		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Trainer Name', 'Trainer Mail', 'Trainer Contact No','Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Training/Trainer/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Trainer_form_heading'),
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

			//Checking Form Validation
			$this->form_validation->set_rules('trainer_name', lang('label_trainer_name'), 'required|callback_alpha_dash_space');
			$this->form_validation->set_rules('trainer_email', lang('label_trainer_mail'), 'required|valid_email');
			$this->form_validation->set_rules('trainer_contact', lang('label_trainer_contact_no'), 'required|numeric');
			$this->form_validation->set_rules('company_id', lang('label_trainer_company'), 'required');
			if ($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('trainer_id') == "")
				{
					if($_FILES['trainer_profile']['name'] != '')
					{
						$config = array();
						$config['upload_path']      = './upload/hr/trainer_profile/';
						$config['allowed_types']    = '*';
						$config['max_size']         = '0';
						$config['max_width']        = '3500';
						$config['max_height']       = '3500';
						$config['max_filename']     = '500';
						$config['overwrite']        = false;
						$this->upload->initialize($config);
						$this->load->library('image_lib');
						$this->load->library('upload', $config);

						if($this->upload->do_upload('trainer_profile'))
						{ 
							$this->load->helper('inflector');
							$file_name              =   underscore($_FILES['trainer_profile']['name']);
							$config['file_name']    =   $file_name;
							$image_data['message']  =   $this->upload->data(); 
							$_POST['trainer_profile']      =   "upload/hr/trainer_profile/".$image_data['message']['file_name'];
						} 
						else
						{
							$data['trainer_profile']   = $this->upload->display_errors('<div class="alert alert-error">', '</div>');
							$this->form_validation->set_rules('trainer_profile', $this->upload->display_errors(), 'required');    
							$_POST['trainer_profile']  =   '';
						}
					}
					else
					{
						$_POST['trainer_profile']   =   '';
					}

					$data 		=	array(
											'trainer_name' 			=> 	$this->input->post('trainer_name'),
											'trainer_email' 		=>	$this->input->post('trainer_email'),
											'company_id' 			=> 	$this->input->post('company_id'),
											'trainer_contact' 		=> 	$this->input->post('trainer_contact'),
											'trainer_profile' 		=> 	$this->input->post('trainer_profile'),
											'created_on'    		=> 	date('Y-m-d H:i:s'),
                                			'updated_on'			=>  date('Y-m-d H:i:s'),
											'created_by'    		=> 	$this->auth_user_id,
											'updated_by'			=> 	$this->auth_user_id
									 	);
					$result 	=	$this->mcommon->common_insert('hr_trainer', $data);

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
					if($_FILES['trainer_profile']['name'] != '')
					{
						$config = array();
						$config['upload_path']      = './upload/hr/trainer_profile/';
						$config['allowed_types']    = '*';
						$config['max_size']         = '0';
						$config['max_width']        = '3500';
						$config['max_height']       = '3500';
						$config['max_filename']     = '500';
						$config['overwrite']        = false;
						$this->upload->initialize($config);
						$this->load->library('image_lib');
						$this->load->library('upload', $config);

						if($this->upload->do_upload('trainer_profile'))
						{ 
							$this->load->helper('inflector');
							$file_name              =   underscore($_FILES['trainer_profile']['name']);
							$config['file_name']    =   $file_name;
							$image_data['message']  =   $this->upload->data(); 
							$_POST['trainer_profile']      =   "upload/hr/trainer_profile/".$image_data['message']['file_name'];
						} 
						else
						{
							$data['trainer_profile']   = $this->upload->display_errors('<div class="alert alert-error">', '</div>');
							$this->form_validation->set_rules('trainer_profile', $this->upload->display_errors(), 'required');    
							$_POST['trainer_profile']  =   '';
						}

						$data 			=	array(
													
												'trainer_name' 			=> 	$this->input->post('trainer_name'),
												'trainer_email' 		=>	$this->input->post('trainer_email'),
												'company_id' 			=> 	$this->input->post('company_id'),
												'trainer_contact' 		=> 	$this->input->post('trainer_contact'),
												'trainer_profile' 		=> 	$this->input->post('trainer_profile'),
                                				'updated_on'			=> date('Y-m-d H:i:s'),
												'updated_by'			=> $this->auth_user_id
											 );
						$where_array 	=	array(
													'trainer_id'  =>$this->input->post('trainer_id')
												 );
						$result 		=	$this->mcommon->common_edit('hr_trainer', $data, $where_array);
					}
					else
					{

						$data 			=	array(
													
												'trainer_name' 			=> 	$this->input->post('trainer_name'),
												'trainer_email' 		=>	$this->input->post('trainer_email'),
												'company_id' 			=> 	$this->input->post('company_id'),
												'trainer_contact' 		=> 	$this->input->post('trainer_contact'),
												'trainer_profile' 		=> 	$this->input->post('trainer_profile_update'),
                                				'updated_on'			=> date('Y-m-d H:i:s'),
												'updated_by'			=> $this->auth_user_id
											 );
						$where_array 	=	array(
													'trainer_id'  =>$this->input->post('trainer_id')
												 );
						$result 		=	$this->mcommon->common_edit('hr_trainer', $data, $where_array);						
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
			if($pkey_id != '')
			{
				$constraint_array 	=	array('trainer_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('hr_trainer', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Training/Trainer/ajaxLoadForm';
			$this->load->view('hr/Training/form/Trainer_form', $Data);
		}
	}

	public function delete($trainer_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('trainer_id'  =>$trainer_id );
		$result 		=	$this->mcommon->common_edit('hr_trainer', $data, $where_array);
		$this->mcommon->common_edit('hr_training_event', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('hr/Training/Trainer/'));
		}
	}

	public function datatable()
	{
	    //Datatable Create
	    $this->datatables->select('tnr.trainer_id, tnr.trainer_name, tnr.trainer_email, tnr.trainer_contact, tnr.updated_on,CONCAT(up.first_name, " ", up.last_name)')
	    ->from('hr_trainer as tnr')
	    ->join('user_profile as up', 'up.user_id = tnr.updated_by')
	    ->where('tnr.is_delete', 0)
	    ->edit_column('tnr.trainer_id', trainer_buttons('$1', 'hr/Training/Trainer'), 'tnr.trainer_id');
		$this->datatables->edit_column('tnr.updated_on', '$1', 'get_date_timeformat(tnr.updated_on)');
		$this->db->order_by('tnr.updated_on', DESC);
	   // $this->datatables->unset_column('s_no');
	   //$this->datatables ->edit_column('a.status', '$1', 'getStatus(a.status)');
	    echo $this->datatables->generate();  
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

	//Check Trainer have already assiged to program
	public function checkTrainer($trainer_id='')
	{
		$trainer_id  = $this->input->get('trainer_id');
		$checkExisit = $this->mcommon->specific_record_counts('hr_training_program', array('trainer_id' => $trainer_id));
		echo $checkExisit;
	}
}
?>