<?php  
$studentName = "Ivan";
$favoriteSubject = "Web Design";
$tuitionFee = 25000;
$discountPercentage = 0.10;
$deduction = $tuitionFee * $discountPercentage;
$finalTuitionFee = $tuitionFee - $deduction;
$calculusGrade = 1.00;

// Boolean Variables
$isScholar = False;
$passedAllSubjects = False;

$allSubjects = array("Calculus 1", "Networks and Communication", "Automata", "Computer System Architecture", "Modeling and Simulation", "Human Computer Interaction", "Software Engineering 1");

$allSubjectsAndGrade = array(
	// Key        // Value
	"Calculus 1" => 5.00,
	"Networks and Communication"=>1.50,
	"Automata" => 3.00,
	"Computer System Architecture" => 1.75,
	"Modeling and Simulation" => 2.25
);
?>

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
	<p>The name is <?php echo $studentName; ?> and his favorite subject is <?php echo $favoriteSubject; ?></p>
	<p>His tuition fee is <?php echo $tuitionFee; ?></p>
	<p>The discount is <?php echo $discountPercentage * 100; ?>%</p>
	<p>The deduction is <?php echo $deduction; ?></p>
	<p>The final tuition fee is <?php echo $finalTuitionFee; ?></p>
	<p>The grade status is:</p>
	<?php 
	if ($calculusGrade == 5.00) {
		echo "FAILED";
	} 
	else {
		echo "PASSED";
	}
	?>
	<p>Academic Scholarship</p>
	<?php  

	if ($isScholar || $passedAllSubjects) {
		echo "PROBABLY, STILL A SCHOLAR";
	}
	else {
		echo "NOT A SCHOLAR ANYMORE!";
	}
	?>

	<form action="handleform.php" method="POST">
		<p>Type name here<input type="text" name="username"></p>
		<p>Location<input type="text" name="location"></p>
		<p>Number of classes<input type="number" name="numOfClasses"></p>
		<p>FavoriteSubject<input type="text" name="faveSubject"></p>
		<p>Type GPA here<input type="text" name="gpa"></p>
		<input type="submit" value="Submit" name="submitBtn">
	</form>

	<?php echo "The first value from the array is " . $allSubjects[2]; ?>

	<?php foreach ($allSubjects as $value) {
		echo $value . "<br>";
	} 
	?>

	<p>Contents inside associative array, allSubjectsAndGrade</p>

	<?php foreach ($allSubjectsAndGrade as $key => $value) {
		echo $key . " - " . $value . "<br>";
	} 
	?>
	<table style="width:100%">
	  <tr>
	    <th>Subject</th>
	    <th>Grade</th>
	  </tr>
	  <?php foreach ($allSubjectsAndGrade as $key => $value) { ?>
	  <tr>
	    <td><?php echo $key; ?></td>
	    <td><?php echo $value; ?></td>
	  </tr>
	   <?php } ?>
	</table>
</body>
</html>