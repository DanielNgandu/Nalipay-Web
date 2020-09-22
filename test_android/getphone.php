<?php
session_start();
	require "connection.php";
	
	$group_id =$_POST["group_id"];
	
	
$response = array();
$sql_query="select first_name,phone from loangroupmember WHERE group_id = '".$group_id."';";
$result = mysqli_query($con,$sql_query);
if (mysqli_num_rows($result)>0)
{	$response['success']=1;	
	$groupi = array();
	while($row=mysqli_fetch_array($result))
	{
	array_push($groupi,$row);	
	} 
	$response['groupi']=$groupi;

}else{
	$response["success"]=0;
	$response["Message"]='No data';
	
	
}
echo json_encode($response);

mysqli_close($con);

?>