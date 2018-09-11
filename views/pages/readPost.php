<?php include '../include/header.php'; ?>

<?php

require_once APPROOT . '/config/Database.php';
require_once APPROOT . '/models/Post.php';

if(isset($_POST['pid'])) {

	$database = new Database;
	$db = $database->connect();

	$post = new Post($db);

	$post->id = $_POST['pid'];

	$result = $post->readPost();

	if($result) {

		$singlePost = $result->fetch(PDO::FETCH_ASSOC);

	} else {

		print_r($result->errorInfo());
	}

?>
	<div class="d-flex position-relative title-box align-items-center">
		
		<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $singlePost['user_id']): ?>
			<form id="delForm" action="/app/deletePost.php" method="POST">
				<input type="hidden" name="pid" value="<?php echo $singlePost['id']; ?>">
				<button class="icon-box add-blog-btn left" type="submit"><i class="fas fa-trash-alt"></i></button>
			</form>
		<?php endif; ?>

		<h2 class="text-center w-100 plr-80"><?php echo $singlePost['title']; ?></h2>

		<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $singlePost['user_id']): ?>
			<form action="editPost.php" method="POST">
				<input type="hidden" name="pid" value="<?php echo $singlePost['id']; ?>">
				<button class="add-blog-btn btn btn-warning" type="submit">Edit</button>
			</form>
		<?php endif; ?>

	</div>

	<hr>

	<p class="mh-200"><?php echo $singlePost['body']; ?></p>

	<hr>

	<p><strong>Author: </strong> <?php echo $singlePost['username']; ?></p>

<?php

} else {
	
	header('Location: /');

}

include '../include/footer.php'; 

?>