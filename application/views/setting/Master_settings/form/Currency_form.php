<?php
$currency_id                                =   "";
$currency_name                              =   "";
$is_enabled                                 =   "";
$fraction                                   =   "";
$fraction_units                             =   "";
$smallest_currency_fraction_value           =   "";
$symbol                                     =   "";
$number_formate                             =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $currency_id                        =   $row->currency_id;
        $currency_name                      =   $row->currency_name;
        $is_enabled                         =   $row->is_enabled;
        $fraction                           =   $row->fraction;
        $fraction_units                     =   $row->fraction_units;
        $smallest_currency_fraction_value   =   $row->smallest_currency_fraction_value;
        $symbol                             =   $row->symbol;
        $number_formate                     =   $row->number_formate;
    }
}
else
{
    $currency_id                            =   $this->input->post('currency_id');
    $currency_name                          =   $this->input->post('currency_name');
    $is_enabled                             =   $this->input->post('is_enabled');
    $fraction                               =   $this->input->post('fraction');
    $fraction_units                         =   $this->input->post('fraction_units');
    $smallest_currency_fraction_value       =   $this->input->post('smallest_currency_fraction_value');
    $symbol                                 =   $this->input->post('symbol');
    $number_formate                         =   $this->input->post('number_formate'); 
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('currency_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
     <input type="hidden" name="currency_id" id="currency_id" value="<?php echo $currency_id; ?>" >
    	<div class="row">
    		<div class="col-md-6">
    			<div class="form-group">
    				<label><?php echo $this->lang->line('label_currency');?></label>
                    <span class="mandatory">*</span>
    				<input type="text" name="currency_name" id="currency_name" ng-init="currency_name = '<?php echo $currency_name; ?>'" value="<?php echo $currency_name;?>" class="form-control" ng-model="currency_name" required disallow-spaces allow-characters>
                    <span class="help-block" ng-show="showMsgs && myform.currency_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.currency_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('currency_name')?></span>
    			</div>         
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_currency_fraction');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="fraction" id="fraction" ng-init="fraction = '<?php echo $fraction; ?>'" value="<?php echo $fraction; ?>" class="form-control" ng-model="fraction" required disallow-spaces>
                    <span class="help-block" ng-show="showMsgs && myform.fraction.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.fraction.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('fraction')?></span>
                </div>
            </div>           
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_currency_fraction_units');?></label>
                    <input type="text" name="fraction_units" id="fraction_units" ng-init="fraction_units = '<?php echo $fraction_units; ?>'"ng-init="fraction_units = '<?php echo $fraction_units; ?>'" value="<?php echo$fraction_units;?>" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_currency_smallest_currency_fraction_value');?></label>
                    <input type="text" name="smallest_currency_fraction_value" ng-init="smallest_currency_fraction_value = '<?php echo $smallest_currency_fraction_value; ?>'" id="smallest_currency_fraction_value" value="<?php echo$smallest_currency_fraction_value;?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_currency_symbol');?></label>
                    <input type="text" name="symbol" id="symbol" ng-init="symbol = '<?php echo $symbol; ?>'" value="<?php echo $symbol;?>" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_currency_number_format');?></label>
                    <input type="text" name="number_formate" ng-init="number_formate = '<?php echo $number_formate; ?>'" id="number_formate" value="<?php echo $number_formate;?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_enabled" ng-init="is_enabled = '<?php echo $is_enabled; ?>'" id="is_enabled"  <?php if($is_enabled == 1){ echo 'checked = "checked"';} ?>/>          
                        <?php echo $this->lang->line('label_currency_enabled');?>
                    </label>
                </div>
            </div>
        </div>      
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"><?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('setting/Master_settings/Currency/') ?>" class="btn btn-danger"> Cancel</a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>