<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu
 * Website: danielngandu.com
 * Date: 20/01/2019
 * Time: 00:22
 */
require('connection.php');
session_start();

//initialization of variables
$loan_officer_id = $first_name = $last_name = $email = $contact_no = $nrc = $province = $city = $house_address = $loan_amount = $interest_on_loan = $password = $confirmpassword = "";
//Insert Process
//echo print_r($_POST);
if(isset($_POST['give_loan_btn']))
{
    //echo print_r($_POST);
    $loan_officer_id = $_POST["loan_officer_id"];
    // echo $loan_officer_id." ";
    $customer_id = $_POST["customer_id"];
    // echo $customer_id." ";
    $group_id = $_POST["group_id"];
    // echo $group_id." ";

    $first_name = $_POST["first_name"];
    // echo $first_name." ";
    $last_name = $_POST["last_name"];
    $last_name = mysqli_real_escape_string($conn,$last_name);
    // echo $last_name." ";
    $email = $_POST["email"];
    $contact_no = $_POST["contact_no"];
    $nrc = $_POST["nrc"];
    $province = $_POST["province"];
    $city = $_POST["city"];
    $house_address = $_POST["house_address"];
    $loan_amount = $_POST["loan_amount"];
    $interest_on_loan= $_POST["interest_on_loan"];
    $date_to_pay_back= $_POST["date_to_pay_back"];
    $years_to_pay_back = $_POST["months_to_pay_back"];
    // echo $years_to_pay_back;
    // echo $date_to_pay_back;
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirm_password"];

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
  echo   $interest_on_loan_percentage = $interest_on_loan/100;
$total_payback_amount = $loan_amount * (1 + $interest_on_loan_percentage * $years_to_pay_back);
//find the interest amount_given
$interet_amt = $total_payback_amount -   $loan_amount;
// echo "Total".$total_payback_amount;
// check if passwords identical, then proceed to insert
       if ($password == $confirmpassword) {
           echo "Success!";
           echo print_r($_POST);
    $sql0 = "SELECT * FROM groups WHERE group_id =".$group_id;
    $result0 = $conn->query($sql0);
    $i = 0;
    while($row3 = $result0->fetch_assoc()){
        $group_id = $row3["group_id"];
        $group_name = $row3["group_name"];
        $group_account_bal = $row3["group_account_bal"];
        $i++;
    }

//    Reduce money from group account before insert
if ($group_account_bal > $loan_amount) {
    $sql = "INSERT INTO loans (`loan_id`, `group_mem_id`, `group_id`, `first_name`, `last_name`, `email`, `phone_number`, `nrc`, `province`, `city`, `home_address`, `amount_given`, `interest_charged`,`interest_amt`,  `loan_officer_id`, `date_given`, `date_to_payback`,`payback_amt`)
    VALUES (NULL, '$customer_id', '$group_id', '$first_name', '$last_name', '$email', '$contact_no', '$nrc', '$province', '$city', '$house_address', '$loan_amount', '$interest_on_loan','$interet_amt', '$loan_officer_id', CURRENT_TIMESTAMP, '$date_to_pay_back',$total_payback_amount)";
$sql1 ="INSERT INTO `transactions` (`trans_id`, `group_id`, `trans_date`, `remarks`, `debit`, `credit`, `balance`) VALUES (NULL, 'group_id',CURRENT_TIMESTAMP, 'Given Loan.', '0', '$loan_amount', '0')";

    $result = $conn->query($sql);
    $result1 = $conn->query($sql1);

    if ($result) {
        echo 'Insert Successful!';
        //echo $group_account_bal;
        //update group balance after insert
        //$new_group_acc_balance = bcsub($group_account_bal, $loan_amount, 4);
        $new_group_acc_balance = $group_account_bal - $loan_amount;
       // echo $new_group_acc_balance;
        //update group_account balance in table
        $sql1 = "UPDATE groups SET group_account_bal = group_account_bal-'$loan_amount' WHERE group_id='$group_id'";
        if (mysqli_query($conn, $sql1)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        header("location:view_loans.php");
        exit;
    } else {
        echo "Error upon update";
    }
    if ($result1) {
        echo 'Insert Successful!';
        //header("location:transactions.php");
        exit;
    } else {
        echo "Error upon update";
    }
}else{
        echo "Insufficient funds!";
}
    //Close connection
    mysqli_close($conn);

}
}else{
    echo "Button not SET!";
}
?>
