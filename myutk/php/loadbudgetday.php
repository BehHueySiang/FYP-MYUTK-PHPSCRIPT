<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");

if (isset($_POST['userid']) && isset($_POST['Budget_id']) ){
	$userid = $_POST['userid'];
	$Budgetid = $_POST['Budget_id'];		
	$sqlbudgetday = "SELECT * FROM `tbl_budgetday` INNER JOIN `tbl_budget` ON tbl_budgetday.Budget_id = tbl_budget.Budget_id WHERE tbl_Budgetday.userid = '$userid'  AND tbl_Budget.Budget_id = '$Budgetid' " ;


}else  {
	
    $sqlbudgetday = "SELECT * FROM `tbl_budgetday` INNER JOIN `tbl_budget` ON tbl_budgetday.Budget_id = tbl_budget.Budget_id'" ;

}

$result = $conn->query($sqlbudgetday);
if ($result->num_rows > 0) {
    $Budgetday["Budgetday"] = array();
	while ($row = $result->fetch_assoc()) {
        $Budgetdaylist = array();
        $Budgetdaylist['Bday_id'] = $row['Bday_id'];
        $Budgetdaylist['userid'] = $row['userid'];
		$Budgetdaylist['Budget_id'] = $row['Budget_id'];
        $Budgetdaylist['Bday_Name'] = $row['Bday_Name'];
        $Budgetdaylist['Expend_Type'] = $row['Expend_Type'];
        $Budgetdaylist['Expend_Name'] = $row['Expend_Name'];
        $Budgetdaylist['Expend_Date'] = $row['Expend_Date'];
        $Budgetdaylist['Expend_Amount'] = $row['Expend_Amount'];
		$Budgetdaylist['Budget_Name'] = $row['Budget_Name'];
        $Budgetdaylist['Budget_Day'] = $row['Budget_Day'];
        $Budgetdaylist['Total_Budget'] = $row['Total_Budget'];
		$Budgetdaylist['Total_Expenditure'] = $row['Total_Expenditure'];

		

        array_push($Budgetday["Budgetday"] ,$Budgetdaylist);
    }
    $response = array('status' => 'success', 'data' => $Budgetday);
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