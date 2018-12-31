<?php
$ci =&get_instance();
$statusDropdown         =  $ci->mcommon->Dropdown('def_hr_training_eve_event_status', array('training_eve_event_status_id as Key', 'event_status as Value'));
$eventtypeDropdown      =  $ci->mcommon->Dropdown('def_hr_training_event_type', array('training_event_type_id as Key', 'type as Value'));
$trainerDropdown        =  $ci->mcommon->Dropdown('hr_trainer', array('trainer_id as Key', 'trainer_name as Value'), array('is_delete' => 0));
$eventstatusDropdown    =  $ci->mcommon->Dropdown('def_hr_training_event_status', array('training_event_status_id as Key', 'status as Value'));
$companyDropdown        =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'), array('is_delete' => 0));
$courseDropdown         =  $ci->mcommon->Dropdown('def_hr_training_event_status', array('training_event_status_id as Key', 'status as Value'));
$employeeDropdown       =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_number as Value'), array('is_delete' => 0));
$traningProDropdown     =  $ci->mcommon->Dropdown('hr_training_program', array('training_program_id as Key', 'training_program as Value'),array('is_delete' => 0));
$programLevelDropdown   =  $ci->mcommon->Dropdown('def_training_program_level', array('def_training_level_id as Key', 'level as Value'));

//Variable Initialize
$training_event_id              =   "";
$event_name                     =   "";
$training_eve_event_status_id   =   "";
$training_event_type_id         =   "";
$trainer_id                     =   "";
$trainer_email                  =   "";
$contact_number                 =   "";
$company_id                     =   "";
$course_id                      =   "";
$location                       =   "";
$start_time                     =   "";
$end_time                       =   "";
$introduction                   =   "";
$training_event_id              =   "";
$send_email                     =   "";
$employee_id                    =   array();
$training_event_status_id       =   array();
$attendees_id                   =   array();

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $training_event_id              =  $row->training_event_id;
        $event_name                     =  $row->event_name;
        $training_eve_event_status_id   =  $row->training_eve_event_status_id;
        $training_event_type_id         =  $row->training_event_type_id;
        $trainer_id                     =  $row->trainer_id;
        $trainer_email                  =  $row->trainer_email;
        $contact_number                 =  $row->contact_number;
        $has_certificate                =  $row->has_certificate;
        $def_training_level_id          =  $row->def_training_level_id;
        $training_program_id            =  $row->training_program_id;
        $company_id                     =  $row->company_id;
        $course_id                      =  $row->course_id;
        $location                       =  $row->location;
        $start_time                     =  $row->start_time;
        $end_time                       =  $row->end_time;
        $introduction                   =  $row->introduction;       
    } 
}
else
{
    $training_event_id              =  $this->input->post('training_event_id');
    $event_name                     =  $this->input->post('event_name');
    $training_eve_event_status_id   =  $this->input->post('training_eve_event_status_id');
    $training_event_type_id         =  $this->input->post('training_event_type_id');
    $trainer_id                     =  $this->input->post('trainer_id');
    $trainer_email                  =  $this->input->post('trainer_email');
    $contact_number                 =  $this->input->post('contact_number');
    $company_id                     =  $this->input->post('company_id');
    $course_id                      =  $this->input->post('course_id');
    $location                       =  $this->input->post('location');
    $start_time                     =  $this->input->post('start_time');
    $end_time                       =  $this->input->post('end_time');
    $introduction                   =  $this->input->post('introduction');
    $has_certificate                =  $this->input->post('has_certificate');
    $def_training_level_id          =  $this->input->post('def_training_level_id');
    $training_program_id            =  $this->input->post('training_program_id');
}

if(!empty($contentData))
{
    foreach ($contentData as $row)
    {
        $attendees_id[]                   =   $row->attendees_id;
        $send_email                       =   $row->send_email;
        $employee_id[]                    =   $row->employee_id;
        $training_event_status_id[]       =   $row->training_event_status_id;
        $trowEmp++;   
    } 
}
else
{ 
    $attendees_id                   =   $this->input->post('attendees_id');
    $send_email                     =   $this->input->post('send_email');
    $employee_id                    =   $this->input->post('employee_id');
    $training_event_status_id       =   $this->input->post('training_event_status_id');
}
$trowEmp           = count($training_event_status_id) ? count($training_event_status_id):'1';
$checkDisable      = ($training_event_id == '') ? 'disabled' : '';
?>
<style type="text/css"></style>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Training_event_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="training_event_id" id="training_event_id"  value="<?php echo $training_event_id;?>" >
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_event_name');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" name="event_name" id="event_name" maxlength="45" ng-init="event_name = '<?php echo $event_name; ?>'" value="<?php echo $event_name;?>" class="form-control" ng-model="event_name" ng-pattern="/^[a-zA-Z\s]*$/" required allow-characters/>
                    <span class="help-block" ng-show="showMsgs && myform.event_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.event_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('event_name')?></span>
                </div>
            </div>
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_training_event_type','' , 'eventTypes' )" >
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_type');?></label>
                    <span class="mandatory"> * </span>
                        <!--<?php 
                        $attrib = 'class="form-control select2" id="training_event_type_id" ng-model="training_event_type_id" required ';
                        echo form_dropdown('training_event_type_id', $eventtypeDropdown, set_value('training_event_type_id', (isset($training_event_type_id)) ? $training_event_type_id : ''), $attrib);
                        ?>
                        <?PHP 
                            if(form_error('training_event_type_id')){ echo '<span class="help-block">'.form_error('training_event_type_id').'</span>';}
                        ?>-->
                        <select name="training_event_type_id" ng-init="training_event_type_id = '<?php echo $training_event_type_id; ?>'" ng-model="training_event_type_id" id="training_event_type_id" class="form-control"  required select2>
                              <option value="">-- Select --</option>  training_event_type_id
                              <option ng-repeat="training_event_type_id in eventTypes" value="{{training_event_type_id.training_event_type_id}}">{{training_event_type_id.type}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.training_event_type_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_training_eve_event_status','' , 'statuses' )" > 
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_event_status');?></label>
                    <span class="mandatory"> * </span>  
                        <!--<?php 
                        $attrib = 'class="form-control select2" id="training_eve_event_status_id" ng-model="training_eve_event_status_id" required ';
                        echo form_dropdown('training_eve_event_status_id', $statusDropdown, set_value('training_eve_event_status_id', (isset($training_eve_event_status_id)) ? $training_eve_event_status_id : ''), $attrib);?>
                        <?PHP if(form_error('training_eve_event_status_id')){ echo '<span class="help-block">'.form_error('training_eve_event_status_id').'</span>';} ?>-->
                        <select name="training_eve_event_status_id" ng-init="training_eve_event_status_id = '<?php echo $training_eve_event_status_id; ?>'" ng-model="training_eve_event_status_id" id="training_eve_event_status_id" class="form-control"  required select2>
                              <option value="">-- Select --</option>  training_eve_event_status_id
                              <option ng-repeat="training_eve_event_status_id in statuses" value="{{training_eve_event_status_id.training_eve_event_status_id}}">{{training_eve_event_status_id.event_status}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.training_eve_event_status_id.$error.required"><?php echo $this->lang->line('required');?></span>  
                </div>
            </div>
            <div class="col-md-6"  ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_training_program',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'trainPrograms' )" > 
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_training_program');?></label>
                    <span class="mandatory"> * </span>  
                        <!--<?php 
                        $attrib = 'class="form-control select2" id="training_program_id" ng-model="training_program_id" required ';
                        echo form_dropdown('training_program_id', $traningProDropdown, set_value('training_program_id', (isset($training_program_id)) ? $training_program_id : ''), $attrib);?>
                        <?PHP if(form_error('training_program_id')){ echo '<span class="help-block">'.form_error('training_program_id').'</span>';} ?>-->

                        <select name="training_program_id" ng-init="training_program_id = '<?php echo $training_program_id; ?>'" ng-model="training_program_id" id="training_program_id" class="form-control" required select2>
                            <option value="">-- Select --</option>  training_program_id
                            <option ng-repeat="training_program_id in trainPrograms" value="{{training_program_id.training_program_id}}">{{training_program_id.training_program}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.training_program_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                </div>
            </div>     
        </div>
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_training_program_level','' , 'levels' )"> 
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_level');?></label>
                    <!--<?php 
                    $attrib = 'class="form-control select2" id="def_training_level_id" ng-model="def_training_level_id" required ';
                    echo form_dropdown('def_training_level_id', $programLevelDropdown, set_value('def_training_level_id', (isset($def_training_level_id)) ? $def_training_level_id : ''), $attrib);?>
                    <?PHP if(form_error('def_training_level_id')){ echo '<span class="help-block">'.form_error('def_training_level_id').'</span>';} ?>-->

                    <select name="def_training_level_id" ng-init="def_training_level_id = '<?php echo $def_training_level_id; ?>'" ng-model="def_training_level_id" id="def_training_level_id" class="form-control" required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="def_training_level_id in levels" value="{{def_training_level_id.def_training_level_id}}">{{def_training_level_id.level}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.def_training_level_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group">
                        <label>
                            <input type="checkbox"  name="has_certificate" ng-init="has_certificate = '<?php echo $has_certificate; ?>'" id="has_certificate" <?php if($has_certificate == 1){ echo 'checked = "checked"';} ?> /> 
                            <?php echo lang('label_has_certificate');?>
                        </label>
                    </div>
            </div>     
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_trainer',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'trainers' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_trainer_name');?></label>
                    <span class="mandatory"> * </span>
                    <!--<?php
                        $attrib = 'class="form-control select2" id="trainer_id" onchange="loadDetails();" ng-model="trainer_id" required '; 
                        echo form_dropdown('trainer_id', $trainerDropdown, set_value('trainer_id', (isset($trainer_id)) ? $trainer_id : ''), $attrib);?>
                        <?PHP if(form_error('trainer_id')){ echo '<span class="help-block">'.form_error('trainer_id').'</span>';} 
                    ?>-->
                    <select name="trainer_id" ng-init="trainer_id = '<?php echo $trainer_id; ?>'" ng-model="trainer_id" id="trainer_id" class="form-control"  required select2 onchange="loadDetails();">
                        <option value="">-- Select --</option>  
                        <option ng-repeat="trainer_id in trainers" value="{{trainer_id.trainer_id}}">{{trainer_id.trainer_name}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.trainer_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_trainer_email_id');?></label>
                    <input type="text" name="trainer_email" ng-init="trainer_email = '<?php echo $trainer_email; ?>'" id="trainer_email" value="<?php echo $trainer_email;?>" class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('trainer_email')?></span>
                </div>
            </div> 
            <div class="clearfix"></div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_contact_number');?></label>
                    <input type="text" name="contact_number" ng-init="contact_number = '<?php echo $contact_number; ?>'" id="contact_number" value="<?php echo $contact_number;?>" class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('contact_number')?></span>
                </div>
            </div>
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'companies' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_company_name');?></label>
                    <span class="mandatory"> * </span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="company_id" ng-model="company_id" required ';
                        echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);?>
                        <?PHP if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} 
                    ?>-->
                    <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control" required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                </div>
            </div>        
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                 <div class="form-group">
                    <label><?php echo $this->lang->line('label_course');?></label>
                    <span class="mandatory"> * </span>
                    <!--Course is a Dropdown-->
                    <input type="text" name="course_id" maxlength="30" ng-init="course_id = '<?php echo $course_id; ?>'" id="course_id" value="<?php echo $course_id;?>" class="form-control" ng-model="course_id" required allow-characters/>
                    <span class="help-block" ng-show="showMsgs && myform.course_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                    <span class="help-block"><?php echo form_error('course_id')?></span>
                </div>   
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label><?php echo $this->lang->line('label_location');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" name="location" maxlength="25" ng-init="location = '<?php echo $location; ?>'" id="location" value="<?php echo $location;?>" class="form-control"  ng-model="location" required allow-characters/>
                    <span class="help-block" ng-show="showMsgs && myform.location.$error.required"><?php echo $this->lang->line('required');?></span> 
                    <span class="help-block"><?php echo form_error('location')?></span>
                </div> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_start_date');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="start_time" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $start_time?>', 'start_time')" value="{{start_time | date:'dd-MM-yyyy' }}" name="start_time" ng-focus="open('popup1')"/>
                    <span class="help-block" ng-show="showMsgs && myform.start_time.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_end_date');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="end_time" is-open="popup2.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $end_time?>', 'end_time')" value="{{end_time | date:'dd-MM-yyyy' }}" name="end_time"  ng-focus="open('popup2')"/>
                    <span class="help-block" ng-show="showMsgs && myform.end_time.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
        </div>    
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_introduction');?></label>
                    <span class="mandatory"> * </span>
                    <textarea name="introduction" cols="40" rows="5" id="introduction" class="form-control" ng-model="introduction" required ng-init="introduction = '<?php echo $introduction;?>'"><?php echo $introduction;?></textarea>               
                    <span class="help-block" ng-show="showMsgs && myform.introduction.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error('introduction')?></span>
                </div>
            </div>
        </div>
        <!--Attendees: -->
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_attendance');?></span></legend>
            <div class="row">   
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <input type="checkbox" ng-model="send_email" ng-init="send_email = '<?php echo $send_email; ?>'" name="send_email" id="send_email" value="1" <?php if($send_email == 1){ echo 'checked = "checked"';} ?> /> 
                            <?php echo lang('label_send_email');?>
                        </label>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <!--<th><input type="checkbox" ></th>-->
                                <th></th>
                                <th><?php echo lang('label_employee_id');?></th>
                                <th><?php echo lang('label_status');?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="employee_details">
                        <?php 
                        $is=1;
                        for($in=0; $in < $trowEmp; $in++)
                        {
                        ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="tr_eve_cbx" id="tr_eve_cbx<?php echo $in;?>" data-name="tr_eve_cbx" data-row="<?php echo $in;?>" value="<?php echo $attendees_id[$in];?>" onclick="checkDeleteButton('tr_eve_cbx', 'add_delete');" <?php echo $checkDisable;?>/>
                                    <input type="hidden" name="attendees_id[]" value="<?php echo $attendees_id[$in];?>" data-name="attendees_id" id="attendees_id<?php echo $in;?>" data-row="<?php echo $in;?>">
                                </td>
                                <td>
                                    <?php 
                                        $attrib = 'class="form-control" id="employee_id'.$in.'" data-name="employee_id" data-row="'.$in.'"';
                                        echo form_dropdown('employee_id[]', $employeeDropdown, set_value('employee_id['.$in.']', (isset($employee_id[$in])) ? $employee_id[$in] : ''), $attrib);?>
                                        <?PHP if(form_error('employee_id['.$in.']')){ echo '<span class="help-block">'.form_error('employee_id['.$in.']').'</span>';} 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $attrib = 'class="form-control" id="training_event_status_id'.$in.'" data-name="training_event_status_id" data-row="'.$in.'"';
                                        echo form_dropdown('training_event_status_id[]', $eventstatusDropdown, set_value('training_event_status_id['.$in.']', (isset($training_event_status_id[$in])) ? $training_event_status_id[$in] : ''), $attrib);?>
                                        <?PHP if(form_error('training_event_status_id['.$in.']')){ echo '<span class="help-block">'.form_error('training_event_status_id['.$in.']').'</span>';} 
                                    ?>
                                </td>
                                <td></td>
                            </tr>
                        <?php                      
                        $is++;
                        } 
                        ?> 
                        </tbody> 
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('employee_details');" > <?php echo $this->lang->line('label_add_row');?> </button>
                                    <input type="button" class="btn btn-danger btn-sm add_delete" id="button" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('employee_details', 'tr_eve_cbx', 'hr_training_event_attendees', 'attendees_id');" disabled>
                                </td>
                            </tr>                      
                        </tfoot>                                 
                    </table>
                </div>  
            </div>                   
        </fieldset> 
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div> 
    </form>
</div>