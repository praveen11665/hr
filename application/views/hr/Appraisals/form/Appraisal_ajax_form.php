<?php
 
 $appraisal_template_id               =   array();
 $kra                                 =   array();
 $weight_age                          =   array();

if(!empty($template))
{

    foreach ($template as $row )
    {
        $appraisal_template_id[]      =   $row->appraisal_template_id;
        $kra[]                        =   $row->kra;
        $weight_age[]                 =   $row->weight_age; 
        $trowAppraisal++;             
    }

}

$trowAppraisal           = count($kra) ? count($kra):'1';

?>
<table  class="table table-bordered">
    <thead>
        <tr>
            <!--<th><input type="checkbox" name=""></th>-->
            <th><?php echo lang('label_goals');?></th>
            <th><?php echo $this->lang->line('label_weight_age');?></th>
            <th><?php echo $this->lang->line('label_score');?></th>
            <th><?php echo $this->lang->line('label_score_earned');?></th>
        </tr>         
    </thead>
    <tbody class="all_row_values">
    <?php 
        $is=1;
        for($in=0; $in < $trowAppraisal; $in++)
        {
            ?>
		        <tr>
		            <!--<td>
                        <input type="checkbox" class="app_cbx" id="app_cbx<?php echo $in;?>" data-name="app_cbx" data-row="<?php echo $in;?>" value="<?php echo $appraisal_goal_id[$in];?>"/>
                        <input type="hidden" name="appraisal_goal_id[]" value="<?php echo $appraisal_goal_id[$in];?>" data-row="<?php echo $in;?>" id="appraisal_goal_id<?php echo $in;?>" data-name="appraisal_goal_id">
                    </td>-->
                    <td>
                        <input type="text" name="kra[]" id="kra<?php echo $in;?>" data-name="kra" data-row="<?php echo $in;?>" value="<?php echo $kra[$in];?>" class="form-control kra" />
                    </td>
                    <td>
                        <input type="text" name="weight_age[]" data-name="weight_age" id="weight_age<?php echo $in;?>"  data-row="<?php echo $in;?>" value="<?php echo $weight_age[$in];?>" class="form-control weight_age" onkeyup ="calculateScore()" onkeypress="return isNumberKey(event)"/>
                    </td>
                    <td> 
                        <input type="text" name="score[]" data-name="score" data-row="<?php echo $in;?>" id="score<?php echo $in;?>" value="<?php echo $score[$in]; ?>" class="form-control score" onkeyup ="calculateScore()" onkeypress="return isNumberKey(event)" onkeypress="return isNumberKey(event)"/>
                    </td>
                    <td>
                        <input type="text" name="score_earned[]" data-row="<?php echo $in;?>" id="score_earned<?php echo $in;?>" data-name="score_earned" value="<?php echo $score_earned[$in]; ?>" class="form-control score_earned" onkeyup ="calculateScore()" />
                    </td>
		        </tr>
		    <?php                      
        $is++;
        } 
    ?> 
    </tbody>                                         
</table>

