<?php
session_start();

include("functions.php");

if (isset($_SESSION["logged_in"]))
{

	fill_session($_SESSION["user_id"]);

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
		<script src="js/check_in_out.js"></script>
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
						var url="search_user_validate.php?search_messages="+zoekterm;  

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
							<li><a href="messages_page.php">Messages<span class="badge" id="message_aantal"></span></a></li>
							<li><a href="settings_page.php">Settings</a></li>
							<?php

							if ($_SESSION["admin"] == 1)
							{
								echo "<li><a href=\"admin_page.php\">Admin panel</a></li>";
							}

							?>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</div>
				</div><!-- /.container-fluid -->
			</nav>

			<div class="container-fluid">
				<div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">
					<div class="BOX margin_15_bottom">
						<div class="col-md-5 user_foto">
							<img src="<?php if($_SESSION["profile_picture"] != NULL) {echo "IMG/users/" .$_SESSION["profile_picture"];} else {echo "IMG/users/default.png";} ?>" alt="Profile picture" class="user_foto">
						</div>
						<div class="col-md-7 user_info">
							<ul>
								<li><?php echo $_SESSION["name"]; ?></li>
								<li><?php echo $_SESSION["function"]; ?></li>
								<li>
									<div class="col-xs-9 col-sm-9 col-md-9 no_pad_left">Online</div>
									<div class="col-xs-3 col-sm-3 col-md-3">


										<?php

										if ($_SESSION["logged_in"] == 1)
										{
											echo "<img src=\"IMG/Green_circle.png\" title=\"Online\" alt=\"Online\" class=\"indicator_online_building\">";
										}
										else
										{
											echo "<img src=\"IMG/Red_circle.png\" title=\"Offline\" alt=\"Offline\" class=\"indicator_online_building\">";
										}

										?>
									</div>
									<li>
										<div class="col-xs-9 col-sm-9 col-md-9 no_pad_left">In Building</div>
										<div class="col-xs-3 col-sm-3 col-md-3">

											<?php
											if ($_SESSION["in_building"] == 1)
											{
												echo "<img src=\"IMG/Green_square.png\" id=\"in_building\" title=\"In Building\" alt=\"In Building\" class=\"indicator_online_building\">";
											}
											else
											{
												echo "<img src=\"IMG/Red_square.png\" id=\"in_building\" title=\"Not in Building\" alt=\"Not in building\" class=\"indicator_online_building\">";
											}
											?>

										</div>
									</li>
									<li>
										<div class="col-md-12 no_pad_left">

											<?php
											if ($_SESSION["in_building"] == 0)
											{
												echo "<button class=\"btn btn-success\" id=\"check_in_out_button\" onclick=\"check_in_out();\">Check in</button>";
												echo "<h5 id=\"check_in_out_warning\"><small>Don't forget to check in when arriving.</small></h5>";
											}
											else
											{
												echo "<button class=\"btn btn-danger\" id=\"check_in_out_button\" onclick=\"check_in_out();\">Check out</button>";
												echo "<h5 id=\"check_in_out_warning\"><small>Don't forget to check out when leaving.</small></h5>"; /*werkt pas vanaf refresh?*/
											}
											?>

										</div>
									</li>
								</ul>
							</div>
							<p class="clear_both"></p>
						</div>
						<div class="BOX margin_15_bottom no_pad_bottom">
							<div class="col-md-12">
								<a href="info_page.php" class="h4">Info</a>
							</div>
							<p class="clear_both"></p>
						</div>
						<div class="BOX margin_15_bottom no_pad_bottom">
							<div class="col-md-12">
								<a href="check_in_out_page.php" class="h4">Check in and out history</a>
							</div>
							<p class="clear_both"></p>
						</div>
					</div>
					<div class="col-xs-12 col-sm-5 col-sm-offset-0 col-md-5 col-md-offset-0 col-lg-4 user_search">
						<div class="BOX">
						<h4>Messages</h4>
							<div class="col-md-12"><hr class="hr"><br></div>
							<form class="form-horizontal" name="people_search" method="post" action="#">
								<div class="form-group">
									<label for="zoeken" class="col-md-3 control-label">Search:</label>
									<div class="col-md-9">
										<input type="text" onkeyup="search_users();" class="form-control" id="zoeken" name="zoeken">
									</div>
								</div>
							</form>
							<div class="col-md-12" id="members">
								<?php
								print_messages_list();
								?>
							</div>
							<p class="clear_both"></p>
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
			header("Location: index.php");
		}