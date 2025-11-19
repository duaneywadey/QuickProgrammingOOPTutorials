<?php
// Get the raw POST data
$requestBody = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($requestBody, true);

function returnAsJSON($response) {
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

if (isset($data['action']) && $data['action'] == "divideNumber") {
    // Extract values first
    $numerator = isset($data['numerator']) ? $data['numerator'] : null;
    $denominator = isset($data['denominator']) ? $data['denominator'] : null;

    // Validate inputs are provided (0 is allowed, so avoid empty())
    if ($numerator === null || $denominator === null) {
        returnAsJSON([
            'success' => false,
            'message' => 'Numerator and denominator are required.'
        ]);
    }

    // Validate inputs are numeric
    if (!is_numeric($numerator) || !is_numeric($denominator)) {
        returnAsJSON([
            'success' => false,
            'message' => 'Numerator and denominator must be numbers.'
        ]);
    }

    // Validate denominator is not zero
    if ((float)$denominator == 0) {
        http_response_code(400);
        returnAsJSON([
            'success' => false,
            'message' => 'Division by zero is not allowed.'
        ]);
    }

    // Perform division
    $quotient = (float)$numerator / (float)$denominator;
    returnAsJSON([
        'success' => true,
        'message' => 'The answer is ' . $quotient . '. Thank you for using the calculator.',
    ]);
}
