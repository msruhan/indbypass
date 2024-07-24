<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends FSD_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		redirect('login');
	}
	
	public function testmail()
	{
		$from_email = 'support@imei.network';
		$from_name = 'imei.network';
		$to_email = 'shariq2k@yahoo.com';
		$subject = 'This is just a test email';
		$message = 'Hello shariq, its me umza from karachi please contact with me.';
		$this->fsd->sent_email($from_email, $from_name, $to_email, $subject, $message );
		echo $this->email->print_debugger(); exit;
		echo 'SENT';
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */