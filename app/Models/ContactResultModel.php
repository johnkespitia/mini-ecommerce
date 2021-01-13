<?php 

namespace Model;

class ContactResultModel extends Model{

	const TABLE = "contact_results";

	public function all(){
		$sql = 'SELECT c.id, c.title c.contact_id, c.user_id, c.date_result, c.description, c.result, c.status, c.next_step,
		users.name user, users.email user_email
		FROM '.self::TABLE." c  INNER JOIN users ON c.user_id = users.id 
			 ORDER BY id desc";
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT c.id, c.title, c.contact_id, c.user_id, c.date_result, c.description, c.result, c.status, c.next_step,
		users.name user, users.email user_email
		FROM '.self::TABLE." c  INNER JOIN users ON c.user_id = users.id 
			 WHERE c.id={$id}
			 ORDER BY id desc";
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function findBy($where, $singleRow = false){
		$whereBuild = $this->where($where);
		$sql = 'SELECT c.id, c.title, c.contact_id, c.user_id, c.date_result, c.description, c.result, c.status, c.next_step,
		users.name user, users.email user_email
		FROM '.self::TABLE." c  INNER JOIN users ON c.user_id = users.id 
			 ".$whereBuild."
			 ORDER BY c.id desc";
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (title, contact_id, user_id, date_result, description, result, status, next_step) value (
			'".addslashes($fields["title"])."', 
			".addslashes($fields["contact_id"]).", 
			".addslashes($fields["user_id"]).", 
			'".addslashes($fields["date_result"])."', 
			'".addslashes($fields["description"])."', 
			'".addslashes($fields["result"])."', 
			'".addslashes($fields["status"])."', 
			'".addslashes($fields["next_step"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			title = '".addslashes($fields["title"])."', 
			description = '".addslashes($fields["description"])."', 
			result = '".addslashes($fields["result"])."', 
			status = '".addslashes($fields["status"])."', 
			next_step = '".addslashes($fields["next_step"])."', 
			date_result = '".addslashes($fields["date_result"])."', 
			contact_id = ".addslashes($fields["contact_id"]).", 
			user_id = ".addslashes($fields["user_id"])."
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}
}