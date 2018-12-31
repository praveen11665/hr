<?php
 $designation_id     = "";
 $designation_name   = ""; 
 $description 		 = "";
 
if(!empty($tableData))
{
    foreach ($tableData as $row) 
    {
        $designation_id   	 = $row->designation_id;        
        $designation_name    = $row->designation_name;
        $description         = $row->description;
    }
}
else
{
    $designation_id   		= $this->input->post('designation_id');
    $designation_name    	= $this->input->post('designation_name'); 
    $description    		= $this->input->post('description');   
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('designation_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
	<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
		<input type="hidden" name="designation_id" id="designation_id" value="<?php echo $designation_id;?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo lang('label_designation');?></label>
					<span class="mandatory">*</span>
					<input type="text" name="designation_name" id="designation_name" ng-init="designation_name = '<?php echo $designation_name; ?>'" value="<?php echo $designation_name;?>" class="form-control"  ng-model="designation_name" ng-pattern="/^[a-zA-Z\s]*$/" required allow-characters maxlength="30"/>
                    <span class="help-block" ng-show="showMsgs && myform.designation_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.designation_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
					<span class="help-block"><?php echo form_error("designation_name")?></span>
				</div>
			</div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('label_description');?></label>
                    <textarea name="description" id="description" ng-model="description" ng-init="description = '<?php echo str_replace("'","",$description); ?>'" class="form-control"><?php echo $description;?></textarea>
                </div>
            </div>
        </div>
		<!--Submit/Cancel Buttons-->
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
                <a href="<?php echo base_url('hr/Setup/Designation') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
	</form>
</div>