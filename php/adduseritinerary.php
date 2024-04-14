<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$Trip_id = $_POST['Trip_id'];
$userid = $_POST['userid'];


	$sqlinsert = "INSERT INTO `tbl_useritinerary`(`Trip_id`,`userid`) VALUES ('$Trip_id','$userid')";


if ($conn->query($sqlinsert) === TRUE) {
		$response = array('status' => 'success', 'data' => $sqlinsert);
		sendJsonResponse($response);
	}else{
		$response = array('status' => 'failed', 'data' => $sqlinsert);
		sendJsonResponse($response);
	}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

?>