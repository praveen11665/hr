<?php
$earning_id							=	array();
$salary_component_id 				=	array();
$statistical_component 				=	array();
$formula                      		=   array();
$amount                       		=   array();
$abbr                         		=   array();
$deduction_id                   	=   array();
$salary_structure_id              	=   array();
$salary_component_id_deduction   	=   array();
$statistical_component_deduction 	=   array();
$formula_deduction               	=   array();
$amount_deduction                	=   array();
$abbr_deduction                  	=   array();
$total_holidays          			=   '';

foreach ($employeeData as $row )
{
    $employee_id                    =   $row->employee_id;
    $naming_series                  =   $row->naming_series;
    $salutation_id                  =   $row->salutation_id;
    $company_id                     =   $row->company_id;
    $employee_number                =   $row->employee_number;
    $date_of_joining                =   date('d-m-Y', strtotime($row->date_of_joining));
    $date_of_birth                  =   date('d-m-Y', strtotime($row->date_of_birth));
    $employee_name                  =   $row->employee_name;        
    $gender_id                      =   $row->gender_id;        
}

foreach ($StructureData as $row)
{
    $name                           =  $row->name;
    $salary_structure_id            =  $row->salary_structure_id;
    $company_id                     =  $row->company_id;
    $salary_structure_is_active_id  =  $row->salary_structure_is_active_id;
    $letter_head_id                 =  $row->letter_head_id;
    $payroll_frequency_id           =  $row->payroll_frequency_id;        
    $salary_slip_based_on_timesheet =  $row->salary_slip_based_on_timesheet;
    $hour_rate                      =  $row->hour_rate;        
} 

foreach ($LetterHeadData as $row )
{
    $letter_head_id      =   $row->letter_head_id;
    $letter_head_name    =   $row->letter_head_name;
    $is_disabled         =   $row->is_disabled;
    $is_default          =   $row->is_default;
    $letter_head_content =   $row->letter_head_content;
    $letter_head_footer  =   $row->letter_head_footer;       
}

foreach ($tableData as $row )
{
    $salary_slip_id          =  $row->salary_slip_id;
    $posting_date            =  date('d-M-Y', strtotime($row->posting_date));
    $employee_id             =  $row->employee_id;
    $employee_name           =  $row->employee_name;
    $letter_head             =  $row->letter_head;
    $start_date              =  date('d-M-Y', strtotime($row->start_date));
    $end_date                =  date('d-M-Y', strtotime($row->end_date));
    $payroll_frequency_id    =  $row->payroll_frequency;
    $salary_structure_id     =  $row->salary_structure_id;
    $total_working_days      =  $row->total_working_days;
    $leave_without_pay       =  $row->leave_without_pay;
    $payment_days            =  $row->payment_days;
    $company               	 =  $row->company;
    $component               =  $row->component;
    //$abbr                    =  $row->abbr;
    //$statistical_component   =  $row->statistical_component;
    //$formula                 =  $row->formula; 
    //$amount                  =  $row->amount;
    $gross_pay               =  $row->gross_pay;
    $total_deduction         =  $row->total_deduction;
    $net_pay                 =  $row->net_pay;
    $rounded_total           =  $row->rounded_total;  
    $salary_slip_status_id   =  $row->salary_slip_status_id;
    $total_holidays          =  $row->total_holidays;

	$allowed_leaves			 =  $row->allowed_leaves;
	$lop 					 =  $row->lop;
	$lop_amount 			 =  $row->lop_amount;
}

foreach($EarningData as $row)
{
    $earning_id[]                   =  $row->earning_id;
    $salary_structure_id            =  $row->salary_structure_id;
    $salary_component_id[]          =  $row->salary_component_id;
    $statistical_component[]        =  $row->statistical_component; 
    $formula[]                      =  $row->formula; 
    $amount[]                       =  $row->amount; 
    $abbr[]                         =  $row->abbr;
    $trowEar++;
}

foreach($DeductionData as $row)
{
    $deduction_id[]                    =  $row->deduction_id;
    $salary_structure_id               =  $row->salary_structure_id;
    $salary_component_id_deduction[]   =  $row->salary_component_id;
    $statistical_component_deduction[] =  $row->statistical_component; 
    $formula_deduction[]               =  $row->formula; 
    $amount_deduction[]                =  $row->amount; 
    $abbr_deduction[]                  =  $row->abbr;
    $trowDed++;
}
$trowEar           = ($trowEar) ? $trowEar:'1';
$trowDed           = ($trowDed) ? $trowDed:'1';
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Salary_slip_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">	
	<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm">
		<h6 class="element-header">
	        <?php echo ucfirst($employee_name);?>
	        <label class="pull-right"><?php echo get_salary_silp_status($salary_slip_status_id);?></label>
	    </h6> 
		<!--<div class="row">			
			<div class="col-md-8">
		    	<h5><?php echo $letter_head_name; ?></h5>
		    </div>
		    <div class="col-md-4">
		    	<h5><?php echo $letter_head_content; ?></h5>
		    	<br>
		    	<?php echo $employee_name; ?>/<?php echo $employee_number; ?>
		    </div>
	    </div>
	    <hr>-->

	    <ul class="task-dates list-inline m-b-0"> 

	        <?php if(!empty($posting_date))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5"><?php echo $this->lang->line('label_posting_date');?></h5>
	                <p><?php echo $posting_date;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($company))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5"><?php echo $this->lang->line('label_company');?></h5>
	                <p><?php echo $company;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($employee_number))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5"><?php echo $this->lang->line('label_employee_code');?></h5>
	                <p><?php echo $employee_number;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($employee_name))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5"><?php echo $this->lang->line('label_employee_name');?></h5>
	                <p><?php echo $employee_name;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($name))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5"><?php echo $this->lang->line('label_is_salary_structure');?></h5>
	                <p><?php echo $name;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($start_date))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5"><?php echo $this->lang->line('label_start_date');?></h5>
	                <p><?php echo $start_date;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($end_date))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5"><?php echo $this->lang->line('label_end_date');?></h5>
	                <p><?php echo $end_date;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($total_working_days > 0))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5"><?php echo $this->lang->line('label_working_days');?></h5>
	                <p><?php echo $total_working_days;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($payment_days > 0))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5"><?php echo $this->lang->line('label_payment_days');?></h5>
	                <p><?php echo $payment_days;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($leave_without_pay > 0))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5">Total Leave</h5>
	                <p><?php echo $leave_without_pay;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($total_holidays > 0))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5">Total Holidays</h5>
	                <p><?php echo $total_holidays;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($allowed_leaves > 0))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5">Allowed Leaves</h5>
	                <p><?php echo $allowed_leaves;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($lop > 0))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5">LOP</h5>
	                <p><?php echo $lop;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($lop_amount > 0))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5">LOP Amount</h5>
	                <p><?php echo $lop_amount;?></p>
	            </li>
	            <?php
	            }
	        ?>	        
	    </ul>

		<div class="clearfix"></div> 
	    <hr>
	    <div class="row">
		    <div class="col-md-6">
			    <label><strong><?php echo $this->lang->line('label_earning');?></strong></label>
				    <table class="table table-bordered">
					    <thead>
					    <tr>
					    	<th><?php echo lang('label_component');?></th>
							<th><?php echo lang('label_amount');?></th>
						</tr>
						</thead>
						 <?php 
		                        $is=1;
		                        for($in=0; $in < $trowEar; $in++)
		                        {
		                        ?>
									<tbody>
										<tr>
											<td><?php echo $abbr[$in] ;?></td>
											<td><?php echo round($amount[$in],2);?></td>
										</tr>
									</tbody>
								<?php
								}
								?>	
					</table>
		    </div>
		    <div class="col-md-6">
			    <label><strong><?php echo $this->lang->line('label_deduction');?></strong></label>
				    <table class="table table-bordered">
					    <thead>
					    <tr>
					    	<th><?php echo lang('label_component');?></th>
							<th><?php echo lang('label_amount');?></th>
						</tr>
						</thead>
						 <?php 
		                        $is=1;
		                        for($in=0; $in < $trowDed; $in++)
		                        {		                        	
		                        ?>
									<tbody>
										<tr>
											<td><?php echo $abbr_deduction[$in] ;?></td>
											<td><?php echo round($amount_deduction[$in],2) ;?></td>
										</tr>
									</tbody>
								<?php
								}
								?>	
					</table>
		    </div>
	    </div>
	    <hr>
	    <ul class="task-dates list-inline m-b-0"> 

	        <?php if(!empty($gross_pay))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5"><?php echo $this->lang->line('label_gross_pay');?></h5>
	                <p><?php echo $gross_pay;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($total_deduction))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5"><?php echo $this->lang->line('label_total_deduction');?></h5>
	                <p><?php echo $total_deduction;?></p>
	            </li>
	            <?php
	            }
	        ?>

	        <?php if(!empty($net_pay))
	            {
	            ?>
	            <li>
	                <h5 class="m-b-5"><?php echo $this->lang->line('label_net_pay');?></h5>
	                <p><?php echo $net_pay;?></p>
	            </li>
	            <?php
	            }
	        ?>
    	</ul>
    	<div class="clearfix"></div> 
		
		<!--<div class="modal-footer">
			<span style="display: block;" id = "Active">
				<input class="btn btn-success" type="submit" value="<?php echo $this->lang->line('label_print');?>" onclick="PrintMeSubmitMe()"><br />
			</span>
        </div>-->
	</form>
</div>