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
			header('HTTP/1.1 401 Unauthorized');

			// Redirect unauthenticated user to landing page
			header('Refresh: 5; url=login.php');

			// Display some warning text
			echo '<p class="alert alert-danger">You do not have access to this page and will be redirected in 5 seconds</p>';
		} else {
			
	?>
		
		<div class="container m-5">
			<div class="card p-5">
				<h1>Create New Post</h1>
				<small>You can view previous posts <a href="index.php">here</a></small>
			</div>
			<div class="card p-2 mt-3">
				
				<?php

					$_SERVER['PHP_AUTH_PW'] = 'Test'; 
					echo $_SERVER['PHP_AUTH_PW'];
				?>
			</div>
		</div>
		
	<?php
		}

	?>
</body>
</html>