<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");


$BudgetName = $_POST['Budget_Name'];
$BudgetDay = $_POST['Budget_Day'];
$userid = $_POST['userid'];
$TotalBudget = $_POST['Total_Budget'];
$TotalExpenditure = $_POST['Total_Expenditure'];
$image = $_POST['image'];

	$sqladdbudget= "INSERT INTO `tbl_budget`( `Budget_Name`,`Budget_Day`, `userid`,`Total_Budget`,`Total_Expenditure`,`image`) VALUES ('$BudgetName','$BudgetDay','$userid','$TotalBudget','$TotalExpenditure','$image')";

if ($conn->query($sqladdbudget) === TRUE) {
		$filename = mysqli_insert_id($conn);
		$response = array('status' => 'success', 'data' => $sqladdbudget);
		$decoded_string = base64_decode($image);
		$path = '../assets/Budget/'.$filename.'_image.png';
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