<?php include '../include/header.php'; ?>

<?php

require_once APPROOT . '/config/Database.php';
require_once APPROOT . '/models/Post.php';

$database = new Database;
$db = $database->connect();

$post = new Post($db);

$result = $post->getAllPosts();
$rowCount = $result->rowCount();

// Pagination
(isset($_GET['pageNbr']) ? $pageNbr = $_GET['pageNbr'] : $pageNbr = 1);

// Set number of posts per page
$postsPerPage = 5;
$offset = ($pageNbr - 1) * $postsPerPage;
$total_pages = ceil($rowCount / $postsPerPage);

$paginatePosts = $post->paginateAllPosts($offset, $postsPerPage);
$allPosts = $paginatePosts->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="d-flex">
	<h1 class="text-center w-100 mb-5 mt-4">All Blog Posts</h1>

	<?php if(isset($_SESSION['username'])): ?>
	<a href="addPost.php" class="add-blog-btn btn btn-success">Add</a>
	<?php endif; ?>
</div>


<?php if($rowCount > 0): ?>
	
	<?php foreach($allPosts as $post): ?>
		
		<div class="blog-post mb-4">
			<h4 class="blog-title"><?php echo $post['title']; ?></h4>
			<p class="blog-text"><?php echo ((strlen($post['body']) > 500) ? substr($post['body'], 0, 500).'...' : $post['body']) ?></p>
			<a class="btn btn-primary" href="#">Read more</a>
		</div>

		<hr>

	<?php endforeach; ?>

	<!-- Pagination -->
	<nav aria-label="Page navigation">
    	<ul class="pagination justify-content-center mt-4">
    		<li class="page-item <?php if($pageNbr <= 1) { echo "disabled"; } ?>" ><a class="page-link" href="<?php if($pageNbr > 1) { echo "?pageNbr=1"; } else { echo "#"; } ?>">First</a></li>
		    <li class="page-item <?php if($pageNbr <= 1) { echo "disabled"; } ?>" ><a class="page-link" href="<?php if($pageNbr > 1) { echo "?pageNbr=". ($pageNbr - 1); } else { echo "#"; } ?>">Previous</a></li>
		    <li class="page-item"><a class="page-link" href="<?php echo '?pageNbr='.$pageNbr ?>"><?php echo $pageNbr ?></a></li>
		    <li class="page-item <?php if($pageNbr == $total_pages) { echo "disabled"; } ?>" ><a class="page-link" href="<?php if($pageNbr < $total_pages) { echo "?pageNbr=". ($pageNbr + 1); } else { echo "#"; } ?>">Next</a></li>
		    <li class="page-item <?php if($pageNbr == $total_pages) { echo "disabled"; } ?>" ><a class="page-link" href="<?php if($pageNbr < $total_pages) { echo "?pageNbr=". $total_pages; } else { echo "#"; } ?>">Last</a></li>
  		</ul>
	</nav>


<?php else: ?>

	<h2 class="text-center">There are no blog posts yet!</h2>

<?php endif; ?>


<?php include '../include/footer.php'; ?>