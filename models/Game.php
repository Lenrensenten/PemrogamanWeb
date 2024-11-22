<?php
// /models/Game.php

include_once "../config/database.php";

class Game {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllGames() {
        $query = "SELECT * FROM fansite4";
        $result = $this->conn->query($query);

        $games = [];
        while ($row = $result->fetch_assoc()) {
            $games[] = $row;
        }
        return $games;
    }

    public function addGame($name, $description) {
        $query = "INSERT INTO fansite4 (name, description) VALUES ('$name', '$description')";
        return $this->conn->query($query);
    }

    public function updateGame($id, $name, $description) {
        $query = "UPDATE fansite4 SET name = '$name', description = '$description' WHERE id = $id";
        return $this->conn->query($query);
    }

    public function deleteGame($id) {
        $query = "DELETE FROM fansite4 WHERE id = $id";
        return $this->conn->query($query);
    }
}
?>
