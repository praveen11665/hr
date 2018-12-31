<?php
$ci =&get_instance();
$namingSeriesdrop       =  $ci->mdrop->namingSeriesdrop('134');
$statusDropdown         =  $ci->mcommon->Dropdown('def_hr_employee_status', array('employee_status_id as Key', 'status as Value'));
$repaymentDropdown      =  $ci->mcommon->Dropdown('def_hr_emp_loan_repayment_method', array('emp_loan_repayment_method_id as Key', 'repayment_method as Value'));

//5 names include
$loan_type_id           =   "";
$loan_name              =   "";
$maximum_loan_amount    =   "";
$rate_of_interest       =   "";
$description            =   "";
$disabled               =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $loan_type_id           =   $row->loan_type_id;
        $naming_series          =   $row->naming_series;
        $loan_name              =   $row->loan_name;
        $maximum_loan_amount    =   $row->maximum_loan_amount;
        $rate_of_interest       =   $row->rate_of_interest;
        $description            =   $row->description;
        $disabled               =   $row->disabled;         
    }

    $naming_seriesArr =   explode('/', $naming_series);
    foreach ($naming_seriesArr as $key => $value) 
    {
        $set_options    =   $naming_seriesArr[0];
    }
    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '134'), 'naming_series_id');

    $naming_option      =   $source_id."_".$set_options; 
}
else
{
    $loan_type_id               =   $this->input->post('loan_type_id');
    $loan_name                  =   $this->input->post('loan_name');
    $maximum_loan_amount        =   $this->input->post('maximum_loan_amount');
    $rate_of_interest           =   $this->input->post('rate_of_interest');
    $description                =   $this->input->post('description');
    $disabled                   =   $this->input->post('disabled'); 
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Loan_type_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
      <input type="hidden" name="loan_type_id" id="loan_type_id" value="<?php echo $loan_type_id;?>">
        <div class="row">
           <div class="col-md-6" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/134')">
                <div class="form-group">
                    <label for="naming_series_id"><?php echo $this->lang->line('label_series_name');?> </label> <span class="mandatory">*</span>
                    <a class="add-new-popup"><i class="popup"></i>+</a>
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
    				<label><?php echo $this->lang->line('label_loan_name');?></label>
    				<span class="mandatory">*</span>
    				<input type="text" name="loan_name" id="loan_name" ng-init="loan_name = '<?php echo $loan_name; ?>'" class="form-control" ng-model="loan_name" ng-pattern="/^[a-zA-Z\s]*$/" required allow-characters maxlength="25"/>
                    <span class="help-block" ng-show="showMsgs && myform.loan_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.loan_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
    				<span class="help-block"><?php echo form_error('loan_name')?></span>
            	</div>  
        	</div>
        </div>
         <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_maximum_loan_amount');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="maximum_loan_amount" id="maximum_loan_amount" ng-init="maximum_loan_amount = '<?php echo $maximum_loan_amount; ?>'" value="<?php echo $maximum_loan_amount;?>" class="form-control" ng-model="maximum_loan_amount" required onkeydown="return allowNonZeroIntegers(event)" maxlength="10"/>
                    <span class="help-block" ng-show="showMsgs && myform.maximum_loan_amount.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.maximum_loan_amount.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('maximum_loan_amount')?></span>
                </div>  
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_rate_of_interest_yearly');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="rate_of_interest" id="rate_of_interest" maxlength="6"  ng-init="rate_of_interest = '<?php echo $rate_of_interest; ?>'" value="<?php echo $rate_of_interest;?>" class="form-control" ng-model="rate_of_interest" required onkeypress="return validateFloatKeyPress(this,event)"/>
                    <span class="help-block" ng-show="showMsgs && myform.rate_of_interest.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.rate_of_interest.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('rate_of_interest')?></span>
                </div>  
            </div>
        </div>
        <div class="row">
        	<div class="col-md-12">
        		<div class="form-group">
    				<label><?php echo lang('label_description');?></label>
    				<textarea class="form-control" rows="3" name="description" id="description" ><?php echo $description;?></textarea>
    				<span class="help-block"><?php echo form_error('description')?></span>
                </div>  
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-6">
    			<div class="form-group">
                    <label>
                        <input type="checkbox" ng-model="disabled" name="disabled" id="disabled" ng-checked="'<?php echo $disabled;?>' == '0'" /> 
                        <?php echo $this->lang->line('label_is_active');?>
                    </label>
            	</div>
            </div>
        </div>

        <!-- <div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit" ng-click="submited('myform')"> <?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('hr/Employee_loan/Loan_type') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>