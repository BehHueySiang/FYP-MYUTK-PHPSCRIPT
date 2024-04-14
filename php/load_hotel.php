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
	$sqlloadhotel = "SELECT * FROM `tbl_hotel` WHERE userid = '$userid'";
}if (isset($_POST['search'])){
	$search = $_POST['search'];
	$sqlloadhotel = "SELECT * FROM `tbl_hotel` WHERE Hotel_Name LIKE '%$search%'";
}else{
	$sqlloadhotel = "SELECT * FROM `tbl_hotel`";
}

$result = $conn->query($sqlloadhotel);
$number_of_result = $result->num_rows;
$number_of_page = ceil($number_of_result / $results_per_page);

$sqlloadhotel = $sqlloadhotel . " LIMIT $page_first_result, $results_per_page";
$result = $conn->query($sqlloadhotel);

if ($result->num_rows > 0) {
    $Hotel["Hotel"] = array();
	while ($row = $result->fetch_assoc()) {
        $Hotellist = array();
        $Hotellist['Hotel_id'] = $row['Hotel_id'];
        $Hotellist['userid'] = $row['userid'];
        $Hotellist['Hotel_Name'] = $row['Hotel_Name'];
        $Hotellist['Book_Url'] = $row['Book_Url'];
        $Hotellist['Hotel_Url'] = $row['Hotel_Url'];
        $Hotellist['Note'] = $row['Note'];
        $Hotellist['Hotel_State'] = $row['Hotel_State'];
        $Hotellist['Hotel_Rate'] = $row['Hotel_Rate'];
        $Hotellist['Hotel_State'] = $row['Hotel_State'];
        $Hotellist['Hotel_Rate'] = $row['Hotel_Rate'];
		$Hotellist['Hotel_Budget'] = $row['Hotel_Budget'];
        array_push($Hotel["Hotel"],$Hotellist);
    }
	$response = array('status' => 'success', 'data' => $Hotel, 'numofpage'=>"$number_of_page",'numberofresult'=>"$number_of_result");
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