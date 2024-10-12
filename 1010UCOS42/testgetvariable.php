<?php  
if (isset($_GET['studentName'])) {
	echo "<h1>Student Name: " . $_GET['studentName'] . "</h1>";
}

if (isset($_GET['yearLevel'])) {
	echo "<h1>Year level: " . $_GET['yearLevel'] . "</h1>";
}

?>