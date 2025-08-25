<?php  

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
}
public function delete($table, $where, $whereParams = []) {
    $sql = "DELETE FROM {$table} WHERE {$where}";
    $stmt = $this->pdo->prepare($sql);

    foreach ($whereParams as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
    }

    $stmt->execute();
    return $stmt->rowCount();
}
?>