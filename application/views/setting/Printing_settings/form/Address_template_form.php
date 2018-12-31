<?php
$ci =&get_instance();

$countryDropdown  =  $ci->mcommon->Dropdown('set_country', array('country_id as Key', 'country_name as Value'));
?>

<form action="" method="post">
	<input type="hidden" name="" id="" value="" >
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label><?php echo $this->lang->line('label_country');?></label>
                <a class="add-new-popup" onclick="addNewPop('<?php echo $formUrl;?>');">+</a>
    			<?php 
				    $attrib = 'class="form-control select2" id="country_id"';
				    echo form_dropdown('country_id', $countryDropdown, set_value('country_id', (isset($country_id)) ? $country_id : ''), $attrib);
				    if(form_error('country_id')){ echo '<span class="help-block">'.form_error('country_id').'</span>';} 
				?>
			</div>
		</div>
	</div>
    <div class="form-buttons-w">
        <button class="btn btn-success" type="submit" name="submit"> Submit</button>
        <a href="<?php echo base_url('inventory/Items_and_pricing/Item_form') ?>" class="btn btn-danger"> Cancel</a>
    </div>
</form>
