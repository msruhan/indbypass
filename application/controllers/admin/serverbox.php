<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Serverbox extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	var $module_name = 'Server Boxes Manager';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('serverbox_model');
		$this->load->model('member_model');		
	}
	
	public function index()
	{
		$data['template'] = "admin/serverbox/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->serverbox_model->get_datatable($this->access);
	}

	public function add()
	{
		$data['template'] = "admin/serverbox/add";
		$this->load->view('admin/master_template',$data);
	}

	public function edit($id)
	{		
		$data['data'] = $this->serverbox_model->get_where(array('ID'=> $id));
		$data['template'] = "admin/serverbox/edit";
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{
		if($id == 1)
		{
			$this->session->set_flashdata('warning', 'Default box can not be delete.');
			redirect("admin/serverbox/");
		}
		
		$c = $this->member_model->count_where(array('MemberGroupID' => $id));
		if($c > 0)
		{
			$this->session->set_flashdata('warning', 'This box can not be delete, It has '.$c.' members.');
			redirect("admin/serverbox/");
		}		
		$this->serverbox_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/serverbox/");
	}
	
	public function insert()
	{
		$this->load->library('form_validation');				
		
		$this->form_validation->set_rules('Title' , 'Title' ,'required');

		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL, TRUE);	
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$data['CreatedDateTime'] = date("Y-m-d H:i:s");
			$groupid = $this->serverbox_model->insert($data); //insert group and return id
			
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/serverbox/");
		}
	}		

	public function update()
	{
		$this->load->library('form_validation');
		$data = $this->input->post(NULL, TRUE);
		$id = $data['ID'];		
				
		$this->form_validation->set_rules('Title' , 'Title' ,'required');
		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);					
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$this->serverbox_model->update($data, $id);
			
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/serverbox/");
		}
	}
}

/* End of file group.php */
/* Location: ./application/controllers/admin/group.php */