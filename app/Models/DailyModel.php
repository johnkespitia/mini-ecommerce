<?php 

namespace Model;

class DailyModel extends Model{

	const TABLE = "daily_reports";

	public function all(){
		$sql = 'SELECT d.*, c.dni car_dni, c.modelo, ct.name type_car, origin.name origin_name, destination.name destination_name,  
		rg.date_report report_date_report, rg.service_type, rg.area,
		cm.name client_name, cm.dni client_dni, cm.email client_email, cm.phone client_phone, cm.address client_address, cty.name client_city,
		ep.name employe_name, ep.dni employe_dni, ep.email employe_email
		FROM '.self::TABLE.' d
		INNER JOIN report_groups rg on d.report_group = rg.id
		INNER JOIN cars c on c.id = rg.car
		INNER JOIN car_types ct on c.car_type = ct.id 
		INNER JOIN customers cm on cm.id = rg.customer
		INNER JOIN cities cty on cty.id = cm.city_id
		INNER JOIN employees ep on ep.id = d.employe
		INNER JOIN cities origin on origin.id = d.origin
		INNER JOIN cities destination on destination.id = d.destination
		ORDER BY d.id DESC';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT d.*, c.dni car_dni, c.modelo, ct.name type_car, origin.name origin_name, destination.name destination_name,  
		rg.date_report report_date_report, rg.service_type, rg.area,
		cm.name client_name, cm.dni client_dni, cm.email client_email, cm.phone client_phone, cm.address client_address, cty.name client_city,
		ep.name employe_name, ep.dni employe_dni, ep.email employe_email
		FROM '.self::TABLE.' d
		INNER JOIN report_groups rg on d.report_group = rg.id
		INNER JOIN cars c on c.id = rg.car
		INNER JOIN car_types ct on c.car_type = ct.id 
		INNER JOIN customers cm on cm.id = rg.customer
		INNER JOIN cities cty on cty.id = cm.city_id
		INNER JOIN employees ep on ep.id = d.employe
		INNER JOIN cities origin on origin.id = d.origin
		INNER JOIN cities destination on destination.id = d.destination
		WHERE d.id='.$id.' ORDER BY d.id desc';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT d.*, c.dni car_dni, c.modelo, ct.name type_car, origin.name origin_name, destination.name destination_name,  
		rg.date_report report_date_report, rg.service_type, rg.area,
		cm.name client_name, cm.dni client_dni, cm.email client_email, cm.phone client_phone, cm.address client_address, cty.name client_city,
		ep.name employe_name, ep.dni employe_dni, ep.email employe_email
		FROM '.self::TABLE.' d
		INNER JOIN report_groups rg on d.report_group = rg.id
		INNER JOIN cars c on c.id = rg.car
		INNER JOIN car_types ct on c.car_type = ct.id 
		INNER JOIN customers cm on cm.id = rg.customer
		INNER JOIN cities cty on cty.id = cm.city_id
		INNER JOIN employees ep on ep.id = d.employe
		INNER JOIN cities origin on origin.id = d.origin
		INNER JOIN cities destination on destination.id = d.destination
		'.$this->where($where).' ORDER BY d.id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (date_report,  employe, time_start_am, time_end_am, time_start_pm, time_end_pm, lunch_time, 
		worked_hours, abble_hours, km_start, km_end, people, origin, destination, 	report_group) value (
			'".addslashes($fields["date_report"])."', 
			".addslashes($fields["employe"]).", 
			".addslashes($fields["time_start_am"]).", 
			".addslashes($fields["time_end_am"]).", 
			".addslashes($fields["time_start_pm"]).", 
			".addslashes($fields["time_end_pm"]).", 
			".addslashes($fields["lunch_time"]).", 
			".addslashes($fields["worked_hours"]).",
			".addslashes($fields["abble_hours"]).",
			".addslashes($fields["km_start"]).", 
			".addslashes($fields["km_end"]).", 
			".addslashes($fields["people"]).",
			".addslashes($fields["origin"]).",
			".addslashes($fields["destination"]).",
			".addslashes($fields["report_group"])."
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			date_report = '".addslashes($fields["date_report"])."', 
			origin = ".addslashes($fields["origin"]).", 
			destination = ".addslashes($fields["destination"]).", 
			employe = ".addslashes($fields["employe"]).", 
			time_start_am = ".addslashes($fields["time_start_am"]).", 
			time_end_am = ".addslashes($fields["time_end_am"]).", 
			time_start_pm = ".addslashes($fields["time_start_pm"]).", 
			time_end_pm = ".addslashes($fields["time_end_pm"]).", 
			lunch_time = ".addslashes($fields["lunch_time"]).", 
			worked_hours = ".addslashes($fields["worked_hours"]).",
			abble_hours = ".addslashes($fields["abble_hours"]).",
			km_start = ".addslashes($fields["km_start"]).", 
			km_end = ".addslashes($fields["km_end"]).", 
			people = ".addslashes($fields["people"]).",
			report_group = ".addslashes($fields["report_group"])."
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}