<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");

if (isset($_POST['userid'])){
	$userid = $_POST['userid'];	
	$sqldisplay = "SELECT * FROM `tbl_useritinerary` INNER JOIN `tbl_itinerary` ON tbl_useritinerary.Trip_id = tbl_itinerary.Trip_id WHERE tbl_useritinerary.userid = '$userid' " ;
}else  {
	 $sqldisplay = "SELECT * FROM `tbl_useritinerary` INNER JOIN `tbl_itinerary` ON tbl_useritinerary.Trip_id = tbl_itinerary.Trip_id " ;

}

$result = $conn->query($sqldisplay);
if ($result->num_rows > 0) {
    $Usertrip["Usertrip"] = array();
	while ($row = $result->fetch_assoc()) {
        $Utriplist = array();
        $Utriplist['Utrip_id'] = $row['Utrip_id'];
		$Utriplist['Trip_id'] = $row['Trip_id'];
        $Utriplist['userid'] = $row['userid'];
		$Utriplist['Trip_Name'] = $row['Trip_Name'];
        $Utriplist['Trip_Type'] = $row['Trip_Type'];
        $Utriplist['Trip_State'] = $row['Trip_State'];
		$Utriplist['Trip_Day'] = $row['Trip_Day'];
		$Utriplist['Total_Tripfee'] = $row['Total_Tripfee'];
        array_push($Usertrip["Usertrip"] ,$Utriplist);
    }
    $response = array('status' => 'success', 'data' => $Usertrip);
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