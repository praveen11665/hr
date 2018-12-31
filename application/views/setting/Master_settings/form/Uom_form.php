<?php
//Variable Initialize
$uom_id   				=   "";
$uom_name            	=   "";
$must_be_whole_number   =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $uom_id   				=  $row->uom_id;
        $uom_name            	=  $row->uom_name;
        $must_be_whole_number   =  $row->must_be_whole_number;
    }    
}
else
{
    $uom_id       			=   $this->input->post('uom_id');
    $uom_name              	=   $this->input->post('uom_name');
    $must_be_whole_number  	=   $this->input->post('must_be_whole_number');   
}    
?> 
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('uom_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
    	<input type="hidden" name="uom_id" id="" value="<?php echo $uom_id;?>" >
    	<div class="row">
    		<div class="col-md-6">
    			<div class="form-group">
    				<label><?php echo $this->lang->line('uom_name');?></label>
                    <span class="mandatory">*</span>
    				<input type="text" name="uom_name" value="<?php echo $uom_name;?>" ng-init="uom_name = '<?php echo $uom_name; ?>'" class="form-control" ng-model="uom_name" required allow-characters>
                    <span class="help-block" ng-show="showMsgs && myform.uom_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.uom_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error("uom_name")?></span>
    			</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-md-6">
    			<div class="form-group">
    				<label>
    				<input type="checkbox" name="must_be_whole_number" id="must_be_whole_number" ng-init="must_be_whole_number = '<?php echo $must_be_whole_number; ?>'" class="form control" <?php if ($must_be_whole_number == 1) {echo 'checked="checked"';} ?> />
    				<?php echo $this->lang->line('must_be_whole_number');?></label>
    			</div>
    		</div>
    	</div>
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit">Create UOM</button>
            <a href="<?php echo base_url('setting/Master_settings/Uom/') ?>" class="btn btn-danger"> Cancel</a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>