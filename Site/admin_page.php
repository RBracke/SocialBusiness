<?php
session_start();
include("functions.php");

if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1)
{

	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Sobu</title>
		<link rel="shortcut icon" href="IMG/icon.png"/>

		<!-- Bootstrap -->
		<link href="css/reset.css" rel="stylesheet" />
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet" />
		<script src="js/message_refresh.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>
		<body>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php"><span class="so">So</span><span class="bu">bu</span></a>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right links_bovenaan">
							<li><a href="messages_page.php">Messages<span class="badge" id="message_aantal"></span></a></li>
							<li><a href="settings_page.php">Settings</a></li>
							<li><a href="admin_page.php">Admin panel</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</div>
				</div><!-- /.container-fluid -->
			</nav>

			<div class="container-fluid">
				<div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-2 pad_15_left"><h2>Admin page</h2></div>
				<div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">
					<div class="BOX margin_15_bottom no_pad_top">
						<a href="admin_page_manage.php"><h3>Manage users</h3></a>
						<p class="clear_both"></p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-5 col-sm-offset-0 col-md-5 col-md-offset-0 col-lg-4 user_search">
					<div class="BOX no_pad_top">
						<a href="admin_page_add.php"><h3>Add a user</h3></a>
						<p class="clear_both"></p>
					</div>
				</div>
			</div>



			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="js/bootstrap.min.js"></script>
		</body>
		</html>
		<?php
	}
	else
	{
		header( "Location: user_page.php" );
	}