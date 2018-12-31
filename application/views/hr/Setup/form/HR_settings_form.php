<?php
$ci 		   = &get_instance();
$nameDropdown  = $ci->mcommon->Dropdown('def_hr_hr_settings_employee_name', array('hr_settings_employee_name_id as Key', 'employee_name as Value'));

 //Variable Initialization
 $hr_setting_id    								= "";
 $retirement_age       							= "";
 $hr_settings_employee_name_id      			= ""; 
 $stop_birthday_reminders       				= ""; 
 $maintain_bill_work_hours_same       			= ""; 
 $include_holidays_in_total_working_days      	= ""; 
 $email_salary_slip_to_employee      			= ""; 
 $max_working_hours_against_timesheet			= "";
 
if(!empty($tableData))
{
    foreach ($tableData as $row) 
    {
        $hr_setting_id     							= $row->hr_setting_id;
        $retirement_age     						= $row->retirement_age;
        $hr_settings_employee_name_id      			= $row->hr_settings_employee_name_id; 
        $stop_birthday_reminders      				= $row->stop_birthday_reminders; 
        $maintain_bill_work_hours_same      		= $row->maintain_bill_work_hours_same; 
        $include_holidays_in_total_working_days     = $row->include_holidays_in_total_working_days;
        $email_salary_slip_to_employee      		= $row->email_salary_slip_to_employee; 
        $max_working_hours_against_timesheet      	= $row->max_working_hours_against_timesheet; 
    }
}
else
{
    $hr_setting_id      						= $this->input->post('hr_setting_id');
    $retirement_age      						= $this->input->post('retirement_age');
    $hr_settings_employee_name_id      			= $this->input->post('hr_settings_employee_name_id');
    $stop_birthday_reminders      				= $this->input->post('stop_birthday_reminders');
    $maintain_bill_work_hours_same      		= $this->input->post('maintain_bill_work_hours_same');
    $include_holidays_in_total_working_days     = $this->input->post('include_holidays_in_total_working_days');
    $email_salary_slip_to_employee      		= $this->input->post('email_salary_slip_to_employee'); 
    $max_working_hours_against_timesheet      	= $this->input->post('max_working_hours_against_timesheet'); 
}							
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Hr_settings_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
		<input type="hidden" name="hr_setting_id" id="hr_setting_id" value="<?php echo $hr_setting_id;?>">
 <!--Employee Settings: -->
	<fieldset>
		<legend><span><?php echo $this->lang->line('label_hr_settings_heading');?></span></legend>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo lang('label_retirement_age');?></label>
					<span class="mandatory">*</span>
					<input type="text" name="retirement_age" id="retirement_age" ng-init="retirement_age = '<?php echo $retirement_age; ?>'" value="<?php echo $retirement_age;?>" class="form-control" ng-model="retirement_age" maxlength="2" maxlength="10" required onkeydown="return allowNonZeroIntegers(event)"/>
					<span class="help-block" ng-show="showMsgs && myform.retirement_age.$error.required"><?php echo $this->lang->line('required');?></span>
					<span class="help-block"><?php echo form_error("retirement_age")?></span>
					Enter retirement age in years
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>
					<input type="checkbox" name="stop_birthday_reminders" id="stop_birthday_reminders" value="1" <?php if($stop_birthday_reminders == 1){ echo 'checked = "checked"';} ?> /> 
					<?php echo lang('label_stop_birthday');?></label><br>
					Don't send Employee Birthday Reminders 
				</div>
			</div>
		</div>
		<div class="row">							
			<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_hr_settings_employee_name','' , 'employeeNames' )" >
				<div class="form-group">
					<label><?php echo lang('label_employee_records');?></label>
					<span class="mandatory">*</span>							
					<!--<?php 
                        $attrib = 'class="form-control" id="hr_settings_employee_name_id" ng-model="hr_settings_employee_name_id" required ';                        
                        echo form_dropdown('hr_settings_employee_name_id', $nameDropdown, set_value('hr_settings_employee_name_id', (isset($hr_settings_employee_name_id)) ? $hr_settings_employee_name_id : ''), $attrib);
                        if(form_error('hr_settings_employee_name_id')){ echo '<span class="help-block">'.form_error('hr_settings_employee_name_id').'</span>';} 
        			?>-->

        			<select name="hr_settings_employee_name_id" ng-init="hr_settings_employee_name_id = '<?php echo $hr_settings_employee_name_id; ?>'" ng-model="hr_settings_employee_name_id" id="hr_settings_employee_name_id" class="form-control" required select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="hr_settings_employee_name_id in employeeNames" value="{{hr_settings_employee_name_id.hr_settings_employee_name_id}}">{{hr_settings_employee_name_id.employee_name}}</option>  
                    </select>   

                     <span class="help-block" ng-show="showMsgs && myform.hr_settings_employee_name_id.$error.required"><?php echo $this->lang->line('required');?></span>
					Employee record is created using selected field.
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>
					<input type="checkbox" name="maintain_bill_work_hours_same" id="maintain_bill_work_hours_same" value="1" <?php if($maintain_bill_work_hours_same == 1){ echo 'checked = "checked"';} ?> /> 
					<?php echo lang('label_maintain_billing');?></label>
				</div>
			</div>
		</div>
	</fieldset>				
 <!--Payroll Settings: -->
	<fieldset>
        <legend><span><?php echo $this->lang->line('label_payroll_settings');?></span></legend>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>
					<input type="checkbox" name="include_holidays_in_total_working_days" id="include_holidays_in_total_working_days" <?php if($include_holidays_in_total_working_days == 1){ echo 'checked = "checked"';} ?> /> 
					<?php echo lang('label_no_of_holidays');?></label><br>
					If checked,Total no. of Working Days will include holidays,and this will reduce the value of Salary Per Day
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>
					<input type="checkbox" name="email_salary_slip_to_employee" id="email_salary_slip_to_employee" <?php if($email_salary_slip_to_employee == 1){ echo 'checked = "checked"';} ?> /> 
					<?php echo lang('label_email_salary');?></label><br>
					Email salary slip to employee based on preffered email selected in employee
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo lang('label_max_working_hours');?></label>
					<span class="mandatory">*</span>
					<input type="text" name="max_working_hours_against_timesheet" ng-init="max_working_hours_against_timesheet = '<?php echo $max_working_hours_against_timesheet; ?>'" id="max_working_hours_against_timesheet" value="<?php echo $max_working_hours_against_timesheet;?>" class="form-control" ng-model="max_working_hours_against_timesheet" onkeypress="return isNumberKey(event)" maxlength="5" required />
					<span class="help-block" ng-show="showMsgs && myform.max_working_hours_against_timesheet.$error.required"><?php echo $this->lang->line('required');?></span>
					<span class="help-block"><?php echo form_error("max_working_hours_against_timesheet")?></span>
				</div>
			</div>
		</div>
	</fieldset>
	<!--Submit/Cancel Buttons-->
    <!--<div class="form-buttons-w">
        <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
        <a href="<?php echo base_url('hr/Setup/HR_settings') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
    </div>-->
    <div class="modal-footer">
	    <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
	    <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
	</div>
</form>	
</div>		
		
