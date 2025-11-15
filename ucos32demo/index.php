<?php  
require_once 'dbConfig.php';

// $query = "UPDATE eax_comsci_students SET first_name = ?, last_name = ? WHERE id = ?";

// $stmt = $pdo->prepare($query);
// $executeQuery = $stmt->execute(["NewMyca", "NewBrisse", 76]);
// if ($executeQuery) {
// 	echo "QUERY SUCCESSFUL!!";
// }

$query = "SELECT * FROM eax_comsci_students WHERE id = 76";

$stmt = $pdo->prepare($query);
$executeQuery = $stmt->execute();
if ($executeQuery) {
	$userID76 = $stmt->fetch();
	$first_name = $userID76['first_name'];
	$last_name = $userID76['last_name'];
	$gender = $userID76['gender'];
	$date_of_birth = $userID76['date_of_birth'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<div class="userInfoCard" style="border-style: solid;">
		<h1>First Name: <?php echo $first_name; ?></h1>
		<h1>Last Name: <?php echo $last_name; ?></h1>
		<h1>Gender: <?php echo $gender; ?></h1>
		<h1>Date of Birth: <?php echo $date_of_birth; ?></h1>
	</div>
</body>
</html>