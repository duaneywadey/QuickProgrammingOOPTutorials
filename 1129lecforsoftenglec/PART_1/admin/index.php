<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<?php  
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
	<link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
	<?php include 'navbar.php'; ?>
	<h1 style="text-align: center;">Suspend Accounts</h1>
	<?php $getAllUsers = getAllUsers($pdo); ?>
	<?php foreach ($getAllUsers as $row) { ?>
	<div class="container" style="display: flex; justify-content: center;">
		<div class="userInfo" style="background-color: ghostwhite; border-style: solid; border-color: gray;width: 50%; margin-top: 25px; padding: 50px;">
			<h3>Username: <span style="color: blue"><?php echo $row['username']; ?></span></h3>
			<h3>First Name: <span style="color: blue"><?php echo $row['first_name']; ?></span></h3>
			<h3>Last Name: <span style="color: blue"><?php echo $row['last_name']; ?></span></h3>
			<h3>Date Joined: <span style="color: blue"><?php echo $row['date_added']; ?></span></h3>

			<?php if ($row['is_suspended'] == 0) { ?>
				<a href="suspend-an-account.php?user_id=<?php echo $row['user_id']; ?>" style="float: right;">Suspend Account</a>
			<?php } else { ?>
				<a href="suspend-an-account.php?user_id=<?php echo $row['user_id']; ?>" style="float: right;">Unsuspend Account</a>
			<?php } ?>

		</div>
	</div>
	<?php } ?>
</body>
</html>