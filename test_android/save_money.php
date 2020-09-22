<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu ( danielngandu.com | 0975517084 )
 * Date: 09/06/2019
 * Time: 09:35
 */

$user_id = $amount = $receiver = $description = $new_balance = $sender_phone_number = "";
$sender_balance = $receiver_balance = $receiver_id = $receivers_new_balance = $receiver_name = $sender_name = "";
$response = array();

include("../connection.php");
$user_id = $_POST['user_id'];
$amount = $_POST['amount'];
//$receiver = $_POST['receiver'];
$description = $_POST['description'];
//echo $user_id;
//print_r($_POST);
$sql = "SELECT * FROM group_members WHERE group_mem_id = '$user_id'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $sender_id = $row['group_mem_id'];
    $sender_balance = $row['account_balance'];
    $sender_name = $row['first_name'];
    $sender_phone_number = $row['contact_number'];
}


$description_sender = "Saving K" . $amount . " meant for " . $description;
$new_sender_balance = $sender_balance - $amount;


if ($new_sender_balance < 0) {
    //error
    $response['success'] = 0;
    $response["Message"] = 'No data';
    echo "insufficient funds";
} else {


    $money_saving_sql = "INSERT INTO `savings` (`trans_id`, `user_id`, `amount_saved`, `description`,`trans_date`)
 VALUES (NULL,'$user_id','$amount','$description_sender',CURRENT_TIMESTAMP)";

    $result = $conn->query($money_saving_sql);

    //print_r($result);
    echo "\n";
    if ($result) {
        $response['success'] = 1;
        // echo 'Insert Successful!' . "\n";


        //update senders group_account balance in table

        $senders_new_balance_sql = "UPDATE `group_members` SET `account_balance` = '$new_sender_balance' WHERE `group_members`.`group_mem_id` = '$sender_id'";

        $update_result = $conn->query($senders_new_balance_sql);
        //print_r($update_result);
        if ($update_result) {
            $check_senders_new_balance_sql = "SELECT * FROM group_members WHERE `group_mem_id` = '$sender_id'";
            $update_result1 = $conn->query($check_senders_new_balance_sql);

            while ($row = $update_result1->fetch_assoc()) {

                $new_balance = $row['account_balance'];
                // $new_balance = $row['user_id'];

            }
//            echo "Money Sent successfully. New Account balance is ".$new_balance."\n";
            $response["Message"] = 'Money Saved Successfully!';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

    }
}

echo json_encode($response);

mysqli_close($conn);