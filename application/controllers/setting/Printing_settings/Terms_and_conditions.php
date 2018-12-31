<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Terms_and_conditions extends MY_Controller
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
		$this->lang->load("setting","english");
		$this->load->library("form_validation");		
  	}

  	public function index($Data=array())
  	{
  		if( $this->acl_permits('setting.company_master') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('terms_conditions_form_heading'),
								'form_title' 		=> $this->lang->line('terms_conditions_form_title'),
								//'form_description' 	=> $this->lang->line('terms_conditions_form_description'),
								//'list_heading' 		=> $this->lang->line('terms_conditions_form_heading'),
								//'list_title' 		=> $this->lang->line('terms_conditions_form_title'),
								'list_description' 	=> $this->lang->line('terms_conditions_form_description'),
								'formUrl' 			=> 'setting/Printing_settings/Terms_and_conditions/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview'		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Title', 'Status', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'setting/Printing_settings/Terms_and_conditions/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('terms_conditions_form_heading'),
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
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('terms', 'Terms', 'trim|required');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('tc_id') == "")
				{
					$data 		=	array(
											'title' 		=> $this->input->post('title'),
											'disabled' 		=>	($this->input->post('disabled'))?'1':'0',
											'is_default' 	=>	($this->input->post('is_default'))?'1':'0',
											'terms' 		=> $this->input->post('terms'),
											'created_on'    => date('Y-m-d H:i:s'),
											'updated_on'    => date('Y-m-d H:i:s'),
											'created_by'    => $this->auth_user_id,
											'updated_by'	=> $this->auth_user_id
									 	);
					$result 	=	$this->mcommon->common_insert('set_terms_conditions', $data);

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
					$data 			=	array(
												'title' 	 =>	$this->input->post('title'),
												'disabled' 	 =>	($this->input->post('disabled'))?'1':'0',
												'is_default' =>	($this->input->post('is_default'))?'1':'0',
												'terms' 	 =>	$this->input->post('terms'),
												'updated_on' => date('Y-m-d H:i:s'),
												'updated_by' => $this->auth_user_id
										 );
					$where_array 	=	array('tc_id'  =>$this->input->post('tc_id'));
					$result 		=	$this->mcommon->common_edit('set_terms_conditions', $data, $where_array);

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
				$constraint_array 	=	array('tc_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('set_terms_conditions', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'setting/Printing_settings/Terms_and_conditions/ajaxLoadForm';
			$this->load->view('setting/Printing_settings/form/Terms_and_conditions_form', $Data);
		}
	}

	public function delete($tc_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('tc_id'  =>$tc_id);
		$result 		=	$this->mcommon->common_edit('set_terms_conditions', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('setting/Printing_settings/Terms_and_conditions/'));
		}
	}

	public function datatable()
	{
    	$this->datatables->select('t.tc_id, t.title, t.is_default, t.updated_on, CONCAT(up.first_name, " ", up.last_name)')
        ->from('set_terms_conditions AS t')
      	->join('user_profile as up', 'up.user_id = t.updated_by')
        ->where('t.is_delete', '0')
		->edit_column('t.tc_id', get_ajax_buttons('$1', 'setting/Printing_settings/Terms_and_conditions/'), 't.tc_id');
		$this->db->order_by('t.updated_on',DESC);
		$this->datatables->edit_column('t.is_default', '$1', 'get_disable_status(t.is_default)');
		$this->datatables->edit_column('t.updated_on', '$1', 'get_date_timeformat(t.updated_on)');
        echo $this->datatables->generate();
    }
}