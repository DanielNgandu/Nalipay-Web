<?php
include ("connection.php");
$user_id = $_GET['user_id'];
$json = array();
$sql = "SELECT * FROM bank WHERE user_id = '$user_id' ORDER BY trans_id DESC";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
$json[]=$row;
}

echo json_encode($json);

?>