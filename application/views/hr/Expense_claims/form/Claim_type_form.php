<?php
$ci =&get_instance();
$namingSeriesdrop           =  $ci->mdrop->namingSeriesdrop('101');
$defaultaccountDropdown     =  $ci->mcommon->Dropdown('acc_account', array('account_id as Key', 'account_name as Value'), array('is_delete' => 0));
$companyDropdown            =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name      as Value'), array('is_delete' => 0));

$default_account                =   array();
$expense_claims_type_id         =   "";
$expense_claim_type_account_id  =   array();
$expense_type                   =   "";
$description                    =   "";
$company_id                     =   array();
$accounts                       =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $expense_claim_type_id          =   $row->expense_claim_type_id;
        $naming_series                  =   $row->naming_series;
        $expense_type                   =   $row->expense_type;
        $description                    =   $row->description;
    }

    $naming_seriesArr =   explode('/', $naming_series);
    foreach ($naming_seriesArr as $key => $value) 
    {
        $set_options    =   $naming_seriesArr[0];
    }
    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '101'), 'naming_series_id');

    $naming_option      =   $source_id."_".$set_options; 
}
else
{
    $expense_claim_type_id              =   $this->input->post('expense_claim_type_id');
    $expense_type                       =   $this->input->post('expense_type');
    $description                        =   $this->input->post('description');
}

if(!empty($tableData1))
{
    foreach ($tableData1 as $row )
    {
        $expense_claim_type_id             =   $row->expense_claim_type_id;
        $expense_claim_type_account_id[]   =   $row->expense_claim_type_account_id;
        $company_id[]                      =   $row->company_id;
        $default_account[]                 =   $row->default_account;
        $trowEmp++;        
    }
}
else
{   
    $expense_claim_type_account_id      =   $this->input->post('expense_claim_type_account_id');
    $company_id                         =   $this->input->post('company_id');
    $accounts                           =   $this->input->post('default_account');
}

$trowEmp        = count($company_id) ? count($company_id):'1';
$checkDisable   = ($expense_claim_type_id == '') ? 'disabled' : '';
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Claim_type_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="expense_claim_type_id" id="expense_claim_type_id" value="<?php echo $expense_claim_type_id;?>" >
            <div class="row">
                <div class="col-md-4" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/101')">
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
                        <label><?php echo $this->lang->line('label_expense_claim_type');?></label>
                        <span class="mandatory">*</span>
                        <input type="text" name="expense_type" id="expense_type" ng-init="expense_type = '<?php echo $expense_type; ?>'" value="<?php echo $expense_type;?>" class="form-control" ng-model="expense_type" required allow-characters ng-keyup="checkUnique('../../Common_controller/checkUnique/hr_expense_claim_type', expense_type, 'expense_type')"/>
                        <span class="help-block" ng-show="showMsgs && myform.expense_type.$error.required"><?php echo $this->lang->line('required');?></span>
                        <span class="help-block" ng-show="myform.expense_type.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                        <span class="help-block"><?php echo form_error('expense_type')?></span>
                        <span class="help-block" ng-show="showuniqueMsgs">{{expense_type}} already in use</span>
                    </div>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_description');?></label>
                        <span class="mandatory">*</span>
                        <textarea class="form-control" rows="3" name="description" ng-init="description = '<?php echo $description; ?>'" id="description" ng-model="description" required><?php echo $description;?></textarea>
                        <span class="help-block" ng-show="showMsgs && myform.description.$error.required"><?php echo $this->lang->line('required');?></span>
                        <span class="help-block" ng-show="myform.description.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                        <span class="help-block"><?php echo form_error('description')?></span>
                    </div>  
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-bordered">
                        <thead>
                            <tr>
                                <!--<th><input type="checkbox" name=""></th>-->
                                <th></th>
                                <th><?php echo lang('label_company');?></th>
                                <th><?php echo lang('label_default_account');?></th>
                            </tr>
                        </thead>
                        <tbody id="claim_types" >
                        <?php 
                        $is=1;
                        for($in=0; $in < $trowEmp; $in++)
                        {
                        ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="exp_claim_type_cbx" id="exp_claim_type_cbx<?php echo $in;?>" data-name="exp_claim_type_cbx" data-row="<?php echo $in;?>" value="<?php echo $expense_claim_type_account_id[$in];?>" onclick="checkDeleteButton('exp_claim_type_cbx', 'add_delete');" <?php echo $checkDisable;?>/>
                                    <input type="hidden" name="expense_claim_type_account_id[]" value="<?php echo $expense_claim_type_account_id[$in] ?>" data-row="<?php echo $in;?>" data-name="expense_claim_type_account_id" id="expense_claim_type_account_id<?php echo $in;?>">
                                </td>
                                <td> 
                                    <?php 
                                    $attrib = 'class="form-control" id="company_id'.$in.'" onchange="addEmployee()" data-row="'.$in.'" data-name="company_id"';
                                    echo form_dropdown('company_id[]', $companyDropdown, set_value('company_id['.$in.']', (isset($company_id[$in])) ? $company_id[$in] : ''), $attrib);
                                    if(form_error('company_id['.$in.']')){ echo '<span class="help-block">'.form_error('company_id['.$in.']').'</span>';} 
                                    ?> 
                                    <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>
                                </td>
                                <td> 
                                    <?php 
                                        $attrib = 'class="form-control" id="default_account'.$in.'" data-name="default_account" data-row="'.$in.'"';
                                        echo form_dropdown('default_account[]', $defaultaccountDropdown, set_value('default_account['.$in.']', (isset($default_account[$in])) ? $default_account[$in] : ''), $attrib);?>
                                        <?PHP if(form_error('default_account['.$in.']')){ echo '<span class="help-block">'.form_error('default_account['.$in.']').'</span>';} 
                                    ?>
                                </td>
                            </tr>
                        <?php                      
                        $is++;
                        } 
                        ?> 
                        </tbody> 
                        <tfoot>
                            <th colspan="6">
                                <button class="btn btn-primary btn-sm" id ="e" data-name="e" type="button" onclick="addNewRow('claim_types');" > <?php echo $this->lang->line('label_add_row');?> </button>
                                <input type="button" class="btn btn-danger btn-sm add_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('claim_types', 'exp_claim_type_cbx', 'hr_expense_claim_account', 'expense_claim_type_account_id');" disabled>
                            </th>
                        </tfoot>                
                    </table>
                </div>
            </div>
            <!--<div class="form-buttons-w">
                <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
                <a href="<?php echo base_url('hr/Expense_claims/Claim_type') ?>" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
            </div>-->
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
                <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform', 'showuniqueMsgs')"><?php echo $this->lang->line('label_submit');?></button>
            </div>
    </form>
</div>