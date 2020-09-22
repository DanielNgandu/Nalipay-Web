<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu ( danielngandu.com | 0975517084 )
 * Date: 19/03/2019
 * Time: 08:59
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
    $loan_officer_id = $first_name = $last_name = $email = $contact_no = $nrc =$loan_officer_name
        = $province = $city = $house_address = $loan_amount = $interest_on_loan =
    $password = $confirmpassword = $phone_number = $home_address = $_SESSION["status"] ="";


    if(isset($_GET["loan_id"])){
        $loan_id = $_GET["loan_id"];
        $sql = "SELECT * FROM `loans` INNER JOIN groups ON loans.group_id = groups.group_id  INNER JOIN loan_officers  ON loans.loan_officer_id = loan_officers.loan_officer_id INNER JOIN admin ON loan_officers.user_id = admin.user_id  WHERE loan_id=".$loan_id;
        $result = $conn->query($sql);
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            //$loan_id = $row["loan_id"];
            $group_mem_id = $row["group_mem_id"];
            $group_name = $row["group_name"];
            $group_address = $row["group_address"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $email = $row["email"];
            $nrc = $row["nrc"];
            $phone_number = $row["phone_number"];
            $date_given = $row["date_given"];
            $date_to_payback = $row["date_to_payback"];
            $amount_given = $row["amount_given"];
            $home_address = $row["home_address"];
            $loan_officer_name = $row["first_name"];
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
                <li class="breadcrumb-item active">Overview </li>
            </ol>



            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    View Loan</div>
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
                        <form class="form-sample" action = "edit_loan.php" name="myForm" id="main" method="post">
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
                                        <label class="col-sm-3 col-form-label">Loan ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="asset_id" class="form-control" name="asset_id" value="<?php echo $loan_id;?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input id="asset_type_name" class="form-control" type="text" placeholder="" value="<?php echo $first_name;?>" name="asset_type_name" disabled="disabled">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input id="asset_model" class="form-control" type="text" placeholder="" value="<?php echo $last_name;?>" name="asset_model" disabled="disabled">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">NRC No.</label>
                                        <div class="col-sm-9">
                                            <input id="asset_serial_number" class="form-control" type="text" placeholder="" value="<?php echo $nrc;?>" name="asset_serial_number" disabled="disabled">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Phone#</label>
                                        <div class="col-sm-9">
                                            <input id="asset_sim_number" class="form-control" type="text" placeholder="" value
                                            ="<?php echo $phone_number;?>" name="asset_sim_number" disabled="disabled">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Group</label>
                                        <div class="col-sm-9">
                                            <input id="asset_status" class="form-control" type="text" placeholder="" value="<?php echo $group_name;?>" name="asset_status" disabled="disabled">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Home Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="system_name" class="form-control" name="system_name" value="<?php echo $home_address;?>" placeholder=" " disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Amount Given (K)</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="assignment_station_name" class="form-control" name="assignment_station_name" value="<?php echo $amount_given;?>" placeholder="" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Date Given</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="assignment_station_manager" class="form-control" name="assignment_station_manager" value="<?php echo $date_given;?>" placeholder="" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Date to Payback</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="assignment_station_manager_number" class="form-control" name="assignment_station_manager_number" value="<?php echo $date_to_payback;?>" placeholder="" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Loan Officer</label>
                                        <div class="col-sm-9">
                                            <input id="date_acquired" class="form-control" type="text" placeholder="" value = "<?php echo $loan_officer_name;?>" name="date_acquired" disabled="disabled">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <a href="edit_loan.php?loan_id=<?php echo $loan_id;?>"><button type="button" class="btn btn-danger btn-lg offset-11" name="edit_asset_btn">EDIT</button></a>
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