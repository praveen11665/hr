<?php
$leave_application_id           =   "";
$naming_series_id               =   "";
$leave_application_status_id    =   "";
$leave_type_id                  =   "";
$leave_balance                  =   "";
$from_date                      =   "";
$to_date                        =   "";
$reason                         =   "";
$half_day                       =   "";
$half_day_date                  =   "";
$total_leave_days               =   "";
$employee_id                    =   "";
$employee_name                  =   "";
$user_id                        =   "";
$leave_approver_name            =   "";
$posting_date                   =   "";
$follow_via_email               =   "";
$company_id                     =   "";
$letter_head_id                 =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $leave_application_id           =   $row->leave_application_id;
        $naming_series_id               =   $row->naming_series_id;
        $leave_application_status_id    =   $row->leave_application_status_id;
        $leave_type_id                  =   $row->leave_type_id;
        $leave_balance                  =   $row->leave_balance;
        $from_date                      =   date('d-M-Y',strtotime($row->from_date));
        $to_date                        =   date('d-M-Y',strtotime($row->to_date));
        $reason                         =   $row->reason;
        $half_day                       =   $row->half_day;
        $half_day_date                  =   date('d-M-Y',strtotime($row->half_day_date));
        $total_leave_days               =   $row->total_leave_days;
        $employee_id                    =   $row->employee_id;
        $employee_name                  =   $row->employee_name; 
        $user_id                        =   $row->user_id;
        $leave_approver_name            =   $row->leave_approver_name;
        $posting_date                   =   date('d-M-Y',strtotime($row->posting_date));
        $follow_via_email               =   $row->follow_via_email;
        $company_id                     =   $row->company_id;
        $letter_head_id                 =   $row->letter_head_id; 
    }

    foreach($tableDataRejection as $row)
    {
        $rejection_remarks              =   $row->rejection_remarks;
    }
}
         
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Holidays_list_leaves_and_holiday');?></h4>
</div>

<div class="modal-body" id="modal-body">  
    <h6 class="element-header">
        <?php echo ucfirst($employee_name);?>
        <label class="pull-right"><?php echo get_leave_status($leave_application_status_id);?></label>
    </h6>
    <ul class="task-dates list-inline m-b-0">

        <?php if(!empty($posting_date))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_posting_date');?></h5>
                <p><?php echo $posting_date; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($leave_type_id))
            {
                $leaveType = $this->mcommon->specific_row_value('hr_leave_type', array('leave_type_id' => $leave_type_id), 'leave_type_name');

            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_leave_type');?></h5>
                <p><?php echo $leaveType;?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($from_date))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_from_date');?></h5>
                <p><?php echo $from_date; ?></p>
            </li>
            <?php
            }
        ?>                     

        <?php if(!empty($to_date))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_to_date');?></h5>
                <p><?php echo $to_date; ?></p>
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

        <?php if(!empty($half_day))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_half_day');?></h5>
                <p><?php echo ($half_day == 1) ? 'YES' : 'No'; ?></p>
            </li>
            <?php
            }
        ?>

        <?php
            if($half_day == '1')
            {
                if(!empty($half_day_date))
                {
                    ?>
                    <li>
                        <h5 class="m-b-5"><?php echo $this->lang->line('label_half_day_date');?></h5>
                        <p><?php echo $half_day_date; ?></p>
                    </li>
                    <?php
                }
            }
        ?>

        <?php if(!empty($total_leave_days))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_total_leave');?></h5>
                <p><?php echo $total_leave_days; ?></p>
            </li>
            <?php
            }
        ?>

        <?php if(!empty($leave_approver_name))
            {
            ?>
            <li>
                <h5 class="m-b-5"><?php echo $this->lang->line('label_leave_approver_name');?></h5>
                <p><?php echo $leave_approver_name; ?></p>
            </li>
            <?php
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