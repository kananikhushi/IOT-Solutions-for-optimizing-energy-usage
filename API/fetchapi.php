<?php
header('Content-Type: application/json');
include('db_config.php');

 $response = array();
 
 $checkQuery = "SELECT `SMOKE_ID`, `DEVICE_ID`, `SMOKE_VALUE`, `READING_TIME` FROM `SMOKE_SENSOR_TABLE`"; // change here.
 $result = mysqli_query($conn,$checkQuery);
 $numrow = mysqli_num_rows($result);
 
 if($result->num_rows == 0)
 {
$response["error"] = TRUE;
$response["message"] = "Sorry no smoke data found.";
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

$details['SMOKE_ID'] = $val['SMOKE_ID'];
$details['DEVICE_ID'] = $val['DEVICE_ID'];
$details['SMOKE_VALUE'] = $val['SMOKE_VALUE'];
$details['READING_TIME'] = $val['READING_TIME'];
array_push($data,$details);

}
}
$response["smoke"] = $data; // change in response name.
$response["error"] = FALSE;
$response["message"] = "Successfully Smoke Sensor data Found.";
echo json_encode($response);
exit;
 }
 
?>

