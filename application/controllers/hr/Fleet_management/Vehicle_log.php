<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vehicle_log extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->lang->load("validation_lang","english");
    $this->load->helper('url');
    $this->load->helper('form');
    $this->is_logged_in();
    $this->load->model("menu_model", "menu");
    $items = $this->menu->all();
    $this->load->library("multi_menu");
    $this->multi_menu->set_items($items);
    $this->lang->load("hr","english");
    $this->load->library("form_validation");    
  }

  public function index($Data=array())
  {
    if( $this->acl_permits('HR.vehicle_log') )
    {
      //Redirect
      $view_data = array(
                          'form_heading'      => $this->lang->line('Vehicle_log_form_heading'),
                          'form_title'        => $this->lang->line('Vehicle_log_form_title'),
                          'form_description'  => $this->lang->line('Vehicle_log_form_description'),
                          'list_heading'      => $this->lang->line('Vehicle_log_form_heading'),
                          'list_title'        => $this->lang->line('Vehicle_log_form_title'),
                          'list_description'  => $this->lang->line('Vehicle_log_form_description'),
                          'formUrl'           => 'hr/Fleet_management/Vehicle_log/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'        => TRUE,
                        );

      $tmpl = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Employee','Vehicle', 'Last Update', 'Updated by');

      $view_data['dataTableUrl']   =   'hr/Fleet_management/Vehicle_log/datatable';
      $data = array(
                      'title'     =>  'MEP - '.$this->lang->line('Vehicle_log_form_heading'),
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

     
      $naming                          = $this->input->post('naming_series');       
      $namingSeries                    = $this->mcommon->generateSeries($naming,1);

      $vehicle_log_service_details_idArr  = $this->input->post('vehicle_log_service_details_id');
      $vehicle_log_service_item_idArr     = $this->input->post('vehicle_log_service_item_id');
      $vehicle_log_service_type_idArr     = $this->input->post('vehicle_log_service_type_id');
      $vehicle_log_frquency_idArr         = $this->input->post('vehicle_log_frquency_id');
      $expense_amountArr                  = $this->input->post('expense_amount');
      
      //$this->form_validation->set_rules('naming_series_id', lang('label_series'), 'trim|required');
      $this->form_validation->set_rules('vehicle_id', lang('label_vehicle'), 'trim|required');
      $this->form_validation->set_rules('employee_id', lang('label_employee_id'), 'trim|required');
      //$this->form_validation->set_rules('vehicle_log_service_item_id[]', lang('label_service_item'), 'trim|required');
      //$this->form_validation->set_rules('expense_amount[]', lang('label_expense_amount'), 'trim|required');
      /*foreach ($vehicle_log_frquency_idArr as $key => $value) 
      {
        $this->form_validation->set_rules('vehicle_log_service_item_id['.$key.']', lang('label_service_item'), 'trim|required');
      }*/

      if($this->form_validation->run() == TRUE) 
      {
          //Insert if not id's are given
          if($this->input->post('vehicle_log_id') == "")
          {
            $data     = array(
                                'naming_series'    =>  $namingSeries,
                                'vehicle_id'       => $this->input->post('vehicle_id'),
                                'employee_id'      => $this->input->post('employee_id'),
                                'model'            => $this->input->post('model'),
                                'make'             => $this->input->post('make'),
                                'date'             => date('Y-m-d', strtotime($this->input->post('date'))),
                                'odometer'         => $this->input->post('odometer'),
                                'created_on'       => date('Y-m-d H:i:s'),
                                'created_by'       => $this->auth_user_id,
                                'updated_on'       => date('Y-m-d H:i:s'),
                                'updated_by'       => $this->auth_user_id
                              );          
            $this->db->trans_start();
            $result   = $this->mcommon->common_insert('hr_vehicle_log', $data);
            $where_array  = array('transaction_id' => 1);

            if($result)
            {
              $resultupdate = $this->mcommon->dataUpdate('set_naming_series', 'current_value', $where_array); 
            }

            foreach ($vehicle_log_service_item_idArr as $key => $value) 
            {
              $data1    = array(
                                 'vehicle_log_id'               => $result,
                                 'vehicle_log_service_item_id'  => $vehicle_log_service_item_idArr[$key],
                                 'vehicle_log_service_type_id'  => $vehicle_log_service_type_idArr[$key],
                                 'vehicle_log_frquency_id'      => $vehicle_log_frquency_idArr[$key],
                                 'expense_amount'               => $expense_amountArr[$key],
                                            
                                );
              $result1  = $this->mcommon->common_insert('hr_vehicle_log_service_details', $data1);

            }
            $this->db->trans_complete();

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
            $data         = array(
                                  'vehicle_id'       => $this->input->post('vehicle_id'),
                                  'employee_id'      => $this->input->post('employee_id'),
                                  'model'            => $this->input->post('model'),
                                  'make'             => $this->input->post('make'),
                                  'date'             => date('Y-m-d', strtotime($this->input->post('date'))),
                                  'odometer'         => $this->input->post('odometer'),
                                  'updated_on'       => date('Y-m-d H:i:s'),
                                  'updated_by'       => $this->auth_user_id
                                );
            $where_array  = array('vehicle_log_id'  =>$this->input->post('vehicle_log_id'));

            $this->db->trans_start();
            $result       = $this->mcommon->common_edit('hr_vehicle_log', $data, $where_array); 
            
            foreach ($expense_amountArr as $key => $value) 
            {
              $data1    = array(
                                 'vehicle_log_service_item_id'  => $vehicle_log_service_item_idArr[$key],
                                 'vehicle_log_service_type_id'  => $vehicle_log_service_type_idArr[$key],
                                 'vehicle_log_frquency_id'      => $vehicle_log_frquency_idArr[$key],
                                 'expense_amount'               => $expense_amountArr[$key],
                                            
                                );
              if($vehicle_log_service_details_idArr[$key] != '')
              {
                  $where_array1  = array('vehicle_log_service_details_id'  => $vehicle_log_service_details_idArr[$key]);
                  $result1  = $this->mcommon->common_edit('hr_vehicle_log_service_details',$data1,$where_array1);
              }else
              {
                $data2    = array(
                                 'vehicle_log_id'               =>$this->input->post('vehicle_log_id'),
                                 'vehicle_log_service_item_id'  => $vehicle_log_service_item_idArr[$key],
                                 'vehicle_log_service_type_id'  => $vehicle_log_service_type_idArr[$key],
                                 'vehicle_log_frquency_id'      => $vehicle_log_frquency_idArr[$key],
                                 'expense_amount'               => $expense_amountArr[$key],
                                            
                                );
                $result2  = $this->mcommon->common_insert('hr_vehicle_log_service_details',$data2);
              }  
            }
            $this->db->trans_complete();


            if($result || $result1 || $result2 )
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
        $constraint_array     = array('vehicle_log_id'   =>   $pkey_id);
        $Data['tableData']    = $this->mcommon->records_all('hr_vehicle_log', $constraint_array);
        $Data['contentData']  = $this->mcommon->records_all('hr_vehicle_log_service_details', $constraint_array);
      }
      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Fleet_management/Vehicle_log/ajaxLoadForm';
      $Data['contentUrl']  =   'hr/Fleet_management/Vehicle_log/ajaxTableContentForm';
      $this->load->view('hr/Fleet_management/form/Vehicle_log_form', $Data);
    }
  }

  public function delete($vehicle_log_id)
  {
    $where_array  = array('vehicle_log_id'  =>$vehicle_log_id);
    $this->db->trans_start();
    $result       = $this->mcommon->common_delete('hr_vehicle_log', $where_array);
    $result1      = $this->mcommon->common_delete('hr_vehicle_log_service_details', $where_array);
    $this->db->trans_complete();

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('hr/Fleet_management/Vehicle_log/'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('v.vehicle_log_id, he.employee_name,hv.registration_number,v.updated_on,CONCAT(up.first_name, " ", up.last_name)')
    ->from('hr_vehicle_log AS v')
    ->join('hr_vehicle as hv', 'hv.vehicle_id = v.vehicle_id')
     ->join('user_profile as up', 'up.user_id = v.updated_by')
    ->join('hr_employee as he', 'he.employee_id = v.employee_id')
    ->edit_column('v.vehicle_log_id', get_ajax_buttons('$1', 'hr/Fleet_management/Vehicle_log/'), 'v.vehicle_log_id');
    $this->datatables->edit_column('v.updated_on', '$1', 'get_date_timeformat(v.updated_on)');
    $this->db->order_by('v.updated_on', DESC);
    echo $this->datatables->generate();
  }

  public function ajaxTableContentForm($Data = array())
  {
    $isFormLoad = TRUE;

    if (!empty($_POST)) 
    {
      //This will convert the string to array
      parse_str($_POST['postdata'], $_POST);

      //Checking Form Validation
      $this->form_validation->set_rules('vehicle_log_service_item_id', lang('label_service_item'), 'required');
      $this->form_validation->set_rules('vehicle_log_service_type_id', lang('label_type'), 'required');
      $this->form_validation->set_rules('vehicle_log_frquency_id', lang('label_frequency'), 'required');
      $this->form_validation->set_rules('expense_amount', lang('label_expense_amount'), 'required');

      if ($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('vehicle_log_service_details_id') == "")
        {
          $data     = array(
                             'vehicle_log_service_item_id'   => $this->input->post('vehicle_log_service_item_id'),
                             'vehicle_log_service_type_id'   => $this->input->post('vehicle_log_service_type_id'),
                             'vehicle_log_frquency_id'       => $this->input->post('vehicle_log_frquency_id'),
                             'expense_amount'                => $this->input->post('expense_amount')
                                        
                           );
          $result   = $this->mcommon->common_insert('hr_vehicle_log_service_details', $data);

          if($result)
          {
            $this->session->set_flashdata('msg', 'Saved Successfully');
            $this->session->set_flashdata('alertType', 'success');
            $ajaxResponse['inserted_id']  = $result;
            $where_array                  = array('vehicle_log_service_details_id' => $result);
            /*$get_content                  = $this->mcommon->records_all('hr_vehicle_log_service_details', $where_array);
            $ajaxResponse['all_data']     = $get_content->result_array();*/
            $ajaxResponse['result']       = 'success';


          }
        }
        else
        {
          $data        = array(
                                'vehicle_log_service_item_id'   => $this->input->post('vehicle_log_service_item_id'),
                                'employee_name'                 => $this->input->post('employee_name'),
                                'vehicle_log_frquency_id'       => $this->input->post('vehicle_log_frquency_id'),
                                'expense_amount'                => $this->input->post('expense_amount')
                              );
          $where_array  = array('vehicle_log_service_details_id'  =>$this->input->post('vehicle_log_service_details_id')
                       );
          $result       = $this->mcommon->common_edit('hr_vehicle_log_service_details', $data, $where_array);

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
        $constraint_array   = array('vehicle_log_service_details_id' =>   $this->input->get('pkey_id'));
        $Data['tableData']  = $this->mcommon->records_all('hr_vehicle_log_service_details', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'hr/Fleet_management/Vehicle_log/ajaxTableContentForm';
      $this->load->view('hr/Fleet_management/form/ajax_form/Service_item_form', $Data);
    }
  }

  public function getVehicle()
  {
    $vehicle_id       = $this->input->post('vehicle_id');
    $constraint_array = array('vehicle_id' => $vehicle_id);  
    $resultData       = $this->mcommon->records_all('hr_vehicle', $constraint_array);

    foreach ($resultData as $row) 
    {
      $vehicleData   = $row;
    }
    echo json_encode($vehicleData);
  }
}