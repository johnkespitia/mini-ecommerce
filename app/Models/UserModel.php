<?php 

namespace Model;

class UserModel extends Model{

	const TABLE = "users";

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

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT * FROM '.self::TABLE.' '.$this->where($where).' ORDER BY id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (username,password,name,email,rol_id,status) value (
			'".addslashes($fields["username"])."', 
			'".addslashes($fields["password"])."', 
			'".addslashes($fields["name"])."', 
			'".addslashes($fields["email"])."', 
			".addslashes($fields["rol_id"]).", 
			".addslashes($fields["status"])."
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			username = '".addslashes($fields["username"])."', 
			password = '".addslashes($fields["password"])."', 
			name = '".addslashes($fields["name"])."', 
			email = '".addslashes($fields["email"])."', 
			rol_id = ".addslashes($fields["rol_id"]).", 
			status = ".addslashes($fields["status"])."
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}