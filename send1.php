<?php
session_start();
$user_id=$amount=$reciever=$description="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
include ("connection.php");

$user_id = $_POST['user_id'];
$amount = $_POST['amount'];
$reciever = $_POST['reciever'];
$description = $_POST['description'];
}

$sql = "SELECT * FROM bank WHERE user_id = '$user_id'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
$balance = $row['balance'];
    $username = $row['username'];
}

$sql1 = "SELECT * FROM user WHERE phone = '$reciever'";
$result1 = $conn->query($sql1);

while($row = $result1->fetch_assoc()){
$user_id1 = $row['id'];
    $username1 = $row['username'];
}


$sql2 = "SELECT * FROM bank WHERE user_id = '$user_id1'";
$result2 = $conn->query($sql2);

while($row = $result2->fetch_assoc()){
$balance2 = $row['balance'];
     
}
$description_sender="Sent ".$amount." meant for ".$descrrption. " to ".$username1;
$description_reciever="Recieved ".$amount." meant for ".$descrrption. " from ".$username;

$date = new DateTime('now');
$sender = $balance - $amount;
echo $sender;

if($sender < 0){

echo "insufficient funds";

} else{

$reciever1 = $balance2 + $amount;
    
$buba = "INSERT INTO bank(user_id,balance,username,date,description) VALUES ('$user_id1','$reciever1','$username1',NOW(),'$description_reciever')";
mysqli_query($conn,$buba);
$buba1 = "INSERT INTO bank(user_id,balance,username,date,description) VALUES ('$user_id','$sender','$username',NOW(),'$description_sender')";
mysqli_query($conn,$buba1);
echo "Succeful";
}


?>