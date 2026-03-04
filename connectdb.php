<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "serviceProvider";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Database Connection Failed"
    ]));
}
?>
