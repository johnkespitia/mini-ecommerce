<?php 

namespace Model;

class ChecklistAnswerModel extends Model{

	const TABLE = "answers";

	public function all(){
		$sql = 'SELECT a.*, q.question question_text, qt.type question_type
		FROM '.self::TABLE.' a 
		INNER JOIN questions q ON a.=q.id
		INNER JOIN question_type qt ON q.question_type_id=qt.id
		ORDER BY a.id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT a.*, q.question question_text, qt.type question_type
		FROM '.self::TABLE.' a 
		INNER JOIN questions q ON a.=q.id
		INNER JOIN question_type qt ON q.question_type_id=qt.id
		'
		.$this->where($where).' 
		ORDER BY a.id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function find($id){
		$sql = 'SELECT a.*, q.question question_text, qt.type question_type
		FROM '.self::TABLE.' a 
		INNER JOIN questions q ON a.=q.id
		INNER JOIN question_type qt ON q.question_type_id=qt.id
		WHERE a.id='.$id.' 
		ORDER BY a.id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}
	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (checklist_answer_id, question_id, answer_text) value (
			'".addslashes($fields["checklist_answer_id"])."',
			'".addslashes($fields["question_id"])."',
			'".addslashes($fields["answer_text"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			checklist_answer_id = '".addslashes($fields["checklist_answer_id"])."',
			question_id = '".addslashes($fields["question_id"])."',
			answer_text = '".addslashes($fields["answer_text"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}
}