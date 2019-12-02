<?php
session_start();
$user_id=$amount=$reciever=$description="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
include ("connection.php");

$user_id = $_POST['user_id'];
$amount = $_POST['amount'];

}

$sql = "SELECT * FROM savings WHERE user_id = '$user_id'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
$balance = $row['balance'];
    $username = $row['username'];
}

$sql1 = "SELECT * FROM bank WHERE user_id = '$user_id'";
$result1 = $conn->query($sql1);

while($row = $result1->fetch_assoc()){
$balance1 = $row['balance'];
    $username1 = $row['username'];
}


$date = new DateTime('now');
$sender = $balance - $amount;
echo $sender;

if($sender < 0){

echo "insufficient funds";

} else{

$reciever1 = $balance1 + $amount;
    
$buba = "INSERT INTO bank(user_id,balance,username,date,description) VALUES ('$user_id1','$reciever1','$username1',NOW(),'$description')";
mysqli_query($conn,$buba);
$buba1 = "INSERT INTO savings(user_id,balance,username,date,description) VALUES ('$user_id','$sender','$username',NOW(),'$description')";
mysqli_query($conn,$buba1);
echo "Succeful";
}


?>