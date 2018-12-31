<?php
//Variable Initialization
$category_id    = "";
$category_code  = "";
$category_desc  = "";
$module_icon    = "";
 
if(!empty($tabledata))
{
    foreach ($tabledata as $row) 
    {
        $category_id   = $row->category_id;        
        $category_code = $row->category_code;
        $category_desc = $row->category_desc;
        $module_icon   = $row->module_icon;
    }
}
else
{
    $category_id   = $this->input->post('category_id');
    $category_code = $this->input->post('category_code');
    $category_desc = $this->input->post('category_desc');
    $module_icon   = $this->input->post('module_icon');
}
?>
<style type="text/css">
    .avatar i
    {
        font-size: 30px;
        color: #0073ff;
    }
    .form-check-label i
    {
        font-size: 30px;
        color: #0073ff;
        padding-left: 10px;
    }
    .form-check-label
    {
        padding:10px 30px;
        min-width: 140px;
    }
    .radio-inline
    {   
        padding:10px 30px;
        min-width: 140px;        
        font-size: 30px;
        color: #0073ff;      
    }
</style>
<div ng-app="myApp" ng-controller="myCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h6 class="element-header"><?php echo $this->lang->line('module_form_heading');?></h6>
                <div class="element-box">
                    <form action="<?php echo base_url($ActionUrl);?>" method="post" name="myform">        
                    <input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id;?>">
                        <!--<h5 class="form-header"><?php echo $this->lang->line('module_form_title');?></h5>
                        <div class="form-desc"><?php echo $this->lang->line('module_form_description');?></div>-->
                        <!--Success/Error Message-->
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
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_module_name');?></label>
                            <span class="mandatory">*</span>
                            <input type="text" name="category_code" id="category_code" value="<?php echo $category_code;?>" class="form-control" ng-model="category_code" required ng-init="category_code = '<?php echo $category_code;?>'" allow-characters maxlength="20"/>
                            <span class="help-block" ng-show="showMsgs && myform.category_code.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error('category_code')?></span>
                        </div>
                       
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_module_description');?></label><span class="mandatory">*</span>
                            <textarea name="category_desc" cols="40" rows="3" id="category_desc" class="form-control" ng-model="category_desc" required ng-init="category_desc = '<?php echo $category_desc;?>'"><?php echo $category_desc;?></textarea> 
                            <span class="help-block" ng-show="showMsgs && myform.category_desc.$error.required"><?php echo $this->lang->line('required');?></span>
                            <span class="help-block"><?php echo form_error('category_desc')?></span>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('label_module_icon');?></label>                 
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" value="os-icon os-icon-search" type="radio" <?php echo ($module_icon =='os-icon os-icon-search')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-search"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-search" type="radio" <?php echo ($module_icon =='os-icon os-icon-search')?'checked':'' ?>  name="module_icon"><i class="os-icon os-icon-search"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-right" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-right')?'checked':'' ?>  name="module_icon"><i class="os-icon os-icon-arrow-right"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-right2" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-right2')?'checked':'' ?>name="module_icon"><i class="os-icon os-icon-arrow-right2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-right3" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-right3')?'checked':'' ?>name="module_icon"><i class="os-icon os-icon-arrow-right3"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-right4" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-right4')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-right4"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-right5" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-right5')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-right5"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-left" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-left')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-left"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-left2" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-left2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-left2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-left3" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-left3')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-left3"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-left4" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-left4')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-left4"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-up" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-up')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-up"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-down" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-down')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-down"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-left5" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-left5')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-left5"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-down2" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-down2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-down2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-down3" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-down3')?'checked':'' ?>name="module_icon"><i class="os-icon os-icon-arrow-down3"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-down4" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-down4')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-down4"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-up2" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-up2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-up2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-up3" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-up3')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-up3"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-down5" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-down5')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-down5"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-up4" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-up4')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-up4"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-up5" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-up5')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-up5"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-ui-55" type="radio" <?php echo ($module_icon =='os-icon os-icon-ui-55')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-ui-55"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-mail-19" type="radio" <?php echo ($module_icon =='os-icon os-icon-mail-19')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-mail-19"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-mail-18" type="radio" <?php echo ($module_icon =='os-icon os-icon-mail-18')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-mail-18"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-grid-18" type="radio" <?php echo ($module_icon =='os-icon os-icon-grid-18')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-grid-18"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-ui-02" type="radio" <?php echo ($module_icon =='os-icon os-icon-ui-02')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-ui-02"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-ui-37" type="radio" <?php echo ($module_icon =='os-icon os-icon-ui-37')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-ui-37"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-common-07" type="radio" <?php echo ($module_icon =='os-icon os-icon-common-07')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-common-07"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-ui-54" type="radio" <?php echo ($module_icon =='os-icon os-icon-ui-54')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-ui-54"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-ui-44" type="radio" <?php echo ($module_icon =='os-icon os-icon-ui-44')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-ui-44"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-ui-15" type="radio" <?php echo ($module_icon =='os-icon os-icon-ui-15')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-ui-15"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-documents-03" type="radio" <?php echo ($module_icon =='os-icon os-icon-documents-03')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-documents-03"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-ui-92" type="radio" <?php echo ($module_icon =='os-icon os-icon-ui-92')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-ui-92"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-phone-21" type="radio" <?php echo ($module_icon =='os-icon os-icon-phone-21')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-phone-21"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-documents-07" type="radio" <?php echo ($module_icon =='os-icon os-icon-documents-07')?'checked':'' ?>name="module_icon"><i class="os-icon os-icon-documents-07"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-others-29" type="radio" <?php echo ($module_icon =='os-icon os-icon-others-29')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-others-29"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-ui-65" type="radio" <?php echo ($module_icon =='os-icon os-icon-ui-65')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-ui-65"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-ui-51" type="radio" <?php echo ($module_icon =='os-icon os-icon-ui-51')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-ui-51"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-mail-07" type="radio" <?php echo ($module_icon =='os-icon os-icon-mail-07')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-mail-07"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-mail-01" type="radio" <?php echo ($module_icon =='os-icon os-icon-mail-01')?'checked':'' ?>  name="module_icon"><i class="os-icon os-icon-mail-01"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-others-43" type="radio" <?php echo ($module_icon =='os-icon os-icon-others-43')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-others-43"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-signs-11" type="radio" <?php echo ($module_icon =='os-icon os-icon-signs-11')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-signs-11"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-coins-4" type="radio" <?php echo ($module_icon =='os-icon os-icon-coins-4')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-coins-4"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-user-male-circle2" type="radio" <?php echo ($module_icon =='os-icon os-icon-user-male-circle2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-user-male-circle2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-emoticon-smile" type="radio" <?php echo ($module_icon =='os-icon os-icon-emoticon-smile')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-emoticon-smile"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-robot-2" type="radio" <?php echo ($module_icon =='os-icon os-icon-robot-2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-robot-2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-robot-1" type="radio" <?php echo ($module_icon =='os-icon os-icon-robot-1')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-robot-1"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-crown" type="radio" <?php echo ($module_icon =='os-icon os-icon-crown')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-crown"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-cancel-circle" type="radio" <?php echo ($module_icon =='os-icon os-icon-cancel-circle')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-cancel-circle"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-cancel-square" type="radio" <?php echo ($module_icon =='os-icon os-icon-cancel-square')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-cancel-square"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-close" type="radio" <?php echo ($module_icon =='os-icon os-icon-close')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-close"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-grid-circles" type="radio" <?php echo ($module_icon =='os-icon os-icon-grid-circles')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-grid-circles"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-grid-squares-22" type="radio" <?php echo ($module_icon =='os-icon os-icon-grid-squares-22')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-grid-squares-22"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-grid-squares2" type="radio" <?php echo ($module_icon =='os-icon os-icon-grid-squares2')?'checked':'' ?>  name="module_icon"><i class="os-icon os-icon-grid-squares2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-tasks-checked" type="radio" <?php echo ($module_icon =='os-icon os-icon-tasks-checked')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-tasks-checked"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-hierarchy-structure-2" type="radio" <?php echo ($module_icon =='os-icon os-icon-hierarchy-structure-2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-hierarchy-structure-2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-agenda-1" type="radio" <?php echo ($module_icon =='os-icon os-icon-agenda-1')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-agenda-1"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-cv-2" type="radio" <?php echo ($module_icon =='os-icon os-icon-cv-2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-cv-2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-grid-squares-2" type="radio" <?php echo ($module_icon =='os-icon os-icon-grid-squares-2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-grid-squares-2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-grid-squares" type="radio" <?php echo ($module_icon =='os-icon os-icon-grid-squares')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-grid-squares"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-calendar-time" type="radio" <?php echo ($module_icon =='os-icon os-icon-calendar-time')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-calendar-time"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-twitter" type="radio" <?php echo ($module_icon =='os-icon os-icon-twitter')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-twitter"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-facebook" type="radio" <?php echo ($module_icon =='os-icon os-icon-facebook')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-facebook"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-pie-chart-2" type="radio" <?php echo ($module_icon =='os-icon os-icon-pie-chart-2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-pie-chart-2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-pie-chart-1" type="radio" <?php echo ($module_icon =='os-icon os-icon-pie-chart-1')?'checked':'' ?>name="module_icon"><i class="os-icon os-icon-pie-chart-1"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-pie-chart-3" type="radio" <?php echo ($module_icon =='os-icon os-icon-pie-chart-3')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-pie-chart-3"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-donut-chart-1" type="radio" <?php echo ($module_icon =='os-icon os-icon-donut-chart-1')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-donut-chart-1"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-bar-chart-up" type="radio" <?php echo ($module_icon =='os-icon os-icon-bar-chart-up')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-bar-chart-up"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-bar-chart-stats-up" type="radio" <?php echo ($module_icon =='os-icon os-icon-bar-chart-stats-up')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-bar-chart-stats-up"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-hamburger-menu-2" type="radio" <?php echo ($module_icon =='os-icon os-icon-hamburger-menu-2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-hamburger-menu-2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-hamburger-menu-1" type="radio" <?php echo ($module_icon =='os-icon os-icon-hamburger-menu-1')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-hamburger-menu-1"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-email-2-at" type="radio" <?php echo ($module_icon =='os-icon os-icon-email-2-at')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-email-2-at"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-email-2-at2" type="radio" <?php echo ($module_icon =='os-icon os-icon-email-2-at2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-email-2-at2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-fingerprint" type="radio" <?php echo ($module_icon =='os-icon os-icon-fingerprint')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-fingerprint"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-basic-2-259-calendar" type="radio" <?php echo ($module_icon =='os-icon os-icon-basic-2-259-calendar')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-basic-2-259-calendar"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-2-up" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-2-up')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-2-up"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-arrow-2-down" type="radio" <?php echo ($module_icon =='os-icon os-icon-arrow-2-down')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-arrow-2-down"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-bar-chart-down" type="radio" <?php echo ($module_icon =='os-icon os-icon-bar-chart-down')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-bar-chart-down"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-graph-down" type="radio" <?php echo ($module_icon =='os-icon os-icon-graph-down')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-graph-down"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-pencil-1" type="radio" <?php echo ($module_icon =='os-icon os-icon-pencil-1')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-pencil-1"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-edit-3" type="radio" <?php echo ($module_icon =='os-icon os-icon-edit-3')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-edit-3"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-edit-1" type="radio" <?php echo ($module_icon =='os-icon os-icon-edit-1')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-edit-1"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-database-remove" type="radio" <?php echo ($module_icon =='os-icon os-icon-database-remove')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-database-remove"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-pencil-2" type="radio" <?php echo ($module_icon =='os-icon os-icon-pencil-2')?'checked':'' ?>  name="module_icon"><i class="os-icon os-icon-pencil-2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-link-3" type="radio" <?php echo ($module_icon =='os-icon os-icon-link-3')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-link-3"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-email-forward" type="radio" <?php echo ($module_icon =='os-icon os-icon-email-forward')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-email-forward"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-delivery-box-2" type="radio" <?php echo ($module_icon =='os-icon os-icon-delivery-box-2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-delivery-box-2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-wallet-loaded" type="radio" <?php echo ($module_icon =='os-icon os-icon-wallet-loaded')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-wallet-loaded"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-newspaper" type="radio" <?php echo ($module_icon =='os-icon os-icon-newspaper')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-newspaper"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-window-content" type="radio" <?php echo ($module_icon =='os-icon os-icon-window-content')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-window-content"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-donut-chart-2" type="radio" <?php echo ($module_icon =='os-icon os-icon-donut-chart-2')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-donut-chart-2"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-text-input" type="radio" <?php echo ($module_icon =='os-icon os-icon-text-input')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-text-input"></i>
                                </label>
                                <label class="form-check-label">
                                        <input class="form-check-input" value="os-icon os-icon-user-male-circle" type="radio" <?php echo ($module_icon =='os-icon os-icon-user-male-circle')?'checked':'' ?> name="module_icon"><i class="os-icon os-icon-user-male-circle"></i>
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-buttons-w">
                            <button class="btn btn-success" ng-click="submited('myform')" type="submit"><?php echo $this->lang->line('label_submit');?></button>
                            <a href="<?php echo base_url('setting/modules/Modules/add'); ?>" class="btn btn-danger"><?php echo $this->lang->line('label_cancel');?></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<?php
if(isset($modules_list))
{
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h6 class="element-header">Available Modules</h6>

                    <div class="row">
                        <?php
                        foreach ($modules_list as $key => $value) 
                        {
                            ?>
                                <div class="col-md-4">
                                    <div class="pipeline-body">
                                        <div class="pipeline-item">
                                            <div class="pi-controls">
                                                <div class="pi-settings os-dropdown-trigger"><i class="os-icon os-icon-ui-46"></i>
                                                    <div class="os-dropdown">
                                                        <div class="icon-w"><i class="os-icon os-icon-ui-46"></i></div>
                                                        <ul>
                                                            <li><a href="#"><i class="os-icon os-icon-ui-49"></i><span>Edit Module</span></a></li>
                                                            
                                                            <li><a href="#"><i class="os-icon os-icon-ui-15"></i><span>Remove Module</span></a></li>
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="status status-green" data-placement="top" data-toggle="tooltip" title="" data-original-title="Active Status"></div>
                                            </div>
                                            <div class="pi-body">
                                                <div class="avatar"><i class="<?php echo $value->module_icon; ?>"></i></div>
                                                <div class="pi-info">
                                                    <div class="h6 pi-name"><?php echo ucfirst($value->category_code); ?></div>
                                                    <div class="pi-sub"><?php echo ucfirst($value->category_desc); ?></div>
                                                </div>
                                            </div>
                                            <div class="pi-foot">
                                                <a class="extra-info" href="#"><i class="os-icon os-icon-mail-12"></i><span><?php echo date('d M Y H:i:s',strtotime($value->created_at)); ?></span></a></div>
                                        </div>
                                    </div>
                                </div>
                            <?php    
                        }
                        ?>
                    </div>
            </div>
        </div>
    </div>
    <?php
}
?>-->
<!--Start List-->
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
                                        <th><?php echo lang('label_module_description');?></th>
                                        <th><?php echo lang('label_module_icon');?></th>
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
<!--End List-->