<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu ( danielngandu.com | 0975517084 )
 * Date: 16/04/2019
 * Time: 06:11
 */



include "session_timeout.php";
session_start();
require('connection.php');
if(!isset($_SESSION['email'])){
    header("location:login.php?loginFailed=true");
//    it is also best to add exit; after header. Otherwise, your code may want to continue to execute.
    exit;



}else {
    //variable init
    $asset_type_name = $asset_model = $asset_serial_number = $asset_sim_number = $date_acquired =
    $assignment_station_name = $assignment_station_manager = $assignment_station_manager_number =
    $asset_status = $system_name = $asset_condition_comment = $asset_id = $company_id ="";

//echo print_r($_POST);
    if (isset($_POST['add_group_btn'])) {
        echo print_r($_POST);
        $group_name = $_POST["group_name"];
        $account_balance = $_POST["account_balance"];
        $group_address = $_POST["group_address"];
        $user_id = $_POST["user_id"];
        if(!isset($date_created)){
            date_default_timezone_set('Africa/Harare');
            $today = date("Y/m/d");
            $date_created = $today;
        }
        //Run Insert Query

        if (isset($user_id)) {
            $sql1 = "INSERT INTO `groups` (`group_id`, `group_name`, `group_address`, `group_account_bal`, `created_by`, `date_created`) VALUES (NULL, '$group_name', '$group_address', '$account_balance', '$user_id', '$date_created')";

            if ($result1 = $conn->query($sql1)) {
                //no error
                $_SESSION["insert_success"] = "Group ADDED!";
                $_SESSION["status"] = "success";
                echo "\n" . $_SESSION["insert_success"];
//                $sql = "SELECT loan_officer_id,user_id FROM loan_officers";
//                $result = $conn->query($sql);
//                while($row = $result->fetch_array(MYSQLI_ASSOC)){
//                    $asset_id = $row["loan_officer_id"];
//                    $company_id = $row["user_id"];
//                }
                //header("location:view_asset_details_by_id.php?asset_id=".$asset_id."&company_id=".$_SESSION["company_name"]);


            } else {
                // error

                $_SESSION["insert_failure"] = "Group add FAILED!";
                echo "\n" . $_SESSION["insert_failure"];
                $_SESSION["status"] = "failure";
//                $sql = "SELECT MAX(asset_id) as 'last_id' FROM assets ";
//                $result = $conn->query($sql);
//                while($row = $result->fetch_array(MYSQLI_ASSOC)){
//                    $asset_id = $row["last_id"];
//                }
//                header("location:view_asset_details_by_id.php?asset_id=".$asset_id);

            }



        } else {
            echo "User ID not SET!";
        }


    }
}



?>