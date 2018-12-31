<?php
 //Variable Initialization
 $salutation_id    = "";
 $salutation       = ""; 
 
if(!empty($tableData))
{
    foreach ($tableData as $row) 
    {
        $salutation_id   = $row->salutation_id;        
        $salutation      = $row->salutation;      
    }
}
else
{
    $salutation_id   = $this->input->post('salutation_id');
    $salutation      = $this->input->post('salutation'); 
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('salutation_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
      <input type="hidden" name="salutation_id" id="salutation_id" value="<?php echo $salutation_id;?>">
    	<div class="row">
    		<div class="col-md-6">
    			<div class="form-group">
    				<label><?php echo lang('label_salutation');?></label>
    				<span class="mandatory">*</span>
    				<input type="text" name="salutation" id="salutation" ng-init="salutation = '<?php echo $salutation; ?>'" value="<?php echo $salutation;?>" class="form-control" ng-model="salutation" allow-characters disallow-spaces required maxlength="10"/>
                    <span class="help-block" ng-show="showMsgs && myform.salutation.$error.required"><?php echo $this->lang->line('required');?></span>
    				<span class="help-block"><?php echo form_error("salutation")?></span>
    			</div>
    		</div>
    	</div>
    	<!--Submit/Cancel Buttons-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
        <!--<div class="form-buttons-w">
                <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
                 <a href="<?php echo base_url('hr/Setup/Salutation') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>

        </div>-->
    </form>
</div>