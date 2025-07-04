<?php
header('Content-Type: application/json');
include('db_config.php');

 $response = array();
 
 $checkQuery = "SELECT `Ult_id`, `Ult_value`, `Reading_time`, `Device_id` FROM `ultrasonic_table`"; // change here.
 $result = mysqli_query($conn,$checkQuery);
 $numrow = mysqli_num_rows($result);
 
 if($result->num_rows == 0)
 {
$response["error"] = TRUE;
$response["message"] = "Sorry no Ultrasonic data found.";
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

$details['Ult_id'] = $val['Ult_id'];
$details['Ult_value'] = $val['Ult_value'];
$details['Reading_time'] = $val['Reading_time'];
$details['Device_id'] = $val['Device_id'];

array_push($data,$details);

}
}
$response["Ultrasonic"] = $data; // change in response name.
$response["error"] = FALSE;
$response["message"] = "Successfully Ultrasonic Sensor data Found.";
echo json_encode($response);
exit;
 }
 
?>

