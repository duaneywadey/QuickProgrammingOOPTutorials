<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Welcome To Web Dev Management System. Add new Web Devs!</h1>
	<form action="#" method="POST">
		<p>
			<label for="firstName">Username</label> 
			<input type="text" name="firstName">
		</p>
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName">
		</p>
		<p>
			<label for="firstName">Last Name</label> 
			<input type="text" name="firstName">
		</p>
		<p>
			<label for="firstName">Date of Birth</label> 
			<input type="text" name="firstName">
		</p>
		<p>
			<label for="firstName">Specialization</label> 
			<input type="text" name="firstName">
			<input type="submit" name="insertNewWebDevBtn">
		</p>
	</form>
	<div class="container" style="border-style: solid; width: 50%; height: 350px; margin-top: 20px;">
		<h2>Username: SoftEngIvan</h2>
		<h2>FirstName: Ivan</h2>
		<h2>LastName: Duane</h2>
		<h2>Date Of Birth: August 5, 2005</h2>
		<h2>Specialization: PHP</h2>
		<h2>Date Added: PHP</h2>
		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewprojects.php">View</a>
			<a href="editwebdev.php">Edit</a>
			<a href="deletewebdev.php">Delete</a>
		</div>
	</div> 
</body>
</html>