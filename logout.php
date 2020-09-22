<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu
 * Date: 10/01/2019
 * Time: 11:46
 */

    include "connection.php";

    session_start();
    session_destroy();

    if (isset($_GET['sessionExpired'])) {
        header("location:session_expired.php");
    }
    else {
        header("location:dashboard.php");
    }
?>
