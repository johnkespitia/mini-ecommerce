<?php 

namespace Model;

class MaintainceTrailerModel extends Model{

	const TABLE = "trailer_maintainces";

	public function all(){
		$sql = 'SELECT fc.*, c.dni FROM '.self::TABLE.' fc
		INNER JOIN trailer c ON c.id = fc.trailer
		ORDER BY fc.id desc';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT fc.*, c.dni FROM '.self::TABLE.' fc
		INNER JOIN trailer c ON c.id = fc.trailer '.$this->where($where).' ORDER BY fc.id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function find($id){
		$sql = 'SELECT fc.*, c.dni  FROM '.self::TABLE.' fc
		INNER JOIN trailer c ON c.id = fc.trailer
		WHERE fc.id='.$id.' ORDER BY fc.id desc'; 
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}
	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (trailer, date_maintaince, provider, type_maintance , abble, subject, status, observations) value (
			'".addslashes($fields["trailer"])."',
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
			trailer = '".addslashes($fields["trailer"])."',
			date_maintaince = '".addslashes($fields["date_maintaince"])."',
			provider = '".addslashes($fields["provider"])."',
			type_maintance = '".addslashes($fields["type_maintance"])."',
			abble = '".(!empty($fields["abble"])?1:0)."',
			subject = '".addslashes($fields["subject"])."',
			status = '".addslashes($fields["status"])."',
			results = '".addslashes($fields["results"])."',
			cost = '".addslashes($fields["cost"])."',
			observations = '".addslashes($fields["observations"])."',
			date_finished = '".addslashes($fields["date_finished"])."',
			url = '".addslashes($fields["url"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}