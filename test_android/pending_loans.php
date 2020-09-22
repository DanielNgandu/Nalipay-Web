<?php
require "initial.php";
$user_id = $_POST['user_id'];
$group_id = $_POST['group_id'];


$sql_query = "select first_name from admin where user_id = '".$user_id."'";
$result_query = mysqli_query($con,$sql_query);
$row_query = mysqli_fetch_array($result_query);
$first_name = $row_query['first_name'];
$aaData=array();
// array_push($aaData,$first_name);

$response = array();
$sql = "select * from pending_loans where group_id = '".$group_id."'";

$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result)>0)
{	$response['success']=1;	
	
	while($row=mysqli_fetch_array($result))
	{
    $amount = $row['amount'];
    $loan_app_id = $row['loan_app_id'];
	array_push($aaData,array( "first_name"=>$first_name,"loan_app_id" => $loan_app_id, "amount" => $amount));
	} 
	$response['aaData']=$aaData;

}else{
	$response["success"]=0;
	$response["Message"]='No data';
	
	
}
echo json_encode($response);

mysqli_close($con);

?>
