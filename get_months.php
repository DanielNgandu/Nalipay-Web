<?php
date_default_timezone_set('Africa/Harare');
$today = date("Y-m-d");
if (isset($_POST["date"])) {
  // code...

$date1 = $today;
$date2 = $_POST["date"];

$ts1 = strtotime($date1);
$ts2 = strtotime($date2);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
$years = ($diff / 12);
echo '<input id="months_to_pay_back" class="form-control" type="number" placeholder="0"
       name="months_to_pay_back" required readonly value="'.$years.'">';
}
