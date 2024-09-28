<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	
	<?php  

    // Selecting all students from the table 
	// $stmt = $pdo->prepare("SELECT * FROM eax_comsci_students");

	// if ($stmt->execute()) {
	// 	print_r($stmt->fetchAll());
	// }


	// Selecting only the info of user with an id of 53

	// $stmt = $pdo->prepare("SELECT * FROM 
	// 						eax_comsci_students 
	// 						WHERE id = 53");
	// if ($stmt->execute()) {
	// 	print_r($stmt->fetch());
	// }

	// Selecting all students with an ID of 1 to 50 and are males

	// $query = "SELECT * FROM 
	// 			eax_comsci_students 
	// 		  WHERE id 
	// 		  	BETWEEN 1 AND 50 
	// 		  	AND gender = 'Male'";

	// $stmt = $pdo->prepare($query);
	// if ($stmt->execute()) {
	// 	echo "<pre>";
	// 	print_r($stmt->fetchAll());
	// 	echo "<pre>";

	// }


	// Selecting that user with an id of 26

	// $query = "SELECT * FROM 
	// 			eax_comsci_students 
	// 		  WHERE id = 26";

	// $stmt = $pdo->prepare($query);

	// if ($stmt->execute()) {
	// 	$userID26 = $stmt->fetch();
	// 	echo "<pre>";
	// 	print_r($userID26);
	// 	echo "<pre>";
	// }

	// Getting the personal info

	// $query = "SELECT * FROM 
	// 			eax_comsci_students 
	// 		  WHERE id = 26";

	// $stmt = $pdo->prepare($query);
	
	// if ($stmt->execute()) {
	// 	$userID26 = $stmt->fetch();
	// 	$first_name = $userID26['first_name'];
	// 	$last_name = $userID26['last_name'];
	// 	$date_of_birth = $userID26['last_name'];

	// 	echo "First name: " . $first_name . "<br>";
	// 	echo "Last name: " . $last_name . "<br>";
	// 	echo "Date of birth: " . $date_of_birth . "<br>";
	// }

	// Inserting a new user to the table

	// $query = "INSERT INTO eax_comsci_students (id, first_name, 
	// 	last_name, gender, date_of_birth, year_level) 
	// 	VALUES (?,?,?,?,?,?)";

	// $stmt = $pdo->prepare($query);

	// $executeQuery = $stmt->execute(
	// 	[302,"Daryl","Smith","Male",'2005-08-26', 4]
	// );

	// if ($executeQuery) {
	// 	echo "Query successful!";
	// }
	// else {
	// 	echo "Query failed";
	// }


	// Updating a user from the database

	// $query = "UPDATE eax_comsci_students 
	// 		  SET first_name = ?, last_name = ?
	// 		  WHERE id = 302
	// 		  ";

	// $stmt = $pdo->prepare($query);

	// $executeQuery = $stmt->execute(
	// 	["Ivan", "Duane"]
	// );

	// if ($executeQuery) {
	// 	echo "Update successful!";
	// }
	// else {
	// 	echo "Query failed";
	// }

	// Deleting a user from the database

	// $query = "DELETE FROM eax_comsci_students 
	// 		  WHERE id = 301
	// 		  ";

	// $stmt = $pdo->prepare($query);

	// $executeQuery = $stmt->execute();

	// if ($executeQuery) {
	// 	echo "Deletion successful!";
	// }
	// else {
	// 	echo "Query failed";
	// }


	// Searching for all the users starting with 'G'

	// $query = "SELECT 
	// 			first_name,
	// 			last_name
	// 		  FROM eax_comsci_students
	// 		  WHERE first_name LIKE ?
	// 		  ";

	// $stmt = $pdo->prepare($query);

	// $searchInput = "G";
	// $executeQuery = $stmt->execute([$searchInput."%"]);

	// if ($executeQuery) {
	// 	echo "<pre>";
	// 	print_r($stmt->fetchAll());
	// 	echo "<pre>";
	// }

	// else {
	// 	echo "Query failed";
	// }


	?>


	<?php  
	// Searching for all the users starting with 'G'
	$query = "SELECT 
				first_name,
				last_name
			  FROM eax_comsci_students
			  WHERE first_name LIKE ?
			  ";

	$stmt = $pdo->prepare($query);

	$searchInput = "G";
	$executeQuery = $stmt->execute([$searchInput."%"]);

	if ($executeQuery) {
		$allUsersStartingG = $stmt->fetchAll();
	}

	else {
		echo "Query failed";
	}

	?>

	<?php foreach ($allUsersStartingG as $row) { ?>
		<div class="container" style="border-style: solid; 
		border-width: 2px; margin-top: 10px; height: 50px;">
			<?php echo $row['first_name'] . $row['last_name']; ?>
		</div>
	<?php } ?>	




</body>
</html>