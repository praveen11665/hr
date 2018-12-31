<?php
$ci =&get_instance();
$namingSeriesdrop       =  $ci->mdrop->namingSeriesdrop(1);
$vehicleDropdown        =  $ci->mcommon->Dropdown('hr_vehicle', array('vehicle_id as Key', 'registration_number as Value'), array('is_delete' => 0));
$serviceItemDropdown    =  $ci->mcommon->Dropdown('def_hr_vehicle_log_service_item', array('vehicle_log_service_item_id as Key', 'service_item as Value'));
$serviceTypeDropdown    =  $ci->mcommon->Dropdown('def_hr_vehicle_log_service_type', array('vehicle_log_service_type_id as Key', 'service_type as Value'));
$frquencyDropdown       =  $ci->mcommon->Dropdown('def_hr_vehicle_log_frquency', array('vehicle_log_frquency_id as Key', 'frequency as Value'));
$employeeDropdown       =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_name as Value'),array('is_delete' => 0));

//Variable Initialize
$vehicle_log_id                 = array();
$naming_series                  =  "";
$vehicle_id                     = "";
$employee_id                    = "";
$model                          = "";
$make                           = ""; 
$date                           = "";
$odometer                       = "";
$vehicle_log_service_item_id    = array();
$vehicle_log_service_type_id    = array();
$vehicle_log_frquency_id        = array();
$expense_amount                 = array();
$vehicle_log_service_details_id = array();

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $vehicle_log_id        =  $row->vehicle_log_id;
        $naming_series         =  $row->naming_series;
        $vehicle_id            =  $row->vehicle_id;
        $employee_id           =  $row->employee_id;
        $model                 =  $row->model;
        $make                  =  $row->make;
        $date                  =  $row->date;
        $odometer              =  $row->odometer;
    }

    $naming_seriesArr =   explode('/', $naming_series);
    foreach ($naming_seriesArr as $key => $value) 
    {
        $set_options    =   $naming_seriesArr[0];
    }
    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '1'), 'naming_series_id');

    $naming_option      =   $source_id."_".$set_options;

    foreach ($contentData as $row)
    {
        $vehicle_log_service_details_id[] =  $row->vehicle_log_service_details_id;
        $vehicle_log_service_item_id[]    =  $row->vehicle_log_service_item_id;
        $vehicle_log_service_type_id[]    =  $row->vehicle_log_service_type_id;
        $vehicle_log_frquency_id[]        =  $row->vehicle_log_frquency_id;
        $expense_amount[]                 =  $row->expense_amount;
        $trowlog++;
    }
}
else
{
    $vehicle_log_id                 =   $this->input->post('vehicle_log_id'); 
    $vehicle_id                     =   $this->input->post('vehicle_id');
    $employee_id                    =   $this->input->post('employee_id');
    $model                          =   $this->input->post('model');
    $make                           =   $this->input->post('make');
    $date                           =   $this->input->post('date');
    $odometer                       =   $this->input->post('odometer');
    $vehicle_log_service_item_id    =   $this->input->post('vehicle_log_service_item_id');
    $vehicle_log_service_type_id    =   $this->input->post('vehicle_log_service_type_id');
    $vehicle_log_frquency_id        =   $this->input->post('vehicle_log_frquency_id');
    $expense_amount                 =   $this->input->post('expense_amount');
}
$trowlog           = count($vehicle_log_service_type_id) ? count($vehicle_log_service_type_id) :'1';
$checkDisable      = ($vehicle_log_id == '') ? 'disabled' : '';
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Vehicle_log_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
    <input type="hidden" name="vehicle_log_id" id="vehicle_log_id" value="<?php echo $vehicle_log_id;?>">
    <!--<input type="text" name="result" id="result" value="">-->
    <div class="row">
        <div class="col-md-4" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/1')">
            <div class="form-group">
                <label for="naming_series_id"><?php echo $this->lang->line('label_series_name');?> </label> <span class="mandatory">*</span>
                  <a class="add-new-popup" onclick="">+</a>
                <!--<a class="add-new-popup" ng-click="$ctrl.openSecond('lg', '', '<?php echo base_url($namingUrl);?>' )"><i class="popup"></i>+</a>-->
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

        <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_vehicle','<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>', 'vehicles' )" >
            <div class="form-group">
                <label><?php echo $this->lang->line('label_vehicle');?></label>
                <span class="mandatory">*</span>
                <a class="add-new-popup" onclick="">+</a>
                <!--<?php 
                    $attrib = 'class="form-control select2" id="vehicle_id" onchange="loadVehicle()" ng-model="vehicle_id" required ';
                    echo form_dropdown('vehicle_id', $vehicleDropdown, set_value('vehicle_id', (isset($vehicle_id)) ? $vehicle_id : ''), $attrib);?>                   
                <?php
                    if(form_error('vehicle_id')){ echo '<span class="help-block">'.form_error('vehicle_id').'</span>';}
                ?>-->
                <select name="vehicle_id" ng-init="vehicle_id = '<?php echo $vehicle_id; ?>'" ng-model="vehicle_id" id="vehicle_id" class="form-control" onchange="loadVehicle()" required select2>
                    <option value="">-- Select --</option>  
                    <option ng-repeat="vehicle_id in vehicles" value="{{vehicle_id.vehicle_id}}">{{vehicle_id.registration_number}}</option>  
                </select>
                <span class="help-block" ng-show="showMsgs && myform.vehicle_id.$error.required"><?php echo $this->lang->line('required');?></span>
            </div>
        </div>

        <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employee', <?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employeeData' )" >
            <div class="form-group">
                <label><?php echo $this->lang->line('label_employee');?></label>
                <span class="mandatory"> * </span>                                        
                    <select name="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" ng-model="employee_id" id="employee_id" class="form-control"  required select2>
                          <option value="">-- Select --</option>
                          <option ng-repeat="employee_id in employeeData" value="{{employee_id.employee_id}}">{{employee_id.employee_name}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>   
            </div>
        </div>        
        <div class="col-md-4">
            <div class="form-group">
                <label><?php echo $this->lang->line('label_make');?></label>
                <input type="text" name="make" id="make" ng-init="make = '<?php echo $make; ?>'" value="<?php echo $make;?>" class="form-control" readonly="readonly" />
                <span class="help-block"><?php echo form_error('make')?></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label><?php echo $this->lang->line('label_model');?></label>
                <input type="text" name="model" id="model" ng-init="model = '<?php echo $model; ?>'" value="<?php echo $model;?>" class="form-control" readonly="readonly" />
                <span class="help-block"><?php echo form_error('model')?></span>
            </div>
        </div>
    </div>
    <fieldset>
        <legend><span><?php echo $this->lang->line('label_odometer_reading');?></span></legend>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_date');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" show-button-bar="false" class="form-control"  uib-datepicker-popup="{{format}}" ng-model="date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $date?>', 'date')" value="{{date | date:'dd-MM-yyyy' }}" name="date"  ng-focus="open('popup1')"/>
                    <span class="help-block" ng-show="showMsgs && myform.date.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_odometer');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="odometer" ng-init="odometer = '<?php echo $odometer; ?>'" id="odometer" value="<?php echo $odometer;?>" class="form-control" ng-model="odometer" required onkeypress="return isNumberKey(event)"/>
                    <span class="help-block" ng-show="showMsgs && myform.odometer.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error('odometer')?></span>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend><span><?php echo $this->lang->line('label_service_details');?></span></legend>
        <div class="row">
         <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <!--<th><input type="checkbox" ></th>-->
                        <th></th>
                        <th><?php echo $this->lang->line('label_service_item');?></th>
                        <th><?php echo $this->lang->line('label_type');?></th>
                        <th><?php echo $this->lang->line('label_frequency');?></th>
                        <th><?php echo $this->lang->line('label_expense_amount');?></th>
                        <!--<th></th>-->
                    </tr>
                </thead>
                <tbody id="service_deails">
                <?php 
                $is=1;
                for($in=0; $in < $trowlog; $in++)
                {
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="veh_log_cbx" id="veh_log_cbx<?php echo $in;?>" data-name="veh_log_cbx" data-row="<?php echo $in;?>" ng-init="vehicle_log_service_details_id = '<?php echo $vehicle_log_service_details_id[$in]; ?>'" value="<?php echo $vehicle_log_service_details_id[$in];?>" onclick="checkDeleteButton('veh_log_cbx', 'add_delete');" <?php echo $checkDisable;?>/>
                            <input type="hidden" name="vehicle_log_service_details_id[]" data-name="vehicle_log_service_details_id" id="vehicle_log_service_details_id<?php echo $in;?>" ng-init="vehicle_log_service_details_id = '<?php echo $vehicle_log_service_details_id[$in]; ?>'" value="<?php echo $vehicle_log_service_details_id[$in];?>" data-row="<?php echo $in;?>">
                        </td>
                        <td ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_vehicle_log_service_item','' , 'employees' )">
                            <?php 
                                $attrib = 'class="form-control" id="vehicle_log_service_item_id'.$in.'" data-row="'.$in.'" data-name="vehicle_log_service_item_id"';
                                echo form_dropdown('vehicle_log_service_item_id[]', $serviceItemDropdown, set_value('vehicle_log_service_item_id[$in]', (isset($vehicle_log_service_item_id[$in])) ? $vehicle_log_service_item_id[$in] : ''), $attrib);
                                if(form_error('vehicle_log_service_item_id['.$in.']')){ echo '<span class="help-block">'.form_error('vehicle_log_service_item_id['.$in.']').'</span>';}
                             ?>
                            <!--<select name="vehicle_log_service_item_id[]" ng-init="vehicle_log_service_item_id = '<?php echo $vehicle_log_service_item_id[$in]; ?>'" id="vehicle_log_service_item_id" class="form-control">
                                <option value="">-- Select --</option>  
                                <option ng-repeat="vehicle_log_service_item_id in employees" value="{{vehicle_log_service_item_id.vehicle_log_service_item_id}}">{{vehicle_log_service_item_id.service_item}}</option>  
                            </select>-->
                        </td>
                        <td>
                            <?php 
                                $attrib = 'class="form-control" id="vehicle_log_service_type_id"';
                                echo form_dropdown('vehicle_log_service_type_id[]', $serviceTypeDropdown, set_value('vehicle_log_service_type_id['.$in.']', (isset($vehicle_log_service_type_id[$in])) ? $vehicle_log_service_type_id[$in] : ''), $attrib);
                                if(form_error('vehicle_log_service_type_id')){ echo '<span class="help-block">'.form_error('vehicle_log_service_type_id').'</span>';}
                             ?>
                        </td>
                        <td>
                            <?php 
                                $attrib = 'class="form-control" id="vehicle_log_frquency_id"';
                                echo form_dropdown('vehicle_log_frquency_id[]', $frquencyDropdown, set_value('vehicle_log_frquency_id['.$in.']', (isset($vehicle_log_frquency_id[$in])) ? $vehicle_log_frquency_id[$in] : ''), $attrib);
                                if(form_error('vehicle_log_frquency_id['.$in.']')){ echo '<span class="help-block">'.form_error('vehicle_log_frquency_id['.$in.']').'</span>';}
                             ?>
                        </td>
                        <td>
                            <input type="text" name="expense_amount[]" ng-init="expense_amount = '<?php echo $expense_amount[$in]; ?>'" data-name="expense_amount" id="expense_amount" value="<?php echo $expense_amount[$in];?>" class="form-control" onkeypress="return isNumberKey(event)">                    
                            <span class="help-block"><?php echo form_error('expense_amount[$in]')?></span>
                        </td>
                        <!--<td><button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl;?>');" name="">Details</button>
                        </td>-->
                    </tr>
                    <?php                      
                    $is++;
                } 
                ?> 
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('service_deails');" > <?php echo $this->lang->line('label_add_row');?> </button>
                            <input type="button" class="btn btn-danger btn-sm add_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('service_deails', 'veh_log_cbx', 'hr_vehicle_log_service_details', 'vehicle_log_service_details_id');" disabled>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        </div>
    </fieldset>
    <div class="modal-footer">
        <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
        <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
    </div>
</form>