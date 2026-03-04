<?php
header("Content-Type: application/json");
include "connectdb.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $emailOrMobile = $_POST['eMail'] ?? ''; // can be email or mobile
    $password = $_POST['passwd'] ?? '';

    if (empty($emailOrMobile) || empty($password)) {
        echo json_encode([
            "status" => "error",
            "message" => "Email/Mobile and Password are required"
        ]);
        exit;
    }

    // Convert mobile to international format if it looks like a phone number
    $loginMobile = preg_replace('/[^0-9]/','',$emailOrMobile);
    if(strlen($loginMobile) == 11 && substr($loginMobile,0,1)=="0"){
        $loginMobile = "63" . substr($loginMobile,1);
    } elseif(strlen($loginMobile) == 12 && substr($loginMobile,0,2)=="63"){
        // already international format
    } else {
        $loginMobile = null; // not a mobile, treat as email
    }

    if($loginMobile){
        $stmt = $conn->prepare("SELECT id, passwd FROM userAccounts WHERE mobileNumber = ? LIMIT 1");
        $stmt->bind_param("s", $loginMobile);
    } else {
        $stmt = $conn->prepare("SELECT id, passwd FROM userAccounts WHERE eMail = ? LIMIT 1");
        $stmt->bind_param("s", $emailOrMobile);
    }

    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo json_encode([
            "status" => "error",
            "message" => "User not found"
        ]);
        exit;
    }

    $stmt->bind_result($id, $hashedPassword);
    $stmt->fetch();

    if(password_verify($password, $hashedPassword)){
        echo json_encode([
            "status" => "success",
            "message" => "Login successful",
            "userId" => $id
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid password"
        ]);
    }

    $stmt->close();
    $conn->close();

} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
}
?>
