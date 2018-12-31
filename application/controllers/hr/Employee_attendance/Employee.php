<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->is_logged_in();
        $this->load->model("menu_model", "menu");
        $this->lang->load("validation_lang","english");
        $items = $this->menu->all();
        $this->load->library("multi_menu");
        $this->multi_menu->set_items($items);
        $this->lang->load("hr","english");
        $this->load->library('upload');
    }

    public function index($Data=array())
    {
        if( $this->acl_permits('HR.employee') )
        {
            $view_data = array(
                              'form_heading'      => $this->lang->line('employee_form_heading'),
                              'form_title'        => $this->lang->line('employee_form_title'),
                              //'form_description'  => $this->lang->line('employee_form_description'),
                              //'list_heading'      => $this->lang->line('employee_form_heading'),
                              //'list_title'        => $this->lang->line('employee_form_title'),
                              'list_description'  => $this->lang->line('employee_form_description'),
                              'formUrl'           => 'hr/Employee_attendance/Employee/ajaxLoadForm',
                              'list_view'         => TRUE,
                              'buttonview'        => TRUE,
                              'addNewAsLink'      => 1
                            );

            $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
            $this->table->set_template($tmpl); 
            $this->table->set_heading('Action','Employee Number','Employee Name', 'Company Name', 'Status', 'Last Update', 'Updated by');

            $view_data['dataTableUrl']   =   'hr/Employee_attendance/Employee/datatable';
            $data = array(
                            'title'     =>  'MEP - '.$this->lang->line('employee_form_heading'),
                            'content'   =>  $this->load->view('base_template', $view_data,TRUE)
                          );

            $this->load->view($this->dbvars->app_template, $data);
        }
        else
        {
            //Unauthorized User Message
            $viewData ='';
            $data     = array(
                              'title'     =>  $this->lang->line('unauth_page_title'),
                              'content'   =>  $this->load->view('unauthorized',$viewData,TRUE)
                             );
            $this->load->view('base/error_template', $data);        
        }
    }

    public function ajaxLoadForm($Data = array())
    {
        $isFormLoad = TRUE;

        if(!empty($_POST))
        {
            //Checking Form Validation
            $naming                  =  $this->input->post('naming_series');       
            $namingSeries            =  $this->mcommon->generateSeries($naming, 3);
           
            $educationemployeeArr    =  $this->input->post('emp_educational_details_id');
            $qualificationArr        =  $this->input->post('qualification');
            $school_universityArr    =  $this->input->post('school_university');
            $employee_level_idArr    =  $this->input->post('employee_level_id');
            $year_of_passingArr      =  $this->input->post('year_of_passing');

            $historycompanyArr       =  $this->input->post('emp_history_in_company_id');
            $department_idArr        =  $this->input->post('history_department_id');
            $designation_idArr       =  $this->input->post('history_designation_id');
            $branch_idArr            =  $this->input->post('history_branch_id');
            $from_dateArr            =  $this->input->post('from_date');
            $to_dateArr              =  $this->input->post('to_date');

            $ExternalhistoryArr      =  $this->input->post('emp_external_work_experience_id');
            $company_nameArr         =  $this->input->post('company_name');
            $designationArr          =  $this->input->post('designation');
            $salaryArr               =  $this->input->post('salary');
            $addressArr              =  $this->input->post('address');
            $contactArr              =  $this->input->post('contact');
            $total_experienceArr     =  $this->input->post('total_experience');

            if($this->input->post('employee_status_id') == '1')
            {
                $this->form_validation->set_rules('employee_name', lang('label_branch'), 'required|trim');
                $this->form_validation->set_rules('employee_status_id', lang('label_employee_Status'), 'required|trim');
                $this->form_validation->set_rules('branch_id', lang('label_branch'), 'required|trim');
                $this->form_validation->set_rules('department_id', lang('label_department'), 'required|trim');
                $this->form_validation->set_rules('salutation_id', lang('label_salutation'), 'required|trim');
                $this->form_validation->set_rules('gender_id', lang('label_employee_gender'), 'required|trim');
                //$this->form_validation->set_rules('holiday_list_id', lang('label_employee_holiday_list'), 'required|trim');
                $this->form_validation->set_rules('employee_salary_mode_id', lang('label_employee_salary_mode'), 'required|trim');
                $this->form_validation->set_rules('designation_id', lang('label_employee_designation'), 'required|trim');
                $this->form_validation->set_rules('employee_preferred_contact_email_id', lang('label_employee_preferred_contact_email'), 'required|trim');
                $this->form_validation->set_rules('employee_current_address_id', lang('label_employee_current_Address_is'), 'required|trim');
                $this->form_validation->set_rules('marital_status_id', lang('label_employee_martial_status'), 'required|trim');
                $this->form_validation->set_rules('blood_group_id', lang('label_employee_blood_group'), 'required|trim');
                $this->form_validation->set_rules('date_of_joining', lang('label_employee_date_of_joining'), 'required|trim');
                $this->form_validation->set_rules('date_of_birth', lang('label_employee_date_of_birth'), 'required|trim');
                $this->form_validation->set_rules('company_id', lang('label_employee_company'), 'required|trim');
                //$this->form_validation->set_rules('user_id', lang('label_employee_userid'), 'required|trim');
                $this->form_validation->set_rules('offer_date', lang('label_employee_offer_date'), 'required|trim');
                $this->form_validation->set_rules('employment_type_id', lang('label_employee_employee_type'), 'required|trim');
                $this->form_validation->set_rules('final_confirmation_date', lang('label_employee_confirmation_date'), 'required|trim');
                $this->form_validation->set_rules('contract_end_date', lang('label_employee_contract_end_date'), 'required|trim');
                $this->form_validation->set_rules('date_of_retirement', lang('label_employee_date_of_retirement'), 'required|trim');
                $this->form_validation->set_rules('company_email', lang('label_company_email'), 'required|trim');
                $this->form_validation->set_rules('notice_number_of_days', lang('label_notice'), 'required|trim');
                $this->form_validation->set_rules('employee_permanent_address_id', lang('label_employee_permanent_address_is'), 'required|trim');
            }else
            {
                $this->form_validation->set_rules('employee_name', lang('label_branch'), 'required|trim');
            }
            
            if($this->form_validation->run() == TRUE) 
            {
                //Insert if not id's are given
                if($this->input->post('employee_id') == "")
                {
                    if($_FILES['employee_profile']['name'] != '')
                    {
                        $config = array();
                        $config['upload_path']      = './upload/hr/employee_profile/';
                        $config['allowed_types']    = '*';
                        $config['max_size']         = '0';
                        $config['max_width']        = '3500';
                        $config['max_height']       = '3500';
                        $config['max_filename']     = '500';
                        $config['overwrite']        = false;
                        $this->upload->initialize($config);
                        $this->load->library('image_lib');
                        $this->load->library('upload', $config);

                        if($this->upload->do_upload('employee_profile'))
                        { 
                            $this->load->helper('inflector');
                            $file_name                  =   underscore($_FILES['employee_profile']['name']);
                            $config['file_name']        =   $file_name;
                            $image_data['message']      =   $this->upload->data(); 
                            $_POST['employee_profile']  =   "upload/hr/employee_profile/".$image_data['message']['file_name'];
                        }
                    }
                    else
                    {
                        $_POST['employee_profile']   =   '';
                    }

                    $data           = array(
                                            'salutation_id'             => $this->input->post('salutation_id'),
                                            'employee_name'             => $this->input->post('employee_name'),
                                            'company_id'                => $this->input->post('company_id'),
                                            'user_id'                   => ($this->input->post('user_id')) ? $this->input->post('user_id') : '0',
                                            'naming_series'             => $namingSeries,
                                            //'image'                   => $this->input->post('image'),
                                            'employee_number'           => $this->input->post('employee_number'),
                                            'date_of_joining'           => date('Y-m-d', strtotime($this->input->post('date_of_joining'))),
                                            'date_of_birth'             => date('Y-m-d', strtotime($this->input->post('date_of_birth'))),
                                            'gender_id'                 => $this->input->post('gender_id'),
                                            'created_on'                => date('Y-m-d H:i:s'),
                                            'employee_profile'          => $this->input->post('employee_profile'),
                                            'updated_on'                => date('Y-m-d H:i:s'),
                                            'created_by'                => $this->auth_user_id,
                                            'updated_by'                => $this->auth_user_id
                                            );
                   
                    $result         = $this->mcommon->common_insert('hr_employee', $data);

                    $holiday_list_id = ($this->input->post('holiday_list_id')) ? implode(',', $this->input->post('holiday_list_id')) : '0';                    
                    $empdetailsData = array(
                                            'employee_id'                   =>  $result,
                                            'employee_status_id'            =>  $this->input->post('employee_status_id'),
                                            'employment_type_id'            =>  ($this->input->post('employment_type_id')) ? $this->input->post('employment_type_id') : '0',
                                            'holiday_list_id'               =>  $holiday_list_id,
                                            'offer_date'                    =>  date('Y-m-d', strtotime($this->input->post('offer_date'))),
                                           // 'scheduled_confirmation_date'  =>  $this->input->post('scheduled_confirmation_date'),
                                            'final_confirmation_date'       =>  date('Y-m-d', strtotime($this->input->post('final_confirmation_date'))),
                                            'contract_end_date'             =>  date('Y-m-d', strtotime($this->input->post('contract_end_date'))),
                                            'date_of_retirement'            =>  date('Y-m-d', strtotime($this->input->post('date_of_retirement'))),
                                            'created_on'                    => date('Y-m-d H:i:s'),
                                            'updated_on'                    => date('Y-m-d H:i:s'),
                                            'created_by'                    => $this->auth_user_id,
                                            'updated_by'                    => $this->auth_user_id,
                                            );

                    $result1        = $this->mcommon->common_insert('hr_emp_employment_details', $empdetailsData);
                        
                    if($this->input->post('employee_status_id') == '1')
                    {
                        $JobData        = array(
                                                'employee_id'               =>  $result,
                                                'department_id'             =>  $this->input->post('department_id'),
                                                'designation_id'            =>  $this->input->post('designation_id'),
                                                'branch_id'                 =>  $this->input->post('branch_id'),
                                                'company_email'             =>  $this->input->post('company_email'),
                                                'employee_salary_mode_id'   =>  $this->input->post('employee_salary_mode_id'),
                                                'created_on'                => date('Y-m-d H:i:s'),
                                                'updated_on'                => date('Y-m-d H:i:s'),
                                                'created_by'                => $this->auth_user_id,
                                                'updated_by'                => $this->auth_user_id,
                                                'notice_number_of_days'    =>  $this->input->post('notice_number_of_days')
                                                );
                        $result2        = $this->mcommon->common_insert('hr_emp_job_profile', $JobData);

                        $contactData    = array(
                                                'employee_id'                   =>  $result,
                                                'employee_preferred_contact_email_id' =>  $this->input->post('employee_preferred_contact_email_id'),
                                                'cell_number'                   =>  $this->input->post('cell_number'),
                                                'personal_email'                =>  $this->input->post('personal_email'),
                                                'unsubscribed'                  =>  ($this->input->post('unsubscribed')) ? '1' : '0',
                                                'person_to_be_contacted'        =>  $this->input->post('person_to_be_contacted'),
                                                'relation'                      =>  $this->input->post('relation'),
                                                'emergency_phone_number'        =>  $this->input->post('emergency_phone_number'),
                                                'permanent_address'             =>  $this->input->post('permanent_address'),
                                                'employee_permanent_address_id' =>  $this->input->post('employee_permanent_address_id'),
                                                'employee_current_address_id'   =>  $this->input->post('employee_current_address_id'),
                                                'current_address'               =>  $this->input->post('current_address'),
                                                'contact_person_name'           =>  $this->input->post('contact_person_name'),
                                                'created_on'                    => date('Y-m-d H:i:s'),
                                                'updated_on'                    => date('Y-m-d H:i:s'),
                                                'created_by'                    => $this->auth_user_id,
                                                'updated_by'                    => $this->auth_user_id,
                                                );

                        $result3        = $this->mcommon->common_insert('hr_emp_contact_details', $contactData);
                        
                        $bankData       = array(
                                            'employee_id'               =>  $result,
                                            'bank_ac_no'                =>  $this->input->post('bank_ac_no'),
                                            'bank_name'                 =>  $this->input->post('bank_name'),
                                            'ifsc_code'                 =>  $this->input->post('ifsc_code'),
                                            'branch'                    =>  $this->input->post('branch'),
                                             'created_on'               => date('Y-m-d H:i:s'),
                                            'updated_on'                => date('Y-m-d H:i:s'),
                                            'created_by'                => $this->auth_user_id,
                                            'updated_by'                => $this->auth_user_id,
                                            );
                        $result4        = $this->mcommon->common_insert('hr_emp_bank_details', $bankData);
                    
                        $Insdata        = array(
                                            'employee_id'               =>  $result,
                                            'insurance_company'         =>  $this->input->post('insurance_company'),
                                            'start_date'                =>  date('Y-m-d', strtotime($this->input->post('start_date'))),
                                            'end_date'                  =>  date('Y-m-d', strtotime($this->input->post('end_date'))),
                                            'policy_number'             =>  $this->input->post('policy_number'),
                                            'created_on'                => date('Y-m-d H:i:s'),
                                            'updated_on'                => date('Y-m-d H:i:s'),
                                            'created_by'                => $this->auth_user_id,
                                            'updated_by'                => $this->auth_user_id,
                                            );
                        $result5        = $this->mcommon->common_insert('hr_emp_insurance', $Insdata);
                    
                        $PersonalData   = array(
                                                'employee_id'               =>  $result,
                                                'passport_number'           =>  $this->input->post('passport_number'),
                                                'date_of_issue'             =>  date('Y-m-d', strtotime($this->input->post('date_of_issue'))),
                                                'valid_upto'                =>  date('Y-m-d', strtotime($this->input->post('valid_upto'))),
                                                'place_of_issue'            =>  $this->input->post('place_of_issue'),
                                                'marital_status_id'         =>  $this->input->post('marital_status_id'),
                                                'blood_group_id'            =>  $this->input->post('blood_group_id'),
                                                'health_details'            =>  $this->input->post('health_details'),
                                                 'created_on'               => date('Y-m-d H:i:s'),
                                                'updated_on'                => date('Y-m-d H:i:s'),
                                                'created_by'                => $this->auth_user_id,
                                                'updated_by'                => $this->auth_user_id,
                                               );
                        $result6        = $this->mcommon->common_insert('hr_emp_personal_details', $PersonalData);
                    
                        foreach ($qualificationArr as $key => $value) 
                        {
                          $EduData      = array(
                                                'employee_id'               =>  $result,
                                                'qualification'             =>  $qualificationArr[$key],
                                                'school_university'         =>  $school_universityArr[$key],
                                                'employee_level_id'         =>  $employee_level_idArr[$key],
                                                'year_of_passing'           =>  $year_of_passingArr[$key],
                                              //'class_per'                 =>  $this->input->post('class_per'),
                                              //'maj_opt_subj'              =>  $this->input->post('maj_opt_subj'),
                                                'created_on'               =>   date('Y-m-d H:i:s'),
                                                'updated_on'                =>  date('Y-m-d H:i:s'),
                                                'created_by'                =>  $this->auth_user_id,
                                                'updated_by'                =>  $this->auth_user_id,
                                                );
                          $result7      = $this->mcommon->common_insert('hr_emp_educational_details', $EduData);
                        }

                        foreach ($historycompanyArr as $key => $value) 
                        {
                            $historydata = array(
                                                    'employee_id'               =>  $result,
                                                    'department_id'             =>  $department_idArr[$key],
                                                    'designation_id'            =>  $designation_idArr[$key],
                                                    'branch_id'                 =>  $branch_idArr[$key],
                                                    'from_date'                 =>  date('Y-m-d', strtotime($from_dateArr[$key])),
                                                    'to_date '                  =>  date('Y-m-d', strtotime($to_dateArr[$key])),
                                                    'created_on'                =>  date('Y-m-d H:i:s'),
                                                    'updated_on'                =>  date('Y-m-d H:i:s'),
                                                    'created_by'                =>  $this->auth_user_id,
                                                    'updated_by'                =>  $this->auth_user_id,
                                                );
                            $result8    = $this->mcommon->common_insert('hr_emp_history_in_company', $historydata);
                        }

                        foreach ($company_nameArr as $key => $value) 
                        {
                            $ExternalData   = array(
                                                'employee_id'               =>  $result,
                                                'company_name'              =>  $company_nameArr[$key],
                                                'designation'               =>  $designationArr[$key],
                                                'salary'                    =>  $salaryArr[$key],
                                                'address'                   =>  $addressArr[$key],
                                                'contact'                   =>  $contactArr[$key],
                                               'total_experience'           =>  $total_experienceArr[$key],
                                                'created_on'               => date('Y-m-d H:i:s'),
                                                'updated_on'                => date('Y-m-d H:i:s'),
                                                'created_by'                => $this->auth_user_id,
                                                'updated_by'                => $this->auth_user_id,
                                            );

                            $result11   = $this->mcommon->common_insert('hr_emp_external_work_experience', $ExternalData);
                        }
                            
                        $ProfileData    = array(
                                            'employee_id'               => $result,
                                            'reports_to'                => $this->input->post('reports_to'),
                                            'leave_approver_id'         => $this->input->post('leave_approver_id'),
                                            'created_on'                => date('Y-m-d H:i:s'),
                                            'updated_on'                => date('Y-m-d H:i:s'),
                                            'created_by'                => $this->auth_user_id,
                                            'updated_by'                => $this->auth_user_id,
                                            );
                        $result12       = $this->mcommon->common_insert('hr_emp_organization_profile', $ProfileData);
                    }                

                    if($this->input->post('employee_status_id') == '2')
                    {
                        $ExitData      = array(
                                                'employee_id'                   =>  $result,
                                                'reason_for_leaving'            =>  $this->input->post('reason_for_leaving'),
                                                'resignation_letter_date'       => date('Y-m-d', strtotime($this->input->post('resignation_letter_date'))),
                                                'relieving_date'                =>  date('Y-m-d', strtotime($this->input->post('relieving_date'))),
                                                'employee_leave_en_cashed_id'   =>  $this->input->post('employee_leave_en_cashed_id'),
                                                'encashment_date'               =>  date('Y-m-d', strtotime($this->input->post('encashment_date'))),
                                                 'created_on'                   => date('Y-m-d H:i:s'),
                                                'updated_on'                    => date('Y-m-d H:i:s'),
                                                'created_by'                    => $this->auth_user_id,
                                                'updated_by'                    => $this->auth_user_id,
                                                );
                        $result9        = $this->mcommon->common_insert('hr_emp_exit', $ExitData);
                    
                        $InterData      = array(
                                                'employee_id'               => $result,
                                                'reason_for_resignation'    => $this->input->post('reason_for_resignation'),
                                                'held_on'                   =>  date('Y-m-d', strtotime($this->input->post('held_on'))),
                                                'new_workplace'             => $this->input->post('new_workplace'),
                                                'feedback'                  => $this->input->post('feedback'),
                                                'created_on'                => date('Y-m-d H:i:s'),
                                                'updated_on'                => date('Y-m-d H:i:s'),
                                                'created_by'                => $this->auth_user_id,
                                                'updated_by'                => $this->auth_user_id,
                                               );
                        $result10       = $this->mcommon->common_insert('hr_emp_exit_interview', $InterData);
                    } 

                    if($result)
                    {
                        $where_array  = array('transaction_id' => 3);
                        $resultupdate = $this->mcommon->dataUpdate('set_naming_series', 'current_value', $where_array); 
                    }

                    if($result)
                    {
                        $this->session->set_flashdata('msg', 'Saved Successfully');
                        $this->session->set_flashdata('alertType', 'success');
                        redirect(base_url('hr/Employee_attendance/Employee/'));
                    }
                }
                //Edit function calling
                else
                {
                    if($_FILES['employee_profile']['name'] != '')
                    {
                        $config = array();
                        $config['upload_path']      = './upload/hr/employee_profile/';
                        $config['allowed_types']    = '*';
                        $config['max_size']         = '0';
                        $config['max_width']        = '3500';
                        $config['max_height']       = '3500';
                        $config['max_filename']     = '500';
                        $config['overwrite']        = false;
                        $this->upload->initialize($config);
                        $this->load->library('image_lib');
                        $this->load->library('upload', $config);

                        if($this->upload->do_upload('employee_profile'))
                        { 
                            $this->load->helper('inflector');
                            $file_name                  =   underscore($_FILES['employee_profile']['name']);
                            $config['file_name']        =   $file_name;
                            $image_data['message']      =   $this->upload->data(); 
                            $_POST['employee_profile']  =   "upload/hr/employee_profile/".$image_data['message']['file_name'];
                        }
                    }                   

                    $where_array  = array('employee_id' =>    $this->input->post('employee_id'));
                    $data         = array(
                                        'salutation_id'             => $this->input->post('salutation_id'),
                                        'employee_name'             => $this->input->post('employee_name'),
                                        'company_id'                => $this->input->post('company_id'),
                                        'user_id'                   => ($this->input->post('user_id')) ? $this->input->post('user_id') : '0',
                                        'image'                     => $this->input->post('image'),
                                        'employee_number'           => $this->input->post('employee_number'),
                                        'date_of_joining'           => date('Y-m-d', strtotime($this->input->post('date_of_joining'))),
                                        'date_of_birth'             => date('Y-m-d', strtotime($this->input->post('date_of_birth'))),
                                        'gender_id'                 => $this->input->post('gender_id'),
                                        'employee_profile'          => $this->input->post('employee_profile'),
                                        'updated_on'                => date('Y-m-d H:i:s'),
                                        'updated_by'                => $this->auth_user_id
                                       );
                    $result     = $this->mcommon->common_edit('hr_employee', $data,$where_array);
                
                    $data1      = array(
                                   
                                    'employee_status_id'            =>  $this->input->post('employee_status_id'),
                                    'employment_type_id'            =>  $this->input->post('employment_type_id'),
                                    'holiday_list_id'               =>  implode(',', $this->input->post('holiday_list_id')),
                                    'offer_date'                    =>  date('Y-m-d', strtotime($this->input->post('offer_date'))),
                                   //'scheduled_confirmation_date'  =>  $this->input->post('scheduled_confirmation_date'),
                                    'final_confirmation_date'       =>  date('Y-m-d', strtotime($this->input->post('final_confirmation_date'))),
                                    'contract_end_date'             =>  date('Y-m-d', strtotime($this->input->post('contract_end_date'))),
                                    'date_of_retirement'            =>  date('Y-m-d', strtotime($this->input->post('date_of_retirement'))),
                                    'updated_on'                    => date('Y-m-d H:i:s'),
                                    'updated_by'                    => $this->auth_user_id,
                                    );

                    $result1    = $this->mcommon->common_edit('hr_emp_employment_details', $data1,$where_array);

                    if($this->input->post('employee_status_id') == '1')
                    {
                        $data2      = array(

                                            'department_id'             =>  $this->input->post('department_id'),
                                            'designation_id'            =>  $this->input->post('designation_id'),
                                            'branch_id'                 =>  $this->input->post('branch_id'),
                                            'company_email'             =>  $this->input->post('company_email'),
                                            'employee_salary_mode_id'   =>  $this->input->post('employee_salary_mode_id'),
                                            'updated_on'                => date('Y-m-d H:i:s'),
                                            'updated_by'                => $this->auth_user_id,
                                            'notice_number_of_days'     =>  $this->input->post('notice_number_of_days')
                                            );
                        $result2    = $this->mcommon->common_edit('hr_emp_job_profile', $data2,$where_array);

                        $data3      = array(
                                        'employee_preferred_contact_email_id' =>  $this->input->post('employee_preferred_contact_email_id'),
                                        'cell_number'                   =>  $this->input->post('cell_number'),
                                        'personal_email'                =>  $this->input->post('personal_email'),
                                        'unsubscribed'                  =>  $this->input->post('unsubscribed'),
                                        'person_to_be_contacted'        =>  $this->input->post('person_to_be_contacted'),
                                        'relation'                      =>  $this->input->post('relation'),
                                        'emergency_phone_number'        =>  $this->input->post('emergency_phone_number'),
                                        'permanent_address'             =>  $this->input->post('permanent_address'),
                                        'employee_permanent_address_id' =>  $this->input->post('employee_permanent_address_id'),
                                        'employee_current_address_id'   =>  $this->input->post('employee_current_address_id'),
                                        'current_address'               =>  $this->input->post('current_address'),
                                        'contact_person_name'           =>  $this->input->post('contact_person_name'),
                                        'updated_on'                    => date('Y-m-d H:i:s'),
                                        'updated_by'                    => $this->auth_user_id,
                                        );
                        $result3    = $this->mcommon->common_edit('hr_emp_contact_details', $data3,$where_array);

                        $data4      = array(
                                            'bank_ac_no'                =>  $this->input->post('bank_ac_no'),
                                            'bank_name'                 =>  $this->input->post('bank_name'),
                                            'ifsc_code'                 =>  $this->input->post('ifsc_code'),
                                            'branch'                    =>  $this->input->post('branch'),
                                            'updated_on'                =>  date('Y-m-d H:i:s'),
                                            'updated_by'                =>  $this->auth_user_id,
                                           );

                        $result4    = $this->mcommon->common_edit('hr_emp_bank_details', $data4, $where_array);

                        $data5      = array(
                                            'insurance_company'         =>  $this->input->post('insurance_company'),
                                            'start_date'                =>  date('Y-m-d', strtotime($this->input->post('start_date'))),
                                            'end_date'                  =>  date('Y-m-d', strtotime($this->input->post('end_date'))),
                                            'policy_number'             =>  $this->input->post('policy_number'),
                                            'updated_on'                => date('Y-m-d H:i:s'),
                                            'updated_by'                => $this->auth_user_id,
                                           );
                        $result5    = $this->mcommon->common_edit('hr_emp_insurance', $data5,$where_array);

                        $data6      = array(
                                            'passport_number'           =>  $this->input->post('passport_number'),
                                            'date_of_issue'             =>  date('Y-m-d', strtotime($this->input->post('date_of_issue'))),
                                            'valid_upto'                =>  date('Y-m-d', strtotime($this->input->post('valid_upto'))),
                                            'place_of_issue'            =>  $this->input->post('place_of_issue'),
                                            'marital_status_id'         =>  $this->input->post('marital_status_id'),
                                            'blood_group_id'            =>  $this->input->post('blood_group_id'),
                                            'health_details'            =>  $this->input->post('health_details'),
                                            'updated_on'                => date('Y-m-d H:i:s'),
                                            'updated_by'                => $this->auth_user_id,
                                           );
                        $result6    = $this->mcommon->common_edit('hr_emp_personal_details', $data6,$where_array);

                        foreach ($qualificationArr as $key => $value) 
                        {
                            $EduData      = array(
                                                'qualification'             =>  $qualificationArr[$key],
                                                'school_university'         =>  $school_universityArr[$key],
                                                'employee_level_id'         =>  $employee_level_idArr[$key],
                                                'year_of_passing'           =>  $year_of_passingArr[$key],
                                              //'class_per'                 =>  $this->input->post('class_per'),
                                              //'maj_opt_subj'              =>  $this->input->post('maj_opt_subj'),
                                                'updated_on'                =>  date('Y-m-d H:i:s'),
                                                'updated_by'                =>  $this->auth_user_id,
                                                );
                            if($educationemployeeArr[$key] != '')
                            {
                                $where_array7  = array('emp_educational_details_id' => $educationemployeeArr[$key]);
                                $result7    = $this->mcommon->common_edit('hr_emp_educational_details', $EduData,$where_array7);
                            }
                            else
                            {
                                $EduData      = array(
                                                    'employee_id'                => $this->input->post('employee_id'),
                                                    'qualification'             =>  $qualificationArr[$key],
                                                    'school_university'         =>  $school_universityArr[$key],
                                                    'employee_level_id'         =>  $employee_level_idArr[$key],
                                                    'year_of_passing'           =>  $year_of_passingArr[$key],
                                                  //'class_per'                 =>  $this->input->post('class_per'),
                                                  //'maj_opt_subj'              =>  $this->input->post('maj_opt_subj'),
                                                    'updated_on'                =>  date('Y-m-d H:i:s'),
                                                    'updated_by'                =>  $this->auth_user_id,
                                                    );
                                 $result8    = $this->mcommon->common_insert('hr_emp_educational_details', $EduData);
                            }
                        }

                        foreach ($department_idArr as $key => $value) 
                        {
                            $historydata= array(
                                                'department_id'             =>  $department_idArr[$key],
                                                'designation_id'            =>  $designation_idArr[$key],
                                                'branch_id'                 =>  $branch_idArr[$key],
                                                'from_date'                 =>  date('Y-m-d', strtotime($from_dateArr[$key])),
                                                'to_date '                  =>  date('Y-m-d', strtotime($to_dateArr[$key])),
                                                'updated_on'                =>  date('Y-m-d H:i:s'),
                                                'updated_by'                =>  $this->auth_user_id,
                                            );
                            if($historycompanyArr[$key] != '')
                            {
                                $where_array8  = array('emp_history_in_company_id' => $historycompanyArr[$key]);
                                $result9    = $this->mcommon->common_edit('hr_emp_history_in_company', $historydata,$where_array8);
                            }else
                            {
                                $historydata= array(
                                                'employee_id'               => $this->input->post('employee_id'),
                                                'department_id'             =>  $department_idArr[$key],
                                                'designation_id'            =>  $designation_idArr[$key],
                                                'branch_id'                 =>  $branch_idArr[$key],
                                                'from_date'                 =>  date('Y-m-d', strtotime($from_dateArr[$key])),
                                                'to_date '                  =>  date('Y-m-d', strtotime($to_dateArr[$key])),
                                                'updated_on'                =>  date('Y-m-d H:i:s'),
                                                'updated_by'                =>  $this->auth_user_id,
                                            );
                                 $result10    = $this->mcommon->common_insert('hr_emp_history_in_company', $historydata);
                            }
                        }                    

                        foreach ($company_nameArr as $key => $value) 
                        {
                            $ExternalData = array(
                                                'company_name'              =>  $company_nameArr[$key],
                                                'designation'               =>  $designationArr[$key],
                                                'salary'                    =>  $salaryArr[$key],
                                                'address'                   =>  $addressArr[$key],
                                                'contact'                   =>  $contactArr[$key],
                                               'total_experience'           =>  $total_experienceArr[$key],
                                                'updated_on'                =>  date('Y-m-d H:i:s'),
                                                'updated_by'                =>  $this->auth_user_id,
                                            );
                            if($ExternalhistoryArr[$key] != '')
                            {
                                $where_array11  = array('emp_external_work_experience_id' => $ExternalhistoryArr[$key]);
                                 $result13   = $this->mcommon->common_edit('hr_emp_external_work_experience', $ExternalData,
                                $where_array11);
                            }else
                            {
                                $ExternalData = array(
                                                'employee_id'               => $this->input->post('employee_id'),
                                                'company_name'              =>  $company_nameArr[$key],
                                                'designation'               =>  $designationArr[$key],
                                                'salary'                    =>  $salaryArr[$key],
                                                'address'                   =>  $addressArr[$key],
                                                'contact'                   =>  $contactArr[$key],
                                               'total_experience'           =>  $total_experienceArr[$key],
                                                'updated_on'                =>  date('Y-m-d H:i:s'),
                                                'updated_by'                =>  $this->auth_user_id,
                                            );
                                $result14   = $this->mcommon->common_insert('hr_emp_external_work_experience', $ExternalData,
                                $where_array11);
                            }
                        }

                        $data11     = array(
                                             'reports_to'                => $this->input->post('reports_to'),
                                            'leave_approver_id'         => $this->input->post('leave_approver_id'),
                                            'updated_on'                => date('Y-m-d H:i:s'),
                                            'updated_by'                => $this->auth_user_id,
                                            );
                        $result15   = $this->mcommon->common_edit('hr_emp_organization_profile', $data11,$where_array);
                    }

                    if($this->input->post('employee_status_id') == '2')
                    {
                        $checkExist = $this->mcommon->specific_record_counts('hr_emp_exit',$where_array);

                        if($checkExist == '')
                        {
                            $data9      = array(
                                                'employee_id'                   => $this->input->post('employee_id'),
                                                'reason_for_leaving'            => $this->input->post('reason_for_leaving'),
                                                'resignation_letter_date'       => date('Y-m-d', strtotime($this->input->post('resignation_letter_date'))),
                                                'relieving_date'                => date('Y-m-d', strtotime($this->input->post('relieving_date'))),
                                                'employee_leave_en_cashed_id'   => $this->input->post('employee_leave_en_cashed_id'),
                                                'encashment_date'               => date('Y-m-d', strtotime($this->input->post('encashment_date'))),
                                                'created_on'                    => date('Y-m-d H:i:s'),
                                                'created_by'                    => $this->auth_user_id,
                                                'updated_on'                    => date('Y-m-d H:i:s'),
                                                'updated_by'                    => $this->auth_user_id,
                                               );
                            $result11   = $this->mcommon->common_insert('hr_emp_exit', $data9);

                            $data10     = array(
                                                'employee_id'               => $this->input->post('employee_id'),
                                                'reason_for_resignation'    =>  $this->input->post('reason_for_resignation'),
                                                'held_on'                   =>  date('Y-m-d', strtotime($this->input->post('held_on'))),
                                                'new_workplace'             =>  $this->input->post('new_workplace'),
                                                'feedback'                  =>  $this->input->post('feedback'),
                                                'created_on'                => date('Y-m-d H:i:s'),
                                                'created_by'                => $this->auth_user_id,
                                                'updated_on'                => date('Y-m-d H:i:s'),
                                                'updated_by'                => $this->auth_user_id,
                                               );
                            $result12   = $this->mcommon->common_insert('hr_emp_exit_interview', $data10, $where_array);
                        }
                        else
                        {
                            $data9      = array(
                                                'reason_for_leaving'            => $this->input->post('reason_for_leaving'),
                                                'resignation_letter_date'       => date('Y-m-d', strtotime($this->input->post('resignation_letter_date'))),
                                                'relieving_date'                => date('Y-m-d', strtotime($this->input->post('relieving_date'))),
                                                'employee_leave_en_cashed_id'   => $this->input->post('employee_leave_en_cashed_id'),
                                                'encashment_date'               => date('Y-m-d', strtotime($this->input->post('encashment_date'))),
                                                'updated_on'                    => date('Y-m-d H:i:s'),
                                                'updated_by'                    => $this->auth_user_id,
                                               );
                            $result11   = $this->mcommon->common_edit('hr_emp_exit', $data9, $where_array);
                            
                            $data10     = array(
                                                'reason_for_resignation'    =>  $this->input->post('reason_for_resignation'),
                                                'held_on'                   =>  date('Y-m-d', strtotime($this->input->post('held_on'))),
                                                'new_workplace'             =>  $this->input->post('new_workplace'),
                                                'feedback'                  =>  $this->input->post('feedback'),
                                                'updated_on'                => date('Y-m-d H:i:s'),
                                                'updated_by'                => $this->auth_user_id,
                                               );
                            $result12   = $this->mcommon->common_edit('hr_emp_exit_interview', $data10, $where_array);
                        }
                    }

                    if($result || $result2 || $result3 || $result4 || $result5 || $result6 || $result7 || $result8 || $result9 || $result10 || $result11 || $result12 || $result13 || $result14)
                    {
                        $this->session->set_flashdata('msg', 'Updated Successfully');
                        $this->session->set_flashdata('alertType', 'success');
                        redirect(base_url('hr/Employee_attendance/Employee/'));
                    }
                    else
                    {
                        $this->session->set_flashdata('msg', 'No data has been changed');
                        $this->session->set_flashdata('alertType', 'danger');
                        redirect(base_url('hr/Employee_attendance/Employee/'));
                    }
                }
                $isFormLoad = FALSE;
            } 
        }

        if($isFormLoad)
        {
            $Data['dropdownUrl']          = 'setting/Master_settings/Naming_series/ajaxLoadForm';
            $Data['SalutationUrl']        = 'hr/Setup/Salutation/ajaxLoadForm';
            $Data['CompanyUrl']           = 'setting/Master_settings/Company/ajaxLoadForm';
            $Data['EmploymentTypeUrl']    = 'hr/Setup/Employment_type/ajaxLoadForm';
            $Data['HolidayListeUrl']      = 'hr/Leaves_holiday/Holiday_list/ajaxLoadForm';
            $Data['DepartmentUrl']        = 'hr/Setup/Department/ajaxLoadForm';
            $Data['DesignationUrl']       = 'hr/Setup/Designation/ajaxLoadForm';
            $Data['BranchUrl']            = 'hr/Setup/Branch/ajaxLoadForm';
            $Data['SclcontentUrl']        = 'hr/Employee_attendance/Employee/ajaxDetailContent';
            $Data['EducontentUrl']        = 'hr/Employee_attendance/Employee/ajaxWorkDetailContent';
            $Data['ActionUrl']            = 'hr/Employee_attendance/Employee/ajaxLoadForm';
            $Data['contentUrl']           = 'setting/modules/Users/ajaxLoadForm';

            $view_data                      = array(
                                                    'form_heading'      => $this->lang->line('employee_form_title'),
                                                    //'form_title'        => $this->lang->line('employee_form_title'),
                                                    //'form_description'  => $this->lang->line('employee_form_description'),
                                                    'form_view'         =>  $this->load->view('hr/Employee_attendance/form/Employee_form', $Data,TRUE),            
                                                    );

            $template_view = array(
                                    'title'     =>  'MEP - '.$this->lang->line('employee_form_heading'),
                                    'content'   =>  $this->load->view('base_template', $view_data,TRUE)
                                  );

            $this->load->view($this->dbvars->app_template, $template_view);
        }
    }

    public function edit($employee_id)
    {
        $constraint_array           = array('employee_id'   =>   $employee_id);
        $Data['tableData']          = $this->mcommon->records_all('hr_employee', $constraint_array);
        $Data['EmployeeContent']    = $this->mcommon->records_all('hr_emp_employment_details', $constraint_array);
        $Data['jobprofileContent']  = $this->mcommon->records_all('hr_emp_job_profile', $constraint_array);
        $Data['contactContent']     = $this->mcommon->records_all('hr_emp_contact_details', $constraint_array);
        $Data['bankcontent']        = $this->mcommon->records_all('hr_emp_bank_details', $constraint_array);
        $Data['InsuranceContent']   = $this->mcommon->records_all('hr_emp_insurance', $constraint_array);
        $Data['PersonalContent']    = $this->mcommon->records_all('hr_emp_personal_details', $constraint_array);
        $Data['EducationContent']   = $this->mcommon->records_all('hr_emp_educational_details', $constraint_array);
        $Data['histroyContent']     = $this->mcommon->records_all('hr_emp_history_in_company', $constraint_array);
        $Data['ExternalContent']    = $this->mcommon->records_all('hr_emp_external_work_experience', $constraint_array);
        $Data['UserContent']        = $this->mcommon->records_all('hr_emp_organization_profile', $constraint_array);
        $Data['exitContent']        = $this->mcommon->records_all('hr_emp_exit', $constraint_array);
        $Data['exitInvContent']     = $this->mcommon->records_all('hr_emp_exit_interview', $constraint_array);        

        $Data['dropdownUrl']          = 'setting/Master_settings/Naming_series/ajaxLoadForm';
        $Data['SalutationUrl']        = 'hr/Setup/Salutation/ajaxLoadForm';
        $Data['CompanyUrl']           = 'setting/Master_settings/Company/ajaxLoadForm';
        $Data['EmploymentTypeUrl']    = 'hr/Setup/Employment_type/ajaxLoadForm';
        $Data['HolidayListeUrl']      = 'hr/Leaves_holiday/Holiday_list/ajaxLoadForm';
        $Data['DepartmentUrl']        = 'hr/Setup/Department/ajaxLoadForm';
        $Data['DesignationUrl']       = 'hr/Setup/Designation/ajaxLoadForm';
        $Data['BranchUrl']            = 'hr/Setup/Branch/ajaxLoadForm';
        $Data['SclcontentUrl']        = 'hr/Employee_attendance/Employee/ajaxDetailContent';
        $Data['EducontentUrl']        = 'hr/Employee_attendance/Employee/ajaxWorkDetailContent';
        $Data['ActionUrl']            = 'hr/Employee_attendance/Employee/ajaxLoadForm';
        $Data['contentUrl']           = 'setting/modules/Users/ajaxLoadForm';

        $view_data                    =     array(
                                                    'form_heading'      => $this->lang->line('employee_form_title'),
                                                    //'form_title'        => $this->lang->line('employee_form_title'),
                                                    //'form_description'  => $this->lang->line('employee_form_description'),
                                                    //'list_heading'      => $this->lang->line('employee_form_heading'),
                                                    //'list_title'        => $this->lang->line('employee_form_title'),
                                                    //'list_description'  => $this->lang->line('employee_form_description'),
                                                    );

        $view_data['form_view']       =     $this->load->view('hr/Employee_attendance/form/Employee_form', $Data, TRUE);
        $data = array(
                        'title'     =>  'MEP - Edit Employee',
                        'content'   =>  $this->load->view('base_template', $view_data,TRUE)
                     );
        $this->load->view($this->dbvars->app_template, $data);
    }

    public function delete($employee_id)
    {
        $data       = array(
                              'is_delete'  => 1,
                              'updated_by' => $this->auth_user_id
                           );
        $where_array        = array('employee_id'  =>$employee_id );
       
        $result     = $this->mcommon->common_edit('hr_employee', $data, $where_array);
        $result1    = $this->mcommon->common_edit('hr_emp_employment_details', $data, $where_array);
        $result2    = $this->mcommon->common_edit('hr_emp_job_profile', $data, $where_array);
        $result3    = $this->mcommon->common_edit('hr_emp_contact_details', $data, $where_array);
        $result4    = $this->mcommon->common_edit('hr_emp_bank_details', $data, $where_array);
        $result5    = $this->mcommon->common_edit('hr_emp_insurance', $data, $where_array);
        $result6    = $this->mcommon->common_edit('hr_emp_personal_details', $data, $where_array);
        $result7    = $this->mcommon->common_edit('hr_emp_educational_details', $data, $where_array);
        $result8    = $this->mcommon->common_edit('hr_emp_history_in_company', $data, $where_array);
        $result9    = $this->mcommon->common_edit('hr_emp_external_work_experience', $data, $where_array);
        $result10   = $this->mcommon->common_edit('hr_emp_organization_profile', $data, $where_array);
        $result11   = $this->mcommon->common_edit('hr_emp_exit_interview', $data, $where_array);
        $result12   = $this->mcommon->common_edit('hr_emp_exit', $data, $where_array);

        if($result10)
        {
          //Session for Delete
          $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
          $this->session->set_flashdata('alertType', 'success');
          redirect(base_url('hr/Employee_attendance/Employee/'));
        }
    }

    public function datatable()
    {
        //Datatable Create
        $this->datatables->select('a.employee_id, a.employee_number ,a.employee_name, sc.company_name, es.employee_status_id, a.updated_on, CONCAT(up.first_name, " ", up.last_name)')
        ->from('hr_employee as a')
        ->where('a.is_delete', '0')
        ->join('user_profile as up', 'up.user_id = a.updated_by')    
        ->join('hr_emp_employment_details as ed', 'ed.employee_id = a.employee_id')     
        ->join('def_hr_employee_status as es', 'es.employee_status_id = ed.employee_status_id')
        ->join('set_company as sc', 'sc.company_id = a.company_id')


        ->edit_column('a.employee_id', get_ajax_buttons_page_form('$1', 'hr/Employee_attendance/Employee/'), 'a.employee_id');
        $this->db->group_by('a.employee_id');
        $this->db->order_by('a.updated_on',DESC);
        //  $this->datatables->edit_column('a.disabled', '$1', 'get_disable_employee_status_id(a.disabled)');
        $this->datatables->edit_column('a.updated_on', '$1', 'get_date_timeformat(a.updated_on)');
        // $this->datatables->unset_column('s_no');
        $this->datatables ->edit_column('es.employee_status_id', '$1', 'employeeStatus(es.employee_status_id)');
        echo $this->datatables->generate();  
    }

    public function ajaxDetailContent($Data = array())
    {
        $isFormLoad = TRUE;

        if(!empty($_POST))
        {
           
          //This will convert the string to array
          parse_str($_POST['postdata'], $_POST);

          //Checking Form Validation
            $this->form_validation->set_rules('employee_name', lang('label_branch'), 'required|trim');
            $this->form_validation->set_rules('employee_status_id', lang('label_employee_Status'), 'required|trim');

            if($this->form_validation->run() == TRUE) 
            {
                //Insert if not id's are given

                $naming         = $this->input->post('naming_series');       
                $namingSeries   = $this->mcommon->generateSeries($naming,3);
                
             
                if($this->input->post('emp_educational_details_id') == "")
                {
                    $EduData      = array(
                                        'employee_id'               =>  $result,
                                        'qualification'             =>  $this->input->post('qualification'),
                                        'school_university'         =>  $this->input->post('school_university'),
                                        'employee_level_id'         =>  $this->input->post('employee_level_id'),
                                        'year_of_passing'           =>  $this->input->post('year_of_passing'),
                                      //'class_per'                 =>  $this->input->post('class_per'),
                                      //'maj_opt_subj'              =>  $this->input->post('maj_opt_subj'),
                                        'created_on'               => date('Y-m-d H:i:s'),
                                        'updated_on'                => date('Y-m-d H:i:s'),
                                        'created_by'                => $this->auth_user_id,
                                        'updated_by'                => $this->auth_user_id,
                                        );
                    $result    = $this->mcommon->common_insert('hr_emp_educational_details', $EduData);
                      if($result)
                      {
                        $this->session->set_flashdata('msg', 'Saved Successfully');
                        $this->session->set_flashdata('alertType', 'success');
                        $ajaxResponse['result'] = 'success';
                      }
                }
                //Edit function calling
                else
                {   
                     $where_array  = array('emp_educational_details_id' =>    $this->input->post('emp_educational_details_id'));
                   
                    $data      = array(
                                        'qualification'             =>  $this->input->post('qualification'),
                                        'school_university'         =>  $this->input->post('school_university'),
                                        'employee_level_id'         =>  $this->input->post('employee_level_id'),
                                        'year_of_passing'           =>  $this->input->post('year_of_passing'),
                                        //'class_per'               =>  $this->input->post('class_per'),
                                      //  'maj_opt_subj'            =>  $this->input->post('maj_opt_subj'),
                                         'created_on'               => date('Y-m-d H:i:s'),
                                        'updated_on'                => date('Y-m-d H:i:s'),
                                        'created_by'                => $this->auth_user_id,
                                        'updated_by'                => $this->auth_user_id,
                                       );
                    $result7    = $this->mcommon->common_edit('hr_emp_educational_details', $data,$where_array);

                  
                  if($result)
                  {
                    $this->session->set_flashdata('msg', 'Updated Successfully');
                    $this->session->set_flashdata('alertType', 'success');
                    $ajaxResponse['result'] = 'success';
                  }
                  else
                  {
                    $this->session->set_flashdata('msg', 'No data has been changed');
                    $this->session->set_flashdata('alertType', 'danger');
                    $ajaxResponse['result'] = 'success';
                  }
                }
            $isFormLoad = FALSE;
            echo json_encode($ajaxResponse);
            } 
        }

        if($isFormLoad)
        {
          //Get data from table for edit the data
          if($this->input->get('pkey_id') != '')
          {
            $constraint_array           = array('employee_id'  =>   $this->input->get('pkey_id'));
            $Data['EducationContent']   = $this->mcommon->records_all('hr_emp_educational_details', $constraint_array);
          }

          //Ajax Form Load
          $Data['ActionUrl']            = 'hr/Employee_attendance/Employee/ajaxDetailContent';

          $this->load->view('hr/Employee_attendance/form/ajax_form/employee_school_details_form', $Data);
        }
    }

    public function ajaxWorkDetailContent($Data = array())
    {
        $isFormLoad = TRUE;

        if(!empty($_POST))
        {
           
          //This will convert the string to array
          parse_str($_POST['postdata'], $_POST);

          //Checking Form Validation
            $this->form_validation->set_rules('employee_name', lang('label_branch'), 'required|trim');
            $this->form_validation->set_rules('employee_status_id', lang('label_employee_Status'), 'required|trim');

            if($this->form_validation->run() == TRUE) 
            {
                //Insert if not id's are given

                $naming         = $this->input->post('naming_series');       
                $namingSeries   = $this->mcommon->generateSeries($naming,3);
                
             
                if($this->input->post('emp_educational_details_id') == "")
                {
                    $EduData      = array(
                                        'employee_id'               =>  $result,
                                        'qualification'             =>  $this->input->post('qualification'),
                                        'school_university'         =>  $this->input->post('school_university'),
                                        'employee_level_id'         =>  $this->input->post('employee_level_id'),
                                        'year_of_passing'           =>  $this->input->post('year_of_passing'),
                                      //'class_per'                 =>  $this->input->post('class_per'),
                                      //'maj_opt_subj'              =>  $this->input->post('maj_opt_subj'),
                                        'created_on'               => date('Y-m-d H:i:s'),
                                        'updated_on'                => date('Y-m-d H:i:s'),
                                        'created_by'                => $this->auth_user_id,
                                        'updated_by'                => $this->auth_user_id,
                                        );
                    $result    = $this->mcommon->common_insert('hr_emp_educational_details', $EduData);
                      if($result)
                      {
                        $this->session->set_flashdata('msg', 'Saved Successfully');
                        $this->session->set_flashdata('alertType', 'success');
                        $ajaxResponse['result'] = 'success';
                      }
                }
                //Edit function calling
                else
                {   
                     $where_array  = array('emp_educational_details_id' =>    $this->input->post('emp_educational_details_id'));
                   
                    $data      = array(
                                        'qualification'             =>  $this->input->post('qualification'),
                                        'school_university'         =>  $this->input->post('school_university'),
                                        'employee_level_id'         =>  $this->input->post('employee_level_id'),
                                        'year_of_passing'           =>  $this->input->post('year_of_passing'),
                                        //'class_per'               =>  $this->input->post('class_per'),
                                      //  'maj_opt_subj'            =>  $this->input->post('maj_opt_subj'),
                                         'created_on'               => date('Y-m-d H:i:s'),
                                        'updated_on'                => date('Y-m-d H:i:s'),
                                        'created_by'                => $this->auth_user_id,
                                        'updated_by'                => $this->auth_user_id,
                                       );
                    $result7    = $this->mcommon->common_edit('hr_emp_educational_details', $data,$where_array);

                  
                  if($result)
                  {
                    $this->session->set_flashdata('msg', 'Updated Successfully');
                    $this->session->set_flashdata('alertType', 'success');
                    $ajaxResponse['result'] = 'success';
                  }
                  else
                  {
                    $this->session->set_flashdata('msg', 'No data has been changed');
                    $this->session->set_flashdata('alertType', 'danger');
                    $ajaxResponse['result'] = 'success';
                  }
                }
            $isFormLoad = FALSE;
            echo json_encode($ajaxResponse);
            } 
        }

        if($isFormLoad)
        {
          //Get data from table for edit the data
          if($this->input->get('pkey_id') != '')
          {
            $constraint_array           = array('employee_id'  =>   $this->input->get('pkey_id'));
            $Data['EducationContent']   = $this->mcommon->records_all('hr_emp_educational_details', $constraint_array);
          }

          //Ajax Form Load
          $Data['ActionUrl']            = 'hr/Employee_attendance/Employee/ajaxWorkDetailContent';

          $this->load->view('hr/Employee_attendance/form/ajax_form/work_experience_details_form', $Data);
        }
    }

    public function genreteEmployeeId()
    {
        $naming_series_id     =  $this->input->post('naming_series_id');  
        $namingSeries         =  $this->mcommon->generateSeries($naming_series_id, 3);
        echo $namingSeries;
    }
}