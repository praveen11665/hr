<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Standard_reply extends MY_Controller
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
  		if( $this->acl_permits('setting.standard_reply') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('standard_reply_form_heading'),
								'form_title' 		=> $this->lang->line('standard_reply_form_title'),
								//'form_description' 	=> $this->lang->line('standard_reply_description'),
								//'list_heading' 		=> $this->lang->line('standard_reply_form_heading'),
								//'list_title' 		=> $this->lang->line('standard_reply_form_title'),
								'list_description' 	=> $this->lang->line('standard_reply_description'),
								'formUrl' 			=> 'setting/Master_settings/Standard_reply/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview' 		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Standard Reply Name', 'Standard Reply Message', 'Standard Reply Status', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'setting/Master_settings/Standard_reply/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('standard_reply_form_heading'),
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

	public function ajaxLoadForm($pkey_id ='')
	{
		$isFormLoad = TRUE;

		if(!empty($_POST))
		{
			//This will convert the string to array
			parse_str($_POST['postdata'], $_POST);

			//Checking Form Validation
			$this->form_validation->set_rules('standard_reply_name', lang('label_standard_reply_name'), 'trim|required');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('standard_reply_id') == "")
				{
					$data 		=	array(
											'standard_reply_name' 		=> $this->input->post('standard_reply_name'),
											'standard_reply_status' 	=>	($this->input->post('standard_reply_status'))?'1':'0',
											'standard_reply_subject' 	=> $this->input->post('standard_reply_subject'),
											'standard_reply_message' 	=> $this->input->post('standard_reply_message'),
											'created_on'    			=> date('Y-m-d H:i:s'),
											'created_by'    			=> $this->auth_user_id,
											'updated_on'    			=> date('Y-m-d H:i:s'),
											'updated_by'				=> $this->auth_user_id
									 	);
					$result 	=	$this->mcommon->common_insert('set_email_standard_reply', $data);

					if($result)
					{
						$this->session->set_flashdata('msg', 'Saved Successfully');
						$this->session->set_flashdata('alertType', 'success');
						$ajaxResponse['result'] = 'success';
					}
				}
				//Edit function calling
				else
				{
					$data 			=	array(
												'standard_reply_name'			=>	$this->input->post('standard_reply_name'),
												'standard_reply_status'			=>	($this->input->post('standard_reply_status'))?'1':'0',
												'standard_reply_subject' 		=> $this->input->post('standard_reply_subject'),
												'standard_reply_message' 		=> $this->input->post('standard_reply_message'),
												'updated_on'					=> date('Y-m-d H:i:s'),
												'updated_by'					=> $this->auth_user_id
										 	);
					$where_array 	=	array('standard_reply_id'  =>$this->input->post('standard_reply_id'));
					$result 		=	$this->mcommon->common_edit('set_email_standard_reply', $data, $where_array);

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
				$constraint_array 	=	array('standard_reply_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('set_email_standard_reply', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'setting/Master_settings/Standard_reply/ajaxLoadForm';
			$this->load->view('setting/Master_settings/form/Standard_reply_form', $Data);
		}
	}

	public function delete($standard_reply_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('standard_reply_id'  =>$standard_reply_id);
		$result 		=	$this->mcommon->common_edit('set_email_standard_reply', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('setting/Master_settings/Standard_reply/'));
		}
	}

	public function datatable()
	{
	    //Datatable Create
	    $this->datatables->select('s.standard_reply_id, s.standard_reply_name,s.standard_reply_message, s.standard_reply_status, s.updated_on, CONCAT(up.first_name, " ", up.last_name)')
	    ->from('set_email_standard_reply as s')
	    ->join('user_profile as up' , 'up.user_id = s.updated_by')
	    ->where('s.is_delete', '0')
	    ->edit_column('s.standard_reply_id', get_ajax_buttons('$1', 'setting/Master_settings/Standard_reply/'), 's.standard_reply_id')
		->edit_column('s.standard_reply_status', '$1', 'getStatus(s.standard_reply_status)')
		->edit_column('s.updated_on', '$1', 'get_date_timeformat(s.updated_on)');
		$this->db->order_by('s.updated_on',DESC);
	    echo $this->datatables->generate();  
    }   
}