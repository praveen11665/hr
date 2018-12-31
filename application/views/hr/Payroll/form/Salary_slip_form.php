<?php
$ci =&get_instance();
$namingSeriesdrop                   =   $ci->mdrop->namingSeriesdrop('185');
$letterHeadDropdown                 =   $ci->mcommon->Dropdown('set_letter_head', array('letter_head_id as Key', 'letter_head_name as Value'),array('is_delete' =>'0'));
$joinArr                            =   array('hr_employee as em' => 'em.employee_id = sm.employee_id');
$employeeDropdown                   =   $ci->mcommon->Dropdown('hr_salary_structure_select_employee sm', array('sm.employee_id as Key', 'em.employee_number as Value'), array('sm.is_delete' => 0), '', '', '', '', $joinArr);
$payrollFrquencyDropdown            =  $ci->mcommon->Dropdown('def_hr_payroll_frquency', array('payroll_frequency_id as Key', 'payroll_frequency as Value'));
$StatusDropdown                     =  $ci->mcommon->Dropdown('def_hr_salary_slip_status', array('salary_slip_status_id as Key', 'status as Value'));
$SalaryStructureDropdown            =  $ci->mcommon->Dropdown('hr_salary_structure', array('salary_structure_id as Key', 'name as Value'),array('is_delete' =>'0'));
$EarningDropdown                    =  $ci->mcommon->Dropdown('hr_salary_component', array('salary_component_id as Key', 'salary_component as Value'),array('salary_component_type_id' =>'1','is_delete' =>'0'));
$DeductionDropdown                  =  $ci->mcommon->Dropdown('hr_salary_component', array('salary_component_id as Key', 'salary_component as Value'),array('salary_component_type_id' =>'2','is_delete' =>'0'));//Variable Initialize
$TimesheetDropdown                  =  $ci->mcommon->Dropdown('man_timesheet', array('timesheet_id as Key', 'naming_series as Value'),array('is_delete' =>'0'));

$salary_slip_id                     =   "";
$posting_date                       =   "";
$employee_id                        =   "";
$employee_name                      =   "";
$designation                        =   "";
$branch                             =   "";
$company                            =   "";
$letter_head                        =   "";
$start_date                         =   "";
$end_date                           =   "";
$payroll_frequency_id               =   "";
$working_days                       =   "";
$leave_without_pay                  =   "";
$payment_days                       =   "";
$component                          =   "";
$abbr                               =   "";
$statistical_component              =   "";
$formula                            =   "";
$amount                             =   "";
$gross_pay                          =   "";
$total_deduction                    =   "";
$net_pay                            =   "";
$rounded_total                      =   "";
$statistical_component_earing       =   array();
$salary_slip_deduction_id           =   array(); 
$salary_component_id_deduction      =   array();
$statistical_component_deduction    =   array();
$formula_deduction                  =   array();
$amount_deduction                   =   array();
$abbr_deduction                     =   array();
$salary_slip_earning_id             =   array();

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $salary_slip_id          =  $row->salary_slip_id;
        $naming_series           =  $row->naming_series;
        //$posting_date            =  date('d-m-Y', strtotime($row->posting_date));
        $posting_date            =  $row->posting_date;
        $employee_id             =  $row->employee_id;
        $employee_name           =  $row->employee_name;
        $designation             =  $row->designation;
        $department              =  $row->department;
        $branch                  =  $row->branch;
        $company                 =  $row->company;
        $base                    =  $row->base;
        $letter_head_id          =  $row->letter_head_id;
        $start_date              =  date('d-m-Y', strtotime($row->start_date));
        //$start_date              =  $row->start_date;
        $end_date                =  date('d-m-Y', strtotime($row->end_date));
        //$end_date                =  $row->end_date;
        $payroll_frequency_id    =  $row->payroll_frequency_id;
        $salary_structure_id     =  $row->salary_structure_id;
        $working_days            =  $row->working_days;
        $total_working_hours     =  $row->total_working_hours;
        $hour_rate               =  $row->hour_rate;
        $leave_without_pay       =  $row->leave_without_pay;
        $payment_days            =  $row->payment_days;
        $bank_name               =  $row->bank_name;
        $bank_account_no         =  $row->bank_account_no;
        //$gross_pay               =  $row->gross_pay;
        $total_deduction         =  $row->total_deduction;
        //$net_pay                 =  $row->net_pay;
        $rounded_total           =  $row->rounded_total;  
        $salary_slip_based_on_timesheet            =  $row->salary_slip_based_on_timesheet;
        $salary_slip_status_id   =  $row->salary_slip_status_id;
        $total_working_days      =  $row->total_working_days;
    }

    $naming_seriesArr =   explode('/', $naming_series);
    foreach ($naming_seriesArr as $key => $value) 
    {
        $set_options    =   $naming_seriesArr[0];
    }
    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '185'), 'naming_series_id');

    $naming_option      =   $source_id."_".$set_options; 
}
else
{
    $salary_slip_id          = $this->input->post('salary_slip_id');
    $posting_date            = $this->input->post('posting_date');
    $employee_id             = $this->input->post('employee_id');
    $employee_name           = $this->input->post('employee_name');
    $designation             = $this->input->post('designation');
    $department              = $this->input->post('department');
    $branch                  = $this->input->post('branch');
    $company                 = $this->input->post('company');
    $letter_head             = $this->input->post('letter_head');
    $start_date              = $this->input->post('start_date');
    $base                    = $this->input->post('base');
    $end_date                = $this->input->post('end_date');
    $payroll_frequency       = $this->input->post('payroll_frequency');
    $working_days            = $this->input->post('working_days');
    $leave_without_pay       = $this->input->post('leave_without_pay');
    $payment_days            = $this->input->post('payment_days');
    $component               = $this->input->post('component');
    $abbr                    = $this->input->post('abbr');
    //$statistical_component   = $this->input->post('statistical_component');
    $formula                 = $this->input->post('formula'); 
    $amount                  = $this->input->post('amount');
    $gross_pay               = $this->input->post('gross_pay');
    $total_deduction         = $this->input->post('total_deduction');
    $net_pay                 = $this->input->post('net_pay');
    $rounded_total           = $this->input->post('rounded_total');            
}

if(!empty($TimesheetData))
{
    foreach ($TimesheetData as $row) 
    {
            $employee_id          =  $row->employee_id;

            $total_working_hours          =  $row->total_hours;
    }
    foreach ($EmployeeData as $row)
    {
        $name                           =  $row->name;
        $salary_structure_id            =  $row->salary_structure_id;
        $hour_rate                      =   $ci->mcommon->specific_row_value('hr_salary_structure',  array('salary_structure_id' => $salary_structure_id),'hour_rate');
        $company_id                     =  $row->company_id;
        $salary_structure_is_active_id  =  $row->salary_structure_is_active_id;
        $letter_head_id                 =  $row->letter_head_id;
        $payroll_frequency_id           =  $row->payroll_frequency_id;        
        $salary_slip_based_on_timesheet =  $row->salary_slip_based_on_timesheet;
        $mode_of_payment_id             =  $row->mode_of_payment_id;
        $payment_account                =  $row->payment_account;

    }  
    $salary_slip_based_on_timesheet  =1;
}

if(!empty($EarningData))
{
    foreach($EarningData as $row)
    {
        $salary_slip_earning_id[]       =  $row->salary_slip_earning_id;
        $salary_component_id_earing[]   =  $row->salary_component_id;
        $statistical_component_earing[] =  $row->statistical_component; 
        $formula_earing[]               =  $row->formula; 
        $amount_earing[]                =  $row->amount; 
        $abbr_earing[]                  =  $row->abbr;
        $trowEar++;
    }
}
else
{
    $salary_component_id_earing                =   $this->input->post('salary_component_id_earing[]');
    $abbr_earing                               =   $this->input->post('abbr_earing');  
    $statistical_component_earing              =   $this->input->post('statistical_component_earing');  
    $formula_earing                            =   $this->input->post('formula_earing');
    $amount_earing                             =   $this->input->post('amount_earing');      
    $salary_structure_id                       =   $this->input->post('salary_structure_id');   
}

if(!empty($DeductionData))
{
    foreach($DeductionData as $row)
    {
        $salary_slip_deduction_id[]        =  $row->salary_slip_deduction_id;
        $salary_component_id_deduction[]   =  $row->salary_component_id;
        $statistical_component_deduction[] =  $row->statistical_component; 
        $formula_deduction[]               =  $row->formula; 
        $amount_deduction[]                =  $row->amount; 
        $abbr_deduction[]                  =  $row->abbr;
        $trowDed++;
    }
}
else
{
    $salary_component_id_deduction        =   $this->input->post('salary_component_id_deduction');
    $abbr_deduction                       =   $this->input->post('abbr_deduction');  
    $statistical_component_deduction      =   $this->input->post('statistical_component_deduction');  
    $formula_deduction                    =   $this->input->post('formula_deduction');
    $amount_deduction                     =   $this->input->post('amount_deduction');      
    $salary_structure_id                  =   $this->input->post('salary_structure_id');   
}

$trowEar           = count($salary_component_id_earing) ? count($salary_component_id_earing) :'1';
$trowDed           = count($salary_component_id_deduction) ? count($salary_component_id_deduction) :'1';
$checkDisable      = ($salary_slip_id == '') ? 'disabled' : '';
?>
<style type="text/css">
    .scrollHidden  {
      overflow: hidden;
    }
</style>
<div ng-app="myApp" ng-controller="myCtrl" id="checkDropdown">                    
    <form action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">    
        <input type="hidden" name="salary_slip_id" id="salary_slip_id" value="<?php echo $salary_slip_id;?>" >
        <input type="hidden" name="base" id="base" value="<?php echo $base;?>" >
         <div class="row">
            <div class="col-md-6" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/185')">
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
                    <label><?php echo $this->lang->line('label_posting_date');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" show-button-bar="false" name="posting_date" uib-datepicker-popup="{{format}}" ng-model="posting_date" is-open="popup1.opened"  ng-required="false" name="posting_date" ng-focus="open('popup1')" data-ng-init="init('<?php echo $posting_date?>', 'posting_date')"  data-name="posting_date" id="posting_date" class="form-control" value = "<?php echo $posting_date;?>" required/>
                    <!--<input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="posting_date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="false" close-text="Close" alt-input-formats="altInputFormats" value="{{posting_date | date:'dd-MM-yyyy' }}" name="posting_date" ng-focus="open('popup1')"/>-->
                    <span class="help-block" ng-show="showMsgs && myform.posting_date.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error('posting_date')?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_salary_slip_status', '', 'statusData' )" >
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_status');?></label>
                    <span class="mandatory"> * </span>                                        
                        <select name="salary_slip_status_id" ng-init="salary_slip_status_id = '<?php echo $salary_slip_status_id; ?>'" ng-model="salary_slip_status_id" id="salary_slip_status_id" class="form-control"  required select2>
                              <option value="">-- Select --</option>
                              <option ng-repeat="salary_slip_status_id in statusData" value="{{salary_slip_status_id.salary_slip_status_id}}">{{salary_slip_status_id.status}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.salary_slip_status_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                </div>
            </div>

            <!--<div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_status');?></label>
                        <span class="mandatory"> * </span>
                        <?php 
                            $attrib = 'class="form-control " id="salary_slip_status_id" required ng-model="salary_slip_status_id" select2';
                            echo form_dropdown('salary_slip_status_id', $StatusDropdown, set_value('salary_slip_status_id', (isset($salary_slip_status_id)) ? $salary_slip_status_id : '1'), $attrib);
                            if(form_error('salary_slip_status_id')){ echo '<span class="help-block">'.form_error('salary_slip_status_id').'</span>';} 
                        ?> 
                        <span class="help-block" ng-show="showMsgs && myform.salary_slip_status_id.$error.required"><?php echo $this->lang->line('required');?></span>
                    </div>
                </div>-->

            <!--<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_salary_structure_select_employee', <?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'langData' )" >
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_id');?></label>
                    <span class="mandatory"> * </span>                                        
                        <select name="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" ng-model="employee_id" id="employee_id" class="form-control"  required select2>
                              <option value="">-- Select --</option>
                              <option ng-repeat="employee_id in langData" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                </div>
            </div>-->
            <div class="col-md-6">
                 <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_id');?></label>
                    <span class="mandatory"> * </span>
                    <?php 
                        $attrib = 'class="form-control employee_id" id="employee_id" onchange ="salaryStructureEmployee(this.value)" select2 required';
                        echo form_dropdown('employee_id', $employeeDropdown, set_value('employee_id', (isset($employee_id)) ? $employee_id : ''), $attrib);
                        if(form_error('employee_id')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';} 
                    ?> 
                    <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_company');?></label>
                    <input type="text" name="company" id="company_id" value="<?php echo $company;?>" class="form-control" readonly />
                    <span class="help-block"><?php echo form_error('company')?></span>
                </div>
            </div>
            <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_name');?></label>
                    <input type="text" name="employee_name" id="employee_name" value="<?php echo $employee_name;?>" class="form-control" readonly />
                    <span class="help-block"><?php echo form_error('')?></span>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_letter_head');?></label>
                    <a class="add-new-popup" onclick="">+</a>
                    <?php 
                        $attrib = 'class="form-control " id="letter_head_id" select2';
                        echo form_dropdown('letter_head_id', $letterHeadDropdown, set_value('letter_head_id', (isset($letter_head_id)) ? $letter_head_id : ''), $attrib);
                        if(form_error('letter_head_id')){ echo '<span class="help-block">'.form_error('letter_head_id').'</span>';} 
                    ?> 
                </div>  
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label><?php echo $this->lang->line('label_department');?></label>
                    <input type="text" name="department" id="department_id" value="<?php echo $department ;?>" class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('letter_department')?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_salary_structure', <?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'structureData' )" >
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_is_salary_structure');?></label>
                    <span class="mandatory"> * </span>                                        
                        <select name="salary_structure_id" ng-init="salary_structure_id = '<?php echo $salary_structure_id; ?>'" ng-model="salary_structure_id" id="salary_structure_id" class="form-control"  required select2>
                              <option value="">-- Select --</option>
                              <option ng-repeat="salary_structure_id in structureData" value="{{salary_structure_id.salary_structure_id}}">{{salary_structure_id.name}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.salary_structure_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                </div>
            </div>

            <!--<div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_is_salary_structure');?></label>
                    <span class="mandatory"> * </span>
                     <?php 
                        $attrib = 'class="form-control " id="salary_structure_id" onchange ="getComponent(this.value)" required ng-model="salary_structure_id" select2';
                        echo form_dropdown('salary_structure_id', $SalaryStructureDropdown, set_value('salary_structure_id', (isset($salary_structure_id)) ? $salary_structure_id : ''), $attrib);
                        if(form_error('salary_structure_id')){ echo '<span class="help-block">'.form_error('salary_structure_id').'</span>';} 
                    ?>
                    <span class="help-block" ng-show="showMsgs && myform.salary_structure_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>-->
            <div class="col-md-6">
                 <div class="form-group">
                    <label><?php echo $this->lang->line('label_designation');?></label>
                    <input type="text" name="designation" id="designation_id" value="<?php echo $designation;?>" class="form-control" readonly />
                    <span class="help-block"><?php echo form_error('designation')?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_branch');?></label>
                    <input type="text" name="branch" id="branch_id" value="<?php echo $branch;?>" class="form-control" readonly />
                    <span class="help-block"><?php echo form_error('branch')?></span>
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <hr>

        <div class="row">
            <div  class="col-md-6">
                 <div class="form-group">
                    <label>
                        <input type="checkbox" name="salary_slip_based_on_timesheet"  id="salary_slip_based_on_timesheet"  onclick="showContent(this, '.MaintainingSalaryContent')" value="1" <?php echo ($salary_slip_based_on_timesheet =='1')?'checked':'' ?>/>       
                            <?php echo $this->lang->line('label_salary_slip_based_ts');?>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div  class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_start_date');?></label>
                    <span class="mandatory">*</span>
                    <input type='text' name="start_date" ng-model="start_date" ng-init="start_date = '<?php echo $start_date; ?>'" id="start_date" class="single-from form-control" value="<?php echo $start_date;?>" required onchange="calculateWorkingdays()"/>

                    <!--<input type="text" name="start_date" uib-datepicker-popup="{{format}}" ng-model="start_date" is-open="popup2.opened" ng-required="false" name="start_date" ng-focus="open('popup2')" data-ng-init="init('<?php echo $start_date?>', 'start_date')"  data-name="start_date" id="start_date" class="form-control" value = "<?php echo $start_date;?>"  required/> -->                   
                    <span class="help-block" ng-show="showMsgs && myform.start_date.$error.required"><?php echo $this->lang->line('required');?></span>                   
                     <span class="help-block"><?php echo form_error('start_date')?></span>
                </div>
            </div>
            <div  class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_end_date');?></label>
                    <span class="mandatory">*</span>
                    <input type='text' name="end_date" ng-model="end_date" ng-init="end_date = '<?php echo $end_date; ?>'" id="end_date" class="single-to form-control" value="<?php echo $end_date;?>" required onchange="calculateWorkingdays()"/>

                    <!--<input type="text" name="end_date" uib-datepicker-popup="{{format}}" ng-model="end_date" is-open="popup3.opened" ng-required="false" name="end_date" ng-focus="open('popup3')" data-ng-init="init('<?php echo $end_date?>', 'end_date')"  data-name="end_date" id="end_date" class="form-control" value = "<?php echo $end_date;?>"  required/>-->

                    <span class="help-block" ng-show="showMsgs && myform.end_date.$error.required"><?php echo $this->lang->line('required');?></span>                    
                    <span class="help-block"><?php echo form_error('end_date')?></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_payroll_frquency', '', 'payrollData' )" >
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_payroll_frequency');?></label>
                    <span class="mandatory"> * </span>                                        
                        <select name="payroll_frequency_id" ng-init="payroll_frequency_id = '<?php echo $payroll_frequency_id; ?>'" ng-model="payroll_frequency_id" id="payroll_frequency_id" class="form-control"  required select2 ><!--onchange="salaryslipGetToDate()"-->
                        <option value="">-- Select --</option>
                        <option ng-repeat="payroll_frequency_id in payrollData" value="{{payroll_frequency_id.payroll_frequency_id}}">{{payroll_frequency_id.payroll_frequency}}</option>
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.payroll_frequency_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                </div>
            </div>

            <!--<div  class="col-md-6">
             <div class="form-group">
                    <label><?php echo $this->lang->line('label_payroll_frequency');?></label>
                    <span class="mandatory"> * </span>
                    <?php 
                        $attrib = 'class="form-control " id="payroll_frequency_id" onchange="salaryslipGetToDate()" required ng-model="payroll_frequency_id" select2';
                        echo form_dropdown('payroll_frequency_id', $payrollFrquencyDropdown, set_value('payroll_frequency_id', (isset($payroll_frequency_id)) ? $payroll_frequency_id : ''), $attrib);
                        if(form_error('payroll_frequency_id')){ echo '<span class="help-block">'.form_error('payroll_frequency_id').'</span>';} 
                    ?> 
                    <span class="help-block" ng-show="showMsgs && myform.payroll_frequency_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div> 
            </div>-->

            <div  class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_working_days');?></label>
                    <input type="text" name="total_working_days" id="total_working_days" value="<?php echo $total_working_days;?>"  class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('total_working_days')?></span>
                </div>
            </div>
        </div>

        <div class="row"> 
            <div  class="col-md-4">
                <div class="form-group">
                    <label>Total Holiday</label>
                    <input type="text" name="total_holidays" id="total_holidays" value="<?php echo $total_holidays;?>" class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('total_holidays')?></span>
                </div>
            </div>

            <div  class="col-md-4">
                <div class="form-group">
                    <!--<label><?php echo $this->lang->line('label_depands_on_leave');?></label>-->
                    <label>Total Leave</label>
                    <input type="text" name="leave_without_pay" id="leave_without_pay" value="<?php echo $leave_without_pay;?>" class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('leave_without_pay')?></span>
                </div>
            </div>

            <div  class="col-md-4">
                <div class="form-group">
                    <!--<label><?php echo $this->lang->line('label_depands_on_leave');?></label>-->
                    <label>Allowed Leaves</label>
                    <input type="text" name="allowed_leaves" id="allowed_leaves" value="<?php echo $allowed_leaves;?>" class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('allowed_leaves')?></span>
                </div>
            </div>

            <div  class="col-md-4">
                <div class="form-group">
                    <!--<label><?php echo $this->lang->line('label_depands_on_leave');?></label>-->
                    <label>LOP</label>
                    <input type="text" name="lop" id="lop" value="<?php echo $lop;?>" class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('lop')?></span>
                </div>
            </div>

            <div  class="col-md-4">
                <div class="form-group">
                    <!--<label><?php echo $this->lang->line('label_depands_on_leave');?></label>-->
                    <label>LOP Amount</label>
                    <input type="text" name="lop_amount" id="lop_amount" value="<?php echo $lop_amount;?>" class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('lop_amount')?></span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_payment_days');?></label>
                    <input type="text" name="payment_days" id="payment_days" value="<?php echo $payment_days;?>" class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('payment_days')?></span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Per Day Salary</label>
                    <input type="text" name="per_day_salary" id="per_day_salary" class="form-control" value="<?php echo $per_day_salary;?>" readonly/>
                    <span class="help-block"><?php echo form_error('')?></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Base Salary</label>
                    <input type="text" name="base_salary" id="base_salary" class="form-control" value="<?php echo $base_salary;?>" readonly/>
                </div>
            </div>           
        </div>

        <?php $checkBoxClass = ($salary_slip_based_on_timesheet == '1') ? 'block': 'none'; ?>
        <span style="display: <?php echo $checkBoxClass;?>"  class="MaintainingSalaryContent">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_total_working_hours');?></label>
                        <input type="text" name="total_working_hours" id="total_working_hours" class="form-control" value="<?php echo $total_working_hours;?>" readonly/>
                        <span class="help-block"><?php echo form_error('')?></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Per Hour Salary</label>
                        <input type="text" name="per_hour_salary" id="per_hour_salary" class="form-control" value="<?php echo $per_hour_salary;?>" readonly/>
                    </div>
                </div>
                <!--<div class="col-md-4">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_hour_rate');?></label>
                        <input type="text" name="hour_rate" id="hour_rate" value="<?php echo $hour_rate;?>" onkeyup ="calculateWorkingdays()" class="form-control" />
                        <span class="help-block"><?php echo form_error('letter_department')?></span>
                    </div>
                </div>-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Total Hour Rate</label>
                        <input type="text" name="hour_rate" id="hour_rate" value="<?php echo $base_salary;?>" class="form-control" readonly/>
                        <span class="help-block"><?php echo form_error('hour_rate')?></span>
                    </div>
                </div>
            </div>
        </span>
        <!-- <div class="row">
            <div class="col-md-6">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th><input type="checkbox" ></th>
                            <th><?php echo lang('label_Timesheet');?></th>
                            <th><?php echo lang('label_working_hours');?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="EarningData">
                            <?php 
                                $is=1;
                                for($in=0; $in < 1; $in++)
                                {
                                ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="salary_slip_timesheet_id[]" value="<?php echo $salary_slip_timesheet_id[$in];?>" class ="new_row_delete" >
                                            <input type="hidden" name="salary_slip_timesheet_id[]" class="" value="<?php echo $salary_slip_timesheet_id[$in];?>">
                                        </td>
                                        <td>
                                            <?php
                                                $attrib = 'class="form-control " data-name="timesheet_id" id="timesheet_id'.$in.'" data-row="'.$in.'';
                                                echo form_dropdown('timesheet_id[]', $TimesheetDropdown, set_value('timesheet_id['.$in.']', (isset($timesheet_id[$in])) ? $timesheet_id[$in] : ''), $attrib);
                                            ?>
                                        </td>
                                        <td>
                                            <input type="text" name="working_hours[]"  data-name="working_hours" id="working_hours<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo$working_hours[$in];?>" class="form-control" readonly/>
                                        </td>
                                        <td> <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl1;?>');" name="">Details</button> </td>    
                                    </tr>
                                <?php                      
                                $is++;
                                } 
                            ?> 
                        </tbody>
                         <tfoot>
                            <tr>
                                <td colspan="7">                           
                               <button class="btn btn-primary" type="button" onclick="addNewRow('EarningData');" > + Add Row </button>
                               <input type="button" class="btn btn-danger" name="" value="Delete" onclick="addRowDelete('EarningData', 'new_row_delete', 'hr_salary_slip_earning', 'salary_slip_earning_id');">  
                                </td>
                            </tr>
                        </tfoot>
                    </table>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_total_working_hours');?></label>
                    <input type="text" name="" class="form-control" />
                    <span class="help-block"><?php echo form_error('')?></span>
                </div>
                <br>
                 <div class="form-group">
                        <label><?php echo $this->lang->line('label_hour_rate');?></label>
                        <span class="mandatory"> * </span>
                        <input type="text" name="" id="" value="<?php echo $hour_rate;?>" class="form-control" />
                        <span class="help-block"><?php echo form_error('letter_department')?></span>
                </div>
            </div>
        </div>-->
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_company_bank_details');?></span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_bank_name');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" name="bank_name" id="bank_name" value="<?php echo $bank_name;?>" class="form-control" ng-model="bank_name" ng-init="bank_name = '<?php echo $bank_name;?>'" required allow-characters maxlength="20"/>
                    <span class="help-block" ng-show="showMsgs && myform.bank_name.$error.required"><?php echo $this->lang->line('required');?></span> 
                    <span class="help-block"><?php echo form_error('bank_name')?></span>
                </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_bank_account_number');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" name="bank_account_no" id="bank_account_no" value="<?php echo $bank_account_no;?>" class="form-control" ng-model="bank_account_no" ng-init="bank_account_no = '<?php echo $bank_account_no;?>'" required onkeypress="return isNumberKey(event)" maxlength="20"/>
                    <span class="help-block" ng-show="showMsgs && myform.bank_account_no.$error.required"><?php echo $this->lang->line('required');?></span> 
                    <span class="help-block"><?php echo form_error('bank_account_no')?></span>
                </div>
                    
                </div>
            </div>
        </fieldset>
        
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_earning');?></span></legend>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id = "Earning">
                        <thead>
                            <tr>
                                <!--<th><input type="checkbox" name="" class="form-control"></th>-->
                                <th></th>
                                <th><?php echo lang('label_component');?> <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $dropdownUrllink;?>');">+</a> </th>
                                <th><?php echo lang('label_abbr');?></th>
                                <th><?php echo lang('label_statistical_component');?></th>
                                <th><?php echo lang('label_formula');?> (base*n)</th>
                                <th><?php echo lang('label_amount');?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="EarningData">
                            <?php 
                                for($in=0; $in < $trowEar; $in++)
                                {
                                ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="salary_slip_earning_id[]" value="<?php echo $salary_slip_earning_id[$in];?>" class ="earn_row_delete" onclick="checkDeleteButton('earn_row_delete', 'earn_delete');" <?php echo $checkDisable;?>>
                                            <input type="hidden" name="salary_slip_earning_id[]" class="" value="<?php echo $salary_slip_earning_id[$in];?>">
                                        </td>
                                        <td>
                                            <?php
                                                $attrib = 'class="form-control " data-name="salary_component_id_earing" id="salary_component_id_earing'.$in.'" data-row="'.$in.'" onchange="loadSalaryearn_abbr(this.id,this.value)"';
                                                echo form_dropdown('salary_component_id_earing[]', $EarningDropdown, set_value('salary_component_id_earing['.$in.']', (isset($salary_component_id_earing[$in])) ? $salary_component_id_earing[$in] : ''), $attrib);
                                            ?>
                                        </td>
                                        <td>
                                            <input type="text" name="abbr_earing[]"   data-name="salary_component_abbr_earing" id="salary_component_abbr_earing<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo $abbr_earing[$in];?>" class="form-control"/>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="statistical_component_earing[<?php echo $in;?>]"   data-name="ear_statistical_component" id="ear_statistical_component<?php echo $in;?>" data-row="<?php echo $in;?>" value="1" <?php if($statistical_component_earing[$in] == 1){ echo 'checked = "checked"';} ?>/>
                                        </td>
                                        <td>
                                        <textarea row="5" columns="10" name="formula_earing[]"  data-name="ear_formular" id="ear_formular<?php echo $in;?>" data-row="<?php echo $in;?>" class="form-control"><?php echo $formula_earing[$in];?></textarea>
                                        </td>
                                        <td>
                                            <input type="text" name="amount_earing[]"  data-name="ear_amount" id="ear_amount<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo$amount_earing[$in];?>" class="form-control amountEaring" readonly/>
                                        </td>
                                        <td> <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl1;?>');" name=""><?php echo $this->lang->line('label_Details');?></button> </td>    
                                    </tr>
                                <?php                      
                                } 
                            ?> 
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">                           
                                    <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('EarningData');" > <?php echo $this->lang->line('label_add_row');?></button>
                                    <input type="button" class="btn btn-danger btn-sm earn_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('EarningData', 'earn_row_delete', 'hr_salary_slip_earning', 'salary_slip_earning_id');" disabled>  
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend><span><?php echo $this->lang->line('label_deduction');?></span></legend>
            <div class="row">
                <div class="col-md-12">                
                    <table class="table table-bordered" id="Deduction">
                        <thead>
                            <tr>
                                <!--<th><input type="checkbox" name="" class="form-control"></th>-->
                                <th></th>
                                <th><?php echo lang('label_component');?> <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $dropdownUrllink;?>');">+</a> </th>
                                <th><?php echo lang('label_abbr');?></th>
                                <th><?php echo lang('label_statistical_component');?></th>
                                <th><?php echo lang('label_formula');?> (base*n)</th>
                                <th><?php echo lang('label_amount');?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="DeductionData">
                        <?php 
                            for($in=0; $in < $trowDed; $in++)
                            {
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="salary_slip_deduction_id[]" value="<?php echo $salary_slip_deduction_id[$in];?>" class ="dedu_row_delete" onclick="checkDeleteButton('dedu_row_delete', 'dedu_delete');" <?php echo $checkDisable;?>>
                                        <input type="hidden" name="salary_slip_deduction_id[]" class="" value="<?php echo $salary_slip_deduction_id[$in];?>">
                                    </td>
                                    <td>
                                        <?php
                                            $attrib = 'class="form-control " data-name="salary_component_id_deduction" id="salary_component_id_deduction'.$in.'" data-row="'.$in.'" onchange="loadSalarydeduct_abbr(this.id,this.value)"';
                                            echo form_dropdown('salary_component_id_deduction[]', $DeductionDropdown, set_value('salary_component_id_deduction['.$in.']', (isset($salary_component_id_deduction[$in])) ? $salary_component_id_deduction[$in] : ''), $attrib);
                                        ?>
                                    </td>
                                    <td>
                                        <input type="text" name="abbr_deduction[]" data-name="salary_component_abbr_deduction" id="salary_component_abbr_deduction<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo $abbr_deduction[$in];?>" class="form-control"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="statistical_component_deduction[<?php echo $in;?>]"   data-name="statistical_component_deduction" id="statistical_component_deduction<?php echo $in;?>" data-row="<?php echo $in;?>" value="1" <?php if($statistical_component_deduction[$in] == 1){ echo 'checked = "checked"';} ?>/>
                                    </td>
                                    <td>
                                        <textarea row="5" columns="10" name="formula_deduction[]"  data-name="formula_deduction" id="formula_deduction<?php echo $in;?>" data-row="<?php echo $in;?>" class="form-control"><?php echo $formula_deduction[$in];?></textarea>
                                    </td>
                                    <td>
                                        <input type="text" name="amount_deduction[]"  data-name="amount_deduction" id="amount_deduction<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo$amount_deduction[$in];?>" class="form-control" readonly/>
                                    </td>
                                    <td> <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl2;?>');" name=""><?php echo $this->lang->line('label_Details');?></button> </td>    
                                </tr>
                                <?php                      
                            } 
                        ?> 
                        <?php 
                            /*for($in=0; $in < $trowDed; $in++)
                            {
                            ?>      
                            <tr>
                                <td>
                                    <input type="checkbox" name="salary_slip_deduction_id[]" value = "<?php echo $salary_slip_deduction_id[$in] ;?>" class="new_row_delete">
                                    <input type="hidden" name="salary_slip_deduction_id[]" class="" value="<?php echo $salary_slip_deduction_id[$in];?>">
                                </td>
                                <td>
                                    <?php
                                    $attrib = 'class="form-control " data-name="salary_component_id_deduction" id="salary_component_id_deduction'.$in.'" data-row="'.$in.'" onchange="loadSalarydeduct_abbr(this.id,this.value)"';
                                    echo form_dropdown('salary_component_id_deduction[]', $DeductionDropdown, set_value('salary_component_id_deduction['.$in.']', (isset($salary_component_id_deduction[$in])) ? $salary_component_id_deduction[$in] : ''), $attrib);?>
                                </td>
                                <td>
                                    <input type="text" name="abbr_deduction[]" data-name="salary_component_abbr_deduction" id="salary_component_abbr_deduction<?php echo $in;?>" data-row="<?php echo $in;?>"  value="<?php echo $abbr_deduction[$in];?>" class="form-control" readonly/>                                    
                                </td>
                                <td>
                                    <input type="checkbox" name="statistical_component_deduction[<?php echo $in;?>]" data-name="statistical_component_deduction" id="statistical_component_deduction<?php echo $in;?>" data-row="<?php echo $in;?>"
                                    value="1" <?php if($statistical_component_deduction[$in] == 1) { echo 'checked = "checked"';} ?> />
                                </td>
                                <td>
                                     <textarea name="formula_deduction[]" row="5"  data-name="formula_deduction" id="formula_deduction<?php echo $in;?>" data-row="<?php echo $in;?> columns="10" class="form-control"><?php echo$formula_deduction[$in];?></textarea>
                                </td>
                                <td>
                                    <input type="text" name="amount_deduction[]"  data-name="amount_deduction" id="amount_deduction<?php echo $in;?>" data-row="<?php echo $in;?>""  value="<?php echo $amount_deduction[$in];?>" class="form-control amount_deduction" readonly/>
                                </td>
                                <td> 
                                    <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl2;?>');" name=""><?php echo $this->lang->line('label_Details');?></button> 
                                </td>    
                            </tr>
                            <?php                     
                            }*/ 
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">                           
                               <button class="btn btn-primary" type="button" onclick="addNewRow('DeductionData');" > <?php echo $this->lang->line('label_add_row');?> </button>
                               <input type="button" class="btn btn-danger dedu_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('DeductionData', 'dedu_row_delete', 'hr_salary_slip_deduction', 'salary_slip_deduction_id');" disabled>  
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
           </div>
        </fieldset>
        <input type="hidden" name="total_earing" id="total_earing">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_gross_pay');?></label>
                    <input type="text" name="gross_pay" id="gross_pay" class="form-control"  value="<?php echo $gross_pay;?>" readonly="readonly" />
                    <span class="help-block"><?php echo form_error('gross_pay')?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_total_deduction');?></label>
                    <input type="text" name="total_deduction" id="total_deduction" class="form-control" value="<?php echo $total_deduction;?>" readonly/>
                    <span class="help-block"><?php echo form_error('total_deduction')?></span>
                </div>
            </div>
        </div>
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_net_pay_informaton');?></span></legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_net_pay');?></label>
                            <input type="text" name="net_pay" id="net_pay" value="<?php echo $net_pay;?>" class="form-control" 
                            value= "<?php echo $net_pay;?>" readonly  />
                            <span class="help-block"><?php echo form_error('net_pay')?></span>
                        </div>
                    </div> 
                    <div class="col-md-6">   
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_rounded_total');?></label>
                            <input type="text" name="rounded_total" id="rounded_total" class="form-control"  value="<?php echo $net_pay;?>" readonly/>
                            <span class="help-block"><?php echo form_error('rounded_total')?></span>
                        </div>
                    </div>
                </div>
        </fieldset>
        <div class="modal-footer">
            <a href="<?php echo base_url('hr/Payroll/Salary_slip'); ?>" class="btn btn-danger"><?php echo $this->lang->line('label_cancel');?></a>
            <button class="btn btn-primary" ng-click="submited('myform')" type="submit"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>
<script type="text/javascript">
   $(document).ready(function(){   

    $("html").removeClass("scrollHidden");

    $('#checkDropdown').on('select2:open', function (e) {
        $("html").addClass("scrollHidden");
    });

    $('#checkDropdown').on('select2:close', function (e) {
        $("html").removeClass("scrollHidden");
    });
});
</script>