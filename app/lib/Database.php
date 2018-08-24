<?php

class Database{
	private $host = DB_HOST;
	private $user = DB_USER;
	private $password = DB_PASSWORD;
	private $dbname = DB_NAME;

	private $dbhandler;
	private $statement;
	private $error;

	public function __construct(){
		$dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

		try{
			$this->dbhandler = new PDO($dsn, $this->user, $this->password, $options);
		} catch(PDOException $e){
			$this->error = $e->getMessage();
			echo $this->error;
		}
	}

	public function query($sql){
		$this->statement = $this->dbhandler->prepare($sql);
	}

	public function bind($param, $value, $type = null){
		if (is_null($type)) {
			switch(true){
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}

		$this->statement->bindValue($param, $value, $type);
	}

	public function execute(){
		return $this->statement->execute();
	}

	public function resultSet(){
		$this->execute();
		return $this->statement->fetchAll(PDO::FETCH_OBJ);
	}

	public function single(){
		$this->execute();
		return $this->statement->fetch(PDO::FETCH_OBJ);
	}

	public function rowCount(){
		return $this->statement->rowCount();
	}
}