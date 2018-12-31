<?php
$ci =&get_instance();
$expenseClaimTypeDropdown  =  $ci->mcommon->Dropdown('hr_expense_claim_type', array('expense_claim_type_id as Key', 'expense_type as Value'));
?>
<form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxContentForm">
  <input type="hidden" name="expense_claim_detail_id" id="expense_claim_detail_id" value="<?php echo $expense_claim_detail_id;?>">
	<div class="row">
    	<div class="col-md-6">
            <div class="form-group">
                <label for=""><?php echo $this->lang->line('label_expense_date');?></label>
                <input class="single-daterange form-control" type="date" value="<?php echo $expense_date;?>" name="expense_date">
                <span class="help-block"><?php echo form_error('expense_date')?></span>  
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for=""><?php echo $this->lang->line('label_expense_claim_type');?></label>
                <a class="add-new-popup" onclick="">+</a>
        				<?php 
                    $attrib = 'class="form-control select-2" id="expense_claim_type_id"';
                    echo form_dropdown('expense_claim_type_id', $expenseClaimTypeDropdown, set_value('expense_claim_type_id', (isset($expense_claim_type_id)) ? $expense_claim_type_id : ''), $attrib);
                    if(form_error('expense_claim_type_id')){ echo '<span class="help-block">'.form_error('expense_claim_type_id').'</span>';}
                ?>                  
                <span class="help-block"><?php echo form_error('expense_claim_type_id')?></span>  
            </div>
        </div>
  </div>
  <div class="row">
 		<div class="col-md-6">
 			<div class="form-group">
              <label for=""><?php echo $this->lang->line('label_description');?></label>
              <input type="text" name="description" class="form-control">
              <span class="help-block"><?php echo form_error('description')?></span>  
          </div>
 		</div>
 		<div class="col-md-6">
 			<div class="form-group">
              <label for=""><?php echo $this->lang->line('label_claim_amount');?></label>
              <input type="text" name="claim_amount" class="form-control" onkeyup="loadamount();">
              <span class="help-block"><?php echo form_error('claim_amount')?></span>  
          </div>
 		</div>
  </div> 
  <div class="row">   
 		<div class="col-md-6">
 			<div class="form-group">
              <label for=""><?php echo $this->lang->line('label_sanctioned');?></label>
              <input type="text" name="sanctioned_amount" class="form-control" onkeyup="loadamount();">
              <span class="help-block"><?php echo form_error('sanctioned_amount')?></span>  
          </div>
 		</div>
  </div>
  <div class="row">
  	<div class="col-md-12">
    <div class="form-buttons-w">
		<button class="btn btn-success" type="submit" name="submit"> <?php echo $this->lang->line('label_submit');?></button>
		<a href="" class="btn btn-danger"> <?php echo $this->lang->line('label_cancel');?></a>
	</div>
</form>
