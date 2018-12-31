<?php
$employee_id                        ='';
$naming_series                      ='';
$salutation_id                      ='';
$employee_name                      ='';
$company_id                         ='';
$user_id                            ='';
$image                              ='';
$employee_number                    ='';
$date_of_joining                    ='';
$date_of_birth                      ='';
$gender_id                          ='';

$emp_bank_details_id                ='';
$bank_name                          ='';
$bank_ac_no                         ='';
$ifsc_code                          ='';
$branch                             ='';

$emp_contact_details_id             ='';
$employee_preferred_contact_email_id='';
$cell_number                        ='';
$personal_email                     ='';
$unsubscribed                       ='';
$person_to_be_contacted             ='';
$relation                           ='';
$emergency_phone_number             ='';
$employee_permanent_address_id      ='';
$permanent_address                  ='';
$employee_current_address_id        ='';
$current_address                    ='';

$emp_educational_details_id         = '';
$school_university                  = array();
$qualification                      = array();
$employee_level_id                  = array();
$year_of_passing                    = array();
$class_per                          = '';
$maj_opt_subj                       = '';

$emp_employment_details_id          ='';
$employee_status_id                 ='';
$employment_type_id                 ='';
$holiday_list_id                    ='';
$offer_date                         ='';
$scheduled_confirmation_date        ='';
$final_confirmation_date            ='';
$contract_end_date                  ='';
$date_of_retirement                 ='';

$emp_exit_id                        ='';
$resignation_letter_date            ='';
$relieving_date                     ='';
$reason_for_leaving                 ='';
$employee_leave_en_cashed_id        ='';
$encashment_date                    ='';

$emp_exit_interview_id              ='';
$held_on                            ='';
$reason_for_resignation             ='';
$new_workplace                      ='';
$feedback                           ='';

$emp_external_work_experience_id    = array();
$company_name                       = array();
$designation                        = array();
$salary                             = array();
$address                            = array();
$contact                            = array();
$total_experience                   = array();

$emp_history_in_company_id          = array();
$branch_id                          = '';
$department_id                      = '';
$designation_id                     = '';
$from_date                          = array();
$to_date                            = array();

$emp_insurance_id                   ='';
$insurance_company                  ='';
$start_date                         ='';
$end_date                           ='';
$policy_number                      ='';


$emp_job_profile_id                 ='';
$branch_id                          ='';
$department_id                      ='';
$designation_id                     ='';
$company_email                      ='';
$notice_number_of_days              ='';
$employee_salary_mode_id            ='';

$emp_personal_details_id            ='';
$passport_number                    ='';
$date_of_issue                      ='';
$valid_upto                         ='';
$place_of_issue                     ='';
$marital_status_id                  ='';
$blood_group_id                     ='';
$family_background                  ='';
$health_details                     ='';

$emp_organization_profile_id        = array();
$reports_to                         ='';
$leave_approver_id                  = array();
$history_department_id              = array();
$history_designation_id             = array();
$history_branch_id                  = array();

$resignation_letter_date            = '';
$relieving_date                     = '';
$reason_for_leaving                 = '';
$employee_leave_en_cashed_id        = '';
$encashment_date                    = '';

$held_on                            = '';
$reason_for_resignation             = '';
$new_workplace                      = '';
$feedback                           = '';

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $employee_id                    =   $row->employee_id;
        $naming_series                  =   $row->naming_series;
        $salutation_id                  =   $row->salutation_id;
        $company_id                     =   $row->company_id;
        $employee_number                =   $row->employee_number;
        $date_of_joining                =   $row->date_of_joining;
        $date_of_birth                  =   $row->date_of_birth;
        $employee_name                  =   $row->employee_name;        
        $gender_id                      =   $row->gender_id;        
        $user_id                        =   ($row->user_id) ? $row->user_id : '';  
        $employee_profile               =   $row->employee_profile;    
    }

    $naming_seriesArr =   explode('/', $naming_series);
    foreach ($naming_seriesArr as $key => $value) 
    {
        $set_options    =   $naming_seriesArr[0];
    }
    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '3'), 'naming_series_id');

    $naming_option      =   $source_id."_".$set_options;
}
else
{
    $employee_id                    =   $this->input->post('employee_id');
    $salutation_id                  =   $this->input->post('salutation_id');
    $user_id                        =   $this->input->post('user_id');
    $gender_id                      =   $this->input->post('gender_id');
    $employee_number                =   $this->input->post('employee_number');
    $date_of_joining                =   $this->input->post('date_of_joining');
    $date_of_birth                  =   $this->input->post('date_of_birth');
    $employee_name                  =   $this->input->post('employee_name');
}

if(!empty($EmployeeContent))
{
    foreach ($EmployeeContent as $row )
    {
        $holiday_list_id                 =   $row->holiday_list_id;
        $employee_id                     =   $row->employee_id;
        $employee_status_id              =   $row->employee_status_id;
        $offer_date                      =   $row->offer_date;
        $final_confirmation_date         =   $row->final_confirmation_date;
        $contract_end_date               =   $row->contract_end_date;
        $date_of_retirement              =   $row->date_of_retirement;
        $employment_type_id              =   $row->employment_type_id;        
    }
}
else
{
    $employee_id                     =   $this->input->post('employee_id');
    $holiday_list_id                 =   $this->input->post('holiday_list_id');
    $employee_status_id              =   $this->input->post('employee_status_id');
    $offer_date                      =   $this->input->post('offer_date');
    $final_confirmation_date         =   $this->input->post('final_confirmation_date');
    $contract_end_date               =   $this->input->post('contract_end_date');
    $date_of_retirement              =   $this->input->post('date_of_retirement');
    $employment_type_id              =   $this->input->post('employment_type_id'); 
}

if(!empty($jobprofileContent))
{
    foreach ($jobprofileContent as $row )
    {
        $employee_id                    =   $row->employee_id;
        $department_id                  =   $row->department_id;
        $designation_id                 =   $row->designation_id;
        $branch_id                      =   $row->branch_id;
        $company_email                  =   $row->company_email;
        $employee_salary_mode_id        =   $row->employee_salary_mode_id;
        $notice_number_of_days          =   $row->notice_number_of_days;
    }
}
else
{
    $employee_id                    =   $this->input->post('employee_id');
    $department_id                  =   $this->input->post('department_id');
    $designation_id                 =   $this->input->post('designation_id');
    $branch_id                      =   $this->input->post('branch_id');
    $company_email                  =   $this->input->post('company_email');
    $employee_salary_mode_id        =   $this->input->post('employee_salary_mode_id');
    $notice_number_of_days          =   $this->input->post('notice_number_of_days');
}
 
if(!empty($contactContent))
{
    foreach ($contactContent as $row )
    {
        $employee_id                            =   $row->employee_id;
        $employee_preferred_contact_email_id    =   $row->employee_preferred_contact_email_id;
        $cell_number                            =   $row->cell_number;
        $personal_email                         =   $row->personal_email;
        $unsubscribed                           =   $row->unsubscribed;
        $person_to_be_contacted                 =   $row->person_to_be_contacted;
        $relation                               =   $row->relation;
        $emergency_phone_number                 =   $row->emergency_phone_number;
        $permanent_address                      =   $row->permanent_address;
        $employee_permanent_address_id          =   $row->employee_permanent_address_id;
        $employee_current_address_id            =   $row->employee_current_address_id;
        $current_address                        =   $row->current_address;
        $contact_person_name                    =   $row->contact_person_name;
    }
}
else
{
    $employee_id                            =   $this->input->post('employee_id');
    $employee_preferred_contact_email_id    =   $this->input->post('employee_preferred_contact_email_id');
    $cell_number                            =   $this->input->post('cell_number');
    $personal_email                         =   $this->input->post('personal_email');
    $unsubscribed                           =   $this->input->post('unsubscribed');
    $person_to_be_contacted                 =   $this->input->post('person_to_be_contacted');
    $relation                               =   $this->input->post('relation');
    $emergency_phone_number                 =   $this->input->post('emergency_phone_number');
    $permanent_address                      =   $this->input->post('permanent_address');
    $employee_permanent_address_id          =   $this->input->post('employee_permanent_address_id');
    $employee_current_address_id            =   $this->input->post('employee_current_address_id');
    $current_address                        =   $this->input->post('current_address');
    $contact_person_name                    =   $this->input->post('contact_person_name');
}

if(!empty($bankcontent))
{
    foreach ($bankcontent as $row )
    {
        $employee_id                            =   $row->employee_id;
        $bank_ac_no                             =   $row->bank_ac_no;
        $bank_name                              =   $row->bank_name;
        $ifsc_code                              =   $row->ifsc_code;
        $branch                                 =   $row->branch;
    }
}
else
{
    $employee_id                            =   $this->input->post('employee_id');
    $bank_ac_no                             =   $this->input->post('bank_ac_no');
    $bank_name                              =   $this->input->post('bank_name');
    $ifsc_code                              =   $this->input->post('ifsc_code');
    $branch                                 =   $this->input->post('branch');
}

if(!empty($InsuranceContent))
{
    foreach ($InsuranceContent as $row )
    {
        $employee_id                           =   $row->employee_id;
        $insurance_company                     =   $row->insurance_company;
        $start_date                            =   date('d-m-Y', strtotime($row->start_date));
        $end_date                              =   date('d-m-Y', strtotime($row->end_date));
        $policy_number                         =   $row->policy_number;
    }
}
else
{
    $employee_id                           =   $this->input->post('employee_id');
    $insurance_company                     =   $this->input->post('insurance_company');
    $start_date                            =   $this->input->post('start_date');
    $end_date                              =   $this->input->post('end_date');
    $policy_number                         =   $this->input->post('policy_number');
}

if(!empty($PersonalContent))
{
    foreach ($PersonalContent as $row )
    {
        $employee_id                           =   $row->employee_id;
        $passport_number                       =   $row->passport_number;
        $date_of_issue                         =   $row->date_of_issue;
        $valid_upto                            =   $row->valid_upto;
        $place_of_issue                        =   $row->place_of_issue;
        $marital_status_id                     =   $row->marital_status_id;
        $blood_group_id                        =   $row->blood_group_id;
        $health_details                        =   $row->health_details;
    }
}
else
{
    $employee_id                           =   $this->input->post('employee_id');
    $insurance_company                     =   $this->input->post('insurance_company');
    $date_of_issue                         =   $this->input->post('date_of_issue');
    $valid_upto                            =   $this->input->post('valid_upto');
    $place_of_issue                        =   $this->input->post('place_of_issue');
    $marital_status_id                     =   $this->input->post('marital_status_id');
    $blood_group_id                        =   $this->input->post('blood_group_id');
    $health_details                        =   $this->input->post('health_details');
}

if(!empty($UserContent))
{
    foreach ($UserContent as $row )
    {       
        $emp_organization_profile_id[]            =   $row->emp_organization_profile_id;
        $reports_to                               =   $row->reports_to;
        $leave_approver_id[]                      =   $row->leave_approver_id;
        $trowUser++; 
    }
}
else
{
    $reports_to                           =   $this->input->post('reports_to');
    $leave_approver_id                    =   $this->input->post('leave_approver_id');
}

if(!empty($EducationContent))
{
    foreach ($EducationContent as $row )
    {       
        $emp_educational_details_id              =   $row->emp_educational_details_id;
        $employee_id                             =   $row->employee_id;
        $qualification[]                         =   $row->qualification;
        $school_university[]                     =   $row->school_university;
        $employee_level_id[]                     =   $row->employee_level_id;
        $year_of_passing[]                       =   $row->year_of_passing;
        $trowEdu++; 
    }
}
else
{
    $employee_id                           =   $this->input->post('employee_id');
    $qualification                         =   $this->input->post('qualification');
    $school_university                     =   $this->input->post('school_university');
    $employee_level_id                     =   $this->input->post('employee_level_id');
    $year_of_passing                       =   $this->input->post('year_of_passing');
}

if(!empty($histroyContent))
{
    foreach ($histroyContent as $row )
    {
        $emp_history_in_company_id[]              =   $row->emp_history_in_company_id;
        $history_department_id[]                  =   $row->department_id;
        $history_designation_id[]                 =   $row->designation_id;
        $history_branch_id[]                      =   $row->branch_id;
        $from_date[]                              =   date('d-m-Y', strtotime($row->from_date));
        $to_date[]                                =   date('d-m-Y', strtotime($row->to_date));
        $trowHis++;
    }
}
else
{
    $emp_history_in_company_id              =   $this->input->post('emp_history_in_company_id');
    $employee_id                            =   $this->input->post('employee_id');
    $history_department_id                  =   $this->input->post('history_department_id');
    $from_date                              =   $this->input->post('from_date');
    $to_date                                =   $this->input->post('to_date');
    $history_designation_id                 =   $this->input->post('history_designation_id');
    $history_branch_id                      =   $this->input->post('history_branch_id');
}

if(!empty($ExternalContent))
{
    foreach ($ExternalContent as $row )
    {
        $emp_external_work_experience_id[]        =   $row->emp_external_work_experience_id;
        $designation[]                            =   $row->designation;
        $company_name[]                           =   $row->company_name;
        $salary[]                                 =   $row->salary;
        $address[]                                =   $row->address;
        $contact[]                                =   $row->contact;
        $total_experience []                      =   $row->total_experience;
        $trowEx++;
   }
}
else
{
    $employee_id                            =   $this->input->post('employee_id');
    $designation                            =   $this->input->post('designation');
    $company_name                           =   $this->input->post('company_name');
    $salary                                 =   $this->input->post('salary');
    $address                                =   $this->input->post('address');
    $contact                                =   $this->input->post('contact');
    $total_experience                       =   $this->input->post('total_experience');
}

if(!empty($exitContent))
{
    foreach ($exitContent as $row )
    {
        $employee_id                        = $row->employee_id;
        $resignation_letter_date            = $row->resignation_letter_date;
        $relieving_date                     = $row->relieving_date;
        $reason_for_leaving                 = $row->reason_for_leaving;
        $employee_leave_en_cashed_id        = $row->employee_leave_en_cashed_id;
        $encashment_date                    = $row->encashment_date;
    }
}else
{
    $resignation_letter_date            = $this->input->post('resignation_letter_date');
    $relieving_date                     = $this->input->post('relieving_date');
    $reason_for_leaving                 = $this->input->post('reason_for_leaving');
    $employee_leave_en_cashed_id        = $this->input->post('employee_leave_en_cashed_id');
    $encashment_date                    = $this->input->post('encashment_date');
}

if(!empty($exitInvContent))
{
    foreach ($exitInvContent as $row )
    {
        $employee_id               = $row->employee_id;
        $held_on                   = $row->held_on;
        $reason_for_resignation    = $row->reason_for_resignation;
        $new_workplace             = $row->new_workplace;
        $feedback                  = $row->feedback;
    }
}else
{
    $held_on                   = $this->input->post('held_on');
    $reason_for_resignation    = $this->input->post('reason_for_resignation');
    $new_workplace             = $this->input->post('new_workplace');
    $feedback                  = $this->input->post('feedback');
}

$trowUser      = count($leave_approver_id) ? count($leave_approver_id) :'1';
$trowHis       = count($emp_history_in_company_id) ? count($emp_history_in_company_id) :'1';
$trowEdu       = count($qualification) ? count($qualification) :'1';
$trowEx        = count($designation) ? count($designation) :'1';
$checkDisable  = ($employee_id == '') ? 'disabled' : '';

$ci =   &get_instance();
$namingSeriesdrop           =  $ci->mdrop->namingSeriesdrop(3);
$salutationDropdown         =  $ci->mcommon->Dropdown('hr_salutation', array('salutation_id as Key', 'salutation as Value'), array('is_delete' => 0));
$companyDropdown            =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'), array('is_delete' => 0));
$userDropdown               =  $ci->mcommon->Dropdown('users', array('user_id as Key', 'username  as Value'),array('auth_level' => 9));
$genderDropdown             =  $ci->mcommon->Dropdown('def_gender', array('gender_id as Key', 'gender  as Value'));
$statusDropdown             =  $ci->mcommon->Dropdown('def_hr_employee_status', array('employee_status_id as Key', 'status  as Value'));
$holidayListDropdown        =  $ci->mcommon->Dropdown('hr_holiday_list', array('holiday_list_id as Key', 'holiday_list_name  as Value'), array('is_delete' => 0));
$departmentDropdown         =  $ci->mcommon->Dropdown('hr_department', array('department_id as Key', 'department_name as Value'), array('is_delete' => 0));
$branchDropdown             =  $ci->mcommon->Dropdown('hr_branch', array('branch_id as Key', 'branch as Value'), array('is_delete' => 0));
$designationDropdown        =  $ci->mcommon->Dropdown('hr_designation', array('designation_id as Key', 'designation_name as Value'), array('is_delete' => 0));
$employeeDropdown           =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'naming_series as Value'),array('is_delete' => 0));
$currentAddressDropdown     =  $ci->mcommon->Dropdown('def_hr_employee_current_address', array('employee_current_address_id as Key', 'current_accommodation_type as Value'));
$permanentAddressDropdown   =  $ci->mcommon->Dropdown('def_hr_employee_permanent_address', array('employee_permanent_address_id as Key', 'permanent_accommodation_type as Value'));
$contactEmailDropdown       =  $ci->mcommon->Dropdown('def_hr_employee_preferred_contact_email', array('employee_preferred_contact_email_id as Key', 'preferred_contact_email as Value'));
$salaryModeDropdown         =  $ci->mcommon->Dropdown('def_hr_employee_salary_mode', array('employee_salary_mode_id as Key', 'salary_mode as Value'));
$leaveEnCashedDropdown      =  $ci->mcommon->Dropdown('def_hr_employee_leave_en_cashed', array('employee_leave_en_cashed_id as Key', 'leave_en_cashed as Value'));
$maritalStatusDropdown      =  $ci->mcommon->Dropdown('def_marital_status', array('marital_status_id as Key', 'marital_status as Value'));
$employeeLevelDropdown      =  $ci->mcommon->Dropdown('def_hr_employee_level', array('employee_level_id as Key', 'level as Value'));
$bloodgroupDropdown         =  $ci->mcommon->Dropdown('def_blood_group', array('blood_group_id as Key', 'blood_group as Value'));
$employmentType             =  $ci->mcommon->Dropdown('hr_employment_type', array('employment_type_id as Key', 'employment_type_name as Value'), array('is_delete' => 0));
?>
<style type="text/css">
    .scrollHidden  {
      overflow: hidden;
    }
</style>
<div ng-app="myApp" ng-controller="myCtrl" id="checkDropdown">
    <form action="<?php echo base_url($ActionUrl);?>" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform" enctype="multipart/form-data">
        <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id;?>">
        <div class="row">
            <div class="col-md-6" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/3')">
                <div class="form-group form-select">
                    <label for="naming_series_id"><?php echo $this->lang->line('label_series_name');?> </label> <span class="mandatory">*</span>
                    <a class="add-new-popup" ng-click="$ctrl.openSecond('lg', '', '<?php echo base_url($namingUrl);?>' )"><i class="popup"></i>+</a>                    
                    <select name="naming_series" ng-init="naming_series = '<?php echo $naming_option; ?>'" ng-model="naming_series" id="naming_series" class="form-control naming_series" required select2 onchange="genreteEmployeeId();">
                          <option value="">-- Select --</option>  
                          <option ng-repeat="naming_series_id in dropSeriesValues" value="{{naming_series_id.naming_series_id}}">{{naming_series_id.naming_series}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.naming_series.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-6" id="selectDiv">
               <div class="form-group">
                    <label><?php echo lang('label_employee_employee_number');?></label><span class="mandatory">*</span>
                    <?php $readOnlyEmpNum = ($employee_id) ? 'readonly' : 'readonly';?>
                    <input type="text" name="employee_number" id="employee_number" ng-init="employee_number = '<?php echo $employee_number; ?>'" ng-model="employee_number" maxlength="10" value="<?php echo $employee_number;?>" class="form-control" ng-keyup="checkUnique('../../../Common_controller/checkUnique/hr_employee', employee_number, 'employee_number')" required <?php echo $readOnlyEmpNum;?>/>
                    <span class="help-block" ng-show="showMsgs && myform.employee_number.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="showuniqueMsgs">{{employee_number}} already in use</span>
                    <span class="help-block"><?php echo form_error("employee_number")?></span>
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_salutation',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'salutaions' )" >
                <div class="form-group">
                    <label><?php echo lang('label_salutation');?></label>
                     <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $SalutationUrl;?>');"><i class="popup"></i>+</a>  
                    <span class="mandatory">*</span>
                    <!--<?php 
                        $attrib = 'class="form-control " id="salutation_id" name="salutation_id" ng-model="salutation_id" required ';
                        echo form_dropdown('salutation_id', $salutationDropdown, set_value('salutation_id', (isset($salutation_id)) ? $salutation_id : ''), $attrib);
                        if(form_error('salutation_id')){ echo '<span class="help-block">'.form_error('salutation_id').'</span>';} 
                    ?>-->
                    <select name="salutation_id" ng-init="salutation_id = '<?php echo $salutation_id; ?>'" ng-model="salutation_id" id="salutation_id" class="form-control" required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="salutation_id in salutaions" value="{{salutation_id.salutation_id}}">{{salutation_id.salutation}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.salutation_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('label_employee_date_of_joining');?></label>
                    <span class="mandatory">*</span>                        
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="date_of_joining" is-open="popup1.opened" datepicker-options="pastYearBlockOptions" ng-required="true" data-ng-init="init('<?php echo $date_of_joining?>', 'date_of_joining')" value="{{date_of_joining | date:'dd-MM-yyyy' }}" name="date_of_joining" ng-focus="open('popup1')" ng-change="checkJoiningDate()" id="date_of_joining"/>
                    <span class="help-block" ng-show="showMsgs && myform.date_of_joining.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="showjoiningMsgs">Date of Joining must be greater than Date of Birth</span>
                    <span class="help-block"><?php echo form_error('date_of_joining')?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('label_employee_full_name');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="employee_name" ng-init="employee_name = '<?php echo $employee_name; ?>'" allow-characters id="employee_name" value="<?php echo $employee_name;?>" class="form-control"  ng-model="employee_name" required maxlength="30"/>
                    <span class="help-block" ng-show="showMsgs && myform.employee_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error("employee_name")?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('label_employee_date_of_birth');?></label>
                    <span class="mandatory">*</span>
                        <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="date_of_birth" is-open="popup2.opened" datepicker-options="futureDateOptions" ng-required="true" data-ng-init="init('<?php echo $date_of_birth?>', 'date_of_birth')" value="{{date_of_birth | date:'dd-MM-yyyy' }}" name="date_of_birth" ng-focus="open('popup2')" id="date_of_birth" ng-change="checkJoiningDate()"/>
                    <span class="help-block" ng-show="showMsgs && myform.date_of_birth.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error('date_of_birth')?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'companies' )" >
                <div class="form-group">
                    <label><?php echo lang('label_employee_company');?></label>
                    <span class="mandatory">*</span>
                     <a class="add-new-popup"  onclick="addDropdownPopup('<?php echo $CompanyUrl;?>');"><i class="popup"></i>+</a>  
                    <!--<?php 
                        $attrib = 'class="form-control " id="company_id"  ng-model="company_id" required ';
                        echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);
                        if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} 
                    ?>-->
                    <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                </div>
            </div>
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_gender','' , 'genders' )" >
                <div class="form-group">
                    <label><?php echo lang('label_employee_gender');?></label>
                    <span class="mandatory">*</span>
                    <!--<?php 
                        $attrib = 'class="form-control " id="gender_id" ng-model="gender_id" required';
                        echo form_dropdown('gender_id', $genderDropdown, set_value('gender_id', (isset($gender_id)) ? $gender_id : ''), $attrib);
                        if(form_error('gender_id')){ echo '<span class="help-block">'.form_error('gender_id').'</span>';} 
                    ?>-->
                    <select name="gender_id" ng-init="gender_id = '<?php echo $gender_id; ?>'" ng-model="gender_id" id="gender_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="gender_id in genders" value="{{gender_id.gender_id}}">{{gender_id.gender}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.gender_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/users','' , 'users' )" >
                <div class="form-group">
                    <label><?php echo lang('label_employee_userid');?></label>
                    <!--<span class="mandatory">*</span>-->
                    <a class="add-new-popup" onclick="" ><i class="popup"></i>+</a> 
                    <select name="user_id" ng-init="user_id = '<?php echo $user_id; ?>'" ng-model="user_id" id="user_id" class="form-control" select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="user_id in users" value="{{user_id.user_id}}">{{user_id.username}}</option>
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.user_id.$error.required"><?php echo $this->lang->line('required');?></span>  
                </div> <!--System User(Login) ID,If set,It will become default for all HR forms-->
            </div>
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_employee_status','' , 'empStatuses' )" >
                <div class="form-group">
                    <label><?php echo lang('label_employee_Status');?></label><span class="mandatory">*</span>
                    <!--<span class="mandatory">*</span>
                    <?php 
                        $attrib = 'class="form-control " id="employee_status_id" onchange="showStatusContent(this.value)" ng-model="employee_status_id" required ';
                        echo form_dropdown('employee_status_id', $statusDropdown, set_value('employee_status_id', (isset($employee_status_id)) ? $employee_status_id : '1'), $attrib);
                        if(form_error('employee_status_id')){ echo '<span class="help-block">'.form_error('employee_status_id').'</span>';} 
                    ?>-->
                    <select name="employee_status_id" ng-init="employee_status_id = '<?php echo $employee_status_id; ?>'" ng-model="employee_status_id" id="employee_status_id" class="form-control" required select2>
                        <option value="">-- Select --</option>  <!--onchange="checkExitContent(this.value)"-->
                        <option ng-repeat="employee_status_id in empStatuses" value="{{employee_status_id.employee_status_id}}">{{employee_status_id.status}}</option>  
                    </select>
                        <span class="help-block" ng-show="showMsgs && myform.employee_status_id.$error.required"><?php echo $this->lang->line('required');?></span>                             
                    </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('label_employee_profile');?></label>
                    <input type="file" name="employee_profile" id="employee_profile" ng-model="employee_profile" ng-init="employee_profile = '<?php echo $employee_profile; ?>'" value="<?php echo$employee_profile;?>" class="form-control" valid-file/>
                    <div ng-messages="myform.employee_profile.$error" ng-if="myform.employee_profile.$touched">
                        <span class="help-block" ng-message="extension">Upload Image Files Only</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <?php 
            if($employee_profile != '')
            {
                ?>
                    <div class="form-group">
                        <input type="hidden" name="employee_profile" value="<?php echo $employee_profile;?>" />
                        <img src="<?php echo base_url().''.$employee_profile;?>" width="100" height="150" />          
                    </div>
                <?php
            }
            ?>
            </div>
        </div>

        <!--<div class="row">
            <div class="col-md-4">
                <a  class="btn btn-info" onclick="addTableContentPop('<?php echo $contentUrl;?>');"> <?php echo lang('label_create_user');?></a>
            </div>
        </div>--> 

        <!--ACTIVE CONTENT-->
        <div ng-if="employee_status_id == '1' || employee_status_id == ''">
            <fieldset>
                <legend> <span> <?php echo lang('label_employee_employment_details');?> </span> </legend>
                <div class="row">
                    <div class="col-md-6">           
                        <div class="form-group">
                            <label><?php echo lang('label_employee_offer_date');?></label>
                            <span class="mandatory">*</span>
                                <input type="text" class="form-control" show-button-bar="false" uib-datepicker-popup="{{format}}" ng-model="offer_date" is-open="popup3.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $offer_date?>', 'offer_date')" value="{{offer_date | date:'dd-MM-yyyy' }}" name="offer_date" ng-focus="open('popup3')"/>
                                <span class="help-block" ng-show="showMsgs && myform.offer_date.$error.required"><?php echo $this->lang->line('required');?></span> 
                            <span class="help-block"><?php echo form_error('offer_date')?></span>
                        </div>
                    </div>
                    <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employment_type',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employmentTypes' )" >
                        <div class="form-group">
                        <label><?php echo lang('label_employee_employee_type');?></label>
                        <span class="mandatory">*</span>
                         <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $EmploymentTypeUrl;?>');" ><i class="popup"></i>+</a>  
                        <!--<?php
                            $extraAttr="id='employment_type_id' class='form-control ' ng-model='employment_type_id'required ";
                            echo form_dropdown('employment_type_id', $employmentType, $employment_type_id, $extraAttr);
                        ?>--> 
                        <select name="employment_type_id" ng-init="employment_type_id = '<?php echo $employment_type_id; ?>'" ng-model="employment_type_id" id="employment_type_id" class="form-control" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="employment_type_id in employmentTypes" value="{{employment_type_id.employment_type_id}}">{{employment_type_id.employment_type_name}}</option>  
                        </select>
                            <span class="help-block" ng-show="showMsgs && myform.employment_type_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                            <span class="help-block"><?php echo form_error('employment_type_id')?></span>
                        </div>                            
                    </div>                     
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_confirmation_date');?></label>
                            <span class="mandatory">*</span>
                                <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="final_confirmation_date" is-open="popup4.opened" datepicker-options="pastYearBlockOptions" ng-required="true" data-ng-init="init('<?php echo $final_confirmation_date?>', 'final_confirmation_date')" value="{{final_confirmation_date | date:'dd-MM-yyyy' }}" name="final_confirmation_date" ng-focus="open('popup4')"/>
                                <span class="help-block" ng-show="showMsgs && myform.final_confirmation_date.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error('final_confirmation_date')?></span>
                        </div>
                    </div>
                    <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_holiday_list',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'holdiayLists' )" >
                        <div class="form-group checkClick">
                        <label><?php echo lang('label_employee_holiday_list');?></label>
                        <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $HolidayListeUrl;?>');"><i class="popup"></i>+</a>  
                        <span class="mandatory">*</span>
                        <!--<?php 
                            $attrib = 'class="form-control " id="holiday_list_id" ng-model="holiday_list_id" required';
                            echo form_dropdown('holiday_list_id', $holidayListDropdown, set_value('holiday_list_id', (isset($holiday_list_id)) ? $holiday_list_id : ''), $attrib);
                            if(form_error('holiday_list_id')){ echo '<span class="help-block">'.form_error('holiday_list_id').'</span>';} 
                        ?>-->
                        <select name="holiday_list_id[]" ng-init="holiday_list_id = '<?php echo $holiday_list_id; ?>'" ng-model="holiday_list_id" id="holiday_list_id" class="form-control" select2 multiple required>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="holiday_list_id in holdiayLists" value="{{holiday_list_id.holiday_list_id}}">{{holiday_list_id.holiday_list_name}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.holiday_list_id.$error.required"><?php echo $this->lang->line('required');?></span>  
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_contract_end_date');?></label>
                            <!--<span class="mandatory">*</span>-->
                                <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="contract_end_date" is-open="popup5.opened" datepicker-options="pastYearBlockOptions" ng-required="true" data-ng-init="init('<?php echo $contract_end_date?>', 'contract_end_date')" value="{{contract_end_date | date:'dd-MM-yyyy' }}" name="contract_end_date" ng-focus="open('popup5')"/>
                                <!--<span class="help-block" ng-show="showMsgs && myform.contract_end_date.$error.required"><?php echo $this->lang->line('required');?></span> -->
                                <span class="help-block"><?php echo form_error('contract_end_date')?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_date_of_retirement');?></label>
                            <!--<span class="mandatory">*</span>-->
                                <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="date_of_retirement" is-open="popup6.opened" datepicker-options="pastYearBlockOptions" ng-required="true" data-ng-init="init('<?php echo $date_of_retirement?>', 'date_of_retirement')" value="{{date_of_retirement | date:'dd-MM-yyyy' }}" name="date_of_retirement" ng-focus="open('popup6')"/>
                                <!--<span class="help-block" ng-show="showMsgs && myform.date_of_retirement.$error.required"><?php echo $this->lang->line('required');?></span>-->
                                <span class="help-block"><?php echo form_error('date_of_retirement')?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-md-6">     
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend> <span> <?php echo lang('label_employee_job_profile');?> </span></legend>
                <div class="row">
                    <div class="col-md-6" >
                        <div class="form-group" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_branch',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'branches' )" >
                        <label><?php echo lang('label_employee_branch');?></label> <span class="mandatory">*</span>
                        <!--<a class="add-new-popup" onclick="addDropdownPopup('<?php echo $BranchUrl;?>');" ><i class="popup"></i>+</a>  
                        <span class="mandatory">*</span>
                        <?php 
                            $attrib = 'class="form-control " id="branch_id" ng-model="branch_id" required';
                            echo form_dropdown('branch_id', $branchDropdown, set_value('branch_id', (isset($branch_id)) ? $branch_id : ''), $attrib);
                            if(form_error('branch_id')){ echo '<span class="help-block">'.form_error('branch_id').'</span>';} 
                        ?>-->
                        <select name="branch_id" ng-init="branch_id = '<?php echo $branch_id; ?>'" ng-model="branch_id" id="branch_id" class="form-control" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="branch_id in branches" value="{{branch_id.branch_id}}">{{branch_id.branch}}</option>  
                        </select>
                            <span class="help-block" ng-show="showMsgs && myform.branch_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>
                        <div class="form-group" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_department',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'depts' )" >
                            <label><?php echo lang('label_employee_department');?></label>
                            <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $DepartmentUrl;?>');" ><i class="popup"></i>+</a>  
                            <span class="mandatory">*</span>
                            <!--<?php 
                                $attrib = 'class="form-control " id="department_id" ng-model="department_id" required';
                                echo form_dropdown('department_id', $departmentDropdown, set_value('department_id', (isset($department_id)) ? $department_id : ''), $attrib);
                                if(form_error('department_id')){ echo '<span class="help-block">'.form_error('department_id').'</span>';} 
                            ?>-->
                            <select name="department_id" ng-init="department_id = '<?php echo $department_id; ?>'" ng-model="department_id" id="department_id" class="form-control"  required select2>
                                <option value="">-- Select --</option>  
                                <option ng-repeat="department_id in depts" value="{{department_id.department_id}}">{{department_id.department_name}}</option>  
                            </select>
                            <span class="help-block" ng-show="showMsgs && myform.department_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>
                        <div class="form-group" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_designation',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'desings' )" >
                            <label><?php echo lang('label_employee_designation');?></label>
                             <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $DesignationUrl;?>');" ><i class="popup"></i>+</a>  
                            <span class="mandatory">*</span>
                            <!--<?php 
                                $attrib = 'class="form-control " id="designation_id" ng-model="designation_id" required';
                                echo form_dropdown('designation_id', $designationDropdown, set_value('designation_id', (isset($designation_id)) ? $designation_id : ''), $attrib);
                                if(form_error('designation_id')){ echo '<span class="help-block">'.form_error('designation_id').'</span>';} 
                            ?>-->
                            <select name="designation_id" ng-init="designation_id = '<?php echo $designation_id; ?>'" ng-model="designation_id" id="designation_id" class="form-control"  required select2>
                                <option value="">-- Select --</option>  
                                <option ng-repeat="designation_id in desings" value="{{designation_id.designation_id}}">{{designation_id.designation_name}}</option>  
                            </select>
                            <span class="help-block" ng-show="showMsgs && myform.designation_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('label_company_email');?></label>
                            <span class="mandatory">*</span>
                            <input type="email" name="company_email" ng-init="company_email = '<?php echo $company_email; ?>'" id="company_email" value="<?php echo $company_email?>" class="form-control" ng-model="company_email" required maxlength="30"/>
                            <span class="help-block" ng-show="showMsgs && myform.company_email.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block" ng-show="myform.company_email.$error.email"><?php echo $this->lang->line('email_val');?></span>
                            <span class="help-block"><?php echo form_error("company_email")?></span>
                            <!--Provide Email Address Registered in company-->
                        </div>
                         <div class="form-group">
                            <label><?php echo lang('label_notice');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="notice_number_of_days" onkeypress="return isNumberKey(event)" maxlength = "2" ng-init="notice_number_of_days = '<?php echo $notice_number_of_days; ?>'" id="notice_number_of_days" value="<?php echo $notice_number_of_days?>" class="form-control" ng-model="notice_number_of_days" required/>
                            <span class="help-block" ng-show="showMsgs && myform.notice_number_of_days.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error("notice_number_of_days")?></span>
                            <!--Provide Email Address Registered in company-->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_employee_salary_mode','' , 'salModes' )" >
                            <label><?php echo lang('label_employee_salary_mode');?></label>
                            <span class="mandatory">*</span>
                            <!--<?php 
                            $attrib = 'class="form-control " id="" onchange="showSelectContent2(this.value,\'bankDetails\')"  ng-model="employee_salary_mode_id" required';
                            echo form_dropdown('employee_salary_mode_id', $salaryModeDropdown, set_value('employee_salary_mode_id', (isset($employee_salary_mode_id)) ? $employee_salary_mode_id : ''), $attrib);?>
                            <?PHP if(form_error('employee_salary_mode_id')){ echo '<span class="help-block">'.form_error('employee_salary_mode_id').'</span>';} ?>-->
                            <select name="employee_salary_mode_id" ng-init="employee_salary_mode_id = '<?php echo $employee_salary_mode_id; ?>'" ng-model="employee_salary_mode_id" id="employee_salary_mode_id" class="form-control" onchange="showSelectContent2(this.value,'bankDetails')" required select2>
                                <option value="">-- Select --</option>  
                                <option ng-repeat="employee_salary_mode_id in salModes" value="{{employee_salary_mode_id.employee_salary_mode_id}}">{{employee_salary_mode_id.salary_mode}}</option>  
                            </select>
                            <span class="help-block" ng-show="showMsgs && myform.employee_salary_mode_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>
                        <?php $styleBank = ($employee_salary_mode_id == 1) ? 'block' : 'none';?>
                        <span style="display: <?php echo $styleBank;?>" id="bankDetails">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_bank_name');?>   </label>
                            <span class="mandatory">*</span>
                            <input type="text" name="bank_name" ng-init="bank_name = '<?php echo $bank_name; ?>'" id="bank_name" value="<?php echo $bank_name;?>" class="form-control" ng-model="bank_name" <?php echo ($employee_salary_mode_id == 1) ? 'required' :'' ?> maxlength="25" allow-characters/>
                            <span class="help-block" ng-show="showMsgs && myform.bank_name.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error("bank_name")?></span>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('label_employee_bank_account_number');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="bank_ac_no"  maxlength="20" ng-init="bank_ac_no = '<?php echo $bank_ac_no; ?>'" id="bank_ac_no" value="<?php echo $bank_ac_no;?>" class="form-control" ng-model="bank_ac_no" <?php echo ($employee_salary_mode_id == 1) ? 'required' :'' ?> onkeypress="return isNumberKey(event)"/>
                            <span class="help-block" ng-show="showMsgs && myform.bank_ac_no.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error("bank_ac_no")?></span>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('label_employee_IFSC_code');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="ifsc_code" ng-init="ifsc_code = '<?php echo $ifsc_code; ?>'" id="ifsc_code" value="<?php echo $ifsc_code;?>" class="form-control" ng-model="ifsc_code" <?php echo ($employee_salary_mode_id == 1) ? 'required' :'' ?> maxlength="20" onkeypress="return IsAlphaNumeric(event)"/>
                            <span class="help-block" ng-show="showMsgs && myform.ifsc_code.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error("ifsc_code")?></span>
                        </div>
                        <div class="form-group">
                            <label><?php echo lang('label_employee_branch');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="branch" ng-init="branch = '<?php echo $branch; ?>'" id="branch" value="<?php echo $branch;?>" class="form-control" ng-model="branch" <?php echo ($employee_salary_mode_id == 1) ? 'required' :'' ?> maxlength="20" allow-characters/>
                            <span class="help-block" ng-show="showMsgs && myform.branch.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error("branch")?></span>
                        </div>
                        </span>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend> <span> <?php echo lang('label_employee_organization_profile_heading');?> </span></legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employee',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employees' )" >
                            <label><?php echo lang('label_repots_to');?></label>
                            <a class="add-new-popup"><i class="popup"></i>+</a>  
                            <!--<?php 
                                $attrib = 'class="form-control " id="reports_to"';
                                echo form_dropdown('reports_to', $employeeDropdown, set_value('reports_to', (isset($reports_to)) ? $reports_to : ''), $attrib);
                                if(form_error('reports_to')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';} 
                            ?>--> 
                            <select name="reports_to" ng-init="reports_to = '<?php echo $reports_to; ?>'" ng-model="reports_to" id="reports_to" class="form-control" select2>
                                <option value="">-- Select --</option>  
                                <option ng-repeat="employee_id in employees" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option>  
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        The first Leave Approver in the list will be set as Default Leave Approver
                        <table  class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <!--<th><input type="checkbox" name=""></th>-->
                                    <th><label><?php echo lang('label_employee_leave_approved_by');?></label>
                                        <a class="add-new-popup"><i class="popup"></i>+</a>
                                    </th>                                        
                                    <!--<th></th>-->
                                </tr>
                            </thead>
                            <tbody id="leave_appvoer_details">
                            <?php 
                            $is=1;
                            for($in=0; $in < $trowUser; $in++)
                            {
                                ?>
                                <tr>
                                    <td> <input type="checkbox" name="emp_organization_profile_id[]" value="<?php echo $emp_organization_profile_id[$in];?>" class="new_row_delete" onclick="checkDeleteButton('new_row_delete', 'app-delete');" <?php echo $checkDisable;?>></td>
                                    <td> 
                                        <?php 
                                            $attrib = 'class="form-control" id="leave_approver_id"';
                                            echo form_dropdown('leave_approver_id', $userDropdown, set_value('leave_approver_id[$in]', (isset($leave_approver_id[$in])) ? $leave_approver_id[$in] : ''), $attrib);
                                            if(form_error('leave_approver_id')){ echo '<span class="help-block">'.form_error('user_id').'</span>';} 
                                        ?> 
                                    </td>                                        
                                    <!--<td> <a class="btn btn-inverse" onclick="addTableContentPop('<?php echo $contentUrl;?>');" name=""><?php echo lang('label_Details');?></a>
                                    </td>-->
                                </tr>
                                <?php                      
                                $is++;
                                } 
                            ?>
                            </tbody> 
                            <tfoot>
                                <th colspan="3">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('leave_appvoer_details');" ><?php echo lang('label_add_row');?></button>
                                    <input type="button" class="btn btn-danger btn-sm app-delete" name="" value="Delete" onclick="addRowDelete('leave_appvoer_details', 'new_row_delete', 'hr_emp_organization_profile', 'emp_organization_profile_id');" disabled>
                                </th>
                            </tfoot>                
                        </table>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend><span><?php echo lang('label_employee_contact_details');?></span></legend>
                <div class="row">
                    <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_employee_preferred_contact_email','' , 'conEmails' )">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_preferred_contact_email');?></label>
                            <span class="mandatory">*</span>
                            <!--<?php 
                                $attrib = 'class="form-control " id="employee_preferred_contact_email_id" ng-model="employee_preferred_contact_email_id" required';
                                echo form_dropdown('employee_preferred_contact_email_id', $contactEmailDropdown, set_value('employee_preferred_contact_email_id', (isset($employee_preferred_contact_email_id)) ? $employee_preferred_contact_email_id : ''), $attrib);
                                if(form_error('employee_preferred_contact_email_id')){ echo '<span class="help-block">'.form_error('employee_preferred_contact_email_id').'</span>';} 
                            ?>-->
                            <select name="employee_preferred_contact_email_id" ng-init="employee_preferred_contact_email_id = '<?php echo $employee_preferred_contact_email_id; ?>'" ng-model="employee_preferred_contact_email_id" id="employee_preferred_contact_email_id" class="form-control" required select2>
                                <option value="">-- Select --</option>  
                                <option ng-repeat="employee_preferred_contact_email_id in conEmails" value="{{employee_preferred_contact_email_id.employee_preferred_contact_email_id}}">{{employee_preferred_contact_email_id.preferred_contact_email}}</option>  
                            </select>
                            <span class="help-block" ng-show="showMsgs && myform.employee_preferred_contact_email_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>
                    </div>
                    <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_employee_permanent_address','' , 'empAddress' )">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_permanent_address_is');?></label>
                            <span class="mandatory">*</span>
                            <!--<?php 
                                $attrib = 'class="form-control " id="employee_permanent_address_id" ng-model="employee_permanent_address_id" required';
                                echo form_dropdown('employee_permanent_address_id', $permanentAddressDropdown, set_value('employee_permanent_address_id', (isset($employee_permanent_address_id)) ? $employee_permanent_address_id : ''), $attrib);
                                if(form_error('employee_permanent_address_id')){ echo '<span class="help-block">'.form_error('employee_permanent_address_id').'</span>';} 
                            ?>-->
                            <select name="employee_permanent_address_id" ng-init="employee_permanent_address_id = '<?php echo $employee_permanent_address_id; ?>'" ng-model="employee_permanent_address_id" id="employee_permanent_address_id" class="form-control"  required select2>
                                <option value="">-- Select --</option>  
                                <option ng-repeat="employee_permanent_address_id in empAddress" value="{{employee_permanent_address_id.employee_permanent_address_id}}">{{employee_permanent_address_id.permanent_accommodation_type}}</option>  
                            </select>
                            <span class="help-block" ng-show="showMsgs && myform.employee_permanent_address_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_phone_number');?></label>
                               <input type="text" name="cell_number" onkeypress="return isNumberKey(event)"maxlength="10" ng-init="cell_number = '<?php echo $cell_number; ?>'" maxlength="10" id="cell_number" value="<?php echo $cell_number;?>" class="form-control"  onkeypress="return isNumberKey(event)"/>  
                                <span class="help-block"><?php echo form_error('cell_number')?></span>
                        </div>
                    </div>                                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_personal_email_id');?></label>
                            <input type="email" name="personal_email" ng-model="personal_email" ng-init="personal_email = '<?php echo $personal_email; ?>'" id="personal_email" value="<?php echo $personal_email;?>" class="form-control" maxlength="30"/>
                            <span class="help-block" ng-show="myform.personal_email.$error.email"><?php echo $this->lang->line('email_val');?></span>
                            <span class="help-block"><?php echo form_error("personal_email")?></span>
                        </div>
                     </div>                                
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_contact_person_name');?></label>
                            <input type="text" name="person_to_be_contacted" id="person_to_be_contacted" allow-characters maxlength="45" ng-init="person_to_be_contacted = '<?php echo $person_to_be_contacted; ?>'" value="<?php echo $person_to_be_contacted;?>" class="form-control" maxlength="20"/>
                             <span class="help-block"><?php echo form_error("person_to_be_contacted")?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_relation');?></label>                        
                            <input type="text" name="relation" id="relation" allow-characters maxlength="45" ng-init="relation = '<?php echo $relation; ?>'" value="<?php echo $relation;?>" class="form-control"/>
                            <span class="help-block"><?php echo form_error("relation")?></span>
                        </div>
                    </div>
                    <!--<div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_emergency_contact');?></label>                                
                            <input type="text" name="contact_person_name" maxlength="10" ng-init="contact_person_name = '<?php echo $contact_person_name; ?>'" id="contact_person_name" value="<?php echo $contact_person_name;?>" class="form-control" onkeypress="return isNumberKey(event)"/>
                            <span class="help-block"><?php echo form_error("emergency_phone_number")?></span>
                        </div>
                    </div>-->
                    <div class="col-md-6">
                        <div class="form-group" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_employee_current_address','' , 'curAddress' )" >
                            <label><?php echo lang('label_employee_current_Address_is');?></label>
                            <span class="mandatory">*</span>
                            <!--<?php 
                                $attrib = 'class="form-control " id="employee_current_address_id" ng-model="employee_current_address_id" required';
                                echo form_dropdown('employee_current_address_id', $currentAddressDropdown, set_value('employee_current_address_id', (isset($employee_current_address_id)) ? $employee_current_address_id : ''), $attrib);
                                if(form_error('employee_current_address_id')){ echo '<span class="help-block">'.form_error('employee_current_address_id').'</span>';} 
                            ?>-->
                            <select name="employee_current_address_id" ng-init="employee_current_address_id = '<?php echo $employee_current_address_id; ?>'" ng-model="employee_current_address_id" id="employee_current_address_id" class="form-control"  required select2>
                                <option value="">-- Select --</option>  
                                <option ng-repeat="employee_current_address_id in curAddress" value="{{employee_current_address_id.employee_current_address_id}}">{{employee_current_address_id.current_accommodation_type}}</option>  
                            </select>
                            <span class="help-block" ng-show="showMsgs && myform.employee_current_address_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_emergency_contact_number');?></label>                                
                            <input type="text" name="emergency_phone_number" onkeypress="return isNumberKey(event)" maxlength="10" ng-init="emergency_phone_number = '<?php echo $emergency_phone_number; ?>'" id="emergency_phone_number" value="<?php echo $emergency_phone_number;?>" class="form-control"/>
                            <span class="help-block"><?php echo form_error("emergency_phone_number")?></span>
                        </div>
                    </div>
                </div>
                <div class="row">                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="unsubscribed" id="unsubscribed" ng-init="unsubscribed = '<?php echo $unsubscribed; ?>'"  <?php echo ($unsubscribed =='1')?'checked':'' ?> /> 
                                <?php echo lang('label_un_subscribed');?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label><?php echo lang('label_employee_permanent_address');?></label>             
                            <textarea  name="permanent_address" ng-init="permanent_address = '<?php echo $permanent_address; ?>'" value="<?php echo $permanent_address;?>" id="permanent_address" rows="7" class="form-control"><?php echo $permanent_address;?></textarea>
                                    <span class="help-block"><?php echo form_error("permanent_address")?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_current_address');?></label>                
                            <textarea  name="current_address" ng-init="current_address = '<?php echo $current_address; ?>'" value="<?php echo $current_address;?>" id="current_address" rows="7" class="form-control"><?php echo $current_address;?></textarea>
                            <span class="help-block"><?php echo form_error("current_address")?></span>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend> <span> <?php echo lang('label_employee_insurance_details');?> </span></legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">                            
                            <label><?php echo lang('label_employee_insurance_company_name');?></label>                 
                            <input type='text' name="insurance_company" allow-characters maxlength="20" ng-init="insurance_company = '<?php echo $insurance_company; ?>'" id=insurance_company"" class="form-control" value="<?php echo $insurance_company;?>"/>
                            <span class="help-block"><?php echo form_error('insurance_company')?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_start_date');?></label>
                                <input type="text" name="start_date" id="start_date" value="<?php echo $start_date;?>" class="single-daterange-from form-control"/> 
                                <!--<input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="start_date" is-open="popup7.opened" datepicker-options="dateOptions" ng-required="true"  data-ng-init="init('<?php echo $start_date?>', 'start_date')" value="{{start_date | date:'dd-MM-yyyy' }}" name="start_date"  ng-focus="open('popup7')" id="start_date" ng-change="fromDateChange('start_date')"/>-->
                                <span class="help-block"><?php echo form_error('start_date')?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">                            
                            <label><?php echo lang('label_policy_no');?></label>                 
                            <input type='text' maxlength="25" name="policy_number" ng-init="policy_number = '<?php echo $policy_number; ?>'"  onkeypress="return isNumberKey(event)" id="policy_number" class="form-control" value="<?php echo $policy_number;?>"/>
                            <span class="help-block"><?php echo form_error('policy_number')?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_end_date');?></label>
                                <input type="text" name="end_date" id="end_date" value="<?php echo $end_date;?>" class="single-daterange-to form-control"/> 

                                <!--<input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="end_date" is-open="popup8.opened" datepicker-options="toDateOptions" ng-required="true"  data-ng-init="init('<?php echo $end_date?>', 'end_date')" value="{{end_date | date:'dd-MM-yyyy' }}" name="end_date"  ng-focus="open('popup8')"/>-->

                            <span class="help-block"><?php echo form_error('end_date')?></span>
                        </div>
                    </div>   
                </div>
            </fieldset>

            <fieldset>
                <legend> <span> <?php echo lang('label_employee_personal_details');?> </span></legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">                            
                            <label><?php echo lang('label_employee_passport_number');?></label>                 
                            <input type='text' name="passport_number" maxlength="15" ng-init="passport_number = '<?php echo $passport_number; ?>'" id="passport_number" class="form-control" value="<?php echo $passport_number;?>"/>
                            <span class="help-block"><?php echo form_error('passport_number')?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_date_of_issue');?></label>
                                <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="date_of_issue" is-open="popup9.opened" datepicker-options="futureDateOptions" ng-required="false" data-ng-init="init('<?php echo $date_of_issue?>', 'date_of_issue')" value="{{date_of_issue | date:'dd-MM-yyyy' }}" name="date_of_issue" ng-focus="open('popup9')"/>
                                <span class="help-block"><?php echo form_error('date_of_issue')?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_valid_up_to');?></label>
                                <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="valid_upto" is-open="popup10.opened" datepicker-options="pastDateOptions" ng-required="false" data-ng-init="init('<?php echo $valid_upto?>', 'valid_upto')" value="{{valid_upto | date:'dd-MM-yyyy' }}" name="valid_upto" ng-focus="open('popup10')"/>
                                <span class="help-block"><?php echo form_error('valid_upto')?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">                            
                            <label><?php echo lang('label_employee_place_of_issue');?></label>                 
                              <!--  <input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="place_of_issue" is-open="popup11.opened" datepicker-options="dateOptions" ng-required="false" data-ng-init="init('<?php echo $place_of_issue?>', 'place_of_issue')" value="{{place_of_issue | date:'dd-MM-yyyy' }}" name="place_of_issue" ng-focus="open('popup11')"/>-->
                            <input type='text' name="place_of_issue"  allow-characters maxlength="20" ng-init="place_of_issue = '<?php echo $place_of_issue; ?>'" id="place_of_issue" class="form-control" value="<?php echo $place_of_issue;?>"/>
                            <span class="help-block"><?php echo form_error('place_of_issue')?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_marital_status','' , 'marStatus' )" >
                            <label><?php echo lang('label_employee_martial_status');?></label>
                            <span class="mandatory">*</span>
                            <!--<?php 
                                $attrib = 'class="form-control " id="marital_status_id" ng-model="marital_status_id" required';
                                echo form_dropdown('marital_status_id', $maritalstatusDropdown, set_value('marital_status_id', (isset($marital_status_id)) ? $marital_status_id : ''), $attrib);
                                if(form_error('marital_status_id')){ echo '<span class="help-block">'.form_error('marital_status_id').'</span>';} 
                            ?>-->
                            <select name="marital_status_id" ng-init="marital_status_id = '<?php echo $marital_status_id; ?>'" ng-model="marital_status_id" id="marital_status_id" class="form-control"  required select2>
                                <option value="">-- Select --</option>  
                                <option ng-repeat="marital_status_id in marStatus" value="{{marital_status_id.marital_status_id}}">{{marital_status_id.marital_status}}</option>  
                            </select>
                            <span class="help-block" ng-show="showMsgs && myform.marital_status_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>
                    </div>
                    <!--
                    <div class="col-md-6">
                        <div class="form-group" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_blood_group','' , 'bldGroups' )" >
                            <label><?php echo lang('label_employee_blood_group');?></label>
                            <span class="mandatory">*</span>
                            <?php 
                                $attrib = 'class="form-control " id="blood_group_id"  ng-model="blood_group_id" required select2';
                                echo form_dropdown('blood_group_id', $bloodgroupDropdown, set_value('blood_group_id', (isset($blood_group_id)) ? $blood_group_id : ''), $attrib);
                                if(form_error('blood_group_id')){ echo '<span class="help-block">'.form_error('blood_group_id').'</span>';} 
                            ?>
                            <select name="blood_group_id" ng-init="blood_group_id = '<?php echo $blood_group_id; ?>'" select2> 
                                <option value="">-- Select --</option>  
                                <option ng-repeat="blood_group_id in bldGroups" value="{{blood_group_id.blood_group_id}}">{{blood_group_id.blood_group}}</option>  
                            </select>
                            <span class="help-block" ng-show="showMsgs && myform.blood_group_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>
                    </div>-->
                    <div class="col-md-6">
                        <div class="form-group" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_blood_group','' , 'bldGroups' )" >
                            <label><?php echo lang('label_employee_blood_group');?></label>
                            <span class="mandatory">*</span>
                            <!--<?php 
                                $attrib = 'class="form-control " id="blood_group_id" ng-model="blood_group_id" required';
                                echo form_dropdown('blood_group_id', $maritalstatusDropdown, set_value('blood_group_id', (isset($marital_status_id)) ? $marital_status_id : ''), $attrib);
                                if(form_error('blood_group_id')){ echo '<span class="help-block">'.form_error('blood_group_id').'</span>';} 
                            ?>-->
                            <select name="blood_group_id" ng-init="blood_group_id = '<?php echo $blood_group_id; ?>'" ng-model="blood_group_id" id="blood_group_id" class="form-control" required select2>
                                <option value="">-- Select --</option>  
                                <option ng-repeat="blood_group_id in bldGroups" value="{{blood_group_id.blood_group_id}}">{{blood_group_id.blood_group}}</option>  
                            </select>
                            <span class="help-block" ng-show="showMsgs && myform.blood_group_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">   
                            <label><?php echo lang('label_employee_health_details');?></label>                
                            <textarea  name="health_details" ng-init="health_details = '<?php echo $health_details; ?>'" value="<?php echo $health_details;?>" rows="6" class="form-control"> <?php echo $health_details;?></textarea>
                            <span class="help-block"><?php echo form_error("health_details")?></span>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend> <span> <?php echo lang('label_employee_educational_details_heading');?> </span></legend>
                <div class="row">
                    <div class="col-md-12">                            
                        <table  class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <!--<th><input type="checkbox" name=""></th>-->
                                    <th><label><?php echo lang('label_employee_school_university');?></label> </th>
                                    <th><label><?php echo lang('label_employee_qualification');?></label>  </th>
                                    <th><label><?php echo lang('label_employee_level');?></label> </th>
                                    <th><label><?php echo lang('label_employee_year_of_passing');?></label></th> 
                                </tr>
                            </thead>
                            <?php 
                                $is=1;
                                for($in=0; $in < $trowEdu; $in++)
                                {
                                    ?>
                                        <tbody id="edu_exp_employee_details">
                                            <tr>
                                                <td>
                                                    <input type="checkbox"  name="emp_educational_details_id[]" value="<?php echo $emp_educational_details_id[$in];?>" class="new_row_delete_emp" onclick="checkDeleteButton('new_row_delete_emp', 'edu-delete');" <?php echo $checkDisable;?>> 
                                                    <input type="hidden" name="emp_educational_details_id[]" value="<?php echo $emp_educational_details_id[$in];?> ">
                                                </td>
                                                <td> 
                                                    <input type="text" name="school_university[]" allow-characters id="school_university<?php echo $in;?>" data-name="school_university"  data-row="<?php echo $in;?>" value="<?php echo $school_university[$in];?>" class="form-control"/>
                                                </td>
                                                <td> 
                                                    <input type="text" name="qualification[]" id="qualification<?php echo $in;?>" data-name="qualification"  data-row="<?php echo $in;?>" value="<?php echo $qualification[$in];?>" class="form-control"/> 
                                                </td>
                                                <td>
                                                   <?php 
                                                        $attrib = 'class="form-control " id="employee_level_id'.$in.'" data-name="employee_level_id" data-row="'.$in.'"';
                                                        echo form_dropdown('employee_level_id[]', $employeeLevelDropdown, set_value('employee_level_id['.$in.']', (isset($employee_level_id[$in])) ? $employee_level_id[$in] : ''), $attrib);?>
                                                        <?PHP if(form_error('employee_level_id['.$in.']')){ echo '<span class="help-block">'.form_error('employee_level_id['.$in.']').'</span>';} 
                                                    ?>
                                                </td>
                                                <td> 
                                                    <input type="text" name="year_of_passing[]" maxlength="4" onkeypress="return isNumberKey(event)" id="year_of_passing<?php echo $in;?>" data-name="year_of_passing"  data-row="<?php echo $in;?>" value="<?php echo $year_of_passing[$in];?>" class="form-control"/> 
                                                </td>
                                               <!-- <td> 
                                                    <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $SclcontentUrl;?>');" name="">Details</button>
                                                </td>-->
                                            </tr>
                                        </tbody> 
                                        <?php                      
                                    $is++;
                                } 
                            ?> 
                            <tfoot>
                                <th colspan="6">
                                     <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('edu_exp_employee_details');" ><?php echo lang('label_add_row');?> </button>
                                     <input type="button" class="btn btn-danger btn-sm edu-delete" name="" value="Delete" onclick="addRowDelete('edu_exp_employee_details', 'new_row_delete_emp', 'hr_emp_educational_details', 'emp_educational_details_id');" disabled>
                                </th>
                            </tfoot>                
                        </table>
                    </div>
                </div>
            </fieldset>
           
            <fieldset>
                <legend> <span> <?php echo lang('label_employee_previous_work_experience');?> </span></legend>
                <div class="col-md-12">                            
                        <table  class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>     
                                    <!--<th><input type="checkbox" name=""></th>-->
                                    <th><label><?php echo lang('label_employee_company');?></label> </th>
                                    <th><label><?php echo lang('label_employee_previous_designation');?></label>  </th>
                                    <th><label><?php echo lang('label_employee_salary');?></label> </th>
                                    <th><label><?php echo lang('label_employee_address');?></label></th>
                                    <th><label><?php echo lang('label_contact_number');?></label> </th>
                                    <th><label><?php echo lang('label_total_experience');?></label> </th>
                                </tr>
                            </thead>
                            <?php 
                                $is=1;
                                for($in=0; $in < $trowEx; $in++)
                                {
                                    ?>
                                        <tbody id="work_exp_employee_details">
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="emp_external_work_experience_id[]" value="<?php echo $emp_external_work_experience_id[$in];?>" class="new_row_delete" onclick="checkDeleteButton('new_row_delete', 'work-delete');" <?php echo $checkDisable;?>>
                                                    <input type="hidden" name="emp_external_work_experience_id[]" value="<?php echo $emp_external_work_experience_id[$in];?>" class="emp_external_work_experience">
                                                </td>
                                                <td>
                                                    <input type="text" name="company_name[]" allow-characters id="company_name<?php echo $in;?>" data-name="company_name"  data-row="<?php echo $in;?>" value="<?php echo $company_name[$in];?>" class="form-control"/>
                                                 </td>
                                                <td> 
                                                    <input type="text" name="designation[]" allow-characters id="designation<?php echo $in;?>" data-name="designation"  data-row="<?php echo $in;?>" value="<?php echo $designation[$in];?>" class="form-control"/> 
                                                </td>
                                                <td>
                                                    <input type="text" name="salary[]" maxlength="7" onkeypress="return isNumberKey(event)" id="salary<?php echo $in;?>" data-name="salary"  data-row="<?php echo $in;?>" value="<?php echo $salary[$in];?>" class="form-control"/>
                                                </td>
                                                <td> 
                                                    <input type="text" name="address[]" id="address<?php echo $in;?>" data-name="address"  data-row="<?php echo $in;?>" value="<?php echo $address[$in];?>" class="form-control"/> 
                                                </td>
                                                <td> 
                                                    <input type="text" name="contact[]" maxlength="10"  onkeypress="return isNumberKey(event)" id="contact<?php echo $in;?>" data-name="contact"  data-row="<?php echo $in;?>" value="<?php echo $contact[$in];?>" class="form-control"/> 
                                                </td>
                                                <td> 
                                                    <input type="text" name="total_experience[]" maxlength="10"  id="total_experience<?php echo $in;?>" data-name="total_experience"  data-row="<?php echo $in;?>" value="<?php echo $total_experience[$in];?>" class="form-control"/> 
                                                </td>
                                                <!--<td>
                                                    <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $EducontentUrl;?>');" name="">Details</button>
                                                </td>-->
                                            </tr>
                                        </tbody> 
                                         <?php                      
                                $is++;
                                } 
                            ?> 
                            <tfoot>
                                <th colspan="7">
                                     <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('work_exp_employee_details');" > + Add Row </button>
                                     <input type="button" class="btn btn-danger btn-sm work-delete" name="" value="Delete" onclick="addRowDelete('work_exp_employee_details', 'new_row_delete', 'hr_emp_external_work_experience', 'emp_external_work_experience_id');" disabled>
                                </th>
                            </tfoot>                
                        </table>
                    </div>
            </fieldset>

            <fieldset>
                <legend> <span> <?php echo lang('label_employee_history_in_company_heading');?></span></legend>
                <div class="col-md-12">                            
                        <table  class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <!--<th><input type="checkbox" name=""></th>-->
                                    <th><label><?php echo lang('label_branch');?></label> </th>
                                    <th><label><?php echo lang('label_department');?></label>  </th>
                                    <th><label><?php echo lang('label_designation_heading');?></label> </th>
                                    <th><label><?php echo lang('label_employee_from_date');?></label>   </th>         
                                    <th><label><?php echo lang('label_employee_to_date');?></label> </th>
                                </tr>
                            </thead>
                        <?php 
                            $is=1;
                            for($in=0; $in < $trowHis; $in++)
                            {
                                ?>
                                <tbody id="history_employee_details">
                                    <tr>
                                        <td> 
                                            <input type="checkbox" name="emp_history_in_company_id[]" value="<?php echo $emp_history_in_company_id[$in];?>" class="new_row_delete_company" onclick="checkDeleteButton('new_row_delete_company', 'his-delete');" <?php echo $checkDisable;?>>
                                            <input type="hidden" name="emp_history_in_company_id[]" id="emp_history_in_company_id" value="<?php echo $emp_history_in_company_id[$in];?>" class="form-control"/> 
                                        </td>
                                        <td> 
                                            <?php 
                                                $attrib = 'class="form-control " id="history_branch_id'.$in.'" data-name="history_branch_id" data-row="'.$in.'"';
                                                echo form_dropdown('history_branch_id[]', $branchDropdown, set_value('history_branch_id['.$in.']', (isset($history_branch_id[$in])) ? $history_branch_id[$in] : ''), $attrib);?>
                                                <?PHP if(form_error('history_branch_id['.$in.']')){ echo '<span class="help-block">'.form_error('history_branch_id['.$in.']').'</span>';} 
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $attrib = 'class="form-control " id="history_department_id'.$in.'" data-name="history_department_id" data-row="'.$in.'"';
                                                echo form_dropdown('history_department_id[]', $departmentDropdown, set_value('history_department_id['.$in.']', (isset($history_department_id[$in])) ? $history_department_id[$in] : ''), $attrib);?>
                                                <?PHP if(form_error('history_department_id['.$in.']')){ echo '<span class="help-block">'.form_error('history_department_id['.$in.']').'</span>';}
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $attrib = 'class="form-control  " id="history_designation_id'.$in.'" data-name="history_designation_id" data-row="'.$in.'"';
                                                echo form_dropdown('history_designation_id[]', $designationDropdown, set_value('history_designation_id['.$in.']', (isset($history_designation_id[$in])) ? $history_designation_id[$in] : ''), $attrib);?>
                                                <?PHP if(form_error('history_designation_id')){ echo '<span class="help-block">'.form_error('history_designation_id['.$in.']').'</span>';} 
                                            ?>
                                        </td>
                                        <td> 
                                            <input type="text" name="from_date[]" id="from_date<?php echo $in;?>" data-name="from_date"  data-row="<?php echo $in;?>" value="<?php echo $from_date[$in];?>" class="single-daterange-from form-control"/> 
                                        </td>
                                        <td>
                                            <input type="text" name="to_date[]" id="to_date<?php echo $in;?>" data-name="to_date"  data-row="<?php echo $in;?>" value="<?php echo $to_date[$in];?>" class="single-daterange-to form-control"/> 
                                         </td>
                                    </tr>
                                </tbody> 
                                <?php                      
                            $is++;
                            } 
                        ?> 
                            <tfoot>
                                <th colspan="7">
                                   <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('history_employee_details');" > <?php echo lang('label_add_row');?></button>
                                    <input type="button" class="btn btn-danger btn-sm his-delete" name="" value="Delete" onclick="addRowDelete('history_employee_details', 'new_row_delete_company', 'hr_emp_history_in_company', 'emp_history_in_company_id');" disabled>
                                </th>
                            </tfoot>                
                        </table>
                    </div>
            </fieldset>
        </div>

        <!--LEFT CONTENT-->
        <div ng-if="employee_status_id == '2'"> 
            <fieldset>
                <legend> <span> <?php echo lang('label_employee_exit_heading');?> </span></legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_resignation_letter_date');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="resignation_letter_date" is-open="popup12.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $resignation_letter_date?>', 'resignation_letter_date')" value="{{resignation_letter_date | date:'dd-MM-yyyy' }}" name="resignation_letter_date" ng-focus="open('popup12')" ng-init="resignation_letter_date = '<?php echo $resignation_letter_date;?>'"/>
                            <span class="help-block" ng-show="showMsgs && myform.resignation_letter_date.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error('resignation_letter_date')?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">                            
                            <label><?php echo lang('label_employee_relieving_date');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="relieving_date" is-open="popup13.opened" datepicker-options="pastDateOptions" ng-required="true" data-ng-init="init('<?php echo $relieving_date?>', 'relieving_date')" value="{{relieving_date | date:'dd-MM-yyyy' }}" name="relieving_date" ng-focus="open('popup13')"/>
                            <span class="help-block" ng-show="showMsgs && myform.relieving_date.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error('relieving_date')?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">                            
                            <label><?php echo lang('label_employee_reason_for_leaving');?></label>
                            <input type='text' name="reason_for_leaving" ng-init="reason_for_leaving = '<?php echo $reason_for_leaving; ?>'" id="reason_for_leaving" class="form-control" value="<?php echo $reason_for_leaving;?>" allow-characters/>
                            <span class="help-block"><?php echo form_error('reason_for_leaving')?></span>
                        </div>
                    </div>                    
                    <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_employee_leave_en_cashed','' , 'leaEncash' )">
                        <div class="form-group" >
                            <label><?php echo lang('label_employee_leave_encashed');?></label>
                            <!--<?php 
                                $attrib = 'class="form-control " id="employee_leave_en_cashed_id" ng-model="employee_leave_en_cashed_id"';
                                echo form_dropdown('employee_leave_en_cashed_id', $leaveEnCashedDropdown, set_value('employee_leave_en_cashed_id', (isset($employee_leave_en_cashed_id)) ? $employee_leave_en_cashed_id : ''), $attrib);
                                if(form_error('employee_leave_en_cashed_id')){ echo '<span class="help-block">'.form_error('employee_leave_en_cashed_id').'</span>';} 
                            ?>-->
                            <select name="employee_leave_en_cashed_id" ng-init="employee_leave_en_cashed_id = '<?php echo $employee_leave_en_cashed_id; ?>'" ng-model="employee_leave_en_cashed_id" id="employee_leave_en_cashed_id" class="form-control" select2 >
                                <option value="">-- Select --</option>  
                                <option ng-repeat="employee_leave_en_cashed_id in leaEncash" value="{{employee_leave_en_cashed_id.employee_leave_en_cashed_id}}">{{employee_leave_en_cashed_id.leave_en_cashed}}</option>  
                            </select>
                        </div>  
                    </div>             
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_encashment_date');?></label>
                            <!--<input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="encashment_date" is-open="popup14.opened" datepicker-options="dateOptions" data-ng-init="init('<?php echo $encashment_date?>', 'encashment_date')" value="{{encashment_date | date:'dd-MM-yyyy' }}" name="encashment_date" ng-focus="open('popup14')"/>-->

                            <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="encashment_date" is-open="popup14.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $encashment_date?>', 'encashment_date')" value="{{encashment_date | date:'dd-MM-yyyy' }}" name="encashment_date" ng-focus="open('popup14')"/>
                            <span class="help-block"><?php echo form_error('encashment_date')?></span>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend> <span> <?php echo lang('label_employee_exit_interview_details');?> </span></legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo lang('label_employee_reason_for_resignation');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="reason_for_resignation" ng-init="reason_for_resignation = '<?php echo $reason_for_resignation; ?>'" id="reason_for_resignation" value="<?php echo $reason_for_resignation;?>" class="form-control" ng-model="reason_for_resignation" allow-characters required/>
                            <span class="help-block" ng-show="showMsgs && myform.reason_for_resignation.$error.required"><?php echo $this->lang->line('required');?></span> 
                            <span class="help-block"><?php echo form_error("reason_for_resignation")?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">                            
                            <label><?php echo lang('label_employee_held_on');?></label>                                
                            <!--<input type='text' name="held_on" ng-init="held_on = '<?php echo $held_on; ?>'" id="held_on" class="single-daterange form-control" value="<?php echo $held_on;?>"/>-->
                            <input type="text" show-button-bar="false" name="held_on" uib-datepicker-popup="{{format}}" ng-model="held_on" is-open="popup15.opened" ng-required="false" name="held_on" ng-focus="open('popup15')" data-ng-init="init('<?php echo $held_on?>', 'held_on')"  data-name="held_on" id="held_on" class="form-control" value = "<?php echo $held_on;?>"/>
                            <span class="help-block"><?php echo form_error('held_on')?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <label><?php echo lang('label_new_workplace');?></label>                                
                            <input type='text' name="new_workplace" ng-init="new_workplace = '<?php echo $new_workplace; ?>'" id="new_workplace" class="form-control" value="<?php echo $new_workplace;?>" allow-characters/>
                            <span class="help-block"><?php echo form_error('new_workplace')?></span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label><?php echo lang('label_employee_feed_back');?></label>                         
                            <textarea  name="feedback" ng-init="feedback = '<?php echo $feedback; ?>'" value="<?php echo $feedback;?>" rows="7" class="form-control"> <?php echo $feedback;?> </textarea>
                            <span class="help-block"><?php echo form_error("feedback")?></span>
                        </div>
                    </div>   
                </div>
            </fieldset>
        </div>

        <div class="modal-footer">
            <a href="<?php echo base_url('hr/Employee_attendance/Employee'); ?>" class="btn btn-danger"><?php echo $this->lang->line('label_cancel');?></a>
            <button class="btn btn-primary" ng-click="submited('myform', 'showuniqueMsgs')" type="submit" ng-disabled="showjoiningMsgs"><?php echo $this->lang->line('label_submit');?></button>
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

    function checkExitContent(opt,values1)
    {
        if (opt == "1")
        {
            $('#Active').css('display', 'block');
            $('#left').css('display', 'none'); 
        }else
        {
            $('#Active').css('display', 'none');
            $('#left').css('display', 'block');
            //$(".requriedSelect").removeAttr("required"); 
        }
    }      

    document.getElementById('selectDiv').onselect = function () {
        window.getSelection().removeAllRanges();
    }

    function genreteEmployeeId(argument) 
    {
        var naming_series_id = $('#naming_series').val();

        $.ajax
        ({
          type : "POST",
          url  : '<?php echo base_url();?>hr/Employee_attendance/Employee/genreteEmployeeId',
          data : {'naming_series_id' : naming_series_id},
          success : function(data)
          {
            $('#employee_number').val(data);
          },
        });
    }    
</script>