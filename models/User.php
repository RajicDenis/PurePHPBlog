<?php

class User {

	// DB property
	private $conn;

	// Table properties
	public $username;
	public $email;
	public $password;

	public function __construct($db) {

		$this->conn = $db;
	}

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

	public function getUsername($email) {

		$sql = 'SELECT * FROM users WHERE email = :email';

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':email', $email);

		$stmt->execute();

		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		return $result['username'];

	}

	public static function getRegisterError($message, $path = '/views/register.php') {

		$_SESSION['Error'] = $message;
		header('Location: '. $path);

	}

	public static function getLoginError($message, $path = '/views/login.php') {

		$_SESSION['Error_login'] = $message;
		header('Location: '. $path);

	}


}