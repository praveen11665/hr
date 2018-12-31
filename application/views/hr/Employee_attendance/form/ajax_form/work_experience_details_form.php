<?php
 $ci =&get_instance();
$employeeLevelDropdown      =  $ci->mcommon->Dropdown('def_hr_employee_level', array('employee_level_id as Key', 'level as Value'));
?>



<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxContentForm">
  <input type="hidden" name="holiday_list_holiday_id" id="holiday_list_holiday_id" value="<?php echo $holiday_list_holiday_id; ?>"/>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""><?php echo lang('label_employee_company');?> </label>
                <input type="text" name="company_name" id="company_name" value="<?php echo $company_name;?>" class="form-control"/>     
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo lang('label_employee_previous_designation');?></label>
                <input type="text" name="company_name" id="company_name" value="<?php echo $company_name;?>" class="form-control"/>                 
                <span class="help-block"><?php echo form_error('description');?></span>
            </div>  
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""><?php echo lang('label_employee_salary');?> </label>
               <input type="text" name="company_name" id="company_name" value="<?php echo $company_name;?>" class="form-control"/>              
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo lang('label_employee_address');?></label>
                 <input type="text" name="company_name" id="company_name" value="<?php echo $company_name;?>" class="form-control"/>               
                <span class="help-block"><?php echo form_error('description');?></span>
            </div>  
        </div>
    </div>
     <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""><?php echo lang('label_total_experience');?> </label>
                <input type="text" name="company_name" id="company_name" value="<?php echo $company_name;?>" class="form-control"/>              
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo lang('label_employee_address');?></label>
                 <input type="text" name="company_name" id="company_name" value="<?php echo $company_name;?>" class="form-control"/>            
                <span class="help-block"><?php echo form_error('description');?></span>
            </div>  
        </div>
    </div>
    <div class="form-buttons-w">
        <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
        <button class="btn btn-danger" type="reset" name="reset"> <?php echo $this->lang->line('label_cancel');?></button>
    </div>
</form>
