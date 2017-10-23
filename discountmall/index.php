<?php
include_once("../includes/db_connect.php");

//Checking For Already Login
session_start();
if(isset($_SESSION['uname']))
{
	header('Location:dashboard.php');
}

//Checking Login Details
if(isset($_POST['sub']) && $_POST['sub']=="Sign In")
{
	$uname=mysql_real_escape_string(trim($_POST['uname']));
	$pass=md5(mysql_real_escape_string(trim($_POST['pass'])));
	if($uname=="" || $pass=="")
	{
		header('Location:index.php');
	}
	else
	{
		$check_user=mysql_query("select * from admin where username='{$uname}' and pass='{$pass}'");
		$crows=mysql_num_rows($check_user);
		if($crows==1)
		{
			$data=mysql_fetch_array($check_user);
			$_SESSION['uname']=$data[1];
			$_SESSION['permission']=$data[3];
			header('Location:dashboard.php');
		}
		else
		{
			header('Location:index.php?msg=fail');
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
  <title>Admin Login - Discount Ka Mall</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Stylesheets -->
  <link href="style/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="style/font-awesome.css">
  <link href="style/style.css" rel="stylesheet">
  <link href="style/bootstrap-responsive.html" rel="stylesheet">
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

<script type="text/javascript">
function valid_details()
{
	if(document.getElementById('uname').value=="")
	{
		alert("Please Enter User Name");
		document.getElementById('uname').focus();
		return false;
	}
	if(document.getElementById('pass').value=="")
	{
		alert("Please Enter Password");
		document.getElementById('pass').focus();
		return false;
	}
}
</script>
</head>

<body>

<!-- Form area -->
<div class="admin-form">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <!-- Widget starts -->
            <div class="widget">
              <!-- Widget head -->
              <div class="widget-head">
                <i class="icon-lock"></i> Login 
              </div>

              <div class="widget-content">
                <div class="padd">
                  <!-- Login form -->
                  <form class="form-horizontal" method="post" action="" onsubmit="return valid_details();" autocomplete="off">
                    <!-- Email -->
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputEmail">User Name</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control" id="uname" name="uname" placeholder="User Name">
                      </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputPassword">Password</label>
                      <div class="col-lg-9">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                      </div>
                    </div>
                    <!-- Remember me checkbox and sign in button -->
                    <div class="form-group">
					<div class="col-lg-9 col-lg-offset-3">

					</div>
					</div>
                        <div class="col-lg-9 col-lg-offset-3">
							<input type="submit" name="sub" value="Sign In" class="btn btn-danger">
						</div>
                    <br />
                  </form>
				  
				</div>
                </div>
              
                <div class="widget-foot">
				<?php
				if(isset($_GET['msg']) && $_GET['msg']=="fail")
				{
					echo "<p style='color:red;font-weight:bold;font-size:15px;'>Invalid Login Details</p>";
				}
				?>
                </div>
            </div>  
      </div>
    </div>
  </div> 
</div>
	
		

<!-- JS -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>