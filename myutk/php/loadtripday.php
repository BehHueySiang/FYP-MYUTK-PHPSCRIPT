<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");

if (isset($_POST['userid']) && isset($_POST['Trip_id']) ){
	$userid = $_POST['userid'];
	$Tripid = $_POST['Trip_id'];		
	$sqltripday = "SELECT * FROM `tbl_tripday` INNER JOIN `tbl_des` ON tbl_tripday.Des_id = tbl_des.Des_id INNER JOIN `tbl_itinerary` ON tbl_tripday.Trip_id = tbl_itinerary.Trip_id WHERE tbl_tripday.userid = '$userid'  AND tbl_itinerary.Trip_id = '$Tripid' " ;
}else if(isset($_POST['Trip_id'])) {
	$Tripid = $_POST['Trip_id'];
    $sqltripday = "SELECT * FROM `tbl_tripday` INNER JOIN `tbl_des` ON tbl_tripday.Des_id = tbl_des.Des_id INNER JOIN `tbl_itinerary` ON tbl_tripday.Trip_id = tbl_itinerary.Trip_id WHERE tbl_itinerary.Trip_id = '$Tripid' " ;

}else  {
	
    $sqltripday = "SELECT * FROM `tbl_tripday` INNER JOIN `tbl_des` ON tbl_tripday.Des_id = tbl_des.Des_id INNER JOIN `tbl_itinerary` ON tbl_tripday.Trip_id = tbl_itinerary.Trip_id" ;

}

$result = $conn->query($sqltripday);
if ($result->num_rows > 0) {
    $Tripdayitems["Tripday"] = array();
	while ($row = $result->fetch_assoc()) {
        $Tripdaylist = array();
        $Tripdaylist['Day_id'] = $row['Day_id'];
        $Tripdaylist['Des_id'] = $row['Des_id'];
		$Tripdaylist['Trip_id'] = $row['Trip_id'];
        $Tripdaylist['Day_Name'] = $row['Day_Name'];
        $Tripdaylist['userid'] = $row['userid'];
        $Tripdaylist['Des_Name'] = $row['Des_Name'];
        $Tripdaylist['Url'] = $row['Url'];
        $Tripdaylist['Open_Time'] = $row['Open_Time'];
        $Tripdaylist['Close_Time'] = $row['Close_Time'];
        $Tripdaylist['Suggest_Time'] = $row['Suggest_Time'];
        $Tripdaylist['Activity'] = $row['Activity'];
        $Tripdaylist['Des_State'] = $row['Des_State'];
        $Tripdaylist['Des_Rate'] = $row['Des_Rate'];
		$Tripdaylist['Des_Budget'] = $row['Des_Budget'];
		 $Tripdaylist['Trip_Name'] = $row['Trip_Name'];
        $Tripdaylist['Trip_Type'] = $row['Trip_Type'];
        $Tripdaylist['Trip_State'] = $row['Trip_State'];
		$Tripdaylist['Trip_Day'] = $row['Trip_Day'];
		$Tripdaylist['Total_Tripfee'] = $row['Total_Tripfee'];

        array_push($Tripdayitems["Tripday"] ,$Tripdaylist);
    }
    $response = array('status' => 'success', 'data' => $Tripdayitems);
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
