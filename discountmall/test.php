<?php
$todate=date('Y-m-d');
$expireDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($todate)) . " + 365 days"));
//echo $expireDate;
?>