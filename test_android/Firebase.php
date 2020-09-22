<?php
if (isset($_POST['send'])){
send_notification();
}

function send_notification(){

define ('API_ACCESS_KEY', 'AAAAmsEeeAo:APA91bGz37fl8Xf7Vw5LBVfrLqxHSnLLFeME_fEgNv7Xv2EVsd9c1LhZj9FkcpdUfPVedjhFEMQhs0BGaAeFH4mIMGeKaEambeppo73zgrPQlfp79D7vQ7p_-bukAkFB-VP1lgpMl3AU');
//$registrationIds = ;
#prep the bundle

$msg = array (
'body' => 'Firebase Push Notification',
'title' => 'Nalipay',
);

$fields = array(
'to' => $_POST['token'],
'notification' => $msg
);

$headers = array
(
'Authorization: key=' . API_ACCESS_KEY,
'Content-Type: application/json'
);

#Send Response To FireBase Server
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
            echo $result;
            curl_close ($ch);
}
?>