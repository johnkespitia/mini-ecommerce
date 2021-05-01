<?php

namespace Model;

class Model
{

	const CONTAIN = "like";
	const EQUAL = "=";
	const NOTEQUAL = "<>";
	const GT = ">";
	const GTE = ">=";
	const IN = "IN";
	const NOTIN = "NOT IN";
	const LT = "<";
	const LTE = "<=";
	const ISNULL = "is null";

	protected $db;

	public function __construct()
	{
		try {
			$this->db = new \PDO("mysql:host=" . $_ENV["DATABASE_HOST"] . ";dbname=" . $_ENV["DATABASE_DBNAME"] . ";charset=UTF8", $_ENV["DATABASE_USER"], $_ENV["DATABASE_PASSWORD"]);
		} catch (\Exception $e) {
			throw new \Exception("bootstrap error", 101);
		}
	}

	protected function where($where)
	{
		if (empty($where)) {
			return "";
		}
		$queryWhere = "";
		$and = "WHERE";
		foreach ($where as $validation) {
			if ($validation[1] == self::CONTAIN) {
				$queryWhere .= " {$and} {$validation[0]} " . self::CONTAIN . " '%" . addslashes($validation[2]) . "%'";
			} elseif ($validation[1] == self::ISNULL) {
				$queryWhere .= " {$and} {$validation[0]} {$validation[1]} ";
			} elseif ($validation[1] == self::IN || $validation[1] == self::NOTIN) {
				$queryWhere .= " {$and} {$validation[0]} " . addslashes(implode(",", $validation[1]));
			} else {
				$queryWhere .= " {$and} {$validation[0]} {$validation[1]} '" . addslashes($validation[2]) . "'";
			}
			if ($and == "WHERE") {
				$and = "AND";
			}
		}
		return $queryWhere;
	}

	public function getLastId()
	{
		return $this->db->lastInsertId();
	}

	public function getLastError()
	{
		return $this->db->errorInfo();
	}
}
