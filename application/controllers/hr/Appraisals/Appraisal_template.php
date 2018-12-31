<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appraisal_template extends MY_Controller
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
		$this->lang->load("validation_lang","english");
		$this->multi_menu->set_items($items);
		$this->lang->load("hr","english");
		$this->load->library("form_validation");		
  	}

  	public function index($Data=array())
  	{
  		if( $this->acl_permits('HR.appraisal_template') )
    	{
			//Redirect
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Appraisals_Template_form_heading'),
								'form_title' 		=> $this->lang->line('Appraisals_Template_form_title'),
								'form_description' 	=> $this->lang->line('Appraisals_Template_form_description'),
								'list_heading' 		=> $this->lang->line('Appraisals_Template_form_heading'),
								'list_title' 		=> $this->lang->line('Appraisals_Template_form_title'),
								'list_description' 	=> $this->lang->line('Appraisals_Template_form_description'),
								'formUrl' 			=> 'hr/Appraisals/Appraisal_template/ajaxLoadForm',
								'list_view' 		=> TRUE,
	                        	'buttonview'        => TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Title', 'Description', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Appraisals/Appraisal_template/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Appraisals_Template_form_heading'),
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

			$kraArr                   					=	$this->input->post('kra');
			$weight_ageArr           				 	= 	$this->input->post('weight_age');
			$appraisal_template_goal_idArr            	= 	$this->input->post('appraisal_template_goal_id');

			//Checking Form Validation
			$this->form_validation->set_rules('appraisal_temp_title', lang('label_appraisals_template_title'), 'required');
			$this->form_validation->set_rules('description', lang('label_description'), 'required');
			$this->form_validation->set_rules('naming_series', lang('label_series_name'), 'required');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if ($this->input->post('appraisal_template_id') == '') 
				{
					$naming         = $this->input->post('naming_series');       
          			$namingSeries   = $this->mcommon->generateSeries($naming,41);

					$data   = array(
									'appraisal_temp_title' 		=> 	$this->input->post('appraisal_temp_title') ,
									'description' 				=> 	$this->input->post('description'),
									'naming_series' 			=>	$namingSeries,
									'created_by'				=> 	$this->auth_user_id,
									'created_on'				=> 	date('Y-m-d H:i:s'),
									'updated_on'				=> 	date('Y-m-d H:i:s'),
									'updated_by'				=> 	$this->auth_user_id
								    );
					$result = $this->mcommon->common_insert('hr_appraisal_template', $data);

					$where_array  	= array('transaction_id' => 7);

			        if($result)
			        {
			            $resultupdate = $this->mcommon->dataUpdate('set_naming_series', 'current_value', $where_array); 
			        }

					foreach ($kraArr as $key => $value) 
					{
						$data_goal = array(
										'appraisal_template_id' => $result,
										'kra'                   => $kraArr[$key],
										'weight_age'            => $weight_ageArr[$key],
										'created_by'			=> $this->auth_user_id,
										'created_on'			=> date('Y-m-d H:i:s'),
										'updated_by'			=> $this->auth_user_id
									);

						$result_goal = $this->mcommon->common_insert('hr_appraisal_template_goal', $data_goal);
					}
			
					if($result_goal)
					{
						$this->session->set_flashdata('msg', 'Saved Successfully');
						$this->session->set_flashdata('alertType', 'success');
						$ajaxResponse['result'] = 'success';
					}
				}
				//Edit function calling
				else
				{
					$data   	= array(
										'appraisal_temp_title' 		=> $this->input->post('appraisal_temp_title') ,
										'description' 				=> $this->input->post('description'),
										'created_by'				=> $this->auth_user_id,
										'created_on'				=> date('Y-m-d H:i:s'),
										'updated_on'				=> 	date('Y-m-d H:i:s'),
										'updated_by'				=> $this->auth_user_id
								    	);
					$where_array = array('appraisal_template_id' => $this->input->post('appraisal_template_id'));
					$result = $this->mcommon->common_edit('hr_appraisal_template', $data, $where_array);

					foreach ($kraArr as $key => $value) 
					{

						if($appraisal_template_goal_idArr[$key] != "")
						{
							
							$data_goal 	 = array(
												//'appraisal_template_id' => $result,
												'kra'                   => $kraArr[$key],
												'weight_age'            => $weight_ageArr[$key],
												'updated_by'			=> $this->auth_user_id
											  );
							$where_array =	array('appraisal_template_goal_id' => $appraisal_template_goal_idArr[$key]);

							$result_goal = $this->mcommon->common_edit('hr_appraisal_template_goal', $data_goal, $where_array);
						}

						else
						{
							$data_goal = array(
												'appraisal_template_id' => $this->input->post('appraisal_template_id'),
												'kra'                   => $kraArr[$key],
												'weight_age'            => $weight_ageArr[$key],
												'created_by'			=> $this->auth_user_id,
												'created_on'			=> date('Y-m-d H:i:s'),
												'updated_by'			=> $this->auth_user_id
											);

							$result_goal = $this->mcommon->common_insert('hr_appraisal_template_goal', $data_goal);
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
				$constraint_array 			=	array('appraisal_template_id' 	=>	 $pkey_id);
				$Data['tableData']			=	$this->mcommon->records_all('hr_appraisal_template', $constraint_array);
				$Data['tableDataTemplate']	=	$this->mcommon->records_all('hr_appraisal_template_goal', $constraint_array);

			}

			//Ajax Form Load
			$Data['ActionUrl']   	= 	'hr/Appraisals/Appraisal_template/ajaxLoadForm';
			$this->load->view('hr/Appraisals/form/Appraisal_template_form', $Data);
		}
	}

	public function datatable()
	{
    	$this->datatables->select('at.appraisal_template_id, at.appraisal_temp_title, at.description, at.updated_on, CONCAT(up.first_name, " ", up.last_name)')
        ->from('hr_appraisal_template AS at')
        ->join('user_profile as up', 'up.user_id = at.updated_by')
        ->where('at.is_Delete', '0')
		->edit_column('at.appraisal_template_id', get_ajax_buttons('$1', 'hr/Appraisals/Appraisal_template/'), 'at.appraisal_template_id');	
		$this->db->order_by('at.updated_on',DESC);
		$this->datatables->edit_column('at.updated_on', '$1', 'get_date_timeformat(at.updated_on)');
        echo $this->datatables->generate();
	}

	public function delete($appraisal_template_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('appraisal_template_id'  =>$appraisal_template_id);
		$result 		=	$this->mcommon->common_edit('hr_appraisal_template', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('hr/Appraisals/Appraisal_template/'));
		}
	} 
}
?>