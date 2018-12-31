<?php
/*
 * function that generate the action buttons edit, delete
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */

function get_buttons($id, $url)
{
    $ci 	 = & get_instance();
    $deleteUrl  = base_url($url.'/delete/'.$id);
    $html 	 = '<span class="actions">';
    $html   .= '<a href="' . base_url() .$url.'edit/'.$id .'" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';
    $html   .= '&nbsp;&nbsp;';
    $html   .= '<a href="javascript:confirmDelete(\''.$deleteUrl.'\');" href="' . base_url().$url.'delete/'.$id .'" title="Delete"><i class="os-icon os-icon-cancel-square"></i></a>';  
    //$html   .= '<a href="' . base_url().$url.'delete/'.$id .'" title="Delete"><i class="os-icon os-icon-cancel-square"></i></a>';
    $html   .= '</span>';
    return $html;
}

function module_buttons($id, $url)
{
    $ci          = & get_instance();
    $checkExisit = $ci->mcommon->specific_record_counts('acl_actions', array('category_id' => $id));

    $deleteUrl  = base_url($url.'/delete/'.$id);
    $html    = '<span class="actions">';
    $html   .= '<a href="' . base_url() .$url.'edit/'.$id .'" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';
    $html   .= '&nbsp;&nbsp;';
    $html   .= '<a href="javascript:moduleDelete(\''.$deleteUrl.'\', \''.$checkExisit.'\');" href="' . base_url().$url.'delete/'.$id .'" title="Delete"><i class="os-icon os-icon-cancel-square"></i></a>'; 
    $html   .= '</span>';
    return $html;
}

function trainer_buttons($id, $url)
{
    $ci         = & get_instance();
    $formUrl    = base_url($url.'/ajaxLoadForm/'.$id);
    $deleteUrl  = base_url($url.'/delete/'.$id);
    $html    = '<span class="actions">';
    $html   .= '<a href="javascript:addNewPopAngular(\''.$formUrl.'\');" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';
    $html   .= '&nbsp;&nbsp;';
    $html   .= '<a href="javascript:trainerDelete(\''.$deleteUrl.'\', \''.$id.'\');" href="' . base_url().$url.'delete/'.$id .'" title="Delete"><i class="os-icon os-icon-cancel-square"></i></a>';    
    $html   .= '</span>';
    return $html;
}

function get_ajax_buttons($id, $url)
{
    $ci 	 	= & get_instance();
    $formUrl 	= base_url($url.'/ajaxLoadForm/'.$id);
    $deleteUrl 	= base_url($url.'/delete/'.$id);
    $html 	 = '<span class="actions">';
    $html   .= '<a href="javascript:addNewPopAngular(\''.$formUrl.'\');" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';
    $html   .= '&nbsp;&nbsp;';
    $html   .= '<a href="javascript:confirmDelete(\''.$deleteUrl.'\');" href="' . base_url().$url.'delete/'.$id .'" title="Delete"><i class="os-icon os-icon-cancel-square"></i></a>';    
    $html   .= '</span>';
    return $html;
}

function get_ajax_buttons_page_form($id, $url)
{
    $ci         = & get_instance();
    $formUrl    = base_url($url.'/edit/'.$id);
    $deleteUrl  = base_url($url.'/delete/'.$id);

   
    $html    = '<span class="actions">';
    $html   .= '<a href="' . base_url().$url.'edit/'.$id .'" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';
    $html   .= '&nbsp;&nbsp;';
    $html   .= '<a href="javascript:confirmDelete(\''.$deleteUrl.'\');" href="' . base_url().$url.'delete/'.$id .'" title="Delete"><i class="os-icon os-icon-cancel-square"></i></a>';    
    $html   .= '</span>';
    return $html;
}

function get_item_buttons_page_form($id, $url)
{
    $ci         = & get_instance();
    $formUrl    =  base_url($url.'/edit/'.$id);
    $deleteUrl  = base_url($url.'/delete/'.$id);
    $detailUrl  = $url.'/ajaxcontentquickStock/'.$id;
    
    $html    = '<span class="actions">';
        $html   .= '<a href="javascript:addNewPop(\''.$detailUrl.'\', \''.$id.'\');" title="Quick Stock Entry"><i class="fa fa-database fa-1x btn-primary "></i></i></a>';
    $html   .= '&nbsp;&nbsp;';
    $html   .= '<a href="' . base_url().$url.'edit/'.$id .'" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';
    $html   .= '&nbsp;&nbsp;';
    $html   .= '<a href="javascript:confirmDelete(\''.$deleteUrl.'\');" href="' . base_url().$url.'delete/'.$id .'" title="Delete"><i class="os-icon os-icon-cancel-square"></i></a>';    
    $html   .= '</span>';
    return $html;
}

function get_ajax_buttons_Quotation_form($id, $url, $valid_till, $quotation_status_id)
{
    $ci         = & get_instance();
    $formUrl    =  base_url($url.'/edit/'.$id);
    $deleteUrl  = base_url($url.'/delete/'.$id);
    $detailUrl  = $url.'/ajaxLoadFormDetail/'.$id;
    $html       = '<span class="actions">';

    if(strtotime(date('Y-m-d')) <= strtotime($valid_till) && $quotation_status_id ==1) 
    {
        
        $html   .= '<a href="' . base_url().$url.'edit/'.$id .'" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';
        $html   .= '&nbsp;&nbsp;';
    }elseif(strtotime(date('Y-m-d')) >= strtotime($valid_till) && $quotation_status_id !=4)
    {
         $where_array       =   array('quotation_id'   => $id);
          $data             =   array('quotation_status_id'   => '8');
         $result1        =   $ci->mcommon->common_edit('sales_quotation_more_info', $data, $where_array); 
        $html   .= '<a href="javascript:addNewPop(\''.$detailUrl.'\', \''.$id.'\');" title="Detail"><i class="os-icon os-icon-newspaper"></i></a>';
        $html   .= '&nbsp;&nbsp;';
    }else
    {
        $html   .= '<a href="javascript:addNewPop(\''.$detailUrl.'\', \''.$id.'\');" title="Detail"><i class="os-icon os-icon-newspaper"></i></a>';
        $html   .= '&nbsp;&nbsp;';
    }

    $html   .= '<a href="javascript:confirmDelete(\''.$deleteUrl.'\');" href="' . base_url().$url.'delete/'.$id .'" title="Delete"><i class="os-icon os-icon-cancel-square"></i></a>';    
    $html   .= '</span>';
    return $html;
}

function getQuotationStatus($quotation_status_id='')
{
    if($quotation_status_id == 1)
    {
        $html = '<span class="label text-success">Draft</span>';
    }elseif($quotation_status_id == 2)
    {
        $html = '<span class="label text-success">Submitted</span>';
    }elseif($quotation_status_id == 3)
    {
        $html = '<span class="label text-danger">Ordered</span>';
    }
    elseif($quotation_status_id == 4)
    {
        $html = '<span class="label text-danger">Lost</span>';
    }elseif($quotation_status_id == 5)
    {
        $html = '<span class="label text-danger">Cancelled</span>';
    }
    elseif($quotation_status_id == 6)
    {
        $html = '<span class="label text-danger">Open</span>';
    }
    elseif($quotation_status_id == 7)
    {
        $html = '<span class="label text-danger">Replied</span>';
    }
    elseif($quotation_status_id == 8)
    {
        $html = '<span class="label text-danger">Expired</span>';
    }

    return $html;
}

function PurchaseorderStatus($quotation_status_id='')
{
    if($quotation_status_id == 1)
    {
        $html = '<span class="label text-success">Draft</span>';
    }elseif($quotation_status_id == 2)
    {
        $html = '<span class="label text-success">Submitted</span>';
    }elseif($quotation_status_id == 3)
    {
        $html = '<span class="label text-danger">Stopped</span>';
    }
    elseif($quotation_status_id == 4)
    {
        $html = '<span class="label text-danger">Cancelled</span>';
    }
    return $html;
}

function get_ajax_buttons_page_payment_req_form($id, $url)
{
    $ci         = & get_instance();
    $formUrl    =  base_url($url.'/edit/'.$id);
    $deleteUrl  = base_url($url.'/delete/'.$id);

    $html    = '<span class="actions">';
    $html   .= '<a href="' . base_url().$url.'edit/'.$id .'" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';
    $html   .= '&nbsp;&nbsp;';
    $html   .= '<a href="javascript:confirmDelete(\''.$deleteUrl.'\');" href="' . base_url().$url.'delete/'.$id .'" title="Delete"><i class="os-icon os-icon-cancel-square"></i></a>';    
    $html   .= '</span>';
    return $html;
}

function getStatus($status='')
{
    if($status == 1)
    {
        $html = '<span class="badge" style="background-color: #3c763d; color: white;" >Active</span>';
    }else
    {
        $html = '<span class="badge" style="background-color: #e81a10; color: white;" >In Active</span>';
    }

    return $html;
}

function employeeStatus($status='')
{
    if($status == 1)
    {
        $html = '<span class="badge" style="background-color: #3c763d; color: white;" >Active</span>';
    }else
    {
        $html = '<span class="badge" style="background-color: #e81a10; color: white;" >Left</span>';
    }

    return $html;
}

function get_loan_type_status($status='')
{
    if($status == 1)
    {
        $html = '<span class="badge" style="background-color: #e81a10; color: white;" >In Active</span>';
    }else
    {
        $html = '<span class="badge" style="background-color: #3c763d; color: white;" >Active</span>';
    }
    return $html;
}

function getdefaultStatus($status='')
{
    if($status == 1)
    {
        $html = '<i class="1x label-success"> Yes</i>';
    }else
    {
        $html = '<i class="1x label-danger ">No</i>';
    }

    return $html;
}

function get_disable_status($status='')
{
	if($status == 1)
    {
        $html = '<span class="badge" style="background-color: #3c763d; color: white;" >Active</span>';
    }else
    {
        $html = '<span class="badge" style="background-color: #e81a10; color: white;" >In Active</span>';
    }
	return $html;
}

function get_item_status($status='')
{
    if($status == 1)
    {
        $html = '<span class=" btn-warning">Template</span>';
    }else if($status == 2)
    {
        $html = '<span class="btn-success">Item</span>';
    }else
    {
        $html = '<span class="btn-danger">Varaiant</span>';
    }

    return $html;
}

function get_date_timeformat($date='')
{
	if($date != '0000-00-00 00:00:00')
	{
		return date('d-M-Y', strtotime($date)).' <small>'.date('h:i A', strtotime($date)).'</small>';
	}else
	{
		return '-';
	}
}

function get_date_format($date='')
{
    if($date != '0000-00-00')
    {
        return date('d-M-Y', strtotime($date));
    }else
    {
        return '-';
    }
}

function get_parent_name($id='')
{
    if($id)
    {
        $ci  = & get_instance();
        $name = $ci->mcommon->specific_row_value('inv_warehouse', array('warehouse_id' => $id),'warehouse_name');
        return $name;
    }
}

function get_parent_customer_group_name($id='')
{
    if($id)
    {
        $ci  = & get_instance();
        $name = $ci->mcommon->specific_row_value('crm_customer_group', array('customer_group_id' => $id),'customer_group_name');
        return $name;
    }
}

function get_parent_task($id='')
{
    if($id)
    {
        $ci  = & get_instance();
        $name = $ci->mcommon->specific_row_value('pro_task', array('task_id' => $id),'naming_series');
        return $name;
    }
}

function get_pricingrule_data($id='')
{
    if($id)
    {
        $ci  = & get_instance();
        $name = $ci->mcommon->specific_row_value('def_inv_pricing_rule_apply', array('pricing_rule_apply_id' => $id),'apply_on');
        return $name;
    }
}

function get_pricingrulefor_data($id='')
{
    if($id)
    {
        $ci  = & get_instance();
        $name = $ci->mcommon->specific_row_value('def_inv_pricing_rule_applicable', array('pricing_rule_applicable_id' => $id),'applicable_for');
        return $name;
    }
}

function get_quotation_to($id='')
{
    if($id)
    {
        $ci  = & get_instance();
        $name = $ci->mcommon->specific_row_value('def_sales_quo_quotation_to', array('quo_quotation_to_id' => $id),'quotation_to');
        return $name;
    }
}

function get_quotation_order($id='')
{
    if($id)
    {
        $ci  = & get_instance();
        $name = $ci->mcommon->specific_row_value('def_sales_quotation_order_type', array('quotation_order_type_id' => $id),'order_type');
        return $name;
    }
}

function get_parent_type($id='')
{
    if($id)
    {
        $ci  = & get_instance();
        $name = $ci->mcommon->specific_row_value('acc_account', array('account_id' => $id),'account_name');
        return $name;
    }
}

function get_user_buttons($id, $url, $banned)
{
    $formUrl   = $url.'ajaxLoadForm';
    $popUpUrl  = base_url($url.'/ajaxLoadForm/'.$id);
    $ci 	   = & get_instance();

    $html 	 = '<span class="actions">';
    $html   .= '<a href="javascript:addNewPopAngular(\''.$popUpUrl.'\');" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';

    /*$html   .= '<a href="' . base_url() .$url.'edit/'.$id .'" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';*/
    $html   .= '&nbsp;&nbsp;'; 
    
    if ($banned ==	0) 
    {
        $html   .= '<a href="' . base_url().$url.'statusUpdate/'.$id .'/1" title="Deactivate"><i class="os-icon os-icon-close"></i></a>';
    } 
    else
    {
    	$html   .= '<a href="' . base_url().$url.'statusUpdate/'.$id .'/0" title="Activate"><i class="os-icon os-icon-common-07"></i></a>';	
    } 
    $html   .= '&nbsp;&nbsp;'; 
    $html   .= '<a href="' . base_url().$url.'privilage/'.$id .'" title="Edit Privillage"><i class="os-icon os-icon-user-male-circle2"></i></a>';
    $html   .= '</span>';

    return $html;
}

function get_user_status($bannedStatus='')
{
	if($bannedStatus == 0)
	{
        $html = '<span class="badge" style="background-color: #3c763d; color: white;" >Active</span>';

	}else
	{
        $html = '<span class="badge" style="background-color: #ec0a0a; color: white;" >Banned</span>';
	}

	return $html;
}

/*function get_detail_buttons($id, $url, $banned)
{
    $ci      = & get_instance();

    $html    = '<span class="actions">';
    $html   .= '<a href="' . base_url() .$url.'edit/'.$id .'" title="Edit"><i class="os-icon os-icon-pencil-2">Details</i></a>';
    $html   .= '&nbsp;&nbsp;'; 
    
    if ($banned ==  0) 
    {
        $html   .= '<a href="' . base_url().$url.'statusUpdate/'.$id .'/1" title="Deactivate"><i class="os-icon os-icon-close"></i></a>';
    } 
    else
    {
        $html   .= '<a href="' . base_url().$url.'statusUpdate/'.$id .'/0" title="Activate"><i class="os-icon os-icon-common-07"></i></a>'; 
    } 
    $html   .= '&nbsp;&nbsp;'; 
    $html   .= '<a href="' . base_url().$url.'privilage/'.$id .'" title="Edit Privillage"><i class="os-icon os-icon-user-male-circle2"></i></a>';
    $html   .= '</span>';
}*/

function get_detail_buttons($id, $url)
{

    $ci= & get_instance();
    $html='<span class="actions">';   
    
            $html .='<a href="javascript:void(0)" title="Generate E-Receipt" onclick=showModal('.$id.',"'.$url.'") data-toggle="modal" data-target="#iconForm"><i class="btn btn-link" style="color:gray;">Details</i></a> &nbsp;';
       
    $html.='</span>';
    return $html;  
}

function get_ajax_buttons_details($id, $url)
{
   
    $ci         = & get_instance();
    
    $detailUrl  = base_url($url.'/ajaxLoadFormDetail/'.$id);

    $html    = '<span class="actions">';
    $html   .= '<a href="javascript:addNewPopAngular(\''.$detailUrl.'\');" title="Detail"><i class="os-icon os-icon-newspaper"></i></a>';
    $html   .= '</span>';
    return $html;
}

function get_loan_status($emp_loan_appliction_status_id='')
{
    if($emp_loan_appliction_status_id == 1)
    {
        $html = '<span class="badge" style="background-color: #254afc; color: white;" >Open</span>';
    }
    else if($emp_loan_appliction_status_id == 2)
    {
        $html = '<span class="badge" style="background-color: green; color: white;" >Approved</span>';
    }
    else if($emp_loan_appliction_status_id == 3)
    {
        $html = '<span class="badge" style="background-color: red; color: white;" >Rejected</span>';
    }   


    return $html;
}

function get_loan_approve_status($emp_loan_status_id='')
{
    if($emp_loan_status_id == 1)
    {
        $html = '<span class="label text-success">Sanctioned</span>';
        $html = '<span class="badge" style="background-color: #0acf97; color: white;" >Sanctioned</span>';
    }
    else if($emp_loan_status_id == 2)
    {
        $html = '<span class="label text-primary">Partially Disbursed</span>';
        $html = '<span class="badge" style="background-color: #333; color: white;" >Disbursed</span>';

    }
    else if($emp_loan_status_id == 3)
    {
        $html = '<span class="label text-primary">Fully Disbursed</span>';
        $html = '<span class="badge" style="background-color: #ff679b; color: white;" >Fully Disbursed</span>';
    }

    else if($emp_loan_status_id == 4)
    {
        $html = '<span class="label text-success">Repaid/Closed</span>';
        $html = '<span class="badge" style="background-color: #f1556c; color: white;" >Repaid/Closed</span>';

    }else
    {
        $html = '<span class="badge" style="background-color: #254afc; color: white;" >New</span>';
    }

    return $html;
}

function get_ajax_buttons_loan($id, $url, $emp_loan_appliction_status_id)
{
    $ci         = & get_instance();
    $formUrl    = base_url($url.'/ajaxLoadForm/'.$id);
    $detailUrl  = base_url($url.'/ajaxLoadFormDetail/'.$id);

    $html    = '<span class="actions">';
    if($emp_loan_appliction_status_id != 3)
    {
        $html   .= '<a href="javascript:addNewPopAngular(\''.$formUrl.'\');" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';       
        $html   .= '&nbsp;&nbsp;';
    }
    $html   .= '<a href="javascript:addNewPopAngular(\''.$detailUrl.'\');" title="Detail"><i class="os-icon os-icon-newspaper"></i></a>';
    $html   .= '</span>'; 
    return $html; 
}

function get_salary_silp_status($employee_salary_slip_status_id='')
{
    if($employee_salary_slip_status_id == 1)
    {
        $html = '<span class="badge" style="background-color: #254afc; color: white;" >Draft</span>';

    }
    else if($employee_salary_slip_status_id == 2)
    {
        $html = '<span class="badge" style="background-color: #0acf97; color: white;" >Submitted</span>';

    }
    else if($employee_salary_slip_status_id == 3)
    {
        $html = '<span class="badge" style="background-color: #ea1f15; color: white;" >Canceled</span>';
    }

    return $html;
}

function get_supplier_quoatation_status($supplier_quo_status_id='')
{
    if($supplier_quo_status_id == 1)
    {
        $html = '<span class="label text-primary">Draft</span>';
    }
    else if($supplier_quo_status_id == 2)
    {
        $html = '<span class="label text-success">Submitted</span>';

    }
    else if($supplier_quo_status_id == 3)
    {
        $html = '<span class="label text-danger">Stopped</span>';
    }else if($supplier_quo_status_id == 4)
    {
        $html = '<span class="label text-danger">Cancelled</span>';
    }

    return $html;
}

function get_ajax_buttons_salary_silp($id, $url, $employee_salary_slip_status_id)
{
    $ci         = & get_instance();
    $formUrl    = base_url($url.'/edit/'.$id);
    //$detailUrl  = $url.'/ajaxLoadFormDetail/';
    $detailUrl  = base_url($url.'/ajaxLoadFormDetail/'.$id);

    $html    = '<span class="actions">';

    if($employee_salary_slip_status_id < 3)
    {        
        $html   .= '<a href="' . base_url().$url.'/edit/'.$id .'" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';
        $html   .= '&nbsp;&nbsp;';
    }    
    //$html   .= '<a href="javascript:addNewPop(\''.$detailUrl.'\', \''.$id.'\');" title="Detail"><i class="os-icon os-icon-newspaper"></i></a>';
    $html   .= '<a href="javascript:addNewPopAngular(\''.$detailUrl.'\');" title="Detail"><i class="os-icon os-icon-newspaper"></i></a>';
    $html   .= '</span>'; 
    return $html; 
}

function get_ajax_buttons_loanDetail($id, $url, $emp_loan_status_id)
{
    $ci         = & get_instance();
    $formUrl    = base_url($url.'/ajaxLoadForm/'.$id);
    $detailUrl  = base_url($url.'/ajaxLoadFormDetailLoan/'.$id);

    $html    = '<span class="actions">';

    if($emp_loan_status_id == 0)
    { 
        $html   .= '<a href="javascript:addNewPopAngular(\''.$formUrl.'\');" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';
        $html   .= '&nbsp;&nbsp;';
    }
    else if($emp_loan_status_id > 0)
    {
        $html   .= '<a href="javascript:addNewPopAngular(\''.$detailUrl.'\');" title="Detail"><i class="os-icon os-icon-newspaper"></i></a>';
    }
    
    $html   .= '</span>'; 
    return $html;  
}

function get_approver_status($expense_claim_approval_status_id='')
{
    if($expense_claim_approval_status_id == 0)
    {
        $html = '<span class="badge" style="background-color: #254afc; color: white;" >Open</span>';
    }
    else if($expense_claim_approval_status_id == 1)
    {
        $html = '<span class="badge" style="background-color: green; color: white;" >Approved</span>';
    }
    else if($expense_claim_approval_status_id == 2)
    {
        $html = '<span class="badge" style="background-color: red; color: white;" >Rejected</span>';
    }

    return $html;
}

function get_leave_status($leave_application_status_id='')
{
    if($leave_application_status_id == 1)
    {
        $html = '<span class="badge" style="background-color: #254afc; color: white;" >Open</span>';
    }
    else if($leave_application_status_id == 2)
    {
        $html = '<span class="badge" style="background-color: green; color: white;" >Approved</span>';

    }
    else if($leave_application_status_id == 3)
    {
        $html = '<span class="badge" style="background-color: red; color: white;" >Rejected</span>';
    }

    return $html;
}

function get_ajax_buttons_approver($id, $url, $expense_claim_approval_status_id)
{
    $ci         = & get_instance();
    $formUrl    = base_url($url.'/ajaxLoadForm/'.$id);
    $detailUrl  = base_url($url.'/ajaxapproverrejectionDetail/'.$id);

    $html    = '<span class="actions">';
    if($expense_claim_approval_status_id != 2)
    {
        $html   .= '<a href="javascript:addNewPopAngular(\''.$formUrl.'\');" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';
        $html   .= '&nbsp;&nbsp;';
    }
    $html   .= '<a href="javascript:addNewPopAngular(\''.$detailUrl.'\');" title="Detail"><i class="os-icon os-icon-newspaper"></i></a>';
    $html   .= '</span>'; 
    return $html; 
}

function get_ajax_buttons_leave($id, $url, $leave_application_status_id)
{
    $ci         = & get_instance();
    $formUrl    = base_url($url.'/ajaxLoadForm/'.$id);
    $detailUrl  = base_url($url.'/ajaxleaverejectionDetail/'.$id);

    $html    = '<span class="actions">';
    if($leave_application_status_id == 1)
    {
    $html   .= '<a href="javascript:addNewPopAngular(\''.$formUrl.'\');" title="Edit"><i class="os-icon os-icon-pencil-2"></i></a>';
    $html   .= '&nbsp;&nbsp;';
    }
    $html   .= '<a href="javascript:addNewPopAngular(\''.$detailUrl.'\');" title="Detail"><i class="os-icon os-icon-newspaper"></i></a>';
    $html   .= '</span>'; 
    return $html; 
}

function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) 
{
    $dates      = array();
    $current    = strtotime($first);
    $last       = strtotime($last);

    while( $current <= $last ) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}

?>
