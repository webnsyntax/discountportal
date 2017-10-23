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
	header("Location:contact.php?city=$_SESSION[city]");
	unset($_SESSION['city']);
	$_SESSION['city']=="";
	//exit();
	//echo "<script>window.location.href = 'women.php?city=$_SESSION[city]';</script>"; 
}
if(isset($_POST['sub']) && $_POST['sub']=="Submit Us")
{
	$uname=mysql_real_escape_string(trim($_POST['uname']));
	if($_POST['umail']=="")
	{
		$umail="Not Provided";
	}
	else
	{
		$umail=mysql_real_escape_string(trim($_POST['umail']));
	}
	$umobile=mysql_real_escape_string(trim($_POST['umobile']));
	$umessage=mysql_real_escape_string(trim($_POST['umsg']));

	//echo "$uname<br/>$umail<br/>$umobile<br/>$umessage";

$admin_mail='support@discountkamall.com';
$subject='A Person Contacted Through Online';
$message='
<html>
<body>
<font size=4>Dear Admin,</font><br/><br/>
&nbsp;&nbsp;Person Details are,<br/>
&nbsp;&nbsp;&nbsp;
<table bgcolor=#fff8dc border=1 cellpadding=3 cellspacing=3>
<tr>
<td>
Name
</td>
<td>:</td>
<td>'.$uname.'</td>
</tr>
<tr>
<td>
Email Id
</td>
<td>:</td>
<td>'.$umail.'</td>
</tr>
<tr>
<td>
Phone Number
</td>
<td>:</td>
<td>'.$umobile.'</td>
</tr>
<tr>
<td>
Message
</td>
<td>:</td>
<td>'.$umessage.'</td>
</tr>
</table>
<br/>
&nbsp;&nbsp;<br/><br/>
&nbsp;&nbsp;<strong><font size=3>Thanks and Regards</font>,</strong><br/>
&nbsp;&nbsp;<font style=font-size:20px;color:#008080;font-weight:bold>Discount Ka Mall</font>
</body>
</html>
';

if($umail!="Not Provided")
{
$user_subject='Your Details Submitted Successfully';
$user_message='
<html>
<body>
<font size=4>Dear '.$uname.',</font><br/><br/>

&nbsp;&nbsp;Thanks for submitting your details at <a href=http://www.discountkamall.com target=_blank>www.discountkamall.com</a> as soon as possible we will get back to you.<br/><br/>
&nbsp;&nbsp;Discount Ka Mall Team is happy to help you. <br/><br/>
&nbsp;&nbsp;For any enquires mail us at support@discountkamall.com or call us on 0866-6888855.
&nbsp;&nbsp;<br/><br/>
&nbsp;&nbsp;<strong><font size=3>Thanks and Regards</font>,</strong><br/>
&nbsp;&nbsp;<font style=font-size:20px;color:#008080;font-weight:bold>Discount Ka Mall Team.</font>
</body>
</html>
';
$mailto_user=mail($umail, $user_subject, $user_message, $headers);
}
$mailto_admin=mail($admin_mail, $subject, $message, $headers);
if($mailto_admin)
{
		
		echo '<script> alert("Your details submitted successfully ") </script>';
		echo '<script language="JavaScript"> window.location.href ="contact.php" </script>';
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Discount Ka Mall - Contact Us</title>
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
    window.location='http://www.discountkamall.com/contact.php?city=' + this.value
  });
});
</script>
<script type="text/javascript">
function valid_details()
{
	var con=/^[789]\d{9}$/;

	if(document.getElementById('uname').value=="")
	{
		alert("Please Enter Your Name");
		document.getElementById('uname').focus();
		return false;
	}
	if(document.getElementById('umobile').value=="")
	{
		alert("Please Enter Your Mobile Number");
		document.getElementById('umobile').focus();
		return false;
	}
	else if(!document.getElementById('umobile').value.match(con))
	{
		alert("Please Enter Valid Mobile Number");
		document.getElementById('umobile').focus();
		return false;	
	}
	if(document.getElementById('umsg').value=="")
	{
		alert("Please Enter Your Message");
		document.getElementById('umsg').focus();
		return false;
	}
}
</script>
</head>
<body>
<!-- header_top -->
<?php include_once('header.php'); ?>

<!-- content -->
<div class="container">
<div class="main">
<div class="contact">				
					<div class="contact_info">
						<h2>Contact Us</h2>
			    	 		<div class="map">
					   			<iframe src="https://www.google.com/maps/d/u/1/embed?mid=z9fXBH4pjzTk.kkZzJ5tj_WwE" width="100%" height="400"></iframe>
					   		</div>
      				</div>
				  <div class="contact-form">
			 	  	 	<h2>Contact Us</h2>
			 	 	    <form method="post" action="" onsubmit="return valid_details();">
					    	<div>
						    	<span><label>Name</label></span>
						    	<span><input type="text" class="textbox" name="uname" id="uname" placeholder="Enter Your Name"></span>
						    </div>
						    <div>
						    	<span><label>E-mail(Optional)</label></span>
						    	<span><input type="text" class="textbox" name="umail" id="umail" placeholder="Enter Your E-mail"></span>
						    </div>
						    <div>
						     	<span><label>Mobile</label></span>
						    	<span><input type="text" class="textbox"name="umobile" id="umobile" placeholder="Enter Your Mobile"></span>
						    </div>
						    <div>
						    	<span><label>Message</label></span>
						    	<span><textarea name="umsg" id="umsg" placeholder="Enter Your Message"></textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" name="sub" value="Submit Us"></span>
						  </div>
					    </form>
				    </div>
  				<div class="clearfix"></div>		
			  </div>
</div>
</div>
<!-- footer_top -->
<?php include_once('footer.php'); ?>
</body>
</html>