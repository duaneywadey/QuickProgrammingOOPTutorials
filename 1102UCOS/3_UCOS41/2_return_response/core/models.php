<?php  
function checkIfUserExists($pdo, $username) {

	// Initialize response array
	$response = array();
	
	// Prepare an SQL to get all rows of data where username = argument
	$sql = "SELECT * FROM user_accounts WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		// We store the result set to userInfoArray
		$userInfoArray = $stmt->fetch();

		// If number of rows is greater than zero
		if ($stmt->rowCount() > 0) {

			// We create a response array with the following key value pairs
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {

			// If user doesnt exist, we have a status of 400, and tell the user that the username doesnt exist
			$response = array(
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function insertNewUser($pdo, $username, $first_name, $last_name, $password) {

	// Initialize array response
	$response = array();

	// Call the checkIfUserExists() function
	$checkIfUserExists = checkIfUserExists($pdo, $username); 

	// If the function returned false
	if (!$checkIfUserExists['result']) {

		// Prepare the SQL query to insert user
		$sql = "INSERT INTO user_accounts (username, first_name, last_name, password) 
		VALUES (?,?,?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $first_name, $last_name, $password])) {

			// If insertion is successful, we return this response array
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {

			// If insertion is not successful, we return this response array
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {

		// If user is already found, we return this response array
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	// Return the response based on the condition met
	return $response;
}

?>