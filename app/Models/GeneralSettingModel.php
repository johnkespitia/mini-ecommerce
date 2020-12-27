<?php 

namespace Model;

class GeneralSettingModel extends Model{

	const TABLE = "general_settings";

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
		$sql = "INSERT INTO ".self::TABLE." (name,value,status) value (
			'".addslashes($fields["name"])."', 
			'".addslashes($fields["value"])."', 
			".addslashes($fields["status"])."
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			name = '".addslashes($fields["name"])."', 
			value = '".addslashes($fields["value"])."', 
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