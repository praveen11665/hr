<?php

$ci  =&get_instance();
$salaryComponentDropdown        =  $ci->mcommon->Dropdown('hr_salary_component', array('salary_component_id as Key', 'salary_component as Value'));


?>
<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxContentForm">
	<input type="hidden" name="salary_detail_id" id="salary_detail_id" value="<?php echo $salary_detail_id; ?>"/>
	<div class="row">
		<div class="col-md-6">
            <div class="form-group">
                <label><?php echo $this->lang->line('label_salary_component');?></label>
                <a class="add-new-popup" onclick="">+</a><br>
                <?php 
                    $attrib = 'class="form-control select2" id="salary_component_id"';
                    echo form_dropdown('salary_component_id', $salaryComponentDropdown, set_value('salary_component_id', (isset($salary_component_id)) ? $salary_component_id : ''), $attrib);
                    if(form_error('salary_component_id')){ echo '<span class="help-block">'.form_error('salary_component_id').'</span>';} 
                ?>
                <span class="help-block"><?php echo form_error('salary_component')?></span>
            </div>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        	<div class="form-group">
                <label><?php echo $this->lang->line('label_condition');?></label>               
                <textarea class="form-control" rows="3" name="condition" id="condition" ><?php echo $reason;?></textarea>
                <span class="help-block"><?php echo form_error('condition');?></span>
            </div>

        </div>
        <div class="col-md-6">
        </div>		
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>
			        <input type="checkbox" name="amount_based_on_formula" checked=""  id="amount_based_on_formula" onclick="showMultiContent(this, '.MaintainingSalaryContent', '.name')" value="1" <?php echo ($amount_based_on_formula =='1')?'checked':'' ?>/> 

			            <?php echo $this->lang->line('label_amount_based_formula');?>
			    </label>
			</div>
		</div>
		<div class="col-md-6">
		</div>
	</div>

	<div class="row">	
		<div class="col-md-6 MaintainingSalaryContent" style="display:<?php echo($amount_based_on_formula);?> ? 'block' : 'none';">		
			<div class="form-group">
	            <label><?php echo $this->lang->line('label_formula');?></label>
	            <textarea class="form-control" rows="3" name="formula" id="formula" ><?php echo $reason;?></textarea>           
	            <span class="help-block"><?php echo form_error('formula')?></span>
	        </div>
	    </div>	
		<div class="col-md-6">
		</div>
	</div>
	<div class="row">	
		<div class="col-md-6 name" style="display: none;">
		
			<div class="form-group">
	            <label><?php echo $this->lang->line('label_amount');?></label>
	            <input type="text" name="amount" id="amount" class="form-control"/>
	            <span class="help-block"><?php echo form_error('amount')?></span>
	        </div>
	    </div>	
		<div class="col-md-6">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>
			        <input type="checkbox" name="depends_on_lwp"  id="depends_on_lwp" value="1" <?php echo ($depends_on_lwp =='1')?'checked':'' ?>/>            
			            <?php echo $this->lang->line('label_depands_on_leave');?>
			    </label>
			</div>
		</div>
		<div class="col-md-6">
		</div>
	</div>
	<div class="form-buttons-w">
        <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
        <button class="btn btn-danger" type="reset" name="reset"> <?php echo $this->lang->line('label_cancel');?></button>
    </div>
</form>
