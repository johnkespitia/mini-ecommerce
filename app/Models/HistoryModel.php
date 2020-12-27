<?php 

namespace Model;

class HistoryModel extends Model{

	const TABLE = "history";
	
	public function all(){
		$sql = 'SELECT * FROM '.self::TABLE.' ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT * FROM '.self::TABLE.' WHERE id='.$id.' ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function findBy($where, $singleRow = false, $limit = 5){
		$sql = 'SELECT * FROM '.self::TABLE.' '.$this->where($where).' ORDER BY id desc limit '.$limit;
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (user_id,raw_request,raw_response,date_request,cost_request) value (
			".addslashes($fields["user_id"]).", 
			'".addslashes($fields["raw_request"])."', 
			'".addslashes($fields["raw_response"])."', 
			'".addslashes($fields["date_request"])."', 
			".addslashes($fields["cost_request"])."
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			user_id = ".addslashes($fields["user_id"]).", 
			raw_request = '".addslashes($fields["raw_request"])."', 
			raw_response = '".addslashes($fields["raw_response"])."', 
			date_request = '".addslashes($fields["date_request"])."', 
			cost_request = ".addslashes($fields["cost_request"])."
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}