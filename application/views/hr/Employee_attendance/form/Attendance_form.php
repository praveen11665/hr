<?php 
$ci =&get_instance();
$namingSeriesdrop			=  $ci->mdrop->namingSeriesdrop(4);
$companyDropdown  			=  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'), array('is_delete' => 0));
$attendanceStatusDropdown  	=  $ci->mcommon->Dropdown('def_hr_employee_attendance', array('employee_attendance_status_id as Key', 'status as Value'));
$employeeDropdown  			=  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_number as Value'), array('is_delete' => 0));

//Variable Initialization
$employee_attendance_id    	    = "";
$naming_series       			= ""; 
$employee_id       			    = ""; 
$employee_name       			= ""; 
$employee_attendance_status_id  = "";
$attendance_date      			= ""; 
$company_id      				= "";  

if(!empty($tableData))
{
    foreach($tableData as $row) 
    {
     	$employee_attendance_id     			= $row->employee_attendance_id;          
        $naming_series     						= $row->naming_series;
        $employee_id     						= $row->employee_id;
        $employee_name     						= $row->employee_name;
        $employee_attendance_status_id          = $row->employee_attendance_status_id;
        $attendance_date      					= $row->attendance_date;  
        $company_id     						= $row->company_id;
    }

    $naming_seriesArr =   explode('/', $naming_series);
    foreach ($naming_seriesArr as $key => $value) 
    {
        $set_options    =   $naming_seriesArr[0];
    }
    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '4'), 'naming_series_id');

    $naming_option      =   $source_id."_".$set_options;
}
else
{
 	$employee_attendance_id      				= $this->input->post('employee_attendance_id');
 	$employee_id      							= $this->input->post('employee_id');
    $employee_name      						= $this->input->post('employee_name');
    $employee_attendance_status_id      		= $this->input->post('employee_attendance_status_id');
    $attendance_date      						= $this->input->post('attendance_date');
    $company_id      							= $this->input->post('company_id'); 
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('attendance_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
      <input type="hidden" name="employee_attendance_id" id="employee_attendance_id" value="<?php echo $employee_attendance_id;?>"/>
    	<div class="row">
    		<div class="col-md-6" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/4')">
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
    			<label><?php echo lang('label_attendance_attendance_date');?></label>
    			<span class="mandatory">*</span>
    			<div class="form-group">                
    			    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="attendance_date" id="attendance_date" is-open="popup1.opened" datepicker-options="pastYearfutureDateOptions" ng-required="true" data-ng-init="init('<?php echo $attendance_date?>', 'attendance_date')" value="{{attendance_date | date:'dd-MM-yyyy' }}" name="attendance_date"  ng-focus="open('popup1')" ng-change="checkAttentance('../../../Common_controller/checkAttentance/hr_employee_attendance', 'employee_id', 'attendance_date')"/>
    	            <span class="help-block" ng-show="showMsgs && myform.attendance_date.$error.required"><?php echo $this->lang->line('required');?></span>                
        		</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employee',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employees' )" >
    			<div class="form-group">
    				<label><?php echo lang('label_attendance_employee_id');?></label>
    				<span class="mandatory">*</span>    				
    				<select name="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" ng-model="employee_id" id="employee_id" class="form-control" required select2 onchange="loademployeename()" ng-change="checkAttentance('../../../Common_controller/checkAttentance/hr_employee_attendance', 'employee_id', 'attendance_date')">
                        <option value="">-- Select --</option>  
                        <option ng-repeat="employee_id in employees" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option>  
                    </select>
    				<span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span> 
    			</div>
    		</div>
    		<div class="col-md-6">
    			<div class="form-group">
                	<label><?php echo lang('label_attendance_employee_name');?></label><br>
                    <input type='text' name ="employee_name" id="employee_name" ng-model="employee_name" ng-init="employee_name = '<?php echo $employee_name; ?>'" value="<?php echo $employee_name;?>" class="form-control"  readonly />
                    {{employee_name}}
                    <span class="help-block"><?php echo form_error("employee_name")?></span>
                    <span class="help-block" ng-show="showattenMsgs">For this employee already attendance updated for {{attendance_date | date:'dd-MM-yyyy' }}</span>

        		</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'companies' )" >
    			<div class="form-group">
    				<label><?php echo lang('label_attendance_company');?></label>
    					<!--<?php 
    				    $attrib = 'class="form-control select2" id="company_id" ng-model="company_id" required';
    				    echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);
    				    if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} 
    					?>-->
                        <input type="hidden" name="company_id" id="company_id_hidden" value="<?php echo $company_id; ?>">
    					<select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control" select2 disabled>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
                        </select>				
                        <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>
    				<!--<span class="help-block"><?php echo form_error('company_id')?></span>-->
    			</div>
    		</div>
    	
    		<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_employee_attendance','' , 'attStatuses' )" >
    			<div class="form-group">
    				<label><?php echo lang('label_attendance_status');?></label>
    				<span class="mandatory">*</span>
    				<!--<?php 
                    $attrib = 'class="form-control select2" id="employee_attendance_status_id" ng-model="employee_attendance_status_id" required ';
                    echo form_dropdown('employee_attendance_status_id', $attendanceStatusDropdown, set_value('employee_attendance_status_id', (isset($employee_attendance_status_id)) ? $employee_attendance_status_id : ''), $attrib);
                    if(form_error('employee_attendance_status_id')){ echo '<span class="help-block">'.form_error('employee_attendance_status_id').'</span>';} ?>-->

    				<select name="employee_attendance_status_id" ng-init="employee_attendance_status_id = '<?php echo $employee_attendance_status_id; ?>'" ng-model="employee_attendance_status_id" id="employee_attendance_status_id" class="form-control"  required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="employee_attendance_status_id in attStatuses" value="{{employee_attendance_status_id.employee_attendance_status_id}}">{{employee_attendance_status_id.status}}</option>  
                    </select>                
                    <span class="help-block" ng-show="showMsgs && myform.employee_attendance_status_id.$error.required"><?php echo $this->lang->line('required');?></span>
    			</div>
    		</div>	
    	</div>
    	 <!--Submit/Cancel Buttons-->
    	<div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform', 'showattenMsgs')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>