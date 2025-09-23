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

if ($method === 'GET') {
    // Fetch posts with comments
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($posts as &$post) {
        $stmt = $pdo->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at ASC");
        $stmt->execute([$post['id']]);
        $post['comments'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    echo json_encode($posts);
    exit;
}

if ($method === 'POST') {
    // Support JSON input or form data fallback
    $data = $input ? $input : $_POST;
    $type = $data['type'] ?? '';
    $content = trim($data['content'] ?? '');

    if ($type === 'post' && $content !== '') {
        $stmt = $pdo->prepare("INSERT INTO posts (content) VALUES (?)");
        $stmt->execute([$content]);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        exit;
    } 

    elseif ($type === 'comment' && isset($data['post_id']) && $content !== '') {
        $stmt = $pdo->prepare("INSERT INTO comments (post_id, content) VALUES (?, ?)");
        $stmt->execute([$data['post_id'], $content]);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        exit;
    }

    http_response_code(400);
    echo json_encode(['error' => 'Invalid parameters']);
    exit;
}

if ($method === 'PUT') {
    if (!$input) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input']);
        exit;
    }
    $type = $input['type'] ?? '';
    $id = $input['id'] ?? 0;
    $content = trim($input['content'] ?? '');
    
    if ($type === 'post' && $id && $content !== '') {
        $stmt = $pdo->prepare("UPDATE posts SET content = ? WHERE id = ?");
        $stmt->execute([$content, $id]);
        echo json_encode(['success' => true]);
        exit;
    }

    elseif ($type === 'comment' && $id && $content !== '') {
        $stmt = $pdo->prepare("UPDATE comments SET content = ? WHERE id = ?");
        $stmt->execute([$content, $id]);
        echo json_encode(['success' => true]);
        exit;
    }
    http_response_code(400);
    echo json_encode(['error' => 'Invalid parameters']);
    exit;
}

if ($method === 'DELETE') {
    if (!$input) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input']);
        exit;
    }
    $type = $input['type'] ?? '';
    $id = $input['id'] ?? 0;
    if ($type === 'post' && $id) {
        $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
        exit;
    } 

    elseif ($type === 'comment' && $id) {
        $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
        exit;
    }
    http_response_code(400);
    echo json_encode(['error' => 'Invalid parameters']);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Method not allowed']);
exit;
