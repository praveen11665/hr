<?php
$ci =&get_instance();
$namingSeriesdrop                   =  $ci->mdrop->namingSeriesdrop('41');

//Variable Initialize
$appraisal_template_id              =   "";
$appraisal_temp_title               =   "";
$description                        =   "";
$kra                                =   array();
$weight_age                         =   array();
$appraisal_template_goal_id         =   array();

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $appraisal_template_id      =   $row->appraisal_template_id;
        $naming_series              =   $row->naming_series;
        $appraisal_temp_title       =   $row->appraisal_temp_title;
        $description                =   $row->description;             
    }

    foreach ($tableDataTemplate as $row) 
    {
        $appraisal_template_id              =   $row->appraisal_template_id;
        $appraisal_template_goal_id[]       =   $row->appraisal_template_goal_id;
        $kra[]                              =   $row->kra;
        $weight_age[]                       =   $row->weight_age;
        $trowtemp++;
    }

    $naming_seriesArr =   explode('/', $naming_series);
    foreach ($naming_seriesArr as $key => $value) 
    {
        $set_options    =   $naming_seriesArr[0];
    }
    $source_id          =   $this->mcommon->specific_row_value('set_naming_series', array('transaction_id' => '41'), 'naming_series_id');

    $naming_option      =   $source_id."_".$set_options; 
}
else
{
    $appraisal_template_id          =   $this->input->post('appraisal_template_id');
    $appraisal_temp_title           =   $this->input->post('appraisal_temp_title');
    $description                    =   $this->input->post('description');
    $kra                            =   $this->input->post('kra');
    $weight_age                     =   $this->input->post('weight_age');  
}

$trowtemp       = count($kra) ? count($kra):'1';
$checkDisable   = ($appraisal_template_id == '') ? 'disabled' : '';
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Appraisals_Template_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="appraisal_template_id" id="appraisal_template_id" value="<?php echo $appraisal_template_id;?>">
        <div class="row">
            <div class="col-md-6" ng-init="loadSeriesDropdown('<?php echo base_url();?>Common_controller/namingSeriesdrop/41')">
                <div class="form-group">
                    <label for="naming_series_id"><?php echo $this->lang->line('label_series_name');?> </label> <span class="mandatory">*</span>
                    <a class="add-new-popup" ng-click="$ctrl.openSecond('lg', '', '<?php echo base_url($namingUrl);?>' )"><i class="popup"></i>+</a>
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
            <div class="col-md-6">
                <div class="form-group">
                <label for=""><?php echo $this->lang->line('label_appraisals_template_title');?></label>
                    <span class="mandatory">*</span>
                <input type="text" name="appraisal_temp_title" id="appraisal_temp_title" ng-init="appraisal_temp_title = '<?php echo $appraisal_temp_title; ?>'" value="<?php echo $appraisal_temp_title;?>" class="form-control" ng-model="appraisal_temp_title" required allow-characters maxlength="25"/>
                <span class="help-block"><?php echo form_error('appraisal_temp_title')?></span>
                <span class="help-block" ng-show="showMsgs && myform.appraisal_temp_title.$error.required"><?php echo $this->lang->line('required');?></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label><?php echo $this->lang->line('label_description');?></label>
                <span class="mandatory">*</span>
                <textarea class="form-control" rows="3" name="description" ng-init="description = '<?php echo $description; ?>'" id="description" ng-model="description" required><?php echo $description; ?></textarea>
                <span class="help-block"><?php echo form_error('description')?></span>
                <span class="help-block" ng-show="showMsgs && myform.description.$error.required"><?php echo $this->lang->line('required');?></span>

                </div>  
            </div>
            <div class="col-md-6">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table  class="table table-bordered">
                <thead>
                    <tr>
                    <!--<th><input type="checkbox" name=""></th>-->
                    <th></th>
                    <th><?php echo lang('label_kra');?></th>
                    <th><?php echo lang('label_weight_age');?></th>
                    <th></th>
                    </tr>
                </thead>

                <tbody id = "appraisal_template">
                <?php 
                $is=1;
                for($in=0; $in < $trowtemp; $in++)
                {
                ?>
                    <tr>
                    <td>
                        <input type="checkbox" class="app_temp_cbx" id="app_temp_cbx<?php echo $in;?>" data-name="app_temp_cbx" data-row="<?php echo $in;?>" value="<?php echo $appraisal_template_goal_id[$in];?>" onclick="checkDeleteButton('app_temp_cbx', 'add-delete');" <?php echo $checkDisable;?>/>
                        <input type="hidden" name="appraisal_template_goal_id[]" data-row="<?php echo $in;?>" value="<?php echo $appraisal_template_goal_id[$in];?>" data-name="appraisal_template_goal_id" id="appraisal_template_goal_id<?php echo $in;?>">
                    </td>
                    <td>
                        <input type="text" name="kra[]" id="kra<?php echo $in;?>" ng-init="kra = '<?php echo $kra[$in]; ?>'" data-name="kra" data-row="<?php echo $in;?>" value="<?php echo $kra[$in];?>" class="form-control" ng-model="kra"/>
                    </td>
                    <td>
                        <input type="text" name="weight_age[]" data-row="<?php echo $in;?>" data-name="weight_age"  ng-init="weight_age = '<?php echo $weight_age[$in]; ?>'" id="weight_age<?php echo $in;?>" value="<?php echo $weight_age[$in];?>" class="form-control weight_age" ng-model="weight_age" onkeypress="return isNumberKey(event)" maxlength="5"/>
                        <!--<span class="help-block" ng-show="showMsgs && myform['weight_age[]'].$error.required"><?php echo $this->lang->line('required');?></span>-->
                        <!--<span class="help-block" ng-show="myform.weight_age_<?php echo $in;?>.$error.required"><?php echo $this->lang->line('required');?></span>-->
                    </td>
                    <td></td>
                    </tr>
                <?php                      
                    $is++;
                    } 
                ?> 
                </tbody> 
                <tfoot>
                    <th colspan="6">
                    <button class="btn btn-primary btn-sm" type="button" onclick="addNewRow('appraisal_template');" > + Add Row </button>
                    <input type="button" class="btn btn-danger btn-sm add-delete" name="" value="Delete" onclick="addRowDelete('appraisal_template', 'app_temp_cbx', 'hr_appraisal_template_goal', 'appraisal_template_goal_id');" disabled>
                    </th>
                </tfoot>                
                </table>
            </div>
        </div>
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="button" onclick = "calculateWeightAge()"> Submit</button>
            <a href="<?php echo base_url('hr/Appraisals/Appraisal_template') ?>" class="btn btn-danger"> Cancel</a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>