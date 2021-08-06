<?php 

namespace Model;

class ChecklistQuestionModel extends Model{

	const TABLE = "question_options";

	public function all(){
		$sql = 'SELECT * FROM '.self::TABLE.' 
		ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT * FROM '.self::TABLE.' '
		.$this->where($where).' 
		ORDER BY id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function find($id){
		$sql = 'SELECT * FROM '.self::TABLE.'  
		WHERE id='.$id.' 
		ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}
	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (question_id,option_text) value (
			'".addslashes($fields["question_id"])."',
			'".addslashes($fields["option_text"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			question_id = '".addslashes($fields["question_id"])."',
			option_text = '".addslashes($fields["option_text"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}
}