<?php
header('Content-Type: application/json');
include('db_config.php');

 $response = array();
 
 $checkQuery = "SELECT `Device_id`, `Device_issue_date`, `Device_no`, `Login_id` FROM `device_table`"; // change here.
 $result = mysqli_query($conn,$checkQuery);
 $numrow = mysqli_num_rows($result);
 
 if($result->num_rows == 0)
 {
$response["error"] = TRUE;
$response["message"] = "Sorry no Device data found.";
echo json_encode($response);
exit;
 }
 else
 {
 

$data = array();

for($i=1;$i<=$numrow;$i++)
{
while($val = mysqli_fetch_assoc($result))
{

$details['Device_id'] = $val['Device_id'];
$details['Device_issue_date'] = $val['Device_issue_date'];
$details['Device_no'] = $val['Device_no'];
$details['Login_id'] = $val['Login_id'];
array_push($data,$details);

}
}
$response["Device"] = $data; // change in response name.
$response["error"] = FALSE;
$response["message"] = "Successfully Device data Found.";
echo json_encode($response);
exit;
 }
 
?>

