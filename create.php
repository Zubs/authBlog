<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>authBlog 1 - Create Post</title>

	<!-- Import some style -->
	<link rel="stylesheet" href="css/index.css">
</head>
<body class="p-5">

	<?php

		// See if the user is authenticated
		if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {

			// Set status code to 401
			header($_SERVER["SERVER_PROTOCOL"].' 401 Unauthorized');

			// Redirect unauthenticated user to landing page
			header('Refresh: 5; url=login.php');

			// Display some warning text
			echo '<p class="alert alert-danger">You do not have access to this page and will be redirected in 5 seconds</p>';
		} else {

			// Confirm that form was submitted
			if (isset($_POST['submit'])) {
				
				// Store user inputs
				$title = $_POST['title'];
				$body = $_POST['body'];

				// Confirm that both variables aren't empty
				if (!empty($title) && !empty($body)) {
					
					// Connect To Database 
					$connection = mysqli_connect('localhost', 'root', '', 'authBlog1') or die("Unable to connect to db");

					// Write the MySQL query here
					$query = "INSERT INTO posts VALUES (0, '$body','$title', now())";

					// Run The Query
					$result = mysqli_query($connection, $query) or die("Unable To Add New Row");

					// Close connection
					mysqli_close($connection);

					// Send user to the login page
					header('Location: index.php');
				}
			}	
	?>
		
		<div class="container m-5">
			<div class="card p-5">
				<h1>Create New Post</h1>
				<small>You can view previous posts <a href="index.php">here</a></small>
			</div>
			<div class="card p-2 mt-3">		
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="m-3">
					<div class="form-group">
						<input type="text" class="form-control" name="title" placeholder="Enter Post Title..."></div>
					<div class="form-group">
						<textarea name="body" class="form-control" placeholder="Enter Post Content..."></textarea>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-block" name="submit" value="POST">
					</div>
				</form>
			</div>
		</div>
		
	<?php
		}

	?>
</body>
</html>