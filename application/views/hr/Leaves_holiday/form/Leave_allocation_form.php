<?php
$ci =&get_instance();
$namingSeriesdrop           =  $ci->mdrop->namingSeriesdrop('6');
$employeeDropdown           =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_number as Value'), array('is_delete' => 0));
$leavetypeDropdown          =  $ci->mcommon->Dropdown('hr_leave_type', array('leave_type_id as Key', 'leave_type_name as Value'), array('is_delete' => 0));

$leave_allocation_id        =   "";
$naming_series              =   "";
$employee_id                =   "";
$employee_name              =   "";
$description                =   "";
$leave_type_id              =   "";
$from_date                  =   "";
$to_date                    =   "";
$new_leaves_allocated       =   "";
$carry_forward              =   "";
$carry_forwarded_leaves     =   "";
$total_leaves_allocated     =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $leave_allocation_id        =   $row->leave_allocation_id;
        $naming_series              =   $row->naming_series;
        $employee_id                =   $row->employee_id;
        $employee_name              =   $row->employee_name;
        $description                =   $row->description;
        $leave_type_id              =   $row->leave_type_id;
        $from_date                  =   $row->from_date;
        $to_date                    =   $row->to_date;
        $new_leaves_allocated       =   $row->new_leaves_allocated;
        $carry_forward              =   $row->carry_forward;
        $carry_forwarded_leaves     =   $row->carry_forwarded_leaves;
        $total_leaves_allocated     =   $row->total_leaves_allocated;
    }

    $naming_seriesArr =   explode('/', $naming_series);
    foreach ($naming_seriesArr as $key => $value) 
    {
        $set_options    =   $naming_seriesArr[0];
    }
    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '6'), 'naming_series_id');

    $naming_option      =   $source_id."_".$set_options; 
}
else
{
    $leave_allocation_id            =   $this->input->post('leave_allocation_id');
    $naming_series                  =   $this->input->post('naming_series');
    $employee_id                    =   $this->input->post('employee_id');
    $employee_name                  =   $this->input->post('employee_name');
    $description                    =   $this->input->post('description');
    $leave_type_id                  =   $this->input->post('leave_type_id');
    $from_date                      =   $this->input->post('from_date');
    $to_date                        =   $this->input->post('to_date');
    $new_leaves_allocated           =   $this->input->post('new_leaves_allocated');
    $carry_forward                  =   $this->input->post('carry_forward');
    $carry_forwarded_leaves         =   $this->input->post('carry_forwarded_leaves');
    $total_leaves_allocated         =   $this->input->post('total_leaves_allocated');
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Leave_Allocation_log_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="leave_allocation_id" id="leave_allocation_id" value="<?php echo $leave_allocation_id;?>">
        <div class="row">
            <div class="col-md-6" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/6')">
                <div class="form-group">
                    <label for="naming_series_id"><?php echo $this->lang->line('label_series_name');?> </label> <span class="mandatory">*</span>
                    <a class="add-new-popup" ng-click="$ctrl.openSecond('lg', '', '<?php echo base_url($namingUrl);?>' )"><i class="popup"></i>+</a>
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
                    <label><?php echo $this->lang->line('label_description');?> </label>
                    <span class="mandatory">*</span>
                    <textarea name="description" class="form-control" rows="3" cols="5" ng-init="description = '<?php echo $description; ?>'" ng-model="description" required><?php echo $description;?></textarea>
                    <span class="help-block"><?php echo form_error('description');?></span>
                    <span class="help-block" ng-show="showMsgs && myform.description.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employee',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employees' )">
                <div class="form-group">
                    <label for="employee_id"><?php echo $this->lang->line('label_employee');?></label>
                    <span class="mandatory">*</span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="employee_id" onchange="loademployeename();" ng-model="employee_id" required';
                        echo form_dropdown('employee_id', $employeeDropdown, set_value('employee_id', (isset($employee_id)) ? $employee_id : ''), $attrib);?>
                    <?PHP if(form_error('employee_id')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';} ?>-->   
                    <select name="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" ng-model="employee_id" id="employee_id" class="form-control" onchange="loademployeename();" required select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="employee_id in employees" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option>  
                     </select>                
                     <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>                             
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                	<label for="employee_name"><?php echo $this->lang->line('label_employee_name');?> </label>
                	<input type="text" name="employee_name" id="employee_name" ng-init="employee_name = '<?php echo $employee_name; ?>'" value="<?php echo $employee_name;?>" class="form-control" readonly="readonly" />
    				<span class="help-block"><?php echo form_error('employee_name');?></span>
    			</div>
            </div>	
        </div>
        <hr>
        <!-- second row-->
    	<div class="row">
         	<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_leave_type',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'leaveTypes' )">
             	<div class="form-group">
                    <label for="leave_type_id"><?php echo $this->lang->line('label_leave_type');?> </label>
                    <a class="add-new-popup" onclick="">+</a>
                    <span class="mandatory">*</span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="leave_type_id" ng-model="leave_type_id" required';
                        echo form_dropdown('leave_type_id', $leavetypeDropdown, set_value('leave_type_id', (isset($leave_type_id)) ? $leave_type_id : ''), $attrib);
                        if(form_error('leave_type_id')){ echo '<span class="help-block">'.form_error('leave_type_id').'</span>';}
                    ?>--> 
                    <select name="leave_type_id" ng-init="leave_type_id = '<?php echo $leave_type_id; ?>'" ng-model="leave_type_id" id="leave_type_id" class="form-control" required select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="leave_type_id in leaveTypes" value="{{leave_type_id.leave_type_id}}">{{leave_type_id.leave_type_name}}</option>  
                     </select>                
                     <span class="help-block" ng-show="showMsgs && myform.leave_type_id.$error.required"><?php echo $this->lang->line('required');?></span>  
       			</div>
       		</div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="new_leaves_allocated"><?php echo $this->lang->line('label_new_leave_allocaton');?> </label>
                    <input type="text" name="new_leaves_allocated" id="new_leaves_allocated" ng-model="new_leaves_allocated" ng-init="new_leaves_allocated = '<?php echo $new_leaves_allocated; ?>'" value="<?php echo $new_leaves_allocated ?>" class="form-control" onkeypress="return isNumberKey(event)" maxlength="2"/>
                    <span class="help-block"><?php echo form_error('new_leaves_allocated');?></span>
                </div>        
            </div>
        </div>
        <!-- Thirdd row-->
    	<div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="from_date"> <?php echo $this->lang->line('label_from_date');?> </label>
                    <span class="mandatory">*</span>
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="from_date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true"  data-ng-init="init('<?php echo $from_date?>', 'from_date')" value="{{from_date | date:'dd-MM-yyyy' }}" name="from_date"  ng-focus="open('popup1')" id="from_date" ng-change="fromDateChange('from_date')"/>
                    <span class="help-block" ng-show="showMsgs && myform.from_date.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>                            
            </div>
            <div class="col-md-6">
                <div class="form-group"> 
                    <label>
                        <input type="checkbox" name="carry_forward" id="carry_forward" ng-init="carry_forward = '<?php echo $carry_forward; ?>'" <?php if($carry_forward == 1){ echo 'checked = "checked"';} ?> onClick="loadUnusedLeaves(this,'#unused_leaves')" /> 
                        <?php echo lang('label_unused_leaves');?>
                    </label>
                </div>                            
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">            
            </div>
            <div class="col-md-6" style="display: none;" id="unused_leaves">
                <div class="form-group">

                    <label for="carry_forwarded_leaves"><?php echo $this->lang->line('label_unused_leave');?> </label>
                    <input type="text" name="carry_forwarded_leaves" id="carry_forwarded_leaves" ng-init="carry_forwarded_leaves = '<?php echo $carry_forwarded_leaves; ?>'" value="<?php echo $carry_forwarded_leaves;?>" class="form-control" readonly="readonly" onkeyup="carryforwardleaves();"/>
                    <span class="help-block"><?php echo form_error('carry_forwarded_leaves');?></span>
                </div>
            </div>  
        </div>
        <div class="row">
    		<div class="col-md-6">
            	<div class="form-group">
                	<label for="to_date"><?php echo $this->lang->line('label_to_date');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="to_date" is-open="popup2.opened" datepicker-options="toDateOptions" ng-required="true"  data-ng-init="init('<?php echo $to_date?>', 'to_date')" value="{{to_date | date:'dd-MM-yyyy' }}" name="to_date"  ng-focus="open('popup2')"/>
                    <span class="help-block" ng-show="showMsgs && myform.to_date.$error.required"><?php echo $this->lang->line('required');?></span>
    			</div>
    		</div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="total_leaves_allocated"><?php echo $this->lang->line('label_total_leaves');?> </label>
                    <input type="text" name="total_leaves_allocated" id="total_leaves_allocated" ng-init="total_leaves_allocated = '<?php echo $total_leaves_allocated; ?>'" value="{{new_leaves_allocated}}" class="form-control" readonly="readonly" />
                    <span class="help-block"><?php echo form_error('total_leaves_allocated');?></span>
                </div>
            </div>
        </div>	
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>