<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`
 * Date: 23/01/2019
 * Time: 21:32
 */




require('connection.php');


$sql = "SELECT * FROM loans";
$result = $conn->query($sql);

$i = 0;

while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $data[] = $row;

}


$results = ["sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data ];


echo json_encode($results);


?>
