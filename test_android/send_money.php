<?php
$user_id = $amount = $receiver = $description = $new_balance = $sender_phone_number = "";
$sender_balance = $receiver_balance = $receiver_id = $receivers_new_balance = $receiver_name = $sender_name = "";
$response = array();

include("../connection.php");
$user_id = $_POST['user_id'];
$amount = $_POST['amount'];
$receiver_full = $_POST['receiver'];
$description = $_POST['description'];
$zero = 0;
$receiver = $zero.$receiver_full;

$sql = "SELECT * FROM admin WHERE user_id = '$user_id'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $sender_id = $row['user_id'];
    $sender_balance = $row['acc_balance'];
    $sender_name = $row['first_name'];
    $sender_phone_number = $row['contact_number'];
}

$sql1 = "SELECT * FROM admin WHERE contact_number = '$receiver'";
$result1 = $conn->query($sql1);

while ($rows = $result1->fetch_assoc()) {
    $receiver_id = $rows['user_id'];
    $receiver_phone_number = $rows['contact_number'];
    $receiver_name = $rows['first_name'];
    $receiver_balance = $rows['acc_balance'];
}
//echo $receiver_id."\n";
//

//retrieve senders token
$sql_token_sender = "SELECT * FROM token WHERE user = '$user_id'";
$result_token = $conn->query($sql_token_sender);

while ($row_token = $result_token->fetch_assoc()) {
    $token = $row_token['token'];
}

//retrieve recievers token
$sql_token_reciever = "SELECT * FROM token WHERE user = '$receiver_id'";
$result_token_reciever = $conn->query($sql_token_reciever);

while ($row_token_reciever = $result_token_reciever->fetch_assoc()) {
    $token_reciever = $row_token_reciever['token'];
   
}

$description_sender = "Sent K" . $amount . " meant for " . $description . " to " . $receiver_name;
$description_reciever = "Received " . $amount . " meant for " . $description . " from " . $sender_name;

//$date = new DateTime('now');
//$sender = $sender_balance - $amount;
//echo $sender;
$new_sender_balance = $sender_balance - $amount;


if ($new_sender_balance < 0) {
    //error
    $response['success'] = 0;
    $response["Message"] = 'No data';
    echo "insufficient funds";
} else {


    $money_transfers_sql = "INSERT INTO 
money_transfers(user_id,sender_phone_number,reciever_phone_number,amount_sent,description,transaction_date)
 VALUES ('$user_id','$sender_phone_number','$receiver_phone_number',$amount,'$description_sender',CURRENT_TIMESTAMP)";

    $result = $conn->query($money_transfers_sql);

    //print_r($result);
    echo "\n";
    if ($result) {
        $response['success'] = 1;
        // echo 'Insert Successful!' . "\n";
        $new_receiver_balance = (int)$receiver_balance + (int)$amount;

        //update senders group_account balance in table

        $senders_new_balance_sql = "UPDATE `admin` SET `acc_balance` = '$new_sender_balance' WHERE `admin`.`user_id` = '$user_id'";

        $update_result = $conn->query($senders_new_balance_sql);
        //print_r($update_result);
        if ($update_result) {
            $check_senders_new_balance_sql = "SELECT * FROM admin WHERE `user_id` = '$sender_id'";
            $update_result1 = $conn->query($check_senders_new_balance_sql);
            
            
             $logs = "INSERT INTO `user_log`(`trans_id`, `user_id`, `trans_date`, `remarks`, `debit`, `credit`, `balance`) VALUES (NULL,'$user_id',CURRENT_TIMESTAMP,'$description_sender','0','$amount','$new_sender_balance')";
            $result_log = $conn->query($logs);
            
             $logs2 = "INSERT INTO `user_log`(`trans_id`, `user_id`, `trans_date`, `remarks`, `debit`, `credit`, `balance`) VALUES (NULL,'$receiver_id',CURRENT_TIMESTAMP,'$description_reciever','0','$amount','$new_reciever_balance')";
            $result_log2 = $conn->query($logs2);

            while ($row = $update_result1->fetch_assoc()) {

                $new_balance = $row['acc_balance'];
                // $new_balance = $row['user_id'];

            }
            sender_notification();
         
            //echo "Money Sent successfully. New Account balance is ".$new_balance."\n";
            $response["Message"] = "Money Sent successfully!".$receiver;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }


        //        //update receivers group_account balance
        $update_receivers_balance_sql = "UPDATE admin SET acc_balance ='$new_receiver_balance' WHERE user_id='$receiver_id'";
        $update_result2 = $conn->query($update_receivers_balance_sql);

        if ($update_result2) {

            $check_receivers_new_balance_sql = "SELECT * FROM admin WHERE `user_id` = '$receiver_id'";
            $result_q = $conn->query($check_receivers_new_balance_sql);

            while ($row = $result_q->fetch_assoc()) {

                $receivers_new_balance = $row['account_balance'];
            }
            // echo "Money Received successfully. New Account balance is ".$receivers_new_balance."\n";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}

//NOTIFICATIONS
function sender_notification(){

define ('API_ACCESS_KEY', 'AAAAmsEeeAo:APA91bGz37fl8Xf7Vw5LBVfrLqxHSnLLFeME_fEgNv7Xv2EVsd9c1LhZj9FkcpdUfPVedjhFEMQhs0BGaAeFH4mIMGeKaEambeppo73zgrPQlfp79D7vQ7p_-bukAkFB-VP1lgpMl3AU');
//$registrationIds = ;
#prep the bundle

$msg = array (
'body' => $GLOBALS['description_sender'],
'title' => 'Sent',
);

$fields = array(
    'notification' => $msg,
'to'=>$GLOBALS['token']

);


$headers = array
(
'Authorization: key=' . API_ACCESS_KEY,
'Content-Type: application/json'
);

#Send Response To FireBase Server
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            if ($result){
               reciever_notification();
            }else if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
            curl_close ($ch);
}


// reciever notification
function reciever_notification(){

define ('API_ACCESS_KEY', 'AAAAmsEeeAo:APA91bGz37fl8Xf7Vw5LBVfrLqxHSnLLFeME_fEgNv7Xv2EVsd9c1LhZj9FkcpdUfPVedjhFEMQhs0BGaAeFH4mIMGeKaEambeppo73zgrPQlfp79D7vQ7p_-bukAkFB-VP1lgpMl3AU');
//$registrationIds = ;
#prep the bundle

$msg = array (
'body' => $GLOBALS['description_reciever'],
'title' => 'Recieved',
);

$fields = array(
    'notification' => $msg,
'to'=>$GLOBALS['token_reciever']

);


$headers = array
(
'Authorization: key=' . API_ACCESS_KEY,
'Content-Type: application/json'
);

#Send Response To FireBase Server
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
            curl_close ($ch);
}

echo json_encode($response);

mysqli_close($conn);