<?php 

namespace Model;

class ProductModel extends Model{

	const TABLE = "products";

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
		$sql = "INSERT INTO ".self::TABLE." (sku, name, price) values ('{$fields["sku"]}','{$fields["name"]}',{$fields["price"]})";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
				name='{$fields["name"]}', 
				sku='{$fields["sku"]}', 
				price={$fields["price"]}
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}