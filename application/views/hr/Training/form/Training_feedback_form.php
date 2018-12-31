<?php
$ci =&get_instance();
$employeeDropdown       =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_number as Value'), array('is_delete' => 0));
$trainingeventDropdown  =  $ci->mcommon->Dropdown('hr_training_event', array('training_event_id as Key', 'event_name as Value'), array('is_delete' => 0));

//Variable Initialize
$training_feedback_id   =   "";
$employee_id            =   "";
$employee_name          =   "";
$course_id              =   "";
$training_event_id      =   "";
$trainer_name           =   "";
$feedback               =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $training_feedback_id   =  $row->training_feedback_id;
        $employee_id            =  $row->employee_id;
        $employee_name          =  $row->employee_name;
        $course_id              =  $row->course_id;
        $training_event_id      =  $row->training_event_id;        
        $trainer_name           =  $row->trainer_name;    
        $feedback               =  $row->feedback;        
    }    
}
else
{
    $training_feedback_id       =   $this->input->post('training_feedback_id');
    $employee_id                =   $this->input->post('employee_id');
    $employee_name              =   $this->input->post('employee_name'); 
    $course_id                  =   $this->input->post('course_id');
    $training_event_id          =   $this->input->post('training_event_id'); 
    $trainer_name               =   $this->input->post('trainer_name');  
    $feedback                   =   $this->input->post('feedback'); 
}
?>
<style type="text/css"></style>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Training_feedback_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
      <input type="hidden" name="training_feedback_id" id="training_feedback_id" value="<?php echo $training_feedback_id;?>" >
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employee', <?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employeeData' )" >
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_id');?></label>
                    <span class="mandatory"> * </span>                                        
                        <select name="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" ng-model="employee_id" id="employee_id" class="form-control"  required select2 onchange="loademployeename();">
                              <option value="">-- Select --</option>
                              <option ng-repeat="employee_id in employeeData" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                </div>
            </div>
            <?php
            /*
            <div class="col-md-6" ng-init="loadDropdown(<?php echo base_url();?>Common_controller/loadDropdown/hr_employee',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employees' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_id');?></label>
                    <span class="mandatory"> * </span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="employee_id" onchange="loademployeename();"  ng-model="employee_id" required ';
                        echo form_dropdown('employee_id', $employeeDropdown, set_value('employee_id', (isset($employee_id)) ? $employee_id : ''), $attrib);?>
                    <?PHP if(form_error('employee_id')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';} ?>-->

                    <select name="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" ng-model="employee_id" id="employee_id" class="form-control" onchange="loademployeename();" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="employee_id in employees" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                </div>
            </div>
            */
            ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_name');?></label>
                    <!--<span class="mandatory"> * </span>-->
                    <input type="text" name="employee_name" id="employee_name" value="<?php echo $employee_name;?>" class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('employee_name')?></span>                
                </div>
            </div>                       
        </div>
        <div class="row">
             <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_training_event', <?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'eventData' )" >
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_training_event');?></label>
                    <span class="mandatory"> * </span>                                        
                        <select name="training_event_id" ng-init="training_event_id = '<?php echo $training_event_id; ?>'" ng-model="training_event_id" id="training_event_id" class="form-control"  required select2 onchange="loadTranierName();">
                              <option value="">-- Select --</option>
                              <option ng-repeat="training_event_id in eventData" value="{{training_event_id.training_event_id}}">{{training_event_id.event_name}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.training_event_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                </div>
            </div>

            <?php
            /*
            <div class="col-md-6" ng-init="loadDropdown(<?php echo base_url();?>Common_controller/loadDropdown/hr_training_event',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'events' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_training_event');?></label>
                    <a class="add-new-popup" onclick="">+</a>
                    <span class="mandatory"> * </span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="training_event_id" onchange="loadTranierName();" ng-model="training_event_id" required ';
                        echo form_dropdown('training_event_id', $trainingeventDropdown, set_value('training_event_id', (isset($training_event_id)) ? $training_event_id : ''), $attrib);?>
                    <?PHP if(form_error('training_event_id')){ echo '<span class="help-block">'.form_error('training_event_id').'</span>';} ?>-->

                    <select name="training_event_id" ng-init="training_event_id = '<?php echo $training_event_id; ?>'" ng-model="training_event_id" id="training_event_id" class="form-control" onchange="loadTranierName();" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="training_event_id in events" value="{{training_event_id.training_event_id}}">{{training_event_id.event_name}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.training_event_id.$error.required"><?php echo $this->lang->line('required');?></span>  
                </div>
            </div>
            */
            ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_trainer_name');?></label>
                    <!--<span class="mandatory"> * </span>-->
                    <input type="text" name="trainer_name" id="trainer_name" value="<?php echo $trainer_name;?>" class="form-control" readonly />
                    <span class="help-block"><?php echo form_error('trainer_name')?></span>               
                </div>
            </div>      
        </div> <hr/>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_course');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" name="course_id" id="course_id" maxlength="45" value="<?php echo $course_id;?>" class="form-control" ng-model="course_id" required allow-characters ng-init="course_id = '<?php echo $course_id;?>'"/>
                    <span class="help-block"><?php echo form_error('course_id')?></span>
                    <span class="help-block" ng-show="showMsgs && myform.course_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div> <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_feedback');?></label>
                    <span class="mandatory"> * </span>
                    <textarea name="feedback" cols="40" rows="5" id="feedback" class="form-control" ng-model="feedback" required ng-init="feedback = '<?php echo $feedback;?>'"><?php echo $feedback;?></textarea> 
                    <span class="help-block"><?php echo form_error('feedback')?></span>
                    <span class="help-block" ng-show="showMsgs && myform.feedback.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
        </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
                <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
            </div> 
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"> <?php echo lang('label_submit');?></button>
            <a href="<?php echo base_url('hr/Training/Training_feedback') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
        </div>-->
    </form>
</div>