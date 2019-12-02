<?php
session_start();
	require "initial.php";
	
	$loan_id =$_POST["loan_app_id"];
	
	
$response = array();
$sql_query="select user_id,amount,application_date,owing from pending_loans WHERE loan_app_id = '".$loan_id."';";
$result = mysqli_query($con,$sql_query);
if (mysqli_num_rows($result)>0)
{	
    
	while($row=mysqli_fetch_array($result))
	{
	    
	    $user_id=$row['user_id'];
       $amount = $row[1];
		$application_date = $row[2];
		$owing = $row[3];
 
	} 
//	$response['groupi']=$groupi;
}

$sql= "select first_name,last_name,phone_number,nrc,email from users where user_id = '".$user_id."';";
$result1 = mysqli_query($con,$sql);
if (mysqli_num_rows($result1)>0)
{		
	$rows = mysqli_fetch_row($result1);
		$firstname = $rows[0];
		$last_name = $rows[1];
		$phone_number = $rows[2];
		$nrc = $rows[3];
		$email = $rows[4];
		$code="success";
array_push($response,array("code"=>$code,"firstname"=>$firstname,"last_name"=>$last_name,"phone_number"=>$phone_number,"nrc"=>$nrc,"email"=>$email,"amount"=>$amount,"application_date"=>$application_date,"owing"=>$owing));
echo json_encode($response);

}else{
	$code="failed No data on member selected";
	
	
}



mysqli_close($con);
?>












