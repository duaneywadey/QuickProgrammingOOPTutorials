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

	$query = insertIntoStudentRecords($pdo, $firstName, $lastName, 
		$gender, $yearLevel, $section, $adviser, $religion);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Query failed";
	}

}

?>





