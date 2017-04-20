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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript">
			function search_users()
			{
				xhr = new XMLHttpRequest();
				var zoekterm = document.getElementById("zoeken").value;
				if (xhr != null)
				{
					var output = document.getElementById("members");
					var loading = "<i>Loading...&nbsp;&nbsp;&nbsp;</i><i class=\"fa fa-circle-o-notch fa-spin\" style=\"font-size:24px\"></i>";
					output.innerHTML = loading;
					setTimeout(function()
					{
						var url="search_user_validate.php?search_admin_page_manage="+zoekterm;  

						xhr.onreadystatechange=refresh_inhoud;
						xhr.open("GET",url,true);
						xhr.send(null);
					}, 500);

					
				}
			}

			function refresh_inhoud() 
			{
				var output = document.getElementById("members");
				if (xhr.readyState == 4 && xhr.status == 200)
				{
					if(xhr.responseText)
					{

						output.innerHTML = xhr.responseText;

					}
					else
					{
						output.innerHTML = "<h2>Geen resultaten.</h2>";
					}
				}
			}
		</script>

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
							<li><a href="messages_page.php">Messages</a></li>
							<li><a href="settings_page.php">Settings</a></li>
							<li><a href="admin_page.php">Admin panel</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</div>
				</div><!-- /.container-fluid -->
			</nav>

			<div class="container-fluid">
				<div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-2 pad_15_left"><h2>Admin page - Manage</h2></div>
				<div class="col-xs-12 col-sm-12 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
					<form class="form-horizontal" name="people_search" method="post" action="#">
						<div class="form-group">
							<label for="zoeken" class="col-md-3 control-label">Search:</label>
							<div class="col-md-9">
								<input type="text" onkeyup="search_users();" class="form-control" id="zoeken" name="zoeken">
							</div>
						</div>
					</form>
					<div class="BOX margin_15_bottom" id="members">
						<?php 
						printmembers();
						?>
						<p class="clear_both"></p>
					</div>
					<div class="BOX">
						<?php 
						echo "<h4>*Info Rights ID</h4>";
						printrightsinfo();
						?>
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