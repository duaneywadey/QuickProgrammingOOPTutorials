<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php  
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}

$getUserByID = getUserByID($pdo, $_SESSION['user_id']);

if ($getUserByID['is_admin'] == 1) {
	header("Location: admin/index.php");
}

if ($getUserByID['is_suspended'] == 1) {
	header("Location: suspended-account-error.php");
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
	<h1 style="text-align:center;">All Inquiries</h1>

	<div class="branches" style="display: flex; justify-content: center; margin-top: 25px;">
		<div class="branchContainer" style="background-color: ghostwhite; border-style: solid; border-color: gray;width: 50%; padding: 25px;">
			<h2>Ivan</h2>
			<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Adipisci mollitia sit dolores sapiente enim quo rerum nemo libero nulla iusto repudiandae accusantium voluptate neque asperiores ut, assumenda odio sunt minima.</p>
			<h1>All Replies</h1>
			<div class="reply" style="margin-left: 25px; margin-top: 10px;">
				<h3>Ivan</h3>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem accusantium doloribus obcaecati, ullam voluptate mollitia optio soluta, laudantium nobis, eum ipsa natus aliquam quasi? Ex ullam corrupti, adipisci quaerat ad.</p>
			</div>				
		</div>
	</div>
</body>
</html>