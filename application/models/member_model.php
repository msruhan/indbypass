<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "gsm_members";
		$this->tbl_credits = "gsm_credits";
        $this->tbl_member_fileservices = "gsm_member_fileservices";
        $this->tbl_member_methods = "gsm_member_methods";
		$this->tbl_methods = "gsm_methods";
		$this->tbl_networks = "gsm_networks";
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
	
    public function count_where($params) 
    {
		$this->db->from($this->tbl_name)->where($params);
        return  $this->db->count_all_results();
	}
	
	public function increase_referal_count($member_id)
	{
		$member_id = intval($member_id);
		$this->db->query('UPDATE `gsm_members` SET `ReferralClicks`=`ReferralClicks`+1 WHERE `ID`='.$member_id);
	}

    public function insert($data) 
    {
		$data["Password"] = md5($data["Password"]);
        $this->db->insert($this->tbl_name, $data);
        $id = $this->db->insert_id();
        return intval($id);
    }

	public function update_server_ip($server_ip, $email)
	{
		$this->db->update($this->tbl_name, ['ServerIP' => $server_ip], ['Email' => $email]);
	}

    public function update($data, $id)
    {
    	if(array_key_exists("Password", $data))
		{
			if($data["Password"] != null )
				$data["Password"] = md5($data["Password"]);
			else
				unset($data['Password']);
		}
		if(isset($data['ResetApiKey']))
		{
			$this->db->set('ApiKey', 'UUID()', FALSE);
			unset($data['ResetApiKey']);
		}
		if(isset($data['ResetServerIP']))
		{
			$data['ServerIP'] = NULL;
			unset($data['ResetServerIP']);
		}
        $this->db->update($this->tbl_name, $data, array('ID' => $id));
    }
	
    ############ Insert All IMEI METHOD Prices Individually ############
    
	public function insert_method($data)
	{
		$this->db->insert($this->tbl_member_methods,$data);
	}
	
    ############ Insert All File METHOD Prices Individually ############
    
	public function insert_filemethod($data)
	{
		$this->db->insert($this->tbl_member_fileservices, $data);
	}
	
	############## DElETE RECORDS of IMEI METHODS PRICES #############
	
	public function delete_method($id)
	{
		 $this->db->delete($this->tbl_member_methods, array('MemberID' => $id)); 
	}
	
	############## DElETE RECORDS of FILE METHODS PRICES #############
	
	public function delete_filemethod($id)
	{
		 $this->db->delete($this->tbl_member_fileservices, array('MemberID' => $id)); 
	}
	
	############### Get IMEI Method Price Individually ###################
	
	public function get_all_method_member($id)
	{
		$this->db->select("$this->tbl_member_methods.*, $this->tbl_methods.Title");
		$this->db->from($this->tbl_member_methods);
		$this->db->join($this->tbl_methods,"$this->tbl_methods.ID = $this->tbl_member_methods.MethodID","inner");
		$this->db->where("$this->tbl_member_methods.MemberID", $id);
		$query = $this->db->get();
		return $query->result_array();		
	}
	

	public function get_imei_service_list($member_id)
	{
		$services = [];
		$query = $this->db->get($this->tbl_networks);
		$networks = $query->result_array();
		foreach ($networks as $n)
		{
			$query->free_result(); // The $query result object will no longer be available
			$network_id = $n['ID'];
			$services[$network_id] = [
				'NetworkID' => $n['ID'],
				'Title' => $n['Title']
			];
			$this->db->select("{$this->tbl_member_methods}.*, {$this->tbl_methods}.*");
			$this->db->from($this->tbl_member_methods);
			$this->db->join($this->tbl_methods,"{$this->tbl_methods}.ID = {$this->tbl_member_methods}.MethodID", "inner");
			$this->db->where("{$this->tbl_member_methods}.MemberID", $member_id);
			$this->db->where("{$this->tbl_methods}.NetworkID", $n['ID']);
			$this->db->where("{$this->tbl_methods}.Status", 'Enabled');
			$query = $this->db->get();
			$services[$network_id]['methods'] = $query->result_array();
		}
		return $services;
	}
	############### Get File Service Method Price Individually ###################
	
	public function get_all_file_member_price($id = 0)
	{
		$this->db->select("$this->tbl_member_fileservices.*,gsm_fileservices.Title");
		$this->db->from($this->tbl_member_fileservices);
		$this->db->join("gsm_fileservices","gsm_fileservices.ID = $this->tbl_member_fileservices.FileServiceID","inner");
		$this->db->where("$this->tbl_member_fileservices.MemberID", $id);
		$query = $this->db->get();
		//die($this->db->last_query());
        return $query->result_array();
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
			$oprations .= '<a href="'.site_url("admin/member/edit/$1").'" title="Edit this record" class="tip"><i class="fa fa-pencil" aria-hidden="true"></i></a>
			<a href="'.site_url("admin/member/editfilemethodprice/$1").'" title="Edit File Method Price" class="tip"><i class="fa fa-file-o" aria-hidden="true"></i></a>
			<a href="'.site_url("admin/member/editmethodprice/$1").'" title="Edit Method Price this record" class="tip"><i class="fa fa-barcode" aria-hidden="true"></i></a>';
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/member/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';

		## Get Credits of member ##
		$credits = "SELECT SUM(`Amount`) FROM $this->tbl_credits C WHERE `C`.`MemberID` = $this->tbl_name.ID";

		$this->datatables
				->select("ID, FirstName, LastName, Mobile, Email, Status, CreatedDateTime", TRUE)
				->select("($credits) Credits", TRUE)
				->from($this->tbl_name)
				->add_column('delete', $oprations, "ID");		
		return $this->datatables->generate();
	}	
}