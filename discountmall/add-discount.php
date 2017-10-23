<?php
include_once("../includes/db_connect.php");
include_once("functions.php");
admin_logincheck();
$admin_name=$_SESSION['uname'];
$permission=$_SESSION['permission'];

if(isset($_POST['sub']) && $_POST['sub']=="Add")
{
	$city=$_POST['city'];
	$category=$_POST['cat'];
	$adtitle=mysql_real_escape_string(trim($_POST['adtitle']));
	$discount=mysql_real_escape_string(trim($_POST['discount']));
	$ddetails=mysql_real_escape_string(trim($_POST['ddetails']));
	$address=mysql_real_escape_string(trim($_POST['address']));
	$cdetails=mysql_real_escape_string(trim($_POST['cdetails']));
	$description=mysql_real_escape_string(trim($_POST['desc']));
	$expdate=mysql_real_escape_string(trim($_POST['epdate']));
	if(isset($_POST['desc2']))
	{
		$description2=mysql_real_escape_string(trim($_POST['desc2']));
	}
	else
	{
		$description2="Not Provided";
	}
	if(isset($_POST['desc3']))
	{
		$description3=mysql_real_escape_string(trim($_POST['desc3']));
	}
	else
	{
		$description3="Not Provided";
	}
	$dimage_tmp_name1=$_FILES['dimage']['tmp_name'][0];
	
	if($city=="" || $category=="" || $adtitle=="" || $discount=="" || $address=="" || $cdetails=="" || $description=="" || $dimage_tmp_name1=="")
	{
		echo '<script> alert("Please Add Discount Properly")</script>';
		header('Refresh:0.0005; url=add-discount.php');
	}
	else
	{
		
		//if(count(array_unique()))
		$dimage_name1=$_FILES['dimage']['name'][0];
		$insert_discount=mysql_query("insert into discounts (category, adtitle, discount, address, cdetails, description, status, pdate, udate, city, description2, description3, expdate, ddetails) values ('$category', '$adtitle', '$discount', '$address', '$cdetails', '$description', '1', curdate(), curdate(), '$city', '$description2', '$description3', '$expdate', '$ddetails')");
		if($insert_discount)
		{
			$id=mysql_insert_id();
			$did="DSID".$id;
			$new_path1='../discountlogos/'.$id.$dimage_name1;
			move_uploaded_file($dimage_tmp_name1, $new_path1);
			$update_discount=mysql_query("update discounts set dlogo='$new_path1', disid='$did' where sno='{$id}'");
			/* if($update_discount)
			{
						echo '<script> alert("Discount Added Successfully")</script>';
						//header('Refresh:0.0005; url=add-discount.php');
			} */

			if($_FILES['dimage']['tmp_name'][1]=="")
			{
				$new_path2='../discountlogos/'.$id.$dimage_name1;
			}
			else
			{
				$dimage_tmp_name2=$_FILES['dimage']['tmp_name'][1];
				$dimage_name2=$_FILES['dimage']['name'][1];
				$new_path2='../discountlogos/'.$id.$dimage_name2;
				move_uploaded_file($dimage_tmp_name2, $new_path2);
			}
			if($_FILES['dimage']['tmp_name'][2]=="")
			{
				$new_path3='../discountlogos/'.$id.$dimage_name1;
			}
			else
			{
				$dimage_tmp_name3=$_FILES['dimage']['tmp_name'][2];
				$dimage_name3=$_FILES['dimage']['name'][2];
				$new_path3='../discountlogos/'.$id.$dimage_name3;
				move_uploaded_file($dimage_tmp_name3, $new_path3);
			}
			if($_FILES['dimage']['tmp_name'][3]=="")
			{
				$new_path4='../discountlogos/'.$id.$dimage_name1;
			}
			else
			{
				$dimage_tmp_name4=$_FILES['dimage']['tmp_name'][3];
				$dimage_name4=$_FILES['dimage']['name'][3];
				$new_path4='../discountlogos/'.$id.$dimage_name4;
				move_uploaded_file($dimage_tmp_name4, $new_path4);
			}
			
			
			$insert_images=mysql_query("insert into dimages (disid, dlogo1, dlogo2, dlogo3, dlogo4, date) values ('$did', '$new_path1', '$new_path2', '$new_path3', '$new_path4', curdate())");
			if($insert_images)
			{
					echo '<script> alert("Discount Added Successfully")</script>';
						//header('Refresh:0.0005; url=add-discount.php');
			}
			
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
function valid_details()
{
	if(document.getElementById('cat').value=="")
	{
		alert("Please Select Category");
		return false;
	}
	if(document.getElementById('adtitle').value=="")
	{
		alert("Please Enter Ad Title");
		document.getElementById('adtitle').focus();
		return false;
	}
	if(document.getElementById('discount').value=="")
	{
		alert("Please Enter Discount");
		document.getElementById('discount').focus();
		return false;
	}
	if(document.getElementById('ddetails').value=="")
	{
		alert("Please Enter Discount Details");
		document.getElementById('ddetails').focus();
		return false;
	}
	if(document.getElementById('address').value=="")
	{
		alert("Please Enter Address");
		document.getElementById('address').focus();
		return false;
	}
	if(document.getElementById('cdetails').value=="")
	{
		alert("Please Enter Contact Details");
		document.getElementById('cdetails').focus();
		return false;
	}
	if(document.getElementById('desc').value=="")
	{
		alert("Please Enter Description");
		document.getElementById('desc').focus();
		return false;
	}
	if(document.getElementById('dimage').value=="")
	{
		alert("Please Upload Discount Logo");
		return false;
	}
	if(document.getElementById('epdate').value=="")
	{
		alert("Please Select Expire Date");
		document.getElementById('epdate').focus();
		return false;
	}
	
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
          <li class="has_sub"><a href="#" class="open"><i class="fa fa-list-alt"></i> <span>Discounts</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="add-discount.php" class="active">Add Discount</a></li>
              <li><a href="discount-list.php">Discount List</a></li>
            </ul>
          </li>
		<li class="has_sub"><a href="#"><i class="fa fa-list-alt"></i> <span>Users</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
				<li><a href="new-user.php">New User</a></li>
				<li><a href="today-users.php">Today Users</a></li>
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
          <a href="#" class="bread-current">Add Discount</a>
        </div>
        
        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

	    <div class="matter">
        <div class="container">

          <!-- Today status. jQuery Sparkline plugin used. -->

			<div class="row">
				<div class="col-md-8">
				
				<div class="widget">
                
                <div class="widget-head">
                  <div class="pull-left">Add Discount</div>
                  
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">
            
                    <!-- Form starts.  -->
                     <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data" onsubmit="return valid_details();">
					 
							<div class="form-group">
                                  <label class="col-lg-2 control-label">City</label>
                                  <div class="col-lg-10">
                                    <select class="form-control" name="city" id="city">
                                      <option value="">--Select City--</option>
									  <option value="Vijayawada">Vijayawada</option>
									  <option value="Vizag">Vizag</option>
									  <option value="Tirupathi">Tirupathi</option>
                                    </select>
                                  </div>
                            </div>
							<div class="form-group">
                                  <label class="col-lg-2 control-label">Category</label>
                                  <div class="col-lg-10">
                                    <select class="form-control" name="cat" id="cat">
                                      <option value="">--Select Category--</option>
									  <option value="Auto">Automobiles</option>
									  <option value="Beauty">Beauty & Spa</option>
									  <option value="Clothing">Clothing</option>
									  <option value="Education">Education</option>
									  <option value="Gaming">Gaming</option>
                                      <option value="Electronics">Electronics</option>
                                      <option value="Jewellery">Jewellery</option>
                                      <option value="Hospitals">Hospitals</option>
                                      <option value="Hotels">Hotels</option>
									  <option value="Shopping">Shopping</option>
									  <option value="SuperMarkets">Super Markets</option>
									  <option value="Restaurants">Restaurants</option>
									  <option value="Travels">Travels</option>
									  <option value="Services">Other Services</option>
                                    </select>
                                  </div>
                            </div>
                              
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Ad Title</label>
                                  <div class="col-lg-10">
                                    <input type="text" class="form-control" name="adtitle" id="adtitle" placeholder="Ad Title">
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Discount</label>
                                  <div class="col-lg-10">
                                    <input type="text" class="form-control" name="discount" id="discount" placeholder="Discount">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Discount Details</label>
                                  <div class="col-lg-10">
                                    <textarea class="form-control" rows="3" name="ddetails" id="ddetails" placeholder="Discount Details"></textarea>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Address</label>
                                  <div class="col-lg-10">
                                    <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"></textarea>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Contact Details</label>
                                  <div class="col-lg-10">
                                    <textarea class="form-control" rows="2" name="cdetails" id="cdetails" placeholder="Contact Details"></textarea>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Description 1</label>
                                  <div class="col-lg-10">
                                    <textarea class="form-control" rows="3" name="desc" id="desc" placeholder="Description 1"></textarea>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Description 2</label>
                                  <div class="col-lg-10">
                                    <textarea class="form-control" rows="3" name="desc2" id="desc2" placeholder="Description 2"></textarea>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Description 3</label>
                                  <div class="col-lg-10">
                                    <textarea class="form-control" rows="3" name="desc3" id="desc3" placeholder="Description 3"></textarea>
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Discount Image 1</label>
                                  <div class="col-lg-10">
                                    <input type="file" name="dimage[]" id="dimage">
                                  </div>
                                </div><div class="form-group">
                                  <label class="col-lg-2 control-label">Discount Image 2</label>
                                  <div class="col-lg-10">
                                    <input type="file" name="dimage[]" id="dimage">
                                  </div>
                                </div>
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Discount Image 3</label>
                                  <div class="col-lg-10">
                                    <input type="file" name="dimage[]" id="dimage">
                                  </div>
                                </div>
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Discount Image 4</label>
                                  <div class="col-lg-10">
                                    <input type="file" name="dimage[]" id="dimage">
                                  </div>
                                </div>
								
								<div class="form-group">
                                  <label class="col-lg-2 control-label">Expire Date</label>
                                  <div class="col-lg-6">
                                    <input type="text" class="form-control datepicker" name="epdate" id="epdate" placeholder="Expire Date">
                                  </div>
                                </div>
								
                                    <hr />
                                <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-9">
                                    
                                    <input type="submit" class="btn btn-success" name="sub" value="Add">
                                    <input type="reset" class="btn btn-danger" value="Reset">
									
                                  </div>
                                </div>
                              </form>
                  </div>
                </div>
              </div>

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

<!------Date Picker---------->
	
	<link href="calender/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script src="calender/jquery-1.9.1.js"></script>
	<script src="calender/jquery-ui-1.10.3.custom.js"></script>
	
<script>
	$(function() {
    $( ".datepicker" ).datepicker({
	
	dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true,
	  yearRange: '2015:2025'
    });
  });
</script>
</body>
</html>