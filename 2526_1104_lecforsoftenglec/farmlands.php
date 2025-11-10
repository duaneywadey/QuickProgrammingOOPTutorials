<?php require_once 'data_model/dbconfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="vendor/bootstrap.css">
	<script src="vendor/sweetalert.js"></script>
	<script src="vendor/jquery.js"></script>
	<style>
		.redBorder {
			border-style: solid;
		}
	</style>
</head>
<body>
	<?php require_once 'includes/navbar.php'; ?>
	<div class="container">
		<h1 class="display-4 text-center"><?php echo $_GET['username'] ?>'s Farmlands</h1>
		  <div class="row" id="dataHere">
		  </div>
	</div>
	<script>

	 document.addEventListener('DOMContentLoaded', function () {
		fetch('api.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({
				userIDInput: "<?php echo $_GET['user_id']; ?>",
				action: 'getAllFarmsByUserID'
			})
		})
		.then(response => {
			return response.json();
		})
		.then(data => {
			let rows = ''
			for (var i = 0; i < data.result_set.length; i++) {
				rows += `
						<div class="col-md-4 mt-4">
							<div class="card shadow mt-4">
								<div class="card-body">
									<h3 class="locationClass">Location: ${data.result_set[i].location} </h1>
									<h4 class="text-success" jsonattr='${JSON.stringify(data.result_set[i])}' >Crop type: ${data.result_set[i].crop_type} </h1>
									<h5 class="addressClass" croptypeattr='${JSON.stringify(data.result_set[i].crop_type)}'>Address: ${data.result_set[i].farmland_address} </h4>
								</div>
							</div>	
						</div>
						`
			}
			document.getElementById('dataHere').innerHTML = rows;
		})
		.catch(error => {
			console.error('Fetch error:', error);
		});
	 })

	</script>
	<script src="vendor/logout.js"></script>
</body>
</html>