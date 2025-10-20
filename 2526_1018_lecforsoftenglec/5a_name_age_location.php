<?php
header('Content-Type: application/json');

$metroManilaCities = [
    'Caloocan', 'Las Piñas', 'Makati', 'Malabon', 'Mandaluyong', 'Manila',
    'Marikina', 'Muntinlupa', 'Navotas', 'Parañaque', 'Pasay',
    'Pasig', 'Quezon City', 'San Juan', 'Taguig', 'Valenzuela',
    'Pateros'
];

// Read JSON input
$input = json_decode(file_get_contents('php://input'), true);

// Initialize default error response
$response = [
    'status' => 'error',
    'message' => 'Invalid input or action'
];

// Validate action
if (isset($input['action']) && $input['action'] === 'checkAgeLocation') {
    $name = isset($input['name']) ? trim($input['name']) : '';
    $age = isset($input['age']) ? intval($input['age']) : 0;
    $location = isset($input['location']) ? trim($input['location']) : '';

    // Check if location is in Metro Manila (NCR)
    $locationLower = strtolower($location);
    $isFromNCR = false;
    foreach ($metroManilaCities as $city) {
        if (strtolower($city) === $locationLower) {
            $isFromNCR = true;
            break;
        }
    }

    $isAdult = ($age >= 18);

    if ($isAdult && $isFromNCR) {
        // Success case
        $response = [
            'status' => 'success',
            'name' => $name,
            'age' => $age,
            'location' => $location
        ];
    } else {
        // Single error message returned for any failure condition
        $errorMessage = '';
        if (!$isAdult && !$isFromNCR) {
            $errorMessage = 'You are not at least 18 years old and not from Metro Manila (NCR).';
        } elseif (!$isFromNCR) {
            $errorMessage = 'You are not from Metro Manila (NCR).';
        } elseif (!$isAdult) {
            $errorMessage = 'You are not at least 18 years old.';
        } else {
            $errorMessage = 'Invalid input conditions.';
        }

        $response = [
            'status' => 'error',
            'message' => $errorMessage
        ];
    }
}

echo json_encode($response);
exit();
