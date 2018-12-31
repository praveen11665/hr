<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_sales extends CI_Migration 
{
	public function up()
    {


    	if(!$this->db->table_exists('sales_quotation'))
	    {
	        $this->dbforge->add_field(array(
	        'quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'title' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'naming_series' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'quotation_to' => array(
	        'type' => 'text',
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'customer' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'lead' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'customer_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'company' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'transaction_date' => array(
	        'type' => 'date',
	        ),
	        'order_type' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        ));

	        $this->dbforge->add_key('quotation_id', true);
		    $this->dbforge->add_field('INDEX (customer)');
		    $this->dbforge->add_field('INDEX (lead)');
		    $this->dbforge->add_field('INDEX (company)');
		    $this->dbforge->create_table('sales_quotation', true);
    	}

    	if(!$this->db->table_exists('sales_quotation_contact'))
	    {
	        $this->dbforge->add_field(array(
	        'quotation_contact_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'customer_address' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'address_display' => array(
	        'type' => 'text',
	        ),
	        'contact_person' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'contact_display' => array(
	        'type' => 'text',
	        ),
	        'contact_mobile' => array(
	        'type' => 'text',
	        ),
	        'contact_email' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'shipping_address_name' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'shipping_address' => array(
	        'type' => 'text',
	        ),
	        'customer_group' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'territory' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        ));

	        $this->dbforge->add_key('quotation_contact_id', true);
		    $this->dbforge->add_field('INDEX (quotation_id)');
		    $this->dbforge->add_field('INDEX (customer_address)');
		    $this->dbforge->add_field('INDEX (contact_person)');
		    $this->dbforge->add_field('INDEX (shipping_address_name)');
		    $this->dbforge->add_field('INDEX (customer_group)');
		    $this->dbforge->add_field('INDEX (territory)');
		    $this->dbforge->create_table('sales_quotation_contact', true);
    	}

    	if(!$this->db->table_exists('sales_quotation_currency_price_list'))
	    {
	        $this->dbforge->add_field(array(
	        'quotation_currency_price_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'currency' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'conversion_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'selling_price_list' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'price_list_currency' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'plc_conversion_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'ignore_pricing_rule' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'base_total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'base_net_total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'net_total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        ));

	        $this->dbforge->add_key('quotation_currency_price_list_id', true);
	        $this->dbforge->add_field('INDEX (quotation_id)');
	        $this->dbforge->add_field('INDEX (price_list_currency)');
	        $this->dbforge->add_field('INDEX (selling_price_list)');
	        $this->dbforge->add_field('INDEX (currency)');
	        $this->dbforge->create_table('sales_quotation_currency_price_list', true);
    	}

    	if(!$this->db->table_exists('sales_quotation_tax'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_quotation_tax_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'taxes_and_charges' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'shipping_rule' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'other_charges_calculation' => array(
	        'type' => 'text', 
	        ),
	        'base_taxes_and_charges' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'total_taxes_and_charges' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'quo_apply_addi_disc_on_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'base_discount_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'additional_discount_percentage' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'discount_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'base_grand_total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'base_in_words' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'base_rounded_total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'grand_total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'rounded_total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'in_words' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('sales_quotation_tax_id', true);
		    $this->dbforge->add_field('INDEX (quotation_id)');
		    $this->dbforge->add_field('INDEX (taxes_and_charges)');
		    $this->dbforge->add_field('INDEX (quo_apply_addi_disc_on_id)');
		    $this->dbforge->create_table('sales_quotation_tax', true);
    	}

    	if(!$this->db->table_exists('sales_quotation_term_conditions'))
	    {
	        $this->dbforge->add_field(array(
	        'quotation_term_conditions_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'tc_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'terms' => array(
	        'type' => 'longtext', 
	        ),
	            ));

	        $this->dbforge->add_key('quotation_term_conditions_id', true);
		    $this->dbforge->add_field('INDEX (quotation_id)');
		    $this->dbforge->add_field('INDEX (tc_id)');
		    $this->dbforge->create_table('sales_quotation_term_conditions', true);
    	}

    	if(!$this->db->table_exists('sales_quotation_printing_details'))
	    {
	        $this->dbforge->add_field(array(
	        'quotation_printing_details_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'letter_head_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'select_print_heading' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'language' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('quotation_printing_details_id', true);
	        $this->dbforge->add_field('INDEX (quotation_id)');
	        $this->dbforge->add_field('INDEX (letter_head_id)');
	        $this->dbforge->add_field('INDEX (select_print_heading)');
	        $this->dbforge->create_table('sales_quotation_printing_details', true);
    	}

    	if(!$this->db->table_exists('sales_quotation_more_info'))
	    {
	        $this->dbforge->add_field(array(
	        'quotation_more_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'campaign' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'source' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'order_lost_reason' => array(
	        'type' => 'text',
	        ),
	        'quotation_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'supplier_quotation' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'opportunity' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        ));

	        $this->dbforge->add_key('quotation_more_info_id', true);
	        $this->dbforge->add_field('INDEX (quotation_id)');
	        $this->dbforge->add_field('INDEX (campaign)');
	        $this->dbforge->add_field('INDEX (source)');
	        $this->dbforge->add_field('INDEX (quotation_status_id)');
	        $this->dbforge->add_field('INDEX (supplier_quotation)');
	        $this->dbforge->add_field('INDEX (opportunity)');
	        $this->dbforge->create_table('sales_quotation_more_info', true);
    	}

    	if(!$this->db->table_exists('sales_order'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_order_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'naming_series' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'customer_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'customer_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'order_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'amended_from_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'transaction_date' => array(
	        'type' => 'date',
	        ),
	        'delivery_date' => array(
	        'type' => 'date',
	        ),
	        'po_no' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'po_date' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'tax_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        ));

	        $this->dbforge->add_key('sales_order_id', true);
	        
	        $this->dbforge->add_field('INDEX (customer_id)');
	        $this->dbforge->add_field('INDEX (order_type_id)');
	        $this->dbforge->add_field('INDEX (amended_from_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (tax_id)');
	        $this->dbforge->create_table('sales_order', true);
    	}

    	if(!$this->db->table_exists('sales_order_contact_info'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_order_contact_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'customer_address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'address_display' => array(
	        'type' => 'text',
	        ),
	        'contact_person_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'contact_display' => array(
	        'type' => 'text',
	        ),
	        'contact_mobile' => array(
	        'type' => 'text',
	        ),
	        'contact_email' => array(
	        'type' => 'text',
	        ),
	        'shipping_address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'customer_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'territory_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('sales_order_contact_info_id', true);
		    $this->dbforge->add_field('INDEX (customer_address_id)');
		    $this->dbforge->add_field('INDEX (contact_person_id)');
		    $this->dbforge->add_field('INDEX (shipping_address_id)');
		    $this->dbforge->add_field('INDEX (customer_group_id)');
		    $this->dbforge->add_field('INDEX (territory_id)');
		    $this->dbforge->create_table('sales_order_contact_info', true);
    	}

    	if(!$this->db->table_exists('sales_order_currency'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_order_currency_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'curreny_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'conversion_rate' => array(
	        'type' => 'float',
	        ),
	        'selling_price_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'price_list_currency_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'plc_conversion_rate' => array(
	        'type' => 'float',
	        ),
	        'ignore_pricing_rule' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        ));

	        $this->dbforge->add_key('sales_order_currency_id', true);
	        $this->dbforge->add_field('INDEX (curreny_id)');
	        $this->dbforge->add_field('INDEX (selling_price_list_id)');
	        $this->dbforge->add_field('INDEX (price_list_currency_id)');
	        $this->dbforge->create_table('sales_order_currency', true);
    	}

    	if(!$this->db->table_exists('sales_order_tax_charges'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_order_tax_charges_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'taxes_charges_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'shipping_rule_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        ));

	        $this->dbforge->add_key('sales_order_tax_charges_id', true);
	        $this->dbforge->add_field('INDEX (taxes_charges_id)');
	        $this->dbforge->add_field('INDEX (shipping_rule_id)');
	        $this->dbforge->create_table('sales_order_tax_charges', true);
    	}

    	if(!$this->db->table_exists('sales_order_totals'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_order_totals_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'base_grand_total' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'base_rounded_total' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'base_in_words' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'grand_total' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'rounded_total' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'in_words' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        ));

	        $this->dbforge->add_key('sales_order_totals_id', true);
	        $this->dbforge->create_table('sales_order_totals', true);
    	}

    	if(!$this->db->table_exists('sales_order_terms'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_order_terms_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'tc_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'terms' => array(
	        'type' => 'text', 
	        )
	        ));

	        $this->dbforge->add_key('sales_order_terms_id', true);
	        $this->dbforge->add_field('INDEX (tc_id)');
	        $this->dbforge->create_table('sales_order_terms', true);
    	}

    	if(!$this->db->table_exists('sales_order_more_info'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_order_more_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'project_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'campaign_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'source_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('sales_order_more_info_id', true);
	        $this->dbforge->add_field('INDEX (project_id)');
	        $this->dbforge->add_field('INDEX (campaign_id)');
	        $this->dbforge->add_field('INDEX (source_id)');
	        $this->dbforge->create_table('sales_order_more_info', true);
    	}

    	if(!$this->db->table_exists('sales_order_billing'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_order_billing_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'billing_status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        ));

	        $this->dbforge->add_key('sales_order_billing_id', true);
	        $this->dbforge->create_table('sales_order_billing', true);
    	}

    	if(!$this->db->table_exists('sales_order_commission'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_order_commission_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'sales_partner_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'commission_rate' => array(
	        'type' => 'float',
	        ),
	        'total_commission' => array(
	        'type' => 'float',
	        ),
	        ));

	        $this->dbforge->add_key('sales_order_commission_id', true);
	        $this->dbforge->add_field('INDEX (sales_partner_id)');
	        $this->dbforge->create_table('sales_order_commission', true);
    	}

    	if(!$this->db->table_exists('sales_order_sales_team'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_order_sales_team_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'sales_person_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'contribution' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'incentives' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        ));

	        $this->dbforge->add_key('sales_order_sales_team_id', true);
	        $this->dbforge->add_field('INDEX (sales_person_id)');
	        $this->dbforge->create_table('sales_order_sales_team', true);
    	}
    }
    public function down()
    {
    	$this->dbforge->drop_table('sales_quotation', true);
    	$this->dbforge->drop_table('sales_quotation_contact', true);
    	$this->dbforge->drop_table('sales_quotation_currency_price_list', true);
    	$this->dbforge->drop_table('sales_quotation_term_conditions', true);
    	$this->dbforge->drop_table('sales_quotation_tax', true);
    	$this->dbforge->drop_table('sales_quotation_printing_details', true);
    	$this->dbforge->drop_table('sales_quotation_more_info', true);
      	$this->dbforge->drop_table('sales_order', true);
    	$this->dbforge->drop_table('sales_order_contact_info', true);
    	$this->dbforge->drop_table('sales_order_currency', true);
    	$this->dbforge->drop_table('sales_order_tax_charges', true);
    	$this->dbforge->drop_table('sales_order_totals', true);
    	$this->dbforge->drop_table('sales_order_terms', true);
    	$this->dbforge->drop_table('sales_order_more_info', true);
    	$this->dbforge->drop_table('sales_order_billing', true);
    	$this->dbforge->drop_table('sales_order_commission', true);
    	$this->dbforge->drop_table('sales_order_sales_team', true);
    }
}