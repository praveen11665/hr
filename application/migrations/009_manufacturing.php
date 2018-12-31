<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_manufacturing extends CI_Migration 
{
	public function up()
    {
    	if(!$this->db->table_exists('man_production_order'))
	    {
	        $this->dbforge->add_field(array(
	        'production_order_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'man_production_order_status_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'naming_series' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
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
	        'use_multi_level_bom' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'quantity' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'material_transferred_for_manufacturing' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'produced_qty' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),
	        'sales_order_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'project_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'skip_transfer' => array(
	        'type' => 'decimal',
	        'constraint' => '9,2',
	        ),

	        'wip_warehouse' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'fg_warehouse' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'scrap_warehouse' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'null' => false
	        ),
	        'planned_start_date' => array(
		    'type' => 'datetime',
		    ),
		    'actual_start_date' => array(
		    'type' => 'datetime',
		    ),
		    'planned_end_date' => array(
		    'type' => 'datetime',
		    ),
		    'actual_end_date' => array(
		    'type' => 'datetime',
		    ),
		    'expected_delivery_date' => array(
		    'type' => 'date',
	        ),
	        'description' => array(
		    'type' => 'text',
		    ),
		    'uom_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'null' => false
		    ),
		    'company_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    ),
		    'material_request_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'null' => false
		    ),
		    'material_request_item' => array(
		    'type' => 'varchar',
		    'constraint' => 255,
		    'null' => false
		    ),
	        ));

	        $this->dbforge->add_key('production_order_id', true);
	        
	        $this->dbforge->add_field('INDEX (man_production_order_status_id)'); 
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (bom_id)');
	        $this->dbforge->add_field('INDEX (sales_order_id)');
	        $this->dbforge->add_field('INDEX (project_id)');
	        $this->dbforge->add_field('INDEX (wip_warehouse)');
	        $this->dbforge->add_field('INDEX (fg_warehouse)');
	        $this->dbforge->add_field('INDEX (scrap_warehouse)');
	        $this->dbforge->add_field('INDEX (uom_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (material_request_id)');
	        $this->dbforge->create_table('man_production_order', true);
    	}


    	if(!$this->db->table_exists('man_production_order_required_items'))
	    {
	        $this->dbforge->add_field(array(
	        'production_order_required_items_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'production_order_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
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
	        'required_quantity' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'transferred_quantity' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('production_order_required_items_id', true);
	        $this->dbforge->add_field('INDEX (production_order_id)');
	        $this->dbforge->add_field('INDEX (item_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
	        $this->dbforge->create_table('man_production_order_required_items', true);
    	}
  

		if(!$this->db->table_exists('man_timesheet'))
	    {
	        $this->dbforge->add_field(array(
		    'timesheet_id' => array(
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
		    'sales_invoice_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    ),
		    'salary_slip_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    ),
		    'status_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
		    'employee_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    ),
		    'employee_name' => array(
		    'type' => 'varchar',
		    'constraint' => 255,
		    'null' => false
		    ),
		    'user_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    ),
		    'start_date' => array(
		    'type' => 'date',
		    ),
		    'end_date' => array(
		    'type' => 'date',
		    ),
		    'production_order_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
	        ),
	        'total_hours' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    ),
		    'total_billable_hours' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    ),
		    'total_billed_hours' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    ),
		    'total_costing_amount' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    ),
		    'total_billable_amount' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    ),
		    'total_billed_amount' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    ),
		    'per_billed' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    ),
		    'note' => array(
		    'type' => 'longtext'
	        ),
	        ));

	        $this->dbforge->add_key('timesheet_id', true);
	        
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (sales_invoice_id)');
	        $this->dbforge->add_field('INDEX (salary_slip_id)');
	        $this->dbforge->add_field('INDEX (status_id)');
	        $this->dbforge->add_field('INDEX (employee_id)');
	        $this->dbforge->add_field('INDEX (user_id)');
		    $this->dbforge->create_table('man_timesheet', true);
    	}

    	if(!$this->db->table_exists('man_production_planing_tool'))
	    {
	        $this->dbforge->add_field(array(
		    'production_planing_tool_id' => array(
		    'type' => 'int',
		    'constraint' => 10,
		    'unsigned' => true,
		    'auto_increment' => true
		    ),
		    'production_planning_get_items_from_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'customer_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'warehouse_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'company_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'from_date' => array(
		    'type' => 'datetime',
		    ),
		    'to_date' => array(
		    'type' => 'datetime',
		    ),	
	        'project_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'warehouse_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true
	        ),
	        'create_material_requests_for_all_required_qty' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'create_material_requests_non_stock_request' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'use_multi_level_bom' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'only_raw_materials' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        'include_subcontracted' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('production_planing_tool_id', true);
	        $this->dbforge->add_field('INDEX (production_planning_get_items_from_id)');
	        $this->dbforge->add_field('INDEX (customer_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (project_id)');
	        $this->dbforge->add_field('INDEX (warehouse_id)');
		    $this->dbforge->create_table('man_production_planing_tool', true);
    	}	       	
    }

    public function down()
    {
    	$this->dbforge->drop_table('man_production_order', true);
    	$this->dbforge->drop_table('man_production_order_required_items', true);
    	$this->dbforge->drop_table('man_timesheet', true);
    	$this->dbforge->drop_table('man_production_planing_tool', true);
    }

}