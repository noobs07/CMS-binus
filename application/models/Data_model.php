<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Data_model extends MY_Model{
		
	
	public function insertData($user_id = 1, $data){
		if(is_array($data) && !empty($data)){
			$this->db->trans_begin();
			
			$ins = "INSERT INTO courseStudentOutcome(stsrc, userIn, courseStudentOutcomeUUID, PM, nameIN, nameEN) VALUES ";
			$insDetail = "INSERT INTO courseLObj(stsrc, userIn, courseLObjUUID, code, descIN, descEN, taxonomyID, taxonomyName, taxonomyDesc, taxonomyCode, taxonomyKeyword, taxonomyLevel, courseStudentOutcomeID) VALUES ";
			$check_ins = false;
			$check_insDetail = false;
			foreach($data as $d){
				$ins .= "('I', {$this->db->escape($user_id)}, {$this->db->escape($d->statusStudentOutcomeId)}, {$this->db->escape($d->statusStudentOutcomePM)}, {$this->db->escape($d->statusStudentOutcomeNameIN)}, {$this->db->escape($d->statusStudentOutcomeNameEN)}),";
				$check_ins = true;
				
				foreach($d->lobjData as $r){
					$sql = "(SELECT courseStudentOutcomeID FROM courseStudentOutcome WHERE courseStudentOutcomeUUID = {$this->db->escape($d->statusStudentOutcomeId)})";
					$insDetail .= "('I', {$this->db->escape($user_id)}, {$this->db->escape($r->id)}, {$this->db->escape($r->code)}, {$this->db->escape($r->descIN)}, {$this->db->escape($r->descEN)}, {$this->db->escape($r->bloomTaxonomyId)}, {$this->db->escape($r->bloomTaxonomyName)}, {$this->db->escape($r->bloomTaxonomyDesc)}, {$this->db->escape($r->bloomTaxonomyCode)}, {$this->db->escape($r->bloomTaxonomyKeyword)}, {$this->db->escape($r->bloomTaxonomyLevel)}, {$sql}),";
					$check_insDetail = true;
				}
			}
			
			if($check_ins){
				$this->db->query(rtrim($ins, ','));
				$this->setLogQuery('ins');
			}
			
			if($check_insDetail){
				$this->db->query(rtrim($insDetail, ','));
				$this->setLogQuery('ins_detail');
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