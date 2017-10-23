<?php
include_once("../includes/db_connect.php");
include_once("functions.php");
admin_logincheck();
$admin_name=$_SESSION['uname'];
$permission=$_SESSION['permission'];
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
	if(document.getElementById('purpose').value=="")
	{
		alert("Please Enter Purpose");
		document.getElementById('purpose').focus();
		return false;
	}
	if(document.getElementById('desc').value=="")
	{
		alert("Please Enter Description");
		document.getElementById('desc').focus();
		return false;
	}
	if(document.getElementById('amount').value=="")
	{
		alert("Please Enter Amount");
		document.getElementById('amount').focus();
		return false;
	}
	else if(isNaN(document.getElementById('amount').value))
	{
		alert("Please Enter Valid Amount");
		document.getElementById('amount').focus();
		return false;
	}
	if(document.getElementById('edate').value=="")
	{
		alert("Please Select Date");
		document.getElementById('edate').focus();
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
          <li><a href="dashboard.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
          <li class="has_sub"><a href="#"><i class="fa fa-list-alt"></i> <span>Discounts</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="add-discount.php">Add Discount</a></li>
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
		<li><a href="expenses.php" class="open"><i class="fa fa-list-alt"></i> <span>Expenses</span></a></li>
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
          <a href="#" class="bread-current">Add Expense</a>
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
                  <div class="pull-left">Add Expense</div>
                  <div class="widget-icons pull-right">
                   
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">
				  <!-- Form starts.  -->
                     <form class="form-horizontal" method="post" role="form" action="" onsubmit="return valid_details();">
					 
						<div class="form-group">
                                  <label class="col-lg-2 control-label">Purpose</label>
                                  <div class="col-lg-6">
                                    <input type="text" class="form-control" name="purpose" id="purpose" placeholder="Purpose">
                                  </div>
                        </div>
						
						<div class="form-group">
                                  <label class="col-lg-2 control-label">Description</label>
                                  <div class="col-lg-6">
                                    <textarea class="form-control" rows="2" name="desc" id="desc" placeholder="Description"></textarea>
                                  </div>
                        </div>
						
						        <div class="form-group">
                                  <label class="col-lg-2 control-label">Amount</label>
                                  <div class="col-lg-6">
                                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount">
                                  </div>
                                </div>
                              
                                <div class="form-group">
                                  <label class="col-lg-2 control-label">Date</label>
                                  <div class="col-lg-6">
                                    <input type="text" class="form-control datepicker" placeholder="Date" name="edate" id="edate">
                                  </div>
                                </div>
								
                                <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-9">
                                    <input type="submit" class="btn btn-success" name="sub" value="Submit">
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
	
	dateFormat: "yy-mm-dd"
    });
  });
</script>
</body>
</html>