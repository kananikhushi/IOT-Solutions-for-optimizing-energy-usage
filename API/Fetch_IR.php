<?php
header('Content-Type: application/json');
include('db_config.php');

 $response = array();
 
 $checkQuery = "SELECT `IR_id`, `IR_value`, `Reading_time`, `Device_id` FROM `ir_table`"; // change here.
 $result = mysqli_query($conn,$checkQuery);
 $numrow = mysqli_num_rows($result);
 
 if($result->num_rows == 0)
 {
$response["error"] = TRUE;
$response["message"] = "Sorry no IR data found.";
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

$details['IR_id'] = $val['IR_id'];
$details['IR_value'] = $val['IR_value'];
$details['Device_id'] = $val['Device_id'];
$details['Reading_time'] = $val['Reading_time'];
array_push($data,$details);

}
}
$response["IR"] = $data; // change in response name.
$response["error"] = FALSE;
$response["message"] = "Successfully IR Sensor data Found.";
echo json_encode($response);
exit;
 }
 
?>

