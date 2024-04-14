<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");

$userid = $_POST['userid'];
$Des_Name = $_POST['desname'];
$Url = $_POST['url'];
$Open_Time = $_POST['opentime'];
$Close_Time = $_POST['closetime'];
$Suggest_Time = $_POST['suggesttime'];
$Activity = $_POST['activity'];
$Des_Budget = $_POST['desbudget'];
$Des_State = $_POST['desstate'];
$Des_Rate = $_POST['desrate'];
$image = $_POST['image'];
$image1 = $_POST['image1'];
$image2 = $_POST['image2'];
$sqlinsert = "INSERT INTO `tbl_des`( `userid`, `Des_Name`, `Url`, `Open_Time`, `Close_Time`, `Suggest_Time`, `Activity`, `Des_Budget`, `Des_State`, `Des_Rate`, `image`, `image1`, `image2`) VALUES 
('$userid','$Des_Name','$Url','$Open_Time','$Close_Time','$Suggest_Time','$Activity','$Des_Budget','$Des_State','$Des_Rate','$image','$image1','$image2')";

if ($conn->query($sqlinsert) === TRUE) {
	$filename = mysqli_insert_id($conn);
	$response = array('status' => 'success', 'data' => null);
	 $decoded_string = base64_decode($image);
    $path = '../assets/Destination/'.$filename.'_image.png';
    $decoded_string1 = base64_decode($image1);
    $path1 = '../assets/Destination/'.$filename.'_image2.png';
    $decoded_string2 = base64_decode($image2);
    $path2 = '../assets/Destination/'.$filename.'_image3.png';
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