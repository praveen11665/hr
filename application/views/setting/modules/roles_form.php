<?php
//Variable Initialize
$role_id          = "";
$role_name        = "";
$category_id      = array();
$action_id        = array();

/*
    --Check form load for edit operation
    --If yes get the data from table and assign values to variables
*/
if(!empty($appRoleData))
{
    // Role table Data
    foreach($appRoleData as $row)
    { 
        $role_id          = $row->role_id;
        $role_name        = $row->role_name;
    }

    //Role actions table data set as array
    foreach ($appRoleActionData as $row) 
    {
        $category_id[]    = $row->category_id;
        $action_id[]      = $row->action_id;
    }

}
else
{
    $role_id          = $this->input->post('role_id');
    $role_name        = $this->input->post('role_name');
    $category_id      = $this->input->post('category_id[]');
    $action_id        = $this->input->post('action_id[]');
}

$rolesActionsArr = array();  
foreach ($actionData as $row) 
{
    $rolesActionsArr[$row->category_id][$row->action_id] = $row->action_code;  
}
?>
<style type="text/css">
    h5{
        padding: 0px 15px;
    }
</style>
<!--Heading,title,description for form-->
<div ng-app="myApp" ng-controller="myCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h6 class="element-header"><?php echo $this->lang->line('role_form_heading');?></h6>
                <div class="element-box">
                    <!--<h5 class="form-header"><?php echo $this->lang->line('role_form_title');?></h5>
                    <div class="form-desc"><?php echo $this->lang->line('role_form_description');?></div>-->
                    <!-- Success/Error message print here-->
                    <?php
                    if(isset($message))
                    {
                        ?>
                        <div class="alert alert-<?php echo $alertType;?>" id="alert-message">
                            <?php echo $message; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- Start form -->
                    <form action="<?php echo base_url($ActionUrl);?>" method="post" name="roleform">
                        <input type="hidden" name="role_id" id="role_id" value="<?php echo $role_id;?>">
                        <!--Role name with textbox -->

                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for=""><?php echo $this->lang->line('label_role_name');?></label>
                                  <span class="mandatory">*</span>
                                    <input type="text" name="role_name" ng-pattern="/^[a-zA-Z\s]*$/"  id="role_name" value="<?php echo $role_name;?>" class="form-control" ng-model="role_name" required ng-init="role_name = '<?php echo $role_name;?>'" allow-characters/>
                                    <span class="help-block" ng-show="showMsgs && roleform.role_name.$error.required"><?php echo $this->lang->line('required');?></span>
                                    <span class="help-block" ng-show="roleform.role_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                                    <span class="help-block"><?php echo form_error('role_name')?></span>
                              </div>
                          </div>
                        </div>
                        <!--Category based actions checkbox view -->
                        <?php
                        foreach ($categoryData as $row) 
                        {
                            ?>
                            <div class="row">
                                <h5> <?php echo ucwords($row->category_code);?>
                                    <label class="form-check-label"><small>
                                        <input type="checkbox" id="checkall<?php echo $row->category_id;?>" onclick="checkAllMenu('<?php echo $row->category_id;?>')" /> Check All</small>
                                    </label> 
                                </h5>
                                <hr/>                
                                <div class="form-check">
                                    <?php
                                    foreach ($rolesActionsArr[$row->category_id] as $actionID => $actionCode) 
                                    {
                                        ?>
                                            <label class="form-check-label col-md-3">
                                                <input type="checkbox" name="action_id[<?php echo $actionID;?>]" value="<?php echo $actionID;?>" class="checkbox<?php echo $row->category_id;?>" onclick="checkMenu('<?php echo $actionID; ?>');"  <?php echo (in_array($actionID, $action_id)) ? 'checked' : '';?>> <?php echo ucwords(str_replace('_', ' ', $actionCode));?>            
                                            </label>
                                            <input type="hidden" name="category_id[<?php echo $actionID;?>]" value="<?php echo $row->category_id;?>"
                                            >
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <!--Buttons for sumbit and reset-->
                        <br><hr/>
                        <div class="form-buttons-w">
                            <div class="row">
                                <div class="col-lg-12">                                
                                    <button class="btn btn-success" type="submit" name="submit" ng-click="submited('roleform')"><?php echo $this->lang->line('label_submit');?></button>
                                    <a href="<?php echo base_url();?>setting/modules/Roles/add" class="btn btn-danger"><?php echo $this->lang->line('label_cancel');?></a>
                                </div>
                            </div>                            
                        </div>
                    </form>
                    <?php
                        require_once(APPPATH."views/base/common_js.php");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End form -->
<!-- Start List -->
<?php

if(isset($listData))
{
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h6 class="element-header"><?php echo $this->lang->line('role_list_title');?></h6>
                <div class="element-box">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th><?php echo lang('label_role_name');?></th> 
                                    </tr> 
                                    <tbody></tbody>                           
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<!-- End List -->
<script type="text/javascript">
    function checkAllMenu(category_id) 
    {
       if($('#checkall'+category_id).is(':checked'))
       {
            $('.checkbox'+category_id).prop("checked", true);
       }
       else
       {
            $('.checkbox'+category_id).prop("checked", false);
       }
    }
</script>