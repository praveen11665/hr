<?php
$ci =&get_instance();
$EventNameDropdown      =  $ci->mcommon->Dropdown('hr_training_event', array('training_event_id as Key', 'event_name as Value'), array('is_delete' => 0));
$EmployeeIdDropdown     =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_number as Value'), array('is_delete' => 0));

//Variable Initialize
$training_result_id             =   "";
$training_event_id              =   "";
$employee_id                    =   "";
$hours                          =   "";
$grade                          =   "";
$comments                       =   array();
$employee_id                    =   array();
$hours                          =   array();
$grade                          =   array();
$training_result_employee_id    =   array();
     
if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $training_result_id     =   $row->training_result_id;
        $training_event_id      =   $row->training_event_id;
        //$employee_id          =   $row->employee_id;
        $hours                  =   $row->hours;
        $grade                  =   $row->grade;
        //$comments             =   $row->comments;
    }    
}
else
{
    $training_result_id     =   $this->input->post('training_result_id');
    $training_event_id      =   $this->input->post('training_event_id');
    //$employee_id            =   $this->input->post('employee_id');
    $hours                  =   $this->input->post('hours'); 
    $grade                  =   $this->input->post('grade');
    $comments               =   $this->input->post('comments'); 
}
if(!empty($tableData1))
{
    foreach ($tableData1 as $row)
    {
        $training_result_id             =   $row->training_result_id;
        $training_result_employee_id[]    =   $row->training_result_employee_id;
        $employee_id[]                  =   $row->employee_id;
        $hours[]                        =   $row->hours;
        $grade[]                        =   $row->grade;
        $comments[]                     =   $row->comments;
        $trowEmp++;
    }    
}
else
{
    $training_result_id     =   $this->input->post('training_result_id');
    $employee_id            =   $this->input->post('employee_id');
    $hours                  =   $this->input->post('hours'); 
    $grade                  =   $this->input->post('grade');
    $comments               =   $this->input->post('comments'); 
}
$trowEmp           = count($employee_id) ? count($employee_id):'1';
$checkDisable      = ($training_result_id == '') ? 'disabled' : '';
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Training_result_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm"  name="myform">
      <input type="hidden" name="training_result_id" id="training_result_id" value="<?php echo $training_result_id;?>" >
        <div class="row">
                <div class="col-md-4" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/hr_training_event',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'events' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_event_name');?></label>
                    <span class="mandatory"> * </span>
                    <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $dropdownUrl;?>');">+</a>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="training_event_id" ng-model="training_event_id" required ';
                        echo form_dropdown('training_event_id', $EventNameDropdown, set_value('training_event_id', (isset($training_event_id)) ? $training_event_id : ''), $attrib);
                        if(form_error('training_event_id')){ echo '<span class="help-block">'.form_error('training_event_id').'</span>';}
                    ?>-->
                    <select name="training_event_id" ng-init="training_event_id = '<?php echo $training_event_id; ?>'" ng-model="training_event_id" id="training_event_id" class="form-control" required select2>
                          <option value="">-- Select --</option>  
                          <option ng-repeat="training_event_id in events" value="{{training_event_id.training_event_id}}">{{training_event_id.event_name}}</option>  
                    </select>
                    <span class="help-block" ng-show="showMsgs && myform.training_event_id.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
        </div>   
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <!--<th><input type="checkbox" ></th> -->
                            <th></th>
                            <th><?php echo lang('label_employee_id');?></th>  
                            <th><?php echo lang('label_hours');?></th>
                            <th><?php echo lang('label_grade');?></th>
                            <th><?php echo lang('label_comments');?></th>
                            <!--<th></th>-->
                        </tr>
                    </thead>
                    <tbody id="employee_score">
                    <?php 
                        $is=1;
                        for($in=0; $in < $trowEmp; $in++)
                        {
                            ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="tr_res_cbx" id="tr_res_cbx<?php echo $in;?>" data-name="tr_res_cbx" data-row="<?php echo $in;?>" value="<?php echo $training_result_employee_id[$in];?>" onclick="checkDeleteButton('tr_res_cbx', 'add_delete');" <?php echo $checkDisable;?>/>
                                        <input type="hidden" name="training_result_employee_id[]" value="<?php echo $training_result_employee_id[$in] ;?>" data-name="training_result_employee_id" id="training_result_employee_id<?php echo $in;?>" data-row="<?php echo $in;?>"/>
                                    </td>
                                    <td>
                                        <?php 
                                        $attrib = 'class="form-control" id="employee_id'.$in.'" data-row="'.$in.'" data-name="employee_id"';
                                        echo form_dropdown('employee_id[]', $EmployeeIdDropdown, set_value('employee_id['.$in.']', (isset($employee_id)) ? $employee_id[$in] : ''), $attrib);
                                        if(form_error('employee_id['.$in.']')){ echo '<span class="help-block">'.form_error('employee_id['.$in.']').'</span>';}
                                        ?> 
                                    </td>
                                    <td>
                                        <input type="text" name="hours[]" maxlength="5" id="hours<?php echo $in;?>" ng-init="hours = '<?php echo $hours[$in]; ?>'" value="<?php echo $hours[$in];?>" class="form-control" data-row="<?php echo $in;?>" onkeypress="return isNumberKey(event)"/>
                                        <span class="help-block"><?php echo form_error('hours[$in]')?></span>
                                    </td>
                                    <td>
                                        <input type="text" name="grade[]" maxlength="10" id="grade<?php echo $in;?>" ng-init="grade = '<?php echo $grade[$in]; ?>'" value="<?php echo $grade[$in];?>" class="form-control" data-row="<?php echo $in;?>"/>
                                        <span class="help-block"><?php echo form_error('grade[$in]')?></span>
                                    </td>
                                    <td>
                                        <input type="text" name="comments[]" maxlength="30" id="comments<?php echo $in;?>" ng-init="comments = '<?php echo $comments[$in]; ?>'" value="<?php echo $comments[$in];?>" class="form-control" data-row="<?php echo $in;?>"/>
                                        <span class="help-block"><?php echo form_error('comments[$in]')?></span>
                                    </td>
                                    <!--<td>
                                        <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl;?>');" name="">Details</button>
                                    </td>-->
                                </tr>
                            <?php                      
                            $is++;
                        } 
                    ?> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('employee_score');" > <?php echo $this->lang->line('label_add_row');?> </button>
                                <input type="button" class="btn btn-danger btn-sm add_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('employee_score', 'tr_res_cbx', 'hr_training_result_employee', 'training_result_employee_id');" disabled>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>