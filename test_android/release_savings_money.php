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


//Get guys amount
$sql = "SELECT * FROM `group_members` WHERE group_mem_id ='$user_id'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $main_account_balance = $row['account_balance'];

}


if ( $amount_requested > $account_saved) {
    //error

    $response['success'] = 0;
    $response["Message"] = 'No data';
    echo "insufficient funds";
} else {
    $description_sender = "User Released K" . $amount_requested;
    $new_main_balance = $main_account_balance + $amount_requested;

    $money_release_sql = "UPDATE `group_members` SET account_balance = '$new_main_balance' WHERE`group_members`.`group_mem_id` = '$user_id'";

    $result = $conn->query($money_release_sql);

    //print_r($result);
    echo "\n";
    if ($result) {
        $response['success'] = 1;
        // echo 'Insert Successful!' . "\n";


        //update senders savings balance in table
        $neg_amount_saved = -$amount_requested;
        $money_saving_sql = "INSERT INTO `savings` (`trans_id`, `user_id`, `amount_saved`, `description`,`trans_date`)
 VALUES (NULL,'$user_id','$neg_amount_saved','$description_sender',CURRENT_TIMESTAMP)";

        $update_result = $conn->query($money_saving_sql);
        //print_r($update_result);
        if ($update_result) {
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

echo json_encode($response);

mysqli_close($conn);