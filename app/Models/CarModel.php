<?php 

namespace Model;

class CarModel extends Model{

	const TABLE = "cars";

	public function all(){
		$sql = 'SELECT c.*, ct.name type_car FROM '.self::TABLE.' c
		INNER JOIN car_types ct on c.car_type = ct.id
		ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT c.*, ct.name type_car FROM '.self::TABLE.'  c
		INNER JOIN car_types ct on c.car_type = ct.id 
		WHERE c.id='.$id.' ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT c.*, ct.name type_car FROM '.self::TABLE.' c
		INNER JOIN car_types ct on c.car_type = ct.id  
		'.$this->where($where).' ORDER BY id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (dni, car_type,modelo ,status) value (
			'".addslashes($fields["dni"])."', 
			".addslashes($fields["car_type"]).",
			'".addslashes($fields["modelo"])."', 
			".addslashes($fields["status"])."
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			dni = '".addslashes($fields["dni"])."', 
			modelo = '".addslashes($fields["modelo"])."', 
			car_type = ".addslashes($fields["car_type"]).",
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