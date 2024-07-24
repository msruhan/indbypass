<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class credit_model extends CI_Model
{
	
	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "gsm_credits";
		$this->emp_tbl = "hr_employees";
		$this->mem_tbl = "gsm_members";
		
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
	
	public function get_sum($params)
	{
		$this->db->select_sum('Amount');
		$this->db->where($params);
		$query = $this->db->get($this->tbl_name);
		return $query->result_array();
	}
	
	public function refund($order_id, $transaction_code, $member_id) 
	{
        $query = $this->db->get_where($this->tbl_name, array('TransactionCode' => $transaction_code, 'TransactionID' => $order_id, 'MemberID' => $member_id));
        $result = $query->result_array();
		if( is_array($result) && count($result) > 0 )
		{
			unset($result[0]['ID']);
			$result[0]['Description'] = 'Amount Refunded';
			$result[0]['Amount'] = abs($result[0]['Amount']);
			$result[0]['CreatedDateTime'] = date("Y-m-d H:i:s");
			return $this->insert($result[0]);
		}
		return FALSE;
    } 
		
	public function get_max_transaction_id($param) 
    {
		$this->db->select_max('TransactionID')
		->from($this->tbl_name)
		->where($param);
        $query = $this->db->get();
        $result = $query->result_array();
		return empty($result[0]['TransactionID'])?0:$result[0]['TransactionID'];
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

    public function update($data, $id)
    {   
        return $this->db->update($this->tbl_name, $data, array('ID' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->tbl_name, array('ID' => $id));                
    }
	
	public function get_credit($id)
	{
		$sql = "SELECT SUM(Amount) AS credit FROM gsm_credits WHERE MemberID = $id";
		$result = $this->db->query($sql);
		$credit = $result->result_array();		
		return floatval($credit[0]['credit']);
	}

	public function get_total_credit($id)
	{
		$sql = "SELECT SUM(Amount) AS total_credit FROM gsm_credits WHERE Amount > 0 AND MemberID = $id";
		$result = $this->db->query($sql);
		$credit = $result->result_array();		
		return floatval($credit[0]['total_credit']);
	}

	public function get_total_order($id)
	{
		$sql = "SELECT COUNT(id) AS total_order_imei FROM gsm_imei_orders WHERE MemberID = $id";
		$result = $this->db->query($sql);
		$credit = $result->result_array();
		
		$sql2 = "SELECT COUNT(id) AS total_order_server FROM gsm_server_orders WHERE MemberID = $id";
		$result2 = $this->db->query($sql2);
		$credit2 = $result2->result_array();

		$total_orders = $credit[0]['total_order_imei'] + $credit2[0]['total_order_server'];
		return $total_orders;
	}

	public function get_credit_data($id)
	{
		$this->load->library('odatatables');
		$this->odatatables
				->select("$this->tbl_name.ID, CONCAT($this->tbl_name.TransactionCode, $this->tbl_name.TransactionID) AS Code", FALSE)				
				->select("$this->tbl_name.Amount, $this->tbl_name.Description, $this->tbl_name.CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->join($this->mem_tbl, "$this->tbl_name.MemberID=$this->mem_tbl.ID", "inner")
				->where("$this->tbl_name.MemberID", $id);	
		return $this->odatatables->generate();
	}	

	public function get_credit_data_new($id, $start, $length, $cari_data)
	{
		$this->db->select("$this->tbl_name.ID, CONCAT($this->tbl_name.TransactionCode, $this->tbl_name.TransactionID) AS Code", FALSE)				
				->select("$this->tbl_name.Amount, $this->tbl_name.Description, $this->tbl_name.CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->join($this->mem_tbl, "$this->tbl_name.MemberID=$this->mem_tbl.ID", "inner")
				->where("$this->tbl_name.MemberID", $id)
				->like('TransactionCode', $cari_data, 'both')
				->or_like('Amount', $cari_data, 'both')
				->or_like('Description', $cari_data, 'both')
				->or_like("$this->tbl_name.CreatedDateTime", $cari_data, 'both')
				->limit($length, $start)
				->order_by("$this->tbl_name.ID", "desc");

		return $this->db->get()->result_array();					

	}	
	
	public function get_datatable()
	{
		$this->load->library('datatables');
		$this->datatables
				->select("$this->tbl_name.ID, CONCAT($this->tbl_name.TransactionCode, $this->tbl_name.TransactionID) AS Code, CONCAT($this->mem_tbl.FirstName, ' ', $this->mem_tbl.LastName) AS Name", FALSE)
				->select("$this->tbl_name.Description, $this->tbl_name.Amount, $this->tbl_name.CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->join($this->mem_tbl, "$this->tbl_name.MemberID=$this->mem_tbl.ID", "left");		
		return $this->datatables->generate();
	}
}