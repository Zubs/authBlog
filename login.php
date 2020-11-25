<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body class="p-5">
	
	<?php

		// See if user is authenticated already
		if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {

			// Set status code to 401
			header($_SERVER["SERVER_PROTOCOL"].' 401 Unauthorized');

			// Pop up the box for authentication
			header('WWW-Authenticate: Basic realm="authBlog1"');

			// Redirect to landing page
			header('Refresh: 5; url=index.php');

			// Render some warning text
			echo '<p class="alert alert-danger">You do not have access to this page and will be redirected in 5 seconds</p>';
		} else {

			// Get variables
			$username = $_SERVER['PHP_AUTH_USER'];
			$password = $_SERVER['PHP_AUTH_PW'];

			// Connect to database
			$conn = mysqli_connect('localhost', 'root', '', 'authBlog1') or die("Unable to connect to db");

			// Fetch posts from database
			$query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";

			// Run the query to actually get the data
			$data = mysqli_query($conn, $query) or die("Unable to fetch posts");

			// Fetch the row
			$row = mysqli_fetch_row($data);
			
			// If the user exists
			if ($row) {
				
				// See if passwords match
				if (password_verify($password, $row[2])) {
					
					// Redirect to create page
					header('Location: create.php');
				} else {

					// Set status code to 401
					header($_SERVER["SERVER_PROTOCOL"].' 401 Unauthorized');

					// Pop up the box for authentication
					header('WWW-Authenticate: Basic realm="authBlog1"');

					// Redirect to landing page
					header('Refresh: 5; url=index.php');

					// Render some warning text
					echo '<p class="alert alert-danger">You do not have access to this page and will be redirected in 5 seconds</p>';
				}
			} else {

				// Set status code to 401
				header($_SERVER["SERVER_PROTOCOL"].' 401 Unauthorized');

				// Pop up the box for authentication
				header('WWW-Authenticate: Basic realm="authBlog1"');

				// Redirect to landing page
				header('Refresh: 5; url=index.php');

				// Render some warning text
				echo '<p class="alert alert-danger">You do not have access to this page and will be redirected in 5 seconds</p>';
			}
		}
	?>
</body>
</html>
