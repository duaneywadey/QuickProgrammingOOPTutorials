<?php echo "string"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="9ac_form_and_input.php" method="POST">
		<div class="inputGroup">
			<p>First Name</p>
			<p><input type="text" name="fname"></p>		
		</div>
		<div class="inputGroup">
			<p>Last Name</p>
			<p><input type="text" name="lname"></p>		
		</div>
		<div class="inputGroup">
			<p>Age</p>
			<p><input type="text" name="age"></p>		
		</div>
		<div class="inputGroup">
			<p>Submit</p>
			<p><input type="submit" name="submitBtn" value="Submit"></p>		
		</div>
	</form>

	<?php

	if (isset($_POST['submitBtn'])) {

		// Get user input from the input fields
		$firstName = $_POST['fname'];
		$lastName = $_POST['lname'];
		$age = $_POST['age'];

		// Store them inside an associative array 
		$userInfoArray = array(
			"firstName" => $firstName,
			"lastName" => $lastName,
			"age" => $age
		);

		// Print the associative array in a displayable format
		echo "<pre>";
		print_r($userInfoArray);
		echo "<pre>";

		// We access the values using their keys 
		echo "Accessing them by their keys<br>";
		echo "<h2>Firstname: " . $userInfoArray['firstName']; "</h2>";
		echo "<h2>Lastname: " . $userInfoArray['lastName']; "</h2>";
		echo "<h2>Age: " . $userInfoArray['age']; "</h2>";
	}
	?>
</body>
</html>