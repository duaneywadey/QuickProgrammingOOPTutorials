<?php
header('Content-Type: application/json');

$dsn = 'mysql:host=localhost;dbname=mockdb;charset=utf8mb4';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

// Read raw input and decode JSON
$input = json_decode(file_get_contents("php://input"), true);

$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as &$post) {
    $stmt = $pdo->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at ASC");
    $stmt->execute([$post['id']]);
    $post['comments'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

echo "<pre>";
print_r($posts);
echo "<pre>";
