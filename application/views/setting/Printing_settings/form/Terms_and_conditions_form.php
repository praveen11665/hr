<?php
    $tc_id      =   "";
    $title      =   "";
    $terms      =   ""; 
    $disabled   =   "";
    $is_default =   "";

    if(!empty($tableData))
    {
        foreach($tableData as $row) 
        {
            $tc_id          =       $row->tc_id;
            $title          =       $row->title;
            $terms          =       $row->terms;
            $disabled       =       $row->disabled;
            $is_default     =       $row->is_default;
        }
    }
    else
    {
        $tc_id          =       $this->input->post('tc_id');
        $title          =       $this->input->post('title');
        $terms          =       $this->input->post('terms');
        $disabled       =       $this->input->post('disabled');
        $is_default     =       $this->input->post('is_default');
    }
?>
  <!-- Success/Error message print here-->
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('terms_conditions_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="tc_id" id="" value="<?php echo $tc_id; ?>"/>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_address_terms_conditions_title');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="title" id="" ng-init="title = '<?php echo $title; ?>'" value="<?php echo $title;?>" class="form-control" ng-model="title" required allow-characters/>
                    <span class="help-block" ng-show="showMsgs && myform.title.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.title.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error("title")?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_terms_conditions');?></label>
                    <span class="mandatory">*</span>
                    <textarea class="form-control" name="terms" ng-init="terms = '<?php echo $terms; ?>'" ng-model="terms" required><?php echo $terms;?></textarea>
                    <span class="help-block" ng-show="showMsgs && myform.terms.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.terms.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error("terms")?></span>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>
                    <input type="checkbox" name="disabled" ng-init="disabled = '<?php echo $disabled; ?>'"  id="" <?php if($disabled == 1){ echo 'checked = "checked"';} ?>/> <?php echo $this->lang->line('label_terms_conditions_disabled');?>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_default" ng-init="is_default = '<?php echo $is_default; ?>'" id="is_default" <?php if($is_default == 1){ echo 'checked = "checked"';} ?>/> 
                        <?php echo $this->lang->line('label_letter_head_is_default');?>
                    </label>
                </div>
            </div>
        </div>                 
        <!--Submit/Cancel Buttons-->
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('setting/Printing_settings/Terms_and_conditions/') ?>" class="btn btn-danger"> Cancel</a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>