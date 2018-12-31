 <?php
$ci =&get_instance();

$salarycomponenttypeDropdown        =  $ci->mcommon->Dropdown('def_hr_salary_component_type', array('salary_component_type_id  as Key', 'type as Value'));
$companyDropdown                    =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name      as Value'), array('is_delete' => 0));
$accountsDropdown                   =  $ci->mcommon->Dropdown('acc_account', array('account_id as Key', 'account_name as Value'),array('is_delete' => 0));

//Variable Initialize
$salary_component_id                =   "";
$salary_component                   =   "";
$salary_component_abbr              =   "";
$salary_component_type_id           =   "";
$description                        =   "";
$company_id                         =   array();
$default_account                    =   array();
$salary_component_account_id        =   array();

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $salary_component_id        =  $row->salary_component_id;
        $salary_component           =  $row->salary_component;
        $salary_component_abbr      =  $row->salary_component_abbr;
        $salary_component_type_id   =  $row->salary_component_type_id;        
        $description                =  $row->description;        
    }
}
else
{
    $salary_component_id            =   $this->input->post('salary_component_id');   
    $salary_component               =   $this->input->post('salary_component'); 
    $salary_component_abbr          =   $this->input->post('salary_component_abbr');
    $salary_component_type_id       =   $this->input->post('salary_component_type_id');
    $description                    =   $this->input->post('description');
}

if(!empty($tableData1))
{
    foreach($tableData1 as $row)
    {
        $salary_component_account_id[]  =  $row->salary_component_account_id;
        $company_id[]                   =  $row->company_id;
        $default_account[]              =  $row->default_account;  
        $trowEmp++; 
    }
}
else
{
    $salary_component_account_id    =   $this->input->post('salary_component_account_id');   
    $company_id                     =   $this->input->post('company_id');
    $default_account                =   $this->input->post('default_account');   
}

$trowEmp        = count($company_id) ? count($company_id):'1';
$checkDisable   = ($salary_component_id == '') ? 'disabled' : '';
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Salary_components_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
      <input type="hidden" name="salary_component_id" id="salary_component_id" value="<?php echo $salary_component_id;?>" >
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_name');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" name="salary_component" ng-pattern="/^[a-zA-Z\s]*$/" allow-characters maxlength="25" required id="salary_component" class="form-control" ng-init="salary_component = '<?php echo $salary_component; ?>'" value="<?php echo $salary_component;?>" ng-model="salary_component" required />
                    <span class="help-block" ng-show="showMsgs && myform.salary_component.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.salary_component.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('salary_component')?></span>
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_abbreviation');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" name="salary_component_abbr" ng-pattern="/^[a-zA-Z\s]*$/" allow-characters maxlength="30" id="salary_component_abbr" class="form-control" ng-init="salary_component_abbr = '<?php echo $salary_component_abbr; ?>'" value="<?php echo $salary_component_abbr;?>" ng-model="salary_component_abbr" required />
                    <span class="help-block" ng-show="showMsgs && myform.salary_component_abbr.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.salary_component_abbr.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('salary_component_abbr')?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/def_hr_salary_component_type','' , 'components' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_type');?></label>
                    <span class="mandatory"> * </span>
                    <!--<?php 
                    $attrib = 'class="form-control select2" id="salary_component_type_id" ng-model="salary_component_type_id" required';
                    echo form_dropdown('salary_component_type_id', $salarycomponenttypeDropdown, set_value('salary_component_type_id', (isset($salary_component_type_id)) ? $salary_component_type_id : ''), $attrib); 
                        if(form_error('salary_component_type_id')){ echo '<span class="help-block">'.form_error('salary_component_type_id').'</span>';}
                    ?>-->
                    <select name="salary_component_type_id" ng-init="salary_component_type_id = '<?php echo $salary_component_type_id; ?>'" ng-model="salary_component_type_id" id="salary_component_type_id" class="form-control" required select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="salary_component_type_id in components" value="{{salary_component_type_id.salary_component_type_id}}">{{salary_component_type_id.type}}</option>  
                     </select>
                    <span class="help-block" ng-show="showMsgs && myform.salary_component_type_id.$error.required"><?php echo $this->lang->line('required');?></span>  
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_description');?></label>
                    <span class="mandatory"> * </span>
                    <textarea name="description" row="5" columns="10" class="form-control" ng-init="description = '<?php echo $description; ?>'" ng-model="description" required > <?php echo $description;?></textarea>
                    <span class="help-block" ng-show="showMsgs && myform.description.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error('description')?></span>
                </div>
            </div> 
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <!--<th><input type="checkbox" name=""></th>-->
                            <th><label><?php echo $this->lang->line('label_company');?></label></th>
                            <th> <label><?php echo $this->lang->line('label_default_account');?>  <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $dropdownUrllink;?>');">+</a> </label></th>           
                        </tr>
                    </thead>
                    <tbody id="Component">
                    <?php 
                        $is=1;
                        for($in=0; $in < $trowEmp; $in++)
                        {
                        ?>
                        <tr>
                            <td><input type="checkbox" name="salary_component_account_id[]" value="<?php echo $salary_component_account_id[$in];?>" class="add_row_delete" onclick="checkDeleteButton('add_row_delete', 'add-delete');" <?php echo $checkDisable;?>/>
                            <input type="hidden" name="salary_component_account_id[]" value="<?php echo $salary_component_account_id[$in];?>" class="add_row_delete"/>
                            </td>
                            <td>
                                <?php 
                                    $attrib = 'class="form-control" id="company_id" ';
                                    echo form_dropdown('company_id[]', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id[$in] : ''), $attrib);
                                    if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} 
                                ?> 
                            </td>
                            <td>
                                <?php 
                                    $attrib = 'class="form-control" id="default_account"';
                                    echo form_dropdown('default_account[]', $accountsDropdown, set_value('default_account[$in]', (isset($default_account)) ? $default_account[$in] : ''), $attrib);
                                    if(form_error('default_account')){ echo '<span class="help-block">'.form_error('default_account').'</span>';}
                                ?>
                            </td>                       
                        </tr>
                        <?php                      
                        $is++;
                        } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6">
                                <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('Component');" > <?php echo $this->lang->line('label_add_row');?> </button>
                                <input type="button" class="btn btn-danger btn-sm add-delete" name="" id="addrow" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('Component', 'add_row_delete', 'hr_salary_component_account', 'salary_component_account_id');" disabled>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>