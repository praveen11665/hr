<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Country extends MY_Controller
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
  		if( $this->acl_permits('setting.country_master') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('country_form_heading'),
								'form_title' 		=> $this->lang->line('country_form_title'),
								//'form_description' 	=> $this->lang->line('country_description'),
								//'list_heading' 		=> $this->lang->line('country_form_heading'),
								//'list_title' 		=> $this->lang->line('country_form_title'),
								'list_description' 	=> $this->lang->line('country_description'),
								'formUrl' 			=> 'setting/Master_settings/Country/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview' 		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 		 
			$this->table->set_heading('Action', 'Country', 'Date Format', 'Time Zones', 'Code', 'Last Update', 'Updated by');
			$view_data['dataTableUrl']   =	 'setting/Master_settings/Country/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('country_form_heading'),
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
			$this->form_validation->set_rules('country_name', lang('country_form_title'), 'trim|required');
			$this->form_validation->set_rules('date_formate', lang('label_date_format'), 'trim|required');
			$this->form_validation->set_rules('time_zones', lang('label_time_zone'), 'trim|required');
			$this->form_validation->set_rules('code', lang('label_code'), 'trim|required');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('country_id') == "")
	            {
					//insert function without id  
					$data   = array(
					                'country_name'	=> $this->input->post('country_name'),
					                'date_formate'  => $this->input->post('date_formate'),    
					                'time_zones'    => $this->input->post('time_zones'),
					                'code'     		=> $this->input->post('code'),
					                'created_on'    => date('Y-m-d H:i:s'),
					                'updated_on'    => date('Y-m-d H:i:s'),
									'created_by'    => $this->auth_user_id,
									'updated_by'	=> $this->auth_user_id
					              );           
					$result = $this->mcommon->common_insert('set_country', $data); 

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
					$data   	= array(
						                'country_name'      => $this->input->post('country_name'),
						                'date_formate'    	=> $this->input->post('date_formate'),    
						                'time_zones'        => $this->input->post('time_zones'),
						                'code'     			=> $this->input->post('code'),
										'updated_on'    	=> date('Y-m-d H:i:s'),
										'updated_by'        => $this->auth_user_id
					              		); 
					$where_array =	array('country_id'  =>$this->input->post('country_id'));
					$result 	 =	$this->mcommon->common_edit('set_country', $data, $where_array);

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
				$constraint_array 	=	array('country_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('set_country', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'setting/Master_settings/Country/ajaxLoadForm';
			$this->load->view('setting/Master_settings/form/Country_form', $Data);
		}
	}
	
	//Datatable view
	public function datatable()
	{
		//datatable joining 
		$this->datatables ->select('c.country_id ,c.country_name, c.date_formate, c.time_zones, c.code, c.updated_on, CONCAT(up.first_name, " ", up.last_name)');
		$this->datatables ->from('set_country as c');
		$this->datatables ->join('user_profile as up', 'up.user_id = c.updated_by');
		$this->datatables ->where('c.is_delete', '0');
		$this->datatables ->edit_column('c.country_id', get_ajax_buttons('$1', 'setting/Master_settings/Country/'), 'c.country_id');
		$this->datatables->edit_column('c.updated_on', '$1', 'get_date_timeformat(c.updated_on)');
		$this->db->order_by('c.updated_on',DESC);
		echo $this->datatables->generate();
	}

	public function delete($country_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('country_id'  =>$country_id);
		$result 		=	$this->mcommon->common_edit('set_country', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('setting/Master_settings/Country/'));
		}
	}	
}