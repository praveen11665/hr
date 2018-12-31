<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->lang->load("purchase","english");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->is_logged_in();

		$this->load->model("menu_model", "menu");
		$items = $this->menu->all();
		$this->load->library("multi_menu");
		$this->load->library('form_validation');
		$this->lang->load("app","english");
		$this->multi_menu->set_items($items);
    }

    //Common 404Page error for all modules
	public function common404error($value='')
	{
		$viewData = '';
		$data     = array(
		                  'title'     =>  $this->lang->line('page_not_found_page_title'),
		                  'content'   =>  $this->load->view('file_not_found_form', $viewData,TRUE)
		                  );
		$this->load->view('base/error_template', $data); 
	}   

    public function delete()
    {
    	$where_array  = 	array(
    								$this->input->post('pk_field')  => $this->input->post('val')
    						 	);
    	$table 		  =		$this->input->post('table');
	    $result       = 	$this->mcommon->common_delete($table, $where_array);
	}

	public function loadDropdown($table)
	{
		$where_array 	=  (array) json_decode($this->input->get('search'));
		$output    		=  $this->mcommon->records_all($table, $where_array, 'resultArray');
		echo json_encode($output); 
	}

	public function checkUnique($table, $is_delete='')
	{
		$uniquevalue 	= $this->input->get('uniquevalue');
		$dbfield 		= $this->input->get('dbfield');
		
		if($is_delete == '1')
		{
			$whereArray     = array($dbfield => $uniquevalue);			
		}else
		{
			$whereArray     = array($dbfield => $uniquevalue, 'is_delete' => 0);			
		}

		$checkVal       = $this->mcommon->specific_record_counts($table, $whereArray);
		
		if($checkVal)
		{
			$ajaxResponse['result'] = 'true';
		}
		else
		{
			$ajaxResponse['result'] = 'false';
		}
		echo json_encode($ajaxResponse);
	}		

	public function emailUnique($table)
	{
		$uniquevalue 	= $this->input->get('uniquevalue');
		$dbfield 		= $this->input->get('dbfield');
		$whereArray     = array($dbfield => $uniquevalue, 'is_delete' => 0);

		$checkVal       = $this->mcommon->specific_record_counts($table, $whereArray);
		if($checkVal)
		{
			$ajaxResponse['result'] = 'true';
		}
		else
		{
			$ajaxResponse['result'] = 'false';
		}
		echo json_encode($ajaxResponse);
	}

	public function namingSeriesdrop($transaction_id)
	{
	    $this->db->select('transaction_id, set_options, naming_series_id');
	    $this->db->from('set_naming_series');
	    $this->db->where('transaction_id', $transaction_id);
	    $this->db->where('is_delete', 0);
	    $results 			=   $this->db->get()->result();
	    $optionsNames 		=	array();
	    foreach ($results as $item) 
	    {
	    	$seriesNames	=	explode(',', $item->set_options);
	    	foreach ($seriesNames as $naming)
	    	{
	    		$optionsNames[$item->naming_series_id."_".$naming]  =  $naming;
	    	}
	    	//$optionsNames 	= 	array_merge($seriesNames, $optionsNames);
	    }

	    $options        =   array();
	   	// $options['']    =   lang("label_select_dropdown");
	   	$i = 0;
	    foreach ($optionsNames as $key => $value) 
	    {
	        $options[$i]['naming_series_id'] 	=  $key;
	        $options[$i]['naming_series'] 		=  $value;
	        $i++;
	    }
	    echo json_encode($options);  
	}

	public function checkAttentance($table)
	{
		$employee_id 		= $this->input->get('employee_id');
		$attendance_date 	= date('Y-m-d', strtotime($this->input->get('attendance_date')));	
		$whereArray     	= array('employee_id' => $employee_id, 'attendance_date' => $attendance_date);	
		$checkVal       	= $this->mcommon->specific_record_counts($table, $whereArray);
		
		if($checkVal)
		{
			$ajaxResponse['result'] = 'true';
		}
		else
		{
			$ajaxResponse['result'] = 'false';
		}
		echo json_encode($ajaxResponse);
	}

	public function checkExistLoan()
	{
		$employee_id 		= $this->input->get('employee_id');
		$loan_type_id 		= $this->input->get('loan_type_id');

		$whereArray     	= array('employee_id' => $employee_id, 'loan_type_id' => $loan_type_id);	
		$checkVal       	= $this->mcommon->specific_record_counts('hr_employee_loan_application', $whereArray);
		
		if($checkVal)
		{
			$ajaxResponse['result'] = 'true';
		}
		else
		{
			$ajaxResponse['result'] = 'false';
		}
		echo json_encode($ajaxResponse);
	}


}
?>