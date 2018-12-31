<?php
//Variable Initialize
$standard_reply_id   				=   "";
$standard_reply_name            	=   "";
$standard_reply_subject             =   "";
$standard_reply_message             =   "";
$standard_reply_status              =   "";

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $standard_reply_id                  =  $row->standard_reply_id; 
        $standard_reply_status   			=  $row->standard_reply_status;
        $standard_reply_name            	=  $row->standard_reply_name;
        $standard_reply_subject             =  $row->standard_reply_subject;
        $standard_reply_message            =  $row->standard_reply_message;
    }    
}
else
{
    $standard_reply_id       			    =   $this->input->post('standard_reply_id');
    $standard_reply_name              	    =   $this->input->post('standard_reply_name');
    $standard_reply_subject  	            =   $this->input->post('standard_reply_subject'); 
    $standard_reply_status                  =   $this->input->post('standard_reply_status');  
    $standard_reply_message                 =   $this->input->post('standard_reply_message');
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('standard_reply_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
    	<input type="hidden" name="standard_reply_id" id="" value="<?php echo $standard_reply_id;?>" >
    	<div class="row">
    		<div class="col-md-6">
    			<div class="form-group">
    				<label><?php echo $this->lang->line('label_standard_reply_name');?></label>
                    <span class="mandatory"> * </span>
    				<input type="text" name="standard_reply_name" ng-model="standard_reply_name" ng-init="standard_reply_name = '<?php echo $standard_reply_name; ?>'" value="<?php echo $standard_reply_name;?>" class="form-control" required allow-characters>
                    <span class="help-block" ng-show="showMsgs && myform.standard_reply_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.standard_reply_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error("standard_reply_name")?></span>
    			</div>
    		</div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_standard_reply_subject');?></label>
                    <input type="text" name="standard_reply_subject" class="form-control" id="standard_reply_subject" ng-init="standard_reply_subject = '<?php echo $standard_reply_subject; ?>'"  value="<?php echo $standard_reply_subject;?>" allow-characters/>
                </div>
            </div>
    	</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_standatrd_reply_message');?></label>
                    <textarea name="standard_reply_message" id="standard_reply_message" class="form-control"><?php echo $standard_reply_message;?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>                    
                        <input type="checkbox" name="standard_reply_status"  id="standard_reply_status" <?php if($standard_reply_status == 1){ echo 'checked = "checked"';} ?> />
                        <?php echo $this->lang->line('label_standard_reply_status');?>
                    </label>
                </div>
            </div>
        </div>
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit">Submit</button>
            <a href="<?php echo base_url('setting/Master_settings/standard_reply/') ?>" class="btn btn-danger"> Cancel</a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>