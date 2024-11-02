<?php  
require_once 'models.php';
require_once 'dbConfig.php';
require_once 'validate.php';

$alert = array();

if (isset($_POST['registerUserBtn'])) {

	$username = sanitizeInput($_POST['username']);
	$first_name = sanitizeInput($_POST['first_name']);
	$last_name = sanitizeInput($_POST['last_name']);
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	if (!empty($username) && !empty($first_name) && !empty($last_name) && !empty($password) && !empty($confirm_password)) {

		if ($password == $confirm_password) {

			$insertQuery = insertNewUser($pdo, $username, $first_name, 
				$last_name, password_hash($_POST['password'], PASSWORD_DEFAULT));

			if ($insertQuery['status'] == '200') {
				$_SESSION['status'] = $insertQuery['status'];
				$_SESSION['message'] = $insertQuery['message'];
				header("Location: ../login.php");
			}

			else {
				$_SESSION['status'] = $insertQuery['status'];
				$_SESSION['message'] = $insertQuery['message'];
				header("Location: ../register.php");
			}

		}

		else {
			$_SESSION['message'] = "Please make sure that both passwords are equal";
			header("Location: ../register.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure that all input fields are not empty!";
		header("Location: ../register.php");
	}
}


if (isset($_POST['loginUserBtn'])) {

	$username = sanitizeInput($_POST['username']);
	$password = $_POST['password'];

	if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);
		$userIDFromDB = $loginQuery['user_id']; 
		$usernameFromDB = $loginQuery['username']; 
		$passwordFromDB = $loginQuery['password'];

		if ($loginQuery) {

			if (password_verify($password, $passwordFromDB)) {
				$_SESSION['message'] = "Login Successful!";
				$_SESSION['status'] = "200";
				$_SESSION['username'] = $usernameFromDB;
				$_SESSION['user_id'] = $userIDFromDB;
				header("Location: ../index.php");
			}

			else {
				$_SESSION['message'] = "Invalid Credentials!";
				$_SESSION['status'] = "401";
				header("Location: ../login.php");
			}

		}
		else {
			$_SESSION['message'] = "Invalid Credentials!";
			$_SESSION['status'] = "401";
			header("Location: ../login.php");
		}
	
	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		$_SESSION['status'] = "401";
		header("Location: ../login.php");
	}
 
}

if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}

if (isset($_POST['insertNewPostBtn'])) {

	$title = sanitizeInput($_POST['title']);
	$body = sanitizeInput($_POST['body']);
	$userID = $_SESSION['user_id'];

	if (!empty($title) && !empty($body) && !empty($userID)) {

		$insertQuery = insertNewPost($pdo, $title, $body, $userID);

		if ($insertQuery) {
			header("Location: ../index.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure all input fields are not empty!";
		header("Location: ../index.php");
	}
}

if (isset($_POST['editPostBtn'])) {

	$title = sanitizeInput($_POST['title']);
	$body = sanitizeInput($_POST['body']);
	$user_post_id = $_GET['user_post_id'];

	if (!empty($title) && !empty($body)) {

		$editQuery = editAPost($pdo, $title, $body, $user_post_id);

		if ($editQuery) {
			header("Location: ../index.php");
		}
	
	}

	else {
		header("Location: ../index.php");
		$_SESSION['message'] = "Make sure input fields are not empty!";
	}
}

if (isset($_POST['deletePostBtn'])) {

	$user_post_id = $_GET['user_post_id'];
	$deleteQuery = deleteAPost($pdo, $user_post_id);

	if ($deleteQuery) {
		header("Location: ../index.php");
	}

}

?>
