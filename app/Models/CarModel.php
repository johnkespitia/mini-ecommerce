<?php 

namespace Model;

class CarModel extends Model{

	const TABLE = "cars";

	public function all(){
		$sql = 'SELECT c.*, ct.name type_car, ft.name fuel_type, 
		lc.name line_category_name, b.name brand_name, 
		st.name service_type_name
		FROM '.self::TABLE.' c
		INNER JOIN car_types ct on c.car_type = ct.id
		LEFT JOIN fuel_types ft on c.fuel_type = ft.id
		LEFT JOIN line_categories lc on c.line_category = lc.id
		LEFT JOIN brands b on c.brand = b.id
		LEFT JOIN service_types st on c.service_type = st.id
		ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT c.*, ct.name type_car, ft.name fuel_type, 
		lc.name line_category_name, b.name brand_name, 
		st.name service_type_name
		FROM '.self::TABLE.' c
		INNER JOIN car_types ct on c.car_type = ct.id
		LEFT JOIN fuel_types ft on c.fuel_type = ft.id
		LEFT JOIN line_categories lc on c.line_category = lc.id
		LEFT JOIN brands b on c.brand = b.id
		LEFT JOIN service_types st on c.service_type = st.id
		WHERE c.id='.$id.' ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT c.*, ft.name fuel_type, 
		lc.name line_category_name, b.name brand_name, 
		st.name service_type_name
		FROM '.self::TABLE.' c
		INNER JOIN car_types ct on c.car_type = ct.id
		LEFT JOIN fuel_types ft on c.fuel_type = ft.id
		LEFT JOIN line_categories lc on c.line_category = lc.id
		LEFT JOIN brands b on c.brand = b.id
		LEFT JOIN service_types st on c.service_type = st.id
		'.$this->where($where).' ORDER BY id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (dni, car_type,modelo ,status, fuel_type, line_category, brand, service_type) value (
			'".addslashes($fields["dni"])."', 
			".addslashes($fields["car_type"]).",
			'".addslashes($fields["modelo"])."', 
			".addslashes($fields["status"]).",
			".addslashes($fields["fuel_type"]).",
			".addslashes($fields["line_category"]).",
			".addslashes($fields["brand"]).",
			".addslashes($fields["service_type"])."
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			dni = '".addslashes($fields["dni"])."', 
			modelo = '".addslashes($fields["modelo"])."', 
			car_type = ".addslashes($fields["car_type"]).",
			status = ".addslashes($fields["status"]).",
			fuel_type = ".addslashes($fields["fuel_type"]).",
			line_category = ".addslashes($fields["line_category"]).",
			brand = ".addslashes($fields["brand"]).",
			service_type = ".addslashes($fields["service_type"])."
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}