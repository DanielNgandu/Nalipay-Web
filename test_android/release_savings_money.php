<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu ( danielngandu.com | 0975517084 )
 * Date: 17/06/2019
 * Time: 17:32
 */

$user_id = $amount = $receiver = $description = $new_balance = $sender_phone_number = $account_saved = $main_account_balance ="";
$sender_balance = $receiver_balance = $receiver_id = $receivers_new_balance = $receiver_name = $sender_name = $description_sender = "";
$response = array();

include("../connection.php");
$user_id = $_POST['user_id'];
$amount_requested = $_POST['amount'];
//$receiver = $_POST['receiver'];
//$description = $_POST['description'];
//echo $user_id;
//print_r($_POST);
$sql = "SELECT SUM(amount_saved) 'total_saved' FROM savings WHERE user_id = '$user_id'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $account_saved = $row['total_saved'];

}

//retrieve token
$sql_token = "SELECT * FROM token WHERE user = '$user_id'";
$result_token = $conn->query($sql_token);

while ($row_token = $result_token->fetch_assoc()) {
    $token = $row_token['token'];
   
   
}


//Get guys amount
$sql = "SELECT * FROM `admin` WHERE user_id ='$user_id'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $main_account_balance = $row['acc_balance'];

}


if ( $amount_requested > $account_saved) {
    //error

    $response['success'] = 0;
    $response["Message"] = 'No data';
    echo "insufficient funds";
} else {
    $description = "Released K" . $amount_requested . " from savings";
    $new_main_balance = $main_account_balance + $amount_requested;
$new_save_balance = $account_saved - $amount_requested;
    $money_release_sql = "UPDATE `admin` SET acc_balance = '$new_main_balance' WHERE`admin`.`user_id` = '$user_id'";

    $result = $conn->query($money_release_sql);

    //print_r($result);
    echo "\n";
    if ($result) {
        
        //call notification functions
        sender_notification();
        reciever_notification();
        
        $response['success'] = 1;
        // echo 'Insert Successful!' . "\n";


        //update senders savings balance in table
        $neg_amount_saved = -$amount_requested;
        $money_saving_sql = "INSERT INTO `savings` (`trans_id`, `user_id`, `amount_saved`, `description`,`trans_date`)
 VALUES (NULL,'$user_id','$neg_amount_saved','$description_sender',CURRENT_TIMESTAMP)";

        $update_result = $conn->query($money_saving_sql);
     //   print_r($update_result);
        if ($update_result) {
            $logs = "INSERT INTO `user_log`(`trans_id`, `user_id`, `trans_date`, `remarks`, `debit`, `credit`, `balance`) VALUES (NULL,'$user_id',CURRENT_TIMESTAMP,'$description','0','$amount_requested','$new_save_balance')";
            $result_log = $conn->query($logs);
            
            $check_savers_new_balance_sql = "SELECT SUM(amount_saved) 'total_saved' FROM savings WHERE user_id = '".$user_id."'";
            $update_result1 = $conn->query($check_savers_new_balance_sql);

            while ($row = $update_result1->fetch_assoc()) {

                $new_balance = $row['total_saved'];
                // $new_balance = $row['user_id'];

            }
//            echo "Money Sent Released. New Account Amount Saved is ".$new_balance."\n";
            $response["Message"] = 'Money Released Successfully!';
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
'title' => 'Release',
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