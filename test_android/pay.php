<?php
session_start();
	require "connection.php";
	
	$admin_id =$_POST["admin_id"];
	$amount =$_POST["amount"];
	$groupid =$_POST["groupid"];
	
	
$response = array();
$sql_query="select Balance from user_acc where user_id = '".$admin_id."' and group_id = '".$groupid."';";
$result = mysqli_query($bnk,$sql_query);
if (mysqli_num_rows($result)>0)
{	$row = mysqli_fetch_row($result);
		$Balance = $row[0];
		$required = ($amount + ($amount * 0.1));
		if($Balance>=$required){
//			$payment="Last_paid";
			$newbalance = $Balance - $required;
			$sql = "update user_acc set `Balance`='".$newbalance."' where user_id ='".$admin_id."' AND group_id = '".$groupid."';";
			$result1 = mysqli_query($bnk,$sql);
//			$log_sql = "update logs set `payment`='".$payment."' where user_id ='".$admin_id."' AND group_id = '".$groupid."';";
//			$result4 = mysqli_query($con,$log_sql);
			$code = "success";
			$message = "paid.......";
			array_push($response, array("code"=>$code,"message"=>$message));
			echo json_encode($response);
			if($newbalance>0){
				$sqli ="select Balance from centralbank where group_id = '".$groupid."';";	   
				$result2 = mysqli_query($bnk,$sqli);
				$row = mysqli_fetch_row($result2);
		         $adminBalance = $row[0];
				  $currentbala = $adminBalance + $required;
				  $sqll = "update centralbank set `Balance`='".$currentbala."' where group_id = '".$groupid."';";
				  $result3 = mysqli_query($bnk,$sqll);
				  $code = "success";
			$message = "received.......";
			array_push($response, array("code"=>$code,"message"=>$message));
			echo json_encode($response);
			}
		} else{   
		
		  $code = "Failedailed to Pay Insufficent balance......";
			array_push($response, array("code"=>$code));
			echo json_encode($response);
		}
		
		
	
}else{
	$response["success"]=0;
	$response["Message"]='No data';
	
	
}
echo json_encode($response);

mysqli_close($con);

?>