<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Data_model extends MY_Model{
		
		
	public function getCourseLO($course_code){
		return $this->db->query("dbo.courseLO_getFromCourseCode ?", array($course_code))->result();
	}
	
	
	public function getCourseStudentOutcome($course_code){
		return $this->db->select('courseStudentOutcomeId, PM, nameIN, nameEN')
					->get_where('courseStudentOutcome', ['CRSE_CODE' => $course_code])->result();
	}
	
	public function getCourseLObj($courseStudentOutcomeId, $course_code = null){
		$this->db->select('courseLObjID, code, descIN, descEN')
			->from('courseLObj')
			->where('courseStudentOutcomeID', $courseStudentOutcomeId);
		
		if(!empty($course_code)){
			$this->db->where('CRSE_CODE', $course_code);
		}	
		return $this->db->order_by('code')->get()->result();
	}
	
	
	public function insertData($user_id = 1, $course_code, $data){
		if(is_array($data) && !empty($data)){
			$this->db->trans_begin();
			
			$ins = "INSERT INTO courseStudentOutcome(stsrc, userIn, courseStudentOutcomeUUID, PM, nameIN, nameEN, CRSE_CODE) VALUES ";
			$insDetail = "INSERT INTO courseLObj(stsrc, userIn, courseLObjUUID, code, descIN, descEN, taxonomyID, taxonomyName, taxonomyDesc, taxonomyCode, taxonomyKeyword, taxonomyLevel, courseStudentOutcomeID, CRSE_CODE) VALUES ";
			$check_ins = false;
			$check_insDetail = false;
			$insLObj2LO = [];
			foreach($data as $d){
				$ins .= "('I', {$this->db->escape($user_id)}, {$this->db->escape($d->statusStudentOutcomeId)}, {$this->db->escape($d->statusStudentOutcomePM)}, {$this->db->escape($d->statusStudentOutcomeNameIN)}, {$this->db->escape($d->statusStudentOutcomeNameEN)}, {$this->db->escape($course_code)}),";
				$check_ins = true;
				
				foreach($d->lobjData as $r){
					$sql = "(SELECT courseStudentOutcomeID FROM courseStudentOutcome WHERE courseStudentOutcomeUUID = {$this->db->escape($d->statusStudentOutcomeId)})";
					$insDetail .= "('I', {$this->db->escape($user_id)}, {$this->db->escape($r->id)}, {$this->db->escape($r->code)}, {$this->db->escape($r->descIN)}, {$this->db->escape($r->descEN)}, {$this->db->escape($r->bloomTaxonomyId)}, {$this->db->escape($r->bloomTaxonomyName)}, {$this->db->escape($r->bloomTaxonomyDesc)}, {$this->db->escape($r->bloomTaxonomyCode)}, {$this->db->escape($r->bloomTaxonomyKeyword)}, {$this->db->escape($r->bloomTaxonomyLevel)}, {$sql}, {$this->db->escape($course_code)}),";
					$check_insDetail = true;
					$insLObj2LO[] = "dbo.courseLObj2LO_Create {$this->db->escape($course_code)}, {$this->db->escape($r->id)}, {$this->db->escape($user_id)} ";
				}
			}
			
			if($check_ins){
				$this->db->simple_query(rtrim($ins, ','));
				//$this->setLogQuery('ins');
			}
			
			if($check_insDetail){
				$this->db->simple_query(rtrim($insDetail, ','));
				//$this->setLogQuery('ins_detail');
			}
			
			if(count($insLObj2LO) > 0){
				foreach($insLObj2LO as $i){
					$this->db->simple_query($i);
				}
			}
			
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$this->setMessage('Data gagal disimpan');
				return false;
			}else{
				$this->db->trans_commit();
				$this->setMessage('Data berhasil disimpan');
				return true;
			}
		}
		$this->setMessage('Data tidak dikenali. Data yang dimasukkan harus berupa array.');
		return false;
	}
}