<?php
$CI =& get_instance();
$countryDropdown    =  $CI->mcommon->Dropdown('set_country', array('country_id as Key', 'country_name as Value'));

$user_id            =   $this->auth_user_id;
$Where_array        =   array('user_id'=> $user_id);
$UserData           =   $this->mcommon->records_all('users', $Where_array);
$UserprofileData    =   $this->mcommon->records_all('user_profile', $Where_array);
$UseraddressData    =   $this->mcommon->records_all('user_address', $Where_array);
$UserphoneData      =   $this->mcommon->records_all('user_phone', $Where_array);

foreach ($UserData as $row) 
{
    $user_id    =   $row->user_id;
    $username   =   $row->username;
    $email      =   $row->email;
}
foreach ($UserprofileData as $row) 
{
    $first_name     =   $row->first_name;
    $last_name      =   $row->last_name;
}
foreach ($UseraddressData as $row) 
{
    $address_line_1    =   $row->address_line_1;
    $address_line_2    =   $row->address_line_2;
    $city              =   $row->city;
    $state             =   $row->state;
    $country_id        =   $row->country_id;
    $pincode           =   $row->pincode;
}

foreach ($UserphoneData as $row) 
{
    $phone_number     =   $row->phone_number;
}
?>
 <!--Argon CSS-->
<link href="<?php echo base_url(); ?>global/assets/css/argon.css?v=1.0.0" rel="stylesheet">

<!-- Main content -->
<div ng-app="myApp" ng-controller="myCtrl">
    <div class="main-content">
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 50px; background-size: cover; background-position: center top;">
            <!-- Mask -->
            <span class="mask bg-gradient-default opacity-8"></span>
            <!-- Header container -->
            <div class="container-fluid d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <h1 class="display text-white">Hello, <?php echo $first_name." ".$last_name;?></h1>
                        <p class="text-white mt-0 mb-12">This is your profile page. You can change your details and login credentials</p>
                     </div>
                </div>
            </div>
        </div>

        <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-hex border-0">
                          <div class="row align-items-center">
                            <div class="col-8">
                              <h3 class="mb-0">My Profile</h3>
                            </div>
                          </div>
                        </div>
                        <div class="card-body bg-white">
                            <form action="<?php echo base_url($ActionUrl);?>" method="post" >
                                <input type="hidden" name="user_id"  id="user_id" value="<?php echo $user_id;?>">
                                <?php 
                                    if($this->session->flashdata('msg') != '')
                                    {
                                        ?>
                                            <div class="alert alert-<?php echo $this->session->flashdata('alertType');?>" id="alert-message">
                                                <?php echo $this->session->flashdata('msg'); ?>
                                            </div>
                                        <?php
                                    } 
                                ?>
                                <div class="pl-lg-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('label_first_name');?></label><span class="mandatory">*</span>         
                                                <input type="text" class="form-control form-control-alternative" id="first_name" name="first_name" value="<?php echo $first_name;?>" allow-characters>
                                                <span class="help-block"><?php echo form_error('first_name')?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('label_last_name');?></label><span class="mandatory">*</span>         
                                                <input type="text" class="form-control form-control-alternative" id="last_name" name="last_name" value="<?php echo $last_name;?>" allow-characters>
                                                <span class="help-block"><?php echo form_error('last_name')?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('label_email_address');?></label>     
                                                <input type="text" class="form-control form-control-alternative" id="email" name="email" value="<?php echo $email;?>" readonly>
                                                <span class="help-block"><?php echo form_error('email')?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label ><?php echo $this->lang->line('label_mobile_number');?></label><span class="mandatory">*</span>         
                                                <input type="text" class="form-control form-control-alternative" id="phone_number" name="phone_number" value="<?php echo $phone_number;?>"  onkeypress="return isNumberKey(event)" maxlength="10">
                                                <span class="help-block"><?php echo form_error('phone_number')?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <!-- Address -->
                                    <h6 class="heading-small text-muted mb-4"><?php echo $this->lang->line('label_address_details');?></h6>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo $this->lang->line('label_address_line_1');?></label><span class="mandatory">*</span>
                                                <textarea class="form-control form-control-alternative" id="address_line_1" name="address_line_1" rows="3" cols="200"><?php echo $address_line_1;?></textarea> 
                                                <span class="help-block"><?php echo form_error('address_line_1')?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo $this->lang->line('label_address_line_2');?></label><span class="mandatory">*</span>
                                                <textarea class="form-control form-control-alternative" id="address_line_2" name="address_line_2" rows="3" cols="200"><?php echo $address_line_2;?></textarea> 
                                                <span class="help-block"><?php echo form_error('address_line_2')?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('label_city');?></label><span class="mandatory">*</span>
                                                <input type="text" name="city" id="city" class="form-control form-control-alternative" value="<?php echo $city;?>" allow-characters/>
                                                <span class="help-block"><?php echo form_error('city')?></span>
                                            </div>  
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('label_state');?></label><span class="mandatory">*</span>
                                                <input type="text" name="state" id="state" class="form-control form-control-alternative" value="<?php echo $state;?>" allow-characters/>
                                                <span class="help-block"><?php echo form_error('state')?></span>
                                            </div>  
                                        </div> 
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('label_country');?></label><span class="mandatory">*</span>
                                                <?php 
                                                    $attrib = 'class="form-control form-control-alternative select2" id="country_id" ';
                                                    echo form_dropdown('country_id', $countryDropdown, set_value('country_id', (isset($country_id)) ? $country_id : ''), $attrib);
                                                    if(form_error('country_id')){ echo '<span class="help-block">'.form_error('country_id').'</span>';}
                                                ?>
                                            </div>  
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('label_pincode');?></label><span class="mandatory">*</span>
                                                <input type="text" name="pincode" id="pincode" class="form-control form-control-alternative" value="<?php echo $pincode;?>" onkeypress="return isNumberKey(event)" maxlength="6"/>
                                                <span class="help-block"><?php echo form_error('pincode')?></span>
                                            </div>  
                                        </div> 
                                    </div> 

                                    <hr class="my-4" />
                                    <!-- Login Details -->
                                    <h6 class="heading-small text-muted mb-4"><?php echo $this->lang->line('label_login_details');?></h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('label_username');?></label>
                                                <input type="text" name="username" id="username" class="form-control form-control-alternative" value="<?php echo $username;?>" readonly allow-characters/>
                                                <span class="help-block"><?php echo form_error('username')?></span>
                                            </div>  
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('label_password');?></label>
                                                <input type="password" name="passwd" id="passwd" class="form-control form-control-alternative" />
                                                <span class="help-block"><?php echo form_error('passwd')?></span>
                                            </div>  
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('label_confirm_password');?></label>
                                                <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-alternative" />
                                                <span class="help-block"><?php echo form_error('confirm_password')?></span>
                                            </div>  
                                        </div> 
                                    </div>   
                                    <hr>
                                    <!--Submit/Cancel Buttons-->
                                    <div class="form-buttons-w text-right">
                                        <a href="<?php echo base_url('setting/modules/users/myProfile'); ?>" class="btn btn-danger"><?php echo $this->lang->line('label_cancel');?></a>
                                        <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
                                    </div>
                                    <div class="pl-lg-4">
                                      <div class="form-group">
                                      </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require_once(APPPATH."views/base/common_js.php");
?>