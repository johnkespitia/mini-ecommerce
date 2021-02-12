<?php 

namespace Model;

class DailyModel extends Model{

	const TABLE = "daily_reports";

	public function all(){
		$sql = 'SELECT d.*, c.dni car_dni, c.modelo, ct.name type_car,   
		cm.name client_name, cm.dni client_dni, cm.email client_email, cm.phone client_phone, cm.address client_address, cty.name client_city,
		ep.name employe_name, ep.dni employe_dni, ep.email employe_email
		FROM '.self::TABLE.' d
		INNER JOIN cars c on c.id = d.car
		INNER JOIN car_types ct on c.car_type = ct.id 
		INNER JOIN customers cm on cm.id = d.customer
		INNER JOIN cities cty on cty.id = cm.city_id
		INNER JOIN employees ep on ep.id = d.employe
		ORDER BY d.id DESC';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT d.*, c.dni car_dni, c.modelo, ct.name type_car,   
		cm.name client_name, cm.dni client_dni, cm.email client_email, cm.phone client_phone, cm.address client_address, cty.name client_city,
		ep.name employe_name, ep.dni employe_dni, ep.email employe_email
		FROM '.self::TABLE.' d
		INNER JOIN cars c on c.id = d.car
		INNER JOIN car_types ct on c.car_type = ct.id 
		INNER JOIN customers cm on cm.id = d.customer
		INNER JOIN cities cty on cty.id = cm.city_id
		INNER JOIN employees ep on ep.id = d.employe
		WHERE d.id='.$id.' ORDER BY d.id desc';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT d.*, c.dni car_dni, c.modelo, ct.name type_car,   
		cm.name client_name, cm.dni client_dni, cm.email client_email, cm.phone client_phone, cm.address client_address, ct.name client_city,
		ep.name employe_name, ep.dni employe_dni, ep.email employe_email
		FROM '.self::TABLE.' d
		INNER JOIN cars c on c.id = d.car
		INNER JOIN car_types ct on c.car_type = ct.id 
		INNER JOIN customer cm on cm.id = d.customer
		INNER JOIN cities ct on ct.id = cm.city_id
		INNER JOIN employees ep on ep.id = d.employe
		'.$this->where($where).' ORDER BY d.id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (date_report, car, customer, employe, time_start_am, time_end_am, time_start_pm, time_end_pm, lunch_time, service_type, AREA, 
		worked_hours, abble_hours, km_start, km_end, people) value (
			'".addslashes($fields["date_report"])."', 
			".addslashes($fields["car"]).", 
			".addslashes($fields["customer"]).", 
			".addslashes($fields["employe"]).", 
			".addslashes($fields["time_start_am"]).", 
			".addslashes($fields["time_end_am"]).", 
			".addslashes($fields["time_start_pm"]).", 
			".addslashes($fields["time_end_pm"]).", 
			".addslashes($fields["lunch_time"]).", 
			'".addslashes($fields["service_type"])."', 
			'".addslashes($fields["area"])."', 
			".addslashes($fields["worked_hours"]).",
			".addslashes($fields["abble_hours"]).",
			".addslashes($fields["km_start"]).", 
			".addslashes($fields["km_end"]).", 
			".addslashes($fields["people"])."
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			date_report = '".addslashes($fields["date_report"])."', 
			car = ".addslashes($fields["car"]).", 
			customer = ".addslashes($fields["customer"]).", 
			employe = ".addslashes($fields["employe"]).", 
			time_start_am = ".addslashes($fields["time_start_am"]).", 
			time_end_am = ".addslashes($fields["time_end_am"]).", 
			time_start_pm = ".addslashes($fields["time_start_pm"]).", 
			time_end_pm = ".addslashes($fields["time_end_pm"]).", 
			lunch_time = ".addslashes($fields["lunch_time"]).", 
			service_type = '".addslashes($fields["service_type"])."', 
			area = '".addslashes($fields["area"])."', 
			worked_hours = ".addslashes($fields["worked_hours"]).",
			abble_hours = ".addslashes($fields["abble_hours"]).",
			km_start = ".addslashes($fields["km_start"]).", 
			km_end = ".addslashes($fields["km_end"]).", 
			people = ".addslashes($fields["people"])."
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}