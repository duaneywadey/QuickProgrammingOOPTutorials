<?php  
session_start();


if (isset($_POST['insertTextFileBtn'])) {

	// Get file name
	$fileName = $_FILES['textFile']['name'];

	// Get temporary file name
	$tempFileName = $_FILES['textFile']['tmp_name'];

	// Get file extension
	$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

	// Generate random characters for image name
	$uniqueID = sha1(md5(rand(1,9999999)));

	// Combine image name and file extension
	$imageName = $uniqueID.".".$fileExtension;

	// Specify path
	$folder = "files/".$imageName;

	// Move file to the specified path 
	if (move_uploaded_file($tempFileName, $folder)) {
		$_SESSION['message'] = "File saved successfully!";
		header("Location: index.php");
	}

}

?>