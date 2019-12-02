<?php
session_start();
	require "initial.php";
	
	$user_id =$_POST["user_id"];
	
	
$response = array();
$sql_query= "select first_name,last_name,phone_number,city,email from users where user_id = '".$user_id."';";
$result = mysqli_query($con,$sql_query);
if (mysqli_num_rows($result)>0)
{		
	$row = mysqli_fetch_row($result);
		$firstname = $row[0];
		$last_name = $row[1];
		$phone_number = $row[2];
	
		$city = $row[3];
		$email = $row[4];
		$code="success";
array_push($response,array("code"=>$code,"firstname"=>$firstname,"last_name"=>$last_name,"phone_number"=>$phone_number,"acc_number"=>$acc_number,"city"=>$city,"email"=>$email));
echo json_encode($response);

}else{
	$code="failed No data on member selected";
	
	
	
}

mysqli_close($con);

?>