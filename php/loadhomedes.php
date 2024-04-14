<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");

if (isset($_POST['userid'])){
	$userid = $_POST['userid'];
		
	$sqldisplay = "SELECT * FROM `tbl_homedestination` INNER JOIN `tbl_des` ON tbl_homedestination.Des_id = tbl_des.Des_id WHERE tbl_homedestination.userid = '$userid' " ;
}else  {
	 	$sqldisplay = "SELECT * FROM `tbl_homedestination` INNER JOIN `tbl_des` ON tbl_homedestination.Des_id = tbl_des.Des_id  " ;


}

$result = $conn->query($sqldisplay);
if ($result->num_rows > 0) {
    $Homedes["Homedes"] = array();
	while ($row = $result->fetch_assoc()) {
        $Hdeslist = array();
        $Hdeslist['Hdes_id'] = $row['Hdes_id'];
        $Hdeslist['Des_id'] = $row['Des_id'];
        $Hdeslist['userid'] = $row['userid'];
        $Hdeslist['Des_Name'] = $row['Des_Name'];
        $Hdeslist['Url'] = $row['Url'];
        $Hdeslist['Open_Time'] = $row['Open_Time'];
        $Hdeslist['Close_Time'] = $row['Close_Time'];
        $Hdeslist['Suggest_Time'] = $row['Suggest_Time'];
        $Hdeslist['Activity'] = $row['Activity'];
        $Hdeslist['Des_State'] = $row['Des_State'];
        $Hdeslist['Des_Rate'] = $row['Des_Rate'];
		$Hdeslist['Des_Budget'] = $row['Des_Budget'];
		
        array_push($Homedes["Homedes"] ,$Hdeslist);
    }
    $response = array('status' => 'success', 'data' => $Homedes);
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