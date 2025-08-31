<?php 

require_once 'Article.php';

$article = new Article();

// Article class functions
$newArticleId = $article->createArticle("Sample Title", "Article content here", 1);
echo "Created Article ID: $newArticleId\n";

print_r($article->getArticles());         // Get all articles
print_r($article->getArticles($newArticleId));  // Get article by ID

echo "Updated articles: " . $article->updateArticle($newArticleId, "New Title", "Updated content") . "\n";

echo "Visibility update: " . $article->updateArticleVisibility($newArticleId, true) . "\n";
?>