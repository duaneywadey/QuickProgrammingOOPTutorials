<?php
header('Content-Type: application/json');

// Database connection setup - please update with your actual DB credentials
$host = 'localhost';
$dbname = 'mockdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to select all posts
    $sql = "SELECT id, description, user_id, date_added, last_updated FROM posts LIMIT 5";
    $stmt = $pdo->query($sql);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output raw JSON data
    echo json_encode($posts);

} catch (PDOException $e) {
    echo json_encode([
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
