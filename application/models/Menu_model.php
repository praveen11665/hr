<?php
class Menu_model extends CI_Model
{
	private $table='menus';

	public function all()
	{
		return $this->db->get("menus")->result_array();
	}

	public function getmodulemenus($module_id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('module_id',$module_id);
		$this->db->where('is_active',1);
		return $this->db->get()->result_array();
	}

	public function getmodulemenusHr($module_id)
	{
		$this->db->select('id, name');
		$this->db->from($this->table);
		$this->db->where('module_id',$module_id);
		$this->db->where('is_active',1);
		$this->db->where('parent',NULL);
		return $this->db->get()->result_array();
	}

	public function getsubmodulemenusHr($module_id, $parent_id)
	{
		$this->db->select('id, name, slug');
		$this->db->from($this->table);
		$this->db->where('module_id',$module_id);
		$this->db->where('is_active',1);
		$this->db->where('parent',$parent_id);
		return $this->db->get()->result_array();
	}
}