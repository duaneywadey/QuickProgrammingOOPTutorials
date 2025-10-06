<?php
header('Content-Type: application/json');
$host = 'localhost';
$db   = 'mockdb';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

$action = $_GET['action'] ?? '';

if ($action === 'list') {
    $search = $_GET['search'] ?? '';
    $sql = "SELECT * FROM students WHERE name LIKE ? OR email LIKE ? ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $like = "%$search%";
    $stmt->execute([$like, $like]);
    $students = $stmt->fetchAll();
    echo json_encode($students);
    exit;
}

if ($action === 'insert') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['name']) || empty($data['email'])) {
        echo json_encode(['error' => 'Name and Email are required']);
        exit;
    }
    $sql = "INSERT INTO students (name, email) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([$data['name'], $data['email']]);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}

if ($action === 'update') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['id']) || empty($data['name']) || empty($data['email'])) {
        echo json_encode(['error' => 'ID, Name and Email are required']);
        exit;
    }
    $sql = "UPDATE students SET name = ?, email = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([$data['name'], $data['email'], $data['id']]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}

if ($action === 'delete') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['id'])) {
        echo json_encode(['error' => 'ID is required']);
        exit;
    }
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([$data['id']]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}

echo json_encode(['error' => 'Invalid action']);
