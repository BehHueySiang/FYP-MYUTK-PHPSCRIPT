<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");
$action = $_POST['action'];
$Tripid = $_POST['Tripid'];
$TotalTripFee = $_POST['Total_Tripfee'];
if ($action === 'add') {

$sql = "UPDATE `tbl_itinerary` SET `Total_Tripfee`= ( Total_Tripfee + $TotalTripFee) WHERE  `Trip_id` = '$Tripid'";

}else if ($action === 'delete'){
	$sql = "UPDATE `tbl_itinerary` SET `Total_Tripfee`= ( Total_Tripfee - $TotalTripFee) WHERE  `Trip_id` = '$Tripid'";

}

if ($conn->query($sql) === TRUE) {
		$response = array('status' => 'success', 'data' => $sql);
		sendJsonResponse($response);
	}else{
		$response = array('status' => 'failed', 'data' => $sql);
		sendJsonResponse($response);
	}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

?>