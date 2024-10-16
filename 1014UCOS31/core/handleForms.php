<?php  


require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertWebDevBtn'])) {

	if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['dateOfBirth'])  && !empty($_POST['specialization'])) {

		$query = insertWebDev($pdo, $_POST['username'], $_POST['firstName'], 
		$_POST['lastName'], $_POST['dateOfBirth'], $_POST['specialization']);

		if ($query) {
			header("Location: ../index.php");
		}
		else {
			echo "Insertion failed";
		}

	}

	else {
		echo "Make sure that no input fields are empty!";
	}

}

if (isset($_POST['editWebDevBtn'])) {

	if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['dateOfBirth']) && !empty($_POST['specialization']) && !empty($_GET['web_dev_id'])) {

		$query = updateWebDev($pdo, $_POST['firstName'], $_POST['lastName'], 
		$_POST['dateOfBirth'], $_POST['specialization'], $_GET['web_dev_id']);

		if ($query) {
			header("Location: ../index.php");
		}

		else {
			echo "Edit failed";
		}

	}

	else {
		echo "Make sure no input fields are empty before updating!";
	}



}

if (isset($_POST['deleteWebDevBtn'])) {
	$query = deleteWebDev($pdo, $_GET['web_dev_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertNewProjectBtn'])) {
	$query = insertProject($pdo, $_POST['projectName'], $_POST['technologiesUsed'], $_GET['web_dev_id']);

	if ($query) {
		header("Location: ../viewprojects.php?web_dev_id=" .$_GET['web_dev_id']);
	}
	else {
		echo "Insertion failed";
	}
}


if (isset($_POST['editProjectBtn'])) {
	$query = updateProject($pdo, $_POST['projectName'], $_POST['technologiesUsed'], $_GET['project_id']);

	if ($query) {
		header("Location: ../viewprojects.php?web_dev_id=" .$_GET['web_dev_id']);
	}
	else {
		echo "Update failed";
	}

}

if (isset($_POST['deleteProjectBtn'])) {
	$query = deleteProject($pdo, $_GET['project_id']);

	if ($query) {
		header("Location: ../viewprojects.php?web_dev_id=" .$_GET['web_dev_id']);
	}
	else {
		echo "Deletion failed";
	}
}





?>