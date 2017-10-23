<?php
if(isset($_POST['Sign']) && $_POST['Sign']=="Sign In")
{

	if(isset($_SESSION['uname']))
	{
		header('Location:card-types.php');
	}

	$lmail=mysql_real_escape_string(trim($_POST['lmail']));
	$lpass=mysql_real_escape_string(md5(trim($_POST['lpass'])));

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
<div class="top_bg">
<div class="container">
<div class="header_top">
	<div class="top_left">
		<h2><a href="#">Discount Card</a> one card for all discounts</h2>
	</div>
	<div class="top_right">
		<ul>
			<li><a href="registration.php">Register</a></li>|
			<li class="login" >
						<div id="loginContainer"><a href="#" id="loginButton"><span>Login</span></a>
						    <div id="loginBox">                
						        <form id="loginForm" action="" method="post" onsubmit="return valid_login();">
						                <fieldset id="body">
						                	<fieldset>
						                          <label for="email">Email Address</label>
						                          <input type="email" name="lmail" id="lmail" pattern="[a-zA-Z0-9\_\.]+\@[a-zA-Z\.]+\.([a-z]{2,4})$" placeholder="Registered Email Id" required>
						                    </fieldset>
						                    <fieldset>
						                            <label for="password">Password</label>
						                            <input type="password" name="lpass" id="lpass" placeholder="Password" required>
						                     </fieldset>
						                    <input type="submit" id="login" name="Sign" value="Sign In">
						                	</fieldset>
						            <span><a href="#">Forgot your password?</a></span>
							 </form>
				        </div>
			      </div>
			</li>
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
			<a href="index.php"><img src="images/logo.png" alt=""/> </a>
		</div>
		<!-- start header_right -->
		<div class="header_right">
		<div class="create_btn">
			<a class="arrow"  href="search.php">Check Card <img src="images/right_arrow.png" alt=""/>  </a>
		</div>

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
			<li><a class="color1" href="index.php">Home</a></li>
			<li><a class="color2" href="restaurants.php">Restaurants</a></li>
			<li><a class="color4" href="hotels.php">Hotels</a></li>
			<li><a class="color3" href="electronics.php">Electronics</a></li>
			<li><a class="color9" href="jewellery.php">Jewellery</a></li>			
			<li><a class="color5" href="shopping.php">Shopping</a></li>
			<li><a class="color1" href="supermarkets.php">Super Markets</a></li>
			<li><a class="color6" href="beauty-spa.php">Beauty & Health</a></li>
			<li><a class="color7" href="hospitals.php">Hospitals</a></li>
			<li><a class="color8" href="travels.php">Travels</a></li>
			<li><a class="color9" href="clothing.php">Clothing</a></li>
			<li><a class="color8" href="gaming.php">Gaming Zone</a></li>
			<li><a class="color4" href="education.php">Education Zone</a></li>
			<li><a class="color10" href="auto.php">Automobiles</a></li>
			<li><a class="color6" href="services.php">Other Services</a></li>
		</ul> 
	</div>
</div>
</div>