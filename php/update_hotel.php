<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");


if (!isset($_POST['HotelId']) ||!isset($_POST['hotelname']) || !isset($_POST['bookurl']) || !isset($_POST['hotelurl']) || !isset($_POST['note']) || !isset($_POST['hotelstate']) || !isset($_POST['hotelbudget']) || !isset($_POST['hotelrate'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}//The isset() function is used to check if a variable is set or not. If any of the variables listed above are not set, meaning they haven't been passed in the POST request, the condition !isset($_POST['variable']) will evaluate to true.

//If any of these variables are not set, the code block inside the curly braces will be executed. In this case, it sets the $response array with a status of 'failed' and a null value for the 'data' key. Then, the sendJsonResponse() function is called to send this response as a JSON object. Finally, the die() function is called to terminate the script execution.

//Essentially, this code checks for the presence of required $_POST variables, and if any are missing, it sends a failed response and stops the execution of the script. This helps ensure that all the necessary data is provided before proceeding with the database update operation.
$Hotel_id = $_POST['HotelId'];
$Hotel_Name = $_POST['hotelname'];
$Book_Url = $_POST['bookurl'];
$Hotel_Url = $_POST['hotelurl'];
$Note = $_POST['note'];
$Hotel_State = $_POST['hotelstate'];
$Hotel_Budget = $_POST['hotelbudget'];
$Hotel_Rate = $_POST['hotelrate'];



$sqlupdate = "UPDATE `tbl_hotel` SET `Hotel_Name`='$Hotel_Name',`Book_Url`='$Book_Url',`Hotel_Url`='$Hotel_Url',`Note`='$Note',`Hotel_State`='$Hotel_State',`Hotel_Budget`='$Hotel_Budget',`Hotel_Rate`='$Hotel_Rate' WHERE `Hotel_id` = '$Hotel_id'";

if ($conn->query($sqlupdate) === TRUE) {
	$response = array('status' => 'success', 'data' => null);
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