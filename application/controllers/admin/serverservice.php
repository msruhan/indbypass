<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Serverservice extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	var $module_name = 'Server Services Manager';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('serverbox_model');
		$this->load->model('serverservice_model');
		$this->load->model('serverorder_model');
	}
	
	public function index()
	{
		$data['template'] = "admin/serverservice/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->serverservice_model->get_datatable($this->access);
	}

	public function add()
	{
		$box_list = array('0'=>'');
		foreach ($this->serverbox_model->get_all() as $value)
			$box_list[$value['ID']] = $value['Title'];
		$data['box_list'] = $box_list;
		$data['template'] = "admin/serverservice/add";
		$this->load->view('admin/master_template', $data);
	}

	public function edit($id)
	{
		$box_list = array('0'=>'');
		foreach ($this->serverbox_model->get_all() as $value)
			$box_list[$value['ID']] = $value['Title'];
		$data['box_list'] = $box_list;
		$data['data'] = $this->serverservice_model->get_where(array('ID'=> $id));
		$data['template'] = "admin/serverservice/edit";
		$this->load->view('admin/master_template', $data);
	}
		
	public function delete($id)
	{
		$result = $this->serverorder_model->count_where(array('ServerServiceID' => $id));
		if($result > 0)
		{
			$this->session->set_flashdata('warning', $result . ' order(s) are associated with this service.');
			redirect("admin/serverservice/");			
		}
		$this->serverservice_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/serverservice/");
	}
	
	public function insert()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ServerBoxID' , 'Server Box / Tool' ,'required');
        $this->form_validation->set_rules('Title' , 'Title' ,'required|max_length[255]');
		$this->form_validation->set_rules('Price' , 'Price' ,'required|numeric');
		$this->form_validation->set_rules('Quantity' , 'Quantity' ,'required|integer');
        $this->form_validation->set_rules('DeliveryTime' , 'Delivery Time' ,'required|max_length[255]');
        $this->form_validation->set_rules('Description' , 'Description' ,'max_length[512]');
        
		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL,TRUE);
			$data['Status'] = isset($data['Status'])?"Enabled":"Disabled";
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$data['CreatedDateTime'] = date("Y-m-d H:i:s");
			
			$fileid = $this->serverservice_model->insert($data);
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/serverservice/");
		}
	}		

	public function update()
	{
		$this->load->library('form_validation');
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];		
		$this->form_validation->set_rules('ServerBoxID' , 'Server Box / Tool' ,'required');
        $this->form_validation->set_rules('Title' , 'Title' ,'required|max_length[255]');
		$this->form_validation->set_rules('Price' , 'Price' ,'required|numeric');
		$this->form_validation->set_rules('Quantity' , 'Quantity' ,'required|integer');
        $this->form_validation->set_rules('DeliveryTime' , 'Delivery Time' ,'required|max_length[255]');
        $this->form_validation->set_rules('Description' , 'Description' ,'max_length[512]');
		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);
            $data['Status'] = isset($data['Status'])?"Enabled":"Disabled"; 					
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");						
			$this->serverservice_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/serverservice/");
		}
	}
	
	
}

/* End of file serverservice.php */
/* Location: ./application/controllers/admin/serverservice.php */