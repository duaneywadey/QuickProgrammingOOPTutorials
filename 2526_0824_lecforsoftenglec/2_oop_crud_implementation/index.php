<?php
// index.php

require_once 'classes/Post.php';
require_once 'classes/Comment.php';

echo "<h1>CRUD Operations Demonstration</h1>";

$postManager = new Post();
$commentManager = new Comment();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      input {
        padding: 20px;
      }
      table, th, td {
          border:1px solid black;
      }
      body {
        font-family: "Arial";
      }
    </style>
</head>
<body>
    <h1>All Posts</h1>
    <h3>Add new post</h3>
    <form action="handleforms.php" method="POST">
        <p>
            <label for="description">Description</label>
            <input type="text" name="description">
        </p>
        <p>
            <label for="description">User ID</label>
            <input type="text" name="user_id"><br>
        </p>
        <input type="submit" name="insertPostBtn"><br>
    </form>
    <table style="width:100%">
      <tr>
        <th>ID</th>
        <th>Description</th>
        <th>User ID</th>
        <th>Date Added</th>
        <th>Last Updated</th>
        <th>Action</th>
    </tr>

    <?php $allPosts = $postManager->getPosts();?>
    <?php foreach ($allPosts as $post) { ?>
        <tr>
            <td><?php echo $post['id'];?></td>
            <td><?php echo $post['description'];?></td>
            <td><?php echo $post['user_id'];?></td>
            <td><?php echo $post['date_added'];?></td>
            <td><?php echo $post['last_updated'];?></td>
            <td>
                <a href="edit.php?post_id=<?php echo $post['id']; ?>">Edit</a>
                <a href="delete.php?post_id=<?php echo $post['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
</body>
</html>