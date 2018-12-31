<?php
$ci =&get_instance();
$vehicleFuelTypeDropdown    =  $ci->mcommon->Dropdown('def_hr_vehicle_fuel_type', array('vehicle_fuel_type_id as Key', 'fuel_type as Value'));
$fuelUomDropdown            =  $ci->mcommon->Dropdown('set_uom', array('uom_id as Key', 'uom_name as Value'), array('is_delete' => 0));
$employeeDropdown           =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_name as Value'), array('is_delete' => 0));

//Variable Initialize
$vehicle_id             =  '';
$vehicle_fuel_type_id   =  '';
$registration_number    =  '';
$make                   =  '';
$model                  =  '';
$odometer_value         =  '';
$chassis_no             =  '';
$acquisition_date       =  '';
$vehicle_value          =  '';
$location               =  '';
$insurance_company      =  '';
$start_date             =  '';
$end_date               =  '';
$policy_no              =  '';
$color                  =  '';
$doors                  =  '';
$wheels                 =  '';
$carbon_check_date      =  '';
$uom_id                 =  '';
$employee_id            =  '';

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $vehicle_id             =  $row->vehicle_id;
        $vehicle_fuel_type_id   =  $row->vehicle_fuel_type_id;
        $registration_number    =  $row->registration_number;
        $make                   =  $row->make;
        $model                  =  $row->model;
        $odometer_value         =  $row->odometer_value;
        $chassis_no             =  $row->chassis_no;
        $acquisition_date       =  $row->acquisition_date;
        $vehicle_value          =  $row->vehicle_value;
        $location               =  $row->location;
        $insurance_company      =  $row->insurance_company;
        $start_date             =  $row->start_date;
        $end_date               =  $row->end_date;
        $policy_no              =  $row->policy_no;
        $color                  =  $row->color;
        $doors                  =  $row->doors;
        $employee_id            =  $row->employee_id;        
        $wheels                 =  $row->wheels;
        $carbon_check_date      =  $row->carbon_check_date;
        $uom_id                 =  $row->uom_id;
    }
}
else
{
    $vehicle_id                 =   $this->input->post('vehicle_id');
    $vehicle_fuel_type_id       =   $this->input->post('vehicle_fuel_type_id');
    $registration_number        =   $this->input->post('registration_number');
    $make                       =   $this->input->post('make');
    $model                      =   $this->input->post('model');
    $odometer_value             =   $this->input->post('odometer_value');
    $acquisition_date           =   $this->input->post('acquisition_date');
    $location                   =   $this->input->post('location');
    $employee_id                =   $this->input->post('employee_id');
    $chassis_no                 =   $this->input->post('chassis_no');
    $vehicle_value              =   $this->input->post('vehicle_value');
    $insurance_company          =   $this->input->post('insurance_company');
    $start_date                 =   $this->input->post('start_date');
    $end_date                   =   $this->input->post('end_date');
    $policy_no                  =   $this->input->post('policy_no');
    $carbon_check_date          =   $this->input->post('carbon_check_date');
    $color                      =   $this->input->post('color');
    $wheels                     =   $this->input->post('wheels');
    $doors                      =   $this->input->post('doors');
    $uom_id                     =   $this->input->post('uom_id');
}
?> 
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Vehicle_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">                  
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
      <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $vehicle_id;?>">
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_vehicle');?></span></legend>            
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_registration_number');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="registration_number" id="registration_number" ng-init="registration_number = '<?php echo $registration_number; ?>'" value="<?php echo $registration_number;?>" class="form-control" ng-model="registration_number" maxlength="15" required onkeypress="return isRegistrationFormat(event)" ng-keyup="checkUnique('../../Common_controller/checkUnique/hr_vehicle', registration_number, 'registration_number')"/>
                            <span class="help-block" ng-show="showMsgs && myform.registration_number.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block" ng-show="showuniqueMsgs">{{registration_number}} already in use</span>
                            <span class="help-block"><?php echo form_error('registration_number')?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_make');?></label>
                            <input type="text" name="make" ng-init="make = '<?php echo $make; ?>'" value="<?php echo $make;?>" class="form-control" ng-model="make" maxlength="20"/>
                            <span class="help-block"><?php echo form_error('make')?></span>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_model');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="model" ng-init="model = '<?php echo $model; ?>'" value="<?php echo $model;?>" class="form-control" ng-model="model" maxlength="20" required />
                            <span class="help-block" ng-show="showMsgs && myform.model.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error('model')?></span>
                        </div>
                    </div>
                </div>
        </fieldset>
                
      <!-- second row with five columns for details-->
        <fieldset>
            <legend><span><?php echo $this->lang->line('Vehicle_details');?></span></legend>           
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_odometer_value');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="odometer_value" ng-init="odometer_value = '<?php echo $odometer_value; ?>'"  value="<?php echo $odometer_value;?>" class="form-control"  ng-model="odometer_value" maxlength="10" required  onkeypress="return isFloat(event)"/>
                            <span class="help-block" ng-show="showMsgs && myform.odometer_value.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error('odometer_value')?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_chassis_no');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="chassis_no" ng-init="chassis_no = '<?php echo $chassis_no; ?>'" value="<?php echo $chassis_no;?>" class="form-control" ng-model="chassis_no" onkeypress="return IsAlphaNumeric(event)" maxlength="17" required />
                             <span class="help-block" ng-show="showMsgs && myform.chassis_no.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error('chassis_no')?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_acquisition_date');?></label>
                            <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="acquisition_date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="false" close-text="Close" alt-input-formats="altInputFormats"  data-ng-init="init('<?php echo $acquisition_date?>', 'acquisition_date')" value="{{acquisition_date | date:'dd-MM-yyyy' }}" name="acquisition_date" ng-focus="open('popup1')"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                           <label><?php echo $this->lang->line('label_vehicle_value');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="vehicle_value" maxlength="10" ng-init="vehicle_value = '<?php echo $vehicle_value; ?>'"  value="<?php echo $vehicle_value;?>" class="form-control"  ng-model="vehicle_value" onkeypress="return isNumberKey(event)"  required />
                            <span class="help-block" ng-show="showMsgs && myform.vehicle_value.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error('vehicle_value')?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_location');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="location" maxlength="20" ng-init="location = '<?php echo $location; ?>'" value="<?php echo $location;?>" class="form-control" ng-model="location"  allow-characters required />
                             <span class="help-block" ng-show="showMsgs && myform.location.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error('location')?></span>
                        </div>
                    </div>
                    <div class="col-md-3" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_employee',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employees' )" >
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_employee');?></label><a class="add-new-popup" onclick="">+</a>
                            <span class="mandatory">*</span>
                            <!--<?php 
                                $attrib = 'class="form-control select2" id="employee_id" ng-model="employee_id" required ';
                                echo form_dropdown('employee_id', $employeeDropdown, set_value('employee_id', (isset($employee_id)) ? $employee_id : ''), $attrib);
                                ?>
                                <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>
                                <?php
                                if(form_error('employee_id')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';}
                            ?>-->
                            <select name="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" ng-model="employee_id" id="employee_id" class="form-control" required select2>
                                  <option value="">-- Select --</option>  
                                  <option ng-repeat="employee_id in employees" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option>  
                            </select>
                            <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        </div>
                    </div>
                </div>
            </fieldset>
                
        <!-- third row with four columns for Insurance details-->
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_insurance_details');?></span></legend>            
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_insurance_company');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="insurance_company" maxlength="30" ng-init="insurance_company = '<?php echo $insurance_company; ?>'" value="<?php echo $insurance_company;?>" class="form-control" ng-model="insurance_company" ng-pattern="/^[a-zA-Z\s]*$/" allow-characters required />
                            <span class="help-block" ng-show="showMsgs && myform.insurance_company.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error('insurance_company')?></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_start_date');?></label>
                            <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="start_date" is-open="popup2.opened" datepicker-options="dateOptions" ng-required="false" close-text="Close" alt-input-formats="altInputFormats" value="{{start_date | date:'dd-MM-yyyy' }}"  data-ng-init="init('<?php echo $start_date?>', 'start_date')" name="start_date" ng-focus="open('popup2')"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_end_date');?></label>
                            <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="end_date" is-open="popup3.opened" datepicker-options="dateOptions" ng-required="false" close-text="Close" alt-input-formats="altInputFormats" value="{{end_date | date:'dd-MM-yyyy' }}"  data-ng-init="init('<?php echo $end_date?>', 'end_date')" name="end_date" ng-focus="open('popup3')"/>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_policy_no');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="policy_no" ng-init="policy_no = '<?php echo $policy_no; ?>'" value="<?php echo $policy_no;?>" class="form-control"  ng-model="policy_no" onkeypress="return isNumberKey(event)" maxlength="20" required />
                            <span class="help-block" ng-show="showMsgs && myform.policy_no.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error('policy_no')?></span>
                        </div>
                    </div>
                </div>
        </fieldset>                
        <!-- Fourth row with six columns for  Additional settings-->
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_additional_details');?></span></legend>
                 <div class="row">
                    <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_vehicle_fuel_type','' , 'fuelTypes' )">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_fuel_type');?></label>
                            <span class="mandatory">*</span>
                            <!--<?php 
                                $attrib = 'class="form-control select2" id="vehicle_fuel_type_id"';
                                echo form_dropdown('vehicle_fuel_type_id', $vehicleFuelTypeDropdown, set_value('vehicle_fuel_type_id', (isset($vehicle_fuel_type_id)) ? $vehicle_fuel_type_id : ''), $attrib);
                                if(form_error('vehicle_fuel_type_id')){ echo '<span class="help-block">'.form_error('vehicle_fuel_type_id').'</span>';}
                             ?>-->
                            <select name="vehicle_fuel_type_id" ng-init="vehicle_fuel_type_id = '<?php echo $vehicle_fuel_type_id; ?>'" ng-model="vehicle_fuel_type_id" id="vehicle_fuel_type_id" class="form-control" required select2>
                                  <option value="">-- Select --</option>  
                                  <option ng-repeat="vehicle_fuel_type_id in fuelTypes" value="{{vehicle_fuel_type_id.vehicle_fuel_type_id}}">{{vehicle_fuel_type_id.fuel_type}}</option>  
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_uom','' , 'uoms' )">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_fuel_uom');?></label><a class="add-new-popup" onclick="">+</a>
                            <span class="mandatory">*</span>
                             <!--<?php 
                                $attrib = 'class="form-control select2" id="uom_id"';
                                echo form_dropdown('uom_id', $fuelUomDropdown, set_value('uom_id', (isset($uom_id)) ? $uom_id : ''), $attrib);
                                if(form_error('uom_id')){ echo '<span class="help-block">'.form_error('uom_id').'</span>';}
                             ?>-->
                             <select name="uom_id" ng-init="uom_id = '<?php echo $uom_id; ?>'" ng-model="uom_id" id="uom_id" class="form-control" required select2>
                                  <option value="">-- Select --</option>  
                                  <option ng-repeat="uom_id in uoms" value="{{uom_id.uom_id}}">{{uom_id.uom_name}}</option>  
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_colors');?></label>
                            <input type="text" name="color" maxlength="20" ng-init="color = '<?php echo $color; ?>'" value="<?php echo $color;?>" class="form-control" allow-characters/>
                            <span class="help-block"><?php echo form_error('color')?></span>
                        </div>
                    </div>
                    
                 </div>
                 <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                           <label><?php echo $this->lang->line('label_doors');?></label>
                            <input type="text" name="doors" maxlength="2" ng-init="doors = '<?php echo $doors; ?>'" value="<?php echo $doors;?>" class="form-control" onkeypress="return isNumberKey(event)"/>
                            <span class="help-block"><?php echo form_error('doors')?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_Wheels');?></label>
                            <input type="text" name="wheels" maxlength="2" ng-init="wheels = '<?php echo $wheels; ?>'" value="<?php echo $wheels;?>" class="form-control" onkeypress="return isNumberKey(event)"/>
                            <span class="help-block"><?php echo form_error('wheels')?></span>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label><?php echo $this->lang->line('label_last_carbon_check');?></label>
                            <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="carbon_check_date" is-open="popup4.opened" datepicker-options="dateOptions" ng-required="false" close-text="Close" alt-input-formats="altInputFormats" value="{{carbon_check_date | date:'dd-MM-yyyy' }}"  data-ng-init="init('<?php echo $carbon_check_date?>', 'carbon_check_date')" name="carbon_check_date" ng-focus="open('popup4')"/>
                            <span class="help-block"><?php echo form_error('carbon_check_date')?></span>
                        </div>
                    </div>
                </div>
        </fieldset>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform', 'showuniqueMsgs')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>