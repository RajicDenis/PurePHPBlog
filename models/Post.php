<?php

class Post {

	// DB property
	private $conn;

	// Table properties
	public $id;
	public $title;
	public $body;
	public $author;
	public $category_id;
	public $user_id;
	public $created_at;
	public $updated_at;

	// Connect to the database
	public function __construct($db) {

		$this->conn = $db;
	}

	public function getAllPosts($userId = null) { 

		if(isset($userId)) {

			$sql = 'SELECT 
					p.id, p.title, p.body, p.author, p.user_id as userId, p.category_id as categoryId, c.id as cat_id, c.name

					FROM posts p LEFT JOIN categories c ON p.category_id = c.id WHERE p.user_id = :userId';

			$stmt = $this->conn->prepare($sql);

			$stmt->bindValue(':userId', $userId);

		} else {

			$sql = 'SELECT 
					p.id, p.title, p.body, p.author, p.user_id as userId, p.category_id as categoryId, c.id as cat_id, c.name
					FROM posts p LEFT JOIN categories c ON p.category_id = c.id';

			$stmt = $this->conn->prepare($sql);
		}

		$stmt->execute();

		return $stmt;

	}

	public function paginateAllPosts($offset, $postsPerPage, $userId = null) {

		if(isset($userId)) {

			$sql = 'SELECT 
					p.id, p.title, p.body, p.author, p.user_id as userId, p.category_id, c.id as cat_id, c.name
					FROM posts p LEFT JOIN categories c ON p.category_id = c.id WHERE p.user_id = :userId LIMIT :offset, :postsPerPage';

		} else {

			$sql = 'SELECT 
					p.id, p.title, p.body, p.author, p.user_id as userId, p.category_id, c.id as cat_id, c.name
					FROM posts p LEFT JOIN categories c ON p.category_id = c.id LIMIT :offset, :postsPerPage';
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

	public function addPost($update = false) {

		if(!$update) {

			$sql = 'INSERT INTO posts (title, body, category_id, author, user_id, created_at) VALUES (:title, :body, :category_id, :author, :user_id, :created_at)';

		} else {

			$sql = 'UPDATE posts SET title = :title, body = :body, category_id = :category_id, author = :author, user_id = :user_id, updated_at = :updated_at WHERE id = :id';

		}
		

		$stmt = $this->conn->prepare($sql);

		$stmt->bindValue(':title', $this->title);
		$stmt->bindValue(':body', $this->body);
		$stmt->bindValue(':category_id', $this->category_id);
		$stmt->bindValue(':author', $this->author);
		$stmt->bindValue(':user_id', $this->user_id);

		if(!$update) {
			$stmt->bindValue(':created_at', $this->created_at);
		} else {
			$stmt->bindValue(':updated_at', $this->updated_at);
			$stmt->bindValue(':id', $this->id);
		}

		$stmt->execute();

		return $stmt;

	}

	public function readPost() {

		$sql = 'SELECT 
				p.id, p.title, p.body, p.author, p.user_id, p.category_id, u.id as userId, u.username, u.email
				FROM posts p LEFT JOIN users u ON p.user_id = u.id WHERE p.id = :pid';

		$stmt = $this->conn->prepare($sql);

		$stmt->bindValue(':pid', $this->id);

		$stmt->execute();

		return $stmt;

	}

	public function deletePost($id) {

		$sql = 'DELETE FROM posts WHERE id = :id';

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $id);

		$stmt->execute();

		return $stmt;

	}

}