<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu
 * Date: 14/01/2019
 * Time: 22:28
 */


require('connection.php');
session_start();
if(isset($_POST["group_id"])){
   //header("location:login.php?loginFailed=true");
    $group_id = $_POST["group_id"];
//    echo "<p>Group ID = ".$group_id."</p>";


$sql = "SELECT * FROM group_members WHERE group_id=".$group_id;
$result = $conn->query($sql);

$i = 0;
while($row = $result->fetch_assoc()){
    //$data[] = $row["group_mem_id"];
    $i++;
}
//var_dump($data);

//$results = ["sEcho" => 1,
//    "iTotalRecords" => count($data),
//    "iTotalDisplayRecords" => count($data),
//    "aaData" => $data ];


echo json_encode($i);

}else{
    echo "Group ID NOT set!";
}
?>
