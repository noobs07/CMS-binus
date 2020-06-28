<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

class Data_model extends MY_Model {
	
	
	public function insertData($user_id = 1, $data){
		if(is_array($data) && !empty($data)){
			$this->db->trans_begin();
			
			$ins = [];
			$insDetail = [];
			foreach($data as $d){
				$ins[] = ['stsrc' => 'I',
						  'userIn' => $user_id,
						  'courseStudentOutcomeUUID' => $d->statusStudentOutcomeId,
						  'PM' => "{$d->statusStudentOutcomePM}",
						  'nameIN' => $d->statusStudentOutcomeNameIN,
						  'nameEN' => $d->statusStudentOutcomeNameEN];
						  
				
				foreach($d->lobjData as $r){
					$sql = "(SELECT courseStudentOutcomeID FROM courseStudentOutcome WHERE courseStudentOutcomeUUID = {$this->db->escape($d->statusStudentOutcomeId)})";
					$insDetail[] = 	['stsrc' => 'I',
									  'userIn' => $this->db->escape($user_id),
									  'courseLObjUUID' => $this->db->escape($r->id),
									  'code' => $this->db->escape($r->code),
									  'descIN' => $this->db->escape($r->descIN),
									  'descEN' => $this->db->escape($r->descEN),
									  'courseStudentOutcomeID' => $sql,
									  'taxonomyID' => $this->db->escape($r->bloomTaxonomyId),
									  'taxonomyName' => $this->db->escape($r->bloomTaxonomyName),
									  'taxonomyDesc' => $this->db->escape($r->bloomTaxonomyDesc),
									  'taxonomyCode' => $this->db->escape($r->bloomTaxonomyCode),
									  'taxonomyKeyword' => $this->db->escape($r->bloomTaxonomyKeyword),
									  'taxonomyLevel' => $this->db->escape($r->bloomTaxonomyLevel)];
				}
			}
			
			if(count($ins) > 0){
				echo 'Q1 ';
				$this->db->insert_batch('courseStudentOutcome', $ins);
				echo $this->db->get_compiled_insert('courseStudentOutcome');
				$this->setLogQueryInsert('courseStudentOutcome');
			}
			
			if(count($insDetail) < 0){
				echo 'Q2 ';
				$this->db->insert_batch('courseLObj', $insDetail, false);
				echo $this->db->get_compiled_insert('courseLObj');
				$this->setLogQueryInsert('courseLObj');
			}
			
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return false;
			}else{
				$this->db->trans_commit();
				return true;
			}
		}
		return false;
	}
}