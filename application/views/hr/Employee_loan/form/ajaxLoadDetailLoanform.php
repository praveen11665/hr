<?php
$employee_loan_id               = "";
$employee_id                    = "";
$employee_name                  = "";
$employee_loan_application_id   = "";
$loan_type_id                   = "";
$posting_date                   = "";
$emp_loan_status_id             = "";
$company_id                     = "";
$repay_from_salary              = "";
$loan_amount                    = "";
$disbursement_date              = "";
$rate_of_interest               = "";
$emp_loan_repayment_method_id   = "";
$mode_of_payment_type_id        = "";
$payment_account                = "";
$employee_loan_account          = "";
$interest_income_account        = "";
$total_payable_amount           = "";
$total_payable_interest         = "";


$payment_date                   = "";
$interest_amount                = "";
$total_amount                   = "";
$balance_loan_amount            = "";


if(!empty($tableData))
{
    foreach($tableData as $row)
    {
        $employee_loan_id                   = $row->employee_loan_id;
        $employee_id                        = $row->employee_id;
        $employee_name                      = $row->employee_name;
        $employee_loan_application_id       = $row->employee_loan_application_id;
        $loan_name                       	= $row->loan_name;
        $posting_date                       = date('d-m-Y',strtotime($row->posting_date));
        $emp_loan_status_id                 = $row->emp_loan_status_id;
        $company_name                       = $row->company_name;
        $repay_from_salary                  = $row->repay_from_salary;
        $loan_amount                        = $row->loan_amount;
        $disbursement_date                  = date('d-m-Y',strtotime($row->disbursement_date));
        $rate_of_interest                   = $row->rate_of_interest;
        $repayment_method       			= $row->repayment_method;
        $mode_of_payment_type_id            = $row->mode_of_payment_type_id;
        $payment_account                    = $row->payment_account;
        $employee_loan_account              = $row->employee_loan_account;
        $total_payable_amount               = $row->total_payable_amount;
        $repayment_amount                   = $row->repayment_amount;
        $repayment_periods                  = $row->repayment_periods;
        $total_payable_interest             = $row->total_payable_interest;
        $interest_income_account            = $row->interest_income_account;
    }

    foreach($tableDataRepayment as $row)
    {
        $payment_date           = $row->payment_date;
        $principal_amount       = $row->principal_amount;
        $interest_amount        = $row->interest_amount;
        $total_amount           = $row->total_amount;
        $balance_loan_amount    = $row->balance_loan_amount;
    }
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Loan_accounts_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <h6 class="element-header">
        <?php echo ucfirst($employee_name);?>
        <label class="pull-right"><?php echo get_loan_approve_status($emp_loan_status_id);?></label>
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

        <?php if(!empty($repay_from_salary))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_repay_from_salary');?></h5>
                <p><?php echo ($repay_from_salary == 1) ? 'YES' : 'NO'; ?></p>
            </li>
            <?php
            }
        ?>         

        <?php if(!empty($payment_date))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_payment_date');?></h5>
                <p><?php echo date('d-M-Y', strtotime($payment_date));?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($principal_amount))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_principal_amount');?></h5>
                <p><?php echo $principal_amount; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($interest_amount))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_interest_amount');?></h5>
                <p><?php echo $interest_amount; ?></p>
            </li>
            <?php
            }
        ?>                        

        <?php if(!empty($total_amount))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_total_amount');?></h5>
                <p><?php echo $total_amount; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($balance_loan_amount))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_balance_loan_amount');?></h5>
                <p><?php echo $balance_loan_amount; ?></p>
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
    </ul>
    <div class="clearfix"></div>   
</div>