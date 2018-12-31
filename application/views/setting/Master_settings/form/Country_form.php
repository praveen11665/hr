<?php
	$country_id		=	'';
    $country_name	=	'';
    $date_formate	=	'';
    $time_zones		=	'';
    $code			=	'';

if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
        $country_id		=	$row->country_id;
	    $country_name	=	$row->country_name;
	    $date_formate	=	$row->date_formate;
	    $time_zones		=	$row->time_zones;
	    $code			=	$row->code;
    }
}
else
{
    $country_id		=	$this->input->post('country_id');
    $country_name	=	$this->input->post('country_name');
    $date_formate	=	$this->input->post('date_formate');
    $time_zones		=	$this->input->post('time_zones');
    $code			=	$this->input->post('code');    
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('country_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
	<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
		<input type="hidden" name="country_id" id="country_id" value="<?php echo $country_id; ?>"/>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo $this->lang->line('country_form_title');?>
					<span class="mandatory">*</span>
					</label>
					<input type="text" name="country_name" id="country_name" ng-init="country_name = '<?php echo $country_name; ?>'" value="<?php echo $country_name;?>" class="form-control" ng-model="country_name" required allow-characters>
					<span class="help-block" ng-show="showMsgs && myform.country_name.$error.required"><?php echo $this->lang->line('required');?></span>
					<span class="help-block"><?php echo form_error("country_name")?></span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo $this->lang->line('label_date_format');?>
						<span class="mandatory">*</span>
					</label>
					<input type="text" name="date_formate" id="date_formate" ng-init="date_formate = '<?php echo $date_formate; ?>'" value="<?php echo $date_formate;?>" class="form-control" ng-model="date_formate" required>
					<span class="help-block" ng-show="showMsgs && myform.date_formate.$error.required"><?php echo $this->lang->line('required');?></span>
					<span class="help-block"><?php echo form_error("date_formate")?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo $this->lang->line('label_time_zone');?>
						<span class="mandatory">*</span>
					</label>
					<input type="text" name="time_zones" id="time_zones" ng-init="time_zones = '<?php echo $time_zones; ?>'" value="<?php echo $time_zones;?>" class="form-control" ng-model="time_zones" required>
					<span class="help-block" ng-show="showMsgs && myform.time_zones.$error.required"><?php echo $this->lang->line('required');?></span>
					<span class="help-block"><?php echo form_error("time_zones")?></span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo $this->lang->line('label_code');?>
						<span class="mandatory">*</span>
					</label>
					<input type="text" name="code" id="code" ng-init="code = '<?php echo $code; ?>'" value="<?php echo $code;?>" class="form-control" ng-model="code" required allow-characters>
					<span class="help-block" ng-show="showMsgs && myform.code.$error.required"><?php echo $this->lang->line('required');?></span>
					<span class="help-block"><?php echo form_error("code")?></span>
				</div>
			</div>
		</div>
	    <!--<div class="form-buttons-w">
	        <button class="btn btn-success" type="submit" name="submit"><?php echo $this->lang->line('label_submit');?></button>
	        <a href="<?php echo base_url('setting/Master_settings/Country/') ?>" class="btn btn-danger"> Cancel</a>
	    </div>-->
	    <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
	</form>
</div>