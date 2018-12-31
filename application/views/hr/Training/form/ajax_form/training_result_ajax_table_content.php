<?php
$ci =&get_instance();
$EmployeeIdDropdown  =  $ci->mcommon->Dropdown('hr_employee', array('employee_id as Key', 'employee_number as Value'));

$training_result_employee_id    =   "";
$employee_id                    =   "";
$employee_name                  =   "";
$hours                          =   "";
$grade                          =   "";
$comments                       =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $training_result_employee_id    =   $row->training_result_employee_id;
        $employee_id                    =   $row->employee_id;
        $employee_name                  =   $row->employee_name;
        $hours                          =   $row->hours;
        $grade                          =   $row->grade;
        $comments                       =   $row->comments;
    }
}
else
{
    $training_result_employee_id    =   $this->input->post('training_result_employee_id');
    $employee_id                    =   $this->input->post('employee_id');
    $employee_name                  =   $this->input->post('employee_name');
    $hours                          =   $this->input->post('hours'); 
    $grade                          =   $this->input->post('grade');
    $comments                       =   $this->input->post('comments'); 
}
?>
<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxContentForm">
  <input type="hidden" name="training_result_employee_id" id="training_result_employee_id" value="<?php echo $training_result_employee_id; ?>"/>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""><?php echo $this->lang->line('label_employee');?> </label>
                <a class="add-new-popup" onclick="">+</a>
                <span class="mandatory">*</span><br/>
                <?php 
                    $attrib = 'class="form-control select2" id="employee_id" onchange="loademployeename();"';
                    echo form_dropdown('employee_id', $EmployeeIdDropdown, set_value('employee_id', (isset($employee_id)) ? $employee_id : ''), $attrib);
                    if(form_error('employee_id')){ echo '<span class="help-block">'.form_error('employee_id').'</span>';}
                ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo $this->lang->line('label_employee_name');?></label>
                <span class="mandatory">*</span>
                <input type="text" name="employee_name" id="employee_name" value="<?php echo $employee_name;?>" class="form-control"  readonly/>
                <span class="help-block"><?php echo form_error('employee_name');?></span>
            </div>  
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""> <?php echo lang('label_hours');?> </label>
                <span class="mandatory">*</span><br/>
                <input type="text" name="hours" id="hours" value="<?php echo $hours;?>" class="form-control"/>
                <span class="help-block"><?php echo form_error('hours');?></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for=""> <?php echo lang('label_grade');?> </label>
                <span class="mandatory">*</span><br/>
                <input type="text" name="grade" id="grade" value="<?php echo $grade;?>" class="form-control"/>
                <span class="help-block"><?php echo form_error('grade');?></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""> <?php echo lang('label_comments');?> </label>
                <span class="mandatory">*</span>
                <textarea row="5" columns="10" class="form-control" name="comments" id="comments"> <?php echo $comments;?></textarea>
                </textarea>
                <span class="help-block"><?php echo form_error('comments');?></span>
            </div>
        </div>
    </div>
    <div class="form-buttons-w">
        <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
        <button class="btn btn-danger" type="reset" name="reset"> <?php echo $this->lang->line('label_cancel');?></button>
    </div>
</form>

