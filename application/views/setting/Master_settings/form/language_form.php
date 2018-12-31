<?php
$ci =&get_instance();
$LanguagecodeDropdown           =  $ci->mcommon->Dropdown('setting_language', array('language_id as Key', 'language_code as Value'), array('is_delete' => '0'));

$language_id                    = "";
$language_code                  = "";
$language_name                  = "";
$language_flag                  = "";
$language_based                 = "";

if(!empty($tableData))
{
    foreach($tableData as $row)
    {
        $language_id         = $row->language_id;
        $language_code       = $row->language_code;
        $language_name       = $row->language_name;
        $language_flag       = $row->language_flag;
        $language_based      = $row->language_based;
       
    }
}
else
{
    $language_id             = $this->input->post('language_id');
    $language_code           = $this->input->post('language_code');
    $language_name           = $this->input->post('language_name');
    $language_flag           = $this->input->post('language_flag');
    $language_based          = $this->input->post('language_based');                    
}
?>  
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Language_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
      <input type="hidden" name="language_id" id="language_id" value="<?php echo $language_id;?>"/" >
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_language_code');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" name="language_code" id="language_code" ng-init="language_code = '<?php echo $language_code; ?>'"  value="<?php echo $language_code;?>" class="form-control" ng-model="language_code" required allow-characters ng-keyup="checkUnique('../../Common_controller/checkUnique/setting_language', language_code, 'language_code')">
                    <span class="help-block" ng-show="showMsgs && myform.language_code.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="showuniqueMsgs">{{language_code}} already in use</span>
                    <span class="help-block"><?php echo form_error('language_code')?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_language_name');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" name="language_name" id="language_name" ng-init="language_name = '<?php echo $language_name; ?>'"  value="<?php echo $language_name;?>" class="form-control" ng-model="language_name" required allow-characters/>
                    <span class="help-block" ng-show="showMsgs && myform.language_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error('language_name')?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_language_flag');?></label>
                    <span class="mandatory"> * </span>
                    <input type="text" name="language_flag" id="language_flag" ng-init="language_flag = '<?php echo $language_flag; ?>'"  value="<?php echo $language_flag;?>" class="form-control" ng-model="language_flag" required allow-characters/>
                    <span class="help-block" ng-show="showMsgs && myform.language_flag.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error('language_flag')?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_language_based');?></label>
                    <?php 
                    $attrib = 'class="form-control select2" id="language_based"';
                    echo form_dropdown('language_based', $LanguagecodeDropdown, set_value('language_based', (isset($language_based)) ? $language_based : ''), $attrib);?>
                    <?PHP if(form_error('language_based')){ echo '<span class="help-block">'.form_error('language_based').'</span>';} ?>   
                </div>
            </div>
            <!--<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/setting_language', '', 'langData' )" >
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_language_based');?></label>
                    <select name="language_based" ng-init="language_based = '<?php echo $language_based; ?>'" ng-model="language_based" id="language_based" class="form-control"  required select2>
                          <option value="">-- Select --</option>
                          <option ng-repeat="language_id in langData" value="{{language_id.category_id}}">{{language_id.language_code}}</option>  
                    </select>
                </div>
            </div>-->
        </div>
        <!--<div class="row">
            <div class="col-md-6">
                <div class="form-buttons-w">
                    <button class="btn btn-success" type="submit" name="submit">Submit</button>
                    <a href="<?php echo base_url('setting/Master_settings/Language/') ?>" class="btn btn-danger"> Cancel</a>
                </div>
            </div>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform', 'showuniqueMsgs')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</body>