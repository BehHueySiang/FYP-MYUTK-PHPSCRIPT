<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");




if (isset($_POST['userid']) && isset($_POST['Budget_id'])){
	$userid = $_POST['userid'];	
    $Budgetid = $_POST['Budget_id'];			

	$sqlloadbudget = "SELECT * FROM `tbl_budget` WHERE userid = '$userid' AND tbl_budget.Budget_id = '$Budgetid' ";
}else if (isset($_POST['userid'])){
	$userid = $_POST['userid'];
	$sqlloadbudget = "SELECT * FROM `tbl_budget` WHERE userid = '$userid'";
}else{
	$sqlloadbudget = "SELECT * FROM `tbl_budget`";
}

$result = $conn->query($sqlloadbudget);

if ($result->num_rows > 0) {
    $Budgetinfo["Budgetinfo"] = array();
	while ($row = $result->fetch_assoc()) {
        $Budgetinfolist = array();
        $Budgetinfolist['Budget_id'] = $row['Budget_id'];
        $Budgetinfolist['userid'] = $row['userid'];
        $Budgetinfolist['Budget_Name'] = $row['Budget_Name'];
		$Budgetinfolist['Budget_Day'] = $row['Budget_Day'];
		$Budgetinfolist['Total_Budget'] = $row['Total_Budget'];
		$Budgetinfolist['Total_Expenditure'] = $row['Total_Expenditure'];
        array_push($Budgetinfo["Budgetinfo"],$Budgetinfolist);
    }
	$response = array('status' => 'success', 'data' => $Budgetinfo);
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