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
	header("Location:hotels.php?city=$_SESSION[city]");
	unset($_SESSION['city']);
	$_SESSION['city']=="";
	//exit();
	//echo "<script>window.location.href = 'women.php?city=$_SESSION[city]';</script>"; 
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Discount Ka Mall - Hotels</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
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
<!-- the jScrollPane script -->
<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" id="sourcecode">
			$(function()
			{
				$('.scroll-pane').jScrollPane();
			});
		</script>
<script type="text/javascript">
$(function(){
  $("#city").change(function(){
    window.location='http://www.discountkamall.com/hotels.php?city=' + this.value
  });
});
</script>
</head>
<body>
<!-- header_top -->
<?php include_once('header.php'); ?>
<!-- content -->
<div class="container">
<div class="main">

	
	<!-- start content -->
	<div class="content">
		<?php
		if(isset($_SESSION['city']))
		{
			$get_hotels=mysql_query("select * from discounts where category='Hotels' and city='{$_SESSION['city']}' and status='1'");

		}
		else
		{
			$get_hotels=mysql_query("select * from discounts where category='Hotels' and status='1'");
	
		}
		
		$hotel_rows=mysql_num_rows($get_hotels);
		
		echo "<div class='content_text'>
			<p style='font-size:22px;'>Hotels - $hotel_rows Listed</p>
			</div>";

		//echo $restaurant_rows;
		if($hotel_rows==0)
		{
			echo "<p style='font-size:22px;'> Awesome Discounts On Hotels Are Coming Soon</p>";
		}
		else
		{
			echo "<div class='row grids'>";
			while($hotels=mysql_fetch_array($get_hotels))
			{
				$imgpath=substr("$hotels[7]", 3);
				
				echo "<div class='col-md-3 grid1'>
					<a href='details.php?disid=$hotels[8]'>
					<img src='$imgpath' width='270' height='350' alt='Hotel - Discounts'/>
					<div class='look'>			
						<h4>$hotels[2]</h4>
						<p>$hotels[3]</p>
					</div></a>
				</div>";
			}
			echo "</div>";
		}
		?>
		
			
			
		
		<!-- end grids_of_3 -->
	</div>
	<!-- end content -->
</div>
</div>
<!-- footer_top -->
<?php include_once('footer.php'); ?>
</body>
</html>