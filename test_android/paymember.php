<?php
session_start();
	require "connection.php";
	
	$admin_id =$_POST["admin_id"];
	$groupid =$_POST["groupid"];
	
	
$response = array();
$total_sql="select total from loangroup where group_id = '".$groupid."';";			
$result5 = mysqli_query($con,$total_sql);
if (mysqli_num_rows($result5)>0)
{	$row = mysqli_fetch_row($result5);
	$total = $row[0];}
$sql_query="select Balance from centralbank where group_id = '".$groupid."';";			
$result = mysqli_query($bnk,$sql_query);
if (mysqli_num_rows($result)>0)
{	$row = mysqli_fetch_row($result);
		$Balance = $row[0];
		if($Balance>=$total){
//			$payment="Has_paid";
			$newbalance = $Balance - $total;
			$sql = "update centralbank set `Balance`='".$newbalance."' where group_id ='".$groupid."';";
					//"update centralbank set `Balance`='".$currentbala."' where group_id = '".$groupid."';";
			$result1 = mysqli_query($bnk,$sql);
			//$log_sql = "update logs set `payment`='".$payment."' where user_id ='".$admin_id."' AND group_id = '".$groupid."';";
			//$result4 = mysqli_query($con,$log_sql);
			$code = "successfully paid member ";
			$message = "paid.......";
			array_push($response, array("code"=>$code,"message"=>$message));
			echo json_encode($response);
			if($total>0){
				$sqli ="select Balance from user_acc where user_id = '".$admin_id."' and group_id = '".$groupid."';";	   
				$result2 = mysqli_query($bnk,$sqli);
				$row = mysqli_fetch_row($result2);
		         $adminBalance = $row[0];
				  $currentbala = $adminBalance + $total;
				  $sqll = "update user_acc set `Balance`='".$currentbala."'where user_id ='".$admin_id."' AND group_id = '".$groupid."';";
				  //"update user_acc set `Balance`='".$newbalance."' where user_id ='".$admin_id."' AND group_id = '".$groupid."';";
				  $result3 = mysqli_query($bnk,$sqll);
				  $code = "successfully paid member";
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