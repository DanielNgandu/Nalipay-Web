
<?php
include "connection.php";
include "session_timeout.php";

session_start();
//require('connection.php');
if(!isset($_SESSION['email'])){
    header("location:login.php?loginFailed=true");

}else{

    //If login is successful, get session id
    if(isset($_SESSION['group_id'])){
        $group_id = $_SESSION['group_id'];
        $admin_id = $_SESSION['admin_id'];
        //echo "".$admin_id;
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
            $("#select_province").click(function() {
                var province_id = $(this).val();
                if(province_id){

                    $.ajax( {
                        url: "load_cities.php",
                        type: "post",
                        data: { province_id : province_id },
                        success: function(html) {
                            //console.log(html);
                            $('#select_city').html(html);
                        }
                    });
                }

            });

            $("#select_city").click(function() {
                var city_id = $(this).val();
                if(city_id){
                    $.ajax( {
                        url: "load_zones.php",
                        type: "post",
                        data: { city_id : city_id },
                        success: function(html) {
                            //console.log(html);
                            $('#select_zones').html(html);
                        }
                    });
                }

            });
        // });

        $("#date_to_pay_back").blur(function() {
            var date = $(this).val();
            // alert("Date"+ date);
                $.ajax( {
                    url: "get_months.php",
                    type: "post",
                    data: { date : date },
                    success: function(html) {
                        // console.log(html);
                        $('#months_to_pay_back').html(html);
                    }
                });


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
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Give Loan</li>
            </ol>



            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Give New Loan</div>
                <div class="card-body">

                    <form class="form-sample" action = "give_loan_action.php" name="myForm" id="main" method="post">
                        <p class="card-description">
                        </p>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group row">
                                        <label class="col-sm-7 col-form-label" hidden="hidden">Loan Officer ID</label>
                                        <div class="col-sm-9">
                                        <input type="text" id="id" class="form-control" name="loan_officer_id" value="<?php echo $admin_id;?>" hidden="hidden">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>

                        <div class="row">

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
                                                    $asset_status_id = $row["group_id"];
                                                    $asset_status = $row["group_name"];
                                                    echo "<option value=".$asset_status_id.">".$asset_status."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-5 messages"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">FirstName</label>
                                    <div class="col-sm-9">
                                        <input id="first_name" class="form-control" type="text" placeholder="" value="" name="first_name" required>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <input id="last_name" class="form-control" type="text" placeholder="" value="" name="last_name" required>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input id="email" class="form-control" type="text" placeholder="" value="" name="email" required>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Phone#</label>
                                    <div class="col-sm-9">
                                        <input id="contact_no" class="form-control" type="text" placeholder="" value
                                        ="" name="contact_no" required>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">NRC</label>
                                    <div class="col-sm-9">
                                        <input id="nrc" class="form-control" type="text" placeholder="xxxxxx/xx/1" value="" name="nrc" required>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Member ID</label>
                                    <div class="col-sm-9">
                                        <input type="number" id="cust_id" class="form-control" name="customer_id" value="" placeholder="Enter customer ID">
                                    </div>
                                </div>
                                <div class="col-sm-5 messages"></div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Province</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="select_province" name="province" required>
                                            <?php
                                            $sql = "SELECT *  FROM provinces ";
                                            if ($result = $conn->query($sql)) {

                                                while ($row = $result->fetch_assoc()){
                                                    $id = $row["province_id"];
                                                    $province_name = $row["province_name"];
                                                    echo "<option value=".$id.">".$province_name."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">City/Town</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="select_city" name="city" required>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Home Address</label>
                                    <div class="col-sm-9">
                                        <input id="house_address" class="form-control" type="text" placeholder="House no. ,Street name,compound etc" value
                                        ="" name="house_address" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">How much (K)?</label>
                                    <div class="col-sm-9">
                                        <input id="loan_amount" class="form-control" type="number" placeholder="K 0.0" value = "" name="loan_amount" required>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Interest on Loan (%)</label>
                                    <div class="col-sm-9">
                                        <input id="interest_on_loan" class="form-control" type="number" placeholder="%"
                                               name="interest_on_loan" required>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date to payback</label>
                                    <div class="col-sm-9">
                                        <input id="date_to_pay_back" class="form-control" type="date" placeholder="DD/MM/YYY"
                                               name="date_to_pay_back" required>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Years</label>
                                    <div class="col-sm-9">
                                        <div id ="months_to_pay_back">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Confirm this transaction:</label>
                                    <div class="col-sm-9">
                                        <input id="password" class="form-control" type="password" placeholder="Enter your Password"  name="password" required>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Confirm Password:</label>
                                    <div class="col-sm-9">
                                        <input id="confirm-password" class="form-control" type="password" placeholder="Confirm password"
                                               name="confirm_password" required>
                                    </div>
                                    <div class="col-sm-5 messages"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-success btn-lg offset-lg-11" name="give_loan_btn">Approve Loan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
