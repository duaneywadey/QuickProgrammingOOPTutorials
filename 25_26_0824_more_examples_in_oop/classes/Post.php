<?php
// classes/Post.php

require_once 'Database.php';

class Post extends Database {
    protected $table = 'posts';

    public function createPost($title, $content) {
        $data = [
            'title' => $title,
            'content' => $content,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->insert($this->table, $data);
    }

    public function getPosts() {
        return $this->selectAll($this->table);
    }

    public function getPostById($id) {
        return $this->selectOne($this->table, 'id = :id', ['id' => $id]);
    }

    public function updatePost($id, $title, $content) {
        $data = [
            'title' => $title,
            'content' => $content,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        return $this->update($this->table, $data, 'id = :id', ['id' => $id]);
    }

    public function deletePost($id) {
        return $this->delete($this->table, 'id = :id', ['id' => $id]);
    }
}