<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$userid = $_POST['userid'];
$Budget_id = $_POST['Budget_id'];

// First, delete all records from tbl_tripday related to the Trip_id
$sql_delete_budgetday = "DELETE FROM `tbl_budgetday` WHERE `Budget_id` = '$Budget_id'";

if ($conn->query($sql_delete_budgetday) === TRUE) {
    // Second, delete the record from tbl_budget
    $sql_delete_budget = "DELETE FROM `tbl_budget` WHERE `userid` = '$userid' AND `Budget_id` = '$Budget_id'";

    if ($conn->query($sql_delete_budget) === TRUE) {
        $response = array('status' => 'success', 'message' => 'This budget plan and related data deleted successfully');
    } else {
        $response = array('status' => 'failed', 'message' => 'Failed to delete from tbl_budget');
    }
} else {
    $response = array('status' => 'failed', 'message' => 'Failed to delete from tbl_budgetday');
}

sendJsonResponse($response);

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>