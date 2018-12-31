<?php
 //Variable Initialization
 $branch_id    = "";
 $branch       = ""; 
 
if(!empty($tableData))
{
    foreach ($tableData as $row) 
    {
        $branch_id   = $row->branch_id;        
        $branch      = $row->branch;
    }
}
else
{
    $branch_id   = $this->input->post('branch_id');
    $branch      = $this->input->post('branch'); 
}
?>
<!-- Success/Error message print here-->
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Branch_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $branch_id; ?>"/>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_branch');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="branch" id="branch" ng-init="branch = '<?php echo $branch; ?>'" value="<?php echo $branch;?>" class="form-control" ng-model="branch" ng-pattern="/^[a-zA-Z\s]*$/" required allow-characters maxlength="25"/>
                    <span class="help-block" ng-show="showMsgs && myform.branch.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.branch.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error("branch");?></span>

                </div>
            </div>
        </div>
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('hr/Setup/Branch') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>