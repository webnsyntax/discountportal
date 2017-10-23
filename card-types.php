<?php
include_once("includes/db_connect.php");
include_once("includes/functions.php");
logincheck();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Discounts Ka Mall - Registration</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary JavaScript plugins) -->
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
<style>
.db-bk-color-one {
    background-color: #f55039;
}

.db-bk-color-two {
    background-color: #46A6F7;
}

.db-bk-color-three {
    background-color: #47887E;
}

.db-bk-color-six {
    background-color: #F59B24;
}
/*============================================================
PRICING STYLES
==========================================================*/
.db-padding-btm {
    padding-bottom: 50px;
}
.db-button-color-square {
    color: #fff;
    background-color: rgba(0, 0, 0, 0.50);
    border: none;
    border-radius: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
}

    .db-button-color-square:hover {
        color: #fff;
        background-color: rgba(0, 0, 0, 0.50);
        border: none;
    }


.db-pricing-eleven {
    margin-bottom: 30px;
    margin-top: 50px;
    text-align: center;
    box-shadow: 0 0 5px rgba(0, 0, 0, .5);
    color: #fff;
    line-height: 30px;
}

    .db-pricing-eleven ul {
        list-style: none;
        margin: 0;
        text-align: center;
        padding-left: 0px;
    }

        .db-pricing-eleven ul li {
            padding-top: 20px;
            padding-bottom: 20px;
            cursor: pointer;
        }

            .db-pricing-eleven ul li i {
                margin-right: 5px;
            }


    .db-pricing-eleven .price {
        background-color: rgba(0, 0, 0, 0.5);
        padding: 40px 20px 20px 20px;
        font-size: 60px;
        font-weight: 900;
        color: #FFFFFF;
    }

        .db-pricing-eleven .price small {
            color: #B8B8B8;
            display: block;
            font-size: 12px;
            margin-top: 22px;
        }

    .db-pricing-eleven .type {
        background-color: #52E89E;
        padding: 50px 20px;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 30px;
    }

    .db-pricing-eleven .pricing-footer {
        padding: 20px;
    }

.db-attached > .col-lg-4,
.db-attached > .col-lg-3,
.db-attached > .col-md-4,
.db-attached > .col-md-3,
.db-attached > .col-sm-4,
.db-attached > .col-sm-3 {
    padding-left: 0;
    padding-right: 0;
}

.db-pricing-eleven.popular {
    margin-top: 10px;
}

    .db-pricing-eleven.popular .price {
        padding-top: 80px;
    }
</style>
</head>
<body>
<!-- header_top -->
<?php include_once('user-header.php'); ?>
<!-- content -->
<div class="container">
<div class="main">
	<div class="container">
   <div class="row text-center">
            <div class="col-md-12">
            <br/><br/>
            <h3>
Our Different Types Of Cards And Their Details..
            </h3>
            <br/><br/>
            </div>
    </div>        
           
        <div class="row db-padding-btm db-attached">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="db-wrapper">
                    <div class="db-pricing-eleven db-bk-color-one">
                        <div class="price">
                            <sup>Rs</sup>365
                                <small>per annum</small>
                        </div>
                        <div class="type">
                            Single Card
                        </div>
                        <ul>

                            <li>Discounts Valid For 1 Person</li>
                            <li>Eligibility : Card Holder Only</li>
                        </ul>
                        <div class="pricing-footer">

                            <a href="#" class="btn db-button-color-square btn-lg">Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                 <div class="db-wrapper">
                <div class="db-pricing-eleven db-bk-color-two popular">
                    <div class="price">
                        <sup>Rs</sup>1200
                                <small>per annum</small>
                    </div>
                    <div class="type">
                        Family Card
                    </div>
                    <ul>

                        <li>Discounts Valid For 4 Persons</li>
                        <li>Eligibility : Card Holder + Any 3 Family Members</li>
                    </ul>
                    <div class="pricing-footer">

                        <a href="#" class="btn db-button-color-square btn-lg">Buy Now</a>
                    </div>
                </div>
                     </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                 <div class="db-wrapper">
                <div class="db-pricing-eleven db-bk-color-three">
                    <div class="price">
                        <sup>Rs</sup>1500
                                <small>per annum</small>
                    </div>
                    <div class="type">
                        Friend's Card
                    </div>
                    <ul>

                        <li>Discounts Valid For 5 Persons</li>
                        <li>Eligibility : Card Holder + Any 4 Friends</li>
                    </ul>
                    <div class="pricing-footer">

                        <a href="#" class="btn db-button-color-square btn-lg">Buy Now</a>
                    </div>
                </div>
                     </div>
            </div>
            <div class="row text-center">
            <div class="col-md-12">
            <h3>
            	Currently online card purchase is under process.</h3>
            <h3>You can also purchase offline call us at 0866-6888855.</h3>
            <h3>We are Happy to Serve You.</h3>
            </div>
        </div>
        </div>

    </div>
    </div>
</div>
</div>
<!-- footer_top -->
<?php include_once('user-footer.php'); ?>
</body>
</html>