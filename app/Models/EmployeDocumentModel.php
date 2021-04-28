<?php

namespace Model;

class EmployeDocumentModel extends Model
{

	const TABLE = "employe_documents";

	public function all()
	{
		$sql = 'SELECT d.* , dt.name document_name
				FROM ' . self::TABLE . ' d
				INNER JOIN employe_document_types dt ON dt.id = d.document_type
				ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
			yield $row;
		}
	}

	public function findBy($where, $singleRow = false)
	{
		$sql = 'SELECT d.* , dt.name document_name, c.dni employe_dni, c.name employe_name
		FROM ' . self::TABLE . ' d
		INNER JOIN employe_document_types dt ON dt.id = d.document_type
		INNER JOIN employees c ON c.id = d.employe
		' . $this->where($where) . ' ORDER BY id desc';
		foreach ($this->db->query($sql) as $row) {
			if ($singleRow)
				return $row;
			else
				yield $row;
		}
	}

	public function find($id)
	{
		$sql = 'SELECT d.* , dt.name document_name
		FROM ' . self::TABLE . ' d
		INNER JOIN employe_document_types dt ON dt.id = d.document_type
		WHERE id=' . $id . ' ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
			return $row;
		}
	}
	public function create($fields)
	{
		$sql = "INSERT INTO " . self::TABLE . " (document_type, employe, provider, url, code, date_created, expiration_date, expedition_date) value (
			" . addslashes($fields["document_type"]) . ",
			" . addslashes($fields["employe"]) . ",
			'" . addslashes($fields["provider"]) . "',
			'" . addslashes($fields["url"]) . "',
			'" . addslashes($fields["code"]) . "',
			'" . addslashes($fields["date_created"]) . "',
			" . ((!empty($fields["date_expiration"])) ? "'" . addslashes($fields["date_expiration"]) . "'" : "NULL") . ",
			" . ((!empty($fields["date_expedition"])) ? "'" . addslashes($fields["date_expedition"]) . "'" : "NULL") . "
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id)
	{
		$sql = "UPDATE " . self::TABLE . " 
			SET
			document_type = " . addslashes($fields["document_type"]) . ",
			employe = " . addslashes($fields["employe"]) . ",
			provider = '" . addslashes($fields["provider"]) . "',
			url = '" . addslashes($fields["url"]) . "',
			code = '" . addslashes($fields["code"]) . "',
			date_expiration = " . ((!empty($fields["date_expiration"])) ? "'" . addslashes($fields["date_expiration"]) . "'" : "NULL") . ",
			date_expedition = " . ((!empty($fields["date_expedition"])) ? "'" . addslashes($fields["date_expedition"]) . "'" : "NULL") . "
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
