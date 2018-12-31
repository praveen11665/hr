<?php
$ci                          = &get_instance();
$leaveblocklistDropdown      = $ci->mcommon->Dropdown('hr_leave_block_list', array('leave_block_list_id as Key', 'leave_block_list_name as Value'),array('is_delete' => 0));

$department_id    	         = "";
$department_name             = ""; 
$leave_block_list_id         = "";

if(!empty($tableData))
{
    foreach ($tableData as $row) 
    {
        $department_id   	    = $row->department_id;        
        $department_name        = $row->department_name;
        $leave_block_list_id    = $row->leave_block_list_id;
    }
}
else
{
    $department_id   	    = $this->input->post('department_id');
    $department_name        = $this->input->post('department_name');
    $leave_block_list_id    = $this->input->post('leave_block_list_id');   
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('department_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="department_id" id="department_id" value="<?php echo $department_id;?>">					
        <div class="row">
        	<div class="col-md-6">
        		<div class="form-group">
        			<label><?php echo lang('label_department_type');?></label>
        			<span class="mandatory">*</span>
        			<input type="text" name="department_name" id="department_name" ng-init="department_name = '<?php echo $department_name; ?>'" value="<?php echo $department_name;?>" class="form-control" ng-model="department_name" ng-pattern="/^[a-zA-Z\s]*$/" required allow-characters maxlength="25"/>
                    <span class="help-block" ng-show="showMsgs && myform.department_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.department_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
        			<span class="help-block"><?php echo form_error("department_name")?></span>
        		</div>
        	</div>
       
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_leave_block_list',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'blockLists' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_leave_blocklist');?></label>
                     <a class="add-new-popup"><i class="popup"></i>+</a>
                       
                    <span class="mandatory">*</span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="leave_block_list_id" ng-model="leave_block_list_id" required';
                        echo form_dropdown('leave_block_list_id', $leaveblocklistDropdown, set_value('leave_block_list_id', (isset($leave_block_list_id)) ? $leave_block_list_id : ''), $attrib);
                        if(form_error('leave_block_list_id')){ echo '<span class="help-block">'.form_error('leave_block_list_id').'</span>';} 
                    ?>-->
                    <select name="leave_block_list_id" ng-init="leave_block_list_id = '<?php echo $leave_block_list_id; ?>'" ng-model="leave_block_list_id" id="leave_block_list_id" class="form-control" required select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="leave_block_list_id in blockLists" value="{{leave_block_list_id.leave_block_list_id}}">{{leave_block_list_id.leave_block_list_name}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.leave_block_list_id.$error.required"><?php echo $this->lang->line('required');?></span>    
                </div>
            </div>
        </div>
        <!--Submit/Cancel Buttons-->
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('hr/Setup/Department') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>

        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>