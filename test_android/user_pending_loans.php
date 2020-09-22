<?php
/**
 * Created by PhpStorm.
 * User: DANIEL NG`ANDU
 * Date: 03/11/2019
 * Time: 17:44
 */


require "initial.php";
$user_id = $_POST['user_id'];


$sql_query = "select first_name from admin where user_id = '".$user_id."'";
$result_query = mysqli_query($con,$sql_query);
$row_query = mysqli_fetch_array($result_query);
$first_name = $row_query['first_name'];
$aaData=array();
// array_push($aaData,$first_name);

$response = array();
$sql =  "SELECT * FROM pending_loans INNER JOIN groups ON pending_loans.group_id = groups.group_id WHERE user_id='".$user_id."' ";



$result = mysqli_query($con,$sql);
$response['success']=1;

if (mysqli_num_rows($result)>0)
{	$response['success']=1;

    while($row=mysqli_fetch_array($result))
    {
        $tmp = array();
        $tmp =$row;


        $response['aaData'][]= $tmp;
    }

}else{
    $response["success"]=0;
    $response["Message"]='No data';


}
echo json_encode($response);

mysqli_close($con);

?>
*