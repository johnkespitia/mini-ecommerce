<?php 

namespace Model;

class MaintainceCarModel extends Model{

	const TABLE = "car_maintainces";

	public function all(){
		$sql = 'SELECT fc.*, c.dni FROM '.self::TABLE.' fc
		INNER JOIN cars c ON c.id = fc.car
		ORDER BY fc.id desc';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT fc.*, c.dni FROM '.self::TABLE.' fc
		INNER JOIN cars c ON c.id = fc.car '.$this->where($where).' ORDER BY fc.id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function find($id){
		$sql = 'SELECT fc.*, c.dni  FROM '.self::TABLE.' fc
		INNER JOIN cars c ON c.id = fc.car
		WHERE id='.$id.' ORDER BY fc.id desc';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}
	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (car, date_maintaince, provider, type_maintance , abble, subject, status, observations) value (
			'".addslashes($fields["car"])."',
			'".addslashes($fields["date_maintaince"])."',
			'".addslashes($fields["provider"])."',
			'".addslashes($fields["type_maintance"])."',
			'".(!empty($fields["abble"])?1:0)."',
			'".addslashes($fields["subject"])."',
			'".addslashes($fields["status"])."',
			'".addslashes($fields["observations"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			car = '".addslashes($fields["car"])."',
			date_maintaince = '".addslashes($fields["date_maintaince"])."',
			provider = '".addslashes($fields["provider"])."',
			type_maintance = '".addslashes($fields["type_maintance"])."',
			abble = '".(!empty($fields["abble"])?1:0)."',
			subject = '".addslashes($fields["subject"])."',
			status = '".addslashes($fields["status"])."',
			results = '".addslashes($fields["results"])."',
			cost = '".addslashes($fields["cost"])."',
			observations = '".addslashes($fields["observations"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}
}