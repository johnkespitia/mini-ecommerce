<?php 

namespace Model;

class DocumentTypeModel extends Model{

	const TABLE = "document_types";

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
		$sql = "INSERT INTO ".self::TABLE." (name, car, trailer) value (
			'".addslashes($fields["name"])."',
			'".addslashes($fields["car"])."',
			'".addslashes($fields["trailer"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			name = '".addslashes($fields["name"])."',
			car = '".addslashes($fields["car"])."',
			trailer = '".addslashes($fields["trailer"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}
}