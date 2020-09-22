<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu
 * Date: 10/01/2019
 * Time: 11:11
 */



require('connection.php');


$sql = "SELECT * FROM transactions";
$result = $conn->query($sql);


while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $data[] = $row;
}


$results = ["sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "success" => 1,
    "aaData" => $data ];


echo json_encode($results);


?>
