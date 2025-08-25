<?php
// classes/Comment.php

require_once 'Database.php';

class Comment extends Database {
    protected $table = 'comments';

    public function createComment($postId, $author, $commentText) {
        $data = [
            'post_id' => $postId,
            'author' => $author,
            'comment_text' => $commentText,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->insert($this->table, $data);
    }

    public function getCommentsByPostId($postId) {
        return $this->selectAll($this->table, 'post_id = :post_id', ['post_id' => $postId]);
    }

    public function getCommentById($id) {
        return $this->selectOne($this->table, 'id = :id', ['id' => $id]);
    }

    public function updateComment($id, $commentText) {
        $data = [
            'comment_text' => $commentText,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        return $this->update($this->table, $data, 'id = :id', ['id' => $id]);
    }

    public function deleteComment($id) {
        return $this->delete($this->table, 'id = :id', ['id' => $id]);
    }
}