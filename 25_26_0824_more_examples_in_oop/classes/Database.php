<?php
// classes/Database.php

class Database {
    protected $pdo;

    public function __construct() {
        require_once __DIR__ . '/../config/db_config.php'; // Adjust path if needed

        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
            // echo "Database connected successfully!<br>"; // For debugging
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Inserts a new record into the specified table.
     *
     * @param string $table The name of the table.
     * @param array $data An associative array of column-value pairs.
     * @return int The ID of the last inserted row.
     */
    public function insert($table, $data) {
        $keys = array_keys($data);
        $fields = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);

        $sql = "INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})";
        $stmt = $this->pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmt->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Updates an existing record in the specified table.
     *
     * @param string $table The name of the table.
     * @param array $data An associative array of column-value pairs to update.
     * @param string $where The WHERE clause for the update (e.g., 'id = :id').
     * @param array $whereParams An associative array of parameters for the WHERE clause.
     * @return int The number of affected rows.
     */
    public function update($table, $data, $where, $whereParams = []) {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "{$key} = :{$key}";
        }
        $set = implode(', ', $set);

        $sql = "UPDATE {$table} SET {$set} WHERE {$where}";
        $stmt = $this->pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        foreach ($whereParams as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * Deletes records from the specified table.
     *
     * @param string $table The name of the table.
     * @param string $where The WHERE clause for the delete (e.g., 'id = :id').
     * @param array $whereParams An associative array of parameters for the WHERE clause.
     * @return int The number of affected rows.
     */
    public function delete($table, $where, $whereParams = []) {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        $stmt = $this->pdo->prepare($sql);

        foreach ($whereParams as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * Fetches all records from a table based on an optional WHERE clause.
     *
     * @param string $table The name of the table.
     * @param string $where An optional WHERE clause.
     * @param array $params Optional parameters for the WHERE clause.
     * @return array An array of associative arrays representing the fetched rows.
     */
    public function selectAll($table, $where = '', $params = []) {
        $sql = "SELECT * FROM {$table}";
        if (!empty($where)) {
            $sql .= " WHERE {$where}";
        }
        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Fetches a single record from a table based on an optional WHERE clause.
     *
     * @param string $table The name of the table.
     * @param string $where An optional WHERE clause.
     * @param array $params Optional parameters for the WHERE clause.
     * @return array|false An associative array representing the fetched row, or false if not found.
     */
    public function selectOne($table, $where = '', $params = []) {
        $sql = "SELECT * FROM {$table}";
        if (!empty($where)) {
            $sql .= " WHERE {$where}";
        }
        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmt->execute();
        return $stmt->fetch();
    }
}