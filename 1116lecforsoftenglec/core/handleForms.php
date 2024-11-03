<?php  
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertNewUserBtn'])) {
	$username = trim($_POST['username']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$password = trim($_POST['password']);
	$confirm_password = trim($_POST['confirm_password']);

	if (!empty($username) && !empty($first_name) && !empty($last_name) && !empty($password) && !empty($confirm_password)) {

		if ($password == $confirm_password) {

			$insertQuery = insertNewUser($pdo, $username, $first_name, $last_name, password_hash($password, PASSWORD_DEFAULT));
			$_SESSION['message'] = $insertQuery['message'];

			if ($insertQuery['status'] == '200') {
				header("Location: ../login.php");
			}

			else {
				header("Location: ../register.php");
			}

		}
		else {
			$_SESSION['message'] = "Please make sure both passwords are equal";
			header("Location: ../register.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		header("Location: ../register.php");
	}
}

if (isset($_POST['loginUserBtn'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = checkIfUserExists($pdo, $username);
		$userIDFromDB = $loginQuery['userInfoArray']['user_id'];
		$usernameFromDB = $loginQuery['userInfoArray']['username'];
		$passwordFromDB = $loginQuery['userInfoArray']['password'];

		if (password_verify($password, $passwordFromDB)) {
			$_SESSION['user_id'] = $userIDFromDB;
			$_SESSION['username'] = $usernameFromDB;
			header("Location: ../index.php");
		}
	}
}

if (isset($_GET['logoutUserBtn'])) {
	unset($_SESSION['username']);
	header("Location: ../login.php");
}

if (isset($_POST['updateBranchBtn'])) {

	$address = $_POST['address'];
	$head_manager = $_POST['head_manager'];
	$contact_number = $_POST['contact_number'];
	$date = date('Y-m-d H:i:s');

	if (!empty($address) && !empty($head_manager) && !empty($contact_number)) {

		$inputArr = array(
			"address"=>$_POST['address'],
			"head_manager"=>$_POST['head_manager'],
			"contact_number"=>$_POST['contact_number']
		);

		$getBranchByID = getBranchByID($pdo, $_GET['branch_id']);
		$result = array_diff($inputArr, $getBranchByID);

		$logParams = [
			"address"=>null,
			"head_manager"=>null,
			"contact_number"=>null
		];

		foreach ($result as $key => $value) {
            if ($value !== null) {
                $logParams[$key] = $value;
            }
        }

        if (!empty(array_filter($logParams))) {
            insertIntoBranchUpdateLogs($pdo, $logParams['address'], $logParams['head_manager'], $logParams['contact_number'], $_GET['branch_id'], $_SESSION['user_id']);
        }

		$updateBranch = updateBranch($pdo, $address, $head_manager, $contact_number, $date, $_SESSION['user_id'], $_GET['branch_id']);

		if ($updateBranch) {
			$_SESSION['message'] = "Successfully updated!";
			header("Location: ../index.php");
		}
	}
}


$arrTest = array(
	"FirstName"=>"Ivan Duane",
	"LastName"=>"Dequito",
	"Age"=>"24",
	"Hobbies"=>null,
	"Dreams"=>null
);

echo "<pre>";
print_r($arrTest);
echo "<pre>";

echo "<pre>";
print_r(array_filter($arrTest));
echo "<pre>";
?>