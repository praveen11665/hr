<?php
//Variable Initialization
$employment_type_id    	= "";
$employment_type_name   = ""; 
 
if(!empty($tableData))
{
    foreach ($tableData as $row) 
    {
        $employment_type_id   	=   $row->employment_type_id;        
        $employment_type_name   =   $row->employment_type_name; 
    }
}
else
{
    $employment_type_id   	 =   $this->input->post('employment_type_id');
    $employment_type_name    =   $this->input->post('employment_type_name');
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('employment_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
	<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
		<input type="hidden" name="employment_type_id"  value="<?php echo $employment_type_id;?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo lang('label_employee_type_heading');?></label>
					<span class="mandatory">*</span>
					<input type="text" name="employment_type_name" ng-init="employment_type_name = '<?php echo $employment_type_name; ?>'" value="<?php echo $employment_type_name; ?>" class="form-control" ng-model="employment_type_name" ng-pattern="/^[a-zA-Z\s]*$/" required allow-characters maxlength="25"/>
					<span class="help-block" ng-show="showMsgs && myform.employment_type_name.$error.required"><?php echo $this->lang->line('required');?></span>
					<span class="help-block" ng-show="myform.employment_type_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
					<span class="help-block"><?php echo form_error("employment_type_name")?></span>
				</div>
			</div>
		</div>
		<!--Submit/Cancel Buttons-->
	    <!--<div class="form-buttons-w">
	        <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
	        <a href="<?php echo base_url('hr/Setup/Employment_type') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
	    </div>-->
	    <div class="modal-footer">
		    <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
		    <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
		</div>
	</form>
</div>