<?php
// Get the raw POST data
$requestBody = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($requestBody, true);

// Validate input
if (!isset($data['numerator']) || !isset($data['denominator'])) {
    http_response_code(400);
    // Reinitialize for this branch
    $response = [
        'success' => false,
        'message' => 'Numerator and denominator are required.'
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Extract values
$numerator = $data['numerator'];
$denominator = $data['denominator'];

// Validate denominator is not zero
if ($denominator == 0) {
    http_response_code(400);
    // Reinitialize for this branch
    $response = [
        'success' => false,
        'message' => 'Division by zero is not allowed.'
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Perform division
$quotient = $numerator / $denominator;

// Success path
http_response_code(200);
$response = [
    'success' => true,
    'message' => 'The answer is ' . $quotient . '. Thank you for using the calculator.',
];

// Return result as JSON
header('Content-Type: application/json');
echo json_encode($response);
