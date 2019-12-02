<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu
 * Date: 10/01/2019
 * Time: 08:54
 */


//enabe error reporting
//error_reporting(-1);
//ini_set('display_errors', 'On');
//set_error_handler("var_dump");

// Localhost connection
 $servername = "rentzambia.com.mysql"; //replace it with your database server name
 $username = "rentzambia_com_nalipay2019";  //replace it with your database username
 $password = "nalipay@2019";  //replace it with your database password
 $dbname = "rentzambia_com_nalipay2019";

// Online connection
//$servername = "localhost"; //replace it with your database server name
//$username = "danielngandu";  //replace it with your database username
//$password = "nintend0";  //replace it with your database password
//$dbname = "nalipay2019";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{

}
?>
