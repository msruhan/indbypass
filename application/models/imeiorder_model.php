<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imeiorder_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "gsm_imei_orders";
		$this->tbl_method = "gsm_methods";
		$this->tbl_members = "gsm_members";
	}
	
	public function get_where($params) 
	{
        $query = $this->db->get_where($this->tbl_name, $params);
        return $query->result_array();
    }

	public function get_where_in(array $id) 
	{
		$this->db->select("
		$this->tbl_name.ID, 
		$this->tbl_name.IMEI, 
		$this->tbl_name.ExtraInformation, 
		$this->tbl_name.iCloudCarrierInfo, 
		$this->tbl_name.iCloudAppleIDHint, 
		$this->tbl_name.iCloudActivationLockScreenshot, 
		$this->tbl_name.iCloudIMEINumberScreenshot, 
		$this->tbl_name.iCloudAppleIdEmail, 
		$this->tbl_name.iCloudAppleIdScreenshot, 
		$this->tbl_name.iCloudAppleIdInfo, 
		$this->tbl_name.iCloudPhoneNumber, 
		$this->tbl_name.iCloudID, 
		$this->tbl_name.iCloudPassword, 
		$this->tbl_name.iCloudUDID, 
		$this->tbl_name.iCloudICCID, 
		$this->tbl_name.iCloudVideo, 
		$this->tbl_method.Title"
		, TRUE);
		$this->db->from($this->tbl_name);
		$this->db->join($this->tbl_method, "$this->tbl_name.MethodID=$this->tbl_method.ID", "inner");
		
		$this->db->where_in("$this->tbl_name.ID", $id);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function get_order_details($params = False) 
	{
		$this->db->select("$this->tbl_name.ID,$this->tbl_name.verify, $this->tbl_name.IMEI, $this->tbl_method.Title, $this->tbl_name.Maker, $this->tbl_name.Note, $this->tbl_name.Model, $this->tbl_name.UpdatedDateTime, $this->tbl_name.CreatedDateTime", TRUE);
		$this->db->from($this->tbl_name);
		$this->db->join($this->tbl_method, "$this->tbl_name.MethodID=$this->tbl_method.ID", "inner");
		if($params)
			$this->db->where($params);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all() 
    {                
        $query = $this->db->get($this->tbl_name);
        return $query->result_array();
    }
    
    public function get_percentage($id)
	{
		$sql = "SELECT Status  FROM $this->tbl_name WHERE MemberID = $id 
		UNION ALL
		SELECT Status FROM gsm_fileservices_orders WHERE MemberID = $id";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	
	public function get_pendingPercentage($id)
	{
		$sql = "SELECT Status  FROM $this->tbl_name WHERE MemberID = $id  AND Status = 'Pending'
		UNION ALL
		SELECT Status FROM gsm_fileservices_orders WHERE MemberID = $id And Status = 'Pending'";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	
	public function get_rejectPercentage($id)
	{
		$sql = "SELECT Status  FROM $this->tbl_name WHERE MemberID = $id  AND Status = 'Canceled'
		UNION ALL
		SELECT Status FROM gsm_fileservices_orders WHERE MemberID = $id And Status = 'Canceled'";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	
	public function get_approavedPercentage($id)
	{
		$sql = "SELECT Status  FROM $this->tbl_name WHERE MemberID = $id  AND Status = 'Issued'
		UNION ALL
		SELECT Status FROM gsm_fileservices_orders WHERE MemberID = $id And Status = 'Issued'";
		$result = $this->db->query($sql);
		return $result->result_array();
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

	public function get_count_by($col)
	{
		$query = $this->db
              ->select("{$col}, count({$col}) AS countof")
              ->group_by($col)
              ->get($this->tbl_name);
		return $query->result();
	}

	public function get_duplicates($imeis, $member_id, $method_id) 
    {
		$this->db->select("IMEI")
		->from($this->tbl_name)
		->where('MemberID', $member_id)
		// ->where('MethodID', $method_id)
		->where('Status', 'Pending')
		->where_in('IMEI', $imeis);
		$query = $this->db->get();
        return $query->result_array();
	}

    public function insert($data) 
    {
        $this->db->insert($this->tbl_name, $data);
        $id = $this->db->insert_id();
        return intval($id);
    }
	
	public function insert_bulk_imei($data)
	{
		$this->db->insert_batch($this->tbl_name, $data); 
	}

    public function update($data, $id)
    {   
        return $this->db->update($this->tbl_name, $data, array('ID' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->tbl_name, array('ID' => $id));                
    }
	
	public function get_imei_history($id,$status)
	{
		$sql = "SELECT `gsm_imei_orders`.`ID`,  gsm_imei_orders.IMEI,
		 `gsm_methods`.`Title`, `gsm_imei_orders`.`Email`, `gsm_imei_orders`.`Note`, 
		 `gsm_imei_orders`.`Status`, `gsm_imei_orders`.`CreatedDateTime` FROM (`gsm_imei_orders`) INNER JOIN 
		 `gsm_methods` ON `gsm_imei_orders`.`MethodID`=`gsm_methods`.`ID` WHERE 
		 `gsm_imei_orders`.`MemberID` = '$id' AND `gsm_imei_orders`.`Status` = '$status' ";
		 $result = $this->db->query($sql);
		 return $result->result_array();
	}
	
	public function get_imei_data($id)
	{
		$this->load->library('odatatables');
		$this->odatatables				
				->select("$this->tbl_name.ID, $this->tbl_name.IMEI, $this->tbl_method.Title, $this->tbl_name.Code, $this->tbl_name.Note, $this->tbl_name.Status,  $this->tbl_name.CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->join($this->tbl_method, "$this->tbl_name.MethodID=$this->tbl_method.ID", "inner")
				->where("$this->tbl_name.MemberID",$id);						
		return $this->odatatables->generate();
	}

	public function get_imei_data_new($id, $start, $length, $cari_data)
	{
		$this->db->select("$this->tbl_name.ID, $this->tbl_name.IMEI, $this->tbl_method.Title, $this->tbl_method.Price, $this->tbl_name.Code, $this->tbl_name.Note, $this->tbl_name.Status,  $this->tbl_name.CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->join($this->tbl_method, "$this->tbl_name.MethodID=$this->tbl_method.ID", "inner")
				->where("$this->tbl_name.MemberID",$id)
				->like('IMEI', $cari_data, 'both')
				// ->or_like('Title', $cari_data, 'both')
				// ->or_like('Code', $cari_data, 'both')
				// ->or_like('Note', $cari_data, 'both')
				->or_like("$this->tbl_name.Status", $cari_data, 'both')
				->limit($length, $start)
				->order_by("$this->tbl_name.ID", "desc");
				
				return $this->db->get()->result_array();					
	}

	public function get_imei_data_new_detail($id, $id_order)
	{
		$this->db->select("$this->tbl_name.ID, $this->tbl_name.IMEI, $this->tbl_method.Title, $this->tbl_method.Description, $this->tbl_method.Price, $this->tbl_method.DeliveryTime, $this->tbl_name.Code, $this->tbl_name.Note, $this->tbl_name.Status, $this->tbl_name.Email, $this->tbl_name.Comments, $this->tbl_name.CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->join($this->tbl_method, "$this->tbl_name.MethodID=$this->tbl_method.ID", "inner")
				->where("$this->tbl_name.MemberID",$id)
				->where("$this->tbl_name.ID",$id_order);
				
				return $this->db->get()->row_array();					
	}
	
	public function get_imei_data_select_new($id, $param, $start, $length, $cari_data)
	{
		if(!empty($cari_data)){
			$sql = "SELECT $this->tbl_name.ID, $this->tbl_name.IMEI, $this->tbl_method.Title, $this->tbl_name.Code, $this->tbl_name.Note, $this->tbl_name.Status,  $this->tbl_name.CreatedDateTime FROM $this->tbl_name INNER JOIN $this->tbl_method ON $this->tbl_name.MethodID=$this->tbl_method.ID WHERE $this->tbl_name.MemberID = '$id' AND $this->tbl_name.Status = '$param' AND($this->tbl_name.IMEI LIKE '%$cari_data%' OR $this->tbl_method.Title LIKE '%$cari_data%' OR $this->tbl_name.Code LIKE '%$cari_data%' OR $this->tbl_name.Note LIKE '%$cari_data%') ORDER BY $this->tbl_name.ID DESC LIMIT $start, $length";
		}else{
			$sql = "SELECT $this->tbl_name.ID, $this->tbl_name.IMEI, $this->tbl_method.Title, $this->tbl_name.Code, $this->tbl_name.Note, $this->tbl_name.Status,  $this->tbl_name.CreatedDateTime FROM $this->tbl_name INNER JOIN $this->tbl_method ON $this->tbl_name.MethodID=$this->tbl_method.ID WHERE $this->tbl_name.MemberID = '$id' AND $this->tbl_name.Status = '$param' ORDER BY $this->tbl_name.ID DESC LIMIT $start, $length";
		}

		$result = $this->db->query($sql);
		
		return $result->result_array();					
	}
	
	public function get_imei_data_select($id,$status)
	{
		$this->load->library('odatatables');
		$this->odatatables				
				->select("$this->tbl_name.ID, $this->tbl_name.IMEI, $this->tbl_method.Title, $this->tbl_name.Code, $this->tbl_name.Note, $this->tbl_name.Status,  $this->tbl_name.CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->join($this->tbl_method, "$this->tbl_name.MethodID=$this->tbl_method.ID", "inner")
				->where("$this->tbl_name.MemberID",$id)
				->where("$this->tbl_name.Status",$status);						
		return $this->odatatables->generate();
	}
	
	public function get_datatable($access)
	{
		$this->load->library('datatables');
		$oprations = '';
		if($access['edit'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/imeiorder/edit/$1").'" title="Edit this record" class="tip"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
		if($access['edit'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/imeiorder/cancel/$1").'" title="Cancel this record" class="tip" onclick="return confirm(\'Are you sure to cancel record \');"><i class="fa fa-mail-reply" aria-hidden="true"></i></a>';
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/imeiorder/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
		
		$this->datatables				
				->select("$this->tbl_name.ID, $this->tbl_name.IMEI, $this->tbl_method.Title, $this->tbl_members.Email, $this->tbl_name.Comments, $this->tbl_name.Status, $this->tbl_name.CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->join($this->tbl_method, "$this->tbl_name.MethodID=$this->tbl_method.ID", "left")
				->join($this->tbl_members, "$this->tbl_name.MemberID=$this->tbl_members.ID", "left")
				->add_column('delete', $oprations, "ID");
		return $this->datatables->generate();
	}
}