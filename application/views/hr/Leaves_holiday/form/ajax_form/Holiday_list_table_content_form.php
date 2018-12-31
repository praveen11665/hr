<?php
$holiday_list_holiday_id        =   "";
$holiday_date                   =   "";
$description                    =   "";

if(!empty($contentData))
{
    foreach($contentData as $row)
    {
       $holiday_list_holiday_id = $row->holiday_list_holiday_id; 
       $holiday_date            =   date('d-m-Y', strtotime($row->holiday_date));
       $description             =   $row->description;      
    }
}
else
{
    $holiday_list_holiday_id =   $this->input->post('holiday_list_holiday_id'); 
    $holiday_date            =   $this->input->post('holiday_date');
    $description             =   $this->input->post('description');   
}
?>
<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxContentForm">
  <input type="hidden" name="holiday_list_holiday_id" id="holiday_list_holiday_id" value="<?php echo $holiday_list_holiday_id; ?>"/>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""><?php echo $this->lang->line('label_date');?> </label>
                <input class="single-daterange form-control" type="text" value="<?php echo $holiday_date;?>" name="holiday_date" id="holiday_date">               
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo $this->lang->line('label_description');?></label>
                <textarea name="description" class="form-control" id="description"><?php echo $description;?></textarea>                
                <span class="help-block"><?php echo form_error('description');?></span>
            </div>  
        </div>
    </div>
    <div class="form-buttons-w">
        <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
        <button class="btn btn-danger" type="reset" name="reset"> <?php echo $this->lang->line('label_cancel');?></button>
    </div>
</form>
