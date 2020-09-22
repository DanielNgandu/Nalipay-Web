<?php
session_start();
	require "connection.php";
	$phone_number = $_POST["phone_number"];
	$admin_id = $_POST["admin_id"];
	$group_id = $_POST["group_id"];
	
	$position =$_POST["position"];
//	$pay_day =$_POST["pay_day"];
	
	$sql = "select user_id,first_name,last_name,acc_number,phone_number from users where phone_number = '".$phone_number."';";
	
	$result = mysqli_query($con,$sql);

	$response = array();

	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_row($result);
		$message = $row[0];
		$first_name = $row[1];
		$last_name = $row[2];
		$acc_number = $row[3];
		$phone_number = $row[4];
		$code = "success";
		array_push($response,array("code"=>$code,"message"=>$message));
		 echo json_encode($response);
        
        
        
        $group ="select group_name from loangroup where group_id = '".$group_id."';";
		$group_result = mysqli_query($con,$group);
        
        if(mysqli_num_rows($group_result)>0){
		$row1 = mysqli_fetch_row($group_result);
		$group_name = $row1['group_name'];
        }
		
					
					$contact_sql ="INSERT INTO contacts(admin_id,friend_id) VALUES ('".$admin_id."','".$message."');";
		$result = mysqli_query($con,$contact_sql);
        
		$logs_sql="INSERT INTO logs(first_name,last_name,user_id,group_id,acc_number,phone_number) VALUES ('".$first_name."','".$last_name."','".$message."','".$group_id."','".$acc_number."','".$phone_number."');";
        $result3 = mysqli_query($con,$logs_sql);
        
			$sql1 = "select user_id,first_name from users where phone_number = '".$phone_number."';";
			$result2 = mysqli_query($con,$sql1);
			
			if(mysqli_num_rows($result2)>0){
				$row = mysqli_fetch_row($result2);
		$firstname = $row[1];
			$loan_sql="INSERT INTO loangroupmember(group_id,group_name,member_id,first_name,phone) VALUES ('".$group_id."','".$group_name."','".$message."','".$firstname."','".$phone_number."');";
			$result = mysqli_query($con,$loan_sql);
			
			$loan_sql1="INSERT INTO `user_acc`(`group_id`, `user_id`) VALUES ('".$group_id."','".$message."');";
					$result1 = mysqli_query($bnk,$loan_sql1);	
						
						array_push($response,array("code"=>$code,"message"=>$message));
							
					echo json_encode($response);
			}else{
			 	array_push($response,array("code"=>$code,"message"=>$message));
		        echo json_encode($response);

			}
		
		
	}
	else
		
		{
			
			$code = "login_failed";
			$message = "user not found";	
			array_push($response,array("code"=>$code,"message"=>$message));
			echo json_encode($response);
		}
		mysqli_close($con);


?>