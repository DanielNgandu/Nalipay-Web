<?php
include("connection.php");
$response = $province_id = "";
$i = 0;
$province_id = $_POST["province_id"];
$json = array();
$sql = "SELECT * FROM cities WHERE province_id=".$province_id."";
if ($result = $conn->query($sql)) {

  while ($row = $result->fetch_assoc()){
    $id = $row["city_id"];
    $city_name = $row["city_name"];
  echo "<option value=".$id.">".$city_name."</option>";
    $json[]= array(
   'city_name' => $row['city_name'],
 // 'password' => $row['password']
);
$i++;
  }
}

echo json_encode($json);



?>
