<?php
include_once("../includes/db_connect.php");
include_once("functions.php");
admin_logincheck();
$admin_name=$_SESSION['uname'];
$permission=$_SESSION['permission'];

$uid=$_GET['Id'];

if(isset($_POST['sub']) && $_POST['sub']=="Add")
{
	$fname=mysql_real_escape_string(trim($_POST['fname']));
	$email=mysql_real_escape_string(trim($_POST['email']));
	$mobile=mysql_real_escape_string(trim($_POST['mobile']));
	$pass=md5(mysql_real_escape_string(trim($_POST['pass'])));
	$gender=$_POST['gender'];
	$dob=mysql_real_escape_string(trim($_POST['dob']));
	$aid=mysql_real_escape_string(trim($_POST['aid']));
	$address=mysql_real_escape_string(trim($_POST['address']));
	$city=mysql_real_escape_string($_POST['city']);
	$card_type=$_POST['ctype'];
	$amount=mysql_real_escape_string(trim($_POST['amount']));
	$acard_tmp_name=$_FILES['acard']['tmp_name'];
	$user_tmp_name=$_FILES['cphoto']['tmp_name'];
	
	$acard_name=$_FILES['acard']['name'];
	$user_name=$_FILES['cphoto']['name'];
	
	if($fname=="" || $email=="" || $mobile=="" || $pass=="" || $gender=="" || $dob=="" || $aid=="" || $address=="" || $city=="" || $card_type=="" || $amount=="" || $acard_tmp_name=="" || $user_tmp_name=="")
	{
		echo '<script> alert("Please Enter Customer Details Properly")</script>';
		header('Refresh:0.0005; url=new-user.php');
	}
	else if($_FILES['acard']['size'] > 250000 || $_FILES['cphoto']['size'] > 250000)
	{
		echo '<script> alert("Error:Uploaded File Sizes May Graterthan 250kb")</script>';
		header('Refresh:0.0005; url=new-user.php');
	}
	else if(pathinfo($acard_name,PATHINFO_EXTENSION) != "jpg" && pathinfo($acard_name,PATHINFO_EXTENSION) != "png" && pathinfo($acard_name,PATHINFO_EXTENSION) != "jpeg")
	{
		echo '<script> alert("Error:Aadhar Card Should be In jpg or png or jpeg Formats Only")</script>';
		header('Refresh:0.0005; url=new-user.php');
	}
	else if(pathinfo($user_name,PATHINFO_EXTENSION) != "jpg" && pathinfo($user_name,PATHINFO_EXTENSION) != "png" && pathinfo($user_name,PATHINFO_EXTENSION) != "jpeg")
	{
		echo '<script> alert("Error:Your Photo Should be In jpg or png or jpeg Formats Only")</script>';
		header('Refresh:0.0005; url=new-user.php');
	}
	else
	{
		$search_email=mysql_query("select * from users where email='{$email}'");
		$email_rows=mysql_num_rows($search_email);
		
		$search_mobile=mysql_query("select * from users where mobile='{$mobile}'");
		$mobile_rows=mysql_num_rows($search_mobile);
		
		if($email_rows!=0)
		{
			echo '<script> alert("Email Id Already Registered With Us")</script>';
			header('Refresh:0.0005; url=new-user.php');
		}
		else if($mobile_rows!=0)
		{
			echo '<script> alert("Mobile Number Already Registered With Us")</script>';
			header('Refresh:0.0005; url=new-user.php');
		}
		else if($email_rows!=0 && $mobile_rows!=0)
		{
			echo '<script> alert("Email Id And Mobile Number Are Already Registered With Us")</script>';
			header('Refresh:0.0005; url=new-user.php');
		}
		else
		{
			
			$insert_user=mysql_query("insert into users (full_name, email, pass, gender, mobile, dob, aid, address, city, terms, dcard, issby, rdate, apply_status) values ('$fname', '$email', '$pass', '$gender', '$mobile', '$dob', '$aid', '$address', '$city', '1', '0', '$admin_name', curdate(), 'yes')");
			if($insert_user)
			{
				
				$id=mysql_insert_id();
				$userid="DKM".$city.$id;
				$acard_new='proofid/'.$id.$acard_name;
				$user_new='proofphoto/'.$id.$user_name;
				move_uploaded_file($acard_tmp_name, $acard_new);
				move_uploaded_file($user_tmp_name, $user_new);
				$update_user=mysql_query("update users set userid='$userid', acard='$acard_new', cphoto='$user_new' where sno='{$id}'");
				if($update_user)
				{
					$todate=date('Y-m-d');
					$expireDate=date("Y-m-d", strtotime(date("Y-m-d", strtotime($todate)) . " + 365 days"));
					$card_insert=mysql_query("insert into discards (userid, card_type, card_amount, issue_date, valid_date) values ('$userid', '$card_type', '$amount', '$todate', '$expireDate')");
					if($card_insert)
					{
						echo '<script> alert("Order for discount card was submitted successfully.")</script>';
						header('Refresh:0.0005; url=dashboard.php');
					}
				}
			}
			else
			{
				die(mysql_error());
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
	var con1=/^[a-zA-Z0-9\_\.]+\@[a-zA-Z\.]+\.([a-z]{2,4})$/;
	var con2=/^[789]\d{9}$/;
	if(document.getElementById('fname').value=="")
	{
		alert("Please Enter Customer Full Name");
		document.getElementById('fname').focus();
		return false;
	}
	else if(document.getElementById('fname').value.length < 3)
	{
		alert("Please Enter Valid Customer Name");
		document.getElementById('fname').focus();
		return false;
	}
	if(document.getElementById('email').value=="")
	{
		alert("Please Enter Customer Email Id");
		document.getElementById('email').focus();
		return false;
	}
	else if(!document.getElementById('email').value.match(con1))
	{
		alert("Please Enter Valid Customer Email Id");
		document.getElementById('email').focus();
		return false;
	}
	if(document.getElementById('mobile').value=="")
	{
		alert("Please Enter Customer Mobile Number");
		document.getElementById('mobile').focus();
		return false;
	}
	else if(!document.getElementById('mobile').value.match(con2))
	{
		alert("Please Enter Valid Customer Mobile Number");
		document.getElementById('mobile').focus();
		return false;
	}
	if(document.getElementById('pass').value=="")
	{
		alert("Please Enter Customer Password As Mobile Number");
		document.getElementById('pass').focus();
		return false;
	}
	if(document.getElementById('male').checked==false && document.getElementById('female').checked==false)
	{
		alert("Please Select Gender");
		return false;
	}
	else if(document.getElementById('male').checked==true && document.getElementById('female').checked==true)
	{
		alert("Please Select Only One Gender");
		return false;
	}
	if(document.getElementById('dob').value=="")
	{
		alert("Please Select DOB");
		document.getElementById('dob').focus();
		return false;
	}
	if(document.getElementById('aid').value=="")
	{
		alert("Please Enter Aadhar Id");
		document.getElementById('aid').focus();
		return false;
	}
	if(document.getElementById('acard').value=="")
	{
		alert("Please Upload Aadhar Card");
		document.getElementById('acard').focus();
		return false;
	}
	if(document.getElementById('cphoto').value=="")
	{
		alert("Please Upload Passport Size Photo");
		document.getElementById('cphoto').focus();
		return false;
	}
	if(document.getElementById('address').value=="")
	{
		alert("Please Enter Address");
		document.getElementById('address').focus();
		return false;
	}
	if(document.getElementById('city').value=="")
	{
		alert("Please Select City");
		return false;
	}
	if(document.getElementById('ctype').value=="")
	{
		alert("Please Select Card Type");
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
		<li class="has_sub"><a href="#" class="open"><i class="fa fa-list-alt"></i> <span>Users</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
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
          <a href="#" class="bread-current">User Details</a>
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
					?>
						<div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Adding New User</div>
                  
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">
                    
                    <!-- Profile form -->
                   
                                    <div class="form profile">
                                      <!-- Edit profile form (not working)-->
                                      <form class="form-horizontal" method="post" enctype="multipart/form-data" action="" onsubmit="return valid_details();">
                                          <!-- Name -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="name1">Card Holder Full Name</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="fname" name="fname" placeholder="Card Holder Full Name">
                                            </div>
                                          </div>   
                                          <!-- Email -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="email1">Email</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="email" name="email" placeholder="Customer Email Id">
                                            </div>
                                          </div>
                                          <!-- Telephone -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Mobile</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Customer Mobile Number">
                                            </div>
                                          </div>
										<div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Password</label>
                                            <div class="col-lg-6">
                                              <input type="password" class="form-control" id="pass" name="pass" placeholder="Password/Mobile">
                                            </div>
                                          </div>
										<div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Gender</label>
                                            <div class="col-lg-6">
											<label class="inline">
                                              <input type="checkbox" id="male" name="gender" value="M">&nbsp;M &nbsp;&nbsp;
											  <input type="checkbox" id="female" name="gender" value="F">&nbsp;F
											  </label>
                                            </div>
                                          </div>
										  <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">DOB</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control datepicker" id="dob" name="dob" placeholder="DOB">
                                            </div>
                                          </div>
										  <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Aadhar Id</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="aid" name="aid" placeholder="Aadhar Id">
                                            </div>
                                          </div>
										  <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Aadhar Card</label>
                                            <div class="col-lg-6">
                                              <input type="file" class="form-control" id="acard" name="acard">
                                            </div>
											File Size Should Lessthan 250KB
                                          </div>
										  <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Photo</label>
                                            <div class="col-lg-6">
                                              <input type="file" class="form-control" id="cphoto" name="cphoto">
                                            </div>
											File Size Should Lessthan 250KB
                                          </div>
                                          <!-- Address -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="address">Address</label>
                                            <div class="col-lg-6">
                                              <textarea class="form-control" id="address" name="address" placeholder="Address"></textarea>
                                            </div>
                                          </div>                           
                                          <!-- Country -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2">City</label>
                                            <div class="col-lg-6">                               
                                                <select class="form-control" name="city" id="city">
                                                <option value=""> --- Select City --- </option>
												<option value="1">Vijayawada</option>        
                                                </select>  
                                            </div>
                                          </div>
									<h4>Card Details</h4>
											<div class="form-group">
                                            <label class="control-label col-lg-2">Card Type</label>
                                            <div class="col-lg-6">                               
                                                <select class="form-control" name="ctype" id="ctype">
                                                <option value=""> --- Select Card --- </option>
												<option value="single">Single Card</option>
												<option value="family">Family Card</option> 
												<option value="friends">Friends Card</option> 												
                                                </select>  
                                            </div>
                                          </div>
										  <div class="form-group">
                                            <label class="control-label col-lg-2" for="telephone">Amount</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="amount" name="amount" value="" placeholder="Amount">
                                            </div>
                                          </div>
										  
                                          
                                          <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
											 <div class="col-lg-6 col-lg-offset-2">
												<input type="submit" class="btn btn-primary" name="sub" value="Add">
												<input type="reset" class="btn btn-danger" value="Reset">
											</div>
                                          </div>
                                      </form>
                                    </div>

                  </div>
                </div>
              </div>
					<?php
				}
				else
				{
					$user_query=mysql_query("select * from users where userid='{$uid}'");
					$user_details=mysql_fetch_array($user_query);

					$user_card=mysql_query("select * from discards where userid='{$uid}'");
                	$card_details=mysql_fetch_array($user_card);
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
                                             <!-- Buttons -->
											 <div class="col-lg-6 col-lg-offset-2">
												<a href="card.php?cid=<?php echo $user_details[1]; ?>" target="_blank"><input type="button" class="btn btn-success" name="sub" value="Generate Card"></a>
											</div>
                                          </div>

											  <?php
										  }
										  ?>
										
										  
                                          
                                          <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
											 <div class="col-lg-6 col-lg-offset-2">
												<!-- <input type="button" class="btn btn-primary" name="sub" value="Add">
												<input type="button" class="btn btn-danger" value="Reset"> -->
											</div>
                                          </div>
                                      </form>
                                    </div>

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
	  yearRange: '1950:2020'
    });
  });
</script>

</body>
</html>