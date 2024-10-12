<?php  
if (isset($_GET['studentName'])) {
	echo "Hello! welcome " . $_GET['studentName'];
}

if (isset($_GET['yearLevel'])) {
	echo "<br>Your year level is ". $_GET['yearLevel'];
}



?>