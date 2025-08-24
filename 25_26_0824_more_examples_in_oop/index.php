<?php
// index.php

require_once 'classes/Post.php';
require_once 'classes/Comment.php';

echo "<h1>CRUD Operations Demonstration</h1>";

try {
    // --- Create instances of Post and Comment ---
    $postManager = new Post();
    $commentManager = new Comment();

    // Ensure database tables exist (you'd typically do this via migrations or a setup script)
    // For demonstration, let's assume 'test_db' exists with 'posts' and 'comments' tables.
    // Example SQL to create tables:
    /*
    CREATE TABLE posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        created_at DATETIME NOT NULL,
        updated_at DATETIME
    );

    CREATE TABLE comments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        post_id INT NOT NULL,
        author VARCHAR(255) NOT NULL,
        comment_text TEXT NOT NULL,
        created_at DATETIME NOT NULL,
        updated_at DATETIME,
        FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
    );
    */

    // --- INSERT a new Post ---
    echo "<h2>1. Inserting New Posts</h2>";
    $postId1 = $postManager->createPost("My First Blog Post", "This is the exciting content of my very first post on this blog!");
    echo "Inserted Post 1 with ID: " . $postId1 . "<br>";

    $postId2 = $postManager->createPost("A Second Thought", "Just some more random thoughts for the second post.");
    echo "Inserted Post 2 with ID: " . $postId2 . "<br>";
    echo "<hr>";

    // --- INSERT new Comments ---
    echo "<h2>2. Inserting New Comments</h2>";
    $commentId1 = $commentManager->createComment($postId1, "Alice", "Great first post!");
    echo "Inserted Comment 1 with ID: " . $commentId1 . " for Post ID " . $postId1 . "<br>";

    $commentId2 = $commentManager->createComment($postId1, "Bob", "I totally agree with Alice!");
    echo "Inserted Comment 2 with ID: " . $commentId2 . " for Post ID " . $postId1 . "<br>";

    $commentId3 = $commentManager->createComment($postId2, "Charlie", "Interesting perspective on your second post.");
    echo "Inserted Comment 3 with ID: " . $commentId3 . " for Post ID " . $postId2 . "<br>";
    echo "<hr>";

    // --- READ all Posts ---
    echo "<h2>3. Reading All Posts</h2>";
    $allPosts = $postManager->getPosts();
    if (!empty($allPosts)) {
        foreach ($allPosts as $post) {
            echo "Post ID: " . $post['id'] . ", Title: " . $post['title'] . "<br>";
            echo "Content: " . substr($post['content'], 0, 50) . "...<br>";
        }
    } else {
        echo "No posts found.<br>";
    }
    echo "<hr>";

    // --- READ Comments for a specific Post ---
    echo "<h2>4. Reading Comments for Post ID {$postId1}</h2>";
    $commentsForPost1 = $commentManager->getCommentsByPostId($postId1);
    if (!empty($commentsForPost1)) {
        foreach ($commentsForPost1 as $comment) {
            echo "Comment ID: " . $comment['id'] . ", Author: " . $comment['author'] . ", Text: " . $comment['comment_text'] . "<br>";
        }
    } else {
        echo "No comments found for Post ID {$postId1}.<br>";
    }
    echo "<hr>";

    // --- UPDATE a Post ---
    echo "<h2>5. Updating Post ID {$postId1}</h2>";
    $updatedRowsPost = $postManager->updatePost($postId1, "My Updated First Post", "This content has been updated and is even more exciting now!");
    echo "Updated " . $updatedRowsPost . " row(s) for Post ID " . $postId1 . ".<br>";
    $updatedPost = $postManager->getPostById($postId1);
    echo "New Title: " . $updatedPost['title'] . ", New Content: " . substr($updatedPost['content'], 0, 50) . "...<br>";
    echo "<hr>";

    // --- UPDATE a Comment ---
    echo "<h2>6. Updating Comment ID {$commentId2}</h2>";
    $updatedRowsComment = $commentManager->updateComment($commentId2, "I still agree with Alice, but more enthusiastically!");
    echo "Updated " . $updatedRowsComment . " row(s) for Comment ID " . $commentId2 . ".<br>";
    $updatedComment = $commentManager->getCommentById($commentId2);
    echo "New Comment Text: " . $updatedComment['comment_text'] . "<br>";
    echo "<hr>";

    // --- DELETE a Comment ---
    echo "<h2>7. Deleting Comment ID {$commentId3}</h2>";
    $deletedRowsComment = $commentManager->deleteComment($commentId3);
    echo "Deleted " . $deletedRowsComment . " row(s) for Comment ID " . $commentId3 . ".<br>";
    $remainingCommentsForPost2 = $commentManager->getCommentsByPostId($postId2);
    if (empty($remainingCommentsForPost2)) {
        echo "No comments remaining for Post ID " . $postId2 . " after deletion.<br>";
    }
    echo "<hr>";

    // --- DELETE a Post ---
    echo "<h2>8. Deleting Post ID {$postId2}</h2>";
    $deletedRowsPost = $postManager->deletePost($postId2);
    echo "Deleted " . $deletedRowsPost . " row(s) for Post ID " . $postId2 . ".<br>";
    $deletedPostCheck = $postManager->getPostById($postId2);
    if (!$deletedPostCheck) {
        echo "Post ID " . $postId2 . " successfully deleted.<br>";
    }
    echo "<hr>";

    echo "<p>Demonstration Complete!</p>";

} catch (PDOException $e) {
    echo "<h2>Database Error!</h2>";
    echo "Error: " . $e->getMessage() . "<br>";
    echo "Please ensure your 'test_db' database and 'posts'/'comments' tables are set up correctly and your `db_config.php` has the right credentials.";
} catch (Exception $e) {
    echo "<h2>Application Error!</h2>";
    echo "Error: " . $e->getMessage() . "<br>";
}

?>