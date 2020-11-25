<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>authBlog 1 - Create Account</title>

	<!-- Import some style -->
	<link rel="stylesheet" href="css/index.css">
</head>
<body class="p-5">
	<?php

		// Confirm that form was submitted
		if (isset($_POST['create'])) {
			
			// Store user inputs
			$username = $_POST['username'];
			$password = $_POST['password'];

			// Confirm that both variables aren't empty
			if (!empty($username) && !empty($password)) {
				
				// Connect To Database 
				$connection = mysqli_connect('localhost', 'root', '', 'authBlog1') or die("Unable to connect to db");

				// Encrypt password for added security
				$password = password_hash($password, PASSWORD_DEFAULT);

				// Write the MySQL query here
				$query = "INSERT INTO users VALUES (0, '$username', '$password')";

				// Run The Query
				$result = mysqli_query($connection, $query) or die("Unable To Add New Row");

				// Close connection
				mysqli_close($connection);

				// Send user to the login page
				header('Location: login.php');
			}
		}	

	?>
	<div class="container m-5">
		<div class="card p-5">
			<h1>Create Account</h1>
		</div>
		<div class="row my-3">
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="col-md-12">
				<div class="row">
					<div class="form-group col-md-6">
						<input type="text" class="form-control" name="username" placeholder="Username..." required>
					</div>
					<div class="form-group col-md-6">
						<input type="password" class="form-control" name="password" placeholder="Password..." required>
					</div>
					<div class="form-group col-md-12">
						<input class="btn btn-primary btn-block" name="create" value="Create Account" type="submit">
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>