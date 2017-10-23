<?php
session_start();
unset($_SESSION['uname']);
session_destroy();
include("index.php");
echo '<script> alert("Your are successfully logged out") </script>';
echo '<script language="JavaScript"> window.location.href ="index.php" </script>';
?>