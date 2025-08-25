<?php
// classes/Post.php

require_once 'Database.php';

class Post extends Database {
    protected $table = 'posts';

    public function createPost($description, $user_id) {
        $data = [
            'description' => $description,
            'user_id' => $user_id,
            'date_added' => date('Y-m-d H:i:s')
        ];
        return $this->insert($this->table, $data);
    }

    public function getPosts() {
        return $this->selectAll($this->table);
    }

    public function getPostById($id) {
        return $this->selectOne($this->table, 'id = :id', ['id' => $id]);
    }

    public function updatePost($id, $description, $user_id) {
        $data = [
            'description' => $description,
            'user_id' => $user_id,
            'last_updated' => date('Y-m-d H:i:s')
        ];
        return $this->update($this->table, $data, 'id = :id', ['id' => $id]);
    }

    public function deletePost($id) {
        return $this->delete($this->table, 'id = :id', ['id' => $id]);
    }
}