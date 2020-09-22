<?php
$user_id = $amount = $receiver = $description = $new_balance = $sender_phone_number = "";
$sender_balance = $receiver_balance = $receiver_id = $receivers_new_balance = $receiver_name = $sender_name = "";
$response = array();

include("../connection.php");
$user_id = $_POST['user_id'];
$amount = $_POST['amount'];
$receiver = $_POST['receiver'];
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

$sql1 = "SELECT * FROM group_members WHERE contact_number = '$receiver'";
$result1 = $conn->query($sql1);

while ($row = $result1->fetch_assoc()) {
    $receiver_id = $row['group_mem_id'];
    $receiver_phone_number = $row['contact_number'];
    $receiver_name = $row['first_name'];
    $receiver_balance = $row['account_balance'];
}
//echo $receiver_id."\n";
//

$description_sender = "Sent " . $amount . " meant for " . $description . " to " . $receiver_name;
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
        $new_receiver_balance = $receiver_balance + $amount;

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
            //echo "Money Sent successfully. New Account balance is ".$new_balance."\n";
            $response["Message"] = 'Money Sent successfully!';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }


        //        //update receivers group_account balance
        $update_receivers_balance_sql = "UPDATE group_members SET account_balance ='$new_receiver_balance' WHERE group_mem_id='$receiver_id'";
        $update_result1 = $conn->query($update_receivers_balance_sql);

        if ($update_result1) {

            $check_receivers_new_balance_sql = "SELECT * FROM group_members WHERE `group_mem_id` = '$receiver_id'";
            $result1 = $conn->query($check_receivers_new_balance_sql);

            while ($row = $result1->fetch_assoc()) {

                $receivers_new_balance = $row['account_balance'];
            }
            // echo "Money Received successfully. New Account balance is ".$receivers_new_balance."\n";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}

echo json_encode($response);

mysqli_close($conn);