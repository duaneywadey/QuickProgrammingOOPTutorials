<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body {
			font-family: "Arial";
			background-color: #FFFFF0;
		}
		input {
			font-size: 1.5em;
			height: auto;
			width: 25%;
		}
		table, th, td {
			border:1px solid black;
		}

		tr {
		    border-top: 12px solid transparent;
		    border-bottom: 12px solid transparent;
		}
	</style>
</head>
<body>
	
	<h1>Uploading File in PHP</h1>

	<?php if (isset($_SESSION['message'])) { ?>
		<h3 style="color: green;"><?php echo $_SESSION['message']; ?></h3>
	<?php } unset($_SESSION['message']); ?>

	<form action="handleForms.php" method="POST" enctype="multipart/form-data">
		<p>
			<input type="file" name="textFile">
		</p>
		<p>
			<input type="submit" name="insertTextFileBtn">
		</p>
	</form>


</body>
</html>