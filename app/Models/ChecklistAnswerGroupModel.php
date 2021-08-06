<?php 

namespace Model;

class ChecklistAnswerGroupModel extends Model{

	const TABLE = "checklist_answer";

	public function all(){
		$sql = 'SELECT a.*, ct.title checklist_title, c.dni car_dni, e.dni employee_dni, e.name employee_name
		e.email employee_email FROM '.self::TABLE.' a 
		INNER JOIN checklist_template ct ON a.checklist_template_id=ct.id
		INNER JOIN cars c ON a.car_id=c.id
		INNER JOIN employees e ON a.employee_id=e.id
		INNER JOIN daily_reports dr ON a.daily_report_id=dr.id

		ORDER BY a.id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT a.*, ct.title checklist_title, c.dni car_dni, e.dni employee_dni, e.name employee_name
		e.email employee_email FROM '.self::TABLE.' a 
		INNER JOIN checklist_template ct ON a.checklist_template_id=ct.id
		INNER JOIN cars c ON a.car_id=c.id
		INNER JOIN employees e ON a.employee_id=e.id
		INNER JOIN daily_reports dr ON a.daily_report_id=dr.id
		'
		.$this->where($where).' 
		ORDER BY a.id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function find($id){
		$sql = 'SELECT a.*, ct.title checklist_title, c.dni car_dni, e.dni employee_dni, e.name employee_name
		e.email employee_email FROM '.self::TABLE.' a 
		INNER JOIN checklist_template ct ON a.checklist_template_id=ct.id
		INNER JOIN cars c ON a.car_id=c.id
		INNER JOIN employees e ON a.employee_id=e.id
		INNER JOIN daily_reports dr ON a.daily_report_id=dr.id

		WHERE a.id='.$id.' 
		ORDER BY a.id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}
	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (checklist_template_id, car_id, employee_id, daily_report_id, filled_date) value (
			'".addslashes($fields["checklist_template_id"])."',
			'".addslashes($fields["car_id"])."',
			'".addslashes($fields["employee_id"])."',
			'".addslashes($fields["daily_report_id"])."',
			'".addslashes($fields["filled_date"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			checklist_template_id = '".addslashes($fields["checklist_template_id"])."',
			car_id = '".addslashes($fields["car_id"])."',
			employee_id = '".addslashes($fields["employee_id"])."',
			daily_report_id = '".addslashes($fields["daily_report_id"])."',
			filled_date = '".addslashes($fields["filled_date"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}
}