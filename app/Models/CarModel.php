<?php 

namespace Model;

class CarModel extends Model{

	const TABLE = "cars";

	public function all(){
		$sql = 'SELECT c.*, ct.name type_car, ft.name fuel_type, 
		lc.name line_category_name, b.name brand_name, 
		st.name service_type_name,
		con.dni owner_id, con.name owner_name, con.email owner_email
		FROM '.self::TABLE.' c
		INNER JOIN car_types ct on c.car_type = ct.id
		LEFT JOIN fuel_types ft on c.fuel_type = ft.id
		LEFT JOIN line_categories lc on c.line_category = lc.id
		LEFT JOIN brands b on c.brand = b.id
		LEFT JOIN service_types st on c.service_type = st.id
		LEFT JOIN car_owner con on c.car_owner = con.id
		ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT c.*, ct.name type_car, ft.name fuel_type, 
		lc.name line_category_name, b.name brand_name, 
		st.name service_type_name,
		con.dni owner_id, con.name owner_name, con.email owner_email
		FROM '.self::TABLE.' c
		INNER JOIN car_types ct on c.car_type = ct.id
		LEFT JOIN fuel_types ft on c.fuel_type = ft.id
		LEFT JOIN line_categories lc on c.line_category = lc.id
		LEFT JOIN brands b on c.brand = b.id
		LEFT JOIN service_types st on c.service_type = st.id
		LEFT JOIN car_owner con on c.car_owner = con.id
		WHERE c.id='.$id.' ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT c.*, ct.name type_car, ft.name fuel_type, 
		lc.name line_category_name, b.name brand_name, 
		st.name service_type_name,
		con.dni owner_id, con.name owner_name, con.email owner_email
		FROM '.self::TABLE.' c
		INNER JOIN car_types ct on c.car_type = ct.id
		LEFT JOIN fuel_types ft on c.fuel_type = ft.id
		LEFT JOIN line_categories lc on c.line_category = lc.id
		LEFT JOIN brands b on c.brand = b.id
		LEFT JOIN service_types st on c.service_type = st.id
		LEFT JOIN car_owner con on c.car_owner = con.id
		'.$this->where($where).' ORDER BY id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (dni, car_type,modelo ,status, fuel_type, line_category, brand, service_type,
		internal_number, relationship, cc, color, service_permission, body_type, no_doors, no_engine, vin, no_serie, tn_charge, 
		no_chasis, date_license, car_owner, oil_change_km
		) value (
			'".addslashes($fields["dni"])."', 
			".addslashes($fields["car_type"]).",
			'".addslashes($fields["modelo"])."', 
			".addslashes($fields["status"]).",
			".addslashes($fields["fuel_type"]).",
			".addslashes($fields["line_category"]).",
			".addslashes($fields["brand"]).",
			".addslashes($fields["service_type"]).",
			'".addslashes($fields["internal_number"])."',
			'".addslashes($fields["relationship"])."',
			'".addslashes($fields["cc"])."',
			'".addslashes($fields["color"])."',
			'".addslashes($fields["service_permission"])."',
			'".addslashes($fields["body_type"])."',
			'".addslashes($fields["no_doors"])."',
			'".addslashes($fields["no_engine"])."',
			'".addslashes($fields["vin"])."',
			'".addslashes($fields["no_serie"])."',
			'".addslashes($fields["tn_charge"])."',
			'".addslashes($fields["no_chasis"])."',
			'".addslashes($fields["date_license"])."',
			'".addslashes($fields["car_owner"])."',
			'".addslashes($fields["oil_change_km"])."'
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
			service_type = ".addslashes($fields["service_type"]).",
			internal_number = '".addslashes($fields["internal_number"])."',
			relationship = '".addslashes($fields["relationship"])."',
			cc = '".addslashes($fields["cc"])."',
			color = '".addslashes($fields["color"])."',
			service_permission = '".addslashes($fields["service_permission"])."',
			body_type = '".addslashes($fields["body_type"])."',
			no_doors = '".addslashes($fields["no_doors"])."',
			no_engine = '".addslashes($fields["no_engine"])."',
			vin = '".addslashes($fields["vin"])."',
			no_serie = '".addslashes($fields["no_serie"])."',
			tn_charge = '".addslashes($fields["tn_charge"])."',
			no_chasis = '".addslashes($fields["no_chasis"])."',
			date_license = '".addslashes($fields["date_license"])."',
			car_owner = '".addslashes($fields["car_owner"])."',
			oil_change_km = '".addslashes($fields["oil_change_km"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}