<?php
header('Content-Type: application/json');
include('db_config.php');

$response = array();

	  



	  $query = "UPDATE `led` SET `status`='ON' WHERE id = 1";
	  $result = mysqli_query($conn,$query);
	  
	
	
	  
	  if($result)
	  {
	
		  
			  $response["error"] = FALSE;
			  $response["message"] = "LED IS ON";
			  echo json_encode($response);
			  exit;
	  }
	  else
	  {
		  
	  	  $response["error"] = TRUE;
		  $response["message"] = "NOT ABLE TO TURN ON LED";
		  $response["errr"] = mysqli_error($conn);
		  echo json_encode($response);
			  
		  
	  }


?>