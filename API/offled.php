<?php
header('Content-Type: application/json');
include('db_config.php');

$response = array();

	  



	  $query = "UPDATE `led` SET `status`='OFF' WHERE id = 1";
	  $result = mysqli_query($conn,$query);
	  
	
	
	  
	  if($result)
	  {
	
		  
			  $response["error"] = FALSE;
			  $response["message"] = "LED IS OFF";
			  echo json_encode($response);
			  exit;
	  }
	  else
	  {
		  
	  	  $response["error"] = TRUE;
		  $response["message"] = "NOT ABLE TO TURN OFF LED";
		  $response["errr"] = mysqli_error($conn);
		  echo json_encode($response);
			  
		  
	  }


?>