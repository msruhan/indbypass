<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class serverbox_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
        $this->tbl_name = "gsm_server_boxes";
        $this->tbl_services = "gsm_server_services";
	}
	
	public function get_where($params) 
	{
        $query = $this->db->get_where($this->tbl_name, $params);
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

    public function insert($data) 
    {
        $this->db->insert($this->tbl_name, $data);
        $id = $this->db->insert_id();
        return intval($id);
    }

    public function update($data, $id)
    {   
        $this->db->update($this->tbl_name, $data, array('ID' => $id));
    }

    public function delete($id)
    {
        $this->db->delete($this->tbl_name, array('ID' => $id));                
    }
    
    public function service_with_boxes() 
	{
        $data = array();
        $query = $this->db->get($this->tbl_name);
        foreach ($query->result_array() as $box) 
        {
            $box_id = $box['ID'];
            $data[$box_id]['Title'] = $box['Title'];
        }

        $query = $this->db->get_where($this->tbl_services, array('Status' => 'Enabled'));
        foreach ($query->result_array() as $service) 
        {
            $box_id = $service['ServerBoxID'];
            $data[$box_id]['services'][] = $service;
        }
        return $data;
    }

    public function service_with_boxes_new($cari_data = NULL) 
	{
        $data = array();
        $query = $this->db->get($this->tbl_name);
        foreach ($query->result_array() as $box) 
        {
            $box_id = $box['ID'];
            $data[$box_id]['Title'] = $box['Title'];
        }

        $this->db->like('Title', $cari_data);
		$this->db->where('Status', 'Enabled');
		$query = $this->db->get($this->tbl_services);
        foreach ($query->result_array() as $service) 
        {
            $box_id = $service['ServerBoxID'];
            $data[$box_id]['services'][] = $service;
        }
        return $data;
    }
    
	function get_datatable($access)
	{
		$this->load->library('datatables');
		$oprations = '';
		if($access['edit'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/serverbox/edit/$1").'" title="Edit this record" class="tip">
<i class="fa fa-pencil" aria-hidden="true"></i></a>';
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/serverbox/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
		
		$this->datatables
				->select("ID, Title, UpdatedDateTime, CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->add_column('delete', $oprations, 'ID');		
		return $this->datatables->generate();
	}	
}