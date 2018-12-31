<?php
$ci =&get_instance();
$namingSeriesdrop           =  $ci->mdrop->namingSeriesdrop('98');
$employeeDropdown           =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_number as Value'), array('is_delete' => 0));
$companyDropdown            =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'), array('is_delete' => 0));
$statusDropdown             =  $ci->mcommon->Dropdown('def_hr_emp_loan_appliction_status', array('emp_loan_appliction_status_id as Key', 'status as Value'));
$loanTypeDropdown           =  $ci->mcommon->Dropdown('hr_loan_type', array('loan_type_id as Key', 'loan_name as Value'), array('is_delete' => 0, 'disabled' => 0));
$repaymentDropdown          =  $ci->mcommon->Dropdown('def_hr_emp_loan_repayment_method', array('emp_loan_repayment_method_id as Key', 'repayment_method as Value'));

$employee_loan_application_id   =   "";
$posting_date                   =   "";
$employee_id                    =   "";
$employee_name                  =   "";
$emp_loan_appliction_status_id  =   "";
$company_id                     =   "";
$loan_type_id                   =   "";
$loan_amount                    =   ""; 
$required_by_date               =   "";
$reason                         =   "";
$emp_loan_repayment_method_id   =   "";
$rate_of_interest               =   "";
$total_payable_interest         =   "";
$repayment_amount               =   "";
$repayment_periods              =   "";
$total_payable_amount           =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $employee_loan_application_id   =   $row->employee_loan_application_id;
        $posting_date                   =   $row->posting_date;
        $naming_series                  =   $row->naming_series;
        $employee_id                    =   $row->employee_id;
        $employee_name                  =   $row->employee_name;
        $emp_loan_appliction_status_id  =   ($row->emp_loan_appliction_status_id == 1) ? '' :  $row->emp_loan_appliction_status_id;
        $company_id                     =   $row->company_id;
        $loan_type_id                   =   $row->loan_type_id;
        $loan_amount                    =   $row->loan_amount;
        $required_by_date               =   $row->required_by_date;
        $reason                         =   $row->reason;
        $emp_loan_repayment_method_id   =   $row->emp_loan_repayment_method_id;
        $rate_of_interest               =   $row->rate_of_interest;
        $total_payable_interest         =   $row->total_payable_interest;
        $repayment_amount               =   $row->repayment_amount;
        $repayment_periods              =   $row->repayment_periods;
        $total_payable_amount           =   $row->total_payable_amount;
    }

    $naming_seriesArr =   explode('/', $naming_series);
    foreach ($naming_seriesArr as $key => $value) 
    {
        $set_options    =   $naming_seriesArr[0];
    }
    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '98'), 'naming_series_id');

    $naming_option      =   $source_id."_".$set_options; 
}
else
{
    $employee_loan_application_id   =   $this->input->post('employee_loan_application_id');
    $posting_date                   =   $this->input->post('posting_date');
    $employee_id                    =   $this->input->post('employee_id');
    $employee_name                  =   $this->input->post('employee_name');
    $emp_loan_appliction_status_id  =   $this->input->post('emp_loan_appliction_status_id');
    $company_id                     =   $this->input->post('company_id');
    $loan_type_id                   =   $this->input->post('loan_type_id');
    $loan_amount                    =   $this->input->post('loan_amount');
    $required_by_date               =   $this->input->post('required_by_date');
    $reason                         =   $this->input->post('reason');
    $emp_loan_repayment_method_id   =   $this->input->post('emp_loan_repayment_method_id');
    $rate_of_interest               =   $this->input->post('rate_of_interest'); 
    $total_payable_interest         =   $this->input->post('total_payable_interest'); 
    $repayment_amount               =   $this->input->post('repayment_amount'); 
    $repayment_periods              =   $this->input->post('repayment_periods'); 
    $total_payable_amount           =   $this->input->post('total_payable_amount');
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Loan_application_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="employee_loan_application_id" id="employee_loan_application_id" value="<?php echo $employee_loan_application_id;?>">
        <div class="row">
            <div class="col-md-4" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/98')">
                <div class="form-group">
                    <label for="naming_series_id"><?php echo $this->lang->line('label_series_name');?> </label> <span class="mandatory">*</span>
                    <a class="add-new-popup" <i class="popup"></i>+</a>
                    <!--ng-click="$ctrl.openSecond('lg', '', '<?php echo base_url($namingUrl);?>' )">-->
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="naming_series" ng-model="naming_series" required ';
                        echo form_dropdown('naming_series', $namingSeriesdrop, set_value('naming_series', (isset($naming_option)) ? $naming_option : ''), $attrib);
                        if(form_error('naming_series')){ echo '<span class="help-block">'.form_error('naming_series').'</span>';}
                    ?>-->
                    <select name="naming_series" ng-init="naming_series = '<?php echo $naming_option; ?>'" ng-model="naming_series" id="naming_series" class="form-control" required select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="naming_series_id in dropSeriesValues" value="{{naming_series_id.naming_series_id}}">{{naming_series_id.naming_series}}</option>  
                     </select>
                    <span class="help-block" ng-show="showMsgs && myform.naming_series.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>

        	<div class="col-md-4">
            	<div class="form-group">
                    <label><?php echo $this->lang->line('label_posting_date');?></label><span class="mandatory">*</span>    
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="posting_date" is-open="popup1.opened"  ng-required="false" name="posting_date" ng-focus="open('popup1')" data-ng-init="init('<?php echo $posting_date?>', 'posting_date')"/>
                    <span class="help-block" ng-show="showMsgs && myform.posting_date.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error('posting_date');?></span>
                </div>  
            </div>
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employee',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employees' )"  >
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_code');?> </label>
                    <span class="mandatory">*</span><br/>
                     <!--<?php 
                        $attrib = 'class="form-control select2" id="employee_id" onchange="loademployeename();" ng-model="employee_id" required';
                        echo form_dropdown('employee_id', $employeeDropdown, set_value('employee_id', (isset($employee_id)) ? $employee_id : ''), $attrib);?>-->

                    <select name="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" ng-model="employee_id" id="employee_id" class="form-control" onchange="loademployeename();" required select2 ng-change="checkExistLoan('../../Common_controller/checkExistLoan/')">
                          <option value="">-- Select --</option>  
                          <option ng-repeat="employee_id in employees" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>
                    <?PHP if(form_error('employee_id')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';} ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_name');?></label>
                    <input type="text" name="employee_name" id="employee_name" ng-init="employee_name = '<?php echo $employee_name; ?>'"  ng-model="employee_name" value="<?php echo $employee_name;?>" class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('employee_name');?></span>
                </div>  
            </div>
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'companies' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_company_id');?></label>
                    <span class="mandatory">*</span><br/>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="company_id" ng-model="company_id" required';
                        echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);?>
                    <?PHP if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} ?>-->
                    <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control"  required select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
                     </select>
                    <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-4" id ="emp_application_status" style="display:<?php echo ($employee_loan_application_id) ? 'block' : 'none'; ?>">
                <div class="form-group" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_emp_loan_appliction_status', '<?php echo htmlspecialchars(json_encode(array('emp_loan_appliction_status_id >' => 1))); ?>' , 'appStatus' )" >
                    <label for=""><?php echo $this->lang->line('label_status');?></label>
                    <span class="mandatory">*</span><br/>
                    <select name="emp_loan_appliction_status_id"  ng-model="emp_loan_appliction_status_id" id="emp_loan_appliction_status_id" class="form-control" onChange="showSelectContentremarks(this.value)" <?php echo ($employee_loan_application_id != '') ? 'required' : ''; ?> select2 ng-init="emp_loan_appliction_status_id = '<?php echo $emp_loan_appliction_status_id;?>'">
                        <option value="">-- Select --</option>  
                        <option ng-repeat="emp_loan_appliction_status_id in appStatus" value="{{emp_loan_appliction_status_id.emp_loan_appliction_status_id}}">{{emp_loan_appliction_status_id.status}}</option>  
                    </select>
                    <?php if($employee_loan_application_id != '')
                    {
                        ?>
                        <span class="help-block" ng-show="showMsgs && myform.emp_loan_appliction_status_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        <?php
                    }
                    ?>  

                </div>
            </div>
            <div class="col-md-4" id ="rejection_remarks" style="display: none;">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_rejection_remarks');?></label>
                    <textarea name="rejection_remarks" class="form-control" ng-init="rejection_remarks = '<?php echo $rejection_remarks; ?>'"><?php echo $rejection_remarks;?></textarea>
                    <span class="help-block"><?php echo form_error('rejection_remarks');?></span>
                </div>   
            </div>
    	</div>
        <!-- Heading Loan Info Details-->
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_loan_info');?></span></legend>
    		<div class="row">
                <div class="col-md-4" >
                    <div class="form-group" required ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_loan_type',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0, 'disabled' => 0))); ?>, 'loans' )">
                        <label><?php echo $this->lang->line('label_loan_type');?></label>
                        <span class="mandatory">*</span>
                        <!--<a class="add-new-popup" onclick="addDropdownPopup('<?php echo $LoanTypeUrl;?>');"><i class="popup"></i>+</a>-->
                        <a class="add-new-popup"><i class="popup"></i>+</a>
                        <!-- ng-click="$ctrl.openSecond('lg', '', '<?php echo base_url($LoanTypeUrl);?>' )"-->
                        <!--<?php 
                            $attrib = 'class="form-control select2" id="loan_type_id" onchange="loadLoanDetails();" ng-model="loan_type_id" required';
                            echo form_dropdown('loan_type_id', $loanTypeDropdown, set_value('loan_type_id', (isset($loan_type_id)) ? $loan_type_id : ''), $attrib);?>
                            <?PHP if(form_error('loan_type_id')){ echo '<span class="help-block">'.form_error('loan_type_id').'</span>';} 
                        ?>-->
                        <select name="loan_type_id"  ng-model="loan_type_id" ng-init="loan_type_id = '<?php echo $loan_type_id; ?>'" id="loan_type_id" class="form-control" onchange="loadLoanDetails();" select2 ng-change="checkExistLoan('../../Common_controller/checkExistLoan/')">
                            <option value="">-- Select --</option>  
                            <option ng-repeat="loan_type_id in loans"  value="{{loan_type_id.loan_type_id}}">{{loan_type_id.loan_name}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.loan_type_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        <span class="help-block" ng-show="showLoanExistMsgs">Already given loan type for this employee</span>
                    </div>
                </div>
                <div class="col-md-4">
               		<div class="form-group">
    					<label><?php echo $this->lang->line('label_loan_amount');?></label>
    					<span class="mandatory">*</span>
    					<input type="text" name="loan_amount" id="maximum_loan_amount" ng-init="loan_amount = '<?php echo $loan_amount; ?>'" ng-model="loan_amount" value="<?php echo $loan_amount;?>" class="form-control" onkeyup = "calculateInterest();" ng-keyup="maxLoanAmount('Loan_application/maximunLoanAmont')" required onkeydown="return allowNonZeroIntegers(event)" maxlength="10"/>
                        <span class="help-block" ng-show="showMsgs && myform.loan_amount.$error.required"><?php echo $this->lang->line('required');?></span>
                        <span class="help-block" ng-show="showLoanMsg">{{loan_amount}} Loan Amount cannot exceed maximum loan amount</span>
    					<span class="help-block"><?php echo form_error('loan_amount');?></span>
    				</div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_required_by_date');?></label><span class="mandatory">*</span>    
                        <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="required_by_date" is-open="popup2.opened"  ng-required="true"  data-ng-init="init('<?php echo $required_by_date?>', 'required_by_date')" name="required_by_date"  ng-focus="open('popup2')"/>
                        <span class="help-block" ng-show="showMsgs && myform.required_by_date.$error.required"><?php echo $this->lang->line('required');?></span>
                        <span class="help-block"><?php echo form_error('required_by_date');?></span>
                    </div>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_reason');?></label>
                        <span class="mandatory">*</span>
                        <textarea class="form-control" rows="3" name="reason" id="reason" ng-model="reason" ng-init="reason = '<?php echo $reason; ?>'" required><?php echo $reason;?></textarea>
                        <span class="help-block" ng-show="showMsgs && myform.reason.$error.required"><?php echo $this->lang->line('required');?></span>
                        <span class="help-block" ng-show="myform.reason.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                        <span class="help-block"><?php echo form_error('reason');?></span>
                    </div>
                </div> 
            </div>
        </fieldset>

        <fieldset>
            <legend><span><?php echo $this->lang->line('label_repayment_info');?></span></legend>
            <div class="row">
                <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_emp_loan_repayment_method','' , 'repayMethods' )" >
                    <div class="form-group">
                        <label><?php echo lang('label_repayment_method');?></label>
                        <span class="mandatory">*</span>  
                        <!--<?php
                            $attrib = 'class="form-control select2" id="emp_loan_repayment_method_id" onchange="showSelectContentrepayment(this.value,\'repaymentAmountContent\')" ng-model="emp_loan_repayment_method_id" required'; 
                            echo form_dropdown('emp_loan_repayment_method_id', $repaymentDropdown, set_value('emp_loan_repayment_method_id', (isset($emp_loan_repayment_method_id)) ? $emp_loan_repayment_method_id : ''), $attrib);
                            if(form_error('emp_loan_repayment_method_id')){ echo '<span class="help-block">'.form_error('emp_loan_repayment_method_id').'</span>';}
                        ?>-->
                        <select name="emp_loan_repayment_method_id" ng-init="emp_loan_repayment_method_id = '<?php echo $emp_loan_repayment_method_id; ?>'" ng-model="emp_loan_repayment_method_id" id="emp_loan_repayment_method_id" class="form-control" onchange="showSelectContentrepayment(this.value)" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="emp_loan_repayment_method_id in repayMethods" value="{{emp_loan_repayment_method_id.emp_loan_repayment_method_id}}">{{emp_loan_repayment_method_id.repayment_method}}</option>  
                         </select> 
                        <?PHP 
                        ?>   
                        <span class="help-block" ng-show="showMsgs && myform.emp_loan_repayment_method_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        <span class="help-block" ng-show="myform.emp_loan_repayment_method_id.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span> 
                    </div>
                </div> 

                <div class="col-md-6">
                    <span style="display:<?php echo ($emp_loan_repayment_method_id) ? 'block' : 'none'; ?>" id="repaymentAmountContent">                       
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_Monthly_repayment_amount');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="repayment_amount" id="repayment_amount" value="<?php echo $repayment_amount;?>" class="form-control" onkeyup = "calculateInterest();" onkeypress="return isNumberKey(event)" maxlength="10"/>
                            <span class="help-block"><?php echo form_error('repayment_amount')?></span>
                            <label><?php echo $this->lang->line('label_Repayment_period_in_months');?></label>
                            <input type="text" name="repayment_periods" id="repayment_periods" value="<?php echo $repayment_periods;?>" class="form-control" onkeyup ="calculateInterest();" onkeypress="return isNumberKey(event)"/>
                            <span class="help-block"><?php echo form_error('repayment_periods')?></span>
                        </div>                           
                    </span>                    
                    <!--<span style="display:<?php echo ($emp_loan_repayment_method_id == 2) ? 'block' : 'none'; ?>" id="repaymentPeriodContent"> 
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_Repayment_period_in_months');?></label>
                                <span class="mandatory">*</span>
                                <input type="text" name="repayment_periods" id="repayment_periods_2" value="<?php echo $repayment_periods;?>" class="form-control" onkeyup="calculateInterest();" />
                                <label><?php echo $this->lang->line('label_Monthly_repayment_amount');?></label>
                                <input type="text" name="repayment_amount" id="repayment_amount_2" value="<?php echo $repayment_amount;?>" class="form-control" onkeyup = "calculateInterest();" readonly/>
                                <span class="help-block"><?php echo form_error('repayment_periods')?></span>
                            </div>  
                    </span>-->
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_rate_of_interest');?></label>
                        <input type="text" name="rate_of_interest" id="rate_of_interest" value="<?php echo $rate_of_interest;?>"" class="form-control" onkeyup="calculateInterest();" readonly />
                        <span class="help-block"><?php echo form_error('rate_of_interest')?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_total_payable_interest');?></label>
                        <input type="text" name="total_payable_interest" id="total_payable_interest" value="<?php echo $total_payable_interest;?>" class="form-control" onkeyup="calculateInterest();" readonly/>
                        <span class="help-block"><?php echo form_error('total_payable_interest')?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_total_payable_amount');?></label>
                        <input type="text" name="total_payable_amount" id="total_payable_amount" value="<?php echo $total_payable_amount;?>" class="form-control" onkeyup="calculateInterest();" readonly/>
                        <span class="help-block"><?php echo form_error('total_payable_amount')?></span>
                    </div>
                </div>
            </div>
        </fieldset>
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('hr/Employee_loan/Loan_application') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform', 'showLoanMsg', 'showLoanExistMsgs')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>