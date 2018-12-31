<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Salary_components extends MY_Controller
{	
	public function __construct()
	{
		parent::__construct();
		$this->lang->load("validation_lang","english");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->is_logged_in();
		$this->load->model("menu_model", "menu");
		$items = $this->menu->all();
		$this->load->library("multi_menu");
		$this->multi_menu->set_items($items);
		$this->lang->load("hr","english");
		$this->load->library("form_validation");		
	}

	public function index($Data=array())
  	{
  		if( $this->acl_permits('HR.salary_component') )
    	{  
		//Redirect
			$view_data = array(
								'form_heading' 		=> $this->lang->line('Salary_components_form_heading'),
								'form_title' 		=> $this->lang->line('Salary_components_form_title'),
								'form_description' 	=> $this->lang->line('Salary_components_form_description'),
								'list_heading' 		=> $this->lang->line('Salary_components_form_heading'),
								'list_title' 		=> $this->lang->line('Salary_components_form_title'),
								'list_description' 	=> $this->lang->line('Salary_components_form_description'),
								'formUrl' 			=> 'hr/Payroll/Salary_components/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview'		=> TRUE
							  );

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Action', 'Salary Component', 'Salary Component Abbr', 'Type', 'Last Update', 'Updated by');

			$view_data['dataTableUrl']   =	 'hr/Payroll/Salary_components/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('Salary_components_form_heading'),
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

				$account_idArr						= $this->input->post('salary_component_account_id');
				$company_idArr						= $this->input->post('company_id');
				$default_accountArr 				= $this->input->post('default_account');

		        $this->form_validation->set_rules('salary_component', lang('label_name'), 'trim|required');
		        $this->form_validation->set_rules('salary_component_abbr', lang('label_abbreviation'), 'trim|required');
		        $this->form_validation->set_rules('salary_component_type_id', lang('label_type'), 'trim|required');
		        $this->form_validation->set_rules('description', lang('label_description'), 'trim|required');
		        
		        if($this->form_validation->run() == TRUE)
		        {
		          if($this->input->post('salary_component_id') == "")
		          {              
		           $this->db->trans_start();         
		           $data   = array(   
		                            'salary_component'    				=> $this->input->post('salary_component'),
		                            'salary_component_abbr'    			=> $this->input->post('salary_component_abbr'),    
		                            'salary_component_type_id'			=> $this->input->post('salary_component_type_id'),
		                            'description' 			   			=> $this->input->post('description'),
		                            'created_on'          				=> date('Y-m-d H:i:s'),
		                            'updated_on'          				=> date('Y-m-d H:i:s'),
		                            'created_by'          				=> $this->auth_user_id,
		                            'updated_by'          				=> $this->auth_user_id
		                            );  
			        $result = $this->mcommon->common_insert('hr_salary_component',$data); 
			        
			        foreach ($company_idArr as $key =>$value) 
			        {
			        	$data1  = array(
				        				'salary_component_id'				=> $result,
				        				'company_id'						=> $company_idArr[$key],
				        				'default_account'					=> $default_accountArr[$key],
				        				'created_on'          				=> date('Y-m-d H:i:s'),
			                            'created_by'          				=> $this->auth_user_id,
			                            'updated_by'          				=> $this->auth_user_id
				        				);
			        	$result1 = $this->mcommon->common_insert('hr_salary_component_account', $data1);
			        }
			        $this->db->trans_complete();
		            
		            if($result1)
		            {
		              $this->session->set_flashdata('msg', 'Saved Successfully');
		              $this->session->set_flashdata('alertType', 'success');
		              //redirect(base_url('sales/Setup/Terms_and_conditions_template/add'));
		              $ajaxResponse['result'] = 'success';
		            }
		          }
		          else
		          {
		            $data = array(
			                        'salary_component'    		=> $this->input->post('salary_component'),
			                        'salary_component_abbr'    	=> $this->input->post('salary_component_abbr'),    
			                        'salary_component_type_id'	=> $this->input->post('salary_component_type_id'),
			                        'description' 			   	=> $this->input->post('description'),
			                        'updated_on'          		=> date('Y-m-d H:i:s'),
			                        'updated_by'         		=> $this->auth_user_id
		                        );
		            
		            $where_array  = array('salary_component_id' =>  $this->input->post('salary_component_id'));
		            
		            $this->db->trans_start();         
			        $result = $this->mcommon->common_edit('hr_salary_component',$data, $where_array); 
			       
			       foreach ($company_idArr as $key => $value) 
			        {
			        	 $data1  = array(
				        				'company_id'						=>$company_idArr[$key],
				        				'default_account'					=>$default_accountArr[$key],
			                            'updated_by'          				=> $this->auth_user_id
				        				);
			        	 if($account_idArr[$key] != '')
			        	 {
			        	 	$where_array  = array('salary_component_account_id' =>    $account_idArr[$key]);
				        	$result1 = $this->mcommon->common_edit('hr_salary_component_account', $data1, $where_array);
			        	 }
			        	 else
			        	 {
			        	 	$data1  = array(
				        				'salary_component_id' 				=> $this->input->post('salary_component_id'),
				        				'company_id'						=>$company_idArr[$key],
				        				'default_account'					=>$default_accountArr[$key],
			                            'updated_by'          				=> $this->auth_user_id
				        				);
			       			$result1 = $this->mcommon->common_insert('hr_salary_component_account', $data1);

			        	 }
			        }
			        $this->db->trans_complete();
		            
		            if($result || $result1)
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
				$constraint_array 	=	array('salary_component_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('hr_salary_component', $constraint_array);

				$constraint_array1 	=	array('salary_component_account_id' 	=>	 $this->input->get('pkey_id'));
				$Data['tableData1']	=	$this->mcommon->records_all('hr_salary_component_account', $constraint_array);		
			}

		    //Ajax Form Load
		    $Data['ActionUrl']   =  'hr/Payroll/Salary_components/ajaxLoadForm';
		    //Add new popup
		    $Data['dropdownUrllink']=	 'hr/Payroll/Salary_structure/ajaxDropdownPopupForm4';
		    $this->load->view('hr/Payroll/form/Salary_components_form', $Data);
	    }
 	}

	public function delete($salary_component_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array  = array('salary_component_id' => $salary_component_id);
		$this->db->trans_start();
		$result       = $this->mcommon->common_edit('hr_salary_component', $data, $where_array);
		$data1 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$result1       = $this->mcommon->common_edit('hr_salary_component_account', $data1, $where_array);
		$this->db->trans_complete();
		if($result)
		{
			$this->session->set_flashdata('msg', 'Deleted Successfully');
		    $this->session->set_flashdata('alertType', 'success');
			redirect(base_url('hr/Payroll/Salary_components'));		              
		}	                                         
	}

	public function datatable()
	{
		$this->datatables->select('hsc.salary_component_id, hsc.salary_component, hsc.salary_component_abbr, hsct.type, hsc.updated_on, CONCAT(up.first_name, " ", up.last_name)')
		->from('hr_salary_component as hsc')
		->where('hsc.is_delete', '0')
		->join('user_profile as up', 'up.user_id = hsc.updated_by')
		->join('def_hr_salary_component_type as hsct', 'hsct.salary_component_type_id = hsc.salary_component_type_id')
		->edit_column('hsc.salary_component_id', get_ajax_buttons('$1', 'hr/Payroll/Salary_components/'), 'hsc.salary_component_id')
		->edit_column('hsc.updated_on', '$1', 'get_date_timeformat(hsc.updated_on)');	
		$this->db->order_by('hsc.updated_on', DESC);
		echo $this->datatables->generate();  
    }

	// For dropdown Default amount Add new
    public function ajaxDropdownPopupForm4($Data = array())
	{
	    $isFormLoad = TRUE;
	    
	    if(!empty($_POST))
	    {
	      //This will convert the string to array
	      parse_str($_POST['postdata'], $_POST);
	        
	        $this->form_validation->set_rules('account_name', lang('label_account_name'), 'trim|required');
	        $this->form_validation->set_rules('tax_rate',lang('label_rate'), 'trim|required');

	        if($this->form_validation->run() == TRUE)
	        {
	          if($this->input->post('account_id') == "")
	          {              
	            //insert function without id
	           $parent_account			=	$this->input->post('parent_account');
	           $data   = array(   
	           					'account_name'				=>	$this->input->post('account_name'),
	                            'is_group'					=>	($this->input->post('is_group'))?'1' : '0',
	                            'company_id'				=>	$this->input->post('company_id'),
	                            'account_root_type_id'		=>	$this->input->post('account_root_type_id'),
	                            'account_report_type_id'	=>	$this->input->post('account_report_type_id'),
	                            'currency_id'				=>	$this->input->post('currency_id'),
	                            'parent_account' 			=>  (empty($parent_account) ? NULL : $parent_account),
	                            'account_account_type_id'	=>	$this->input->post('account_account_type_id'),
	                            'tax_rate'					=>	$this->input->post('tax_rate'),
	                            'account_freeze_account_id'	=>	$this->input->post('account_freeze_account_id'),
	                            'account_balance_must_be_id'=>	$this->input->post('account_balance_must_be_id'),
	                            'created_on'    			=>  date('Y-m-d H:i:s'),
								'created_by'    			=>  $this->auth_user_id,
								'updated_by'				=>  $this->auth_user_id
	                            );           
	            $result = $this->mcommon->common_insert('acc_account',$data); 

	            if($result)
	            {
	              $this->session->set_flashdata('msg', 'Saved Successfully');
	              $this->session->set_flashdata('alertType', 'success');
	              //redirect(base_url('sales/Setup/Terms_and_conditions_template/add'));
	              $ajaxResponse['result'] = 'success';
	            }
	          }
	          else
	          {
	            $data = array(
	            				'account_name'				=>	$this->input->post('account_name'),
	                            'is_group'					=>	$this->input->post('is_group'),
	                            'company_id'				=>	$this->input->post('company_id'),
	                            'account_root_type_id'		=>	$this->input->post('account_root_type_id'),
	                            'account_report_type_id'	=>	$this->input->post('account_report_type_id'),
	                            'currency_id'				=>	$this->input->post('currency_id'),
	                            'parent_account' 			=>  (empty($parent_account) ? NULL : $parent_account),
	                            'account_account_type_id'	=>	$this->input->post('account_account_type_id'),
	                            'tax_rate'					=>	$this->input->post('tax_rate'),
	                            'account_freeze_account_id'	=>	$this->input->post('account_freeze_account_id'),
	                            'account_balance_must_be_id'=>	$this->input->post('account_balance_must_be_id'),
	                        	'updated_by'				=> $this->auth_user_id
	                        );
	            
	            $where_array  = array('account_id' =>    $this->input->post('account_id'));
	            
	            $result=$this->mcommon->common_edit('acc_account',$data,$where_array);
	            
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
	        $constraint_array   = array('account_id'  =>   $this->input->get('pkey_id'));
	        $Data['tableData']  = $this->mcommon->records_all('acc_account', $constraint_array);
	      }

	      //Ajax Form Load
	      $Data['ActionUrl']   =  'accounts/Company_and_accounts/Chart_of_Accounts/ajaxLoadForm';
	      $this->load->view('accounts/Company_and_accounts/form/Chart_of_Accounts_form', $Data);
	    }
	}
}