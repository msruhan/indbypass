<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class method_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "gsm_methods";
        $this->tbl_networks = "gsm_networks";
		$this->tbl_apis = "gsm_apis";
		$this->tbl_imei_orders = "gsm_imei_orders";
		$this->tbl_members = "gsm_members";
		$this->tbl_member_methods = "gsm_member_methods";
	}

	public function get_top10()
	{
        $query = $this->db->query("SELECT * FROM `gsm_methods` WHERE `ID` IN (SELECT `MethodID` FROM `gsm_imei_orders` GROUP by `MethodID` ORDER by COUNT(`MethodID`) DESC)  limit 10");
        return $query->result_array();
	}
	
	public function get_pending_imei_orders() 
	{
		$this->db->select("$this->tbl_apis.LibraryID, $this->tbl_apis.Host, $this->tbl_apis.Username, $this->tbl_apis.ApiKey")
		->select("$this->tbl_name.ToolID, $this->tbl_imei_orders.Email, $this->tbl_imei_orders.ID, $this->tbl_imei_orders.ReferenceID, $this->tbl_imei_orders.IMEI")
		->select("$this->tbl_members.Email AS MemberEmail, $this->tbl_members.FirstName, $this->tbl_members.LastName, $this->tbl_imei_orders.MemberID")
		->from($this->tbl_apis)
		->join($this->tbl_name, "$this->tbl_apis.ID = $this->tbl_name.ApiID")
		->join($this->tbl_imei_orders, "$this->tbl_name.ID = $this->tbl_imei_orders.MethodID")
		->join($this->tbl_members, "$this->tbl_imei_orders.MemberID = $this->tbl_members.ID")
		->where("$this->tbl_imei_orders.Status", "Pending")
		->where("`$this->tbl_imei_orders`.`ReferenceID` IS NOT NULL", NULL, false)
		->order_by("$this->tbl_imei_orders.ID", "ASC");
		
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function send_pending_imei_orders() 
	{
		$this->db->select("$this->tbl_apis.LibraryID, $this->tbl_apis.Host, $this->tbl_apis.Username, $this->tbl_apis.ApiKey")
		->select("$this->tbl_name.ToolID, $this->tbl_imei_orders.*")
		->from($this->tbl_apis)
		->join($this->tbl_name, "$this->tbl_apis.ID = $this->tbl_name.ApiID")
		->join($this->tbl_imei_orders, "$this->tbl_name.ID = $this->tbl_imei_orders.MethodID")
		->where(array("$this->tbl_imei_orders.Status" => "Pending", "$this->tbl_imei_orders.ReferenceID" => NULL))
		->order_by("$this->tbl_imei_orders.ID", "ASC");
		
        $query = $this->db->get();
        return $query->result_array();
    }	
	
	public function get_where($params) 
	{
        $query = $this->db->get_where($this->tbl_name, $params);
        return $query->result_array();
    }
	
	public function get_member_method_by_id($member_id, $method_id)
	{
		$this->db->select("{$this->tbl_member_methods}.MethodID, {$this->tbl_member_methods}.Price")
		->select("{$this->tbl_name}.Title, {$this->tbl_name}.DeliveryTime, {$this->tbl_name}.Description, {$this->tbl_name}.Price, {$this->tbl_name}.Network, {$this->tbl_name}.Mobile, {$this->tbl_name}.SerialNumber, {$this->tbl_name}.Provider, {$this->tbl_name}.PIN, {$this->tbl_name}.KBH, {$this->tbl_name}.MEP, {$this->tbl_name}.PRD, {$this->tbl_name}.Type, {$this->tbl_name}.Locks, {$this->tbl_name}.Reference")
		->from($this->tbl_name)
		->join($this->tbl_member_methods, "{$this->tbl_member_methods}.MethodID = {$this->tbl_name}.ID")
		->where("{$this->tbl_member_methods}.MemberID", $member_id)
		->where("{$this->tbl_member_methods}.MethodID", $method_id)
		->where("{$this->tbl_name}.Status", 'Enabled');
		$query = $this->db->get();
        return $query->result_array();
	}
	
	public function method_with_networks() 
	{
        $data = array();
        $query = $this->db->get($this->tbl_networks);
        foreach ($query->result_array() as $network) 
        {
            $network_id = $network['ID'];
            $data[$network_id]['Title'] = $network['Title'];
        }
                
        $query = $this->db->get_where($this->tbl_name, array('Status' => 'Enabled'));
        foreach ($query->result_array() as $method) 
        {
            $network_id = $method['NetworkID'];
            $data[$network_id]['methods'][] = $method;
        }
        return $data;
    }      
	
	public function method_with_networks_list($cari_data = NULL) 
	{
        $data = array();
        $query = $this->db->get($this->tbl_networks);
        foreach ($query->result_array() as $network) 
        {
            $network_id = $network['ID'];
            $data[$network_id]['Title'] = $network['Title'];
        }
                
		$this->db->like('Title', $cari_data);
		$this->db->where('Status', 'Enabled');
		$query = $this->db->get($this->tbl_name);
        foreach ($query->result_array() as $method) 
        {
            $network_id = $method['NetworkID'];
            $data[$network_id]['methods'][] = $method;
        }
        return $data;
    } 
	
	public function get_api_credentials($id) 
	{
		$this->db->select("{$this->tbl_apis}.Host, {$this->tbl_apis}.Username, {$this->tbl_apis}.ApiKey, {$this->tbl_name}.*")
		->from($this->tbl_name)
		->join($this->tbl_apis, "{$this->tbl_name}.ApiID = {$this->tbl_apis}.ID")
		->where("{$this->tbl_name}.ID", $id);
        $query = $this->db->get();
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
	
	public function insert_batch_methods($data)
	{
		$this->db->insert_batch("gsm_member_methods", $data);
	}
		
	public function insert_batch_suppliermethods($data)
	{
		$this->db->insert_batch("gsm_supplier_methods", $data);
	}

    public function update($data, $id)
    {   
        $this->db->update($this->tbl_name, $data, array('ID' => $id));
    }
	
	public function get_user_price($memberid,$methodid)
	{
		$this->db->select('Price');
		$this->db->from('gsm_member_methods');
		$this->db->where('MemberID',$memberid);
		$this->db->where('MethodID',$methodid);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_user_price_new($methodid)
	{
		$this->db->select('Price');
		$this->db->from('gsm_methods');
		$this->db->where('ID',$methodid);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_all_user_price($memberid)
	{
		$this->db->from('gsm_member_methods');
		$this->db->where('MemberID',$memberid);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_all_tool_id()
	{
		$data = array();
		
		$this->db->select("$this->tbl_name.ToolID");
		$this->db->from($this->tbl_name);
		$query = $this->db->get();
		
		foreach ($query->result_array() as $row)
		{
			$data[] = $row['ToolID'];
		}
		return $data;
	}

	public function get_field_names( $prefix = NULL )
	{
		$fields = $this->db->field_data($this->tbl_name);
		if( $prefix !== NULL )
		{
			$fields = array_filter($fields, function ($v) use ($prefix)  {
				return substr($v->name, 0, strlen($prefix)) === $prefix;
			});
		}
		return $fields;
	}

    public function delete($id)
    {
		$this->db->delete($this->tbl_member_methods, array('MethodID' => $id));
        $this->db->delete($this->tbl_name, array('ID' => $id));
    }
    
    public function delete_api_relate($api_id)
    {
    	$this->db->delete($this->tbl_name, array('ApiID' => $api_id));
    }
	
	function get_datatable($access)
	{
		$this->load->library('datatables');
		$oprations = '';
		if($access['edit'] == 'Y')
		{
			$oprations .= '<a href="'.site_url("admin/method/edit/$1").'" title="Edit this record" class="tip"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
			$oprations .= '<a href="'.site_url("admin/method/sync/$1").'" title="Sync this method required parameters" class="tip"><i class="fa fa-refresh" aria-hidden="true"></i></a>';
		}
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/method/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
		
		$this->datatables
				->select("ID, Title, Status, Price, CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->add_column('delete', $oprations, 'ID');		
		return $this->datatables->generate();
	}	
}