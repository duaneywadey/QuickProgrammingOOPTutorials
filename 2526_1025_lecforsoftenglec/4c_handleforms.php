<?php
session_start();
require '4_dbconfig.php';

// Receive JSON input
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

header('Content-Type: application/json');

// A response data will return two values back to the template, success status and message value
$response = ["success" => false, "message" => "Unknown error"];

$action = $input['action'] ?? '';

switch ($action) {
    case 'register':
        $username = trim($input['username'] ?? '');
        $email = trim($input['email'] ?? '');
        $password = trim($input['password'] ?? '');
        $contact_number = trim($input['contact_number'] ?? '');

        if ($username === '' || $email === '' || $password === '') {
            $response['message'] = "Fields cannot be empty";
            break;
        }

        $stmt = $pdo->prepare("SELECT user_id FROM sweetalert_users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $response['message'] = "Username already taken";
            break;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO sweetalert_users (username, email, password, contact_number) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $hash, $contact_number]);

        $response['success'] = true;
        $response['message'] = "Registration successful";
        break;

    case 'login':
        $username = trim($input['username'] ?? '');
        $password = trim($input['password'] ?? '');

        if ($username === '' || $password === '') {
            $response['message'] = "Fields cannot be empty";
            break;
        }

        $stmt = $pdo->prepare("SELECT * FROM sweetalert_users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $response['success'] = true;
            $response['message'] = "Login successful";
        } else {
            $response['message'] = "Invalid username or password";
        }
        break;

    case 'logout':
        if (isset($_SESSION['user_id'])) {
            session_destroy();
            $response['success'] = true;
            $response['message'] = "Logout successful";
        } else {
            $response['message'] = "No active session";
        }
        break;

    default:
        $response['message'] = "Invalid action";
}

echo json_encode($response);
exit;
