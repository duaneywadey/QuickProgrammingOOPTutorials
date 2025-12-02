<?php
// handleForms.php
header('Content-Type: application/json');

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input || !isset($input['action'])) {
        throw new Exception('Invalid request');
    }

    $action = $input['action'];
    $response = ['success' => false];

    switch ($action) {
        case 'greetUserWithNameAndAge':
            if (empty($input['name']) || !isset($input['age'])) {
                throw new Exception('Name and age are required');
            }
            $response['success'] = true;
            $response['message'] = "Hello there {$input['name']}, you are {$input['age']} years old.";
            break;

        case 'getProduct':
            if (!isset($input['num1']) || !isset($input['num2'])) {
                throw new Exception('Both numbers are required');
            }
            $product = $input['num1'] * $input['num2'];
            $response['success'] = true;
            $response['message'] = "The product is: " . number_format($product, 2);
            break;

        case 'getQuotient':
            if (!isset($input['dividend']) || !isset($input['divisor'])) {
                throw new Exception('Both dividend and divisor are required');
            }
            
            if ($input['divisor'] == 0) {
                throw new Exception('Division by zero is not allowed');
            }
            
            $quotient = $input['dividend'] / $input['divisor'];
            $response['success'] = true;
            $response['message'] = "The quotient is: " . number_format($quotient, 2);
            break;

        default:
            throw new Exception('Unknown action');
    }

    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
