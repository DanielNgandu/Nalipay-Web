<?php
session_start();
	require "connection.php";
$phone_number = $_POST["phone_number"];
	
$sql1 = "select phone_number from users where phone_number = '".$phone_number."';";

$result = mysqli_query($con,$sql1);
$response = array();
if (mysqli_num_rows($result)>0){
$row = mysqli_fetch_row($result);
 $cont = $row[0];
 $code = "success";
array_push($response,array("code"=>$code,"cont"=>$cont));
echo json_encode($response);
	
}
else
{
	
	
	$code = "failed";
	$message = "phone_number not found.......";
	array_push($response, array("code"=>$code,"message"=>$message));
	echo json_encode($response);
	
}

mysqli_close($con);

?>