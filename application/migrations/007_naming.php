<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_naming extends CI_Migration 
{
  
    public function up()
    {
    	if(!$this->db->table_exists('naming_transaction'))
	    {
	        $this->dbforge->add_field(array(
	        'transaction_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'transaction' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('transaction_id', true);
	        $this->dbforge->create_table('naming_transaction',true);

	        $data = array(
            array('transaction' => 'Vehicle Log'),
            array('transaction' => 'Expense Claim'),
            array('transaction' => 'Employee'),
            array('transaction' => 'Attendance'),
            array('transaction' => 'Leave Application'),
            array('transaction' => 'Leave Allocation'),
            array('transaction' => 'Appraisal')
         );
         
         $this->db->insert_batch('naming_transaction', $data); 
	    }

	    if(!$this->db->table_exists('naming_prefix'))
	    {
	        $this->dbforge->add_field(array(
	        'prefix_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'prefix' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('prefix_id', true);
	        $this->dbforge->create_table('naming_prefix',true);

	        $data = array(
            array('prefix' => '#'),
            array('prefix' => '##'),
            array('prefix' => '###'),
            array('prefix' => '####'),
            array('prefix' => '#####'),
            array('prefix' => '######'),
            array('prefix' => '#######'),
            array('prefix' => '########'),
            array('prefix' => '#########'),
            array('prefix' => '##########'),
         );
         
         $this->db->insert_batch('naming_prefix', $data); 
	    }
	} 

	public function down()
    {
    	$this->dbforge->drop_table('naming_transaction',true);
    	$this->dbforge->drop_table('naming_prefix',true);
	} 

}

