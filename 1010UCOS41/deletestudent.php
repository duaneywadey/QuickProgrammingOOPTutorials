<?php  
require_once 'core/dbConfig.php';
require_once 'core/models.php';

$getStudentByID = getStudentByID($pdo, $_GET['student_id']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="core/handleForms.php?student_id=<?php echo $_GET['student_id']; ?>" method="POST">
		<div class="container" style="border-style: solid;">
			<h3>First Name: <?php echo $getStudentByID['first_name']; ?></h3>
			<h3>Last Name: <?php echo $getStudentByID['last_name']; ?></h3>
			<h3>Year Level: <?php echo $getStudentByID['year_level']; ?></h3>
			<h3>Section: <?php echo $getStudentByID['section']; ?></h3>
			<p>Are you sure you want to delete <?php echo $_GET['student_id']; ?></p>
			<input type="submit" name="deleteStudentBtn" value="Delete">
		</div>
	</form>
</body>
</html>