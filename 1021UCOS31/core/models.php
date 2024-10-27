<?php  

function insertNewUser($pdo, $username, $password) {

	$checkUserSQL = "SELECT * FROM  user_passwords WHERE username  = ?";
	$checkUserSQLStmt = $pdo->prepare($checkUserSQL);
	$checkUserSQLStmt->execute([$username]);

	if ($checkUserSQLStmt->rowCount() == 0) {
		$sql = "INSERT INTO user_passwords (username, password) VALUES (?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $password]);

		if ($executeQuery) {
			$_SESSION['message'] = "User successfully inserted!";
			return true;
		}

		else {
			$_SESSION['message'] = "An error occured from the query";
		}
	}
	else {
		$_SESSION['message'] = "User already exists";
	}

}

function loginUser($pdo, $username, $password) {

	$sql = "SELECT * FROM user_passwords WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {
		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username'];
		$passwordFromDB = $userInfoRow['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login is successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Username/password is invalid";
		}

	}

	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesnt exist from the database!";
	}

}

?>