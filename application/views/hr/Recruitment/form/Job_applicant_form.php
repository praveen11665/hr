<?php
$ci =&get_instance();
$jobstatusDropdown      =  $ci->mcommon->Dropdown('def_hr_job_applicant_status', array('job_applicant_status_id as Key', 'status as Value'));
$jobOpeningDropdown     =  $ci->mcommon->Dropdown('hr_job_opening', array('job_opening_id as Key', 'job_title as Value'), array('is_delete' => 0));
 //Variable Initailize
 $job_applicant_id          = "";
 $applicant_name            = "";
 $email_id                  = "";
 $job_applicant_status_id   = "";
 $job_opening_id            = "";
 $cover_letter              = "";
 $contact_number            = "";
 $total_experience          = "";
 $current_ctc               = "";
 $expected_ctc              = "";
 $technical_skills          = "";
 $resume_attachment         = "";
 
if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $job_applicant_id         =  $row->job_applicant_id;
        $applicant_name           =  $row->applicant_name;
        $email_id                 =  $row->email_id;
        $job_applicant_status_id  =  $row->job_applicant_status_id;
        $job_opening_id           =  $row->job_opening_id;
        $cover_letter             =  $row->cover_letter;
        $contact_number           =  $row->contact_number;
        $total_experience         =  $row->total_experience;
        $current_ctc              =  $row->current_ctc;
        $expected_ctc             =  $row->expected_ctc;
        $technical_skills         =  $row->technical_skills;
        $resume_attachment        =  $row->resume_attachment;
    }
}
else
{
    $job_applicant_id        =   $this->input->post('job_applicant_id');
    $applicant_name          =   $this->input->post('applicant_name');
    $email_id                =   $this->input->post('email_id');
    $job_applicant_status_id =   $this->input->post('job_applicant_status_id');
    $job_opening_id          =   $this->input->post('job_opening_id');
    $cover_letter            =   $this->input->post('cover_letter');
    $contact_number          =   $this->input->post('contact_number');
    $total_experience        =   $this->input->post('total_experience');
    $current_ctc             =   $this->input->post('current_ctc');
    $expected_ctc            =   $this->input->post('expected_ctc');
    $technical_skills        =   $this->input->post('technical_skills');
    $resume_attachment       =   $this->input->post('resume_attachment');
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Job_applicant_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">          
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelFormWithFile" enctype="multipart/form-data" name="myform">
      <input type="hidden" name="job_applicant_id" id="job_applicant_id" value="<?php echo $job_applicant_id;?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_applicant_name');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="applicant_name" maxlength="20" id="applicant_name" ng-init="applicant_name = '<?php echo $applicant_name; ?>'" value="<?php echo $applicant_name;?>" class="form-control" ng-model="applicant_name" ng-pattern="/^[a-zA-Z\s]*$/" required allow-characters/>
                    <span class="help-block" ng-show="showMsgs && myform.applicant_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.applicant_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('applicant_name')?></span>
                </div>
            </div>
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_job_opening',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'jobOpenings' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_job_opening');?></label>
                    <a class="add-new-popup" onclick="">+</a>
                    <!--<?php 
                    $attrib = 'class="form-control select2" id="job_opening_id"';
                    echo form_dropdown('job_opening_id', $jobOpeningDropdown, set_value('   job_opening_id', (isset($job_opening_id)) ? $job_opening_id : ''), $attrib);
                    if(form_error('job_opening_id')){ echo '<span class="help-block">'.form_error('job_opening_id').'</span>';} 
                    ?>-->
                    <select name="job_opening_id" ng-init="job_opening_id = '<?php echo $job_opening_id; ?>'" ng-model="job_opening_id" id="job_opening_id" class="form-control" select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="job_opening_id in jobOpenings" value="{{job_opening_id.job_opening_id}}">{{job_opening_id.job_title}}</option>  
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_email_address');?></label>
                    <span class="mandatory">*</span>
                        <input type="email" name="email_id" id="email_id" maxlength="25" ng-init="email_id = '<?php echo $email_id; ?>'" value="<?php echo $email_id;?>" class="form-control" ng-model="email_id" required ng-keyup="emailUnique('../../Common_controller/emailUnique/hr_job_applicant', email_id, 'email_id')"/>
                    <span class="help-block" ng-show="showMsgs && myform.email_id.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.email_id.$error.email"><?php echo $this->lang->line('email_val');?></span>
                    <span class="help-block"><?php echo form_error('email_id')?></span>
                    <span class="help-block" ng-show="showEmailuniqueMsgs">{{email_id}} already in use</span>
                </div>
            </div>
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_job_applicant_status','' , 'statuses' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_status');?></label>
                    <span class="mandatory">*</span>
                    <!--<?php 
                    $attrib = 'class="form-control select2" id="job_applicant_status_id" ng-model="job_applicant_status_id" required';
                    echo form_dropdown('job_applicant_status_id', $jobstatusDropdown, set_value('job_applicant_status_id', (isset($job_applicant_status_id)) ? $job_applicant_status_id : ''), $attrib);
                    if(form_error('job_applicant_status_id')){ echo '<span class="help-block">'.form_error('job_applicant_status_id').'</span>';} 
                    ?>-->

                    <select name="job_applicant_status_id" ng-init="job_applicant_status_id = '<?php echo $job_applicant_status_id; ?>'" ng-model="job_applicant_status_id" id="job_applicant_status_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="job_applicant_status_id in statuses" value="{{job_applicant_status_id.job_applicant_status_id}}">{{job_applicant_status_id.status}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.job_applicant_status_id.$error.required"><?php echo $this->lang->line('required');?></span>

                </div>
            </div>
        </div>
        <div class="row">                    
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_cover_letter');?></label>
                    <span class="mandatory">*</span>
                    <textarea class="form-control" rows="5" ng-init="cover_letter = '<?php echo $cover_letter; ?>'" name="cover_letter" id="cover_letter" ng-model="cover_letter" required><?php echo $cover_letter;?></textarea>
                    <span class="help-block"><?php echo form_error('cover_letter')?></span>
                    <span class="help-block" ng-show="showMsgs && myform.cover_letter.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_contact_number');?></label>
                    <span class="mandatory">*</span>
                        <input type="text" name="contact_number" id="contact_number" ng-init="contact_number = '<?php echo $contact_number; ?>'" value="<?php echo $contact_number;?>" class="form-control" onkeypress="return isNumberKey(event)" ng-model="contact_number" ng-pattern="/^[0-9]{10}$/" maxlength="10" required ng-keyup="checkUnique('../../Common_controller/checkUnique/hr_job_applicant', contact_number, 'contact_number')"/>
                    <span class="help-block" ng-show="showMsgs && myform.contact_number.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.contact_number.$error.pattern">Please Given Valid contact no</span>
                    <span class="help-block"><?php echo form_error('contact_number')?></span>
                    <span class="help-block" ng-show="showuniqueMsgs">{{contact_number}} already in use</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_total_experience');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="total_experience" maxlength="20" ng-init="total_experience = '<?php echo $total_experience; ?>'" id="total_experience" value="<?php echo $total_experience;?>" class="form-control" ng-model="total_experience" required onkeypress = "return IsAlphaNumeric(event)"/>

                    <span class="help-block" ng-show="showMsgs && myform.total_experience.$error.required"><?php echo $this->lang->line('required');?></span>                
                    <span class="help-block"><?php echo form_error('total_experience')?></span>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_current_CTC');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="current_ctc" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" step="0.001" id="current_ctc" ng-init="current_ctc = '<?php echo $current_ctc; ?>'" value="<?php echo $current_ctc;?>" class="form-control" ng-model="current_ctc" maxlength="10" required onkeydown="return allowNonZeroIntegers(event)" onselect="return disallowKeys(event)"/>
                    <span class="help-block"><?php echo form_error('current_ctc')?></span>
                    <span class="help-block" ng-show="showMsgs && myform.current_ctc.$error.required"><?php echo $this->lang->line('required');?></span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_expected_CTC');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="expected_ctc" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" step="0.001" id="expected_ctc" ng-init="expected_ctc = '<?php echo $expected_ctc; ?>'" value="<?php echo $expected_ctc;?>" class="form-control" ng-model="expected_ctc" maxlength="10" required onkeydown="return allowNonZeroIntegers(event)"/>
                    <span class="help-block"><?php echo form_error('expected_ctc')?></span>
                    <span class="help-block" ng-show="showMsgs && myform.expected_ctc.$error.required"><?php echo $this->lang->line('required');?></span>

                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_technical_skills');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="technical_skills" maxlength="45" id="technical_skills" ng-init="technical_skills = '<?php echo $technical_skills; ?>'" value="<?php echo $technical_skills;?>" class="form-control" ng-model="technical_skills" required/>
                    <span class="help-block"><?php echo form_error('technical_skills')?></span>
                    <span class="help-block" ng-show="showMsgs && myform.technical_skills.$error.required"><?php echo $this->lang->line('required');?></span>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="input-file-1"><?php echo $this->lang->line('label_resume_attachment');?></label>
                    <span class="mandatory">*</span>
                    <input type="file" name="resume_attachment" ng-model="resume_attachment" id="resume_attachment"  accept="application/pdf"  value="<?php echo $resume_attachment;?>"  class="form-control" <?php echo ($resume_attachment)? '' : 'required';?>/>
                    <!--<span class="help-block" ng-show="showMsgs && myform.resume_attachment.$error.required"><?php echo $this->lang->line('required');?></span>-->
                </div>
            </div> 
            <div class="col-md-6"><br><br>
                <?php
                    if($resume_attachment != '')
                    {
                        ?>
                        <a class="btn btn-primary" href="<?php echo base_url($resume_attachment);?>" target="_blank">View Resume</a>
                        <?php
                    }
                ?>
            </div>
        </div> 
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform', 'showEmailuniqueMsgs', 'showuniqueMsgs')"><?php echo $this->lang->line('label_submit');?></button>
        </div>                 
    </form>
</div>
<script type="text/javascript">
    function disallowKeys(e) 
    {
        return false
    }
</script>