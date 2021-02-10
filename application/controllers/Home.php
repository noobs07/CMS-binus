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

	public function index(){
		$this->load->view('konten/cms');
	}
	
	public function getMappingSO()
	{
		// simplify for get course code, if not exists course code, then set default course code.
		// FINC7007,ISYS6442,ACCT6063, ACCT6010,ISYS6256
		$course_id = $this->input->get_post('course_id');
		
		// FOOD6573  STAT6008 BUSS6017
		$course_id = empty($course_id)? '019500' : $course_id;
		
		$course = $this->data->getBaseCourseByCourseID($course_id);
		
		// bypass
		$course = !empty($course)? $course : (object)['INSTITUTION' => 'BNS01', 
													  'ACAD_CAREER' => 'CNF', 
													  'CRSE_ID' => $course_id, 
													  'CRSE_CODE' => $course_id, 
													  'CRSE_TTL_LONG_I' => 'Kursus tidak ditemukan', 
													  'COURSE_TITLE_LONG' => 'Course not found', 
													  'N_SKST' => 2,
													  'N_SKSP' => 2];
		
		$data['status']	 = false;
		$data['msg'] 	 = "No Data Coourse Found";
		$data['course']  = null;
		$data['so'] 	 = null;
		$data['mapping'] = null;
		
		//dump($course,'course');
		
		if($course){
			$code = $course->CRSE_CODE;
			// get data SO
			$so = $this->data->getCourseStudentOutcome($code);
			//dump($so,'so');
			
			// untuk mendapatkan course monitoring, parameter bisa diinputkan disini. parameter 'RS1','373','1920'
			$courseMonitoring = $this->getCourseMonitoring($course->ACAD_CAREER, $this->input->post('attr_value'), $this->input->post('strm'));
			
			// Jika data belum ada, get dari API
			if (empty($so)) {
				// return dari API SO dan LObj
				$api_data	= $this->postRequest("get_assesment_plane/{$code}");
				//dump($api_data,'API');	die;
				
				// simpan SO dan LObj ke local database
				$res = $this->data->insertCourseStudentOutcome($this->_userID, $code, $api_data->data);
				//dump($res,'Insert'); 
				
				// get data SO
				$so = $this->data->getCourseStudentOutcome($code);
				//dump($so,'SO-2'); 
			}
			
			$data = [];
			foreach ($so as $s) {

				// get data LObj untuk tiap-tiap SO
				$detail  = $this->data->getCourseLObj($s->statusSOId, $code);
				foreach ($detail as $d) {
					$s->learningObjs[] = $d;
				}
			}
			
			$result = $so;

			// get data mapping LObj dan LO
			$LObj2LO = $this->data->getCourseLObj2LO($code);
			
			if(!$LObj2LO){
				$LObj2LO[0]['courseLObjID'] = uniqid();
				$LObj2LO[0]['code'] 	= 'code';
				$LObj2LO[0]['descIN'] = 'desc IN';
				$LObj2LO[0]['descEN'] = 'desc EN';
				$LObj2LO[0]['teachAndLearnStrategyName'] = 'teachAndLearnStrategyName';
				$LObj2LO[0]['assessmentPlan'] = 'assessmentPlan';
				$LObj2LO[0]['weight'] = 50;
				$LObj2LO[0]['isXX'] 	= false;
				$LObj2LO[0]['LO'] 	= [['courseLObj2LOId' => uniqid(), 'courseOutlineLearningOutcomeID' => 'courseOutlineLearningOutcomeID 1', 'weightLO' => '1', 'courseOutlineLearningOutcome' => 'courseOutlineLearningOutcome 1', 'priority' => 1],
										['courseLObj2LOId' => uniqid(), 'courseOutlineLearningOutcomeID' => 'courseOutlineLearningOutcomeID 2', 'weightLO' => '2', 'courseOutlineLearningOutcome' => 'courseOutlineLearningOutcome 2', 'priority' => 1],
										['courseLObj2LOId' => uniqid(), 'courseOutlineLearningOutcomeID' => 'courseOutlineLearningOutcomeID 3', 'weightLO' => '3', 'courseOutlineLearningOutcome' => 'courseOutlineLearningOutcome 3', 'priority' => 1],
									  ];
			}

			if ($result) {
				$data['log'] = $this->data->getLogQuery();
			} else {
				$data['log'] = null;
			}
			
			$data['status']	 = true;
			$data['msg'] 	 = $this->data->getMessage();
			$data['course']	 = $course;
			$data['so'] 	 = $result;
			$data['mapping'] = $LObj2LO;	
		}
		
		$this->output->set_content_type('application/json')
						->set_output(json_encode($data, JSON_NUMERIC_CHECK));
	}

	function saveData()
	{
		$this->load->library('form_validation');

		$_POST = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
		
		/* $this->form_validation->set_rules('courseStudentOutlineID', 'SO ID', 'required');
		$this->form_validation->set_rules('courseLObjID', 'LObj ID', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			echo json_encode(['status' => false,
                             'message' => $this->form_validation->error_array()]);
		} else { */
			// contoh post data untuk map parameter ketiga saveStudentLearningOutcome(1,2,3), parameter 1,2 bisa diabaikan (diset null dulu)
			// $map = array(7 => 0, 8 => 2, 9 => 1);		=> key adalah courseLObj2LOID dan valuenya adalah weigthLO	
			$data['status'] = $this->data->saveStudentLearningOutcome($this->_userID, $this->input->post('detail', true));
			$data['msg'] 	= $this->data->getMessage();
			
			$this->output->set_content_type('application/json')
						->set_output(json_encode($data, JSON_NUMERIC_CHECK));
		/* } */
	}
	
	function getCourseMonitoring($acad_career = 'RS1', $attr_value = '373', $strm = '1920')
	{
		// validate if parameter has blank value
		$acad_career = empty($acad_career)? 'RS1' : $acad_career;
		$attr_value  = empty($attr_value)? '373' : $attr_value;
		$strm 		 = empty($strm)? '1920' : $strm;
		return $this->data->getCourseMonitoring($acad_career, $attr_value, $strm);
	}
	function getHome(){
		echo "home";
	}
}
