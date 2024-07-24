<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends FSD_Controller 
{
	var $before_filter = array('name' => 'member_authorization', 'except' => array());
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('imeiorder_model');
		$this->load->model('method_model');
		$this->load->model('fileorder_model');
		$this->load->model('serverorder_model');
		$this->load->model('fileservices_model');
		$this->load->model('credit_model');
		$this->load->model('payment_model');
	}
	
	public function index()
	{
		$data = array();
		$id = $this->session->userdata('MemberID');
		$percentage = $this->imeiorder_model->get_percentage($id);
		$pendingpercent = $this->imeiorder_model->get_pendingPercentage($id);
		$rejectpercent = $this->imeiorder_model->get_rejectPercentage($id);
		$approvedpercent = $this->imeiorder_model->get_approavedPercentage($id);
		$data['totalPercentage'] = count($percentage);
		$data['totalPercentage'] = $data['totalPercentage'] > 0 ? $data['totalPercentage'] : 1;
		$data['pendingPercentage'] = ( (count($pendingpercent) * 100 ) / $data['totalPercentage'] );
		$data['rejectPercentage'] = ( (count($rejectpercent) * 100 ) / $data['totalPercentage'] );
		$data['appraovedPercentage'] = ( (count($approvedpercent) * 100 ) / $data['totalPercentage'] );		
		$data['Title'] = "Dashboard";
		$data['template'] = "member/dashboard";
		$data['credit'] = $this->credit_model->get_credit($id);
		$data['total_credit'] = $this->credit_model->get_total_credit($id);
		$data['total_order'] = $this->credit_model->get_total_order($id);

		$settings = $this->setting_model->get_all();
		foreach ($settings as $s)
			$data['notif'][$s['Key']] = $s['Value'];

		foreach ($settings as $s)
			$data['notif_updated'][$s['Key']] = $s['UpdatedDateTime'];

		$data['content'] = "member/dashboard";
		$data['content_js'] = "dashboard/dashboard.js";
		
		$this->load->view('mastertemplate', $data);
	}

	public function credits()
	{
		$data = array();
		$data['Title'] = "Credits";
		$data['template'] = "member/credits";

		$data['content'] = "member/credits";
		$data['content_js'] = "dashboard/credit.js";
		
		$settings = $this->setting_model->get_all();
		foreach ($settings as $s)
			$data['notif'][$s['Key']] = $s['Value'];

		foreach ($settings as $s)
			$data['notif_updated'][$s['Key']] = $s['UpdatedDateTime'];

		$this->load->view('mastertemplate', $data);
	}
	
	public function listener()
	{
		$id = $this->session->userdata('MemberID');
		echo $this->imeiorder_model->get_imei_data($id);
	}

	public function listener_new()
	{
		$id = $this->session->userdata('MemberID');

		$start      =  $_REQUEST['start'];
        $length     = $_REQUEST['length'];
        $cari_data  = $_REQUEST['search']['value'];

        $datas = $this->imeiorder_model->get_imei_data_new($id, $start, $length, $cari_data);

        $total = 9999999;
        $array_data = array();
        $no = $start + 1;
        if (!empty($datas) && $datas != null) {

            foreach ($datas as $d) {

				$status = ($d['Status'] == "Issued") ? "Success" : $d['Status'];

				switch ($status) {
					case "Pending":
						$status = "<span class='badge bg-warning text-white'>Pending</span>";
						break;
					case "Success":
						$status = "<span class='badge bg-success'>Success</span>";
						break;
					case "Canceled":
						$status = "<span class='badge bg-danger'>Rejected</span>";
						break;
					default:
						$status = "<span class='bg bg-secondary'>Unknown</span>";
						break;
				}

                $data["no"]          = $no;
                $data["detail"]      = "<a href='#' onclick='detailIMEI(\"".$d['ID']."\")'><i class='fa fa-eye'></i></a>";
                $data["imei"]        = $d['IMEI'];
                // $data["description"] = $d['Title'];
                // $data["price"]       = $d['Price'];
                $data["service"]     = $d['Title'];
                // $data["code"]        = $d['Note'];
                $data["status"]      = $status;
                // $data["created_at"]  = $d['CreatedDateTime'];

                array_push($array_data, $data);
                $no++;
            }
        }

        $output = array(

            "draw" => intval($_REQUEST['draw']),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            "data" => $array_data
        );


        echo json_encode($output);
	}

	public function listener_new_detail()
	{
		$id = $this->session->userdata('MemberID');
		$id_order = $this->input->post('id_order');

		$output = $this->imeiorder_model->get_imei_data_new_detail($id, $id_order);

		echo json_encode($output);
	}
	
	public function fileorder()
	{
		$id = $this->session->userdata('MemberID');
		echo $this->fileorder_model->get_file_data($id);
	}
	
	public function serverorder()
	{
		$id = $this->session->userdata('MemberID');
		echo $this->serverorder_model->get_server_data($id);
	}

	public function serverorder_new()
	{
		$id = $this->session->userdata('MemberID');

		$start      =  $_REQUEST['start'];
        $length     = $_REQUEST['length'];
        $cari_data  = $_REQUEST['search']['value'];

        $datas = $this->serverorder_model->get_server_data_new($id, $start, $length, $cari_data);

        $total = 9999999;
        $array_data = array();
        $no = $start + 1;
        if (!empty($datas) && $datas != null) {

            foreach ($datas as $d) {

                $data["no"]         = $no;
                $data["service"]    = $d['Title'];
                $data["code"] 		= $d['Code'];
                $data["email"]      = $d['Email'];
                $data["note"]       = $d['Notes'];
                $data["status"]     = $d['Status'];
                $data["created_at"] = $d['CreatedDateTime'];

                array_push($array_data, $data);
                $no++;
            }
        }

        $output = array(

            "draw" => intval($_REQUEST['draw']),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            "data" => $array_data
        );


        echo json_encode($output);
	}

	public function credit()
	{
		$id = $this->session->userdata('MemberID');
		echo $this->credit_model->get_credit_data($id);
	}

	public function credit_new()
	{
		$id = $this->session->userdata('MemberID');

		$start      =  $_REQUEST['start'];
        $length     = $_REQUEST['length'];
        $cari_data  = $_REQUEST['search']['value'];

        $datas = $this->credit_model->get_credit_data_new($id, $start, $length, $cari_data);

        $total = 9999999;
        $array_data = array();
        $no = $start + 1;
        if (!empty($datas) && $datas != null) {

            foreach ($datas as $d) {

                $data["no"]          = $no;
                $data["code"] 		 = $d['Code'];
                $data["amount"]      = $d['Amount'];
                $data["description"] = $d['Description'];
                $data["created_at"]  = $d['CreatedDateTime'];

                array_push($array_data, $data);
                $no++;
            }
        }

        $output = array(

            "draw" => intval($_REQUEST['draw']),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            "data" => $array_data
        );


        echo json_encode($output);
	}

	public function addfund()
	{
		$data = array();
		$id = $this->session->userdata('MemberID');
		$data['Title'] = "Dashboard";
		$data['template'] = "member/addcredit";
		$data['credit'] = $this->credit_model->get_credit($id);
		$data['paypal_settings'] = $this->payment_model->get_where(array('ID'=>1));

		$data['content'] = "member/addcredit";
		$data['content_js'] = "dashboard/addcredit.js";
		
		$settings = $this->setting_model->get_all();
		foreach ($settings as $s)
			$data['notif'][$s['Key']] = $s['Value'];

		foreach ($settings as $s)
			$data['notif_updated'][$s['Key']] = $s['UpdatedDateTime'];

		$this->load->view('mastertemplate', $data);	
	}
	
	public function profile()
	{
		$data = array();
		$id = $this->session->userdata('MemberID');
		$data['data'] = $this->member_model->get_where(array('ID' => $id));
		$data['Title'] = $this->lang->line('my_account_heading');
		$data['template'] = "member/profile";
		$data['credit'] = $this->credit_model->get_credit($id);

		$data['content'] = "member/profile";
		$data['content_js'] = "dashboard/profile.js";

		$settings = $this->setting_model->get_all();
		foreach ($settings as $s)
			$data['notif'][$s['Key']] = $s['Value'];

		foreach ($settings as $s)
			$data['notif_updated'][$s['Key']] = $s['UpdatedDateTime'];
		
		$this->load->view('mastertemplate', $data);
	}
	
	
	public function editprofile()
	{
		$this->form_validation->set_rules('FirstName', 'First Name', 'required|min_length[3]');
		$this->form_validation->set_rules('LastName', 'Last Name', 'required|min_length[3]');
		$this->form_validation->set_rules('Email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('CurrentPassword', 'Current Password', 'required|min_length[5]');
		if ($this->form_validation->run() == FALSE)
		{
			$data = $this->input->post(NULL,TRUE);
			$this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible fade show" role="alert" role="danger"> '.$this->lang->line('error_field_required').'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			redirect(site_url('member/dashboard/profile'));
		}
		else {
			$data = $this->input->post(NULL,TRUE);
			$member_data = $this->member_model->get_where(array('ID' => $data['ID']));
			if($member_data[0]['Password'] == md5($data['CurrentPassword']))
			{
				unset($data['CurrentPassword']);
				
				if($data['NewPassword'] != "")
				{
					if($data['NewPassword'] == $data['ConfirmPassword'])
					{
						$data['Password'] = $data['NewPassword'];
					}
					else
					{
						$this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible fade show" role="alert" role="danger"> '.$this->lang->line('error_password_not_match').'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
						redirect(site_url('member/dashboard/profile'));
					}
				}

				unset($data['NewPassword']);
				unset($data['ConfirmPassword']);
				$this->member_model->update($data, $data['ID']);
				$this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible fade show" role="alert" role="danger"> '.$this->lang->line('error_update_successfully').'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				redirect(site_url('member/dashboard/profile'));
			}
			$this->session->set_flashdata("message",'<div class="alert alert-danger alert-dismissible fade show" role="alert" role="danger"> '.$this->lang->line('error_wrong_password').'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			redirect(site_url('member/dashboard/profile'));
		}
	}

	
}	