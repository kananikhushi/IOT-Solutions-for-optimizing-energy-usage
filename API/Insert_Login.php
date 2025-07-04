<?php
header('Content-Type: application/json');
include('db_config.php');

$response = array();



if(isset($_GET["Name"]) && isset($_GET["Contact_no"]) && isset($_GET["Email_id"]) && isset($_GET["Password"]) && isset($_GET["Role"]) && isset($_GET["Status"]) )
{
	  

	  $Name = $_GET["Name"];
	  $Contact_no = $_GET["Contact_no"];
	  $Email_id = $_GET["Email_id"];
	  $Password = $_GET["Password"];
	  $Role = $_GET["Role"];
	  $Status = $_GET["Status"];

	  $query = "INSERT INTO `login_table`(`Name`, `Contact_no`, `Email_id`,`Password`,`Role`,`Status`) VALUES('$Name','$Contact_no','$Email_id','$Password','$Role','$Status')";
	  $result = mysqli_query($conn,$query);
	  // ?Name=kamakshi&Contact_no=8320400801&Email_id=kangan15@gmail.com&Password=abc&Role=1&Status=1
	
	
	  
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