<?php
session_start();
	require "connection.php";
	
	$first_name=$last_name=$nrc=$access_level=$password=$balance=$group=$phone_number=$city=$email="";
	
	

	$first_name =$_POST["first_name"];
	$last_name =$_POST["last_name"];
    $nrc = $_POST["nrc"];
	$access_level = 4;
	$password = $_POST["password"];
	$balance= 0;
	$group= 0;
	$phone_number = $_POST["phone_number"];
	$city = $_POST["city"];
	$address = $_POST['address'];
	$email =$_POST["email"];
	
	
    
$sql = "select user_id from admin where nrc = '".$nrc."'";

$result = mysqli_query($conn,$sql);
print_r($result);
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
    
    $sql_city ="select city_id, province_id from cities where city_name = '".$city."'";
    $result_city = mysqli_query($conn,$sql_city);
$response = array();
$row = mysqli_fetch_array($result_city);

$city_id = $row['city_id'];



    
    
	 $password = SHA1($password);
	
	$sql2 = "INSERT INTO `admin`(`user_id`, `access_level_id`, `city_id`, `first_name`, `last_name`, `email`, `contact_number`, `nrc`, `acc_balance`, `password`, `address`) VALUES (NULL,'$access_level','$city_id','$first_name','$last_name','$email','$phone_number','$nrc','$balance','$password','$address')";
	
		if(mysqli_query($conn, $sql2)){
			$code = "success";
			$message = "welcom.......";
			array_push($response, array("code"=>$code,"message"=>$message));
			echo json_encode($response);
		}else{
			$code = "result2_failed";
			$message = "User already exist in login.......";
			array_push($response, array("code"=>$code,"message"=>$message));
			echo json_encode($response);
		}
}
mysqli_close($conn);

?>