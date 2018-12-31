<?php
$ci  =&get_instance();
$ci->load->model('Common_model','mcommon',TRUE);
$payrollFrquencyDropdown                =  $ci->mcommon->Dropdown('def_hr_payroll_frquency', array('payroll_frequency_id as Key', 'payroll_frequency as Value'));
$companyDropdown                        =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'));
$accountsDropdown                       =  $ci->mcommon->Dropdown('acc_account', array('account_id as Key', 'account_name as Value'));
$salaryStructureActiveDropdown          =  $ci->mcommon->Dropdown('def_hr_salary_structure_is_active', array('salary_structure_is_active_id as Key', 'is_active as Value')); 
$letterHeadDropdown                     =  $ci->mcommon->Dropdown('set_letter_head', array('letter_head_id as Key', 'letter_head_name as Value'));
$employeeDropdown                       =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_name as Value'),array('is_delete'=>0));
$EarningDropdown                        =  $ci->mcommon->Dropdown('hr_salary_component', array('salary_component_id as Key', 'salary_component as Value'),array('salary_component_type_id' =>'1'));
$DeductionDropdown                      =  $ci->mcommon->Dropdown('hr_salary_component', array('salary_component_id as Key', 'salary_component as Value'),array('salary_component_type_id' =>'2'));
$modeofPaymentDropdown                  =  $ci->mcommon->Dropdown('def_acc_mode_of_payment_type', array('mode_of_payment_type_id as Key', 'type as Value'));

//Variable Initialize 
$name                                   =   "";
$salary_structure_id                    =   "";
$company_id                             =   "";
$salary_structure_is_active_id          =   "";
$letter_head_id                         =   "";
$payroll_frequency_id                   =   "";
$salary_slip_based_on_timesheet         =   ""; 
$hour_rate                              =   "";

$employee_id                            =   array();
$from_date                              =   array();                
$to_date                                =   array();                
$base                                   =   array();
$variable                               =   array();

$earning_id                             =   array();
$salary_component_id_earing             =   array();
$statistical_component_earing           =   array();
$formula_earing                         =   array();
$amount_earing                          =   array();
$salary_structure_id_earing             =   array();

$salary_component_id_deduction          =   array();
$statistical_component_deduction        =   array();
$formula_deduction                      =   array();
$amount_deduction                       =   array();
$salary_structure_id_deduction          =   array();
$salary_structure_select_employee_id    =   array();
$abbr_earing                            =   array();
$deduction_id                           =   array();
$abbr_deduction                         =   array();
$mode_of_payment_id                     =   "";
$payment_account                        =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $name                           =  $row->name;
        $salary_structure_id            =  $row->salary_structure_id;
        $company_id                     =  $row->company_id;
        $salary_structure_is_active_id  =  $row->salary_structure_is_active_id;
        $letter_head_id                 =  $row->letter_head_id;
        $payroll_frequency_id           =  $row->payroll_frequency_id;        
        $salary_slip_based_on_timesheet =  $row->salary_slip_based_on_timesheet;
        $mode_of_payment_id             =  $row->mode_of_payment_id;
        $payment_account                =  $row->payment_account;
        $salary_component_id            =  $row->salary_component_id;
        $hour_rate                      =  $row->hour_rate;        
    }    
}
else
{
    $name                               =   $this->input->post('name');
    $salary_structure_id                =   $this->input->post('salary_structure_id');   
    $company_id                         =   $this->input->post('company_id');   
    $salary_structure_is_active_id      =   $this->input->post('salary_structure_is_active_id'); 
    $letter_head_id                     =   $this->input->post('letter_head_id');
    $payroll_frequency_id               =   $this->input->post('payroll_frequency_id');
    $salary_slip_based_on_timesheet     =   $this->input->post('salary_slip_based_on_timesheet');
    $hour_rate                          =   $this->input->post('hour_rate');
    $mode_of_payment_id                 =   $this->input->post('mode_of_payment_id');   
    $payment_account                    =   $this->input->post('payment_account');  
    $salary_component_id                =   $this->input->post('salary_component_id');  
}

if(!empty($tableData1))
{
    foreach($tableData1 as $row)
    {
        $salary_structure_select_employee_id[]  =  $row->salary_structure_select_employee_id;
        $employee_id[]                          =  $row->employee_id;
        $from_date[]                            =  date('d-m-Y', strtotime($row->from_date));
        $to_date[]                              =  $row->to_date;
        $base[]                                 =  $row->base; 
        $salary_structure_id                    =  $row->salary_structure_id;
        $variable[]                             =  $row->variable; 
        $trowEmp++;
    }
}
else
{
    $employee_id                        =   $this->input->post('employee_id');
    $from_date                          =   $this->input->post('from_date');  
    $to_date                            =   $this->input->post('to_date');  
    $base                               =   $this->input->post('base');  
    $variable                           =   $this->input->post('variable'); 
    $salary_structure_id                =   $this->input->post('salary_structure_id');   
}

if(!empty($tableData2))
{
    foreach($tableData2 as $row)
    {
        $earning_id[]                          =  $row->earning_id;
        $salary_structure_id                   =  $row->salary_structure_id;
        $salary_component_id_earing[]          =  $row->salary_component_id;
        $statistical_component_earing[]        =  $row->statistical_component; 
        $formula_earing[]                      =  $row->formula; 
        $amount_earing[]                       =  $row->amount; 
        $abbr_earing[]                         =  $row->abbr;
        $trowEar++;
    }
}
else
{
    $salary_component_id_earing                =   $this->input->post('salary_component_id_earing');
    $abbr_earing                               =   $this->input->post('abbr_earing');  
    $statistical_component_earing              =   $this->input->post('statistical_component_earing');  
    $formula_earing                            =   $this->input->post('formula_earing');
    $amount_earing                             =   $this->input->post('amount_earing');      
    $salary_structure_id                       =   $this->input->post('salary_structure_id');   
}

if(!empty($tableData3))
{
    foreach($tableData3 as $row)
    {
        $deduction_id[]                    =  $row->deduction_id;
        $salary_structure_id               =  $row->salary_structure_id;
        $salary_component_id_deduction[]   =  $row->salary_component_id;
        $statistical_component_deduction[] =  $row->statistical_component; 
        $formula_deduction[]               =  $row->formula; 
        $amount_deduction[]                =  $row->amount; 
        $abbr_deduction[]                  =  $row->abbr;
        $trowDed++;
    }
}
else
{
    $salary_component_id_deduction        =   $this->input->post('salary_component_id_deduction');
    $abbr_deduction                       =   $this->input->post('abbr_deduction');  
    $statistical_component                =   $this->input->post('statistical_component_deduction');  
    $statistical_component_deduction      =   $this->input->post('formula_deduction');
    $amount_deduction                     =   $this->input->post('amount_deduction');      
    $salary_structure_id                  =   $this->input->post('salary_structure_id');  
}

$trowEar        = count($salary_component_id_earing) ? count($salary_component_id_earing) :'1';
$trowDed        = count($salary_component_id_deduction) ? count($salary_component_id_deduction) :'1';
$trowEmp        = count($employee_id) ? count($employee_id) :'1';
$checkDisable   = ($salary_structure_id == '') ? 'disabled' : '';
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Salary_structure_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="salary_structure_id" id="salary_structure_id" value="<?php echo $salary_structure_id;?>">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_name');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="name" id="name" allow-characters value="<?php echo $name;?>" ng-init="name = '<?php echo $name; ?>'" class="form-control" ng-model="name" required maxlength="25"/>
                    <span class="help-block" ng-show="showMsgs && myform.name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error('name')?></span>
                </div>
            </div>
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'companies' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_company');?></label>
                    <span class="mandatory"> * </span>
                        <!--<?php 
                            $attrib = 'class="form-control select2" id="company_id" ng-model="company_id" required ';
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
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_salary_structure_is_active','' , 'structures' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_is_active');?></label>
                    <span class="mandatory"> * </span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="salary_structure_is_active_id" ng-model="salary_structure_is_active_id" required ';
                        echo form_dropdown('salary_structure_is_active_id', $salaryStructureActiveDropdown, set_value('salary_structure_is_active_id', (isset($salary_structure_is_active_id)) ? $salary_structure_is_active_id : ''), $attrib);
                        if(form_error('salary_structure_is_active_id')){ echo '<span class="help-block">'.form_error('salary_structure_is_active_id').'</span>';} 
                    ?>-->
                    <select name="salary_structure_is_active_id" ng-init="salary_structure_is_active_id = '<?php echo $salary_structure_is_active_id; ?>'" ng-model="salary_structure_is_active_id" id="salary_structure_is_active_id" class="form-control"  required select2>
                              <option value="">-- Select --</option>  
                              <option ng-repeat="salary_structure_is_active_id in structures" value="{{salary_structure_is_active_id.salary_structure_is_active_id}}">{{salary_structure_is_active_id.is_active}}</option>  
                         </select>
                    <span class="help-block" ng-show="showMsgs && myform.salary_structure_is_active_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_letter_head',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'letterHeads' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_letter_head');?></label>
                    <span class="mandatory"> * </span>
                    <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $dropdownUrllink;?>');">+</a> 
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="letter_head_id"';
                        echo form_dropdown('letter_head_id', $letterHeadDropdown, set_value('letter_head_id', (isset($letter_head_id)) ? $letter_head_id : ''), $attrib);
                        if(form_error('letter_head_id')){ echo '<span class="help-block">'.form_error('letter_head_id').'</span>';} 
                    ?>-->
                    <select name="letter_head_id" ng-init="letter_head_id = '<?php echo $letter_head_id; ?>'" ng-model="letter_head_id" id="letter_head_id" class="form-control" required select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="letter_head_id in letterHeads" value="{{letter_head_id.letter_head_id}}">{{letter_head_id.letter_head_name}}</option>  
                    </select> 
                    <span class="help-block" ng-show="showMsgs && myform.letter_head_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>                         
            <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_payroll_frquency','' , 'frquencies' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_payroll_frequency');?></label>
                    <span class="mandatory"> * </span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="payroll_frequency_id"ng-model="payroll_frequency_id" required  ';
                        echo form_dropdown('payroll_frequency_id', $payrollFrquencyDropdown, set_value('payroll_frequency_id', (isset($payroll_frequency_id)) ? $payroll_frequency_id : ''), $attrib);
                        if(form_error('payroll_frequency_id')){ echo '<span class="help-block">'.form_error('payroll_frequency_id').'</span>';} 
                    ?>-->
                    <select name="payroll_frequency_id" ng-init="payroll_frequency_id = '<?php echo $payroll_frequency_id; ?>'" ng-model="payroll_frequency_id" id="payroll_frequency_id" class="form-control"  required select2>
                              <option value="">-- Select --</option>  
                              <option ng-repeat="payroll_frequency_id in frquencies" value="{{payroll_frequency_id.payroll_frequency_id}}">{{payroll_frequency_id.payroll_frequency}}</option>  
                         </select>
                    <span class="help-block" ng-show="showMsgs && myform.payroll_frequency_id.$error.required"><?php echo $this->lang->line('required');?></span> 
                </div>
            </div>      
        </div>
        <hr>
        <!--Select Employee: -->
        <label><?php echo $this->lang->line('label_select_employee');?></label>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <!--<th><input type="checkbox" ></th>-->
                    <th></th>
                    <th><?php echo lang('label_employee');?></th>
                    <th><?php echo lang('label_from_date');?></th>
                    <th><?php echo lang('label_base');?></th>
                    <th><?php echo lang('label_variable');?></th>
                    <th></th>
                </tr>
            </thead>
                <tbody id="employee">
                <?php 
                    $is=1;
                    for($in=0; $in < $trowEmp; $in++)
                    {
                        ?>
                        <tr>
                            <td>
                            <input type="checkbox" name="salary_structure_select_employee_id[]" data-name="salary_structure_select_employee_id" id="salary_structure_select_employee_id<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo $salary_structure_select_employee_id[$in];?>" class="new_row_delete" onclick="checkDeleteButton('new_row_delete', 'add_delete');" <?php echo $checkDisable;?>>
                            <input type="hidden" name="salary_structure_select_employee_id[]"  value="<?php echo $salary_structure_select_employee_id[$in];?>">
                            </td>
                            <td>
                                <?php
                                    $attrib = 'class="form-control" data-name="employee_id" id="employee_id'.$in.'" data-row="'.$in.'"';
                                    echo form_dropdown('employee_id[]', $employeeDropdown, set_value('employee_id['.$in.']', (isset($employee_id[$in])) ? $employee_id[$in] : ''), $attrib);
                                ?> 
                            </td>
                            <td>
                                <!--<input type="text" name="from_date[]" uib-datepicker-popup="{{format}}" ng-model="from_date" is-open="popup1.opened"  ng-required="false" name="from_date" ng-focus="open('popup1')" data-ng-init="init('<?php echo $from_date?>', 'from_date')"  data-name="from_date" id="from_date<?php echo $in;?>" data-row="<?php echo $in;?>" class="form-control" value = "<?php echo $from_date[$in] ;?>"  />

                                <input type="hidden" name="to_date[]"uib-datepicker-popup="{{format}}" ng-model="to_date" is-open="popup2.opened"  ng-required="false" name="to_date" ng-focus="open('popup2')" data-ng-init="init('<?php echo $to_date?>', 'to_date')" data-name="to_date" id="to_date<?php echo $in;?>" data-row="<?php echo $in;?>"  class="form-control" value = "<?php echo $todate[$in] ;?>"/>-->

                                <input type="text" name="from_date[]" name="from_date" data-name="from_date" id="from_date<?php echo $in;?>" data-row="<?php echo $in;?>" class="form-control single-daterange" value = "<?php echo $from_date[$in] ;?>"  />

                                <input type="hidden" name="to_date[]" name="to_date" data-name="to_date" id="to_date<?php echo $in;?>" data-row="<?php echo $in;?>" class="form-control single-daterange" value = "<?php echo $to_date[$in] ;?>"  />
                            </td>
                            <td><input type="text" name="base[]" ng-init="base = '<?php echo $base[$in]; ?>'" data-name="base" id="base<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo $base[$in];?>" class="form-control baseAmount" onkeypress="return isNumberKey(event)" maxlength="15"/></td><!-- onkeyup="calTotalBase()"-->
                            <td>
                                <input type="text" name="variable[]"  data-name="variable" ng-init="variable = '<?php echo $variable[$in]; ?>'" id="variable<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo $variable[$in];?>" class="form-control" onkeypress="return isNumberKey(event)" maxlength="15" ng-pattern="/^[0-9]{10}$/"/>
                            </td>
                            <td> <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl;?>');" name=""><?php echo $this->lang->line('label_Details');?></button></td>    
                        </tr>
                    <?php                      
                $is++;
                } 
            ?> 
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">                           
                    <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('employee');" > <?php echo $this->lang->line('label_add_row');?> </button>
                    <input type="button" class="btn btn-danger btn-sm add_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('employee', 'new_row_delete', 'hr_salary_structure_select_employee', 'salary_structure_select_employee_id');" disabled>
                    </td>
                </tr>
            </tfoot>                     
        </table><br>
        <!--<input type="text" name="total_base" id="total_base">-->
        <hr>
        <!--Salary Slip: -->
        <label>
        <input type="checkbox" name="salary_slip_based_on_timesheet"  id="salary_slip_based_on_timesheet"  onclick="showContent(this, '.MaintainingSalaryContent')" value="1" <?php echo ($salary_slip_based_on_timesheet =='1')?'checked':'' ?>/>
            <!--<input type="checkbox" name="salary_slip" id="salary_slip"  onclick="showContent(this, '.MaintainingSalaryContent')" />-->
            <?php echo $this->lang->line('label_salary_slip_based_ts');?>
        </label>
        <?php $checkBoxClass = ($salary_slip_based_on_timesheet == '1') ? 'block': 'none'; ?>
        <span style="display: <?php echo $checkBoxClass;?>" class="MaintainingSalaryContent">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_salary_component');?></label>
                        <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $dropdownUrllink;?>');">+</a> 
                        <?php 
                            $attrib = 'class="form-control" id="salary_component_id"';
                            echo form_dropdown('salary_component_id', $EarningDropdown, set_value('salary_component_id', (isset($salary_component_id)) ? $salary_component_id : ''), $attrib);
                        ?>
                        <span class="help-block"><?php echo form_error('salary_component')?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_hour_rate');?></label>
                        <input type="text" name="hour_rate" ng-init="hour_rate = '<?php echo $hour_rate; ?>'" id="hour_rate" value="<?php echo $hour_rate;?>";" class="form-control"/>
                        <span class="help-block"><?php echo form_error('hour_rate')?></span>
                    </div>
                </div>
            </div> <br> 
        </span>                
        <hr>
        <!--Earning: -->
        <label><?php echo $this->lang->line('label_earning');?></label>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <!--<th><input type="checkbox"></th>-->
                    <th></th>
                    <th><?php echo lang('label_component');?> <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $dropdownUrllink;?>');">+</a> </th>
                    <th><?php echo lang('label_abbr');?></th>
                    <th><?php echo lang('label_statistical_component');?></th>
                    <th><?php echo lang('label_formula');?> (base*n)</th>
                    <!--<th><?php echo lang('label_amount');?></th>
                    <th></th>-->
                </tr>
            </thead>
                <tbody id = "Earning">
            <?php 
                $is=1;
                for($in=0; $in < $trowEar; $in++)
                {
                ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="earning_id[]" value="<?php echo $earning_id[$in];?>" class ="earning_row_delete" onclick="checkDeleteButton('earning_row_delete', 'earning_delete');" <?php echo $checkDisable;?>>
                            <input type="hidden" name="earning_id[]" class="" value="<?php echo $earning_id[$in];?>">
                        </td>
                        <td>
                            <?php
                                $attrib = 'class="form-control" data-name="salary_component_id_earing" id="salary_component_id_earing'.$in.'" data-row="'.$in.'" onchange="loadSalaryearn_abbr(this.id,this.value)"';
                                echo form_dropdown('salary_component_id_earing[]', $EarningDropdown, set_value('salary_component_id_earing['.$in.']', (isset($salary_component_id_earing[$in])) ? $salary_component_id_earing[$in] : ''), $attrib);
                            ?>
                        </td>
                        <td>
                            <input type="text" name="abbr_earing[]" ng-init="abbr_earing = '<?php echo $abbr_earing[$in]; ?>'"  data-name="salary_component_abbr_earing" id="salary_component_abbr_earing<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo $abbr_earing[$in];?>" class="form-control" readonly/>
                        </td>
                        <td>
                            <input type="checkbox" name="statistical_component_earing[<?php echo $in;?>]" ng-init="statistical_component_earing = '<?php echo $statistical_component_earing[$in]; ?>'"  data-name="ear_statistical_component" id="ear_statistical_component<?php echo $in;?>" data-row="<?php echo $in;?>" value="1" <?php if($statistical_component_earing[$in] == 1){ echo 'checked = "checked"';} ?>/>
                        </td>
                        <td>
                        <textarea row="5" columns="10" name="formula_earing[]" ng-init="formula_earing = '<?php echo $formula_earing[$in]; ?>'" data-name="ear_formular" id="ear_formular<?php echo $in;?>" data-row="<?php echo $in;?>" class="form-control"><?php echo $formula_earing[$in];?></textarea><!--onkeyup="calucalateEarnAmount(this.id, this.value)"-->
                        </td>
                        <!--<td>
                            <input type="text" name="amount_earing[]" ng-init="amount_earing = '<?php echo $amount_earing[$in]; ?>'" data-name="ear_amount" id="ear_amount<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo$amount_earing[$in];?>" class="form-control" readonly/>
                        </td>
                        <td> <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl1;?>');" name=""><?php echo $this->lang->line('label_Details');?></button> </td>-->  
                    </tr>
                <?php                      
                $is++;
                } 
            ?> 
                </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">                           
                        <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('Earning');" ><?php echo $this->lang->line('label_add_row');?></button>
                        <input type="button" class="btn btn-danger btn-sm earning_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('Earning', 'earning_row_delete', 'hr_earning', 'earning_id');" disabled>
                    </td>
                </tr>
            </tfoot>                     
        </table><br>
        <hr>

        <!--Deduction: -->
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_deduction');?></span></legend>
           <table class="table table-bordered">
                <thead>
                    <tr>
                        <!--<th><input type="checkbox"></th>-->
                        <th></th>
                        <th><?php echo lang('label_component');?> <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $dropdownUrllink;?>');">+</a> </th>
                        <th><?php echo lang('label_abbr');?></th>
                        <th><?php echo lang('label_statistical_component');?></th>
                        <th><?php echo lang('label_formula');?> (base*n)</th>
                        <!--<th><?php echo lang('label_amount');?></th>
                        <th></th>-->
                    </tr>
                </thead>
                <tbody id = "Deduction">
                <?php 
                    $is=1;
                    for($in=0; $in < $trowDed; $in++)
                    {
                    ?>      
                        <tr>
                            <td>
                                <input type="checkbox" name="deduction_id[]" value = "<?php echo $deduction_id[$in] ;?>" class="deduction_row_delete" onclick="checkDeleteButton('deduction_row_delete', 'deduction_delete');" <?php echo $checkDisable;?>>
                                <input type="hidden" name="deduction_id[]" class="" value="<?php echo $deduction_id[$in];?>">
                            </td>
                            <td>
                                <?php
                                $attrib = 'class="form-control" data-name="salary_component_id_deduction" id="salary_component_id_deduction'.$in.'" data-row="'.$in.'" onchange="loadSalarydeduct_abbr(this.id,this.value)"';
                                echo form_dropdown('salary_component_id_deduction[]', $DeductionDropdown, set_value('salary_component_id_deduction['.$in.']', (isset($salary_component_id_deduction[$in])) ? $salary_component_id_deduction[$in] : ''), $attrib);
                            ?>
                            </td>
                            <td>
                                <input type="text" name="abbr_deduction[]" ng-init="abbr_deduction = '<?php echo $abbr_deduction[$in]; ?>'" data-name="salary_component_abbr_deduction" id="salary_component_abbr_deduction<?php echo $in;?>" data-row="<?php echo $in;?>"  value="<?php echo $abbr_deduction[$in];?>" class="form-control" readonly/>                                    
                            </td>
                            <td>
                                <input type="checkbox" name="statistical_component_deduction[<?php echo $in;?>]" ng-init="statistical_component_deduction = '<?php echo $statistical_component_deduction[$in]; ?>'"  data-name="statistical_component_deduction" id="statistical_component_deduction<?php echo $in;?>" data-row="<?php echo $in;?>" value="1" <?php if($statistical_component_deduction[$in] == 1){ echo 'checked = "checked"';} ?>/>
                                <!--<input type="checkbox" name="statistical_component_deduction[]" ng-init="statistical_component_deduction = '<?php echo $statistical_component_deduction[$in]; ?>'" data-name="statistical_component_deduction" id="statistical_component_deduction<?php echo $in;?>" data-row="<?php echo $in;?>"
                                value="1" <?php if($statistical_component[$in] == 1) { echo 'checked = "checked"';} ?> />-->
                            </td>
                            <td>
                                 <textarea name="formula_deduction[]" row="5" ng-init="formula_deduction = '<?php echo $formula_deduction[$in]; ?>'" data-name="formula_deduction" id="formula_deduction<?php echo $in;?>" data-row="<?php echo $in;?> columns="10" class="form-control"><?php echo$formula_deduction[$in];?></textarea><!--onkeyup="calucalateDeductionAmount(this.id, this.value)"-->
                            </td>
                            <!--<td>
                                <input type="text" name="amount_deduction[]" ng-init="amount_deduction = '<?php echo $amount_deduction[$in]; ?>'" data-name="amount" id="amount<?php echo $in;?>" data-row="<?php echo $in;?>""  value="<?php echo$amount_deduction[$in];?>" class="form-control" readonly/>
                            </td>
                            <td> 
                                <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl2;?>');" name=""><?php echo $this->lang->line('label_Details');?></button> 
                            </td>-->   
                        </tr>
                    <?php                      
                    $is++;
                    } 
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">                           
                       <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('Deduction');" > <?php echo $this->lang->line('label_add_row');?> </button>
                       <input type="button" class="btn btn-danger btn-sm deduction_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('Deduction', 'deduction_row_delete', 'hr_deduction', 'deduction_id');" disabled>  
                        </td>
                    </tr>
                </tfoot>                     
            </table>
        </fieldset>

        <!--Accounts: -->
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_accounts');?></span></legend>
             <div class="row">
                <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_acc_mode_of_payment_type','' , 'modTypes' )">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_mode_of_payment');?></label>
                        <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $dropdownUrlMode;?>');">+</a>  
                        <!--<?php 
                            $attrib = 'class="form-control select2" id="mode_of_payment_id"';
                            echo form_dropdown('mode_of_payment_id', $modeofPaymentDropdown, set_value('mode_of_payment_id', (isset($mode_of_payment_id)) ? $mode_of_payment_id : ''), $attrib);
                            if(form_error('mode_of_payment_id')){ echo '<span class="help-block">'.form_error('mode_of_payment_id').'</span>';}
                        ?>-->
                        <select name="mode_of_payment_id" ng-init="mode_of_payment_id = '<?php echo $mode_of_payment_id; ?>'" ng-model="mode_of_payment_id" id="mode_of_payment_id" class="form-control" select2>
                              <option value="">-- Select --</option>  
                              <option ng-repeat="mode_of_payment_id in modTypes" value="{{mode_of_payment_id.mode_of_payment_type_id}}">{{mode_of_payment_id.type}}</option>  
                         </select>
                        <span class="help-block"><?php echo form_error('mode_of_payment')?></span>
                    </div>
                </div>
                <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/acc_account',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'accounts' )">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_payment_account');?></label>
                        <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $dropdownUrlAcc;?>');">+</a> 
                        <!--<?php 
                            $attrib = 'class="form-control select2" id="payment_account"';
                            echo form_dropdown('payment_account', $accountsDropdown, set_value('payment_account', (isset($payment_account)) ? $payment_account : ''), $attrib);
                            if(form_error('payment_account')){ echo '<span class="help-block">'.form_error('payment_account').'</span>';}
                        ?>-->
                        <select name="payment_account" ng-init="payment_account = '<?php echo $payment_account; ?>'" ng-model="payment_account" id="payment_account" class="form-control" select2>
                              <option value="">-- Select --</option>  
                              <option ng-repeat="payment_account in accounts" value="{{payment_account.account_id}}">{{payment_account.account_name}}</option>  
                         </select>
                    </div>
                </div>
            </div>
        </fieldset>

         <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('.single-daterange').daterangepicker({singleDatePicker: true,locale: {format: 'DD-MM-YYYY'}});

        //calTotalBase();
    });

    /*function calTotalBase() 
    {
        total_base       = 0;

        $('.baseAmount').each(function()
        {
            total_base        += Number($(this).val());
            $('#total_base').val(total_base);
        });
    }

    function calucalateEarnAmount(id, val) 
    {
        var id          = id;
        var thenum      = id.match(/\d+$/)[0];
        var arr         = val.split('base*');
        var total_base  = $('#total_base').val();
        var amount      = total_base * arr[1];

        if(amount)
        {
            $('#ear_amount'+thenum).val(amount);
        }
    }

    function calucalateDeductionAmount(id, val) 
    {
        var id          = id;
        var thenum      = id.match(/\d+$/)[0];
        var arr         = val.split('base*');
        var total_base  = $('#total_base').val();
        var amount      = total_base * arr[1];

        if(amount)
        {
            $('#amount'+thenum).val(amount);
        }
    }*/
</script>