<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php $getStudentByID = getStudentByID($pdo, $_GET['student_id']); ?>
	<form action="core/handleForms.php?student_id=<?php echo $_GET['student_id']; ?>" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName" value="<?php echo $getStudentByID['first_name']; ?>">
		</p>
		<p>
			<label for="lastName">Last Name</label>
			<input type="text" name="lastName" value="<?php echo $getStudentByID['last_name']; ?>">
		</p>
		<p>
			<label for="gender">Gender</label>
			<input type="text" name="gender" value="<?php echo $getStudentByID['gender']; ?>">
		</p>
		<p>
			<label for="yearLevel">Year Level</label>
			<input type="text" name="yearLevel" value="<?php echo $getStudentByID['year_level']; ?>">
		</p>
		<p>
			<label for="section">Section</label> 
			<input type="text" name="section" value="<?php echo $getStudentByID['section']; ?>">
		</p>
		<p>
			<label for="adviser">Adviser</label> 
			<input type="text" name="adviser" value="<?php echo $getStudentByID['adviser']; ?>">
		</p>
		<p>
			<label for="religion">Religion</label>
			<input type="text" name="religion" value="<?php echo $getStudentByID['religion']; ?>">
			<input type="submit" name="editStudentBtn">
		</p>
	</form>
</body>
</html>