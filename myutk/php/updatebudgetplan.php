<?php
include_once("dbconnect.php");

// Check if POST data exists
if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
    $response = array('status' => 'failed', 'data' => 'No POST data received');
    sendJsonResponse($response);
    die();
}

// Extract POST data
$Budgetid = $_POST['Budgetid'];
$userid = $_POST['userid'];
$TotalBudget = $_POST['Total_Budget'];

// Check if an image file was uploaded
if (!empty($_FILES['image']['name'])) {
    $targetDir = '../assets/Budget/';
    $imageFileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $imageFileName;

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
        $imagePath = $targetFilePath;
    } else {
        $response = array('status' => 'failed', 'data' => 'Failed to upload image');
        sendJsonResponse($response);
        die();
    }
} else {
    $imagePath = ''; // No new image provided
}

// Update database with new data
$sqlupdate = "UPDATE `tbl_budget` SET `Total_Budget`='$TotalBudget', `image`='$imagePath' WHERE `Budget_id`='$Budgetid' AND `userid`='$userid'";

if ($conn->query($sqlupdate) === TRUE) {
    $response = array('status' => 'success', 'data' => null);
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'data' => 'Failed to update database');
    sendJsonResponse($response);
}

// Function to send JSON response
function sendJsonResponse($sentArray) {
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>

