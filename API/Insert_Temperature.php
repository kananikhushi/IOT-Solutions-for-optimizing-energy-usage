<?php
header('Content-Type: application/json');
include('db_config.php');

$response = array();



if(isset($_GET["Temprature"]) && isset($_GET["Humidity"]))
{
	  

	  $Temprature = $_GET["Temprature"];
	  $Humidity = $_GET["Humidity"];

	  $query = "INSERT INTO `temprature_table`(`Temprature`, `Reading_time`, `Humidity`) VALUES('$Temprature',CURRENT_TIMESTAMP(),'$Humidity')";
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