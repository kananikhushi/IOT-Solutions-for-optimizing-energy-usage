<?php
header('Content-Type: application/json');
include('db_config.php');

$response = array();



if(isset($_GET["Device_no"]) && isset($_GET["Login_id"]))
{
	  
	  $Device_no = $_GET["Device_no"];
	  $Login_id = $_GET["Login_id"];

	  $query = "INSERT INTO `device_table`(`Device_issue_date`, `Device_no`, `Login_id`) VALUES(CURRENT_TIMESTAMP(),'$Device_no','$Login_id')";
	  $result = mysqli_query($conn,$query);
	  
	
	
	  
	  if($result)
	  {
	
		  
			  $response["error"] = FALSE;
			  $response["message"] = "Successfully added.";
			  echo json_encode($response);
			  exit;
	  }
	  else
	  {
		  
	  	  $response["error"] = TRUE;
		  $response["message"] = "Sorry not able to insert";
		  $response["errr"] = mysqli_error($conn);
		  echo json_encode($response);
			  
		  
	  }
}
  else
  {
	  //Invalid parameters
	  $response["error"] = TRUE;
	  $response["message"] = "Invalid Parameters";
	 
	  echo json_encode($response);
	  exit;
  }
?>