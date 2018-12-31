<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_default extends CI_Migration 
{  
    public function up()
    {  
    	if(!$this->db->table_exists('def_hr_emp_loan_appliction_status'))
	    {
	        $this->dbforge->add_field(array(
	        'emp_loan_appliction_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('emp_loan_appliction_status_id', true);
	        $this->dbforge->create_table('def_hr_emp_loan_appliction_status',true);

	        $data = array(
            array('emp_loan_appliction_status_id' => 2,
            	  'status' => 'Approved'),
            array('emp_loan_appliction_status_id' => 3,
            	  'status' => 'Rejected')
         );
         
         $this->db->insert_batch('def_hr_emp_loan_appliction_status', $data); 
	    }

	    if(!$this->db->table_exists('def_hr_emp_loan_repayment_method'))
	    {
	        $this->dbforge->add_field(array(
	        'emp_loan_repayment_method_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'repayment_method' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('emp_loan_repayment_method_id', true);
	        $this->dbforge->create_table('def_hr_emp_loan_repayment_method',true); 

	    	$data = array(
            array('repayment_method' => 'Repay Fixed Amount per Period'),
            array('repayment_method' => 'Repay Over Number of Periods')
           
         );
	    	$this->db->insert_batch('def_hr_emp_loan_repayment_method', $data); 
	    }

	    if(!$this->db->table_exists('def_hr_emp_loan_status'))
	    {
	        $this->dbforge->add_field(array(
	        'emp_loan_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('emp_loan_status_id', true);
	        $this->dbforge->create_table('def_hr_emp_loan_status',true); 

	        $data = array(
            array('status' => 'Sanctioned'),
            array('status' => 'Partially Disbursed'),
            array('status' => 'Fully Disbursed'),
            array('status' => 'Repaid/Closed '),
         );
	    	$this->db->insert_batch('def_hr_emp_loan_status', $data); 

	    }

	    if(!$this->db->table_exists('def_hr_vehicle_fuel_type'))
	    {
	        $this->dbforge->add_field(array(
	        'vehicle_fuel_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'fuel_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('vehicle_fuel_type_id', true);
	        $this->dbforge->create_table('def_hr_vehicle_fuel_type',true); 

	        $data = array(
            array('fuel_type' 				=> 'Petrol'),
            array('fuel_type' 				=> 'Diesel'),
            array('fuel_type' 				=> 'Natural Gas'),
            array('fuel_type' 				=> 'Electric')
         );
	    	$this->db->insert_batch('def_hr_vehicle_fuel_type', $data); 
	    }

	    if(!$this->db->table_exists('def_hr_training_eve_event_status'))
	    {
	        $this->dbforge->add_field(array(
	        'training_eve_event_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'event_status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('training_eve_event_status_id', true);
	        $this->dbforge->create_table('def_hr_training_eve_event_status',true); 
	        $data = array(
            array('event_status' 					=> 'Scheduled'),
            array('event_status' 					=> 'Completed'),
            array('event_status' 					=> 'Cancelled ')
           					
         );
	    	$this->db->insert_batch('def_hr_training_eve_event_status', $data); 
	    }

	    if(!$this->db->table_exists('def_hr_training_event_type'))
	    {
	        $this->dbforge->add_field(array(
	        'training_event_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('training_event_type_id', true);
	        $this->dbforge->create_table('def_hr_training_event_type',true); 

	        $data = array(
            array('type' 					=> 'Seminar'),
            array('type' 					=> 'Theory'),
            array('type' 					=> 'Workshop'),
            array('type' 					=> 'Conference'),
            array('type' 					=> 'Exam '),
            array('type' 					=> 'Internet')
           					
         );
	    	$this->db->insert_batch('def_hr_training_event_type', $data); 
	    }


	    if(!$this->db->table_exists('def_hr_training_event_status'))
	    {
	        $this->dbforge->add_field(array(
	        'training_event_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('training_event_status_id', true);
	        $this->dbforge->create_table('def_hr_training_event_status',true); 

	        $data = array(
            array('status' 					=> 'Open'),
            array('status' 					=> 'Invited'),
            array('status' 					=> 'Attended '),
            array('status' 					=> 'Withdrawn '),
         	);
	    	$this->db->insert_batch('def_hr_training_event_status', $data); 
	    }

	    if(!$this->db->table_exists('def_hr_holiday_list_weekly_off'))
	    {
	        $this->dbforge->add_field(array(
	        'holliday_list_weekly_off_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        ),
	        'weekly_off' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('holliday_list_weekly_off_id', true);
	        $this->dbforge->create_table('def_hr_holiday_list_weekly_off',true); 

	        $data = array(
            array('holliday_list_weekly_off_id' => 0,
            	  'weekly_off' 					=> 'Sunday'),
            array('holliday_list_weekly_off_id' => 1,
            	  'weekly_off' 					=> 'Monday'),
            array('holliday_list_weekly_off_id' => 2,
            	  'weekly_off' 					=> 'Tuesday'),
            array('holliday_list_weekly_off_id' => 3,
            	  'weekly_off' 					=> 'Wednesday'),
            array('holliday_list_weekly_off_id' => 4,
            	  'weekly_off' 					=> 'Thursday'),
            array('holliday_list_weekly_off_id' => 5,
            	  'weekly_off' 					=> 'Friday'),
            array('holliday_list_weekly_off_id' => 6,
            	  'weekly_off' 					=> 'Saturday'),
         	);
	    	$this->db->insert_batch('def_hr_holiday_list_weekly_off', $data); 
	    }

	    if(!$this->db->table_exists('def_hr_job_opening_status'))
	    {
	        $this->dbforge->add_field(array(
	        'job_opening_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('job_opening_status_id', true);
	        $this->dbforge->create_table('def_hr_job_opening_status',true); 

	        $data = array(
            array('status' 				=> 'Open'),
            array('status' 				=> 'Closed')
            
         	);
	    	$this->db->insert_batch('def_hr_job_opening_status', $data);
	    }

	    if(!$this->db->table_exists('def_hr_job_applicant_status'))
	    {
	        $this->dbforge->add_field(array(
	        'job_applicant_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('job_applicant_status_id', true);
	        $this->dbforge->create_table('def_hr_job_applicant_status',true); 

	        $data = array(
            array('status'=> 'Open'),
            array('status'=> 'Replied'),
            array('status'=> 'Rejected'),
            array('status'=> 'Hold')
            
         	);
	    	$this->db->insert_batch('def_hr_job_applicant_status', $data);
	    }

	    if(!$this->db->table_exists('def_hr_salary_component_type'))
	    {
	        $this->dbforge->add_field(array(
	        'salary_component_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('salary_component_type_id', true);
	        $this->dbforge->create_table('def_hr_salary_component_type',true); 

	        $data = array(
            array('type' 				=> 'Earning'),
            array('type' 				=> 'Deduction')
         	);
	    	$this->db->insert_batch('def_hr_salary_component_type', $data);
	    }

		if(!$this->db->table_exists('def_hr_vehicle_log_service_item'))
	    {
	        $this->dbforge->add_field(array(
	        'vehicle_log_service_item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'service_item' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('vehicle_log_service_item_id', true);
	        $this->dbforge->create_table('def_hr_vehicle_log_service_item',true); 

	        $data = array(
            array('service_item' 							=> 'Brake Oil'),
            array('service_item' 							=> 'Brake Pad'),
            array('service_item' 							=> 'Clutch Plate'),
            array('service_item' 							=> 'Engine Oil'),
            array('service_item' 							=> 'Oil Change'),
            array('service_item' 							=> 'Wheels'),
         	);
	    	$this->db->insert_batch('def_hr_vehicle_log_service_item', $data);
	    }

	    if(!$this->db->table_exists('def_hr_vehicle_log_service_type'))
	    {
	        $this->dbforge->add_field(array(
	        'vehicle_log_service_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'service_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('vehicle_log_service_type_id', true);
	        $this->dbforge->create_table('def_hr_vehicle_log_service_type',true); 

	        $data = array(
            array('service_type' 							=> 'Inspection'),
            array('service_type' 							=> 'Service'),
            array('service_type' 							=> 'Change')
         	);
	    	$this->db->insert_batch('def_hr_vehicle_log_service_type', $data);
	    }

	    if(!$this->db->table_exists('def_hr_vehicle_log_frquency'))
	    {
	        $this->dbforge->add_field(array(
	        'vehicle_log_frquency_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'frequency' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('vehicle_log_frquency_id', true);
	        $this->dbforge->create_table('def_hr_vehicle_log_frquency',true); 

	        $data = array(
            array('frequency'=> 'Mileage'),
            array('frequency'=> 'Monthly'),
            array('frequency'=> 'Quarterly'),
            array('frequency'=> 'Half Yearly'),
            array('frequency'=> 'Yearly'),
         	);
	    	$this->db->insert_batch('def_hr_vehicle_log_frquency', $data);
	    }

	    if(!$this->db->table_exists('def_hr_expense_claim_status'))
	    {
	        $this->dbforge->add_field(array(
	        'expense_claim_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('expense_claim_status_id', true);
	        $this->dbforge->create_table('def_hr_expense_claim_status',true); 

	        $data = array(
            array('status'=> 'Draft'),
            array('status'=> 'Paid'),
            array('status'=> 'Unpaid'),
            array('status'=> 'Rejected'),
            array('status'=> 'Submitted'),
            array('status'=> 'Cancelled')
         	);
	    	$this->db->insert_batch('def_hr_expense_claim_status', $data);
	    }

	    if(!$this->db->table_exists('def_hr_expense_claim_approval_status'))
	    {
	        $this->dbforge->add_field(array(
	        'expense_claim_approval_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'approval_status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('expense_claim_approval_status_id', true);
	        $this->dbforge->create_table('def_hr_expense_claim_approval_status',true); 

	        $data = array(
            array('approval_status'=> 'Approved'),
            array('approval_status'=> 'Rejected'),
         	);
	    	$this->db->insert_batch('def_hr_expense_claim_approval_status', $data);
	    }

	    if(!$this->db->table_exists('def_hr_hr_settings_employee_name'))
	    {
	        $this->dbforge->add_field(array(
	        'hr_settings_employee_name_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'employee_name' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('hr_settings_employee_name_id', true);
	        $this->dbforge->create_table('def_hr_hr_settings_employee_name',true); 

	        $data = array(
            array('employee_name'=> 'Full name'),
            array('employee_name'=> 'Naming series'),
            array('employee_name'=> 'Employee number')            
         	);
	    	$this->db->insert_batch('def_hr_hr_settings_employee_name', $data);
	    }

	    if(!$this->db->table_exists('def_gender'))
	    {
	        $this->dbforge->add_field(array(
	        'gender_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'gender' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('gender_id', true);
	        $this->dbforge->create_table('def_gender',true); 

	        $data = array(
            array('gender'=> 'Male '),
            array('gender'=> 'Female '),
            array('gender'=> 'Transgender')            
         	);
	    	$this->db->insert_batch('def_gender', $data);
	    }

	    if(!$this->db->table_exists('def_hr_employee_status'))
	    {
	        $this->dbforge->add_field(array(
	        'employee_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('employee_status_id', true);
	        $this->dbforge->create_table('def_hr_employee_status',true); 
	        $data = array(
            array('status'=> 'Active'),
            array('status'=> 'Left'),
         	);
	    	$this->db->insert_batch('def_hr_employee_status', $data);
	    }


	    if(!$this->db->table_exists('def_hr_employee_salary_mode'))
	    {
	        $this->dbforge->add_field(array(
	        'employee_salary_mode_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'salary_mode' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('employee_salary_mode_id', true);
	        $this->dbforge->create_table('def_hr_employee_salary_mode',true); 
	         $data = array(
            array('salary_mode'=> 'Bank'),
            array('salary_mode'=> 'Cash'),
            array('salary_mode'=> 'Cheque')
         	);
	    	$this->db->insert_batch('def_hr_employee_salary_mode', $data);
	    
	    }

	    if(!$this->db->table_exists('def_hr_employee_salary_slip_status'))
	    {
	        $this->dbforge->add_field(array(
	        'employee_salary_slip_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('employee_salary_slip_status_id', true);
	        $this->dbforge->create_table('def_hr_employee_salary_slip_status',true); 
	         $data = array(
            array('status'=> 'Draft'),
            array('status'=> 'Submitted'),
            array('status'=> 'Cancelled')
         	);
	    	$this->db->insert_batch('def_hr_employee_salary_slip_status', $data);
	    
	    }

	    if(!$this->db->table_exists('def_hr_employee_preferred_contact_email'))
	    {
	        $this->dbforge->add_field(array(
	        'employee_preferred_contact_email_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'preferred_contact_email' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('employee_preferred_contact_email_id', true);
	        $this->dbforge->create_table('def_hr_employee_preferred_contact_email',true); 

	        $data = array(
            array('preferred_contact_email'=> 'Company Email'),
            array('preferred_contact_email'=> 'Personal Email'),
            array('preferred_contact_email'=> 'User ID')
         	);
	    	$this->db->insert_batch('def_hr_employee_preferred_contact_email', $data);
	    }

	    if(!$this->db->table_exists('def_hr_employee_permanent_address'))
	    {
	        $this->dbforge->add_field(array(
	        'employee_permanent_address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'permanent_accommodation_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('employee_permanent_address_id', true);
	        $this->dbforge->create_table('def_hr_employee_permanent_address',true);

	         $data = array(
            array('permanent_accommodation_type'=> 'Rented'),
            array('permanent_accommodation_type'=> 'Owned')
         	);
	    	$this->db->insert_batch('def_hr_employee_permanent_address', $data); 
	    }

	    if(!$this->db->table_exists('def_hr_employee_current_address'))
	    {
	        $this->dbforge->add_field(array(
	        'employee_current_address_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'current_accommodation_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('employee_current_address_id', true);
	        $this->dbforge->create_table('def_hr_employee_current_address',true); 
	         $data = array(
            array('current_accommodation_type'=> 'Rented'),
            array('current_accommodation_type'=> 'Owned')
         	);
	    	$this->db->insert_batch('def_hr_employee_current_address', $data); 
	    }

	    if(!$this->db->table_exists('def_marital_status'))
	    {
	        $this->dbforge->add_field(array(
	        'marital_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'marital_status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('marital_status_id', true);
	        $this->dbforge->create_table('def_marital_status',true);

	        $data = array(
            array('marital_status'=> 'Single'),
            array('marital_status'=> 'Married'),
            array('marital_status'=> 'Divorced'),
            array('marital_status'=> 'Widowed')
         	);
	    	$this->db->insert_batch('def_marital_status', $data);  
	    }

	    if(!$this->db->table_exists('def_blood_group'))
	    {
	        $this->dbforge->add_field(array(
	        'blood_group_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'blood_group' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('blood_group_id', true);
	        $this->dbforge->create_table('def_blood_group',true); 
	         $data = array(
            array('blood_group'=> 'A+'),
            array('blood_group'=> 'A'),
            array('blood_group'=> 'B+'),
            array('blood_group'=> 'B-'),
            array('blood_group'=> 'AB+'),
            array('blood_group'=> 'AB-'),
            array('blood_group'=> 'O+'),
            array('blood_group'=> 'O-'),

         	);
	    	$this->db->insert_batch('def_blood_group', $data); 
	    }

	    if(!$this->db->table_exists('def_hr_employee_level'))
	    {
	        $this->dbforge->add_field(array(
	        'employee_level_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'level' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('employee_level_id', true);
	        $this->dbforge->create_table('def_hr_employee_level',true); 

	        $data = array(
            array('level'=> 'Graduate'),
            array('level'=> 'Post Graduate'),
            array('level'=> 'Under Graduate')
         	);
	    	$this->db->insert_batch('def_hr_employee_level', $data);  
	    }

	    if(!$this->db->table_exists('def_hr_employee_leave_en_cashed'))
	    {
	        $this->dbforge->add_field(array(
	        'employee_leave_en_cashed_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'leave_en_cashed' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('employee_leave_en_cashed_id', true);
	        $this->dbforge->create_table('def_hr_employee_leave_en_cashed',true);

	         $data = array(
            array('leave_en_cashed'=> 'Yes'),
            array('leave_en_cashed'=> 'No ')
         	);
	    	$this->db->insert_batch('def_hr_employee_leave_en_cashed', $data);   
	    }

	    if(!$this->db->table_exists('def_hr_employee_attendance_status'))
	    {
	        $this->dbforge->add_field(array(
	        'employee_attendance_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('employee_attendance_status_id', true);
	        $this->dbforge->create_table('def_hr_employee_attendance',true);

	        $data = array(
            array('status'=>'Present'),
            array('status'=>'Absent'),
            array('status'=>'On leave'),
            array('status'=>'Half day')
         	);
	    	$this->db->insert_batch('def_hr_employee_attendance', $data); 
	    }

	    if(!$this->db->table_exists('def_hr_leave_application_status'))
	    {
	        $this->dbforge->add_field(array(
	        'leave_application_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('leave_application_status_id', true);
	        $this->dbforge->create_table('def_hr_leave_application_status',true); 

	         $data = array(
            array('status'=>'Open'),
            array('status'=>'Approved'),
            array('status'=>'Rejected')
         	);
	    	$this->db->insert_batch('def_hr_leave_application_status', $data); 
	    }

	    if(!$this->db->table_exists('def_hr_offer_letter_status'))
	    {
	        $this->dbforge->add_field(array(
	        'offer_letter_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('offer_letter_status_id', true);
	        $this->dbforge->create_table('def_hr_offer_letter_status',true); 

	        $data = array(
            array('status'=>'Awaiting Response'),
            array('status'=>'Accepted'),
            array('status'=>'Rejected')
         	);
	    	$this->db->insert_batch('def_hr_offer_letter_status', $data); 
	    }

	    if(!$this->db->table_exists('def_hr_payroll_frquency'))
	    {
	        $this->dbforge->add_field(array(
	        'payroll_frequency_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'payroll_frequency' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('payroll_frequency_id', true);
	        $this->dbforge->create_table('def_hr_payroll_frquency',true); 

	        $data = array(
            array('payroll_frequency'=>'Monthly'),
            array('payroll_frequency'=>'Fortnightly'),
            array('payroll_frequency'=>'Bimonthly'),
            array('payroll_frequency'=>'Weekly'),
            array('payroll_frequency'=>'Daily'),

         	);
	    	$this->db->insert_batch('def_hr_payroll_frquency', $data);
	    }

	    if(!$this->db->table_exists('def_hr_salary_slip_status'))
	    {
	        $this->dbforge->add_field(array(
	        'salary_slip_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('salary_slip_status_id', true);
	        $this->dbforge->create_table('def_hr_salary_slip_status',true); 

	        $data = array(
            array('status'=>'Draft'),
            array('status'=>'Submitted'),
            array('status'=>'Cancelled'),

         	);
	    	$this->db->insert_batch('def_hr_salary_slip_status', $data);
	    }

	    
	    if(!$this->db->table_exists('def_hr_salary_structure_is_active'))
	    {
	        $this->dbforge->add_field(array(
	        'salary_structure_is_active_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'is_active' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('salary_structure_is_active_id', true);
	        $this->dbforge->create_table('def_hr_salary_structure_is_active',true); 

	        $data = array(
            array('is_active'=>'Yes '),
            array('is_active'=>'No')
         	);
	    	$this->db->insert_batch('def_hr_salary_structure_is_active', $data); 
	    }

	    if(!$this->db->table_exists('def_hr_appraisal_status'))
	    {
	        $this->dbforge->add_field(array(
	        'appraisal_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('appraisal_status_id', true);
	        $this->dbforge->create_table('def_hr_appraisal_status',true); 

	        $data = array(
            array('status'=>'Submitted'),
            array('status'=>'Completed'),
            array('status'=>'Cancelled')

         	);
	    	$this->db->insert_batch('def_hr_appraisal_status', $data);  
	    }
    	if(!$this->db->table_exists('def_crm_lead_status'))
	    {
	        $this->dbforge->add_field(array(
	        'lead_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('lead_status_id', true);
	        $this->dbforge->create_table('def_crm_lead_status',true);

	        $data = array(
            array('status' => 'Lead Open'),
            array('status' => 'Replied'),
            array('status' => 'Opportunity'),
            array('status' => 'Quotation'),
            array('status' => 'Lost'),
            array('status' => 'Quotation'),
            array('status' => 'Interested'),
            array('status' => 'Converted Do'),
            array('status' => 'Not Contact')
	        );

	        $this->db->insert_batch('def_crm_lead_status', $data); 
		        
	    }

	    if(!$this->db->table_exists('def_crm_lead_lead_type'))
	    {
	        $this->dbforge->add_field(array(
	        'lead_lead_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'lead_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('lead_lead_type_id', true);
	        $this->dbforge->create_table('def_crm_lead_lead_type',true);

	        $data = array(
            array('lead_type' => 'Client'),
            array('lead_type' => 'Channel Partner'),
            array('lead_type' => 'Consultant'),
	        );

	        $this->db->insert_batch('def_crm_lead_lead_type', $data); 
		        
	    }

	    if(!$this->db->table_exists('def_crm_lead_market_segment'))
	    {
	        $this->dbforge->add_field(array(
	        'lead_market_segment_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'market_segment' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('lead_market_segment_id', true);
	        $this->dbforge->create_table('def_crm_lead_market_segment',true);

	        $data = array(
            array('market_segment' => 'Lower income'),
            array('market_segment' => 'Middle income'),
            array('market_segment' => 'Upper income'),
	        );

	        $this->db->insert_batch('def_crm_lead_market_segment', $data); 
	        
	    }

	    if(!$this->db->table_exists('def_crm_lead_request_type'))
	    {
	        $this->dbforge->add_field(array(
	        'lead_request_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'request_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('lead_request_type_id', true);
	        $this->dbforge->create_table('def_crm_lead_request_type',true);

	        $data = array(
            array('request_type' => 'Product enquiry'),
            array('request_type' => 'Request for information'),
            array('request_type' => 'Suggestions'),
            array('request_type' => 'Others'),
	        );

	        $this->db->insert_batch('def_crm_lead_request_type', $data); 
	        
	    }

	    if(!$this->db->table_exists('def_crm_opp_oppurtunity_from'))
	    {
	        $this->dbforge->add_field(array(
	        'opp_oppurtunity_from_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'oppurtunity_from' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('opp_oppurtunity_from_id', true);
	        $this->dbforge->create_table('def_crm_opp_oppurtunity_from',true);

	        $data = array(
            array('oppurtunity_from' => 'Lead'),
            array('oppurtunity_from' => 'Customer'),

	        );

	        $this->db->insert_batch('def_crm_opp_oppurtunity_from', $data); 
	        
	    }

	    if(!$this->db->table_exists('def_crm_opp_oppurtunity_type'))
	    {
	        $this->dbforge->add_field(array(
	        'opp_oppurtunity_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'oppurtunity_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('opp_oppurtunity_type_id', true);
	        $this->dbforge->create_table('def_crm_opp_oppurtunity_type',true);

	        $data = array(
            array('oppurtunity_type' => 'Sales'),
            array('oppurtunity_type' => 'Maintenance'),

	        );

	        $this->db->insert_batch('def_crm_opp_oppurtunity_type', $data); 
	        
	    }

	    if(!$this->db->table_exists('def_crm_oppurtunity_status'))
	    {
	        $this->dbforge->add_field(array(
	        'oppurtunity_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('oppurtunity_status_id', true);
	        $this->dbforge->create_table('def_crm_oppurtunity_status',true);

	        $data = array(
            array('status' => 'Open'),
            array('status' => 'Quotation'),
            array('status' => 'Converted'),
            array('status' => 'Lost'),
            array('status' => 'Replied'),
            array('status' => 'Closed'),
	        );

	        $this->db->insert_batch('def_crm_oppurtunity_status', $data); 
	        
	    }

	    if(!$this->db->table_exists('def_crm_customer_type'))
	    {
	        $this->dbforge->add_field(array(
	        'customer_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('customer_type_id', true);
	        $this->dbforge->create_table('def_crm_customer_type',true);

	        $data = array(
            array('type' => 'Company'),
            array('type' => 'Individual'),
	        );

	        $this->db->insert_batch('def_crm_customer_type', $data); 
	        
	    }

	    if(!$this->db->table_exists('def_crm_customer_credit_days_based'))
	    {
	        $this->dbforge->add_field(array(
	        'customer_credit_days_based_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'credit_days_based_on' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('customer_credit_days_based_id', true);
	        $this->dbforge->create_table('def_crm_customer_credit_days_based',true);

	        $data = array(
            array('credit_days_based_on' => 'Fixed days'),
            array('credit_days_based_on' => 'Last day of the next month'),
	        );

	        $this->db->insert_batch('def_crm_customer_credit_days_based', $data); 
	        
	    }

	    if(!$this->db->table_exists('def_crm_sms_center_send_to'))
	    {
	        $this->dbforge->add_field(array(
	        'sms_center_send_to_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'send_to' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('sms_center_send_to_id', true);
	        $this->dbforge->create_table('def_crm_sms_center_send_to',true);

	        $data = array(
            array('send_to' => 'All Contact'),
            array('send_to' => 'All Customer Contact'),
            array('send_to' => 'All Supplier Contact'),
            array('send_to' => 'All Sales Partner Contact'),
            array('send_to' => 'All Lead (Open)'),
            array('send_to' => 'All Employee (Active)'),
            array('send_to' => 'All Sales Person'),
	        );

	        $this->db->insert_batch('def_crm_sms_center_send_to', $data); 
	        
	    }



	    if(!$this->db->table_exists('def_pur_buying_supplier_naming'))
	    {
	        $this->dbforge->add_field(array(
	        'buying_supplier_naming_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'supplier_naming' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('buying_supplier_naming_id', true);
	        $this->dbforge->create_table('def_pur_buying_supplier_naming',true); 

	        $data = array(
            array('supplier_naming'=> 'Supplier Name'),
            array('supplier_naming'=> 'Naming series')
        	);
	    	$this->db->insert_batch('def_pur_buying_supplier_naming', $data);
	    }


	    if(!$this->db->table_exists('def_pur_buying_pur_order_req'))
	    {
	        $this->dbforge->add_field(array(
	        'buying_pur_order_req_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'purchase_order_required' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('buying_pur_order_req_id', true);
	        $this->dbforge->create_table('def_pur_buying_pur_order_req',true); 

	        $data = array(
            array('purchase_order_required'=> 'Yes'),
            array('purchase_order_required'=> 'No')
        	);
	    	$this->db->insert_batch('def_pur_buying_pur_order_req', $data);
	    }

	    if(!$this->db->table_exists('def_pur_buying_pur_receipt_req'))
	    {
	        $this->dbforge->add_field(array(
	        'buying_pur_receipt_req_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'purchase_receipt_required' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('buying_pur_receipt_req_id', true);
	        $this->dbforge->create_table('def_pur_buying_pur_receipt_req',true); 

	        $data = array(
            array('purchase_receipt_required'=> 'Yes'),
            array('purchase_receipt_required'=> 'No')
        	);
	    	$this->db->insert_batch('def_pur_buying_pur_receipt_req', $data);
	    }


	    if(!$this->db->table_exists('def_pur_purchase_taxes_type'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_taxes_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('purchase_taxes_type_id', true);
	        $this->dbforge->create_table('def_pur_purchase_taxes_type',true); 

	        $data = array(
            array('type'=> 'Actual'),
            array('type'=> 'On Net Total'),
            array('type'=> 'On Previous Row Amount'),
            array('type'=> 'On Previous Row Total'),
        	);
	    	$this->db->insert_batch('def_pur_purchase_taxes_type', $data);
	    }


	    if(!$this->db->table_exists('def_pur_purchase_taxes_add_or_dec'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_taxes_add_or_dec_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'add_or_deduct' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('purchase_taxes_add_or_dec_id', true);
	        $this->dbforge->create_table('def_pur_purchase_taxes_add_or_dec',true); 

	        $data = array(
            array('add_or_deduct'=> 'Add'),
            array('add_or_deduct'=> 'Deduct')            
        	);
	    	$this->db->insert_batch('def_pur_purchase_taxes_add_or_dec', $data);
	    }


	    if(!$this->db->table_exists('def_pur_sup_scor_evaluation_period'))
	    {
	        $this->dbforge->add_field(array(
	        'sup_scor_evaluation_period_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'evaluation_period' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('sup_scor_evaluation_period_id', true);
	        $this->dbforge->create_table('def_pur_sup_scor_evaluation_period',true); 

	        $data = array(
            array('evaluation_period'=> 'Per Week'),
            array('evaluation_period'=> 'Per Month'),
            array('evaluation_period'=> 'Per Year')            
        	);
	    	$this->db->insert_batch('def_pur_sup_scor_evaluation_period', $data);
	    }

	    if(!$this->db->table_exists('def_pur_sup_scor_color'))
	    {
	        $this->dbforge->add_field(array(
	        'sup_scor_color_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'color' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('sup_scor_color_id', true);
	        $this->dbforge->create_table('def_pur_sup_scor_color',true); 

	        $data = array(
            array('color'=> 'Blue'),
            array('color'=> 'Purple'),
            array('color'=> 'Green'),
            array('color'=> 'Yellow'),            
            array('color'=> 'Orange'),
            array('color'=> 'Red')
        	);
	    	$this->db->insert_batch('def_pur_sup_scor_color', $data);
	    }


	    if(!$this->db->table_exists('def_pur_material_req_type'))
	    {
	        $this->dbforge->add_field(array(
	        'pur_material_req_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('pur_material_req_type_id', true);
	        $this->dbforge->create_table('def_pur_material_req_type',true); 

	        $data = array(
            array('type'=> 'Purchase'),
            array('type'=> 'Material Transfer'),
            array('type'=> 'Material Issue'),
            array('type'=> 'Manufacture') 
        	);
	    	$this->db->insert_batch('def_pur_material_req_type', $data);
	    }


	    if(!$this->db->table_exists('def_pur_purchasing_status'))
	    {
	        $this->dbforge->add_field(array(
	        'purchasing_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('purchasing_status_id', true);
	        $this->dbforge->create_table('def_pur_purchasing_status',true); 

	        $data = array(
            array('status'=> 'Draft'),
            array('status'=> 'Submitted'),
            array('status'=> 'Stopped'),
            array('status'=> 'Cancelled'),
            array('status'=> 'Pending'),
            array('status'=> 'Partially Ordered'),
            array('status'=> 'Ordered'),
            array('status'=> 'Issued'),
            array('status'=> 'Transferred')
           );
	    	$this->db->insert_batch('def_pur_purchasing_status', $data);
	    }


	    if(!$this->db->table_exists('def_pur_req_for_quo_status'))
	    {
	        $this->dbforge->add_field(array(
	        'req_for_quo_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('req_for_quo_status_id', true);
	        $this->dbforge->create_table('def_pur_req_for_quo_status',true); 

	        $data = array(
            array('status'=> 'Draft'),
            array('status'=> 'To bill'),
            array('status'=> 'Completed'),
            array('status'=> 'Cancelled'),
            array('status'=> 'Closed')            
           );
	    	$this->db->insert_batch('def_pur_req_for_quo_status', $data);
	    }


	    if(!$this->db->table_exists('def_pur_supplier_quo'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_quo_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('supplier_quo_id', true);
	        $this->dbforge->create_table('def_pur_supplier_quo',true); 

	        $data = array(
            array('type'=> 'Actual'),
            array('type'=> 'On net total'),
            array('type'=> 'On previous row amount'),
            array('type'=> 'ON previous row total')
            );
	    	$this->db->insert_batch('def_pur_supplier_quo', $data);
	    }

	    if(!$this->db->table_exists('def_pur_supplier_quo_consider_tax_or_change'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_quo_consider_tax_or_change_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'consider_tax_or_charge_for' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('supplier_quo_consider_tax_or_change_id', true);
	        $this->dbforge->create_table('def_pur_supplier_quo_consider_tax_or_change',true); 

	        $data = array(
            array('consider_tax_or_charge_for'=> 'Valuation and Total'),
            array('consider_tax_or_charge_for'=> 'Valuation'),
            array('consider_tax_or_charge_for'=> 'Total')
            );
	    	$this->db->insert_batch('def_pur_supplier_quo_consider_tax_or_change', $data);
	    }

	    if(!$this->db->table_exists('def_pur_supplier_quo_add_or_deduct'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_quo_add_or_deduct_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'add_or_deduct' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('supplier_quo_add_or_deduct_id', true);
	        $this->dbforge->create_table('def_pur_supplier_quo_add_or_deduct',true); 

	        $data = array(
            array('add_or_deduct'=> 'Add'),
            array('add_or_deduct'=> 'Deduct')
            );
	    	$this->db->insert_batch('def_pur_supplier_quo_add_or_deduct', $data);
	    }


	    if(!$this->db->table_exists('def_pur_supplier_quo_apply_addi_disc'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_quo_apply_addi_disc_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'apply_additional_discount_on' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('supplier_quo_apply_addi_disc_id', true);
	        $this->dbforge->create_table('def_pur_supplier_quo_apply_addi_disc',true); 

	        $data = array(
            array('apply_additional_discount_on'=> 'Grand total'),
            array('apply_additional_discount_on'=> 'Net total')
            );
	    	$this->db->insert_batch('def_pur_supplier_quo_apply_addi_disc', $data);
	    }


	    if(!$this->db->table_exists('def_pur_supplier_quo_status'))
	    {
	        $this->dbforge->add_field(array(
	        'supplier_quo_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('supplier_quo_status_id', true);
	        $this->dbforge->create_table('def_pur_supplier_quo_status',true); 

	        $data = array(
            array('status'=> 'Draft'),
            array('status'=> 'Submitted'),
            array('status'=> 'Stopped'),
            array('status'=> 'Cancelled')
            );
	    	$this->db->insert_batch('def_pur_supplier_quo_status', $data);
	    }


	    if(!$this->db->table_exists('def_pur_purchase_sup_quo_order'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_sup_quo_order_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'supply_raw_materials' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('purchase_sup_quo_order_id', true);
	        $this->dbforge->create_table('def_pur_purchase_sup_quo_order',true); 

	        $data = array(
            array('supply_raw_materials'=> 'Yes'),
            array('supply_raw_materials'=> 'No')            
            );
	    	$this->db->insert_batch('def_pur_purchase_sup_quo_order', $data);
	    }


	    if(!$this->db->table_exists('def_pur_purchase_order_type'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_order_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('purchase_order_type_id', true);
	        $this->dbforge->create_table('def_pur_purchase_order_type',true); 

	        $data = array(
            array('type'=> 'Actual'),
            array('type'=> 'On net total'),
            array('type'=> 'On previous row amount'),
            array('type'=> 'On previous row total')            
            );
	    	$this->db->insert_batch('def_pur_purchase_order_type', $data);
	    }


	    if(!$this->db->table_exists('def_pur_purchase_order_consider_tax_or_change'))
	    {
	        $this->dbforge->add_field(array(
	        'consider_tax_or_change_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'consider_tax_or_charge_for' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('consider_tax_or_change_id', true);
	        $this->dbforge->create_table('def_pur_purchase_order_consider_tax_or_change',true); 

	        $data = array(
            array('consider_tax_or_charge_for'=> 'Valuation and Total'),
            array('consider_tax_or_charge_for'=> 'Valuation'),
            array('consider_tax_or_charge_for'=> 'Total')
            );
	    	$this->db->insert_batch('def_pur_purchase_order_consider_tax_or_change', $data);
	    }



	    if(!$this->db->table_exists('def_pur_purchase_order_apply_addi_disc'))
	    {
	        $this->dbforge->add_field(array(
	        'apply_addi_disc_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'apply_additional_discount_on' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('apply_addi_disc_id', true);
	        $this->dbforge->create_table('def_pur_purchase_order_apply_addi_disc',true); 

	        $data = array(
            array('apply_additional_discount_on'=> 'Grand total'),
            array('apply_additional_discount_on'=> 'Net total')
            );
	    	$this->db->insert_batch('def_pur_purchase_order_apply_addi_disc', $data);
	    }

	    if(!$this->db->table_exists('def_pur_purchase_order_status'))
	    {
	        $this->dbforge->add_field(array(
	        'status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('status_id', true);
	        $this->dbforge->create_table('def_pur_purchase_order_status',true); 

	        $data = array(
            array('status'=> 'Draft'),
            array('status'=> 'Submitted'),
            array('status'=> 'Stopped'),
            array('status'=> 'Cancelled')
            );
	    	$this->db->insert_batch('def_pur_purchase_order_status', $data);
	    }

	    if(!$this->db->table_exists('def_pur_supplier_credit_limit'))
        {
            $this->dbforge->add_field(array(
            'supplier_credit_limit_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'credit_limit_based_on' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),

            ));
            $this->dbforge->add_key('supplier_credit_limit_id', true);
            $this->dbforge->create_table('def_pur_supplier_credit_limit',true);

            $data = array(
            array('credit_limit_based_on' => 'Fixed days'),
            array('credit_limit_based_on' => 'last day of the next month')
         );
         
         $this->db->insert_batch('def_pur_supplier_credit_limit', $data);
        }


        if(!$this->db->table_exists('def_con_contact_status'))
        {
            $this->dbforge->add_field(array(
            'contact_status_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'status' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),

            ));
            $this->dbforge->add_key('contact_status_id', true);
            $this->dbforge->create_table('def_con_contact_status',true);

            $data = array(
            array('status' => 'Open'),
            array('status' => 'Replied'),
            array('status' => 'Passive')
         );
         
         $this->db->insert_batch('def_con_contact_status', $data);
        }

        if(!$this->db->table_exists('def_con_address_type'))
        {
            $this->dbforge->add_field(array(
            'address_type_id' => array(
            'type' => 'int',
            'constraint' => 10,
            'unsigned' => true,
            'auto_increment' => true
            ),
            'type' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
            ),

            ));
            $this->dbforge->add_key('address_type_id', true);
            $this->dbforge->create_table('def_con_address_type',true);

            $data = array(
            array('type' => 'Billing'),
            array('type' => 'Shipping'),
            array('type' => 'Office'),
            array('type' => 'Personal'),
            array('type' => 'Plant'),
            array('type' => 'Postal'),
            array('type' => 'Shop'),
            array('type' => 'Others'),
            array('type' => 'Subsidiary'),
            array('type' => 'Warehouse'),
            array('type' => 'Current'),
            array('type' => 'Permanent'),
         );
         
         $this->db->insert_batch('def_con_address_type', $data);
        }


    	if(!$this->db->table_exists('def_sales_quo_quotation_to'))
	    {
	        $this->dbforge->add_field(array(
	        'quo_quotation_to_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'quotation_to' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('quo_quotation_to_id', true);
	        $this->dbforge->create_table('def_sales_quo_quotation_to',true);

	        $data = array(
            array('quotation_to' => 'Lead'),
            array('quotation_to' => 'Customer')
      
         );
         
         $this->db->insert_batch('def_sales_quo_quotation_to', $data); 
	    }

	    if(!$this->db->table_exists('def_sales_quotation_order_type'))
	    {
	        $this->dbforge->add_field(array(
	        'quotation_order_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'order_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('quotation_order_type_id', true);
	        $this->dbforge->create_table('def_sales_quotation_order_type',true);

	        $data = array(
            array('order_type' => 'Sales'),
            array('order_type' => 'Maintenanace')
      
         );
         
         $this->db->insert_batch('def_sales_quotation_order_type', $data); 
	    }

	    if(!$this->db->table_exists('def_sales_quotation_margin_type'))
	    {
	        $this->dbforge->add_field(array(
	        'quotation_margin_type_id' => array(
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
	        $this->dbforge->add_key('quotation_margin_type_id', true);
	        $this->dbforge->create_table('def_sales_quotation_margin_type',true);

	        $data = array(
            array('margin_type' => 'Percentage'),
            array('margin_type' => 'Amount')
      
         );
         
         $this->db->insert_batch('def_sales_quotation_margin_type', $data); 
	    }

	    if(!$this->db->table_exists('def_sales_quotation_type'))
	    {
	        $this->dbforge->add_field(array(
	        'quotation_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('quotation_type_id', true);
	        $this->dbforge->create_table('def_sales_quotation_type',true);

	        $data = array(
            array('type' => 'Actual'),
            array('type' => 'On net total'),
            array('type' => 'On previous row amount'),
            array('type' => 'On previous row total')
      
         );
         
         $this->db->insert_batch('def_sales_quotation_type', $data); 
	    }

	    if(!$this->db->table_exists('def_sales_quo_apply_addi_disc_on'))
	    {
	        $this->dbforge->add_field(array(
	        'quo_apply_addi_disc_on_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'apply_additional_discount_on' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('quo_apply_addi_disc_on_id', true);
	        $this->dbforge->create_table('def_sales_quo_apply_addi_disc_on',true);

	        $data = array(
            array('apply_additional_discount_on' => 'Grand total'),
            array('apply_additional_discount_on' => 'Net total')      
         );
         
         $this->db->insert_batch('def_sales_quo_apply_addi_disc_on', $data); 
	    }

	    if(!$this->db->table_exists('def_sales_quotation_status'))
	    {
	        $this->dbforge->add_field(array(
	        'quotation_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('quotation_status_id', true);
	        $this->dbforge->create_table('def_sales_quotation_status',true);

	        $data = array(
            array('status' => 'Draft'),
            array('status' => 'Submitted'),
            array('status' => 'Ordered'),
            array('status' => 'Lost'),
            array('status' => 'Cancelled'),
            array('status' => 'Open'),
            array('status' => 'Replied'),   
         );
         
         $this->db->insert_batch('def_sales_quotation_status', $data); 
	    }

	    if(!$this->db->table_exists('def_sales_sales_order_status'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_order_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('sales_order_status_id', true);
	        $this->dbforge->create_table('def_sales_sales_order_status',true);

	        $data = array(
            array('status' => 'Draft'),
            array('status' => 'To Deliver and Bill'),
            array('status' => 'To Bill'),
            array('status' => 'To Deliver'),
            array('status' => 'Completed'),
            array('status' => 'Cancelled'),
            array('status' => 'Closed'),   
         );
         
         $this->db->insert_batch('def_sales_sales_order_status', $data); 
	    }

	    if(!$this->db->table_exists('def_sales_customer_type'))
	    {
	        $this->dbforge->add_field(array(
	        'customer_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('customer_type_id', true);
	        $this->dbforge->create_table('def_sales_customer_type',true);

	        $data = array(
            array('type' => 'Company'),
            array('type' => 'Individual'),             
         );
         
         $this->db->insert_batch('def_sales_customer_type', $data); 
	    }

	    if(!$this->db->table_exists('def_sales_customer_credit_days_based_on'))
	    {
	        $this->dbforge->add_field(array(
	        'customer_credit_days_based_on_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'credit_days_based_on' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('customer_credit_days_based_on_id', true);
	        $this->dbforge->create_table('def_sales_customer_credit_days_based_on',true);

	        $data = array(
            array('credit_days_based_on' => 'Fixed days'),
            array('credit_days_based_on' => 'Last day of the next month'),             
         );
         
         $this->db->insert_batch('def_sales_customer_credit_days_based_on', $data); 
	    }

	    if(!$this->db->table_exists('def_sales_selling_set_customer_naming_by'))
	    {
	        $this->dbforge->add_field(array(
	        'selling_set_customer_naming_by_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'customer_naming_by' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('selling_set_customer_naming_by_id', true);
	        $this->dbforge->create_table('def_sales_selling_set_customer_naming_by',true);

	        $data = array(
            array('customer_naming_by' => 'Customer name'),
            array('customer_naming_by' => 'Naming series')
                       
         );
         
         $this->db->insert_batch('def_sales_selling_set_customer_naming_by', $data); 
	    }

	    if(!$this->db->table_exists('def_sales_selling_set_campaign_naming_by'))
	    {
	        $this->dbforge->add_field(array(
	        'selling_set_campaign_naming_by_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'campaign_naming_by' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('selling_set_campaign_naming_by_id', true);
	        $this->dbforge->create_table('def_sales_selling_set_campaign_naming_by',true);

	        $data = array(
            array('campaign_naming_by' => 'Campaign name'),
            array('campaign_naming_by' => 'Naming series')
                       
        	 );
         
         $this->db->insert_batch('def_sales_selling_set_campaign_naming_by', $data); 
	    }

	    if(!$this->db->table_exists('def_sales_sales_order_required'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_order_required_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'sales_order_required' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('sales_order_required_id', true);
	        $this->dbforge->create_table('def_sales_sales_order_required',true);

	         $data = array(
            array('sales_order_required'=> 'Yes'),
            array('sales_order_required'=> 'No ')
         	);
	    	$this->db->insert_batch('def_sales_sales_order_required', $data);   
	    }

	    if(!$this->db->table_exists('def_sales_sales_delivery_note_required'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_delivery_note_required_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'sales_delivery_note_required' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),
	        ));
	        $this->dbforge->add_key('sales_delivery_note_required_id', true);
	        $this->dbforge->create_table('def_sales_sales_delivery_note_required',true);

	         $data = array(
            array('sales_delivery_note_required'=> 'Yes'),
            array('sales_delivery_note_required'=> 'No ')
         	);
	    	$this->db->insert_batch('def_sales_sales_delivery_note_required', $data);   
	    }


	    if(!$this->db->table_exists('def_sales_sales_partner_partner_type'))
	    {
	        $this->dbforge->add_field(array(
	        'sales_partner_partner_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'partner_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('sales_partner_partner_type_id', true);
	        $this->dbforge->create_table('def_sales_sales_partner_partner_type',true);

	        $data = array(
            array('partner_type' => 'Channel partner'),
            array('partner_type' => 'distributors'),
            array('partner_type' => 'Dealers'),
            array('partner_type' => 'Agent'),           
         	array('partner_type' => 'Retailer'),
         	array('partner_type' => 'Implementation'),
         	array('partner_type' => 'partners'),
         	array('partner_type' => 're-sellers')
         );
         
         $this->db->insert_batch('def_sales_sales_partner_partner_type', $data); 
	    }


    	if(!$this->db->table_exists('def_pro_status'))
	    {
	        $this->dbforge->add_field(array(
	        'pro_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('pro_status_id', true);
	        $this->dbforge->create_table('def_pro_status',true);

	        $data = array(
            array('status' => 'Open '),
            array('status' => 'Completed'),
            array('status' => 'Cancelled')
         );
         
         $this->db->insert_batch('def_pro_status', $data); 
	    }

	    if(!$this->db->table_exists('def_pro_is_active'))
	    {
	        $this->dbforge->add_field(array(
	        'pro_is_active_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'is_active' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('pro_is_active_id', true);
	        $this->dbforge->create_table('def_pro_is_active',true);

	        $data = array(
            array('is_active' => 'Yes '),
            array('is_active' => 'No'),
         );
         
         $this->db->insert_batch('def_pro_is_active', $data); 
	    }
	    if(!$this->db->table_exists('def_pro_complete_mode'))
	    {
	        $this->dbforge->add_field(array(
	        'complete_mode_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'complete_mode' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('complete_mode_id', true);
	        $this->dbforge->create_table('def_pro_complete_mode',true);

	        $data = array(
            array('complete_mode' => 'Task progress'),
            array('complete_mode' => 'Task completed'),
            array('complete_mode' => 'Task weight')
         );
         
         $this->db->insert_batch('def_pro_complete_mode', $data); 
	    }
	    if(!$this->db->table_exists('def_pro_priority'))
	    {
	        $this->dbforge->add_field(array(
	        'priority_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'priority' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('priority_id', true);
	        $this->dbforge->create_table('def_pro_priority',true);

	        $data = array(
            array('priority' => 'Medium'),
            array('priority' => 'High'),
            array('priority' => 'Low')
         );
         
         $this->db->insert_batch('def_pro_priority', $data); 
	    }
	     if(!$this->db->table_exists('def_pro_status'))
	    {
	        $this->dbforge->add_field(array(
	        'status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('status_id', true);
	        $this->dbforge->create_table('def_pro_status',true);

	        $data = array(
            array('status' => 'Open'),
            array('status' => 'Closed'),
            array('status' => 'Pending review'),
            array('status' => 'Cancelled'),
            array('status' => 'Working')
         );
         
         $this->db->insert_batch('def_pro_status', $data); 
	    }
	    if(!$this->db->table_exists('def_pro_task_status'))
	    {
	        $this->dbforge->add_field(array(
	        'task_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('task_status_id', true);
	        $this->dbforge->create_table('def_pro_task_status',true);

	        $data = array(
            array('status' => 'Open'),
            array('status' => 'Closed'),
            array('status' => 'Pending review'),
            array('status' => 'Cancelled'),
            array('status' => 'Working'),
            array('status' => 'Overdue')
         );
         
         $this->db->insert_batch('def_pro_task_status', $data); 
	    }
	     if(!$this->db->table_exists('def_pro_time_sheet_status'))
	    {
	        $this->dbforge->add_field(array(
	        'time_sheet_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('time_sheet_status_id', true);
	        $this->dbforge->create_table('def_pro_time_sheet_status',true);

	        $data = array(
            array('status' => 'Draft'),
            array('status' => 'Submitted'),
            array('status' => 'Billed'),
            array('status' => 'Payslip'),
            array('status' => 'Completed'),
            array('status' => 'Cancelled')
         );
         
         $this->db->insert_batch('def_pro_time_sheet_status', $data); 
	    }


		if(!$this->db->table_exists('def_inv_stock_entry_purpose'))
	    {
	        $this->dbforge->add_field(array(
	        'stock_entry_purpose_id' => array(
	        'type' 	=> 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'purpose' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('stock_entry_purpose_id', true);
	        $this->dbforge->create_table('def_inv_stock_entry_purpose',true);

	        $data = array(
            array('purpose' => 'Material Issue'),
            array('purpose' => 'Material Receipt'),
            array('purpose' => 'Material Transfer'),
            array('purpose' => 'Material transfer for manufacture'),
            array('purpose' => 'Manufacture'),
            array('purpose' => 'Repack'),
            array('purpose' => 'Subcontract')
            );
         $this->db->insert_batch('def_inv_stock_entry_purpose', $data); 
	    }

		if(!$this->db->table_exists('def_inv_delivery_note_additional'))
	    {
	        $this->dbforge->add_field(array(
	        'delivery_note_additional_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'additional_discount_on' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('delivery_note_additional_id', true);
	        $this->dbforge->create_table('def_inv_delivery_note_additional',true);

	        $data = array(
	        array('additional_discount_on' => 'Grand total'),
	        array('additional_discount_on' => 'Net total'),
	        ); 
	        $this->db->insert_batch('def_inv_delivery_note_additional', $data);
	    }

	    if(!$this->db->table_exists('def_inv_delivery_note_status'))
	    {
	        $this->dbforge->add_field(array(
	        'delivery_note_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('delivery_note_status_id', true);
	        $this->dbforge->create_table('def_inv_delivery_note_status',true);

	        $data = array(
	        array('status' => 'Draft'),
	        array('status' => 'To bill'),
	        array('status' => 'Completed'),
	        array('status' => 'Cancelled'),
	        array('status' => 'Closed'),
	        ); 
	        $this->db->insert_batch('def_inv_delivery_note_status', $data); 
	    }

	    if(!$this->db->table_exists('def_inv_purchase_receipt_type'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_receipt_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('purchase_receipt_type_id', true);
	        $this->dbforge->create_table('def_inv_purchase_receipt_type',true);

	        $data = array(
	        array('type' => 'Actual'),
	        array('type' => 'On net total'),
	        array('type' => 'On previous row amount'),
	        array('type' => 'On previous row total'),
	        ); 
	        $this->db->insert_batch('def_inv_purchase_receipt_type', $data);
	    }

	    if(!$this->db->table_exists('def_inv_purchase_receipt_tax'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_receipt_tax_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'consider_tax' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('purchase_receipt_tax_id', true);
	        $this->dbforge->create_table('def_inv_purchase_receipt_tax',true);

	        $data = array(
	        array('consider_tax' => 'Valuation and taxes'),
	        array('consider_tax' => 'Taxes'),
	        array('consider_tax' => 'Valuation'),
	        ); 
	        $this->db->insert_batch('def_inv_purchase_receipt_tax', $data);
	    }

	    if(!$this->db->table_exists('def_inv_purchase_receipt_apply_discount'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_receipt_apply_discount_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'apply_discount_on' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('purchase_receipt_apply_discount_id', true);
	        $this->dbforge->create_table('def_inv_purchase_receipt_apply_discount',true);

	        $data = array(
	        array('apply_discount_on' => 'Grand total'),
	        array('apply_discount_on' => 'Net total')
	        ); 
	        $this->db->insert_batch('def_inv_purchase_receipt_apply_discount', $data);
	    }
	    if(!$this->db->table_exists('def_inv_pur_receipt_raw_material_supplied'))
	    {
	        $this->dbforge->add_field(array(
	        'pur_receipt_raw_material_supplied_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'raw_material_supplied' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('pur_receipt_raw_material_supplied_id', true);
	        $this->dbforge->create_table('def_inv_pur_receipt_raw_material_supplied',true);

	        $data = array(
	        array('raw_material_supplied' => 'Yes'),
	        array('raw_material_supplied' => 'No')
	        ); 
	        $this->db->insert_batch('def_inv_pur_receipt_raw_material_supplied', $data);
	    }

	    if(!$this->db->table_exists('def_inv_pur_receipt_status'))
	    {
	        $this->dbforge->add_field(array(
	        'pur_receipt_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('pur_receipt_status_id', true);
	        $this->dbforge->create_table('def_inv_pur_receipt_status',true);

	        $data = array(
	        array('status' => 'Draft'),
	        array('status' => 'To bill'),
	        array('status' => 'Completed'),
	        array('status' => 'Cancelled'),
	        array('status' => 'Closed')
	        ); 
	        $this->db->insert_batch('def_inv_pur_receipt_status', $data);
	    }

	    if(!$this->db->table_exists('def_inv_purchase_receipt_add_deduct'))
	    {
	        $this->dbforge->add_field(array(
	        'purchase_receipt_add_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'add_deduct' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('purchase_receipt_add_id', true);
	        $this->dbforge->create_table('def_inv_purchase_receipt_add_deduct',true);
	        $data = array(
	        array('add_deduct' => 'Add'),
	        array('add_deduct' => 'Deduct'),
	        );
	        $this->db->insert_batch('def_inv_purchase_receipt_add_deduct', $data);
	    }

	    if(!$this->db->table_exists('def_inv_material_request_type'))
	    {
	    	$this->dbforge->add_field(array(
	        'material_request_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('material_request_type_id', true);
	        $this->dbforge->create_table('def_inv_material_request_type',true);
	        $data = array(
	        array('type' => 'Purchase'),
	        array('type' => 'Manufacture'),
	        array('type' => 'Material issue'),
	        array('type' => 'Material Transfer'),
	        );
	        $this->db->insert_batch('def_inv_material_request_type', $data);
	    }

	    if(!$this->db->table_exists('def_inv_material_request_status'))
	    {
	    	$this->dbforge->add_field(array(
	        'material_request_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('material_request_status_id', true);
	        $this->dbforge->create_table('def_inv_material_request_status',true);
	        $data = array(
	        array('status' => 'Draft'),
	        array('status' => 'To bill'),
	        array('status' => 'Completed'),
	        array('status' => 'WSCancelled'),
	        array('status' => 'Closed'),
	        );
	        $this->db->insert_batch('def_inv_material_request_status', $data);
	    }

	    if(!$this->db->table_exists('def_inv_item_pricing_item_nature'))
	    {
	    	$this->dbforge->add_field(array(
	        'item_pricing_item_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'item_nature' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('item_pricing_item_id', true);
	        $this->dbforge->create_table('def_inv_item_pricing_item_nature',true);
	        $data = array(
	        array('item_nature' => 'Manufactured'),
	        array('item_nature' => 'Brought out'),
	        array('item_nature' => 'Both'),
	        );
	        $this->db->insert_batch('def_inv_item_pricing_item_nature', $data);
	    }

	    if(!$this->db->table_exists('def_inv_item_pricing_variant_based'))
	    {
	    	$this->dbforge->add_field(array(
	        'item_pricing_variant_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'variant_based_on' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('item_pricing_variant_id', true);
	        $this->dbforge->create_table('def_inv_item_pricing_variant_based',true);
	        $data = array(
	        array('variant_based_on' => 'Item Attributes'),
	        array('variant_based_on' => 'Manufactures'),
	        );
	        $this->db->insert_batch('def_inv_item_pricing_variant_based', $data);
	    }

	    if(!$this->db->table_exists('def_inv_item_pricing_default_material'))
	    {
	    	$this->dbforge->add_field(array(
	        'item_pricing_default_material_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'default_material_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('item_pricing_default_material_id', true);
	        $this->dbforge->create_table('def_inv_item_pricing_default_material',true);
	        $data = array(
	        array('default_material_type' => 'Purchase'),
	        array('default_material_type' => 'Material Transfer'),
	        array('default_material_type' => 'Material Issue'),
	        array('default_material_type' => 'Manufacture'),
	        );
	        $this->db->insert_batch('def_inv_item_pricing_default_material', $data);
	    }

	    if(!$this->db->table_exists('def_inv_item_pricing_valuation_method'))
	    {
	    	$this->dbforge->add_field(array(
	        'item_pricing_valuation_method_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'valuation_method' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('item_pricing_valuation_method_id', true);
	        $this->dbforge->create_table('def_inv_item_pricing_valuation_method',true);
	        $data = array(
	        array('valuation_method' => 'FIFO'),
	        array('valuation_method' => 'LIFO'),
	        array('valuation_method' => 'Weighted Average'),
	        );
	        $this->db->insert_batch('def_inv_item_pricing_valuation_method', $data);
	    }

	    if(!$this->db->table_exists('def_inv_item_pricing_material_request'))
	    {
	    	$this->dbforge->add_field(array(
	        'item_pricing_material_request_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'material_request_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('item_pricing_material_request_id', true);
	        $this->dbforge->create_table('def_inv_item_pricing_material_request',true);
	        $data = array(
	        array('material_request_type' => 'Purchase'),
	        array('material_request_type' => 'Material Transfer'),
	        array('material_request_type' => 'Material Issue'),
	        array('material_request_type' => 'Manufacture'),
	        );
	        $this->db->insert_batch('def_inv_item_pricing_material_request', $data);
	    }

	    if(!$this->db->table_exists('def_inv_item_stock_verification'))
	    {
	    	$this->dbforge->add_field(array(
	        'item_stock_verification_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'stock_verification' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('item_stock_verification_id', true);
	        $this->dbforge->create_table('def_inv_item_stock_verification',true);
	        $data = array(
	        array('stock_verification' => 'Perpetual inventory'),
	        array('stock_verification' => 'Verification by Classification'),
	        array('stock_verification' => 'Verification by Group'),
	        );
	        $this->db->insert_batch('def_inv_item_stock_verification', $data);
	    }




	    if(!$this->db->table_exists('def_inv_pricing_rule_apply'))
	    {
	    	$this->dbforge->add_field(array(
	        'pricing_rule_apply_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'apply_on' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('pricing_rule_apply_id', true);
	        $this->dbforge->create_table('def_inv_pricing_rule_apply',true);
	        $data = array(
	        array('apply_on' => 'Item code'),
	        array('apply_on' => 'Item group'),
	        array('apply_on' => 'Brand'),
	        );
	        $this->db->insert_batch('def_inv_pricing_rule_apply', $data);
	    }

	    if(!$this->db->table_exists('def_inv_pricing_rule_priority'))
	    {
	    	$this->dbforge->add_field(array(
	        'pricing_rule_priority_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'priority' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('pricing_rule_priority_id', true);
	        $this->dbforge->create_table('def_inv_pricing_rule_priority',true);
	        $data = array(
	        array('priority' => '1'),
	        array('priority' => '2'),
	        array('priority' => '3'),
	        array('priority' => '4'),
	        array('priority' => '5'),
	        array('priority' => '6'),
	        array('priority' => '7'),
	        array('priority' => '8'),
	        array('priority' => '9'),
	        array('priority' => '10'),
	        array('priority' => '11'),
	        array('priority' => '12'),
	        array('priority' => '13'),
	        array('priority' => '14'),
	        array('priority' => '15'),
	        array('priority' => '16'),
	        array('priority' => '17'),
	        array('priority' => '18'),
	        array('priority' => '19'),
	        array('priority' => '20'),
	        );
	        $this->db->insert_batch('def_inv_pricing_rule_priority', $data);
	    }

	    if(!$this->db->table_exists('def_inv_pricing_rule_applicable'))
	    {
	    	$this->dbforge->add_field(array(
	        'pricing_rule_applicable_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'applicable_for' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('pricing_rule_applicable_id', true);
	        $this->dbforge->create_table('def_inv_pricing_rule_applicable',true);
	        $data = array(
	        array('applicable_for' => 'Customer'),
	        array('applicable_for' => 'Customer Group'),
	        array('applicable_for' => 'Territory'),
	        array('applicable_for' => 'Sales Partner'),
	        array('applicable_for' => 'Campaign'),
	        );
	        $this->db->insert_batch('def_inv_pricing_rule_applicable', $data);
	    }

	    if(!$this->db->table_exists('def_inv_pricing_rule_price_discount'))
	    {
	    	$this->dbforge->add_field(array(
	        'pricing_rule_price_discount_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'price_discount' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('pricing_rule_price_discount_id', true);
	        $this->dbforge->create_table('def_inv_pricing_rule_price_discount',true);
	        $data = array(
	        array('price_discount' => 'Price'),
	        array('price_discount' => 'Discount Percentage'),
	        );
	        $this->db->insert_batch('def_inv_pricing_rule_price_discount', $data);
	    }

	     if(!$this->db->table_exists('def_inv_pricing_rule_margin_type'))
	    {
	    	$this->dbforge->add_field(array(
	        'pricing_rule_margin_type_id' => array(
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
	        $this->dbforge->add_key('pricing_rule_margin_type_id', true);
	        $this->dbforge->create_table('def_inv_pricing_rule_margin_type',true);
	        $data = array(
	        array('margin_type' => 'Percentage'),
	        array('margin_type' => 'Amount'),
	        );
	        $this->db->insert_batch('def_inv_pricing_rule_margin_type', $data);
	    }

	    if(!$this->db->table_exists('def_inv_serial_no_maintenance_status'))
	    {
	    	$this->dbforge->add_field(array(
	        'serial_no_maintenance_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'maintenance_status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('serial_no_maintenance_status_id', true);
	        $this->dbforge->create_table('def_inv_serial_no_maintenance_status',true);
	        $data = array(
	        array('maintenance_status' => 'Under warranty'),
	        array('maintenance_status' => 'Out of warranty'),
	        array('maintenance_status' => 'Under AMC'),
	        array('maintenance_status' => 'Out of AMC'),
	        );
	        $this->db->insert_batch('def_inv_serial_no_maintenance_status', $data);
	    }

	    if(!$this->db->table_exists('def_inv_installation_note_status'))
	    {
	    	$this->dbforge->add_field(array(
	        'installation_note_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('installation_note_status_id', true);
	        $this->dbforge->create_table('def_inv_installation_note_status',true);
	        $data = array(
	        array('status' => 'Draft'),
	        array('status' => 'Submitted'),
	        array('status' => 'Cancelled'),
	        );
	        $this->db->insert_batch('def_inv_installation_note_status', $data);
	    }

	    if(!$this->db->table_exists('def_inv_quality_inspection_type'))
	    {
	    	$this->dbforge->add_field(array(
	        'quality_inspection_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'inspection_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('quality_inspection_type_id', true);
	        $this->dbforge->create_table('def_inv_quality_inspection_type',true);
	        $data = array(
	        array('inspection_type' => 'Incoming'),
	        array('inspection_type' => 'Outgoing'),
	        array('inspection_type' => 'In process'),
	        );
	        $this->db->insert_batch('def_inv_quality_inspection_type', $data);
	    }

	    if(!$this->db->table_exists('def_inv_quality_inspection_reference'))
	    {
	    	$this->dbforge->add_field(array(
	        'quality_inspection_reference_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'reference_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('quality_inspection_reference_id', true);
	        $this->dbforge->create_table('def_inv_quality_inspection_reference',true);
	        $data = array(
	        array('reference_type' => 'Purchase receipt'),
	        array('reference_type' => 'Purchase Invoice'),
	        array('reference_type' => 'Delivery Note'),
	        array('reference_type' => 'Sales Invoice'),
	        );
	        $this->db->insert_batch('def_inv_quality_inspection_reference', $data);
	    }

	    if(!$this->db->table_exists('def_inv_quality_inspection_reading_status'))
	    {
	    	$this->dbforge->add_field(array(
	        'quality_inspection_reading_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('quality_inspection_reading_status_id', true);
	        $this->dbforge->create_table('def_inv_quality_inspection_reading_status',true);
	        $data = array(
	        array('status' => 'Accepted'),
	        array('status' => 'Rejected'),
	        );
	        $this->db->insert_batch('def_inv_quality_inspection_reading_status', $data);
	    }

	    if(!$this->db->table_exists('def_inv_landed_cost_voucher_receipt_document'))
	    {
	    	$this->dbforge->add_field(array(
	        'landed_cost_voucher_receipt_document_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'receipt_document_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('landed_cost_voucher_receipt_document_id', true);
	        $this->dbforge->create_table('def_inv_landed_cost_voucher_receipt_document',true);
	        $data = array(
	        array('receipt_document_type' => 'Purchase invoice'),
	        array('receipt_document_type' => 'Purchase Receipt'),
	        );
	        $this->db->insert_batch('def_inv_landed_cost_voucher_receipt_document', $data);
	    }

	    if(!$this->db->table_exists('def_inv_landed_cost_voucher_distribute_charge'))
	    {
	    	$this->dbforge->add_field(array(
	        'landed_cost_voucher_distribute_charge_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'distribute_charge_based_on' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('landed_cost_voucher_distribute_charge_id', true);
	        $this->dbforge->create_table('def_inv_landed_cost_voucher_distribute_charge',true);
	        $data = array(
	        array('distribute_charge_based_on' => 'Quantity'),
	        array('distribute_charge_based_on' => 'Amount'),
	        );
	        $this->db->insert_batch('def_inv_landed_cost_voucher_distribute_charge', $data);
	    }

	    if(!$this->db->table_exists('def_inv_stock_category_stock_category'))
	    {
	    	$this->dbforge->add_field(array(
	        'stock_category_stock_category_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'stock_category' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('stock_category_stock_category_id', true);
	        $this->dbforge->create_table('def_inv_stock_category_stock_category',true);
	        $data = array(
	        array('stock_category' => 'Value Based'),
	        array('stock_category' => 'Moving Base'),
	        );
	        $this->db->insert_batch('def_inv_stock_category_stock_category', $data);
	    }

	    if(!$this->db->table_exists('def_inv_stock_setting_item_naming'))
	    {
	    	$this->dbforge->add_field(array(
	        'stock_setting_item_naming_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'item_naming_by' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('stock_setting_item_naming_id', true);
	        $this->dbforge->create_table('def_inv_stock_setting_item_naming',true);
	        $data = array(
	        array('item_naming_by' => 'Item code'),
	        array('item_naming_by' => 'Naming series'),
	        );
	        $this->db->insert_batch('def_inv_stock_setting_item_naming', $data);
	    }

	    if(!$this->db->table_exists('def_inv_stock_setting_default_valuation'))
	    {
	    	$this->dbforge->add_field(array(
	        'stock_setting_default_valuation_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'default_valuation_method' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('stock_setting_default_valuation_id', true);
	        $this->dbforge->create_table('def_inv_stock_setting_default_valuation',true);
	        $data = array(
	        array('default_valuation_method' => 'FIFO'),
	        array('default_valuation_method' => 'Moving Average'),
	        array('default_valuation_method' => 'LIFO'),
	        array('default_valuation_method' => 'Weighted Average'),
	        );
	        $this->db->insert_batch('def_inv_stock_setting_default_valuation', $data);
	    }


	   

	    if(!$this->db->table_exists('def_man_bom_rate_of_material'))
	    {
	    	$this->dbforge->add_field(array(
	    	'bom_rate_of_material_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'rate_of_material_based_on'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('bom_rate_of_material_id', true);
	        $this->dbforge->create_table('def_man_bom_rate_of_material',true);
	        $data = array(
	        array('rate_of_material_based_on' => 'Valuation Rate'),
	        array('rate_of_material_based_on' => 'Last Purchase '),
	        array('rate_of_material_based_on' => 'Rate'),
	        array('rate_of_material_based_on' => 'Price list'),
	        );
	        $this->db->insert_batch('def_man_bom_rate_of_material', $data);
	    }

	    if(!$this->db->table_exists('def_man_production_order_status'))
	    {
	    	$this->dbforge->add_field(array(
	    	'man_production_order_status_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('man_production_order_status_id', true);
	        $this->dbforge->create_table('def_man_production_order_status',true);
	        $data = array(
	        array('status' => 'Draft'),
	        array('status' => 'Submitted'),
	        array('status' => 'Not Started'),
	        array('status' => 'In Process'),
	        array('status' => 'Completed'),
	        array('status' => 'Stopped'),
	        array('status' => 'Cancelled'),
	        );
	        $this->db->insert_batch('def_man_production_order_status', $data);
	    }


	    if(!$this->db->table_exists('def_man_timesheet_status'))
	    {
	    	$this->dbforge->add_field(array(
	    	'status_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('status_id', true);
	        $this->dbforge->create_table('def_man_timesheet_status',true);
	        $data = array(
	        array('status' => 'Submitted'),
	        array('status' => 'Billed'),
	        array('status' => 'Payslip'),
	        array('status' => 'Completed'),
	        array('status' => 'Cancelled'),
	        );
	        $this->db->insert_batch('def_man_timesheet_status', $data);
	    }

	    if(!$this->db->table_exists('def_man_manufacturing_settings_back_flush'))
	    {
	    	$this->dbforge->add_field(array(
	    	'back_flush_raw_material_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'back_flush_raw_material'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('back_flush_raw_material_id', true);
	        $this->dbforge->create_table('def_man_manufacturing_settings_back_flush',true);
	        $data = array(
	        array('back_flush_raw_material' => 'BOM'),
	        array('back_flush_raw_material' => 'Material'),
	        array('back_flush_raw_material' => 'Transferred to Manufacture'),
	        );
	        $this->db->insert_batch('def_man_manufacturing_settings_back_flush', $data);
	    }

	    if(!$this->db->table_exists('def_man_production_planning_get_items_from'))
	    {
	    	$this->dbforge->add_field(array(
	    	'production_planning_get_items_from_id'=>array(
	    	'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'get_items_from'=>array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('production_planning_get_items_from_id', true);
	        $this->dbforge->create_table('def_man_production_planning_get_items_from',true);
	        $data = array(
	        array('get_items_from' => 'Sales Order'),
	        array('get_items_from' => 'Material Request'),
	        );
	        $this->db->insert_batch('def_man_production_planning_get_items_from', $data);
	    }

	    if(!$this->db->table_exists('def_acc_mode_of_payment_type'))
	    {
	        $this->dbforge->add_field(array(
	        'mode_of_payment_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('mode_of_payment_type_id', true);
	        $this->dbforge->create_table('def_acc_mode_of_payment_type',true);

	        $data = array(
            array('type' => 'Cash'),
            array('type' => 'Bank'),
            array('type' => 'General')
         );
         
         $this->db->insert_batch('def_acc_mode_of_payment_type', $data); 
	    }

	    if(!$this->db->table_exists('def_acc_account_root_type'))
	    {
	        $this->dbforge->add_field(array(
	        'account_root_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'root_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('account_root_type_id', true);
	        $this->dbforge->create_table('def_acc_account_root_type',true);

	        $data = array(
            array('root_type' => 'Asset'),  
			array('root_type' => 'Liability'),
            array('root_type' => 'Income'),
            array('root_type' => 'Expense'),
            array('root_type' => 'Equity')
         );
         
         $this->db->insert_batch('def_acc_account_root_type', $data); 
	    }

	    if(!$this->db->table_exists('def_acc_account_report_type'))
	    {
	        $this->dbforge->add_field(array(
	        'account_report_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'report_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('account_report_type_id', true);
	        $this->dbforge->create_table('def_acc_account_report_type',true);

	        $data = array(
            array('report_type' => 'Balance Sheet'),  
			array('report_type' => 'Profit and Loss'),            
         );
         
         $this->db->insert_batch('def_acc_account_report_type', $data); 
	    }

	    if(!$this->db->table_exists('def_acc_account_account_type'))
	    {
	        $this->dbforge->add_field(array(
	        'account_account_type_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'account_type' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('account_account_type_id', true);
	        $this->dbforge->create_table('def_acc_account_account_type',true);

	        $data = array(
            array('account_type' => 'Accumulated Depreciation'),  
			array('account_type' => 'Bank'),
			array('account_type' => 'Cash'),  
			array('account_type' => 'Chargeable'), 
			array('account_type' => 'Cost of Goods Sold'),  
			array('account_type' => 'Depreciation'),
			array('account_type' => 'Equity'),  
			array('account_type' => 'Expense Account'), 
			array('account_type' => 'Expenses Included In Valuation'),   
			array('account_type' => 'Fixed Asset'),  
			array('account_type' => 'Income Account'),
			array('account_type' => 'Payable'),  
			array('account_type' => 'Receivable'),
			array('account_type' => 'Round Off'),  
			array('account_type' => 'Stock'),			
			array('account_type' => 'Stock Adjustment'), 			
			array('account_type' => 'Stock Received But Not Billed'), 			
			array('account_type' => 'Tax'), 			
			array('account_type' => 'Temporary'),         
         );
         
         $this->db->insert_batch('def_acc_account_account_type', $data); 
	    }

	    if(!$this->db->table_exists('def_acc_account_freeze_account'))
	    {
	        $this->dbforge->add_field(array(
	        'account_freeze_account_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'freeze_account' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('account_freeze_account_id', true);
	        $this->dbforge->create_table('def_acc_account_freeze_account',true);

	        $data = array(
            array('freeze_account' => 'No'),  
			array('freeze_account' => 'Yes'),            
         );
         
         $this->db->insert_batch('def_acc_account_freeze_account', $data); 
	    }

	    if(!$this->db->table_exists('def_acc_account_balance_must_be'))
	    {
	        $this->dbforge->add_field(array(
	        'account_balance_must_be_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'balance_must_be' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('account_balance_must_be_id', true);
	        $this->dbforge->create_table('def_acc_account_balance_must_be',true);

	        $data = array(
            array('balance_must_be' => 'Debit'),  
			array('balance_must_be' => 'Credit'),            
         );
         
         $this->db->insert_batch('def_acc_account_balance_must_be', $data); 
	    }

	    if(!$this->db->table_exists('def_acc_asset_status'))
	    {
	        $this->dbforge->add_field(array(
	        'asset_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('asset_status_id', true);
	        $this->dbforge->create_table('def_acc_asset_status',true);

	        $data = array(
            array('status' => 'Draft'),  
			array('status' => 'Submitted'),
			array('status' => 'Partially Depreciated'), 
			array('status' => 'Fully Depreciated'),
			array('status' => 'Sold'),
			array('status' => 'Scrapped'),           
         );
         
         $this->db->insert_batch('def_acc_asset_status', $data); 
	    }

	    if(!$this->db->table_exists('def_man_timesheet_status'))
	    {
	        $this->dbforge->add_field(array(
	        'man_timesheet_status_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'status' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('man_timesheet_status_id', true);
	        $this->dbforge->create_table('def_man_timesheet_status',true);

	        $data = array(
            array('status' => 'Submitted'),  
			array('status' => 'Billed'),
			array('status' => 'Payslip'), 
			array('status' => 'Completed'),
			array('status' => 'Cancelled'),           
         );
         
         $this->db->insert_batch('def_man_timesheet_status', $data); 
	    }

	    if(!$this->db->table_exists('def_set_company_chart_of_accounts'))
	    {
	        $this->dbforge->add_field(array(
	        'company_chart_of_accounts_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'chart_of_accounts' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('company_chart_of_accounts_id', true);
	        $this->dbforge->create_table('def_set_company_chart_of_accounts',true);

	        $data = array(
            array('chart_of_accounts' => 'Standard Template'),  
			array('chart_of_accounts' => 'Existing Company')          
         );
         
         $this->db->insert_batch('def_set_company_chart_of_accounts', $data); 
	    }

	    if(!$this->db->table_exists('def_set_company_domain'))
	    {
	        $this->dbforge->add_field(array(
	        'company_domain_id' => array(
	        'type' => 'int',
	        'constraint' => 10,
	        'unsigned' => true,
	        'auto_increment' => true
	        ),
	        'domain' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	        ),

	        ));
	        $this->dbforge->add_key('company_domain_id', true);
	        $this->dbforge->create_table('def_set_company_domain',true);

	        $data = array(
            array('domain' => 'Distribution'),  
			array('domain' => 'Manufacturing'),  
			array('domain' => 'Retail'),  
			array('domain' => 'Services'),  
			array('domain' => 'Education'),  
			array('domain' => 'Others'),          
         );
         
         $this->db->insert_batch('def_set_company_domain', $data); 
	    }
	}

	public function down()
    {
		$this->dbforge->drop_table('def_hr_emp_loan_appliction_status', true);
		$this->dbforge->drop_table('def_hr_emp_loan_repayment_method', true);
		$this->dbforge->drop_table('def_hr_emp_loan_status', true);
		$this->dbforge->drop_table('def_hr_vehicle_fuel_type', true);
		$this->dbforge->drop_table('def_hr_training_eve_event_status', true);
		$this->dbforge->drop_table('def_hr_training_event_type', true);
		$this->dbforge->drop_table('def_hr_training_event_status', true);
		$this->dbforge->drop_table('def_hr_holiday_list_weekly_off', true);
		$this->dbforge->drop_table('def_hr_job_opening_status', true);
		$this->dbforge->drop_table('def_hr_job_applicant_status', true);
		$this->dbforge->drop_table('def_hr_salary_component_type', true);
		$this->dbforge->drop_table('def_hr_vehicle_log_service_item', true);
		$this->dbforge->drop_table('def_hr_vehicle_log_service_type', true);
		$this->dbforge->drop_table('def_hr_vehicle_log_frquency', true);
		$this->dbforge->drop_table('def_hr_expense_claim_status', true);
		$this->dbforge->drop_table('def_hr_hr_settings_employee_name', true);
		$this->dbforge->drop_table('def_gender', true);
		$this->dbforge->drop_table('def_hr_employee_status', true);
		$this->dbforge->drop_table('def_hr_employee_salary_mode', true);
		$this->dbforge->drop_table('def_hr_employee_salary_slip_status',true);
		$this->dbforge->drop_table('def_hr_employee_preferred_contact_email', true);
		$this->dbforge->drop_table('def_hr_employee_permanent_address', true);
		$this->dbforge->drop_table('def_hr_employee_current_address', true);
		$this->dbforge->drop_table('def_marital_status', true);
		$this->dbforge->drop_table('def_blood_group', true);
		$this->dbforge->drop_table('def_hr_employee_level', true);
		$this->dbforge->drop_table('def_hr_employee_leave_en_cashed', true);
		$this->dbforge->drop_table('def_hr_employee_attendance', true);
		$this->dbforge->drop_table('def_hr_leave_application_status', true);
		$this->dbforge->drop_table('def_hr_offer_letter_status', true);
		$this->dbforge->drop_table('def_hr_payroll_frquency', true);
		$this->dbforge->drop_table('def_hr_salary_structure_is_active', true);
		$this->dbforge->drop_table('def_hr_appraisal_status', true);
		$this->dbforge->drop_table('def_hr_expense_claim_approval_status',true);
		$this->dbforge->drop_table('def_crm_lead_status', true);
		$this->dbforge->drop_table('def_crm_lead_lead_type', true);
		$this->dbforge->drop_table('def_crm_lead_market_segment', true);
		$this->dbforge->drop_table('def_crm_lead_request_type', true);
		$this->dbforge->drop_table('def_crm_opp_oppurtunity_from', true);
		$this->dbforge->drop_table('def_crm_opp_oppurtunity_type', true);
		$this->dbforge->drop_table('def_crm_oppurtunity_status', true);
		$this->dbforge->drop_table('def_crm_customer_type', true);
		$this->dbforge->drop_table('def_crm_customer_credit_days_based', true);
		$this->dbforge->drop_table('def_crm_sms_center_send_to', true);
		$this->dbforge->drop_table('def_hr_salary_slip_status', true);
		$this->dbforge->drop_table('def_pur_buying_supplier_naming', true);
		$this->dbforge->drop_table('def_pur_buying_pur_order_req', true);
		$this->dbforge->drop_table('def_pur_buying_pur_receipt_req', true);
		$this->dbforge->drop_table('def_pur_purchase_taxes_type', true);
		$this->dbforge->drop_table('def_pur_purchase_taxes_add_or_dec', true);
		$this->dbforge->drop_table('def_pur_sup_scor_evaluation_period', true);
		$this->dbforge->drop_table('def_pur_sup_scor_color', true);
		$this->dbforge->drop_table('def_pur_material_req_type', true);
		$this->dbforge->drop_table('def_pur_purchasing_status', true);
		$this->dbforge->drop_table('def_pur_req_for_quo_status', true);
		$this->dbforge->drop_table('def_pur_supplier_quo', true);
		$this->dbforge->drop_table('def_pur_supplier_quo_consider_tax_or_change', true);
		$this->dbforge->drop_table('def_pur_supplier_quo_add_or_deduct', true);
		$this->dbforge->drop_table('def_pur_supplier_quo_apply_addi_disc', true);
		$this->dbforge->drop_table('def_pur_supplier_quo_status', true);
		$this->dbforge->drop_table('def_pur_purchase_sup_quo_order', true);
		$this->dbforge->drop_table('def_pur_purchase_order_type', true);
		$this->dbforge->drop_table('def_pur_purchase_order_consider_tax_or_change', true);
		$this->dbforge->drop_table('def_pur_purchase_order_apply_addi_disc', true);
		$this->dbforge->drop_table('def_pur_purchase_order_status', true);
		$this->dbforge->drop_table('def_pur_supplier_credit_limit', true);
		$this->dbforge->drop_table('def_con_contact_status', true);
		$this->dbforge->drop_table('def_con_address_type', true);
		$this->dbforge->drop_table('def_sales_quo_quotation_to', true);
		$this->dbforge->drop_table('def_sales_quotation_order_type', true);
		$this->dbforge->drop_table('def_sales_quotation_margin_type', true);
		$this->dbforge->drop_table('def_sales_quotation_type', true);
		$this->dbforge->drop_table('def_sales_quo_apply_addi_disc_on', true);
		$this->dbforge->drop_table('def_sales_quotation_status', true);
		$this->dbforge->drop_table('def_sales_sales_order_status', true);
		$this->dbforge->drop_table('def_sales_customer_type', true);
		$this->dbforge->drop_table('def_sales_customer_credit_days_based_on', true);
		$this->dbforge->drop_table('def_sales_selling_set_customer_naming_by', true);
		$this->dbforge->drop_table('def_sales_selling_set_campaign_naming_by', true);
		$this->dbforge->drop_table('def_sales_sales_order_required', true);
		$this->dbforge->drop_table('def_sales_sales_delivery_note_required', true);
		$this->dbforge->drop_table('def_sales_sales_partner_partner_type', true);
		$this->dbforge->drop_table('def_pro_status', true);
		$this->dbforge->drop_table('def_pro_complete_mode', true);
		$this->dbforge->drop_table('def_pro_priority', true);
		$this->dbforge->drop_table('def_pro_status', true);
		$this->dbforge->drop_table('def_pro_task_status', true);
		$this->dbforge->drop_table('def_pro_time_sheet_status', true);
		$this->dbforge->drop_table('def_pro_is_active', true);
		$this->dbforge->drop_table('def_inv_stock_entry_purpose', true);
		$this->dbforge->drop_table('def_inv_delivery_note_additional', true);
		$this->dbforge->drop_table('def_inv_delivery_note_status', true);
		$this->dbforge->drop_table('def_inv_purchase_receipt_type', true);
		$this->dbforge->drop_table('def_inv_purchase_receipt_tax', true);
		$this->dbforge->drop_table('def_inv_purchase_receipt_apply_discount',true);
		$this->dbforge->drop_table('def_inv_pur_receipt_raw_material_supplied',true);
		$this->dbforge->drop_table('def_inv_pur_receipt_status',true);
		$this->dbforge->drop_table('def_inv_purchase_receipt_add_deduct', true);
		$this->dbforge->drop_table('def_inv_material_request_type', true);
		$this->dbforge->drop_table('def_inv_material_request_status', true);
		$this->dbforge->drop_table('def_inv_item_pricing_item_nature', true);
		$this->dbforge->drop_table('def_inv_item_pricing_variant_based', true);
		$this->dbforge->drop_table('def_inv_item_pricing_default_material', true);
		$this->dbforge->drop_table('def_inv_item_pricing_valuation_method', true);
		$this->dbforge->drop_table('def_inv_item_pricing_material_request', true);
		$this->dbforge->drop_table('def_inv_item_stock_verification',true);
		$this->dbforge->drop_table('def_inv_pricing_rule_apply', true);
		$this->dbforge->drop_table('def_inv_pricing_rule_priority', true);
		$this->dbforge->drop_table('def_inv_pricing_rule_applicable', true);
		$this->dbforge->drop_table('def_inv_pricing_rule_price_discount', true);
		$this->dbforge->drop_table('def_inv_pricing_rule_margin_type',true);
		$this->dbforge->drop_table('def_inv_serial_no_maintenance_status', true);
		$this->dbforge->drop_table('def_inv_installation_note_status', true);
		$this->dbforge->drop_table('def_inv_quality_inspection_type', true);
		$this->dbforge->drop_table('def_inv_quality_inspection_reference', true);
		$this->dbforge->drop_table('def_inv_quality_inspection_reading_status', true);
		$this->dbforge->drop_table('def_inv_landed_cost_voucher_receipt_document', true);
		$this->dbforge->drop_table('def_inv_landed_cost_voucher_distribute_charge', true);
		$this->dbforge->drop_table('def_inv_stock_category_stock_category', true);
		$this->dbforge->drop_table('def_inv_stock_setting_item_naming', true);
		$this->dbforge->drop_table('def_inv_stock_setting_default_valuation', true);
		$this->dbforge->drop_table('def_man_bom_rate_of_material', true);
		$this->dbforge->drop_table('def_man_production_order_status',true);
		$this->dbforge->drop_table('def_man_timesheet_status', true);
		$this->dbforge->drop_table('def_man_manufacturing_settings_back_flush', true);
		$this->dbforge->drop_table('def_man_production_planning_get_items_from',true);
		$this->dbforge->drop_table('def_acc_mode_of_payment_type', true);
		$this->dbforge->drop_table('def_acc_account_root_type', true);
		$this->dbforge->drop_table('def_acc_account_report_type', true);
		$this->dbforge->drop_table('def_acc_account_account_type', true);
		$this->dbforge->drop_table('def_acc_account_freeze_account', true);
		$this->dbforge->drop_table('def_acc_account_balance_must_be', true);
		$this->dbforge->drop_table('def_acc_asset_status',true);
		$this->dbforge->drop_table('def_man_timesheet_status',true);
		$this->dbforge->drop_table('def_set_company_chart_of_accounts',true);
		$this->dbforge->drop_table('def_set_company_domain',true);		
	}
}