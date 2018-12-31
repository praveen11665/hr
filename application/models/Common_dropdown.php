
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_dropdown extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
/*
parent
*/
	public function parentDropdown($module_id='')
	{
		$this->db->select('id, parent, name');
		$this->db->from('menus');
		$this->db->where('parent', NULL);
		$this->db->where('module_id', $module_id);
		$results  = $this->db->get()->result();
		$options		=	array();
		$options[''] 	= 	lang("label_select_dropdown");
		foreach ($results as $item) 
		{
			$options[$item->id]	=	$item->name;
		}
		return $options;
	}

	/*
Module
*/
	public function moduleDropdown()
	{
		$this->db->select('category_id, category_code');
		$this->db->from('acl_categories');		
		$results 		= $this->db->get()->result();
		$options		=	array();
		$options[''] 	= 	lang("label_select_dropdown");
		foreach ($results as $item) 
		{
			$options[$item->category_id]	=	$item->category_code;
		}
		return $options;
	}

	public function namingSeriesdrop($transaction_id)
	{
	    $this->db->select('transaction_id, set_options, naming_series_id');
	    $this->db->from('set_naming_series');
	    $this->db->where('transaction_id', $transaction_id);
	    $this->db->where('is_delete', 0);
	    $results 			=   $this->db->get()->result();
	    $optionsNames 		=	array();
	    foreach ($results as $item) 
	    {
	    	$seriesNames	=	explode(',', $item->set_options);
	    	foreach ($seriesNames as $naming)
	    	{
	    		$optionsNames[$item->naming_series_id."_".$naming]  =  $naming;
	    	}
	    	//$optionsNames 	= 	array_merge($seriesNames, $optionsNames);

	    }

	    $options        =   array();
	   // $options['']    =   lang("label_select_dropdown");
	    foreach ($optionsNames as $key => $value) 
	    {
	        $options[$key] =  $value;
	    }
	    
	    return $options;
	}
}