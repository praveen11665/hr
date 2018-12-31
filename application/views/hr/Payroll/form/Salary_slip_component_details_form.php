<?php
$earning_id                     =   array();
$salary_component_id_earing     =   array();
$statistical_component          =   array();
$formula_earing                 =   array();
$abbr_earing1                   =   array();
$salary_component_abbr          =   array();
$salary_slip_earning_id         =   array();

$ci =&get_instance();
$EarningDropdown                    =  $ci->mcommon->Dropdown('hr_salary_component', array('salary_component_id as Key', 'salary_component as Value'),array('salary_component_type_id' =>'1'));
$DeductionDropdown                  =  $ci->mcommon->Dropdown('hr_salary_component', array('salary_component_id as Key', 'salary_component as Value'),array('salary_component_type_id' =>'2'));

if(!empty($Earning))
{
    foreach($Earning as $row)
    {
        $salary_slip_earning_id         =  $row->salary_slip_earning_id;
        $earning_id[]                   =  $row->earning_id;
        $salary_structure_id            =  $row->salary_structure_id;
        $salary_component_id_earing[]   =  $row->salary_component_id;
        $statistical_component[]        =  $row->statistical_component; 
        $formula_earing[]               =  $row->formula; 

        if($row->abbr != '')
        {
            $abbr_earing1[]             =  $row->abbr;
        }
        if($row->salary_component_type_id == 1)
        {
            $salary_component_abbr[]    =  $row->salary_component_abbr;
        }
        $trowEar++;

        //Employee based earning amount calculation
        $formulaEaring   = $row->formula;
        $salaryBase      = array('base' => $baseAmount);
        $amount_earing[] = eval('return ' . strtr($formulaEaring, $salaryBase) . ';');
    }
            
    if($salary_component_abbr != '')
    {
        $abbr_earing     = array_merge($salary_component_abbr,$abbr_earing1);
    }else
    {
        $abbr_earing     = $abbr_earing1;
    }

    $trowEar           = count($salary_component_id_earing) ? count($salary_component_id_earing) :'1';
    $checkDisable      = (empty($earning_id)) ? 'disabled' : '';
}
else
{
    $salary_component_id_earing                =   $this->input->post('salary_component_id_earing[]');
    $abbr_earing                               =   $this->input->post('abbr_earing');  
    $statistical_component_earing              =   $this->input->post('statistical_component_earing');  
    $formula_earing                            =   $this->input->post('formula_earing');
    $amount                                    =   $this->input->post('amount_earing');      
    $salary_structure_id                       =   $this->input->post('salary_structure_id'); 

    $trowEar           = count($salary_component_id_earing) ? count($salary_component_id_earing) :'1';
    $checkDisable      = (empty($earning_id)) ? 'disabled' : '';
}

if(!empty($earningEditData))
{
    foreach ($earningEditData as $row) 
    {
       $salary_slip_earning_id[]        = $row->salary_slip_earning_id;
       $salary_component_id_earing[]    = $row->salary_component_id;
       $abbr_earing[]                   = $row->abbr;
       $statistical_component[]         = $row->statistical_component;
       $formula_earing[]                = $row->formula;
       $amount_earing[]                 = $row->amount;
    }

    $trowEar       = count($salary_slip_earning_id) ? count($salary_slip_earning_id) :'1';
    $checkDisable  = (empty($salary_slip_earning_id)) ? 'disabled' : '';
}
?>
<table class="table table-bordered">
    <thead>
    <tr>
        <!--<th><input type="checkbox" ></th>-->
        <th></th>
        <th><?php echo lang('label_component');?> <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $dropdownUrllink;?>');">+</a> </th>
        <th><?php echo lang('label_abbr');?></th>
        <th><?php echo lang('label_statistical_component');?></th>
        <th><?php echo lang('label_formula');?> (base*n)</th>
        <th><?php echo lang('label_amount');?></th>
        <th></th>
    </tr>
    </thead>
    <tbody id="EarningData">
        <?php 
            $is=1;
            for($in=0; $in < $trowEar; $in++)
            {
            ?>
                <tr>
                    <td>
                        <input type="checkbox" name="salary_slip_earning_id[]" value="<?php echo $salary_slip_earning_id[$in];?>" class ="earn_row_delete" onclick="checkDeleteButton('earn_row_delete', 'earn_delete');" <?php echo $checkDisable;?>>
                        <input type="hidden" name="salary_slip_earning_id[]" value="<?php echo $salary_slip_earning_id[$in];?>">
                    </td>
                    <td>
                        <?php
                            $attrib = 'class="form-control select2" data-name="salary_component_id_earing" id="salary_component_id_earing'.$in.'" data-row="'.$in.'" onchange="loadSalaryearn_abbr(this.id,this.value)"';
                            echo form_dropdown('salary_component_id_earing[]', $EarningDropdown, set_value('salary_component_id_earing['.$in.']', (isset($salary_component_id_earing[$in])) ? $salary_component_id_earing[$in] : ''), $attrib);
                        ?>
                    </td>
                    <td>
                        <input type="text" name="abbr_earing[]"   data-name="salary_component_abbr_earing" id="salary_component_abbr_earing<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo $abbr_earing[$in];?>" class="form-control"/>

                    </td>
                    <td>
                        <input type="checkbox" name="statistical_component_earing[<?php echo $in;?>]" data-name="ear_statistical_component" id="ear_statistical_component<?php echo $in;?>" data-row="<?php echo $in;?>" value="1" <?php if($statistical_component[$in] == 1){ echo 'checked = "checked"';} ?>/>
                    </td>
                    <td>
                    <textarea row="5" columns="10" name="formula_earing[]"  data-name="ear_formular" id="ear_formular<?php echo $in;?>" data-row="<?php echo $in;?>" class="form-control" onkeyup="calucalateEarnAmount(this.id, this.value), calTotalEarning()" ><?php echo $formula_earing[$in];?></textarea>
                    </td>
                    <td>
                        <input type="text" name="amount_earing[]"  data-name="ear_amount" id="ear_amount<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo $amount_earing[$in];?>" class="form-control amountEaring" readonly/>
                    </td>
                    <td> <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl1;?>');" name=""><?php echo $this->lang->line('label_Details');?></button> </td>    
                </tr>
            <?php                      
            $is++;
            } 
        ?> 
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7">                           
               <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('EarningData');" > <?php echo $this->lang->line('label_add_row');?> </button>
               <input type="button" class="btn btn-danger btn-sm earn_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('EarningData', 'earn_row_delete', 'hr_salary_slip_earning', 'salary_slip_earning_id');" disabled>  
            </td>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
    function calucalateEarnAmount(id, formula) 
    {
        var id          = id;
        var thenum      = id.match(/\d+$/)[0];
        //var baseAmount  = $('#base').val();
        var baseAmount  = $('#base_salary').val();
        var amount      = eval(formula.replace("base", baseAmount));

        if(amount)
        {
            $('#ear_amount'+thenum).val(amount);
        }else
        {
            $('#ear_amount'+thenum).val('0');
        }
    }

    $(document).ready(function ()
    {
        calTotalEarning();
    });   

    function calTotalEarning() 
    {
        total_earing       = 0;

        $('.amountEaring').each(function()
        {
            total_earing    += Number($(this).val());
            $('#total_earing').val(total_earing);
        });

        netPayTotal();
    }    

    function netPayTotal() 
    {
        var total_earing    = $('#total_earing').val();
        var total_deduction = $('#total_deduction').val();

        gross_pay      = Number(total_earing) + Number(total_deduction);
        rounded_total  = Math.round(total_earing);

        $('#gross_pay').val(gross_pay);
        $('#net_pay').val(total_earing);
        $('#rounded_total').val(rounded_total);
    }
</script>