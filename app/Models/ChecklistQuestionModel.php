<?php 

namespace Model;

class ChecklistQuestionModel extends Model{

	const TABLE = "checklist_questions";

	public function all(){
		$sql = 'SELECT q.*, qt.type q_type  FROM '.self::TABLE.' q
		INNER JOIN checklist_question_type qt ON q.question_type_id = qt.id
		ORDER BY q.id asc';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT q.*, qt.type q_type  FROM '.self::TABLE.' q
		INNER JOIN checklist_question_type qt ON q.question_type_id = qt.id '
		.$this->where($where).' 
		ORDER BY q.id asc ';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function find($id){
		$sql = 'SELECT q.*, qt.type q_type  FROM '.self::TABLE.' q
		INNER JOIN checklist_question_type qt ON q.question_type_id = qt.id 
		WHERE q.id='.$id.' 
		ORDER BY q.id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}
	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (checklist_template_id,question_type_id,question) value (
			'".addslashes($fields["checklist_template_id"])."',
			'".addslashes($fields["question_type_id"])."',
			'".addslashes($fields["question"])."'
		)"; 
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			checklist_template_id = '".addslashes($fields["checklist_template_id"])."',
			question_type_id = '".addslashes($fields["question_type_id"])."',
			question = '".addslashes($fields["question"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($where){
		$sql = "delete from ".self::TABLE." ".$this->where($where);
		return $this->db->exec($sql);
	}
}