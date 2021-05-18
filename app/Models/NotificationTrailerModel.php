<?php 

namespace Model;

class NotificationTrailerModel extends Model{

	const TABLE = "trailer_notifications";

	public function all(){
		$sql = 'SELECT cn.*, nt.name not_type
		FROM '.self::TABLE.' cn 
		INNER JOIN notification_types nt
		ON cn.notification_type = nt.id
		ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT cn.*, nt.name not_type
		FROM '.self::TABLE.' cn 
		INNER JOIN notification_types nt
		ON cn.notification_type = nt.id
		'.$this->where($where).' ORDER BY cn.id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function find($id){
		$sql = 'SELECT cn.*, nt.name not_type
		FROM '.self::TABLE.' cn 
		INNER JOIN notification_types nt
		ON cn.notification_type = nt.id
		WHERE cn.id='.$id.' 
		ORDER BY cn.id'; 
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}
	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (trailer, notification_type, value_type,value_compare,avg_reminder) value (
			'".addslashes($fields["trailer"])."',
			'".addslashes($fields["notification_type"])."',
			'".addslashes($fields["value_type"])."',
			'".addslashes($fields["value_compare"])."',
			'".addslashes($fields["avg_reminder"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			trailer = '".addslashes($fields["trailer"])."',
			notification_type = '".addslashes($fields["notification_type"])."',
			value_type = '".addslashes($fields["value_type"])."',
			value_compare = '".addslashes($fields["value_compare"])."',
			avg_reminder = '".addslashes($fields["avg_reminder"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}