<?php
session_start();
	require "connection.php";

	$admin_id =$_POST["admin_id"];
	$group_name =$_POST["group_name"];
//	$number_of_people =$_POST["number_of_people"];
//	$amount =$_POST["amount"];
//	$number_of_days =$_POST["number_of_days"];
//	$total =$_POST["total"];
	$position =$_POST["position"];
//	$pay_day =$_POST["pay_day"];
$total="0";
	
	
	 
	
   
$sql1 = "select acc_number,first_name,last_name,phone_number from users where user_id = '".$admin_id."';";

$result = mysqli_query($con,$sql1);

$response = array();
if ((mysqli_num_rows($result)>0))
{	
		$row = mysqli_fetch_row($result);
		$admin_acc = $row[0];
		$firstname = $row[1];
		$last_name = $row[2];
		$phone_number = $row[3];
    
    
	$cond_sql ="select * from loangroup where group_name = '".$group_name."';";
		$result1 = mysqli_query($con,$cond_sql);
		if((mysqli_num_rows($result1)>0)){
	$code = "failed";
	$message = "Group name already exists.......";
	array_push($response, array("code"=>$code,"message"=>$message));
	echo json_encode($response);} 
    
    else{
    
    
    
	$sql="insert into loangroup(admin_id, group_name, total)values ('".$admin_id."','".$group_name."','".$total."');";
	$contact_sql ="INSERT INTO contacts(admin_id,friend_id) VALUES ('".$admin_id."','".$admin_id."');";
	$result1 = mysqli_query($con,$contact_sql);
	
		
	if(mysqli_query($con,$sql)){
		$sql2 = "select group_id,group_name from loangroup where group_name = '".$group_name."';";
		$res= mysqli_query($con,$sql2);
						if(mysqli_num_rows($res)>0){
						$row = mysqli_fetch_row($res);
								$code = $row[0];
								$message = $row[1];
                            
								$sql3="INSERT INTO loangroupmember(group_id,group_name,member_id,first_name, phone) VALUES ('".$code."','".$group_name."','".$admin_id."','".$firstname."','".$phone_number."');";
							    mysqli_query($con,$sql3);
                            
								$sql4="INSERT INTO `centralbank`(`group_id`, `admin_id`, `admin_acc`) VALUES  ('".$code."','".$admin_id."','".$admin_acc."');";
								mysqli_query($bnk,$sql4);
                            
								$loan_sql1="INSERT INTO `user_acc`(`group_id`, `user_id`) VALUES ('".$code."','".$admin_id."');";
								mysqli_query($bnk,$loan_sql1);	
                            
								$logs_sql="INSERT INTO logs(first_name,last_name,user_id,group_id,acc_number,phone_number) VALUES ('".$firstname."','".$last_name."','".$admin_id."','".$code."','".$admin_acc."','".$phone_number."');";
							  mysqli_query($con,$logs_sql);
                            
//								array_push($response,array("code"=>$code,"message"=>$message));
//								echo json_encode($response);
							
						}
			array_push($response, array("code"=>$code,"message"=>$message));
	echo json_encode($response);}
    }
}


mysqli_close($con);

?>