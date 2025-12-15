<?php
// students.php
header('Content-Type: application/json');
$dsn = 'mysql:host=localhost;dbname=mockdb;charset=utf8mb4';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo json_encode(['success'=>false, 'message'=>'Database connection failed']);
    exit;
}

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'list':
        $stmt = $pdo->query("SELECT * FROM students ORDER BY id");
        $students = $stmt->fetchAll();
        echo json_encode($students);
        break;

    case 'add':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!empty($data['name']) && !empty($data['age']) && !empty($data['email'])) {
            $stmt = $pdo->prepare("INSERT INTO students (name, age, email) VALUES (?, ?, ?)");
            $success = $stmt->execute([$data['name'], $data['age'], $data['email']]);
            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['success' => false, 'message'=>'Invalid input']);
        }
        break;

    case 'edit':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!empty($data['id']) && !empty($data['name']) && !empty($data['age']) && !empty($data['email'])) {
            $stmt = $pdo->prepare("UPDATE students SET name = ?, age = ?, email = ? WHERE id = ?");
            $success = $stmt->execute([$data['name'], $data['age'], $data['email'], $data['id']]);
            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['success' => false, 'message'=>'Invalid input']);
        }
        break;

    case 'delete':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!empty($data['id'])) {
            $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
            $success = $stmt->execute([$data['id']]);
            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['success' => false, 'message'=>'Invalid ID']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}
