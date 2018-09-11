<?php

session_start();

require_once '../config/Database.php';
require_once '../models/Post.php';

if(isset($_POST['pid'])) {

	$database = new Database;
	$db = $database->connect();

	$post = new Post($db);

	if($post->deletePost($_POST['pid'])) {

		$_SESSION['Del_post'] = 'Post successfully deleted!';
		header('Location: /views/pages/allPosts.php?user='. $_SESSION['user_id']);

	} else {

		print_r($post->deletePost($_POST['pid'])->errorInfo());
	}

} else {

	header('Location: /');
}

