<?php

session_start();

require_once APPROOT.'/config/Database.php';
require_once APPROOT.'/models/User.php';

if (isset($_POST['addPost'])) {

	$title = htmlentities($_POST['title']);
	$body = htmlentities($_POST['body']);
	// Category_id hardcoded for now
	$category_id = 1;
	$id = $_SESSION['user_id'];//ddddddddddddddddddddddddddddd


} else {

	header('Location: /')
}