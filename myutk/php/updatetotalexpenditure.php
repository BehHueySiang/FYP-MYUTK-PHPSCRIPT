<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");
$action = $_POST['action'];
$Budgetid = $_POST['Budgetid'];
$TotalExpenditure = $_POST['Total_Expenditure'];
if ($action === 'add') {

$sql = "UPDATE `tbl_budget` SET `Total_Expenditure`= ( Total_Expenditure + $TotalExpenditure) WHERE  `Budget_id` = '$Budgetid'";

}else if ($action === 'delete'){
	$sql = "UPDATE `tbl_budget` SET `Total_Expenditure`= ( Total_Expenditure - $TotalExpenditure) WHERE  `Budget_id` = '$Budgetid'";

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