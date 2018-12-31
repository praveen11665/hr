<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave_blocklist extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load("hr","english");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->is_logged_in();
		$this->load->model("menu_model", "menu");
		$items = $this->menu->all();
		$this->load->library("form_validation");
		$this->load->library("multi_menu");
	    $this->lang->load("validation_lang","english");
		$this->multi_menu->set_items($items);
 	}

	public function index($viewData = array())
  	{
  		if( $this->acl_permits('HR.leave_block_list') )
    	{		
	  		$view_data = array(
								'form_heading' 		=> $this->lang->line('Leave_blocklist_form_heading'),
								'form_title' 		=> $this->lang->line('Leave_blocklist_form_title'),
								'form_description' 	=> $this->lang->line('Leave_blocklist_form_description'),
								'formUrl' 			=> 'hr/Leaves_holiday/Leave_blocklist/ajaxLoadForm',
								'list_heading' 		=> $this->lang->line('Leave_blocklist_form_heading'),
								'list_title' 		=> $this->lang->line('Leave_blocklist_form_title'),
								'list_description' 	=> $this->lang->line('Leave_blocklist_form_description'),
								'list_view' 		=> TRUE,
								'buttonview'        => TRUE
							  );
	  		$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Leave Block List Name','Company Name','Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Leaves_holiday/Leave_blocklist/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Leave_blocklist_form_heading'),
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

			$block_dateArr						=	$this->input->post('block_date');  
			$leave_block_list_date_idArr		=	$this->input->post('leave_block_list_date_id');  
			$reasonArr							=	$this->input->post('reason');  
			$leave_block_list_allow_idArr		=	$this->input->post('leave_block_list_allow_id');  
			$user_idArr							=	$this->input->post('user_id');  

			//Checking Form Validation
			$this->form_validation->set_rules('leave_block_list_name', lang('label_leave_blocklist_name'), 'trim|required');
			$this->form_validation->set_rules('company_id', lang('label_company_name'), 'trim|required');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('leave_block_list_id') == "")
				{
		            $data   	= 	array( 
					                       'leave_block_list_name'   		=> $this->input->post('leave_block_list_name'),
					               			'company_id'   					=> $this->input->post('company_id'),
					            			'applies_to_all_departments'    => ($this->input->post('applies_to_all_departments'))?'1':'0',
					            			'created_on'    				=> date('Y-m-d H:i:s'),
					            			'updated_on'    				=> date('Y-m-d H:i:s'),
											'created_by'    				=> $this->auth_user_id,
											'updated_by'					=> $this->auth_user_id
				            		     );
		            $result 	=	$this->mcommon->common_insert('hr_leave_block_list', $data);
		 
			   	 	foreach ($block_dateArr as $key => $value)
			     	{
			            $dataBlockDate   	= 	array(  
						            					'leave_block_list_id'	=> $result,
								                        'block_date'			=> date('Y-m-d', strtotime($block_dateArr[$key])),
								                      	'reason'				=> $reasonArr[$key],
								                        'created_on'        	=> date('Y-m-d H:i:s'),
														'created_by'    		=> $this->auth_user_id,
														'updated_by'			=> $this->auth_user_id
							            		     );

			            $resultBlockDate 	=	$this->mcommon->common_insert('hr_leave_block_list_date', $dataBlockDate);
		            }

		            foreach ($user_idArr as $key => $value) 
		            {
		            	$dataAllowUser   	= 	array(  
					            					'leave_block_list_id'	=> $result,
							                        'user_id'  				=> $user_idArr[$key],
							                        'created_on'        	=> date('Y-m-d H:i:s'),
													'created_by'    		=> $this->auth_user_id,
													'updated_by'			=> $this->auth_user_id
						            		     );

						$resultAllowUser 	=	$this->mcommon->common_insert('hr_leave_block_list_allow', $dataAllowUser);
		            }

					if($result || $resultBlockDate || $resultAllowUser)
					{
						$this->session->set_flashdata('msg', 'Saved Successfully');
						$this->session->set_flashdata('alertType', 'success');
						$ajaxResponse['result'] = 'success';
					}
				}
				//Edit function calling
				else
				{
					$data   	 = 	array( 
					                       'leave_block_list_name'   		=> $this->input->post('leave_block_list_name'),
					               			'company_id'   					=> $this->input->post('company_id'),
					            			'applies_to_all_departments'    => ($this->input->post('applies_to_all_departments'))?'1':'0',		
					            			'updated_on'    				=> date('Y-m-d H:i:s'),
											'updated_by'					=> $this->auth_user_id
				            		     );
					$where_array =	array('leave_block_list_id'  => $this->input->post('leave_block_list_id'));

		            //$this->db->trans_start();
		            $result 	  =	$this->mcommon->common_edit('hr_leave_block_list', $data, $where_array);

		           	foreach ($block_dateArr as $key  => $value)
			     	{
			            $dataBlockDate   	= 	array(  

								                        'block_date'			=> date('Y-m-d', strtotime($block_dateArr[$key])),
								                      	'reason'				=> $reasonArr[$key],
								                        'created_on'        	=> date('Y-m-d H:i:s'),
														'created_by'    		=> $this->auth_user_id,
														'updated_by'			=> $this->auth_user_id
							            		     );
			            if($leave_block_list_date_idArr[$key] != '')
			            {
			            	$where_arrayBlockDate 	=	array('leave_block_list_date_id'  => $leave_block_list_date_idArr[$key]);

				            $resultBlockDate		=	$this->mcommon->common_edit('hr_leave_block_list_date', $dataBlockDate,$where_arrayBlockDate);			            	
			            }
			            else
			            {
			            	$dataBlockDate['leave_block_list_id']   	=  	$this->input->post('leave_block_list_id');
			            	$resultBlockDate1 							=	$this->mcommon->common_insert('hr_leave_block_list_date', $dataBlockDate);
			            }
		            }

		            foreach ($user_idArr as $key => $value) 
		            {
		            	$dataAllowUser   			= 	array(  
										                        'user_id'  				=> $user_idArr[$key],
										                        'created_on'        	=> date('Y-m-d H:i:s'),
																'created_by'    		=> $this->auth_user_id,
																'updated_by'			=> $this->auth_user_id
									            		     );
		            	if($leave_block_list_allow_idArr[$key]	!=	'')
		            	{

		            	$where_arrayAllowuser 		=	array('leave_block_list_allow_id'  =>$leave_block_list_allow_id[$key]);
						$resultAllowUser 			=	$this->mcommon->common_edit('hr_leave_block_list_allow', $dataAllowUser, $where_arrayAllowuser);
		            	}

		            	else
		            	{
		            		$dataAllowUser['leave_block_list_id']		=	$this->input->post('leave_block_list_id');
		            		$resultAllowUser1 							=	$this->mcommon->common_insert('hr_leave_block_list_allow', $dataAllowUser);

		            	}
		            }

					if($result || $resultBlockDate || $resultBlockDate1 || $resultAllowUser || $resultAllowUser1)
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
				$constraint_array 		=	array('leave_block_list_id' 	=>	 $pkey_id);
				$Data['tableData']		=	$this->mcommon->records_all('hr_leave_block_list', $constraint_array);
				$Data['contentData']	=	$this->mcommon->records_all('hr_leave_block_list_date', $constraint_array);
				$Data['contentData1']	=	$this->mcommon->records_all('hr_leave_block_list_allow', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Leaves_holiday/Leave_blocklist/ajaxLoadForm';
			$this->load->view('hr/Leaves_holiday/form/Leave_blocklist_form', $Data);
		}
	}

	public function delete($leave_block_list_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('leave_block_list_id'  =>$leave_block_list_id);

		$this->db->trans_start();
		$result 		=	$this->mcommon->common_edit('hr_leave_block_list', $data, $where_array);
		$result1 		=	$this->mcommon->common_edit('hr_leave_block_list_date', $data, $where_array);
		$result2 		=	$this->mcommon->common_edit('hr_leave_block_list_allow', $data, $where_array);
		$this->db->trans_complete();

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('hr/Leaves_holiday/Leave_blocklist/'));
		}
	}

	public function datatable()
	{
		$this->datatables->select('hlb.leave_block_list_id, hlb.leave_block_list_name	, sc.company_name, hlb.updated_on, CONCAT(up.first_name, " ", up.last_name)')
			->from('hr_leave_block_list as hlb')
			->join('set_company as sc', 'sc.company_id = hlb.company_id')
			->join('user_profile as up','up.user_id = hlb.updated_by','left')
	       	->where('hlb.is_delete', '0')        
			->edit_column('hlb.leave_block_list_id', get_ajax_buttons('$1', 'hr/Leaves_holiday/Leave_blocklist/'), 'hlb.leave_block_list_id')
			->edit_column('hlb.updated_on', '$1', 'get_date_timeformat(hlb.updated_on)');
		$this->db->order_by('hlb.updated_on',DESC);
		echo $this->datatables->generate();
	}		
}