<?php
// greet.php
header("Content-Type: application/json");

$name = $_POST['name'] ?? '';
$location = $_POST['location'] ?? '';

$response = [
    "message" => "Hello there, $name and you're from $location"
];

echo json_encode($response);
?>
