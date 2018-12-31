<?php
    $printing_heading_id = "";
    $printing_heading    = "";
    $description         = "";    

    if(!empty($tableData))
    {
        foreach ($tableData as $row)
        {
            $printing_heading_id =  $row->printing_heading_id;
            $printing_heading    =  $row->printing_heading;
            $description         =  $row->description;
        }  
    }   
    else
    {
        $printing_heading_id  = $this->input->post('printing_heading_id');
        $printing_heading     = $this->input->post('printing_heading');
        $description          = $this->input->post('description');
    } 
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('printing_heading_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
    	<input type="hidden" name="printing_heading_id" id="printing_heading_id" value="<?php echo $printing_heading_id;?>" >
    	<div class="row">
    		<div class="col-md-6">
    			<div class="form-group">
                    <!--printing heading textbox-->
    				<label><?php echo $this->lang->line('label_printing_heading');?></label>
                    <span class="mandatory">*</span>
    				<input type="text" name="printing_heading" id="printing_heading" ng-init="printing_heading = '<?php echo $printing_heading; ?>'" value="<?php echo $printing_heading;?>" class="form-control" ng-model="printing_heading" required allow-characters>
                    <span class="help-block" ng-show="showMsgs && myform.printing_heading.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.printing_heading.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('printing_heading');?></span>
    			</div>
    		</div>
            <div class="col-md-6">
                <div class="form-group">
                    <!--Description textarea-->
                    <label><?php echo $this->lang->line('label_printing_heading_description');?></label>
                    <span class="mandatory">*</span>
                    <textarea class="form-control" name="description" id="description" ng-init="description = '<?php echo $description; ?>'"  ng-model="description" required><?php echo $description;?></textarea>
                    <span class="help-block" ng-show="showMsgs && myform.description.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.description.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('description');?></span>
                </div>
            </div>
    	</div>
        <!--buttons-->
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"><?php echo lang('label_submit');?></button>
            <a href="<?php echo base_url('setting/Printing_settings/printing_heading/') ?>" class="btn btn-danger"> Cancel</a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>