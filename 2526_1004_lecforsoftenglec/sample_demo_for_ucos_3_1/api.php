<?php
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid or missing JSON input']);
    exit;
}

switch ($action) {
    case 'getNameAndAge':
        $name = trim($input['name'] ?? '');
        $age = filter_var($input['age'] ?? null, FILTER_VALIDATE_INT);

        if ($name === '' || $age === false || $age < 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid name or age']);
            exit;
        }

        echo json_encode([
            'name' => $name,
            'age' => $age
        ]);
        exit;

    case 'getQuotient':
        $numerator = filter_var($input['numerator'] ?? null, FILTER_VALIDATE_FLOAT);
        $denominator = filter_var($input['denominator'] ?? null, FILTER_VALIDATE_FLOAT);

        if ($numerator === false || $denominator === false) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid numerator or denominator']);
            exit;
        }
        if ($denominator == 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Denominator cannot be zero']);
            exit;
        }

        $quotient = $numerator / $denominator;
        echo json_encode(['quotient' => $quotient]);
        exit;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
        exit;
}