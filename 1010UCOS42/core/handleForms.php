<?php  
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertNewStudentBtn'])) {
	$firstName = $_POST['firstName']; 
	$lastName = $_POST['lastName']; 
	$gender = $_POST['gender']; 
	$yearLevel = $_POST['yearLevel']; 
	$section = $_POST['section']; 
	$adviser = $_POST['adviser']; 
	$religion = $_POST['religion']; 


	if (!empty($firstName) && !empty($lastName) && !empty($gender) && !empty($yearLevel) && !empty($section) && !empty($adviser) && !empty($religion)) {

		$query = insertIntoStudentRecords($pdo, $firstName, $lastName, $gender, $yearLevel, $section, $adviser, $religion);

		if ($query) {
			header("Location: ../index.php");
		}
		else {
			echo "Query failed";
		}
	}

	else {
		echo "Make sure no input fields are empty!";
	}

}

if (isset($_POST['editStudentBtn'])) {
	$firstName = $_POST['firstName']; 
	$lastName = $_POST['lastName']; 
	$gender = $_POST['gender']; 
	$yearLevel = $_POST['yearLevel']; 
	$section = $_POST['section']; 
	$adviser = $_POST['adviser']; 
	$religion = $_POST['religion']; 

	if (!empty($firstName) && !empty($lastName) && !empty($gender) && !empty($yearLevel) && !empty($section) && !empty($adviser) && !empty($religion)) {

		$query = updateAStudent($pdo, $_GET['student_id'], $firstName, $lastName, $gender, $yearLevel, $section, $adviser, $religion);

		if ($query) {
			header("Location: ../index.php");
		}
		
		else {
			echo "Query failed";
		}

	}

	else {
		echo "Make sure no input fields are empty before updating!";
	}

	

}

if (isset($_POST['deleteStudentBtn'])) {
	
	$query = deleteAStudent($pdo, $_GET['student_id']);
	
	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}

?>