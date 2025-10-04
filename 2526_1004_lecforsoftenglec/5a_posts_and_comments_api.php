<?php
header('Content-Type: application/json');

// Database connection parameters (adjust accordingly)
$host = 'localhost';
$dbname = 'mockdb';
$username = 'root';
$password = '';

// Connect to database using PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to get posts with their comments
    $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY date_added DESC");
    $stmt->execute();  // execute before fetch
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($posts as &$post) {
        $stmt = $pdo->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY date_added DESC");
        $stmt->execute([$post['id']]);
        $post['comments'] = $stmt->fetchAll();
    }

    echo json_encode($posts);

    // // Build structured array: each post with nested comments
    // $posts = [];
    // foreach ($rows as $row) {
    //     $postId = $row['post_id'];
    //     if (!isset($posts[$postId])) {
    //         $posts[$postId] = [
    //             'id' => $postId,
    //             'description' => $row['post_description'],
    //             'user_id' => $row['post_user_id'],
    //             'date_added' => $row['post_date_added'],
    //             'last_updated' => $row['post_last_updated'],
    //             'comments' => []
    //         ];
    //     }
    //     if ($row['comment_id']) {
    //         $posts[$postId]['comments'][] = [
    //             'id' => $row['comment_id'],
    //             'description' => $row['comment_description'],
    //             'user_id' => $row['comment_user_id'],
    //             'date_added' => $row['comment_date_added'],
    //             'last_updated' => $row['comment_last_updated']
    //         ];
    //     }
    // }

    // // Return JSON array (reset keys)
    // echo json_encode(array_values($posts), JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
