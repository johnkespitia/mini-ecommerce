<?php

namespace Model;

class TrailerDocumentModel extends Model
{

	const TABLE = "trailer_document";

	public function all()
	{
		$sql = 'SELECT d.* , dt.name document_name
				FROM ' . self::TABLE . ' d
				INNER JOIN document_types dt ON dt.id = d.document_type
				ORDER BY d.id';
		foreach ($this->db->query($sql) as $row) {
			yield $row;
		}
	}

	public function findBy($where, $singleRow = false)
	{
		$sql = 'SELECT d.* , dt.name document_name, c.dni trailer_dni
		FROM ' . self::TABLE . ' d
		INNER JOIN document_types dt ON dt.id = d.document_type
		INNER JOIN trailer c ON c.id = d.trailer
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
		$sql = 'SELECT d.* , dt.name document_name
		FROM ' . self::TABLE . ' d
		INNER JOIN document_types dt ON dt.id = d.document_type
		WHERE d.id=' . $id . ' ORDER BY d.id';
		foreach ($this->db->query($sql) as $row) {
			return $row;
		}
	}
	public function create($fields)
	{
		$sql = "INSERT INTO " . self::TABLE . " (document_type, trailer, provider, url, code, date_created, date_expiration, date_expedition) value (
			" . addslashes($fields["document_type"]) . ",
			" . addslashes($fields["trailer"]) . ",
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
			trailer = " . addslashes($fields["trailer"]) . ",
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
