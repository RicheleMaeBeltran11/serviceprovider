<?php
header("Content-Type: application/json");
include "connectdb.php";

$mobile = $_POST['mobileNumber'] ?? '';

if(empty($mobile)){
    echo json_encode(["status"=>"error","message"=>"Mobile number required"]);
    exit();
}

// Convert mobile
$mobile = preg_replace('/[^0-9]/','',$mobile);
if(strlen($mobile)==11 && substr($mobile,0,1)=="0") $mobile = "63".substr($mobile,1);
elseif(strlen($mobile)!=12 || substr($mobile,0,2)!="63") {
    echo json_encode(["status"=>"error","message"=>"Invalid mobile number format"]);
    exit();
}

// Check if mobile exists
$check = $conn->prepare("SELECT id FROM userAccounts WHERE mobileNumber=?");
$check->bind_param("s",$mobile);
$check->execute();
$check->store_result();
if($check->num_rows==0){
    echo json_encode(["status"=>"error","message"=>"Mobile number not registered"]);
    exit();
}

// Generate OTP
$otp = rand(100000,999999);
$message = "Your OTP for password reset is: $otp";

// Save OTP
$stmt = $conn->prepare("INSERT INTO smsForOtp (mobileNumber,smsString,otpNumber,status) VALUES (?,?,?,0)");
$stmt->bind_param("sss",$mobile,$message,$otp);
$stmt->execute();

// Send OTP via IPROG SMS
$apiToken = "b6483eb286fed0b258ec89973b0745d1b239aba9"; // replace with your real token
$url = "https://www.iprogsms.com/api/v1/sms_messages";

$data = [
    "api_token"=>$apiToken,
    "phone_number"=>$mobile,
    "message"=>$message
];

$ch = curl_init($url."?api_token=".urlencode($apiToken));
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,["Content-Type: application/json"]);
curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
curl_close($ch);

$jsonResp = json_decode($response,true);

if($httpcode==200 && isset($jsonResp['status']) && $jsonResp['status']==200){
    $conn->query("UPDATE smsForOtp SET status=1 WHERE otpNumber='$otp'");
    echo json_encode(["status"=>"success","message"=>"OTP sent successfully"]);
} else {
    echo json_encode(["status"=>"error","message"=>"Failed to send OTP","details"=>$jsonResp]);
}
?>
