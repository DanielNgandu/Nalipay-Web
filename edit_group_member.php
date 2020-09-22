<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu ( danielngandu.com | 0975517084 )
 * Date: 24/03/2019
 * Time: 16:55
 */

?>

<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu ( danielngandu.com | 0975517084 )
 * Date: 18/03/2019
 * Time: 11:04
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
    $loan_officer_id = $first_name = $last_name = $email = $contact_no = $nrc = $group_name
        = $province = $city = $house_address = $loan_amount = $interest_on_loan = $date_created =
    $password = $confirmpassword = $phone_number = $home_address = $_SESSION["status"] = $account_balance ="";

    $group_id_session = $_SESSION['group_id'];
    if(isset($_GET["group_mem_id"])){
        $group_mem_id = $_GET["group_mem_id"];
        $sql = "SELECT * FROM `group_members` INNER JOIN groups ON group_members.group_id = groups.group_id WHERE group_members.group_id=".$group_id_session." AND  group_mem_id=".$group_mem_id ;
        $result = $conn->query($sql);
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $group_id = $row["group_id"];
            $group_name = $row["group_name"];
            $group_address = $row["group_address"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $nrc = $row["nrc"];
            $phone_number = $row["contact_number"];
            $home_address = $row["address"];
            $date_created = $row["date_created"];
            $account_balance = $row["account_balance"];

        }

    }else{
        echo "ID Not SET!";
    }

}




?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Nalipay - Dashboard</title>
    <!-- Hearder Imports-->

    <?php include "header_imports.php"?>

    <!-- End of Header imports  -->
</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="dashboard.php">Nalipay</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <?php include "navbar_search.php"; ?>
    <!-- End Navbar Search  -->

    <!-- Navbar -->
    <?php include "navbar.php"; ?>

</nav>
<!-- End of Navbar-->

<div id="wrapper">

    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>
    <!-- End of Sidebar -->

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Edit Group Member</li>
            </ol>



            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Edit Member</div>
                <div class="card-body">
                    <div class="container">
                        <?php
                        if ($_SESSION["status"] == "success"){
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            //unset($_SESSION["update_status"]);
                        }elseif($_SESSION["status"] == "failed") {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Failed!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            //unset($_SESSION["update_status"]);
                        }else {
                            ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Form Initialized!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php

                        }
                        ?>
                        <form class="form-sample" action = "edit_group_member_action.php" name="myForm" id="main" method="post">
                            <p class="card-description">
                            </p>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-7 col-form-label" hidden="hidden">User ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="id" class="form-control" name="user_id" value="<?php echo $_SESSION['admin_id'];?>" hidden="hidden">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Member ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="asset_id" class="form-control" name="group_mem_id" value="<?php echo $group_mem_id;?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input id="asset_type_name" class="form-control" type="text" placeholder="" value="<?php echo $first_name;?>" name="first_name" required="required">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input id="asset_model" class="form-control" type="text" placeholder="" value="<?php echo $last_name;?>" name="last_name" required="required">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">NRC No.</label>
                                        <div class="col-sm-9">
                                            <input id="asset_serial_number" class="form-control" type="text" placeholder="" value="<?php echo $nrc;?>" name="nrc" required="required">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Phone#</label>
                                        <div class="col-sm-9">
                                            <input id="asset_sim_number" class="form-control" type="text" placeholder="" value
                                            ="<?php echo $phone_number;?>" name="contact_number" required="required">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Group</label>
                                        <div class="col-sm-9">
                                                <select id="group" class="form-control" type="text"  name="group_id" required="required">
                                                    <option value="">Choose one...</option>

                                                    <?php
                                                    $sql = "SELECT * FROM groups ";
                                                    if ($result = $conn->query($sql)) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $group_id = $row["group_id"];
                                                            $group_name = $row["group_name"];
                                                            echo "<option value=".$group_id.">".$group_name."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Home Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="system_name" class="form-control" name="home_address" value="<?php echo $home_address;?>" placeholder=" " required="required">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Account Bal.(K)</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="assignment_station_name" class="form-control" name="account_balance" value="<?php echo $account_balance;?>" placeholder="" required="required">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Date Registered</label>
                                        <div class="col-sm-9">
                                            <input type="date" id="assignment_station_manager" class="form-control" name="date_created" value="<?php echo $date_created;?>" placeholder="" readonly="readonly" >
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success btn-lg offset-11" name="edit_group_mem_btn">SAVE</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <?php include "footer.php"; ?>
            <!-- End of footer -->

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include "logout_modal.php" ?>
    <!-- End of Logout Modal -->
    <!-- JS Imports -->
    <?php include "js_imports.php"; ?>
    <!-- End of JS imports-->
</body>

</html>
