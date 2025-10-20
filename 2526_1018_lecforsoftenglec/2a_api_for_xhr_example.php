<?php
// Read the raw POST body
$requestBody = file_get_contents('php://input');

// Decode JSON data
$data = json_decode($requestBody, true);

// Validate input existence
if (!isset($data['name']) || !isset($data['age'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Name and age are required.']);
    exit;
}

$name = trim($data['name']);
$age = (int)$data['age'];

// Validate name is not empty and age is a non-negative number
if ($name === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Name cannot be empty.']);
    exit;
}
if ($age < 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Age must be zero or positive.']);
    exit;
}

// Return the received data as confirmation
header('Content-Type: application/json');
echo json_encode(['name' => $name, 'age' => $age]);
