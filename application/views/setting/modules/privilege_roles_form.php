<?php
//Variable Initialize
$user_id          = "";
$role_name        = "";
$category_id      = array();
$action_id        = array();

/*
    --Check form load for edit operation
    --If yes get the data from table and assign values to variables
*/
if(!empty($aclData))
{
    //Role actions table data set as array
    foreach ($aclData as $row) 
    {
        $action_id[]      = $row->action_id;
    }

}
else
{
    $user_id          = $this->input->post('user_id');
    $role_name        = $this->input->post('role_name');
    $category_id      = $this->input->post('category_id[]');
    $action_id        = $this->input->post('action_id[]');
}

$rolesActionsArr = array();  
foreach ($actionData as $row) 
{
    $rolesActionsArr[$row->category_id][$row->action_id] = $row->action_code;  
}

$userProfile = $userProfileData[0];
$user_id        =   ($user_id) ? $user_id : $userProfile->user_id;

?>
<!--Heading,title,description for form-->
<div class="row">
    <div class="col-lg-12">
        <div class="element-wrapper">
            <h6 class="element-header"><?php echo $this->lang->line('role_privilege_heading');?></h6>
            <div class="element-box">
                <h5 class="form-header"><?php echo $this->lang->line('role_privilege_title');?></h5>
                <div class="form-desc"><h6>(<?php echo $userProfile->first_name.' '.$userProfile->last_name;?>)</h6></div>
                <!-- Success/Error message print here-->
                <?php
                if(isset($message))
                {
                    ?>
                    <div class="alert alert-<?php echo $alertType;?>">
                        <?php echo $message; ?>
                    </div>
                    <?php
                }
                ?>
                <!-- Start form -->
                <form action="<?php echo base_url($actionUrl);?>" method="post">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">                    
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
                        <button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
                        <a href="<?php echo base_url();?>setting/modules/Users/add" class="btn btn-danger"><?php echo $this->lang->line('label_cancel');?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End form -->
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





    
                

