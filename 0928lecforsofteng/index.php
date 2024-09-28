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
	
	?>

	
</body>
</html>