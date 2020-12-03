<?php 

namespace Model;

class CityModel extends Model{

	const TABLE = "cities";

	public function all(){
		$sql = 'SELECT * FROM '.self::TABLE.' ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy(){
		
	}

	public function create(){
		
	}

	public function update(){
		
	}

	public function delete(){
		
	}
}