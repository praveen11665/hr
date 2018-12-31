<?php
$ci =&get_instance();
$payrollFrequencyDropdown =  $ci->mcommon->Dropdown('def_hr_payroll_frquency', array('payroll_frequency_id as Key', 'payroll_frequency as Value'));
$companyDropdown          =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name      as Value'), array('is_delete' => 0));
$departmentDropdown       =  $ci->mcommon->Dropdown('hr_department', array('department_id as Key', 'department_name as Value'), array('is_delete' => 0));
$branchDropdown           =  $ci->mcommon->Dropdown('hr_branch', array('branch_id as Key', 'branch as Value'), array('is_delete' => 0));
$designationDropdown      =  $ci->mcommon->Dropdown('hr_designation', array('designation_id as Key', 'designation_name as Value'), array('is_delete' => 0));
$projectDropdown          =  $ci->mcommon->Dropdown('pro_project', array('project_id as Key', 'project_name as Value'), array('is_delete' => 0)); 
$accountsDropdown         =  $ci->mcommon->Dropdown('def_acc_account_account_type', array('account_account_type_id as Key', 'account_type as Value'));

//Variable Initialize
$process_payroll_id             =   "";
$company_id                     =   "";
$posting_date                   =   "";
$payroll_frquency_id            =   "";
$branch_id                      =   "";
$department_id                  =   "";
$designation_id                 =   "";
$salary_slip_based_on_timesheet =   "";
$start_date                     =   "";
$end_date                       =   "";
$cost_center_id                 =   "";
$project_id                     =   "";
$account_id                     =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $process_payroll_id             =  $row->process_payroll_id;
        $company_id                     =  $row->company_id;
        $posting_date                   =  date('m/d/Y', strtotime($row->posting_date));
        $payroll_frquency_id            =  $row->payroll_frequency_id;
        $branch_id                      =  $row->branch_id;
        $department_id                  =  $row->department_id;
        $designation_id                 =  $row->designation_id;
        $salary_slip_based_on_timesheet =  $row->salary_slip_based_on_timesheet;
        $start_date                     =  date('m/d/Y', strtotime($row->start_date));
        $end_date                       =  date('m/d/Y', strtotime($row->end_date));
        $cost_center_id                 =  $row->cost_center_id ;
        $project_id                     =  $row->project_id;
        $account_account_type_id        =  $row->account_id;       
    }    
}
else
{
    $process_payroll_id             =   $this->input->post('process_payroll_id');   
    $company_id                     =   $this->input->post('company_id'); 
    $posting_date                   =   $this->input->post('posting_date');
    $payroll_frquency_id            =   $this->input->post('payroll_frquency_id');
    $branch_id                      =   $this->input->post('branch_id');
    $department_id                  =   $this->input->post('department_id');
    $designation_id                 =   $this->input->post('designation_id');
    $salary_slip_based_on_timesheet =   $this->input->post('salary_slip_based_on_timesheet');
    $start_date                     =   $this->input->post('start_date');
    $end_date                       =   $this->input->post('end_date'); 
    $cost_center_id                 =   $this->input->post('cost_center_id');
    $project_id                     =   $this->input->post('project_id');   
    $account_account_type_id        =   $this->input->post('account_id'); 
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Process_payroll_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
      <input type="hidden" name="process_payroll_id" id="process_payroll_id" value="<?php echo $process_payroll_id;?>" >
        <fieldset>
            <legend> <span> <?php echo $this->lang->line('label_select_employee');?> </span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company', <?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'companyData' )" >
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_company');?></label>
                                <span class="mandatory"> * </span>                                        
                                    <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control"  required select2>
                                          <option value="">-- Select --</option>
                                          <option ng-repeat="company_id in companyData" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
                                    </select>
                                    <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                            </div>
                        </div>
                        <?php
                        /*
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_company');?></label>
                                <span class="mandatory"> * </span>
                                <?php 
                                    $attrib = 'class="form-control select2" id="company_id" ng-model="company_id" required ';
                                    echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);
                                    if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} 
                                ?> 
                                <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>
                            </div>
                        </div>
                        */
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_posting_date');?></label>
                                <span class="mandatory"> * </span>
                                <input type="text" show-button-bar="false" name="posting_date" uib-datepicker-popup="{{format}}" ng-model="posting_date" is-open="popup1.opened"  ng-required="false" name="posting_date" ng-focus="open('popup1')" data-ng-init="init('<?php echo $posting_date?>', 'posting_date')"  data-name="posting_date" id="posting_date" class="form-control" value = "<?php echo $posting_date;?>"  required/>

                                <!--<input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="posting_date" is-open="popup2.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" value="{{posting_date | date:'dd-MM-yyyy' }}" name="posting_date"  ng-focus="open('popup2')"/>-->
                                <span class="help-block" ng-show="showMsgs && myform.posting_date.$error.required"><?php echo $this->lang->line('required');?></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_payroll_frquency', '', 'frequencyData' )" style="display: block;"  id="content_payroll_frequency">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_payroll_frequency');?></label>
                                <span class="mandatory"> * </span>                                        
                                    <select name="payroll_frquency_id" ng-init="payroll_frquency_id = '<?php echo $payroll_frquency_id; ?>'" ng-model="payroll_frquency_id" id="payroll_frquency_id" class="form-control"  required select2>
                                          <option value="">-- Select --</option>
                                          <option ng-repeat="payroll_frquency_id in frequencyData" value="{{payroll_frquency_id.payroll_frequency_id}}">{{payroll_frquency_id.payroll_frequency}}</option>  
                                    </select>
                                    <span class="help-block" ng-show="showMsgs && myform.payroll_frquency_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                            </div>
                        </div>
                        <!--<div class="col-md-12" style="display: block;"  id="content_payroll_frequency">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_payroll_frequency');?></label>
                                <span class="mandatory">*</span>
                                <?php 
                                    $attrib = 'class="form-control select2" id="payroll_frquency_id" ng-model="payroll_frquency_id" required';
                                    echo form_dropdown('payroll_frquency_id', $payrollFrequencyDropdown, set_value('payroll_frquency_id', (isset($payroll_frquency_id)) ? $payroll_frquency_id : ''), $attrib);
                                    if(form_error('payroll_frquency_id')){ echo '<span class="help-block">'.form_error('payroll_frquency_id').'</span>';} 
                                ?> 
                                <span class="help-block" ng-show="showMsgs && myform.payroll_frquency_id.$error.required"><?php echo $this->lang->line('required');?></span>
                            </div>
                        </div>-->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_branch', <?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'branchData' )">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_branch');?></label>
                                <span class="mandatory"> * </span>                                        
                                    <select name="branch_id" ng-init="branch_id = '<?php echo $branch_id; ?>'" ng-model="branch_id" id="branch_id" class="form-control"  required select2>
                                          <option value="">-- Select --</option>
                                          <option ng-repeat="branch_id in branchData" value="{{branch_id.branch_id}}">{{branch_id.branch}}</option>  
                                    </select>
                                    <span class="help-block" ng-show="showMsgs && myform.branch_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                            </div>
                        </div>
                        <!--<div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_branch');?></label>
                                <span class="mandatory">*</span>
                                <?php 
                                    $attrib = 'class="form-control select2" id="branch_id" ng-model="branch_id" required ';
                                    echo form_dropdown('branch_id', $branchDropdown, set_value('branch_id', (isset($branch_id)) ? $branch_id : ''), $attrib);
                                    if(form_error('branch_id')){ echo '<span class="help-block">'.form_error('branch_id').'</span>';}
                                ?>
                                <span class="help-block" ng-show="showMsgs && myform.branch_id.$error.required"><?php echo $this->lang->line('required');?></span>
                            </div>
                        </div>-->
                    </div>
                    <div class="row">
                        <div class="col-md-12" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_department', <?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'departmentData' )">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_department');?></label>
                                <span class="mandatory"> * </span>                                        
                                    <select name="department_id" ng-init="department_id = '<?php echo $department_id; ?>'" ng-model="department_id" id="department_id" class="form-control"  required select2>
                                          <option value="">-- Select --</option>
                                          <option ng-repeat="department_id in departmentData" value="{{department_id.department_id}}">{{department_id.department_name}}</option>
                                    </select>
                                    <span class="help-block" ng-show="showMsgs && myform.department_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                            </div>
                        </div>
                        <!--<div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_department');?></label>
                                <span class="mandatory">*</span>
                                <?php 
                                    $attrib = 'class="form-control select2" id="department_id" ng-model="department_id" required ';
                                    echo form_dropdown('department_id', $departmentDropdown, set_value('department_id', (isset($department_id)) ? $department_id : ''), $attrib);
                                    if(form_error('department_id')){ echo '<span class="help-block">'.form_error('department_id').'</span>';} 
                                ?>
                                <span class="help-block" ng-show="showMsgs && myform.department_id.$error.required"><?php echo $this->lang->line('required');?></span>    
                            </div>
                        </div>-->
                    </div>
                    <div class="row">
                        <div class="col-md-12" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_designation', <?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'designationData' )">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_designation');?></label>
                                <span class="mandatory"> * </span>                                        
                                    <select name="designation_id" ng-init="designation_id = '<?php echo $designation_id; ?>'" ng-model="designation_id" id="designation_id" class="form-control"  required select2>
                                          <option value="">-- Select --</option>
                                          <option ng-repeat="designation_id in designationData" value="{{designation_id.designation_id}}">{{designation_id.designation_name}}</option>
                                    </select>
                                    <span class="help-block" ng-show="showMsgs && myform.designation_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                            </div>
                        </div>

                        <!--<div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_designation');?></label>
                                <span class="mandatory"> * </span>
                                <?php 
                                    $attrib = 'class="form-control select2" id="designation_id" ng-model="designation_id" required ';
                                    echo form_dropdown('designation_id', $designationDropdown, set_value('designation_id', (isset($designation_id)) ? $designation_id : ''), $attrib);
                                    if(form_error('designation_id')){ echo '<span class="help-block">'.form_error('designation_id').'</span>';} 
                                ?>
                                <span class="help-block" ng-show="showMsgs && myform.designation_id.$error.required"><?php echo $this->lang->line('required');?></span>
                            </div>
                        </div>-->
                    </div>
                </div>                            
            </div> 
        </fieldset>             
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="salary_slip_based_on_timesheet" id="salary_slip_based_on_timesheet" value="1" onchange="loadFrequency()" <?php echo ($salary_slip_based_on_timesheet =='1')?'checked':'' ?>/>
                        <?php echo $this->lang->line('label_salary_slip_based');?>                                    
                    </label>                              
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <fieldset>
            <legend> <span> <?php echo $this->lang->line('label_select_payroll_period');?> </span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_start_date');?></label>
                        <span class="mandatory"> * </span>
                        <input type="text" show-button-bar="false" name="start_date" uib-datepicker-popup="{{format}}" ng-model="start_date" is-open="popup2.opened"  ng-required="false" name="start_date" ng-focus="open('popup2')" data-ng-init="init('<?php echo $start_date?>', 'start_date')"  data-name="start_date" id="start_date" class="form-control" value = "<?php echo $start_date;?>"  required/>

                        <!--<input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="start_date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" value="{{start_date | date:'dd-MM-yyyy' }}" name="start_date"  ng-focus="open('popup1')"/>-->
                        <span class="help-block" ng-show="showMsgs && myform.start_date.$error.required"><?php echo $this->lang->line('required');?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_end_date');?></label>
                        <span class="mandatory"> * </span>
                        <input type="text" show-button-bar="false" name="end_date" uib-datepicker-popup="{{format}}" ng-model="end_date" is-open="popup3.opened"  ng-required="false" name="end_date" ng-focus="open('popup3')" data-ng-init="init('<?php echo $end_date?>', 'end_date')"  data-name="end_date" id="end_date" class="form-control" value = "<?php echo $end_date;?>"  required/>

                        <!--<input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="end_date" is-open="popup3.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" value="{{end_date | date:'dd-MM-yyyy' }}" name="end_date"  ng-focus="open('popup3')"/>-->
                        <span class="help-block" ng-show="showMsgs && myform.end_date.$error.required"><?php echo $this->lang->line('required');?></span>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend> <span> <?php echo $this->lang->line('label_accounts');?> </span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_cost_center');?>
                                <a class="add-new-popup" onclick="">+</a> 
                        </label> 
                        <?php 
                            $attrib = 'class="form-control select2" id="cost_center_id"';
                            echo form_dropdown('cost_center_id', $projectDropdown, set_value('cost_center_id', (isset($cost_center_id)) ? $cost_center_id : ''), $attrib);
                            if(form_error('cost_center_id')){ echo '<span class="help-block">'.form_error('cost_center_id').'</span>';}
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_project');?>
                            <a class="add-new-popup" onclick="">+</a>   
                        </label>                                    
                        <?php 
                            $attrib = 'class="form-control select2" id="project_id"';
                            echo form_dropdown('project_id', $projectDropdown, set_value('project_id', (isset($project_id)) ? $project_id : ''), $attrib);
                            if(form_error('project_id')){ echo '<span class="help-block">'.form_error('project_id').'</span>';}
                        ?>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend> <span> <?php echo $this->lang->line('label_payment_entry');?> </span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('label_payment_accounts');?></label>                            
                                <?php 
                            $attrib = 'class="form-control select2" id="account_account_type_id"';
                            echo form_dropdown('account_account_type_id', $accountsDropdown, set_value('account_account_type_id', (isset($account_account_type_id)) ? $account_account_type_id : ''), $attrib);
                            if(form_error('account_id')){ echo '<span class="help-block">'.form_error('account_id').'</span>';}
                        ?>
                            </div>
                        </div>
                    </div>      
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend> <span> <?php echo $this->lang->line('label_process_payroll');?> </span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <button class="btn btn-info" type="button"  onclick = "bulkEmployeeSalary()"><?php echo $this->lang->line('label_cerate_salary_slip');?></button> <br/>
                        <!--<?php echo $this->lang->line('label_create_salary_slip_for_above_mentioned_criteria');?>-->     
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                        <button class="btn btn-success" type="submit" name="submit" ng-click="$ctrl.submit_form('myform')"> <?php echo $this->lang->line('label_submit_salary_slip');?></button> <br/>
                    </div>
                </div>
            </div>
            <div class="row" id="create_slip" style="display: none;">
                <div class="col-md-12">
                    <label><?php echo $this->lang->line('label_create_salary_slip_for_above_mentioned_criteria');?></label>
                </div>
            </div>                      
        </fieldset>
        
        <!--Submit/Cancel Buttons-->
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
            <button class="btn btn-danger" type="reset" name="reset"> <?php echo $this->lang->line('label_cancel');?></button>
        </div>-->
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function ()
    {
        loadFrequency();
    });
</script>