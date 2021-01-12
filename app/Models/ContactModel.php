<?php 

namespace Model;

class ContactModel extends Model{

	const TABLE = "contacts";

	public function all(){
		$sql = 'SELECT c.id, c.title, c.reminder, c.repeat_period, c.repeat_times, c.method, c.datetime_start, c.datetime_end, c.description, c.type, c.order_id, c.user_id, c.customer_id,
		users.name user, users.email user_email, customers.name customer, customers.email customer_email, customers.phone customer_phone, customers.address customer_address
		FROM '.self::TABLE." c  INNER JOIN users ON c.user_id = users.id INNER JOIN customers ON c.customer_id = customers.id
			 LEFT JOIN orders on c.order_id=orders.id
			 ORDER BY id desc";
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT c.id, c.title, c.reminder, c.repeat_period, c.repeat_times, c.method, c.datetime_start, c.datetime_end, c.description, c.type, c.order_id, c.user_id, c.customer_id,
		users.name user, users.email user_email, customers.name customer, customers.email customer_email, customers.phone customer_phone, customers.address customer_address
		FROM '.self::TABLE." c  INNER JOIN users ON c.user_id = users.id INNER JOIN customers ON c.customer_id = customers.id
			 LEFT JOIN orders on c.order_id=orders.id
			 WHERE c.id={$id}
			 ORDER BY id desc";
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function findBy($where, $singleRow = false){
		$whereBuild = $this->where($where);
		$sql = 'SELECT c.id, c.title, c.reminder, c.repeat_period, c.repeat_times, c.method, c.datetime_start, c.datetime_end, c.description, c.type, c.order_id, c.user_id, c.customer_id,
		users.name user, users.email user_email, customers.name customer, customers.email customer_email, customers.phone customer_phone, customers.address customer_address
		FROM '.self::TABLE." c  INNER JOIN users ON c.user_id = users.id INNER JOIN customers ON c.customer_id = customers.id
			 LEFT JOIN orders on c.order_id=orders.id
			 ".$whereBuild."
			 ORDER BY c.id desc";
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (title,description,user_id,type,
		customer_id,datetime_start,datetime_end, method, order_id, reminder, repeat_period, repeat_times) value (
			'".addslashes($fields["title"])."', 
			'".addslashes($fields["description"])."', 
			".addslashes($fields["user_id"]).", 
			'".addslashes($fields["type"])."', 
			".addslashes($fields["customer_id"]).", 
			'".addslashes($fields["datetime_start"])."', 
			'".addslashes($fields["datetime_end"])."',
			'".addslashes($fields["method"])."',
			".addslashes($fields["order_id"]).",
			'".addslashes($fields["reminder"])."',
			".addslashes($fields["repeat_period"]).",
			".addslashes($fields["repeat_times"])."
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		echo $sql = "UPDATE ".self::TABLE." 
			SET
			title = '".addslashes($fields["title"])."', 
			description = '".addslashes($fields["description"])."', 
			type = '".addslashes($fields["type"])."', 
			method = '".addslashes($fields["method"])."', 
			datetime_start = '".addslashes($fields["datetime_start"])."', 
			datetime_end = '".addslashes($fields["datetime_end"])."', 
			customer_id = ".addslashes($fields["customer_id"]).", 
			order_id = ".addslashes($fields["order_id"]).",
			reminder = '".addslashes($fields["reminder"])."'
			WHERE id = {$id}";
			/*
			,
			repeat_period = ".addslashes($fields["repeat_period"]).",
			repeat_times = ".addslashes($fields["repeat_times"])."
			*/
		return $this->db->exec($sql);
	}
}