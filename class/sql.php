<?php 

class Sql extends PDO {

	private $conn;
	private $drive = 'mysql';
	private $hostname = 'localhost';
	private $dbname = 'dbphp7';
	private $user = 'root';
	private $password = '';

	public function __construct() {

		$this->conn = new PDO("$this->drive:host=$this->hostname; dbname=$this->dbname", "$this->user", "$this->password");

	}

	public function setParams($statement, $parameters = array()) {

		foreach ($parameters as $key => $value) {
			
			$this->setParam($statement, $key, $value);

		}

	}

	public function setParam($statement, $key, $value) {

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array()) {

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;

	}

	public function select($rawQuery, $params = array()):array {

		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

}

?>