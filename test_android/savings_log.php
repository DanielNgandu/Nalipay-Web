<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu ( danielngandu.com | 0975517084 )
 * Date: 09/06/2019
 * Time: 10:41
 */

session_start();
require "../connection.php";

$user_id =$_GET["user_id"];


$response = array();
$sql_query="SELECT * FROM savings WHERE user_id = '".$user_id."'";
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