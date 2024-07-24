<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class checkout extends FSD_Controller 
{
	var $before_filter = array('name' => 'member_authorization', 'except' => array());
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('merchant');
		$this->merchant->load('paypal_express');
		$this->load->model('payment_model');
		$this->load->model('credit_model');
		$this->load->model('member_model');
	}
	
	public function index()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->form_validation->set_rules('Credit', 'Credit', 'required|numeric|greater_than[4.99]');
			if($this->form_validation->run() === FALSE)
			{
				$this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible fade show" role="alert" role="danger"> '.validation_errors().'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				redirect('member/dashboard/addfund');
			}
			else
			{
				### Get Paypal settings
				$paypal_settings = $this->payment_model->get_where(array('ID'=>1));
				
				### Initilize settings	      		
				$settings = array(
					'username' => $paypal_settings[0]['UserName'],
					'password' => $paypal_settings[0]['Password'],
					'signature' => $paypal_settings[0]['Signature'],
					'test_mode' => TEST_MODE
				);
				$this->merchant->initialize($settings);
				
				### Set amount on the basis of percent
				$amount = $this->input->post('Credit');
				$this->session->set_userdata('addcredit', $amount);
				if($paypal_settings > 0)
				{
					$percent = ( ( $amount * $paypal_settings[0]['percent'] ) / 100 );
					$amount += $percent;
					$amount += 0.35; // PayPal extra fee
				}
				$this->session->set_userdata('addamount', $amount);
				
				### set paramerters for paypals
				$params = array(
					'amount' => $amount,
					'name' => 'Store Credits',
					'description' => 'Add Store Credits '. $this->input->post('Credit'),
					'currency' => $paypal_settings[0]['Currency'],
					'return_url' => site_url('member/checkout/complete'),
					'cancel_url' => site_url('member/checkout/cancel')
				);		
				$response = $this->merchant->purchase($params);
				if( is_object($response) && $response->status() == 'failed')
				{
					$this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible fade show" role="alert" role="danger"> '.$this->lang->line('error_unable_process_payment').'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
					redirect('member/dashboard/addfund');	
				}
			}
		}
		else
		{
			redirect('member/dashboard/addfund');
		}
	}
	
	function cancel()
	{
		$this->session->set_userdata('addcredit',"");
		redirect('member/dashboard');
	}
	
	function complete()
	{
		$this->load->library('merchant');
		$this->merchant->load('paypal_express');
		### Get Paypal settings
		$paypal_settings = $this->payment_model->get_where(array('ID'=>1));
		$member_id = $this->session->userdata('MemberID');

	    ### Initilize settings	      		
		$settings = array(
			'username' => $paypal_settings[0]['UserName'],
			'password' => $paypal_settings[0]['Password'],
			'signature' => $paypal_settings[0]['Signature'],
			'test_mode' => TEST_MODE
		);
		$this->merchant->initialize($settings);
		
		$params = array(
			'amount' => $this->session->userdata('addamount'),
			'name' => 'Store Credits',
			'description' => 'Add Store Credits '. $this->session->userdata('addcredit'),
			'currency' => $paypal_settings[0]['Currency'],
			'return_url' => site_url('member/checkout/complete'),
			'cancel_url' => site_url('member/checkout/cancel')
		);
		
		$response = $this->merchant->purchase_return($params);
		if ($response->status() == Merchant_response::COMPLETE)
		{
		    if ($response->success())
			{
				$credits = $this->credit_model->get_where(['Description like' => '%'.$response->reference().'%']);
				if( empty($credits) )
				{
					$this->load->model('credit_model');
					$credit_data = array(
					'MemberID' => $member_id,
					'TransactionCode' => PAYPAL_PAYMENT_RECEIVED,
					'TransactionID' => time(),
					'Description' => "Add Credit from Paypal: ".$response->reference(),
					'Amount' => $this->session->userdata('addcredit'),
					'CreatedDateTime' => date("Y-m-d H:i:s")
					);
					$this->credit_model->insert($credit_data);

					## Referral Commission ##
					if( !empty($this->settings['app_referral_commission']) )
					{
						$already = $this->credit_model->count_where([ 'TransactionCode' => REFERRAL_MEMBER_COMMISSION, 'TransactionID' => $member_id]);
						if( $already == 0 )
						{
							$member = $this->member_model->get_where(['ID' => $member_id]);
							if( !empty($member) && !empty($member[0]['ReferralMemberID']) )
							{
								$commission = floatval($credit_data['Amount']) / 100 * floatval($this->settings['app_referral_commission']);
								$data = array(
									'MemberID' => $member[0]['ReferralMemberID'],
									'TransactionCode' => REFERRAL_MEMBER_COMMISSION,
									'TransactionID' => $member_id,
									'Description' => "Referral commission received from ".$member[0]['FirstName']." " .$member[0]['LastName'],
									'Amount' => $commission,
									'CreatedDateTime' => date("Y-m-d H:i:s")
								);
								$this->credit_model->insert($data);
							}
						}
					}
					
					$this->session->set_flashdata("success", $this->lang->line('error_credit_successfully'));
					redirect('member/dashboard/addfund');
				}
			}
		}
		$this->session->set_flashdata("fail", $this->lang->line('error_transaction_declined'));
		redirect('member/dashboard/addfund');
	}
}