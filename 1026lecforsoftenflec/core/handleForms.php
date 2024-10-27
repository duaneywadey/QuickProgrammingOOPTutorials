<?php  
require_once 'models.php';
require_once 'dbConfig.php';
require_once 'validate.php';

if (isset($_POST['registerUserBtn'])) {

	$username = $_POST['username'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		if (sanitizeInput($username) && sanitizeInput($first_name) && sanitizeInput($last_name)) {

			$insertQuery = insertNewUser($pdo, $username, $first_name, $last_name, $password);

			if ($insertQuery) {
				header("Location: ../login.php");
			}
			else {
				header("Location: ../register.php");
			}
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for registration!";

		header("Location: ../login.php");
	}

}




if (isset($_POST['loginUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		if (sanitizeInput($username)) {

			$loginQuery = loginUser($pdo, $username, $password);

			if ($loginQuery) {
				header("Location: ../index.php");
			}
			
			else {
				header("Location: ../login.php");
			}
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		header("Location: ../login.php");
	}
 
}


if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}

if (isset($_POST['insertNewPostBtn'])) {

	$title = $_POST['title'];
	$body = $_POST['body'];
	$userID = $_SESSION['user_id'];

	$insertQuery = insertNewPost($pdo, $title, $body, $userID);

	if ($insertQuery) {
		header("Location: ../index.php");
	}

}

if (isset($_POST['editPostBtn'])) {

	$title = $_POST['title'];
	$body = $_POST['body'];
	$user_post_id = $_GET['user_post_id'];

	$editQuery = editAPost($pdo, $title, $body, $user_post_id);

	if ($editQuery) {
		header("Location: ../index.php");
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