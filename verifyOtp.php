<?php
header("Content-Type: application/json");
include "connectdb.php";

$mobile = $_POST['mobileNumber'] ?? '';
$otp = $_POST['otpNumber'] ?? '';

if(empty($mobile) || empty($otp)){
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

$stmt = $conn->prepare("SELECT id FROM smsForOtp WHERE mobileNumber=? AND otpNumber=? AND status=1 ORDER BY id DESC LIMIT 1");
$stmt->bind_param("ss",$mobile,$otp);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows>0){
    $conn->query("UPDATE smsForOtp SET status=2 WHERE mobileNumber='$mobile' AND otpNumber='$otp'");
    echo json_encode(["status"=>"success","message"=>"OTP verified"]);
} else {
    echo json_encode(["status"=>"error","message"=>"Invalid OTP"]);
}
?>
