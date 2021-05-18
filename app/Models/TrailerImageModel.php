<?php 

namespace Model;

class TrailerImageModel extends Model{

	const TABLE = "trailer_images";

	public function all(){
		$sql = 'SELECT *
		FROM '.self::TABLE.'
		ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT *
		FROM '.self::TABLE.'
		WHERE c.id='.$id.' ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT *
		FROM '.self::TABLE.'
		'.$this->where($where).' ORDER BY id'; 
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (trailer, url) value (
			".addslashes($fields["trailer"]).",
			'".addslashes($fields["url"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			url = '".addslashes($fields["url"])."', 
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