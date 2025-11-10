<?php
require_once 'data_model/dbconfig.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

// A response data will return two values back to the template, success status and message value
$response = ["success" => false, "message" => "Unknown error"];

if (isset($input['action']) && $input['action'] === 'register') {
    $username = trim($input['username'] ?? '');
    $email = trim($input['email'] ?? '');
    $password = trim($input['password'] ?? '');
    $contact_number = trim($input['contact_number'] ?? '');

    if ($username === '' || $email === '' || $password === '') {
        $response['message'] = "Fields cannot be empty";
    } else {
        $stmt = $pdo->prepare("SELECT user_id FROM agriland_users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $response['message'] = "Username already taken";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO agriland_users (username, email, password, contact_number) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $email, $hash, $contact_number]);

            $response['success'] = true;
            $response['message'] = "Registration successful";
        }
    }
    echo json_encode($response);
    exit;
} 

if (isset($input['action']) && $input['action'] === 'login') {
    $username = trim($input['username'] ?? '');
    $password = trim($input['password'] ?? '');

    if ($username === '' || $password === '') {
        $response['message'] = "Fields cannot be empty";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM agriland_users WHERE username = ?");
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
    }
    echo json_encode($response);
    exit;
} 

if (isset($input['action']) && $input['action'] === 'logout') {
    if (isset($_SESSION['user_id'])) {
        session_destroy();
        $response['success'] = true;
        $response['message'] = "Logout successful";
    } else {
        $response['message'] = "No active session";
    }
    echo json_encode($response);
    exit;
} 

if (isset($input['action']) && $input['action'] === 'getFarmLandJson') {
    $sql = "SELECT * FROM agrilands";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result_set);
    exit;
}

if (isset($input['action']) && $input['action'] === 'getAllUsers') {
    $sql = "SELECT * FROM agriland_users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result_set);
    exit;
}


if (isset($input['action']) && $input['action'] === 'getSingleFarmLandJson') {
    $sql = "SELECT * FROM agrilands WHERE farmland_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$input['farmIDInput']]);
    $result_set = $stmt->fetch();
    echo json_encode(['message'=>'good afternoon', 'phpname' => $input['phpGetVar']]);
    exit;     
}

if (isset($input['action']) && $input['action'] === 'getAllFarmsByUserID') {
    if (!isset($input['userIDInput'])) {
        echo json_encode(['error' => 'Missing userIDInput']);
        exit;
    }
    $sql = "SELECT * FROM agrilands WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$input['userIDInput']]);
    $result_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result_set);
    exit;
}

if (isset($input['action']) && $input['action'] === 'insertFarm') {
    $sql = "INSERT INTO agrilands (farmland_address, location, crop_type, user_id) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $input['farmlandAddressInput'],
        $input['farmlandLocInput'],
        $input['farmlandCropTypeInput'],
        $input['userIDInput']
    ]);
    echo json_encode(['success' => true]);
    exit;
}

if (isset($input['action']) && $input['action'] === 'deleteFarm') {
    $sql = "DELETE FROM agrilands WHERE farmland_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $input['farmland_id']
    ]);
    echo json_encode(['success' => true]);
    exit;
}

if (isset($input['action']) && $input['action'] === 'updateFarm') {
    $sql = "UPDATE agrilands SET farmland_address = ?, location = ?, crop_type = ?
            WHERE farmland_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $input['farmland_address'],
        $input['location'],
        $input['crop_type'],
        $input['farmland_id']
    ]);
    echo json_encode(['success' => true]);
    exit;
}

// Optional: return a helpful error if action is missing or incorrect
echo json_encode(['error' => 'Invalid action']);
exit;
