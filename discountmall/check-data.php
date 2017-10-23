<?php
include_once("../includes/db_connect.php");
include_once("functions.php");
admin_logincheck();

if(isset($_GET['umobile']))
{

$mobile=$_GET['umobile'];

		$search_sql=mysql_query("select * from users where mobile='{$mobile}'");
		$mrow=mysql_num_rows($search_sql);
		$udata=mysql_fetch_array($search_sql);
		if($mrow>0)
		{
			echo "<span style='color:red;'>Mobile Number Existing</span>";
		}
		else
		{
			echo "<span style='color:green;'>New Mobile Number</span>";
		}

}

if(isset($_GET['uemail']))
{

$email=$_GET['uemail'];

		$search_sql=mysql_query("select * from users where email='{$email}'");
		$mrow=mysql_num_rows($search_sql);
		$udata=mysql_fetch_array($search_sql);
		if($mrow>0)
		{
			echo "<span style='color:red;'>Email Id Existing</span>";
		}
		else
		{
			echo "<span style='color:green;'>New Email Id</span>";
		}

}

if(isset($_GET['uaadhar']))
{

$aadhar=$_GET['uaadhar'];

		$search_sql=mysql_query("select * from users where aid='{$aadhar}'");
		$mrow=mysql_num_rows($search_sql);
		$udata=mysql_fetch_array($search_sql);
		if($mrow>0)
		{
			echo "<span style='color:red;'>Aadhar Card Existing</span>";
		}
		else
		{
			echo "<span style='color:green;'>New Aadhar Card</span>";
		}

}
?>