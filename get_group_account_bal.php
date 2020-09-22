<?php
/**
 * Created by PhpStorm.
 * User: Daniel Ng`andu
 * Date: 12/01/2019
 * Time: 21:52
 */


include("connection.php");
session_start();
if(isset($_POST["group_id"])) {
//header("location:login.php?loginFailed=true");
    //$group_id = $_SESSION['group_id'];
    $response = $group_id = "";
    $i = 0;
    $group_id = $_POST["group_id"];
    $json = array();
    $sql = "SELECT * FROM groups WHERE group_id =".$group_id;
    if ($result = $conn->query($sql)) {

        while ($row = $result->fetch_assoc()) {
            $group_id = $row["group_id"];
            $group_name = $row["group_name"];
            $group_account_bal = $row["group_account_bal"];
            echo $group_account_bal;
            $json[] = array(
                'group_name' => $row['group_name'],
                'group_id' => $row['group_id']
            );
            $i++;
        }
    }

    //echo json_encode($json);
}else{
    echo "Error: no results fetched.";
}


?>
