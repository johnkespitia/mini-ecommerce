<?php 

namespace Model;

class OrderModel extends Model{

	const TABLE = "orders";

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
		$sql = "INSERT INTO ".self::TABLE." (customer_id, date_order, total) values ('{$fields["customer_id"]}','{$fields["date_order"]}',{$fields["total"]})";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
				customer_id='{$fields["customer_id"]}', 
				date_order='{$fields["date_order"]}', 
				total={$fields["total"]}
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}