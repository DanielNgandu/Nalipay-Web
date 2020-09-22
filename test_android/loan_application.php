<?php
session_start();
	require "initial.php";
$response = array();
	$user_id =$_POST["user_id"];
	$group_id =$_POST["group_id"];
    $amount =$_POST["amount"];
    $purpose =$_POST["purpose"];
     date_default_timezone_set('Africa/Harare');
    $today = date("Y-m-d");
    // 	print_r($_POST);


$sql_query="select SUM(payback_amt) AS 'total_payback' from loans WHERE group_mem_id = '".$user_id."'";
$result = mysqli_query($con,$sql_query);

 while($row = mysqli_fetch_array($result)){

    $total_payback = $row['total_payback'];
    
 }   
 
 
 $sql_paid="select SUM(amount_paid) AS 'total_paid' from loans WHERE group_mem_id = '".$user_id."' ";
$result_paid = mysqli_query($con,$sql_paid);

 while($rows = mysqli_fetch_array($result_paid)){

    $paid = $rows['total_paid'];
    
 } 
 
 $owing = $total_payback - $paid;
//  echo $owing;

 
	$sql="INSERT INTO `pending_loans`(`loan_app_id`, `user_id`, `group_id`, `amount`, `purpose`, `application_date`, `owing`) VALUES (NULL,'".$user_id."','".$group_id."','".$amount."','".$purpose."','".$today."','".$owing."');";


	if(mysqli_query($con,$sql)){
         echo $code="success";
        $message = "successful";
        array_push($response, array("code"=>$code,"message"=>$message));
	echo json_encode($response);
    }else {
        echo $code=  "Error updating record: " . mysqli_error($con);
    }

mysqli_close($con);

?>