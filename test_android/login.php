<?php
session_start();
	require "../connection.php";
//	$phone = $_POST["phone"];
//	$password = $_POST["password"];
//	$password = sha1($password);

$phone = mysqli_real_escape_string($conn, $_POST["phone"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);
$password = sha1($password);
$response = array();
$sql =  "SELECT * FROM admin INNER JOIN group_members ON admin.user_id = group_members.group_mem_id WHERE email='".$phone."' AND password='".$password."'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {

    //fetching data from db as assocaitive array

    while($row=$result->fetch_assoc()){
        //setting our SESSION variables
        $_SESSION['admin_id'] =  $row['user_id'];
        $_SESSION['group_id'] = $row['group_id'];
        $_SESSION['group_mem_id'] = $row['group_mem_id'];
        $group_mem_id = $row['group_mem_id'];
        $user_id = $row['user_id'];
        $group_id = $row['group_id'];
        $_SESSION['email'] =  $row['email'];
        $first_name=  $row['first_name'];
        $last_name=  $row['last_name'];
        $code = "login_success";
        $message = $row['user_id'];
        array_push($response,array("code"=>$code,"message"=>$message,"group_id"=>$group_id,
        "group_mem_id" =>$group_mem_id,"user_id" => $user_id

            ));
    }

    $_SESSION['isAdminValid'] = true;
    $_SESSION['LAST_ACTIVITY'] = time();
    //header("location:dashboard.php");
    echo json_encode($response);
}
else {
    session_destroy();
    //die(header("location:login.php?loginFailed=true"));
}


		mysqli_close($conn);


?>