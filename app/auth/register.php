<?php
session_start();
unset($_SESSION['Error']);

require_once '../../config/Database.php';
require_once '../../models/User.php';

if (isset($_POST['submit'])) {
	if($_POST['username'] != '' && $_POST['email'] != '' && $_POST['password'] != '') {

		// Get form input
		$username = htmlentities($_POST['username']);
		$email = htmlentities($_POST['email']);
		$password = htmlentities($_POST['password']);

		// Create array of inputed data to pass to filter
		$data = [
			'username' => filter_var($username, FILTER_SANITIZE_STRING),
			'email' => filter_var($email, FILTER_SANITIZE_EMAIL);
		];

		// Validate data
		$filters = [
			'username' => array(
				'filter' => FILTER_CALLBACK,
				'options' => 'ucwords'
			),
			'email' => FILTER_VALIDATE_EMAIL,
		];

		$filtered = filter_var_array($data, $filters);

		if($filtered['username'] != '' && $filtered['email'] != '') {

			if(empty($password)) {

				User::getRegisterError('Please enter a password!');

			} elseif(strlen($password) < 6) {

				User::getRegisterError('Your password needs to be at least 6 characters long!');

			} else {
				// If everything is valid
				$password = password_hash($password, PASSWORD_DEFAULT);

				$database = new Database;
				$db = $database->connect();

				$user = new User($db);

				if($user->checkIfMailExists($email) == false) {

					$sql = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';

					$stmt = $db->prepare($sql);
					$stmt->bindValue(':username', $username);
					$stmt->bindValue(':email', $email);
					$stmt->bindValue(':password', $password);

					if($stmt->execute()) {

						$_SESSION['Register_success'] = 'You have successfully registered! You can now log in!';
						header('Location: /views/login.php');

					} else {

						User::getRegisterError($stmt->errInfo[2]);
					}

				} else {

					User::getRegisterError('Email already exists!');
				}
				
			}

		} else {
			
			// If filter returns empty string - something is wrong with the data
			User::getRegisterError('Username or email invalid');			
		}

	} else {

		// If at least one of the input fields is empty
		User::getRegisterError('Please enter all necessary data!');
	}

} else {
	// If someone tries accessing through the URL, instead of the form
	header('Location: /');
}

?>



