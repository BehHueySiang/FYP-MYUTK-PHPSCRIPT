<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");


if (!isset($_POST['Reviewid']) ||!isset($_POST['reviewname']) || !isset($_POST['comment'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
$Review_id = $_POST['Reviewid'];
$Review_Name = $_POST['reviewname'];
$Comment = $_POST['comment'];

$sqlupdate = "UPDATE `tbl_review` SET `Review_Name`='$Review_Name',`Comment`='$Comment' WHERE `Review_id` = '$Review_id'";

if ($conn->query($sqlupdate) === TRUE) {
	$response = array('status' => 'success', 'data' => null);
    sendJsonResponse($response);
}else{
	$response = array('status' => 'failed', 'data' => null);
	sendJsonResponse($response);
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

?>