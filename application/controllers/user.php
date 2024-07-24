<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends FSD_Controller 
{
	var $before_filter = array('name' => 'get_settings', 'except' => array());
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('method_model');
		$this->load->model('fileservices_model');
		$this->load->model('autoresponder_model');
	}
	
	public function forgot_password()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->form_validation->set_rules('Email', 'Email', 'required|valid_email');
			if ($this->form_validation->run() !== FALSE)
			{
				$query = $this->member_model->get_where(array('Email' => $this->input->post('Email') ));
				if( count($query) > 0)
				{
					//set token for password
					$token = array('Token' => $query[0]['ID']."-".rand(123456789, 987654321) );
					$this->member_model->update($token, $query[0]['ID']);
					## Get Issue Email Template ##
					$data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 4)); // Forgot Password Token Email					
					## Send Email with Template ## 		
					if(isset($data) && count($data)>0)
					{
						$from_name = $data[0]['FromName'];
						$from_email = $data[0]['FromEmail'];
						$to_email = $data[0]['ToEmail'];
						$subject = $data[0]['Subject'];
						$message = html_entity_decode($data[0]['Message']);
						
						//Information
						$post['TokenUrl'] = site_url('user/set_password/'.$token['Token']);
						$post['FirstName'] = $query[0]['FirstName'];
						$post['LastName'] = $query[0]['LastName'];
						$post['Email'] = $query[0]['Email'];
				
						$this->fsd->email_template($post, $from_email, $from_name, $to_email, $subject, $message );
						$this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
						
						$this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible fade show" role="alert" role="danger"> '.$this->lang->line('error_success_email').'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
						redirect('forgot_password');						
					}								   	
				}
				//record not found
				$this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible fade show" role="alert" role="danger"> '.$this->lang->line('error_invalid_email').'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				redirect('forgot_password');	 		
			}
		}
		$data = array();
		$data["title"] = $this->lang->line('forgot_password_heading');
		$data["heading"] = $this->lang->line('forgot_password_heading');
		// $data['master_template'] = "user/forgetpassword";
		$this->load->view("user/forgetpassword", $data);
	}
	
	public function set_password($token)
	{
		if(empty($token))
			redirect('forgot_password');
			
		$data = $this->member_model->get_where(array('Token' => $token, 'Status' => 'Enabled' ));
		if(count($data) > 0)
		{
			$length = 8;
			$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
			## Get Issue Email Template ##
			$template = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 5)); // Forgot Password Token Email					
			## Send Email with Template ## 		
			if(isset($template) && count($template)>0)
			{
				$from_name = $template[0]['FromName'];
				$from_email = $template[0]['FromEmail'];
				$to_email = $template[0]['ToEmail'];
				$subject = $template[0]['Subject'];
				$message = html_entity_decode($template[0]['Message']);
				
				//Information
				$post['Password'] = $password;
				$post['FirstName'] = $data[0]['FirstName'];
				$post['LastName'] = $data[0]['LastName'];
				$post['Email'] = $data[0]['Email'];
		
				$this->fsd->email_template($post, $from_email, $from_name, $to_email, $subject, $message );
				$this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
				
				$userdata = array('Token' => NULL, 'Password' => $password );
				$update = $this->member_model->update($userdata, $data[0]['ID']);
				$this->session->set_flashdata("success", $this->lang->line('error_success_password'));
				redirect('login');						
			}				 				
		}
		$this->session->set_flashdata("fail", $this->lang->line('error_invalid_password'));
		redirect('login');
	}
	
	public function login()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->form_validation->set_rules('Email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('Password', 'Password', 'required|min_length[5]');
			if ($this->form_validation->run() !== FALSE)
			{
				$data = $this->input->post(NULL, TRUE);			
				$query = $this->member_model->get_where(array( 'Email' => $data['Email'], 'Password' => md5($data['Password'])));
				
				if(count($query) > 0)
				{
					if($query[0]["Status"] == "Enabled")
					{
						$session = array(
							'MemberID' => $query[0]['ID'],
							'MemberEmail' => $query[0]['Email'],
							'MemberFirstName' => $query[0]['FirstName'],
							'MemberLastName' => $query[0]['LastName'],
							'MemberPhone' => $query[0]['Mobile'],
							'is_member_logged_in' => TRUE 
						);
						$this->session->set_userdata($session);					
						redirect('member/dashboard');
					}	
					else 
					{
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" role="danger"> '.$this->lang->line('error_account_deactivated').'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
						redirect('login');
					}
				}
				else 
				{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert" role="danger"> '.$this->lang->line('error_invalid_login').'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
					redirect('login');
				}			 
			}
		}
		$data = array();
		$data["title"] = "Login";
		$data["heading"] = "Login";
		// $data['master_template'] = "user/login";
		$this->load->view("user/login",$data);				
	}

	public function register()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{		
			$this->form_validation->set_rules('FirstName', 'First Name', 'required|min_length[3]');
			$this->form_validation->set_rules('LastName', 'Last Name', 'required|min_length[3]');
			$this->form_validation->set_rules('Email', 'Email', 'required|valid_email|is_unique[gsm_members.Email]');
			$this->form_validation->set_rules('Password', 'Password', 'required|min_length[5]');
			$this->form_validation->set_rules('CPassword', 'Confirm Password', 'required|matches[Password]');
			## set custom validation error messages ##
			$this->form_validation->set_message('is_unique', $this->lang->line('error_email_already_registered'));			
			if ($this->form_validation->run() !== FALSE)
			{
				$data = $this->input->post(NULL, TRUE); //collect form data				
				//register data to database
				$token = rand(123456789, 987654321);
				unset($data['CPassword']);
				$data['Token'] = $token;
				$data['ReferralMemberID'] = $this->session->userdata('referral')? $this->session->userdata('referral'): NULL;
				$data['Status'] = 'Disabled';
                $data["CreatedDateTime"] = date("y-m-d H:i:s");
								
				$this->member_model->insert($data);	
				## Get Issue Email Template ##
				$template = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 1)); // Registration Email					
				## Send Email with Template ## 		
				if(isset($template) && count($template)>0)
				{
					$from_name = $template[0]['FromName'];
					$from_email = $template[0]['FromEmail'];
					$to_email = $template[0]['ToEmail'];
					$subject = $template[0]['Subject'];
					$message = html_entity_decode($template[0]['Message']);
					
					//Information
					$post['Password'] = $data['password'];
					$post['FirstName'] = $data['FirstName'];
					$post['LastName'] = $data['LastName'];
					$post['Email'] = $data['Email'];
					$post['Password'] = $this->input->post('Password', TRUE);
					$post['TokenUrl'] = site_url('user/verify/'.$token);
				
					$this->fsd->email_template($post, $from_email, $from_name, $to_email, $subject, $message );
					$this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
				}

				## Get Issue Email Template ##
				$template = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 8)); // Registration notification to admin
				## Send Email with Template ## 		
				if(isset($template) && count($template)>0)
				{
					$from_name = $template[0]['FromName'];
					$from_email = $template[0]['FromEmail'];
					$to_email = $template[0]['ToEmail'];
					$subject = $template[0]['Subject'];
					$message = html_entity_decode($template[0]['Message']);
					
					//Information
					$post['Password'] = $data['password'];
					$post['FirstName'] = $data['FirstName'];
					$post['LastName'] = $data['LastName'];
					$post['Email'] = $data['Email'];
					$post['Password'] = $this->input->post('Password', TRUE);					
				
					$this->fsd->email_template($post, $from_email, $from_name, $to_email, $subject, $message );
					$this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
				}
				$this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible fade show" role="alert" role="danger"> '.$this->lang->line('error_verification_email').'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				redirect('login');									
			}
		}
		$referral = $this->input->get('referral', TRUE); 
		if( !empty($referral) )
		{
			$this->session->set_userdata('referral', $referral);
			$this->member_model->increase_referal_count($referral);
		}

		$data = array();
		$data["title"] = $this->lang->line('register_heading');
		$data["heading"] = $this->lang->line('register_heading');
		// $data['master_template'] = "user/register";
		$this->load->view("user/register",$data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');	
	}

	public function services_list()
	{
		$this->load->model('method_model');
		$data = array();
		$data['imei_services'] = $this->method_model->method_with_networks();
		$data["title"] = $this->lang->line('services_heading');
		$data["heading"] = $this->lang->line('services_heading');
		$data['master_template'] = "user/services_list";
		$this->load->view("user/master_template", $data);
	}

	public function verify($token)
	{
		if(empty($token))
			redirect('login');
			
		$data = $this->member_model->get_where(array('Token' => $token, 'Status' => 'Disabled' ));
		if(count($data) > 0)
		{
			$userdata = [
				'Token' => NULL, 
				'Status' => 'Enabled',
				'UpdatedDateTime' => date("y-m-d H:i:s")
			];
			$update = $this->member_model->update($userdata, $data[0]['ID']);
			$this->session->set_flashdata("success", $this->lang->line('error_success_account_verified'));
			redirect('login');
		}
		$this->session->set_flashdata("fail", $this->lang->line('error_invalid_token'));
		redirect('login');
	}

	public function unsubscribe()
	{
		$this->session->set_flashdata("success", $this->lang->line('error_unsubscribe_msg'));
		redirect('login');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */