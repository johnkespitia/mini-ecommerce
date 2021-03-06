<?php 

namespace Model;

class CustomerModel extends Model{

	const TABLE = "customers";

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

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (name, phone, address, city_id, email, dni) values ('{$fields["name"]}','{$fields["phone"]}','{$fields["address"]}',{$fields["city_id"]},'{$fields["email"]}','{$fields["dni"]}')";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
				name='{$fields["name"]}', 
				phone='{$fields["phone"]}', 
				address='{$fields["address"]}', 
				city_id={$fields["city_id"]}, 
				email='{$fields["email"]}',
				dni = '{$fields["dni"]}',
				newsletter = '{$fields["newsletter"]}'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
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
}