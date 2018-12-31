<?php
$user_id          = "";
$user_profile_id  = "";
$first_name       = "";
$last_name        = "";
$username         = "";
$email            = "";
$passwd           = "";
$phone_number     = "";
$role_id          = "";
$confirm_password = "";
 
if(!empty($tabledata))
{
    foreach ($tabledata as $row) 
    {
        $user_id         = $row->user_id;
        $username        = $row->username;
        $email           = $row->email;
        $passwd          = $row->passwd;
        $role_id         = $row->auth_level;
    }
    foreach($userProfileData as $row)
    {
        $user_profile_id = $row->user_profile_id;
        $first_name      = $row->first_name;
        $last_name       = $row->last_name;
    }
    foreach ($userPhoneData as $row) 
    {
        $phone_number    = $row->phone_number;      
    }             
}
else
{
    $user_id            = $this->input->post('user_id');
    $user_profile_id    = $this->input->post('user_profile_id');
    $first_name         = $this->input->post('first_name');
    $last_name          = $this->input->post('last_name');
    $username           = $this->input->post('username');     
    $email              = $this->input->post('email');
    $passwd             = $this->input->post('passwd');
    $phone_number       = $this->input->post('phone_number');
    $role_id            = $this->input->post('role_id');
    $confirm_password   = $this->input->post('confirm_password');
}

$readonly             = ($user_id) ? 'readonly' : '';
$mandatory            = ($user_id) ? '' : '<span class="mandatory">*</span>';
$ci                   =  &get_instance();
$selectRoleDropdown   =  $ci->mcommon->Dropdown('app_roles', array('role_id as Key', 'role_name as Value'));
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('create_user_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">                          
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_first_name');?></label><span class="mandatory">*</span>
                    <input type="text" name="first_name" id="first_name" value="<?php echo $first_name;?>" class="form-control" ng-model="first_name" ng-pattern="/^[a-zA-Z\s]*$/" required ng-init="first_name = '<?php echo $first_name; ?>'" allow-characters maxlength="15"/>
                    <span class="help-block" ng-show="showMsgs && myform.first_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.first_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('first_name')?></span>
                </div>                            
            </div>
       
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_last_name');?></label><span class="mandatory">*</span>
                    <input type="text" name="last_name" id="last_name" value="<?php echo $last_name;?>" class="form-control" ng-model="last_name" ng-pattern="/^[a-zA-Z\s]*$/" required ng-init="last_name = '<?php echo $last_name; ?>'" allow-characters maxlength="15"/>
                    <span class="help-block" ng-show="showMsgs && myform.last_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.last_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error('last_name')?></span>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_email_address');?></label><span class="mandatory">*</span>
                    <input type="email" name="email" id="email" maxlength="45" value="<?php echo $email;?>" class="form-control" ng-model="email" required <?php echo $readonly;?> ng-keyup="emailUnique('../../Common_controller/checkUnique/users/1', email, 'email')" ng-init="email = '<?php echo $email; ?>'"/>
                    <span class="help-block" ng-show="showMsgs && myform.email.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.email.$error.email"><?php echo $this->lang->line('email_val');?></span>
                    <span class="help-block" ng-show="showEmailuniqueMsgs">{{email}} already in use</span>
                    <span class="help-block"><?php echo form_error('email')?></span>
                </div>  
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_mobile_number');?></label><span class="mandatory">*</span>
                    <input type="text" name="phone_number" id="phone_number" value="<?php echo $phone_number;?>" class="form-control" ng-model="phone_number" ng-pattern="/^[0-9]{10}$/" maxlength="10" required onkeypress="return isNumberKey(event)" ng-init="phone_number = '<?php echo $phone_number; ?>'"/>
                    <span class="help-block" ng-show="showMsgs && myform.phone_number.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.phone_number.$error.pattern"><?php echo $this->lang->line('mobile_val');?></span>
                    <span class="help-block"><?php echo form_error('phone_number')?></span>
                </div>  
            </div>            
        </div>
        <h5 class="form-header"><?php echo $this->lang->line('create_user_form_sub_title');?></h5>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_username');?></label><span class="mandatory">*</span>
                    <input type="text" name="username" id="username" value="<?php echo $username;?>" class="form-control" maxlength="12" ng-model="username" required <?php echo $readonly;?> ng-keyup="checkUnique('../../Common_controller/checkUnique/users/1', username, 'username')" ng-init="username = '<?php echo $username; ?>'"/>
                    <span class="help-block" ng-show="showMsgs && myform.username.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="showuniqueMsgs">{{username}} already in use</span>
                    <span class="help-block"><?php echo form_error('username')?></span>
                </div>  
            </div>

            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/app_roles','' , 'roleData' )" >
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_select_role');?></label>
                    <span class="mandatory"> * </span>                                        
                        <select name="role_id" ng-init="role_id = '<?php echo $role_id; ?>'" ng-model="role_id" id="role_id" class="form-control"  required select2>
                              <option value="">-- Select --</option>
                              <option ng-repeat="role_id in roleData" value="{{role_id.role_id}}">{{role_id.role_name}}</option>  
                        </select>
                        <span class="help-block" ng-show="showMsgs && myform.role_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                </div>
            </div>

            <!--<div class="col-md-6">
                <div class="form-group">
                    <label for=""><?php echo $this->lang->line('label_select_role');?></label><span class="mandatory">*</span>
                    <?php 
                        $attrib = 'class="form-control select2" id="role_id" ng-model="role_id" required';
                        echo form_dropdown('role_id', $selectRoleDropdown, set_value('role_id', (isset($role_id)) ? $role_id : ''), $attrib);
                        if(form_error('role_id')){ echo '<span class="help-block">'.form_error('role_id').'</span>';} 
                        ?> 
                    <span class="help-block" ng-show="showMsgs && myform.role_id.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block"><?php echo form_error('role_id')?></span>
                </div>
            </div>-->      
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_password');?></label><?php echo $mandatory;?>
                    <input type="password" name="passwd" id="passwd" maxlength="30" class="form-control" required ng-model="passwd" password-verify="{{confirm_password}}" ng-pattern="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z_@!%*./#&+-]{8,}$/" />
                    <span class="help-block" ng-show="showMsgs && myform.passwd.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.passwd.$error.pattern">
                        <?php echo $this->lang->line('password_val');?>
                    </span>
                    <span class="help-block"><?php echo form_error('passwd')?></span>
                </div>  
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_confirm_password');?></label><?php echo $mandatory;?>
                    <input type="password" name="confirm_password" maxlength="30" ng-model="confirm_password" id="confirm_password" class="form-control" required password-verify="{{passwd}}"/>
                    <span class="help-block" ng-show="showMsgs && myform.confirm_password.$error.required"><?php echo $this->lang->line('required');?></span>

                    <div class="help-block" ng-messages="myform.confirm_password.$error" ng-if=" myform.confirm_password.$dirty">
                        <p ng-message="minlength">This field is too short</p>
                        <p ng-message="maxlength">This field is too long</p>
                        <p ng-message="passwordVerify">Password do not match</span>
                    </div>
                    <span class="help-block"><?php echo form_error('confirm_password')?></span>
                </div>  
            </div> 
        </div>  

        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit"><?php echo $this->lang->line('label_submit');?></button>
            <a href="<?php echo base_url('setting/modules/Users/add'); ?>" class="btn btn-danger"><?php echo $this->lang->line('label_cancel');?></a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform', 'showEmailuniqueMsgs', 'showuniqueMsgs')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>