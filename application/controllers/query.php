/*14-10-2018*/ live->updated
UPDATE `menus` SET `is_active` = '0' WHERE `menus`.`id` = 184;
ALTER TABLE `set_company_default_values` CHANGE `existing_company` `existing_company` VARCHAR(255) NOT NULL;

/*15-10-2018*/ live->updated
INSERT INTO `def_hr_expense_claim_approval_status` (`expense_claim_approval_status_id`, `approval_status`) VALUES ('0', 'New');
INSERT INTO `def_hr_emp_loan_appliction_status` (`emp_loan_appliction_status_id`, `status`) VALUES ('1', 'New');

/*17-10-2018*/ live->updated
ALTER TABLE `hr_job_applicant` CHANGE `total_experience` `total_experience` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

/*20-10-2018*/ live->updated

ALTER TABLE `hr_emp_leave_rejection` CHANGE `leave_application_id` `leave_application_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT

ALTER TABLE `hr_emp_leave_rejection` DROP `leave_application_id`;

ALTER TABLE `hr_emp_leave_rejection` ADD `leave_rejection_id` INT UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD `leave_application_id` INT UNSIGNED NOT NULL AFTER `leave_rejection_id`, ADD PRIMARY KEY (`leave_rejection_id`), ADD INDEX (`leave_application_id`);

DROP INDEX `category_code` ON acl_categories
DROP INDEX `category_desc` ON acl_categories

ALTER TABLE `acl_actions` CHANGE `action_desc` `action_desc` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Human readable description';

/****************************26-10-18*******************************************/

ALTER TABLE `acl_categories` CHANGE `category_desc` `category_desc` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Human readable description';

/**************************29-11-2018***********************************************/
ALTER TABLE `hr_emp_employment_details` CHANGE `holiday_list_id` `holiday_list_id` VARCHAR(50) NOT NULL;

ALTER TABLE `hr_salary_slip` ADD `total_holidays` DECIMAL(9,2) NOT NULL AFTER `payment_days`

/********************************01-12-2018******************************************/
ALTER TABLE `hr_salary_slip` ADD `allowed_leaves` DECIMAL(9,2) NOT NULL AFTER `hour_rate`, ADD `lop` DECIMAL(9,2) NOT NULL AFTER `allowed_leaves`, ADD `lop_amount` DECIMAL(19,2) NOT NULL AFTER `lop`;

/*******************************03-12-2018**********************************************/

ALTER TABLE `hr_employee_attendance` ADD `is_half_date` TINYINT NOT NULL DEFAULT '0' AFTER `attendance_date`;

/******************************06-12-2018**********************************************/

ALTER TABLE `hr_training_program` ADD FOREIGN KEY (`trainer_id`) REFERENCES `hr_trainer`(`trainer_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `hr_training_event` ADD FOREIGN KEY (`trainer_id`) REFERENCES `hr_trainer`(`trainer_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `hr_training_event_attendees` ADD FOREIGN KEY (`training_event_id`) REFERENCES `hr_training_event`(`training_event_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `hr_training_result` ADD FOREIGN KEY (`training_event_id`) REFERENCES `hr_training_event`(`training_event_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `hr_training_result_employee` ADD FOREIGN KEY (`training_result_id`) REFERENCES `hr_training_result`(`training_result_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `hr_training_feedback` ADD FOREIGN KEY (`training_event_id`) REFERENCES `hr_training_event`(`training_event_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*****************************07-12-2018**************************************/
ALTER TABLE `hr_vehicle_log` ADD FOREIGN KEY (`vehicle_id`) REFERENCES `hr_vehicle`(`vehicle_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `hr_vehicle_log_service_details` ADD FOREIGN KEY (`vehicle_log_id`) REFERENCES `hr_vehicle`(`vehicle_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/****************************14-12-2018***********************************/

ALTER TABLE `hr_employee_loan_application` CHANGE `total_payable_amount` `total_payable_amount` DECIMAL(9,2) NOT NULL;