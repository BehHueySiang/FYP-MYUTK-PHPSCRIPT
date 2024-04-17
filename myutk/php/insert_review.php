<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");

$userid = $_POST['userid'];
$Review_Name = $_POST['reviewname'];
$Comment = $_POST['comment'];
$image = $_POST['image'];
$image1 = $_POST['image1'];
$image2 = $_POST['image2'];
$sqlinsert = "INSERT INTO `tbl_review`(`userid`, `Review_Name`, `Comment`,`image`, `image1`, `image2`) VALUES 
('$userid','$Review_Name','$Comment','$image','$image1','$image2')";

if ($conn->query($sqlinsert) === TRUE) {
	$filename = mysqli_insert_id($conn);
	$response = array('status' => 'success', 'data' => null);
	 $decoded_string = base64_decode($image);
    $path = '../assets/Review/'.$filename.'_image.png';
    $decoded_string1 = base64_decode($image1);
    $path1 = '../assets/Review/'.$filename.'_image2.png';
    $decoded_string2 = base64_decode($image2);
    $path2 = '../assets/Review/'.$filename.'_image3.png';
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