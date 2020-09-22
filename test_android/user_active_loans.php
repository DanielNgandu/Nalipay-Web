<?php
require "initial.php";
$user_id = $_POST['user_id'];



$sql_query = "select first_name from admin where user_id = '".$user_id."'";
$result_query = mysqli_query($con,$sql_query);
$row_query = mysqli_fetch_array($result_query);
$first_name = $row_query['first_name'];
$aaData=array();
// array_push($aaData,$first_name);

$response = array();
$sql = "SELECT * FROM loans INNER JOIN groups ON loans.group_id = groups.group_id where owing > 0 AND group_mem_id='".$user_id."' ORDER BY date_given ASC";





$result = mysqli_query($con,$sql);
    $response['success']=1;

if (mysqli_num_rows($result)>0)
{	$response['success']=1;	
	
	while($row=mysqli_fetch_array($result))
	{
        $tmp = array();
        $tmp =$row;


        $response['loans'][]= $tmp;
	} 

}else{
	$response["success"]=0;
	$response["Message"]='No data';
	
	
}
echo json_encode($response);

mysqli_close($con);

?>
