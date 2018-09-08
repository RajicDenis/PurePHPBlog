<?php include 'include/header.php'; ?>

<div class="container d-flex flex-column align-items-center">

	<?php if(isset($_SESSION['Register_success'])) : ?><div class="alert alert-success mt-2"><?php echo $_SESSION['Register_success']; ?></div> <?php endif; ?>
	<?php unset($_SESSION['Register_success']); ?>

	<?php if(isset($_SESSION['Error_login'])) : ?><div class="alert alert-danger mt-2"><?php echo $_SESSION['Error_login']; ?></div> <?php endif; ?>
	<?php unset($_SESSION['Error_login']); ?>

	<h2>Login form</h2>
	<form class="w-50" action="../app/auth/login.php" method="POST">

		<div class="form-group">
		    <label for="email">Email address</label>
		    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
		</div>

		<div class="form-group">
		    <label for="password">Password</label>
		    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
		</div>

		<button type="submit" name="submit" class="btn btn-primary">Login</button>

	</form>
</div>

<?php include 'include/footer.php'; ?>