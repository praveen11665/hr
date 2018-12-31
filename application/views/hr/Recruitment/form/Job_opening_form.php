<?php
$ci =&get_instance();
$jobstatusDropdown  =  $ci->mcommon->Dropdown('def_hr_job_opening_status', array('job_opening_status_id as Key', 'status as Value'));
 //Variable Initalize
 $job_opening_id            = "";
 $job_title                 = "";
 $route                     = "";
 $publish                   = "";
 $job_opening_status_id     = "";
 $description               = "";
 
if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $job_opening_id          =  $row->job_opening_id;
        $job_title               =  $row->job_title;
        $route                   =  $row->route;
        $publish                 =  $row->publish;
        $job_opening_status_id   =  $row->job_opening_status_id;
        $description             =  $row->description;
    }
}
else
{
    $job_opening_id         =   $this->input->post('job_opening_id');
    $job_title              =   $this->input->post('job_title');
    $route                  =   $this->input->post('route');
    $publish                =   $this->input->post('publish');
    $job_opening_status_id  =   $this->input->post('job_opening_status_id');
    $description            =   $this->input->post('description');
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Job_opening_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="job_opening_id" id="job_opening_id" value="<?php echo $job_opening_id;?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_job_title');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="job_title" id="job_title" ng-init="job_title = '<?php echo $job_title; ?>'" value="<?php echo $job_title;?>" class="form-control" ng-model="job_title" ng-pattern="/^[a-zA-Z\s]*$/" required allow-characters maxlength="25" ng-keyup="checkUnique('../../Common_controller/checkUnique/hr_job_opening', job_title, 'job_title')"/>
                    <span class="help-block" ng-show="showMsgs && myform.job_title.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.job_title.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('job_title')?></span>
                    <span class="help-block" ng-show="showuniqueMsgs">{{job_title
                    }} already in use</span>
                </div>
            </div><br><br>
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="publish" id="publish" ng-init="publish = '<?php echo $publish; ?>'" <?php if($publish == 1){ echo 'checked = "checked"';} ?>  />
                        <?php echo $this->lang->line('label_publish_on_website');?>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group"><br>
                    <?php echo $this->lang->line('label_route');?>
                    <input type="text" name="route" id="route" ng-init="route = '<?php echo $route; ?>'" value="<?php echo $route;?>" class="form-control" maxlength="25">
                </div>
            </div>
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_job_opening_status','' , 'statuses' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_status');?></label>
                    <span class="mandatory">*</span>     
                    <!--<?php 
                    $attrib = 'class="form-control select2" id="job_opening_status_id" ng-model="job_opening_status_id" required';
                    echo form_dropdown('job_opening_status_id', $jobstatusDropdown, set_value('job_opening_status_id', (isset($job_opening_status_id)) ? $job_opening_status_id : ''), $attrib);
                    if(form_error('job_opening_status_id')){ echo '<span class="help-block">'.form_error('job_opening_status_id').'</span>';} ?>-->

                    <select name="job_opening_status_id" ng-init="job_opening_status_id = '<?php echo $job_opening_status_id; ?>'" ng-model="job_opening_status_id" id="job_opening_status_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="job_opening_status_id in statuses" value="{{job_opening_status_id.job_opening_status_id}}">{{job_opening_status_id.status}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.job_opening_status_id.$error.required"><?php echo $this->lang->line('required');?></span>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_description');?></label>
                    <textarea name="description" row="5" columns="10" class="form-control" ng-init="description = '<?php echo $description; ?>'"><?php echo $description;?></textarea>
                    <span class="help-block"><?php echo form_error('description')?></span>
                </div>
            </div>
        </div>    
       <!-- <div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('hr/Recruitment/Job_opening') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
        </div>-->
        <div class="modal-footer">
                <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
                <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform', 'showuniqueMsgs')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>