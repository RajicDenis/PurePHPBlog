<?php include 'include/header.php'; ?>

<div class="container d-flex flex-column align-items-center">
	<?php if(isset($_SESSION['Error'])) : ?><div class="alert alert-danger mt-2"><?php echo $_SESSION['Error']; ?></div> <?php endif; ?>
	<?php unset($_SESSION['Error']); ?>

	<h2>Registration form</h2>
	<form class="w-50" action="../app/auth/register.php" method="POST">

		<div class="form-group">
		    <label for="username">Username</label>
		    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
		</div>

		<div class="form-group">
		    <label for="email">Email address</label>
		    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
		</div>

		<div class="form-group">
		    <label for="password">Password</label>
		    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
		</div>

		<button type="submit" name="submit" class="btn btn-primary">Register</button>

	</form>
</div>

<?php include 'include/footer.php'; ?>