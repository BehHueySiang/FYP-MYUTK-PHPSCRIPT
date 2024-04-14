<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");
$userid = $_POST['userid'];
$Budget_id = $_POST['Budget_id'];
$BdayName = $_POST['Bday_Name'];
$ExpendType = $_POST['Expend_Type'];
$ExpendName = $_POST['Expend_Name'];
$ExpendAmount = $_POST['Expend_Amount'];
$image = $_POST['image'];



	$sqlinsert = "INSERT INTO `tbl_budgetday`(`userid`, `Budget_id`,`Bday_Name`,`Expend_Type`,`Expend_Name`,`Expend_Amount`,`image`) VALUES ('$userid','$Budget_id','$BdayName','$ExpendType','$ExpendName','$ExpendAmount','$image')";


if ($conn->query($sqlinsert) === TRUE) {
		$filename = mysqli_insert_id($conn);
		$response = array('status' => 'success', 'data' => $sqlinsert);
		$decoded_string = base64_decode($image);
		$path = '../assets/BudgetDay/'.$filename.'_image.png';
		file_put_contents($path, $decoded_string);
		sendJsonResponse($response);
	}else{
		$response = array('status' => 'failed', 'data' => $sqlinsert);
		sendJsonResponse($response);
	}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

?>