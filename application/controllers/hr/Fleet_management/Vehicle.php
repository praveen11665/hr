<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vehicle extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->lang->load("validation_lang","english");
    $this->lang->load("hr","english");
    $this->load->helper('url');
    $this->load->helper('form');
    $this->is_logged_in();
    $this->load->model("menu_model", "menu");
    $items = $this->menu->all();
    $this->load->library("multi_menu");
    $this->load->library("form_validation");
    $this->multi_menu->set_items($items);
  }

  public function index($Data=array())
  {
    if( $this->acl_permits('HR.vehicle') )
    {
      $view_data = array(
                'form_heading'    => $this->lang->line('Vehicle_form_heading'),
                'form_title'      => $this->lang->line('Vehicle_form_title'),
                'form_description'=> $this->lang->line('Vehicle_form_description'),
                'list_heading'    => $this->lang->line('Vehicle_form_heading'),
                'list_title'      => $this->lang->line('Vehicle_form_title'),
                'list_description'=> $this->lang->line('Vehicle_form_description'),
                'formUrl'         => 'hr/Fleet_management/Vehicle/ajaxLoadForm',
                'list_view'       => TRUE,
                'buttonview'      => TRUE
                );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Employee', 'Registration Number', 'Model', 'Vehicle value', 'Location', 'Insurance Company', 'Policy No', 'Last Update', 'Updated by');
      $view_data['dataTableUrl']   =   'hr/Fleet_management/Vehicle/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Vehicle_form_heading'),
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

  public function ajaxLoadForm($pkey_id='')
  {
    $isFormLoad = TRUE;

    if(!empty($_POST))
    {
      //This will convert the string to array
      parse_str($_POST['postdata'], $_POST);
        
        $this->form_validation->set_rules('registration_number', lang('label_registration_number'), 'trim|required');
        $this->form_validation->set_rules('model', lang(''), 'trim|required');
        $this->form_validation->set_rules('odometer_value', lang('label_model'), 'trim|required');
        $this->form_validation->set_rules('chassis_no', lang('label_chassis_no'), 'trim|required');
        $this->form_validation->set_rules('vehicle_value', lang('label_vehicle_value'), 'trim|required');
        $this->form_validation->set_rules('location', lang('label_location'), 'trim|required');
        $this->form_validation->set_rules('insurance_company', lang('label_insurance_company'), 'trim|required');
        $this->form_validation->set_rules('employee_id', lang('label_employee'), 'trim|required');
        //$this->form_validation->set_rules('vehicle_fuel_type_id', lang('label_fuel_type'), 'trim|required');
        //$this->form_validation->set_rules('uom_id', lang('label_fuel_uom'), 'trim|required');
        $this->form_validation->set_rules('policy_no', lang('label_policy_no'), 'trim|required');

        if($this->form_validation->run() == TRUE)
        {
          if($this->input->post('vehicle_id') == "")
          {    
            //insert function without id
           $data   = array(   
                            'registration_number' => $this->input->post('registration_number'),
                            'make'                => $this->input->post('make'),
                            'model'               => $this->input->post('model'),
                            'odometer_value'      => $this->input->post('odometer_value'),
                            'chassis_no'          => $this->input->post('chassis_no'),
                            'acquisition_date'    => date('Y-m-d', strtotime($this->input->post('acquisition_date'))),
                            'vehicle_value'       => $this->input->post('vehicle_value'),
                            'employee_id'         => $this->input->post('employee_id'),                            
                            'location'            => $this->input->post('location'),
                            'insurance_company'   => $this->input->post('insurance_company'),
                            'start_date'          => date('Y-m-d', strtotime($this->input->post('start_date'))),
                            'end_date'            => date('Y-m-d', strtotime($this->input->post('end_date'))),
                            'policy_no'           => $this->input->post('policy_no'),
                            'vehicle_fuel_type_id'=> $this->input->post('vehicle_fuel_type_id'),
                            'color'               => $this->input->post('color'),
                            'wheels'              => $this->input->post('wheels'),
                            'doors'               => $this->input->post('doors'),
                            'carbon_check_date'   => date('Y-m-d', strtotime($this->input->post('carbon_check_date'))),
                            'uom_id'              => $this->input->post('uom_id'),
                            'created_on'          => date('Y-m-d H:i:s'),
                            'updated_on'          => date('Y-m-d H:i:s'),
                            'created_by'          => $this->auth_user_id,
                            'updated_by'          => $this->auth_user_id
                            );           
            $result = $this->mcommon->common_insert('hr_vehicle',$data); 

            if($result)
            {
              $this->session->set_flashdata('msg', 'Saved Successfully');
              $this->session->set_flashdata('alertType', 'success');
              $ajaxResponse['result'] = 'success';
            }
          }
          else
          {
            $data = array(
                            'registration_number' => $this->input->post('registration_number'),
                            'make'                => $this->input->post('make'),
                            'model'               => $this->input->post('model'),
                            'odometer_value'      => $this->input->post('odometer_value'),
                            'chassis_no'          => $this->input->post('chassis_no'),
                            'acquisition_date'    => date('Y-m-d', strtotime($this->input->post('acquisition_date'))),
                            'vehicle_value'       => $this->input->post('vehicle_value'),
                            'employee_id'         => $this->input->post('employee_id'),                            
                            'location'            => $this->input->post('location'),
                            'insurance_company'   => $this->input->post('insurance_company'),
                            'start_date'          => date('Y-m-d', strtotime($this->input->post('start_date'))),
                            'end_date'            => date('Y-m-d', strtotime($this->input->post('end_date'))),
                            'policy_no'           => $this->input->post('policy_no'),
                            'vehicle_fuel_type_id'=> $this->input->post('vehicle_fuel_type_id'),
                            'color'               => $this->input->post('color'),
                            'wheels'              => $this->input->post('wheels'),
                            'doors'               => $this->input->post('doors'),
                            'carbon_check_date'   => date('Y-m-d', strtotime($this->input->post('carbon_check_date'))),
                            'uom_id'              => $this->input->post('uom_id'),
                            'updated_on'          => date('Y-m-d H:i:s'),
                            'updated_by'          => $this->auth_user_id
                         );
            
            $where_array  = array('vehicle_id' =>    $this->input->post('vehicle_id'));
            
            $result=$this->mcommon->common_edit('hr_vehicle',$data,$where_array);
            
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
      if($pkey_id != '')
      {
        $constraint_array   = array('vehicle_id'  =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('hr_vehicle', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Fleet_management/Vehicle/ajaxLoadForm';
      $this->load->view('hr/Fleet_management/form/Vehicle_form', $Data);
    }
  }

  public function delete($vehicleId)
  {
    $where_array  = array('vehicle_id' => $vehicleId);
    $result       = $this->mcommon->common_delete('hr_vehicle', $where_array);
    if($result)
    {
      $msg = $this->session->set_flashdata('msg', 'Deleted Successfully');
      $this->session->set_flashdata('alertType', 'message');
      redirect(base_url('hr/Fleet_management/Vehicle'));
    }                                                 
  }  

  public function datatable()
  {
    $this->datatables->select('hv.vehicle_id, he.employee_name, hv.registration_number, hv.model, hv.vehicle_value, hv.location, hv.insurance_company, hv.policy_no, hv.updated_on, CONCAT(up.first_name, " ", up.last_name)')
    ->from('hr_vehicle as hv')
    ->join('hr_employee as he', 'he.employee_id = hv.employee_id', 'left')
    ->join('user_profile as up', 'up.user_id = hv.updated_by', 'left')
    ->where('hv.is_delete', '0')
    ->edit_column('hv.updated_on', '$1', 'get_date_timeformat(hv.updated_on)')
    ->edit_column('hv.vehicle_id', get_ajax_buttons('$1', 'hr/Fleet_management/Vehicle/'), 'hv.vehicle_id');
    $this->db->order_by('hv.updated_on', DESC);
    echo $this->datatables->generate();  
  }
}