<?php include 'include/header.php'; ?>


<div class="container">

	<div class="jumbotron mt-5 d-flex flex-column align-items-center">
		<h1 class="display-4">Welcome <?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; } else { echo 'Guest!'; } ?></h1>
		<p class="lead">This is a simple blog!</p>
		<hr class="my-4">
		<p>To post your own posts please register or login if you already have an account!</p>
		<p class="lead">
	    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
		</p>
	</div>
</div>	


<?php include 'include/footer.php'; ?>

