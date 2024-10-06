<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
	table, th, td {
	  border:1px solid black;
	}
	</style>
</head>
<body>
	
	<?php  

	// Search for all users starting with 'G'

	$query = "SELECT 
				first_name,
				last_name,
				date_of_birth,
				CASE
					WHEN year_level = 1 THEN 'First Year'
					WHEN year_level = 2 THEN 'Second Year'
					WHEN year_level = 3 THEN 'Third Year'
					WHEN year_level = 4 THEN 'Fourth Year'
				END AS year_level
			  FROM eax_comsci_students";
	$stmt = $pdo->prepare($query);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		$allStudents = $stmt->fetchAll();
	}

	?>


	<table style="width:50%">
	
	<!-- <tr><th></th></tr> (Column Names) -->
	  <tr>
	    <th>First Name</th>
	    <th>Last Name</th>
	    <th>Date of birth</th>
	    <th>Year Level</th>
	  </tr>

	<?php foreach ($allStudents as $row) { ?>
	  <tr>
	    <td><?php echo $row['first_name'];?></td>
	    <td><?php echo $row['last_name'];?></td>
	    <td><?php echo $row['date_of_birth'];?></td>
	    <td><?php echo $row['year_level'];?></td>
	  </tr>
	<?php } ?>

	</table>
</body>
</html>