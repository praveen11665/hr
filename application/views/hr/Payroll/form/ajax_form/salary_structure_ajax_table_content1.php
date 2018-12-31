<?php
$ci  =&get_instance();

$EmployeeIdDropdown        =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_number as Value'));


?>

<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxContentForm">
	<input type="hidden" name="salary_structure_select_employee_id" id="salary_structure_select_employee_id" value="<?php echo $salary_structure_select_employee_id; ?>"/>
	<div class="row">
		<div class="col-md-6">
            <div class="form-group">
                <label for=""><?php echo $this->lang->line('label_employee');?> </label>
                <a class="add-new-popup" onclick="">+</a>
                <span class="mandatory">*</span><br/>
                <?php 
                    $attrib = 'class="form-control select2" id="employee_id" onchange="loademployeename();"';
                    echo form_dropdown('employee_id', $EmployeeIdDropdown, set_value('employee_id', (isset($employee_id)) ? $employee_id : ''), $attrib);
                    if(form_error('employee_id')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';}
                ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo $this->lang->line('label_employee_name');?></label>	                
                <input type="text" name="employee_name" id="employee_name" value="<?php echo $employee_name;?>" class="form-control"  readonly/>
                <span class="help-block"><?php echo form_error('employee_name');?></span>
            </div>  
        </div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
                <label><?php echo $this->lang->line('label_from_date');?></label>	                
                <input type="text" name="from_date" id="from_date" class="single-daterange form-control"/>
                <span class="help-block"><?php echo form_error('from_date');?></span>
            </div>  
		</div>
		<div class="col-md-6">
			<div class="form-group">
                <label><?php echo $this->lang->line('label_employee_to_date');?></label>	                
                <input type="text" name="to_date" id="to_date" value="<?php echo $to_date;?>" class="single-daterange form-control" />
                <span class="help-block"><?php echo form_error('to_date');?></span>
            </div>  
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
                <label><?php echo $this->lang->line('label_base');?></label>	                
                <input type="text" name="base" id="base" value="<?php echo $base;?>" class="form-control"/>
                <span class="help-block"><?php echo form_error('base');?></span>
            </div> 
		</div>
		<div class="col-md-6">
			<div class="form-group">
                <label><?php echo $this->lang->line('label_variable');?></label>	                
                <input type="text" name="variable" id="variable" value="<?php echo $variable;?>" class="form-control"/>
                <span class="help-block"><?php echo form_error('variable');?></span>
            </div> 
		</div>
	</div>
	<div class="form-buttons-w">
        <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
        <button class="btn btn-danger" type="reset" name="reset"> <?php echo $this->lang->line('label_cancel');?></button>
    </div>
</form>
