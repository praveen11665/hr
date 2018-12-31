<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_master extends CI_Migration 
{  
    public function up()
    {
    	if(!$this->db->table_exists('set_letter_head'))
	    {
	        $this->dbforge->add_field(array(
	        'letter_head_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'letter_head_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'is_disabled'=>array(
	        'type' => 'tinyint',
	        'constraint' => 4
	        ),
	        'is_default' => array(
	        'type' => 'tinyint',
	        'constraint' => 4
	        ),
	        'letter_head_content'=>array(
	        'type'=>'TEXT',
			'null'=>TRUE,
			),
			'letter_head_footer'=>array(
			'type'=>'TEXT',
			'null'=>TRUE,
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
	        $this->dbforge->add_key('letter_head_id', true);
	        $this->dbforge->create_table('set_letter_head',true); 
	    }

	    if(!$this->db->table_exists('set_terms_conditions'))
	    {
	        $this->dbforge->add_field(array(
	        'tc_id' => array(
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
	        'disabled' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'terms' => array(
	       	'type' => 'text'
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
	        $this->dbforge->add_key('tc_id', true);
	        $this->dbforge->create_table('set_terms_conditions', true);
    	}

	    if(!$this->db->table_exists('set_naming_series'))
	    {

	        $this->dbforge->add_field(array(
	        'naming_series_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'transaction_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'set_options'=>array(
	        'type' => 'text',
	        'null'=>false,
	        ),
	        'user_must_always_select'=>array(
	        'type' => 'tinyint',
            'constraint' => '4',
            ),
            'prefix_id'=>array(
            'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'current_value'=>array(
	        'type' => 'int',
	        'constraint' => 10,
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
	        $this->dbforge->add_key('naming_series_id', true);
	        $this->dbforge->create_table('set_naming_series',true); 
	    }

	    if(!$this->db->table_exists('set_printing_heading'))
	    {

	        $this->dbforge->add_field(array(
	        'printing_heading_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'printing_heading' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'description' => array(
	       	'type' => 'text'
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
	        $this->dbforge->add_key('printing_heading_id', true);
	        $this->dbforge->create_table('set_printing_heading',true); 
	    }

	    if(!$this->db->table_exists('inv_warehouse'))
	    {
	        $this->dbforge->add_field(array(
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'warehouse_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'is_group' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'unsigned' => true,
	        'constraint' => 10,
	        ),
	        'disabled' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'account_id' => array(
	        'type' => 'int',
	        'unsigned' => true,
	        'constraint' => 10
	        ),
	        'email_id' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'phone_no' => array(
	        'type' => 'varchar',
	        'constraint' => 50,
	        'null' => false
	        ),
	        'mobile_no' => array(
	        'type' => 'varchar',
	        'constraint' => 50,
	        'null' => false
	        ),
	        'address_line_1' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'address_line_2' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'city' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'state' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'pin' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'parent_warehouse_id' => array(
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

	        $this->dbforge->add_key('warehouse_id', true);
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (account_id)');
	        $this->dbforge->create_table('inv_warehouse', true);
    	}

    	if(!$this->db->table_exists('inv_item_attribute'))
	    {
	        $this->dbforge->add_field(array(
	        'item_attribute_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'attribute' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'numeric_values' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'from_range' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'increment' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'to_range' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
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

	        $this->dbforge->add_key('item_attribute_id', true);
	        $this->dbforge->create_table('inv_item_attribute', true);
    	}

    	if(!$this->db->table_exists('inv_item_attribute_values'))
	    {
	        $this->dbforge->add_field(array(
	        'item_attribute_values_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'item_attribute_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'attribute_value' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'abbr' => array(
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

	        $this->dbforge->add_key('item_attribute_values_id', true);
	        $this->dbforge->add_field('INDEX (item_attribute_id)');
	        $this->dbforge->create_table('inv_item_attribute_values', true);
    	}

    	if(!$this->db->table_exists('inv_brand'))
	    {
	        $this->dbforge->add_field(array(
	        'brand_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'brand' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'description' => array(
	        'type' => 'text',
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

	        $this->dbforge->add_key('brand_id', true);
	        $this->dbforge->create_table('inv_brand', true);
    	}

    	if(!$this->db->table_exists('inv_stock_settings'))
	    {
	        $this->dbforge->add_field(array(
	        'stock_settings_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'stock_setting_item_naming_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'stock_setting_default_valuation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'tolerance' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'show_barcode_field'=> array(
            'type' => 'tinyint',
            'constraint' => '4',
            ),
            'auto_insert_price_list_rate_if_missing'=> array(
            'type' => 'tinyint',
            'constraint' => '4',
            ),
            'allow_negative_stock'=> array(
            'type' => 'tinyint',
            'constraint' => '4',
            ),
            'automatically_set_serial_nos_based_on_fifo'=> array(
            'type' => 'tinyint',
            'constraint' => '4',
            ),
            'auto_indent'=> array(
            'type' => 'tinyint',
            'constraint' => '4',
            ),
            'reorder_email_notify'=> array(
            'type' => 'tinyint',
            'constraint' => '4',
            ),
            'stock_frozen_upto'=> array(
            'type' => 'date',
            ),
            'stock_frozen_upto_days'=> array(
            'type' => 'int',
            'constraint' => '10',
            ),
            'role_id' => array(
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

	        $this->dbforge->add_key('stock_settings_id', true);
	        $this->dbforge->add_field('INDEX (item_group_id)');
	        $this->dbforge->add_field('INDEX (stock_setting_item_naming_id)');
	        $this->dbforge->add_field('INDEX (uom_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
	        $this->dbforge->add_field('INDEX (stock_setting_default_valuation_id)');
	        $this->dbforge->add_field('INDEX (role_id)');
	        $this->dbforge->create_table('inv_stock_settings', true);
    	}

    	
    	if(!$this->db->table_exists('crm_campaign'))
		{
			$this->dbforge->add_field(array(
			'campaign_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'campaign_name'=>array(
			'type'=>'VARCHAR',
		 	'constraint'=>45,
		 	),
			'naming_series' => array(
	           'type' => 'varchar',
	           'constraint' => 255,
	           ),
			'description'=>array(
			'type'=>'TEXT',
			'null'=>TRUE,
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
			$this->dbforge->add_key('campaign_id',TRUE);
			
			$this->dbforge->create_table('crm_campaign');
		}

		if(!$this->db->table_exists('set_industry_type')) 
		{

			$this->dbforge->add_field(array(		    
		    'industry_type_id'=> array(
		    'type' => 'INT',
		    'constraint' => 10,
		    'unsigned' => TRUE,
		    'auto_increment' => TRUE
		    ),
		    'industry_type'=> array(
		    'type' => 'VARCHAR',
		   	'constraint' => '250',
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
			$this->dbforge->add_key('industry_type_id',TRUE);
			$this->dbforge->create_table('set_industry_type');
		}

		if(!$this->db->table_exists('inv_manufacturer'))
		{
			$this->dbforge->add_field(array(
			'manufacturer_id'=>array(
		    'type' => 'INT',
		    'constraint' => 10,
		    'unsigned' => TRUE,
		    'auto_increment' => TRUE
		    ),
			'short_name'=>array(
			'type'=>'varchar',
			'constraint' => 255,
	        'null' => 'false',
	        ),
	        'full_name'=>array(
	        'type'=>'varchar',
			'constraint' => 255,
	        'null' => 'false',
	        ),
			'website'=>array(
			'type'=>'varchar',
			'constraint' => 255,
	        'null' => false,
	        ),
			'country_id'=>array(
			'type' => 'INT',
		    'constraint' => 10,
		     'unsigned' => TRUE,
		    ),
			'logo'=>array(
			'type' => 'text',
	        'null' => false
	        ),
			'notes'=>array(
			'type' => 'text',
	        'null' => false,
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
			$this->dbforge->add_key('manufacturer_id',TRUE);
			$this->dbforge->add_field('INDEX (country_id)');
			$this->dbforge->create_table('inv_manufacturer');
		}

		if(!$this->db->table_exists('inv_custom_tariff_number'))
		{
			$this->dbforge->add_field(array(
			'tariff_id'=>array(
			'type' => 'INT',
		    'constraint' => 10,
		    'unsigned' => TRUE,
		    'auto_increment' => TRUE
		    ),
			'tariff_number'=>array(
			'type'=>'varchar',
			'constraint' => 255,
	       	'null' => 'false',
	        ),
			'description'=>array(
			'type' => 'text',
	        'null' => false,
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
	       	$this->dbforge->add_key('tariff_id',TRUE);
			$this->dbforge->create_table('inv_custom_tariff_number');
		}

		if(!$this->db->table_exists('man_workstation'))
		{
			$this->dbforge->add_field(array(
			'workstation_id'=>array(
			'type' => 'INT',
		    'constraint' => 10,
		    'unsigned' => TRUE,
		    'auto_increment' => TRUE
		    ),
		    'workstation_name'=>array(
		    'type'=>'varchar',
			'constraint' => 255,
	       	'null' => 'false',
	       	),
	       	'description'=>array(
	       	'type'=>'TEXT',
			'null'=>TRUE,
			),
			'hour_rate_electricity'=>array(
			'type' =>'decimal',
            'constraint' => '9,2',
            'null' => FALSE,
            ),
            'hour_rate_consumable'=>array(
			'type' =>'decimal',
            'constraint' => '9,2',
            'null' => FALSE,
            ),
            'hour_rate_rent'=>array(
			'type' =>'decimal',
            'constraint' => '9,2',
            'null' => FALSE,
            ),
            'hour_rate_labour'=>array(
			'type' =>'decimal',
            'constraint' => '9,2',
            'null' => FALSE,
            ),
            'hour_rate'=>array(
			'type' =>'decimal',
            'constraint' => '9,2',
            'null' => FALSE,
            ),
            'holiday_list_id'=>array(
            'type' => 'INT',
		    'constraint' => 10,
		    'unsigned' => TRUE,
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
		    $this->dbforge->add_key('workstation_id',TRUE);
		    $this->dbforge->add_field('INDEX (holiday_list_id)');
			$this->dbforge->create_table('man_workstation');
		}

		if(!$this->db->table_exists('man_operation'))
		{
			$this->dbforge->add_field(array(
			'operation_id'=>array(
			'type' => 'INT',
		    'constraint' => 10,
		    'unsigned' => TRUE,
		    'auto_increment' => TRUE
		    ),
		    'workstation_id'=>array(
		    'type' => 'INT',
		    'constraint' => 10,
		    'unsigned' => TRUE,
		    ),
		    'operation_name'=>array(
		    'type'=>'varchar',
			'constraint' => 255,
	       	'null' => 'false',
	       	),
	       	'operation_description'=>array(
	       	'type' => 'text',
	        'null' => false,
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
	        $this->dbforge->add_key('operation_id',TRUE);
		    $this->dbforge->add_field('INDEX (workstation_id)');
			$this->dbforge->create_table('man_operation');
		}

		if(!$this->db->table_exists('man_bom'))
	    {
	        $this->dbforge->add_field(array(
	        'bom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'quantity' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'is_active' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'is_default' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'with_operations' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'bom_rate_of_material_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'price_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'set_rate_of_sub_assembly_item_based_on_bom' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'currency_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'conversion_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'operating_cost' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'raw_material_cost' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'scrap_material_cost' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'base_operating_cost' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'base_raw_material_cost' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'base_scrap_material_cost' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'total_cost' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'base_total_cost' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'project_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'description' => array(
	        'type' => 'text',
	        ),
	        'image' => array(
	        'type' => 'text',
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

	        $this->dbforge->add_key('bom_id', true);
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (bom_rate_of_material_id)');
	        $this->dbforge->add_field('INDEX (price_list_id)');
	        $this->dbforge->add_field('INDEX (currency_id)');
	        $this->dbforge->add_field('INDEX (project_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (uom_id)');
	        $this->dbforge->create_table('man_bom', true);
    	}

    	if(!$this->db->table_exists('man_bom_item'))
	    {
	        $this->dbforge->add_field(array(
	        'bom_item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'bom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_name' => array(
		    'type' => 'varchar',
		    'constraint' => 255,
		    'null' => false
		    ),
		    'bom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'description' => array(
		    'type' => 'text',
		    ),
		    'image' => array(
	        'type' => 'text',
	        ),
	        'image_view' => array(
	        'type' => 'text',
	        ),
	        'qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'stock_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
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
	        'null' => false
	        ),
	        'rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'base_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'base_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'scrap' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'qty_consumed_per_unit' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
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

	        $this->dbforge->add_key('bom_item_id', true);
	        $this->dbforge->add_field('INDEX (bom_id)');
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (bom_id)');
	        $this->dbforge->add_field('INDEX (uom_id)');
	        $this->dbforge->add_field('INDEX (uom_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
	        $this->dbforge->create_table('man_bom_item', true);
    	}

    	if(!$this->db->table_exists('man_bom_scrap_item'))
	    {
	        $this->dbforge->add_field(array(
	        'bom_scrap_item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'bom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_name' => array(
		    'type' => 'varchar',
		    'constraint' => 255,
		    'null' => false
		    ),
	        'stock_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'base_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'base_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
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

	        $this->dbforge->add_key('bom_scrap_item_id', true);
	        $this->dbforge->add_field('INDEX (bom_id)');
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (uom_id)');
	        $this->dbforge->create_table('man_bom_scrap_item', true);
    	}

    	if(!$this->db->table_exists('man_bom_explosion_item'))
	    {
	        $this->dbforge->add_field(array(
	        'bom_explosion_item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'bom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_name' => array(
		    'type' => 'varchar',
		    'constraint' => 255,
		    'null' => false
		    ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'description' => array(
		    'type' => 'text',
		    ),
		    'image' => array(
	        'type' => 'text',
	        ),
	        'image_view' => array(
	        'type' => 'text',
	        ),
	        'stock_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'qty_consumed_per_unit' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
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

	        $this->dbforge->add_key('bom_explosion_item_id', true);
	        $this->dbforge->add_field('INDEX (bom_id)');
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
	        $this->dbforge->add_field('INDEX (uom_id)');
	        $this->dbforge->create_table('man_bom_explosion_item', true);
    	}
    	if(!$this->db->table_exists('set_country'))
	    {
	        $this->dbforge->add_field(array(
	        'country_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'country_name'=>array(
	        'type' => 'varchar',
		    'constraint' => 255,
		    'null' => false
		    ),
		    'date_formate'=>array(
		    'type' => 'varchar',
		    'constraint' => 255,
		    'null' => false
		    ),
		    'time_zones'=>array(
		    'type' => 'varchar',
		    'constraint' => 255,
		    'null' => false
		    ),
		    'code'=>array(
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
		    $this->dbforge->add_key('country_id', true);
		    $this->dbforge->create_table('set_country', true);
		}

		if(!$this->db->table_exists('set_uom'))
	    {
	        $this->dbforge->add_field(array(
	        'uom_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'uom_name'=>array(
	        'type' => 'varchar',
		    'constraint' => 255,
		    'null' => false
		    ),
		    'must_be_whole_number'=>array(
		    'type' => 'tinyint',
	       	'constraint' => '4',
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
	       	$this->dbforge->add_key('uom_id', true);
		    $this->dbforge->create_table('set_uom', true);
		}

		if(!$this->db->table_exists('inv_item'))
	    {
	        $this->dbforge->add_field(array(
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'naming_series' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'item_code' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'gst_hsn_code_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'barcode' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'item_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'disabled' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'is_stock_item' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'opening_stock' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'valuation_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'standard_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'is_fixed_asset' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'asset_category_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'null' => false
	        ),
	        'tolerance' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'image' => array(
	        'type' => 'text',
	        ),
	        'brand_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'description' => array(
	        'type' => 'text',
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
	        $this->dbforge->add_key('item_id', true);
	        
	        $this->dbforge->add_field('INDEX (item_group_id)');
	        $this->dbforge->add_field('INDEX (uom_id)');
	        $this->dbforge->add_field('INDEX (asset_category_id)');
	        $this->dbforge->add_field('INDEX (brand_id)');
	        $this->dbforge->create_table('inv_item', true);
    	}

    	if(!$this->db->table_exists('inv_item_inventory'))
	    {
	        $this->dbforge->add_field(array(
	        'item_inventory_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'end_of_life' => array(
	        'type' => 'date',
	        'null' => false
	        ),
	        'item_pricing_default_material_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_pricing_valuation_method_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'warranty_period' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'net_weight' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
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

	        $this->dbforge->add_key('item_inventory_id', true);
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
	        $this->dbforge->add_field('INDEX (item_pricing_default_material_id)');
	        $this->dbforge->add_field('INDEX (item_pricing_valuation_method_id)');
	        $this->dbforge->add_field('INDEX (uom_id)');
	        $this->dbforge->create_table('inv_item_inventory', true);
    	}

    	if(!$this->db->table_exists('inv_item_serial_nos_batches'))
	    {
	        $this->dbforge->add_field(array(
	        'item_serial_nos_batches_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'has_batch_no' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'create_new_batch' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'has_serial_no' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ), 
	        'serial_no_series' => array(
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

	        $this->dbforge->add_key('item_serial_nos_batches_id', true);
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->create_table('inv_item_serial_nos_batches', true);
    	} 

    	if(!$this->db->table_exists('inv_item_variants_section'))
	    {
	        $this->dbforge->add_field(array(
	        'item_variants_section_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'has_variants' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'item_pricing_variant_id' => array(
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

	        $this->dbforge->add_key('item_variants_section_id', true);
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (item_pricing_variant_id)');
	        $this->dbforge->create_table('inv_item_variants_section', true);
    	}

    	if(!$this->db->table_exists('inv_item_purchase_details'))
	    {
	        $this->dbforge->add_field(array(
	        'item_purchase_details_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'is_purchase_item' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'min_order_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'safety_stock' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'lead_time_days' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'cost_center_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'account_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'last_purchase_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
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

	        $this->dbforge->add_key('item_purchase_details_id', true);
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (cost_center_id)');
	        $this->dbforge->add_field('INDEX (account_id)');
	        $this->dbforge->create_table('inv_item_purchase_details', true);
    	}

    	if(!$this->db->table_exists('inv_item_supplier_details'))
	    {
	        $this->dbforge->add_field(array(
	        'item_supplier_details_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'supplier_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'delivered_by_supplier' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'manufacturer_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'manufacturer_part_no' => array(
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

	        $this->dbforge->add_key('item_supplier_details_id', true);
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (supplier_id)');
	        $this->dbforge->add_field('INDEX (manufacturer_id)');
	        $this->dbforge->create_table('inv_item_supplier_details', true);
    	}

    	if(!$this->db->table_exists('inv_item_foreign_trade_details'))
		{
		    $this->dbforge->add_field(array(
		    'item_foreign_trade_details_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
		    'country_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    ),
		    'tariff_id'=>array(
			'type' => 'INT',
		    'constraint' => 10,
		    'unsigned' => TRUE
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

		    $this->dbforge->add_key('item_foreign_trade_details_id', true);
		    $this->dbforge->add_field('INDEX (item_id)');
		    $this->dbforge->add_field('INDEX (country_id)');
		    $this->dbforge->add_field('INDEX (tariff_id)');
		    $this->dbforge->create_table('inv_item_foreign_trade_details', true);
		}

		if(!$this->db->table_exists('inv_item_sales_details'))
		{
		    $this->dbforge->add_field(array(
		    'item_sales_details_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
		    'is_sales_item' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
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
	        'max_discount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
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

		    $this->dbforge->add_key('item_sales_details_id', true);
		    $this->dbforge->add_field('INDEX (item_id)');
		    $this->dbforge->add_field('INDEX (account_id)');
		    $this->dbforge->add_field('INDEX (cost_center_id)');
		    $this->dbforge->create_table('inv_item_sales_details', true);
		}

		if(!$this->db->table_exists('inv_item_inspection_criteria'))
		{
		    $this->dbforge->add_field(array(
		    'item_inspection_criteria_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
		    'inspection_required_before_purchase' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'inspection_required_before_delivery' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
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

		    $this->dbforge->add_key('item_inspection_criteria_id', true);
		    $this->dbforge->add_field('INDEX (item_id)');
		    $this->dbforge->create_table('inv_item_inspection_criteria', true);
		}

		if(!$this->db->table_exists('inv_item_manufacturing'))
		{
		    $this->dbforge->add_field(array(
		    'item_manufacturing_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
		    'bom_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    ),
		    'is_sub_contracted_item' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'customer_code' => array(
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

		    $this->dbforge->add_key('item_manufacturing_id', true);
		    $this->dbforge->add_field('INDEX (item_id)');
		    $this->dbforge->add_field('INDEX (bom_id)');
		    $this->dbforge->create_table('inv_item_manufacturing', true);
		}

		if(!$this->db->table_exists('inv_item_reorder'))
		{
		    $this->dbforge->add_field(array(
		    'item_reorder_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'warehouse_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'warehouse_reorder_level' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'warehouse_reorder_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'material_request_id' => array(
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

		    $this->dbforge->add_key('item_reorder_id', true);
		    $this->dbforge->add_field('INDEX (item_id)');
		    $this->dbforge->add_field('INDEX (warehouse_id)');
		    $this->dbforge->add_field('INDEX (warehouse_id)');
		    $this->dbforge->add_field('INDEX (material_request_id)');
		    $this->dbforge->create_table('inv_item_reorder', true);
		}

		if(!$this->db->table_exists('inv_item_uom_conversion'))
		{
		    $this->dbforge->add_field(array(
		    'uom_conversion_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
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

		    $this->dbforge->add_key('uom_conversion_id', true);
		    $this->dbforge->add_field('INDEX (item_id)');
		    $this->dbforge->add_field('INDEX (uom_id)');
		    $this->dbforge->create_table('inv_item_uom_conversion', true);
		}

		if(!$this->db->table_exists('inv_item_variant_attribute'))
		{
		    $this->dbforge->add_field(array(
		    'item_variant_attribute_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_attribute_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'attribute_value' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'numeric_values' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'from_range' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'increment' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'to_range' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
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

		    $this->dbforge->add_key('item_variant_attribute_id', true);
		    $this->dbforge->add_field('INDEX (item_id)');
		    $this->dbforge->add_field('INDEX (item_attribute_id)');
		    $this->dbforge->create_table('inv_item_variant_attribute', true);
		}

		if(!$this->db->table_exists('inv_item_customer_detail'))
		{
		    $this->dbforge->add_field(array(
		    'item_customer_detail_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'customer_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'ref_code' => array(
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

		    $this->dbforge->add_key('item_customer_detail_id', true);
		    $this->dbforge->add_field('INDEX (item_id)');
		    $this->dbforge->add_field('INDEX (customer_id)');
		    $this->dbforge->create_table('inv_item_customer_detail', true);
		}

		if(!$this->db->table_exists('inv_item_supplier'))
		{
		    $this->dbforge->add_field(array(
		    'item_supplier_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'supplier_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'supplier_part_no' => array(
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

		    $this->dbforge->add_key('item_supplier_id', true);
		    $this->dbforge->add_field('INDEX (item_id)');
		    $this->dbforge->add_field('INDEX (supplier_id)');
		    $this->dbforge->create_table('inv_item_supplier', true);
		}

		if(!$this->db->table_exists('inv_item_tax'))
		{
		    $this->dbforge->add_field(array(
		    'item_tax_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'account_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'tax_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
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

		    $this->dbforge->add_key('item_tax_id', true);
		    $this->dbforge->add_field('INDEX (item_id)');
		    $this->dbforge->add_field('INDEX (account_id)');
		    $this->dbforge->create_table('inv_item_tax', true);
		}

		if(!$this->db->table_exists('inv_item_quality_inspection_parameter'))
		{
		    $this->dbforge->add_field(array(
		    'item_quality_inspection_parameter_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'specification' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'value' => array(
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

		    $this->dbforge->add_key('item_quality_inspection_parameter_id', true);
		    $this->dbforge->add_field('INDEX (item_id)');
		    $this->dbforge->create_table('inv_item_quality_inspection_parameter', true);
		}

		if(!$this->db->table_exists('inv_pricing_rule'))
	    {
	        $this->dbforge->add_field(array(
	        'pricing_rule_id' => array(
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
	        'pricing_rule_apply_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'brand_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'pricing_rule_priority_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'disable' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'buying' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'selling' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'pricing_rule_applicable_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'customer_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
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
	        'sales_partner_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'campaign_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'supplier_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'supplier_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'min_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'max_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'valid_from' => array(
	        'type' => 'date',
	        ),
	        'valid_upto' => array(
	        'type' => 'date',
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'pricing_rule_margin_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'margin_rate_or_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'pricing_rule_price_discount_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'price' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'discount_percentage' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'price_list_id' => array(
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

	        $this->dbforge->add_key('pricing_rule_id', true);
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (brand_id)');
	        $this->dbforge->add_field('INDEX (item_group_id)');
	        $this->dbforge->add_field('INDEX (customer_id)');
	        $this->dbforge->add_field('INDEX (customer_group_id)');
	        $this->dbforge->add_field('INDEX (territory_id)');
	        $this->dbforge->add_field('INDEX (sales_partner_id)');
	        $this->dbforge->add_field('INDEX (campaign_id)');
	        $this->dbforge->add_field('INDEX (supplier_id)');
	        $this->dbforge->add_field('INDEX (supplier_type_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (price_list_id)');
	        $this->dbforge->add_field('INDEX (pricing_rule_apply_id)'); 
	        $this->dbforge->add_field('INDEX (pricing_rule_priority_id)'); 
	        $this->dbforge->add_field('INDEX (pricing_rule_applicable_id)');
	        $this->dbforge->add_field('INDEX (pricing_rule_margin_type_id)');
	        $this->dbforge->add_field('INDEX (pricing_rule_price_discount_id)');   
	        $this->dbforge->create_table('inv_pricing_rule', true);
    	}

    	if(!$this->db->table_exists('inv_item_group'))
		{
		    $this->dbforge->add_field(array(
		    'item_group_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'item_group_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'parent_item_group' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'default' => null,
		    'null' => true
		    ),
		    'is_group'=> array(
            'type' => 'tinyint',
            'constraint' => '4',
            ),
            'is_active'=> array(
            'type' => 'tinyint',
            'constraint' => '4',
            ),
            'default_income_account' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    ),
		    'default_expense_account' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    ),
		    'default_cost_center' => array(
		    'type' => 'int',
		    'constraint' => 10,
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

		    $this->dbforge->add_key('item_group_id', true);
		    $this->dbforge->add_field('INDEX (item_group_id)');
		    $this->dbforge->add_field('INDEX (default_income_account)');
		    $this->dbforge->add_field('INDEX (default_expense_account)');
		    $this->dbforge->add_field('INDEX (default_cost_center)');
		    $this->dbforge->create_table('inv_item_group', true);
		}

		if(!$this->db->table_exists('pur_supplier'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'naming_series' => array(
	           'type' => 'varchar',
	           'constraint' => 255,
	           ),
	        'supplier_name'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'country_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'tax_id'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'image'=>array(
	        'type'=>'text',
	        ),
	        'supplier_type_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'language_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'disabled'=>array(
	        'type'=>'tinyint',
			'constraint' => '4',
			),
			'warn_rfqs'=>array(
			'type'=>'tinyint',
			'constraint' => '4',
			),
			'warn_pos'=>array(
			'type'=>'tinyint',
			'constraint' => '4',
			),
			'prevent_rfqs'=>array(
			'type'=>'tinyint',
			'constraint' => '4',
			),
			'prevent_pos'=>array(
			'type'=>'tinyint',
			'constraint' => '4',
			),
			'currency_id'=>array(
			'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'price_list_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'supplier_credit_limit_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
	        'credit_days'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'address_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'contact_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
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
			$this->dbforge->add_key('supplier_id', true);
			$this->dbforge->add_field('INDEX (country_id)');
			$this->dbforge->add_field('INDEX (supplier_type_id)');
			$this->dbforge->add_field('INDEX (language_id)');
			$this->dbforge->add_field('INDEX (currency_id)');
			$this->dbforge->add_field('INDEX (price_list_id)');
			$this->dbforge->add_field('INDEX (address_id)');
			$this->dbforge->add_field('INDEX (contact_id)');
			$this->dbforge->add_field('INDEX (supplier_credit_limit_id)');
			$this->dbforge->create_table('pur_supplier', true);
		}

		if(!$this->db->table_exists('pur_supplier_account'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_account_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'supplier_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'company_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'account_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        ));
			$this->dbforge->add_key('supplier_account_id', true);
			$this->dbforge->add_field('INDEX (supplier_id)');
			$this->dbforge->add_field('INDEX (company_id)');
			$this->dbforge->add_field('INDEX (account_id)');
			$this->dbforge->create_table('pur_supplier_account', true);
		}

		if(!$this->db->table_exists('man_manufacturing_settings'))
	    {
	        $this->dbforge->add_field(array(
		    'manufacturing_settings_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'disable_capacity_planning' => array(
		    'type' => 'tinyint',
		    'constraint' => 4,
		    'null' => false
		    ),
		    'allow_overtime' => array(
		    'type' => 'tinyint',
		    'constraint' => 4,
		    'null' => false
		    ),
		    'allow_production_on_holidays' => array(
		    'type' => 'tinyint',
		    'constraint' => 4,
		    'null' => false
		    ),
		    'capacity_planning_for_days' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'null' => false
		    ),
		    'mins_between_operations' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'null' => false
		    ),
		    'over_production_allowance_percentage' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
		    ),
		    'back_flush_raw_material_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
		    'warehouse_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true
		    ),
		    'warehouse_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true
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

	        $this->dbforge->add_key('manufacturing_settings_id', true);
		    $this->dbforge->add_field('INDEX (warehouse_id)');
		    $this->dbforge->add_field('INDEX (warehouse_id)');
		    $this->dbforge->add_field('INDEX (back_flush_raw_material_id)');
		    $this->dbforge->create_table('man_manufacturing_settings', true);
    	}

    	if(!$this->db->table_exists('man_manufacturing_raw_material_type'))
	    {
	        $this->dbforge->add_field(array(
		    'raw_material_type_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'manufacturing_settings_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    ),
		    'raw_material' => array(
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

	        $this->dbforge->add_key('raw_material_type_id', true);
		    $this->dbforge->add_field('INDEX (manufacturing_settings_id)');
		    $this->dbforge->create_table('man_manufacturing_raw_material_type', true);
    	}
    	if(!$this->db->table_exists('sales_selling_settings'))
	    {
	        $this->dbforge->add_field(array(
	        'selling_settings_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'selling_set_customer_naming_by_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'selling_set_campaign_naming_by_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'customer_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'territory_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'price_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'close_opportunity_after_days' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'sales_order_required_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'sales_delivery_note_required_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'maintain_same_sales_rate' => array(
		    'type' => 'tinyint',
		    'constraint' => 4,
		    'null' => false
	        ),
	        'editable_price_list_rate' => array(
		    'type' => 'tinyint',
		    'constraint' => 4,
		    'null' => false
	        ),
	        'allow_multiple_items' => array(
		    'type' => 'tinyint',
		    'constraint' => 4,
		    'null' => false
	        ),
	        'allow_against_multiple_purchase_orders' => array(
		    'type' => 'tinyint',
		    'constraint' => 4,
		    'null' => false
	        ),
	        'validate_selling_price' => array(
		    'type' => 'tinyint',
		    'constraint' => 4,
		    'null' => false
	        ),
	        'hide_tax_id' => array(
		    'type' => 'tinyint',
		    'constraint' => 4,
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

	        $this->dbforge->add_key('selling_settings_id', true);
		    $this->dbforge->add_field('INDEX (price_list_id)');
		    $this->dbforge->add_field('INDEX (territory_id)');
		    $this->dbforge->add_field('INDEX (customer_group_id)');
		    $this->dbforge->add_field('INDEX (sales_order_required_id)');
		    $this->dbforge->add_field('INDEX (sales_delivery_note_required_id)');
		    $this->dbforge->create_table('sales_selling_settings', true);
    	}

    	if(!$this->db->table_exists('sales_taxes_charges_template'))
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
		    $this->dbforge->create_table('sales_taxes_charges_template', true);
    	}

    	if(!$this->db->table_exists('sales_taxes_charges'))
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
	        'charge_type' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
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
		    $this->dbforge->create_table('sales_taxes_charges', true);
    	}

    	if(!$this->db->table_exists('inv_price_list'))
	    {
	        $this->dbforge->add_field(array(
	        'price_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'price_list_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'currency_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'buying' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'selling' => array(
	        'type' => 'tinyint',
	        'constraint' => 4, 
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

	        $this->dbforge->add_key('price_list_id', true);
	        $this->dbforge->add_field('INDEX (currency_id)');
	        $this->dbforge->create_table('inv_price_list', true);
    	} 

    	if(!$this->db->table_exists('inv_item_price'))
    	{
    		$this->dbforge->add_field(array(
	        'item_price_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'price_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'buying' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'selling' => array(
	        'type' => 'tinyint',
	        'constraint' => 4, 
	        ),
	        'currency_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'price_list_rate'=>array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'item_name'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'item_description'=>array(
	        'type'=>'TEXT',
			'null'=>TRUE,
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

	        $this->dbforge->add_key('item_price_id', true);
	        $this->dbforge->add_field('INDEX (price_list_id)');
	        $this->dbforge->add_field('INDEX (currency_id)');
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->create_table('inv_item_price', true);
    	}

    	if(!$this->db->table_exists('inv_shipping_rule'))
    	{
    		$this->dbforge->add_field(array(
	        'shipping_rule_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'label'=>array(
	       	'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'disabled'=>array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'calculate_based_on'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'worldwide_shipping'=>array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        ),
	        'company_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'account_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'cost_center_id'=>array(
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
	        $this->dbforge->add_key('shipping_rule_id', true);
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (account_id)');
	        $this->dbforge->add_field('INDEX (cost_center_id)');
	        $this->dbforge->create_table('inv_shipping_rule', true);
    	}

    	if(!$this->db->table_exists('inv_shipping_rule_condition'))
    	{
    		$this->dbforge->add_field(array(
	        'shipping_condition_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'shipping_rule_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'from_value'=>array(
	        'type' => 'float',
       		'constraint' => 10,2,
        	'null' => false
        	),
        	'to_value'=>array(
        	'type' => 'float',
       		'constraint' => 10,2,
        	'null' => false
        	),
        	'shipping_amount'=>array(
        	'type' => 'decimal',
	        'constraint' => '9,2',
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
	      	$this->dbforge->add_key('shipping_condition_id', true);
	        $this->dbforge->add_field('INDEX (shipping_rule_id)');
	        $this->dbforge->create_table('inv_shipping_rule_condition', true);  
	    }

	    if(!$this->db->table_exists('inv_shipping_rule_country'))
    	{
    		$this->dbforge->add_field(array(
	        'shipping_country_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'shipping_rule_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'country_id'=>array(
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
	    	$this->dbforge->add_key('shipping_country_id', true);
	    	$this->dbforge->add_field('INDEX (shipping_rule_id)');
	        $this->dbforge->add_field('INDEX (country_id)');
	        $this->dbforge->create_table('inv_shipping_rule_country', true);
	    }

	    if(!$this->db->table_exists('pur_supplier_type'))
    	{
    		$this->dbforge->add_field(array(
	        'supplier_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'supplier_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'supplier_credit_limit_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
	        'credit_days'=>array(
	        'type'=>'int',
	        'constraint'=>10,
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
	     	$this->dbforge->add_key('supplier_type_id', true);
	     	$this->dbforge->create_table('pur_supplier_type', true);
	    }

	    if(!$this->db->table_exists('crm_lead_source'))
    	{
    		$this->dbforge->add_field(array(
	        'lead_source_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'source_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'details' => array(
	       	'type' => 'longtext'
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
	     	$this->dbforge->add_key('lead_source_id', true);
	     	$this->dbforge->create_table('crm_lead_source', true);
	    }

	    if(!$this->db->table_exists('pro_project_type'))
    	{
    		$this->dbforge->add_field(array(
	        'project_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'project_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'description' => array(
	       	'type' => 'text'
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
	     	$this->dbforge->add_key('project_type_id', true);
	     	$this->dbforge->create_table('pro_project_type', true);
	    }

	    if(!$this->db->table_exists('pro_activity_type'))
    	{
    		$this->dbforge->add_field(array(
	        'activity_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'activity_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'costing_rate' => array(
	       	'type' => 'decimal',
	       	'constraint' => '9,2'
	        ),
	        'billing_rate' => array(
	       	'type' => 'decimal',
	       	'constraint' => '9,2'
	        ),
	        'disabled' => array(
	       	'type' => 'tinyint',
	       	'constraint' => 4
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
	     	$this->dbforge->add_key('activity_type_id', true);
	     	$this->dbforge->create_table('pro_activity_type', true);
	    }

	    if(!$this->db->table_exists('crm_customer_group'))
		{
			$this->dbforge->add_field(array(
			'customer_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
			'customer_group_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
			'parent_customer_group'=>array(
			'type'=>'int',
		 	'constraint'=>10,
		 	'null' => true,
		 	'default' => null
		 	),
			'is_group'=>array(
			'type'=>'tinyint',
			'constant'=>4,
			),
			'price_list_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'customer_credit_days_based_id'=>array(
			'type'=>'int',
			'constraint'=>10,
			'unsigned' => true
			),
			'credit_days'=>array(
			'type'=>'INT',
			'constraint'=>10,
			),
			'credit_limit'=>array(
			'type'=>'decimal',
			'constraint'=>9,2,
			),
			'lft'=>array(
			'type'=>'INT',
			'constraint'=>10,
			),
			'rgt'=>array(
			'type'=>'INT',
			'constraint'=>10,
			),
			'old_parent'=>array(
			'type'=>'INT',
			'constraint'=>10,
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
			$this->dbforge->add_key('customer_group_id',TRUE);
			$this->dbforge->add_field('INDEX (parent_customer_group)');
			$this->dbforge->add_field('INDEX (customer_credit_days_based_id)');
			$this->dbforge->add_field('INDEX (price_list_id)');
			$this->dbforge->create_table('crm_customer_group');
		}

		if(!$this->db->table_exists('crm_customer_account'))
		{
			$this->dbforge->add_field(array(
			'customer_account_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'customer_group_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'company_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'account_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
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
			$this->dbforge->add_key('customer_account_id',TRUE);
			$this->dbforge->add_field('INDEX (customer_group_id)');
			$this->dbforge->add_field('INDEX (company_id)');
			$this->dbforge->add_field('INDEX (account_id)');
			$this->dbforge->create_table('crm_customer_account');
		}

		if(!$this->db->table_exists('set_currency'))
		{
			$this->dbforge->add_field(array(
			'currency_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'currency_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'is_enabled'=>array(
	        'type' => 'tinyint',
	        'constraint' => 1
	        ),
	        'fraction' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'fraction_units' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'smallest_currency_fraction_value' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'symbol' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'number_formate' => array(
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
			$this->dbforge->add_key('currency_id',TRUE);
			$this->dbforge->create_table('set_currency');
		}

		if(!$this->db->table_exists('set_company'))
		{
			$this->dbforge->add_field(array(
			'company_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'company_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'abbr' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'company_domain_id' => array(
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
			$this->dbforge->add_key('company_id',TRUE);
			$this->dbforge->add_field('INDEX (company_domain_id)');
			$this->dbforge->create_table('set_company');
		}

		if(!$this->db->table_exists('set_company_default_values'))
		{
			$this->dbforge->add_field(array(
			'company_default_values_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'company_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'letter_head_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'holiday_list_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'tc_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'currency_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'country_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'company_chart_of_accounts_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
			'chart_of_accounts_template_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned' => true,
			),
			'existing_company'=>array(
			'type'=>'INT',
			'constraint'=>10,
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
			$this->dbforge->add_key('company_default_values_id',TRUE);
			$this->dbforge->add_field('INDEX (company_id)');
			$this->dbforge->add_field('INDEX (letter_head_id)');
			$this->dbforge->add_field('INDEX (holiday_list_id)');
			$this->dbforge->add_field('INDEX (tc_id)');
			$this->dbforge->add_field('INDEX (currency_id)');
			$this->dbforge->add_field('INDEX (country_id)');
			$this->dbforge->add_field('INDEX (company_chart_of_accounts_id)');
			$this->dbforge->add_field('INDEX (chart_of_accounts_template_id)');
			$this->dbforge->add_field('INDEX (existing_company)');
			$this->dbforge->create_table('set_company_default_values');
		}

		if(!$this->db->table_exists('set_company_sales_settings'))
		{
			$this->dbforge->add_field(array(
			'company_sales_settings_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'company_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'sales_monthly_history'=>array(
			'type'=>'text',
			),
			'sales_target' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'total_monthly_sales' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
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
			$this->dbforge->add_key('company_sales_settings_id',TRUE);
			$this->dbforge->add_field('INDEX (company_id)');
			$this->dbforge->create_table('set_company_sales_settings');
		}

		if(!$this->db->table_exists('set_company_account_settings'))
		{
			$this->dbforge->add_field(array(
			'company_account_settings_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'company_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
	        'default_bank_account' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'default_cash_account' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'default_receivable_account' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'round_off_account' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'write_off_account' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'exchange_gain_loss_account' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'default_payable_account' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'default_expense_account' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'default_income_account' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'default_payroll_payable_account' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'round_off_cost_center' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'default_cost_center' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'credit_limit' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'customer_credit_days_based_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
			'credit_days'=>array(
			'type'=>'INT',
			'constraint'=>10,
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
			$this->dbforge->add_key('company_account_settings_id',TRUE);
			$this->dbforge->add_field('INDEX (company_id)');
			$this->dbforge->add_field('INDEX (default_bank_account)');
			$this->dbforge->add_field('INDEX (default_cash_account)');
			$this->dbforge->add_field('INDEX (default_receivable_account)');
			$this->dbforge->add_field('INDEX (round_off_account)');
			$this->dbforge->add_field('INDEX (write_off_account)');
			$this->dbforge->add_field('INDEX (exchange_gain_loss_account)');
			$this->dbforge->add_field('INDEX (default_payable_account)');
			$this->dbforge->add_field('INDEX (default_expense_account)');
			$this->dbforge->add_field('INDEX (default_income_account)');
			$this->dbforge->add_field('INDEX (default_payroll_payable_account)');
			$this->dbforge->add_field('INDEX (round_off_cost_center)');
			$this->dbforge->add_field('INDEX (default_cost_center)');
			$this->dbforge->add_field('INDEX (customer_credit_days_based_id)');
			$this->dbforge->create_table('set_company_account_settings');
		}

		if(!$this->db->table_exists('set_company_auto_account_stock_settings'))
		{
			$this->dbforge->add_field(array(
			'company_auto_account_stock_settings_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'company_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'enable_perpetual_inventory' => array(
	        'type' => 'tinyint',
	        'constraint' => 1
	        ),
	        'default_inventory_account' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'stock_adjustment_account' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'stock_received_but_not_billed' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'expenses_included_in_valuation' => array(
	        'type' => 'int',
	        'constraint' => 10
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
			$this->dbforge->add_key('company_auto_account_stock_settings_id',TRUE);
			$this->dbforge->add_field('INDEX (company_id)');
			$this->dbforge->add_field('INDEX (default_inventory_account)');
			$this->dbforge->add_field('INDEX (stock_adjustment_account)');
			$this->dbforge->add_field('INDEX (stock_received_but_not_billed)');
			$this->dbforge->add_field('INDEX (expenses_included_in_valuation)');
			$this->dbforge->create_table('set_company_auto_account_stock_settings');
		}

		if(!$this->db->table_exists('set_company_fixed_asset_depreciation_settings'))
		{
			$this->dbforge->add_field(array(
			'company_fixed_asset_depreciation_settings_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'company_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'accumulated_depreciation_account' => array(
	        'type' => 'int',
	        'unsigned' => true,
	        'constraint' => 10
	        ),
	        'depreciation_expense_account' => array(
	        'type' => 'int',
	        'unsigned' => true,
	        'constraint' => 10
	        ),
	        'series_for_depreciation_entry' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'disposal_account' => array(
	        'type' => 'int',
	        'unsigned' => true,
	        'constraint' => 10
	        ),
	        'depreciation_cost_center' => array(
	        'type' => 'int',
	        'unsigned' => true,
	        'constraint' => 10
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
			$this->dbforge->add_key('company_fixed_asset_depreciation_settings_id',TRUE);
			$this->dbforge->add_field('INDEX (company_id)');
			$this->dbforge->add_field('INDEX (accumulated_depreciation_account)');
			$this->dbforge->add_field('INDEX (depreciation_expense_account)');
			$this->dbforge->add_field('INDEX (disposal_account)');
			$this->dbforge->add_field('INDEX (depreciation_cost_center)');
			$this->dbforge->create_table('set_company_fixed_asset_depreciation_settings');
		}

		if(!$this->db->table_exists('set_company_info'))
		{
			$this->dbforge->add_field(array(
			'company_info_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'company_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'phone_no' => array(
	        'type' => 'varchar',
	        'constraint' => 50,
	        'null' => false
	        ),
	        'fax' => array(
	        'type' => 'varchar',
	        'constraint' => 50,
	        'null' => false
	        ),
	        'email' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'website' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'registration_details' => array(
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
			$this->dbforge->add_key('company_info_id',TRUE);
			$this->dbforge->add_field('INDEX (company_id)');
			$this->dbforge->create_table('set_company_info');
		}

		if(!$this->db->table_exists('hr_loan_type'))
    	{
	        $this->dbforge->add_field(array(
	        'loan_type_id' => array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        'auto_increment' => TRUE
	        ),
	        'loan_name' => array(
	        'type' => 'VARCHAR',
	        'constraint' => '250',
	        ),
	        'maximum_loan_amount' =>array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'rate_of_interest' =>array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'disabled' =>array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'description' =>array(
	        'type' => 'TEXT',
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('loan_type_id',TRUE);
	        $this->dbforge->create_table('hr_loan_type');
    	}
    	if(!$this->db->table_exists('hr_emp_leave_approver'))
    	{
	        $this->dbforge->add_field(array(
	        'leave_approver_id' => array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        'auto_increment' => TRUE
	        ),
	        'leave_approver' => array(
	        'type' => 'VARCHAR',
	        'constraint' => '250',
	        ),
	        'employee_id' =>array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => true,
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
	        $this->dbforge->add_key('leave_approver_id',TRUE);
	        $this->dbforge->add_field('INDEX (employee_id)');
	        $this->dbforge->create_table('hr_emp_leave_approver');
    	}
	    if(!$this->db->table_exists('hr_employee_loan_application'))
	    {
	        $this->dbforge->add_field(array(
	        'employee_loan_application_id'=> array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        'auto_increment' => TRUE
	        ),
	        'posting_date'=>array(
	        'type' => 'DATE',
	        ),
	        'employee_id' => array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        ),
	        'employee_name' => array(
	        'type' => 'VARCHAR',
	        'constraint' => 255,
	        ),
	        'emp_loan_appliction_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'default' =>1
	        ),
	        'company_id' =>array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        ),
	        'loan_type_id' =>array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        ),
	        'loan_amount'=>array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'required_by_date' =>array(
	        'type' => 'DATE',
	        ),
	        'reason' =>array(
	        'type' => 'text',
	        ),
	        'emp_loan_repayment_method_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),                   
	        'rate_of_interest' =>array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'emp_loan_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'total_payable_interest'=>array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'repayment_amount'=>array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),                            
	        'repayment_periods' =>array(
	        'type' => 'INT',
	        'constraint' => 10,
	        ),
	        'total_payable_amount'=>array(
	        'type' => 'INT',
	        'constraint' => 10,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        ));
	        $this->dbforge->add_key('employee_loan_application_id', TRUE);
	        $this->dbforge->add_field('INDEX (employee_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (loan_type_id)');
	        $this->dbforge->add_field('INDEX (emp_loan_appliction_status_id)');
	        $this->dbforge->add_field('INDEX (emp_loan_status_id)');
	        $this->dbforge->add_field('INDEX (emp_loan_repayment_method_id)');
	        $this->dbforge->create_table('hr_employee_loan_application');
	    } 

	    if(!$this->db->table_exists('hr_emp_loan_application_rejection'))
	    {
	        $this->dbforge->add_field(array(
	        'emp_loan_application_rejection_id'=> array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        'auto_increment' => TRUE
	        ),
	        'employee_loan_application_id'=> array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        ),
	        'employee_id'=> array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        ),
	        'rejected_by'=> array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'rejection_remarks'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        ));
	        $this->dbforge->add_key('emp_loan_application_rejection_id', TRUE);
	        $this->dbforge->add_field('INDEX (employee_id)');
	        $this->dbforge->add_field('INDEX (employee_loan_application_id)');
	        $this->dbforge->create_table('hr_emp_loan_application_rejection');
	    } 

	    if(!$this->db->table_exists('hr_emp_leave_rejection'))
	    {
	        $this->dbforge->add_field(array(
	        'leave_application_id'=> array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        'auto_increment' => TRUE
	        ),
	        'leave_application_id'=> array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        ),
	        'employee_id'=> array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        ),
	        'rejected_by'=> array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'rejection_remarks'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        ));
	        $this->dbforge->add_key('leave_application_id', TRUE);
	        $this->dbforge->add_field('INDEX (employee_id)');
	        $this->dbforge->add_field('INDEX (leave_application_id)');
	        $this->dbforge->create_table('hr_emp_leave_rejection');
	    } 

	    if(!$this->db->table_exists('hr_vehicle'))
	    { 
	        $this->dbforge->add_field(array(
	        'vehicle_id'=>array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        'auto_increment' => TRUE
	        ),
	        'registration_number'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'make'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'model'=>array(
	        'type' => 'VARCHAR',
	        'constraint' => 255,
	        ),
	        'odometer_value' => array(
	        'type' => 'INT',
	        'constraint' => 10,
	        ),
	        'acquisition_date' =>array(
	        'type' => 'DATE',
	        ),
	        'location' =>array(
	        'type' => 'VARCHAR',
	        'constraint' => 255,
	        ),
	        'chassis_no' =>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'vehicle_value'=>array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'employee_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'insurance_company' => array(
	        'type'      => 'VARCHAR',
	        'constraint'=>'255',
	        ),
	        'policy_no' => array(
	        'type'      => 'int',
	        'constraint'=> 10,
	        ),
	        'start_date'=>array(
	        'type' => 'DATE',
	        ),
	        'end_date'=>array(
	        'type' => 'DATE',
	        ),
	        'vehicle_fuel_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),     
	        'uom_id' => array(
	        'type'      => 'int',
	        'constraint'=> 10,
	        'unsigned' => true
	        ),
	        'carbon_check_date' =>array(
	        'type' => 'DATE',
	        ),
	        'color' => array(
	        'type'      => 'VARCHAR',
	        'constraint'=> 255,
	        ),
	        'wheels'=> array(
	        'type'      => 'INT',
	        'constraint'=> 10,
	        ),
	        'doors' => array(
	        'type'      => 'INT',
	        'constraint'=> 10,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('vehicle_id', TRUE);
	        $this->dbforge->add_field('INDEX (uom_id)');
	        $this->dbforge->add_field('INDEX (employee_id)');
	        $this->dbforge->add_field('INDEX (vehicle_fuel_type_id)');
	      

	        $this->dbforge->create_table('hr_vehicle');
	    } 

	    if(!$this->db->table_exists('hr_training_event'))
	    {
	        $this->dbforge->add_field(array(
	        'training_event_id'=>array(
	        'type'=>'INT',
	        'constraint'=>10,
	        'unsigned'=>TRUE,
	        'auto_increment'=>TRUE,
	        ),
	        'event_name'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        'null' => false
	        ),
	        'training_eve_event_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'training_event_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'trainer_id'=>array(
	        'type'=>'int',
	        'constraint'=> 10,
	        'unsigned' => true
	        ),
	        'trainer_email'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        ),
	        'contact_number'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        ),
	        'company_id'=>array(
	        'type'=>'int',
	        'constraint'=> 10,
	        'unsigned' => true
	        ),
	        'course_id'=>array(
	        'type'=>'varchar',
	        'constraint'=> 250,
	        'unsigned' => true
	        ),
	        'location'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        ),
	        'start_time'=>array(
	        'type'=>'datetime',
	        ),
	        'end_time'=>array(
	        'type'=>'datetime'
	        ),
	        'introduction'=>array(
	        'type'=>'longtext'
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('training_event_id',TRUE);
			$this->dbforge->add_field('INDEX (trainer_id)');
			$this->dbforge->add_field('INDEX (training_eve_event_status_id)');
			$this->dbforge->add_field('INDEX (training_event_type_id)');
			$this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->create_table('hr_training_event');
	    }


	    if(!$this->db->table_exists('hr_trainer'))
	    {
	        $this->dbforge->add_field(array(
	        'trainer_id'=>array(
	        'type'=>'INT',
	        'constraint'=>10,
	        'unsigned'=>TRUE,
	        'auto_increment'=>TRUE,
	        ),
	        'trainer_name'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        ),
	        'trainer_email'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        ),
	        'trainer_contact'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        ),
	        'company_id'=>array(
	        'type'=>'INT',
	        'constraint'=>10,
	        'unsigned'=>TRUE,
	        ),
	        'trainer_profile'=>array(
	        'type'=>'text',
			'Default'=> null
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('trainer_id',TRUE);
	        $this->dbforge->add_field('INDEX (company_id)'); 
	        $this->dbforge->create_table('hr_trainer');
	    }

	    if(!$this->db->table_exists('hr_expense_claim_type'))
	    {
	        $this->dbforge->add_field(array
	        (
	        'expense_claim_type_id'=>array(
	        'type'=>'INT',
	        'constraint'=>11,
	        'unsigned'=>TRUE,
	        'auto_increment'=>TRUE,
	        ),
	        'expense_type'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        ),
	        'description'=>array(
	        'type'=>'text',
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('expense_claim_type_id',TRUE);
	        $this->dbforge->create_table('hr_expense_claim_type');
	    }

	    if(!$this->db->table_exists('hr_leave_block_list'))
	    {
	        $this->dbforge->add_field(array(
	        'leave_block_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'leave_block_list_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'applies_to_all_departments'=> array(
	        'type' => 'tinyint',
	        'constraint' => '4',
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	          $this->dbforge->add_key('leave_block_list_id', true);
	          $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->create_table('hr_leave_block_list', true);
	    }


	    if(!$this->db->table_exists('hr_leave_block_list_date'))
	    {
	        $this->dbforge->add_field(array(
	        'leave_block_list_date_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'leave_block_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'block_date' => array(
	        'type' => 'date',
	        ),
	        'reason' => array(
	        'type' => 'text',
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('leave_block_list_date_id', true);
	        $this->dbforge->add_field('INDEX (leave_block_list_id)');
	        $this->dbforge->create_table('hr_leave_block_list_date', true);
	    }

	    if(!$this->db->table_exists('hr_leave_block_list_allow'))
	    {
	        $this->dbforge->add_field(array(
	        'leave_block_list_allow_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'leave_block_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'user_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        
	        $this->dbforge->add_key('leave_block_list_allow_id', true);
	        $this->dbforge->add_field('INDEX (leave_block_list_id)');
	        $this->dbforge->add_field('INDEX (user_id)');
	        $this->dbforge->create_table('hr_leave_block_list_allow', true);
	    }

	    if(!$this->db->table_exists('hr_employment_type'))
	    {
	        $this->dbforge->add_field(array(
	        'employment_type_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	         ),
	        'employment_type_name'=>array(
	        'type' => 'VARCHAR',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('employment_type_id',TRUE);
	        $this->dbforge->create_table('hr_employment_type');
	    }

	    if(!$this->db->table_exists('hr_holiday_list'))
	    {
	        $this->dbforge->add_field(array(
	        'holiday_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'holiday_list_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'from_date' => array(
	        'type' => 'date',
	        'null' => false
	        ),
	        'to_date' => array(
	        'type' => 'date',
	        'null' => false
	        ),
	        'holliday_list_weekly_off_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

	        $this->dbforge->add_key('holiday_list_id', true);
	        $this->dbforge->add_field('INDEX (holliday_list_weekly_off_id)');
	        $this->dbforge->create_table('hr_holiday_list', true);
	    }

	    if(!$this->db->table_exists('hr_holiday_list_holiday'))
	    {
	        $this->dbforge->add_field(array(
	        'holiday_list_holiday_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'holiday_list_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'holiday_date' => array(
	        'type' => 'date',
	        ),
	        'description' => array(
	        'type' => 'text',
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

	        $this->dbforge->add_key('holiday_list_holiday_id', true);
	        $this->dbforge->add_field('INDEX (holiday_list_id)');
	        $this->dbforge->create_table('hr_holiday_list_holiday', true);
	    }

	    if(!$this->db->table_exists('hr_branch'))
	    {
	        $this->dbforge->add_field(array
	        (
	        'branch_id'=>array(
	        'type'=>'INT',
	        'constraint'=>11,
	        'unsigned'=>TRUE,
	        'auto_increment'=>TRUE,
	        ),
	        'branch'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('branch_id',TRUE);
	        $this->dbforge->create_table('hr_branch');
	    }

	    if(!$this->db->table_exists('hr_department'))
	    {
	        $this->dbforge->add_field(array(
	        'department_id'=>array(
	        'type'=>'INT',
	        'constraint'=> 10,
	        'unsigned'=>TRUE,
	        'auto_increment'=>TRUE,
	        ),
	        'department_name'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        ),
	        'leave_block_list_id'=>array(
	        'type'=>'INT',
	        'constraint'=> 10,
	        'unsigned'=>TRUE,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('department_id',TRUE);
	        $this->dbforge->add_field('INDEX (leave_block_list_id)');
	        $this->dbforge->create_table('hr_department');
	    }

	    if(!$this->db->table_exists('hr_designation'))
	    {
	        $this->dbforge->add_field(array(
	        'designation_id'=>array(
	        'type'=>'INT',
	        'constraint'=>11,
	        'unsigned'=>TRUE,
	        'auto_increment'=>TRUE,
	        ),
	        'designation_name'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        ),
	        'description'=>array(
	        'type'=>'TEXT',
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('designation_id',TRUE);
	        $this->dbforge->create_table('hr_designation');
	    }

	    if(!$this->db->table_exists('hr_leave_type'))
	    {
	        $this->dbforge->add_field(array(
	        'leave_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'leave_type_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'max_days_allowed' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'is_carry_forward' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'is_encash' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'is_lwp' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'allow_negative' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'include_holiday' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

	        $this->dbforge->add_key('leave_type_id', true);
	        $this->dbforge->create_table('hr_leave_type', true);
	    }

	    if(!$this->db->table_exists('hr_job_applicant'))
	    {
	        $this->dbforge->add_field(array(
	        'job_applicant_id'=>array(
	        'type'=>'INT',
	        'constraint'=>5,
	        'unsigned'=>TRUE,
	        'auto_increment'=>TRUE,
	        ),
	        'applicant_name'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        ),
	        'email_id'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        'null'=>TRUE,
	        ),
	        'job_applicant_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'job_opening_id'=>array(
	        'type'=>'INT',
	        'constraint'=>10,
	        'unsigned'=>TRUE,
	        ),
	        'cover_letter'=>array(
	        'type'=>'TEXT',
	        ),
	        'contact_number'=>array(
	        'type'=>'varchar',
	        'constraint'=>255,
	        ),
	        'total_experience'=>array(
	        'type'=>'varchar',
	        'constraint'=>255,
	        ),
	        'current_ctc'=>array(
	        'type'=>'decimal',
	        'constraint'=>'9,2',
	        ),
	        'expected_ctc'=>array(
	        'type'=>'decimal',
	        'constraint'=>'9,2',
	        ),
	        'technical_skills'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        ),
	        'resume_attachment'=>array(
	        'type'=>'text',
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('job_applicant_id',TRUE);
	        $this->dbforge->add_field('INDEX (job_opening_id)');
	        $this->dbforge->add_field('INDEX (job_applicant_status_id)');
	       
	        $this->dbforge->create_table('hr_job_applicant');
	    }

	    if(!$this->db->table_exists('hr_job_opening'))
	    {
	        $this->dbforge->add_field(array(   
	        'job_opening_id'=>array(
	        'type'=>'INT',
	        'constraint'=>11,
	        'unsigned'=>TRUE,
	        'auto_increment'=>TRUE,
	        ),
	        'job_title'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        'null'=>TRUE,
	        ),
	        'publish'=>array(
	        'type'=>'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'route'=>array(
	        'type'=>'VARCHAR',
	        'constraint'=>255,
	        'null'=>TRUE,
	        ),
	        'job_opening_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'description'=>array(
	        'type'=>'longtext',
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('job_opening_id',TRUE);
	        $this->dbforge->add_field('INDEX (job_opening_status_id)');
	        $this->dbforge->create_table('hr_job_opening');
	    }

	    if(!$this->db->table_exists('hr_salary_component'))
	    {
	        $this->dbforge->add_field(array(
	        'salary_component_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'salary_component' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'salary_component_abbr' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'salary_component_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'description' => array(
	        'type' => 'text',
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

	        $this->dbforge->add_key('salary_component_id', true);
	        $this->dbforge->add_field('INDEX (salary_component_type_id)');
	        $this->dbforge->create_table('hr_salary_component', true);
	    }

	    if(!$this->db->table_exists('hr_salary_component_account'))
	    {
	        $this->dbforge->add_field(array(
	        'salary_component_account_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'salary_component_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'default_account' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('salary_component_account_id', true);
	        $this->dbforge->add_field('INDEX (salary_component_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (default_account)');
	        $this->dbforge->create_table('hr_salary_component_account', true);
	    }

	    if(!$this->db->table_exists('hr_appraisal_template'))
	    { 
	        $this->dbforge->add_field(array(
	        'appraisal_template_id'  => array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        'auto_increment' => TRUE
	        ),
	        'appraisal_temp_title' => array(
	        'type' => 'VARCHAR',
	        'constraint' => '255',
	        ),
	        'description' => array(
	        'type' => 'text',
	        ),
	        'kra'  => array(
	        'type' => 'VARCHAR',
	        'constraint' => '255',
	        ),
	        'per_weightage'  => array(
	        'type' => 'DECIMAL',
	        'constraint' => '10,2',
	        'null' => FALSE,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('appraisal_template_id', TRUE);
	        $this->dbforge->create_table('hr_appraisal_template');
	    }
	    if(!$this->db->table_exists('hr_salutation'))
	    {
	    	$this->dbforge->add_field(array(
	        'salutation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'salutation'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('salutation_id', TRUE);
	        $this->dbforge->create_table('hr_salutation');
	    }

	    if(!$this->db->table_exists('sales_territory'))
	    {
	        $this->dbforge->add_field(array(
	        'territory_id' => array(
	        'type' => 'int',
	        'constraint' => 11,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'territory_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'is_group' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'sales_person_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'lft' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'rgt' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'parent_territory' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => true,
	        'default' => null
	        ),
	        'old_parent' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'distribution_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

	        $this->dbforge->add_key('territory_id', true);
		    $this->dbforge->add_field('INDEX (sales_person_id)');
		    $this->dbforge->add_field('INDEX (distribution_id)');
		    $this->dbforge->add_field('INDEX (parent_territory)');

		    $this->dbforge->create_table('sales_territory', true);
    	}

    	if(!$this->db->table_exists('sales_partner_target'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_partner_target_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'territory_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'sales_person_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'fisical_year_id' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'unsigned' => true,
	        ),
	        'target_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'target_amount' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

	        $this->dbforge->add_key('sales_partner_target_id', true);
	        $this->dbforge->add_field('INDEX (territory_id)');
	        $this->dbforge->add_field('INDEX (item_group_id)');
	        $this->dbforge->add_field('INDEX (sales_person_id)');
	        $this->dbforge->add_field('INDEX (fisical_year_id)');
		    $this->dbforge->create_table('sales_partner_target', true);
    	}

    	if(!$this->db->table_exists('acc_fisical_year'))
	    {
	        $this->dbforge->add_field(array(
	        'fisical_year_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'year' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'disabled' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'year_start_date' => array(
	        'type' => 'date',
	        ),
	        'year_end_date' => array(
	        'type' => 'date',
	        ), 
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

	        $this->dbforge->add_key('fisical_year_id', true);
		    $this->dbforge->create_table('acc_fisical_year', true);
    	}

    	if(!$this->db->table_exists('acc_fisical_year_company'))
	    {
	        $this->dbforge->add_field(array(
	        'fisical_year_company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'fisical_year_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

	        $this->dbforge->add_key('fisical_year_company_id', true);
	        $this->dbforge->add_field('INDEX (fisical_year_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
		    $this->dbforge->create_table('acc_fisical_year_company', true);
    	}

    	if(!$this->db->table_exists('sales_sales_person'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_person_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'sales_person_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'parent_sales_person' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => true,
	        'default' => null
	        ),
	        'is_group' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'employee_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'enabled' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'lft' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'rgt' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        ),
	        'old_parent' => array(
	        'type' => 'int',
	        'constraint' => 10
	        ),
	        'distribution_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('sales_person_id', true);
	        $this->dbforge->add_field('INDEX (employee_id)');
	        $this->dbforge->add_field('INDEX (distribution_id)');
	        $this->dbforge->add_field('INDEX (parent_sales_person)');
		    $this->dbforge->create_table('sales_sales_person', true);
    	}

    	if(!$this->db->table_exists('acc_monthly_distribution'))
	    {
	        $this->dbforge->add_field(array(
	        'distribution_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'distribution_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'fisical_year_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('distribution_id', true);
	        $this->dbforge->add_field('INDEX (fisical_year_id)');
		    $this->dbforge->create_table('acc_monthly_distribution', true);
    	}

    	if(!$this->db->table_exists('acc_monthly_distribution_percentage'))
	    {
	        $this->dbforge->add_field(array(
	        'monthly_distribution_percentage_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'distribution_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'month' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'percentage_allocation' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('monthly_distribution_percentage_id', true);
	        $this->dbforge->add_field('INDEX (distribution_id)');
		    $this->dbforge->create_table('acc_monthly_distribution_percentage', true);
    	}

    	if(!$this->db->table_exists('sales_sales_partner'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_partner_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'partner_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'sales_partner_partner_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'territory_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'commission_rate' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        'null' => false
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
	        'territory_target_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'distribution_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'show_in_website'=> array(
            'type' => 'tinyint',
            'constraint' => '4',
            ),
            'route' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'logo' => array(
	        'type' => 'text',
	        ),
	        'partner_website' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'introduction' => array(
	        'type' => 'text',
	        ),
	        'description' => array(
	        'type' => 'longtext',
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('sales_partner_id', true);
	        $this->dbforge->add_field('INDEX (sales_partner_partner_type_id)');
	        $this->dbforge->add_field('INDEX (territory_id)');
	        $this->dbforge->add_field('INDEX (address_id)');
	        $this->dbforge->add_field('INDEX (contact_id)');
	        $this->dbforge->add_field('INDEX (distribution_id)');
	        $this->dbforge->add_field('INDEX (territory_target_id)');
		    $this->dbforge->create_table('sales_sales_partner', true);
    	}

    	if(!$this->db->table_exists('hr_hr_settings'))
	    {
	        $this->dbforge->add_field(array(
	        'hr_setting_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'retirement_age' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false,
	        ),
	        'hr_settings_employee_name_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'stop_birthday_reminders'=> array(
	        'type' => 'tinyint',
	        'constraint' => '4',
	        ),
	        'maintain_bill_work_hours_same'=> array(
	        'type' => 'tinyint',
	        'constraint' => '4',
	        ),
	        'include_holidays_in_total_working_days'=> array(
	        'type' => 'tinyint',
	        'constraint' => '4',
	        ),
	        'email_salary_slip_to_employee'=> array(
	        'type' => 'tinyint',
	        'constraint' => '4',
	        ),
	        'max_working_hours_against_timesheet'=> array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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
	        $this->dbforge->add_key('hr_setting_id', true);
	        $this->dbforge->add_field('INDEX (hr_settings_employee_name_id)');
		    $this->dbforge->create_table('hr_hr_settings', true);
    	} 

    	if(!$this->db->table_exists('hr_employee'))
      {
            $this->dbforge->add_field(array(
            'employee_id' => array(
	        'type' => 'INT',
	        'constraint' => 10,
	        'unsigned' => TRUE,
	        'auto_increment' => TRUE
	        ),
            'naming_series' => array(
           	'type' => 'varchar',
           	'constraint' => 255,
           	),
            'salutation_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'employee_name' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'company_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'user_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'image' => array(
            'type' => 'text',
            'null' => false
            ),
            'employee_number' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'date_of_joining' => array(
            'type' => 'date',
            'null' => false
            ),
            'date_of_birth' => array(
            'type' => 'date',
            'null' => false
            ),
            'gender_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'created_on'=> array(
            'type' => 'timestamp',
            'null'  => 'YES',
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
            $this->dbforge->add_key('employee_id', true);
            
            $this->dbforge->add_field('INDEX (salutation_id)');
            $this->dbforge->add_field('INDEX (company_id)');
            $this->dbforge->add_field('INDEX (user_id)');
            $this->dbforge->add_field('INDEX (gender_id)');
            $this->dbforge->create_table('hr_employee', true);
      }

      if(!$this->db->table_exists('hr_emp_employment_details'))
      {
            $this->dbforge->add_field(array(
            'emp_employment_details_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'employee_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'employee_status_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'employment_type_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'holiday_list_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'offer_date' => array(
            'type' => 'date',
            ),
            'scheduled_confirmation_date' => array(
            'type' => 'date',
            ),
            'final_confirmation_date' => array(
            'type' => 'date',
            ),
            'contract_end_date' => array(
            'type' => 'date',
            ),
            'date_of_retirement' => array(
            'type' => 'date',
            ),
            'created_on'=> array(
            'type' => 'timestamp',
            'null'  => 'YES',
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

            $this->dbforge->add_key('emp_employment_details_id', true);
            $this->dbforge->add_field('INDEX (employee_id)');
            $this->dbforge->add_field('INDEX (employment_type_id)');
            $this->dbforge->add_field('INDEX (holiday_list_id)');
            $this->dbforge->add_field('INDEX (employee_status_id)');
            $this->dbforge->create_table('hr_emp_employment_details', true);
      }

      if(!$this->db->table_exists('hr_emp_job_profile')) 
      {
            $this->dbforge->add_field(array(
            'emp_job_profile_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'employee_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'branch_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'department_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'designation_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'company_email' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'notice_number_of_days' => array(
            'type' => 'int',
            'constraint' => 10,
            ),
            'employee_salary_mode_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'created_on'=> array(
            'type' => 'timestamp',
            'null'  => 'YES',
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

            $this->dbforge->add_key('emp_job_profile_id', true);
            $this->dbforge->add_field('INDEX (employee_id)');
            $this->dbforge->add_field('INDEX (branch_id)');
            $this->dbforge->add_field('INDEX (department_id)');
            $this->dbforge->add_field('INDEX (designation_id)');
            $this->dbforge->add_field('INDEX (employee_salary_mode_id)');
            $this->dbforge->create_table('hr_emp_job_profile', true);
      }

      if(!$this->db->table_exists('hr_emp_bank_details'))
      {
            $this->dbforge->add_field(array(
            'emp_bank_details_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'employee_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'bank_name' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'bank_ac_no' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'ifsc_code' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'branch' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'created_on'=> array(
            'type' => 'timestamp',
            'null'  => 'YES',
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

            $this->dbforge->add_key('emp_bank_details_id', true);
            $this->dbforge->add_field('INDEX (employee_id)');
            $this->dbforge->create_table('hr_emp_bank_details', true);
      }

      if(!$this->db->table_exists('hr_emp_organization_profile'))
      {
            $this->dbforge->add_field(array(
            'emp_organization_profile_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'employee_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'reports_to' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'leave_approver_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'created_on'=> array(
            'type' => 'timestamp',
            'null'  => 'YES',
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

            $this->dbforge->add_key('emp_organization_profile_id', true);
            $this->dbforge->add_field('INDEX (employee_id)');
            $this->dbforge->add_field('INDEX (leave_approver_id)');
            $this->dbforge->create_table('hr_emp_organization_profile', true);
      }

      if(!$this->db->table_exists('hr_emp_contact_details'))
      {
            $this->dbforge->add_field(array(
            'emp_contact_details_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'employee_id'=>array(
            'type'=>'INT',
            'constraint'=>10,
            'unsigned' => true
            ),
            'employee_preferred_contact_email_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'cell_number' => array(
            'type' => 'varchar',
            'constraint' => 13,
            'null' => false
            ),
            'personal_email' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'unsubscribed' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'person_to_be_contacted' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'contact_person_name' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'relation' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'emergency_phone_number' => array(
            'type' => 'varchar',
            'constraint' => 13,
            'null' => false
            ),
            'employee_permanent_address_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'permanent_address' => array(
            'type' => 'text',
            ),
            'employee_current_address_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'current_address' => array(
            'type' => 'text',
            ),
            'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

            $this->dbforge->add_key('emp_contact_details_id', true);
            $this->dbforge->add_field('INDEX (employee_id)');
            $this->dbforge->add_field('INDEX (employee_preferred_contact_email_id)');
            $this->dbforge->add_field('INDEX (employee_permanent_address_id)');
            $this->dbforge->add_field('INDEX (employee_current_address_id)');
            $this->dbforge->create_table('hr_emp_contact_details', true);
      }  

      if(!$this->db->table_exists('hr_emp_insurance'))
      {
            $this->dbforge->add_field(array(
            'emp_insurance_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'employee_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true
            ),
            'insurance_company' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'start_date' => array(
            'type' => 'date',
            'null' => false
            ),
            'end_date' => array(
            'type' => 'date',
            'null' => false
            ),
            'policy_number' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

            $this->dbforge->add_key('emp_insurance_id', true);
            $this->dbforge->add_field('INDEX (employee_id)');
            $this->dbforge->create_table('hr_emp_insurance', true);
      }  

      if(!$this->db->table_exists('hr_emp_personal_details'))
      {
            $this->dbforge->add_field(array(
            'emp_personal_details_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'employee_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true
            ),
            'passport_number' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'date_of_issue' => array(
            'type' => 'date',
            'null' => false
            ),
            'valid_upto' => array(
            'type' => 'date',
            'null' => false
            ),
            'place_of_issue' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'marital_status_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'blood_group_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'health_details' => array(
            'type' => 'text',
            'null' => false
            ),
            'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

            $this->dbforge->add_key('emp_personal_details_id', true);
            $this->dbforge->add_field('INDEX (employee_id)');
            $this->dbforge->add_field('INDEX (marital_status_id)');
            $this->dbforge->add_field('INDEX (blood_group_id)');
            $this->dbforge->create_table('hr_emp_personal_details', true);
      }

      if(!$this->db->table_exists('hr_emp_educational_details'))
      {
            $this->dbforge->add_field(array(
            'emp_educational_details_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'employee_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true
            ),
            'school_university' => array(
            'type' => 'text',
            'constraint' => 255,
            ),
            'qualification' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'employee_level_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'year_of_passing' => array(
            'type' => 'int',
            'constraint'  => 10,
            'null' => false
            ),
            'class_per' => array(
            'type' => 'text',
            'constraint' => 255,
            ),
            'maj_opt_subj' => array(
            'type' => 'text',
            'constraint' => 255,
            ),
            'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

            $this->dbforge->add_key('emp_educational_details_id', true);
            $this->dbforge->add_field('INDEX (employee_id)');
            $this->dbforge->add_field('INDEX (employee_level_id)');
          
            $this->dbforge->create_table('hr_emp_educational_details', true);
      }

      if(!$this->db->table_exists('hr_emp_external_work_experience'))
      {
            $this->dbforge->add_field(array(
            'emp_external_work_experience_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'employee_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true
            ),
            'company_name' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'designation' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'salary' => array(
            'type' => 'decimal',
            'constraint' => '9,2',
            'null' => false
            ),
            'address' => array(
            'type' => 'text',
            'null' => false
            ),
            'contact' => array(
            'type' => 'text',
            'null' => false
            ),
            'total_experience' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

            $this->dbforge->add_key('emp_external_work_experience_id', true);
            $this->dbforge->add_field('INDEX (employee_id)');
            $this->dbforge->create_table('hr_emp_external_work_experience', true);
      }

      if(!$this->db->table_exists('hr_emp_history_in_company'))
      {
            $this->dbforge->add_field(array(
            'emp_history_in_company_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'employee_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true
            ),
            'branch_id' => array(
            'type' => 'int',
            'constraint' => 10,
            ),
            'department_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true
            ),
            'designation_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true
            ),
            'from_date' => array(
            'type' => 'date',
            'null' => false
            ),
            'to_date' => array(
            'type' => 'date',
            'null' => false
            ),
            'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

            $this->dbforge->add_key('emp_history_in_company_id', true);
            $this->dbforge->add_field('INDEX (employee_id)');
            $this->dbforge->add_field('INDEX (branch_id)');
            $this->dbforge->add_field('INDEX (department_id)');
            $this->dbforge->add_field('INDEX (designation_id)');

            $this->dbforge->create_table('hr_emp_history_in_company', true);
      }

      if(!$this->db->table_exists('hr_emp_exit'))
      {
            $this->dbforge->add_field(array(
            'emp_exit_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'employee_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true
            ),
            'resignation_letter_date' => array(
            'type' => 'date',
            'null' => false
            ),
            'relieving_date' => array(
            'type' => 'date',
            'null' => false
            ),
            'reason_for_leaving' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'employee_leave_en_cashed_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
            'encashment_date' => array(
            'type' => 'date',
            'null' => false
            ),
            'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

            $this->dbforge->add_key('emp_exit_id', true);
            $this->dbforge->add_field('INDEX (employee_id)');
            $this->dbforge->add_field('INDEX (employee_leave_en_cashed_id)');
            $this->dbforge->create_table('hr_emp_exit', true);
      }

      if(!$this->db->table_exists('hr_emp_exit_interview'))
      {
            $this->dbforge->add_field(array(
            'emp_exit_interview_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'employee_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true
            ),
            'held_on' => array(
            'type' => 'date',
            'null' => false
            ),
            'reason_for_resignation' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'new_workplace' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),
            'feedback' => array(
            'type' => 'text',
            'null' => false
            ),
            'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

            $this->dbforge->add_key('emp_exit_interview_id', true);
            $this->dbforge->add_field('INDEX (employee_id)');
            $this->dbforge->create_table('hr_emp_exit_interview', true);
      }
      if(!$this->db->table_exists('pro_project'))
	  {
			$this->dbforge->add_field(array(
			'project_id' => array(
			'type' => 'int',
			'constraint' => 10,
			'unsigned' => true,
			'auto_increment' => true
			),
			'project_name' => array(
			'type' => 'varchar',
			'constraint' => 255,
			'null' => false
			),
			'pro_status_id' => array(
			'type' => 'int',
			'constraint' => 10,
			'unsigned' => true,
			),
			'project_type_id' => array(
			'type' => 'int',
			'constraint' => 10,
			'unsigned' => true,
			),
			'pro_is_active_id' => array(
			'type' => 'int',
			'constraint' => 10,
			'unsigned' => true,
			),
			'complete_mode_id' => array(
			'type' => 'int',
			'constraint' => 10,
			'unsigned' => true,
			),
			'priority_id' => array(
			'type' => 'int',
			'constraint' => 10,
			'unsigned' => true,
			),
			'expected_start_date' => array(
			'type' => 'date',
			),
			'expected_end_date' => array(
			'type' => 'date',
			),
			'percent_complete' => array(
			'type' => 'decimal',
			'constraint' => '9,2',
			'null' => false
			),
			'created_on'=> array(
	        'type' => 'timestamp',
	        'null'  => 'YES',
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

			$this->dbforge->add_key('project_id', true);
			$this->dbforge->add_field('INDEX (pro_status_id)');
			$this->dbforge->add_field('INDEX (project_type_id)');
			$this->dbforge->add_field('INDEX (pro_is_active_id)');
			$this->dbforge->add_field('INDEX (complete_mode_id)');
			$this->dbforge->add_field('INDEX (priority_id)');
			$this->dbforge->create_table('pro_project', true);
      }
 
    }
    public function down()
    {
    	$this->dbforge->drop_table('set_letter_head', true);
    	$this->dbforge->drop_table('set_terms_conditions', true); 
        $this->dbforge->drop_table('set_naming_series',true);
        $this->dbforge->drop_table('set_uom',true);
        $this->dbforge->drop_table('set_printing_heading', true); 
        $this->dbforge->drop_table('set_country',true); 
        $this->dbforge->drop_table('set_industry_type', true);
        $this->dbforge->drop_table('set_currency', true);
        $this->dbforge->drop_table('set_company', true);
        $this->dbforge->drop_table('set_company_default_values', true);
        $this->dbforge->drop_table('set_company_sales_settings', true);
        $this->dbforge->drop_table('set_company_account_settings', true);
        $this->dbforge->drop_table('set_company_auto_account_stock_settings', true);
        $this->dbforge->drop_table('set_company_fixed_asset_depreciation_settings', true);
        $this->dbforge->drop_table('set_company_info', true);
        $this->dbforge->drop_table('inv_warehouse', true);
        $this->dbforge->drop_table('inv_item_attribute', true);
        $this->dbforge->drop_table('inv_item_attribute_values', true);
        $this->dbforge->drop_table('inv_brand', true);
        $this->dbforge->drop_table('inv_stock_settings', true);
        $this->dbforge->drop_table('inv_manufacturer',true);
        $this->dbforge->drop_table('inv_custom_tariff_number',true); 
		$this->dbforge->drop_table('inv_item', true);
        $this->dbforge->drop_table('inv_item_inventory', true);
        $this->dbforge->drop_table('inv_item_serial_nos_batches', true);
        $this->dbforge->drop_table('inv_item_variants_section', true);
        $this->dbforge->drop_table('inv_item_purchase_details', true);
        $this->dbforge->drop_table('inv_item_supplier_details', true);
        $this->dbforge->drop_table('inv_item_foreign_trade_details', true);
        $this->dbforge->drop_table('inv_item_sales_details', true);
        $this->dbforge->drop_table('inv_item_inspection_criteria', true);
        $this->dbforge->drop_table('inv_item_manufacturing', true);
        $this->dbforge->drop_table('inv_item_reorder', true);
        $this->dbforge->drop_table('inv_item_uom_conversion', true);
        $this->dbforge->drop_table('inv_item_variant_attribute', true);
        $this->dbforge->drop_table('inv_item_customer_detail', true);
        $this->dbforge->drop_table('inv_item_supplier', true);
        $this->dbforge->drop_table('inv_item_tax', true);
        $this->dbforge->drop_table('inv_item_quality_inspection_parameter', true);
        $this->dbforge->drop_table('inv_pricing_rule', true);
        $this->dbforge->drop_table('inv_item_group', true);
    	$this->dbforge->drop_table('inv_price_list', true);
        $this->dbforge->drop_table('inv_item_price', true);
        $this->dbforge->drop_table('inv_shipping_rule', true);
        $this->dbforge->drop_table('inv_shipping_rule_condition', true);
        $this->dbforge->drop_table('inv_shipping_rule_country', true); 
        $this->dbforge->drop_table('crm_lead_source', true);
        $this->dbforge->drop_table('crm_campaign', true);
        $this->dbforge->drop_table('crm_customer_group', true);
        $this->dbforge->drop_table('crm_customer_account', true); 
        $this->dbforge->drop_table('hr_loan_type', true);
        $this->dbforge->drop_table('hr_employee_loan_application', true);
        $this->dbforge->drop_table('hr_emp_loan_application_rejection');
        $this->dbforge->drop_table('hr_emp_leave_rejection');
        $this->dbforge->drop_table('hr_vehicle', true);  
        $this->dbforge->drop_table('hr_appraisal_template', true);
		$this->dbforge->drop_table('hr_employment_type', true);
		$this->dbforge->drop_table('hr_salary_component_account', true);    
		$this->dbforge->drop_table('hr_leave_type', true);
		$this->dbforge->drop_table('hr_holiday_list', true);
		$this->dbforge->drop_table('hr_holiday_list_holiday', true);
		$this->dbforge->drop_table('hr_leave_block_list', true);
		$this->dbforge->drop_table('hr_leave_block_list_date', true);
		$this->dbforge->drop_table('hr_leave_block_list_allow', true);
		$this->dbforge->drop_table('hr_salary_component', true);
		$this->dbforge->drop_table('hr_job_applicant',TRUE);
		$this->dbforge->drop_table('hr_job_opening',TRUE);
		$this->dbforge->drop_table('hr_training_event',TRUE);
		$this->dbforge->drop_table('hr_trainer',TRUE);
		$this->dbforge->drop_table('hr_expense_claim_type',TRUE);
		$this->dbforge->drop_table('hr_department',TRUE);
		$this->dbforge->drop_table('hr_designation',TRUE);
		$this->dbforge->drop_table('hr_branch',true); 
		$this->dbforge->drop_table('hr_salutation', true);
		$this->dbforge->drop_table('hr_hr_settings', true);
		$this->dbforge->drop_table('hr_employee', true);
        $this->dbforge->drop_table('hr_emp_employment_details', true);
        $this->dbforge->drop_table('hr_emp_job_profile', true);
        $this->dbforge->drop_table('hr_emp_bank_details', true);
        $this->dbforge->drop_table('hr_emp_organization_profile', true);
        $this->dbforge->drop_table('hr_emp_contact_details', true);
        $this->dbforge->drop_table('hr_emp_insurance', true);
        $this->dbforge->drop_table('hr_emp_personal_details', true);
        $this->dbforge->drop_table('hr_emp_educational_details', true);
        $this->dbforge->drop_table('hr_emp_external_work_experience', true);
        $this->dbforge->drop_table('hr_emp_history_in_company', true);
        $this->dbforge->drop_table('hr_emp_exit', true);
        $this->dbforge->drop_table('hr_emp_exit_interview', true);
        $this->dbforge->drop_table('hr_emp_leave_approver', true);
		$this->dbforge->drop_table('sales_territory', true);
    	$this->dbforge->drop_table('sales_partner_target', true); 
    	$this->dbforge->drop_table('acc_fisical_year', true);
    	$this->dbforge->drop_table('acc_fisical_year_company', true);
    	$this->dbforge->drop_table('sales_sales_person', true);
    	$this->dbforge->drop_table('acc_monthly_distribution', true);
    	$this->dbforge->drop_table('acc_monthly_distribution_percentage', true);
    	$this->dbforge->drop_table('sales_sales_partner', true);
    	$this->dbforge->drop_table('sales_selling_settings', true);
        $this->dbforge->drop_table('sales_taxes_charges_template', true);
    	$this->dbforge->drop_table('sales_taxes_charges', true);
    	$this->dbforge->drop_table('pro_project', true);
    	$this->dbforge->drop_table('pro_project_type', true);
        $this->dbforge->drop_table('pro_activity_type', true);
		$this->dbforge->drop_table('pur_supplier', true);
        $this->dbforge->drop_table('pur_supplier_account', true);
        $this->dbforge->drop_table('pur_supplier_type', true);
        $this->dbforge->drop_table('man_workstation',true);
        $this->dbforge->drop_table('man_operation',true);
        $this->dbforge->drop_table('man_bom',true);
        $this->dbforge->drop_table('man_bom_item',true);
        $this->dbforge->drop_table('man_bom_scrap_item',true);
        $this->dbforge->drop_table('man_bom_explosion_item',true);
        $this->dbforge->drop_table('man_manufacturing_settings', true);
        $this->dbforge->drop_table('man_manufacturing_raw_material_type', true);
    }
}

