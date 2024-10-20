<?php  

require_once 'dbConfig.php';
require_once 'models.php';


if (isset($_POST['editUserBtn'])) {
	$editUser = editUser($pdo,$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['gender'], $_POST['address'], $_POST['state'], $_POST['nationality'], $_POST['car_brand'], $_GET['id']);

	if ($editUser) {
		header("Location: ../index.php");
	}
}

if (isset($_POST['deleteUserBtn'])) {
	$deleteUser = deleteUser($pdo,$_GET['id']);

	if ($deleteUser) {
		header("Location: ../index.php");
	}
}

?>