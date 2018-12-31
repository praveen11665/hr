<?php
$letter_head_id             =   "";
$letter_head_name           =   "";
$is_disabled                =   "";
$is_default                 =   "";
$letter_head_content        =   "";
$letter_head_footer         =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row )
    {
        $letter_head_id      =   $row->letter_head_id;
        $letter_head_name    =   $row->letter_head_name;
        $is_disabled         =   $row->is_disabled;
        $is_default          =   $row->is_default;
        $letter_head_content =   $row->letter_head_content;
        $letter_head_footer  =   $row->letter_head_footer;       
    }
}
else
{
    $letter_head_id         =   $this->input->post('letter_head_id');
    $letter_head_name       =   $this->input->post('letter_head_name');
    $is_disabled            =   $this->input->post('is_disabled');
    $is_default             =   $this->input->post('is_default');
    $letter_head_content    =   $this->input->post('letter_head_content');
    $letter_head_footer     =   $this->input->post('letter_head_footer'); 
}
?>
<!-- Success/Error message print here-->
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('letter_head_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
    	<input type="hidden" name="letter_head_id" id="letter_head_id" value="<?php echo $letter_head_id;?>" >
    	<div class="row">
    		<div class="col-md-6">
    			<div class="form-group">
    				<label><?php echo $this->lang->line('label_letter_head_name');?></label>
                    <span class="mandatory">*</span>
    				<input type="text" name="letter_head_name" id="letter_head_name" ng-init="letter_head_name = '<?php echo $letter_head_name; ?>'" value="<?php echo $letter_head_name;?>" class="form-control" ng-model="letter_head_name" required allow-characters>
                    <span class="help-block" ng-show="showMsgs && myform.letter_head_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.letter_head_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('letter_head_name')?></span>
    			</div>
    		</div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_letter_head_header');?></label>
                    <span class="mandatory">*</span>
                    <textarea class="form-control" name="letter_head_content" ng-init="letter_head_content = '<?php echo $letter_head_content; ?>'" id="letter_head_content" ng-model="letter_head_content" required > <?php echo $letter_head_content;?></textarea>
                    <span class="help-block" ng-show="showMsgs && myform.letter_head_content.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.letter_head_content.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('letter_head_content')?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_letter_head_footer');?></label>
                    <span class="mandatory">*</span>
                    <textarea class="form-control" name="letter_head_footer" ng-init="letter_head_footer = '<?php echo $letter_head_footer; ?>'" id="letter_head_footer" ng-model="letter_head_footer" required> <?php echo $letter_head_footer ;?></textarea>
                    <span class="help-block" ng-show="showMsgs && myform.letter_head_footer.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.letter_head_footer.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('letter_head_footer')?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"><br><br>
                            <label>                   
                                <input type="checkbox" name="is_disabled" ng-init="is_disabled = '<?php echo $is_disabled; ?>'" id="is_disabled" <?php if($is_disabled == 1){ echo 'checked = "checked"';} ?>/> 
                                <?php echo $this->lang->line('label_currency_enabled');?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><br><br>
                            <label>
                                <input type="checkbox" name="is_default" ng-init="is_default = '<?php echo $is_default; ?>'" id="is_default" <?php if($is_default == 1){ echo 'checked = "checked"';} ?>/> 
                                <?php echo $this->lang->line('label_letter_head_is_default');?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>            
        </div>   
        <!--Submit/Cancel Buttons-->
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('setting/Printing_settings/letter_head/') ?>" class="btn btn-danger"> Cancel</a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>