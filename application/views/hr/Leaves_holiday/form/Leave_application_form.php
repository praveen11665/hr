<?php
$ci =&get_instance();
$namingSeriesdrop       =  $ci->mdrop->namingSeriesdrop(5);
$statusDropdown         =  $ci->mcommon->Dropdown('def_hr_leave_application_status', array(' leave_application_status_id as Key', 'status as Value'));
$employeeDropdown       =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_number as Value'),array('is_delete'=>0));
$companyDropdown        =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'),array('is_delete'=>0)); 
$letterheadDropdown     =  $ci->mcommon->Dropdown('set_letter_head', array('letter_head_id as Key', 'letter_head_name as Value'),array('is_delete'=>0)); 
$leaveapproverDropdown  =  $ci->mcommon->Dropdown('users', array('user_id as Key', 'user_id as Value'));
$leavetypeDropdown      =  $ci->mcommon->Dropdown('hr_leave_type', array('leave_type_id as Key', 'leave_type_name as Value'), array('is_delete' => 0));

$leave_application_id           =   "";
$naming_series_id               =   "";
$leave_application_status_id    =   "";
$leave_type_id                  =   "";
$leave_balance                  =   "";
$from_date                      =   "";
$to_date                        =   "";
$reason                         =   "";
$half_day                       =   "";
$half_day_date                  =   "";
$total_leave_days               =   "";
$employee_id                    =   "";
$employee_name                  =   "";
$user_id                        =   "";
$leave_approver_name            =   "";
$posting_date                   =   "";
$follow_via_email               =   "";
$company_id                     =   "";
$letter_head_id                 =   "";
$user_id                        =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $leave_application_id           =   $row->leave_application_id;
        $naming_series                  =   $row->naming_series;
        $leave_application_status_id    =   $row->leave_application_status_id;
        $leave_type_id                  =   $row->leave_type_id;
        $leave_balance                  =   $row->leave_balance;
        //$from_date                      =   $row->from_date;
        //$to_date                        =   $row->to_date;
        $from_date                      =   date('d-m-Y', strtotime($row->from_date));
        $to_date                        =   date('d-m-Y', strtotime($row->to_date));
        $reason                         =   $row->reason;
        $half_day                       =   $row->half_day;
        //$half_day_date                  =   $row->half_day_date;
        $half_day_date                  =   date('d-m-Y', strtotime($row->half_day_date));
        $total_leave_days               =   $row->total_leave_days;
        $employee_id                    =   $row->employee_id;
        $employee_name                  =   $row->employee_name; 
        $user_id                        =   ($row->user_id) ? $row->user_id : '';
        $leave_approver_name            =   $row->leave_approver_name;
        $posting_date                   =   $row->posting_date;
        $follow_via_email               =   $row->follow_via_email;
        $company_id                     =   ($row->company_id) ? $row->company_id : '';
        $letter_head_id                 =   ($row->letter_head_id) ? $row->letter_head_id : ''; 
    }   

    $naming_seriesArr =   explode('/', $naming_series);
    foreach ($naming_seriesArr as $key => $value) 
    {
        $set_options    =   $naming_seriesArr[0];
    }
    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '5'), 'naming_series_id');

    $naming_option      =   $source_id."_".$set_options;
}
else
{
    $leave_application_id             =   $this->input->post('leave_application_id');    
    $leave_application_status_id      =   $this->input->post('leave_application_status_id');
    $leave_type_id                    =   $this->input->post('leave_type_id'); 
    $leave_balance                    =   $this->input->post('leave_balance');    
    $from_date                        =   $this->input->post('from_date');
    $to_date                          =   $this->input->post('to_date');
    $reason                           =   $this->input->post('reason');
    $half_day                         =   $this->input->post('half_day');
    $half_day_date                    =   $this->input->post('half_day_date');
    $total_leave_days                 =   $this->input->post('total_leave_days');
    $employee_id                      =   $this->input->post('employee_id');  
    $employee_name                    =   $this->input->post('employee_name');
    $user_id                          =   $this->input->post('user_id');
    $leave_approver_name              =   $this->input->post('leave_approver_name');
    $posting_date                     =   $this->input->post('posting_date');
    $follow_via_email                 =   $this->input->post('follow_via_email');
    $company_id                       =   $this->input->post('company_id');
    $letter_head_id                   =   $this->input->post('letter_head_id');   
    $user_id                          =   $this->input->post('user_id');   
}
?>
<style type="text/css">   
    .modalScrollHidden
    {
        overflow: hidden !important;
    }
</style>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Holidays_list_leaves_and_holiday');?></h4>
</div>
<div class="modal-body" id="modal-body"> 
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="leave_application_id" id="leave_application_id" value="<?php echo $leave_application_id;?>">
        <div class="row">
            <div class="col-md-4" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/5')">
                <div class="form-group">
                    <label for="naming_series_id"><?php echo $this->lang->line('label_series_name');?> </label> <span class="mandatory">*</span>
                    <a class="add-new-popup"><i class="popup"></i>+</a>
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
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employee',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employees' )">
                <div class="form-group">
                    <label for="employee_id"><?php echo lang('label_employee_id');?></label>
                    <span class="mandatory">*</span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="employee_id" onchange="loademployeename();" ng-model="employee_id" required';
                        echo form_dropdown('employee_id', $employeeDropdown, set_value('employee_id', (isset($employee_id)) ? $employee_id : ''), $attrib);?>
                    <?PHP if(form_error('employee_id')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';} ?>--> 
                    <select name="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" ng-model="employee_id" id="employee_id" class="form-control" onchange="loademployeename();"  select2 required>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="employee_id in employees" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option>  
                    </select>                
                    <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>            
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="employee_name"><?php echo lang('label_employee_name');?></label>
                    <input type="text" name="employee_name" id="employee_name" ng-init="employee_name = '<?php echo $employee_name; ?>'" value="<?php echo $employee_name;?>" class="form-control" readonly="readonly" />
                    <span class="help-block"><?php echo form_error('employee_name')?></span>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/users','' , 'users' )">
                <div class="form-group">
                    <label for="leave_approver_id"><?php echo lang('label_leave_approver');?></label>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="user_id" onchange="loadusername();"';
                        echo form_dropdown('user_id', $leaveapproverDropdown, set_value('user_id', (isset($user_id)) ? $user_id : ''), $attrib);
                        if(form_error('user_id')){ echo '<span class="help-block">'.form_error('user_id').'</span>';}
                    ?>-->
                    <select name="user_id" ng-init="user_id = '<?php echo $user_id; ?>'" ng-model="user_id" id="user_id" class="form-control" select2 onchange="loadusername();">
                          <option value="">-- Select --</option>  
                          <option ng-repeat="user_id in users" value="{{user_id.user_id}}">{{user_id.username}}</option>  
                    </select>            
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="leave_approver"><?php echo lang('label_leave_approver_name');?></label>
                    <input type="text" name="leave_approver_name"  ng-init="leave_approver_name = '<?php echo $leave_approver_name; ?>'" id="leave_approver_name" value="<?php echo $leave_approver_name;?>" class="form-control" readonly />
                    <span class="help-block"><?php echo form_error('leave_approver_name')?></span>
                </div>
            </div>    
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_leave_type',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'leaveTypes' )">
                <div class="form-group">
                    <label for="leave_type_id"><?php echo lang('label_leave_type');?></label>
                    <span class="mandatory">*</span>
                    <a class="add-new-popup" onclick="">+</a>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="leave_type_id" onchange="leavebalance();" ng-model="leave_type_id" required';
                        echo form_dropdown('leave_type_id', $leavetypeDropdown, set_value('leave_type_id', (isset($leave_type_id)) ? $leave_type_id : ''), $attrib);
                        if(form_error('leave_type_id')){ echo '<span class="help-block">'.form_error('leave_type_id').'</span>';}
                    ?>-->
                    <select name="leave_type_id" ng-init="leave_type_id = '<?php echo $leave_type_id; ?>'" ng-model="leave_type_id" id="leave_type_id" class="form-control" required select2 onchange="leavebalance(this.value);">
                          <option value="">-- Select --</option>  
                          <option ng-repeat="leave_type_id in leaveTypes" value="{{leave_type_id.leave_type_id}}">{{leave_type_id.leave_type_name}}</option>  
                    </select>                
                    <span class="help-block" ng-show="showMsgs && myform.leave_type_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>                        
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo lang('label_leave_balance');?></label>
                    <input type="text" name="leave_balance" id="leave_balance" ng-init="leave_balance = '<?php echo $leave_balance; ?>'" value="<?php echo $leave_balance;?>" class="form-control" readonly="readonly" >
                    <span class="help-block"><?php echo form_error('leave_balance')?></span>
                </div>                            
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo lang('label_total_leave');?></label>
                    <input type="text" name="total_leave_days" ng-init="employee_name = '<?php echo $employee_name; ?>'" value="<?php echo $total_leave_days;?>" class="form-control" readonly="readonly" id="total_leave_days" />
                    <span class="help-block"><?php echo form_error('total_leave_days')?></span>
                </div>                            
            </div>
            <div class="col-md-4" id ="emp_application_status" style="display:<?php echo ($leave_application_id) ? 'block' : 'none'; ?>">
                <div class="form-group" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_leave_application_status','', 'appStatuses' )">
                    <label><?php echo lang('label_status');?></label>
                    <span class="mandatory">*</span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="leave_application_status_id" onChange="showSelectContentremarks(this.value, \'rejection_remarks\')" ng-model="leave_application_status_id"';
                        echo form_dropdown('leave_application_status_id', $statusDropdown, set_value('leave_application_status_id', (isset($leave_application_status_id)) ? $leave_application_status_id : ''), $attrib);
                       // if(form_error('leave_application_status_id')){ echo '<span class="help-block">'.form_error('leave_application_status_id').'</span>';}
                    ?>-->
                    <select name="leave_application_status_id" ng-init="leave_application_status_id = '<?php echo $leave_application_status_id; ?>'" ng-model="leave_application_status_id" id="leave_application_status_id" class="form-control" onChange="showSelectContentremarks(this.value)"  select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="leave_application_status_id in appStatuses" value="{{leave_application_status_id.leave_application_status_id}}">{{leave_application_status_id.status}}</option>  
                    </select>            
                </div>
            </div>       
             <div class="col-md-6" id ="rejection_remarks" style="display: none;">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_rejection_remarks');?></label>
                    <textarea name="rejection_remarks" class="form-control"></textarea>
                </div>   
            </div>      
        </div><hr>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="from_date"><?php echo lang('label_from_date');?></label>
                            <span class="mandatory">*</span>
                            <!--<input show-button-bar="false" type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="from_date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $from_date?>', 'from_date')" id="from_date" value="{{from_date | date:'dd-MM-yyyy' }}" name="from_date"  ng-focus="open('popup1')" onclick="counthalfdays();"/>-->
                            <input type='text' name="from_date" ng-model="from_date" ng-init="from_date = '<?php echo $from_date; ?>'" id="from_date" class="single-daterange-from form-control" value="<?php echo $from_date;?>" required onchange="counthalfdays(), halfDatePicker();"/>

                            <span class="help-block" ng-show="showMsgs && myform.from_date.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>                            
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="to_date"><?php echo lang('label_to_date');?></label>
                            <span class="mandatory">*</span>                           

                            <!--<input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="to_date" is-open="popup2.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $to_date?>', 'to_date')" value="{{to_date | date:'dd-MM-yyyy' }}" name="to_date"  ng-focus="open('popup2')" id="to_date" onclick="counthalfdays();"/>-->

                            <input type='text' name="to_date" ng-model="to_date" ng-init="to_date = '<?php echo $to_date; ?>'" id="to_date" class="single-daterange-to form-control" value="<?php echo $to_date;?>" required onchange="counthalfdays(), halfDatePicker();"/>

                            <span class="help-block" ng-show="showMsgs && myform.to_date.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>
                                <input type="checkbox"  name="half_day" id="half_day" ng-init="half_day = '<?php echo $half_day; ?>'" <?php echo ($half_day =='1')?'checked':'' ?> onclick="halfdaydate(), counthalfdays()"/>
                                <?php echo lang('label_half_day');?>
                            </label>
                        </div>
                    </div>
                </div>
                <?php $halfDateChecked = ($half_day == '1') ? 'block' : 'none';?>
                <span style="display: <?php echo $halfDateChecked;?>" id="halfday">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo lang('label_half_day_date');?></label>
                            <!--<input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="half_day_date" is-open="popup4.opened" datepicker-options="dateOptions" data-ng-init="init('<?php echo $half_day_date?>', 'half_day_date')" value="{{half_day_date | date:'dd-MM-yyyy' }}" name="half_day_date"  ng-focus="open('popup4')" id="half_day_date" onclick="counthalfdays();"/>-->

                            <input type='text' name="half_day_date" ng-model="half_day_date" ng-init="half_day_date = '<?php echo $half_day_date; ?>'" id="half_day_date" class="single-daterange-half form-control" value="<?php echo $half_day_date;?>" required onchange="counthalfdays();"/>
                            <span class="help-block"><?php echo form_error('half_day_date')?></span>
                        </div>
                    </div>
                </div>
                </span>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="reason"><?php echo lang('label_reason');?></label>
                    <textarea class="form-control" name="reason" id="reason" ng-init="reason = '<?php echo $reason; ?>'" rows =12><?php echo $reason;?></textarea>
                </div> 
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="posting_date"><?php echo lang('label_posting_date');?></label>
                    <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="posting_date" is-open="popup3.opened" datepicker-options="dateOptions"  data-ng-init="init('<?php echo $posting_date?>', 'posting_date')" value="{{posting_date | date:'dd-MM-yyyy' }}" name="posting_date"  ng-focus="open('popup3')"/>
                </div>
            </div>
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'companies' )">
                <div class="form-group">
                    <label for=""><?php echo lang('label_company');?></label>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="company_id"';
                        echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);
                   if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} ?>-->
                    <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control" onchange="loademployeename();" select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
                    </select>           
                </div>
            </div>                      
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="follow_via_email" id="follow_via_email" ng-init="follow_via_email = '<?php echo $follow_via_email; ?>'"<?php echo($follow_via_email == "1")?"checked":""?>/> 
                        <?php echo lang('label_follow_via_email');?>     
                    </label>
                </div>
            </div>     
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_letter_head',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'letterheads' )">
                <div class="form-group">
                    <label for=""><?php echo lang('label_letter_head');?></label>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="letter_head_id"';
                        echo form_dropdown('letter_head_id', $letterheadDropdown, set_value('letter_head_id', (isset($letter_head_id)) ? $letter_head_id : ''), $attrib);?>
                    <?PHP if(form_error('letter_head_id')){ echo '<span class="help-block">'.form_error('letter_head_id').'</span>';} ?>-->                               
                    <select name="letter_head_id" ng-init="letter_head_id = '<?php echo $letter_head_id; ?>'" ng-model="letter_head_id" id="letter_head_id" class="form-control" select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="letter_head_id in letterheads" value="{{letter_head_id.letter_head_id}}">{{letter_head_id.letter_head_name}}</option>  
                    </select>            
                </div>
            </div>                       
        </div>
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('hr/Leaves_holiday/Leave_application') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
        </div>-->

        <div class="modal-footer">
                <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
                <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function ()
    {
        //From Date picker
        $('.single-daterange-from').daterangepicker({
          singleDatePicker: true,
          locale: {
                    //format: 'YYYY-MM-DD'
                    format: 'DD-MM-YYYY'
                  }
        });  

        /*$('.single-daterange-to').daterangepicker({
            singleDatePicker: true,
            minDate: new Date(),
            locale: {
                      format: 'DD-MM-YYYY'
                    }
        });*/ 

        halfDatePicker();      
        
        //To date Picker loaded based on from date
        $('.single-daterange-from').on('apply.daterangepicker', function(ev, picker) { 

          var fromDate = picker.startDate.format('DD-MM-YYYY');
          $('.single-daterange-to').daterangepicker({
            singleDatePicker: true,
            minDate: fromDate,
            locale: {
                      format: 'DD-MM-YYYY'
                    }
          });
        });

        /*******************DATE PICKER WHEN OPEN AND CLOSE ADD AND REMOVE CLASS FOR SCROLL************/

        $('.single-daterange-from').on('show.daterangepicker', function(ev, picker) {
            $(".modal.in").addClass("modalScrollHidden");         
        });

        $('.single-daterange-from').on('hide.daterangepicker', function(ev, picker) {
            $(".modal.in").removeClass("modalScrollHidden");
        }); 

        $('.single-daterange-to').on('show.daterangepicker', function(ev, picker) {
            $(".modal.in").addClass("modalScrollHidden");         
        });        

        $('.single-daterange-to').on('hide.daterangepicker', function(ev, picker) {
            $(".modal.in").removeClass("modalScrollHidden");
        }); 

        $('.single-daterange-half').on('show.daterangepicker', function(ev, picker) {
            $(".modal.in").addClass("modalScrollHidden");         
        });

        $('.single-daterange-half').on('hide.daterangepicker', function(ev, picker) {
            $(".modal.in").removeClass("modalScrollHidden");
        });
    });

    function halfDatePicker(argument) 
    {
        var from_date = $('.single-daterange-from').val();
        var to_date   = $('.single-daterange-to').val();

        $('.single-daterange-half').daterangepicker({
            singleDatePicker: true,
            minDate: from_date,
            maxDate: to_date,
            locale: {
                      format: 'DD-MM-YYYY'
                    }
        }); 
    }
</script>