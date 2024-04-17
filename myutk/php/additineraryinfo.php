<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");


$TripName = $_POST['Trip_Name'];
$TripState = $_POST['Trip_State'];
$TripDay = $_POST['Trip_Day'];
$userid = $_POST['userid'];
$TripType = $_POST['Trip_Type'];
$Totaltripfee = $_POST['Total_Tripfee'];
$image = $_POST['image'];

	$sqladdtoitinerary = "INSERT INTO `tbl_itinerary`( `Trip_Name`, `Trip_State`, `Trip_Type`, `userid`,`Trip_Day`,`Total_Tripfee`,`image`) VALUES ('$TripName','$TripState','$TripType','$userid','$TripDay','$Totaltripfee','$image')";

if ($conn->query($sqladdtoitinerary) === TRUE) {
		$filename = mysqli_insert_id($conn);
		$response = array('status' => 'success', 'data' => $sqladdtoitinerary);
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