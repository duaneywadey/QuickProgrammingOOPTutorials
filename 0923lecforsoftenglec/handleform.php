<?php  

if (isset($_POST['submitBtn'])) {
	
	echo "<pre>";
	print_r($_POST);
	echo "<pre>";

	$username = $_POST['username'];
	$gpa = $_POST['gpa'];
	$location = $_POST['location'];
	$numOfClasses = $_POST['numOfClasses'];
	$faveSubject = $_POST['faveSubject'];

	if ($gpa == 5.00) {
		echo "STATUS: FAILED";
	}
	else {
		echo "YOU PASSED!";
	}
}

?>