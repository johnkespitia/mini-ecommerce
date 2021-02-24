<?php 

namespace Model;

class PermissionModel extends Model{

	const TABLE = "permissions";

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
		$sql = "INSERT INTO ".self::TABLE." (rol_id, permission, module, status) value (
			".addslashes($fields["rol_id"]).",
			'".addslashes($fields["permission"])."',
			'".addslashes($fields["module"])."',
			".addslashes($fields["status"])."
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			rol_id = ".addslashes($fields["rol_id"]).",
			permission = '".addslashes($fields["permission"])."',
			module = '".addslashes($fields["module"])."',
			status = '".addslashes($fields["status"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}
}