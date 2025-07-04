<?php
header('Content-Type: application/json');
include('db_config.php');

$response = array();



if(isset($_GET["Login_id"]) && isset($_GET["Feedback"]))
{

	  $Login_id = $_GET["Login_id"];
	  $Feedback = $_GET["Feedback"];
	  

	  $query = "INSERT INTO `feedback_table`(`Login_id`, `Reading_time`, `Feedback`) VALUES('$Login_id',CURRENT_TIMESTAMP(),'$Feedback')";
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