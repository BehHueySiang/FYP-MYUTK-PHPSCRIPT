<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");


if (!isset($_POST['DesId']) ||!isset($_POST['desname']) || !isset($_POST['url']) || !isset($_POST['opentime']) || !isset($_POST['closetime']) || !isset($_POST['suggesttime']) || !isset($_POST['activity']) || !isset($_POST['desbudget'])|| !isset($_POST['desrate'])|| !isset($_POST['desstate'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}//The isset() function is used to check if a variable is set or not. If any of the variables listed above are not set, meaning they haven't been passed in the POST request, the condition !isset($_POST['variable']) will evaluate to true.

//If any of these variables are not set, the code block inside the curly braces will be executed. In this case, it sets the $response array with a status of 'failed' and a null value for the 'data' key. Then, the sendJsonResponse() function is called to send this response as a JSON object. Finally, the die() function is called to terminate the script execution.

//Essentially, this code checks for the presence of required $_POST variables, and if any are missing, it sends a failed response and stops the execution of the script. This helps ensure that all the necessary data is provided before proceeding with the database update operation.
$Des_id = $_POST['DesId'];
$Des_Name = $_POST['desname'];
$Url = $_POST['url'];
$Open_Time = $_POST['opentime'];
$Close_Time = $_POST['closetime'];
$Suggest_Time = $_POST['suggesttime'];
$Activity = $_POST['activity'];
$Des_Budget = $_POST['desbudget'];
$Des_Rate = $_POST['desrate'];
$Des_State = $_POST['desstate'];



$sqlupdate = "UPDATE `tbl_des` SET `Des_Name`='$Des_Name',`Url`='$Url',`Open_Time`='$Open_Time',`Close_Time`='$Close_Time',`Suggest_Time`='$Suggest_Time',`Activity`='$Activity',`Des_Budget`='$Des_Budget',`Des_State`='$Des_State',`Des_Rate`='$Des_Rate ' WHERE `Des_id` = '$Des_id'";

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