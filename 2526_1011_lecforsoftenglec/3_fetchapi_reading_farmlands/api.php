<?php
header('Content-Type: application/json');

// Setup PDO connection (adjust parameters)
$dsn = 'mysql:host=localhost;dbname=mockdb;charset=utf8mb4';
$username = 'root';
$password = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Read JSON input
$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';

switch ($action) {
    case 'create':
        $farm = $input['farm'];
        $stmt = $pdo->prepare('INSERT INTO agrilands (farm_name, location, crop_type, owner) VALUES (?, ?, ?, ?)');
        $success = $stmt->execute([
            $farm['farm_name'],
            $farm['location'],
            $farm['crop_type'],
            $farm['owner']
        ]);
        echo json_encode(['success' => $success]);
        break;

    case 'read':
        $search = '%' . ($input['search'] ?? '') . '%';
        $stmt = $pdo->prepare('SELECT * FROM agrilands WHERE farm_name LIKE ? OR location LIKE ? OR crop_type LIKE ? OR owner LIKE ? ORDER BY date_added DESC');
        $stmt->execute([$search, $search, $search, $search]);
        $farms = $stmt->fetchAll();
        echo json_encode(['success' => true, 'data' => $farms]);
        break;

    case 'update':
        $farm = $input['farm'];
        $stmt = $pdo->prepare('UPDATE agrilands SET farm_name = ?, location = ?, crop_type = ?, owner = ? WHERE farmland_id = ?');
        $success = $stmt->execute([
            $farm['farm_name'],
            $farm['location'],
            $farm['crop_type'],
            $farm['owner'],
            $farm['farmland_id']
        ]);
        echo json_encode(['success' => $success]);
        break;

    case 'delete':
        $farmland_id = $input['farmland_id'] ?? 0;
        $stmt = $pdo->prepare('DELETE FROM agrilands WHERE farmland_id = ?');
        $success = $stmt->execute([$farmland_id]);
        echo json_encode(['success' => $success]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}
