<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Serverorder extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	var $module_name = 'Server Orders Manager';
	var $status;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('serverorder_model');
		$this->load->model('serverservice_model');
		$this->load->model('credit_model');
		$this->load->model('autoresponder_model');
		$this->load->model('member_model');
		$this->status = array(''=>'', 'Pending'=>'Pending', 'Issued'=>'Issued', 'Cancelled'=>'Cancelled');
	}
	
	public function index()
	{
		$data['template'] = "admin/serverorder/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->serverorder_model->get_datatable($this->access);
	}	

	public function edit($id)
	{
		$service_list = array('0'=>'');
		foreach ($this->serverservice_model->get_all() as $value) 
			$service_list[$value['ID']] = $value['Title'];
		$data['box_list'] = $service_list;
		$data['status_list'] = $this->status;
		$data['data'] = $this->serverorder_model->get_where(array('ID'=> $id));			
		$data['template'] = "admin/serverorder/edit";
		$this->load->view('admin/master_template',$data);
	}	

	public function update()
	{
		$this->load->library('form_validation');
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];		
				
		$this->form_validation->set_rules('ServerServiceID' , 'Server Box / Tool' ,'required');
		$this->form_validation->set_rules('Email' , 'Email' ,'required|valid_email');
		$this->form_validation->set_rules('Note' , 'Note' ,'');
		$this->form_validation->set_rules('Comments' , 'Comments' ,'');		
		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);					
			$data['RequiredFields'] = isset($data['RequiredFields'])? json_encode($data['RequiredFields']): NULL;
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
						
			$this->serverorder_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/serverorder/");
		}
	}

	public function bulk()
	{
		$json = $this->input->post('json', TRUE);		
		$ids = json_decode($json);
		
		if(count($ids) < 1 )
		{
			$this->session->set_flashdata('error', 'No record selected.');
			redirect("admin/serverorder/");				
		}
		$data['data'] = $this->serverorder_model->get_where_in($ids);
		$data['template'] = "admin/serverorder/bulk";
		$this->load->view('admin/master_template',$data);			
	}
	
	public function bulk_operation()
	{
		$post = $this->input->post(NULL, TRUE);
		## Refund Issue to selected codes ##
        if(isset($post['refund']) && count($post['refund'])>0)
        {
            foreach ($post['refund'] as $id) 
            {
                $order = $this->serverorder_model->get_where(array( 'ID' => $id, 'Status' => 'Pending' ));
                if( is_array($order) && count($order) > 0 )
                {
                    $data = array();
                    $data['Code'] = empty($post['Code'][$id])? NULL: $post['Code'][$id];
                    $data['Comments'] = empty($post['Comments'][$id])? NULL: $post['Comments'][$id];
                    $data['Status'] = 'Canceled';
                    $data['UpdatedDateTime'] = date("Y-m-d H:i:s");									
                    $this->serverorder_model->update($data, $id);
                    
                    ## Amount Refund ##
                    $this->credit_model->refund($id, SERVER_CODE_REQUEST, $order[0]['MemberID']);
                    ## Get Canceled Email Template ##
                    $data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 2)); // IMEI Code Canceled
                    ## Send Email with Template ## 		
                    if(isset($data) && count($data)>0)
                    {
                        $from_name = $data[0]['FromName'];
                        $from_email = $data[0]['FromEmail'];
                        $to_email = $data[0]['ToEmail'];	
                        $subject = $data[0]['Subject'];
                        $message = html_entity_decode($data[0]['Message']);
                        //get member information
                        $member = $this->member_model->get_where(array('ID' => $order[0]['MemberID']));				

                        //Information
						$param['Code'] = empty($post['Code'][$id])? '': $post['Code'][$id];
                        $param['IMEI'] = $order[0]['IMEI'];
                        $param['FirstName'] = $member[0]['FirstName'];
                        $param['LastName'] = $member[0]['LastName'];
						$param['Email'] = empty($order[0]['Email'])? $member[0]['Email']: $order[0]['Email'];

                        $this->fsd->email_template($param, $from_email, $from_name, $to_email, $subject, $message );
                        $this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
                    }
                }		
            } // foreachend
        }
		## Bulk Isse code ##
		foreach ($post['Code'] as $id => $code) 
		{
			if( !empty($code) && ( !isset($post['refund']) || !in_array($id, $post['refund'] ) ))
			{
				$order = $this->serverorder_model->get_where(array( 'ID' => $id, 'Status' => 'Pending' ));
				if(is_array($order) && count($order) > 0)
				{				
					$data = array();
					$data['Code'] = $code;
					$data['Comments'] = empty($post['Comments'][$id])? NULL: $post['Comments'][$id];
					$data['Status'] = 'Issued';
					$data['UpdatedDateTime'] = date("Y-m-d H:i:s");									
					$this->serverorder_model->update($data, $id);
					## Get Issue Email Template ##
					$data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 10)); // server Code Issed
					## Send Email with Template ## 		
					if(isset($data) && count($data)>0)
					{
						$from_name = $data[0]['FromName'];
						$from_email = $data[0]['FromEmail'];
						$to_email = $data[0]['ToEmail'];
						$subject = $data[0]['Subject'];
						$message = html_entity_decode($data[0]['Message']);
						//get member information
						$member = $this->member_model->get_where(array('ID' => $order[0]['MemberID']));

						//Information
						$param['Code'] = $code;
						$param['FirstName'] = $member[0]['FirstName'];
						$param['LastName'] = $member[0]['LastName'];					
						$param['Email'] = empty($order[0]['Email'])? $member[0]['Email']: $order[0]['Email'];
					
						$this->fsd->email_template($param, $from_email, $from_name, $to_email, $subject, $message );
						$this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
					}				
				}
			}
		}
		$this->session->set_flashdata('success', 'Bulk operation has been successfully completed.');
		redirect("admin/serverorder/");
	}
	
	public function cancel($id)
	{
		$order = $this->serverorder_model->get_where(array( 'ID' => $id, 'Status' =>'Pending' ));
		if(isset($order[0]) && count($order) > 0)
		{
			$data['Code'] = 'Cancelled';
			$data['Comments'] = 'Cancelled';
			$data['Status'] = 'Cancelled';
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$this->serverorder_model->update($data, $id);
			
			## Amount Refund ##
			$this->credit_model->refund($id, SERVER_CODE_REQUEST, $order[0]['MemberID']);
			## Get Canceled Email Template ##
			$data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 9)); // IMEI Code Canceled
			## Send Email with Template ## 		
			if(isset($data) && count($data)>0)
			{
				$from_name = $data[0]['FromName'];
				$from_email = $data[0]['FromEmail'];
				$to_email = $data[0]['ToEmail'];
				$subject = $data[0]['Subject'];
				$message = html_entity_decode($data[0]['Message']);
				
				//get member information
				$member = $this->member_model->get_where(array('ID' => $order[0]['MemberID']));
				
				//Information
				$post['Code'] = 'Cancelled';
				$post['FirstName'] = $member[0]['FirstName'];
				$post['LastName'] = $member[0]['LastName'];
				$post['Email'] = $order[0]['Email'];	
				$post['Email'] = empty($order[0]['Email'])? $member[0]['Email']: $order[0]['Email'];									

				$this->fsd->email_template($post, $from_email, $from_name, $to_email, $subject, $message );
				$this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
			}			
			$this->session->set_flashdata('success', 'Order has been canceled successfully and a refund has been issued.');
			redirect("admin/serverorder/");
		}
		$this->session->set_flashdata('error', 'Only pending orders can be canncelled.');
		redirect("admin/serverorder/");		
	}
	
	public function delete($id)
	{
		$this->serverorder_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/serverorder/");
	}
}

/* End of file serverorder.php */
/* Location: ./application/controllers/admin/serverorder.php */