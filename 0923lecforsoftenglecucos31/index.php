<?php  

$studentName = "Ivan Duane";
$subject = "Calculus";
$grade = 5.00;
$isScholar = False;
$age = 15;
$school = "Philippine EAX";
$subjects = array("Calculus", "Automata", "Computer System Architecture", "Networks and Communication", "Software Engineering 1", "Modeling and Simulation", "Human Computer Interaction", "Calculus 2", "Data Analysis");

$grades = array(
	"Calculus"=>3.00,
	"Automata"=>2.25,
	"Computer System Architecture"=>1.75,
	"Networks and Communication" => 2.50,
	"Software Engineering 1"=> 1.25,
	"Data Analysis" => 2.00
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>September 23 Lecture</title>
	<style>
	table, th, td {
	  border:1px solid black;
	}
	</style>
</head>
<body>
	<p>The student name is <?php echo $studentName; ?></p>
	<p>The subject is <?php echo $subject; ?></p>
	<p>The grade is <?php echo $grade; ?></p>
	<p>The age is <?php echo $age; ?></p>
	<p>The school is <?php echo $school; ?></p>
	<p>Voting Application Status:

		<?php 

		if ($age >= 18 || $school == "EAX") {
			echo "You can vote here!";
		}
		else {
			echo "You're not allowed to vote!";
		}

		?>
	</p>

	<p>The subjects of <?php echo $studentName; ?> are as follows: </p>
	
	<?php $counter = 0; ?>
	<?php foreach ($subjects as $el) {
		$counter += 1;
		echo $counter . ".) " . $el."<br>"; 
	} 
	?>



	<p>The grades are as follows: </p>
	<table style="width:100%">
	  <tr>
	    <th>Subject</th>
	    <th>Grade</th>
	  </tr>

	  <?php foreach ($grades as $key => $value) { ?>
	  <tr>
	    <td><?php echo $key; ?></td>
	    <td><?php echo $value; ?></td> 
	  </tr>
	  <?php } ?>

	</table>

	<?php foreach ($grades as $key => $value) { ?>
		<div class="card" style="border-style: solid; margin-top: 10px;">
			<h1><?php echo $key ?></h1>
			<h3><?php echo $value ?></h3>
		</div>
	<?php } ?>
</body>
</html>