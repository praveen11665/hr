<?php
$ci =&get_instance();

$namingSeriesdrop                      =  $ci->mdrop->namingSeriesdrop('2');
$expenseClaimTypeDropdown              =  $ci->mcommon->Dropdown('hr_expense_claim_type', array('expense_claim_type_id as Key', 'expense_type as Value'), array('is_delete' => 0));
$expenseClaimStatusDropdown            =  $ci->mcommon->Dropdown('def_hr_expense_claim_status', array('expense_claim_status_id as Key', 'status as Value'));
$employeeDropdown                      =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_number as Value'), array('is_delete' => 0));
$projectDropdown                       =  $ci->mcommon->Dropdown('pro_project', array('project_id as Key', 'project_name as Value'), array('is_delete' => 0));
$UserDropdown                          =  $ci->mcommon->Dropdown('users', array('user_id as Key','username as Value'));
$approverstatusDropdown                =  $ci->mcommon->Dropdown('def_hr_expense_claim_approval_status', array('expense_claim_approval_status_id as Key','approval_status as Value'));
$taskDropdown                          =  $ci->mcommon->Dropdown('def_pro_task_status', array('task_status_id as Key','status as Value'));
$companyDropdown                       =  $ci->mcommon->Dropdown('set_company', array('company_id as Key','company_name as Value'), array('is_delete' => 0));
$payableDropdown                       =  $ci->mcommon->Dropdown('acc_account', array('account_id as Key','account_name as Value'), array('is_delete' => 0));
$cost_centerDropdown                   =  $ci->mcommon->Dropdown('acc_cost_center', array('cost_center_id as Key','cost_center_name as Value'), array('is_delete' => 0));

$expense_claim_id                           =   "";
$naming_series                              =   "";
$is_paid                                    =   "";
$expense_claim_approval_status_id           =   "";
$approval_status                            =   "";
$expense_date                               =   array();
$description                                =   array();
$total_claimed_amount                       =   "";
$total_sanctioned_amount                    =   "";
$posting_date                               =   "";
$employee_id                                =   "";
$employee_name                              =   "";
$project_id                                 =   "";
$task_id                                    =   "";
$remark                                     =   "";
$total_amount_reimbursed                    =   "";
$company_id                                 =   "";
$account_id                                 =   "";
$cost_center_id                             =   "";
$expense_claim_status_id                    =   "";
$expense_claim_detail_id                    =   array();
$expense_claim_type_id                      =   array();
$claim_amount                               =   array();

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $expense_claim_id                                       =   $row->expense_claim_id;
        $naming_series                                          =   $row->naming_series;
        $is_paid                                                =   $row->is_paid;
        $expense_claim_approval_status_id                       =   $row->expense_claim_approval_status_id;
        $approval_status                                        =   $row->approval_status;
        $user_id                                                =   $row->user_id;
        //$description                                            =   $row->description;
        $total_claimed_amount                                   =   $row->total_claimed_amount;
        $total_sanctioned_amount                                =   $row->total_sanctioned_amount;
        $posting_date                                           =   $row->posting_date;
        $employee_id                                            =   $row->employee_id;
        $employee_name                                          =   $row->employee_name;
        $project_id                                             =   $row->project_id;
        $task_id                                                =   $row->task_id;
        $remark                                                 =   $row->remark;
        $total_amount_reimbursed                                =   $row->total_amount_reimbursed;
        $company_id                                             =   $row->company_id;
        $account_id                                             =   $row->account_id;
        $cost_center_id                                         =   $row->cost_center_id;
        $expense_claim_status_id                                =   $row->expense_claim_status_id;
    }   

    $naming_seriesArr =   explode('/', $naming_series);
    foreach ($naming_seriesArr as $key => $value)
    {
        $set_options    =   $naming_seriesArr[0];
    }
    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '2'), 'naming_series_id');

    $naming_option      =   $source_id."_".$set_options;
}
else
{
    $expense_claim_id                               =   $this->input->post('expense_claim_id');
    $is_paid                                        =   $this->input->post('is_paid');
    $expense_claim_approval_status_id               =   $this->input->post('expense_claim_approval_status_id');
    $user_id                                        =   $this->input->post('user_id');
    $approval_status                                =   $this->input->post('approval_status');
    //$expense_date                                   =   $this->input->post('expense_date');
    //$description                                    =   $this->input->post('description');   
    $total_claimed_amount                           =   $this->input->post('total_claimed_amount');
    $total_sanctioned_amount                        =   $this->input->post('total_sanctioned_amount');
    $posting_date                                   =   $this->input->post('posting_date');
    //$expense_date                                   =   $this->input->post('expense_date');
    $employee_id                                    =   $this->input->post('employee_id');
    $employee_name                                  =   $this->input->post('employee_name');  
    $project_id                                     =   $this->input->post('project_id');
    $task_id                                        =   $this->input->post('task_id');
    $remark                                         =   $this->input->post('remark');
    $total_amount_reimbursed                        =   $this->input->post('total_amount_reimbursed');
    //$mode_of_payment_id                             =   $this->input->post('mode_of_payment_id');
    $company_id                                     =   $this->input->post('company_id');
    $payable_account                                =   $this->input->post('payable_account');
    $cost_center_id                                 =   $this->input->post('cost_center_id');
    $expense_claim_status_id                        =   $this->input->post('expense_claim_status_id');
}

if(!empty($tableData1))
{
    foreach ($tableData1 as $row )
    {
        $expense_claim_id                   =   $row->expense_claim_id;
        $expense_claim_detail_id[]          =   $row->expense_claim_detail_id;
        $expense_claim_type_id[]            =   $row->expense_claim_type_id;
        $expense_date[]                     =   date('d-m-Y', strtotime($row->expense_date));
        $description[]                      =   $row->description;
        $claim_amount[]                     =   $row->claim_amount;
        $sanctioned_amount[]                =   $row->sanctioned_amount;
        $trowEmp++;       
    }
}
else
{
    $expense_claim_detail_id      =   $this->input->post('expense_claim_detail_id');
    $expense_date                 =   $this->input->post('expense_date');
    $expense_claim_type_id        =   $this->input->post('expense_claim_type_id');
    $description                  =   $this->input->post('description');
    $claim_amount                 =   $this->input->post('claim_amount');
    $sanctioned_amount            =   $this->input->post('sanctioned_amount');
}
$trowEmp        = count($expense_claim_type_id) ? count($expense_claim_type_id):'1';
$checkDisable   = ($expense_claim_id == '') ? 'disabled' : '';
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button> 
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Expense_claim_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="expense_claim_id" id="expense_claim_id" value="<?php echo $expense_claim_id; ?>">
        <div class="row">
            <div class="col-md-4" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/2')">
                <div class="form-group">
                    <label for="naming_series_id"><?php echo $this->lang->line('label_series_name');?> </label> <span class="mandatory">*</span>
                    <a class="add-new-popup"><i class="popup"></i>+</a>
                    <!--<?php
                        $attrib = 'class="form-control select2" id="naming_series" ng-model="naming_series" required ';
                        echo form_dropdown('naming_series', $namingSeriesdrop, set_value('naming_series', (isset($naming_option)) ? $naming_option : ''), $attrib);
                        if(form_error('naming_series')){ echo '<span class="help-block">'.form_error('naming_series').'</span>';}
                    ?>-->
                    <select name="naming_series" ng-init="naming_series = '<?php echo $naming_option; ?>'" ng-model="naming_series" id="naming_series" class="form-control" required select2>
                          <option value="">-- Select --</option> 
                          <option ng-repeat="naming_series_id in dropSeriesValues" value="{{naming_series_id.naming_series_id}}">{{naming_series_id.naming_series}}</option> 
                     </select>
                    <span class="help-block" ng-show="showMsgs && myform.naming_series.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
            <div class="col-md-4" ng-init="loadDropdown('../../../Common_controller/loadDropdown/users','' , 'users' )">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_approved_by');?></label>
                    <span class="mandatory">*</span>
                    <a class="add-new-popup" >+</a>          
                   <!--<?php
                        $attrib = 'class="form-control select2" id="user_id" ng-model="user_id" required';
                        echo form_dropdown('user_id', $UserDropdown, set_value('user_id', (isset($user_id)) ? $user_id : ''), $attrib);?>
                        <?PHP if(form_error('user_id')){ echo '<span class="help-block">'.form_error('user_id').'</span>';}
                        ?>
                        <-->

                    <select name="user_id" ng-init="user_id = '<?php echo $user_id; ?>'" ng-model="user_id" id="user_id" class="form-control"  required select2>
                        <option value="">-- Select --</option> 
                        <option ng-repeat="user_id in users" value="{{user_id.user_id}}">{{user_id.username}}</option> 
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.user_id.$error.required"><?php echo $this->lang->line('required');?></span>
                    A user with "Expense Approver" role
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-group">
                        <label>                  
                            <input type="checkbox" name="is_paid"  id="is_paid" ng-init="is_paid = '<?php echo $is_paid; ?>'" <?php echo ($is_paid =='1')?'checked':'' ?>/>
                            <?php echo lang('label_is_paid');?>
                        </label>
                    </div>                      
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <!--<th> <input type="checkbox" > </th>-->
                            <th></th>
                            <th> <?php echo lang('label_expense_date');?> </th>
                            <th><?php echo lang('label_expense_claim_type');?>
                                <a class="add-new-popup" onclick="">+</a> </th>
                            <th> <?php echo lang('label_description');?> </th>
                            <th> <?php echo lang('label_claim_amount');?>  </th>
                            <th> <?php echo lang('label_sanctioned');?> </th>
                            <th> </th>
                        </tr>
                    </thead>

                    <tbody id="expense_claims" >
                    <?php
                    $is=1;
                    for($in=0; $in < $trowEmp; $in++)
                    {
                    ?>
                        <!--ng-repeat="row in rows"-->
                        <tr>
                            <td>
                                <input type="checkbox" class="exp_claim_cbx" id="exp_claim_cbx<?php echo $in;?>" data-name="exp_claim_cbx" data-row="<?php echo $in;?>" value="<?php echo $expense_claim_detail_id[$in];?>" onclick="checkDeleteButton('exp_claim_cbx', 'add_delete');" <?php echo $checkDisable;?>/>
                                <input type="hidden" name="expense_claim_detail_id[]" value="<?php echo $expense_claim_detail_id[$in];?>" data-name="expense_claim_detail_id" id="expense_claim_detail_id<?php echo $in;?>" data-row="<?php echo $in;?>">
                            </td>
                            <td>
                                <!--<input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="expense_date" is-open="popup1.opened"  ng-required="false" name="expense_date[]" ng-focus="open('popup1')" data-ng-init="init('<?php echo $expense_date[$in]?>', 'expense_date')"   name="expense_date[]" value="<?php echo $expense_date[$in];?>" data-name="expense_date" id="expense_date<?php echo $in;?>" data-row="<?php echo $in;?>"/>-->
                                <input type="text" class="form-control single-daterange" name="expense_date[]" id="expense_date<?php echo $in;?>" ng-init="expense_date = '<?php echo $expense_date[$in]; ?>'" value="<?php echo $expense_date[$in];?>" data-row="<?php echo $in;?>" data-name="expense_date"/>
                                <span class="help-block"><?php echo form_error("expense_date[$in]")?></span>
                            </td>
                            <td>
                                <?php
                                    $attrib = 'class="form-control" id="expense_claim_type_id'.$in.'" data-name="expense_claim_type_id" data-row="'.$in.'" data-row="'.$in.'"';
                                    echo form_dropdown('expense_claim_type_id[]', $expenseClaimTypeDropdown, set_value('expense_claim_type_id['.$in.']', (isset($expense_claim_type_id[$in])) ? $expense_claim_type_id[$in] : ''), $attrib);
                                    if(form_error('expense_claim_type_id['.$in.']')){ echo '<span class="help-block">'.form_error('expense_claim_type_id['.$in.']').'</span>';}
                                ?> 
                            </td>
                            <td>
                                <input type="text" class="form-control" name="description[]" id="description<?php echo $in;?>" ng-init="description = '<?php echo $description[$in]; ?>'" value="<?php echo $description[$in];?>" data-row="<?php echo $in;?>" data-name="description"/>
                                <span class="help-block"><?php echo form_error("description[$in]")?></span>

                            </td>
                            <td>
                                <input type="text" class="form-control claim_amount" name="claim_amount[]" data-name="claim_amount" id="claim_amount<?php echo $in;?>" data-row="<?php echo $in;?>" ng-init="claim_amount = '<?php echo $claim_amount[$in]; ?>'" value="<?php echo $claim_amount[$in]; ?>" onkeyup="calculateClaimAmount()" onkeydown="return allowNonZeroIntegers(event)" maxlength="10"/>
                                <span class="help-block"><?php echo form_error("claim_amount[$in]")?></span>

                            </td>
                            <td>
                                <input type="text" class="form-control sanctioned_amount"  data-name="sanctioned_amount" name="sanctioned_amount[]" id="sanctioned_amount<?php echo $in;?>" data-row="<?php echo $in;?>" ng-init="sanctioned_amount = '<?php echo $sanctioned_amount[$in]; ?>'" value="<?php echo $sanctioned_amount[$in]; ?>" onkeyup="calculateSanctionedAmount()" onkeydown="return allowNonZeroIntegers(event)" maxlength="10"/>
                                <span class="help-block"><?php echo form_error("sanctioned_amount")?></span>

                            </td>
                            <td>
                                <div class="col-md-2">
                                <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl;?>');" name=""><?php echo $this->lang->line('label_Details');?></button>
                                </div>
                            </td>
                        </tr>
                    <?php                     
                        $is++;
                        }
                    ?>
                    </tbody>
                    <tfoot>
                       <tr>
                            <td colspan="7">
                                <button class="btn btn-primary btn-sm" id ="e" data-name="e" type="button" onclick="addNewRow('expense_claims');" > <?php echo $this->lang->line('label_add_row');?> </button>
                                <!--<button class="btn btn-primary btn-sm"  type="button" name="add" ng-click="addnewrow()">+Add</button>-->
                                <input type="button" class="btn btn-danger btn-sm add_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('expense_claims', 'exp_claim_cbx', 'hr_expense_claim_detail', 'expense_claim_detail_id');" disabled>
                            </td>
                        </tr> 
                    </tfoot>
                </table>                           
            </div> 
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_total_claimed_amt');?></label>
                    <input type="text" name="total_claimed_amount" id="total_claimed_amount" ng-init="total_claimed_amount = '<?php echo $total_claimed_amount; ?>'" value="<?php echo $total_claimed_amount; ?>" class="form-control"  readonly/>
                    <span class="help-block"><?php echo form_error('total_claimed_amount')?></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_total_sanctioned_amt');?></label>
                    <input type="text" name="total_sanctioned_amount" id="total_sanctioned_amount" ng-init="total_sanctioned_amount = '<?php echo $total_sanctioned_amount; ?>'" value="<?php echo $total_sanctioned_amount; ?>" class="form-control"  readonly/>
                    <span class="help-block"><?php echo form_error('total_sanctioned_amount')?></span>
                </div>
            </div>
            <div class="col-md-6" id ="emp_approver_status" style="display:<?php echo ($expense_claim_id) ? 'block' : 'none'; ?>">
                <div class="col-md-4" ng-init="loadDropdown('../../../Common_controller/loadDropdown/def_hr_expense_claim_approval_status','' , 'appStatuses' )">
                <div class="form-group">
                    <div class="form-group">
                        <label for=""><?php echo $this->lang->line('label_approver_status');?></label>       
                        <!--<?php
                            $attrib = 'class="form-control select2" id="expense_claim_approval_status_id" onChange="showSelectContentremarks(this.value, \'rejection_remarks\')" ' ;
                            echo form_dropdown('expense_claim_approval_status_id', $approverstatusDropdown, set_value('expense_claim_approval_status_id', (isset($expense_claim_approval_status_id)) ? $expense_claim_approval_status_id : ''), $attrib);
                        ?>-->
                        <select name="expense_claim_approval_status_id" ng-init="expense_claim_approval_status_id = '<?php echo $expense_claim_approval_status_id; ?>'" ng-model="expense_claim_approval_status_id" id="expense_claim_approval_status_id" class="form-control" onChange="showSelectContentremarks(this.value, \'rejection_remarks\')" select2>
                            <option value="">-- Select --</option> 
                            <option ng-repeat="expense_claim_approval_status_id in appStatuses" value="{{expense_claim_approval_status_id.expense_claim_approval_status_id}}">{{expense_claim_approval_status_id.approval_status}}</option> 
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" id ="rejection_remarks" style="display: none;">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_rejection_remarks');?></label>
                    <textarea name="rejection_remarks" ng-init="rejection_remarks = '<?php echo $rejection_remarks; ?>'" class="form-control"></textarea>
                </div>  
            </div>
        </div>
        <hr>
        <fieldset>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_posting_date');?></label>
                        <span class="mandatory">*</span>
                        <input type="text" show-button-bar="false" class="form-control" uib-datepicker-popup="{{format}}" ng-model="posting_date" is-open="popup2.opened" datepicker-options="dateOptions" ng-required="true" data-ng-init="init('<?php echo $posting_date?>', 'posting_date')" value="{{posting_date | date:'dd-MM-yyyy' }}" name="posting_date"  ng-focus="open('popup2')"/>
                        <span class="help-block" ng-show="showMsgs && myform.posting_date.$error.required"><?php echo $this->lang->line('required');?></span>
                    </div>
                    <div class="form-group" ng-init="loadDropdown('../../../Common_controller/loadDropdown/hr_employee',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'employees' )">
                        <label for=""><?php echo $this->lang->line('label_from_employee');?></label>               
                        <span class="mandatory">*</span>
                        <!--<?php
                            $attrib = 'class="form-control select2" id="employee_id" onchange="loademployeename();" ng-model="employee_id" required';
                            echo form_dropdown('employee_id', $employeeDropdown, set_value('employee_id', (isset($employee_id)) ? $employee_id : ''), $attrib);
                            if(form_error('employee_id')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';}
                        ?>-->
                        <select name="employee_id" ng-init="employee_id = '<?php echo $employee_id; ?>'" ng-model="employee_id" id="employee_id" class="form-control" onchange="loademployeename();" required select2>
                              <option value="">-- Select --</option> 
                              <option ng-repeat="employee_id in employees" value="{{employee_id.employee_id}}">{{employee_id.employee_number}}</option> 
                        </select> 
                        <span class="help-block" ng-show="showMsgs && myform.employee_id.$error.required"><?php echo $this->lang->line('required');?></span>             
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_employee_name');?></label>
                        <input type="text" name="employee_name" id="employee_name" ng-init="employee_name = '<?php echo $employee_name; ?>'" value="<?php echo $employee_name; ?>" class="form-control"  readonly/>
                        <span class="help-block"><?php echo form_error('employee_name')?></span>
                    </div>
                    <div class="form-group" ng-init="loadDropdown('../../../Common_controller/loadDropdown/pro_project',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'projects' )">
                        <label for=""><?php echo $this->lang->line('label_project');?><span class="mandatory">*</span> <a class="add-new-popup" onclick="">+</a> </label>
                        <!--<?php
                            $attrib = 'class="form-control select2" id="project_id"';
                            echo form_dropdown('project_id', $projectDropdown, set_value('project_id', (isset($project_id)) ? $project_id : ''), $attrib);
                            if(form_error('project_id')){ echo '<span class="help-block">'.form_error('project_id').'</span>';}
                        ?>
                        <span class="help-block"><?php echo form_error('project_id')?></span>-->
                        <select name="project_id" ng-init="project_id = '<?php echo $project_id; ?>'" ng-model="project_id" id="project_id" class="form-control" required select2>
                              <option value="">-- Select --</option> 
                              <option ng-repeat="project_id in projects" value="{{project_id.project_id}}">{{project_id.project_name}}</option> 
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.project_id.$error.required"><?php echo $this->lang->line('required');?></span>

                    </div>
                    <div class="form-group" ng-init="loadDropdown('../../../Common_controller/loadDropdown/def_pro_task_status','' , 'taskStatuses' )">
                        <label><?php echo $this->lang->line('label_task');?></label><span class="mandatory">*</span>
                        <a class="add-new-popup" onclick="">+</a>               
                        <!--<?php
                            $attrib = 'class="form-control select2" id="task_id"';
                            echo form_dropdown('task_id', $taskDropdown, set_value('task_id', (isset($task_id)) ? $task_id : ''), $attrib);
                            if(form_error('task_id')){ echo '<span class="help-block">'.form_error('task_id').'</span>';}
                        ?>
                        <span class="help-block"><?php echo form_error('task_id')?></span>-->
                        <select name="task_id" ng-init="task_id = '<?php echo $task_id; ?>'" ng-model="task_id" id="task_id" class="form-control" required select2>
                              <option value="">-- Select --</option> 
                              <option ng-repeat="task_id in taskStatuses" value="{{task_id.task_status_id}}">{{task_id.status}}</option> 
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.task_id.$error.required"><?php echo $this->lang->line('required');?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_remark');?></label>
                        <textarea name="remark" rows="8" columns="65" class="form-control" ng-init="remark = '<?php echo $remark; ?>'"><?php echo $remark;?></textarea>
                        <span class="help-block"><?php echo form_error('remark')?></span>
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_total_amt_reimbursed');?></label>
                        <input type="text" name="total_amount_reimbursed" id="total_amount_reimbursed" ng-init="total_amount_reimbursed = '<?php echo $total_amount_reimbursed; ?>'" value="<?php echo $total_amount_reimbursed; ?>" class="form-control"/>
                        <span class="help-block"><?php echo form_error('total_amount_reimbursed')?></span>
                    </div>
                </div>
            </div>
        </fieldset>        
        <!--Accounting Details -->
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_accounting_details');?></span></legend>
            <div class="row">
                <div class="col-md-6" ng-init="loadDropdown('../../../Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'companies' )">
                    <div class="form-group">
                        <label for=""><?php echo $this->lang->line('label_company');?></label>               
                        <span class="mandatory">*</span>
                        <!--<?php
                            $attrib = 'class="form-control select2" id="company_id" ng-model="company_id" required';
                            echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);
                            if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';}
                        ?>-->
                        <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control"required select2>
                            <option value="">-- Select --</option> 
                            <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option> 
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>               
                    </div>
                </div>
                <div class="col-md-6" ng-init="loadDropdown('../../../Common_controller/loadDropdown/acc_account',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'accounts' )">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_payable_amount');?></label>
                        <span class="mandatory">*</span>
                        <a class="add-new-popup" onclick="">+</a>              
                        <!--<?php
                            $attrib = 'class="form-control select2" id="account_id" ng-model="account_id" required';
                            echo form_dropdown('account_id', $payableDropdown, set_value('account_id', (isset($account_id)) ? $account_id : ''), $attrib);
                            if(form_error('account_id')){ echo '<span class="help-block">'.form_error('account_id').'</span>';}
                        ?>-->
                        <select name="account_id" ng-init="account_id = '<?php echo $account_id; ?>'" ng-model="account_id" id="account_id" class="form-control"required select2>
                            <option value="">-- Select --</option> 
                            <option ng-repeat="account_id in accounts" value="{{account_id.account_id}}">{{account_id.account_name}}</option> 
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.account_id.$error.required"><?php echo $this->lang->line('required');?></span>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6"  ng-init="loadDropdown('../../../Common_controller/loadDropdown/acc_cost_center',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'cost_centers' )">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_cost_center');?></label>
                        <span class="mandatory">*</span>
                        <a class="add-new-popup" onclick="">+</a>                
                        <!--<?php
                            $attrib = 'class="form-control select2" id="cost_center_id" ng-model="cost_center_id" required';
                            echo form_dropdown('cost_center_id', $cost_centerDropdown, set_value('cost_center_id', (isset($cost_center_id)) ? $cost_center_id : ''), $attrib);
                            if(form_error('cost_center_id')){ echo '<span class="help-block">'.form_error('cost_center_id').'</span>';}
                        ?>-->
                        <select name="cost_center_id" ng-init="cost_center_id = '<?php echo $cost_center_id; ?>'" ng-model="cost_center_id" id="cost_center_id" class="form-control"required select2>
                            <option value="">-- Select --</option> 
                            <option ng-repeat="cost_center_id in cost_centers" value="{{cost_center_id.cost_center_id}}">{{cost_center_id.cost_center_name}}</option> 
                        </select>    
                        <span class="help-block" ng-show="showMsgs && myform.cost_center_id.$error.required"><?php echo $this->lang->line('required');?></span>
         
                    </div>
                </div>
            </div>
        </fieldset>
        <!--More Details -->
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_more_details');?></span></legend>
            <div class="row">
                <div class="col-md-6" ng-init="loadDropdown('../../../Common_controller/loadDropdown/def_hr_expense_claim_status','' , 'claimStatuses' )">
                    <div class="form-group">
                        <label for=""><?php echo $this->lang->line('label_status');?></label><span class="mandatory">*</span>                        
                        <select name="expense_claim_status_id" ng-init="expense_claim_status_id = '<?php echo $expense_claim_status_id; ?>'" ng-model="expense_claim_status_id" id="expense_claim_status_id" class="form-control"required select2>
                            <option value="">-- Select --</option> 
                            <option ng-repeat="expense_claim_status_id in claimStatuses" value="{{expense_claim_status_id.expense_claim_status_id}}">{{expense_claim_status_id.status}}</option> 
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.expense_claim_status_id.$error.required"><?php echo $this->lang->line('required');?></span>

                    </div>
                </div>
            </div>
        </fieldset>        
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('.single-daterange').daterangepicker({singleDatePicker: true,locale: {format: 'DD-MM-YYYY'}});
    });
</script>