<?php include '../include/header.php'; ?>

<?php

require_once APPROOT . '/config/Database.php';
require_once APPROOT . '/models/Post.php';

$database = new Database;
$db = $database->connect();

$user = new Post($db);

$result = $user->getAllPosts();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);

$num = count($posts); 

?>

<h1 class="text-center mb-5">All Blog Posts</h1>

<?php if($num > 0): ?>
	
	<?php foreach($posts as $post): ?>
		
		<div class="blog-post mb-4">
			<h4 class="blog-title"><?php echo $post['title']; ?></h4>
			<p class="blog-text"><?php echo ((strlen($post['body']) > 500) ? substr($post['body'], 0, 500).'...' : $post['body']) ?></p>
			<a class="btn btn-primary" href="#">Read more</a>
		</div>

		<hr>

	<?php endforeach; ?>


<?php else: ?>

	<h2 class="text-center">There are no blog posts yet!</h2>

<?php endif; ?>


<?php include '../include/footer.php'; ?>