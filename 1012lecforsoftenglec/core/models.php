<?php  

function insertWebDev($pdo, $username, $first_name, $last_name, 
	$date_of_birth, $specialization) {

	$sql = "INSERT INTO web_devs (username, first_name, last_name, 
		date_of_birth, specialization) VALUES(?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username, $first_name, $last_name, 
		$date_of_birth, $specialization]);

	if ($executeQuery) {
		return true;
	}
}



function updateWebDev($pdo, $first_name, $last_name, 
	$date_of_birth, $specialization, $web_dev_id) {

	$sql = "UPDATE web_devs
				SET first_name = ?,
					last_name = ?,
					date_of_birth = ?, 
					specialization = ?
				WHERE web_dev_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, 
		$date_of_birth, $specialization, $web_dev_id]);
	
	if ($executeQuery) {
		return true;
	}

}


function deleteWebDev($pdo, $web_dev_id) {
	$deleteWebDevProj = "DELETE FROM projects WHERE web_dev_id = ?";
	$deleteStmt = $pdo->prepare($deleteWebDevProj);
	$executeDeleteQuery = $deleteStmt->execute([$web_dev_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM web_devs WHERE web_dev_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$web_dev_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllWebDevs($pdo) {
	$sql = "SELECT * FROM web_devs";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getWebDevByID($pdo, $web_dev_id) {
	$sql = "SELECT * FROM web_devs WHERE web_dev_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$web_dev_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}





function getProjectsByWebDev($pdo, $web_dev_id) {
	
	$sql = "SELECT 
				projects.project_id AS project_id,
				projects.project_name AS project_name,
				projects.technologies_used AS technologies_used,
				projects.date_added AS date_added,
				CONCAT(web_devs.first_name,' ',web_devs.last_name) AS project_owner
			FROM projects
			JOIN web_devs ON projects.web_dev_id = web_devs.web_dev_id
			WHERE projects.web_dev_id = ? 
			GROUP BY projects.project_name;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$web_dev_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertProject($pdo, $project_name, $technologies_used, $web_dev_id) {
	$sql = "INSERT INTO projects (project_name, technologies_used, web_dev_id) VALUES (?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$project_name, $technologies_used, $web_dev_id]);
	if ($executeQuery) {
		return true;
	}

}

function getProjectByID($pdo, $project_id) {
	$sql = "SELECT 
				projects.project_id AS project_id,
				projects.project_name AS project_name,
				projects.technologies_used AS technologies_used,
				projects.date_added AS date_added,
				CONCAT(web_devs.first_name,' ',web_devs.last_name) AS project_owner
			FROM projects
			JOIN web_devs ON projects.web_dev_id = web_devs.web_dev_id
			WHERE projects.project_id  = ? 
			GROUP BY projects.project_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$project_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateProject($pdo, $project_name, $technologies_used, $project_id) {
	$sql = "UPDATE projects
			SET project_name = ?,
				technologies_used = ?
			WHERE project_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$project_name, $technologies_used, $project_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteProject($pdo, $project_id) {
	$sql = "DELETE FROM projects WHERE project_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$project_id]);
	if ($executeQuery) {
		return true;
	}
}




?>