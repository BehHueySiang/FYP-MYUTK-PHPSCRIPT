<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$results_per_page = 6;
if (isset($_POST['pageno'])){
	$pageno = (int)$_POST['pageno'];
}else{
	$pageno = 1;
}
$page_first_result = max((($pageno - 1) * $results_per_page), 0);

if (isset($_POST['userid'])){
	$userid = $_POST['userid'];	
	$sqlloaddes = "SELECT * FROM `tbl_des` WHERE userid = '$userid'";
}if (isset($_POST['search']) && isset($_POST['searchstate'])){
	$search = $_POST['searchstate'];
	$searchstate = $_POST['searchstate'];
	$sqlloaddes = "SELECT * FROM `tbl_des` WHERE Des_Name LIKE '%$search%' OR Des_State LIKE '%$searchstate%'";
}else{
	$sqlloaddes = "SELECT * FROM `tbl_des`";
}

$result = $conn->query($sqlloaddes);
$number_of_result = $result->num_rows;
$number_of_page = ceil($number_of_result / $results_per_page);

$sqlloaddes = $sqlloaddes . " LIMIT $page_first_result, $results_per_page";
$result = $conn->query($sqlloaddes);

if ($result->num_rows > 0) {
    $Des["Des"] = array();
	while ($row = $result->fetch_assoc()) {
        $Deslist = array();
        $Deslist['Des_id'] = $row['Des_id'];
        $Deslist['userid'] = $row['userid'];
        $Deslist['Des_Name'] = $row['Des_Name'];
        $Deslist['Url'] = $row['Url'];
        $Deslist['Open_Time'] = $row['Open_Time'];
        $Deslist['Close_Time'] = $row['Close_Time'];
        $Deslist['Suggest_Time'] = $row['Suggest_Time'];
        $Deslist['Activity'] = $row['Activity'];
        $Deslist['Des_State'] = $row['Des_State'];
        $Deslist['Des_Rate'] = $row['Des_Rate'];
		$Deslist['Des_Budget'] = $row['Des_Budget'];
        array_push($Des["Des"],$Deslist);
    }
	$response = array('status' => 'success', 'data' => $Des, 'numofpage'=>"$number_of_page",'numberofresult'=>"$number_of_result");
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