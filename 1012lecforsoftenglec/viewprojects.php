<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<form action="#" method="POST">
		<p>
			<label for="firstName">Project Name</label> 
			<input type="text" name="projectName">
		</p>
		<p>
			<label for="firstName">Technologies Used</label> 
			<input type="text" name="technologiesUsed">
			<input type="submit" name="insertNewProjectBtn">
		</p>
	</form>

	<table style="width:50%; margin-top: 50px;">
	  <tr>
	    <th>Project ID</th>
	    <th>Project Name</th>
	    <th>Technologies Used</th>
	    <th>Project Owner</th>
	    <th>Date Added</th>
	    <th>Action</th>
	  </tr>
	  <tr>
	  	<td>1</td>
	  	<td>StudentSystem</td>
	  	<td>HTML, CSS, JavaScript, PHP</td>
	  	<td>Ivan Duane</td>
	  	<td>October 12, 2024</td>
	  	<td>
	  		<a href="editproject.php">Edit</a>
	  		<a href="deleteproject.php">Delete</a>
	  	</td>
	  </tr>
	</table>
</body>
</html>