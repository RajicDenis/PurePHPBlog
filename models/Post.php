<?php

class Post {

	// DB property
	private $conn;

	// Table properties
	public $title;
	public $body;
	public $author;
	public $category_id;
	public $user_id;
	public $created_at;

	// Connect to the database
	public function __construct($db) {

		$this->conn = $db;
	}

	public function getAllPosts($userId = null) { 

		if(isset($userId)) {

			$sql = 'SELECT * FROM posts p LEFT JOIN categories c ON p.category_id = c.id WHERE p.user_id = :userId';

			$stmt = $this->conn->prepare($sql);

			$stmt->bindValue(':userId', $userId);

		} else {

			$sql = 'SELECT * FROM posts p LEFT JOIN categories c ON p.category_id = c.id';

			$stmt = $this->conn->prepare($sql);
		}

		$stmt->execute();

		return $stmt;

	}

	public function paginateAllPosts($offset, $postsPerPage, $userId = null) {

		if(isset($userId)) {

			$sql = 'SELECT * FROM posts p LEFT JOIN categories c ON p.category_id = c.id WHERE p.user_id = :userId LIMIT :offset, :postsPerPage';

		} else {

			$sql = 'SELECT * FROM posts p LEFT JOIN categories c ON p.category_id = c.id LIMIT :offset, :postsPerPage';
		}

		$stmt = $this->conn->prepare($sql);

		if(isset($userId)) { 
			$stmt->bindValue(':userId', $userId); 
		}

		$stmt->bindValue(':offset', $offset);
		$stmt->bindValue(':postsPerPage', $postsPerPage);

		$stmt->execute();

		return $stmt;
	}

	public function addPost() {

		$sql = 'INSERT INTO posts (title, body, category_id, author, user_id, created_at) VALUES (:title, :body, :category_id, :author, :user_id, :created_at)';

		$stmt = $this->conn->prepare($sql);

		$stmt->bindValue(':title', $this->title);
		$stmt->bindValue(':body', $this->body);
		$stmt->bindValue(':category_id', $this->category_id);
		$stmt->bindValue(':author', $this->author);
		$stmt->bindValue(':user_id', $this->user_id);
		$stmt->bindValue(':created_at', $this->created_at);

		$stmt->execute();

		return $stmt;

	}

}