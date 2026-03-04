<?php
header("Content-Type: application/json");
include "connectdb.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['eMail'] ?? '';
    $mobile = $_POST['mobileNumber'] ?? '';
    $password = $_POST['passwd'] ?? '';

    if(empty($email) || empty($mobile) || empty($password)){
        echo json_encode(["status"=>"error","message"=>"All fields are required"]);
        exit();
    }

    // Convert mobile to international format
    $mobile = preg_replace('/[^0-9]/','',$mobile);
    if(strlen($mobile)==11 && substr($mobile,0,1)=="0"){
        $mobile = "63".substr($mobile,1);
    } elseif(strlen($mobile)==12 && substr($mobile,0,2)=="63"){
        // already international format
    } else {
        echo json_encode(["status"=>"error","message"=>"Invalid mobile number format"]);
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email exists
    $check = $conn->prepare("SELECT id FROM userAccounts WHERE eMail=?");
    $check->bind_param("s",$email);
    $check->execute();
    $check->store_result();
    if($check->num_rows>0){
        echo json_encode(["status"=>"error","message"=>"Email already exists"]);
        exit();
    }

    // Check if mobile exists
    $checkMobile = $conn->prepare("SELECT id FROM userAccounts WHERE mobileNumber=?");
    $checkMobile->bind_param("s",$mobile);
    $checkMobile->execute();
    $checkMobile->store_result();
    if($checkMobile->num_rows>0){
        echo json_encode(["status"=>"error","message"=>"Mobile number already exists"]);
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO userAccounts (eMail,mobileNumber,passwd) VALUES (?,?,?)");
    $stmt->bind_param("sss",$email,$mobile,$hashedPassword);

    if($stmt->execute()){
        echo json_encode(["status"=>"success","message"=>"User created successfully","mobile_international"=>$mobile]);
    } else {
        echo json_encode(["status"=>"error","message"=>"Failed to create user"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status"=>"error","message"=>"Invalid Request Method"]);
}
?>
