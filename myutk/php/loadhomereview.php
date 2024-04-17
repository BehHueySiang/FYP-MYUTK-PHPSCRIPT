<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");

if (isset($_POST['userid'])){
	$userid = $_POST['userid'];	
	$sqldisplay = "SELECT * FROM `tbl_homereview` INNER JOIN `tbl_review` ON tbl_homereview.Review_id = tbl_review.Review_id WHERE tbl_homereview.userid = '$userid' " ;
}else  {
	 $sqldisplay = "SELECT * FROM `tbl_homereview` INNER JOIN `tbl_review` ON tbl_homereview.Review_id = tbl_review.Review_id " ;



}

$result = $conn->query($sqldisplay);
if ($result->num_rows > 0) {
    $Homereview["Homereview"] = array();
	while ($row = $result->fetch_assoc()) {
		$Hreviewlist = array();
		$Hreviewlist['Hreview_id'] = $row['Hreview_id'];
        $Hreviewlist['Review_id'] = $row['Review_id'];
        $Hreviewlist['userid'] = $row['userid'];
        $Hreviewlist['Review_Name'] = $row['Review_Name'];
        $Hreviewlist['Comment'] = $row['Comment'];
        array_push($Homereview["Homereview"] ,$Hreviewlist);
    }
    $response = array('status' => 'success', 'data' => $Homereview);
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