<?php 

namespace Model;

class NotificationEmailModel extends Model{

	const TABLE = "notifications_emails";

	public function all(){
		$sql = 'SELECT * FROM '.self::TABLE.' ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT * FROM '.self::TABLE.' '.$this->where($where).' ORDER BY id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function find($id){
		$sql = 'SELECT * FROM '.self::TABLE.' WHERE id='.$id.' ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}
	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (email, notification_type) value (
			'".addslashes($fields["email"])."',
			'".addslashes($fields["notification_type"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			email = '".addslashes($fields["email"])."',
			notification_type = '".addslashes($fields["notification_type"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}
}