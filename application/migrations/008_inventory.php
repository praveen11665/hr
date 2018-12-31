<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_inventory extends CI_Migration 
{
  
    public function up()
    {
    	if(!$this->db->table_exists('inv_delivery_note'))
	    {
	        $this->dbforge->add_field(array(
	        'delivery_note_id' => array(
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
	        'unsigned' => true,
	        ),
	        'customer_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'posting_date' => array(
	        'type' => 'date',
	        ),
	        'posting_time' => array(
	        'type' => 'time',
	        ),
	        'set_posting_time' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'po_no' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'po_date' => array(
	        'type' => 'date',
	        ),
	        'is_return' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        ));

	        $this->dbforge->add_key('delivery_note_id', true);
	        
	        $this->dbforge->add_field('INDEX (customer_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
	        $this->dbforge->create_table('inv_delivery_note', true);
    	}

    	if(!$this->db->table_exists('inv_delivery_contact_info'))
	    {
	        $this->dbforge->add_field(array(
	        'delivery_contact_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'shipping_address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'customer_address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'shipping_address' => array(
	        'type' => 'text',
	        ),
	        'contact_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
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
	        ),
	        'address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'tax_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'address_display' => array(
	        'type' => 'text',
	        ),
	        'customer_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'territory_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        ));

	        $this->dbforge->add_key('delivery_contact_info_id', true);
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
	        $this->dbforge->add_field('INDEX (address_id)');
	        $this->dbforge->add_field('INDEX (contact_id)');
	        $this->dbforge->add_field('INDEX (address_id)');
	        $this->dbforge->add_field('INDEX (customer_group_id)');
	        $this->dbforge->add_field('INDEX (tax_id)');
	        $this->dbforge->add_field('INDEX (territory_id)');
	        $this->dbforge->create_table('inv_delivery_contact_info', true);
    	}

    	if(!$this->db->table_exists('inv_delivery_note_item'))
	    {
	        $this->dbforge->add_field(array(
	        'delivery_note_item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_code_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_name' => array(
	        'type' => 'varchar',
			'constraint' => 255,
	        ),
	        'customer_item_code' => array(
	        'type' => 'varchar',
			'constraint' => 255,
	        ),
	        'barcode' => array(
	        'type' => 'varchar',
			'constraint' => 255,
	        ),
	        'description' => array(
	        'type' => 'text',
	        ),
	        'image' => array(
			'type' => 'varchar',
			'constraint' => 255,

	        ),
	        'qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'stock_uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'conversion_factor' => array(
			'type' => 'decimal',
	        'constraint' => '9,2',

	        ),
	        'stock_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'price_list_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'base_price_list_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'margin_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'margin_rate_or_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'rate_with_margin' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'discount_percentage' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'base_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'base_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'pricing_rule_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'net_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'net_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'base_net_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'base_net_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'target_warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'quality_inspection_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'serial_no' => array(
	        'type' => 'text',
	        ),
	        'batch_no_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'actual_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'actual_batch_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'item_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'brand_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_tax_rate' => array(
	        'type' => 'text',
	        ),
	        'expense_account_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'cost_center_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'allow_zero_valuation_rate' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'against_sales_order_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'against_sales_invoice_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'so_detail' => array(
	        'type' => 'varchar',
			'constraint' => 255,
	        ),
	        'si_detail' => array(
	        'type' => 'varchar',
			'constraint' => 255,
	        ),
	        'installed_qty' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'billed_amt' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'page_break' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('delivery_note_item_id', true);
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
	        $this->dbforge->add_field('INDEX (item_code_id)');
	        $this->dbforge->add_field('INDEX (stock_uom_id)');
			$this->dbforge->add_field('INDEX (uom_id)');
			$this->dbforge->add_field('INDEX (margin_type_id)');
			$this->dbforge->add_field('INDEX (pricing_rule_id)');
			$this->dbforge->add_field('INDEX (warehouse_id)');
			$this->dbforge->add_field('INDEX (target_warehouse_id)');
			$this->dbforge->add_field('INDEX (quality_inspection_id)');
			$this->dbforge->add_field('INDEX (batch_no_id)');
			$this->dbforge->add_field('INDEX (item_group_id)');
			$this->dbforge->add_field('INDEX (brand_id)');
			$this->dbforge->add_field('INDEX (expense_account_id)');
			$this->dbforge->add_field('INDEX (cost_center_id)');
			$this->dbforge->add_field('INDEX (against_sales_order_id)');
			$this->dbforge->add_field('INDEX (against_sales_invoice_id)');
			$this->dbforge->create_table('inv_delivery_note_item', true);

    	}

    	if(!$this->db->table_exists('def_inv_margin_type'))
	    {
	        $this->dbforge->add_field(array(
	        'margin_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,  
	        'auto_increment' => true
	        ),
	        'margin_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('margin_type_id', true);
	        $this->dbforge->create_table('def_inv_margin_type',true); 

	    	$data = array(
            array('margin_type' => 'Percentage'),
            array('margin_type' => 'Amount')
           
         );
	    	$this->db->insert_batch('def_inv_margin_type', $data); 
	    }

    	if(!$this->db->table_exists('inv_del_note_packed_item'))
	    {
	        $this->dbforge->add_field(array(
	        'inv_del_note_packed_item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'parent_item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_code_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'description' => array(
	        'type' => 'text',
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'target_warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'serial_no' => array(
	        'type' => 'text',
	        ),
	        'batch_no_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'actual_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'projected_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'page_break' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'prevdoc_doctype' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'parent_detail_docname' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('inv_del_note_packed_item_id', true);
	        $this->dbforge->add_field('INDEX (parent_item_id)');
	        $this->dbforge->add_field('INDEX (item_code_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
			$this->dbforge->add_field('INDEX (target_warehouse_id)');
			$this->dbforge->add_field('INDEX (uom_id)');
	        $this->dbforge->create_table('inv_del_note_packed_item', true);
    	}

    	if(!$this->db->table_exists('inv_del_note_currency_price_list'))
	    {
	        $this->dbforge->add_field(array(
	        'del_note_currency_price_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'currency_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'conversion_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'price_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'price_list_currency_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'plc_conversion_rate' => array(
	        'type' => 'float',
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

	        $this->dbforge->add_key('del_note_currency_price_list_id', true);
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
	        $this->dbforge->add_field('INDEX (price_list_id)');
	        $this->dbforge->add_field('INDEX (currency_id)');
			$this->dbforge->add_field('INDEX (price_list_currency_id)');
	        $this->dbforge->create_table('inv_del_note_currency_price_list', true);
    	}

    	if(!$this->db->table_exists('inv_del_note_tax'))
	    {
	        $this->dbforge->add_field(array(
	        'del_note_tax_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'taxes_charges_template_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'shipping_rule_id' => array(
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
	        'delivery_note_additional_id' => array(
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
	        'in_words' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('del_note_tax_id', true);
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
		    $this->dbforge->add_field('INDEX (taxes_charges_template_id)');
		    $this->dbforge->add_field('INDEX (delivery_note_additional_id)');
		    $this->dbforge->create_table('inv_del_note_tax', true);
    	}

    	if(!$this->db->table_exists('inv_del_note_term_conditions'))
	    {
	        $this->dbforge->add_field(array(
	        'del_note_term_conditions_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'delivery_note_id' => array(
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

	        $this->dbforge->add_key('del_note_term_conditions_id', true);
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
		    $this->dbforge->add_field('INDEX (tc_id)');
		    $this->dbforge->create_table('inv_del_note_term_conditions', true);
    	}

    	if(!$this->db->table_exists('inv_del_note_transporter_info'))
	    {
	        $this->dbforge->add_field(array(
	        'del_note_transporter_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'transporter_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'lr_no' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'lr_date' => array(
	        'type' => 'date',
	        ),
	        ));

	        $this->dbforge->add_key('del_note_transporter_info_id', true);
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
	        $this->dbforge->create_table('inv_del_note_transporter_info', true);
    	}

    	if(!$this->db->table_exists('inv_del_note_more_info'))
	    {
	        $this->dbforge->add_field(array(
	        'del_note_more_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'project_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'campaign_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'lead_source_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'per_billed' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        ));

	        $this->dbforge->add_key('del_note_more_info_id', true);
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
	        $this->dbforge->add_field('INDEX (project_id)');
	        $this->dbforge->add_field('INDEX (campaign_id)');
	        $this->dbforge->add_field('INDEX (lead_source_id)');
	        $this->dbforge->create_table('inv_del_note_more_info', true);
    	}
    	if(!$this->db->table_exists('inv_del_note_printing_details'))
	    {
	        $this->dbforge->add_field(array(
	        'del_note_printing_details_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'letter_head_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'print_heading_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'language' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'print_without_amount' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' =>  false
	        ),
	        'delivery_note_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'per_installed' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'installation_status' => array(
	        'type' => 'varchar',
	        'constraint' => 60,
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'excise_page' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'instructions' => array(
	        'type' => 'text',
	        ),
	        ));

	        $this->dbforge->add_key('del_note_printing_details_id', true);
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
	        $this->dbforge->add_field('INDEX (letter_head_id)');
			$this->dbforge->add_field('INDEX (print_heading_id)');
	        $this->dbforge->add_field('INDEX (delivery_note_status_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
	        $this->dbforge->create_table('inv_del_note_printing_details', true);
    	}

    	if(!$this->db->table_exists('inv_del_note_commission'))
	    {
	        $this->dbforge->add_field(array(
	        'del_note_commission_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'sales_partner_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'commission_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'total_commission' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('del_note_commission_id', true);
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
	        $this->dbforge->add_field('INDEX (sales_partner_id)');
	        $this->dbforge->create_table('inv_del_note_commission', true);
    	}
    	if(!$this->db->table_exists('inv_del_note_sales_team'))
	    {
	        $this->dbforge->add_field(array(
	        'del_note_sales_team_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'sales_partner_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'allocated_percentage' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'total_commission' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('del_note_sales_team_id', true);
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
	        $this->dbforge->add_field('INDEX (sales_partner_id)');
	        $this->dbforge->create_table('inv_del_note_sales_team', true);
    	}

    	if(!$this->db->table_exists('inv_delivery_totals'))
	    {
	        $this->dbforge->add_field(array(
	        'delivery_totals_id' => array(
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

	        $this->dbforge->add_key('delivery_totals_id', true);
	        $this->dbforge->create_table('inv_delivery_totals', true);
    	}

    	if(!$this->db->table_exists('inv_stock_reconciliation'))
	    {
	        $this->dbforge->add_field(array(
	        'stock_reconciliation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'naming_series' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'amended_from_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'posting_date' => array(
	        'type' => 'date',
	        ),
	        'posting_time' => array(
	        'type' => 'time',
	        ),
	        'set_posting_time' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'cost_center_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'reconciliation_json' => array(
	        'type' => 'text',
	        ),
	        'difference_amount' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        ));

	        $this->dbforge->add_key('stock_reconciliation_id', true);
	        
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (amended_from_id)');
	        $this->dbforge->add_field('INDEX (cost_center_id)');
	        $this->dbforge->create_table('inv_stock_reconciliation', true);
    	}

    	if(!$this->db->table_exists('inv_packing_slip'))
	    {
	        $this->dbforge->add_field(array(
	        'packing_slip_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'naming_series' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'from_case_no' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'to_case_no' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        ));

	        $this->dbforge->add_key('packing_slip_id', true);
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
	        
	        $this->dbforge->create_table('inv_packing_slip', true);
    	}

    	if(!$this->db->table_exists('inv_package_weight_details'))
	    {
	        $this->dbforge->add_field(array(
	        'package_weight_details_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'net_weight_pkg' => array(
	        'type' => 'float',
	        ),
	        'net_weight_uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'gross_weight_pkg' => array(
	        'type' => 'float',
	        ),
	        'gross_weight_uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('package_weight_details_id', true);
	        $this->dbforge->add_field('INDEX (net_weight_uom_id)');
	        $this->dbforge->add_field('INDEX (gross_weight_uom_id)');
	        $this->dbforge->create_table('inv_package_weight_details', true);
    	}

    	if(!$this->db->table_exists('inv_quality_inspection'))
	    {
	        $this->dbforge->add_field(array(
	        'quality_inspection_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'naming_series' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'report_date' => array(
	        'type' => 'date',
	        ),
	        'quality_inspection_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true, 
	        ),
	        'quality_inspection_reference_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'reference_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_serial_nos_batches_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'batch_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'sample_size' => array(
	        'type' => 'float',
	        ),
	        'item_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'description' => array(
	        'type' => 'text',
	        ),
	        'user_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'verified_by' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'remarks' => array(
	        'type' => 'text',
	        ),
	        ));

	        $this->dbforge->add_key('quality_inspection_id', true);
	        
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (item_serial_nos_batches_id)');
	        $this->dbforge->add_field('INDEX (batch_id)');
	        $this->dbforge->add_field('INDEX (user_id)');
	        $this->dbforge->add_field('INDEX (quality_inspection_type_id)');
	        $this->dbforge->add_field('INDEX (quality_inspection_reference_id)');
	        $this->dbforge->create_table('inv_quality_inspection', true);
    	}

    	if(!$this->db->table_exists('inv_landed_cost_voucher'))
	    {
	        $this->dbforge->add_field(array(
	        'landed_cost_voucher_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'naming_series' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'total_taxes_and_charges' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'landed_cost_voucher_distribute_charge_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),	        
	        ));

	        $this->dbforge->add_key('landed_cost_voucher_id', true);
	        
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (landed_cost_voucher_distribute_charge_id)');
	        $this->dbforge->create_table('inv_landed_cost_voucher', true);
    	}

    	if(!$this->db->table_exists('inv_material_request'))
	    {
	        $this->dbforge->add_field(array(
	        'material_request_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'material_request_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),	        
	        'naming_series' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
		    'amended_from_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'requested_by' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'transaction_date' => array(
	        'type' => 'date',
	        ),
	        'material_request_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'per_ordered' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'letter_head_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'print_heading_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'tc_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'terms' => array(
	        'type' => 'text',
	        ),
	        ));

	        $this->dbforge->add_key('material_request_id', true);
	        
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (amended_from_id)');
	        $this->dbforge->add_field('INDEX (letter_head_id)');
	        $this->dbforge->add_field('INDEX (print_heading_id)');
	        $this->dbforge->add_field('INDEX (tc_id)');
	        $this->dbforge->add_field('INDEX (material_request_type_id)');
	        $this->dbforge->add_field('INDEX (material_request_status_id)');
	        $this->dbforge->create_table('inv_material_request', true);
    	}

    	if(!$this->db->table_exists('inv_purchase_receipt'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_receipt_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'naming_series' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'supplier_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'supplier_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'posting_date' => array(
	        'type' => 'date',
	        ),
	        'posting_time' => array(
	        'type' => 'time',
	        ),
	        'set_posting_time' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'is_return' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'purchase_receipt_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        ));

	        $this->dbforge->add_key('purchase_receipt_id', true);
	        
	        $this->dbforge->add_field('INDEX (supplier_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (purchase_receipt_id)');
	        $this->dbforge->create_table('inv_purchase_receipt', true);
    	}

    	if(!$this->db->table_exists('inv_purchase_receipt_address'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_receipt_address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'purchase_receipt_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
		    'address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'contact_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'address_display' => array(
	        'type' => 'text',
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
	        'address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'shipping_address_display' => array(
	        'type' => 'text',
	        ),
	        ));

	        $this->dbforge->add_key('purchase_receipt_address_id', true);
	        $this->dbforge->add_field('INDEX (purchase_receipt_id)');
	        $this->dbforge->add_field('INDEX (address_id)');
	        $this->dbforge->add_field('INDEX (contact_id)');
	        $this->dbforge->add_field('INDEX (address_id)');
	        $this->dbforge->create_table('inv_purchase_receipt_address', true);
    	}

    	if(!$this->db->table_exists('inv_purchase_rec_currency_price_list'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_rec_currency_price_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'currency_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'conversion_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'price_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'currency_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'plc_conversion_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2'
	        ),
	        'ignore_pricing_rule' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
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

	        $this->dbforge->add_key('purchase_rec_currency_price_list_id', true);
	        $this->dbforge->add_field('INDEX (price_list_id)');
	        $this->dbforge->add_field('INDEX (currency_id)');
	        $this->dbforge->create_table('inv_purchase_rec_currency_price_list', true);
    	}

    	if(!$this->db->table_exists('inv_purchase_receipt_tax'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_receipt_tax_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'purchase_receipt_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'taxes_charges_template_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'shipping_rule_id' => array(
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
	        'purchase_receipt_apply_discount_id' => array(
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
	        'in_words' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('purchase_receipt_tax_id', true);
		    $this->dbforge->add_field('INDEX (purchase_receipt_id)');
		    $this->dbforge->add_field('INDEX (taxes_charges_template_id)');
		    $this->dbforge->add_field('INDEX (purchase_receipt_apply_discount_id)');
		    $this->dbforge->create_table('inv_purchase_receipt_tax', true);
    	}

    	if(!$this->db->table_exists('inv_purchase_receipt_term_conditions'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_receipt_term_conditions_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'purchase_receipt_id' => array(
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

	        $this->dbforge->add_key('purchase_receipt_term_conditions_id', true);
		    $this->dbforge->add_field('INDEX (purchase_receipt_id)');
		    $this->dbforge->add_field('INDEX (tc_id)');
		    $this->dbforge->create_table('inv_purchase_receipt_term_conditions', true);
    	}

    	if(!$this->db->table_exists('inv_purchase_receipt_raw_material'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_receipt_raw_material_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'purchase_receipt_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'pur_receipt_raw_material_supplied_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'bill_no' => array(
	        'type' => 'date', 
	        ),
	        'bill_date' => array(
	        'type' => 'date', 
	        ),
	        ));

	        $this->dbforge->add_key('purchase_receipt_raw_material_id', true);
	        $this->dbforge->add_field('INDEX (purchase_receipt_id)');
		    $this->dbforge->add_field('INDEX (pur_receipt_raw_material_supplied_id)');
		    $this->dbforge->add_field('INDEX (warehouse_id)');
		    $this->dbforge->create_table('inv_purchase_receipt_raw_material', true);
    	}

    	if(!$this->db->table_exists('inv_purchase_receipt_more_info'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_receipt_more_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'purchase_receipt_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'pur_receipt_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'range' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'per_billed' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2', 
	        ),
	        ));

	        $this->dbforge->add_key('purchase_receipt_more_info_id', true);
	        $this->dbforge->add_field('INDEX (purchase_receipt_id)');
		    $this->dbforge->add_field('INDEX (pur_receipt_status_id)');
		    $this->dbforge->add_field('INDEX (warehouse_id)');
		    $this->dbforge->create_table('inv_purchase_receipt_more_info', true);
    	}

    	if(!$this->db->table_exists('inv_purchase_receipt_printing_details'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_receipt_printing_details_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'purchase_receipt_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'letter_head_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'print_heading_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'instructions' => array(
	        'type' => 'text',
	        ),
	        'remarks' => array(
	        'type' => 'text'
	        ),
	        ));

	        $this->dbforge->add_key('purchase_receipt_printing_details_id', true);
	        $this->dbforge->add_field('INDEX (purchase_receipt_id)');
	        $this->dbforge->add_field('INDEX (letter_head_id)');
	        $this->dbforge->add_field('INDEX (print_heading_id)');
	        $this->dbforge->create_table('inv_purchase_receipt_printing_details', true);
    	}

    	if(!$this->db->table_exists('inv_purchase_receipt_transporter_info'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_receipt_transporter_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'purchase_receipt_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'lr_no' => array(
	        'type' => 'text',
	        ),
	        'lr_date' => array(
	        'type' => 'text'
	        ),
	        ));

	        $this->dbforge->add_key('purchase_receipt_transporter_info_id', true);
	        $this->dbforge->add_field('INDEX (purchase_receipt_id)');
	        $this->dbforge->create_table('inv_purchase_receipt_transporter_info', true);
    	}


    	if(!$this->db->table_exists('inv_serial_no'))
	    {
	        $this->dbforge->add_field(array(
	        'serial_no_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'item_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'description' => array(
	        'type' => 'text',
	        ),
	        'item_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'brand_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('serial_no_id', true);
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
	        $this->dbforge->add_field('INDEX (item_group_id)');
	        $this->dbforge->add_field('INDEX (brand_id)');
	        $this->dbforge->create_table('inv_serial_no', true);
    	}

    	if(!$this->db->table_exists('inv_serial_purchase_details'))
	    {
	        $this->dbforge->add_field(array(
	        'serial_purchase_details_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'serial_no_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'document_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'document_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'purchase_date' => array(
	        'type' => 'date',
	        ),
	        'purchase_time' => array(
	        'type' => 'time',
	        ),
	        'purchase_rate' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'supplier_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'supplier_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('serial_purchase_details_id', true);
	        $this->dbforge->add_field('INDEX (document_type_id)');
	        $this->dbforge->add_field('INDEX (document_type_id)');
	        $this->dbforge->add_field('INDEX (supplier_id)');
	        $this->dbforge->add_field('INDEX (serial_no_id)');
	        
	        $this->dbforge->create_table('inv_serial_purchase_details', true);
    	}

    	if(!$this->db->table_exists('inv_serial_delivery_details'))
	    {
	        $this->dbforge->add_field(array(
	        'serial_delivery_details_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'serial_no_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'document_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'document_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'delivery_date' => array(
	        'type' => 'date',
	        ),
	        'delivery_time' => array(
	        'type' => 'time',
	        ),
	        'is_cancelled' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
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
	        ));

	        $this->dbforge->add_key('serial_delivery_details_id', true);
	        $this->dbforge->add_field('INDEX (document_type_id)');
	        $this->dbforge->add_field('INDEX (document_type_id)');
	        $this->dbforge->add_field('INDEX (customer_id)');
	        $this->dbforge->add_field('INDEX (serial_no_id)');
	        $this->dbforge->create_table('inv_serial_delivery_details', true);
    	}

    	if(!$this->db->table_exists('inv_serial_invoice_details'))
	    {
	        $this->dbforge->add_field(array(
	        'serial_invoice_details_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'serial_no_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'sales_invoice_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('serial_invoice_details_id', true);
	        $this->dbforge->add_field('INDEX (sales_invoice_id)');
	        $this->dbforge->add_field('INDEX (serial_no_id)');
	        $this->dbforge->create_table('inv_serial_invoice_details', true);
    	}

    	if(!$this->db->table_exists('inv_serial_warranty_amc_details'))
	    {
	        $this->dbforge->add_field(array(
	        'serial_warranty_amc_details_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'serial_no_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'serial_no_maintenance_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'warranty_period' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'warranty_expiry_date' => array(
	        'type' => 'date',
	        ),
	        'amc_expiry_date' => array(
	        'type' => 'date',
	        ),
	        ));

	        $this->dbforge->add_key('serial_warranty_amc_details_id', true);
	        $this->dbforge->add_field('INDEX (serial_no_id)');
	        	$this->dbforge->add_field('INDEX (serial_no_maintenance_status_id)');
	        $this->dbforge->create_table('inv_serial_warranty_amc_details', true);
    	}

    	if(!$this->db->table_exists('inv_serial_more_info'))
	    {
	        $this->dbforge->add_field(array(
	        'serial_more_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'serial_no_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'serial_no_details' => array(
	        'type' => 'text',
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        ));

	        $this->dbforge->add_key('serial_more_info_id', true);
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (serial_no_id)');
	        $this->dbforge->create_table('inv_serial_more_info', true);
    	}

    	if(!$this->db->table_exists('inv_batch'))
	    {
	        $this->dbforge->add_field(array(
	        'batch_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'image' => array(
	        'type' => 'text',
	        ),
	        'parent_batch_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'expiry_date' => array(
	        'type' => 'date',
	        ),
	        'supplier_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'reference_doctype_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'reference_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'description' => array(
	        'type' => 'text',
	        ),
	        ));

	        $this->dbforge->add_key('batch_id', true);
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (parent_batch_id)');
	        $this->dbforge->add_field('INDEX (supplier_id)');
	        $this->dbforge->add_field('INDEX (reference_doctype_id)');
	        $this->dbforge->create_table('inv_batch', true);
    	}

    	if(!$this->db->table_exists('inv_installation_note'))
	    {
	        $this->dbforge->add_field(array(
	        'installation_note_id' => array(
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
	        'unsigned' => true,
	        ),
	        'address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'contact_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'customer_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'address_display' => array(
	        'type' => 'text',
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
	        ),
	        'territory_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'customer_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'inst_date' => array(
	        'type' => 'date',
	        ),
	        'inst_time' => array(
	        'type' => 'time',
	        ),
	        'installation_note_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'remarks' => array(
	        'type' => 'text',
	        ),
	        ));

	        $this->dbforge->add_key('installation_note_id', true);
	        
	        $this->dbforge->add_field('INDEX (customer_id)');
	        $this->dbforge->add_field('INDEX (address_id)');
	        $this->dbforge->add_field('INDEX (territory_id)');
	        $this->dbforge->add_field('INDEX (customer_group_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (installation_note_status_id)');
	        $this->dbforge->create_table('inv_installation_note', true);
    	}

    	if(!$this->db->table_exists('inv_stock_entry'))
	    {
	        $this->dbforge->add_field(array(
	        'stock_entry_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'naming_series' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'stock_entry_purpose_id' => array(
	        'type' 	=> 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'production_order_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'purchase_order_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'delivery_note_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'sales_invoice_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'purchase_receipt_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'from_bom' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'posting_date' => array(
	        'type' => 'date',
	        ),
	        'posting_time' => array(
	        'type' => 'time',
	        ),
	        'set_posting_time' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'bom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'fg_completed_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'use_multi_level_bom' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'total_incoming_value' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'total_outgoing_value' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'value_difference' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'total_additional_cost' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('stock_entry_id', true);
	        
	        $this->dbforge->add_field('INDEX (stock_entry_purpose_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (production_order_id)');
	        $this->dbforge->add_field('INDEX (purchase_order_id)');
	        $this->dbforge->add_field('INDEX (delivery_note_id)');
	        $this->dbforge->add_field('INDEX (purchase_receipt_id)');
	        $this->dbforge->add_field('INDEX (bom_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
	        $this->dbforge->create_table('inv_stock_entry', true);
    	}

    	if(!$this->db->table_exists('inv_stock_contact'))
	    {
	        $this->dbforge->add_field(array(
	        'stock_contact_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'stock_entry_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'supplier_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'supplier_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'address_display' => array(
	        'type' => 'text',
	        ),
	        'customer_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'customer_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'customer_address' => array(
	        'type' => 'text',
	        ),
	        ));

	        $this->dbforge->add_key('stock_contact_id', true);
	        $this->dbforge->add_field('INDEX (stock_entry_id)');
	        $this->dbforge->add_field('INDEX (supplier_id)');
	        $this->dbforge->add_field('INDEX (address_id)');
	        $this->dbforge->add_field('INDEX (customer_id)');
	        $this->dbforge->create_table('inv_stock_contact', true);
    	}

    	if(!$this->db->table_exists('inv_stock_printing_settings'))
	    {
	        $this->dbforge->add_field(array(
	        'stock_printing_settings_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'stock_entry_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'print_heading_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'letter_head_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'project_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'remarks' => array(
	        'type' => 'text',
	        ),
	        'total_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('stock_printing_settings_id', true);
	        $this->dbforge->add_field('INDEX (stock_entry_id)');
	        $this->dbforge->add_field('INDEX (print_heading_id)');
	        $this->dbforge->add_field('INDEX (letter_head_id)');
	        $this->dbforge->add_field('INDEX (project_id)');
	        $this->dbforge->create_table('inv_stock_printing_settings', true);
    	}

    	if(!$this->db->table_exists('inv_stock_settings_auto_material_request'))
	    {
	        $this->dbforge->add_field(array(
	        'stock_settings_auto_material_request_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'auto_indent' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'reorder_email_notify' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('stock_settings_auto_material_request_id', true);
	        $this->dbforge->create_table('inv_stock_settings_auto_material_request', true);
    	}

    	if(!$this->db->table_exists('inv_stock_settings_freeze_stock_entries'))
	    {
	        $this->dbforge->add_field(array(
	        'stock_settings_afreeze_stock_entries_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'stock_frozen_upto' => array(
	        'type' => 'date',
	        ),
	        'stock_frozen_upto_days' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'stock_auth_role_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('stock_settings_afreeze_stock_entries_id', true);
	        $this->dbforge->add_field('INDEX (stock_auth_role_id)');
	        $this->dbforge->create_table('inv_stock_settings_freeze_stock_entries', true);
    	}
	}

    public function down()
    {
    	$this->dbforge->drop_table('inv_delivery_note', true);
    	$this->dbforge->drop_table('inv_delivery_contact_info', true);
    	$this->dbforge->drop_table('inv_del_note_currency_price_list', true);
    	$this->dbforge->drop_table('inv_del_note_tax', true);
    	$this->dbforge->drop_table('inv_purchase_receipt_term_conditions', true);
    	$this->dbforge->drop_table('inv_del_note_term_conditions', true);
    	$this->dbforge->drop_table('inv_del_note_transporter_info', true);
    	$this->dbforge->drop_table('inv_del_note_more_info', true);
    	$this->dbforge->drop_table('inv_del_note_printing_details', true);
    	$this->dbforge->drop_table('inv_del_note_sales_team', true);
    	$this->dbforge->drop_table('inv_delivery_totals', true);
    	$this->dbforge->drop_table('inv_stock_reconciliation', true);
    	$this->dbforge->drop_table('inv_packing_slip', true);
    	$this->dbforge->drop_table('inv_package_weight_details', true);
    	$this->dbforge->drop_table('inv_quality_inspection', true);
    	$this->dbforge->drop_table('inv_landed_cost_voucher', true);
    	$this->dbforge->drop_table('inv_material_request', true);
    	$this->dbforge->drop_table('inv_purchase_receipt', true);
    	$this->dbforge->drop_table('inv_purchase_section_addresses', true);
    	$this->dbforge->drop_table('inv_purchase_rec_currency_price_list', true);
    	$this->dbforge->drop_table('inv_purchase_receipt_tax', true);
    	$this->dbforge->drop_table('inv_purchase_receipt_term_conditions', true);
    	$this->dbforge->drop_table('inv_purchase_receipt_raw_material', true);
    	$this->dbforge->drop_table('inv_purchase_receipt_more_info', true);
    	$this->dbforge->drop_table('inv_purchase_receipt_transporter_info', true);
    	$this->dbforge->drop_table('inv_serial_no', true);
    	$this->dbforge->drop_table('inv_serial_purchase_details', true);
    	$this->dbforge->drop_table('inv_serial_delivery_details', true);
    	$this->dbforge->drop_table('inv_serial_invoice_details', true);
    	$this->dbforge->drop_table('inv_serial_warranty_amc_details', true);
    	$this->dbforge->drop_table('inv_serial_more_info', true);
    	$this->dbforge->drop_table('inv_batch', true);
    	$this->dbforge->drop_table('inv_installation_note', true);
    	$this->dbforge->drop_table('inv_stock_entry', true);
    	$this->dbforge->drop_table('inv_stock_contact', true);
    	$this->dbforge->drop_table('inv_stock_printing_settings', true);
    	$this->dbforge->drop_table('inv_stock_settings_auto_material_request', true);
    	$this->dbforge->drop_table('inv_stock_settings_freeze_stock_entries', true);
    	$this->dbforge->drop_table('inv_purchase_receipt_address', true);
    	$this->dbforge->drop_table('inv_purchase_receipt_printing_details', true);
		$this->dbforge->drop_table('inv_delivery_note_item', true);
		$this->dbforge->drop_table('inv_del_note_packed_item', true);
		$this->dbforge->drop_table('def_inv_margin_type', true);


 
    }
}
