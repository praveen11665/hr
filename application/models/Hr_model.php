<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hr_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getemployee($branch_id='', $company_id='', $department_id='', $employeeIds=array(), $check='')
	{
		$this->db->select('e.employee_id, e.employee_name, e.employee_number, hd.department_name, hb.branch, sc.company_name');

		$this->db->from('hr_employee as e');
		$this->db->join('hr_emp_job_profile as eat', 'eat.employee_id = e.employee_id', 'left');
		$this->db->join('hr_department as hd', 'hd.department_id = eat.department_id');
      	$this->db->join('hr_branch as hb', 'hb.branch_id = eat.branch_id');
     	$this->db->join('set_company as sc', 'sc.company_id = e.company_id');
		$this->db->where('e.is_delete', 0);

		if($branch_id != '')
		{
			$this->db->where('eat.branch_id', $branch_id);
		}	
		
		if($company_id != '')
		{
			$this->db->where('e.company_id', $company_id);
		}

		if($department_id != '')
		{
			$this->db->where('eat.department_id', $department_id);
		}	

		if(!empty($employeeIds))
		{
			$this->db->where_in('e.employee_id', $employeeIds);
		}

		if($check)
		{
			$results= $this->db->get()->result_array();
		}else
		{
			$results= $this->db->get()->result();
		}

		return $results;
	}

	public function getCategoryData()
	{
		$this->db->select('ac.*');
		$this->db->from('acl_categories as ac');
		$this->db->join('acl_actions as aa', 'aa.category_id = ac.category_id');
		$this->db->group_by('ac.category_id');
		$results= $this->db->get()->result();
		return $results;
	}	
}
?>