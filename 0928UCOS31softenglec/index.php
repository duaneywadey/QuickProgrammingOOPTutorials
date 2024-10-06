<?php require_once 'core/dbConfig.php';?>

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
	$query = "SELECT
				first_name,
				last_name
			  FROM eax_comsci_students
			  WHERE first_name LIKE ?";
	$stmt = $pdo->prepare($query);
	$searchInput = "G";
	$executeQuery = $stmt->execute([$searchInput."%"]); 
	$allStartingWithG = $stmt->fetchAll();
	?>


	<table style="width:100%">
	  <tr>
	    <th>First Name</th>
	    <th>Last Name</th>
	  </tr>
	  <?php foreach ($allStartingWithG as $row) { ?>
	  	<tr>
	  		<td><?php echo $row['first_name']; ?></td>
	  		<td><?php echo $row['last_name']; ?></td>
	  	</tr>
	  <?php } ?>
	</table>
</body>

</html>
