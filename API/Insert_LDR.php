<?php
header('Content-Type: application/json');
include('db_config.php');

$response = array();



if(isset($_GET["LDR_value"]) && isset($_GET["Device_id"]))
{

	  $LDR_value = $_GET["LDR_value"];
	  $Device_id = $_GET["Device_id"];
	  

	  $query = "INSERT INTO `ldr_table`(`LDR_value`, `Reading_time`, `Device_id`)  VALUES('$LDR_value',CURRENT_TIMESTAMP(),'$Device_id')";
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