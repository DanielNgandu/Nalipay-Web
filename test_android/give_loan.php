<?php

require('connection.php');
session_start();

//initialization of variables
$loan_officer_id=$loan_app_id=$group_id=$interest_on_loan=$date_to_pay_back=$years_to_pay_back="";
//Insert Process
//echo print_r($_POST);
$response = array();


    $loan_officer_id = $_POST["admin_id"];
   $loan_app_id= $_POST['loan_app_id'];
    // $group_id = $_POST["group_id"];
    $interest_on_loan= $_POST["interest_on_loan"];
    $date_to_pay_back= $_POST["settlement_date"];
    //   $years_to_pay_back = $_POST["months_to_pay_back"];
       print_r($_POST);
       
        date_default_timezone_set('Africa/Harare');
$today = date("Y-m-d");

 


$ts1 = strtotime($today);
$ts2 = strtotime($date_to_pay_back);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$diff = (((((int)$year2) - ((int)$year1)) * 12) + ((int)$month2 - (int)$month1));
   
   $years_to_pay_back = (int)$diff;
   
$sql_pending = "SELECT * FROM pending_loans WHERE loan_app_id ='".$loan_app_id."'";
    $result_pending = $conn->query($sql_pending);
    $y = 0;
    while($row_pending = $result_pending->fetch_assoc()){
        $user_id = $row_pending["user_id"];
         $group_id = $row_pending["group_id"];
        $application_date = $row_pending["application_date"];
        $loan_amount = $row_pending["amount"];
        $y++;
        
    }

    //interest rate formula
    // A = P(1 + rt)
//     A = P(1 + rt)
//
// Where:
//
//     A = Total Accrued Amount (principal + interest)
//     P = Principal Amount
//     I = Interest Amount
//     r = Rate of Interest per year in decimal; r = R/100
//     R = Rate of Interest per year as a percent; R = r * 100
//     t = Time Period involved in months or years

    // first  covert percent to decimal
  $interest_on_loan_percentage = ((int)$interest_on_loan)/100;
$total_payback_amount = (int)$loan_amount * (1 + $interest_on_loan_percentage * (int)$years_to_pay_back);
//find the interest amount_given
$interet_amt = (int)$total_payback_amount -   (int)$loan_amount;
//  echo $total_payback_amount;
// check if passwords identical, then proceed to insert
     
    
     // retriving groups current balance 
    $sql0 = "SELECT * FROM groups WHERE group_id ='".$group_id."'";
    $result0 = $conn->query($sql0);
    $i = 0;
    while($row3 = $result0->fetch_assoc()){
        
        $group_account_bal = $row3["group_account_bal"];
        $group_name= $row3["group_name"];
        $i++;
    }
   // echo $group_account_bal;
    // retriving loan applicants current balance 
     $sql_query = "SELECT * FROM admin WHERE user_id ='".$user_id."'";
    $result_query = $conn->query($sql_query);
    $x = 0;
    while($row_query = $result_query->fetch_assoc()){
        
        $user_account_bal = $row_query["acc_balance"];
        $x++;
    }
        // echo $user_account_bal;
    
    $owing = $total_payback_amount;
    
    $new_group_account_bal = (int)$group_account_bal-((int)$loan_amount);
    $new_user_account_bal = (int)$user_account_bal+((int)$loan_amount);
    
   // echo $new_user_account_bal;

//    Reduce money from group account before insert
if (((int)$group_account_bal) > ((int)$loan_amount)) {
  
   $sql="INSERT INTO `loans`(`loan_id`, `group_mem_id`, `group_id`, `amount_given`, `interest_charged`, `interest_amt`, `loan_officer_id`, `date_given`, `date_to_payback`, `payback_amt`, `loan_status`, `amount_paid`, `owing`) VALUES (NULL,'$user_id','$group_id','$loan_amount','$interest_on_loan','$interet_amt','$loan_officer_id','$today','$date_to_pay_back','$total_payback_amount','1','0','$owing')";
    $result = $conn->query($sql);

    
    print_r($result);

    if ($result) {
        $sql1 ="INSERT INTO `transactions` (`trans_id`, `group_id`, `trans_date`, `remarks`, `debit`, `credit`, `balance`) VALUES (NULL, '$group_id',CURRENT_TIMESTAMP, 'Approved Loan', '$loan_amount', '0', '$new_group_account_bal')";
    
    
    // naratin on remarks
    $remarks = "Approved loan amount of K".$loan_amount." from ".$group_name." village banking group";
    
    $sql_user ="INSERT INTO `user_log` (`trans_id`, `user_id`, `trans_date`, `remarks`, `debit`, `credit`, `balance`) VALUES (NULL, '$user_id',CURRENT_TIMESTAMP, '$remarks', '0', '$loan_amount', '$new_user_account_bal')";

   
    $result1 = $conn->query($sql1);
    $result_user = $conn->query($sql_user);
        echo 'Insert Successful!';
        //echo $group_account_bal;
        //update group balance after insert
        //$new_group_acc_balance = bcsub($group_account_bal, $loan_amount, 4);
        $new_group_acc_balance = $group_account_bal - $loan_amount;
       // echo $new_group_acc_balance;
        //update group_account balance in table
        $sql1 = "UPDATE groups SET group_account_bal = group_account_bal-'$loan_amount' WHERE group_id='$group_id'";
        $sql1_query = "UPDATE admin SET acc_balance = acc_balance+'$loan_amount' WHERE user_id='$user_id'";
        $sql_pending_loan= "DELETE FROM `pending_loans` WHERE loan_app_id='$loan_app_id'";
        
        if (mysqli_query($conn, $sql1)) {
            mysqli_query($conn, $sql1_query);
            mysqli_query($conn, $sql_pending_loan);
            
            $code ="success";
            array_push($response, array("code"=>$code));
        } else {
            $code = "error";
            array_push($response, array("code"=>$code));
        }

    } else {
      $code=  "Error updating record: " . mysqli_error($conn);
        echo $code ;
    }
    
}else{
        $code = "Insufficient funds!";
}echo json_encode($response);
    //Close connection
    mysqli_close($conn);

?>