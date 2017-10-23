<div class="top_bg">
<div class="container">
<div class="header_top">
	<div class="top_left">
		<h2><a href="#">Discount Card</a> one card for all discounts</h2>
	</div>
	<div class="top_right">
		<ul>
			<li><a href="#">Hi, <?php echo $_SESSION['uname']; ?></a></li>|
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div class="clearfix"> </div>
</div>
</div>
</div>
<!-- header -->
<div class="header_bg">
<div class="container">
	<div class="header">
		<div class="logo">
			<a href="card-types.php"><img src="images/logo.png" alt=""/> </a>
		</div>
		<!-- start header_right -->
		<div class="header_right">

<div class="search">
		<?php
			if(isset($_SESSION['city']))
			{
				echo "You are in ".$_SESSION['city'];
			}
		?>

<select name="city" id="city">
<option value="">--Select City--</option>
<option value="Vijayawada">Vijayawada</option>
<option value="Vizag">Vizag</option>
<option value="Tirupathi">Tirupathi</option>
</select>
			
</div>
		
		<div class="clearfix"> </div>
		</div>
		<!-- start header menu -->
		<ul class="megamenu skyblue">

		</ul> 
	</div>
</div>
</div>