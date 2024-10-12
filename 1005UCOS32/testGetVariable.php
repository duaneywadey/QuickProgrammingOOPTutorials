<?php  

if (isset($_GET['studentName'])) {
	echo "<h2>The student name is " . $_GET['studentName'] . "</h2>";
}

if (isset($_GET['yearLevel'])) {
	echo "<h2>The year level is " . $_GET['yearLevel'] . "</h2>";	
}

?>