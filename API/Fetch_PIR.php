<?php
header('Content-Type: application/json');
include('db_config.php');

 $response = array();
 
 $checkQuery = "SELECT `PIR_id`, `PIR_value`, `Reading_time`, `Device_id` FROM `pir_table`"; // change here.
 $result = mysqli_query($conn,$checkQuery);
 $numrow = mysqli_num_rows($result);
 
 if($result->num_rows == 0)
 {
$response["error"] = TRUE;
$response["message"] = "Sorry no Fire data found.";
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

$details['PIR_id'] = $val['PIR_id'];
$details['PIR_value'] = $val['PIR_value'];
$details['Reading_time'] = $val['Reading_time'];
$details['Device_id'] = $val['Device_id'];

array_push($data,$details);

}
}
$response["PIR"] = $data; // change in response name.
$response["error"] = FALSE;
$response["message"] = "Successfully PIR Sensor data Found.";
echo json_encode($response);
exit;
 }
 
?>

