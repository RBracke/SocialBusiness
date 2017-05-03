<?php
session_start();

include("functions.php");

if (isset($_SESSION["logged_in"]) && $_SESSION["admin"] == 1 && isset($_GET["id"]))
{
	$user_id = strip($_GET["id"]);

	get_colleague($user_id);

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
							<li><a href="messages_page.php">Messages
								<span id="message_badge">
									<?php 
									print_badge();
									?>
									
								</span>
							</a></li>
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
				<div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-2 pad_15_left"><h2>Admin page - Edit user</h2></div>
				<div class="col-xs-12 col-sm-12 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
					<div class="BOX">
						<div class="col-md-12">
							<form class="form-horizontal" name="settings" method="post" action="admin_validate_user_settings.php" enctype="multipart/form-data">
								<div class="form-group margin_15_top <?php if (isset($_GET["name"]) && $_GET["name"] == "ok") {echo "has-success";} elseif (isset($_GET["name"]) && $_GET["name"] == "error") {echo "has-error";} ?>"">
									<label for="dob" class="col-md-3 control-label">Name</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="name" name="name"  value="<?php echo $_SESSION["colleague"]["name"]; ?>" placeholder="Surname Forename">
										<input type="hidden" name="id" value="<?php echo $_SESSION["colleague"]["user_id"]; ?>">
									</div>
								</div>
								<div class="form-group <?php if (isset($_GET["function"]) && $_GET["function"] == "ok") {echo "has-success";} elseif (isset($_GET["function"]) && $_GET["function"] == "error") {echo "has-error";} ?>"">
									<label for="function" class="col-md-3 control-label">Function</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="function" name="function"  value="<?php echo $_SESSION["colleague"]["function"]; ?>" placeholder="Function of the new employee">
									</div>
								</div>
								<div class="form-group <?php if (isset($_GET["admin"]) && $_GET["admin"] == "ok") {echo "has-success";} elseif (isset($_GET["admin"]) && $_GET["admin"] == "error") {echo "has-error";} ?>"">
									<label for="admin_radio" class="col-md-3 control-label">Admin</label>
									<div class="col-md-9">
										<label class="radio-inline"><input type="radio" id="admin_radio" value="1" name="admin_radio" <?php if($_SESSION["colleague"]["admin"] == 1){echo "checked";} ?>>Yes</label>
										<label class="radio-inline"><input type="radio" value="0" name="admin_radio" <?php if($_SESSION["colleague"]["admin"] == 0){echo "checked";} ?>>No</label>
									</div>
								</div>
								<div class="form-group <?php if (isset($_GET["rights"]) && $_GET["rights"] == "ok") {echo "has-success";} elseif (isset($_GET["rights"]) && $_GET["rights"] == "error") {echo "has-error";} ?>"">
									<label for="rights_checkbox" class="col-md-3 control-label">Has rights</label> <!-- waardes tellen niet op-->
									<div class="col-md-9">
										<label class="checkbox-inline"><input type="checkbox" id="rights_checkbox" value="1" name="rights_checkbox_info" <?php if($_SESSION["colleague"]["rights"]["info"] == 1){echo "checked";} ?>>Check info</label>
										<label class="checkbox-inline"><input type="checkbox" value="1" name="rights_checkbox_time" <?php if($_SESSION["colleague"]["rights"]["check_in_out"] == 1){echo "checked";} ?>>Check in and out times</label>
										<label class="checkbox-inline"><input type="checkbox" value="1" name="rights_checkbox_message" <?php if($_SESSION["colleague"]["rights"]["messages"] == 1){echo "checked";} ?>>Check Messages</label>
									</div>
								</div>
								<div class="form-group margin_15_top <?php if (isset($_GET["nin"]) && $_GET["nin"] == "ok") {echo "has-success";} elseif (isset($_GET["nin"]) && $_GET["nin"] == "error") {echo "has-error";} ?>">
									<label for="nin" class="col-md-3 control-label" id="label_nin" data-toggle="tooltip" data-placement="top" title="National insurance number"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Nin</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="nin" name="nin" value="<?php echo $_SESSION["colleague"]["nin"]; ?>">
									</div>
								</div>
								<div class="form-group <?php if (isset($_GET["dob"]) && $_GET["dob"] == "ok") {echo "has-success";} elseif (isset($_GET["dob"]) && $_GET["dob"] == "error") {echo "has-error";} ?>">
									<label for="dob" class="col-md-3 control-label">Date of birth</label>
									<div class="col-md-9">
										<input type="date" class="form-control" id="dob" name="dob" value="<?php echo $_SESSION["colleague"]["date_of_birth"]; ?>">
									</div>
								</div>
								<div class="form-group <?php if (isset($_GET["gender"]) && $_GET["gender"] == "ok") {echo "has-success";} elseif (isset($_GET["gender"]) && $_GET["gender"] == "error") {echo "has-error";} ?>">
									<label for="gender" class="col-md-3 control-label">Gender</label>
									<div class="col-md-9">
										<label class="radio-inline"><input type="radio" id="gender" value="m" name="gender" <?php if ($_SESSION["colleague"]["gender"] == 1) {echo "checked"; }?>>M</label>
										<label class="radio-inline"><input type="radio" value="f" name="gender"  <?php if ($_SESSION["colleague"]["gender"] == 0) {echo "checked"; }?>>F</label>
									</div>
								</div>
								<div class="form-group <?php if (isset($_GET["address"]) && $_GET["address"] == "ok") {echo "has-success";} elseif (isset($_GET["address"]) && $_GET["address"] == "error") {echo "has-error";} ?>">
									<label for="home" class="col-md-3 control-label">Home address</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="home" name="address" value="<?php echo $_SESSION["colleague"]["address"]; ?>">
									</div>
								</div>
								<div class="form-group <?php if (isset($_GET["martial"]) && $_GET["martial"] == "ok") {echo "has-success";} elseif (isset($_GET["martial"]) && $_GET["martial"] == "error") {echo "has-error";} ?>">
									<label for="martial" class="col-md-3 control-label">Martial status</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="martial" name="martial" value="<?php echo $_SESSION["colleague"]["martial_status"]; ?>">
									</div>
								</div>
								<div class="form-group <?php if (isset($_GET["email"]) && $_GET["email"] == "ok") {echo "has-success";} elseif (isset($_GET["email"]) && $_GET["email"] == "error") {echo "has-error";} ?>">
									<label for="email" class="col-md-3 control-label">Email</label>
									<div class="col-md-9">
										<input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION["colleague"]["email"]; ?>">
									</div>
								</div>
								<div class="form-group <?php if (isset($_GET["phone_number"]) && $_GET["phone_number"] == "ok") {echo "has-success";} elseif (isset($_GET["phone_number"]) && $_GET["phone_number"] == "error") {echo "has-error";} ?>">
									<label for="phone" class="col-md-3 control-label">Phone number</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="phone" name="phone_number" value="<?php echo $_SESSION["colleague"]["phone_number"]; ?>">
									</div>
								</div>
								<div class="form-group <?php if (isset($_GET["new_password"]) && $_GET["new_password"] == "ok") {echo "has-success";} elseif (isset($_GET["new_password"]) && $_GET["new_password"] == "error") {echo "has-error";} ?>"">
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
								<div class="col-md-10">
									<label class="col-md-3 control-label"><button type="submit" class="btn btn-warning">Save</button></label>
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