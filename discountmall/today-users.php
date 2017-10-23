<?php
include_once("../includes/db_connect.php");
include_once("functions.php");
admin_logincheck();
$admin_name=$_SESSION['uname'];
$permission=$_SESSION['permission'];

if(isset($_POST['sub']) && $_POST['sub']=="Update")
{
	$discountid=$_POST['disid'];
	$category=$_POST['cat'];
	$adtitle=mysql_real_escape_string(trim($_POST['adtitle']));
	$discount=mysql_real_escape_string(trim($_POST['discount']));
	$address=mysql_real_escape_string(trim($_POST['address']));
	$cdetails=mysql_real_escape_string(trim($_POST['cdetails']));
	$description=mysql_real_escape_string(trim($_POST['desc']));
	if(isset($_FILES['dimage']['tmp_name']) && $_FILES['dimage']['tmp_name']!="")
	{
		/* 
		 $delfile=mysql_query("select dlogo from discounts where disid='{$discountid}'");
					$del_path=mysql_fetch_assoc($delfile);
					$del_name=$del_path['dlogo'];
					unlink($del_name); */
					
		$discount_name=$_FILES['dimage']['name'];
		$discount_tmp_path=$_FILES['dimage']['tmp_name'];
		$new_path="../discountlogos/".$discountid.$discount_name;
		move_uploaded_file($discount_tmp_path, $new_path);
		
		$udiscount=mysql_query("update discounts set category='$category', adtitle='$adtitle', discount='$discount', address='$address', cdetails='$cdetails', description='$description', dlogo='$new_path', udate=curdate() where disid='{$discountid}'");
		if($udiscount)
		{
			
			echo '<script> alert("Discount Details Updated Successfully")</script>';
							//header('Refresh:0.0005; url=discount-list.php');
			echo '<script>window.location.href = "discount-list.php";</script>';
		}
		
	}
	else
	{
				//echo "hi";
		$udiscount=mysql_query("update discounts set category='$category', adtitle='$adtitle', discount='$discount', address='$address', cdetails='$cdetails', description='$description', udate=curdate() where disid='{$discountid}'");
		if($udiscount)
		{
			
			echo '<script> alert("Discount Details Updated Successfully")</script>';
							//header('Refresh:0.0005; url=discount-list.php');
			echo '<script>window.location.href = "discount-list.php";</script>';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Dashboard - Discount Ka Mall</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">


  <!-- Stylesheets -->
  <link href="style/bootstrap.css" rel="stylesheet">
  <!-- Font awesome icon -->
  <link rel="stylesheet" href="style/font-awesome.css"> 
  <!-- jQuery UI -->
  <link rel="stylesheet" href="style/jquery-ui-1.9.2.custom.min.css"> 
  <!-- Calendar -->
  <link rel="stylesheet" href="style/fullcalendar.css">
  <!-- prettyPhoto -->
  <link rel="stylesheet" href="style/prettyPhoto.css">  
  <!-- Star rating -->
  <link rel="stylesheet" href="style/rateit.css">
  <!-- Date picker -->
  <link rel="stylesheet" href="style/bootstrap-datetimepicker.min.css">
  <!-- CLEditor -->
  <link rel="stylesheet" href="style/jquery.cleditor.css"> 
  <!-- Uniform -->
  <link rel="stylesheet" href="style/uniform.default.html"> 
  <!-- Uniform -->
  <link rel="stylesheet" href="style/daterangepicker-bs3.css" />
  <!-- Bootstrap toggle -->
  <link rel="stylesheet" href="style/bootstrap-switch.css">
  <!-- Main stylesheet -->
  <link href="style/style.css" rel="stylesheet">
  <!-- Widgets stylesheet -->
  <link href="style/widgets.css" rel="stylesheet">   
    <!-- Gritter Notifications stylesheet -->
  <link href="style/jquery.gritter.css" rel="stylesheet">   
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->
<script type="text/javascript">
			function delfile()
				{
				var yes=confirm("Are you sure want to delete this discount ?");
				if(!yes)
				{
				return false;
				}
				else
				{
				window.location='discount-list.php';
				return true;
				}
				}
				function discountlist()
				{
					window.location='discount-list.php';
				}
</script>
</head>

<body>
<header>
<div class="navbar navbar-fixed-top bs-docs-nav" role="banner">
  
    <div class="container">
      <!-- Menu button for smallar screens -->
      <div class="navbar-header">
		  <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse"><span>Menu</span></button>
      <a href="#" class="pull-left menubutton hidden-xs"><i class="fa fa-bars"></i></a>
		  <!-- Site name for smallar screens -->
		  <a href="dashboard.php" class="navbar-brand">Discount <span class="bold">Ka Mall</span></a>
		</div>

      <!-- Navigation starts -->
      <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">         
        
        <!-- Links -->
        <ul class="nav navbar-nav pull-right">
          <li class="dropdown pull-right user-data">            
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              Welcome <span class="bold"><?php echo ucfirst($admin_name);?></span> <b class="caret"></b>              
            </a>
            
            <!-- Dropdown menu -->
            <ul class="dropdown-menu">
              <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
              <li><a href="#"><i class="fa fa-cogs"></i> Change Password</a></li>
              <li><a href="logout.php"><i class="fa fa-key"></i> Logout</a></li>
            </ul>
          </li>

            
        </ul>
      </nav>

    </div>
  </div>
</header>
<!-- Main content starts -->

<div class="content">

  	<!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>
        <!-- Search form -->
        
        <!--- Sidebar navigation -->
        <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
        <ul id="nav">
          <!-- Main menu with font awesome icon -->
          <li><a href="dashboard.php" class="open"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
          <li class="has_sub"><a href="#"><i class="fa fa-list-alt"></i> <span>Discounts</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="add-discount.php">Add Discount</a></li>
              <li><a href="discount-list.php">Discount List</a></li>
            </ul>
          </li>
		<li class="has_sub"><a href="#" class="open"><i class="fa fa-list-alt"></i> <span>Users</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
				<li><a href="new-user.php">New User</a></li>
				<li><a href="today-users.php" class="active">Today Users</a></li>
				<li><a href="total-users.php">Total Users</a></li>
				<li><a href="pending-users.php">Pending Users</a></li>
				<li><a href="card-pendings.php">Pending Cards</a></li>
        <li><a href="issued-cards.php">Issued Cards</a></li>
            <li><a href="search-user.php">Search Card</a></li>
            </ul>
        </li>
		<?php
		if($permission==1)
		{
			?>
				<li class="has_sub"><a href="#"><i class="fa fa-list-alt"></i> <span>Employees</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
					<ul>	
					<li><a href="add-employee.php">Add Employee</a></li>
					<li><a href="employees.php">Employees List</a></li>				
					</ul>
				</li>
			<?php
		}
		?>
		<li class="has_sub"><a href="#"><i class="fa fa-list-alt"></i> <span>Ads</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
				<li><a href="home-slider.php">Home Slider</a></li>
            </ul>
        </li>
        </ul>
    </div>
    <!-- Sidebar ends -->

  	<!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
	      <h2 class="pull-left">Dashboard</h2>
        
        <div class="clearfix"></div>
        <!-- Breadcrumb -->
        <div class="bread-crumb">
          <a href="dashboard.php"><i class="fa fa-home"></i> Home</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Discounts List</a>
        </div>
        
        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

	    <div class="matter">
        <div class="container">

          <!-- Today status. jQuery Sparkline plugin used. -->

			<div class="row">
				<div class="col-md-10">
				
				<?php
					if(isset($_GET['edit']))
					{
						$disid=$_GET['edit'];
						$edit_discount=mysql_query("select * from discounts where disid='{$disid}'");
						$edetails=mysql_fetch_array($edit_discount);
						
						?>
						<div class="widget">
                
                <div class="widget-head">
                  <div class="pull-left">Edit Discount</div>
                  
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">
            
                    <!-- Form starts.  -->
                     <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data" onsubmit="return valid_details();">
							<input type="hidden" name="disid" value="<?php echo $disid; ?>">
							<div class="form-group">
                                  <label class="col-lg-2 control-label">Category</label>
                                  <div class="col-lg-10">
                                    <select class="form-control" name="cat" id="cat">
                        
                                      <option value="Auto" <?php if($edetails['category']=="Auto"){ ?> selected="selected" <?php } ?>>Automobiles</option>
									  <option value="Beauty" <?php if($edetails['category']=="Beauty"){ ?> selected="selected" <?php } ?>>Beauty & Spa</option>
                                      <option value="Mobiles" <?php if($edetails['category']=="Mobiles"){ ?> selected="selected" <?php } ?>>Mobiles</option>
                                      <option value="Gaming" <?php if($edetails['category']=="Gaming"){ ?> selected="selected" <?php } ?>>Gaming</option>
                                      <option value="Hospitals"<?php if($edetails['category']=="Hospitals"){ ?> selected="selected" <?php } ?>>Hospitals</option>
                                      <option value="Hotels" <?php if($edetails['category']=="Hotels"){ ?> selected="selected" <?php } ?>>Hotels</option>
									  <option value="Shopping" <?php if($edetails['category']=="Shopping"){ ?> selected="selected" <?php } ?>>Shopping</option>
									  <option value="Restaurants" <?php if($edetails['category']=="Restaurants"){ ?> selected="selected" <?php } ?>>Restaurants</option>
									  <option value="Travels" <?php if($edetails['category']=="Travels"){ ?> selected="selected" <?php } ?>>Travels</option>
                                    </select>
                                  </div>
                            </div>
                              
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Ad Title</label>
                                  <div class="col-lg-10">
                                    <input type="text" class="form-control" name="adtitle" id="adtitle" placeholder="Ad Title" value="<?php echo $edetails['adtitle']; ?>">
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Discount</label>
                                  <div class="col-lg-10">
                                    <input type="text" class="form-control" name="discount" id="discount" placeholder="Discount" value="<?php echo $edetails['discount']; ?>">
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Address</label>
                                  <div class="col-lg-10">
                                    <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"><?php echo $edetails['address']; ?></textarea>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Contact Details</label>
                                  <div class="col-lg-10">
                                    <textarea class="form-control" rows="2" name="cdetails" id="cdetails" placeholder="Contact Details"><?php echo $edetails['cdetails']; ?></textarea>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Description</label>
                                  <div class="col-lg-10">
                                    <textarea class="form-control" rows="3" name="desc" id="desc" placeholder="Description"><?php echo $edetails['description']; ?></textarea>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Discount Logo</label>
                                  <div class="col-lg-10">
								  <img src="<?php echo $edetails['dlogo']; ?>" width="100" height="100"><br/><br/>
                                    <input type="file" name="dimage" id="dimage">
                                  </div>
                                </div>
								
                                    <hr />
                                <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-9">
                                    
                                    <input type="submit" class="btn btn-success" name="sub" value="Update">
                                    <input type="button" class="btn btn-danger" value="Back" onclick='return discountlist();'>
									
                                  </div>
                                </div>
                              </form>
                  </div>
                </div>
              </div>
						<?php
					}
					else if(isset($_GET['delete']))
					{
						$disid=$_GET['delete'];
						$delete_discount=mysql_query("update discounts set status='0' where disid='{$disid}'");
						if($delete_discount)
						{
							echo '<script> alert("Discount Deleted Successfully")</script>';
							//header('Refresh:0.0005; url=discount-list.php');
							echo '<script>window.location.href = "discount-list.php";</script>';
						}
					}
					else
					{
						?>
						
						<div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Discounts List</div>
                   
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          
                          <th>Name</th>
                          <th>Mobile</th>
                          <th>City</th>
						  <th>Applied</th>
						  <th>Card type</th>
                          <th>Control</th>
                        </tr>
                      </thead>
                      <tbody>
					  
						<?php
						if(isset($_GET['page']))
						{
							$page=$_GET['page'];
						}
						else
						{
							$page=1;
						}
						$start_from=($page-1) * 10;
						//echo $start_from;
						$today_users=mysql_query("select * from users where rdate=curdate()");
						$urows=mysql_num_rows($today_users);
						if($urows==0)
						{
							echo "<div class='alert alert-danger'>
							 No User Registered
								</div>";
						}
						else
						{	
							$users_list=mysql_query("select * from users where rdate=curdate() order by sno desc limit $start_from, 10");
							while($user_details=mysql_fetch_array($users_list))
							{
								$userid=$user_details[1];
								
								echo "<tr>
								<td>$user_details[2]</td>
								<td>$user_details[6]</td>
								<td>$user_details[12]</td>
								<td>$user_details[17]</td>";
								$user_card=mysql_query("select * from discards where userid='{$userid}'");
								$crows=mysql_num_rows($user_card);
								if($crows==0)
								{
									echo "<td>Not Applied</td>";
								}
								else
								{
									$card_details=mysql_fetch_array($user_card);
									echo "<td>$card_details[2]</td>";
								}
								
								echo "<td>
								<a href='today-users.php?edit=$user_details[1]'><button class='btn btn-xs btn-warning'><i class='fa fa-pencil'></i></button></a>&nbsp;&nbsp;";
								if($permission==1)
								{
									echo "<a href='today-users.php?delete=$user_details[1]'><button class='btn btn-xs btn-danger' onclick='return delfile();'><i class='fa fa-times'></i> </button></a>";
								}
								
								echo "</td>
								</tr>";
							}
						}
						?>

                      </tbody>
                    </table>

                    <div class="widget-foot">

                     
                        <ul class="pagination pull-right">
                          <?php
						$total_pages = ceil($urows/10);
						for($j=1; $j<=$total_pages; $j++)
							{
							if($j != $page)
							{
							echo "<li><a href='today-users.php?page=".$j."'> ".$j."</a></li>";
							}
							else
							{
							echo "<li class='active'><a href='today-users.php?page=".$j."'> ".$j."</a></li>";
							}
							}
						?>
                        </ul>
                     
                      <div class="clearfix"></div> 

                    </div>

                  </div>

                </div>
						
						<?php
					}
				?>
				
				
					
				</div>
			</div>
        </div>
		</div>

		<!-- Matter ends -->

    </div>

   <!-- Mainbar ends -->
   <div class="clearfix"></div>

</div>
<!-- Content ends -->

<!-- Footer starts -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <!-- Copyright info -->
            <p class="copy">Copyright &copy; 2015 | <a href="#">Discount Ka Mall</a> </p>
      </div>
    </div>
  </div>
</footer> 	

<!-- Footer ends -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

<!-- JS -->
<script src="js/jquery.js"></script> <!-- jQuery -->
<script src="js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->

<!-- Morris JS -->
<script src="js/raphael-min.js"></script>
<script src="js/morris.min.js"></script>

<!-- jQuery Flot -->
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.flot.js"></script>
<script src="js/jquery.flot.resize.js"></script>
<script src="js/jquery.flot.pie.js"></script>
<script src="js/jquery.flot.stack.js"></script>

<!-- jQuery Notification - Noty -->
<script src="js/jquery.noty.js"></script> <!-- jQuery Notify -->
<script src="js/themes/default.js"></script> <!-- jQuery Notify -->
<script src="js/layouts/bottom.js"></script> <!-- jQuery Notify -->
<script src="js/layouts/topRight.js"></script> <!-- jQuery Notify -->
<script src="js/layouts/top.js"></script> <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

<!-- Daterangepicker -->
<script src="js/moment.min.js"></script>
<script src="js/daterangepicker.js"></script>

<script src="js/sparklines.js"></script> <!-- Sparklines -->

<script src="js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="js/jquery.uniform.min.html"></script> <!-- jQuery Uniform -->
<script src="js/jquery.slimscroll.min.js"></script> <!-- jQuery SlimScroll -->
<script src="js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
<script src="js/filter.js"></script> <!-- Filter for support page -->
<script src="js/custom.js"></script> <!-- Custom codes -->
<script src="js/charts.js"></script> <!-- Charts & Graphs -->

<script src="js/index.js"></script> <!-- Index Javascripts -->
</body>
</html>