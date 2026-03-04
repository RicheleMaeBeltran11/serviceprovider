<?php
header("Content-Type: application/json");
include "connectdb.php";

$mobile = $_POST['mobileNumber'] ?? '';
$otp = $_POST['otpNumber'] ?? '';
$newPassword = $_POST['newPassword'] ?? '';

if(empty($mobile) || empty($otp) || empty($newPassword)){
    echo json_encode(["status"=>"error","message"=>"All fields required"]);
    exit();
}

// Convert mobile
$mobile = preg_replace('/[^0-9]/','',$mobile);
if(strlen($mobile)==11 && substr($mobile,0,1)=="0") $mobile = "63".substr($mobile,1);
elseif(strlen($mobile)!=12 || substr($mobile,0,2)!="63") {
    echo json_encode(["status"=>"error","message"=>"Invalid mobile number format"]);
    exit();
}

// Check OTP verified
$stmt = $conn->prepare("SELECT id FROM smsForOtp WHERE mobileNumber=? AND otpNumber=? AND status=2 ORDER BY id DESC LIMIT 1");
$stmt->bind_param("ss",$mobile,$otp);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows==0){
    echo json_encode(["status"=>"error","message"=>"OTP not verified. Cannot change password."]);
    exit();
}

// Change password
$hashed = password_hash($newPassword,PASSWORD_DEFAULT);
$stmt2 = $conn->prepare("UPDATE userAccounts SET passwd=? WHERE mobileNumber=?");
$stmt2->bind_param("ss",$hashed,$mobile);

if($stmt2->execute()){
    echo json_encode(["status"=>"success","message"=>"Password changed successfully"]);
}else{
    echo json_encode(["status"=>"error","message"=>"Failed to change password"]);
}
?>
