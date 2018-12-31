<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_project extends CI_Migration 
{
	public function up()
    {
    	

    	if(!$this->db->table_exists('pro_project_customer_details'))
	    {
	        $this->dbforge->add_field(array(
	        'project_customer_details_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'project_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'customer_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'sales_order_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'notes' => array(
	        'type' => 'longtext',
	        ),
	        'actual_start_date' => array(
	        'type' => 'date',
	        ),
	        'actual_time' => array(
	        'type' => 'time',
	        ),
	        'actual_end_date' => array(
	        'type' => 'date',
	        ),
	        ));

	        $this->dbforge->add_key('project_customer_details_id', true);
	        $this->dbforge->add_field('INDEX (project_id)');
		    $this->dbforge->add_field('INDEX (customer_id)');
		    $this->dbforge->add_field('INDEX (sales_order_id)');
		    $this->dbforge->create_table('pro_project_customer_details', true);
    	}

    	if(!$this->db->table_exists('pro_project_details'))
	    {
	        $this->dbforge->add_field(array(
	        'project_details_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'project_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'estimated_costing' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'total_costing_amount' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'total_expense_claim' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'cost_center_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'total_billing_amount' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'total_purchase_cost' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'total_sales_cost' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'gross_margin' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'per_gross_margin' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
		    ),
		    ));

	        $this->dbforge->add_key('project_details_id', true);
	        $this->dbforge->add_field('INDEX (company_id)');
		    $this->dbforge->add_field('INDEX (cost_center_id)');
		    $this->dbforge->create_table('pro_project_details', true);
    	}

    	if(!$this->db->table_exists('pro_task'))
	    {
	        $this->dbforge->add_field(array(
	        'task_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'subject' => array(
		    'type' => 'varchar',
		    'constraint' => 255,
		    'null' => false
	        ),
	        'project_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'task_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'priority_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'exp_start_date' => array(
	        'type' => 'date',
	        ),
	        'expected_time' => array(
	        'type' => 'time',
	        ),
	        'task_weight' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
		    'null' => false
	        ),
	        'exp_end_date' => array(
	        'type' => 'date',
	        ),
	        'progress' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'is_milestone' => array(
		    'type' => 'tinyint',
		    'constraint' => 4,
		    'null' => false
	        ),
	        'description' => array(
		    'type' => 'longtext',
	        ),
	        'act_start_date' => array(
	        'type' => 'date',
	        ),
	        'actual_time' => array(
	        'type' => 'time',
	        ),
	        'act_end_date' => array(
	        'type' => 'date',
	        ),
	        'total_costing_amount' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'total_expense_claim' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'total_billing_amount' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'review_date' => array(
	        'type' => 'date',
	        ),
	        'closing_date' => array(
	        'type' => 'date',
	        ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        ));

	        $this->dbforge->add_key('task_id', true);
		    $this->dbforge->add_field('INDEX (project_id)');
		    $this->dbforge->add_field('INDEX (task_status_id)');
		    $this->dbforge->add_field('INDEX (priority_id)');
		    $this->dbforge->add_field('INDEX (company_id)');
		    $this->dbforge->create_table('pro_task', true);
    	}

    	if(!$this->db->table_exists('pro_timesheet'))
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
		    'time_sheet_status_id' => array(
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
	        'type' => 'varchar',
	        'constraint' => 255,
	        'unsigned' => true,
	        ),
	        'start_date' => array(
	        'type' => 'date',
	        ),
	        'end_date' => array(
	        'type' => 'date',
	        ),
	        'production_order_id' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'unsigned' => true,
	        ),
	        'total_hours' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'total_billable_hours' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'total_billed_hours' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'total_costing_amount' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'total_billable_amount' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'total_billed_amount' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'per_billed' => array(
		    'type' => 'decimal',
		    'constraint' => '9,2',
		    'null' => false
	        ),
	        'note' => array(
		    'type' => 'longtext',
	        ),

	        ));

	        $this->dbforge->add_key('timesheet_id', true);
		    
		    $this->dbforge->add_field('INDEX (company_id)');
		    $this->dbforge->add_field('INDEX (sales_invoice_id)');
		    $this->dbforge->add_field('INDEX (salary_slip_id)');
		    $this->dbforge->add_field('INDEX (time_sheet_status_id)');
		    $this->dbforge->add_field('INDEX (employee_id)');
		    $this->dbforge->add_field('INDEX (user_id)');
		    $this->dbforge->add_field('INDEX (production_order_id)');
		    $this->dbforge->create_table('pro_timesheet', true);
    	}

    }

    public function down()
    {

    	$this->dbforge->drop_table('pro_project_customer_details', true);
    	$this->dbforge->drop_table('pro_project_details', true);
    	$this->dbforge->drop_table('pro_task', true);
    	$this->dbforge->drop_table('pro_timesheet', true);
    	$this->dbforge->drop_table('pro_activity_cost', true);
    }

}