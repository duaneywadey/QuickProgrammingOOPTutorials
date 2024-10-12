<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php';

echo "<h1>Delete Student Number " .  $_GET['student_id'] . "?</h1>";

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
			<h1>FirstName: <?php echo $getStudentByID['first_name']; ?></h1>
			<h1>LastName: <?php echo $getStudentByID['last_name']; ?></h1>
			<h1>YearLevel: <?php echo $getStudentByID['year_level']; ?></h1>
			<input type="submit" value="Delete" name="deleteStudentBtn">
		</div>
	</form>
</body>
</html>