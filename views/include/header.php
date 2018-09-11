<?php 

session_start();

// Define constants
define('APPROOT', dirname(dirname(dirname(__FILE__))));

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SimpleAuth</title>

	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/litera/bootstrap.css">

	<link rel="stylesheet" type="text/css" href="/public/css/main.css?version=1">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	
	<div class="container">
	    <a class="navbar-brand" href="/">BlogPost</a>

	    <div class="collapse navbar-collapse justify-content-between" id="navbarText">

			<ul class="nav site-links">
				<a href="/views/pages/allPosts.php"><li class="mr-3 ml-2">Posts</li></a>

				<?php if(isset($_SESSION['username'])): ?>
				<a href="/views/pages/allPosts.php?user=<?php echo $_SESSION['user_id'] ?>"><li class="mr-3">MyPosts</li></a>
				<?php endif; ?>

			</ul>	

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

<div class="container">
