
<?php
include "session_timeout.php";
session_start();
//require('connection.php');
if(!isset($_SESSION['email'])){
    header("location:login.php?loginFailed=true");

}else{

    //If login is successful, get session id
    if(isset($_SESSION['group_id'])){
        $group_id = $_SESSION['group_id'];
        //echo "".$group_id;
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
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Group Transactions</li>
            </ol>

            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Group Transactions</div>
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        <table id="example" class="table" >
                            <thead>
                            <tr>
                                <th>Group ID</th>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Remarks</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>Group ID</th>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Remarks</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>

                            <tbody>
                            </tbody>
                        </table>

                        <script type="text/javascript">
                            $(document).ready(function () {
                                $('#example').dataTable({
                                    "bProcessing": true,
                                    "sAjaxSource": "get_transactions.php",
                                    "aoColumns": [
                                        {
                                            mData: 'group_id'
                                        },
                                        {
                                            mData: 'trans_id'
                                        },
                                        {
                                            mData: 'trans_date'
                                        },
                                        {
                                            mData: 'remarks'
                                        },
                                        {
                                            mData: 'debit'
                                        },
                                        {
                                            mData: 'credit'
                                        },
                                        {
                                            mData: 'balance'
                                        },
                                        {
                                            mData: 'trans_id',
                                            bSortable: false,
                                            mRender: function(data, type, full) {
                                                return '<a class="btn btn-info btn-lg disabled" href=view_transaction_details_by_id.php?transaction_id=' + full.trans_id + '>' + 'View' + '</a>';
                                            }
                                        }


                                    ]
                                });
                            });
                        </script>
                    </div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
