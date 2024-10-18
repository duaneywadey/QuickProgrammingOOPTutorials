<?php  
require_once 'models.php';
require_once 'dbConfig.php';

if (isset($_POST['registerUserBtn'])) {
	insertNewUser($pdo, $_POST['username'], sha1($_POST['password']));
	header("Location: ../index.php");
}

if (isset($_POST['loginUserBtn'])) {
	$loginQuery = loginAUser($pdo, $_POST['username'], sha1($_POST['password']));
	if ($loginQuery) {
		header("Location: ../index.php");
	}
	else {
		header("Location: ../login.php");
	} 
}


?>