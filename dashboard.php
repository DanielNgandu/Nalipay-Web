
<?php
include "session_timeout.php";
session_start();
require('connection.php');
if(!isset($_SESSION['email'])){
    header("location:login.php?loginFailed=true");
//    it is also best to add exit; after header. Otherwise, your code may want to continue to execute.
    exit;

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

<!--      Count loans-->
      <script>
          $(document).ready(function() {
              $.ajax( {
                  url: "get_loans_count.php",
                  success: function(html) {
                      console.log(html);
                      //html = Number(html).toFixed(2);
                      $("#loans_list").html(html);
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
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body" style="width: 400px">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-money-check"></i>
                  </div>
                    <div class="mr-5"> <p id ="group_accout_bal">K0.0</p> Group Account Balance</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-users"></i>
                  </div>
                    <div class="mr-5"><p id = "group_members">0</p> Group Members</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="view_group_members.php">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-sort-numeric-up"></i>
                  </div>
                    <div class="mr-5"><p id = "loans_list">0.0</p>Loans!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="view_loans.php">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                    <div class="mr-5"><p>13</p> Transactions!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="transactions.php">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>



          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Group Members</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table" >
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>NRC</th>
                            <th>Contact Number</th>
                            <th>Account Bal.</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>NRC</th>
                            <th>Contact Number</th>
                            <th>Account Bal.</th>
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
                                "sAjaxSource": "get_group_members_by_id.php",
                                "aoColumns": [
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
                                        mData: 'nrc'
                                    },
                                    {
                                        mData: 'contact_number'
                                    },
                                    {
                                        mData: 'account_balance'
                                    },
                                    {
                                        mData: 'group_mem_id',
                                        bSortable: false,
                                        mRender: function(data, type, full) {
                                            return '<a class="btn btn-info btn-lg" href=view_member_details_by_id.php?group_mem_id=' + full.group_mem_id + '>' + 'View/Edit' + '</a>';
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
        <!-- Jquery DataTable Plugin Js -->

  </body>

</html>
