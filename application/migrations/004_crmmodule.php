<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_crmmodule extends CI_Migration 
{
	public function up()
	{
		if(!$this->db->table_exists('crm_lead'))
	    {
	      $this->dbforge->add_field(array(
	        'lead_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
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
		    'lead_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	         ),
		    'gender_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
		    'email_id' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	         ),
		    'lead_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
		    'lead_source_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
		    'company_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	         ),
		    'customer_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
		    'campaign_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
		    'image' => array(
	        'type' => 'text',
	        'null' => false
	         ),
		    'lead_owner' => array(
	        'type' => 'int',
	        'constraint' => 10,
	         ),
		    'contact_by' => array(
	        'type' => 'int',
	        'constraint' => 10,
	         ),
		    'contact_date' => array(
	        'type' => 'datetime'
	         ), 
		   ));

	        $this->dbforge->add_key('lead_id', true);
	        $this->dbforge->add_field('INDEX (salutation_id)');
	        $this->dbforge->add_field('INDEX (gender_id)');
	        
	        $this->dbforge->add_field('INDEX (lead_source_id)');
	        $this->dbforge->add_field('INDEX (customer_id)');
	        $this->dbforge->add_field('INDEX (campaign_id)');
	        $this->dbforge->add_field('INDEX (lead_owner)');
	        $this->dbforge->add_field('INDEX (contact_by)');
	        $this->dbforge->add_field('INDEX (lead_status_id)');
	        $this->dbforge->create_table('crm_lead', true);
    	}

    	if(!$this->db->table_exists('crm_lead_contact_info'))
	    {
	      $this->dbforge->add_field(array(
	        'contact_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	         ),
	        'lead_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'phone' => array(
	        'type' => 'varchar',
	        'constraint' => 20,
	        'null' => false
	         ),
	        'mobile_no' => array(
	        'type' => 'varchar',
	        'constraint' => 20,
	        'null' => false
	         ),
	        'fax' => array(
	        'type' => 'varchar',
	        'constraint' => 60,
	        'null' => false
	         ),
	        'website' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	         ),
	        'territory_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'city' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	         ),
	        'state'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        'country_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('contact_info_id', true);
	        $this->dbforge->add_field('INDEX (lead_id)');
	        $this->dbforge->add_field('INDEX (territory_id)');
	        $this->dbforge->add_field('INDEX (country_id)');
	        $this->dbforge->create_table('crm_lead_contact_info', true);
    	}

    	if(!$this->db->table_exists('crm_lead_more_info'))
	    {
	      $this->dbforge->add_field(array(
	        'more_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	         ),
	        'lead_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'lead_lead_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'lead_market_segment_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'industry_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'lead_request_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'unsubscribed'=>array(
			'type'=>'tinyint',
			'constraint'=> 4,
			),
			'blog_subscriber'=>array(
			'type'=>'tinyint',
			'constraint'=> 4,
			),
	       ));

	        $this->dbforge->add_key('more_info_id', true);
	        $this->dbforge->add_field('INDEX (lead_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->add_field('INDEX (lead_lead_type_id)');
	        $this->dbforge->add_field('INDEX (lead_market_segment_id)');
	        $this->dbforge->add_field('INDEX (lead_request_type_id)');
	        $this->dbforge->add_field('INDEX (industry_type_id)');
	        $this->dbforge->create_table('crm_lead_more_info', true);
    	}

    	if(!$this->db->table_exists('crm_opportunity'))
	    {
	      $this->dbforge->add_field(array(
	        'opportunity_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	         ),
	        'naming_series' => array(
	           'type' => 'varchar',
	           'constraint' => 255,
	           ),
	        'opp_oppurtunity_from_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'customer_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'null' => false
	         ),
	        'lead_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'customer_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	         ),
	        'title' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	         ),
	        'opp_oppurtunity_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'oppurtunity_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'order_lost_reason' => array(
	        'type' => 'text',
	        'null' => false
	         ),
	        'mins_to_first_response' => array(
	        'type' => 'float',
	        'constraint' => 10,2,
	        'null' => false
	         ),
	        'with_items' => array(
	        'type' => 'tinyint',
	        'constraint' => 4,
	        'null' => false
	         ),
	       ));

	        $this->dbforge->add_key('opportunity_id', true);
	        $this->dbforge->add_field('INDEX (customer_id)');
	        
	        $this->dbforge->add_field('INDEX (lead_id)');
	        $this->dbforge->add_field('INDEX (opp_oppurtunity_from_id)');
	        $this->dbforge->add_field('INDEX (opp_oppurtunity_type_id)');
	        $this->dbforge->add_field('INDEX (oppurtunity_status_id)');
	        $this->dbforge->create_table('crm_opportunity', true);
    	}

    	if(!$this->db->table_exists('crm_opportunity_contact_info'))
	    {
	      $this->dbforge->add_field(array(
	        'opportunity_contact_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	         ),
	        'opportunity_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'address_display' => array(
	        'type' => 'text',
	        'null' => false
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
	        'contact_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'contact_display' => array(
	        'type' => 'text',
	        'null' => false
	         ),
	        'contact_email' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	         ),
	        'contact_mobile' => array(
	        'type' => 'varchar',
	        'constraint' => 20,
	        'null' => false
	         ),
	       ));

	        $this->dbforge->add_key('opportunity_contact_info_id', true);
	        $this->dbforge->add_field('INDEX (opportunity_id)');
	        $this->dbforge->add_field('INDEX (address_id)');
	        $this->dbforge->add_field('INDEX (territory_id)');
	        $this->dbforge->add_field('INDEX (customer_group_id)');
	        $this->dbforge->add_field('INDEX (contact_id)');
	        $this->dbforge->create_table('crm_opportunity_contact_info', true);
    	}

    	if(!$this->db->table_exists('crm_opportunity_more_info'))
	    {
	      $this->dbforge->add_field(array(
	        'opportunity_more_info_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	         ),
	        'opportunity_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'lead_source_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'company_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'transaction_date' => array(
	        'type' => 'date',
	         ),
	        'contact_display' => array(
	        'type' => 'text',
	        'null' => false
	         ),
	       ));

	        $this->dbforge->add_key('opportunity_more_info_id', true);
	        $this->dbforge->add_field('INDEX (opportunity_id)');
	        $this->dbforge->add_field('INDEX (lead_source_id)');
	        $this->dbforge->add_field('INDEX (company_id)');
	        $this->dbforge->create_table('crm_opportunity_more_info', true);
    	}

    	if(!$this->db->table_exists('crm_opportunity_next_contact'))
	    {
	      $this->dbforge->add_field(array(
	        'opportunity_next_contact_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	         ),
	        'opportunity_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'user_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'contact_date' => array(
	        'type' => 'date',
	         ),
	        'to_discuss' => array(
	        'type' => 'text',
	        'null' => false
	        ),
	        ));

	        $this->dbforge->add_key('opportunity_next_contact_id', true);
	        $this->dbforge->add_field('INDEX (opportunity_id)');
	        $this->dbforge->add_field('INDEX (user_id)');
	        $this->dbforge->create_table('crm_opportunity_next_contact', true);
    	}

    	if(!$this->db->table_exists('crm_opportunity_source_info'))
	    {
	      $this->dbforge->add_field(array(
	      	'opportunity_source_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'opportunity_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	         ),
	        'lead_source_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'campaign_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'company_id'=>array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'transaction_date'=>array(
	        'type' => 'date'
	        ),
	        ));
	      $this->dbforge->add_key('opportunity_source_id', true);
	      $this->dbforge->add_field('INDEX (opportunity_id)');
	      $this->dbforge->add_field('INDEX (lead_source_id)');
	      $this->dbforge->add_field('INDEX (campaign_id)');
	      $this->dbforge->add_field('INDEX (company_id)');
	      $this->dbforge->create_table('crm_opportunity_source_info', true);
	    }

	    if(!$this->db->table_exists('crm_opportunity_item'))
	    {
	      $this->dbforge->add_field(array(
	      	'opportunity_item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'opportunity_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'qty' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'uom_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'item_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        ),
	        'description' => array(
	        'type' => 'longtext',
	        ),
	        'item_image' => array(
	        'type' => 'text',
	        ),
	        ));
	      $this->dbforge->add_key('opportunity_item_id', true);
	      $this->dbforge->add_field('INDEX (opportunity_id)');
	      $this->dbforge->add_field('INDEX (item_id)');
	      $this->dbforge->add_field('INDEX (uom_id)');
	      $this->dbforge->create_table('crm_opportunity_item', true);
	    }
    	
		if(!$this->db->table_exists('crm_customer'))
	    {
	      $this->dbforge->add_field(array(
			'customer_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
			'naming_series' => array(
	           'type' => 'varchar',
	           'constraint' => 255,
	           ),
			'salutation_id'=>array(
			'type' => 'INT',
			'constraint' => 10,
			'unsigned' => true,
			),
			'customer_name'=> array(
			'type' => 'VARCHAR',
			'constraint' => '250',
			),
			'gender_id'=>array(
			'type' => 'INT',
			'constraint' => 10,
			'unsigned' => true,
			),
			'customer_type_id'=> array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
			),
			'lead_id'=> array(
			'type' => 'int',
	        'constraint' => 10,
			),
			'image'=>array(
			'type'=>'text',
			'constraint'=>50,
			),
			'customer_group_id'=> array(
			'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
			),
			'territory_id'=>array(
			'type' => 'INT',
			'constraint' => 10,
			'unsigned' => true,
			),
			'tax_id'=>array(
			'type' => 'varchar',
			'constraint' => 250,
			),
			'disabled'=>array(    
			'type' => 'tinyint',
			'constraint' => 4,
            'null' => false
			),
			'currency_id'=>array(
			'type' => 'INT',
			'constraint' => 10,
			'unsigned' => true,
			),
			'price_list_id'=>array(
			'type' => 'INT',
			'constraint' => 10,
			'unsigned' => true,
			),
			'language_id'=>array(
			'type' => 'INT',
			'constraint' => 10,
			'unsigned' => true,
			),
			'website'=>array(
			'type' => 'varchar',
			'constraint' => 250,
			),
			'customer_credit_days_based_id'=> array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
			),
			'credit_days'=> array(
			'type' => 'INT',
			'constraint' => 10,
			),
			'credit_limit'=> array(
			'type' => 'DECIMAL',
			'constraint' => 9,2,
			),
			'customer_details'=> array(
			'type' => 'VARCHAR',
			'constraint' => '250',
			),
			'is_frozen'=> array(
			'type' => 'tinyint',
			'constraint' => 10,
			),
			'sales_partner_id'=>array(
			'type' => 'INT',
			'constraint' => 10,
			'unsigned' => true,
			),
			'default_commission_rate'=> array(
			'type' => 'DECIMAL',
			'constraint' => 9,2,
			),
			'customer_pos_id'=> array(
			'type' => 'int',
			'constraint' => 10,
			),
			));
			$this->dbforge->add_key('customer_id',true);
			
			$this->dbforge->add_field('INDEX (salutation_id)');
			$this->dbforge->add_field('INDEX (gender_id)');
			$this->dbforge->add_field('INDEX (customer_type_id)');
			$this->dbforge->add_field('INDEX (lead_id)');
			$this->dbforge->add_field('INDEX (territory_id)');
			$this->dbforge->add_field('INDEX (customer_group_id)');
			$this->dbforge->add_field('INDEX (currency_id)');
			$this->dbforge->add_field('INDEX (price_list_id)');
			$this->dbforge->add_field('INDEX (language_id)');
			$this->dbforge->add_field('INDEX (sales_partner_id)');
			$this->dbforge->create_table('crm_customer',true);
		}

		if(!$this->db->table_exists('crm_customer_sales_team')) 
		{

			$this->dbforge->add_field(array(		    
			'sales_team_id'=> array(
			'type' => 'INT',
			'constraint' => 10,
			'unsigned' => TRUE,
			'auto_increment' => TRUE
			),
			'customer_id'=>array(
			'type' => 'INT',
			'constraint' => 10,
			'unsigned' => true,
			),
			'sales_person_id'=> array(
			'type' => 'INT',
			'constraint' => 10,
			'unsigned' => true,
			),
			'contact_no'=>array(
			'type'=>'varchar',
			'constraint'=>250,
			),
			'allocated_percentage'=>array(
			'type'=>'float',
			),
			'allocated_amount'   => array(
			'type' => 'DECIMAL',
			'constraint' => '9,2',
			),
			'incentives'     => array(
			'type' => 'DECIMAL',
			'constraint' => '9,2',
			),		            
			));
			$this->dbforge->add_key('sales_team_id',true);
			$this->dbforge->add_field('INDEX (customer_id)');
			$this->dbforge->add_field('INDEX (sales_person_id)');
			$this->dbforge->create_table('crm_customer_sales_team',true);
		}

		if(!$this->db->table_exists('crm_sms_center'))
		{
			$this->dbforge->add_field(array
			(
			'sms_center_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'sms_center_send_to_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
			'customer_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'supplier_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'sales_person_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'department_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'branch_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			),
			'message'=>array(
			'type'=>'TEXT',
			'null'=>TRUE,
			),
			'total_characters'=>array(
			'type'=>'INT',
			'constraint'=>10,
			),
			'total_messages'=>array(
			'type'=>'INT',
			'constraint'=>10,
			),
			));
			$this->dbforge->add_key('sms_center_id',true);
			$this->dbforge->add_field('INDEX (customer_id)');
			$this->dbforge->add_field('INDEX (supplier_id)');
			$this->dbforge->add_field('INDEX (sales_person_id)');
			$this->dbforge->add_field('INDEX (department_id)');
			$this->dbforge->add_field('INDEX (branch_id)');
			$this->dbforge->add_field('INDEX (sms_center_send_to_id)');
			$this->dbforge->create_table('crm_sms_center',true);
		}

		if(!$this->db->table_exists('crm_sms_log'))
		{
			$this->dbforge->add_field(array
			(
			'log_id'=>array(
			'type'=>'INT',
			'constraint'=>10,
			'unsigned'=>TRUE,
			'auto_increment'=>TRUE,
			),
			'sender_name'=>array(
			'type'=>'VARCHAR',
			'constraint'=>255,
			),
			'sent_on'=>array(
			'type'=>'DATE',
			'null'=>TRUE,
			),
			'message'=>array(
			'type'=>'TEXT',
			'null'=>TRUE,
			),
			'no_of_requested_sms'=>array(
			'type'=>'INT',
			'constraint'=>10,
			),
			'requested_numbers'=>array(
			'type'=>'INT',
			'constraint'=>10,
			),
			'no_of_sent_sms'=>array(
			'type'=>'INT',
			'constraint'=>10,
			),
			'sent_to'=>array(
			'type'=>'INT',
			'constraint'=>10,
			),
			));
			$this->dbforge->add_key('log_id',true);
			$this->dbforge->create_table('crm_sms_log',true);
		}
		
	}

	public function down()
	{
		$this->dbforge->drop_table('crm_lead', true);
		$this->dbforge->drop_table('crm_lead_contact_info', true);
		$this->dbforge->drop_table('crm_lead_more_info', true);
		$this->dbforge->drop_table('crm_opportunity', true);
		$this->dbforge->drop_table('crm_opportunity_contact_info', true);
		$this->dbforge->drop_table('crm_opportunity_more_info', true);
		$this->dbforge->drop_table('crm_opportunity_next_contact', true);
		$this->dbforge->drop_table('crm_opportunity_source_info', true);
		$this->dbforge->drop_table('crm_opportunity_item', true);
		$this->dbforge->drop_table('crm_customer', true);
		$this->dbforge->drop_table('crm_customer_sales_team',TRUE);
		$this->dbforge->drop_table('crm_sms_center', true);
		$this->dbforge->drop_table('crm_sms_log', true);
	}

}