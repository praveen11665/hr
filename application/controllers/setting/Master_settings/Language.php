<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Language extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->is_logged_in();
		$this->load->library('form_validation');

		$this->load->model("menu_model", "menu");
		$items = $this->menu->all();
		$this->load->library("multi_menu");
		$this->multi_menu->set_items($items);
		$this->lang->load("setting","english");
		$this->lang->load("validation_lang","english");
  	}

  	public function index($value='')
  	{
		if( $this->acl_permits('setting.language') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Language_form_heading'),
								'form_title' 		=> $this->lang->line('Language_form_title'),
								//'form_description' 	=> $this->lang->line('Language_form_description'),
								//'list_heading' 		=> $this->lang->line('Language_list_heading'),
								//'list_title' 		=> $this->lang->line('Language_list_title'),
								'list_description' 	=> $this->lang->line('Language_list_description'),
								'formUrl' 		    => 'setting/Master_settings/Language/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview'        => TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Language Code', 'Language Name', 'Flag', 'Last Update', 'Updated By');			

			$view_data['dataTableUrl']   =	 'setting/Master_settings/Language/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Language_form_heading'),
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

  	public function check_language_code() 
  	{

	    $language_id      = $this->input->post('language_id');
	    $language_code    = $this->input->post('language_code');
	    $where_array  = array(  
	                            'language_id!='     => $language_id,
	                            'language_code' => $language_code
	                          );
	    $result       = $this->mcommon->records_all('setting_language',$where_array);
	    if (empty($result)) 
	    {
	        return TRUE;
	    } 
	    else 
	    {
	      $this->form_validation->set_message('check_language_code', 'This {field} is already exits...');
	      return FALSE;
	    }
  	}
  	
  	public function ajaxLoadForm($pkey_id='')
	{
		$isFormLoad = TRUE;

		if(!empty($_POST))
		{
			parse_str($_POST['postdata'], $_POST);

			if($this->input->post('language_id') == "")
			{
				$this->form_validation->set_rules('language_code',  'Language Code', 'required|trim|is_unique[setting_language.language_code]');
			}
			else
			{
				$this->form_validation->set_rules('language_code',  'Language Code', 'required|trim|callback_check_language_code');
			}
			$this->form_validation->set_rules('language_name', 'Language Name', 'trim|required');
			$this->form_validation->set_rules('language_flag', 'Flag', 'trim|required');
			//$this->form_validation->set_rules('language_based', 'Based On', 'trim|required');
			
			if($this->form_validation->run() == TRUE)
			{
				if($this->input->post('language_id') == "" )
				{
					$data 		=	array(

											'language_code'     => $this->input->post('language_code'),
											'language_name'     => $this->input->post('language_name'),
											'language_flag'     => $this->input->post('language_flag'),
											'language_based'   	=> $this->input->post('language_based'),
											'created_on'    	=> 	date('Y-m-d H:i:s'),
											'created_by'    	=> 	$this->auth_user_id,
											'updated_on'    	=> 	date('Y-m-d H:i:s'),
											'updated_by'		=> 	$this->auth_user_id
							                									 	
							             );
					$result 	=	$this->mcommon->common_insert('setting_language', $data);
				 	
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

											'language_code'		=> $this->input->post('language_code'),
											'language_name'		=> $this->input->post('language_name'),
											'language_flag'		=> $this->input->post('language_flag'),
											'language_based'	=> $this->input->post('language_based'),
											'updated_on'		=> 	date('Y-m-d H:i:s'),
											'updated_by'		=> $this->auth_user_id
									 		);

					$where_array 	=	array(
												'language_id'  =>$this->input->post('language_id')
												
											 );
					$result 		=	$this->mcommon->common_edit('setting_language', $data, $where_array);
					
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
				$constraint_array 	=	array('language_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('setting_language', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'setting/Master_settings/Language/ajaxLoadForm';	
			$this->load->view('setting/Master_settings/form/language_form', $Data);
		}
	}

	public function delete($language_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('language_id'  =>$language_id);
		$result 		=	$this->mcommon->common_edit('setting_language', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('setting/Master_settings/Language/'));
		}
	}
	
	public function datatable()
  	{
	    $this->datatables->select('a.language_id, a.language_code, a.language_name, a.language_flag, a.updated_on, CONCAT(up.first_name, " ", up.last_name)');
	    $this->datatables->from('setting_language as a');
	 	$this->datatables->join('user_profile as up', 'up.user_id = a.updated_by');
	    $this->datatables->where('a.is_delete', '0');
	    $this->datatables->edit_column('a.language_id', get_ajax_buttons('$1', 'setting/Master_settings/Language/'), 'a.language_id');
		$this->datatables->edit_column('a.updated_on', '$1', 'get_date_timeformat(a.updated_on)');
		$this->db->order_by('a.updated_on',DESC);
	    echo $this->datatables->generate();
  	}
}