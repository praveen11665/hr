<style>
  .full button span {
    background-color: limegreen;
    border-radius: 32px;
    color: black;
  }
  .partially button span {
    background-color: orange;
    border-radius: 32px;
    color: black;
  }
</style>
<?php
$ci =&get_instance();
$companyDropdown  =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'), array('is_delete' => 0));
if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $trainer_id             =  $row->trainer_id;
        $trainer_name           =  $row->trainer_name;
        $trainer_email          =  $row->trainer_email;
        $trainer_contact        =  $row->trainer_contact;
        $company_id             =  $row->company_id;
        $trainer_profile        =  $row->trainer_profile;
    }
}
else
{
    $trainer_id                 =   $this->input->post('trainer_id');
    $trainer_name               =   $this->input->post('trainer_name');
    $trainer_email              =   $this->input->post('trainer_email');
    $trainer_contact            =   $this->input->post('trainer_contact');
    $company_id                 =   $this->input->post('company_id');
    $trainer_profile            =   $this->input->post('trainer_profile');
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('Trainer_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelFormWithFile" enctype="multipart/form-data" name="myform">
        <input type="hidden" name="trainer_id" id="trainer_id" value="<?php echo $trainer_id; ?>" ng-model="trainer_id" />
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_trainer_name');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="trainer_name" id="trainer_name" maxlength="20" ng-init="trainer_name = '<?php echo $trainer_name; ?>'" value="<?php echo$trainer_name; ?>" class="form-control" ng-model="trainer_name" ng-pattern="/^[a-zA-Z\s]*$/" required allow-characters required/>
                    <span class="help-block" ng-show="showMsgs && myform.trainer_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.trainer_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('trainer_name')?></span>
                </div>
            </div>    
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_trainer_mail');?></label>          
                    <span class="mandatory">*</span>
                    <input type="email" name="trainer_email" id="trainer_email" maxlength="25" ng-init="trainer_email = '<?php echo $trainer_email; ?>'" value="<?php echo$trainer_email; ?>" class="form-control" ng-model="trainer_email" ng-keyup="emailUnique('../../Common_controller/emailUnique/hr_trainer', trainer_email, 'trainer_email')" required/>
                    <span class="help-block" ng-show="showMsgs && myform.trainer_email.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.trainer_email.$error.email">Please enter valid email</span>
                    <span class="help-block" ng-show="showEmailuniqueMsgs">{{trainer_email}} already in use</span>
                    <span class="help-block"><?php echo form_error('trainer_email')?></span>
                </div>
            </div>  
        </div>  
        <div class="row">  
            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/set_company',<?php echo htmlspecialchars(json_encode(array('is_delete' => 0))); ?> , 'companies' )">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_trainer_company');?> </label>
                    <span class="mandatory">*</span>
                    <!--<?php 
                        $attrib = 'class="form-control select2" id="company_id" ng-model="company_id" required ';
                        echo form_dropdown('company_id', $companyDropdown, set_value('company_id', (isset($company_id)) ? $company_id : ''), $attrib);?>
                        <span class="help-block" ng-show="showMsgs && myform.company_id.$error.required"><?php echo $this->lang->line('required');?></span>
                        <?PHP if(form_error('company_id')){ echo '<span class="help-block">'.form_error('company_id').'</span>';} ?>-->
                    <select name="company_id" ng-init="company_id = '<?php echo $company_id; ?>'" ng-model="company_id" id="company_id" class="form-control" required select2>
                        <option value="">-- Select --</option>  
                        <option ng-repeat="company_id in companies" value="{{company_id.company_id}}">{{company_id.company_name}}</option>  
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label><?php echo $this->lang->line('label_trainer_contact_no');?> </label>          
                <span class="mandatory">*</span>
                <input type="text" name="trainer_contact" id="trainer_contact" ng-init="trainer_contact = '<?php echo $trainer_contact; ?>'" value="<?php echo$trainer_contact;?>" class="form-control" maxlength="10" ng-model="trainer_contact" ng-pattern="/^[0-9]{10}$/" maxlength="10" onkeypress="return isNumberKey(event)" ng-keyup="checkUnique('../../Common_controller/checkUnique/hr_trainer', trainer_contact, 'trainer_contact')" required/>
                <span class="help-block" ng-show="myform.trainer_contact.$error.pattern">Only 10 Digit Numbers Allowed</span>
                <span class="help-block" ng-show="showMsgs && myform.trainer_contact.$error.required"><?php echo $this->lang->line('required');?></span>
                <span class="help-block" ng-show="showuniqueMsgs">{{trainer_contact}} already in use</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_trainer_profile');?> </label>          
                    <input type="file" name="trainer_profile" id="trainer_profile" ng-model="trainer_profile" ng-init="trainer_profile = '<?php echo $trainer_profile; ?>'" value="<?php echo$trainer_profile;?>" class="form-control" valid-file/>
                    <div ng-messages="myform.trainer_profile.$error" ng-if="myform.trainer_profile.$touched">
                        <span class="help-block" ng-message="extension">Upload Image Files Only</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <?php 
            if($trainer_profile != '')
            {
            ?>
                <div class="form-group">
                <img src="<?php echo base_url().''.$trainer_profile;?>" width="100" height="150" />          
                </div>
            <?php
            }
            ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <?php
                if($trainer_profile != '')
                    {
                    ?>
                    <input type="hidden" name="trainer_profile_update" value="<?php echo $trainer_profile;?>" />
                <?php
                    }
            ?>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform', 'showEmailuniqueMsgs', 'showuniqueMsgs')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>