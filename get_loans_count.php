<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu ( danielngandu.com | 0975517084 )
 * Date: 17/04/2019
 * Time: 21:15
 */


require('connection.php');


$sql = "SELECT * FROM loans";
$result = $conn->query($sql);

$i = 0;

while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $i++;

}


echo json_encode($i);


?>
