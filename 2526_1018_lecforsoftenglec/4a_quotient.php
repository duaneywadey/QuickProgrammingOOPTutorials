<?php
header('Content-Type: application/json');

$response = [];

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['action']) && $input['action'] === "getQuotient") {
    $dividend = intval($input['dividend']);
    $divisor = intval($input['divisor']);

    if ($divisor === 0) {
        $response = [
            'status' => 'error',
            'message' => 'Good morning, UCOS 4-2. This is from a PHP script. Just a reminder that division by zero is not allowed.'
        ];
    } else if ($dividend < 0 || $divisor < 0) {
        $response = [
            'status' => 'error',
            'message' => 'Hello this is from PHP Script and now shown on Sweetalert. Negative numbers are not allowed'
        ];
    } else {
        $quotient = $dividend / $divisor;
        $response = [
            'status' => 'success',
            'quotient' => $quotient
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Invalid action'
    ];
}

echo json_encode($response);
exit;
