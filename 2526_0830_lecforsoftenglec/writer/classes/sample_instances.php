<?php 

require_once 'Article.php';

$user = new User();

// User class functions
$user->startSession();

echo $user->usernameExists("johndoe") ? "Exists\n" : "Available\n";

if ($user->registerUser("johndoemew", "john@example.com", "pass123")) {
    echo "User registered\n";
} else {
    echo "Registration failed\n";
}

if ($user->loginUser("john@example.com", "pass123")) {
    echo "User logged in\n";
}

echo $user->isLoggedIn() ? "User is logged in\n" : "Not logged in\n";
echo $user->isAdmin() ? "User is admin\n" : "User is not admin\n";

$user->logout();
echo "User logged out\n";

print_r($user->getUsers());          // Get all users
print_r($user->getUsers(1));         // Get user by ID

echo "Updated rows: " . $user->updateUser(1, "john_updated", "john@newmail.com", true) . "\n";

// Article class functions
$newArticleId = $article->createArticle("Sample Title", "Article content here", 1);
echo "Created Article ID: $newArticleId\n";

print_r($article->getArticles());         // Get all articles
print_r($article->getArticles($newArticleId));  // Get article by ID

echo "Updated articles: " . $article->updateArticle($newArticleId, "New Title", "Updated content") . "\n";

echo "Visibility update: " . $article->updateArticleVisibility($newArticleId, true) . "\n";
?>