<?php
// /models/Contact.php

include_once "../config/database.php";

class Contact {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllComments() {
        $query = "SELECT * FROM contact";
        $result = $this->conn->query($query);

        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        return $comments;
    }

    public function addComment($name, $email, $message) {
        $query = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";
        return $this->conn->query($query);
    }

    public function updateComment($id, $name, $email, $message) {
        $query = "UPDATE contact SET name = '$name', email = '$email', message = '$message' WHERE id = $id";
        return $this->conn->query($query);
    }

    public function deleteComment($id) {
        $query = "DELETE FROM contact WHERE id = $id";
        return $this->conn->query($query);
    }
}
?>
