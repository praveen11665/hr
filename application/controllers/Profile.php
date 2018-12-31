<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');

	}

    function index()
    {

      	if($this->acl_permits('account.view_self_profile'))
  		  {

    			$view_data['login_data']=$this->auth_data;
    			$view_data['profile_data']=$this->auth_data->profile_data;
    			$view_data['contact_data']=$this->auth_data->contact_data;
    			$view_data['address_data']=$this->auth_data->address_data;
    			$data = array(
    	            	    'title'     => 	$this->lang->line('profile_title'),
    	                	'content'   =>	$this->load->view('account/view_profile',$view_data,TRUE)
    	                );
    		}
    		else
    		{
    			redirect(base_url(),'refresh');
    		}
		    $this->load->view($this->dbvars->app_template, $data);

    }

    public function view($user_id)
    {
    	if($this->acl_permits('account.view_others_profile'))
		{

		}
		else
		{

		}
		$this->load->view($this->dbvars->app_template, $data);
    }
}
