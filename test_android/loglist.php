<?php
session_start();
	require "../connection.php";
	
	$group_id =$_POST["group_id"];
	
	
$response = array();
$sql_query="SELECT * FROM money_transfers WHERE user_id = '".$group_id."'";
$result = mysqli_query($conn,$sql_query);
if (mysqli_num_rows($result)>0){

    $response['success']=1;
	while($row=mysqli_fetch_assoc($result))
	{
        $tmp = array();
        $tmp =$row;


	    $response['transactions'][]= $tmp;
	}

}else{
	$response["success"]=0;
	$response["Message"]='No data';
	
	
}
echo json_encode($response);

mysqli_close($conn);

?>