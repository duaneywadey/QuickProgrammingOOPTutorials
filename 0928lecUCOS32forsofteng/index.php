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

	$query = "
			  SELECT 
			  	CASE 
			  		WHEN year_level = 1 THEN 'First Year'
			  		WHEN year_level = 2 THEN 'Second Year'
			  		WHEN year_level = 3 THEN 'Third Year'
			  		WHEN year_level = 4 THEN 'Fourth Year'
			  	END AS year_level, COUNT(*) AS studentCount
			  	FROM eax_comsci_students
			  	GROUP BY year_level
			  ";
	$stmt = $pdo->prepare($query);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		$studentsByYearLevel = $stmt->fetchAll();
	}
	else {
		echo "Query failed";
	}
	?>

	<table>
	  <tr>
	    <th>Year Level</th>
	    <th>Student Count</th>
	  </tr>

	  <?php foreach ($studentsByYearLevel as $value) { ?>
	  <tr>
	    <td><?php echo $value['year_level']; ?></td>
	    <td><?php echo $value['studentCount']; ?></td>
	  </tr>
	  <?php } ?>
	</table>
</body>
</html>