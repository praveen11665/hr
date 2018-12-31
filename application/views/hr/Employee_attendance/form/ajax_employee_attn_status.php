<fieldset id="markpresent">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label><?php echo lang('label_markpresent');?></label> <hr />
				<?php
				foreach ($presentList as $row) 
				{
					?>
					<label class="form-check-label col-md-3">

				        <input type="checkbox" name="employee_id[<?php echo $row->employee_id;?>]" value="1" class="checkbox employee_id" data-id="<?php echo $row->employee_id;?>" checked > <?php echo ucwords(str_replace('_', ' ', $row->employee_name)) .' '.'['.$row->employee_number.']';?>       
				    </label>
				    <?php
				}
				?>
			</div>
		</div>
	</div>
</fieldset>

<fieldset id="markabsent">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label><?php echo lang('label_markabsent');?></label> <hr />
				<?php
				foreach ($absentList as $row) 
				{
					?>
					<label class="form-check-label col-md-3">

				        <input type="checkbox" name="employee_id[<?php echo $row->employee_id;?>]" value="2" class="checkbox employee_id" data-id="<?php echo $row->employee_id;?>" checked > <?php echo ucwords(str_replace('_', ' ', $row->employee_name)) .' '.'['.$row->employee_number.']';?>       
				    </label>
				    <?php
				}
				?>
			</div>
		</div>
	</div>
</fieldset>

<fieldset id="markhalfday">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label><?php echo lang('label_markhalfday');?></label> <hr />
				<?php
				foreach ($halfDayList as $row) 
				{
					?>
					<label class="form-check-label col-md-3">

				        <input type="checkbox" name="employee_id[<?php echo $row->employee_id;?>]" value="3" class="checkbox employee_id" data-id="<?php echo $row->employee_id;?>" checked > <?php echo ucwords(str_replace('_', ' ', $row->employee_name)) .' '.'['.$row->employee_number.']';?>       
				    </label>
				    <?php
				}
				?>
			</div>
		</div>
	</div>
</fieldset>

<fieldset id="markleave">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label><?php echo lang('label_markonleave');?></label> <hr />
				<?php
				foreach ($leaveList as $row) 
				{
					?>
					<label class="form-check-label col-md-3">

				        <input type="checkbox" name="employee_id[<?php echo $row->employee_id;?>]" value="4" class="checkbox employee_id" data-id="<?php echo $row->employee_id;?>" checked > <?php echo ucwords(str_replace('_', ' ', $row->employee_name)) .' '.'['.$row->employee_number.']';?>       
				    </label>
				    <?php
				}
				?>
			</div>
		</div>
	</div>
</fieldset>

<?php
	if(!empty($presentList) || !empty($absentList) || !empty($halfDayList) || !empty($leaveList))
	{
		?>
			<input type="hidden" name="checkEmployee" id="checkEmployee" value="1">
		<?php
	}
?>