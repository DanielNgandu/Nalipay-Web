<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu ( danielngandu.com | 0975517084 )
 * Date: 09/06/2019
 * Time: 09:35
 */

$user_id = $amount = $receiver = $description = $new_balance = $sender_phone_number = $token = "";
$sender_balance = $receiver_balance = $receiver_id = $receivers_new_balance = $receiver_name = $sender_name = "";
$response = array();

include("../connection.php");
$user_id = $_POST['user_id'];
$amount = $_POST['amount'];
//$receiver = $_POST['receiver'];

//echo $user_id;
//print_r($_POST);
$sql = "SELECT * FROM admin WHERE user_id = '$user_id'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $user_id = $row['user_id'];
    $balance = $row['acc_balance'];
   
}

//retriving token
$sql_token = "SELECT * FROM token WHERE user = '$user_id'";
$result_token = $conn->query($sql_token);

while ($row_token = $result_token->fetch_assoc()) {
    $token = $row_token['token'];
   
   
}



$new_main_balance = $balance - $amount;
$description = "You have saved K" . $amount ;

if ($new_main_balance < 0) {
    //error
    $response['success'] = 0;
    $response["Message"] = 'No data';
    echo "insufficient funds";
} else {


    $money_saving_sql = "INSERT INTO `savings` (`trans_id`, `user_id`, `amount_saved`, `description`,`trans_date`)
 VALUES (NULL,'$user_id','$amount','$descriptionr',CURRENT_TIMESTAMP)";
 
$logs = "INSERT INTO `user_log`(`trans_id`, `user_id`, `trans_date`, `remarks`, `debit`, `credit`, `balance`) VALUES (NULL,'$user_id',CURRENT_TIMESTAMP,'$description','0','$amount','$new_main_balance')";

    $result = $conn->query($money_saving_sql);
$result_log = $conn->query($logs);
    //print_r($result);
    echo "\n";
    if ($result) {
        $response['success'] = 1;
        sender_notification();
        // echo 'Insert Successful!' . "\n";


        //update senders group_account balance in table

        $senders_new_balance_sql = "UPDATE `admin` SET `acc_balance` = '$new_main_balance' WHERE user_id = '".$user_id."'";

        $update_result = $conn->query($senders_new_balance_sql);
        //print_r($update_result);
        if ($update_result) {
            $check_senders_new_balance_sql = "SELECT * FROM admin WHERE `user_id` = '$user_id'";
            $update_result1 = $conn->query($check_senders_new_balance_sql);

            while ($row = $update_result1->fetch_assoc()) {

                $new_balance = $row['acc_balance'];
                // $new_balance = $row['user_id'];

            }
//            echo "Money Sent successfully. New Account balance is ".$new_balance."\n";
            $response["Message"] = 'Money Saved Successfully!';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

    }
}

function sender_notification(){

define ('API_ACCESS_KEY', 'AAAAmsEeeAo:APA91bGz37fl8Xf7Vw5LBVfrLqxHSnLLFeME_fEgNv7Xv2EVsd9c1LhZj9FkcpdUfPVedjhFEMQhs0BGaAeFH4mIMGeKaEambeppo73zgrPQlfp79D7vQ7p_-bukAkFB-VP1lgpMl3AU');
//$registrationIds = ;
#prep the bundle

$msg = array (
'body' => $GLOBALS['description'],
'title' => 'Savings',
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
            if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
            curl_close ($ch);
}


echo json_encode($response);

mysqli_close($conn);