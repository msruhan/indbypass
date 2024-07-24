<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	var $module_name = 'Dashboard';

	public function index()
	{
		$this->load->model('member_model');
		$this->load->model('employee_model');
		$this->load->model('imeiorder_model');
		$this->load->model('fileorder_model');
		$this->load->model('method_model');
		$this->load->model('fileservices_model');
		
		$data['active_members'] = $this->member_model->count_where(['Status' => 'Enabled']);
		$data['inactive_members'] = $this->member_model->count_where(['Status' => 'Disabled']);
		
		$data['active_employees'] = $this->employee_model->count_where(['Status' => 'Enabled']);
		$data['inactive_employees'] = $this->employee_model->count_where(['Status' => 'Disabled']);

		$data['imei_orders'] = ['Pending' => 0, 'Issued' => 0, 'Canceled' => 0];
		$status_count = $this->imeiorder_model->get_count_by('Status');
		foreach ($status_count as $v) 
		{
			$data['imei_orders'][$v->Status] = $v->countof;
		}

		$data['file_orders'] = ['Pending' => 0, 'Issued' => 0, 'Canceled' => 0];
		$status_count = $this->fileorder_model->get_count_by('Status');
		foreach ($status_count as $v) 
		{
			$data['file_orders'][$v->Status] = $v->countof;
		}

		$data['top_imei_methods'] = $this->method_model->get_top10();
		$data['top_file_services'] = $this->fileservices_model->get_top10();
		$data['inactive_members'] = $this->member_model->count_where(['Status' => 'Disabled']);
		$data['template'] = "admin/dashboard";
		$this->load->view('admin/master_template', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/admin/welcome.php */