<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");

$userid = $_POST['userid'];
$Hotel_Name = $_POST['hotelname'];
$Book_Url = $_POST['bookurl'];
$Hotel_Url = $_POST['hotelurl'];
$Note = $_POST['note'];
$Hotel_Budget = $_POST['hotelbudget'];
$Hotel_State = $_POST['hotelstate'];
$Hotel_Rate = $_POST['hotelrate'];
$image = $_POST['image'];
$image1 = $_POST['image1'];
$image2 = $_POST['image2'];
$sqlinsert = "INSERT INTO `tbl_hotel`(`userid`, `Hotel_Name`, `Book_Url`, `Hotel_Url`, `Note`, `Hotel_State`, `Hotel_Budget`, `Hotel_Rate`, `image`, `image1`, `image2`) VALUES 
('$userid','$Hotel_Name','$Book_Url','$Hotel_Url','$Note','$Hotel_State','$Hotel_Budget','$Hotel_Rate','$image','$image1','$image2')";

if ($conn->query($sqlinsert) === TRUE) {
	$filename = mysqli_insert_id($conn);
	$response = array('status' => 'success', 'data' => null);
	 $decoded_string = base64_decode($image);
    $path = '../assets/Hotel/'.$filename.'_image.png';
    $decoded_string1 = base64_decode($image1);
    $path1 = '../assets/Hotel/'.$filename.'_image2.png';
    $decoded_string2 = base64_decode($image2);
    $path2 = '../assets/Hotel/'.$filename.'_image3.png';
	file_put_contents($path, $decoded_string);
	file_put_contents($path1, $decoded_string1);
	file_put_contents($path2, $decoded_string2);
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