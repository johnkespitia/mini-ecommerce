<?php 

namespace Model;

class ChecklistQuestionTypeModel extends Model{

	const TABLE = "checklist_question_type";

	public function all(){
		$sql = 'SELECT q.*  FROM '.self::TABLE.' q
		ORDER BY q.id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT q.* FROM '.self::TABLE.' q '
		.$this->where($where).' 
		ORDER BY q.id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function find($id){
		$sql = 'SELECT q.* FROM '.self::TABLE.' q
		WHERE q.id='.$id.' 
		ORDER BY q.id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}
}