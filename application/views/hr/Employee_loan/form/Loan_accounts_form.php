<?php
$ci =&get_instance();
$employeeDropdown           =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_number as Value'), array('is_delete' => 0));
$companyDropdown            =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'), array('is_delete' => 0));
$loanapplicationDropdown    =  $ci->mcommon->Dropdown('hr_employee_loan_application', array('employee_loan_application_id as Key', 'naming_series as Value'));
$loantypeDropdown           =  $ci->mcommon->Dropdown('hr_loan_type', array('loan_type_id as Key', 'loan_name as Value'), array('is_delete' => 0));
$statusDropdown             =  $ci->mcommon->Dropdown('def_hr_emp_loan_status', array('emp_loan_status_id as Key', 'status as Value'));
$repaymentDropdown          =  $ci->mcommon->Dropdown('def_hr_emp_loan_repayment_method', array('emp_loan_repayment_method_id as Key', 'repayment_method as Value'));
$modeofpaymentDropdown      =  $ci->mcommon->Dropdown('def_acc_mode_of_payment_type', array('mode_of_payment_type_id as Key', 'type as Value'));
$paymentaccountDropdown     =  $ci->mcommon->Dropdown('acc_account', array('account_id as Key', 'account_name as Value'), array('is_delete' => 0));
$loanaccountDropdown        =  $ci->mcommon->Dropdown('acc_account', array('account_id as Key', 'account_name as Value'), array('is_delete' => 0));
$interestincomeDropdown     =  $ci->mcommon->Dropdown('acc_account', array('account_id as Key', 'account_name as Value'), array('is_delete' => 0));

$employee_loan_id               = "";
$employee_id                    = "";
$employee_name                  = "";
$employee_loan_application_id   = "";
$loan_type_id                   = "";
$posting_date                   = "";
$emp_loan_status_id             = "";
$company_id                     = "";
$repay_from_salary              = "";
$loan_amount                    = "";
$disbursement_date              = "";
$rate_of_interest               = "";
$emp_loan_repayment_method_id   = "";
$mode_of_payment_id             = "";
$payment_account                = "";
$employee_loan_account          = "";
$interest_income_account        = "";
$total_payable_amount           = "";
$total_payable_interest         = "";
$payment_date                   = array();
$interest_amount                = array();
$total_amount                   = array();
$balance_loan_amount            = array();

if(!empty($tableData))
{
    foreach($tableData as $row)
    {
        $employee_loan_id                   = $row->employee_loan_id;
        $employee_id                        = $row->employee_id;
        $employee_name                      = $row->employee_name;
        $employee_loan_application_id       = $row->employee_loan_application_id;
        $loan_type_id                       = $row->loan_type_id;
        $posting_date                       = $row->posting_date;
        $emp_loan_status_id                 = $row->emp_loan_status_id;
        $company_id                         = $row->company_id;
        $repay_from_salary                  = $row->repay_from_salary;
        $loan_amount                        = $row->loan_amount;
        $disbursement_date                  = $row->disbursement_date;
        $rate_of_interest                   = $row->rate_of_interest;
        $emp_loan_repayment_method_id       = $row->emp_loan_repayment_method_id;
        $mode_of_payment_id                 = $row->mode_of_payment_id;
        $payment_account                    = $row->payment_account;
        $employee_loan_account              = $row->employee_loan_account;
        $total_payable_amount               = $row->total_payable_amount;
        $repayment_amount                   = $row->repayment_amount;
        $repayment_periods                  = $row->repayment_periods;
        $total_payable_interest             = $row->total_payable_interest;
        $interest_income_account            = $row->interest_income_account;
    }
}
else
{
    $employee_loan_id                       = $this->input->post('employee_loan_id');
    $employee_id                            = $this->input->post('employee_id');
    $employee_name                          = $this->input->post('employee_name');
    $employee_loan_application_id           = $this->input->post('employee_loan_application_id');
    $loan_type_id                           = $this->input->post('loan_type_id');
    $posting_date                           = $this->input->post('posting_date');
    $emp_loan_status_id                     = $this->input->post('emp_loan_status_id');
    $company_id                             = $this->input->post('company_id');
    $repay_from_salary                      = $this->input->post('repay_from_salary');
    $loan_amount                            = $this->input->post('loan_amount');
    $disbursement_date                      = $this->input->post('disbursement_date');
    $rate_of_interest                       = $this->input->post('rate_of_interest');
    $emp_loan_repayment_method_id           = $this->input->post('emp_loan_repayment_method_id');
    $mode_of_payment_id                     = $this->input->post('mode_of_payment_id');
    $payment_account                        = $this->input->post('payment_account');
    $employee_loan_account                  = $this->input->post('employee_loan_account');
    $total_payable_amount                   = $this->input->post('total_payable_amount');
    $repayment_amount                       = $this->input->post('repayment_amount'); 
    $repayment_periods                      = $this->input->post('repayment_periods'); 
    $total_payable_interest                 = $this->input->post('total_payable_interest');
    $interest_income_account                = $this->input->post('interest_income_account');
}

if(!empty($tableData1))
{
    foreach($tableData1 as $row)
    {
        $payment_date                       = date('d-m-Y',strtotime($row->payment_date));
        $principal_amount                   = $row->principal_amount;
        $interest_amount                    = $row->interest_amount;
        $total_amount                       = $row->total_amount;
        $balance_loan_amount                = $row->balance_loan_amount;
        $trowRepay++;
    }
}
else
{
    $payment_date                       = $this->input->post('payment_date');
    $principal_amount                   = $this->input->post('principal_amount');
    $interest_amount                    = $this->input->post('interest_amount');
    $total_amount                       = $this->input->post('total_amount');
    $balance_loan_amount                = $this->input->post('balance_loan_amount');
}
$trowRepay     = ($trowRepay) ? ($trowRepay) :'1';
$checkDisable  = ($employee_loan_id == '') ? 'disabled' : '';
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Loan_accounts_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <label for=""><?php echo "<h5>". $this->lang->line('label_Loan_info') . "</h5>";?> </label>       
        <input type="hidden" name="employee_loan_id" id="" value="<?php echo $employee_loan_id;?>">
        <div class="row">
        	<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employee',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employees' )">
            	<div class="form-group">
					<label><?php echo $this->lang->line('label_employee_id');?></label>
					<span class="mandatory">*</span>
					<!--<?php 
                        $attrib = 'class="form-control select2" id="employee_id" onchange="loademployeename();" ng-model="employee_id" ng-init="employee_id = '.$employee_id.'" required';
                        echo form_dropdown('employee_id', $employeeDropdown, set_value('employee_id', (isset($employee_id)) ? $employee_id : ''), $attrib);?>
                        <?PHP if(form_error('employee_id')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';} 
                    ?>-->
                    <select name="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" ng-model="employee_id" id="employee_id" class="form-control" required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="employee_id in employees" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>

                </div>  
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_posting_date');?></label>
                    <span class="mandatory">*</span>            
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="posting_date" is-open="popup1.opened"  ng-required="true"  data-ng-init="init('<?php echo $posting_date?>', 'posting_date')" name="posting_date"  ng-focus="open('popup1')"/>
                    <span class="help-block" ng-show="showMsgs && myform.posting_date.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error('')?></span>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            	<div class="form-group">
					<label><?php echo $this->lang->line('label_employee_name');?></label>
					<input type="text" name="employee_name" id="employee_name"  ng-init="employee_name = '<?php echo $employee_name; ?>'" value="<?php echo $employee_name;?>" class="form-control" readonly/>
					<span class="help-block"><?php echo form_error('')?></span>
                </div>  
            </div>
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'companies' )" >
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_company');?></label>
                    <span class="mandatory">*</span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="company_id" ng-model="company_id" required';
                        echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);?>
                    <?PHP if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} ?> 
                    <span class="help-block"><?php echo form_error('')?></span>-->
                    <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control" required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
                     </select>
                    <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>                        
        </div>
        <!--second row -->
        <div class="row">
            <div class="col-md-6"  ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employee_loan_application','', 'emploans' )" >
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_loan_application');?></label>
                    <span class="mandatory">*</span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="employee_loan_application_id" ng-model="employee_loan_application_id" required';
                        echo form_dropdown('employee_loan_application_id', $loanapplicationDropdown, set_value('employee_loan_application_id', (isset($employee_loan_application_id)) ? $employee_loan_application_id : ''), $attrib);?>
                    <?PHP if(form_error('employee_loan_application_id')){ echo '<span class="help-block">'.form_error('employee_loan_application_id').'</span>';} ?>                              
                    <span class="help-block"><?php echo form_error('')?></span>-->
                    <select name="employee_loan_application_id" ng-init="employee_loan_application_id = '<?php echo $employee_loan_application_id; ?>'" ng-model="employee_loan_application_id" id="employee_loan_application_id" class="form-control" required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="employee_loan_application_id in emploans" value="{{employee_loan_application_id.employee_loan_application_id}}">{{employee_loan_application_id.naming_series}}</option>  
                     </select>
                    <span class="help-block" ng-show="showMsgs && myform.employee_loan_application_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>  
            </div>
            <div class="col-md-6"  ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_emp_loan_status','', 'statuses' )">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_status');?></label>
                    <span class="mandatory">*</span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="emp_loan_status_id" ng-model="emp_loan_status_id" required';
                        echo form_dropdown('emp_loan_status_id', $statusDropdown, set_value('emp_loan_status_id', (isset($emp_loan_status_id)) ? $emp_loan_status_id : ''), $attrib);?>
                    <?PHP if(form_error('emp_loan_status_id')){ echo '<span class="help-block">'.form_error('emp_loan_status_id').'</span>';} ?>-->
                    <select name="emp_loan_status_id" ng-model="emp_loan_status_id" id="emp_loan_status_id" class="form-control" required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="emp_loan_status_id in statuses" value="{{emp_loan_status_id.emp_loan_status_id}}">{{emp_loan_status_id.status}}</option>  
                     </select>                             
                    <span class="help-block" ng-show="showMsgs && myform.emp_loan_status_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>                    	                
        </div>
        <!--Third row -->
		<div class="row">
			<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_loan_type',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'loanTypes' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_loan_type');?></label>
                    <span class="mandatory">*</span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="loan_type_id" ng-model="loan_type_id" required';
                        echo form_dropdown('loan_type_id', $loantypeDropdown, set_value('loan_type_id', (isset($loan_type_id)) ? $loan_type_id : ''), $attrib);?>
                    <?PHP if(form_error('loan_type_id')){ echo '<span class="help-block">'.form_error('loan_type_id').'</span>';} ?>-->
                    <select name="loan_type_id" ng-model="loan_type_id" ng-init="loan_type_id = '<?php echo $loan_type_id; ?>'" id="loan_type_id" class="form-control" required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="loan_type_id in loanTypes" value="{{loan_type_id.loan_type_id}}">{{loan_type_id.loan_name}}</option>  
                     </select> 
                    <span class="help-block" ng-show="showMsgs && myform.loan_type_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>  
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" ng-model="repay_from_salary"  ng-init="repay_from_salary = '<?php echo $repay_from_salary; ?>'" name="repay_from_salary" id="repay_from_salary" <?php if($repay_from_salary == 1){ echo 'checked = "checked"';} ?> /> 
                        <?php echo $this->lang->line('label_repay_from_salary');?>
                    </label>
                </div>
            </div>
		</div> 

        <fieldset>
            <legend> <span> <?php echo $this->lang->line('loan_details');?></span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_loan_amount');?></label>
                        <span class="mandatory">*</span>
                        <input type="text" name="loan_amount" ng-model="loan_amount" required id="maximum_loan_amount"  ng-init="loan_amount = '<?php echo $loan_amount; ?>'" value="<?php echo $loan_amount;?>" class="form-control" maxlength="10" onkeyup = "calculateInterest();" onkeypress="return isNumberKey(event)" readonly/>
                        <span class="help-block"><?php echo form_error('loan_amount');?></span>
                        <span class="help-block" ng-show="showMsgs && myform.loan_amount.$error.required"><?php echo $this->lang->line('required');?></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_rate_of_interest');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="rate_of_interest" ng-model="rate_of_interest" required id="rate_of_interest"  ng-init="rate_of_interest = '<?php echo $rate_of_interest; ?>'" value="<?php echo $rate_of_interest;?>"" class="form-control" onkeyup="calculateInterest();" readonly />
                    <span class="help-block"><?php echo form_error('rate_of_interest')?></span>
                    <span class="help-block" ng-show="showMsgs && myform.rate_of_interest.$error.required"><?php echo $this->lang->line('required');?></span>
                    </div>  
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_disbursement_date');?></label>
                        <span class="mandatory">*</span>
                        <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="disbursement_date" is-open="popup2.opened"  ng-required="true"  data-ng-init="init('<?php echo $disbursement_date?>', 'disbursement_date')" name="disbursement_date"  ng-focus="open('popup2')"/>
                        <span class="help-block"><?php echo form_error('')?></span>
                        <span class="help-block" ng-show="showMsgs && myform.disbursement_date.$error.required"><?php echo $this->lang->line('required');?></span>
                    </div>  
                </div>

                <div class="col-md-6">
                    <span style="display:<?php echo ($emp_loan_repayment_method_id) ? 'block' : 'none'; ?>" id="repaymentAmountContent">                       
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_Monthly_repayment_amount');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="repayment_amount" id="repayment_amount"  ng-init="repayment_amount = '<?php echo $repayment_amount; ?>'" value="<?php echo $repayment_amount;?>" class="form-control" maxlength="10"  onkeyup = "calculateInterest();" onkeypress="return isNumberKey(event)" readonly/>
                        </div>                           
                    </span>
                </div>
            </div>

            <div class="row"> 
                <div class="col-md-6">
                    <label><?php echo $this->lang->line('label_Repayment_period_in_months');?></label>
                    <input type="text" name="repayment_periods" id="repayment_periods"  ng-init="repayment_periods = '<?php echo $repayment_periods; ?>'" value="<?php echo $repayment_periods;?>" class="form-control" maxlength="10" onkeyup ="calculateInterest();" onkeypress="return isNumberKey(event)" readonly/>
                    <span class="help-block"><?php echo form_error('repayment_amount')?></span>
                </div>
                <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_emp_loan_repayment_method','' , 'rePaymethods' )">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_repayment_method');?></label>
                        <span class="mandatory">*</span>                       
                        <select name="emp_loan_repayment_method_id" ng-model="emp_loan_repayment_method_id" ng-init="emp_loan_repayment_method_id = '<?php echo $emp_loan_repayment_method_id; ?>'" id="emp_loan_repayment_method_id" class="form-control" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="emp_loan_repayment_method_id in rePaymethods" value="{{emp_loan_repayment_method_id.emp_loan_repayment_method_id}}">{{emp_loan_repayment_method_id.repayment_method}}</option>  
                         </select>   
                        <span class="help-block" ng-show="showMsgs && myform.emp_loan_repayment_method_id.$error.required"><?php echo $this->lang->line('required');?></span>
                    </div>  
                </div> 
            </div>
        </fieldset>

        <!-- heading Account Info-->
        <fieldset>
			<legend> <span> <?php echo  $this->lang->line('label_account_info') ;?></span> </legend>
			<div class="row">
                <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_acc_mode_of_payment_type', '', 'modOfPayTypes' )" >
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_mode_of_payment');?></label>
                        <span class="mandatory"> * </span>                             
                            <select name="mode_of_payment_type_id" ng-init="mode_of_payment_type_id = '<?php echo $mode_of_payment_type_id; ?>'" ng-model="mode_of_payment_type_id" id="mode_of_payment_type_id" class="form-control"  required select2>
                                  <option value="">-- Select --</option>
                                  <option ng-repeat="mode_of_payment_type_id in modOfPayTypes" value="{{mode_of_payment_type_id.mode_of_payment_type_id}}">{{mode_of_payment_type_id.type}}</option>  
                            </select>
                            <span class="help-block" ng-show="showMsgs && myform.mode_of_payment_type_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                    </div>
                </div> 

                <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/acc_account',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'emploanAccs' )">
                	<div class="form-group">
                		<label><?php echo $this->lang->line('label_employee_loan_account');?></label>
                        <span class="mandatory">*</span>
						<!--<?php 
                        $attrib = 'class="form-control select2" id="employee_loan_account" ng-model="employee_loan_account" required';
                        echo form_dropdown('employee_loan_account', $loanaccountDropdown, set_value('employee_loan_account', (isset($employee_loan_account)) ? $employee_loan_account : ''), $attrib);?>
                        <?PHP if(form_error('employee_loan_account')){ echo '<span class="help-block">'.form_error('employee_loan_account').'</span>';} ?>-->

                        <select name="employee_loan_account" ng-init="employee_loan_account = '<?php echo $employee_loan_account; ?>'" ng-model="employee_loan_account" id="employee_loan_account" class="form-control" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="employee_loan_account in emploanAccs" value="{{employee_loan_account.account_id}}">{{employee_loan_account.account_name}}</option> 
                        </select>

                        <span class="help-block" ng-show="showMsgs && myform.employee_loan_account.$error.required"><?php echo $this->lang->line('required');?></span>
                	</div>
                </div>
			</div>
            <!--second row-->
			<div class="row">
                <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/acc_account',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'payAccs' )">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_payment_account');?></label>
                        <span class="mandatory">*</span>
                        <!--<?php 
                        $attrib = 'class="form-control select2" id="payment_account" ng-model="payment_account" required';
                        echo form_dropdown('payment_account', $paymentaccountDropdown, set_value('payment_account', (isset($payment_account)) ? $payment_account : ''), $attrib);?>
                        <?PHP if(form_error('payment_account')){ echo '<span class="help-block">'.form_error('payment_account').'</span>';} ?>-->
                        <select name="payment_account" ng-init="payment_account = '<?php echo $payment_account; ?>'" ng-model="payment_account" id="payment_account" class="form-control" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="payment_account in payAccs" value="{{payment_account.account_id}}">{{payment_account.account_name}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.payment_account.$error.required"><?php echo $this->lang->line('required');?></span>
                    </div>
                </div>

				<div class="col-md-6"  ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/acc_account',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'intIncomeAccs' )">
                	<div class="form-group">
                		<label><?php echo $this->lang->line('label_interest_income_account');?></label>
                        <span class="mandatory">*</span>
						<!--<?php 
                        $attrib = 'class="form-control select2" id="interest_income_account" ng-model="interest_income_account" required';
                        echo form_dropdown('interest_income_account', $interestincomeDropdown, set_value('interest_income_account', (isset($interest_income_account)) ? $interest_income_account : ''), $attrib);?>
                        <?PHP if(form_error('interest_income_account')){ echo '<span class="help-block">'.form_error('interest_income_account').'</span>';} ?>-->
                        <select name="interest_income_account" ng-init="interest_income_account = '<?php echo $interest_income_account; ?>'" ng-model="interest_income_account" id="interest_income_account" class="form-control" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="interest_income_account in intIncomeAccs" value="{{interest_income_account.account_id}}">{{interest_income_account.account_name}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.interest_income_account.$error.required"><?php echo $this->lang->line('required');?></span>
                	</div>
                </div>
			</div>
        </fieldset>

        <!-- heading payment schedule-->
        <fieldset>
            <legend> <span> <?php echo  $this->lang->line('label_repayment_schedule') ;?></span> </legend>         				
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <!--<th><input type="checkbox" ></th>-->
                        <th></th>
                        <th><?php echo lang('label_payment_date');?></th>
                        <th><?php echo lang('label_principal_amount');?></th>
                        <th><?php echo lang('label_interest_amount');?></th>
                        <th><?php echo lang('label_total_amount');?></th>
                        <th><?php echo lang('label_balance_loan_amount');?></th>
                    </tr>
                </thead>
                <tbody  id="repayment_details">
                    <?php 
                        $is=1;
                        for($in=0; $in < $trowRepay; $in++)
                        {
                            ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="emp_loan_repay_cbx" id="emp_loan_repay_cbx<?php echo $in;?>" data-name="emp_loan_repay_cbx" data-row="<?php echo $in;?>"  ng-init="emp_loan_repay_cbx = '<?php echo $emp_loan_repay_cbx[$in]; ?>'" value="<?php echo $employee_loan_repayment_schedule_id[$in];?>" onclick="checkDeleteButton('emp_loan_repay_cbx', 'add_delete');" <?php echo $checkDisable;?>/>
                                    <input  type="hidden" name="employee_loan_repayment_schedule_id[]" id="employee_loan_repayment_schedule_id" data-name="employee_loan_repayment_schedule_id" class="form-control" value="<?php echo $employee_loan_repayment_schedule_id[$in];?>" data-row="<?php echo $in;?>"/> 
                                </td>
                                <td>
                                    <!--<input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="payment_date" is-open="popup3.opened"  ng-required="true"  data-ng-init="init('<?php echo $payment_date[$in]?>', 'payment_date')" name="payment_date[]"  ng-focus="open('popup3')"/>-->
                                    <input type='text' name="payment_date" ng-model="payment_date" ng-init="payment_date = '<?php echo $payment_date; ?>'" id="payment_date" class="single-daterange form-control" value="<?php echo $payment_date;?>"/>
                                    <span class="help-block"><?php echo form_error('payment_date[$in]')?></span>
                                </td>
                                <td>
                                    <input type='text' name="principal_amount[]"  ng-init="principal_amount = '<?php echo $principal_amount; ?>'" value="<?php echo $principal_amount[$in];?>" class="form-control" data-name="principal_amount" id="principal_amount<?php echo $in;?>" data-row="<?php echo $in;?>" /> 
                                    <span class="help-block"><?php echo form_error('principal_amount[$in]')?></span>

                                </td>
                                <td>
                                    <input type='text' name="interest_amount[]"  ng-init="interest_amount = '<?php echo $interest_amount[$in]; ?>'" value="<?php echo $interest_amount[$in];?>" class="form-control" data-row="<?php echo $in;?>" data-name="interest_amount" id="interest_amount<?php echo $in;?>"/>
                                    <span class="help-block"><?php echo form_error('interest_amount[$in]')?></span>
         
                                </td>
                                <td>
                                    <input type='text' name="total_amount[]"  ng-init="total_amount = '<?php echo $total_amount[$in]; ?>'" value="<?php echo $total_amount[$in];?>" class="form-control" data-row="<?php echo $in;?>" data-name="total_amount" id="total_amount<?php echo $in;?>"/> 
                                    <span class="help-block"><?php echo form_error('total_amount[$in]')?></span>

                                </td>  
                                <td>
                                    <input type='text' name="balance_loan_amount[]"  ng-init="balance_loan_amount = '<?php echo $balance_loan_amount[$in]; ?>'" value="<?php echo $balance_loan_amount[$in];?>" class="form-control" data-row="<?php echo $in;?>" data-name="balance_loan_amount" id="balance_loan_amount<?php echo $in;?>"/>
                                    <span class="help-block"><?php echo form_error('balance_loan_amount[$in]')?></span>
                                </td> 
                            </tr>
                            <?php                      
                            $is++;
                        }
                    ?>
                </tbody> 
                <tfoot>
                    <tr>
                        <td colspan="6">                                            
                            <button class="btn btn-primary btn-sm" id ="e" data-name="e" type="button" onclick="addNewRow('repayment_details');" > <?php echo $this->lang->line('label_add_row') ;?></button>
                            <input type="button" class="btn btn-danger btn-sm add_delete" name="" value="Delete" onclick="addRowDelete('repayment_details', 'emp_loan_repay_cbx', 'hr_employee_loan_repayment_schedule', 'employee_loan_repayment_schedule_id');" disabled>
                        </td>
                    </tr>                     
                </tfoot>                                 
            </table>
        </fieldset>

         <!-- heading Display Amount-->
        <fieldset>
			<legend><span> <?php echo $this->lang->line('label_total') ;?></span></legend>
            <div class="row">
				<div class="col-md-6">
                	<div class="form-group">
					<label><?php echo $this->lang->line('label_total_payable_amount');?></label>
                    <input type="text" name="total_payable_amount" id="total_payable_amount"  ng-init="total_payable_amount = '<?php echo $total_payable_amount; ?>'" value="<?php echo $total_payable_amount;?>" class="form-control" onkeyup="calculateInterest();" readonly/>
                    <span class="help-block"><?php echo form_error('total_payable_amount')?></span>
                    </div>  
                </div>
                <div class="col-md-6">
                	<div class="form-group">
					<label><?php echo $this->lang->line('label_total_payable_interest');?></label>
                    <input type="text" name="total_payable_interest" id="total_payable_interest"  ng-init="total_payable_interest = '<?php echo $total_payable_interest; ?>'" value="<?php echo $total_payable_interest;?>" class="form-control" onkeyup="calculateInterest();" readonly/>
                    <span class="help-block"><?php echo form_error('total_payable_interest')?></span>
                    </div>  
                </div>
			</div>
        </fieldset>

        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('.single-daterange').daterangepicker({singleDatePicker: true,locale: {format: 'DD-MM-YYYY'}});
    });
</script>