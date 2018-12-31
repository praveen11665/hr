<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_contacts extends CI_Migration 
{
  
    public function up()
    {
	    if(!$this->db->table_exists('con_address')) 
		{

			$this->dbforge->add_field(array(		    
			'address_id'     		=> array(
			'type' => 'int',
			'constraint' => 10,
			'unsigned' => TRUE,
			'auto_increment' => TRUE
			),
			'address_title'        		=> array(
			'type' => 'varchar',
			'constraint' => '250',
			),
			'address_type_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
			'address_line1'        		=> array(
			'type' => 'varchar',
			'constraint' => '250',
			),
			'address_line2'        		=> array(
			'type' => 'varchar',
			'constraint' => '250',
			),
			'country_id'        		=> array(
			'type' => 'int',
			'constraint' => '10',
			),
			'state_id'        			=> array(
			'type' => 'int',
			'constraint' => 10,
			),
			'city_id'        			=> array(
			'type' => 'int',
			'constraint' => 10,
			),
			'postal_code'        		=> array(
			'type' => 'int',
			'constraint' => 10,
			),
			'email-address'        		=> array(
			'type' => 'varchar',
			'constraint' => 10,
			),
			'phone'        				=> array(
			'type' => 'varchar',
			'constraint' => '250',
			),
			'fax'        				=> array(
			'type' => 'varchar',
			'constraint' => '250',
			),
			'preferred_billing_address'=> array(
			'type' => 'varchar',
			'constraint' => '250',
			),
			'preferred_shipping_address'=> array(
			'type' => 'varchar',
			'constraint' => '250',
			),
			'party gstin'        		=> array(
			'type' => 'varchar',
			'constraint' => '250',
			),
			));
			$this->dbforge->add_key('address_id',TRUE);
			$this->dbforge->add_field('INDEX (country_id)');
			$this->dbforge->add_field('INDEX (state_id)');
			$this->dbforge->add_field('INDEX (city_id)');
			$this->dbforge->create_table('con_address');								
		}

		if(!$this->db->table_exists('con_contact'))
		{
			$this->dbforge->add_field(array
			(
			'contact_id'=>array(
			'type'=>'int',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'first_name'=>array(
			'type'=>'varchar',
			'constraint'=>250,
			),
			'last_name'=>array(
			'type'=>'varchar',
			'constraint'=>255,
			),
			'email_address'=>array(
			'type'=>'varchar',
			'constraint'=>255,
			),
			'user_id'=>array(
			'type'=>'int',
			'constraint'=>11,
			'unsigned'=>TRUE,
			),
			'contact_status_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            ),
			'salutation_id'=>array(
			'type'=>'int',
			'constraint'=>11,
			'unsigned'=>TRUE,
			),
			'gender_id'=>array(
			'type'=>'int',
			'constraint'=>11,
			'unsigned'=>TRUE,
			),
			'phone'=>array(
			'type'=>'varchar',
			'constraint'=>255,
			),
			'mobile_no'=>array(
			'type'=>'varchar',
			'constraint'=>255,
			),
			'is_primary_contact'=>array(
			'type'=>'tinyint',
			'constraint'=>'4'
			),
			'department_id'=>array(
			'type'=>'int',
			'constraint'=>11,
			),
			'designation_id'=>array(
			'type'=>'int',
			'constraint'=>11,
			),
			'unsubscribed'=>array(
			'type'=>'tinyint',
			'constraint'=>'4'
			),
			));
			$this->dbforge->add_key('contact_id',TRUE);
			$this->dbforge->add_field('INDEX (user_id)');
			$this->dbforge->add_field('INDEX (contact_status_id)');
			$this->dbforge->add_field('INDEX (salutation_id)');
			$this->dbforge->add_field('INDEX (gender_id)');
			$this->dbforge->add_field('INDEX (department_id)');
			$this->dbforge->add_field('INDEX (designation_id)');
			$this->dbforge->create_table('con_contact');
		}
	}

    public function down()
    {
    	$this->dbforge->drop_table('con_address', true);
    	$this->dbforge->drop_table('con_contact', true);
    }
 }