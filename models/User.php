<?php

class User {

	// DB property
	private $conn;

	// Table properties
	public $username;
	public $email;
	public $password;

	// Connect to the database
	public function __construct($db) {

		$this->conn = $db;
	}

	// Check if user is in the database and if the passwords match
	public function verifyUser($email, $password) {

		$sql = 'SELECT password FROM users WHERE email = :email';

		$stmt = $this->conn->prepare($sql);

		$stmt->bindValue('email', $email);

		$stmt->execute();

		$DBpassword = $stmt->fetchColumn();

		if(password_verify($password, $DBpassword)) {
			if(password_needs_rehash($DBpassword, PASSWORD_DEFAULT)) {
				$newHash = password_hash($password, PASSWORD_DEFAULT);

				$updateSql = 'UPDATE users SET password = :password WHERE email = :email';
				$updateStmt = $this->conn->prepare($updateSql);

				$stmt->bindValue('email', $email);

				$stmt->execute();

			}

			return true;
		}

		return false;

	}

	// Check if email user has provided for registration already exists
	public function checkIfMailExists($email) {

		$sql = 'SELECT * FROM users WHERE email = :email';

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':email', $email);

		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if(count($result) > 0) {
			return true;
		}

		return false;

	}

	public static function getRegisterError($message, $path = '/views/register.php') {

		$_SESSION['Error'] = $message;
		header('Location: '. $path);

	}

	public static function getLoginError($message, $path = '/views/login.php') {

		$_SESSION['Error_login'] = $message;
		header('Location: '. $path);

	}

	// Get username of the user
	public function getUserData($email, $id = false) {

		$sql = 'SELECT * FROM users WHERE email = :email';

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':email', $email);

		$stmt->execute();

		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if($id) {
			return $result['id'];
		}
		
		return $result['username'];

	}


}