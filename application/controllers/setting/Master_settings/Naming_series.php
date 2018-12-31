<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Naming_series extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->is_logged_in();

		$this->load->model("menu_model", "menu");
		$items = $this->menu->all();
		$this->load->library("multi_menu");
    $this->lang->load("validation_lang","english");
		$this->load->library("form_validation");
		$this->multi_menu->set_items($items);
		$this->lang->load("setting","english");
  } 	

	public function index($Data=array())
  {
    if( $this->acl_permits('setting.naming_series') )
    {
      //Redirect
      $view_data = array(
                          'form_heading'      => $this->lang->line('naming_series_form_heading'),
                          'form_title'        => $this->lang->line('naming_series_form_title'),
                          //'form_description'  => $this->lang->line('naming_series_description'),
                          //'list_heading'      => $this->lang->line('naming_series_form_heading'),
                          //'list_title'        => $this->lang->line('naming_series_form_title'),
                          'list_description'  => $this->lang->line('naming_series_description'),
                          'formUrl'           => 'setting/Master_settings/Naming_series/ajaxLoadForm',
                          'list_view'         => TRUE,
                          'buttonview'        => TRUE
                      );

      $tmpl     = array ( 'table_open'  => '<table id="dataTableId" cellpadding="2" cellspacing="1" class="table table-striped">' );
      $this->table->set_template($tmpl); 
      $this->table->set_heading('Action', 'Transaction', 'Series List for this Transaction', 'Series', 'Value', 'Last Update', 'Updated by');

      $view_data['dataTableUrl']    =   'setting/Master_settings/Naming_series/datatable';
      $data                         = array(
                                  'title'     =>  'MEP - '.$this->lang->line('naming_series_form_heading'),
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
      $this->form_validation->set_rules('set_options', lang('label_series_list'), 'required');
      $this->form_validation->set_rules('transaction_id', lang('label_select_transaction'), 'required');
      $this->form_validation->set_rules('prefix_id', lang('label_Prefix'), 'required');
      $this->form_validation->set_rules('current_value', lang('label_Current_Value'), 'required');

      if($this->form_validation->run() == TRUE) 
      {
        //Insert if not id's are given
        if($this->input->post('naming_series_id') == "")
        {
          $data     = array(
                              'transaction_id'              => $this->input->post('transaction_id'),
                              'set_options'                 => $this->input->post('set_options'), 
                              'user_must_always_select'     => ($this->input->post('user_must_always_select')) ? '1' : '0',
                              'prefix_id'                   => $this->input->post('prefix_id'),
                              'current_value'               => $this->input->post('current_value'),   
                              'created_on'                  => date('Y-m-d H:i:s'),
                              'updated_on'                  => date('Y-m-d H:i:s'),
                              'created_by'                  => $this->auth_user_id,
                              'updated_by'                  => $this->auth_user_id
                            );
          $result   = $this->mcommon->common_insert('set_naming_series', $data);

          if($result)
          {
            $this->session->set_flashdata('msg', 'Saved Successfully');
            $this->session->set_flashdata('alertType', 'success');
            //redirect(base_url('setting/Printing_settings/Printing_heading/add'));
            $ajaxResponse['result'] = 'success';
          }
        }
        //Edit function calling
        else
        {
          $data     = array(
                              'transaction_id'              => $this->input->post('transaction_id'),
                              'set_options'                 => $this->input->post('set_options'), 
                              'user_must_always_select'     => ($this->input->post('user_must_always_select')) ? '1' : '0',
                              'prefix_id'                   => $this->input->post('prefix_id'),
                              'current_value'               => $this->input->post('current_value'),   
                              'updated_on'                  => date('Y-m-d H:i:s'),
                              'updated_by'                  => $this->auth_user_id
                            );
          $where_array  = array('naming_series_id'  =>$this->input->post('naming_series_id'));
          $result       = $this->mcommon->common_edit('set_naming_series', $data, $where_array);

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
        $constraint_array   = array('naming_series_id'   =>   $pkey_id);
        $Data['tableData']  = $this->mcommon->records_all('set_naming_series', $constraint_array);
      }

      //Ajax Form Load
      $Data['ActionUrl']   =  'setting/Master_settings/Naming_series/ajaxLoadForm';
      $this->load->view('setting/Master_settings/form/Naming_series_form', $Data);
    }
  }

  public function delete($naming_series_id)
  {
    $data       = array(
                  'is_delete'  => 1,
                  'updated_by' => $this->auth_user_id
                   );
    $where_array  = array('naming_series_id'  =>$naming_series_id);
    $result     = $this->mcommon->common_edit('set_naming_series', $data, $where_array);

    if($result)
    {
      //Session for Delete
      $msg = $this->session->set_flashdata('msg', 'Successfully Deleted !!!');
      $this->session->set_flashdata('alertType', 'success');
      redirect(base_url('setting/Master_settings/Naming_series/'));
    }
  }

  public function datatable()
  {
    $this->datatables->select('ns.naming_series_id, nt.transaction, ns.set_options, np.prefix, ns.current_value, ns.updated_on, CONCAT(up.first_name, " ", up.last_name)')
    ->from('set_naming_series AS ns')
    ->join('naming_transaction as nt', 'nt.transaction_id = ns.transaction_id', 'left')
    ->join('naming_prefix as np', 'np.prefix_id = ns.prefix_id', 'left')
    ->join('user_profile as up', 'up.user_id = ns.updated_by', 'left')
    ->where('ns.is_delete', '0')
    ->edit_column('ns.naming_series_id', get_ajax_buttons('$1', 'setting/Master_settings/Naming_series/'), 'ns.naming_series_id');
    $this->db->order_by('ns.updated_on',DESC);
    $this->datatables->edit_column('ns.updated_on', '$1', 'get_date_timeformat(ns.updated_on)');
    echo $this->datatables->generate();
  }
}