<?php

class Post {

	// DB property
	private $conn;

	// Table properties
	public $title;
	public $body;
	public $author;
	public $category_id;

	// Connect to the database
	public function __construct($db) {

		$this->conn = $db;
	}

	public function getAllPosts() {

		$sql = 'SELECT * FROM posts p LEFT JOIN categories c ON p.category_id = c.id';

		$stmt = $this->conn->prepare($sql);

		$stmt->execute();

		return $stmt;

	}

	public function paginateAllPosts($offset, $postsPerPage) {

		$sql = 'SELECT * FROM posts p LEFT JOIN categories c ON p.category_id = c.id LIMIT :offset, :postsPerPage';

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':offset', $offset);
		$stmt->bindValue(':postsPerPage', $postsPerPage);

		$stmt->execute();

		return $stmt;
	}

}