<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends MY_Controller
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
  		if( $this->acl_permits('setting.company_master') )
    	{
			$view_data = array(
								'form_heading' 		=> $this->lang->line('company_form_heading'),
								'form_title' 		=> $this->lang->line('company_form_title'),
								//'form_description' 	=> $this->lang->line('company_description'),
								//'list_heading' 		=> $this->lang->line('company_form_heading'),
								//'list_title' 		=> $this->lang->line('company_form_title'),
								'list_description' 	=> $this->lang->line('company_description'),
								'formUrl' 			=> 'setting/Master_settings/Company/ajaxLoadForm',
								'list_view' 		=> TRUE,
								'buttonview' 		=> TRUE
							  ); 

			$tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
			$this->table->set_template($tmpl); 		 
			$this->table->set_heading('Action', 'Company', 'Abbreviation', 'Last Update', 'Updated by');
			$view_data['dataTableUrl']   =	 'setting/Master_settings/Company/datatable';
			$data = array(
		            	    'title'     => 	'MEP - '.$this->lang->line('company_form_heading'),
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
			$this->form_validation->set_rules('company_name', lang('label_company'), 'trim|required');
			$this->form_validation->set_rules('abbr', lang('label_abbreviation'), 'trim|required');

			if($this->form_validation->run() == TRUE) 
			{
				//Insert if not id's are given
				if($this->input->post('company_id') == "")
	            {
					//insert function without id  
					$data   = array(
					                'company_name'			=> $this->input->post('company_name'),
					                'abbr'					=> $this->input->post('abbr'),
					                'company_domain_id'  	=> $this->input->post('company_domain_id'),    
					                'is_default'  			=> ($this->input->post('is_default')) ? '1' : '0',    
					                'created_on'    		=> date('Y-m-d H:i:s'),
									'created_by'    		=> $this->auth_user_id,
                                	'updated_on'              => date('Y-m-d H:i:s'),
									'updated_by'			=> $this->auth_user_id
					              );           
					$result = $this->mcommon->common_insert('set_company', $data); 

					$data1  = array(
									'company_id' 							=> $result,
									'letter_head_id' 						=> $this->input->post('letter_head_id'),
									'holiday_list_id' 						=> $this->input->post('holiday_list_id'),
									'tc_id' 								=> $this->input->post('tc_id'),
									'currency_id' 							=> $this->input->post('currency_id'),
									'country_id' 							=> $this->input->post('country_id'),
									'company_chart_of_accounts_id' 			=> $this->input->post('company_chart_of_accounts_id'),
									'existing_company' 						=> $this->input->post('existing_company'),
									'created_on'    						=> date('Y-m-d H:i:s'),
									'created_by'    						=> $this->auth_user_id,
									'updated_by'							=> $this->auth_user_id
									);
					$result1 = $this->mcommon->common_insert('set_company_default_values', $data1);

					$data2 	 = array(
									'company_id' 							=> $result,
									'sales_monthly_history' 				=> $this->input->post('sales_monthly_history'),
									'sales_target' 							=> $this->input->post('sales_target'),
									'total_monthly_sales' 					=> $this->input->post('total_monthly_sales'),
									'created_on'    						=> date('Y-m-d H:i:s'),
									'created_by'    						=> $this->auth_user_id,
									'updated_by'							=> $this->auth_user_id
									);
					$result2 = $this->mcommon->common_insert('set_company_sales_settings', $data2);

					$data3 	 = array(
									'company_id' 							=> $result,
									'default_bank_account' 					=> $this->input->post('default_bank_account'),
									'default_cash_account' 					=> $this->input->post('default_cash_account'),
									'default_receivable_account' 			=> $this->input->post('default_receivable_account'),
									'round_off_account' 					=> $this->input->post('round_off_account'),
									'write_off_account' 					=> $this->input->post('write_off_account'),
									'exchange_gain_loss_account' 			=> $this->input->post('exchange_gain_loss_account'),
									'default_payable_account' 				=> $this->input->post('default_payable_account'),
									'default_expense_account' 				=> $this->input->post('default_expense_account'),
									'default_income_account' 				=> $this->input->post('default_income_account'),
									'default_payroll_payable_account' 		=> $this->input->post('default_payroll_payable_account'),
									'round_off_cost_center' 				=> $this->input->post('round_off_cost_center'),
									'default_cost_center' 					=> $this->input->post('default_cost_center'),
									'credit_limit' 							=> $this->input->post('credit_limit'),
									'customer_credit_days_based_id' 		=> $this->input->post('customer_credit_days_based_id'),
									'credit_days' 							=> $this->input->post('credit_days'),
									'created_on'    						=> date('Y-m-d H:i:s'),
									'created_by'    						=> $this->auth_user_id,
									'updated_by'							=> $this->auth_user_id
									);
					$result3 = $this->mcommon->common_insert('set_company_account_settings', $data3);

					$data4 	 = array(
									'company_id' 							=> $result,
									'accumulated_depreciation_account' 				=> $this->input->post('accumulated_depreciation_account'),
									'depreciation_expense_account' 							=> $this->input->post('depreciation_expense_account'),
									'series_for_depreciation_entry' 					=> $this->input->post('series_for_depreciation_entry'),
									'disposal_account' 					=> $this->input->post('disposal_account'),
									'depreciation_cost_center' 					=> $this->input->post('depreciation_cost_center'),
									'created_on'    						=> date('Y-m-d H:i:s'),
									'created_by'    						=> $this->auth_user_id,
									'updated_by'							=> $this->auth_user_id
									);
					$result4 = $this->mcommon->common_insert('set_company_fixed_asset_depreciation_settings', $data4);

					$data5 	 = array(
									'company_id' 							=> $result,
									'phone_no' 								=> $this->input->post('phone_no'),
									'fax' 									=> $this->input->post('fax'),
									'email' 								=> $this->input->post('email'),
									'website' 								=> $this->input->post('website'),
									'registration_details' 					=> $this->input->post('registration_details'),
									'created_on'    						=> date('Y-m-d H:i:s'),
									'created_by'    						=> $this->auth_user_id,
									'updated_by'							=> $this->auth_user_id
									);
					$result5 = $this->mcommon->common_insert('set_company_info', $data5);


					$data6 	 = array(
									'company_id' 							=> $result,
									'enable_perpetual_inventory' 			=> ($this->input->post('enable_perpetual_inventory'))? '1' : '0',
									'default_inventory_account' 			=> $this->input->post('default_inventory_account'),
									'stock_adjustment_account' 				=> $this->input->post('stock_adjustment_account'),
									'stock_received_but_not_billed' 		=> $this->input->post('stock_received_but_not_billed'),
									'expenses_included_in_valuation' 		=> $this->input->post('expenses_included_in_valuation'),
									'created_on'    						=> date('Y-m-d H:i:s'),
									'created_by'    						=> $this->auth_user_id,
									'updated_by'							=> $this->auth_user_id
									);
					$result6 = $this->mcommon->common_insert('set_company_auto_account_stock_settings', $data6);

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
					$data   = array(
					                'company_name'			=> $this->input->post('company_name'),
					                'abbr'					=> $this->input->post('abbr'),
					                'company_domain_id'  	=> $this->input->post('company_domain_id'),
					                'is_default'  			=> ($this->input->post('is_default')) ? '1' : '0',  
                                	'updated_on'              => date('Y-m-d H:i:s'),
									'updated_by'			=> $this->auth_user_id
					              ); 
				    $where_array  = array('company_id' =>    $this->input->post('company_id'));          
					$result = $this->mcommon->common_edit('set_company', $data, $where_array); 

					$data1  = array(
									'letter_head_id' 						=> $this->input->post('letter_head_id'),
									'holiday_list_id' 						=> $this->input->post('holiday_list_id'),
									'tc_id' 								=> $this->input->post('tc_id'),
									'currency_id' 							=> $this->input->post('currency_id'),
									'country_id' 							=> $this->input->post('country_id'),
									'company_chart_of_accounts_id' 			=> $this->input->post('company_chart_of_accounts_id'),
									'existing_company' 						=> $this->input->post('existing_company'),
									'updated_by'							=> $this->auth_user_id
									);
					$result1 = $this->mcommon->common_edit('set_company_default_values', $data1, $where_array);

					$data2 	 = array(
									'sales_monthly_history' 				=> $this->input->post('sales_monthly_history'),
									'sales_target' 							=> $this->input->post('sales_target'),
									'total_monthly_sales' 					=> $this->input->post('total_monthly_sales'),
									'updated_by'							=> $this->auth_user_id
									);
					$result2 = $this->mcommon->common_edit('set_company_sales_settings', $data2, $where_array);

					$data3 	 = array(
									'default_bank_account' 					=> $this->input->post('default_bank_account'),
									'default_cash_account' 					=> $this->input->post('default_cash_account'),
									'default_receivable_account' 			=> $this->input->post('default_receivable_account'),
									'round_off_account' 					=> $this->input->post('round_off_account'),
									'write_off_account' 					=> $this->input->post('write_off_account'),
									'exchange_gain_loss_account' 			=> $this->input->post('exchange_gain_loss_account'),
									'default_payable_account' 				=> $this->input->post('default_payable_account'),
									'default_expense_account' 				=> $this->input->post('default_expense_account'),
									'default_income_account' 				=> $this->input->post('default_income_account'),
									'default_payroll_payable_account' 		=> $this->input->post('default_payroll_payable_account'),
									'round_off_cost_center' 				=> $this->input->post('round_off_cost_center'),
									'default_cost_center' 					=> $this->input->post('default_cost_center'),
									'credit_limit' 							=> $this->input->post('credit_limit'),
									'customer_credit_days_based_id' 		=> $this->input->post('customer_credit_days_based_id'),
									'credit_days' 							=> $this->input->post('credit_days'),
									'updated_by'							=> $this->auth_user_id
									);
					$result3 = $this->mcommon->common_edit('set_company_account_settings', $data3, $where_array);

					$data4 	 = array(
									'accumulated_depreciation_account' 		=> $this->input->post('accumulated_depreciation_account'),
									'depreciation_expense_account' 			=> $this->input->post('depreciation_expense_account'),
									'series_for_depreciation_entry' 		=> $this->input->post('series_for_depreciation_entry'),
									'disposal_account' 						=> $this->input->post('disposal_account'),
									'depreciation_cost_center' 				=> $this->input->post('depreciation_cost_center'),
									'updated_by'							=> $this->auth_user_id
									);
					$result4 = $this->mcommon->common_edit('set_company_fixed_asset_depreciation_settings', $data4, $where_array);

					$data5 	 = array(
									'phone_no' 								=> $this->input->post('phone_no'),
									'fax' 									=> $this->input->post('fax'),
									'email' 								=> $this->input->post('email'),
									'website' 								=> $this->input->post('website'),
									'registration_details' 					=> $this->input->post('registration_details'),
									'updated_by'							=> $this->auth_user_id
									);
					$result5 = $this->mcommon->common_edit('set_company_info', $data5, $where_array);


					$data6 	 = array(
									'enable_perpetual_inventory' 			=> ($this->input->post('enable_perpetual_inventory'))? '1' : '0',
									'default_inventory_account' 			=> $this->input->post('default_inventory_account'),
									'stock_adjustment_account' 				=> $this->input->post('stock_adjustment_account'),
									'stock_received_but_not_billed' 		=> $this->input->post('stock_received_but_not_billed'),
									'expenses_included_in_valuation' 		=> $this->input->post('expenses_included_in_valuation'),
									'updated_by'							=> $this->auth_user_id
									);
					$result6 = $this->mcommon->common_edit('set_company_auto_account_stock_settings', $data6, $where_array);


					if($result || $result1 || $result2 || $result3 || $result4 || $result5 || $result6)
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
				$constraint_array 	=	array('company_id' 	=>	 $pkey_id);
				$Data['tableData']	=	$this->mcommon->records_all('set_company', $constraint_array);
				$Data['tableData1']	=	$this->mcommon->records_all('set_company_default_values', $constraint_array);
				$Data['tableData2']	=	$this->mcommon->records_all('set_company_sales_settings', $constraint_array);
				$Data['tableData3']	=	$this->mcommon->records_all('set_company_account_settings', $constraint_array);
				$Data['tableData4']	=	$this->mcommon->records_all('set_company_fixed_asset_depreciation_settings', $constraint_array);
				$Data['tableData5']	=	$this->mcommon->records_all('set_company_info', $constraint_array);
				$Data['tableData6']	=	$this->mcommon->records_all('set_company_auto_account_stock_settings', $constraint_array);				
			}

			//Ajax Form Load
			$Data['ActionUrl']   = 	'setting/Master_settings/Company/ajaxLoadForm';
			$this->load->view('setting/Master_settings/form/Company_form', $Data);
		}
	}

	//Datatable view
	public function datatable()
	{
		//datatable joining 
		$this->datatables ->select('c.company_id ,c.company_name, c.abbr, c.updated_on, CONCAT(up.first_name, " ", up.last_name)');
		$this->datatables ->from('set_company as c');
		$this->datatables ->join('user_profile as up', 'up.user_id = c.updated_by');
		$this->datatables ->where('c.is_delete', '0');
		$this->datatables ->edit_column('c.company_id', get_ajax_buttons('$1', 'setting/Master_settings/Company/'), 'c.company_id');
		$this->datatables->edit_column('c.updated_on', '$1', 'get_date_timeformat(c.updated_on)');
		$this->db->order_by('c.updated_on', DESC);
		echo $this->datatables->generate();
	}

	public function delete($company_id)
	{
		$data 			=	array(
									'is_delete'  =>	1,
									'updated_by' => $this->auth_user_id
							     );
		$where_array 	=	array('company_id'  =>$company_id);
		$result 		=	$this->mcommon->common_edit('set_company', $data, $where_array);		
		$result1 		=	$this->mcommon->common_edit('set_company_default_values', $data, $where_array);		
		$result2 		=	$this->mcommon->common_edit('set_company_sales_settings', $data, $where_array);		
		$result3 		=	$this->mcommon->common_edit('set_company_account_settings', $data, $where_array);		
		$result4 		=	$this->mcommon->common_edit('set_company_fixed_asset_depreciation_settings', $data, $where_array);		
		$result5 		=	$this->mcommon->common_edit('set_company_info', $data, $where_array);		
		$result6 		=	$this->mcommon->common_edit('set_company_auto_account_stock_settings', $data, $where_array);

		if($result)
		{
			//Session for Delete
			$msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
			$this->session->set_flashdata('alertType', 'success');
			redirect(base_url('setting/Master_settings/Company/'));
		}
	}	
}