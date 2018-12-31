<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Use:
*     $this->load->database();
*     $this->load->library('dbvars');
*     
* To set value: $this->dbvars->key = 'value';
* To get value:    $this->dbvars->key
* To check if the variable isset: $this->dbvars->__isset($key);
* To unset variable use: $this->dbvars->__unset($key);
* As of PHP 5.1.0 You can use isset($this->dbvars->key), unset($this->dbvars->key);
**/

class Dbvars {
    const TABLE = 'configuration';
    //Table where variables will be stored.
    
    private $data;
    private $ci;
    
    function __construct()
    {
        $this->ci =& get_instance();
    
        $q = $this->ci->db->get(self::TABLE);
        foreach ($q->result() as $row)
           {
               $this->data[$row->key] = unserialize($row->value);
           }
           $q->free_result();

    }

    function __get($key){
        return $this->data[$key];
    }
    
    function __set($key, $value){
        if (isset($this->data[$key])){
            $this->ci->db->where('key', $key);
            $this->ci->db->update(self::TABLE, array('value' => serialize($value)));
        } else {
            $this->ci->db->insert(self::TABLE, array('keyword' => $key, 'value' => serialize($value)));
        }
        $this->data[$key] = $value;
    }
        
    /**  As of PHP 5.1.0  */
    function __isset($key) {
        return isset($this->data[$key]);
    }

    /**  As of PHP 5.1.0  */
    function __unset($key) {
        $this->ci->db->delete(self::TABLE, array('keyword' => $key));    
        unset($this->data[$key]);
    }    
}
?>