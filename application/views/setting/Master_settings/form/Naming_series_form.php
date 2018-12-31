<?php
 	$ci =&get_instance();
 	
    $namingSeriesDropdown   	=  $ci->mcommon->Dropdown('naming_transaction', array('transaction_id as Key', 'transaction as Value'));
    $prefixDropdown   			=  $ci->mcommon->Dropdown('naming_prefix', array('prefix_id as Key', 'prefix as Value'));
	$naming_series_id    		=	'';
	$transaction_id    			=	'';
    $set_options				=	'';
    $user_must_always_select	=	'';
    $prefix_id					=	'';
    $current_value				=	'';
    
if(!empty($tableData))
{
    foreach ($tableData as $row)
    {
		$naming_series_id			=   $row->naming_series_id;
	    $transaction_id 			=   $row->transaction_id;
	    $set_options 				=   $row->set_options;
	    $user_must_always_select 	=   $row->user_must_always_select;
	    $prefix_id 					=   $row->prefix_id;
	    $current_value 				=   $row->current_value;	   		
    }
}
else
{
	$naming_series_id			=   $this->input->post('naming_series_id');
    $transaction_id 			=   $this->input->post('transaction_id');
    $set_options 				=   $this->input->post('set_options');
    $user_must_always_select 	=   $this->input->post('user_must_always_select');
    $prefix_id 					=   $this->input->post('prefix_id');
    $current_value 				=   $this->input->post('current_value');   	
}
?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('naming_series_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
	<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
		<input type="hidden" name="naming_series_id" id="naming_series_id" value="<?php echo $naming_series_id;?>"/>
	    <label>Set prefix for numbering series on your transactions</label>
	    <div class="row">
	    	<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/naming_transaction', '', 'transactionData' )" >
			    <div class="form-group">
			        <label><?php echo $this->lang->line('label_select_transaction');?></label>
			        <span class="mandatory"> * </span>                                        
			            <select name="transaction_id" ng-init="transaction_id = '<?php echo $transaction_id; ?>'" ng-model="transaction_id" id="transaction_id" class="form-control"  required select2>
			                  <option value="">-- Select --</option>
			                  <option ng-repeat="transaction_id in transactionData" value="{{transaction_id.transaction_id}}">{{transaction_id.transaction}}</option>  
			            </select>
			            <span class="help-block" ng-show="showMsgs && myform.transaction_id.$error.required"><?php echo $this->lang->line('required');?></span>   
			    </div>
			</div>
			<!--<div class="col-md-6">
				<div class="form-group">
					<label><?php echo lang('label_select_transaction');?></label>
					<span class="mandatory">*</span>
					<?php 
				    $attrib = 'class="form-control select2" id="transaction_id" ng-model="transaction_id" required';
				    echo form_dropdown('transaction_id', $namingSeriesDropdown, set_value('transaction_id', (isset($transaction_id)) ? $transaction_id : ''), $attrib);
				    if(form_error('transaction_id')){ echo '<span class="help-block">'.form_error('transaction_id').'</span>';} 
					?> 
					<span class="help-block" ng-show="showMsgs && myform.transaction_id.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.transaction_id.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
				</div>
			</div>-->
			<div ng-init="setOptions = '<?php echo $set_options; ?>'">

				<!--CHECK setOptions ON NULL CHECK UNIQUE CONDITION-->
				<div ng-if="!setOptions">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo lang('label_series_list');?></label>
							<span class="mandatory">*</span>
							<textarea name="set_options" class="form-control" ng-model="set_options" ng-init="set_options = '<?php echo $set_options; ?>'" required ng-keyup="checkUnique('../../Common_controller/checkUnique/set_naming_series', set_options, 'set_options')"><?php echo $set_options;?></textarea>
							<span class="help-block" ng-show="showMsgs && myform.set_options.$error.required"><?php echo $this->lang->line('required');?></span>
							<span class="help-block" ng-show="showuniqueMsgs">{{set_options}} already in use</span>
							<span class="help-block"><?php echo form_error("set_options")?></span>
						</div>
					</div>
				</div>
				<div ng-if="setOptions">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo lang('label_series_list');?></label>
							<span class="mandatory">*</span>
							<textarea name="set_options" class="form-control" ng-model="set_options" ng-init="set_options = '<?php echo $set_options; ?>'" required readonly><?php echo $set_options;?></textarea>
							<span class="help-block" ng-show="showMsgs && myform.set_options.$error.required"><?php echo $this->lang->line('required');?></span>
							<span class="help-block"><?php echo form_error("set_options")?></span>
						</div>
					</div>
				</div>
			</div>

			<!--<div class="col-md-6">
				<div class="form-group">
					<label><?php echo lang('label_series_list');?></label>
					<span class="mandatory">*</span>
					<textarea name="set_options" class="form-control" ng-model="set_options" ng-init="set_options = '<?php echo $set_options; ?>'" required ng-keyup="checkUnique('../../Common_controller/checkUnique/set_naming_series', set_options, 'set_options')"><?php echo $set_options;?></textarea>
					<span class="help-block" ng-show="showMsgs && myform.set_options.$error.required"><?php echo $this->lang->line('required');?></span>
					<div ng-init="setOptions = '<?php echo $set_options; ?>'">
						<div ng-if="!setOptions">						
							<span class="help-block" ng-show="showuniqueMsgs">{{set_options}} already in use</span>
						</div>	
					</div>
					<span class="help-block"><?php echo form_error("set_options")?></span>
				</div>
			</div>-->
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>					
						<input type="checkbox" name="user_must_always_select"  id="user_must_always_select"  <?php echo ($user_must_always_select =='1')?'checked':'' ?>/>
						<?php echo lang('label_user_must_always_select');?>
					</label>
				</div>
			</div>
		</div>
		<!--<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<button class="btn btn-inverse"><?php echo lang('label_update');?></button>
					<span class="help-block"><?php echo form_error("update")?></span>
				</div>
			</div>
		</div>-->
	    <fieldset>
	       <legend><span><?php echo $this->lang->line('label_update_series');?></span></legend> 
	       		<label>Change the starting / current sequence number of an existing series.</label> 
	       		<div class="row">
	       			<div class="col-md-6" ng-init="loadDropdown('<?php echo base_url();?>Common_controller/loadDropdown/naming_prefix', '', 'seriesData' )" >
					    <div class="form-group">
					        <label><?php echo $this->lang->line('label_select_transaction');?></label>
					        <span class="mandatory"> * </span>                                        
					            <select name="prefix_id" ng-init="prefix_id = '<?php echo $prefix_id; ?>'" ng-model="prefix_id" id="prefix_id" class="form-control"  required select2>
					                  <option value="">-- Select --</option>
					                  <option ng-repeat="prefix_id in seriesData" value="{{prefix_id.prefix_id}}">{{prefix_id.prefix}}</option>  
					            </select>
					            <span class="help-block" ng-show="showMsgs && myform.prefix_id.$error.required"><?php echo $this->lang->line('required');?></span>   
					    </div>
					</div>
		       		<!--<div class="col-md-6">
						<div class="form-group">
							<label><?php echo lang('label_Prefix');?></label>
							<span class="mandatory">*</span>
							<?php 
						    $attrib = 'class="form-control select2" id="prefix_id" ng-model="prefix_id" required';
						    echo form_dropdown('prefix_id', $prefixDropdown, set_value('prefix_id', (isset($prefix_id)) ? $prefix_id : ''), $attrib);
						    if(form_error('prefix_id')){ echo '<span class="help-block">'.form_error('prefix_id').'</span>';} 
							?> 
							<span class="help-block" ng-show="showMsgs && myform.prefix_id.$error.required"><?php echo $this->lang->line('required');?></span>
                    		<span class="help-block" ng-show="myform.prefix_id.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
						</div>
					</div>-->
		       		<div class="col-md-6">
						<div class="form-group">
							<label><?php echo lang('label_Current_Value');?></label>
							<span class="mandatory">*</span>
							<input type="text" name="current_value" ng-init="current_value = '<?php echo $current_value; ?>'" id="current_value" value="<?php echo $current_value; ?>" class="form-control" ng-model="current_value" required onkeypress="return isNumberKey(event)"/>
							<span class="help-block" ng-show="showMsgs && myform.current_value.$error.required"><?php echo $this->lang->line('required');?></span>
                    		<span class="help-block" ng-show="myform.current_value.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
							<span class="help-block"><?php echo form_error("current_value")?></span>
						</div>
					</div>
				</div>
				<label class="pull-right">This is the number of the last created transaction with this prefix</label>
				<br>
				<!--<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button class="btn btn-inverse"><?php echo lang('label_Update_series_number');?></button>
							<span class="help-block"><?php echo form_error("")?></span>
						</div>
					</div>
				</div>-->      				
	    </fieldset>
	    <!--<div class="form-buttons-w">
			<button class="btn btn-success" type="submit" name="submit"><?php echo lang('label_submit');?></button>
	        <a href="<?php echo base_url('setting/Master_settings/Naming_series/') ?>" class="btn btn-danger"> Cancel</a>
		</div>-->
		<div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform', 'showuniqueMsgs')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
	</form>
</div>