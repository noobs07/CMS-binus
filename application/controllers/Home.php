<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
	private $_userID = '1';

	function __construct()
	{
		parent::__construct();

		$this->load->model('data_model', 'data');
	}

	public function index()
	{
		//$code = 'FOOD6XXX';
		$code = $_GET['course_code'];

		// get data SO
		$so = $this->data->getCourseStudentOutcome($code);

		// Jika data belum ada, get dari API
		if (empty($so)) {
			// return dari API SO dan LObj
			$api_data	= $this->postRequest("get_lobj/{$code}");

			// simpan SO dan LObj ke local database
			$this->data->insertCourseStudentOutcome($this->_userID, $code, $api_data->data);

			// get data SO
			$so = $this->data->getCourseStudentOutcome($code);
		}

		$data = [];
		foreach ($so as $s) {

			// get data LObj untuk tiap-tiap SO
			$detail  = $this->data->getCourseLObj($s->courseStudentOutcomeId, $code);
			foreach ($detail as $d) {
				$s->LObj[] = $d;
			}
		}
		//$this->d($so); die;
		$result = $so;

		//echo '<pre>';
		print_r($so); //die;

		// get data mapping LObj dan LO
		$LObj2LO = $this->data->getCourseLObj2LO($code);

		//dump($so, 'data SO dan LObj'); 
		//dump($LObj2LO, 'data mapping LObj ke LO');

		if ($result) {
			$data['log'] = $this->data->getLogQuery();
		} else {
			$data['log'] = null;
		}
		$data['msg'] 	 = $this->data->getMessage();
		$data['so'] = $result;
		$data['mapping'] = $LObj2LO;
		$this->load->view('konten/cms', $data);
	}

	function saveData()
	{
		$this->load->library('form_validation');

		$_POST = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
		
		$this->form_validation->set_rules('courseStudentOutlineID', 'SO ID', 'required');
		$this->form_validation->set_rules('courseLObjID', 'LObj ID', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			echo json_encode(['status' => false,
                             'message' => $this->form_validation->error_array()]);
		} else {
			// contoh post data untuk map parameter ketiga saveStudentLearningOutcome(1,2,3), parameter 1,2 bisa diabaikan (diset null dulu)
			// $map = array(7 => 0, 8 => 2, 9 => 1);		=> key adalah courseLObj2LOID dan valuenya adalah weigthLO	
			$data['status'] = $this->data->saveStudentLearningOutcome($this->_userID, $this->input->post('courseStudentOutlineID'), $this->input->post('courseLObjID'), $this->input->post('detail', true));
			$data['msg'] 	= $this->data->getMessage();
			echo json_encode($data);
			//$this->load->view('konten/cms', $data);
		}
	}
}
