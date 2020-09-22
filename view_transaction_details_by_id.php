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
    $asset_type_name =  $asset_model = $asset_serial_number = $asset_sim_number = $date_acquired =
    $assignment_station_name = $assignment_station_manager = $assignment_station_manager_number =
    $asset_status = $system_name = $asset_condition_comment=  "";

    if(isset($_GET["transaction_id"])){
        $transaction_id = $_GET["transaction_id"];
        $sql = "SELECT * FROM `transactions` INNER JOIN groups ON transactions.group_id = groups.group_id  WHERE transactions.trans_id=".$transaction_id;
        $result = $conn->query($sql);
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $asset_type_name = $row["asset_type_name"];
            $asset_model = $row["asset_model"];
            $asset_serial_number = $row["asset_serial_number"];
            $asset_sim_number = $row["asset_sim_number"];
            $date_acquired = $row["date_acquired"];
            $assignment_station_name = $row["assignment_station_name"];
            $assignment_station_manager = $row["assignment_station_manager"];
            $assignment_station_manager_number = $row["assignment_station_manager_number"];
            $asset_status = $row["asset_status"];
            $system_name = $row["system_name"];
            $asset_condition_comment = $row["asset_condition_comment"];
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
                <li class="breadcrumb-item active">View Transaction</li>
            </ol>



            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    View Asset</div>
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
                        }else {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Failed!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            //unset($_SESSION["update_status"]);
                        }
                        ?>
                        <form class="form-sample" action = "edit_transaction_action.php" name="myForm" id="main" method="post">
                            <p class="card-description">
                            </p>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-7 col-form-label" hidden="hidden">User ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="id" class="form-control" name="user_id" value="<?php echo $_SESSION['user_id'];?>" hidden="hidden">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Transaction ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="asset_id" class="form-control" name="asset_id" value="<?php echo $transaction_id;?>" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Asset Type</label>
                                        <div class="col-sm-9">
                                            <input id="asset_type_name" class="form-control" type="text" placeholder="" value="<?php echo $asset_type_name;?>" name="asset_type_name" disabled="disabled">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Model</label>
                                        <div class="col-sm-9">
                                            <input id="asset_model" class="form-control" type="text" placeholder="" value="<?php echo $asset_model;?>" name="asset_model" disabled="disabled">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Serial No.</label>
                                        <div class="col-sm-9">
                                            <input id="asset_serial_number" class="form-control" type="text" placeholder="" value="<?php echo $asset_serial_number;?>" name="asset_serial_number" disabled="disabled">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Phone#</label>
                                        <div class="col-sm-9">
                                            <input id="asset_sim_number" class="form-control" type="text" placeholder="" value
                                            ="<?php echo $asset_sim_number;?>" name="asset_sim_number" disabled="disabled">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <input id="asset_status" class="form-control" type="text" placeholder="" value="<?php echo $asset_status;?>" name="asset_status" disabled="disabled">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">System</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="system_name" class="form-control" name="system_name" value="<?php echo $system_name;?>" placeholder=" " disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Station</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="assignment_station_name" class="form-control" name="assignment_station_name" value="<?php echo $assignment_station_name;?>" placeholder="" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Station Manager</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="assignment_station_manager" class="form-control" name="assignment_station_manager" value="<?php echo $assignment_station_manager;?>" placeholder="" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Manager Contact</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="assignment_station_manager_number" class="form-control" name="assignment_station_manager_number" value="<?php echo $assignment_station_manager_number;?>" placeholder="" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Date Acquired</label>
                                        <div class="col-sm-9">
                                            <input id="date_acquired" class="form-control" type="text" placeholder="" value = "<?php echo $date_acquired;?>" name="date_acquired" disabled="disabled">
                                        </div>
                                        <div class="col-sm-5 messages"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Asset Condition Comment</label>
                                        <div class="col-sm-9">
                                            <textarea id="asset_condition_comment" class="form-control"   name="asset_condition_comment" disabled="disabled"><?php echo $asset_condition_comment;?></textarea>
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
                                            <a href="edit_asset.php?asset_id=<?php echo $asset_id;?>"><button type="button" class="btn btn-danger btn-lg offset-11" name="edit_asset_btn">EDIT</button></a>
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