<?php 

namespace Model;

class TrailerModel extends Model{

	const TABLE = "trailer";

	public function all(){
		$sql = 'SELECT c.*, ct.name type_trailer,
		b.name brand_name, 
		con.name contractor_name
		FROM '.self::TABLE.' c
		INNER JOIN trailer_type ct on c.type = ct.id
		LEFT JOIN brands b on c.brand = b.id
		LEFT JOIN contractor con on c.contractor = con.id
		ORDER BY c.id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT c.*, ct.name type_trailer,
		b.name brand_name, 
		con.name contractor_name
		FROM '.self::TABLE.' c
		INNER JOIN trailer_type ct on c.type = ct.id
		LEFT JOIN brands b on c.brand = b.id
		LEFT JOIN contractor con on c.contractor = con.id
		WHERE c.id='.$id.' ORDER BY c.id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT c.*, ct.name type_trailer,
		b.name brand_name, 
		con.name contractor_name
		FROM '.self::TABLE.' c
		INNER JOIN trailer_type ct on c.type = ct.id
		LEFT JOIN brands b on c.brand = b.id
		LEFT JOIN contractor con on c.contractor = con.id
		'.$this->where($where).' ORDER BY c.id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (
			dni, register_code, register_date, register_city, brand, cover, model, 
			color, dni_color, axis_number, weight_capacity, contractor, `type`, `status`
		) value (
			'".addslashes($fields["dni"])."', 
			'".addslashes($fields["register_code"])."', 
			'".addslashes($fields["register_date"])."', 
			'".addslashes($fields["register_city"])."', 
			'".addslashes($fields["brand"])."', 
			'".addslashes($fields["cover"])."', 
			'".addslashes($fields["model"])."', 
			'".addslashes($fields["color"])."', 
			'".addslashes($fields["dni_color"])."', 
			'".addslashes($fields["axis_number"])."', 
			'".addslashes($fields["weight_capacity"])."', 
			'".addslashes($fields["contractor"])."', 
			'".addslashes($fields["type"])."', 
			'".addslashes($fields["status"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			dni = '".addslashes($fields["dni"])."', 
			register_code = '".addslashes($fields["register_code"])."', 
			register_date = '".addslashes($fields["register_date"])."', 
			register_city = '".addslashes($fields["register_city"])."', 
			brand = '".addslashes($fields["brand"])."', 
			cover = '".addslashes($fields["cover"])."', 
			model = '".addslashes($fields["model"])."', 
			color = '".addslashes($fields["color"])."', 
			dni_color = '".addslashes($fields["dni_color"])."', 
			axis_number = '".addslashes($fields["axis_number"])."', 
			weight_capacity = '".addslashes($fields["weight_capacity"])."', 
			contractor = '".addslashes($fields["contractor"])."', 
			type = '".addslashes($fields["type"])."', 
			status = '".addslashes($fields["status"])."'
			WHERE id = {$id}"; 
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}