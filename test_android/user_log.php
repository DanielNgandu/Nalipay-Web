<?php
require "initial.php";
$user_id = $_POST['user_id'];




$response = array();
$aaData=array();
$sql = "select * from user_log where user_id = '".$user_id."' ORDER BY trans_date DESC";

$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result)>0)
{	$response['success']=1;	
	
	while($row=mysqli_fetch_array($result))
	{
        
    $remarks = $row['remarks'];
$trans_date = $row['trans_date'];
 $amount = $row['balance'];
 
 $statement = $remarks." .Your current balance is K".$amount;
 
	
array_push($aaData,array( "remarks"=>$statement,"trans_date" => $trans_date));
	} 
	$response['aaData']=$aaData;

}else{
	$response["success"]=0;
	$response["Message"]='No data';
	
	
}
echo json_encode($response);

mysqli_close($con);

?>
