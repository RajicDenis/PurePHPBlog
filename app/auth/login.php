<?php
session_start();
unset($_SESSION['Error_login']);

require_once '../../config/Database.php';
require_once '../../models/User.php';

if (isset($_POST['submit'])) {

	if(isset($_POST['email']) && isset($_POST['password'])) {

		// Prepare data for validation
		$email = filter_var(htmlentities($_POST['email']), FILTER_SANITIZE_EMAIL);
		$filter = filter_var($email, FILTER_VALIDATE_EMAIL);

		if($filter != null) {

			if(strlen($_POST['password']) < 6) {
				// Send error if password is to short
				User::getLoginError('Password needs to be at least 6 characters!');

			} else {
				// Connect to DB
				$database = new Database;
				$db = $database->connect();

				$user = new User($db);

				// If everything is correct, check for user in db
				if($user->verifyUser($email, $_POST['password'])) {

					// If user is found
					$_SESSION['user_id'] = $user->getUserData($email, true);
					$_SESSION['username'] = $user->getUserData($email);
					$_SESSION['email'] = $email;
					header('Location: /');

				} else {
					// Send error user does not exist
					echo $password;
					//User::getLoginError('E-mail or password incorrect!');
				}

			}

		} else {
			// Send error if email is incorrect
			User::getLoginError('E-mail address invalid!');
		}

	} else {
		// Send error if email and password are not entered
		User::getLoginError('Please enter your E-mail and password!');
	}

} else {

	// If someone tries accessing through the URL, instead of the form
	header("Location: /");
}