<?php  

require_once 'classes/Post.php';
require_once 'classes/Comment.php';

echo "<h1>CRUD Operations Demonstration</h1>";

$postManager = new Post();
$commentManager = new Comment();

if (isset($_POST['insertPostBtn'])) {
    $description = $_POST['description'];
    $user_id = $_POST['user_id'];
    $savePost = $postManager->createPost($description, $user_id);
    if ($savePost) {
        header("Location: index.php");
    }
    else {
        echo "Error occured with the query!";
    }
}

if (isset($_POST['editPostBtn'])) {
    $description = $_POST['description'];
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    $editPost = $postManager->updatePost($post_id, $description, $user_id);
    if ($editPost) {
        header("Location: index.php");
    }
    else {
        echo "Error occured with the query!";
    }
}

if (isset($_POST['deletePostBtn'])) {
    $post_id = $_POST['post_id'];
    $deletePost = $postManager->deletePost($post_id);
    if ($deletePost) {
        header("Location: index.php");
    }
    else {
        echo "Error occured with the query!";
    }
}

?>