<?php
$employee_loan_application_id   =   "";
$posting_date                   =   "";
$employee_id                    =   "";
$employee_name                  =   "";
$emp_loan_appliction_status_id  =   "";
$company_id                     =   "";
$loan_type_id                   =   "";
$loan_amount                    =   ""; 
$required_by_date               =   "";
$reason                         =   "";
$emp_loan_repayment_method_id   =   "";
$rate_of_interest               =   "";
$total_payable_interest         =   "";
$repayment_amount               =   "";
$repayment_periods              =   "";
$total_payable_amount           =   "";
$rejection_remarks              =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $employee_loan_application_id   =   $row->employee_loan_application_id;
        $posting_date                   =   date('d-m-Y',strtotime($row->posting_date));
        $employee_id                    =   $row->employee_id;
        $employee_name                  =   $row->employee_name;
        $emp_loan_appliction_status_id  =   $row->emp_loan_appliction_status_id;
        $company_name                   =   $row->company_name;
        $loan_name                      =   $row->loan_name;
        $loan_amount                    =   $row->loan_amount;
        $required_by_date               =   date('d-m-Y',strtotime($row->required_by_date));
        $reason                         =   $row->reason;
        $repayment_method               =   $row->repayment_method;
        $rate_of_interest               =   $row->rate_of_interest;
        $total_payable_interest         =   $row->total_payable_interest;
        $repayment_amount               =   $row->repayment_amount;
        $repayment_periods              =   $row->repayment_periods;
        $total_payable_amount           =   $row->total_payable_amount;
    }
}
      
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Loan_application_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <h6 class="element-header">
        <?php echo ucfirst($employee_name);?>
        <label class="pull-right"><?php echo get_loan_status($emp_loan_appliction_status_id);?></label>
    </h6>

    <ul class="task-dates list-inline m-b-0">

        <?php if(!empty($posting_date))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_posting_date');?></h5>
                <p><?php echo date('d-M-Y', strtotime($posting_date));?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($employee_name))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_employee_name');?></h5>
                <p><?php echo $employee_name; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($company_name))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_company');?></h5>
                <p><?php echo $company_name; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($loan_name))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_loan_type');?></h5>
                <p><?php echo $loan_name; ?></p>
            </li>
            <?php
            }
        ?>                     

        <?php if(!empty($loan_amount))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_loan_amount');?></h5>
                <p><?php echo $loan_amount; ?></p>
            </li>
            <?php
            }
        ?>        

        <?php if(!empty($required_by_date))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_required_by_date');?></h5>
                <p><?php echo $required_by_date; ?></p>
            </li>
            <?php
            }
        ?>         

        <?php if(!empty($repayment_method))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_repayment_method');?></h5>
                <p><?php echo $repayment_method; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($repayment_amount))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_Monthly_repayment_amount');?></h5>
                <p><?php echo $repayment_amount; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($repayment_periods))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_Repayment_period_in_months');?></h5>
                <p><?php echo $repayment_periods; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($rate_of_interest))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_rate_of_interest');?></h5>
                <p><?php echo $rate_of_interest; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($total_payable_interest))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_total_payable_interest');?></h5>
                <p><?php echo $total_payable_interest; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($total_payable_amount))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_total_payable_amount');?></h5>
                <p><?php echo $total_payable_amount; ?></p>
            </li>
            <?php
            }
        ?>        

        <?php if(!empty($reason))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_reason');?></h5>
                <p><?php echo $reason; ?></p>
            </li>
            <?php
            }
        ?>   

        <?php
        if($emp_loan_appliction_status_id == 3)
         {
            foreach($tableDataRejection as $row)
            {
                $rejection_remarks              =   $row->rejection_remarks;
            }
         }
         else
         {
            $rejection_remarks =  "-";
         }  
        ?> 

        <?php if(!empty($rejection_remarks))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_rejection_remarks');?></h5>
                <p><?php echo $rejection_remarks; ?></p>
            </li>
            <?php
            }
        ?> 
    </ul>
    
    <div class="clearfix"></div>
</div>