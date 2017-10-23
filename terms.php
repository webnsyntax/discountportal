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
	header("Location:terms.php?city=$_SESSION[city]");
	unset($_SESSION['city']);
	$_SESSION['city']=="";
	//exit();
	//echo "<script>window.location.href = 'women.php?city=$_SESSION[city]';</script>"; 
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
    window.location='http://www.discountkamall.com/terms.php?city=' + this.value
  });
});
</script>
</head>
<body>
<!-- header_top -->
<?php include_once('non-header.php'); ?>

<!-- content -->
<div class="container">
<div class="women_main">
	<div class="row single">
		<div class="col-md-12">
			<div class="single-bottom1">
				
					<h3>Terms & Conditions</h3>
					<h6>For Sales Outlets</h6>
					<p class="prod-desc">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In which proprietor was responsible for the firm who will sign on behalf of Firm.  The both Firm and Proprietor herein after referred to as SECOND PARTY.</p>
					<p class="prod-desc">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In consideration of the facts that the First Party wishes to provide Discount Cards to their customers in their regular business where the First Party met the Second Party and explained the business pattern and the profile of the company and the nature of the Discount Card and the utilities and benefit to the retailer by providing Discount to the Customers who was shown the Discount Card which was issued by the First Party.  The undersigned Second Party agrees to the following terms:</p>
					<br/>
					<ul style="font-size:14px;">
						<li>1.	The First Party & Second Party was business associates herein after to improve their respective businesses.</li>
						<li>2.	The First Party was responsible for Issuing Discount Cards and their Validity.</li>
						<li>3.	The Second Party was responsible for maintaining the Discount Range on agreed available stock.</li>
						<li>4.	The Discount Card Issued by First Party was valid for One Year / 365 Days.</li>
						<li>5.	The First Party should provide the list of the Discount Card holders to the Second Party to validate and avail the discount for Customer.</li>
						<li>6.	The First Party was whole and sole responsible for Discounts and Card Duplications and any Customer related discrepancies arising out of transactions.</li>
						<li>7.	The Second Party was responsible to honor the valid discount card and issue discount to the customer.</li>
						<li>8.	The First Party and the Second Party could not deviate the agreement in between the Financial Year.</li>
						<li>9.	The First Party approached the Second Party with business proposal of increasing walk-ins to the Second Party outlet by a mutual benefit programme of Discount Cards.  The Discount Cards was issued by the First Party to a valid customer for a time limit of 365 Days in the valid time the Discount Card Holder can avail the discounts in the Second Party's Outlet.</li>
						<li>10.	The Second Party must provide the First Party the percentage of Discount and the Brands in Annexure-I.</li>
						<li>11.	There was no monetary terms and conditions between the First Party and Second Party.  This was a mutual business association and development agreement, which needs no stamping.</li>
						<li>12.	If there was any difference between the First Party and Second Party must be solved by mutual arbitration and conciliation.</li>
					</ul>
			</div>
		</div>
	</div>
</div>
</div>
<!-- footer_top -->
<?php include_once('footer.php'); ?>
</body>
</html>