<?php  require 'core/dbConfig.php';?>
<?php  require 'core/handleForms.php';?>

<form action="core/handleForms.php?student_id=<?php echo $_GET['student_id']; ?>" method="POST">
	<label for="question">Are you sure you want to delete student <?php echo $_GET['student_id'] ?></label>
	<input type="submit" name="deleteStudentBtn" value="Delete">
</form>