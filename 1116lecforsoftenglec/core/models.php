<?php  

function checkIfUserExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM user_accounts WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"response" => "true",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"response" => "false"
			);
		}
	}

	return $response;

}

function insertNewUser($pdo, $username, $first_name, $last_name, $password) {
	$response = array();

	if (!checkIfUserExists($pdo, $username)) {

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

function getAllBranches($pdo) {
	$sql = "SELECT * FROM branches";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getAllBranchesBySearch($pdo, $search_query) {
	$sql = "SELECT * FROM branches WHERE 
			CONCAT(address,head_manager,
				contact_number,
				date_added,added_by,
				last_updated,
				last_updated_by) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$search_query."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getBranchByID($pdo, $branch_id) {
	$sql = "SELECT * FROM branches WHERE branch_id = ?";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute([$branch_id])) {
		return $stmt->fetch();
	}
}

function updateBranch($pdo, $address, $head_manager, $contact_number, 
	$last_updated, $last_updated_by, $branch_id) {
	$sql = "UPDATE branches
			SET address = ?,
				head_manager = ?,
				contact_number = ?, 
				last_updated = ?, 
				last_updated_by = ? 
			WHERE branch_id = ?
			";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute([$address, $head_manager, $contact_number, 
	$last_updated, $last_updated_by, $branch_id])) {
		return true;
	}
}

function insertIntoBranchUpdateLogs($pdo, $address=null, $head_manager=null, 
	$contact_number=null, $branch_id, $added_by) {

	$sql = "INSERT INTO branches_update_logs (address, head_manager, contact_number, branch_id, added_by) VALUES(?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);

	$executeQuery = $stmt->execute([$address, $head_manager, 
		$contact_number, $branch_id, $added_by]);

	if ($executeQuery) {
		return true;
	}

}
?>