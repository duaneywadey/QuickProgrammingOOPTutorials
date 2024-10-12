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

	$executeQuery = insertIntoStudentRecords($pdo, $firstName, $lastName, $gender, $yearLevel, $section, $adviser, $religion);

	if ($executeQuery) {
		header("Location: ../index.php");
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

	$executeQuery = updateAStudent($pdo, $_GET['student_id'], $firstName, $lastName, $gender, $yearLevel, $section, $adviser, $religion);

	if ($executeQuery) {
		header("Location: ../index.php");
	}	
}

if (isset($_POST['deleteStudentBtn'])) {
	$executeQuery = deleteAStudent($pdo, $_GET['student_id']);
	if ($executeQuery) {
		header("Location: ../index.php");
	}
}

?>