<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_purchase extends CI_Migration 
{
	public function up()
    {
    	if(!$this->db->table_exists('pur_material_request'))
	    {
	        $this->dbforge->add_field(array(
	        'material_request_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'pur_material_req_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'naming_series' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
		    'requested_by' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'transaction_date' => array(
	        'type' => 'date',
	        ),
	        'purchasing_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'per_ordered' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
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
	        'tc_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'terms' => array(
	        'type' => 'longtext', 
	        )
	        ));

	        $this->dbforge->add_key('material_request_id', true);
	        $this->dbforge->add_field('INDEX (pur_material_req_type_id)');
	        
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (letter_head_id)');
	        $this->dbforge->add_field('INDEX (print_heading_id)');
	        $this->dbforge->add_field('INDEX (tc_id)');
	        $this->dbforge->create_table('pur_material_request', true);
    	}

    	if(!$this->db->table_exists('pur_request_for_quotation'))
	    {
	        $this->dbforge->add_field(array(
	        'request_for_quotation_id' => array(
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
	        'supplier_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'transaction_date' => array(
	        'type' => 'date',
	        ),
	        'standard_reply_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'message_for_supplier' => array(
	        'type' => 'longtext', 
	        ),
	        'tc_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'terms' => array(
	        'type' => 'longtext', 
	        ),
	        'print_heading_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'letter_head_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'req_for_quo_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'fiscal_year_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('request_for_quotation_id', true);
	        
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (supplier_id)');
	        $this->dbforge->add_field('INDEX (standard_reply_id)');
	        $this->dbforge->add_field('INDEX (tc_id)');
	        $this->dbforge->add_field('INDEX (print_heading_id)');
	        $this->dbforge->add_field('INDEX (letter_head_id)');
	        $this->dbforge->add_field('INDEX (req_for_quo_status_id)');
	        $this->dbforge->add_field('INDEX (fiscal_year_id)');
	        $this->dbforge->create_table('pur_request_for_quotation', true);
    	}

    	if(!$this->db->table_exists('pur_request_for_quotation_item'))
	    {
	        $this->dbforge->add_field(array(
	        'request_for_quotation_item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'request_for_quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'supplier_part_no' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'item_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'description' => array(
	        'type' => 'longtext',
	        ),
	        'image' => array(
	        'type' => 'text',
	        ),
	        'image_view' => array(
	        'type' => 'text',
	        ),
	        'qty' => array(
	        'type' => 'float',
	        ),
	        'schedule_date' => array(
	        'type' => 'date',
	        ),
	        'uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	    	'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'project_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'material_request_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'material_request_item' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'brand_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'item_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        ));

	        $this->dbforge->add_key('request_for_quotation_item_id', true);
	        $this->dbforge->add_field('INDEX (request_for_quotation_id)');
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
	        $this->dbforge->add_field('INDEX (project_id)');
	        $this->dbforge->add_field('INDEX (material_request_id)');
	        $this->dbforge->add_field('INDEX (brand_id)');
	        $this->dbforge->add_field('INDEX (item_group_id)');
	        $this->dbforge->create_table('pur_request_for_quotation_item', true);
    	}
    	if(!$this->db->table_exists('pur_request_for_quotation_supplier'))
	    {
	        $this->dbforge->add_field(array(
	        'request_for_quotation_supplier_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'request_for_quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'send_email' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'email_sent' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'supplier_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'contact_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'supplier_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'email_id' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('request_for_quotation_supplier_id', true);
	        $this->dbforge->add_field('INDEX (request_for_quotation_id)');
	        $this->dbforge->add_field('INDEX (supplier_id)');
	        $this->dbforge->add_field('INDEX (contact_id)');
	        $this->dbforge->create_table('pur_request_for_quotation_supplier', true);
    	}

    	if(!$this->db->table_exists('pur_buying_settings'))
	    {
	        $this->dbforge->add_field(array(
	        'buying_settings_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'buying_supplier_naming_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'supplier_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'price_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'buying_pur_order_req_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'buying_pur_receipt_req_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'maintain_same_rate' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'allow_multiple_items' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        ));

	        $this->dbforge->add_key('buying_settings_id', true);
	        $this->dbforge->add_field('INDEX (buying_supplier_naming_id)');
	        $this->dbforge->add_field('INDEX (supplier_type_id)');
	        $this->dbforge->add_field('INDEX (price_list_id)');
	        $this->dbforge->add_field('INDEX (buying_pur_order_req_id)');
	        $this->dbforge->add_field('INDEX (buying_pur_receipt_req_id)');
	        $this->dbforge->create_table('pur_buying_settings', true);
    	}

    	if(!$this->db->table_exists('pur_taxes_charges_template'))
	    {
	        $this->dbforge->add_field(array(
	        'taxes_charges_template_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'title' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'is_default' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'disabled' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'created_on'=> array(
            'type' => 'timestamp',
            'null'	=> 'YES',
            'Default'=> null
            ),
     		'created_by'=> array(
            'type' => 'INT',
            'constraint' => 10,
	        'unsigned' => true,
            ),
     		"`updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
    		'updated_by'=> array(
            'type' => 'INT',
            'constraint' => 10,
	        'unsigned' => true,
            ),
    		'is_delete'=> array(
            'type' => 'tinyint',
            'constraint' => '4',
            'default'=> 0
            ),
	        ));

	        $this->dbforge->add_key('taxes_charges_template_id', true);
		    $this->dbforge->add_field('INDEX (company_id)');
		    $this->dbforge->create_table('pur_taxes_charges_template', true);
    	}

    	if(!$this->db->table_exists('pur_taxes_charges'))
	    {
	        $this->dbforge->add_field(array(
	        'taxes_charges_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'taxes_charges_template_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
			'purchase_taxes_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'purchase_taxes_add_or_dec_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'row_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'account_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'cost_center_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'description' => array(
	        'type' => 'text',
	        ),
	        'included_in_print_rate' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2'
	        ),
	        'tax_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2'
	        ),
	        'total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2'
	        ),
	        'tax_amount_after_discount_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2'
	        ),
	        'base_tax_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2'
	        ),
	        'base_total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2'
	        ),
	        'base_tax_amount_after_discount_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2'
	        ),
	        'item_wise_tax_detail' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'parenttype' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'created_on'=> array(
            'type' => 'timestamp',
            'null'	=> 'YES',
            'Default'=> null
            ),
     		'created_by'=> array(
            'type' => 'INT',
            'constraint' => 10,
	        'unsigned' => true,
            ),
     		"`updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
    		'updated_by'=> array(
            'type' => 'INT',
            'constraint' => 10,
	        'unsigned' => true,
            ),
    		'is_delete'=> array(
            'type' => 'tinyint',
            'constraint' => '4',
            'default'=> 0
            ), 
	        ));

	        $this->dbforge->add_key('taxes_charges_id', true);
		    $this->dbforge->add_field('INDEX (taxes_charges_template_id)');
		    $this->dbforge->add_field('INDEX (account_id)');
		    $this->dbforge->add_field('INDEX (cost_center_id)');
		    $this->dbforge->add_field('INDEX (purchase_taxes_type_id)');
		    $this->dbforge->add_field('INDEX (purchase_taxes_add_or_dec_id)');
		    $this->dbforge->create_table('pur_taxes_charges', true);
    	}

    	if(!$this->db->table_exists('pur_supplier_scorecard'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_scorecard_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'supplier_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'supplier_score' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'indicator_color' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'sup_scor_evaluation_period_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'weighting_function' => array(
	        'type' => 'text',
	        ),
	        'warn_rfqs' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'warn_pos' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'prevent_rfqs' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'prevent_pos' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'notify_supplier' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'notify_employee' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'employee_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        ));

	        $this->dbforge->add_key('supplier_scorecard_id', true);
		    $this->dbforge->add_field('INDEX (supplier_id)');
		    $this->dbforge->add_field('INDEX (sup_scor_evaluation_period_id)');
		    $this->dbforge->add_field('INDEX (employee_id)');
		    $this->dbforge->create_table('pur_supplier_scorecard', true);
    	}

    	if(!$this->db->table_exists('pur_supplier_scorecard_variable'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_scorecard_variable_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ), 
	        'variable_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'is_custom' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'param_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'path' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        ));

	        $this->dbforge->add_key('supplier_scorecard_variable_id', true);
		    $this->dbforge->create_table('pur_supplier_scorecard_variable', true);
    	}

    	if(!$this->db->table_exists('pur_supplier_scorecard_criteria'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_scorecard_criteria_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ), 
	        'criteria_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'weight' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false,
	        ), 
	        'max_score' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false,
	        ),
	        'formula' => array(
	        'type' => 'text',
	        ),
	        ));
	        $this->dbforge->add_key('supplier_scorecard_criteria_id', true);
		    $this->dbforge->create_table('pur_supplier_scorecard_criteria', true);
    	}

    	if(!$this->db->table_exists('pur_supplier_scorecard_standing'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_scorecard_standing_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ), 
	        'standing_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'sup_scor_color_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'min_grade' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false,
	        ),
	        'max_grade' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false,
	        ),
	        'warn_rfqs' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'warn_pos' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'prevent_rfqs' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'prevent_pos' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'notify_supplier' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'notify_employee' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'employee_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        ));

	        $this->dbforge->add_key('supplier_scorecard_standing_id', true);
		    $this->dbforge->add_field('INDEX (sup_scor_color_id)');
		    $this->dbforge->add_field('INDEX (employee_id)');
		    $this->dbforge->create_table('pur_supplier_scorecard_standing', true);
    	}

    	if(!$this->db->table_exists('pur_supplier_quotation'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_quotation_id' => array(
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
	        'unsigned' => true
	        ),
	        'transaction_date' => array(
	        'type' => 'date',
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        ));

	        $this->dbforge->add_key('pur_supplier_quotation', true);
		    $this->dbforge->add_field('INDEX (supplier_quotation_id)');
		    
		    $this->dbforge->add_field('INDEX (supplier_id)');
		    $this->dbforge->add_field('INDEX (company_id)');
		    $this->dbforge->create_table('pur_supplier_quotation', true);
    	}

    	if(!$this->db->table_exists('pur_supplier_quo_address'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_quo_address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'supplier_quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'contact_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'address_display' => array(
	        'type' => 'text',
	        ),
	        'contact_mobile' => array(
	        'type' => 'text',
	        ),
	        'contact_display' => array(
	        'type' => 'text',
	        ),
	        'contact_email' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('supplier_quo_address_id', true);
		    $this->dbforge->add_field('INDEX (supplier_quotation_id)');
		    $this->dbforge->add_field('INDEX (address_id)');
		    $this->dbforge->add_field('INDEX (contact_id)');
		    $this->dbforge->create_table('pur_supplier_quo_address', true);
    	}

    	if(!$this->db->table_exists('pur_supplier_quo_currency_pricelist'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_quo_currency_pricelist_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'supplier_quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'currency_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'conversion_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'price_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'currency_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'plc_conversion_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'ignore_pricing_rule' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'base_total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'net_total' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('supplier_quo_currency_pricelist_id', true);
		    $this->dbforge->add_field('INDEX (supplier_quotation_id)');
		    $this->dbforge->add_field('INDEX (currency_id)');
		    $this->dbforge->add_field('INDEX (currency_id)');
		    $this->dbforge->add_field('INDEX (price_list_id)');
		    $this->dbforge->create_table('pur_supplier_quo_currency_pricelist', true);
    	}

    	if(!$this->db->table_exists('pur_supplier_quo_tax'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_quo_tax_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'supplier_quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'taxes_charges_template_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'other_charges_calculation' => array(
	        'type' => 'text', 
	        ),
	        'base_taxes_and_charges_added' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'base_taxes_and_charges_deducted' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'base_total_taxes_and_charges' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'taxes_and_charges_added' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'taxes_and_charges_deducted' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'total_taxes_and_charges' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'supplier_quo_apply_addi_disc_id' => array(
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

	        $this->dbforge->add_key('supplier_quo_tax_id', true);
		    $this->dbforge->add_field('INDEX (supplier_quotation_id)');
		    $this->dbforge->add_field('INDEX (taxes_charges_template_id)');
		    $this->dbforge->add_field('INDEX (supplier_quo_apply_addi_disc_id)');
		    $this->dbforge->create_table('pur_supplier_quo_tax', true);
    	}

    	if(!$this->db->table_exists('pur_supplier_quo_terms_conditions'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_quo_terms_conditions_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'supplier_quotation_id' => array(
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

	        $this->dbforge->add_key('supplier_quo_terms_conditions_id', true);
		    $this->dbforge->add_field('INDEX (supplier_quotation_id)');
		    $this->dbforge->add_field('INDEX (tc_id)');
		    $this->dbforge->create_table('pur_supplier_quo_terms_conditions', true);
    	}
    	if(!$this->db->table_exists('pur_supplier_quo_printing_settings'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_quo_printing_settings_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'supplier_quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'print_heading_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'letter_head_id' => array(
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

	        $this->dbforge->add_key('supplier_quo_printing_settings_id', true);
		    $this->dbforge->add_field('INDEX (supplier_quotation_id)');
		    $this->dbforge->add_field('INDEX (print_heading_id)');
		    $this->dbforge->add_field('INDEX (letter_head_id)');;
		    $this->dbforge->create_table('pur_supplier_quo_printing_settings', true);
    	}

    	if(!$this->db->table_exists('pur_supplier_quo_more_info'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_quo_more_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'supplier_quotation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'supplier_quo_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'purchase_sup_quo_order_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'opportunity_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        ));

	        $this->dbforge->add_key('supplier_quo_more_info_id', true);
		    $this->dbforge->add_field('INDEX (supplier_quotation_id)');
		    $this->dbforge->add_field('INDEX (supplier_quo_status_id)');
		    $this->dbforge->add_field('INDEX (purchase_sup_quo_order_id)');
		    $this->dbforge->add_field('INDEX (opportunity_id)');
		    $this->dbforge->create_table('pur_supplier_quo_more_info', true);
    	}
    }

    public function down()
    {
    	$this->dbforge->drop_table('pur_material_request', true);
    	$this->dbforge->drop_table('pur_request_for_quotation', true);
    	$this->dbforge->drop_table('pur_request_supplier_response_section', true);
    	$this->dbforge->drop_table('pur_request_printing_settings', true);
    	$this->dbforge->drop_table('pur_request_for_quotation_item', true);
    	$this->dbforge->drop_table('pur_request_for_quotation_supplier', true);
    	$this->dbforge->drop_table('pur_request_item_quantity', true);
    	$this->dbforge->drop_table('pur_request_item_warehouse_and_reference', true);
    	$this->dbforge->drop_table('pur_request_more_info', true);
    	$this->dbforge->drop_table('pur_buying_settings', true);
    	$this->dbforge->drop_table('pur_taxes_charges_template', true);
    	$this->dbforge->drop_table('pur_taxes_charges', true);
    	$this->dbforge->drop_table('pur_supplier_scorecard', true);
    	$this->dbforge->drop_table('pur_supplier_scorecard_variable', true);
    	$this->dbforge->drop_table('pur_supplier_scorecard_criteria', true);
    	$this->dbforge->drop_table('pur_supplier_scorecard_standing', true);
    	$this->dbforge->drop_table('pur_supplier_quotation', true);
    	$this->dbforge->drop_table('pur_supplier_quo_address', true);
    	$this->dbforge->drop_table('pur_supplier_quo_currency_pricelist', true);
    	$this->dbforge->drop_table('pur_supplier_quo_tax', true);
    	$this->dbforge->drop_table('pur_supplier_quo_terms_conditions', true);
    	$this->dbforge->drop_table('pur_supplier_quo_printing_settings', true);
    	$this->dbforge->drop_table('pur_supplier_quo_more_info', true);
    }
}