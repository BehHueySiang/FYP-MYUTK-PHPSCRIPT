<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");

if (isset($_POST['userid'])){
	$userid = $_POST['userid'];	
	$sqldisplay = "SELECT * FROM `tbl_homeitinerary` INNER JOIN `tbl_itinerary` ON tbl_homeitinerary.Trip_id = tbl_itinerary.Trip_id WHERE tbl_homeitinerary.userid = '$userid' " ;
}else  {
	 $sqldisplay = "SELECT * FROM `tbl_homeitinerary` INNER JOIN `tbl_itinerary` ON tbl_homeitinerary.Trip_id = tbl_itinerary.Trip_id " ;

}

$result = $conn->query($sqldisplay);
if ($result->num_rows > 0) {
    $Hometrip["Hometrip"] = array();
	while ($row = $result->fetch_assoc()) {
        $Htriplist = array();
        $Htriplist['Htrip_id'] = $row['Htrip_id'];
		$Htriplist['Trip_id'] = $row['Trip_id'];
        $Htriplist['userid'] = $row['userid'];
		$Htriplist['Trip_Name'] = $row['Trip_Name'];
        $Htriplist['Trip_Type'] = $row['Trip_Type'];
        $Htriplist['Trip_State'] = $row['Trip_State'];
		$Htriplist['Trip_Day'] = $row['Trip_Day'];
        array_push($Hometrip["Hometrip"] ,$Htriplist);
    }
    $response = array('status' => 'success', 'data' => $Hometrip);
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