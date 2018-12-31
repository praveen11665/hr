<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_accounts extends CI_Migration 
{
  
    public function up()
    { 
    	if(!$this->db->table_exists('acc_mode_of_payment'))
        {
            $this->dbforge->add_field(array(
            'mode_of_payment_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
            ),
            'mode_of_payment'=>array(
            'type'=>'VARCHAR',
            'constraint'=>255,
            'unsigned' => TRUE,
            ),
            'mode_of_payment_type_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,
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
            $this->dbforge->add_key ('mode_of_payment_id',TRUE);
            $this->dbforge->add_field('INDEX (mode_of_payment_type_id)');
            $this->dbforge->create_table('acc_mode_of_payment',true);
        }

        if(!$this->db->table_exists('acc_mode_of_payment_account'))
        {
            $this->dbforge->add_field(array(
            'mode_of_payment_account_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
            ),
            'mode_of_payment_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,
            ),
            'company_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,
            ),
            'account_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,
            ),
            
            ));
            $this->dbforge->add_key ('mode_of_payment_account_id',TRUE);
            $this->dbforge->add_field('INDEX (mode_of_payment_id)');
            $this->dbforge->add_field('INDEX (company_id)');
            $this->dbforge->add_field('INDEX (account_id)');
            $this->dbforge->create_table('acc_mode_of_payment_account',true);
        }

        if(!$this->db->table_exists('acc_cost_center'))
        {
            $this->dbforge->add_field(array(
            'cost_center_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
            ),
            'cost_center_name'=>array(
            'type'=>'VARCHAR',
            'constraint'=>255,
            'unsigned' => TRUE,
            ),
            'parent_cost_center'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'default' => NULL,
            'null' => true
            ),
            'company_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,
            ),
            'is_group'=> array(
            'type' => 'tinyint',
            'constraint' => 4,
            ),
            'lft'=> array(
            'type' => 'int',
            'constraint' => 10,
            ),
            'rgt'=> array(
            'type' => 'int',
            'constraint' => 10,
            ),
            'old_parent'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'default' => NULL,
            'null' => true
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
            $this->dbforge->add_key ('cost_center_id',TRUE);
            $this->dbforge->add_field('INDEX (company_id)');
            $this->dbforge->create_table('acc_cost_center',true);
        }

        if(!$this->db->table_exists('acc_account'))
        {
            $this->dbforge->add_field(array(
            'account_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
            ),
            'account_name'=>array(
            'type'=>'VARCHAR',
            'constraint'=>255,
            'unsigned' => TRUE,
            ),
            'is_group' =>array(
            'type' => 'tinyint',
            'constraint' => 4,
            'null' => false
            ), 
            'company_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,          
            ),
            'account_root_type_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,          
            ),
            'account_report_type_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,          
            ),
            'currency_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,          
            ),
            'parent_account'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'null' => true,
            'default' => null          
            ),
            'account_account_type_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,          
            ),
            'tax_rate' =>array(
            'type' => 'decimal',
            'constraint' => '9,2',
            ),
            'account_freeze_account_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,          
            ),
            'account_balance_must_be_id'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,          
            ),
            'lft'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,          
            ),
            'rgt'=> array(
            'type' => 'INT',
            'constraint' => 10,
            'unsigned' => TRUE,          
            ),
            'old_parent'=>array(
            'type'=>'int',
            'constraint'=>10,
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
            $this->dbforge->add_key ('account_id',TRUE);
            $this->dbforge->add_field('INDEX (company_id)');
            $this->dbforge->add_field('INDEX (account_root_type_id)');
            $this->dbforge->add_field('INDEX (account_report_type_id)');
            $this->dbforge->add_field('INDEX (currency_id)');
            $this->dbforge->add_field('INDEX (parent_account)');
            $this->dbforge->add_field('INDEX (account_account_type_id)');
            $this->dbforge->add_field('INDEX (account_freeze_account_id)');
            $this->dbforge->add_field('INDEX (account_balance_must_be_id)');
            $this->dbforge->create_table('acc_account',true);
        }
   	}

   	public function down()
      {   
            $this->dbforge->drop_table('acc_mode_of_payment', true);
            $this->dbforge->drop_table('acc_mode_of_payment_account',true);
            $this->dbforge->drop_table('acc_account', true);
            $this->dbforge->drop_table('acc_cost_center',true);
   	}

}