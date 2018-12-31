<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Letter_head extends MY_Controller
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
  		if( $this->acl_permits('setting.letter_head') )
    	{
			//Redirect
			$view_data = array(
								'form_heading' 		=> $this->lang->line('letter_head_form_heading'),
								'form_title' 		=> $this->lang->line('letter_head_form_title'),
								//'form_description' 	=> $this->lang->line('letter_head_form_description'),
								//'list_heading' 		=> $this->lang->line('letter_head_form_heading'),
								//'list_title' 		=> $this->lang->line('letter_head_form_title'),
								'list_description' 	=> $this->lang->line('letter_head_form_description'),
								'formUrl' 			=> 'setting/Printing_settings/Letter_head/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview' 		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Letter Head Name', 'Letter Head Content', 'Is Disabled', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'setting/Printing_settings/Letter_head/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('letter_head_form_heading'),
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
			$this->form_validation->set_rules('letter_head_name', lang('label_letter_head_name'), 'required');
			$this->form_validation->set_rules('letter_head_content', lang('label_letter_head_header'), 'required');
			$this->form_validation->set_rules('letter_head_footer', lang('label_letter_head_footer'), 'required');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if ($this->input->post('letter_head_id') == '') 
				{
					$data  				= array(
												'letter_head_name' 		=> $this->input->post('letter_head_name') ,
												'is_disabled' 			=> ($this->input->post('is_disabled'))?'1':'0',
												'is_default' 			=> ($this->input->post('is_default'))?'1':'0',
												'letter_head_content' 	=> $this->input->post('letter_head_content') ,
												'letter_head_footer' 	=> $this->input->post('letter_head_footer') ,
												'created_by'			=> $this->auth_user_id,
												'created_on'			=> date('Y-m-d H:i:s'),
												'updated_on'			=> date('Y-m-d H:i:s'),
												'updated_by'			=> $this->auth_user_id,
												);
					$result       		= $this->mcommon->common_insert('set_letter_head', $data);	
				
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
					$data  			= array(
												'letter_head_name' 		=> $this->input->post('letter_head_name') ,
												'is_disabled' 			=> ($this->input->post('is_disabled'))?'1':'0',
												'is_default' 			=> ($this->input->post('is_default'))?'1':'0',
												'letter_head_content' 	=> $this->input->post('letter_head_content') ,
												'letter_head_footer' 	=> $this->input->post('letter_head_footer') ,
												'updated_by'			=> $this->auth_user_id,
												'updated_on'			=> date('Y-m-d H:i:s'),
											);
					$where_array    = array('letter_head_id' => $this->input->post('letter_head_id'));
					$result      	= $this->mcommon->common_edit('set_letter_head', $data, $where_array);
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
				$constraint_array 	=	array('letter_head_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('set_letter_head', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'setting/Printing_settings/Letter_head/ajaxLoadForm';
			$this->load->view('setting/Printing_settings/form/Letter_head_form', $Data);
		}
	}

	public function delete($letter_head_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('letter_head_id'  =>$letter_head_id);
		$result 		=	$this->mcommon->common_edit('set_letter_head', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('setting/Printing_settings/Letter_head/'));
		}
	}

	public function datatable()
	{
    	$this->datatables->select('lh.letter_head_id, lh.letter_head_name, lh.letter_head_content,lh.is_disabled, lh.updated_on, CONCAT(up.first_name, " ", up.last_name)')
        ->from('set_letter_head AS lh')
		->join('user_profile as up', 'up.user_id = lh.updated_by')
        ->where('lh.is_delete', '0')
		->edit_column('lh.letter_head_id', get_ajax_buttons('$1', 'setting/Printing_settings/Letter_head/'), 'lh.letter_head_id');
		$this->datatables->edit_column('lh.is_disabled', '$1', 'get_disable_status(lh.is_disabled)');
		$this->datatables->edit_column('lh.updated_on', '$1', 'get_date_timeformat(lh.updated_on)');
		$this->db->order_by('lh.updated_on',DESC);
        echo $this->datatables->generate();
	}	
}