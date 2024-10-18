<?php require_once 'dbConfig.php'; ?>
<?php require_once 'models.php'; ?>

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

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
		<input type="text" name="searchInput">
		<input type="submit" name="searchBtn">
	</form>

	<table style="width:100%">
		<tr>
			<td>ID</td>
			<td>FirstName</td>
			<td>LastName</td>
			<td>Email</td>
			<td>Gender</td>
		</tr>
		<?php 
		if (isset($_GET['searchBtn'])) { 
			$searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
			foreach ($searchForAUser as $row) {
		?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['first_name']; ?></td>
					<td><?php echo $row['last_name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['gender']; ?></td>
				</tr>
		<?php }} else { ?>

		<?php
			$getAllUsers = getAllUsers($pdo);
			foreach ($getAllUsers as $row) { 
		?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['first_name']; ?></td>
					<td><?php echo $row['last_name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['gender']; ?></td>
				</tr>

		<?php }} ?>  
	</table>


</body>
</html>