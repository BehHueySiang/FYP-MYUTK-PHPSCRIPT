<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");


if (!isset($_POST['Tripid']) ||!isset($_POST['Trip_Name']) || !isset($_POST['Trip_State'])|| !isset($_POST['Trip_Type'])|| !isset($_POST['Trip_Day'])|| !isset($_POST['image'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
$Tripid = $_POST['Tripid'];
$TripName = $_POST['Trip_Name'];
$TripState = $_POST['Trip_State'];
$TripType = $_POST['Trip_Type'];
$TripDay = $_POST['Trip_Day'];
$image = $_POST['image'];

$sqlupdate = "UPDATE `tbl_itinerary` SET `Trip_Name`='$TripName',`Trip_State`='$TripState',`Trip_Type`='$TripType',`image`='$image' WHERE `Trip_id` = '$Tripid'";

if ($conn->query($sqlupdate) === TRUE) {
	$filename = mysqli_insert_id($conn);
	$response = array('status' => 'success', 'data' => null);
	$decoded_string = base64_decode($image);
		$path = '../assets/Itinerary/'.$filename.'_image.png';
		file_put_contents($path, $decoded_string);
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