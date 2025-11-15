<?php
header('Content-Type: application/json');

// First names of authorized users (as requested)
$authorizedFirstNames = [
    'alice',
    'carlos',
    'maria',
    'daniel',
    'kyle'
];

// NCR city list (lowercase for case-insensitive comparison)
$ncrCities = [
    'caloocan',
    'las pinas',
    'manila',
    'makati',
    'malabon',
    'mandaluyong',
    'marikina',
    'muntinlupa',
    'navotas',
    'parañaque',
    'pasay',
    'pasig',
    'pateros',
    'quezon city',
    'san juan',
    'taguig',
    'valenzuela'
];

// Normalize input
$name = isset($_POST['name']) ? strtolower(trim($_POST['name'])) : '';
$location = isset($_POST['location']) ? strtolower(trim($_POST['location'])) : '';

// Basic validation
$errors = [];

if ($name === '') {
    $errors[] = 'Name is required.';
} 

if ($location === '') {
    $errors[] = 'Location is required.';
}

// If there are validation errors, respond with failure
if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'message' => implode(' ', $errors)
    ]);
    http_response_code(400);
    exit;
}

// Check if name is in the authorized first-name list
$isAuthorizedName = in_array($name, $authorizedFirstNames, true);

// Check if location is in NCR city list (case-insensitive)
$locationLower = strtolower($location);
$isInNCR = in_array($locationLower, $ncrCities, true) || in_array($locationLower, ['ncr', 'national capital region'], true);

// Response logic
if ($isAuthorizedName && $isInNCR) {
    echo json_encode([
        'success' => true,
        'message' => 'Access granted. User is authorized and located in NCR.'
    ]);
    exit;
} elseif ($isAuthorizedName && !$isInNCR) {
    echo json_encode([
        'success' => false,
        'message' => 'User is not from NCR.'
    ]);
    exit;
} elseif (!$isAuthorizedName && $isInNCR) {
    echo json_encode([
        'success' => false,
        'message' => 'User is not in the authorized users list.'
    ]);
    exit;
} else {
    echo json_encode([
        'success' => false,
        'message' => 'User is not authorized and not located in NCR.'
    ]);
    exit;
}
