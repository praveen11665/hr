<?php
$ci =&get_instance();
$companyDropdown  =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'), array('is_delete' => 0));
$userDropdown     =  $ci->mcommon->Dropdown('users', array('user_id as Key', 'username as Value'));

$leave_block_list_id            =   "";
$leave_block_list_name          =   "";
$company_id                     =   "";
$applies_to_all_departments     =   "";
$reason                         =   array();
$user_id                        =   array();
$block_date                     =   array();
$leave_block_list_allow_id      =   array();

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $leave_block_list_id        =   $row->leave_block_list_id;
        $leave_block_list_name      =   $row->leave_block_list_name;
        $company_id                 =   $row->company_id;
        $applies_to_all_departments =   $row->applies_to_all_departments;     
    } 
}
else
{
    $leave_block_list_id            =   $this->input->post('leave_block_list_id');
    $leave_block_list_name          =   $this->input->post('leave_block_list_name');
    $company_id                     =   $this->input->post('company_id');
    $applies_to_all_departments     =   $this->input->post('applies_to_all_departments');
    $block_from_date                =   $this->input->post('block_from_date');
    $block_to_date                  =   $this->input->post('block_to_date');
    $reason                         =   $this->input->post('reason');
    //$user_id                        =   $this->input->post('user_id');
}

if(!empty($contentData))
{
    foreach ($contentData as $row )
    {
        $leave_block_list_id        =   $row->leave_block_list_id;
        $leave_block_list_date_id[] =   $row->leave_block_list_date_id;
        $block_date[]               =   date("d-m-Y", strtotime($row->block_date));
        $reason[]                   =   $row->reason;
        $trowDate++;
    }
}else
{
    $leave_block_list_date_id   =   $this->input->post('leave_block_list_date_id');
    $block_date                 =   $this->input->post('block_date');
    $reason                     =   $this->input->post('reason');
 }

if(!empty($contentData1))
{
    foreach ($contentData1 as $row )
    {
        $leave_block_list_id                    =   $row->leave_block_list_id;
        $leave_block_list_allow_id[]            =   $row->leave_block_list_allow_id;
        $user_id[]                              =   $row->user_id;
    }
}
else
{
    $leave_block_list_allow_id              =   $this->input->post('leave_block_list_allow_id');
    $user_id                                =   $this->input->post('user_id');
}

$trowDate       = count($block_date) ? count($block_date):'1';
$trowuser       = count($user_id) ? count($user_id):'1';
$checkDisable   = ($leave_block_list_id == '') ? 'disabled' : '';
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Leave_blocklist_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="leave_block_list_id" id="leave_block_list_id" value="<?php echo $leave_block_list_id;?>">
        <div class="row">
        	<div class="col-md-6">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_leave_blocklist_name');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="leave_block_list_name" id="leave_block_list_name" ng-init="leave_block_list_name = '<?php echo $leave_block_list_name; ?>'" value="<?php echo $leave_block_list_name;?>" class="form-control" ng-model="leave_block_list_name" ng-pattern="/^[a-zA-Z\s]*$/" required allow-characters maxlength="25"/>
                    <span class="help-block"><?php echo form_error('leave_block_list_name')?></span>
                    <span class="help-block" ng-show="showMsgs && myform.leave_block_list_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.leave_block_list_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                </div>
            </div>
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?>, 'companies' )">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_company_name');?>    
                    <span class="mandatory">*</span><br/>
                    </label><a class="add-new-popup" onclick="">+</a>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="company_id" ng-model="company_id" required';
                        echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);?>
                        <?PHP if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} 
                    ?>--> 
                    <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control"  required select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
                     </select>                
                     <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="applies_to_all_departments" id="applies_to_all_departments" ng-init="applies_to_all_departments = '<?php echo $applies_to_all_departments; ?>'" <?php if($applies_to_all_departments == 1){ echo 'checked = "checked"';} ?> /> 
                        <?php echo lang('label_applies_to_company');?>
                    </label>
                </div>
            </div>
        </div>

        <fieldset>
            <legend><span><?php echo $this->lang->line('label_block_days');?></span></legend>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <!--<th><input type="checkbox" ></th> -->
                                <th></th>
                                <th><?php echo lang('label_block_days');?></th>
                                <th><?php echo lang('label_reason');?></th>
                            </tr>
                         </thead>
                        <tbody id="block_days">
                        <?php 
                        $is=1;
                        for($in=0; $in < $trowDate; $in++)
                        {
                        ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="leave_block_cbx" id="leave_block_cbx<?php echo $in;?>" data-name="leave_block_cbx" data-row="<?php echo $in;?>" value="<?php echo $leave_block_list_date_id[$in];?>" onclick="checkDeleteButton('leave_block_cbx', 'block_delete');" <?php echo $checkDisable;?>/>
                                    <input type="hidden" name="leave_block_list_date_id[]" id="leave_block_list_date_id<?php echo $in;?>" data-name="leave_block_list_date_id" ng-init="leave_block_list_date_id = '<?php echo $leave_block_list_date_id[$in]; ?>'" value="<?php echo $leave_block_list_date_id[$in];?>" data-row="<?php echo $in;?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control single-daterange" name="block_date[]" data-name="block_date" data-row="<?php echo $in;?>" id ="block_date<?php echo $in;?>" value="<?php echo $block_date[$in];?>"/>
                                </td>
                               
                                <td>
                                    <input type="text" name="reason[]" ng-init="reason = '<?php echo $reason[$in]; ?>'" data-row="<?php echo $in;?>" id="reason<?php echo $in;?>" data-name="reason" value="<?php echo $reason[$in];?>" class="form-control"/>
                                </td>
                            </tr>
                        <?php                      
                        $is++;
                        } 
                        ?>                       
                        </tbody> 
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                    <button class="btn btn-primary" type="button" onclick="addNewRow('block_days');" ><?php echo $this->lang->line('label_add_row');?></button>
                                    <input type="button" class="btn btn-danger block_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('block_days', 'leave_block_cbx', 'hr_leave_block_list_date', 'leave_block_list_date_id');" disabled>
                                </td>
                                </tr>
                            </tfoot>
                    </table>
                </div>
            </div>
        </fieldset>
       
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_allow_users');?></span> </legend>
            Allow the following users to approve Leave Applications for block days
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <!--<th><input type="checkbox" name=""></th>--> 
                                <th></th> 
                                <th><?php echo lang('label_allow_user');?>
                                    <a class="add-new-popup" onclick="">+</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="allow_users">
                        <?php 
                        $is=1;
                        for($in=0; $in < $trowuser; $in++)
                        {
                        ?>                          
                        <tr>
                            <td>
                                <input type="checkbox" class="leave_allow_cbx" id="leave_allow_cbx<?php echo $in;?>" data-name="leave_allow_cbx" data-row="<?php echo $in;?>" value="<?php echo $leave_block_list_allow_id[$in];?>" onclick="checkDeleteButton('leave_allow_cbx', 'users_delete');" <?php echo $checkDisable;?>/>
                                <input type="hidden" name="leave_block_list_allow_id[]" id="leave_block_list_allow_id<?php echo $in;?>" data-name="leave_block_list_allow_id" data-row="<?php echo $in;?>" value="<?php echo $leave_block_list_allow_id[$in];?>">
                            </td>
                            <td>
                                <?php 
                                    $attrib = 'class="form-control" id="user_id['.$in.']" data-row="['.$in.']" data-name="user_id"';
                                    echo form_dropdown('user_id[]', $userDropdown, set_value('user_id['.$in.']', (isset($user_id[$in])) ? $user_id[$in] : ''), $attrib);?>
                                    <?PHP if(form_error('user_id['.$in.']')){ echo '<span class="help-block">'.form_error('user_id').'</span>';} 
                                ?> 
                            </td>
                        </tr>
                        <?php                      
                        $is++;
                        } 
                        ?>                       
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                <button class="btn btn-primary" type="button" onclick="addNewRow('allow_users');" > <?php echo $this->lang->line('label_add_row');?> </button>
                                <input type="button" class="btn btn-danger users_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('allow_users', 'leave_allow_cbx', 'hr_leave_block_list_allow', 'leave_block_list_allow_id');" disabled>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
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