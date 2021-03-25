<?php 

namespace Model;

class CarOwnerModel extends Model{

	const TABLE = "car_owner";

	public function all(){
		$sql = 'SELECT fc.* FROM '.self::TABLE.' fc
		ORDER BY fc.id desc';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT fc.* FROM '.self::TABLE.' fc
		'.$this->where($where).' ORDER BY fc.id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function find($id){
		$sql = 'SELECT fc.*  FROM '.self::TABLE.' fc
		WHERE fc.id='.$id.' ORDER BY fc.id desc';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}
	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (dni, name, email) value (
			'".addslashes($fields["dni"])."',
			'".addslashes($fields["name"])."',
			'".addslashes($fields["email"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			dni = '".addslashes($fields["dni"])."',
			name = '".addslashes($fields["name"])."',
			email = '".addslashes($fields["email"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}
}