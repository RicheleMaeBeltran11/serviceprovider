<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);
if(isset($data['userId'])){
    $_SESSION['userId'] = $data['userId'];
    echo json_encode(['status'=>'success']);
} else {
    echo json_encode(['status'=>'error']);
}
?>
