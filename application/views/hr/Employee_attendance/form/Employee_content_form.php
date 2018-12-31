<?php
foreach ($employeeData as $row) 
{
	?>
		<label class="form-check-label col-md-3">
	    	<input type="checkbox" id="employee_id_<?php echo $row->employee_id;?>" value="<?php echo $row->employee_id;?>" class="checkbox employeeList"> <?php echo ucwords(str_replace('_', ' ', $row->employee_name));?>
	    </label>
	<?php
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<input type="hidden" id="employeeList_1" name="marked_present"  value="" class="hidden">
			<input type="hidden" id="employeeList_2" name="marked_absent"   value="" class="hidden">
			<input type="hidden" id="employeeList_3" name="marked_half_day" value="" class="hidden">
			<input type="hidden" id="employeeList_4" name="mark_leave"      value="" class="hidden">
		</div>
	</div>
</div>