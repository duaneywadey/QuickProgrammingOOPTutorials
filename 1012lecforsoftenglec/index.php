<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Welcome To Web Dev Projects Management System. Add new Web Devs!</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstName">Username</label> 
			<input type="text" name="username">
		</p>
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName">
		</p>
		<p>
			<label for="firstName">Last Name</label> 
			<input type="text" name="lastName">
		</p>
		<p>
			<label for="firstName">Date of Birth</label> 
			<input type="date" name="dateOfBirth">
		</p>
		<p>
			<label for="firstName">Specialization</label> 
			<input type="text" name="specialization">
			<input type="submit" name="insertWebDevBtn">
		</p>
	</form>
	<?php $getAllWebDevs = getAllWebDevs($pdo); ?>
	<?php foreach ($getAllWebDevs as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 350px; margin-top: 20px;">
		<h2>Username: <?php echo $row['username']; ?></h2>
		<h2>FirstName: <?php echo $row['first_name']; ?></h2>
		<h2>LastName: <?php echo $row['last_name']; ?></h2>
		<h2>Date Of Birth: <?php echo $row['date_of_birth']; ?></h2>
		<h2>Specialization: <?php echo $row['specialization']; ?></h2>
		<h2>Date Added: <?php echo $row['date_added']; ?></h2>
		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewprojects.php?web_dev_id=<?php echo $row['web_dev_id']; ?>">View Projects</a>
			<a href="editwebdev.php?web_dev_id=<?php echo $row['web_dev_id']; ?>">Edit</a>
			<a href="deletewebdev.php?web_dev_id=<?php echo $row['web_dev_id']; ?>">Delete</a>
		</div>
	</div> 
	<?php } ?>
</body>
</html>