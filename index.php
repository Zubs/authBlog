<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>authBlog 1</title>

	<!-- Import some style -->
	<link rel="stylesheet" href="css/index.css">
</head>
<body class="p-5">
	<div class="container m-5">
		<div class="card p-5">
			<h1>All Posts</h1>
			<small>You can add new posts <a href="create.php">here</a></small>
			<?php echo $_SERVER['PHP_AUTH_PW']; ?>
		</div>
		<div class="row">

			<!-- Let's handle logic -->
			<?php

				// Connect to database
				$conn = mysqli_connect('localhost', 'root', '', 'authBlog1') or die("Unable to connect to db");

				// Fetch posts from database
				$query = "SELECT * FROM posts ORDER BY date_ DESC";

				// Run the query to actually get the data
				$data = mysqli_query($conn, $query) or die("Unable to fetch posts");

				// Display posts, by looping over them
				while ($row = mysqli_fetch_array($data)) {
			?>

				<!-- I decided to write normal HTML instead of using too many echos -->
				<div class="col-md-6 p-3">
					<div class="card p-2">
						<div class="card-body">
							<h3><?php echo $row['title']; ?></h3>
							<p><?php echo $row['body']; ?></p>
						</div>
					</div>
				</div>
			<?php
				}

				// Close connection
				mysqli_close($conn);

			?>
		</div>
	</div>
</body>
</html>