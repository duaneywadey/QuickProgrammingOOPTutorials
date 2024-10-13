<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this user?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Username: SoftEngIvan</h2>
		<h2>FirstName: Ivan</h2>
		<h2>LastName: Duane</h2>
		<h2>Date Of Birth: August 5, 2005</h2>
		<h2>Specialization: PHP</h2>
		<h2>Date Added: PHP</h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?web_dev_id=<?php echo $_GET['web_dev_id']; ?>" method="POST">
				<input type="submit" name="deleteWebDevBtn" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>

