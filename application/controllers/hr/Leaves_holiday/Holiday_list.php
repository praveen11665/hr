<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Holiday_list extends MY_Controller
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
		$this->load->library("multi_menu");
	    $this->lang->load("validation_lang","english");
		$this->load->library("form_validation");
		$this->multi_menu->set_items($items);
  	}

  	public function index($Data=array())
  	{
  		if( $this->acl_permits('HR.holiday_list') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Holiday_List_title'),
								'form_title' 		=> $this->lang->line('Holiday_List_form_title'),
								'form_description' 	=> $this->lang->line('Holiday_List_form_description'),
								'list_heading' 		=> $this->lang->line('Holiday_List_title'),
								'list_title' 		=> $this->lang->line('Holiday_List_form_title'),
								'list_description' 	=> $this->lang->line('Holiday_List_form_description'),
								'formUrl' 			=> 'hr/Leaves_holiday/Holiday_list/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview' 		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 		 
			$this->table->set_heading('Action', 'Holiday list name', 'From Date', 'To date', 'Weekly Off', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Leaves_holiday/Holiday_list/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Holiday_List_title'),
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
			
			/* For Hoilday List Without WeekoffDate
			if($this->input->post('holliday_list_weekly_off_id') == "")
			{
				$startDate 		= new DateTime(date('d-m-Y', strtotime($this->input->post('from_date'))));
				$endDate 		= new DateTime(date('d-m-Y', strtotime($this->input->post('to_date'))));
    			while ($startDate <= $endDate) 
				{
			        $weekoffArr[] 			= $startDate->format('d-m-Y');
			        $descriptionArr[] 		= $this->input->post('holiday_list_name');

			        $startDate->modify('+1 day');
				}
			}
			else
			{
				$weekoffArr 	= $this->input->post('holiday_date[]');
				$descriptionArr = $this->input->post('description[]');
			}	
			*/
		    $weekoffArr 				= $this->input->post('holiday_date');
			$descriptionArr 			= $this->input->post('description');
			$holiday_list_holiday_idArr = $this->input->post('holiday_list_holiday_id');
			//Form Validation
			$this->form_validation->set_rules('holiday_list_name', lang('label_holiday_list_Name'), 'required');	
			$this->form_validation->set_rules('from_date', lang('label_from_date'), 'required');
			$this->form_validation->set_rules('to_date', lang('label_to_date'), 'required');
			$this->form_validation->set_rules('holliday_list_weekly_off_id', lang('label_weekly_off'), 'required');

			
			if($this->form_validation->run() == TRUE) 
			{ 
				//Insert if not id's are given
				if($this->input->post('holiday_list_id') == "")
	            { 
					//insert function without id  
					$data   = array(
									'holiday_list_name'			  => $this->input->post('holiday_list_name'),
									'from_date'   				  => date('Y-m-d', strtotime($this->input->post('from_date'))),
									'to_date'   				  => date('Y-m-d', strtotime($this->input->post('to_date'))),
									'holliday_list_weekly_off_id' => $this->input->post('holliday_list_weekly_off_id'),
									'created_on'    			  => date('Y-m-d H:i:s'),
									'updated_on'    			  => date('Y-m-d H:i:s'),
									'created_by'    			  => $this->auth_user_id,
									'updated_by'				  => $this->auth_user_id		  
					              ); 
				
					$result = $this->mcommon->common_insert('hr_holiday_list', $data); 
					
					foreach ($weekoffArr as $key => $value) 
					{
						$dateDate  = array(
					        				'holiday_list_id'	=> $result,
						        			'holiday_date'		=> date('Y-m-d', strtotime($weekoffArr[$key])),
					        				'description' 		=> $descriptionArr[$key],
					        				'created_on'        => date('Y-m-d H:i:s'),
				                            'created_by'        => $this->auth_user_id,
				                            'updated_by'        => $this->auth_user_id
					        				);
			        	$result1 	= $this->mcommon->common_insert('hr_holiday_list_holiday', $dateDate);
					} 
					if($result)
					{
					  //success message due to session
					  $this->session->set_flashdata('msg', 'Saved Successfully');
					  $this->session->set_flashdata('alertType', 'success');
					  $ajaxResponse['result'] = 'success';
					}
	            }
				//Edit function calling
				else
				{
					$where_array  	= array('holiday_list_id'  =>	$this->input->post('holiday_list_id'));
					$data  			= array(
											'holiday_list_name'			  => 	$this->input->post('holiday_list_name'),
											'from_date'   				  => 	date('Y-m-d', strtotime($this->input->post('from_date'))),
											'to_date'   				  => 	date('Y-m-d', strtotime($this->input->post('to_date'))),
											'holliday_list_weekly_off_id' => 	$this->input->post('holliday_list_weekly_off_id'),
											'updated_on'    			  => 	date('Y-m-d H:i:s'),
											'updated_by'				  => 	$this->auth_user_id		  
							              ); 
				
					$result 		= $this->mcommon->common_edit('hr_holiday_list', $data,$where_array); 

					foreach ($weekoffArr as $key => $value) 
					{						
						$dateDate  	= array(
						        			'holiday_date'				=> 	date('Y-m-d',strtotime($weekoffArr[$key])),
					        				'description' 				=> 	$descriptionArr[$key],
					        				'created_on'        		=> 	date('Y-m-d H:i:s'),
				                            'created_by'        		=> 	$this->auth_user_id,
				                            'updated_by'        		=> 	$this->auth_user_id
					        				);
						if($holiday_list_holiday_idArr[$key] != "")
		           		{
		           			$where_arrayDate = 	array('holiday_list_holiday_id' => $holiday_list_holiday_idArr[$key]);
			        		$resultDate		 = 	$this->mcommon->common_edit('hr_holiday_list_holiday',$dateDate,$where_arrayDate);
			        	}

			        	else
			        	{
			        		$dateDate['holiday_list_id']		=	$this->input->post('holiday_list_id');
			        		$resultDate1 						= 	$this->mcommon->common_insert('hr_holiday_list_holiday', $dateDate);
			        	}
			        }
					if($result1 || $resultDate || $resultDate1)
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
				$constraint_array 		=	array('holiday_list_id' 	=>	 $pkey_id);
				$Data['tableData']		=	$this->mcommon->records_all('hr_holiday_list', $constraint_array);
				$Data['contentData']	=	$this->mcommon->records_all('hr_holiday_list_holiday', $constraint_array);

			}
			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Leaves_holiday/Holiday_list/ajaxLoadForm';
			$Data['contentUrl']  =	'hr/Leaves_holiday/Holiday_list/ajaxTableContentForm';
			$Data['GetDateUrl']  =	'hr/Leaves_holiday/Holiday_list/getWeekDays';

			$this->load->view('hr/Leaves_holiday/form/Holiday_list_form', $Data);
		}
	}

	public function datatable()
	{
		//datatable joining 
		$this->datatables->select('hl.holiday_list_id, hl.holiday_list_name, hl.from_date, hl.to_date, hlw.weekly_off, hl.updated_on, CONCAT(up.first_name, " ", up.last_name)');
		$this->datatables->from('hr_holiday_list as hl');
		$this->datatables->join('user_profile as up', 'up.user_id = hl.updated_by');
		$this->datatables->join('def_hr_holiday_list_weekly_off as hlw', 'hlw.holliday_list_weekly_off_id = hl.holliday_list_weekly_off_id');
		$this->datatables->where('hl.is_delete', '0');
		$this->datatables ->edit_column('hl.holiday_list_id', get_ajax_buttons('$1', 'hr/Leaves_holiday/Holiday_list/'), 'hl.holiday_list_id');
		$this->datatables->edit_column('hl.updated_on', '$1', 'get_date_timeformat(hl.updated_on)');
		$this->datatables->edit_column('hl.from_date', '$1', 'get_date_format(hl.from_date)');
		$this->datatables->edit_column('hl.to_date', '$1', 'get_date_format(hl.to_date)');
		$this->db->order_by('hl.updated_on', DESC);
		echo $this->datatables->generate();
	}	

	public function delete($holiday_list_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('holiday_list_id'  =>$holiday_list_id);
		$this->db->trans_start();
		$result 		=	$this->mcommon->common_edit('hr_holiday_list', $data, $where_array);
		$result1 		=	$this->mcommon->common_edit('hr_holiday_list_holiday', $data, $where_array);
		$this->db->trans_complete();

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('hr/Leaves_holiday/Holiday_list/'));
		}
	}

	public function ajaxTableContentForm($Data = array())
	{
		$isFormLoad = TRUE;

		if (!empty($_POST)) 
		{
			//This will convert the string to array
			parse_str($_POST['postdata'], $_POST);

			//Checking Form Validation
			$this->form_validation->set_rules('holiday_date', lang('label_date'), 'required');
			$this->form_validation->set_rules('description', lang('label_description'), 'required');

			if ($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('holiday_list_holiday_id') == "")
				{
					$data 		=	array(
			                                'holiday_date'		=> date('Y-m-d', strtotime($this->input->post('holiday_date'))),
					        				'description' 		=> $this->input->post('description'),
					        				'created_on'        => date('Y-m-d H:i:s'),
				                            'created_by'        => $this->auth_user_id,
				                            'updated_by'        => $this->auth_user_id  
									 	);
					$result 	=	$this->mcommon->common_insert('hr_holiday_list_holiday', $data);

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
												'holiday_date'		=> date('Y-m-d', strtotime($this->input->post('holiday_date'))),
					        					'description' 		=> $this->input->post('description'), 
					        					'updated_by'        => $this->auth_user_id 
										 	 );
					$where_array 	=	array('holiday_list_holiday_id'  =>$this->input->post('holiday_list_holiday_id')
											 );
					$result 		=	$this->mcommon->common_edit('hr_holiday_list_holiday', $data, $where_array);

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
				$constraint_array 	=	array('holiday_list_holiday_id' =>	 $this->input->get('pkey_id'));
				$Data['tableData']	=	$this->mcommon->records_all('hr_holiday_list_holiday', $constraint_array);

			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Leaves_holiday/Holiday_list/ajaxTableContentForm';
			$this->load->view('hr/Leaves_holiday/form/ajax_form/Holiday_list_table_content_form', $Data);
		}
	}

	public function getToDate()
	{
		
	 	$FromDate = date('d-m-Y', strtotime($this->input->post('from_date')));

		$newEndingDate = date("d-m-Y", strtotime(date("d-m-Y", strtotime($FromDate)) . " + 1 year"));
		echo $newEndingDate; 
	}

	public function getWeekOff() 
	{
		$startDate 		= new DateTime(date('d-m-Y', strtotime($this->input->post('from_date'))));
	    $endDate 		= new DateTime(date('d-m-Y', strtotime($this->input->post('to_date'))));
	    $weekdayNumber 	= $this->input->post('holliday_list_weekly_off_id');		
		
		$DateArr 	= array();
		$i=0;
		while ($startDate <= $endDate) 
		{
		    if ($startDate->format('w') == $weekdayNumber) 
		    {
		        $DateArr[$i]['holiday_date'] 	= $startDate->format('d-m-Y');
		        $DateArr[$i]['description'] 	= $startDate->format('l');
				$i++;
		    }
		    $startDate->modify('+1 day');
		}

		$Data['weekoffDates'] 	= $DateArr; 
		$Data['contentUrl']     = 'hr/Leaves_holiday/Holiday_list/ajaxTableContentForm';
		echo $this->load->view('hr/Leaves_holiday/form/holiday_weekoff_dates_ajax', $Data);
	}	
}