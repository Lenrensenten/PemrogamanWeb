<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include_once "../controllers/GameController.php";
include_once "../controllers/ContactController.php";
include_once "../config/database.php";

$method = $_SERVER['REQUEST_METHOD'];
$db = $conn; 

$gameController = new GameController($db);
$contactController = new ContactController($db);

switch ($method) {
    case 'GET':
        if (isset($_GET['table']) && $_GET['table'] === 'games') {
            echo $gameController->getGames();
        } elseif (isset($_GET['table']) && $_GET['table'] === 'comments') {
            echo $contactController->getComments();
        } else {
            echo json_encode(["error" => "Table not found"]);
        }
        break;
    
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($_GET['table']) && $_GET['table'] === 'games') {
            echo $gameController->createGame($data);
        } elseif (isset($_GET['table']) && $_GET['table'] === 'comments') {
            echo $contactController->createComment($data);
        } else {
            echo json_encode(["error" => "Invalid table"]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($_GET['table']) && $_GET['table'] === 'games' && isset($_GET['id'])) {
            echo $gameController->updateGame($data, $_GET['id']);
        } elseif (isset($_GET['table']) && $_GET['table'] === 'comments' && isset($_GET['id'])) {
            echo $contactController->updateComment($data, $_GET['id']);
        } else {
            echo json_encode(["error" => "Invalid table or ID"]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['table']) && $_GET['table'] === 'games' && isset($_GET['id'])) {
            echo $gameController->deleteGame($_GET['id']);
        } elseif (isset($_GET['table']) && $_GET['table'] === 'comments' && isset($_GET['id'])) {
            echo $contactController->deleteComment($_GET['id']);
        } else {
            echo json_encode(["error" => "Invalid table or ID"]);
        }
        break;
}

$conn->close();
?>
