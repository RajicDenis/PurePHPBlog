<?php

class Database {

	//DB properties
	private $dbhost = 'localhost';
	private $dbuser = 'root';
	private $dbpass = '';
	private $dbname = 'posts';

	public $dbh;

	public function connect() {

		$dsn = 'mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname .'';
		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

		try {

			$this->dbh = new PDO($dsn, $this->dbuser, $this->dbpass, $options);

			return $this->dbh;

		} catch(PDOException $e) {

			echo $e->getMessage();

		}
		

	}
}