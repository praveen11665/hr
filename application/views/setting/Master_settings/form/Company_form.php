<?php
$ci =&get_instance();
$domainDropdown             =  $ci->mcommon->Dropdown('def_set_company_domain', array('company_domain_id as Key', 'domain as Value'));
$creditdaysDropdown         =  $ci->mcommon->Dropdown('def_crm_customer_credit_days_based', array('customer_credit_days_based_id as Key', 'credit_days_based_on as Value'));
$letterheadDropdown         =  $ci->mcommon->Dropdown('set_letter_head', array('letter_head_id as Key', 'letter_head_name as Value')); 
$holidaylistDropdown        =  $ci->mcommon->Dropdown('hr_holiday_list', array('holiday_list_id as Key', 'holiday_list_name as Value')); 
$termsDropdown              =  $ci->mcommon->Dropdown('set_terms_conditions', array('tc_id as Key', 'title as Value'));
$currencyDropdown           =  $ci->mcommon->Dropdown('set_currency', array('currency_id as Key', 'currency_name as Value')); 
$countryDropdown            =  $ci->mcommon->Dropdown('set_country', array('country_id as Key', 'country_name as Value')); 
$chartofaccountDropdown     =  $ci->mcommon->Dropdown('def_set_company_chart_of_accounts', array('company_chart_of_accounts_id as Key', 'chart_of_accounts as Value')); 
$existingcompanyDropdown    =  $ci->mcommon->Dropdown('set_company', array('company_id as Key', 'company_name as Value'));
$accountDropdown            =  $ci->mcommon->Dropdown('acc_account', array('account_id as Key', 'account_name as Value'));
$costcenterDropdown         =  $ci->mcommon->Dropdown('acc_cost_center', array('cost_center_id as Key', 'cost_center_name as Value'));

$company_id                                = "";
$company_name                              = "";
$abbr                                      = "";
$company_domain_id                         = "";
$letter_head_id                            = "";
$holiday_list_id                           = "";
$tc_id                                     = "";
$currency_id                               = "";
$country_id                                = "";
$company_chart_of_accounts_id              = "";
$chart_of_accounts_template_id             = "";
$existing_company                          = "";
$sales_monthly_history                     = "";
$sales_target                              = "";
$total_monthly_sales                       = "";
$default_bank_account                      = "";
$default_cash_account                      = "";
$default_receivable_account                = "";
$round_off_account                         = "";
$write_off_account                         = "";
$exchange_gain_loss_account                = "";
$default_payable_account                   = "";
$default_expense_account                   = "";
$default_income_account                    = "";
$default_payroll_payable_account           = "";
$round_off_cost_center                     = "";
$credit_limit                              = "";
$customer_credit_days_based_id             = "";
$credit_days                               = "";
$accumulated_depreciation_account          = "";
$depreciation_expense_account              = "";
$series_for_depreciation_entry             = "";
$disposal_account                          = "";
$depreciation_cost_center                  = "";
$phone_no                                  = "";
$fax                                       = "";
$email                                     = "";
$disposal_account                          = "";
$website                                   = "";
$registration_details                      = "";
$enable_perpetual_inventory                = "";
$default_inventory_account                 = "";
$stock_adjustment_account                  = "";
$stock_received_but_not_billed             = "";
$expenses_included_in_valuation            = "";

if(!empty($tableData))
{
    foreach($tableData as $row)
    {
        $company_id         = $row->company_id;
        $company_name       = $row->company_name;
        $abbr               = $row->abbr;
        $company_domain_id  = $row->company_domain_id;
        $is_default         = $row->is_default;
    }
}
else
{
    $company_id             = $this->input->post('company_id');
    $company_name           = $this->input->post('company_name');
    $abbr                   = $this->input->post('abbr');
    $company_domain_id      = $this->input->post('company_domain_id'); 
    $is_default             = $this->input->post('is_default'); 
}

if(!empty($tableData1))
{
    foreach($tableData1 as $row)
    {
        $letter_head_id                 = $row->letter_head_id;
        $holiday_list_id                = $row->holiday_list_id;
        $tc_id                          = $row->tc_id;
        $currency_id                    = $row->currency_id;
        $country_id                     = $row->country_id;
        $company_chart_of_accounts_id   = $row->company_chart_of_accounts_id;
        $existing_company               = $row->existing_company;
   }
}
else
{

    $letter_head_id                        = $this->input->post('letter_head_id');
    $holiday_list_id                       = $this->input->post('holiday_list_id');
    $tc_id                                 = $this->input->post('tc_id');
    $currency_id                           = $this->input->post('currency_id');
    $country_id                            = $this->input->post('country_id');
    $company_chart_of_accounts_id          = $this->input->post('company_chart_of_accounts_id');
    $existing_company                      = $this->input->post('existing_company');
}   

if(!empty($tableData2))
{
    foreach($tableData2 as $row)
    {
        $sales_monthly_history                 = $row->sales_monthly_history;
        $sales_target                          = $row->sales_target;
        $total_monthly_sales                   = $row->total_monthly_sales;
    }
}
else
{
    $sales_monthly_history                  = $this->input->post('sales_monthly_history');
    $sales_target                           = $this->input->post('sales_target');
    $total_monthly_sales                    = $this->input->post('total_monthly_sales');
}

if(!empty($tableData3))
{
    foreach($tableData3 as $row)
    {
        $default_bank_account                   = $row->default_bank_account;
        $default_cash_account                   = $row->default_cash_account;
        $default_receivable_account             = $row->default_receivable_account;
        $round_off_account                      = $row->round_off_account;
        $write_off_account                      = $row->write_off_account;
        $exchange_gain_loss_account             = $row->exchange_gain_loss_account;
        $default_payable_account                = $row->default_payable_account;
        $default_expense_account                = $row->default_expense_account;
        $default_income_account                 = $row->default_income_account;
        $default_payroll_payable_account        = $row->default_payroll_payable_account;
        $round_off_cost_center                  = $row->round_off_cost_center;
        $default_cost_center                    = $row->default_cost_center;
        $credit_limit                           = $row->credit_limit;
        $customer_credit_days_based_id          = $row->customer_credit_days_based_id;
        $credit_days                            = $row->credit_days;
   }
}
else
{

    $default_bank_account                    = $this->input->post('default_bank_account');
    $default_cash_account                    = $this->input->post('default_cash_account');
    $default_receivable_account              = $this->input->post('default_receivable_account');
    $tc_id                                   = $this->input->post('tc_id');
    $round_off_account                       = $this->input->post('round_off_account');
    $write_off_account                       = $this->input->post('write_off_account');
    $exchange_gain_loss_account              = $this->input->post('exchange_gain_loss_account');
    $default_payable_account                 = $this->input->post('default_payable_account');
    $default_expense_account                 = $this->input->post('default_expense_account');
    $default_income_account                  = $this->input->post('default_income_account');
    $default_payroll_payable_account         = $this->input->post('default_payroll_payable_account');
    $round_off_cost_center                   = $this->input->post('round_off_cost_center');
    $round_off_account                       = $this->input->post('round_off_account');
    $default_cost_center                     = $this->input->post('default_cost_center');
    $credit_limit                            = $this->input->post('credit_limit');
    $customer_credit_days_based_id           = $this->input->post('customer_credit_days_based_id');
    $credit_days                             = $this->input->post('credit_days');
}

if(!empty($tableData4))
{
    foreach($tableData4 as $row)
    {
        $accumulated_depreciation_account            = $row->accumulated_depreciation_account;
        $depreciation_expense_account                = $row->depreciation_expense_account;
        $series_for_depreciation_entry               = $row->series_for_depreciation_entry;
        $disposal_account                            = $row->disposal_account;
        $depreciation_cost_center                    = $row->depreciation_cost_center;

   }
}
else
{

    $accumulated_depreciation_account                 = $this->input->post('accumulated_depreciation_account');
    $depreciation_expense_account                     = $this->input->post('depreciation_expense_account');
    $series_for_depreciation_entry                    = $this->input->post('series_for_depreciation_entry');
    $disposal_account                                 = $this->input->post('disposal_account');
    $depreciation_cost_center                         = $this->input->post('depreciation_cost_center');
} 

if(!empty($tableData5))
{
    foreach($tableData5 as $row)
    {
        $phone_no               = $row->phone_no;
        $fax                    = $row->fax;
        $email                  = $row->email;
        $website                = $row->website;
        $registration_details   = $row->registration_details;

   }
}
else
{
    $phone_no                   = $this->input->post('phone_no');
    $fax                        = $this->input->post('fax');
    $email                      = $this->input->post('email');
    $website                    = $this->input->post('website');
    $registration_details       = $this->input->post('registration_details');
}  

if(!empty($tableData6))
{
    foreach($tableData6 as $row)
    {
        $enable_perpetual_inventory               = $row->enable_perpetual_inventory;
        $default_inventory_account                = $row->default_inventory_account;
        $stock_adjustment_account                 = $row->stock_adjustment_account;
        $stock_received_but_not_billed            = $row->stock_received_but_not_billed;
        $expenses_included_in_valuation           = $row->expenses_included_in_valuation;
    }
}
else
{
    $enable_perpetual_inventory                   = $this->input->post('enable_perpetual_inventory');
    $default_inventory_account                    = $this->input->post('default_inventory_account');
    $stock_adjustment_account                     = $this->input->post('stock_adjustment_account');
    $stock_received_but_not_billed                = $this->input->post('stock_received_but_not_billed');
    $expenses_included_in_valuation               = $this->input->post('expenses_included_in_valuation');
}                  

?>
<div class="modal-header">
    <button type="button" class="closepopup btn btn-danger" ng-click="$ctrl.cancel()">&times;</button>  
    <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('company_form_title');?></h4>
</div>
<div class="modal-body" id="modal-body">
    <form action="javascript:" data-action="<?php echo base_url($ActionUrl);?>" method="post" id="ajaxModelForm" name="myform">
        <input type="hidden" name="company_id" id="company_id" value="<?php echo $company_id;?>" >
        <div class="row">
        	<div class="col-md-6">
        		<div class="form-group">
        			<label><?php echo $this->lang->line('label_company');?></label>
                    <span class="mandatory">*</span>
        			<input type="text" name="company_name" class="form-control" ng-init="company_name = '<?php echo $company_name; ?>'" value="<?php echo $company_name;?>" ng-model="company_name" required allow-characters>
                    <span class="help-block" ng-show="showMsgs && myform.company_name.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.company_name.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error("company_name")?></span>
        		</div>
        	</div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_abbreviation');?></label>
                    <span class="mandatory">*</span>
                    <input type="text" name="abbr" class="form-control" ng-init="abbr = '<?php echo $abbr; ?>'" value="<?php echo $abbr;?>" ng-model="abbr" required allow-characters>
                    <span class="help-block" ng-show="showMsgs && myform.abbr.$error.required"><?php echo $this->lang->line('required');?></span>
                    <span class="help-block" ng-show="myform.abbr.$error.pattern"><?php echo $this->lang->line('alphabetic_val');?></span>
                    <span class="help-block"><?php echo form_error("abbr")?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo $this->lang->line('label_domain');?></label>
                    <?php 
                    $attrib = 'class="form-control select2" id="company_domain_id"';
                    echo form_dropdown('company_domain_id', $domainDropdown, set_value('company_domain_id', (isset($company_domain_id)) ? $company_domain_id : ''), $attrib);?>
                    <?PHP if(form_error('company_domain_id')){ echo '<span class="help-block">'.form_error('company_domain_id').'</span>';} ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_default"  value="1" <?php if ($is_default == 1) {echo 'checked = "checked"';}?>>
                        <?php echo $this->lang->line('label_letter_head_is_default');?>
                    </label>
                </div>
            </div>
        </div>
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_default_values');?></span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <?php echo $this->lang->line('label_letter_head');?>
                            <a class="add-new-popup" onclick="">+</a>
                        </label>
                        <?php 
                        $attrib = 'class="form-control select2" id="letter_head_id"';
                        echo form_dropdown('letter_head_id', $letterheadDropdown, set_value('letter_head_id', (isset($letter_head_id)) ? $letter_head_id : ''), $attrib);?>
                        <?PHP if(form_error('letter_head_id')){ echo '<span class="help-block">'.form_error('letter_head_id').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <?php echo $this->lang->line('label_terms_conditions');?>
                            <a class="add-new-popup" onclick="">+</a>    
                        </label>
                        <?php 
                        $attrib = 'class="form-control select2" id="tc_id"';
                        echo form_dropdown('tc_id', $termsDropdown, set_value('tc_id', (isset($tc_id)) ? $tc_id : ''), $attrib);?>
                        <?PHP if(form_error('tc_id')){ echo '<span class="help-block">'.form_error('tc_id').'</span>';} ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <?php echo $this->lang->line('label_holiday_list');?>
                            <a class="add-new-popup" onclick="">+</a>    
                        </label>
                        <?php 
                        $attrib = 'class="form-control select2" id="holiday_list_id"';
                        echo form_dropdown('holiday_list_id', $holidaylistDropdown, set_value('holiday_list_id', (isset($holiday_list_id)) ? $holiday_list_id : ''), $attrib);?>
                        <?PHP if(form_error('holiday_list_id')){ echo '<span class="help-block">'.form_error('holiday_list_id').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <?php echo $this->lang->line('label_currency');?>
                            <a class="add-new-popup" onclick="">+</a>
                        </label>
                        <?php 
                        $attrib = 'class="form-control select2" id="currency_id"';
                        echo form_dropdown('currency_id', $currencyDropdown, set_value('currency_id', (isset($currency_id)) ? $currency_id : ''), $attrib);?>
                        <?PHP if(form_error('currency_id')){ echo '<span class="help-block">'.form_error('currency_id').'</span>';} ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <?php echo $this->lang->line('label_country');?>
                            <a class="add-new-popup" onclick="">+</a>
                        </label>
                        <?php 
                        $attrib = 'class="form-control select2" id="country_id"';
                        echo form_dropdown('country_id', $countryDropdown, set_value('country_id', (isset($country_id)) ? $country_id : ''), $attrib);?>
                        <?PHP if(form_error('country_id')){ echo '<span class="help-block">'.form_error('country_id').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_create_chart_accounts');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="company_chart_of_accounts_id"';
                        echo form_dropdown('company_chart_of_accounts_id', $chartofaccountDropdown, set_value('company_chart_of_accounts_id', (isset($company_chart_of_accounts_id)) ? $company_chart_of_accounts_id : ''), $attrib);?>
                        <?PHP if(form_error('company_chart_of_accounts_id')){ echo '<span class="help-block">'.form_error('company_chart_of_accounts_id').'</span>';} ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_existing_company');?></label>
                        <input type="text" name="existing_company" class="form-control" ng-init="existing_company = '<?php echo $existing_company; ?>'" value ="<?php echo $existing_company;?>">
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_sales');?></span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_sales_monthly_history');?></label>
                        <textarea class="form-control" name="sales_monthly_history"><?php echo $sales_monthly_history;?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                       <label><?php echo $this->lang->line('label_sales_target');?></label>
                       <input type="text" name="sales_target" class="form-control" ng-init="sales_target = '<?php echo $sales_target; ?>'" value="<?php echo $sales_target;?>">
                   </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_total_monthly_sales');?></label>
                       <input type="text" name="total_monthly_sales" class="form-control" ng-init="total_monthly_sales = '<?php echo $total_monthly_sales; ?>'" value="<?php echo $total_monthly_sales;?>">
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_account_settings');?></span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                       <label><?php echo $this->lang->line('label_default_bank_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="default_bank_account"';
                        echo form_dropdown('default_bank_account', $accountDropdown, set_value('default_bank_account', (isset($default_bank_account)) ? $default_bank_account : ''), $attrib);?>
                        <?PHP if(form_error('default_bank_account')){ echo '<span class="help-block">'.form_error('default_bank_account').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_default_cash_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="default_cash_account"';
                        echo form_dropdown('default_cash_account', $accountDropdown, set_value('default_cash_account', (isset($default_cash_account)) ? $default_cash_account : ''), $attrib);?>
                        <?PHP if(form_error('default_cash_account')){ echo '<span class="help-block">'.form_error('default_cash_account').'</span>';} ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_default_receivable_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="default_receivable_account"';
                        echo form_dropdown('default_receivable_account', $accountDropdown, set_value('default_receivable_account', (isset($default_receivable_account)) ? $default_receivable_account : ''), $attrib);?>
                        <?PHP if(form_error('default_receivable_account')){ echo '<span class="help-block">'.form_error('default_receivable_account').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                       <label><?php echo $this->lang->line('label_round_off_account');?></label>
                       <?php 
                        $attrib = 'class="form-control select2" id="round_off_account"';
                        echo form_dropdown('round_off_account', $accountDropdown, set_value('round_off_account', (isset($round_off_account)) ? $round_off_account : ''), $attrib);?>
                        <?PHP if(form_error('round_off_account')){ echo '<span class="help-block">'.form_error('round_off_account').'</span>';} ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_write_off_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="write_off_account"';
                        echo form_dropdown('write_off_account', $accountDropdown, set_value('write_off_account', (isset($write_off_account)) ? $write_off_account : ''), $attrib);?>
                        <?PHP if(form_error('write_off_account')){ echo '<span class="help-block">'.form_error('write_off_account').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_exachange_loss_amount');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="exchange_gain_loss_account"';
                        echo form_dropdown('exchange_gain_loss_account', $accountDropdown, set_value('exchange_gain_loss_account', (isset($exchange_gain_loss_account)) ? $exchange_gain_loss_account : ''), $attrib);?>
                        <?PHP if(form_error('exchange_gain_loss_account')){ echo '<span class="help-block">'.form_error('exchange_gain_loss_account').'</span>';} ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_default_payable_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="default_payable_account"';
                        echo form_dropdown('default_payable_account', $accountDropdown, set_value('default_payable_account', (isset($default_payable_account)) ? $default_payable_account : ''), $attrib);?>
                        <?PHP if(form_error('default_payable_account')){ echo '<span class="help-block">'.form_error('default_payable_account').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_default_expense_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="default_expense_account"';
                        echo form_dropdown('default_expense_account', $accountDropdown, set_value('default_expense_account', (isset($default_expense_account)) ? $default_expense_account : ''), $attrib);?>
                        <?PHP if(form_error('default_expense_account')){ echo '<span class="help-block">'.form_error('default_expense_account').'</span>';} ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_default_income_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="default_income_account"';
                        echo form_dropdown('default_income_account', $accountDropdown, set_value('default_income_account', (isset($default_income_account)) ? $default_income_account : ''), $attrib);?>
                        <?PHP if(form_error('default_income_account')){ echo '<span class="help-block">'.form_error('default_income_account').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_default_payroll_payable_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="default_payroll_payable_account"';
                        echo form_dropdown('default_payroll_payable_account', $accountDropdown, set_value('default_payroll_payable_account', (isset($default_payroll_payable_account)) ? $default_payroll_payable_account : ''), $attrib);?>
                        <?PHP if(form_error('default_payroll_payable_account')){ echo '<span class="help-block">'.form_error('default_payroll_payable_account').'</span>';} ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_round_off_cost_center');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="round_off_cost_center"';
                        echo form_dropdown('round_off_cost_center', $costcenterDropdown, set_value('round_off_cost_center', (isset($round_off_cost_center)) ? $round_off_cost_center : ''), $attrib);?>
                        <?PHP if(form_error('round_off_cost_center')){ echo '<span class="help-block">'.form_error('round_off_cost_center').'</span>';} ?>
                    </div>
                </div>
            </div>
        </fieldset><hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_default_cost_center');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="default_cost_center"';
                        echo form_dropdown('default_cost_center', $costcenterDropdown, set_value('default_cost_center', (isset($default_cost_center)) ? $default_cost_center : ''), $attrib);?>
                        <?PHP if(form_error('default_cost_center')){ echo '<span class="help-block">'.form_error('default_cost_center').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_credit_limit');?></label>
                        <input type="text" name="credit_limit" class="form-control" value="<?php echo $credit_limit;?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_credit_days_based_on');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="customer_credit_days_based_id"';
                        echo form_dropdown('customer_credit_days_based_id', $creditdaysDropdown, set_value('customer_credit_days_based_id', (isset($customer_credit_days_based_id)) ? $customer_credit_days_based_id : ''), $attrib);?>
                        <?PHP if(form_error('customer_credit_days_based_id')){ echo '<span class="help-block">'.form_error('customer_credit_days_based_id').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_credit_days');?></label>
                        <input type="text" name="credit_days" class="form-control" value="<?php echo $credit_days;?>">
                    </div>
                </div>
            </div>
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_stock_settings');?></span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="enable_perpetual_inventory" ng-init="enable_perpetual_inventory = '<?php echo $enable_perpetual_inventory; ?>'"  value="1" <?php if ($enable_perpetual_inventory == 1) {echo 'checked = "checked"';}?>>
                            <?php echo $this->lang->line('label_enable_perpetual_inventory');?>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_default_inventory_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="default_inventory_account"';
                        echo form_dropdown('default_inventory_account', $accountDropdown, set_value('default_inventory_account', (isset($default_inventory_account)) ? $default_inventory_account : ''), $attrib);?>
                        <?PHP if(form_error('default_inventory_account')){ echo '<span class="help-block">'.form_error('default_inventory_account').'</span>';} ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_stock_adjustment_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="stock_adjustment_account"';
                        echo form_dropdown('stock_adjustment_account', $accountDropdown, set_value('stock_adjustment_account', (isset($stock_adjustment_account)) ? $stock_adjustment_account : ''), $attrib);?>
                        <?PHP if(form_error('stock_adjustment_account')){ echo '<span class="help-block">'.form_error('stock_adjustment_account').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_stock_received_but_not_billed');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="stock_received_but_not_billed"';
                        echo form_dropdown('stock_received_but_not_billed', $accountDropdown, set_value('stock_received_but_not_billed', (isset($stock_received_but_not_billed)) ? $stock_received_but_not_billed : ''), $attrib);?>
                        <?PHP if(form_error('stock_received_but_not_billed')){ echo '<span class="help-block">'.form_error('stock_received_but_not_billed').'</span>';} ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_expenses_included_in_valuation');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="expenses_included_in_valuation"';
                        echo form_dropdown('expenses_included_in_valuation', $accountDropdown, set_value('expenses_included_in_valuation', (isset($expenses_included_in_valuation)) ? $expenses_included_in_valuation : ''), $attrib);?>
                        <?PHP if(form_error('expenses_included_in_valuation')){ echo '<span class="help-block">'.form_error('expenses_included_in_valuation').'</span>';} ?>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_fixed_asset_depreciation');?></span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                       <label><?php echo $this->lang->line('label_accumulated_dpreciation_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="accumulated_depreciation_account"';
                        echo form_dropdown('accumulated_depreciation_account', $accountDropdown, set_value('accumulated_depreciation_account', (isset($accumulated_depreciation_account)) ? $accumulated_depreciation_account : ''), $attrib);?>
                        <?PHP if(form_error('accumulated_depreciation_account')){ echo '<span class="help-block">'.form_error('accumulated_depreciation_account').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_depreciation_expense_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="depreciation_expense_account"';
                        echo form_dropdown('depreciation_expense_account', $accountDropdown, set_value('depreciation_expense_account', (isset($depreciation_expense_account)) ? $depreciation_expense_account : ''), $attrib);?>
                        <?PHP if(form_error('depreciation_expense_account')){ echo '<span class="help-block">'.form_error('depreciation_expense_account').'</span>';} ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                       <label><?php echo $this->lang->line('label_series_asset_depreciation');?></label>
                       <input type="text" name="series_for_depreciation_entry" class="form-control" ng-init="series_for_depreciation_entry = '<?php echo $series_for_depreciation_entry; ?>'" value="<?php echo $series_for_depreciation_entry;?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_gain_loss_account');?></label>
                        <?php 
                        $attrib = 'class="form-control select2" id="disposal_account"';
                        echo form_dropdown('disposal_account', $accountDropdown, set_value('disposal_account', (isset($disposal_account)) ? $disposal_account : ''), $attrib);?>
                        <?PHP if(form_error('disposal_account')){ echo '<span class="help-block">'.form_error('disposal_account').'</span>';} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                       <label><?php echo $this->lang->line('label_asset_depreciation_cost_center');?></label>
                       <?php 
                        $attrib = 'class="form-control select2" id="depreciation_cost_center"';
                        echo form_dropdown('depreciation_cost_center', $costcenterDropdown, set_value('depreciation_cost_center', (isset($depreciation_cost_center)) ? $depreciation_cost_center : ''), $attrib);?>
                        <?PHP if(form_error('depreciation_cost_center')){ echo '<span class="help-block">'.form_error('depreciation_cost_center').'</span>';} ?>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_company_information');?></span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                       <label><?php echo $this->lang->line('label_phone_number');?></label>
                       <input type="text" name="phone_no" class="form-control" ng-model="phone_no" ng-init="phone_no = '<?php echo $phone_no; ?>'" value="<?php echo $phone_no;?>" ng-pattern="/^[0-9]{10}$/" maxlength="10" onkeypress="return isNumberKey(event)">
                       <span class="help-block" ng-show="myform.phone_no.$error.pattern"><?php echo $this->lang->line('mobile_val');?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_email_id');?></label>
                        <input type="email" name="email" class="form-control" ng-init="email = '<?php echo $email; ?>'" value="<?php echo $email;?>" ng-model="email">
                        <span class="help-block" ng-show="myform.email.$error.email"><?php echo $this->lang->line('email_val');?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                       <label><?php echo $this->lang->line('label_fax');?></label>
                       <input type="text" name="fax" class="form-control" ng-init="fax = '<?php echo $fax; ?>'" value="<?php echo $fax;?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_website');?></label>
                        <input type="text" name="website" class="form-control" ng-init="website = '<?php echo $website; ?>'" value="<?php echo $website;?>" ng-model="website" ng-pattern="/^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/">
                        <span class="help-block" ng-show="myform.website.$error.pattern"><?php echo $this->lang->line('url_val');?></span>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend><span><?php echo $this->lang->line('label_registration_info');?></span></legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo $this->lang->line('label_registration_details');?></label>
                        <input type="text" name="registration_details" class="form-control" ng-init="registration_details = '<?php echo $registration_details; ?>'" value="<?php echo $registration_details;?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="btn btn-inverse"><?php echo $this->lang->line('label_delete_company_transaction');?></a>
                    </div>
                </div>
            </div>
        </fieldset>
        <!--<div class="form-buttons-w">
            <button class="btn btn-success" type="submit" name="submit">Submit</button>
            <a href="<?php echo base_url('setting/Master_settings/Company/') ?>" class="btn btn-danger"> Cancel</a>
        </div>-->
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" ng-click="$ctrl.cancel()"><?php echo $this->lang->line('label_cancel');?></button>
            <button class="btn btn-primary" type="submit" ng-click="$ctrl.submit_form('myform')"><?php echo $this->lang->line('label_submit');?></button>
        </div>
    </form>
</div>