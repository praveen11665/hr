<?php
$leave_type_id        =   "";
$leave_type_name      =   "";
$max_days_allowed     =   "";
$is_carry_forward     =   "";
$is_lwp               =   "";
$allow_negative       =   "";
$include_holiday      =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $leave_type_id        =   $row->leave_type_id;
        $leave_type_name      =   $row->leave_type_name;
        $max_days_allowed     =   $row->max_days_allowed;
        $is_carry_forward     =   $row->is_carry_forward;
        $is_lwp               =   $row->is_lwp;
        $allow_negative       =   $row->allow_negative;
        $include_holiday      =   $row->include_holiday;
    }
}
else
{
    $leave_type_id            =   $this->input->post('leave_type_id');
    $leave_type_name          =   $this->input->post('leave_type_name');
    $max_days_allowed         =   $this->input->post('max_days_allowed');
    $is_carry_forward         =   $this->input->post('is_carry_forward');
    $is_lwp                   =   $this->input->post('is_lwp');
    $allow_negative           =   $this->input->post('allow_negative');
    $include_holiday          =   $this->input->post('include_holiday');   
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Leave_type_form_title');?></h4>
</div>

<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="leave_type_id" id="leave_type_id" value="<?php echo $leave_type_id;?>">  
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="leave_type_name"><?php echo lang('label_leave_type_name');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="leave_type_name" id="leave_type_name" ng-init="leave_type_name = '<?php echo $leave_type_name; ?>'" value="<?php echo $leave_type_name;?>" class="form-control" ng-model="leave_type_name" ng-pattern="/^[a-zA-Z\s]*$/" required allow-characters maxlength="25"/>
                    <span class="help-block"><?php echo form_error('leave_type_name')?></span>
                    <span class="help-block" ng-show="showMsgs && myform.leave_type_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.leave_type_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="max_days_allowed"><?php echo lang('label_maximum_leave_allowed');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="max_days_allowed" id="max_days_allowed" ng-init="max_days_allowed = '<?php echo $max_days_allowed; ?>'" value="<?php echo $max_days_allowed;?>" class="form-control" ng-model="max_days_allowed" required onkeypress="return isNumberKey(event)" maxlength="2"/>
                    <span class="help-block"><?php echo form_error('max_days_allowed')?></span>
                    <span class="help-block" ng-show="showMsgs && myform.max_days_allowed.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_carry_forward" id="is_carry_forward" ng-init="is_carry_forward = '<?php echo $is_carry_forward; ?>'" <?php echo($is_carry_forward == "1")?"checked":""?>/>
                        <?php echo lang('label_carried_forward');?>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_lwp" id="is_lwp" ng-init="is_lwp = '<?php echo $is_lwp; ?>'"  <?php echo($is_lwp == "1")?"checked":""?>/>   
                        <?php echo lang('label_leave_without_pay');?>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="allow_negative" id="allow_negative" ng-init="allow_negative = '<?php echo $allow_negative; ?>'""  <?php echo($allow_negative == "1")?"checked":""?>/>
                        <?php echo lang('label_allow_negative_balance');?>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="include_holiday" id="include_holiday" ng-init="include_holiday = '<?php echo $include_holiday; ?>'"<?php echo($include_holiday == "1")?"checked":""?>/>
                        <?php echo lang('label_holidays_within_leaves');?>
                    </label>
                </div>
            </div>
        </div>
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('hr/Leaves_holiday/Leave_type'); ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
        </div>-->

        <div class="modal-footer">
                <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
                <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>