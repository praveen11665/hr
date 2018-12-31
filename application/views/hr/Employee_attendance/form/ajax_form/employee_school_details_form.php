<?php
 $ci =&get_instance();
$employeeLevelDropdown      =  $ci->mcommon->Dropdown('def_hr_employee_level', array('employee_level_id as Key', 'level as Value'));
?>



<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxContentForm">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""><?php echo lang('label_employee_school_university');?> </label>
                <input type="text" name="school_university" id="school_university" value="<?php echo $school_university;?>" class="form-control"/>            
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo lang('label_employee_qualification');?></label>
               <input type="text" name="qualification" id="qualification" value="<?php echo $qualification;?>" class="form-control"/> </textarea>                
                <span class="help-block"><?php echo form_error('description');?></span>
            </div>  
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""><?php echo lang('label_employee_level');?> </label>
               <?php 
                    $attrib = 'class="form-control select2" id="employee_level_id"';
                    echo form_dropdown('employee_level_id', $employeeLevelDropdown, set_value('employee_level_id', (isset($employee_level_id)) ? $employee_level_id : ''), $attrib);
                    if(form_error('employee_level_id')){ echo '<span class="help-block">'.form_error('employee_level_id').'</span>';} 
                ?>              
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo lang('label_employee_year_of_passing');?></label>
                <input type="text" name="year_of_passing" id="year_of_passing" value="<?php echo $year_of_passing;?>" class="form-control"/>                
                <span class="help-block"><?php echo form_error('description');?></span>
            </div>  
        </div>
    </div>
    <div class="form-buttons-w">
        <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
        <button class="btn btn-danger" type="reset" name="reset"> <?php echo $this->lang->line('label_cancel');?></button>
    </div>
</form>
