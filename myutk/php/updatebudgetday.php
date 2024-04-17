<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");


if (!isset($_POST['Bdayid']) ||!isset($_POST['Budget_Name']) || !isset($_POST['Budget_Day'])|| !isset($_POST['Total_Budget'])|| !isset($_POST['image'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
$Budgetid = $_POST['Budgetid'];
$userid = $_POST['userid'];
$TotalBudget = $_POST['Total_Budget'];
$image = $_POST['image'];

$sqlupdate = "UPDATE `tbl_budgetday` SET `Total_Budget`='$TotalBudget',`image`='$image' WHERE `Budget_id` = '$Budgetid' AND userid = '$userid";

if ($conn->query($sqlupdate) === TRUE) {
	
	$response = array('status' => 'success', 'data' => null);
	$decoded_string = base64_decode($image);
		$path = '../assets/Budget/'.$Budgetid.'_image.png';
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