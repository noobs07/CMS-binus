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
		$code = 'FOOD6XXX';
		$so = $this->data->getCourseStudentOutcome($code);
		if(empty($so)){
			$api_data	= $this->postRequest("get_lobj/{$code}");	
			
			$this->data->insertData($this->_userID, $code, $api_data->data);
			$so = $this->data->getCourseStudentOutcome($code);
		}
		
		$data = [];
		foreach($so as $s){
			
			$detail  = $this->data->getCourseLObj($s->courseStudentOutcomeId, $code);
			foreach($detail as $d){
				$s->LObj[] = $d;
			}
		}
		$this->d($so); die;
		
		
		echo '<pre>';
		print_r($so); die;
		
		if($result){	
			$data['log'] = $this->data->getLogQuery();
		}else {
			$data['log'] = null;
		}
		$data['msg'] 	 = $this->data->getMessage();
		$this->load->view('konten/cms', $data);
	}
}