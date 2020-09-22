<?php
include("../connection.php");
$group_id = $_POST['group'];
$response = array();


$response['success']=1;	
	$groupi = array();
$sql = "SELECT COUNT(*) as tot FROM group_members WHERE group_id = '$group_id' ";
$result = $conn->query($sql);

$row1 = $result->fetch_assoc();
$tott = $row1['tot'];
            


$sql = "SELECT COUNT(*) as trans FROM transactions WHERE group_id = '$group_id' ";
$result_trans = $conn->query($sql);

$row_trans = $result_trans->fetch_assoc();
$tran=$row_trans['trans'];


$sql1 = "SELECT group_account_bal FROM groups WHERE group_id = '$group_id' ";
$result1 = $conn->query($sql1);

while($row = $result1->fetch_assoc()){
$totall=$row['group_account_bal'];
}
array_push($groupi,array("tot"=>$tott, "trans"=>$tran, "total"=>$totall));
$response['groupi']=$groupi;
echo json_encode($response);

?>