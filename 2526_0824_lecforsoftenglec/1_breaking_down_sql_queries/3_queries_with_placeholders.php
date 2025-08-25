<?php  
// Prepare the SQL INSERT statement with named placeholders
$sql = "INSERT INTO posts 
        (description, user_id, date_added, last_updated) 
        VALUES (:description, :user_id, :date_added, :last_updated)";
$stmt = $pdo->prepare($sql);

    // Data to be inserted
$description = 'This is a sample description.';
$userId = 123;
$dateAdded = date('Y-m-d H:i:s');
$lastUpdated = date('Y-m-d H:i:s');

    // Bind the parameters to the placeholders
$stmt->bindParam(':description', $description, PDO::PARAM_STR);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->bindParam(':date_added', $dateAdded, PDO::PARAM_STR);
$stmt->bindParam(':last_updated', $lastUpdated, PDO::PARAM_STR);

    // Execute the prepared statement
$stmt->execute();

?>

<?php
try {
    // Assume $pdo is an active PDO connection
    $postId = 1;

    // Prepare the SQL SELECT statement with a named placeholder
    $sql = "SELECT id, description, user_id FROM posts WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Bind the parameter
    $stmt->bindParam(':id', $postId, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Fetch the single row result
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($post) {
        echo "Post Found! <br>";
        echo "ID: " . htmlspecialchars($post['id']) . "<br>";
        echo "Description: " . htmlspecialchars($post['description']) . "<br>";
        echo "User ID: " . htmlspecialchars($post['user_id']) . "<br>";
    } else {
        echo "No post found with ID: " . htmlspecialchars($postId);
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<?php
try {
    // Assume $pdo is an active PDO connection
    $postId = 1;
    $newDescription = 'This is the new updated description.';
    $lastUpdated = date('Y-m-d H:i:s');

    // Prepare the SQL UPDATE statement with named placeholders
    $sql = "UPDATE posts 
            SET description = :description, 
            last_updated = :last_updated 
            WHERE id = :id";
            
    $stmt = $pdo->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':description', $newDescription, PDO::PARAM_STR);
    $stmt->bindParam(':last_updated', $lastUpdated, PDO::PARAM_STR);
    $stmt->bindParam(':id', $postId, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Check the number of affected rows
    if ($stmt->rowCount() > 0) {
        echo "Record updated successfully! ✅";
    } else {
        echo "No records were updated. Post ID may not exist.";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<?php
try {
    // Assume $pdo is an active PDO connection
    $postIdToDelete = 1;

    // Prepare the SQL DELETE statement with a named placeholder
    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Bind the parameter
    $stmt->bindParam(':id', $postIdToDelete, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Check the number of affected rows
    if ($stmt->rowCount() > 0) {
        echo "Record deleted successfully! 🗑️";
    } else {
        echo "No records were deleted. Post ID may not exist.";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>