<?php
$holiday_date                   =  array();
$description                    =  array();
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <!--<th width="50px" ><input type="checkbox" ></th>-->
            <th width="50px"></th>
            <th> <label for="date"><?php echo $this->lang->line('label_date');?> </label>  </th> 
            <th> <label for="description"><?php echo $this->lang->line('label_description');?> </label></th> 
            <th> </th>                                            
        </tr> 
    </thead>
    <tbody id="holidayLists">
    <?php

    if(!empty($weekoffDates))
    {
        foreach ($weekoffDates as $key => $WeekDaysArr) 
        {
            ?>
                <tr>
                   <td> 
                        <input type="checkbox" class="holiday_list_cbx" id="holiday_list_cbx<?php echo $in;?>" data-name="holiday_list_cbx" data-row="<?php echo $in;?>" value="<?php echo $expense_claim_type_account_id[$in];?>"  onclick="checkDeleteButton('holiday_list_cbx', 'add_delete');" <?php echo $checkDisable;?>/>
                        <input type="hidden" name="holiday_list_holiday_id[]" id="holiday_list_holiday_id<?php echo $in;?>"  value = "<?php echo $holiday_list_holiday_id[$in];?>" data-name="holiday_list_holiday_id" data-row="<?php echo $in;?>">
                    </td>
                    <td>
                        <input class="single-daterange form-control" type="text" value="<?php echo date('d-m-Y', strtotime($WeekDaysArr['holiday_date']));?>" name="holiday_date[]" id = "holiday_date">
                    </td>
                    <td>
                        <textarea name="description[]" class="form-control" rows="1" id="description" 
                        value = "<?php echo $description;?>"><?php echo $WeekDaysArr['description'];?></textarea>
                        <span class="help-block"><?php echo form_error('description');?></span>
                    </td>
                    <td>
                        <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl;?>');" name=""><?php echo $this->lang->line('label_Details');?></button>
                    </td>
                </tr>
            <?php
        }        
    }else
    {
        ?>
        <tr>
            <td colspan="4"><center><b style="font-size: 20px">No data</b></center></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
                <button class="btn btn-primary btn-sm" id ="e" data-name="e" type="button" onclick="addNewRow('holidayLists');" > <?php echo $this->lang->line('label_add_row');?> </button>
                <input type="button" class="btn btn-danger btn-sm add_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('holidayLists', 'holiday_list_cbx', 'hr_holiday_list_holiday', 'holiday_list_holiday_id');" disabled>
            </td>
        </tr>                                           
    </tfoot>                           
</table>
