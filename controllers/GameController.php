<?php
// /controllers/GameController.php

include_once "../models/Game.php";
include_once "../config/database.php";

class GameController {
    private $game;

    public function __construct($db) {
        $this->game = new Game($db);
    }

    public function getGames() {
        return json_encode($this->game->getAllGames());
    }

    public function createGame($data) {
        if ($this->game->addGame($data['name'], $data['description'])) {
            return json_encode(["message" => "Game added successfully"]);
        }
        return json_encode(["error" => "Failed to add game"]);
    }

    public function updateGame($data, $id) {
        if ($this->game->updateGame($id, $data['name'], $data['description'])) {
            return json_encode(["message" => "Game updated successfully"]);
        }
        return json_encode(["error" => "Failed to update game"]);
    }

    public function deleteGame($id) {
        if ($this->game->deleteGame($id)) {
            return json_encode(["message" => "Game deleted successfully"]);
        }
        return json_encode(["error" => "Failed to delete game"]);
    }
}
?>
