<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");




if (isset($_POST['userid'])  && isset($_POST['Trip_id'])){
	$userid = $_POST['userid'];	
		$Tripid = $_POST['Trip_id'];		

	$sqlloadtrip = "SELECT * FROM `tbl_itinerary` WHERE userid = '$userid' AND tbl_itinerary.Trip_id = '$Tripid'";
}else{
	$sqlloadtrip = "SELECT * FROM `tbl_itinerary`";
}

$result = $conn->query($sqlloadtrip);

if ($result->num_rows > 0) {
    $Tripinfo["Tripinfo"] = array();
	while ($row = $result->fetch_assoc()) {
        $Tripinfolist = array();
        $Tripinfolist['Trip_id'] = $row['Trip_id'];
        $Tripinfolist['userid'] = $row['userid'];
        $Tripinfolist['Trip_Name'] = $row['Trip_Name'];
        $Tripinfolist['Trip_State'] = $row['Trip_State'];
        $Tripinfolist['Trip_Type'] = $row['Trip_Type'];
		$Tripinfolist['Trip_Day'] = $row['Trip_Day'];
		$Tripinfolist['Total_Tripfee'] = $row['Total_Tripfee'];
        array_push($Tripinfo["Tripinfo"],$Tripinfolist);
    }
	$response = array('status' => 'success', 'data' => $Tripinfo);
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