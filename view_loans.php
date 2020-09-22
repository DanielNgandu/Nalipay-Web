<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu
 * Date: 23/01/2019
 * Time: 21:27
 */

include "session_timeout.php";
session_start();
date_default_timezone_set('Africa/Harare');
$today = date("Y-m-d");
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

    <script>
        $(document).ready(function() {
            // $("#select_province").click(function() {
            $.ajax( {
                url: "get_group_account_bal.php",
                type: "post",
                data: { group_id :"<?php echo $group_id; ?>" },
                success: function(html) {
                    //console.log(html);
                    html = Number(html).toFixed(2);

                    $("#group_accout_bal").html("K" + html);
                }
            });
        });

    </script>

    <!--      Count Group members-->
    <script>
        $(document).ready(function() {
            // $("#select_province").click(function() {
            $.ajax( {
                url: "get_number_of_group_members.php",
                type: "post",
                data: { group_id :"<?php echo $group_id; ?>" },
                success: function(html) {
                    //console.log(html);
                    //html = Number(html).toFixed(2);

                    $("#group_members").html(html);
                }
            });
        });

    </script>


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
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">View Loans</li>
            </ol>


            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    List of Loans</div>
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        <table id="example" class="table" >
                            <thead>
                            <tr>
                                <th>Loan ID</th>
                                <th>Member ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>NRC</th>
                                <th>Contact No.</th>
                                <th>Date Given</th>
                                <th>Payment Date</th>
                                <th>Amount Given</th>
                                <th>Interest (%)</th>
                                <th>Payback Amount</th>
                                <th>Status</th>
                                <th>Actions</th>

                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>Loan ID</th>
                                <th>Member ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>NRC</th>
                                <th>Contact No.</th>
                                <th>Date Given</th>
                                <th>Payment Date</th>
                                <th>Amount Given</th>
                                <th>Interest (%)</th>
                                <th>Payback Amount</th>
                                <th>Status</th>
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
                                    "sAjaxSource": "get_loans_given_list.php",
                                    "aoColumns": [
                                        {
                                            mData: 'loan_id'
                                        },
                                        {
                                            mData: 'group_mem_id'
                                        },
                                        {
                                            mData: 'first_name'
                                        },
                                        {
                                            mData: 'last_name'
                                        },
                                        {
                                            mData: 'email',
                                            bSortable: true,
                                            mRender: function(data, type, full) {
                                                return '<a class="btn btn-info btn-md" href="mailto:' + full.email + '">' + 'Email' + '</a>';
                                            }
                                        },
                                        {
                                            mData: 'nrc'
                                        },

                                        {
                                            mData: 'phone_number',
                                            bSortable: true,
                                            mRender: function(data, type, full) {
                                                return '<a class="btn btn-info btn-md" href="tel:' + full.phone_number + '">' + 'Call' + '</a>';
                                            }
                                        },
                                        {
                                            mData: 'date_given'
                                        },
                                        {
                                            mData: 'date_to_payback'
                                        },
                                        {
                                            mData: 'amount_given'

                                        },
                                        {
                                            mData: 'interest_charged'

                                        },
                                        {
                                            mData: 'payback_amt'

                                        },
                                        {
                                            mData: 'date_to_payback',
                                            bSortable: false,
                                            mRender: function(data, type, full) {
                                              var today = "<?php echo $today;?>";
                                              if(full.date_to_payback>today){
                                                return '<a class="btn btn-warning btn-md" href="">' + 'Active' + '</a>';
                                            }else{
                                                return '<a class="btn btn-danger btn-md" href=>' + 'Overdue' + '</a>';
                                            }
                                          }
                                        },
                                        {
                                            mData: 'loan_id',
                                            bSortable: false,
                                            mRender: function(data, type, full) {
                                                return '<a class="btn btn-info btn-md" href=view_loan_details_by_id.php?loan_id=' + full.loan_id + '>' + 'View/Edit' + '</a>';
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
