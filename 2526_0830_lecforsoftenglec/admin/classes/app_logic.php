<?php

// A simple function to display a message on the console for debugging
function console_log($data) {
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}

/**
 * Superclass for handling all database connections and queries.
 * Uses PDO for secure database interactions.
 */
class Database {
    protected $pdo;
    private $host = 'localhost';
    private $db = 'your_database_name';
    private $user = 'your_database_user';
    private $pass = 'your_database_password';
    private $charset = 'utf8mb4';

    /**
     * Constructor establishes the PDO connection.
     */
    public function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Executes a prepared statement and returns the result.
     * @param string $sql The SQL query to execute.
     * @param array $params The parameters to bind to the query.
     * @return array The fetched data.
     */
    protected function executeQuery($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Executes a prepared statement and returns a single row.
     * @param string $sql The SQL query to execute.
     * @param array $params The parameters to bind to the query.
     * @return array|null The single fetched row, or null if not found.
     */
    protected function executeQuerySingle($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }

    /**
     * Executes a non-query statement (INSERT, UPDATE, DELETE).
     * @param string $sql The SQL query to execute.
     * @param array $params The parameters to bind to the query.
     * @return int The number of affected rows.
     */
    protected function executeNonQuery($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    /**
     * Returns the ID of the last inserted row.
     * @return string
     */
    protected function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
}

/**
 * Class for handling User-related operations.
 * Inherits CRUD methods from the Database class.
 */
class User extends Database {

    /**
     * Starts a new session if one isn't already active.
     */
    public function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Registers a new user.
     * @param string $username The user's username.
     * @param string $email The user's email.
     * @param string $password The user's password.
     * @param bool $is_admin Whether the user is an admin.
     * @return bool True on success, false on failure.
     */
    public function registerUser($username, $email, $password, $is_admin = false) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password, is_admin) VALUES (?, ?, ?, ?)";
        try {
            $this->executeNonQuery($sql, [$username, $email, $hashed_password, (int)$is_admin]);
            return true;
        } catch (\PDOException $e) {
            console_log("Registration failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Logs in a user by verifying credentials.
     * @param string $email The user's email.
     * @param string $password The user's password.
     * @return bool True on success, false on failure.
     */
    public function loginUser($email, $password) {
        $sql = "SELECT id, username, password, is_admin FROM users WHERE email = ?";
        $user = $this->executeQuerySingle($sql, [$email]);

        if ($user && password_verify($password, $user['password'])) {
            $this->startSession();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = (bool)$user['is_admin'];
            return true;
        }
        return false;
    }

    /**
     * Checks if a user is currently logged in.
     * @return bool
     */
    public function isLoggedIn() {
        $this->startSession();
        return isset($_SESSION['user_id']);
    }

    /**
     * Checks if the logged-in user is an admin.
     * @return bool
     */
    public function isAdmin() {
        $this->startSession();
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
    }

    /**
     * Logs out the current user.
     */
    public function logout() {
        $this->startSession();
        session_unset();
        session_destroy();
    }

    /**
     * Retrieves users from the database.
     * @param int|null $id The user ID to retrieve, or null for all users.
     * @return array
     */
    public function getUsers($id = null) {
        if ($id) {
            $sql = "SELECT id, username, email, is_admin FROM users WHERE id = ?";
            return $this->executeQuerySingle($sql, [$id]);
        }
        $sql = "SELECT id, username, email, is_admin FROM users";
        return $this->executeQuery($sql);
    }

    /**
     * Updates a user's information.
     * @param int $id The user ID to update.
     * @param string $username The new username.
     * @param string $email The new email.
     * @param bool $is_admin The new admin status.
     * @return int The number of affected rows.
     */
    public function updateUser($id, $username, $email, $is_admin) {
        $sql = "UPDATE users SET username = ?, email = ?, is_admin = ? WHERE id = ?";
        return $this->executeNonQuery($sql, [$username, $email, (int)$is_admin, $id]);
    }

    /**
     * Deletes a user.
     * @param int $id The user ID to delete.
     * @return int The number of affected rows.
     */
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        return $this->executeNonQuery($sql, [$id]);
    }
}

/**
 * Class for handling Article-related operations.
 * Inherits CRUD methods from the Database class.
 */
class Article extends Database {
    /**
     * Creates a new article.
     * @param string $title The article title.
     * @param string $content The article content.
     * @param int $author_id The ID of the author.
     * @return int The ID of the newly created article.
     */
    public function createArticle($title, $content, $author_id) {
        $sql = "INSERT INTO articles (title, content, author_id, is_active) VALUES (?, ?, ?, 0)";
        $this->executeNonQuery($sql, [$title, $content, $author_id]);
        return $this->lastInsertId();
    }

    /**
     * Retrieves articles from the database.
     * @param int|null $id The article ID to retrieve, or null for all articles.
     * @return array
     */
    public function getArticles($id = null) {
        if ($id) {
            $sql = "SELECT * FROM articles WHERE id = ?";
            return $this->executeQuerySingle($sql, [$id]);
        }
        $sql = "SELECT * FROM articles";
        return $this->executeQuery($sql);
    }

    /**
     * Updates an article.
     * @param int $id The article ID to update.
     * @param string $title The new title.
     * @param string $content The new content.
     * @return int The number of affected rows.
     */
    public function updateArticle($id, $title, $content) {
        $sql = "UPDATE articles SET title = ?, content = ? WHERE id = ?";
        return $this->executeNonQuery($sql, [$title, $content, $id]);
    }
    
    /**
     * Toggles the visibility (is_active status) of an article.
     * This operation is restricted to admin users only.
     * @param int $id The article ID to update.
     * @param bool $is_active The new visibility status.
     * @return int The number of affected rows.
     */
    public function updateArticleVisibility($id, $is_active) {
        $userModel = new User();
        if (!$userModel->isAdmin()) {
            console_log("Permission denied. Only an admin can update article visibility.");
            return 0;
        }
        $sql = "UPDATE articles SET is_active = ? WHERE id = ?";
        return $this->executeNonQuery($sql, [(int)$is_active, $id]);
    }

    /**
     * Deletes an article.
     * @param int $id The article ID to delete.
     * @return int The number of affected rows.
     */
    public function deleteArticle($id) {
        $sql = "DELETE FROM articles WHERE id = ?";
        return $this->executeNonQuery($sql, [$id]);
    }
}

?>


