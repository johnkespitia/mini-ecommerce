<?php 

namespace Model;

class ChecklistTemplateModel extends Model{

	const TABLE = "checklist_template";

	public function all(){
		$sql = 'SELECT c1.*, c2.id id_parent, c2.title title_parent, ct.name checklist_type_name, ct.status checklist_type_status
		 FROM '.self::TABLE.' c1
		left join '.self::TABLE.' c2
		on c1.parent = c2.id
		inner join checklist_type ct
		on ct.id = c1.checklist_type
		ORDER BY c1.id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT c1.*, c2.id id_parent, c2.title title_parent, ct.name checklist_type_name, ct.status checklist_type_status 
		FROM '.self::TABLE.' c1
		left join '.self::TABLE.' c2
		on c1.parent = c2.id
		inner join checklist_type ct
		on ct.id = c1.checklist_type
		'.$this->where($where).' 
		ORDER BY c1.parent asc, c1.id asc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function find($id){
		$sql = 'SELECT c1.*, c2.id id_parent, c2.title title_parent , ct.name checklist_type_name, ct.status checklist_type_status 
		FROM '.self::TABLE.' c1
		left join '.self::TABLE.' c2
		on c1.parent = c2.id
		inner join checklist_type ct
		on ct.id = c1.checklist_type
		WHERE c1.id='.$id.' 
		ORDER BY c1.id';
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}
	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (title,version,required,parent,status, checklist_type) value (
			'".addslashes($fields["title"])."',
			'".addslashes($fields["version"])."',
			'".addslashes($fields["required"])."',
			".(!empty($fields["parent"])?$fields["parent"]:"NULL").",
			'".addslashes($fields["status"])."',
			'".addslashes($fields["checklist_type"])."'
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			title = '".addslashes($fields["title"])."',
			version = '".addslashes($fields["version"])."',
			required = '".addslashes($fields["required"])."',
			checklist_type = '".addslashes($fields["checklist_type"])."',
			parent = ".(!empty($fields["parent"])?$fields["parent"]:"NULL").",
			status = '".addslashes($fields["status"])."'
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}
}