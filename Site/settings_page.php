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

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="js/bootstrap.min.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){
					$('[data-toggle="tooltip"]').tooltip();   
				});
			</script>
			<script src="js/check_in_out.js"></script>
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
												echo "<h5 id=\"check_in_out_warning\"><small>Don't forget to check out when leaving.</small></h5>";
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
								<a href="#" class="h4">Check in and out history</a>
							</div>
							<p class="clear_both"></p>
						</div>
						<div class="BOX margin_15_bottom no_pad_bottom">
							<div class="col-md-12">
								<a href="#" class="h4">Message and file history</a>
							</div>
							<p class="clear_both"></p>
						</div>
					</div>
					<div class="col-xs-12 col-sm-5 col-sm-offset-0 col-md-5 col-md-offset-0 col-lg-4 user_search">
						<div class="BOX">
							<h4>Settings</h4>
							<div class="col-md-12"><hr class="hr"></div>
							<div class="col-md-12">
								<form class="form-horizontal" name="settings" method="post" action="settings_validate.php" enctype="multipart/form-data">
									<div class="form-group margin_15_top <?php if (isset($_GET["nin"]) && $_GET["nin"] == "ok") {echo "has-success";} elseif (isset($_GET["nin"]) && $_GET["nin"] == "error") {echo "has-error";} ?>">
										<label for="nin" class="col-md-3 control-label" id="label_nin" data-toggle="tooltip" data-placement="top" title="National insurance number"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Nin</label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="nin" name="nin" value="<?php echo $_SESSION["nin"]; ?>">
										</div>
									</div>
									<div class="form-group <?php if (isset($_GET["dob"]) && $_GET["dob"] == "ok") {echo "has-success";} elseif (isset($_GET["dob"]) && $_GET["dob"] == "error") {echo "has-error";} ?>">
										<label for="dob" class="col-md-3 control-label">Date of birth</label>
										<div class="col-md-9">
											<input type="date" class="form-control" id="dob" name="dob" value="<?php echo $_SESSION["date_of_birth"]; ?>">
										</div>
									</div>
									<div class="form-group <?php if (isset($_GET["gender"]) && $_GET["gender"] == "ok") {echo "has-success";} elseif (isset($_GET["gender"]) && $_GET["gender"] == "error") {echo "has-error";} ?>">
										<label for="gender" class="col-md-3 control-label">Gender</label>
										<div class="col-md-9">
											<label class="radio-inline"><input type="radio" id="gender" value="m" name="gender" <?php if ($_SESSION["gender"] == 1) {echo "checked"; }?>>M</label>
											<label class="radio-inline"><input type="radio" value="f" name="gender"  <?php if ($_SESSION["gender"] == 0) {echo "checked"; }?>>F</label>
										</div>
									</div>
									<div class="form-group <?php if (isset($_GET["address"]) && $_GET["address"] == "ok") {echo "has-success";} elseif (isset($_GET["address"]) && $_GET["address"] == "error") {echo "has-error";} ?>">
										<label for="home" class="col-md-3 control-label">Home address</label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="home" name="address" value="<?php echo $_SESSION["address"]; ?>">
										</div>
									</div>
									<div class="form-group <?php if (isset($_GET["martial"]) && $_GET["martial"] == "ok") {echo "has-success";} elseif (isset($_GET["martial"]) && $_GET["martial"] == "error") {echo "has-error";} ?>">
										<label for="martial" class="col-md-3 control-label">Martial status</label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="martial" name="martial" value="<?php echo $_SESSION["martial_status"]; ?>">
										</div>
									</div>
									<div class="form-group <?php if (isset($_GET["email"]) && $_GET["email"] == "ok") {echo "has-success";} elseif (isset($_GET["email"]) && $_GET["email"] == "error") {echo "has-error";} ?>">
										<label for="email" class="col-md-3 control-label">Personal email</label>
										<div class="col-md-9">
											<input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION["email"]; ?>">
										</div>
									</div>
									<div class="form-group <?php if (isset($_GET["phone_number"]) && $_GET["phone_number"] == "ok") {echo "has-success";} elseif (isset($_GET["phone_number"]) && $_GET["phone_number"] == "error") {echo "has-error";} ?>">
										<label for="phone" class="col-md-3 control-label">Phone number</label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="phone" name="phone_number" value="<?php echo $_SESSION["phone_number"]; ?>">
										</div>
									</div>
									<div class="form-group <?php if (isset($_GET["password"]) && $_GET["password"] == "ok") {echo "has-success";} elseif (isset($_GET["password"]) && $_GET["password"] == "error") {echo "has-error";} ?>">
										<label for="oldpassword" class="col-md-3 control-label">Password</label>
										<div class="col-md-9">
											<input type="password" class="form-control" id="oldpassword" name="password">
										</div>
									</div>
									<div class="form-group <?php if (isset($_GET["new_password"]) && $_GET["new_password"] == "ok") {echo "has-success";} elseif (isset($_GET["new_password"]) && $_GET["new_password"] == "error") {echo "has-error";} ?>">
										<label for="newpassword" class="col-md-3 control-label">New password</label>
										<div class="col-md-9">
											<input type="password" class="form-control" id="newpassword" name="newpassword">
										</div>
									</div>
									<div class="form-group <?php if (isset($_GET["new_password"]) && $_GET["new_password"] == "ok") {echo "has-success";} elseif (isset($_GET["new_password"]) && $_GET["new_password"] == "error") {echo "has-error";} ?>">
										<label for="repassword" class="col-md-3 control-label">Retype password</label>
										<div class="col-md-9">
											<input type="password" class="form-control" id="repassword" name="repassword">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12 no_pad_left pad_15_bottom">
											<label for="picture" class="col-md-3 control-label">New profile picture</label>
											<div class="col-md-9">
												<input accept="image/*" type="file" name="picture" id="picture" class="btn btn-warning file">
											</div>
										</div>
									</div>
									<div class="col-md-9">
										<button type="submit" class="btn btn-warning">Save</button>
									</div>
								</form>
							</div>
							<p class="clear_both"></p>
						</div>
					</div>
				</div>


			</body>
			</html>
			<?php
		}
		else
		{
			header("Location: index.php");
		}