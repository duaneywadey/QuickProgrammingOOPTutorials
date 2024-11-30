<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}

$getUserByID = getUserByID($pdo, $_SESSION['user_id']);

if ($getUserByID['is_admin'] == 0) {
	header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
	<?php include 'navbar.php'; ?>
	<?php  
	if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

		if ($_SESSION['status'] == "200") {
			echo "<h1 style='color: green;'>{$_SESSION['message']}</h1>";
		}

		else {
			echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";	
		}

	}
	unset($_SESSION['message']);
	unset($_SESSION['status']);
	?>
	<h2>All Inquiries</h2>

	<div class="inquiryContainer" style="border-style: solid; padding: 25px;">
		<h1>Ivan</h1>
		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor voluptatum quo maiores dicta officiis laudantium quasi, repellendus. Et nobis sapiente quos, aut distinctio, consectetur doloremque a nisi assumenda temporibus eaque?</p>
		<hr>
		<div class="replyContainer" style="margin-left: 25px;">
			<h1>All Replies</h1>
			<div class="reply" style="padding: 10px;">
				<h3>Ivan</h3>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem accusantium doloribus obcaecati, ullam voluptate mollitia optio soluta, laudantium nobis, eum ipsa natus aliquam quasi? Ex ullam corrupti, adipisci quaerat ad.</p>
			</div>	
			<form action="index.php" method="POST">
				<p>
					<input type="text" name="searchQuery" placeholder="Search here" style="width: 100%">
					<input type="submit" name="insertReplyBtn" value="Reply" style="float: right; height: auto;">
				</p>
			</form>
		</div>
	</div>
</body>
</html>