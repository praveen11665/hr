<?php
    $ci =&get_instance();
    $namingSeriesdrop       =  $ci->mdrop->namingSeriesdrop('26');
    $employeeDropdown  		=  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_name as Value'), array('is_delete' => 0));
    $advanceStatusDropdown  =  $ci->mcommon->Dropdown('def_hr_emp_advance_status', array('employee_advance_status_id as Key', 'employee_advance_status as Value'));
    $accountsDropdown  		=  $ci->mcommon->Dropdown('acc_account', array('account_id as Key', 'account_name as Value'), array('is_delete' => 0));
    $companyDropdown  		=  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'), array('is_delete' => 0));
    $paymentDropdown  		=  $ci->mcommon->Dropdown('acc_mode_of_payment', array('mode_of_payment_id as Key', 'mode_of_payment as Value'), array('is_delete' => 0));

	if(!empty($tableData))
	{
	    foreach ($tableData as $row) 
	    {
	        $emp_advance_id   	    		= 	$row->emp_advance_id;        
	        $naming_series        			= 	$row->naming_series;
	        $employee_id    				= 	$row->employee_id;
	        $date    						= 	$row->date;
	        $purpose    					= 	$row->purpose;
	        $advance_amount    				= 	$row->advance_amount;
	        $paid_amount    				= 	$row->paid_amount;
	        $claimed_amount    				= 	$row->claimed_amount;
	        $employee_advance_status_id    	= 	$row->employee_advance_status_id;
	        $account_id    					= 	$row->account_id;
	        $company_id    					= 	$row->company_id;
	        $mode_of_payment_id    			= 	$row->mode_of_payment_id;
	    }

	    $naming_seriesArr =   explode('/', $naming_series);
	    foreach ($naming_seriesArr as $key => $value) 
	    {
	        $set_options    =   $naming_seriesArr[0];
	    }
	    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '26'), 'naming_series_id');
	    $naming_option      =   $source_id."_".$set_options; 

	    //Take Employee Name
	    $employee_name      =   $this->mcommon->specific_row_value('hr_employee', array('employee_id' => $employee_id), 'employee_name');
	}
	else
	{
	    $emp_advance_id   	    		= 	$this->input->post('emp_advance_id');
	    $employee_id    				= 	$this->input->post('employee_id');   
	    $date    						= 	$this->input->post('date');   
	    $purpose    					= 	$this->input->post('purpose');   
	    $advance_amount    				= 	$this->input->post('advance_amount');   
	    $paid_amount    				= 	$this->input->post('paid_amount');   
	    $claimed_amount    				= 	$this->input->post('claimed_amount');   
	    $employee_advance_status_id    	= 	$this->input->post('employee_advance_status_id');   
	    $account_id    					= 	$this->input->post('account_id');   
	    $company_id    					= 	$this->input->post('company_id');   
	    $mode_of_payment_id    			= 	$this->input->post('mode_of_payment_id');   
	}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('employee_advance_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
	<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
		<input type="hidden" name="emp_advance_id" id="emp_advance_id" value="<?php echo $emp_advance_id;?>">
		<div class="row">
			<div class="col-md-6" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/26')">
	            <div class="form-group">
	                <label for="naming_series_id"><?php echo $this->lang->line('label_series_name');?> </label> <span class="mandatory">*</span>
	                <a class="add-new-popup" ng-click="$ctrl.openSecond('lg', '', '<?php echo base_url($namingUrl);?>' )"><i class="popup"></i>+</a>
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
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo lang('label_posting_date');?></label>
				    <span class="mandatory">*</span>
	                <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $date?>', 'date')" value="{{date | date:'dd-MM-yyyy' }}" name="date"  ng-focus="open('popup1')"/>
	                <span class="help-block" ng-show="showMsgs && myform.date.$error.required"><?php echo $this->lang->line('required');?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employee',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employees' )">
				<div class="form-group">
	                <label for="employee_id"><?php echo $this->lang->line('label_employee');?> </label>
				    <span class="mandatory">*</span>
	                <!--<?php 
	                    $attrib = 'class="form-control select2" id="employee_id"  ng-model="employee_id" required';
	                    echo form_dropdown('employee_id', $employeeDropdown, set_value('employee_id', (isset($employee_id)) ? $employee_id : ''), $attrib);?>
	                <?PHP if(form_error('employee_id')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';} ?>-->
	                <select name="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" ng-model="employee_id" id="employee_id" class="form-control" onchange="loademployeename();" required select2>
	                      <option value="">-- Select --</option>  
	                      <option ng-repeat="employee_id in employees" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option>  
	                </select>                <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>                                
	            </div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo lang('label_employee_name');?></label>
					<input type="text" name="employee_name" id="employee_name" value="<?php echo $employee_name;?>" readonly="" class="form-control">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo lang('label_purpose');?></label>
					<textarea name="purpose" id="purpose" ng-init="purpose = '<?php echo $purpose; ?>'"  class="form-control"><?php echo $purpose;?></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo lang('label_advance_amount');?></label>
					<input type="text" name="advance_amount" maxlength="6" ng-init="advance_amount = '<?php echo $advance_amount; ?>'"  id="advance_amount" value="<?php echo $advance_amount;?>" class="form-control"  onkeydown="return allowNonZeroIntegers(event)">				
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo lang('label_paid_amount');?></label>
					<input type="text" name="paid_amount" id="paid_amount" maxlength="6" ng-init="paid_amount = '<?php echo $paid_amount; ?>'"  value="<?php echo $paid_amount;?>" class="form-control" onkeydown="return allowNonZeroIntegers(event)">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo lang('label_claimed_amount');?></label>
					<input type="text" name="claimed_amount" id="claimed_amount" maxlength="6" ng-init="claimed_amount = '<?php echo $claimed_amount; ?>'"  value="<?php echo $claimed_amount;?>" class="form-control" onkeydown="return allowNonZeroIntegers(event)">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_emp_advance_status','' , 'advStatuses' )">
				<div class="form-group">
	                <label><?php echo lang('label_status');?></label> <span class="mandatory">*</span>
	                <!--<?php 
	                    $attrib = 'class="form-control select2" id="employee_advance_status_id"';
	                    echo form_dropdown('employee_advance_status_id', $advanceStatusDropdown, set_value('employee_advance_status_id', (isset($employee_advance_status_id)) ? $employee_advance_status_id : ''), $attrib);
	                    if(form_error('employee_advance_status_id')){ echo '<span class="help-block">'.form_error('employee_advance_status_id').'</span>';} 
	                ?>--> 						
	                <select name="employee_advance_status_id" ng-init="employee_advance_status_id = '<?php echo $employee_advance_status_id; ?>'" ng-model="employee_advance_status_id" id="employee_advance_status_id" class="form-control"  required select2>
	                      <option value="">-- Select --</option>  
	                      <option ng-repeat="employee_advance_status_id in advStatuses" value="{{employee_advance_status_id.employee_advance_status_id}}">{{employee_advance_status_id.employee_advance_status}}</option>  
	                </select>  
					<span class="help-block" ng-show="showMsgs && myform.employee_advance_status_id.$error.required"><?php echo $this->lang->line('required');?></span>
	            </div>
			</div>
			<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/acc_account',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'accounts' )">
				<div class="form-group">
	                <label><?php echo $this->lang->line('label_advance_account');?></label><span class="mandatory">*</span>
	                <!--<?php 
	                    $attrib = 'class="form-control select2" id="account_id"';
	                    echo form_dropdown('account_id', $accountsDropdown, set_value('account_id', (isset($account_id)) ? $account_id : ''), $attrib);
	                    if(form_error('account_id')){ echo '<span class="help-block">'.form_error('account_id').'</span>';}
	                ?>-->				
	                <select name="account_id" ng-init="account_id = '<?php echo $account_id; ?>'" ng-model="account_id" id="account_id" class="form-control" required select2>
	                      <option value="">-- Select --</option>  
	                      <option ng-repeat="account_id in accounts" value="{{account_id.account_id}}">{{account_id.account_name}}</option>  
	                </select> 
					<span class="help-block" ng-show="showMsgs && myform.account_id.$error.required"><?php echo $this->lang->line('required');?></span>
	            </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'companies' )">
				<div class="form-group">
	                <label><?php echo lang('label_employee_company');?></label>
	                <!--<?php 
	                    $attrib = 'class="form-control select2" id="company_id"';
	                    echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);
	                    if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} 
	                ?>-->				
	                <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control" required select2>
	                      <option value="">-- Select --</option>  
	                      <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
	                </select>  			
	            </div>
			</div>
			<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/acc_mode_of_payment',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'modPayments' )">
				<div class="form-group">
	                <label><?php echo lang('label_mode_of_payment');?></label><span class="mandatory">*</span>
	                <!--<?php 
	                    $attrib = 'class="form-control select2" id="mode_of_payment_id"';
	                    echo form_dropdown('mode_of_payment_id', $paymentDropdown, set_value('mode_of_payment_id', (isset($mode_of_payment_id)) ? $mode_of_payment_id : ''), $attrib);
	                    if(form_error('mode_of_payment_id')){ echo '<span class="help-block">'.form_error('mode_of_payment_id').'</span>';} 
	                ?>--> 							
	                <select name="mode_of_payment_id" ng-init="mode_of_payment_id = '<?php echo $mode_of_payment_id; ?>'" ng-model="mode_of_payment_id" id="mode_of_payment_id" class="form-control" required select2>
	                      <option value="">-- Select --</option>  
	                      <option ng-repeat="mode_of_payment_id in modPayments" value="{{mode_of_payment_id.mode_of_payment_id}}">{{mode_of_payment_id.mode_of_payment}}</option>  
	                </select> 
					<span class="help-block" ng-show="showMsgs && myform.mode_of_payment_id.$error.required"><?php echo $this->lang->line('required');?></span>
	   			</div>
			</div>
		</div>

		<!--Submit and Cancel-->
		<div class="modal-footer">
	        <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
	        <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
	    </div>
	</form>
</div>
<script type="text/javascript">
	/*$(document).ready(function ()
  	{
  		loademployeename();
  	});*/
</script>