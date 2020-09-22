

<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu
 * Date: 10/01/2019
 * Time: 11:11
 */
require('connection.php');
session_start();
if(isset($_SESSION['group_id'])){
   //header("location:login.php?loginFailed=true");
    $group_id = $_SESSION['group_id'];
    //echo "<p>Group ID = ".$group_id."</p>";


$sql = "SELECT * FROM group_members WHERE group_id=".$group_id;
$result = $conn->query($sql);


while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $data[] = $row;
}
//var_dump($data);

$results = ["sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data ];


echo json_encode($results);

}else{
    echo "Group ID NOT set!";
}
?>
