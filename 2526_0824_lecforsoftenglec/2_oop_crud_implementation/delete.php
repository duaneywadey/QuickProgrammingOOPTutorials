<?php
// index.php

require_once 'classes/Post.php';
require_once 'classes/Comment.php';

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
    <h1>Delete the record</h1>
    <h3 style="color: red;">Are you sure you want to delete the record?</h3>
    <a href="index.php">Return to home</a>
    <table style="width:100%">
      <tr>
        <th>ID</th>
        <th>Description</th>
        <th>User ID</th>
        <th>Date Added</th>
        <th>Last Updated</th>
        <th>Action</th>
    </tr>

    <?php $singlePost = $postManager->getPostById($_GET['post_id']); ?>
    <tr>
        <td><?php echo $singlePost['id'];?></td>
        <form action="handleforms.php" method="POST">
            <td>
                <?php echo $singlePost['description'];?>   
            </td> 
            <td>
                <?php echo $singlePost['user_id'];?>    
            </td>
            <td><?php echo $singlePost['date_added'];?></td>
            <td><?php echo $singlePost['last_updated'];?></td>
            <td>
                <input type="hidden" value="<?php echo $singlePost['id'];?>" name="post_id">
                <input type="submit" value="Delete" name="deletePostBtn">
            </td>
        </form>
    </tr>
</body>
</html>