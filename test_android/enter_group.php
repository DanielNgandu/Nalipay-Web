<?php
session_start();
	require "../connection.php";
$member_id = $_POST["member_id"];
//$group = $_POST["group"];

$sql_query="SELECT * FROM `group_members` INNER JOIN groups ON group_members.group_id = groups.group_id  WHERE group_mem_id = '".$member_id."'";

$result1 = mysqli_query($conn,$sql_query);
$response = array();

if (mysqli_num_rows($result1)>0){
$row = mysqli_fetch_row($result1);
		$groupid = $row[1];
		$amount = $row[7];
		$admin_id = $row[0];
		$code = "success";
array_push($response,array("code"=>$code,"groupid"=>$groupid,"amount"=>$amount,"member_id"=>$member_id,"admin_id"=>$admin_id));
echo json_encode($response);
	
}
else {
	$code = "failed";	
			array_push($response,array("code"=>$code));
			echo json_encode($response);
}

mysqli_close($conn);

?>