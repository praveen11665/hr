<?php
$ci =&get_instance();
$namingSeriesdrop           =  $ci->mdrop->namingSeriesdrop('7');
$statusDropdown             =  $ci->mcommon->Dropdown('def_hr_appraisal_status', array('appraisal_status_id as Key', 'status as Value'));
$appraisalTemplateDropdown  =  $ci->mcommon->Dropdown('hr_appraisal_template', array('appraisal_template_id as Key', 'appraisal_temp_title as Value'), array('is_delete' => 0));
$employeeNameDropdown       =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'naming_series as Value'), array('is_delete' => 0));
$companyDropdown            =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name      as Value'), array('is_delete' => 0));

//Variable Initialize
$appraisal_id               =   "";
$naming_series              =   "";
$appraisal_template_id      =   "";
$employee_id                =   "";
$employee_name              =   "";
$status                     =   "";
$start_date                 =   "";
$end_date                   =   "";
$goals                      =   "";
$score                      =   "";
$company_id                 =   "";
$total_score                =   "";
$appraisal_temp_title       =   "";
$score                      =   "";
$remarks                    =   "";
$kra                        =   array();
$weight_age                 =   array();
$score_earned               =   array();
$appraisal_goal_id          =   array();

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $appraisal_id                   =   $row->appraisal_id;
        $naming_series                  =   $row->naming_series;
        $appraisal_template_id          =   $row->appraisal_template_id;
        $employee_id                    =   $row->employee_id;
        $start_date                     =   $row->start_date;
        $end_date                       =   $row->end_date;
        $employee_name                  =   $row->employee_name;
        $appraisal_status_id            =   $row->appraisal_status_id;
       // $employee_id                    =   $row->employee_id;
        $goals                          =   $row->goals;
        $score                          =   $row->score;
        $company_id                     =   $row->company_id;
        $total_score                    =   $row->total_score;
        $remarks                        =   $row->remarks;
    }

    $naming_seriesArr =   explode('/', $naming_series);
    foreach ($naming_seriesArr as $key => $value) 
    {
        $set_options    =   $naming_seriesArr[0];
    }
    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '7'), 'naming_series_id');

    $naming_option      =   $source_id."_".$set_options; 
}
else
{
    $appraisal_id                       =   $this->input->post('appraisal_id');
    $appraisal_template_id              =   $this->input->post('appraisal_template_id');
    $employee_id                        =   $this->input->post('employee_id');    
    $start_date                         =   $this->input->post('start_date');
    $end_date                           =   $this->input->post('end_date');
    $employee_name                      =   $this->input->post('employee_name');
    $appraisal_status_id                =   $this->input->post('appraisal_status_id');
    $employee_id                        =   $this->input->post('employee_id');  
    $goals                              =   $this->input->post('goals');
    $score                              =   $this->input->post('score');
    $company_id                         =   $this->input->post('company_id'); 
    $total_score                        =   $this->input->post('total_score');
    $remarks                            =   $this->input->post('remarks'); 
}

if(!empty($tableDataGoal))
{
    foreach ($tableDataGoal as $row )
    {
        $appraisal_goal_id[]          =   $row->appraisal_goal_id;
        $kra[]                        =   $row->kra;
        $weight_age[]                 =   $row->weight_age; 
        $score[]                      =   $row->score; 
        $score_earned[]               =   $row->score_earned; 
        $trowAppraisalgoal++;             
    }
}
else
{
    $kra                       = $this->input->post('kra');
    $weight_age                = $this->input->post('weight_age');
    $score                     = $this->input->post('score');
    $score_earned              = $this->input->post('score_earned');
}
$trowAppraisalgoal = count($kra) ? count($kra):'1';
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Appraisals_page_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="appraisal_id" id="appraisal_id" value="<?php echo $appraisal_id;?>">
        <div class="row">
         	<div class="col-md-4" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/7')">
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
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_appraisal_template',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'appraisal_templates' )"  >
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_appraisal_template');?></label>
                    <span class="mandatory">*</span> 
                    <a class="add-new-popup" onclick="">+</a>

                    <!--<?php 
                        $attrib = 'class="form-control select2" id="appraisal_template_id" onchange = "getAppraisalTemplate()" ng-model="appraisal_template_id" required';
                        echo form_dropdown('appraisal_template_id', $appraisalTemplateDropdown, set_value('appraisal_template_id', (isset($appraisal_template_id)) ? $appraisal_template_id : ''), $attrib);
                        if(form_error('appraisal_template_id')){ echo '<span class="help-block">'.form_error('appraisal_template_id').'</span>';} 
                    ?>-->

                    <select name="appraisal_template_id" ng-init="appraisal_template_id = '<?php echo $appraisal_template_id; ?>'"  ng-model="appraisal_template_id" id="appraisal_template_id" class="form-control"  onchange = "getAppraisalTemplate()" required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="appraisal_template_id in appraisal_templates" value="{{appraisal_template_id.appraisal_template_id}}">{{appraisal_template_id.appraisal_temp_title}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.appraisal_template_id.$error.required"><?php echo $this->lang->line('required');?></span>
  
                </div>
            </div>
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employee',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employees' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_for_employee');?></label>     
                    <span class="mandatory">*</span> 
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="employee_id" onchange = "loademployeename()" ng-model="employee_id" required';
                        echo form_dropdown('employee_id', $employeeNameDropdown, set_value('employee_id', (isset($employee_id)) ? $employee_id : ''), $attrib);
                        if(form_error('employee_id')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';} 
                    ?>-->
                    <select name="employee_id" ng-model="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" id="employee_id" class="form-control"  onchange = "loademployeename()"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="employee_id in employees" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>
                
                </div>
            </div>
        </div>
        <!--Second Row-->
		<div class="row">
			<div class="col-md-4">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_employee_name');?> </label>
                    <input type="text" name="employee_name" id="employee_name" ng-init="employee_name = '<?php echo $employee_name; ?>'" value="<?php echo $employee_name;?>" class="form-control" readonly/>
                    <span class="help-block"><?php echo form_error('employee_name')?></span>
                </div>
            </div>
			<div class="col-sm-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_appraisal_status', '' , 'appraisal_statuses' )"  >
                <div class="form-group">
                    <label ><?php echo $this->lang->line('label_status');?> </label>
                    <span class="mandatory">*</span> 
                    <!--<?php 
                    $attrib = 'class="form-control select2" id="appraisal_status_id" ng-model="appraisal_status_id" required';
                    echo form_dropdown('appraisal_status_id', $statusDropdown, set_value('appraisal_status_id', (isset($appraisal_status_id)) ? $appraisal_status_id : ''), $attrib);
                    if(form_error('appraisal_status_id')){ echo '<span class="help-block">'.form_error('appraisal_status_id').'</span>';} ?>-->
                    <select name="appraisal_status_id" ng-model="appraisal_status_id" ng-init="appraisal_status_id = '<?php echo $appraisal_status_id; ?>'" id="appraisal_status_id" class="form-control" onchange="loadLoanDetails()" required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="appraisal_status_id in appraisal_statuses" value="{{appraisal_status_id.appraisal_status_id}}">{{appraisal_status_id.status}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.appraisal_status_id.$error.required"><?php echo $this->lang->line('required');?></span>
                               
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="start_date"><?php echo $this->lang->line('label_start_date');?> </label>
                    <span class="mandatory">*</span> 
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="start_date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $start_date?>', 'start_date')" value="{{start_date | date:'dd-MM-yyyy' }}" name="start_date"  ng-focus="open('popup1')"/>
                    <span class="help-block" ng-show="showMsgs && myform.start_date.$error.required"><?php echo $this->lang->line('required');?></span>

                </div>
            </div>                        
		</div>
        <!--Third Row-->
		<div class="row">
			<div class="col-md-4">
                <div class="form-group">
                    <label for="end_date"><?php echo $this->lang->line('label_end_date');?> </label>
                    <span class="mandatory">*</span> 
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="end_date" is-open="popup3.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $end_date?>', 'end_date')" value="{{end_date | date:'dd-MM-yyyy' }}" name="end_date"  ng-focus="open('popup3')"/>
                    <span class="help-block" ng-show="showMsgs && myform.end_date.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
		</div>
        <fieldset>
            <legend><span> <?php echo lang('label_goals');?> </span></legend>
            <div class="row">
                <div class="col-sm-12">
                    <table  class="table table-bordered" id ="template_goal">
                        <thead>
                            <tr>
                                <!--<th><input type="checkbox" name=""></th>-->
                                <th><?php echo lang('label_goals');?></th>
                                <th><?php echo $this->lang->line('label_weight_age');?></th>
                                <th><?php echo $this->lang->line('label_score');?></th>
                                <th><?php echo $this->lang->line('label_score_earned');?></th>
                            </tr>         
                        </thead>
                        
                        <tbody class="all_row_values">
                        <?php 
                            $is=1;
                            for($in=0; $in < $trowAppraisalgoal; $in++)
                            {
                                ?>
                                    <tr>
                                        <!--<td>
                                            <input type="checkbox" class="app_cbx" id="app_cbx<?php echo $in;?>" data-name="app_cbx" data-row="<?php echo $in;?>" value="<?php echo $appraisal_goal_id[$in];?>"/>
                                            <input type="hidden" name="appraisal_goal_id[]" value="<?php echo $appraisal_goal_id[$in];?>" data-row="<?php echo $in;?>" id="appraisal_goal_id<?php echo $in;?>" data-name="appraisal_goal_id">
                                        </td>-->
                                        <td>
                                            <input type="text" name="kra[]" id="kra<?php echo $in;?>" ng-init="kra = '<?php echo $kra[$in]; ?>'" data-name="kra" data-row="<?php echo $in;?>" value="<?php echo $kra[$in];?>" class="form-control kra" />
                                        </td>
                                        <td>
                                            <input type="text" name="weight_age[]" ng-init="weight_age = '<?php echo $weight_age[$in]; ?>'" data-name="weight_age" id="weight_age<?php echo $in;?>"  data-row="<?php echo $in;?>" value="<?php echo $weight_age[$in];?>" class="form-control weight_age" onkeyup ="calculateScore()" onkeypress="return isNumberKey(event)"/>
                                        </td>
                                        <td> 
                                            <input type="text" name="score[]" data-name="score" data-row="<?php echo $in;?>" id="score<?php echo $in;?>" ng-init="score = '<?php echo $score[$in]; ?>'" value="<?php echo $score[$in]; ?>" class="form-control score" onkeyup ="calculateScore()" onkeypress="return isNumberKey(event)"/>
                                        </td>
                                        <td>
                                            <input type="text" name="score_earned[]" data-row="<?php echo $in;?>" id="score_earned<?php echo $in;?>" data-name="score_earned" ng-init="score_earned = '<?php echo $score_earned[$in]; ?>'" value="<?php echo $score_earned[$in]; ?>" class="form-control score_earned" onkeyup ="calculateScore()" onkeypress="return isNumberKey(event)"/>
                                        </td>
                                    </tr>
                                <?php                      
                            $is++;
                            } 
                        ?> 
                        </tbody>                  
                    </table>
                </div>
            </div> 
        </fieldset>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <!--<div class="col-sm-6">
                        <div class="form-group">
                            <button class="btn btn-info" type="submit" name="calculate_total_score">Calculate Total Score</button>
                        </div>
                    </div>-->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_score');?></label>
                            <input type="text" class="form-control" name="total_score" ng-init="total_score = '<?php echo $total_score[$in]; ?>'" value = "<?php echo $total_score;?>" id ="total_score" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'companies' )">
                        <div class="form-group">
                            <label for="employee_name"><?php echo $this->lang->line('label_company');?>  </label>
                            <span class="mandatory">*</span>
                            <!--<?php 
                                $attrib = 'class="form-control select2" id="company_id" ng-model="company_id" required';
                                echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);
                                if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} 
                            ?>-->
                            <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control" required select2>
                                  <option value="">-- Select --</option>  
                                  <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
                             </select> 
                            <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>
                           
                        </div> 
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_remark');?></label>
                            <textarea class="form-control" name="remarks" ng-init="remarks = '<?php echo $remarks[$in]; ?>'"><?php echo $remarks;?></textarea> 
                            <span class="help-block"><?php echo form_error('remarks')?></span>
                        </div>
                    </div>
                </div>                
            </div>
        </div> 
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>