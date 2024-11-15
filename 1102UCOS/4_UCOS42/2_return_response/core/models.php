<?php  

function checkIfUserExists($pdo, $username) {

	// Initialize a response array
	$response = array();

	// Write an SQL query that gets the row equal to the given $username arg
	$sql = "SELECT * FROM user_accounts WHERE username = ?";

	// Prepare the SQL query
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		// We fetch the associative array of our query
		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {

			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);

		}

		else {
			$response = array(
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function insertNewUser($pdo, $username, $first_name, $last_name, $password) {

	// Initialize a response array
	$response = array();

	// We call the function to check if user already exists
	$checkIfUserExists = checkIfUserExists($pdo, $username); 

	// If the result key of our checkIfUserExists function returns "NOT TRUE/ FALSE"
	if (!$checkIfUserExists['result']) {

		$sql = "INSERT INTO user_accounts (username, first_name, last_name, password) 
		VALUES (?,?,?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $first_name, $last_name, $password])) {
			
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}

?>