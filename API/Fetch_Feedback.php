<?php
header('Content-Type: application/json');
include('db_config.php');

 $response = array();
 
 $checkQuery = "SELECT `Fb_id`, `Login_id`,`Reading_time`, `Feedback` FROM `feedback_table`"; // change here.
 $result = mysqli_query($conn,$checkQuery);
 $numrow = mysqli_num_rows($result);
 
 if($result->num_rows == 0)
 {
$response["error"] = TRUE;
$response["message"] = "Sorry no Feedback data found.";
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

$details['Fb_id'] = $val['Fb_id'];
$details['Login_id'] = $val['Login_id'];
$details['Reading_time'] = $val['Reading_time'];
$details['Feedback'] = $val['Feedback'];
array_push($data,$details);

}
}
$response["Feedback"] = $data; // change in response name.
$response["error"] = FALSE;
$response["message"] = "Successfully Feedback data Found.";
echo json_encode($response);
exit;
 }
 
?>

