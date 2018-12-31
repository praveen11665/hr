<?php
defined('BASEPATH') or exit('No direct script access allowed');


class App extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Force SSL
		//$this->force_ssl();
		// Form and URL helpers always loaded (just for convenience)
		$this->load->helper('url');
		$this->load->helper('form');
		$this->is_logged_in();
	}

	public function index()
	{
		$this->dbvars->app_name='CloudERP';
		$this->dbvars->phone_number='044-42016123';
		$this->dbvars->app_email='lntecc.productivity@gmail.com';
		$this->dbvars->app_template='base/base_five';
		$this->dbvars->timezone='Asia/Kolkata';
		$this->dbvars->default_currency='61';
		$this->dbvars->default_country='99';
		$this->dbvars->protocol='smtp';
		$this->dbvars->smtp_host='ssl://smtp.gmail.com';
		$this->dbvars->smtp_port='465';
		$this->dbvars->smtp_user='lntecc.productivity@gmail.com';
		$this->dbvars->smtp_pass='lntecc123!@#';
		$this->dbvars->mailtype='html';

		if( $this->require_role('admin') )
		{
			$view_data='';
			$data = array(
		            	    'title'     => 	$this->lang->line('login_page_title'),
		                	'content'   =>	$this->load->view('unauthorized',$view_data,TRUE)
		                );
      		$this->load->view('base/error_template', $data);        
		}
		else
		{
			echo '';
			$view_data='';
			$data = array(
		            	    'title'     => 	$this->lang->line('login_page_title'),
		                	'content'   =>	$this->load->view('unauthorized',$view_data,TRUE)
		                );
      		$this->load->view('base/error_template', $data);        
		}
	}

	public function setup()
	{
		if( $this->require_role('admin') )
		{
			$view_data['editable']=($this->acl_permits('general.settings_setup'))?'readonly':'';
			$view_data['currencies'] = $this->mcommon->records_all('currencies');
			$view_data['countries'] = $this->mcommon->records_all('countries');
			$view_data['configurations']=$this->mcommon->records_all('configuration');

			if(isset($_POST['submit']))
			{
				foreach ($view_data['configurations'] as $key => $value)
				{
					$keyword = $value->keyword;
					$this->dbvars->$keyword = serialize($_POST["'".$keyword."'"]);
				}
			}

			$data = array(
	            	    'title'     => 	$this->lang->line('login_page_title'),
	                	'content'   =>	$this->load->view('setting/setup',$view_data,TRUE)
	                );
			$this->load->view($this->dbvars->app_template, $data);
		}
		else
		{
			$view_data='';
			$data = array(
	            	    'title'     => 	$this->lang->line('login_page_title'),
	                	'content'   =>	$this->load->view('unauthorized',$view_data,TRUE)
	                );
      		$this->load->view('base/error_template', $data);        
		}
	}

	public function email()
	{
		$data=array();
		$view_data=array();
		if( $this->acl_permits('setting.app_mail') )
		{
			if($this->input->post('submit')!== null)
			{
				foreach ($_POST as $key => $value)
				{
					$this->dbvars->$key=$value;
				}
				$view_data['message']="Success! Mail settings has been updated!";
			}

			$view_data['mail_configurations']=$this->mcommon->records_all('configuration',array('confc_id'=>'2'));
			$data = array(
	            	    'title'     => 	'Email Settings',
	                	'content'   =>	$this->load->view('setting/app/mail',$view_data,TRUE)
	                );
		}
		else
		{
			$view_data='';
			$data = array(
							'title'     => 	$this->lang->line('login_page_title'),
							'content'   =>	$this->load->view('unauthorized',$view_data,TRUE)
						 );
		}
		
      	$this->load->view('base/error_template', $data);        
	}
}