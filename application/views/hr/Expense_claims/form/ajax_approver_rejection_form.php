<?php
$is_paid                                    =   "";
$approval_status                            =   "";
$expense_date                               =   "";
$total_claimed_amount                       =   "";
$total_sanctioned_amount                    =   "";
$posting_date                               =   "";
$expense_date                               =   "";
$employee_id                                =   "";
$employee_name                              =   "";
$remark                                     =   "";
$total_amount_reimbursed                    =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $expense_claim_id                   =   $row->expense_claim_id;
        $is_paid                            =   $row->is_paid;
        $total_claimed_amount               =   $row->total_claimed_amount;
        $total_sanctioned_amount            =   $row->total_sanctioned_amount;
        $posting_date                       =   date('d-m-Y',strtotime($row->posting_date));
        $expense_date                       =   date('d-m-Y',strtotime($row->expense_date));
        $employee_id                        =   $row->employee_id;
        $employee_name                      =   $row->employee_name;
        $remark                             =   $row->remark;
        $total_amount_reimbursed            =   $row->total_amount_reimbursed;
        $expense_claim_approval_status_id   =   $row->expense_claim_approval_status_id;
        $rejection_remarks                  =   $row->rejection_remarks;    
        $naming_series                      =   $row->naming_series;    
        $project_id                         =   $row->project_id;    
        $task_id                            =   $row->task_id;    
    }
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Expense_claim_form_title');?></h4>
</div>

<div class="modal-body" id="modal-body">  
    <h6 class="element-header">
        <?php echo ucfirst($employee_name);?>
        <label class="pull-right"><?php echo get_approver_status($expense_claim_approval_status_id);?></label>
    </h6>
    <ul class="task-dates list-inline m-b-0">
        <?php if(!empty($is_paid))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_is_paid');?></h5>
                <p><?php echo ($is_paid == '1') ? 'YES' : 'NO';?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($posting_date))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_posting_date');?></h5>
                <p><?php echo date('d-M-Y', strtotime($posting_date)); ?></p>
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

        <?php if(!empty($naming_series))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_naming_series');?></h5>
                <p><?php echo $naming_series; ?></p>
            </li>
            <?php
            }
        ?>                     

        <?php if(!empty($total_claimed_amount))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_total_claimed_amt');?></h5>
                <p><?php echo $total_claimed_amount; ?></p>
            </li>
            <?php
            }
        ?>        

        <?php if(!empty($total_sanctioned_amount))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_total_sanctioned_amt');?></h5>
                <p><?php echo $total_sanctioned_amount; ?></p>
            </li>
            <?php
            }
        ?>         

        <?php if(!empty($total_amount_reimbursed))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_total_amt_reimbursed');?></h5>
                <p><?php echo $total_amount_reimbursed; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($total_amount_reimbursed))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_total_amt_reimbursed');?></h5>
                <p><?php echo $total_amount_reimbursed; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($total_amount_reimbursed))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_total_amt_reimbursed');?></h5>
                <p><?php echo $total_amount_reimbursed; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($project_id))
            {
                $projectName = $this->mcommon->specific_row_value('pro_project', array('project_id' => $project_id), 'project_name');
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_project');?></h5>
                <p><?php echo $projectName; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($task_id))
            {
                $taskName = $this->mcommon->specific_row_value('def_pro_task_status', array('task_status_id' => $task_id), 'status');
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_task');?></h5>
                <p><?php echo $taskName; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($remark))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_remark');?></h5>
                <p><?php echo $remark; ?></p>
            </li>
            <?php
            }
        ?>

        <!--<?php if(!empty($expense_claim_approval_status_id))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_approver_status');?></h5>
                <p><?php echo get_approver_status($expense_claim_approval_status_id);?></p>
            </li>
            <?php
            }
        ?>-->
    </ul>
    <div class="clearfix"></div>
</div>