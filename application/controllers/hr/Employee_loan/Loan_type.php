<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loan_type extends MY_Controller
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
  		if( $this->acl_permits('HR.loan_type') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Loan_type_form_heading'),
								'form_title' 		=> $this->lang->line('Loan_type_form_title'),
								'form_description' 	=> $this->lang->line('Loan_type_form_description'),
								'list_heading' 		=> $this->lang->line('Loan_type_form_heading'),
								'list_title' 		=> $this->lang->line('Loan_type_form_title'),
								'list_description' 	=> $this->lang->line('Loan_type_form_description'),
								'formUrl' 			=> 'hr/Employee_loan/Loan_type/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview' 		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Loan Name', 'Maximum Loan Amount', 'Rate Of Interest', 'Status', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Employee_loan/Loan_type/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Loan_type_form_heading'),
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

			//Checking Form Validation
			$this->form_validation->set_rules('loan_name', lang('label_loan_name'), 'trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('naming_series', lang('label_series_name'), 'trim|required');
			$this->form_validation->set_rules('rate_of_interest', lang('label_rate_of_interest'), 'trim|required|numeric');
			$this->form_validation->set_rules('maximum_loan_amount', lang('label_maximum_loan_amount'), 'trim|required|numeric');

			if($this->form_validation->run() == TRUE) 
			{
				$naming         = $this->input->post('naming_series');       
      			$namingSeries   = $this->mcommon->generateSeries($naming,134);
				//Insert if not id's are given
				if($this->input->post('loan_type_id') == "")
				{
					$data 		=	array(
											'loan_name' 			=> 	$this->input->post('loan_name'),
											'naming_series' 		=>	$namingSeries,
											'maximum_loan_amount' 	=>	$this->input->post('maximum_loan_amount'),
											'rate_of_interest' 		=> 	$this->input->post('rate_of_interest'),
											'disabled' 				=> 	($this->input->post('disabled'))?'0':'1',
											'description' 			=> 	$this->input->post('description'),
											'updated_on'    		=> 	date('Y-m-d H:i:s'),
											'created_by'    		=> 	$this->auth_user_id,
											'updated_by'			=> 	$this->auth_user_id
									 	);
					$result 	=	$this->mcommon->common_insert('hr_loan_type', $data);
					
					if($result)
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
					$naming         = $this->input->post('naming_series');       
	      			$namingSeries   = $this->mcommon->generateSeries($naming,134);
					$data 			=	array(
												'loan_name' 			=> 	$this->input->post('loan_name'),
												'naming_series'			=>  $namingSeries,
												'maximum_loan_amount' 	=>	$this->input->post('maximum_loan_amount'),
												'rate_of_interest' 		=> 	$this->input->post('rate_of_interest'),
												'disabled' 				=> 	($this->input->post('disabled'))?'0':'1',
												'description' 			=> 	$this->input->post('description'),
												'updated_on'    		=> 	date('Y-m-d H:i:s'),
												'updated_by'			=> $this->auth_user_id
										 );
					$where_array 	=	array(
												'loan_type_id'  =>$this->input->post('loan_type_id')
											 );
					$result 		=	$this->mcommon->common_edit('hr_loan_type', $data, $where_array);

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
				$constraint_array 	=	array('loan_type_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('hr_loan_type', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'hr/Employee_loan/Loan_type/ajaxLoadForm';
			$Data['namingUrl']   = 	'setting/Master_settings/Naming_series/ajaxLoadForm';
			$this->load->view('hr/Employee_loan/form/Loan_type_form', $Data);
		}
	}

	public function delete($loan_type_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('loan_type_id'  =>$loan_type_id );
		$result 		=	$this->mcommon->common_edit('hr_loan_type', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('hr/Employee_loan/Loan_type'));
		}
	}

	public function datatable()
	{
	    //Datatable Create
	    $this->datatables->select('a.loan_type_id, a.loan_name, a.maximum_loan_amount, a.rate_of_interest, a.disabled, a.updated_on, CONCAT(up.first_name, " ", up.last_name)')
	    ->from('hr_loan_type as a')
	    ->join('user_profile as up', 'up.user_id = a.updated_by')
	    ->where('a.is_delete', '0')
	    ->edit_column('a.loan_type_id', get_ajax_buttons('$1', 'hr/Employee_loan/Loan_type/'), 'a.loan_type_id');
	    $this->datatables->edit_column('a.disabled', '$1', 'get_loan_type_status(a.disabled)');
		$this->datatables->edit_column('a.updated_on', '$1', 'get_date_timeformat(a.updated_on)');
	    $this->db->order_by('a.updated_on', DESC);
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
}
?>


