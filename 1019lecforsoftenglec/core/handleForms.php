<?php  
require_once 'models.php';
require_once 'dbConfig.php';

if (isset($_POST['registerUserBtn'])) {

	$insertQuery = insertNewUser($pdo, $_POST['username'], sha1($_POST['password']));
	if ($insertQuery) {
		header("Location: ../login.php");
	}
	else {
		header("Location: ../register.php");
	}
}

if (isset($_POST['loginUserBtn'])) {
	$loginQuery = loginUser($pdo, $_POST['username'], sha1($_POST['password']));
	if ($loginQuery) {
		header("Location: ../index.php");
	}
	else {
		header("Location: ../login.php");
	} 
}


if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}


?>