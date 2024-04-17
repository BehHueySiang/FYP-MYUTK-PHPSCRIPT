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
    $sqlloadreview = "SELECT * FROM `tbl_review` WHERE userid = '$userid'";
}
else{
    $sqlloadreview = "SELECT * FROM `tbl_review`";
}

if (isset($_POST['search'])){
    $search = $_POST['search'];
    $sqlloadreview .= " AND Review_Name LIKE '%$search%'";
}

$result = $conn->query($sqlloadreview);
$number_of_result = $result->num_rows;
$number_of_page = ceil($number_of_result / $results_per_page);

$sqlloadreview .= " LIMIT $page_first_result, $results_per_page";
$result = $conn->query($sqlloadreview);

if ($result->num_rows > 0) {
    $Review["Review"] = array();
    while ($row = $result->fetch_assoc()) {
        $Reviewlist = array();
        $Reviewlist['Review_id'] = $row['Review_id'];
        $Reviewlist['userid'] = $row['userid'];
        $Reviewlist['Review_Name'] = $row['Review_Name'];
        $Reviewlist['Comment'] = $row['Comment'];
        array_push($Review["Review"],$Reviewlist);
    }
    $response = array('status' => 'success', 'data' => $Review, 'numofpage'=>"$number_of_page",'numberofresult'=>"$number_of_result");
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