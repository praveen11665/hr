<?php
$ci =&get_instance();
$serviceTypeDropdown    =  $ci->mcommon->Dropdown('def_hr_vehicle_log_service_type', array('vehicle_log_service_type_id as Key', 'service_type as Value'));
$frequencyDropdown   	=  $ci->mcommon->Dropdown('def_hr_vehicle_log_frquency', array('vehicle_log_frquency_id as Key', 'frequency as Value'));
$serviceDropdown   		=  $ci->mcommon->Dropdown('def_hr_vehicle_log_service_item', array('vehicle_log_service_item_id as Key', 'service_item as Value'));

 $vehicle_log_service_details_id    = "";
 $vehicle_service_id          		= "";
 $service_item    					= "";
 $service_type             			= "";
 $expense_amount         			= "";

if(!empty($tableData))
{    
    foreach ($ServiceData as $row)
    {
        $vehicle_log_service_details_id    =  $row->vehicle_log_service_details_id;
        $vehicle_service_id    			   =  $row->vehicle_service_id;
        $service_item          			   =  $row->service_item;
        $service_type          			   =  $row->service_type;        
        $expense_amount        			   =  $row->expense_amount;
    }
}
else
{
    $vehicle_log_service_details_id          =   $this->input->post('vehicle_log_service_details_id');
    $vehicle_log_id          				 =   $this->input->post('vehicle_log_id'); 
    $naming_series_id        				 =   $this->input->post('naming_series_id');
    $vehicle_id                    			 =   $this->input->post('vehicle_id');
    $employee_id             				 =   $this->input->post('employee_id');    
}
?>
<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxContentForm">
    <input type="hidden" name="vehicle_log_service_details_id" id="vehicle_log_service_details_id" value="<?php echo $vehicle_log_service_details_id;?>">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
	            <label><?php echo $this->lang->line('label_service_item');?></label>	           
	            <?php 
	                $attrib = 'class="form-control select2" id="vehicle_log_service_item_id"';
	                echo form_dropdown('vehicle_log_service_item_id', $serviceDropdown, set_value('vehicle_log_service_item_id', (isset($vehicle_log_service_item_id)) ? $vehicle_log_service_item_id : ''), $attrib);?>
                <?PHP if(form_error('vehicle_log_service_item_id')){ echo '<span class="help-block">'.form_error('vehicle_log_service_item_id').'</span>';} ?>
	        </div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label><?php echo $this->lang->line('label_type');?></label>
				<?php 
	                $attrib = 'class="form-control select2" id="vehicle_log_service_type_id"';
	                echo form_dropdown('vehicle_log_service_type_id', $serviceTypeDropdown, set_value('vehicle_log_service_type_id', (isset($vehicle_log_service_type_id)) ? $vehicle_log_service_type_id : ''), $attrib);?>
                <?PHP if(form_error('vehicle_log_service_type_id')){ echo '<span class="help-block">'.form_error('vehicle_log_service_type_id').'</span>';} ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
	            <label><?php echo $this->lang->line('label_frequency');?></label>	           
	            <?php 
	                $attrib = 'class="form-control select2" id="vehicle_log_frquency_id"';
	                echo form_dropdown('vehicle_log_frquency_id', $frequencyDropdown, set_value('vehicle_log_frquency_id', (isset($vehicle_log_frquency_id)) ? $vehicle_log_frquency_id : ''), $attrib);?>
                <?PHP if(form_error('vehicle_log_frquency_id')){ echo '<span class="help-block">'.form_error('vehicle_log_frquency_id').'</span>';} ?>
	        </div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label><?php echo $this->lang->line('label_expense');?></label>
				 <input type="text" name="expense_amount" id="expense_amount" value="<?php echo $expense_amount;?>" class="form-control" />			<span class="help-block"><?php echo form_error('expense_amount')?></span>
			</div>
		</div>
	</div>
	<div class="form-buttons-w">
		<button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
        <button class="btn btn-danger" type="reset" name="reset"> <?php echo $this->lang->line('label_cancel');?></button>	
	</div>	
</form>
