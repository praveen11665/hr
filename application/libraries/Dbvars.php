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
                $this->data[$row->keyword] = unserialize(base64_decode($row->value));
               //echo unserialize(base64_decode($row->value));
           }
           $q->free_result();

    }

    function __get($keyword){
        return $this->data[$keyword];
    }

    function __set($keyword, $value){
        if (isset($this->data[$keyword])){
            $this->ci->db->where('keyword', $keyword);
            $this->ci->db->update(self::TABLE, array('value' => base64_encode(serialize($value))));
        } else {
            $this->ci->db->insert(self::TABLE, array('keyword' => $keyword, 'value' => base64_encode(serialize($value))));
        }
        $this->data[$keyword] = $value;
    }

    /**  As of PHP 5.1.0  */
    function __isset($keyword) {
        return isset($this->data[$keyword]);
    }

    /**  As of PHP 5.1.0  */
    function __unset($keyword) {
        $this->ci->db->delete(self::TABLE, array('keyword' => $keyword));
        unset($this->data[$keyword]);
    }
}
?>
