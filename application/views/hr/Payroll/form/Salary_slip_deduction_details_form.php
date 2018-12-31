<?php
$salary_component_id_deduction          =   array();
$statistical_component_deduction        =   array();
$formula_deduction                      =   array();
$amount_deduction                       =   array();
$abbr_deduction                         =   array();

$ci =&get_instance();
$DeductionDropdown  =  $ci->mcommon->Dropdown('hr_salary_component', array('salary_component_id as Key', 'salary_component as Value'),array('salary_component_type_id' =>'2'));

if(!empty($Deduction))
{
    foreach($Deduction as $row)
    {
        $salary_component_id_deduction[]   =  $row->salary_component_id;
        $statistical_component_deduction[] =  $row->statistical_component; 
        $formula_deduction[]               =  $row->formula; 
        $abbr_deduction[]                  =  $row->abbr;
        //$amount_deduction[]                =  $row->amount; 
        $trowDed++;

        //Employee based earning amount calculation
        $formulaEaring       = $row->formula;
        $salaryBase          = array('base' => $baseAmount);
        $amount_deduction[]  = eval('return ' . strtr($formulaEaring, $salaryBase) . ';');
    }

    $trowDed        = count($salary_component_id_deduction) ? count($salary_component_id_deduction) :'1';
    $checkDisable   = (empty($statistical_component_deduction)) ? 'disabled' : '';
}
else
{
    $salary_component_id_deduction        =   $this->input->post('salary_component_id_deduction');
    $abbr_deduction                       =   $this->input->post('abbr_deduction');  
    $statistical_component                =   $this->input->post('statistical_component_deduction');  
    $statistical_component_deduction      =   $this->input->post('formula_deduction');
    $amount_deduction                     =   $this->input->post('amount_deduction');      
    $salary_structure_id                  =   $this->input->post('salary_structure_id');   
}

if(!empty($DeductionData))
{
    foreach ($DeductionData as $row) 
    {
        $salary_slip_deduction_id[]        =  $row->salary_slip_deduction_id;
        $salary_component_id_deduction[]   =  $row->salary_component_id; 
        $abbr_deduction[]                  =  $row->abbr;
        $statistical_component_deduction[] =  $row->statistical_component;
        $formula_deduction[]               =  $row->formula; 
        $amount_deduction[]                =  $row->amount;       
    }

    $trowDed        = count($salary_slip_deduction_id) ? count($salary_slip_deduction_id) :'1';
    $checkDisable   = (empty($salary_slip_deduction_id)) ? 'disabled' : '';
}
?>
<table class="table table-bordered">
    <thead>
    <tr>
        <!--<th><input type="checkbox" ></th>-->
        <th></th>
        <th><input type="checkbox" ></th>
        <th><?php echo lang('label_component');?> <a class="add-new-popup" onclick="addDropdownPopup('<?php echo $dropdownUrllink;?>');">+</a> </th>
        <th><?php echo lang('label_abbr');?></th>
        <th><?php echo lang('label_statistical_component');?></th>
        <th><?php echo lang('label_formula');?> (base*n)</th>
        <th><?php echo lang('label_amount');?></th>
        <th></th>
    </tr>
    </thead>
    <tbody id="DeductionData">
        <?php 
        /*
        for($in=0; $in < $trowDed; $in++)
        {
            ?>
            <tr>
                <td>
                    <input type="checkbox" name="salary_slip_deduction_id[]" value = "<?php echo $salary_slip_deduction_id[$in] ;?>" class="new_row_delete">
                    <input type="hidden" name="salary_slip_deduction_id[]" value="<?php echo $salary_slip_deduction_id[$in];?>">
                </td>
                <td>
                    <?php
                    $attrib = 'class="form-control select2" data-name="salary_component_id_deduction" id="salary_component_id_deduction'.$in.'" data-row="'.$in.'" onchange="loadSalarydeduct_abbr(this.id,this.value)"';
                    echo form_dropdown('salary_component_id_deduction[]', $DeductionDropdown, set_value('salary_component_id_deduction['.$in.']', (isset($salary_component_id_deduction[$in])) ? $salary_component_id_deduction[$in] : ''), $attrib);
                ?>
                </td>
                <td>
                    <input type="text" name="abbr_deduction[]"  data-name="salary_component_abbr_deduction" id="salary_component_abbr_deduction<?php echo $in;?>" data-row="<?php echo $in;?>"  value="<?php echo $abbr_deduction[$in];?>" class="form-control" readonly/>                                    
                </td>
                <td>
                    <input type="checkbox" name="statistical_component_deduction[<?php echo $in;?>]" data-name="statistical_component_deduction" id="statistical_component_deduction<?php echo $in;?>" data-row="<?php echo $in;?>"
                    value="1" <?php if($statistical_component_deduction[$in] == 1) { echo 'checked = "checked"';} ?> />
                </td>
                <td>
                     <textarea name="formula_deduction[]" row="5"  data-name="formula_deduction" id="formula_deduction<?php echo $in;?>" data-row="<?php echo $in;?> columns="10" class="form-control" onkeyup="calucalateDeductionAmount(this.id, this.value), calTotalDeduction()"><?php echo$formula_deduction[$in];?></textarea>
                </td>
                <td>
                    <input type="text" name="amount_deduction[]" data-name="amount" id="amount<?php echo $in;?>" data-row="<?php echo $in;?>""  value="<?php echo$amount_deduction[$in];?>" class="form-control amount_deduction" readonly/>
                </td>
                <td> 
                    <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl2;?>');" name=""><?php echo $this->lang->line('label_Details');?></button> 
                </td>    
            </tr>
            <?php                     
        }
        */ 
        ?>

        <?php 
            for($in=0; $in < $trowDed; $in++)
            {
                ?>
                <tr>
                    <td>
                        <input type="checkbox" name="salary_slip_deduction_id[]" value="<?php echo $salary_slip_deduction_id[$in];?>" class ="dedu_row_delete" onclick="checkDeleteButton('dedu_row_delete', 'dedu_delete');" <?php echo $checkDisable;?>>
                        <input type="hidden" name="salary_slip_deduction_id[]" class="" value="<?php echo $salary_slip_deduction_id[$in];?>">
                    </td>
                    <td>
                        <?php
                            $attrib = 'class="form-control " data-name="salary_component_id_deduction" id="salary_component_id_deduction'.$in.'" data-row="'.$in.'" onchange="loadSalarydeduct_abbr(this.id,this.value)"';
                            echo form_dropdown('salary_component_id_deduction[]', $DeductionDropdown, set_value('salary_component_id_deduction['.$in.']', (isset($salary_component_id_deduction[$in])) ? $salary_component_id_deduction[$in] : ''), $attrib);
                        ?>
                    </td>
                    <td>
                        <input type="text" name="abbr_deduction[]" data-name="salary_component_abbr_deduction" id="salary_component_abbr_deduction<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo $abbr_deduction[$in];?>" class="form-control"/>
                    </td>
                    <td>
                        <input type="checkbox" name="statistical_component_deduction[<?php echo $in;?>]" data-name="statistical_component_deduction" id="statistical_component_deduction<?php echo $in;?>" data-row="<?php echo $in;?>" value="1" <?php if($statistical_component_deduction[$in] == 1){ echo 'checked = "checked"';} ?>/>
                    </td>
                    <td>
                        <textarea row="5" columns="10" name="formula_deduction[]"  data-name="formula_deduction" id="formula_deduction<?php echo $in;?>" data-row="<?php echo $in;?>" class="form-control" onkeyup="calucalateDeductionAmount(this.id, this.value)"><?php echo $formula_deduction[$in];?></textarea>
                    </td>
                    <td>
                        <input type="text" name="amount_deduction[]"  data-name="amount" id="amount<?php echo $in;?>" data-row="<?php echo $in;?>" value="<?php echo$amount_deduction[$in];?>" class="form-control amount_deduction" readonly/>
                    </td>
                    <td> <button class="btn btn-inverse" type="button" onclick="addTableContentPop('<?php echo $contentUrl2;?>');" name=""><?php echo $this->lang->line('label_Details');?></button> </td>    
                </tr>
                <?php                      
            } 
        ?> 
    </tbody>
    <tfoot>
         <tr>
            <td colspan="7">                           
           <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('DeductionData');" > <?php echo $this->lang->line('label_add_row');?>  </button>
           <input type="button" class="btn btn-danger btn-sm dedu_delete" name="" value="<?php echo $this->lang->line('label_delete');?>" onclick="addRowDelete('DeductionData', 'dedu_row_delete', 'hr_salary_slip_deduction', 'salary_slip_deduction_id');" disabled>  
            </td>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
    function calucalateDeductionAmount(id, formula) 
    {
        var id          = id;
        var thenum      = id.match(/\d+$/)[0];
        //var baseAmount  = $('#base').val();
        var baseAmount  = $('#base_salary').val();

        var amount      = eval(formula.replace("base", baseAmount));

        if(amount)
        {
            $('#amount'+thenum).val(amount);
            calTotalDeduction();
        }else
        {
            $('#amount'+thenum).val('0');
        }
    }

    $(document).ready(function ()
    {
        calTotalDeduction();
    }); 

    function calTotalDeduction() 
    {
        total_deduction       = 0;

        $('.amount_deduction').each(function()
        {
            total_deduction        += Number($(this).val());
            $('#total_deduction').val(total_deduction);
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