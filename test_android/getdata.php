<?php
session_start();
	require "../connection.php";
	
	$member_id =$_POST["member_id"];
	
	
$response = array();
$sql_query="SELECT * FROM `group_members` INNER JOIN groups ON group_members.group_id = groups.group_id  WHERE group_mem_id = '".$member_id."'";
$code = "success";
$result = mysqli_query($conn,$sql_query);
if (mysqli_num_rows($result)>0)
{	$response['success']=1;
	$groupi = array();
	while($row=mysqli_fetch_array($result))
	{
	    $code = "success";
	array_push($groupi,$row);
	} 
	$response['groupi']=$groupi;

}else{
    $code = "failed";
	$response["success"]=0;
	$response["Message"]='No data';
	
	
}
echo json_encode($response);

mysqli_close($conn);

?>