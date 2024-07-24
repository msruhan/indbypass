<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "app_settings";
	}
    
    public function get_where($params) 
	{
		$query = $this->db->get_where($this->tbl_name, $params);
        return $query->result_array();
    }

    public function get_module_settings($prefix) 
	{
        $this->db->select("Key, Value")
        ->from($this->tbl_name)
        ->like('Key', $prefix, 'after');
		$query = $this->db->get();
        return $query->result_array();
    }

    function get_all() 
    {                
        $query = $this->db->get($this->tbl_name);
        return $query->result_array();
    }

    function update($data, $key)
    {   
        $this->db->update($this->tbl_name, $data, ['Key' => $key]);
    }
}