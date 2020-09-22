<?php
session_start();
	require "connection.php";
	
	$first_name =$_POST["first_name"];
	$last_name =$_POST["last_name"];
	$nrc =$_POST["nrc"];
	$DOB =$_POST["DOB"];
	$password = $_POST["password"];
	$acc_number= $_POST["acc_number"];
	$phone_number = $_POST["phone_number"];
	$city = $_POST["city"];
	$email =$_POST["email"];
	
	
    
$sql = "select * from users where phone_number = '".$phone_number."';";

$result = mysqli_query($con,$sql);
$response = array();
if (mysqli_num_rows($result)>0)
{
	$code = "re_failed";
	$message = "User already exist.......";
	array_push($response, array("code"=>$code,"message"=>$message));
	echo json_encode($response);
	 
}
else
{
	 $password = md5($password);
	
	$sql = "insert into users(first_name, last_name, nrc,DOB,acc_number,phone_number,city,email)values('".$first_name."','".$last_name."','".$nrc ."','".$DOB."',
	'".$acc_number."','".$phone_number."','".$city ."','".$email."');";
	
	if(mysqli_query($con, $sql)){
	$sql2 = "INSERT INTO login( phone, password) VALUES ('$phone_number','$password')";
	
		if(mysqli_query($con, $sql2)){
			$code = "re_success";
			$message = "welcom.......";
			array_push($response, array("code"=>$code,"message"=>$message));
			echo json_encode($response);
		}else{
			$code = "result2_failed";
			$message = "User already exist in login.......";
			array_push($response, array("code"=>$code,"message"=>$message));
			echo json_encode($response);
		}
	}else{
			$code = "re_failed";
			$message = "User already .......";
			array_push($response, array("code"=>$code,"message"=>$message));
			echo json_encode($response);
		}
}

mysqli_close($con);

?>