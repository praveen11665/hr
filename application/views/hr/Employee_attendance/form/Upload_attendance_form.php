<?php
//Variable Initialization
 $employee_upload_attendance_id    		= "";
 $employee_attendance_id       			= ""; 
 $from_date       						= ""; 
 $to_date       						= ""; 
 $upload_attendance      				= "";  
 
if(!empty($tableData))
{
    foreach ($tableData as $row) 
    {
        $employee_upload_attendance_id   		= $row->employee_upload_attendance_id;        
        $employee_attendance_id     			= $row->employee_attendance_id;
        $from_date      						= date('m-d-Y',strtotime($row->from_date)); 
        $to_date      							= date('m-d-Y',strtotime($row->to_date)); 
        $upload_attendance      				= $row->upload_attendance;  
    }
}
else
{
    $employee_upload_attendance_id   			= $this->input->post('employee_upload_attendance_id');
    $employee_attendance_id      				= $this->input->post('employee_attendance_id');
    $from_date      							= $this->input->post('from_date');
    $to_date      								= $this->input->post('to_date');
    $upload_attendance      					= $this->input->post('upload_attendance');  
}
?>

<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Upload_attendance_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelFormWithFile" enctype="multipart/form-data" name="myform">
      <input type="hidden" name="employee_upload_attendance_id" id="employee_upload_attendance_id" value="<?php echo $employee_upload_attendance_id;?>">
    	<label><h5><?php echo lang('label_download_template');?></h5></label>
            <div class="form-button" style="float: right;"">
                <a href="<?php echo base_url()?>sample_csv_files/Attendence.csv" ><?php echo lang('label_get_template');?></a>
                <!--<div class="input-group">
                    <span class="input-group-addon"><?php echo lang('label_web_link');?></span> 
                    <input type="text" class="form-control" >
                    &nbsp;&nbsp;&nbsp;
                    <button class="btn btn-inverse" type="button" name=""><?php echo lang('label_attach');?></button>
                </div>-->
            </div>   
        <br> 
    	Download the template,fill appropriate data and attach the modified file.All dates and employee combination in the selected period will come in the template,with existing attendance records.
    	<div class="row">
    		<div class="col-md-6">
    			<div class="form-group">
    				<label><?php echo lang('label_attendance_from_date');?></label>
                    <span class="mandatory">*</span>  

                        <input type="text" show-button-bar="false" name="from_date" uib-datepicker-popup="{{format}}" ng-model="from_date" is-open="popup1.opened"  ng-required="false" name="from_date" ng-focus="open('popup1')" data-ng-init="init('<?php echo $from_date?>', 'from_date')"  data-name="from_date" id="from_date" class="form-control" value = "<?php echo $from_date;?>" required ng-change="fromDateChange('from_date')"/>

                        <!--<input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="from_date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" value="{{from_date | date:'dd-MM-yyyy' }}" name="from_date"  ng-focus="open('popup1')"/>-->
                        <span class="help-block" ng-show="showMsgs && myform.from_date.$error.required"><?php echo $this->lang->line('required');?></span>
        		</div>
    		</div>
    		<div class="col-md-6">
    			<div class="form-group">
    				<label><?php echo lang('label_attendance_to_date');?></label>	                	
                    <span class="mandatory">*</span>
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="to_date" is-open="popup2.opened" datepicker-options="toDateOptions" ng-required="true"  data-ng-init="init('<?php echo $to_date?>', 'to_date')" value="{{to_date | date:'dd-MM-yyyy' }}" name="to_date"  ng-focus="open('popup2')"/>
                    <span class="help-block" ng-show="showMsgs && myform.to_date.$error.required"><?php echo $this->lang->line('required');?></span>
        		</div>
    		</div>
    	</div>
    	<!--<div class="row">
    		<div class="col-md-6">
    			<div class="form-group">
        			<div class="form-button">
                        <a href="<?php echo base_url()?>/sample_csv_files/Attendence.xlsx" ><?php echo lang('label_get_template');?></a>
                	</div>
                </div>
    		</div>				
    	</div>-->
    	<!--Submit/Cancel Buttons-->
        <div class="form-buttons-w">
        	<h5><label><?php echo lang('label_import_attendance');?></label></h5>
        	<div class="row">
            	<div class="col-md-6">
                    <input type="file" ng-model="attendence_file" name="attendence_file" id="file" class="form-control" value="" size = "1000" required csv-file>
                    <div ng-messages="myform.attendence_file.$error" ng-if="myform.attendence_file.$touched">
                        <span class="help-block" ng-message="extension">Upload CSV Files Only</span>
                    </div>
                    <span class="help-block"><?php echo form_error('file')?></span>
                </div>           
                <!--<label>OR</label>-->            
    		</div>	
    	</div>
        <!--Submit/Cancel Buttons-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>	