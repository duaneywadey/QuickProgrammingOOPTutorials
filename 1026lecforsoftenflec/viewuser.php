<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body {
			font-family: "Arial";
		}
		input {
			font-size: 1.5em;
			height: 50px;
			width: 200px;
		}
		table, th, td {
			border:1px solid black;
		}
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<?php $getUserByID = getUserByID($pdo, $_GET['user_id']); ?>
	<h1>Username: <?php echo $getUserByID['username']; ?></h1>
	<h1>First Name: <?php echo $getUserByID['first_name']; ?></h1>
	<h1>Last Name: <?php echo $getUserByID['last_name']; ?></h1>
	<h1>Date Joined: <?php echo $getUserByID['date_added']; ?></h1>
	<h1>All Posts</h1>

	<?php $getAllPostsByUser = getAllPostsByUser($pdo, $_GET['user_id']); ?>
	<?php foreach ($getAllPostsByUser as $row) { ?>
	<div class="postContainer" style="border-style: solid; width: 50%; height: 300px; margin-top: 20px;">
		<a href="viewuser.php?user_id=<?php echo $row['user_id']; ?>">
			<h1><?php echo $row['userFullName']; ?></h1>
		</a>
		<i><?php echo $row['date_added']; ?></i>
		<h2><?php echo $row['title']; ?></h2>
		<p><?php echo $row['body']; ?></p>
		
		<?php if ($_SESSION['user_id'] == $row['user_id']) { ?>
		<div class="editAndDelete">
			<a href="editpost.php?user_post_id=<?php echo $row['user_post_id']; ?>">Edit</a>	
			<a href="deletepost.php?user_post_id=<?php echo $row['user_post_id']; ?>">Delete</a>	
		</div>
		<?php } ?>

	</div>
	<?php } ?>

</body>
</html>

