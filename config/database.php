<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "fansite4";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

