<?php

// Database connection details
$dsn = 'mysql:host=localhost;dbname=mockdb;charset=utf8';
$username = 'root';
$password= '';

try {
    // Connect to the database
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL INSERT statement with named placeholders
    $sql = "INSERT INTO posts (description, user_id, date_added, last_updated) 
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

    echo "New record created successfully! ";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>