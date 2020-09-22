<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu ( danielngandu.com | 0975517084 )
 * Date: 18/04/2019
 * Time: 15:25
 */

include "session_timeout.php";
session_start();
require('connection.php');
if(!isset($_SESSION['email'])){
    header("location:login.php?loginFailed=true");
//    it is also best to add exit; after header. Otherwise, your code may want to continue to execute.
    exit;



}else{
    //variable init
    $asset_type_name =  $asset_model = $asset_serial_number = $asset_sim_number = $date_acquired =
    $assignment_station_name = $assignment_station_manager = $assignment_station_manager_number =
    $asset_status = $system_name = $asset_condition_comment= $company_name =  $asset_imei ="";

//echo print_r($_POST);
    if(isset($_POST['edit_group_mem_btn'])) {
         echo print_r($_POST);
        $user_id = $_POST["user_id"];
        $group_mem_id = $_POST["group_mem_id"];
        $group_id = $_POST["group_id"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $nrc = $_POST["nrc"];
        $phone_number = $_POST["contact_number"];
        $home_address = $_POST["home_address"];
        $date_created = $_POST["date_created"];
        $account_balance = $_POST["account_balance"];


        //Run Updates
        if(isset($user_id)) {
            $sql0 = "UPDATE `group_members`
                     SET `modified_by` = '$user_id', 
                    `group_id` = '$group_id',
                    `first_name` = '$first_name',
                    `last_name` = '$last_name',
                    `nrc` = '$nrc',
                    `contact_number` = '$phone_number',
                    `address` = '$home_address',
                    `account_balance` = '$account_balance'
            
                    WHERE `group_members`.`group_mem_id` =$group_mem_id";

            if ($result0 = $conn->query($sql0)) {
                //no error

                $_SESSION["asset_type_name"] = "Group member details UPDATED!";
                echo "\n".$_SESSION["asset_type_name"]."\n";

            } else {
                // error
                $_SESSION["asset_type_name"] = "Group member details UPDATE FAILED!";
                echo "\n".$_SESSION["asset_type_name"]."\n";
            }
        }else{
            echo "asset_type_name NOT SET";
        }


        $_SESSION["status"] = "success";

        header("location:view_member_details_by_id.php?group_mem_id=".$group_mem_id);

    }else{
        // error
        $_SESSION["btn_not_set"] = "Form NOT successfully submitted!";
        echo "\n".$_SESSION["Button Not SET!"];
        $_SESSION["status"] = "failure";
        //header("location:view_asset_details_by_id.php?asset_id=".$asset_id);

    }
}



?>