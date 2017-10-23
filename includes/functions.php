<?php
session_start();
function logincheck()
{
if(!isset($_SESSION['uname']) || $_SESSION['uname']=='')
{
session_destroy();
header('Location:index.php');
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 12000)) {
    // last request was more than 5 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();	// destroy session data in storage
	
include("registration.php");
echo '<script> alert("Your session expired. Please login again") </script>';
echo '<script language="JavaScript"> window.location.href ="registration.php" </script>';
}
$_SESSION['LAST_ACTIVITY'] = time();
}
?>