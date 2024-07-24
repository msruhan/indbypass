<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imeirequest extends FSD_Controller 
{
	var $before_filter = array('name' => 'member_authorization', 'except' => array());
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('method_model');
		$this->load->model('brand_model');
		$this->load->model('provider_model');
		$this->load->model('network_model');
		$this->load->model('imeiorder_model');
		$this->load->model('credit_model');
		$this->load->model("servicemodel_model");		
		$this->load->model("mep_model");
		$this->load->model("autoresponder_model");

	}
	
	########### IMEI Order Request Form display #######################################
	
	public function index()
	{
		$data = array();
		$data['Title'] = "Imei Request";
		$data['imeimethods'] = $this->method_model->method_with_networks();
		$data['template'] = "member/imei/request";
		$id = $this->session->userdata('MemberID');
		$data['credit'] = $this->credit_model->get_credit($id);

		$settings = $this->setting_model->get_all();
		foreach ($settings as $s)
			$data['notif'][$s['Key']] = $s['Value'];

		foreach ($settings as $s)
			$data['notif_updated'][$s['Key']] = $s['UpdatedDateTime'];

		$data['content'] = "member/imei/request";
		$data['content_js'] = "imei_request/imeiRequest.js";

		$this->load->view('mastertemplate', $data);
	}

	public function listservices()
	{
		$data = array();
		$data['Title'] = "Imei Request List";
		$data['template'] = "member/imei/requestlist";

		$data['content'] = "member/imei/requestlist";
		$data['content_js'] = "imei_request/imeiRequestList.js";

		$settings = $this->setting_model->get_all();
		foreach ($settings as $s)
			$data['notif'][$s['Key']] = $s['Value'];

		foreach ($settings as $s)
			$data['notif_updated'][$s['Key']] = $s['UpdatedDateTime'];

		$this->load->view('mastertemplate', $data);
	}

	public function listservicesdata()
	{

		$start      =  $_REQUEST['start'];
        $length     = $_REQUEST['length'];
        $cari_data  = $_REQUEST['search']['value'];

		$datas = $this->method_model->method_with_networks_list($cari_data);

        $total = 9999999;
        $array_data = array();
        $no = $start + 1;

		$flattenedData = [];
		foreach ($datas as $network) {
			if (!empty($network['methods'])) {

				$flattenedData[] = [
					'title' => '<p style="padding:10px;margin:0px;background-color:lightgrey"><b>'.$network['Title'].'</b></p>',
				];

				foreach ($network['methods'] as $method) {
					$flattenedData[] = [
						'title' => '<p style="padding:10px;margin:0px">'.$method['Title'].'</p>',
						'DeliveryTime' => '<p style="padding:10px;margin:0px">'.$method['DeliveryTime'].'</p>',
						'methodPrice' => '<p style="padding:10px;margin:0px">'.$method['Price'].'</p>'
					];
				}
			}
		}

		foreach ($flattenedData as $method) {

			$data['title'] = $method['title'];
			$data['delivery_time'] = $method['DeliveryTime'];
			$data['price'] = $method['methodPrice'];

			array_push($array_data, $data);
		}

		$no++;

        $output = array(

            "draw" => intval($_REQUEST['draw']),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            "data" => $array_data
        );


        echo json_encode($output);
	}
	
	######################## Verify Imei Request FOrm display #########################
	
	public function verify()
	{
		$data = array();
		$data['Title'] = "Verify Imei Request";
		$data['imeimethods'] = $this->method_model->get_where(array('Status'=> 'Enabled'));
		$data['template'] = "member/imei/verifyrequest";
		$id = $this->session->userdata('MemberID');
		$data['credit'] = $this->credit_model->get_credit($id);

		$settings = $this->setting_model->get_all();
		foreach ($settings as $s)
			$data['notif'][$s['Key']] = $s['Value'];

		foreach ($settings as $s)
			$data['notif_updated'][$s['Key']] = $s['UpdatedDateTime'];

		$this->load->view('mastertemplate', $data);
	}
	
	######################## Insert Verify Imei Request  #########################
	
	public function verifyinsert()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('orderid' , 'order id' ,'required');
		$this->form_validation->set_rules('code' , 'code' ,'required');
		$this->form_validation->set_rules('imei' , 'imei' ,'required');
		if($this->form_validation->run() === FALSE)	
		{
			$this->session->set_flashdata("fail", $this->lang->line('error_please_fill_all_required'));
			$this->index();	
		}
		else 
		{
			$data = $this->input->post(NULL,TRUE);
			
			$order_data = $this->imeiorder_model->get_order_details(array('gsm_imei_orders.ID' => $data['orderid'], 'gsm_imei_orders.IMEI' => $data['imei'], 'gsm_imei_orders.Code' => $data['code'] ));
			
			if(!empty($order_data))
			{
				if($order_data[0]['verify'] == 0 )
				{
					$update['verify'] = 1;
					$update['Status'] = 'Verified';
					$update['UpdatedDateTime'] = date("Y-m-d H:i:s");
					
					$this->imeiorder_model->update($update,$data['orderid']);
					
					$this->session->set_flashdata("success", $this->lang->line('error_request_submit'));
					redirect(site_url('member/imeirequest/verify'));
				}
				else 
				{
					$this->session->set_flashdata("fail", $this->lang->line('error_already_verify_request'));
					redirect(site_url('member/imeirequest/verify'));
				}
			}
			else 
			{
				$this->session->set_flashdata("fail", $this->lang->line('error_record_not_found'));
				redirect(site_url('member/imeirequest/verify'));
			}
			
		}
	}
		
	################# Ajax form request fields shown according to database criteria ####
	
	public function formfields()
	{
		if($this->input->is_ajax_request() === TRUE && $this->input->post('MethodID') !== FALSE)
		{
			$member_id = $this->session->userdata('MemberID');
			$id = $this->input->post('MethodID');	
			
			$method = $this->method_model->get_where(array('ID' => $id));			
			$pricing = $this->method_model->get_user_price($member_id, $id);
			
			$data['field_type'] = $method[0]['FieldType'];
			$data['price'] = floatval($pricing[0]['Price']);
			$data['delivery_time'] = $method[0]['DeliveryTime'];
			$data['description'] = $method[0]['Description'];
			
			## DropDowns ##
			$data['providers'] = $method[0]['Provider'] == 1? $this->provider_model->get_where(array('MethodID' => $id)):NULL;
			$data['models'] = $method[0]['Mobile'] == 1? $this->servicemodel_model->get_where(array('MethodID' => $id)):NULL;
			$data['meps'] = $method[0]['MEP'] == 1? $this->mep_model->get_where(array('MethodID' => $id)):NULL;
			## Text Boxes ##
			$data['pin'] = $method[0]['PIN'] == 1? TRUE:FALSE;
			$data['kbh'] = $method[0]['KBH'] == 1? TRUE:FALSE;
			$data['prd'] = $method[0]['PRD'] == 1? TRUE:FALSE;
			$data['type'] = $method[0]['Type'] == 1? TRUE:FALSE;
			$data['locks'] = $method[0]['Locks'] == 1? TRUE:FALSE;
			$data['serial_number'] = $method[0]['SerialNumber'] == 1? TRUE:FALSE;
			$data['reference'] = $method[0]['Reference'] == 1? TRUE:FALSE;
			$data['extra_information'] = $method[0]['ExtraInformation'] == 1? TRUE:FALSE;

			$data['iCloudCarrierInfo'] = $method[0]['iCloudCarrierInfo'] == 1? TRUE:FALSE;
			$data['iCloudAppleIDHint'] = $method[0]['iCloudAppleIDHint'] == 1? TRUE:FALSE;
			$data['iCloudActivationLockScreenshot'] = $method[0]['iCloudActivationLockScreenshot'] == 1? TRUE:FALSE;
			$data['iCloudIMEINumberScreenshot'] = $method[0]['iCloudIMEINumberScreenshot'] == 1? TRUE:FALSE;
			$data['iCloudAppleIdEmail'] = $method[0]['iCloudAppleIdEmail'] == 1? TRUE:FALSE;
			$data['iCloudAppleIdScreenshot'] = $method[0]['iCloudAppleIdScreenshot'] == 1? TRUE:FALSE;
			$data['iCloudAppleIdInfo'] = $method[0]['iCloudAppleIdInfo'] == 1? TRUE:FALSE;
			$data['iCloudPhoneNumber'] = $method[0]['iCloudPhoneNumber'] == 1? TRUE:FALSE;
			$data['iCloudID'] = $method[0]['iCloudID'] == 1? TRUE:FALSE;
			$data['iCloudPassword'] = $method[0]['iCloudPassword'] == 1? TRUE:FALSE;
			$data['iCloudUDID'] = $method[0]['iCloudUDID'] == 1? TRUE:FALSE;
			$data['iCloudICCID'] = $method[0]['iCloudICCID'] == 1? TRUE:FALSE;
			$data['iCloudVideo'] = $method[0]['iCloudVideo'] == 1? TRUE:FALSE;
			
			//var_dump($data); exit;
			$this->load->view("member/imei/loadrequiredfield", $data);
		}
	}

	public function formfieldstext()
	{
		if($this->input->is_ajax_request() === TRUE && $this->input->post('MethodID') !== FALSE)
		{
			$member_id = $this->session->userdata('MemberID');
			$id = $this->input->post('MethodID');	
			
			$method = $this->method_model->get_where(array('ID' => $id));			
			$pricing = $this->method_model->get_user_price($member_id, $id);
			
			$data['field_type'] = $method[0]['FieldType'];
			$data['price'] = floatval($pricing[0]['Price']);
			$data['delivery_time'] = $method[0]['DeliveryTime'];
			$data['description'] = $method[0]['Description'];
			
			## DropDowns ##
			$data['providers'] = $method[0]['Provider'] == 1? $this->provider_model->get_where(array('MethodID' => $id)):NULL;
			$data['models'] = $method[0]['Mobile'] == 1? $this->servicemodel_model->get_where(array('MethodID' => $id)):NULL;
			$data['meps'] = $method[0]['MEP'] == 1? $this->mep_model->get_where(array('MethodID' => $id)):NULL;
			## Text Boxes ##
			$data['pin'] = $method[0]['PIN'] == 1? TRUE:FALSE;
			$data['kbh'] = $method[0]['KBH'] == 1? TRUE:FALSE;
			$data['prd'] = $method[0]['PRD'] == 1? TRUE:FALSE;
			$data['type'] = $method[0]['Type'] == 1? TRUE:FALSE;
			$data['locks'] = $method[0]['Locks'] == 1? TRUE:FALSE;
			$data['serial_number'] = $method[0]['SerialNumber'] == 1? TRUE:FALSE;
			$data['reference'] = $method[0]['Reference'] == 1? TRUE:FALSE;
			$data['extra_information'] = $method[0]['ExtraInformation'] == 1? TRUE:FALSE;

			$data['iCloudCarrierInfo'] = $method[0]['iCloudCarrierInfo'] == 1? TRUE:FALSE;
			$data['iCloudAppleIDHint'] = $method[0]['iCloudAppleIDHint'] == 1? TRUE:FALSE;
			$data['iCloudActivationLockScreenshot'] = $method[0]['iCloudActivationLockScreenshot'] == 1? TRUE:FALSE;
			$data['iCloudIMEINumberScreenshot'] = $method[0]['iCloudIMEINumberScreenshot'] == 1? TRUE:FALSE;
			$data['iCloudAppleIdEmail'] = $method[0]['iCloudAppleIdEmail'] == 1? TRUE:FALSE;
			$data['iCloudAppleIdScreenshot'] = $method[0]['iCloudAppleIdScreenshot'] == 1? TRUE:FALSE;
			$data['iCloudAppleIdInfo'] = $method[0]['iCloudAppleIdInfo'] == 1? TRUE:FALSE;
			$data['iCloudPhoneNumber'] = $method[0]['iCloudPhoneNumber'] == 1? TRUE:FALSE;
			$data['iCloudID'] = $method[0]['iCloudID'] == 1? TRUE:FALSE;
			$data['iCloudPassword'] = $method[0]['iCloudPassword'] == 1? TRUE:FALSE;
			$data['iCloudUDID'] = $method[0]['iCloudUDID'] == 1? TRUE:FALSE;
			$data['iCloudICCID'] = $method[0]['iCloudICCID'] == 1? TRUE:FALSE;
			$data['iCloudVideo'] = $method[0]['iCloudVideo'] == 1? TRUE:FALSE;
			
			//var_dump($data); exit;
			echo json_encode($data);
		}
	}
	
	###### Place IMER Request Order and deduct charges ################################
	
	public function insert()
	{
		$this->load->library('form_validation');
		$data = $this->input->post(NULL, TRUE);
		$method_id = $data['MethodID'];
		switch ($data['field_type']) 
		{
			case ORDER_FIELD_TYPE_SN:
				$this->form_validation->set_rules('IMEI' , 'Serial No' ,'trim|required|callback_sn_check|callback_duplicate_check['.$method_id.']');	
				break;
			case ORDER_FIELD_TYPE_IMEI:
				$this->form_validation->set_rules('IMEI' , 'IMEI' ,'trim|required|callback_imei_check|callback_duplicate_check['.$method_id.']');
				break;
			default:
				$this->form_validation->set_rules('IMEI' , 'IMEI / Serial No' ,'trim|required|callback_duplicate_check['.$method_id.']');
				break;
		}
		$this->form_validation->set_rules('MethodID' , 'Method' ,'required');
		$this->form_validation->set_rules('Email' , 'Email' ,'valid_email');
		$this->form_validation->set_rules('Note' , 'Note' ,'max_length[255]');
		if($this->form_validation->run() === FALSE)	
		{
			$this->index();	
		}
		else 
		{
			$member_id = $this->session->userdata('MemberID');
			$credit = $this->credit_model->get_credit($member_id);
			$pricing = $this->method_model->get_user_price_new($method_id);

			$price = floatval($pricing[0]['Price']);
			
			#### Get IMEI CODES,Count Requests For Orders check Credit
			$imei_data = explode(PHP_EOL, $data['IMEI']);			
			$total_price = count($imei_data) * $price;

			if($total_price > $credit )
			{
				$this->session->set_flashdata('message', $this->lang->line('error_not_enough_credit'));
				redirect("member/imeirequest/");
			}
			
			#### Place Order			
			foreach($imei_data as $key => $val)
			{
				$insert = array();
				$insert['MethodID'] = $method_id;
				$insert['IMEI'] = $val;
				$insert['Email'] = $data['Email'];

				$insert['MemberID'] = $member_id;
				$insert['Maker'] = array_key_exists("Maker", $data)? $data['Maker']: NULL;
				$insert['Model'] = array_key_exists("Model", $data)? $data['Model']: NULL;				
				## API Fields ##
				$insert['ExtraInformation'] = array_key_exists("ExtraInformation", $data)? $data['ExtraInformation']:NULL;
				$insert['SerialNumber'] = array_key_exists("SerialNumber", $data)? $data['SerialNumber']: NULL;
				$insert['ModelID'] = array_key_exists("ModelID", $data)? $data['ModelID']: NULL;				
				$insert['ProviderID'] = array_key_exists("ProviderID", $data)? $data['ProviderID']: NULL;
				$insert['MEPID'] = array_key_exists("MEPID", $data)? $data['MEPID']: NULL;
				$insert['PIN'] = array_key_exists("PIN", $data)? $data['PIN']: NULL;
				$insert['KBH'] = array_key_exists("KBH", $data)? $data['KBH']: NULL;
				$insert['PRD'] = array_key_exists("PRD", $data)? $data['PRD']: NULL;
				$insert['Type'] = array_key_exists("Type", $data)? $data['Type']: NULL;
				$insert['Locks'] = array_key_exists("Locks", $data)? $data['Locks']: NULL;
				$insert['Reference'] = array_key_exists("Reference", $data)? $data['Reference']: NULL;

				$insert['iCloudCarrierInfo'] = array_key_exists('iCloudCarrierInfo', $data)? $data['iCloudCarrierInfo']: NULL;
				$insert['iCloudAppleIDHint'] = array_key_exists('iCloudAppleIDHint', $data)? $data['iCloudAppleIDHint']: NULL;
				$insert['iCloudActivationLockScreenshot'] = array_key_exists('iCloudActivationLockScreenshot', $data)? $data['iCloudActivationLockScreenshot']: NULL;
				$insert['iCloudIMEINumberScreenshot'] = array_key_exists('iCloudIMEINumberScreenshot', $data)? $data['iCloudIMEINumberScreenshot']: NULL;
				$insert['iCloudAppleIdEmail'] = array_key_exists('iCloudAppleIdEmail', $data)? $data['iCloudAppleIdEmail']: NULL;
				$insert['iCloudAppleIdScreenshot'] = array_key_exists('iCloudAppleIdScreenshot', $data)? $data['iCloudAppleIdScreenshot']: NULL;
				$insert['iCloudAppleIdInfo'] = array_key_exists('iCloudAppleIdInfo', $data)? $data['iCloudAppleIdInfo']: NULL;
				$insert['iCloudPhoneNumber'] = array_key_exists('iCloudPhoneNumber', $data)? $data['iCloudPhoneNumber']: NULL;
				$insert['iCloudID'] = array_key_exists('iCloudID', $data)? $data['iCloudID']: NULL;
				$insert['iCloudPassword'] = array_key_exists('iCloudPassword', $data)? $data['iCloudPassword']: NULL;
				$insert['iCloudUDID'] = array_key_exists('iCloudUDID', $data)? $data['iCloudUDID']: NULL;
				$insert['iCloudICCID'] = array_key_exists('iCloudICCID', $data)? $data['iCloudICCID']: NULL;
				$insert['iCloudVideo'] = array_key_exists('iCloudVideo', $data)? $data['iCloudVideo']: NULL;
				
				$insert['Note'] = $data['Note'];
				$insert['Status'] = 'Pending';
				$insert['UpdatedDateTime'] = date("Y-m-d H:i:s");
				$insert['CreatedDateTime'] = date("Y-m-d H:i:s");

				$insert_id = $this->imeiorder_model->insert($insert);
				
				#####Deduct Credits from available credits
				$credit_data = array(
					'MemberID' => $member_id,
					'TransactionCode' => IMEI_CODE_REQUEST,
					'TransactionID' => $insert_id,
					'Description' => "IMEI Code request against imei:".$val,
					'Amount' => -1 * abs($price),
					'CreatedDateTime' => date("Y-m-d H:i:s")
				);
				$this->credit_model->insert($credit_data);
				
				## Send Email with Template ## 		
				$data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 10)); // New order notification
    			if( count($data) > 0 )
    			{
    				$from_name = $data[0]['FromName'];
    				$from_email = $data[0]['FromEmail'];
    				$to_email = $data[0]['ToEmail'];
    				$subject = $data[0]['Subject'];
    				$message = html_entity_decode($data[0]['Message']);
    
    				//Information
    				$post['IMEI'] = $insert['IMEI'];
    				$post['FirstName'] = $insert['FirstName'];
    				$post['LastName'] = $insert['LastName'];
    				$post['Email'] = $insert['Email'];
    
    				$this->fsd->email_template($post, $from_email, $from_name, $to_email, $subject, $message );
    				$this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
    			}

			}						
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert" role="danger"> '.$this->lang->line('error_record_addes_successfully').'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

			redirect("member/imeirequest/");
		}
	}
	
	public function history()
	{
		$data = array();
		$data['Title'] = "IMEI Service History";
		$data['template'] = "member/imei/requesthistory";

		$data['content'] = "member/imei/requesthistory";
		$data['content_js'] = "imei_request/imeiRequest.js";

		$settings = $this->setting_model->get_all();
		foreach ($settings as $s)
			$data['notif'][$s['Key']] = $s['Value'];

		foreach ($settings as $s)
			$data['notif_updated'][$s['Key']] = $s['UpdatedDateTime'];

		$this->load->view('mastertemplate', $data);
	}
	
	public function listener($status)
	{
		$id = $this->session->userdata('MemberID');
		echo $this->imeiorder_model->get_imei_data_select($id, $status);
	}

	public function listener_new()
	{
		$id = $this->session->userdata('MemberID');
		$param = $this->input->post('param');

		$start      =  $_REQUEST['start'];
        $length     = $_REQUEST['length'];
        $cari_data  = $_REQUEST['search']['value'];

        $datas = $this->imeiorder_model->get_imei_data_select_new($id, $param, $start, $length, $cari_data);

        $total = 9999999;
        $array_data = array();
        $no = $start + 1;
        if (!empty($datas) && $datas != null) {

            foreach ($datas as $d) {

                $data["no"]          = $no;
                $data["imei"]        = $d['IMEI'];
                $data["service"] 	 = $d['Title'];
                $data["code"]     	 = $d['Code'];
                $data["note"]        = $d['Note'];
                $data["status"]      = $d['Status'];
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
	
	/* IMEI Validation */
	public function duplicate_check($imeis, $method_id)
	{
		$imeis = explode(PHP_EOL, $imeis);	
		$imeis = array_unique($imeis);

		$orders = $this->imeiorder_model->get_duplicates( $imeis, $this->session->userdata('MemberID'), $method_id);
		if(!empty($orders))
		{
			$imeis = array_column($orders, 'IMEI');
			$imeis = array_unique($imeis);
			$imeis = implode(', ', $imeis);
			$this->form_validation->set_message('duplicate_check', 'The Serial No / IMEI('.$imeis.') already requested.');
			return FALSE;			
		}
		return TRUE;
	}

	public function sn_check($str)
	{
		$sns = explode(PHP_EOL, $str);		
		$sns = array_unique($sns);
		foreach($sns as $sn)
		{	
			if( strlen($sn) != 12 ) 
			{
				$this->form_validation->set_message('sn_check', 'One or more Serial No(s) are invalid.');
				return FALSE;
			}			
		}
		return TRUE;
	}

	public function imei_check($str)
	{
		$imeis = explode(PHP_EOL, $str);		
		$imeis = array_unique($imeis);
		
		foreach($imeis as $imei)
		{	
			if( TRUE !== $this->is_imei($imei) ) 
			{
				$this->form_validation->set_message('imei_check', 'One or more IMEI(s) are invalid.');
				return FALSE;
			}			
		}
		return TRUE;		
	}
	
	private function is_imei($imei)
	{
		// Should be 15 digits
		if(strlen($imei) != 15 || !ctype_digit($imei))
			return false;
		// Get digits
		$digits = str_split($imei);
		// Remove last digit, and store it
		$imei_last = array_pop($digits);
		// Create log
		$log = array();
		// Loop through digits
		foreach($digits as $key => $n)
		{
			// If key is odd, then count is even
			if($key & 1)
			{
				// Get double digits
				$double = str_split($n * 2);
				// Sum double digits
				$n = array_sum($double);
			}
			// Append log
			$log[] = $n;
		}
		// Sum log & multiply by 9
		$sum = array_sum($log) * 9;
		// Compare the last digit with $imei_last
		return substr($sum, -1) == $imei_last;
	}
}