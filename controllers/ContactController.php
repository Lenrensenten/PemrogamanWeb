<?php
// /controllers/ContactController.php

include_once "../models/Contact.php";
include_once "../config/database.php";

class ContactController {
    private $contact;

    public function __construct($db) {
        $this->contact = new Contact($db);
    }

    public function getComments() {
        return json_encode($this->contact->getAllComments());
    }

    public function createComment($data) {
        if ($this->contact->addComment($data['name'], $data['email'], $data['message'])) {
            return json_encode(["message" => "Comment added successfully"]);
        }
        return json_encode(["error" => "Failed to add comment"]);
    }

    public function updateComment($data, $id) {
        if ($this->contact->updateComment($id, $data['name'], $data['email'], $data['message'])) {
            return json_encode(["message" => "Comment updated successfully"]);
        }
        return json_encode(["error" => "Failed to update comment"]);
    }

    public function deleteComment($id) {
        if ($this->contact->deleteComment($id)) {
            return json_encode(["message" => "Comment deleted successfully"]);
        }
        return json_encode(["error" => "Failed to delete comment"]);
    }
}
?>
