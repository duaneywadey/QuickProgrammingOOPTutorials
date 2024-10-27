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
		textarea { 
			font-size: 1.5em;
		}
		table, th, td {
			border:1px solid black;
		}
	</style>
</head>
<body>
	<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
	<?php } unset($_SESSION['message']); ?>



	<?php if (isset($_SESSION['username'])) { ?>
		<h1>Hello there!! <?php echo $_SESSION['username']; ?></h1>
		<?php include 'navbar.php'; ?>
	<?php } else { echo "<h1>No user logged in</h1>";}?>

	<h1>Write a post</h1>

	<form action="core/handleForms.php" method="POST">
		<p><label for="username">Title</label></p>
		<p><input type="text" name="title"></p>
		<p><label for="username">Body</label></p>
		<p><textarea name="body" rows="10" cols="50"></textarea>
		<p><input type="submit" name="insertNewPostBtn"></p>
	</form>

	<h1>All Posts</h1>

	<?php $getAllPosts = getAllPosts($pdo); ?>
	<?php foreach ($getAllPosts as $row) { ?>
	<div class="postContainer" style="border-style: solid; width: 100%; height: auto; margin-top: 20px;">
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

