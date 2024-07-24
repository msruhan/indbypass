<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Referral extends FSD_Controller 
{
	var $before_filter = array('name' => 'member_authorization', 'except' => array());
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('credit_model');
	}
	
	public function index()
	{
		$data = array();
        $id = $this->session->userdata('MemberID');
        
        $data['Member'] = $this->member_model->get_where(['ID' => $id]);
        $data['Signups'] = $this->member_model->count_where(['ReferralMemberID' => $id]);
        $data['Commission'] = $this->credit_model->get_sum(['TransactionCode' => REFERRAL_MEMBER_COMMISSION, 'MemberID' => $id]);
		$data['Title'] = "Referral Commission";
		$data['template'] = "member/referral";
		$data['credit'] = $this->credit_model->get_credit($id);

		$settings = $this->setting_model->get_all();
		foreach ($settings as $s)
			$data['notif'][$s['Key']] = $s['Value'];

		foreach ($settings as $s)
			$data['notif_updated'][$s['Key']] = $s['UpdatedDateTime'];
		
		$this->load->view('mastertemplate', $data);
	}
}	