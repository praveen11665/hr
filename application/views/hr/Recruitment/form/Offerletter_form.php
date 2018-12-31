<?php
$ci =&get_instance();
$jobApplicantDropdown       =  $ci->mcommon->Dropdown('hr_job_applicant', array('job_applicant_id as Key', 'applicant_name as Value'),array('is_delete' => 0));
$jobstatusDropdown          =  $ci->mcommon->Dropdown('def_hr_offer_letter_status', array('offer_letter_status_id as Key', 'status as Value'));
$designationDropdown        =  $ci->mcommon->Dropdown('hr_designation', array('designation_id as Key', 'designation_name as Value'), array('is_delete' => 0));
$companyDropdown            =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name      as Value'), array('is_delete' => 0));
$termsConditionsDropdown    =  $ci->mcommon->Dropdown('set_terms_conditions', array('tc_id as Key', 'title as Value'), array('is_delete' => 0));

//Variable Initialize
$offer_letter_id            = "";
$job_applicant_id           = "";
$applicant_name             = "";
$offer_letter_status_id     = "";
$offer_date                 = "";
$designation_id             = "";
$company_id                 = "";
$tc_id                      = "";
$terms                      = "";
$offer_term                 = array();
$value                      = array();
$offer_letter_term_id       = array();
 
if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $offer_letter_id            = $row->offer_letter_id;
        $job_applicant_id           = $row->job_applicant_id;
        $applicant_name             = $row->applicant_name;
        $offer_letter_status_id     = $row->offer_letter_status_id;
        $offer_date                 = $row->offer_date;
        $designation_id             = $row->designation_id;
        $company_id                 = $row->company_id;
        $tc_id                      = $row->tc_id;
        $terms                      = $row->terms;
    }      
}
else
{
    $offer_letter_id            = $this->input->post('offer_letter_id');
    $job_applicant_id           = $this->input->post('job_applicant_id');
    $applicant_name             = $this->input->post('applicant_name');
    $offer_letter_status_id     = $this->input->post('offer_letter_status_id');
    $offer_date                 = $this->input->post('offer_date');
    $designation_id             = $this->input->post('designation_id');
    $company_id                 = $this->input->post('company_id');
    $tc_id                      = $this->input->post('tc_id');
    $terms                      = $this->input->post('terms');    
}

$contentData = $this->mcommon->records_all('hr_offer_letter_term', array('offer_letter_id' => $offer_letter_id));

if (!empty($contentData)) 
{
    foreach ($contentData as $row) 
    {
        $offer_letter_id              = $row->offer_letter_id;
        $offer_letter_term_id[]       = $row->offer_letter_term_id;
        $offer_term[]                 = $row->offer_term;
        $value[]                      = $row->value;
        $rowOffer++;
    }
}
else
{
    $offer_letter_term_id       = $this->input->post('offer_letter_term_id');
    $offer_term                 = $this->input->post('offer_term');
    $value                      = $this->input->post('value');
}
$rowOffer           = count($offer_term) ? count($offer_term):'1';
$checkDisable       = ($offer_letter_id == '') ? 'disabled' : '';
?>   
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Offerletter_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">               
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="offer_letter_id" id="offer_letter_id" value="<?php echo $offer_letter_id;?>">
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_job_applicant',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'jobApplicants' )"> 
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_job_applicant');?></label>
                    <span class="mandatory">*</span>
                    <a class="add-new-popup" onclick="">+</a>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="job_applicant_id" ng-model="job_applicant_id" required onchange="loadjobapplicantname()"';
                        echo form_dropdown('job_applicant_id', $jobApplicantDropdown, set_value('job_applicant_id', (isset($job_applicant_id)) ? $job_applicant_id : ''), $attrib);
                        if(form_error('job_applicant_id')){ echo '<span class="help-block">'.form_error('job_applicant_id').'</span>';} 
                    ?>--->
                    <select name="job_applicant_id" ng-init="job_applicant_id = '<?php echo $job_applicant_id; ?>'" ng-model="job_applicant_id" id="job_applicant_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="job_applicant_id in jobApplicants" value="{{job_applicant_id.job_applicant_id}}">{{job_applicant_id.applicant_name}}</option>  
                    </select> 
                    <span class="help-block" ng-show="showMsgs && myform.job_applicant_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_offer_letter_status','' , 'jobStatuses' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_status');?></label>
                    <span class="mandatory">*</span>                               
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="offer_letter_status_id" ng-model="offer_letter_status_id" required';
                        echo form_dropdown('offer_letter_status_id', $jobstatusDropdown, set_value('offer_letter_status_id', (isset($offer_letter_status_id)) ? $offer_letter_status_id : ''), $attrib);
                        if(form_error('offer_letter_status_id')){ echo '<span class="help-block">'.form_error('offer_letter_status_id').'</span>';} 
                    ?>-->
                    <select name="offer_letter_status_id" ng-init="offer_letter_status_id = '<?php echo $offer_letter_status_id; ?>'" ng-model="offer_letter_status_id" id="offer_letter_status_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="offer_letter_status_id in jobStatuses" value="{{offer_letter_status_id.offer_letter_status_id}}">{{offer_letter_status_id.status}}</option>  
                    </select>                 
                    <span class="help-block" ng-show="showMsgs && myform.offer_letter_status_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_applicant_name');?><span class="mandatory">*</span></label>
                    <input type="text" ng-model="applicant_name" name="applicant_name" ng-init="applicant_name = '<?php echo $applicant_name; ?>'" id="applicant_name" value="<?php echo $applicant_name;?>" class="form-control" allow-characters maxlength="25" required/>
                    <span class="help-block" ng-show="showMsgs && myform.applicant_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error('applicant_name')?></span>
                </div>
            </div>       
            <div class="col-md-6"> 
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_offer_date');?></label>
                    <span class="mandatory">*</span><br>
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="offer_date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $offer_date?>', 'offer_date')" value="{{offer_date | date:'dd-MM-yyyy' }}" name="offer_date"  ng-focus="open('popup1')" min-date="mindate"/>
                    <span class="help-block" ng-show="showMsgs && myform.offer_date.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_designation',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'designs' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_designation');?></label>
                    <span class="mandatory">*</span>                               
                    <!--<?php 
                    $attrib = 'class="form-control select2" id="designation_id" ng-model="designation_id" required';
                    echo form_dropdown('designation_id', $designationDropdown, set_value('designation_id', (isset($designation_id)) ? $designation_id : ''), $attrib);
                    if(form_error('designation_id')){ echo '<span class="help-block">'.form_error('designation_id').'</span>';} 
                    ?>-->
                    <select name="designation_id" ng-init="designation_id = '<?php echo $designation_id; ?>'" ng-model="designation_id" id="designation_id" class="form-control"  required select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="designation_id in designs" value="{{designation_id.designation_id}}">{{designation_id.designation_name}}</option>  
                    </select> 
                    <span class="help-block" ng-show="showMsgs && myform.designation_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'companies' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_company');?></label>
                    <span class="mandatory">*</span>                               
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="company_id" ng-model="company_id" required';
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
        </div>
        <hr>
        <table class="table table-bordered"> 
                <thead>
                    <tr>
                        <!--<th><input type="checkbox" ></th>-->
                        <th></th>
                        <th><?php echo $this->lang->line('label_offer_terms');?></th>
                        <th><?php echo $this->lang->line('label_value/description');?></th>
                    </tr>
                </thead>
                <tbody id="terms_conditions">
                    <?php 
                    $is=1;
                    for($in=0; $in < $rowOffer; $in++)
                    {
                    ?>
                     <tr>
                        <td>
                            <input type="checkbox" class="offer_letter_cbx" id="offer_letter_cbx<?php echo $in;?>" data-name="offer_letter_cbx" data-row="<?php echo $in;?>" value="<?php echo $offer_letter_term_id[$in];?>" onclick="checkDeleteButton('offer_letter_cbx', 'add_delete');" <?php echo $checkDisable;?>/>
                            <input type="hidden" name="offer_letter_term_id[]" id="offer_letter_term_id<?php echo $in;?>" data-name="offer_letter_term_id" value="<?php echo $offer_letter_term_id[$in];?>" data-row="<?php echo $in;?>">
                        </td>
                        <td>
                            <input type="text" class="form-control" ng-init="offer_term = '<?php echo $offer_term[$in]; ?>'" name="offer_term[]" id="offer_term<?php echo $in;?>" value="<?php echo $offer_term[$in];?>" data-name="offer_term" data-row="<?php echo $in;?>">
                        </td>
                        <td>
                            <textarea rows="2" cols="7" class="form-control" ng-init="value = '<?php echo $value[$in]; ?>'" id="value<?php echo $in;?>" name="value[]" data-name="value" data-row="<?php echo $in;?>"><?php echo $value[$in];?></textarea>
                        </td>
                    </tr>
                    <?php                      
                        $is++;
                        } 
                    ?> 
                 </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <button class="btn btn-primary" type="button" onclick="addNewRow('terms_conditions');" > <?php echo $this->lang->line('label_add_row');?> </button>
                            <input type="button" class="btn btn-danger add_delete" id="button" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('terms_conditions', 'offer_letter_cbx', 'hr_offer_letter_term', 'offer_letter_term_id');" disabled>
                        </td>
                    </tr>
                </tfoot>
        </table> 
        <hr>      
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_terms_conditions',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'terms' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_select_terms');?></label>
                    <a class="add-new-popup" onclick="">+</a>
                    <span class="mandatory">*</span>                
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="tc_id" ng-model="tc_id" required';
                        echo form_dropdown('tc_id', $termsConditionsDropdown, set_value('tc_id', (isset($tc_id)) ? $tc_id : ''), $attrib);
                        if(form_error('tc_id')){ echo '<span class="help-block">'.form_error('tc_id').'</span>';} 
                    ?>-->  
                    <select name="tc_id" ng-init="tc_id = '<?php echo $tc_id; ?>'" ng-model="tc_id" id="tc_id" class="form-control"  required select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="tc_id in terms" value="{{tc_id.tc_id}}">{{tc_id.title}}</option>  
                    </select> 
                    <span class="help-block" ng-show="showMsgs && myform.tc_id.$error.required"><?php echo $this->lang->line('required');?></span>  
                </div>   
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_terms');?></label>
                    <span class="mandatory">*</span>
                    <textarea name="terms" cols="40" rows="3" id="terms" class="form-control" ng-model="termsCondition" required ng-init="termsCondition = '<?php echo $terms;?>'"><?php echo $terms;?></textarea>
                    <span class="help-block" ng-show="showMsgs && myform.terms.$error.required"><?php echo $this->lang->line('required');?></span> 
                    <span class="help-block"><?php echo form_error('terms')?></span>
                </div>
            </div>
        </div>
                     
        <!--<div class="col-md-6">  
            <div class="form-group">
                <label><?php echo $this->lang->line('label_schedule_date_time');?></label>
                <span class="mandatory">*</span><br>
                <input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="schedule_date_time" is-open="popup2.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $schedule_date_time?>', 'schedule_date_time')" value="{{schedule_date_time | date:'dd-MM-yyyy' }}" name="schedule_date_time"  ng-focus="open('popup2')"/>
                <span class="help-block" ng-show="showMsgs && myform.schedule_date_time.$error.required"><?php echo $this->lang->line('required');?></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10"> 
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_terms');?></label>
                    <span class="mandatory">*</span>
                    <textarea rows="8" cols="30" name="terms" id="terms" class="form-control" ng-model="termsCondition" required  ng-init="termsCondition = <?php echo $terms;?>"><?php echo $terms;?></textarea>
                    <span class="help-block" ng-show="showMsgs && myform.terms.$error.required"><?php echo $this->lang->line('required');?></span> 
                    <span class="help-block"><?php echo form_error('terms')?></span>
                </div>
            </div><br><br> 
            <div class="col-md-2">      
                <div class="form-group">
                    <button type="button" href=""><?php echo $this->lang->line('label_Send_offer_letter');?></button> 
                </div>
            </div>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>