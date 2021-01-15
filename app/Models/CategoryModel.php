<?php 

namespace Model;

class CategoryModel extends Model{

	const TABLE = "categories";

	public function all(){
		$sql = 'SELECT c.*, p.id parent_id, p.name parent_name FROM '.self::TABLE.' c
			left join  '.self::TABLE.' p ON c.parent_category = p.id
		ORDER BY name';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT  c.*, p.id parent_id, p.name parent_name FROM '.self::TABLE.' c
		left join  '.self::TABLE.' p ON c.parent_category = p.id
		WHERE c.id='.$id.' ORDER BY c.id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (name, parent_category) values ('{$fields["name"]}',{$fields["parent_category"]})";
		return $this->db->exec($sql);
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT  c.*, p.id parent_id, p.name parent_name FROM '.self::TABLE.' c
		left join  '.self::TABLE.' p ON c.parent_category = p.id '.$this->where($where).' ORDER BY c.parent_category asc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			name = '{$fields["name"]}',
			parent_category = {$fields["parent_category"]}
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}