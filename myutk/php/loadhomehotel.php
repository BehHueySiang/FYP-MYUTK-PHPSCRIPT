<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");

if (isset($_POST['userid'])){
	$userid = $_POST['userid'];		
	$sqldisplay = "SELECT * FROM `tbl_homehotel` INNER JOIN `tbl_hotel` ON tbl_homehotel.Hotel_id = tbl_hotel.Hotel_id WHERE tbl_homehotel.userid = '$userid' " ;
}else  {
	 $sqldisplay = "SELECT * FROM `tbl_homehotel` INNER JOIN `tbl_hotel` ON tbl_homehotel.Hotel_id = tbl_hotel.Hotel_id " ;



}

$result = $conn->query($sqldisplay);
if ($result->num_rows > 0) {
    $Homehotel["Homehotel"] = array();
	while ($row = $result->fetch_assoc()) {
     $Hhotellist = array();
		$Hhotellist['Hhotel_id'] = $row['Hhotel_id'];
        $Hhotellist['Hotel_id'] = $row['Hotel_id'];
        $Hhotellist['userid'] = $row['userid'];
        $Hhotellist['Hotel_Name'] = $row['Hotel_Name'];
        $Hhotellist['Book_Url'] = $row['Book_Url'];
        $Hhotellist['Hotel_Url'] = $row['Hotel_Url'];
        $Hhotellist['Note'] = $row['Note'];
        $Hhotellist['Hotel_State'] = $row['Hotel_State'];
        $Hhotellist['Hotel_Rate'] = $row['Hotel_Rate'];
        $Hhotellist['Hotel_State'] = $row['Hotel_State'];
        $Hhotellist['Hotel_Rate'] = $row['Hotel_Rate'];
		$Hhotellist['Hotel_Budget'] = $row['Hotel_Budget'];
        array_push($Homehotel["Homehotel"] ,$Hhotellist);
    }
    $response = array('status' => 'success', 'data' => $Homehotel);
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