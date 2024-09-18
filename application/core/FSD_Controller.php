<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class FSD_Controller extends CI_Controller
{
	var $settings = [];

	public function __construct()
	{
		parent::__construct();
	}
	 
	public function authorization() 
	{
		$this->load->model('employee_model');
		if( $this->session->userdata('is_admin_logged_in') === FALSE)
			redirect('admin/session/?return_url='.str_replace($this->config->item('url_suffix'), "", current_url()));	
	}

	public function get_settings()
	{
		$settings = $this->setting_model->get_all();
		foreach ($settings as $v) 
			$this->settings[$v['Key']] = $v['Value'];
	}
	
	public function member_authorization()
	{  
		$this->get_settings();
		if( $this->session->userdata('is_member_logged_in') === FALSE)
			redirect('login?return_url='.str_replace($this->config->item('url_suffix'), "", current_url()));
	}
}