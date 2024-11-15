<?php  
require_once 'dbConfig.php';
require_once 'models.php';


if (isset($_POST['insertUserBtn'])) {
	$insertUser = insertNewUser($pdo,$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['gender'], $_POST['address'], $_POST['state'], $_POST['nationality'], $_POST['car_brand']);

	if ($insertUser) {
		$_SESSION['message'] = "Successfully inserted!";
		header("Location: ../index.php");
	}
}


if (isset($_POST['editUserBtn'])) {
	$editUser = editUser($pdo,$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['gender'], $_POST['address'], $_POST['state'], $_POST['nationality'], $_POST['car_brand'], $_GET['id']);

	if ($editUser) {
		$_SESSION['message'] = "Successfully edited!";
		header("Location: ../index.php");
	}
}

if (isset($_POST['deleteUserBtn'])) {
	$deleteUser = deleteUser($pdo,$_GET['id']);

	if ($deleteUser) {
		$_SESSION['message'] = "Successfully deleted!";
		header("Location: ../index.php");
	}
}
?>