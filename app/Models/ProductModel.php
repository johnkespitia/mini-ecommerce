<?php 

namespace Model;

class ProductModel extends Model{

	const TABLE = "products";

	public function all(){
		$sql = 'SELECT p.*, c.id category_id, c.name category_name FROM '.self::TABLE.' p
		LEFT JOIN categories c on p.category_id = c.id
		ORDER BY p.name';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT p.*, c.id category_id, c.name category_name FROM '.self::TABLE.'  p
		LEFT JOIN categories c on p.category_id = c.id WHERE p.id='.$id.' ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	
	public function findBy($where, $singleRow = false){
		$sql = 'SELECT  p.*, c.id category_id, c.name category_name FROM '.self::TABLE.'  p
		LEFT JOIN categories c on p.category_id = c.id '.$this->where($where).' ORDER BY id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
			return $row;
			else
			yield $row;
		}	
	}
	
	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (sku, name, price, quantity, category_id, description, images) 
		values ('{$fields["sku"]}','{$fields["name"]}',{$fields["price"]},{$fields["quantity"]},{$fields["category_id"]},'{$fields["description"]}','{$fields["images"]}')";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
				name='{$fields["name"]}', 
				sku='{$fields["sku"]}', 
				price={$fields["price"]},
				quantity={$fields["quantity"]},
				category_id = {$fields["category_id"]},
				description = '{$fields["description"]}',
				images = '{$fields["images"]}'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}