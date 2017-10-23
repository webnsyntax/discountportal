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
	header("Location:search.php?city=$_SESSION[city]");
	unset($_SESSION['city']);
	$_SESSION['city']=="";
	//exit();
	//echo "<script>window.location.href = 'women.php?city=$_SESSION[city]';</script>"; 
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Discount Ka Mall - A new way to get discounts</title>
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
    window.location='http://www.discountkamall.com/search.php?city=' + this.value

  });
});
</script>
<script type="text/javascript">
function valid_card()
{
	if(document.getElementById('cid').value=="")
	{
		alert("Please Enter Card Id");
		document.getElementById('cid').focus();
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
	<!-- start registration -->
	<div class="registration">
		<div class="registration_left">
		<div class="reg_fb"><i>Check User</i><div class="clearfix"></div></div>
		
		 <div class="registration_form">
		 <!-- Form -->
			<form id="registration_form" action="" method="post" onsubmit="return valid_card();">
				<div>
					<label>
						<input placeholder="Enter Card Id" type="text" name="cid" id="cid" tabindex="1">
					</label>
				</div>
				<div>
					<input type="submit" name="sub" value="Submit" id="register-submit">
				</div>

			</form>
			<!-- /Form -->
		</div>
	</div>
	<div class="clearfix"></div>
	</div>
	<!-- end registration -->
	
	<?php
	if(isset($_POST['sub']) && $_POST['sub']=="Submit")
	{
		$cid=mysql_real_escape_string(trim($_POST['cid']));

		$card_details=mysql_query("select * from discards where cardid='{$cid}'");
		$crows=mysql_num_rows($card_details);
		if($crows!=1)
		{
			echo "<div class='alert alert-danger'>
                      Invalid Details..
                    </div>";
		}
		else
		{
			$cdetails=mysql_fetch_array($card_details);
			$uid=$cdetails[1];
			$user_details=mysql_query("select * from users where userid='{$uid}'");

			$udetails=mysql_fetch_array($user_details);

			$uname=$udetails[2];
			$umobile=$udetails[6];
			$udob=$udetails[7];
			$ucity=$udetails[12];
			$uphoto=$udetails[10];
			if($ucity==1)
			{
				$city="Vijayawada";
			}
			else if($ucity==2)
			{
				$city="Vizag";
			}
			else if($ucity==3)
			{
				$city="Tirupathi";
			}


			/*$card_details=mysql_query("select * from discards where userid='{$uid}'");
			$cdetails=mysql_fetch_array($card_details);*/

			$ctype=$cdetails[2];
			$cexpdate=$cdetails[5];
			if($ctype=='single')
			{
				$cardtype="Single";
			}
			else if($ctype=='family4')
			{
				$cardtype="Family(4)";
			}
			else if($ctype=='family5')
			{
				$cardtype="Family(5)";
			}
			else if($ctype=='family6')
			{
				$cardtype="Family(6)";
			}
			else if($ctype=='friends')
			{
				$cardtype="Friends";
			}
			$edate=date('j-n-Y', strtotime($cexpdate));
			$dob=date('j-n-Y', strtotime($udob));

			echo "<div class='single-bottom2'>
					<h6>Card Details</h6>
						<div class='product'>
						   <div class='product-desc' style='width:60%;'>
								<div class='product-img'>
		                           <img src='discountmall/$uphoto' class='img-responsive' alt=''/>
		                       </div>
		                       <div class='prod1-desc'>
		                           <h5><a class='product_link'>Card Id:$cid</a></h5>
		                           <p class='product_descr'>
		                           	Name:$uname<br/>
		                           	Mobile:$umobile<br/>
		                           	DOB:$dob<br/>
		                           	City:$city
		                           </p>									
							   </div>
							  <div class='clearfix'></div>
					      </div>
						  <div class='product_price'>
								<button class='button1' style='width:180px;'>Card Type: $cardtype</button>								
								<button class='button1' style='width:180px;'><span>Expiry Date: $edate</span></button>
		                  </div>
						 <div class='clearfix'></div>
				     </div>
		   	  </div>";

		}
	}
	?>
</div>
</div>
<!-- footer_top -->
<?php include_once('footer.php'); ?>
</body>
</html>