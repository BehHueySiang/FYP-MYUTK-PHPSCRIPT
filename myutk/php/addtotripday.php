<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$Des_id = $_POST['Des_id'];
$DayName = $_POST['Day_Name'];
$Trip_id = $_POST['Trip_id'];
$userid = $_POST['userid'];



	$sqlinserttoday = "INSERT INTO `tbl_tripday`(`Des_id`, `Day_Name`,`Trip_id`,`userid`) VALUES ('$Des_id','$DayName','$Trip_id','$userid')";


if ($conn->query($sqlinserttoday) === TRUE) {
		$response = array('status' => 'success', 'data' => $sqlinserttoday);
		sendJsonResponse($response);
	}else{
		$response = array('status' => 'failed', 'data' => $sqlinserttoday);
		sendJsonResponse($response);
	}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

?>