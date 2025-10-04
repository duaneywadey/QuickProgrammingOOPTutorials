<?php
// Get the raw POST data
$requestBody = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($requestBody, true);

// Validate input
if (!isset($data['numerator']) || !isset($data['denominator'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Numerator and denominator are required.']);
    exit;
}

$numerator = $data['numerator'];
$denominator = $data['denominator'];

// Validate denominator is not zero
if ($denominator == 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Division by zero is not allowed.']);
    exit;
}

// Perform division
$quotient = $numerator / $denominator;

// Return result as JSON
header('Content-Type: application/json');
echo json_encode(['quotient' => $quotient]);
