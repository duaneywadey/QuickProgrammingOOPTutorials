<?php 
require_once 'data_model/dbconfig.php'; 
?>
<?php 
// session_destroy(); 
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
	<link rel="stylesheet" href="vendor/bootstrap.css">
	<script src="vendor/sweetalert.js"></script>
	<script src="vendor/jquery.js"></script>
</head>
<body>
	<?php require_once 'includes/navbar.php'; ?>
	<div class="container">
		<h1 class="display-3 text-center">Hello there, <span class="text-success"><?php echo $_SESSION['username']; ?></span></h1>
		<h1 class="display-4 text-center">All Farmers</h1>
		<div class="row" id="usersHere">
		</div>
	</div>
	<div class="container">	
		<div class="row" id="dataHere">	
		</div>
	</div>
	<script>
		function loadAllUsers() {
			fetch('api.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({ action: 'getAllUsers' })
			})
			.then(response => {
				return response.json();
			})
			.then(data => {
				console.log(data);
				let rows = "";
				for (var i = 1; i < data.result_set.length; i++) {
					rows += `
							<div class="col-md-4">
								<div class="card shadow mt-4 ml-4">
									<div class="card-header">
										<h2>
											<a href="farmlands.php?user_id=${data.result_set[i].user_id}&username=${data.result_set[i].username}">${data.result_set[i].username}</a>
										</h2>
									</div>
									<div class="card-body">
										<h1>Username: ${data.result_set[i].username}</h1>
										<h4>Email: ${data.result_set[i].email} </h1>
									</div>
								</div>
							</div>
							`
				}
				document.getElementById('usersHere').innerHTML = rows;
			})
			.catch(error => {
				console.error('Fetch error:', error);
			});
		}

		document.addEventListener('DOMContentLoaded', function () {
			loadAllUsers();
		})
	</script>
	<script src="vendor/logout.js"></script>
</body>
</html>