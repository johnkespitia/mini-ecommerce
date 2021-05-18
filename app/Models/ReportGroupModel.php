<?php 

namespace Model;

class ReportGroupModel extends Model{

	const TABLE = "report_groups";

	public function all(){
		$sql = 'SELECT g.id, g.date_report, g.service_type, g.area, g.car, c.dni car_dni, c.modelo car_model, ct.name type_car, 
		cm.name client_name, cm.dni client_dni, cm.email client_email, cm.phone client_phone, cm.address client_address, cty.name client_city, 
		t.dni trailer_dni, t.model trailer_model, tt.name type_car, g.trailer,
		count(dr.id) rows_report 
		FROM report_groups g 
		INNER JOIN cars c on c.id = g.car 
		INNER JOIN trailer t on t.id = g.trailer 
		INNER JOIN car_types ct on c.car_type = ct.id 
		INNER JOIN trailer_type tt on t.type = tt.id 
		INNER JOIN customers cm on cm.id = g.customer 
		INNER JOIN cities cty ON cty.id = cm.city_id
		LEFT JOIN daily_reports dr on g.id = dr.report_group 
		GROUP BY g.id, g.date_report, g.service_type, g.area, g.car, c.dni, c.modelo, ct.name, cm.name, cm.dni, cm.email, cm.phone, cm.address, cty.name ,t.dni, t.model , tt.name, g.trailer
		ORDER BY g.id DESC';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT g.id, g.date_report, g.service_type, g.area, g.car, c.dni car_dni, c.modelo car_model, ct.name type_car, 
		cm.name client_name, cm.dni client_dni, cm.email client_email, cm.phone client_phone, cm.address client_address, cty.name client_city, 
		t.dni trailer_dni, t.model trailer_model, tt.name type_car, g.trailer,
		count(dr.id) rows_report 
		FROM report_groups g 
		INNER JOIN cars c on c.id = g.car 
		INNER JOIN trailer t on t.id = g.trailer 
		INNER JOIN car_types ct on c.car_type = ct.id
		INNER JOIN trailer_type tt on t.type = tt.id  
		INNER JOIN customers cm on cm.id = g.customer 
		INNER JOIN cities cty ON cty.id = cm.city_id
		LEFT JOIN daily_reports dr on g.id = dr.report_group 
		WHERE g.id='.$id.' 
		GROUP BY g.id, g.date_report, g.service_type, g.area, g.car, c.dni, c.modelo, ct.name, cm.name, cm.dni, cm.email, cm.phone, cm.address, cty.name,
		t.dni, t.model , tt.name, g.trailer
		ORDER BY g.id desc'; 
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT g.id, g.date_report, g.service_type, g.area, g.car, c.dni car_dni, c.modelo car_model, ct.name type_car, 
		cm.name client_name, cm.dni client_dni, cm.email client_email, cm.phone client_phone, cm.address client_address, cty.name client_city, 
		t.dni trailer_dni, t.model trailer_model, tt.name type_car, g.trailer,
		count(dr.id) rows_report 
		FROM report_groups g 
		INNER JOIN cars c on c.id = g.car 
		INNER JOIN trailer t on t.id = g.trailer 
		INNER JOIN car_types ct on c.car_type = ct.id 
		INNER JOIN trailer_type tt on t.type = tt.id 
		INNER JOIN customers cm on cm.id = g.customer 
		INNER JOIN cities cty ON cty.id = cm.city_id
		LEFT JOIN daily_reports dr on g.id = dr.report_group 
		'.$this->where($where).' 
		GROUP BY g.id, g.date_report, g.service_type, g.area, g.car, c.dni, c.modelo, ct.name, cm.name, cm.dni, cm.email, cm.phone, cm.address, cty.name,
		t.dni, t.model , tt.name, g.trailer
		ORDER BY g.id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (date_report,  service_type, area, car, customer, trailer) value (
			'".addslashes($fields["date_report"])."', 
			'".addslashes($fields["service_type"])."', 
			'".addslashes($fields["area"])."', 
			".addslashes($fields["car"]).", 
			".addslashes($fields["customer"]).",
			".addslashes($fields["trailer"])." 
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			date_report = '".addslashes($fields["date_report"])."', 
			car = ".addslashes($fields["car"]).", 
			customer = ".addslashes($fields["customer"]).",
			service_type = '".addslashes($fields["service_type"])."', 
			area = '".addslashes($fields["area"])."',
			trailer = '".addslashes($fields["trailer"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}