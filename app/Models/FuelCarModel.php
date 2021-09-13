<?php 

namespace Model;

class FuelCarModel extends Model{

	const TABLE = "fuel_cars";

	public function all(){
		$sql = 'SELECT fc.*, c.dni, ft.name fuel_type_name FROM '.self::TABLE.' fc
		INNER JOIN cars c ON c.id = fc.car
		INNER JOIN fuel_types ft ON c.fuel_type = ft.id
		ORDER BY fc.id desc';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT fc.*, c.dni, ft.name fuel_type_name FROM '.self::TABLE.' fc
		INNER JOIN cars c ON c.id = fc.car 
		INNER JOIN fuel_types ft ON c.fuel_type = ft.id
		'.$this->where($where).' ORDER BY fc.id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function find($id){
		$sql = 'SELECT fc.*, c.dni, ft.name fuel_type_name  FROM '.self::TABLE.' fc
		INNER JOIN cars c ON c.id = fc.car
		INNER JOIN fuel_types ft ON c.fuel_type = ft.id
		WHERE fc.id='.$id.' ORDER BY fc.id desc';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}
	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (car, date_fuel, provider, quantity , ticket, full, image, observations, vale, article_code) value (
			'".addslashes($fields["car"])."',
			'".addslashes($fields["date_fuel"])."',
			'".addslashes($fields["provider"])."',
			'".addslashes($fields["quantity"])."',
			'".addslashes($fields["ticket"])."',
			'".(!empty($fields["full"])?1:0)."',
			'".addslashes($fields["image"])."',
			'".addslashes($fields["observations"])."',
			'".addslashes($fields["vale"])."',
			'".addslashes($fields["article_code"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			car = '".addslashes($fields["car"])."',
			date_fuel = '".addslashes($fields["date_fuel"])."',
			provider = '".addslashes($fields["provider"])."',
			quantity = '".addslashes($fields["quantity"])."',
			ticket = '".addslashes($fields["ticket"])."',
			full = '".(!empty($fields["full"])?1:0)."',
			image = '".addslashes($fields["image"])."',
			observations = '".addslashes($fields["observations"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}
	
	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." WHERE id = {$id}";
		return $this->db->exec($sql);
	}
}