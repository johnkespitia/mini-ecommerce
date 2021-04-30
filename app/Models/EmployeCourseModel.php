<?php

namespace Model;

class EmployeCourseModel extends Model
{

	const TABLE = "employe_courses";

	public function all()
	{
		$sql = 'SELECT d.* , dt.name course_name
				FROM ' . self::TABLE . ' d
				INNER JOIN courses dt ON dt.id = d.course
				ORDER BY d.id';
		foreach ($this->db->query($sql) as $row) {
			yield $row;
		}
	}

	public function findBy($where, $singleRow = false)
	{
		$sql = 'SELECT d.* , dt.name course_name, c.dni employe_dni, c.name employe_name
		FROM ' . self::TABLE . ' d
		INNER JOIN courses dt ON dt.id = d.course
		INNER JOIN employees c ON c.id = d.employe
		' . $this->where($where) . ' ORDER BY d.id desc';
		foreach ($this->db->query($sql) as $row) {
			if ($singleRow)
				return $row;
			else
				yield $row;
		}
	}

	public function find($id)
	{
		$sql = 'SELECT d.* , dt.name course_name
		FROM ' . self::TABLE . ' d
		INNER JOIN courses dt ON dt.id = d.course
		WHERE d.id=' . $id . ' ORDER BY d.id';
		foreach ($this->db->query($sql) as $row) {
			return $row;
		}
	}
	public function create($fields)
	{
		$sql = "INSERT INTO " . self::TABLE . " (course, employe, provider, url, code, date_created, expiration_date, expedition_date,qualification) value (
			" . addslashes($fields["course"]) . ",
			" . addslashes($fields["employe"]) . ",
			'" . addslashes($fields["provider"]) . "',
			'" . addslashes($fields["url"]) . "',
			'" . addslashes($fields["code"]) . "',
			'" . addslashes($fields["date_created"]) . "',
			" . ((!empty($fields["expiration_date"])) ? "'" . addslashes($fields["expiration_date"]) . "'" : "NULL") . ",
			" . ((!empty($fields["expedition_date"])) ? "'" . addslashes($fields["expedition_date"]) . "'" : "NULL") . ",
			" . ((!empty($fields["qualification"])) ? "'" . addslashes($fields["qualification"]) . "'" : "NULL") . "
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id)
	{
		$sql = "UPDATE " . self::TABLE . " 
			SET
			course = " . addslashes($fields["course"]) . ",
			employe = " . addslashes($fields["employe"]) . ",
			provider = '" . addslashes($fields["provider"]) . "',
			url = '" . addslashes($fields["url"]) . "',
			code = '" . addslashes($fields["code"]) . "',
			expiration_date = " . ((!empty($fields["expiration_date"])) ? "'" . addslashes($fields["expiration_date"]) . "'" : "NULL") . ",
			expedition_date = " . ((!empty($fields["expedition_date"])) ? "'" . addslashes($fields["expedition_date"]) . "'" : "NULL") . ",
			qualification = " . ((!empty($fields["qualification"])) ? "'" . addslashes($fields["qualification"]) . "'" : "NULL") . "
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}

	public function delete($id)
	{
		$sql = "DELETE FROM " . self::TABLE . " 
			WHERE id = {$id}";
		return $this->db->exec($sql);
	}
}
