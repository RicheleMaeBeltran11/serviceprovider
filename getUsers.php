<?php
header("Content-Type: application/json");
include "connectdb.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $result = $conn->query("SELECT id, eMail, mobileNumber FROM userAccounts");

    if ($result) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        echo json_encode([
            "status" => "success",
            "data" => $users
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to fetch users"
        ]);
    }

    $conn->close();

} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid Request Method"
    ]);
}
?>
