<?php
include_once("../includes/db_connect.php");
include_once("functions.php");
admin_logincheck();
$admin_name=$_SESSION['uname'];
$permission=$_SESSION['permission'];

if(isset($_POST['cup']) && $_POST['cup']=="Update")
{
  $ucid=$_POST['ucid'];
  $cstatus=$_POST['cstatus'];

  $update_user=mysql_query("update users set dcard='1' where userid='{$ucid}'");
  $update_card=mysql_query("update discards set posted_date=now() where userid='{$ucid}'");

  if($update_user && $update_card)
  {
    echo '<script> alert("Card Status Updated Successfully.")</script>';
     header('Refresh:0.0005; url=search-user.php');
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
function search_details()
{
  if(document.getElementById('uid').value=="")
  {
    alert("Please Enter Card Id");
    document.getElementById('uid').focus();
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
		<li class="has_sub"><a href="#"  class="open"><i class="fa fa-list-alt"></i> <span>Users</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
				<li><a href="new-user.php">New User</a></li>
				<li><a href="today-users.php">Today Users</a></li>
				<li><a href="total-users.php">Total Users</a></li>
				<li><a href="pending-users.php">Pending Users</a></li>
				<li><a href="card-pendings.php">Pending Cards</a></li>
        <li><a href="issued-cards.php">Issued Cards</a></li>
        <li><a href="search-user.php" class="active">Search Card</a></li>
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
		<li><a href="expenses.php"><i class="fa fa-list-alt"></i> <span>Expenses</span></a></li>
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
          <a href="#" class="bread-current">Dashboard</a>
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
                    <div class="pull-left">Search Card</div>
                    
                    <div class="clearfix"></div>
                  </div>

                  <div class="widget-content">
                  <div class="padd">
                    <div class="form profile">
                                      <!-- Edit profile form (not working)-->
                          <form class="form-horizontal" method="post" enctype="multipart/form-data" action="" onsubmit="return search_details();" autocomplete="off">
                            <!-- Name -->
                                  <div class="form-group">
                                        <label class="control-label col-lg-2" for="name1">Enter Card Id</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="uid" name="uid" placeholder="Enter Card Id">
                                        </div>
                                  </div>
                                  <!-- Buttons -->
                                  <div class="form-group">
                                             <!-- Buttons -->
                                     <div class="col-lg-6 col-lg-offset-2">
                                      <input type="submit" class="btn btn-primary" name="sub" value="Search">
                                      <input type="reset" class="btn btn-danger" value="Reset">
                                    </div>
                                   </div>
                          </form>
                    </div>          
                  </div>
                  </div>

                </div>

                <?php
                  if(isset($_POST['sub']) && $_POST['sub']=="Search")
                  {
                    $cid=mysql_real_escape_string(trim($_POST['uid']));

                    $card_check=mysql_query("select * from discards where cardid='{$cid}'");
                    $crows=mysql_num_rows($card_check);
                    if($crows==0)
                    {
                        echo "<div class='alert alert-danger'>
                      No Details Found
                        </div>";
                    }
                    else
                    {
                          $card_details=mysql_fetch_array($card_check);
                          $uid=$card_details['1'];
                          $user_check=mysql_query("select * from users where userid='{$uid}'");
                          $user_details=mysql_fetch_array($user_check);
                          ?>
                          <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">User Details</div>
                  
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">
                    
                    <!-- Profile form -->
                   
                                    <div class="form profile">
                                      <!-- Edit profile form (not working)-->
                                      <form class="form-horizontal" method="" enctype="multipart/form-data" action="">
                                          <!-- Name -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="name1">Card Id</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="fname" name="fname" placeholder="Card Holder Full Name" value="<?php echo $card_details[8]; ?>" readonly>
                                            </div>
                                          </div>
                      <!-- Name -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="name1">Card Holder Full Name</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="fname" name="fname" placeholder="Card Holder Full Name" value="<?php echo $user_details[2]; ?>" readonly>
                                            </div>
                                          </div>   
                                          <!-- Email -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="email1">Email</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="email" name="email" placeholder="Customer Email Id" value="<?php echo $user_details[3]; ?>" readonly>
                                            </div>
                                          </div>
                                          <!-- Telephone -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Mobile</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Customer Mobile Number" value="<?php echo $user_details[6]; ?>" readonly>
                                            </div>
                                          </div>
                    
                    <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Gender</label>
                                            <div class="col-lg-6">
                       <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Customer Mobile Number" value="<?php echo $user_details[5]; ?>" readonly>
                                            </div>
                                          </div>
                      <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">DOB</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control datepicker" id="dob" name="dob" placeholder="DOB" value="<?php echo $user_details[7]; ?>" readonly>
                                            </div>
                                          </div>
                      <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Aadhar Id</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="aid" name="aid" placeholder="Aadhar Id" value="<?php echo $user_details[8]; ?>" readonly>
                                            </div>
                                          </div>
                      <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Aadhar Card</label>
                                            <div class="col-lg-6">
                                              <span class='label label-info'><a href="<?php echo $user_details[9]; ?>" download="<?php echo $user_details[9]; ?>" title='Click To Download' style='text-decoration:none;'>Download Aadhar Card</a></span>
                                            </div>
                      
                                          </div>
                      <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Photo</label>
                                            <div class="col-lg-6">
                                              <span class='label label-info'><a href="<?php echo $user_details[10]; ?>" download="<?php echo $user_details[10]; ?>" title='Click To Download' style='text-decoration:none;'>Download Photo</a></span>
                                            </div>
                      
                                          </div>
                                          <!-- Address -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="address">Address</label>
                                            <div class="col-lg-6">
                                              <textarea class="form-control" id="address" name="address" placeholder="Address" readonly><?php echo $user_details[11]; ?></textarea>
                                            </div>
                                          </div>                           
                                          <!-- Country -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2">City</label>
                                            <div class="col-lg-6">                               
                                                <input type="text" class="form-control" id="aid" name="aid" placeholder="Aadhar Id" value="<?php echo $user_details[12]; ?>" readonly>
                                            </div>
                                          </div>
                      <?php
                      $card_check=mysql_query("select * from discards where userid='{$uid}'");
                      $crows=mysql_num_rows($card_check);
                      if($crows!=0)
                      {
                        $card_details=mysql_fetch_array($card_check);
                        //print_r($card_details);
                        ?>
                      <h4>Card Details</h4>
                      <div class="form-group">
                                            <label class="control-label col-lg-2">Card Type</label>
                                            <div class="col-lg-6">                               
                                               <input type="text" class="form-control datepicker" id="dob" name="dob" placeholder="DOB" value="<?php echo $card_details[2]; ?>" readonly>  
                                            </div>
                                          </div>
                      <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Amount</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" value="<?php echo $card_details[3]; ?>" readonly>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Card Applied On</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" placeholder="Applied Date" value="<?php echo $card_details[6]; ?>" readonly>
                                            </div>
                                          </div>

                        <?php
                      }
                      ?>

                                      </form>
                                      <form class="form-horizontal" method="post" action="" autocomplete="off">
                                        <input type="hidden" name="ucid" id="cid" value="<?php echo $uid; ?>">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Card Status</label>
                                            <div class="col-lg-6">                               
                                                <select class="form-control" name="cstatus" id="cstatus">
                                                <option value=""> --- Select Status--- </option>
                                                <option value="0" <?php if($user_details[14]=="0"){ ?> selected="selected" <?php } ?>>Pending</option>
                                                <option value="1" <?php if($user_details[14]=="1"){ ?> selected="selected" <?php } ?>>Posted</option>                       
                                                </select>  
                                            </div>
                                          </div>

                                           <div class="form-group">
                                             <!-- Buttons -->
                                           <div class="col-lg-6 col-lg-offset-2">
                                            <input type="submit" class="btn btn-danger" name="cup" value="Update">
                                          </div>
                                          </div>
                                      </form>
                                    </div>

                  </div>
                </div>
              </div>
                          <?php
                    }
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