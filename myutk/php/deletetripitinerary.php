<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$userid = $_POST['userid'];
$Trip_id = $_POST['Trip_id'];

// First, delete all records from tbl_tripday related to the Trip_id
$sql_delete_tripday = "DELETE FROM `tbl_tripday` WHERE `Trip_id` = '$Trip_id'";

if ($conn->query($sql_delete_tripday) === TRUE) {
    // Second, delete the record from tbl_itinerary
    $sql_delete_itinerary = "DELETE FROM `tbl_itinerary` WHERE `userid` = '$userid' AND `Trip_id` = '$Trip_id'";

    if ($conn->query($sql_delete_itinerary) === TRUE) {
        $response = array('status' => 'success', 'message' => 'Trip and related data deleted successfully');
    } else {
        $response = array('status' => 'failed', 'message' => 'Failed to delete from tbl_itinerary');
    }
} else {
    $response = array('status' => 'failed', 'message' => 'Failed to delete from tbl_tripday');
}

sendJsonResponse($response);

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>
