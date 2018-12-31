<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_hrmodule extends CI_Migration 
{

      public function up()
      {   
            if(!$this->db->table_exists('hr_employee_loan'))
            {
                  $this->dbforge->add_field(array(
                  'employee_loan_id'=> array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
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
                  'employee_loan_application_id'=>array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'loan_type_id'=>array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'posting_date' =>array(
                  'type' => 'date',
                  ),
                  'company_id' =>array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'emp_loan_status_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'repay_from_salary' =>array(
                  'type' => 'tinyint',
                  'constraint' => 4,
                  'null' => false
                  ),
                  'loan_amount' =>array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  ),
                  'rate_of_interest' =>array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  ),
                  'disbursement_date' =>array(
                  'type' => 'date',
                  ),
                  'emp_loan_repayment_method_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'repayment_periods' =>array(
                  'type' => 'INT',
                  'constraint' => 10,
                  ),
                  'repayment_amount'=>array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  ),                        
                  'mode_of_payment_type_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'payment_account' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  ), 
                  'employee_loan_account' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  ), 
                  'interest_income_account' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  ), 
                  'total_payable_amount' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  ), 
                  'total_payable_interest' => array(
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
                  )
                  ));
                  $this->dbforge->add_key('employee_loan_id', TRUE);
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->add_field('INDEX (loan_type_id)');
                  $this->dbforge->add_field('INDEX (company_id)');
                  $this->dbforge->add_field('INDEX (mode_of_payment_type_id)');
                  $this->dbforge->add_field('INDEX (payment_account)');
                  $this->dbforge->add_field('INDEX (employee_loan_account)');
                  $this->dbforge->add_field('INDEX (interest_income_account)');
                  $this->dbforge->add_field('INDEX (employee_loan_application_id)');
                  $this->dbforge->add_field('INDEX (emp_loan_status_id)');
                  $this->dbforge->add_field('INDEX (emp_loan_repayment_method_id)');
                  $this->dbforge->create_table('hr_employee_loan',true);
            }


            if(!$this->db->table_exists('hr_employee_loan_repayment_schedule'))
            {
                  $this->dbforge->add_field(array(
                  'employee_loan_repayment_schedule_id'=> array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
                  ),
                  'employee_loan_id'=> array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'payment_date'=> array(
                  'type' => 'date',
                  ),
                  'principal_amount' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  ),
                  'interest_amount' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  ),
                  'total_amount' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  ),
                  'balance_loan_amount' => array(
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
                  $this->dbforge->add_key ('employee_loan_repayment_schedule_id',TRUE);
                  $this->dbforge->add_field('INDEX (employee_loan_id)');
                  $this->dbforge->create_table('hr_employee_loan_repayment_schedule',true);
            }


            if(!$this->db->table_exists('hr_vehicle_log'))
            { 
                  $this->dbforge->add_field(array(
                  'vehicle_log_id'=> array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
                  ),
                  'naming_series' => array(
      	      'type' => 'varchar',
      	      'constraint' => 255,
      	      ),
                  'vehicle_id'=> array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,          
                  ),
                  'employee_id'=> array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'model' => array(
                  'type' => 'VARCHAR',
                  'constraint' => 255,
                  ),
                  'make' => array(
                  'type' => 'VARCHAR',
                  'constraint' => 255,
                  ),
                  'date' => array(
                  'type' => 'date',
                  ),
                  'odometer'=> array(
                  'type' => 'INT',
                  'constraint' => 10,
                  ),
                  ));
                  $this->dbforge->add_key ('vehicle_log_id',TRUE);
                  $this->dbforge->add_field('INDEX (vehicle_id)');
                  
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->create_table('hr_vehicle_log',true);
            }

            if(!$this->db->table_exists('hr_vehicle_log_service_details'))
            { 
                  $this->dbforge->add_field(array(
                  'vehicle_log_service_details_id'=> array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
                  ),
                  'vehicle_log_id'=> array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'vehicle_log_service_item_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'vehicle_log_service_type_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'vehicle_log_frquency_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'expense_amount' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  'null' => false
                  ),
                  ));
                  $this->dbforge->add_key ('vehicle_log_service_details_id',TRUE);
                  $this->dbforge->add_field('INDEX (vehicle_log_id)');
                  $this->dbforge->add_field('INDEX (vehicle_log_service_item_id)');
                  $this->dbforge->add_field('INDEX (vehicle_log_service_type_id)');
                  $this->dbforge->add_field('INDEX (vehicle_log_frquency_id)');
                  $this->dbforge->create_table('hr_vehicle_log_service_details',true);
            }

            if(!$this->db->table_exists('hr_appraisal'))
            { 
                  $this->dbforge->add_field(array(
                  'appraisal_id'      => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
                  ),
                  'appraisal_template_id'=> array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'naming_series' => array(
	           'type' => 'varchar',
	           'constraint' => 255,
	           ),
                  'employee_id'       => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'employee_name'     => array(
                  'type' => 'VARCHAR',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'appraisal_status_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'start_date'        => array(
                  'type' => 'DATE',
                  ),
                  'end_date'          => array(
                  'type' => 'DATE',                                               
                  ),
                  'total_score'       => array(
                  'type' => 'DECIMAL',
                  'constraint' => '10,2',
                  'null' => FALSE,
                  ),
                  'remarks'=> array(
                  'type' => 'text',
                  'constraint' => 255,
                  ),
                  'company_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  ));
                  $this->dbforge->add_key('appraisal_id', TRUE);
                  $this->dbforge->add_field('INDEX (appraisal_template_id)');
                  
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->add_field('INDEX (appraisal_status_id)');
                  $this->dbforge->add_field('INDEX (company_id)');
                  $this->dbforge->create_table('hr_appraisal',true);
            }
            if(!$this->db->table_exists('hr_appraisal_goal'))
            { 
                  $this->dbforge->add_field(array(
                  'appraisal_goal_id' => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
                  ),
                  'appraisal_id'      => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'appraisal_template_id' => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'kra'=> array(
                  'type' => 'VARCHAR',
                  'constraint' => 255,
                  ),
                  'weight_age'=> array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  ),
                  'score'=> array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  ),
                  'score_earned'=> array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  ),
                  ));
                  $this->dbforge->add_key('appraisal_goal_id',TRUE);
                  $this->dbforge->add_field('INDEX (appraisal_id)');
                  $this->dbforge->add_field('INDEX (appraisal_template_id)');
                  $this->dbforge->create_table('hr_appraisal_goal',true);
            }

            if(!$this->db->table_exists('hr_process_payroll'))
            { 
                  $this->dbforge->add_field( array(
                  'process_payroll_id'    => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
                  ),
                  'company_id'           => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'posting_date'      => array(
                  'type' => 'DATE',
                  ),
                  'payroll_frequency_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'department_id'        => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'designation_id'        => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'branch_id'            => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'salary_slip_based_on_timesheet' =>array(
                  'type' => 'tinyint',
                  'constraint' => 4,
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
                  'cost_center_id'  => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'project_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'account_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  ));
                  $this->dbforge->add_key('process_payroll_id', TRUE);
                  $this->dbforge->add_field('INDEX (company_id)');
                  $this->dbforge->add_field('INDEX (department_id)');
                  $this->dbforge->add_field('INDEX (designation_id)');
                  $this->dbforge->add_field('INDEX (branch_id)');
                  $this->dbforge->add_field('INDEX (payroll_frequency_id)');
                  $this->dbforge->add_field('INDEX (cost_center_id)');
                  $this->dbforge->add_field('INDEX (project_id)');
                  $this->dbforge->add_field('INDEX (account_id)');
                  $this->dbforge->create_table('hr_process_payroll',true);
            }

            
            if(!$this->db->table_exists('hr_employee_attendance_tool'))
            {
                  $this->dbforge->add_field(array(
                  'employee_attendance_tool_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'department_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'branch_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'company_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'marked_present' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'marked_absent' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'marked_half_day' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'mark_leave' => array(
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
                  ));

                  $this->dbforge->add_key('employee_attendance_tool_id', true);
                  $this->dbforge->add_field('INDEX (department_id)');
                  $this->dbforge->add_field('INDEX (branch_id)');
                  $this->dbforge->add_field('INDEX (company_id)');

                  $this->dbforge->create_table('hr_employee_attendance_tool', true);
            }

            if(!$this->db->table_exists('hr_employee_attendance'))
            {
                  $this->dbforge->add_field(array(
                  'employee_attendance_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'naming_series' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'employee_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
                  ),
                  'employee_name'=>array(
                  'type'=>'varchar',
                  'constraint'=>255,
                  ),
                  'employee_attendance_status_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'attendance_date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'company_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true
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
                  ));

                  $this->dbforge->add_key('employee_attendance_id', true);
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->add_field('INDEX (company_id)');
                  $this->dbforge->add_field('INDEX (employee_attendance_status_id)');
                  $this->dbforge->create_table('hr_employee_attendance', true);
            }

            if(!$this->db->table_exists('hr_employee_upload_attendance'))
            {
                  $this->dbforge->add_field(array(
                  'employee_upload_attendance_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
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
                  ));

                  $this->dbforge->add_key('employee_upload_attendance_id', true);

                  $this->dbforge->create_table('hr_employee_upload_attendance', true);
            }

            if(!$this->db->table_exists('hr_leave_application'))
            {
                  $this->dbforge->add_field(array(
                  'leave_application_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'naming_series' => array(
	           'type' => 'varchar',
	           'constraint' => 255,
	           ),
                  'leave_application_status_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'leave_type_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'leave_balance' => array(
                  'type' => 'decimal',
                  'constraint' => 9,2,
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
                  'reason' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'half_day' => array(
                  'type' => 'tinyint',
                  'constraint' => 4,
                  'null' => false
                  ),
                  'half_day_date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'total_leave_days' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  'null' => false
                  ),
                  'employee_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
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
                  'leave_approver_name' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'posting_date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'follow_via_email' => array(
                  'type' => 'tinyint',
                  'constraint' => 4,
                  'null' => false
                  ),
                  'company_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true
                  ),
                  'letter_head_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true
                  ),
                  ));

                  $this->dbforge->add_key('leave_application_id', true);
                  
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->add_field('INDEX (company_id)');
                  $this->dbforge->add_field('INDEX (user_id)');
                  $this->dbforge->add_field('INDEX (letter_head_id)');
                  $this->dbforge->add_field('INDEX (leave_application_status_id)');
                  $this->dbforge->create_table('hr_leave_application', true);
            }

            if(!$this->db->table_exists('hr_leave_allocation'))
            {
                  $this->dbforge->add_field(array(
                  'leave_allocation_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'naming_series' => array(
	           'type' => 'varchar',
	           'constraint' => 255,
	           ),
                  'employee_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
                  ),
                  'employee_name' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'description' => array(
                  'type' => 'text',
                  'null' => false
                  ),
                  'leave_type_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'from_date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'to_date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'new_leaves_allocated' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  'null' => false
                  ),
                  'carry_forward' => array(
                  'type' => 'tinyint',
                  'constraint' => 4,
                  'null' => false
                  ),
                  'carry_forwarded_leaves' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  'null' => false
                  ),
                  'total_leaves_allocated' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  'null' => false
                  ),
                  ));

                  $this->dbforge->add_key('leave_allocation_id', true);
                  
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->add_field('INDEX (leave_type_id)');
                  $this->dbforge->create_table('hr_leave_allocation', true);
            }

            if(!$this->db->table_exists('hr_leave_control_panel'))
            {
                  $this->dbforge->add_field(array(
                  'leave_control_panel_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'company_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'employment_type_id' => array(
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
                  'from_date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'to_date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'leave_type_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'carry_forward' => array(
                  'type' => 'tinyint',
                  'constraint' => 4,
                  'null' => false
                  ),
                  'no_of_days' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  'null' => false
                  ),
                  ));

                  $this->dbforge->add_key('leave_control_panel_id', true);
                  $this->dbforge->add_field('INDEX (company_id)');
                  $this->dbforge->add_field('INDEX (employment_type_id)');
                  $this->dbforge->add_field('INDEX (branch_id)');
                  $this->dbforge->add_field('INDEX (department_id)');
                  $this->dbforge->add_field('INDEX (designation_id)');
                  $this->dbforge->add_field('INDEX (leave_type_id)');
                  $this->dbforge->create_table('hr_leave_control_panel', true);
            }


            if(!$this->db->table_exists('hr_salary_structure'))
            {
                  $this->dbforge->add_field(array(
                  'salary_structure_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'name' => array(
                  'type' => 'varchar',
                  'constraint' => 255
                  ),
                  'company_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'letter_head_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'salary_structure_is_active_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'payroll_frequency_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'salary_slip_based_on_timesheet' => array(
                  'type' => 'tinyint',
                  'constraint' => 4,
                  'null' => false
                  ),
                  'salary_component_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'hour_rate' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  'null' => false
                  ),
                  'total_earning' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  'null' => false
                  ),
                  'total_deduction' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  'null' => false
                  ),
                  'net_pay' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  'null' => false
                  ),
                  'mode_of_payment_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'payment_account' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  ),
                  'created_on'=> array(
                  'type' => 'timestamp',
                  'null'      => 'YES',
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

                  $this->dbforge->add_key('salary_structure_id', true);
                  $this->dbforge->add_field('INDEX (company_id)');
                  $this->dbforge->add_field('INDEX (letter_head_id)');
                  $this->dbforge->add_field('INDEX (salary_structure_is_active_id)');
                  $this->dbforge->add_field('INDEX (payroll_frequency_id)');
                  $this->dbforge->add_field('INDEX (salary_component_id)');
                  $this->dbforge->add_field('INDEX (mode_of_payment_id)');
                  $this->dbforge->add_field('INDEX (payment_account)');
                  $this->dbforge->create_table('hr_salary_structure', true);
            }

            if(!$this->db->table_exists('hr_salary_structure_select_employee'))
            {
                  $this->dbforge->add_field(array(
                  'salary_structure_select_employee_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'salary_structure_id' => array(
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
                  'from_date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'to_date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'base' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  'null' => false
                  ),
                  'variable' => array(
                  'type' => 'decimal',
                  'constraint' => '9,2',
                  'null' => false
                  ),
                  'created_on'=> array(
                  'type' => 'timestamp',
                  'null'      => 'YES',
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

                  $this->dbforge->add_key('salary_structure_select_employee_id', true);
                  $this->dbforge->add_field('INDEX (salary_structure_id)');
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->create_table('hr_salary_structure_select_employee', true);
            }

            if(!$this->db->table_exists('hr_salary_slip'))
            {
                  $this->dbforge->add_field(array(
                  'salary_slip_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'posting_date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'employee_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true
                  ),
                  'employee_name' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'company' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'department' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'designation' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'branch' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'salary_slip_status_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'letter_head_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'salary_slip_based_on_timesheet'=>array(
                  'type'=>'tinyint',
                  'constraint'=>4
                  ),
                  'start_date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'end_date' => array(
                  'type' => 'date',
                  'null' => false
                  ),
                  'salary_structure_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'payroll_frequency_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'total_working_days'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'leave_without_pay'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'payment_days'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'total_working_hours'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'hour_rate'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'bank_name' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'bank_account_no' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'gross_pay'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'total_deduction'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'principal_amount'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'interest_amount'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'total_loan_repayment'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'net_pay'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'rounded_total'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'total_in_words' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'created_on'=> array(
                  'type' => 'timestamp',
                  'null'      => 'YES',
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
                  $this->dbforge->add_key('salary_slip_id', true);
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->add_field('INDEX (salary_slip_status_id)');
                  $this->dbforge->add_field('INDEX (letter_head_id)');
                  $this->dbforge->add_field('INDEX (salary_structure_id)');
                  $this->dbforge->add_field('INDEX (payroll_frequency_id)');
                  $this->dbforge->create_table('hr_salary_slip', true);
            }

            if(!$this->db->table_exists('hr_salary_slip_timesheet'))
            {
                  $this->dbforge->add_field(array(
                  'salary_slip_timesheet_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'salary_slip_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'timesheet_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'working_hours'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  ));
                  $this->dbforge->add_key('salary_slip_timesheet_id', true);
                  $this->dbforge->add_field('INDEX (salary_slip_id)');
                  $this->dbforge->add_field('INDEX (timesheet_id)');
                  $this->dbforge->create_table('hr_salary_slip_timesheet', true);
            }

            if(!$this->db->table_exists('hr_earning'))
            {
                  $this->dbforge->add_field(array(
                  'earning_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'salary_structure_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'salary_component_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'abbr' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'statistical_component' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'formula' => array(
                  'type' => 'text',
                  'null' => false
                  ),
                  'amount' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  ));

                  $this->dbforge->add_key('earning_id', true);
                  $this->dbforge->add_field('INDEX (salary_structure_id)');
                  $this->dbforge->add_field('INDEX (salary_component_id)');
                  $this->dbforge->create_table('hr_earning', true);
            }

            if(!$this->db->table_exists('hr_deduction'))
            {
                  $this->dbforge->add_field(array(
                  'deduction_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'salary_structure_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'salary_component_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true
                  ),
                  'abbr' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'statistical_component' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'formula' => array(
                  'type' => 'text',
                  'null' => false
                  ),
                  'amount' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  ));

                  $this->dbforge->add_key('deduction_id', true);
                  $this->dbforge->add_field('INDEX (salary_structure_id)');
                  $this->dbforge->add_field('INDEX (salary_component_id)');
                  $this->dbforge->create_table('hr_deduction', true);
            }

            if(!$this->db->table_exists('hr_salary_detail'))
            {
                  $this->dbforge->add_field(array(
                  'salary_detail_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'salary_structure_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true
                  ),
                  'salary_component_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true
                  ),
                  'abbr' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'statistical_component' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'condition' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'amount_based_on_formula' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'formula' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'amount' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'depends_on_lwp' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),
                  'default_amount' => array(
                  'type' => 'varchar',
                  'constraint' => 255,
                  'null' => false
                  ),

                  ));

                  $this->dbforge->add_key('salary_detail_id', true);
                  $this->dbforge->add_field('INDEX (salary_component_id)');
                  $this->dbforge->add_field('INDEX (salary_structure_id)');
                  $this->dbforge->create_table('hr_salary_detail',true);      
            }

            if(!$this->db->table_exists('hr_training_result'))
            {
                  $this->dbforge->add_field(array
                  (
                  'training_result_id'=>array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'training_event_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  ),
                  'employee_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
                  ),
                  'hours'=>array(
                  'type'=>'float',
                  ),
                  'grade'=>array(
                  'type'=>'VARCHAR',
                  'constraint'=>255,
                  ),
                  'comments'=>array(
                  'type'=>'VARCHAR',
                  'constraint'=>255,
                  ),
                  ));
                  $this->dbforge->add_key('training_result_id',TRUE);
                  $this->dbforge->add_field('INDEX (training_event_id)');
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->create_table('hr_training_result');
            }


            if(!$this->db->table_exists('hr_training_result_employee'))
            {
                  $this->dbforge->add_field(array
                  (
                  'training_result_employee_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  'auto_increment'=>TRUE,
                  ),
                  'employee_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
                  ),
                  'employee_name'=>array(
                  'type'=>'varchar',
                  'constraint'=>255,
                  ),
                  'hours'=>array(
                  'type'=>'float',
                  ),
                  'grade'=>array(
                  'type'=>'varchar',
                  'constraint'=>255,
                  ),
                  'comments'=>array(
                  'type'=>'text',
                  ),
                  ));
                  $this->dbforge->add_key('training_result_employee_id',TRUE);
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->create_table('hr_training_result_employee');
            }

            if(!$this->db->table_exists('hr_training_event_attendees'))
            {
                  $this->dbforge->add_field(array(   
                  'attendees_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  'auto_increment'=>TRUE,
                  ),
                  'training_event_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  ),
                  'send_email'=>array(
                  'type'=>'TINYINT',
                  'default'=>1,
                  ),
                  'employee_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
                  ),
                  'training_event_status_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  ));
                  $this->dbforge->add_key('attendees_id',TRUE);
                  $this->dbforge->add_field('INDEX (training_event_id)');
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->add_field('INDEX (training_event_status_id)');
                  $this->dbforge->create_table('hr_training_event_attendees');
            }


            if(!$this->db->table_exists('hr_training_feedback'))
            {
                  $this->dbforge->add_field(array
                  (
                  'training_feedback_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  'auto_increment'=>TRUE,
                  ),
                  'employee_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
                  ),
                  'employee_name'=>array(
                  'type'=>'VARCHAR',
                  'constraint'=>255,
                  'null' => false
                  ),
                  'trainer_name'=>array(
                  'type'=>'VARCHAR',
                  'constraint'=>255,
                  'null' => false
                  ),
                  'course_id'=>array(
                  'type'=>'varchar',
                  'constraint'=>255,
                  'unsigned' => true
                  ),
                  'training_event_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
                  ),
                  'feedback'=>array(
                  'type'=>'TEXT',
                  'null'=>TRUE,
                  ),  
                  ));
                  $this->dbforge->add_key('training_feedback_id',TRUE);
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->add_field('INDEX (training_event_id)');
                  $this->dbforge->create_table('hr_training_feedback');
            }

            if(!$this->db->table_exists('hr_expense_claim'))
            {
                  $this->dbforge->add_field(array
                  (
                  'expense_claim_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  'auto_increment'=>TRUE,
                  ),
                  'naming_series' => array(
	           'type' => 'varchar',
	           'constraint' => 255,
	           ),
                  'is_paid'=>array(
                  'type'=>'tinyint',
                  'constraint'=>4
                  ),
                  'expense_claim_approval_status_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'user_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  'total_claimed_amount'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'total_sanctioned_amount'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'posting_date' => array(
                  'type' => 'date', 
                  ),
                  'employee_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
                  ),
                  'employee_name'=>array(
                  'type'=>'VARCHAR',
                  'constraint'=>255,
                  ),
                  'project_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
                  ),
                  'task_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
                  ),
                  'total_amount_reimbursed'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'remark'=>array(
                  'type'=>'text',
                  ),
                  'company_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
                  ),
                  'mode_of_payment_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true 
                  ),
                  'account_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true 
                  ),
                  'cost_center_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true 
                  ),
                  'expense_claim_status_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  ));
                  $this->dbforge->add_key('expense_claim_id',TRUE);
                  
                  $this->dbforge->add_field('INDEX (user_id)');
                  $this->dbforge->add_field('INDEX (employee_id)');
                  $this->dbforge->add_field('INDEX (project_id)');
                  $this->dbforge->add_field('INDEX (task_id)');
                  $this->dbforge->add_field('INDEX (company_id)');
                  $this->dbforge->add_field('INDEX (mode_of_payment_id)');
                  $this->dbforge->add_field('INDEX (expense_claim_status_id)');
                  $this->dbforge->add_field('INDEX (expense_claim_approval_status_id)');
                  $this->dbforge->create_table('hr_expense_claim', true);
            }
            if(!$this->db->table_exists('hr_expense_claim_detail'))
            {
                  $this->dbforge->add_field(array
                  (
                  'expense_claim_detail_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  'auto_increment'=>TRUE,
                  ),
                  'expense_claim_type_id'=>array(
                  'type'=>'INT',
                  'constraint'=>11,
                  'unsigned'=>TRUE,
                  ),
                  'expense_date' => array(
                  'type' => 'date', 
                  ),
                  'default_account'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned' => true
                  ),
                  'description'=>array(
                  'type'=>'longtext',
                  ),
                  'claim_amount'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  'sanctioned_amount'=>array(
                  'type'=>'decimal',
                  'constraint'=>'9,2',
                  ),
                  ));
                  $this->dbforge->add_key('expense_claim_detail_id',TRUE);
                  $this->dbforge->add_field('INDEX (expense_claim_type_id)');
                  $this->dbforge->add_field('INDEX (default_account)');
                  $this->dbforge->create_table('hr_expense_claim_detail');
            }

            if(!$this->db->table_exists('hr_expense_claim_account',true))
            {

                  $this->dbforge->add_field(array(
                  'expense_claim_type_account_id' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  'auto_increment' => true
                  ),
                  'company_id' =>array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  ),
                  'default_account' => array(
                  'type' => 'int',
                  'constraint' => 10,
                  'unsigned' => true,
                  ),
                  ));
                  $this->dbforge->add_key('expense_claim_type_account_id',TRUE);
                  $this->dbforge->add_field('INDEX (company_id)');
                  $this->dbforge->add_field('INDEX (default_account)');
                  $this->dbforge->create_table('hr_expense_claim_account',true);
            }

            if(!$this->db->table_exists('hr_offer_letter'))
            {
                  $this->dbforge->add_field(array(
                  'offer_letter_id'=> array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
                  ),
                  'job_applicant_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  ),
                  'applicant_name'=>array(
                  'type'=>'VARCHAR',
                  'constraint'=>255,
                  'null'=>false,
                  ),
                  'offer_letter_status_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  ),
                  'offer_date'=>array(
                  'type'=>'DATE',
                  ),
                  'designation_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  ),
                  'company_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  ),
                  'tc_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  ),
                  'terms'=>array(
                  'type'=>'longtext',
                  ),
                  ));
                  $this->dbforge->add_key('offer_letter_id',TRUE);
                  $this->dbforge->add_field('INDEX (job_applicant_id)');
                  $this->dbforge->add_field('INDEX (offer_letter_status_id)');
                  $this->dbforge->add_field('INDEX (designation_id)');
                  $this->dbforge->add_field('INDEX (company_id)');
                  $this->dbforge->add_field('INDEX (tc_id)');
                  $this->dbforge->create_table('hr_offer_letter');
            }

            if(!$this->db->table_exists('hr_offer_letter_term'))
            {
                  $this->dbforge->add_field(array(
                  'offer_letter_term_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  'auto_increment'=>TRUE,
                  ),
                  'offer_letter_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,            
                  ),
                  'offer_term'=>array(
                  'type'=>'varchar',
                  'constraint'=>255            
                  ),
                  'value' => array(
                  'type' => 'text',
                  ),
                  ));
                  $this->dbforge->add_key('offer_letter_term_id',TRUE);
                  $this->dbforge->add_field('INDEX (offer_letter_id)');
                  $this->dbforge->create_table('hr_offer_letter_term');
            }

            if(!$this->db->table_exists('hr_appraisal_template'))
            {
                  $this->dbforge->add_field(array(
                  'appraisal_template_id'=>array(
                  'type'=>'INT',
                  'constraint'=>10,
                  'unsigned'=>TRUE,
                  'auto_increment'=>TRUE,
                  ),
                  'kra_title'=>array(
                  'type'=>'VARCHAR',
                  'constraint'=>255,
                  'null' => false
                  ),
                  'description'=>array(
                  'type'=>'text',
                  ),
                  ));
                  $this->dbforge->add_key('appraisal_template_id',TRUE);
                  $this->dbforge->create_table('hr_appraisal_template');
            }
      }
      public function down()
      {
            $this->dbforge->drop_table('hr_employee_loan', true);
            $this->dbforge->drop_table('hr_employee_loan_repayment_schedule',true);   
            $this->dbforge->drop_table('hr_vehicle_log', true);
            $this->dbforge->drop_table('hr_vehicle_log_service_details', true);
            $this->dbforge->drop_table('hr_process_payroll', true);
            $this->dbforge->drop_table('hr_appraisal', true);
            $this->dbforge->drop_table('hr_appraisal_goal', true);
            $this->dbforge->drop_table('hr_employee_attendance_tool', true);
            $this->dbforge->drop_table('hr_employee_attendance', true);
            $this->dbforge->drop_table('hr_employee_upload_attendance', true);
            $this->dbforge->drop_table('hr_leave_application', true);
            $this->dbforge->drop_table('hr_leave_allocation', true);
            $this->dbforge->drop_table('hr_leave_control_panel', true);
            $this->dbforge->drop_table('hr_salary_structure', true);
            $this->dbforge->drop_table('hr_salary_structure_select_employee', true);
            $this->dbforge->drop_table('hr_salary_slip', true);
            $this->dbforge->drop_table('hr_salary_slip_timesheet', true);
            $this->dbforge->drop_table('hr_earning', true);
            $this->dbforge->drop_table('hr_deduction', true);
            $this->dbforge->drop_table('hr_salary_detail', true);
            $this->dbforge->drop_table('hr_training_result',TRUE);
            $this->dbforge->drop_table('hr_training_result_employee',TRUE); 
            $this->dbforge->drop_table('hr_training_feedback',TRUE);
            $this->dbforge->drop_table('hr_training_event_attendees',TRUE);
            $this->dbforge->drop_table('hr_expense_claim',TRUE);
            $this->dbforge->drop_table('hr_expense_claim_detail',true);
            $this->dbforge->drop_table('hr_expense_claim_account',true);
            $this->dbforge->drop_table('hr_offer_letter', true); 
            $this->dbforge->drop_table('hr_offer_letter_term', true); 
            $this->dbforge->drop_table('hr_appraisal_template', true);   
      }
}
