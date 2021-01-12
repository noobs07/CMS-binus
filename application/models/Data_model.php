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
	
	public function getCourseLObj($statusStudentOutcomeId = null, $course_code = null){
		return $this->db->query("dbo.CMS_GET_CourseLObj ?, ?", array($statusStudentOutcomeId, $course_code))->result();
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
		if(is_array($data) && !empty($data)){
			
			$ins = "INSERT INTO {$this->_tableCourseStudentOutcome}(stsrc, userIn, statusStudentOutcomeId, statusStudentOutcomePM, statusStudentOutcomeNameIN, statusStudentOutcomeNameEN, CRSE_CODE) VALUES ";
			$insDetail = "INSERT INTO {$this->_tableCourseLObj}(stsrc, userIn, courseLObjId, code, descIN, descEN, bloomTaxonomyId, bloomTaxonomyName, bloomTaxonomyDesc, bloomTaxonomyCode, bloomTaxonomyKeyword, bloomTaxonomyLevel, statusStudentOutcomeId, CRSE_CODE) VALUES ";
			$check_ins = false;
			$check_insDetail = false;
			$insLObj2LO = [];
			foreach($data as $d){
				$ins .= "('I', {$this->db->escape($user_id)}, {$this->db->escape($d->statusStudentOutcomeId)}, {$this->db->escape($d->statusStudentOutcomePM)}, {$this->db->escape($d->statusStudentOutcomeNameIN)}, {$this->db->escape($d->statusStudentOutcomeNameEN)}, {$this->db->escape($course_code)}),";
				$check_ins = true;
				
				foreach($d->lobjData as $r){
					$insDetail .= "('I', {$this->db->escape($user_id)}, {$this->db->escape($r->id)}, {$this->db->escape($r->code)}, {$this->db->escape($r->descIN)}, {$this->db->escape($r->descEN)}, {$this->db->escape($r->bloomTaxonomyId)}, {$this->db->escape($r->bloomTaxonomyName)}, {$this->db->escape($r->bloomTaxonomyDesc)}, {$this->db->escape($r->bloomTaxonomyCode)}, {$this->db->escape($r->bloomTaxonomyKeyword)}, {$this->db->escape($r->bloomTaxonomyLevel)}, {$this->db->escape($d->statusStudentOutcomeId)}, {$this->db->escape($course_code)}),";
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
	
	public function saveStudentLearningOutcome($user_id = 1, $courseStudentOutlineID, $courseLObjID, $map){
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