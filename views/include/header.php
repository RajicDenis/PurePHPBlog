<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SimpleAuth</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	
	<div class="container">
	    <a class="navbar-brand" href="/">BlogPost</a>

	    <div class="collapse navbar-collapse justify-content-end" id="navbarText">
		    <ul class="nav justify-content-end">

		    	<?php if(!isset($_SESSION['username'])): ?>

				<li class="nav-item">
					<form action="/views/register.php" method="POST">
						<button type="submit" class="btn btn-default mr-2">Register</button>
					</form>
				</li>
			  	<li class="nav-item">
			    	<form action="/views/login.php" method="POST">
						<button type="submit" class="btn btn-default">Login</button>
					</form>
			  	</li>

			  	<?php else: ?>

			  	<li class="nav-item">
			    	<form action="/app/auth/logout.php" method="POST">
						<button type="submit" name="logout" class="btn btn-default">Logout</button>
					</form>
			  	</li>
			  	
			  	<?php endif; ?>	

			</ul>
	    </div>

	</div>
	
</nav>
