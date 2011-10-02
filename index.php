<?php
session_start();

if($_SERVER['QUERY_STRING'] == "" || $_SERVER['QUERY_STRING'] == "/") {
	header('Location:?/home');
}

$location = explode('/',$_SERVER['QUERY_STRING']);

include("./extra/db.php");
include("./extra/functions.php");
$dbconnect = mysql_connect($host, $dbuser, $dbpass) or die("could not connect to database<br>".mysql_error());
$_SESSION['invitepass'] = getNewInvitePass($dbconnect);


if(!isset($_SESSION['user'])) {
	
} else {
	$kbmax = $_SESSION['max'];

	$ar = getDirectorySize("./data/".$_SESSION['user']."/");


	$kbleft = $ar['size'];

	$finalkb = ($kbmax - $kbleft);


}
$error = $location[2];

if($error == "logout") {
	//echo "Logged out correctly";
	session_unset();
	session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>YourCloud</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="styles.css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; /* 40px to make the container go all the way to the bottom of the topbar */
      }
      .container > footer p {
        text-align: center; /* center align it with the container */
      }
      .container {
        width: 820px; /* downsize our container to make the content feel a bit tighter and more cohesive. NOTE: this removes two full columns from the grid, meaning you only go to 14 columns and not 16. */
      }

      /* The white background content wrapper */
      .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; /* negative indent the amount of the padding to maintain the grid system */
        -webkit-border-radius: 0 0 6px 6px;
           -moz-border-radius: 0 0 6px 6px;
                border-radius: 0 0 6px 6px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

      /* Page header tweaks */
      .page-header {
        background-color: #f5f5f5;
        padding: 20px 20px 10px;
        margin: -20px -20px 20px;
      }

      /* Styles you shouldn't keep as they are for displaying this base example only */
      .content .span10,
      .content .span4 {
        min-height: 500px;
      }
      /* Give a quick and non-cross-browser friendly divider */
      .content .span4 {
        margin-left: 0;
        padding-left: 19px;
        border-left: 1px solid #eee;
      }

      .topbar .btn {
        border: 0;
      }
		.meter-wrap{
    		margin-left: 30px;
			position: relative;
			text-align: center;
		}

		.meter-wrap, .meter-value, .meter-text {
		/* The width and height of your image */
			text-align: center;
                                            
			width: 155px; height: 30px;
		}

		.meter-wrap, .meter-value {
			background: #bdbdbd top left no-repeat;
		}
            
		.meter-text {
			position: absolute;
			top:0; left:0;

			padding-top: 5px;
                
			color: #fff;
			text-align: center;
			width: 100%;
		}
		.box {
		background-color: #f5f5f5;
  padding: 8.5px;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
 
		}
    </style>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script src="./js/modal.js"></script>

  </head>

  <body>
  <script>

  </script>
    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="./?/home">YourCloud</a>
          <ul class="nav">
            <li><a href="./?/home">Home</a></li>
            <li><a href="./?/about">About</a></li>
            <li><a href="./?/blog">Blog</a></li>

            <li><a href="./?/login">Log in</a></li>

            <li><a href="./?/register">Register</a></li>
          </ul>
          <!--<form action="./extra/functions.php" method="post" class="pull-right">
            <input type="hidden" name="action" value="login">
            <input class="input-small" type="text" placeholder="Username" name="user">
            <input class="input-small" type="password" placeholder="Password" name="pass">
            <button class="btn" type="submit">Sign in</button>
          </form>-->
        </div>
      </div>
    </div>

	<div class="container">

		<div class="content">
		       	<?php
// COOL URLS PHP CODE IS COPYRIGHT HUNTER DOLAN HTTP://MADEBYHD.US


	if(file_exists('./pages/'.$location[1].'.php')) {
		include('./pages/'.$location[1].'.php');
	} else {
		include('./pages/404.php');
	}
mysql_close();
?>
		</div>

	</div>

      <footer>
        <p>&copy; zad0xsis-dev 2011 - <a href="./?/support">Support</a></p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
