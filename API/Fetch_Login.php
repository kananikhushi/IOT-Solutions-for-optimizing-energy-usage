<?php
header('Content-Type: application/json');
include('db_config.php');

 $response = array();
 
 $checkQuery = "SELECT `Login_id`, `Name`, `Contact_no`, `Email_id`, `Password`, `Role`, `Status` FROM `login_table`"; // change here.
 $result = mysqli_query($conn,$checkQuery);
 $numrow = mysqli_num_rows($result);
 
 if($result->num_rows == 0)
 {
$response["error"] = TRUE;
$response["message"] = "Sorry no Login data found.";
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

$details['Login_id'] = $val['Login_id'];
$details['Contact_no'] = $val['Contact_no'];
$details['Email_id'] = $val['Email_id'];
$details['Password'] = $val['Password'];
$details['Role'] = $val['Role'];
$details['Status'] = $val['Status'];
array_push($data,$details);

}
}
$response["Login_id"] = $data; // change in response name.
$response["error"] = FALSE;
$response["message"] = "Successfully Login data Found.";
echo json_encode($response);
exit;
 }
 
?>

