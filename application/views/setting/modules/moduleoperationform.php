<?php
 $action_id    = "";
 $action_code  = "";
 $action_desc  = "";
 $category_id  = "";
 
if(!empty($tabledata))
{
    foreach ($tabledata as $row) 
    {
        $action_id   = $row->action_id;        
        $action_code = $row->action_code;
        $action_desc = $row->action_desc;
        $category_id = $row->category_id;
    }
}
else
{
    $action_id   = $this->input->post('action_id');
    $action_code = $this->input->post('action_code');
    $action_desc = $this->input->post('action_desc');
    $category_id = $this->input->post('category_id');
}

//$action_code  =  str_replace('_', ' ', ucwords($action_code));
?>
<style type="text/css">
    .select2 > .select2-choice.ui-select-match {
            /* Because of the inclusion of Bootstrap */
            height: 29px;
        }

        .selectize-control > .selectize-dropdown {
            top: 36px;
        }
        /* Some additional styling to demonstrate that append-to-body helps achieve the proper z-index layering. */
        .select-box {
          background: #fff;
          position: relative;
          z-index: 1;
        }
        .alert-info.positioned {
          margin-top: 1em;
          position: relative;
          z-index: 10000; /* The select2 dropdown has a z-index of 9999 */
        }

        .selectize-control {
          /* Align Selectize with input-group-btn */
          top: 2px;
        }

          .selectize-control > .selectize-dropdown {
            top: 34px;
          }

        /* Reset right rounded corners, see Bootstrap input-groups.less */
        .input-group > .selectize-control > .selectize-input {
          border-bottom-right-radius: 0;
          border-top-right-radius: 0;
        }
</style>
<div ng-app="myApp" ng-controller="myCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h6 class="element-header"><?php echo $this->lang->line('moduleoperation_form_heading');?></h6>
                <div class="element-box">
                    <?php
                        if(isset($message))
                        {
                            ?>
                            <div class="alert alert-<?php echo $alertType; ?>" id="alert-message"> 
                                <?php echo $message; ?>
                            </div>
                            <?php
                        }
                    ?>         
                    <form action="<?php echo base_url($ActionUrl);?>" method="post" name="myform">                
                    <input type="hidden" name="action_id" id="action_id" value="<?php echo $action_id;?>">
                        <!--<h5 class="form-header"><?php echo $this->lang->line('moduleoperations_form_title');?></h5>
                        <div class="form-desc"><?php echo $this->lang->line('activity_form_description');?></div>-->
                        <div class="row">
                            <!--<div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?php echo $this->lang->line('label_module');?></label><span class="mandatory">*</span>
                                    <?php
                                        $extraAttr="id='category_id' class='form-control select2' ng-model='category_id' required";
                                        echo form_dropdown('category_id', $moduleDropdown, $category_id, $extraAttr);
                                    ?>
                                   
                                    <span class="help-block" ng-show="showMsgs && myform.category_id.selected.$error.required"><?php echo $this->lang->line('required');?></span>
                                    <span class="help-block"><?php echo form_error('category_id')?></span>
                                </div>
                            </div> -->

                            <div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/acl_categories','' , 'aclCategories' )" >
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('label_module');?></label>
                                    <span class="mandatory"> * </span>                                        
                                        <select name="category_id" ng-init="category_id = '<?php echo $category_id; ?>'" ng-model="category_id" id="category_id" class="form-control"  required select2>
                                              <option value="">-- Select --</option>
                                              <option ng-repeat="category_id in aclCategories" value="{{category_id.category_id}}">{{category_id.category_code}}</option>  
                                        </select>
                                        <span class="help-block" ng-show="showMsgs && myform.category_id.$error.required"><?php echo $this->lang->line('required');?></span>   
                                </div>
                            </div>      
                       
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('label_operation_name');?></label><span class="mandatory">*</span>
                                    <input type="text" name="action_code" id="action_code" value="<?php echo $action_code;?>" class="form-control" ng-model="action_code" required ng-init="action_code = '<?php echo $action_code;?>'" ng-pattern="/^[a-zA-Z\s_]*$/" allow-characters-with-underscore maxlength="25" ng-keyup="checkUnique('../../../Common_controller/checkUnique/acl_actions/1', action_code, 'action_code')"/>
                                    <span class="help-block" ng-show="showMsgs && myform.action_code.$error.required"><?php echo $this->lang->line('required');?></span>
                                    <span class="help-block" ng-show="myform.action_code.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                                    <span class="help-block" ng-show="showuniqueMsgs">{{action_code}} already in use</span>
                                    <span class="help-block"><?php echo form_error('action_code')?></span>
                                </div>  
                            </div>
                        </div>                        
                            
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('label_action_description');?></label><span class="mandatory">*</span>
                                    <textarea name="action_desc" cols="40" rows="3" id="action_desc" class="form-control" ng-model="action_desc" required ng-init="action_desc = '<?php echo $action_desc;?>'"><?php echo $action_desc;?></textarea> 
                                    <span class="help-block" ng-show="showMsgs && myform.action_desc.$error.required"><?php echo $this->lang->line('required');?></span>
                                    <span class="help-block"><?php echo form_error('action_desc')?></span>
                                </div>
                            </div>                        
                        </div>
                        <hr>
                        <div class="form-buttons-w">
                            <button class="btn btn-success" type="submit" name="submit" ng-click="submited('myform', 'showuniqueMsgs')" ng-disabled="showuniqueMsgs"><?php echo $this->lang->line('label_submit');?></button>
                            <a href="<?php echo base_url('setting/modules/Moduleoperations/add'); ?>" class="btn btn-danger"><?php echo $this->lang->line('label_cancel');?></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($listData))
{
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h6 class="element-header"><?php echo $this->lang->line('moduleoperations_list_title');?></h6>
                <div class="element-box">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('label_action');?></th>
                                        <th><?php echo lang('label_module_name');?></th>
                                        <th><?php echo lang('label_operation_name');?></th>
                                        <th><?php echo lang('label_action_description');?></th>     
                                    </tr> 
                                    <tbody>
                                        
                                    </tbody>                           
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