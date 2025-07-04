<?php
header('Content-Type: application/json');
include('db_config.php');

 $response = array();
 
 $checkQuery = "SELECT `Temp_id`, `Temprature`, `Reading_time`, `Humidity` FROM `temprature_table`"; // change here.
 $result = mysqli_query($conn,$checkQuery);
 $numrow = mysqli_num_rows($result);
 
 if($result->num_rows == 0)
 {
$response["error"] = TRUE;
$response["message"] = "Sorry no temprature data found.";
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

$details['Temp_id'] = $val['Temp_id'];
$details['Temprature'] = $val['Temprature'];
$details['Reading_time'] = $val['Reading_time'];
$details['Humidity'] = $val['Humidity'];
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

