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
				<div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-2 pad_15_left"><h2>Admin page - Add a user</h2></div>
				<div class="col-xs-12 col-sm-12 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
					<div class="BOX">
							<div class="col-md-12">
								<form class="form-horizontal" name="add_user" method="post" action="add_user_validate.php">
									<div class="form-group margin_15_top">
										<label for="dob" class="col-md-3 control-label">Name<span class="rood">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="name" name="name" placeholder="Surname Forename">
										</div>
									</div>
									<div class="form-group">
										<label for="function" class="col-md-3 control-label">Function<span class="rood">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="function" name="function" placeholder="Function of the new employee">
										</div>
									</div>
									<div class="form-group">
										<label for="admin_radio" class="col-md-3 control-label">Admin<span class="rood">*</span></label>
										<div class="col-md-9">
											<label class="radio-inline"><input type="radio" id="admin_radio" value="1" name="admin_radio">Yes</label>
											<label class="radio-inline"><input type="radio" value="0" name="admin_radio">No</label>
										</div>
									</div>
									<div class="form-group">
										<label for="rights_checkbox" class="col-md-3 control-label">Has rights<span class="rood">*</span></label> <!-- waardes tellen niet op-->
										<div class="col-md-9">
											<label class="checkbox-inline"><input type="checkbox" id="rights_checkbox" value="1" name="rights_checkbox_info">Check info</label>
											<label class="checkbox-inline"><input type="checkbox" value="1" name="rights_checkbox_time">Check in and out times</label>
											<label class="checkbox-inline"><input type="checkbox" value="1" name="rights_checkbox_message">Check Messages</label>
										</div>
									</div>
									<div class="form-group">
										<label for="nin" class="col-md-3 control-label" id="label_nin" data-toggle="tooltip" data-placement="top" title="National insurance number"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Nin</label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="nin" name="nin" placeholder="example: 85020100200">
										</div>
									</div>
									<div class="form-group">
										<label for="dob" class="col-md-3 control-label">Date of birth</label>
										<div class="col-md-9">
											<input type="date" class="form-control" id="dob" name="dob">
										</div>
									</div>
									<div class="form-group">
										<label for="gender" class="col-md-3 control-label">Gender</label>
										<div class="col-md-9">
											<label class="radio-inline"><input type="radio" id="gender" value="m" name="gender">M</label>
											<label class="radio-inline"><input type="radio" value="f" name="gender">F</label>
										</div>
									</div>
									<div class="form-group">
										<label for="home" class="col-md-3 control-label">Home address</label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="home" name="address">
										</div>
									</div>
									<div class="form-group">
										<label for="martial" class="col-md-3 control-label">Martial status</label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="martial" name="martial">
										</div>
									</div>
									<div class="form-group">
										<label for="email" class="col-md-3 control-label">Personal email</label>
										<div class="col-md-9">
											<input type="email" class="form-control" id="email" name="email">
										</div>
									</div>
									<div class="form-group">
										<label for="phone" class="col-md-3 control-label">Phone number</label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="phone" name="phone_number" placeholder="example: 0499999999">
										</div>
									</div>
									<div class="form-group">
										<label for="newpassword" class="col-md-3 control-label">Password</label>
										<div class="col-md-9">
											<input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Default = admin">
										</div>
									</div>
									<div class="form-group">
										<label for="repassword" class="col-md-3 control-label">Retype password</label>
										<div class="col-md-9">
											<input type="password" class="form-control" id="repassword" name="repassword">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12 no_pad_left pad_15_bottom">
											<label for="picture" class="col-md-3 control-label">Profile picture</label>
											<div class="col-md-9">
												<input type="file" id="picture" class="btn btn-warning file">
											</div>
										</div>
									</div>
									<div class="col-sm-12 pad_15_bottom"><span class="rood">* Required</span></div>
									<div class="col-md-9">
										<button type="submit" class="btn btn-warning">Add</button>
									</div>
								</form>
							</div>
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