<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this project?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Project Name: SoftEngIvan</h2>
		<h2>Technologies Used: Ivan</h2>
		<h2>Project Owner: Duane</h2>
		<h2>Date Added: PHP</h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php" method="POST">
				<input type="submit" name="deleteProjectBtn" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>

