<?php
session_start();
	require "../connection.php";
	
	//$admin_id =$_POST["admin_id"];
$group_mem_id =$_GET["group_member_id"];
$Balance = "";
$sql_query="SELECT * FROM `group_members` WHERE group_mem_id = '".$group_mem_id."'";
$response = array();
$result = mysqli_query($conn,$sql_query);
if (mysqli_num_rows($result)>0)
{
    $response['success']=1;
    $groupi = array();
    while($row=$result->fetch_assoc()){

		$Balance = number_format($row["account_balance"]);
	    $code = "success";

}
    array_push($response,array("balance"=>$Balance,"code"=>$code));
    echo json_encode($response);
}else{
    $response['success']=0;
    $code = "failed";
array_push($response,array("code"=>$code));
	
	
}
echo json_encode($response);

mysqli_close($conn);

?>