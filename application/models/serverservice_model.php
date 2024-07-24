<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class serverservice_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "gsm_server_services";
        $this->tbl_apis = "gsm_apis";
        $this->tbl_orders = "gsm_server_orders";
        $this->tbl_member_services = "gsm_member_fileservices";
	}
	
	public function get_where($params) 
	{
        $query = $this->db->get_where($this->tbl_name, $params);
        return $query->result_array();
    }  

    public function get_where_fileservices_orders($params) 
	{
        $query = $this->db->get_where($this->tbl_orders, $params);
        return $query->result_array();
    }	

    public function get_all() 
    {                
        $query = $this->db->get($this->tbl_name);
        return $query->result_array();
    }
    
    public function count_all() 
    {
        $query = $this->db->count_all($this->tbl_name);
        return $query;
    }
    
    public function count_where($params) 
    {
		$this->db->from($this->tbl_name)->where($params);
        return  $this->db->count_all_results();
    }    

    public function insert($data) 
    {
        $this->db->insert($this->tbl_name, $data);
        $id = $this->db->insert_id();
        return intval($id);
    }
    
	public function insert_batch($data)
	{
		$this->db->insert_batch($this->tbl_name, $data); 
	}
	
    public function update($data, $id)
    {   
        $this->db->update($this->tbl_name, $data, array('ID' => $id));
    }

    public function delete($id)
    {
        $this->db->delete($this->tbl_name, array('ID' => $id));                
    }
	
	function get_datatable($access)
	{
		$this->load->library('datatables');
		$oprations = '';
		if($access['edit'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/serverservice/edit/$1").'" title="Edit this record" class="tip"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/serverservice/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
		
		$this->datatables
				->select("ID, Title, Price, Status,CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->add_column('delete', $oprations, 'ID');		
		return $this->datatables->generate();
	}
}