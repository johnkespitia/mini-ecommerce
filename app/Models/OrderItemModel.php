<?php 

namespace Model;

class OrderItemModel extends Model{

	const TABLE = "order_items";

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
		$sql = "INSERT INTO ".self::TABLE." (order_id, product_id, product_price_sold, product_status, item_sku) values ({$fields["order_id"]},{$fields["product_id"]},{$fields["product_price_sold"]}, '{$fields["product_status"]}', '{$fields["item_sku"]}')";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
				order_id={$fields["order_id"]}, 
				product_price_sold={$fields["product_price_sold"]}, 
				product_id={$fields["product_id"]},
				product_status='{$fields["product_status"]}',
				item_sku = '{$fields["item_sku"]}'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}