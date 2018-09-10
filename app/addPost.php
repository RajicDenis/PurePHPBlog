<?php

session_start();
unset($_SESSION['Added_post']);
unset($_SESSION['Error_add']);

require_once '../config/Database.php';
require_once '../models/Post.php';

if (isset($_POST['addPost'])) {

	$title = htmlentities($_POST['title']);
	$body = htmlentities($_POST['body']);
	// Category_id hardcoded for now
	$category_id = 1;
	$author = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];

	$database = new Database;
	$db = $database->connect();

	$post = new Post($db);

	$post->title = $title;
	$post->body = $body;
	$post->category_id = $category_id;
	$post->author = $author;
	$post->user_id = $user_id;
	$post->created_at = date('Y-m-d H-i-s');

	if($post->addPost()) {
		$_SESSION['Added_post'] = 'Post successfully added!';
		header('Location: /views/pages/allPosts.php');
	} else {
		$_SESSION['Error_add'] = $post->addPost()->errorInfo();
		header('Location: /views/pages/allPosts.php');
	}


} else {

	header('Location: /');
}