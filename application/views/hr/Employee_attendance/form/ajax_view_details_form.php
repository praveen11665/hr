<?php
foreach ($tableData as $row) 
{    	
	$employee_attendance_tool_id    = $row->employee_attendance_tool_id;
	$date    						= date('d-m-Y',strtotime($row->date));
	$department_name    			= $row->department_name;
	$branch    					    = $row->branch;
	$company_name    				= $row->company_name;
}

?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('employee_attendance_details');?></h4>
</div>
<div class="modal-body" id="modal-body">
	<div class="row">
		<div class="col-md-12">

			<?php
				if(!empty($presentList))
				{
					?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo lang('label_date');?></th>
								<th><?php echo lang('label_employee_name');?></th>
								<th><?php echo lang('label_employee_code');?></th>
								<th><?php echo lang('label_department');?></th>
								<th><?php echo lang('label_branch');?></th>
								<th><?php echo lang('label_company');?></th>
							</tr>
						</thead>
						<tbody>
							<h5><?php echo lang('label_markpresent');?></h5>
							<?php
							foreach ($presentList as $row) 
							{
								?>
								<tr>
									<td><?php echo date('d-M-Y', strtotime($date));?></td>
									<td><?php echo $row->employee_name;?></td>
									<td><?php echo $row->employee_number;?></td>
									<td><?php echo $row->department_name;?></td>
									<td><?php echo $row->branch;?></td>
									<td><?php echo $row->company_name;?></td>
								</tr>
								<?php
							}
							?>				
						</tbody>
					</table>
					<hr>
					<?php
				}
			?>

			<?php
				if(!empty($absentList))
				{
					?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo lang('label_date');?></th>
								<th><?php echo lang('label_employee_name');?></th>
								<th><?php echo lang('label_employee_code');?></th>
								<th><?php echo lang('label_department');?></th>
								<th><?php echo lang('label_branch');?></th>
								<th><?php echo lang('label_company');?></th>
							</tr>
						</thead>		
						<tbody>
							<h5><?php echo lang('label_markabsent');?></h5>
							<?php
							foreach ($absentList as $row) 
							{
								?>
								<tr>
									<td><?php echo date('d-M-Y', strtotime($date));?></td>
									<td><?php echo $row->employee_name;?></td>
									<td><?php echo $row->employee_number;?></td>
									<td><?php echo $row->department_name;?></td>
									<td><?php echo $row->branch;?></td>
									<td><?php echo $row->company_name;?></td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
					<hr>
					<?php
				}
			?>

			<?php
				if(!empty($halfDayList))
				{
					?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo lang('label_date');?></th>
								<th><?php echo lang('label_employee_name');?></th>
								<th><?php echo lang('label_employee_code');?></th>
								<th><?php echo lang('label_department');?></th>
								<th><?php echo lang('label_branch');?></th>
								<th><?php echo lang('label_company');?></th>
							</tr>
						</thead>		
						<tbody>
							<h5><?php echo lang('label_markonleave');?></h5>
							<?php
							foreach ($halfDayList as $row) 
							{
								?>
								<tr>
									<td><?php echo date('d-M-Y', strtotime($date));?></td>
									<td><?php echo $row->employee_name;?></td>
									<td><?php echo $row->employee_number;?></td>
									<td><?php echo $row->department_name;?></td>
									<td><?php echo $row->branch;?></td>
									<td><?php echo $row->company_name;?></td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
					<hr>
					<?php
				}
			?>

			<?php
				if(!empty($leaveList))
				{
					?>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th><?php echo lang('label_date');?></th>
									<th><?php echo lang('label_employee_name');?></th>
									<th><?php echo lang('label_employee_code');?></th>
									<th><?php echo lang('label_department');?></th>
									<th><?php echo lang('label_branch');?></th>
									<th><?php echo lang('label_company');?></th>
								</tr>
							</thead>		
							<tbody>
								<h5><?php echo lang('label_markhalfday');?></h5>
								<?php
								foreach ($leaveList as $row) 
								{
									?>
									<tr>
										<td><?php echo date('d-M-Y', strtotime($date));?></td>
										<td><?php echo $row->employee_name;?></td>
										<td><?php echo $row->employee_number;?></td>
										<td><?php echo $row->department_name;?></td>
										<td><?php echo $row->branch;?></td>
										<td><?php echo $row->company_name;?></td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					<?php
				}
			?>
		</div>
	</div>
</div>