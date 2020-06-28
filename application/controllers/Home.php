<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	private $_userID = '1';
	
	function __construct(){
		parent::__construct();
		
		$this->load->model('data_model', 'data');
	}
	
	public function index()
	{	
		$api_data	= $this->postRequest('get_lobj/FOOD6XXX');	
		$result 	= $this->data->insertData($this->_userID, $api_data->data);
		
		if($result){	
			$data['log'] = $this->data->getLogQuery();
		}else {
			$data['log'] = null;
		}
		$data['msg'] 	 = $this->data->getMessage();
		$this->load->view('konten/cms', $data);
	}
}