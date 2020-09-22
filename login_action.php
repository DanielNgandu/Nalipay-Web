<?php
/*
 * Created by PhpStorm.
 * User: Daniel Ng`andu
 * Date: 10/01/2019
 * Time: 08:47
 */

    include "connection.php";
    /* Avoid multiple sessions warningCheck if session is set before starting a new one. */
    if(!isset($_SESSION)) {
        session_start();
    }
    //checking if for was submitted with inputs
    if(isset($_POST['login_btn']))
    {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $password = sha1($password);

    $sql =  "SELECT * FROM admin WHERE email='".$email."' AND password='".$password."'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

        //fetching data from db as assocaitive array
        while($row=$result->fetch_assoc()){
            //setting our SESSION variables
            $_SESSION['admin_id'] =  $row['user_id'];
            $_SESSION['group_id'] = $row['group_id'];
            $_SESSION['email'] =  $row['email'];
            $first_name=  $row['first_name'];
            $last_name=  $row['last_name'];
           $_SESSION['full_names'] = $first_name." ".$last_name;
        }

        $_SESSION['isAdminValid'] = true;
        $_SESSION['LAST_ACTIVITY'] = time();
        header("location:dashboard.php");
    }
    else {
        session_destroy();
        die(header("location:login.php?loginFailed=true"));
    }
}else{
  echo "Button not set";
  $_SESSION['login_failure'] = "failure";
//  header("location:login.php");
}
?>
