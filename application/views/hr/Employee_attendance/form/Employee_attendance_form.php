<?php
$ci =&get_instance();   
$namingSeriesdrop    	=  $ci->mdrop->namingSeriesdrop('96');
$departmentDropdown  	=  $ci->mcommon->Dropdown('hr_department', array('department_id as Key', 'department_name as Value'), array('is_delete' => 0));
$branchDropdown       =  $ci->mcommon->Dropdown('hr_branch', array('branch_id as Key', 'branch as Value'), array('is_delete' => 0));
$companyDropdown  		=  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name 	 as Value'), array('is_delete' => 0));
//Variable Initialization
$employee_attendance_tool_id   = "";
$naming_series                 = ""; 
$date                          = "";
$department_id                 = ""; 
$branch_id                     = ""; 
$company_id                    = "";
$marked_present                = "";
$marked_absent                 = "";
$marked_half_day               = "";
$mark_leave                    = "";
 
if(!empty($tableData))
{
  foreach ($tableData as $row) 
  {
    $employee_attendance_tool_id  = 	$row->employee_attendance_tool_id;
    $naming_series                = 	$row->naming_series;        
    $date                         =   date('m-d-Y',strtotime($row->date));
    $department_id                = 	$row->department_id; 
    $branch_id                    = 	$row->branch_id; 
    $company_id                   = 	$row->company_id;
    $marked_present               =	  explode(",", $row->marked_present);
    $marked_absent                =	  explode(",", $row->marked_absent);
    $marked_half_day              =	  explode(",", $row->marked_half_day);
    $mark_leave                   =	  explode(",", $row->mark_leave);
  }    

  $naming_seriesArr =   explode('/', $naming_series);
  foreach ($naming_seriesArr as $key => $value) 
  {
      $set_options    =   $naming_seriesArr[0];
  }
  $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '96'), 'naming_series_id');

  $naming_option      =   $source_id."_".$set_options; 
}
else
{
  $employee_attendance_tool_id  = $this->input->post('employee_attendance_tool_id');
  $naming_series      					= $this->input->post('naming_series');
  $date      								    = $this->input->post('date');
  $department_id      					= $this->input->post('department_id');
  $branch_id      						  = $this->input->post('branch_id');
  $company_id                   = $this->input->post('company_id'); 
  $marked_present      					= $this->input->post('marked_present');
  $marked_absent      					= $this->input->post('marked_absent');
  $marked_half_day              = $this->input->post('marked_half_day');
  $mark_leave                   = $this->input->post('mark_leave'); 
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button> 
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('employee_attendance_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
  <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
    <input type="hidden" name="employee_attendance_tool_id" id="employee_attendance_tool_id" value="<?php echo $employee_attendance_tool_id;?>">
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
  			<div class="form-group">
  				<label><?php echo lang('label_date');?></label>
  	       <span class="mandatory">*</span> 
           <input type="text" show-button-bar="false" name="date" uib-datepicker-popup="{{format}}" ng-model="date" is-open="popup1.opened"  ng-required="false" name="date" ng-focus="open('popup1')" data-ng-init="init('<?php echo $date?>', 'date')"  data-name="date" id="date" class="form-control" value = "<?php echo $date;?>" required  datepicker-options="pastYearfutureDateOptions" ng-change="addEmployee()"/>

      			<!--<input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" value="{{date | date:'dd-MM-yyyy' }}" name="date"  ng-focus="open('popup1')"/>-->
            <span class="help-block" ng-show="showMsgs && myform.date.$error.required"><?php echo $this->lang->line('required');?></span>                
      		</div>
  		</div>
    </div>
    <div class="row">  
  		<div class="col-md-4">
  			<div class="form-group">
  				<label><?php echo lang('label_company');?></label>
  				<span class="mandatory">*</span>
  				<?php 
  				    $attrib = 'class="form-control select2" id="company_id" onchange="addEmployee()" ng-model="company_id" required';
  				    echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);
  				    if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} 
  				?> 
  				<span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>
  			</div>
  		</div>
      <div class="col-md-4">
        <div class="form-group">
          <label><?php echo lang('label_branch');?></label>
          <span class="mandatory">*</span>
          <?php 
              $attrib = 'class="form-control select2" id="branch_id" onchange="addEmployee()" ng-model="branch_id" required';
              echo form_dropdown('branch_id', $branchDropdown,  set_value('branch_id', (isset($branch_id)) ? $branch_id : ''), $attrib);
              if(form_error('branch_id')){ echo '<span class="help-block">'.form_error('branch_id').'</span>';} 
          ?>
          <span class="help-block" ng-show="showMsgs && myform.branch_id.$error.required"><?php echo $this->lang->line('required');?></span> 
        </div>
      </div>
  		<div class="col-md-4">
  			<div class="form-group">
  				<label><?php echo lang('label_department');?></label>
  	            <span class="mandatory">*</span>
  				<?php 
  				    $attrib = 'class="form-control select2" id="department_id" onchange="addEmployee()" ng-model="department_id" required';
  				    echo form_dropdown('department_id', $departmentDropdown, set_value('department_id', (isset($department_id)) ? $department_id : ''), $attrib);
  				    if(form_error('department_id')){ echo '<span class="help-block">'.form_error('department_id').'</span>';} 
  				?>
  				<span class="help-block" ng-show="showMsgs && myform.department_id.$error.required"><?php echo $this->lang->line('required');?></span> 
  			</div>	
  		</div>		
  	</div> <hr/>
  	<div class="row">
  		<div class="col-md-6">
  			<label><?php echo lang('label_unmarked_attendance');?></label>
  			<div class="form-group">
  				<button id="checkAll" type="button" class="btn btn-inverse"> <?php echo lang('label_checked');?>  </button>
  				<button id="uncheckAll" type="button" class="btn btn-inverse"> <?php echo lang('label_unchecked');?></button>
      		</div>	     
  		</div>
  	</div>
  	<div class="row">
      <div class="col-sm-12 col-xs-12" id="employeeAttendanceData">                	
      </div>
      <div class="col-md-12">
  			<div class="form-group">
  				<button class="btn btn-group" id="sub1" type="button" onclick="getCheckedCheckboxesFor('1')"> <?php echo lang('label_mark_present');?> </button>
  				<button class="btn btn-group" type="button" onclick="getCheckedCheckboxesFor('2')"> <?php echo lang('label_mark_absent');?> </button>
  				<button class="btn btn-group" type="button" onclick="getCheckedCheckboxesFor('3')"> <?php echo lang('label_mark_halfday');?> </button>
  				<button class="btn btn-group" type="button" onclick="getCheckedCheckboxesFor('4')"> <?php echo lang('label_mark_leave');?> </button>				
      		</div>	 
  		</div>
  	</div>
  	<span id="employeeAttendanceContent">
  		<fieldset id="markpresent">
  			<div class="row">
  				<div class="col-md-12">
  					<div class="form-group">
  						<label><?php echo lang('label_markpresent');?></label>
  					</div>
  				</div>
  			</div>
  		</fieldset>
  		
  		<fieldset id="markabsent">
  			<div class="row">
  				<div class="col-md-12">
  					<div class="form-group">
  						<label><?php echo lang('label_markabsent');?></label>
  					</div>
  				</div>
  			</div>
  		</fieldset>

  		<fieldset id="markhalfday">
  			<div class="row">
  				<div class="col-md-12">
  					<div class="form-group">
  						<label><?php echo lang('label_markhalfday');?></label>
  					</div>
  				</div>
  			</div>
  		</fieldset>

  		<fieldset id="markleave">
  			<div class="row">
  				<div class="col-md-12">
  					<div class="form-group">
  						<label><?php echo lang('label_markonleave');?></label>
  					</div>
  				</div>
  			</div>
  		</fieldset>
  	</span>
  	<!--Submit/Cancel Buttons-->
  	<div class="modal-footer">
      <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
      <button class="btn btn-primary" type="submit" ng-click="$ctrl.atten_submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
    </div>
  </form>
</div>
<script type="text/javascript">

// Check all and un-check all for HR/attendance
$(function () 
{
  $("#checkAll").click(function(){
      $(".checkbox").prop("checked", true);
  });

  $("#uncheckAll").click(function(){
      $(".checkbox").prop("checked", false);
  });  
});

function addEmployee()
{
  branch_id     = $('#branch_id').val();
  company_id    = $('#company_id').val();
  department_id = $('#department_id').val();
  date          = $('#date').val();

  $.ajax
  ({
    type : "POST",
    dataType:'html',
    url  : '<?php echo base_url();?>hr/Employee_attendance/Employee_attendance/getEmployeeDetails/',
    data : {

              'branch_id' : branch_id,
              'company_id' : company_id,
              'department_id' : department_id,
              'date'          : date
          },
    success : function(html1)
    {
      $('#employeeAttendanceData').html(html1);
    }
  });
}

function getCheckedCheckboxesFor(attendanceStatus) 
{
  var checkboxes = $(".employeeList:checked"), values = [];
  Array.prototype.forEach.call(checkboxes, function(el){
    if(!el.disabled)
    {
      values.push(el.value);
    }
  });         

  $("#employeeList_"+attendanceStatus).val(values);

  presentList = $("#employeeList_1").val();
  absentList  = $("#employeeList_2").val();
  halfDayList = $("#employeeList_3").val();
  leaveList   = $("#employeeList_4").val();

  if(presentList || absentList || halfDayList || leaveList)
  {
    //AjaxCall
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Employee_attendance/Employee_attendance/loadDetails/',
      data : {
                'presentList'   : presentList,
                'absentList'    : absentList,
                'halfDayList'   : halfDayList,
                'leaveList'     : leaveList
             },
      success : function(data)
      {        
        $('#employeeAttendanceContent').html(data);
        
        $(".employee_id").each(function()
        {
          employee_id = $(this).data('id');
          $('#employee_id_'+employee_id).prop('disabled', true);
        });
      },
    });
  }else
  {
    swal("Please choose an employees", "", "error");
  }
}
</script>