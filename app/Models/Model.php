<?php

namespace Model;

class Model{

	protected $db;
	public function __construct(){
		try{
			$this->db = new \PDO("mysql:host=".$_ENV["DATABASE_HOST"].";dbname=".$_ENV["DATABASE_DBNAME"]."", $_ENV["DATABASE_USER"], $_ENV["DATABASE_PASSWORD"]);	
		}catch(Exception $e){
			throw new Exception("bootstrap error", 101);
			  
		}
	}

}