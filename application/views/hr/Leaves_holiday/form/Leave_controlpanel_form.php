<?php
$ci =&get_instance();
$leavetypeDropdown      =  $ci->mcommon->Dropdown('hr_leave_type', array('leave_type_id as Key', 'leave_type_name as Value'), array('is_delete' => 0));
$companyDropdown        =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'), array('is_delete' => 0));
$branchDropdown         =  $ci->mcommon->Dropdown('hr_branch', array('branch_id as Key', 'branch as Value'), array('is_delete' => 0));
$departmentDropdown     =  $ci->mcommon->Dropdown('hr_department', array('department_id as Key', 'department_name as Value'), array('is_delete' => 0));
$designationDropdown    =  $ci->mcommon->Dropdown('hr_designation', array('designation_id as Key', 'designation_name as Value'),array('is_delete' => 0));
$employmenttypeDropdown =  $ci->mcommon->Dropdown('hr_employment_type', array('employment_type_id as Key', 'employment_type_name as Value'), array('is_delete' => 0));

$leave_control_panel_id         =   "";
$company_id                     =   "";
$employment_type_id             =   "";
$branch_id                      =   "";
$department_id                  =   "";
$designation_id                 =   "";
$from_date                      =   "";
$to_date                        =   "";
$leave_type_id                  =   "";
$carry_forward                  =   "";
$no_of_days                     =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $leave_control_panel_id         =   $row->leave_control_panel_id;
        $company_id                     =   $row->company_id;
        $employment_type_id             =   $row->employment_type_id;
        $branch_id                      =   $row->branch_id;
        $department_id                  =   $row->department_id;
        $designation_id                 =   $row->designation_id;
        $from_date                      =   $row->from_date;
        $to_date                        =   $row->to_date;
        $leave_type_id                  =   $row->leave_type_id;
        $carry_forward                  =   $row->carry_forward;
        $no_of_days                     =   $row->no_of_days;       
    }
}
else
{
    $leave_control_panel_id             =   $this->input->post('leave_control_panel_id');
    $company_id                         =   $this->input->post('company_id');
    $employment_type_id                 =   $this->input->post('employment_type_id');
    $branch_id                          =   $this->input->post('branch_id');
    $department_id                      =   $this->input->post('department_id');
    $designation_id                     =   $this->input->post('designation_id');
    $from_date                          =   $this->input->post('from_date');
    $to_date                            =   $this->input->post('to_date');
    $leave_type_id                      =   $this->input->post('leave_type_id');
    $carry_forward                      =   $this->input->post('carry_forward');
    $no_of_days                         =   $this->input->post('no_of_days');   
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Leave_controlpanel_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="leave_control_panel_id" id="leave_control_panel_id" value="<?php echo $leave_control_panel_id;?>">
        <div class="row">            
         	<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'companies' )">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_company');?></label>
                    <span class="mandatory">*</span><br/>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="company_id" ng-model="company_id" required';
                        echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);?>
                    <?PHP if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} ?>-->
                    <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
                     </select> 
                    <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-6"  ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employment_type',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'empTypes' )">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_employment_type');?></label>
                    <span class="mandatory">*</span><br/>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="employment_type_id" ng-model="employment_type_id" required';
                        echo form_dropdown('employment_type_id', $employmenttypeDropdown, set_value('employment_type_id', (isset($employment_type_id)) ? $employment_type_id : ''), $attrib);?>
                    <?PHP if(form_error('employment_type_id')){ echo '<span class="help-block">'.form_error('employment_type_id').'</span>';} ?>--> 
                    <select name="employment_type_id" ng-init="employment_type_id = '<?php echo $employment_type_id; ?>'" ng-model="employment_type_id" id="employment_type_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="employment_type_id in empTypes" value="{{employment_type_id.employment_type_id}}">{{employment_type_id.employment_type_name}}</option>  
                    </select> 
                    <span>Leave blank if considered for all employee types</span>
                    <span class="help-block" ng-show="showMsgs && myform.employment_type_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
        </div>    
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_from_date');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" class="form-control" show-button-bar="false" uib-datepicker-popup="{{format}}" ng-model="from_date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $from_date?>', 'from_date')" value="{{from_date | date:'dd-MM-yyyy' }}" name="from_date"  ng-focus="open('popup1')"/>
                    <span class="help-block" ng-show="showMsgs && myform.from_date.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_to_date');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="to_date" is-open="popup2.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $to_date?>', 'to_date')" value="{{to_date | date:'dd-MM-yyyy' }}" name="to_date"  ng-focus="open('popup2')"/>
                    <span class="help-block" ng-show="showMsgs && myform.to_date.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"  ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_branch',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'branches' )">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_branch');?></label>
                    <span class="mandatory">*</span><br/>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="branch_id" ng-model="branch_id" required';
                        echo form_dropdown('branch_id', $branchDropdown, set_value('branch_id', (isset($branch_id)) ? $branch_id : ''), $attrib);?>
                    <?PHP if(form_error('branch_id')){ echo '<span class="help-block">'.form_error('branch_id').'</span>';} ?>-->

                    <select name="branch_id" ng-init="branch_id = '<?php echo $branch_id; ?>'" ng-model="branch_id" id="branch_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="branch_id in branches" value="{{branch_id.branch_id}}">{{branch_id.branch}}</option>  
                    </select>                 
                    <span>Leave blank if considered for all branches</span> 
                    <span class="help-block" ng-show="showMsgs && myform.branch_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>    
            <div class="col-md-6"  ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_leave_type',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'leaveTypes' )">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_leave_type');?></label>
                    <span class="mandatory">*</span>
                    <a class="add-new-popup" onclick="">+</a>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="leave_type_id" ng-model="leave_type_id" required';
                        echo form_dropdown('leave_type_id', $leavetypeDropdown, set_value('leave_type_id', (isset($leave_type_id)) ? $leave_type_id : ''), $attrib);
                        if(form_error('leave_type_id')){ echo '<span class="help-block">'.form_error('leave_type_id').'</span>';}
                    ?>-->
                    <select name="leave_type_id" ng-init="leave_type_id = '<?php echo $leave_type_id; ?>'" ng-model="leave_type_id" id="leave_type_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="leave_type_id in leaveTypes" value="{{leave_type_id.leave_type_id}}">{{leave_type_id.leave_type_name}}</option>  
                    </select> 
                    <span class="help-block" ng-show="showMsgs && myform.leave_type_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_department',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'departmentData' )">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_department');?></label>
                    <span class="mandatory">*</span><br/>                   
                    <select name="department_id" ng-init="department_id = '<?php echo $department_id; ?>'" ng-model="department_id" id="department_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="department_id in departmentData" value="{{department_id.department_id}}">{{department_id.department_name}}</option>  
                     </select> 
                    <span class="help-block" ng-show="showMsgs && myform.department_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>

            <div class="col-md-6"  ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_designation',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'desings' )">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_designation');?></label>
                    <span class="mandatory">*</span><br/>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="designation_id" ng-model="designation_id" required';
                        echo form_dropdown('designation_id', $designationDropdown, set_value('designation_id', (isset($designation_id)) ? $designation_id : ''), $attrib);?>
                    <?PHP if(form_error('designation_id')){ echo '<span class="help-block">'.form_error('designation_id').'</span>';} ?>--> 
                    <select name="designation_id" ng-init="designation_id = '<?php echo $designation_id; ?>'" ng-model="designation_id" id="designation_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="designation_id in desings" value="{{designation_id.designation_id}}">{{designation_id.designation_name}}</option>  
                    </select> 
                    <span>Leave blank if considered for all designations</span>            
                    <span class="help-block" ng-show="showMsgs && myform.designation_id.$error.required"></span>  
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="carry_forward" id="carry_forward" ng-init="carry_forward = '<?php echo $carry_forward; ?>'" <?php if($carry_forward == 1){ echo 'checked = "checked"';} ?> /> 
                        <?php echo lang('label_carry_forward');?>
                    </label><br>
                    <span>Please select Carry Forward if you also want to include previous fiscal year's balance leaves to this fiscal year</span>
                </div>
            </div>           
        </div>    
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_new_leave_allocation');?></label>
                    <input type="text" name="no_of_days" id="no_of_days" ng-init="no_of_days = '<?php echo $no_of_days; ?>'" value="<?php echo $no_of_days;?>" class="form-control" onkeypress="return isNumberKey(event)" maxlength="2"/>
                    <span class="help-block"><?php echo form_error('no_of_days')?></span>
                </div>
            </div><br>
            <!--<div class="col-md-6">
                <div class="form-group">
                    <button class="btn btn-default" type="submit" name="submit"><?php echo $this->lang->line('label_allocate');?></button>
                </div>
            </div>-->
        </div>       

        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>                   
    </form>
</div> 