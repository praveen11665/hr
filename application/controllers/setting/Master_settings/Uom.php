<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uom extends MY_Controller
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
  		if( $this->acl_permits('setting.uom_master') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('uom_form_heading'),
								'form_title' 		=> $this->lang->line('uom_form_title'),
								//'form_description' 	=> $this->lang->line('uom_description'),
								//'list_heading' 		=> $this->lang->line('uom_form_heading'),
								//'list_title' 		=> $this->lang->line('uom_form_title'),
								'list_description' 	=> $this->lang->line('uom_description'),
								'formUrl' 			=> 'setting/Master_settings/Uom/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview' 		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Uom Name','Last Update', 'Updated By');

			$view_data['dataTableUrl']   =	 'setting/Master_settings/Uom/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('uom_form_heading'),
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
			$this->form_validation->set_rules('uom_name', 'UOM Name', 'trim|required');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('uom_id') == "")
				{
					$data 		=	array(
											'uom_name' 		=> $this->input->post('uom_name'),
											'must_be_whole_number' 		=>	($this->input->post('must_be_whole_number'))?'1':'0',
											'created_on'    => date('Y-m-d H:i:s'),
											'updated_on'    => date('Y-m-d H:i:s'),
											'created_by'    => $this->auth_user_id,
											'updated_by'	=> $this->auth_user_id
									 	);
					$result 	=	$this->mcommon->common_insert('set_uom', $data);

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
												'uom_name' 	=>	$this->input->post('uom_name'),
												'must_be_whole_number' 	=>	($this->input->post('must_be_whole_number'))?'1':'0',
												'updated_on'    => date('Y-m-d H:i:s'),
												'updated_by'	=> $this->auth_user_id
										 );
					$where_array 	=	array(
												'uom_id'  =>$this->input->post('uom_id')
											 );
					$result 		=	$this->mcommon->common_edit('set_uom', $data, $where_array);

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
				$constraint_array 	=	array('uom_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('set_uom', $constraint_array);
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'setting/Master_settings/Uom/ajaxLoadForm';
			$this->load->view('setting/Master_settings/form/Uom_form', $Data);
		}
	}

	public function delete($uom_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('uom_id'  =>$uom_id);
		$result 		=	$this->mcommon->common_edit('set_uom', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('setting/Master_settings/Uom/'));
		}
	}

	public function datatable()
	{
	    //Datatable Create
	    $this->datatables->select('a.uom_id, a.uom_name,a.updated_on, CONCAT(up.first_name, " ", up.last_name)')
	    ->from('set_uom as a')
		->join('user_profile as up', 'up.user_id = a.updated_by')
	    ->where('a.is_delete', '0')	    
	    ->edit_column('a.uom_id', get_ajax_buttons('$1', 'setting/Master_settings/Uom/'), 'a.uom_id');
		$this->db->order_by('a.updated_on',DESC);
		//$this->datatables->edit_column('a.must_be_whole_number', '$1', 'get_disable_status(a.must_be_whole_number)');
		$this->datatables->edit_column('a.updated_on', '$1', 'get_date_timeformat(a.updated_on)');
	    echo $this->datatables->generate();  
    }   
}