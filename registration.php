<?php
include_once("includes/db_connect.php");
session_start();
if(isset($_GET['city']))
{

	//echo $_GET['city'];
	$_SESSION['city']=$_GET['city'];
	//echo $_SESSION['city'];
}
else if(isset($_SESSION['city']))
{
	header("Location:registration.php?city=$_SESSION[city]");
	unset($_SESSION['city']);
	$_SESSION['city']=="";
	//exit();
	//echo "<script>window.location.href = 'women.php?city=$_SESSION[city]';</script>"; 
}


if(isset($_POST['sub']) && $_POST['sub']=="Create Account")
{
	if(isset($_SESSION['uname']))
	{
		header('Location:card-types.php');
	}
	
	$name=mysql_real_escape_string(trim($_POST['cname']));
	$remail=mysql_real_escape_string(trim($_POST['remail']));
	$rmobile=mysql_real_escape_string(trim($_POST['rmobile']));
	$gender=$_POST['gender'];
	$city=mysql_real_escape_string(trim($_POST['rcity']));
	$pass=md5(mysql_real_escape_string(trim($_POST['pass'])));
	$terms=$_POST['cterms'];
	//echo "$name<br/>$remail<br/>$gender<br/>$pass<br/>$terms";
	if($name=="" || $remail=="" || $pass=="")
	{
		echo '<script> alert("Please Enter Valid Details")</script>';
		header('Refresh:0.0005; url=registration.php');
	}
	
	$search_user=mysql_query("select * from users where email='{$remail}'");
	$srows=mysql_num_rows($search_user);

	$search_mobile=mysql_query("select * from users where mobile='{$rmobile}'");
	$mrows=mysql_num_rows($search_mobile);

	if($srows!=0 && $mrows!=0)
	{
		echo '<script> alert("Email Id and Mobile Number Already Registered With Us")</script>';
		//header('Refresh:0.0005; url=registration.php');
		echo '<script language="JavaScript"> window.location.href ="registration.php" </script>';
	}
	else if($srows!=0)
	{
		echo '<script> alert("Email Id Already Registered With Us")</script>';
		//header('Refresh:0.0005; url=registration.php');
		echo '<script language="JavaScript"> window.location.href ="registration.php" </script>';
	}
	else if($mrows!=0)
	{
		echo '<script> alert("Mobile Number Already Registered With Us")</script>';
		//header('Refresh:0.0005; url=registration.php');
		echo '<script language="JavaScript"> window.location.href ="registration.php" </script>';
	}
	else
	{
		$user_insert=mysql_query("insert into users (full_name, email, pass, gender, mobile, terms, city, rdate, apply_status) values ('$name', '$remail', '$pass', '$gender', '$rmobile', '$terms', '$city', curdate(), 'no')");
		if($user_insert)
		{
			$id=mysql_insert_id();
				/*if($id > '9999')
				{
					$cadd='000000';
				}
				elseif($id > '99999')
				{
					$cadd='00000';
				}
				else if($id > '999999')
				{
					$cadd='0000';
				}
				else
				{
					$cadd='0000000';
				}*/
				$userid="UID".$id;

			$user_update=mysql_query("update users set userid='$userid' where sno='{$id}'");
			if($user_update)
			{
						echo '<script> alert("Congrats You Almost Done. Please Login To Buy Discount Card")</script>';
						header('Refresh:0.0005; url=registration.php');
			}
		}
	}
	
}
if(isset($_POST['sub']) && $_POST['sub']=="Sign In")
{

	if(isset($_SESSION['uname']))
	{
		header('Location:card-types.php');
	}

	$lmail=mysql_real_escape_string(trim($_POST['loginmail']));
	$lpass=mysql_real_escape_string(md5(trim($_POST['loginpass'])));

	if($lmail=="" || $lpass=="")
	{
		header('Location:index.php');
	}
	else
	{
		$check_user=mysql_query("select * from users where email='{$lmail}' and pass='{$lpass}'");
		$crows=mysql_num_rows($check_user);
		if($crows==1)
		{
			$data=mysql_fetch_array($check_user);
			$_SESSION['uname']=$data[2];
			header('Location:card-types.php');
		}
		else
		{
			echo '<script> alert("Invalid Login Details")</script>';
		}
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Discounts Ka Mall - Registration</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary JavaScript plugins) -->
<script type='text/javascript' src="js/jquery-1.11.1.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<!-- start menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script src="js/menu_jquery.js"></script>
<script type="text/javascript">
$(function(){
  $("#city").change(function(){
    window.location='http://www.discountkamall.com/registration.php?city=' + this.value
  });
});
</script>
<script type="text/javascript">
function valid_details()
{
	var con1=/^[a-zA-Z0-9\_\.]+\@[a-zA-Z\.]+\.([a-z]{2,4})$/;
	var con2=/^[789]\d{9}$/;
	
	if(document.getElementById('cname').value=="")
	{
		alert("Please Enter Your Name");
		document.getElementById('cname').focus();
		return false;
	}
	else if(document.getElementById('cname').value.length < 3)
	{
		alert("Please Enter Valid Name");
		document.getElementById('cname').focus();
		return false;
	}
	if(document.getElementById('remail').value=="")
	{
		alert("Please Enter Your Email Id");
		document.getElementById('remail').focus();
		return false;
	}
	else if(!document.getElementById('remail').value.match(con1))
	{
		alert("Please Enter Valid Email Id");
		document.getElementById('remail').focus();
		return false;
	}
	if(document.getElementById('rmobile').value=="")
	{
		alert("Please Enter Your Mobile Number");
		document.getElementById('rmobile').focus();
		return false;
	}
	else if(!document.getElementById('rmobile').value.match(con2))
	{
		alert("Please Enter Valid Mobile Number");
		document.getElementById('rmobile').focus();
		return false;
	}
	if(document.getElementById('rcity').value=="")
	{
		alert("Please Select Your City");
		return false;
	}

	if(document.getElementById('pass').value=="")
	{
		alert("Please Enter Password");
		document.getElementById('pass').focus();
		return false;
	}
	else if(document.getElementById('pass').value.length < 6)
	{
		alert("Password should contain atleast 6 characters");
		document.getElementById('pass').focus();
		return false;
	}
	if(document.getElementById('rpass').value=="")
	{
		alert("Please Retype Password");
		document.getElementById('rpass').focus();
		return false;
	}
	if(document.getElementById('pass').value!=document.getElementById('rpass').value)
	{
		alert("Password and Retype Password Not Matching");
		document.getElementById('rpass').focus();
		return false;
	}
	if(document.getElementById('cterms').checked==false)
	{
		alert("Please Agree Terms of Service To Register");
		return false;
	}
	
}
</script>
<style>
.myselect{
	padding:8px;
	display:block;
	width:100%;
	outline:none;
	font-weight:normal;
	border: 1px solid rgb(231, 231, 231);
}
</style>
</head>
<body>
<!-- header_top -->
<?php include_once('header.php'); ?>
<!-- content -->
<div class="container">
<div class="main">
	<!-- start registration -->
	<div class="registration">
		<div class="registration_left">
		<h2>New user? <span> create an account </span></h2>
		<!-- [if IE] 
		    < link rel='stylesheet' type='text/css' href='ie.css'/>  
		 [endif] -->  
		  
		<!-- [if lt IE 7]>  
		    < link rel='stylesheet' type='text/css' href='ie6.css'/>  
		<! [endif] -->  

		 <div class="registration_form">
		 <!-- Form -->
			<form id="" action="" method="post" onsubmit="return valid_details();">
				<div>
					<label>
						<input placeholder="Your Name" type="text" name="cname" id="cname">
					</label>
				</div>
				
				<div>
					<label>
						<input placeholder="Your Email Id" type="text" name="remail" id="remail">
					</label>
				</div>
				<div>
					<label>
						<input placeholder="Your Mobile Number" type="text" name="rmobile" id="rmobile">
					</label>
				</div>

				<div class="sky-form">
					<div class="sky_form1">
						<ul>
							<li><label class="radio left"><input type="radio" name="gender" checked="checked" value="M"><i></i>Male</label></li>
							<li><label class="radio"><input type="radio" name="gender" value="F"><i></i>Female</label></li>
							<div class="clearfix"></div>
						</ul>
					</div>
				</div>
				<div>
					<label>
						<select class="myselect" name="rcity" id="rcity">
							<option value=""> --- Select Your City --- </option>
							<option value="1">Vijayawada</option>
							<option value="2">Vizag</option>
							<option value="3">Tirupathi</option>
						</select>
					</label>
				</div>
				<div>
					<label>
						<input placeholder="Password" type="password" name="pass" id="pass">
					</label>
				</div>						
				<div>
					<label>
						<input placeholder="Retype Password" type="password" name="rpass" id="rpass">
					</label>
				</div>
				<div class="sky-form">
					<label class="checkbox"><input type="checkbox" name="cterms" id="cterms" value="1" checked="checked"><i></i>i agree to discountkamall.com &nbsp;<a class="terms" href="terms.php"> terms of service</a> </label>
				</div>
				<div>
					<input type="submit" id="register-submit" name="sub" value="Create Account">
				</div>
				
			</form>
			<!-- /Form -->
		</div>
	</div>
	<div class="registration_left">
		<h2>Existing user? <span> Login Here </span></h2>
		
		<div class="registration_form">
		 <!-- Form -->
			<form id="registration_form" action="" method="post">
				<div>
					<label>
						<input placeholder="Registered Email Id" type="email" name="loginmail" tabindex="3" pattern="[a-zA-Z0-9\_\.]+\@[a-zA-Z\.]+\.([a-z]{2,4})$" required>
					</label>
				</div>
				<div>
					<label>
						<input placeholder="password" type="password" name="loginpass" tabindex="4" required>
					</label>
				</div>						
				<div>
					<input type="submit" name="sub" value="Sign In" id="register-submit">
				</div>
				<div class="forget">
					<a href="#">forgot your password</a>
				</div>
			</form>
			<!-- /Form -->
			</div>
	</div>
	<div class="clearfix"></div>
	</div>
	<!-- end registration -->
</div>
</div>
<!-- footer_top -->
<?php include_once('footer.php'); ?>
</body>
</html>