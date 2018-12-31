<?php
$ci =&get_instance();
$weekdayDropdown  =  $ci->mcommon->Dropdown('def_hr_holiday_list_weekly_off', array('holliday_list_weekly_off_id as Key', ' weekly_off as Value'));   
$holiday_list_id                =   "";
$holiday_list_name              =   "";
$from_date                      =   "";
$to_date                        =   "";
$holliday_list_weekly_off_id    =   "";
$holiday_date                   =   array();
$description                    =   array();
$holiday_list_holiday_id        =   array();

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $holiday_list_id                =   $row->holiday_list_id;
        $holiday_list_name              =   $row->holiday_list_name;
        $from_date                      =   $row->from_date;
        $to_date                        =   $row->to_date;
        $holliday_list_weekly_off_id    =   $row->holliday_list_weekly_off_id;        
    }
}
else
{
    $holiday_list_id                =   $this->input->post('holiday_list_id');
    $holiday_list_name              =   $this->input->post('holiday_list_name');
    $from_date                      =   $this->input->post('from_date');
    $to_date                        =   $this->input->post('to_date');
    $holliday_list_weekly_off_id    =   $this->input->post('holliday_list_weekly_off_id');
}

if(!empty($contentData))
{
    foreach($contentData as $row)
    {
       
       $holiday_list_id                 =   $row->holiday_list_id;
       $holiday_list_holiday_id[]       =   $row->holiday_list_holiday_id;
       $holiday_date[]                  =   date('d-m-Y', strtotime($row->holiday_date));
       $description[]                   =   $row->description;     
       $trowImg++; 
    }
}
else
{
    $holiday_list_holiday_id        =   $this->input->post('holiday_list_holiday_id');
    $holiday_list_id                =   $this->input->post('holiday_list_id');
    $holiday_date                   =   $this->input->post('holiday_date');
    $description                    =   $this->input->post('description');   
}

$trowImg        = count($holiday_date) ? count($holiday_date):'1';
$checkDisable   = ($holiday_list_id == '') ? 'disabled' : '';
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Holiday_List_form_title');?></h4>
</div>

<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
      <input type="hidden" name="holiday_list_id" id="holiday_list_id" value="<?php echo $holiday_list_id;?>">
        <div class="row">
            <div class="col-md-6">            
                <div class="form-group">
                    <label for="holiday_list_name"><?php echo $this->lang->line('label_holiday_list_Name');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="holiday_list_name" id="holiday_list_name" ng-init="holiday_list_name = '<?php echo $holiday_list_name; ?>'" value="<?php echo $holiday_list_name;?>" class="form-control" ng-model="holiday_list_name" ng-pattern="/^[a-zA-Z\s]*$/" required allow-characters maxlength="25"/>
                    <span class="help-block" ng-show="showMsgs && myform.holiday_list_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.holiday_list_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('holiday_list_name');?></span>
                </div>
            </div>                
            <div class="col-md-6">
                <div class="form-group">
                    <label for="from_date"><?php echo $this->lang->line('label_from_date');?> </label>
                    <span class="mandatory">*</span>
                    <input type="text" id="from_date" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="from_date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $from_date?>', 'from_date')" value="{{from_date | date:'dd-MM-yyyy' }}" name="from_date"  ng-focus="open('popup1')"/>
                    <span class="help-block" ng-show="showMsgs && myform.from_date.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="to_date"><?php echo $this->lang->line('label_to_date');?> </label>
                    <span class="mandatory">*</span>
                    <input type="text" id="to_date" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="to_date" is-open="popup2.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $to_date?>', 'to_date')" value="{{to_date | date:'dd-MM-yyyy' }}" name="to_date"  ng-focus="open('popup2')"/>
                    <span class="help-block" ng-show="showMsgs && myform.to_date.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>            
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_holiday_list_weekly_off','' , 'weekOffs' )">
                <div class="form-group">
                    <label for="weekly_off"><?php echo $this->lang->line('label_weekly_off');?></label>
                    <span class="mandatory">*</span><br/>
                       <!--<?php 
                        $attrib = 'class="form-control select2" id="holliday_list_weekly_off_id" ng-model="holliday_list_weekly_off_id" required';
                        echo form_dropdown('holliday_list_weekly_off_id', $weekdayDropdown, set_value('holliday_list_weekly_off_id', (isset($holliday_list_weekly_off_id)) ? $holliday_list_weekly_off_id : ''), $attrib);
                        ?>
                        <?PHP 
                            if(form_error('holliday_list_weekly_off_id')){ echo '<span class="help-block">'.form_error('holliday_list_weekly_off_id').'</span>';}
                        ?>-->
                        <select name="holliday_list_weekly_off_id" ng-init="holliday_list_weekly_off_id = '<?php echo $holliday_list_weekly_off_id; ?>'" ng-model="holliday_list_weekly_off_id" id="holliday_list_weekly_off_id" class="form-control" onchange="showSelectContentrepayment(this.value)" required select2>
                            <option value="">-- Select --</option>  
                            <option ng-repeat="holliday_list_weekly_off_id in weekOffs" value="{{holliday_list_weekly_off_id.holliday_list_weekly_off_id}}">{{holliday_list_weekly_off_id.weekly_off}}</option>  
                         </select>
                        <span class="help-block" ng-show="showMsgs && myform.holliday_list_weekly_off_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                </div>
            </div>
        </div>            
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                     <button type = "button" class="btn btn-inverse" onclick="LoadWeekOff();" name=""><?php echo lang('label_get_weekly_off_dates');?></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">                               
                    <table class="table table-bordered" id="holidayList">
                        <thead>
                            <tr>
                                <!--<th width="50px" ><input type="checkbox"></th>-->
                                <th width="50px" ></th>
                                <th><label for="date"><?php echo $this->lang->line('label_date');?> </label> </th> 
                                <th><label for="description"><?php echo $this->lang->line('label_description');?> </label> 
                                </th> 
                                <th> </th>                                            
                            </tr> 
                        </thead>
                        <tbody id="holidayLists">
                        <?php 
                        $is=1;
                        for($in=0; $in < $trowImg; $in++)
                        {
                        ?>
                            <tr>
                                <td> 
                                     <input type="checkbox" class="holiday_list_cbx" id="holiday_list_cbx<?php echo $in;?>" data-name="holiday_list_cbx" data-row="<?php echo $in;?>" value="<?php echo $holiday_list_holiday_id[$in];?>" onclick="checkDeleteButton('holiday_list_cbx', 'add_delete');" <?php echo $checkDisable;?>/>
                                     <input type="hidden" name="holiday_list_holiday_id[]" id="holiday_list_holiday_id<?php echo $in;?>"  value = "<?php echo $holiday_list_holiday_id[$in];?>" data-name="holiday_list_holiday_id" data-row="<?php echo $in;?>">
                                </td>
                                <td> 
                                    <input class="form-control single-daterange" type="text" value="<?php echo $holiday_date[$in];?>" name="holiday_date[]" data-name="holiday_date" id = "holiday_date<?php echo $in;?>" data-row="<?php echo $in;?>">
                                </td>
                                <td>  
                                    <textarea name="description[]" class="form-control" data-name="description" id="description<?php echo $in;?> data-row="<?php echo $in;?>"><?php echo  $description[$in];?></textarea>                   
                                    <span class="help-block"><?php echo form_error('description[$in]');?></span> 
                                </td>
                                <td> 
                                    <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl;?>');" name=""><?php echo $this->lang->line('label_Details');?></button>
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
                                    <button class="btn btn-primary btn-sm" id ="e" data-name="e" type="button" onclick="addNewRow('holidayLists');" > <?php echo $this->lang->line('label_add_row');?> </button>
                                    <input type="button" class="btn btn-danger btn-sm add_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('holidayLists', 'holiday_list_cbx', 'hr_holiday_list_holiday', 'holiday_list_holiday_id');" disabled>
                                </td>
                            </tr>                                           
                        </tfoot>                       
                </table>
                </div>
            </div>
        </div>
        <!--<input type="button" class="btn btn-inverse" name="" id="" value="Clear All" >-->
                   
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('hr/Leaves_holiday/Holiday_list'); ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
        </div>-->

        <div class="modal-footer">
                <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
                <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
         </div>
    </form> 
</div>
<script>
    $(function() {
        var dates = $( "#textbox1id , #textbox2id" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            minDate : 0,
            maxDate : "+3Y",
            onSelect: function( selectedDate ) {
                var option = this.id == "textbox1id" ? "minDate" : "maxDate",
                    instance = $( this ).data( "datepicker" );
                    date = $.datepicker.parseDate(
                        instance.settings.dateFormat ||
                        $.datepicker._defaults.dateFormat,
                        selectedDate, instance.settings );
                dates.not( this ).datepicker( "option", option, date );
            }
        });
    });

    $(document).ready(function ()
    {
        $('.single-daterange').daterangepicker({singleDatePicker: true,locale: {format: 'DD-MM-YYYY'}});
    });
</script>