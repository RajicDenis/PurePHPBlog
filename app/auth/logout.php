<?php

session_start();

require_once '../../config/Database.php';
require_once '../../models/User.php';

if(isset($_POST['logout'])) {

	session_unset();
	session_destroy();

	header('Location: /');
}