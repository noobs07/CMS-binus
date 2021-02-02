<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Data_model extends MY_Model{
	private $_msg;
	private $_tableCourseStudentOutcome 		= 'courseStudentOutcome';
	private $_tableCourseOutlineLearningOutcome = 'courseOutlineLearningOutcome';
	private $_tableCourseLObj 					= 'courseLObj';
	private $_tableCourseLObj2LO				= 'courseLObj2LO';
	private $_tableBaseCourse					= 'ORACLE.dbo.PS_N_COURSE_CODE';

	
	
	public function setMessage($msg = ''){
		$this->_msg = $msg;
	}
	
	public function getMessage(){
		return $this->_msg;
	}
	
	public function getBaseCourseByCourseID($course_id = ''){
		return $this->db->query("dbo.CMS_GET_BaseCourseByCourseID ?", array($course_id))->row();
	}
	
		
	public function getCourseLO($course_code){
		return $this->db->query("dbo.CMS_GET_CourseLOByCourseCode ?", array($course_code))->result();
	}
	
	
	public function getCourseStudentOutcome($course_code){
		return $this->db->query("dbo.CMS_GET_CourseStudentOutcomeByCourseCode ?", array($course_code))->result();
	}
	
	public function getCourseLObj($statusSOId = null, $course_code = null){
		return $this->db->query("dbo.CMS_GET_CourseLObj ?, ?", array($statusSOId, $course_code))->result();
	}
	
	public function getCourseLObj2LO($course_code){
		$result = $this->db->query("dbo.CMS_GET_CourseLObj2LO ?", array($course_code))->result();
		
		$data = [];
		$i= 0;
		foreach($result as $index => $r){
			if(isset($data[$i][$r->courseLObjID])){
				$data[$i]['LO'][] 	= ['courseLObj2LOId' => $r->courseLObj2LOId,
									   'courseOutlineLearningOutcomeID' => $r->courseOutlineLearningOutcomeID,
									   'weightLO' => $r->weightLO,
									   'courseOutlineLearningOutcome' => $r->courseOutlineLearningOutcome,
									   'priority' => $r->priority
									];
			}else{
				if($index > 0) $i++;
				
				$data[$i][$r->courseLObjID] = $r->courseLObjID;
				$data[$i]['courseLObjID'] = $r->courseLObjID;
				$data[$i]['code'] 	= $r->code;
				$data[$i]['descIN'] = $r->descIN;
				$data[$i]['descEN'] = $r->descEN;
				$data[$i]['teachAndLearnStrategyName'] = $r->teachAndLearnStrategyName;
				$data[$i]['assessmentPlan'] = $r->assessmentPlan;
				$data[$i]['weight'] = $r->weight;
				$data[$i]['isXX'] = $r->isXX;
				$data[$i]['LO'][] 	= ['courseLObj2LOId' => $r->courseLObj2LOId,
									   'courseOutlineLearningOutcomeID' => $r->courseOutlineLearningOutcomeID,
									   'weightLO' => $r->weightLO,
									   'courseOutlineLearningOutcome' => $r->courseOutlineLearningOutcome,
									   'priority' => $r->priority
									];
			} 
		}
		return $data;
	}
	
	
	public function insertCourseStudentOutcome($user_id = 1, $course_code, $data){
		if(is_object($data) && !empty($data)){
			
			$ins = "INSERT INTO {$this->_tableCourseStudentOutcome}(id, stsrc, userIn, statusSOId, statusSONameIN, statusSONameEN, CRSE_CODE, descIN, descEN, code) VALUES ";
			$insDetail = "INSERT INTO {$this->_tableCourseLObj}(stsrc, userIn, id, code, descIN, descEN, teachAndLearnStrategyName, assessmentPlan, weight, isXX, courseSOId, statusSOId, CRSE_CODE) VALUES ";
			$check_ins = false;
			$check_insDetail = false;
			$insLObj2LO = [];
			foreach($data->studentOutcome as $d){
				$ins .= "({$this->db->escape($d->id)}, 'I', {$this->db->escape($user_id)}, {$this->db->escape($d->statusSOId)}, {$this->db->escape($d->statusSONameIN)}, {$this->db->escape($d->statusSONameEN)}, {$this->db->escape($course_code)}, {$this->db->escape($d->descIN)}, {$this->db->escape($d->descEN)}, {$this->db->escape($d->code)}),";
				$check_ins = true;
				
				foreach($d->learningObjs as $r){
					$insDetail .= "('I', {$this->db->escape($user_id)}, {$this->db->escape($r->id)}, {$this->db->escape($r->code)}, {$this->db->escape($r->descIN)}, {$this->db->escape($r->descEN)}, {$this->db->escape($r->teachAndLearnStrategyName)}, {$this->db->escape($r->assessmentPlan)}, {$this->db->escape($r->weight)}, {$this->db->escape($r->isXX)}, {$this->db->escape($d->id)}, {$this->db->escape($d->statusSOId)}, {$this->db->escape($course_code)}),";
					$check_insDetail = true;
					
					$insLObj2LO[] = "dbo.CMS_INS_CourseLObj2LO {$this->db->escape($course_code)}, {$this->db->escape($r->id)}, {$this->db->escape($user_id)} ";
				}
			}
			
			$ins 		= ($check_ins)? rtrim($ins, ',') : NULL;
			$insDetail 	= ($check_insDetail)? rtrim($insDetail, ',') : NULL;
			$stat 		= $this->db->query("dbo.CMS_INS_CourseStudentOutcome ?, ?", array($ins, $insDetail))->row();			
			
			if(count($insLObj2LO) > 0 && $stat->status == 1){
				foreach($insLObj2LO as $i){
					$cek = $this->db->query($i)->row();
					if($cek->status == 0) $stat = $cek;
				}
			}
			
			$this->setMessage($stat->msg);
			return ($stat->status);
		}
		$this->setMessage('Data tidak dikenali. Data yang dimasukkan harus berupa array.');
		return false;
	}
	
	public function saveStudentLearningOutcome($user_id = 1, $map){
		if(!empty($map)){
			
			$upd  = "UPDATE e SET e.weightLO = t.weightLO, e.userUp = {$this->db->escape($user_id)}, e.dateUp = GETDATE() FROM {$this->_tableCourseLObj2LO} e JOIN ( VALUES "; //(courseLObj2LOId, courseStudentOutlineID, courseLObjID, weightLO) VALUES ";
			foreach($map as $LObj2LOID => $weigth){
				$upd .= "({$this->db->escape($LObj2LOID)}, {$this->db->escape($weigth)}),";	
			}
			
			$upd  = rtrim($upd, ',');
			$upd .= ") t (courseLObj2LOId, weightLO) ON t.courseLObj2LOId = e.courseLObj2LOId;";
			
			$stat = $this->db->query("dbo.CMS_UPD_StudentLearningOutcome ?", array($upd))->row();
			
			if($stat->status == 1){
				$this->setMessage('Data berhasil disimpan.');
				return true;
			}else{
				$this->setMessage('Data gagal disimpan.');
				return false;
			}
		}
		
		$this->setMessage('Data gagal disimpan. Input map harus array dan memiliki nilai.');
		return false;
	}
	
	// fungsi untuk mengambil deskripsi course. Contoh parameter 'RS1','373','1920'
	public function getCourseMonitoring($acad_career = null, $attr_value = null, $strm = null){
		return $this->db->query("dbo.Staff_CMS_CourseMonitoring_LoadData ?, ?, ?", array($acad_career, $attr_value, $strm))->result();
	}
}