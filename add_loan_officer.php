<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu ( danielngandu.com | 0975517084 )
 * Date: 11/04/2019
 * Time: 18:40
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
    $loan_officer_id = $first_name = $last_name = $email = $contact_no = $nrc
        = $province = $city = $house_address = $loan_amount = $interest_on_loan =
    $password = $confirmpassword = $phone_number = $home_address = $_SESSION["status"] ="";


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
                <li class="breadcrumb-item active">Add</li>
            </ol>



            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Add Loan Officer</div>
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
                        <form class="form-sample" action = "add_loan_officer_action.php" name="myForm" id="main" method="post">
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
                                        <label class="col-sm-3 col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input id="asset_type_name" class="form-control" type="text" placeholder="First Name" value="" name="f_name" required="required">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input id="l_name" class="form-control" type="text" placeholder="Last Name" value="" name="l_name" required="required">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="email" class="form-control" name="email" value="" placeholder="e.g example@gmail.com" required="required">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">NRC No.</label>
                                        <div class="col-sm-9">
                                            <input id="nrc" class="form-control" type="text" placeholder="NRC" value="" name="nrc" required="required">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Phone#</label>
                                        <div class="col-sm-9">
                                            <input id="asset_sim_number" class="form-control" type="text" placeholder="Phone No." value
                                            ="" name="asset_sim_number" required="required">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Group</label>
                                        <div class="col-sm-9">
                                            <select id="asset_status" class="form-control" type="text"  name="asset_status" required="required">
                                                <option value="">Choose one...</option>
                                                <?php
                                                $sql = "SELECT * FROM groups ";
                                                if ($result = $conn->query($sql)) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $asset_status_id = $row["group_id"];
                                                        $asset_status = $row["group_name"];
                                                        echo "<option value=".$asset_status_id.">".$asset_status."</option>";
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
                                            <input type="text" id="loan_officer_address" class="form-control" name="loan_officer_address" value="" placeholder=" " required="required">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" id="password" class="form-control" name="password" value="" placeholder=" " required="required">
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
                                            <button type="submit" class="btn btn-success btn-lg offset-11" name="add_loan_officer_btn">SAVE</button>
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