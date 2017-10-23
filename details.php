<!DOCTYPE HTML>
<html>
<head>
<title>Discount Ka Mall</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary JavaScript plugins) -->
<script type='text/javascript' src="js/jquery-1.11.1.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> </script>
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<!-- start menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script src="js/menu_jquery.js"></script>

<link rel="stylesheet" href="css/etalage.css">
<script src="js/jquery.etalage.min.js"></script>
<script>
			jQuery(document).ready(function($){

				$('#etalage').etalage({
					thumb_image_width: 300,
					thumb_image_height: 400,
					source_image_width: 900,
					source_image_height: 1200,
					show_hint: true
					
				});

			});
		</script>

<!-- the jScrollPane script -->
<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" id="sourcecode">
			$(function()
			{
				$('.scroll-pane').jScrollPane();
			});
		</script> 
</head>
<body>
<!-- header_top -->
<?php include_once('header.php'); ?>
<!-- content -->
<div class="container">
<div class="women_main">
	<!-- start content -->
			<div class="row single">
				<div class="col-md-9">
				<?php
				include_once("includes/db_connect.php");
				if(isset($_GET['disid']))
				{
					$disid=$_GET['disid'];
					$check_disid=mysql_query("select * from discounts where disid='{$disid}'");
					$crows=mysql_num_rows($check_disid);
					if($crows==0)
					{
						header('Location:index.php');
					}
					else
					{
						$ddetails=mysql_fetch_array($check_disid);
						$dimages_query=mysql_query("select * from dimages where disid='{$disid}'");
						$dimages=mysql_fetch_array($dimages_query);
						$imgpath1=substr("$dimages[2]", 3);
						$imgpath2=substr("$dimages[3]", 3);
						$imgpath3=substr("$dimages[4]", 3);
						$imgpath4=substr("$dimages[5]", 3);
						
						echo "<div class='single_left'>
							<div class='grid images_3_of_2'>
						
								
								<ul id='etalage'>
							<li>
								
									<img class='etalage_thumb_image' src='$imgpath1' class='img-responsive/'>
									<img class='etalage_source_image' src='$imgpath1' class='img-responsive' title='' />
								
							</li>
							<li>
								<img class='etalage_thumb_image' src='$imgpath2' class='img-responsive' />
								<img class='etalage_source_image' src='$imgpath2' class='img-responsive' title='' />
							</li>
							
							<li>
								<img class='etalage_thumb_image' src='$imgpath3' class='img-responsive' />
								<img class='etalage_source_image' src='$imgpath3' class='img-responsive' title='' />
							</li>
							
							<li>
								<img class='etalage_thumb_image' src='$imgpath4' class='img-responsive' />
								<img class='etalage_source_image' src='$imgpath4' class='img-responsive' title='' />
							</li>
							
						</ul>
							
						
								<div class='clearfix'></div>		
						  </div>
							<h3>$ddetails[2] - offers $ddetails[3]</h3>

							<br/><br/><h4>Discount Details</h4>
							<p class='prod-desc'>$ddetails[16]</p>

							<br/><br/>
								<h4>Address</h4>
								
							<p class='prod-desc'>$ddetails[4]</p>
							<br/><br/>
							<h4>Contact</h4>
								
							<p class='prod-desc'>$ddetails[5]</p>
							";



							if($ddetails[1]=="Hotels")
							{
								echo "<p class='prod-desc'>Note: For your convenience please call us before one day of your visit.</p>";
							}
						echo "<div class='clearfix'></div>
					   </div>
							<div class='single-bottom1'>
							<h6>Description</h6>
							<p class='prod-desc'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ddetails[6]</p>";
							if($ddetails[13]!="Not Provided")
							{
								echo "<p class='prod-desc'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ddetails[13]</p>";
							}
							if($ddetails[14]!="Not Provided")
							{
								echo "<p class='prod-desc'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ddetails[14]</p>";
							}

							echo "</div>";
					}
				}
				else
				{
					header('Location:index.php');
				}
				?>
				  
				
			
		  </div>	
		<div class="col-md-3">
		Our Ads
		<img class="" src="images/d4.jpg" width="250" height="300" class="img-responsive" />
		</div>
		   <div class="clearfix"></div>		
	  </div>
	<!-- end content -->
</div>
</div>
<!-- footer_top -->
<?php include_once('footer.php'); ?>
</body>
</html>