<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Currency extends MY_Controller
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
		$this->lang->load("validation_lang","english");
		$this->multi_menu->set_items($items);
		$this->lang->load("setting","english");
  	}
  	
  	public function index($Data=array())
  	{
  		if( $this->acl_permits('setting.currency_master') )
    	{
			//Redirect
			$view_data = array(
								'form_heading' 		=> $this->lang->line('currency_form_heading'),
								'form_title' 		=> $this->lang->line('currency_form_title'),
								//'form_description' 	=> $this->lang->line('currency_form_description'),
								//'list_heading' 		=> $this->lang->line('currency_form_heading'),
								//'list_title' 		=> $this->lang->line('currency_form_title'),
								'list_description' 	=> $this->lang->line('currency_form_description'),
								'formUrl' 			=> 'setting/Master_settings/Currency/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview' 		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Currency Name', 'Fraction', 'Is Enabled', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'setting/Master_settings/Currency/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('currency_form_heading'),
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
			$this->form_validation->set_rules('currency_name', lang('label_currency'), 'required');
			$this->form_validation->set_rules('fraction', lang('label_currency_fraction'), 'required');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if ($this->input->post('currency_id') == '') 
				{
					$data  				= array(
												'currency_name' 					=>$this->input->post('currency_name') ,
												'is_enabled'						=>($this->input->post('is_enabled')) ? '1' : '0',
												'fraction'							=>$this->input->post('fraction'),
												'fraction_units'					=>$this->input->post('fraction_units'),
												'smallest_currency_fraction_value'	=>$this->input->post('smallest_currency_fraction_value'),
												'symbol'							=>$this->input->post('symbol'),
												'number_formate'					=>$this->input->post('number_formate'),
												'created_by'						=> $this->auth_user_id,
												'created_on'						=> date('Y-m-d H:i:s'),
												'updated_on'						=> date('Y-m-d H:i:s'),
												'updated_by'						=> $this->auth_user_id,
												);
					$result       		= $this->mcommon->common_insert('set_currency', $data);	
				
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
					$data  				= array(
												'currency_name' 					=>$this->input->post('currency_name') ,
												'is_enabled'						=>($this->input->post('is_enabled')) ? '1' : '0',
												'fraction'							=>$this->input->post('fraction'),
												'fraction_units'					=>$this->input->post('fraction_units'),
												'smallest_currency_fraction_value'	=>$this->input->post('smallest_currency_fraction_value'),
												'symbol'							=>$this->input->post('symbol'),
												'number_formate'					=>$this->input->post('number_formate'),
												'updated_on'						=> date('Y-m-d H:i:s'),
												'updated_by'						=> $this->auth_user_id,

												);
					$where_array    	= array('currency_id' => $this->input->post('currency_id'));
					$result      		= $this->mcommon->common_edit('set_currency', $data, $where_array);
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
				$constraint_array 	=	array('currency_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('set_currency', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   	= 	'setting/Master_settings/Currency/ajaxLoadForm';
			$this->load->view('setting/Master_settings/form/Currency_form', $Data);
		}
	}

	public function delete($currency_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('currency_id'  =>$currency_id);
		$result 		=	$this->mcommon->common_edit('set_currency', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('setting/Master_settings/Currency/'));
		}
	}

	public function datatable()
	{
    	$this->datatables->select('sc.currency_id, sc.currency_name, sc.fraction, sc.is_enabled, sc.updated_on, CONCAT(up.first_name, " ", up.last_name)')
        ->from('set_currency AS sc')
        ->join('user_profile as up', 'up.user_id = sc.updated_by')
        ->where('sc.is_delete', '0')
		->edit_column('sc.currency_id', get_ajax_buttons('$1', 'setting/Master_settings/Currency/'), 'sc.currency_id');
		$this->db->order_by('sc.updated_on',DESC);
		$this->datatables->edit_column('sc.is_enabled', '$1', 'get_disable_status(sc.is_enabled)');		
		$this->datatables->edit_column('sc.updated_on', '$1', 'get_date_timeformat(sc.updated_on)');
        echo $this->datatables->generate();
	}  	
}