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
		<script src="js/check_in_out.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="js/bootstrap.min.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){
					$('[data-toggle="tooltip"]').tooltip();   
				});
			</script>

		<!-- zingshart -->
		<script src= "js/zingchart.min.js"></script>
		<script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
		ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script>

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
					 <img src="IMG/user.png" alt="Profile picture" class="user_foto">
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
			 <a href="#" class="h4">Info</a>
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
 <div class="col-xs-12 col-sm-5 col-sm-offset-0 col-md-5 col-md-offset-0 col-lg-4">
 	<div class="BOX">
 	<div id='myChart'></div>
 	<?php
	 	$link = connecteren();
		$query = "SELECT in_building_now FROM in_building WHERE user_id = '" .$_SESSION["user_id"]. "' ORDER BY in_building_id ASC";
		$data = mysqli_query($link, $query) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query\"");
	?>
	<script>
		var myData=[<?php 
		while($info=mysqli_fetch_array($data)){
			echo $info['in_building_now'].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
		}
		?>];
		<?php
			$query = "SELECT time_check FROM in_building WHERE user_id = '" .$_SESSION["user_id"]. "' ORDER BY in_building_id ASC";
			$data = mysqli_query($link, $query) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query\"");
		?>
		var myLabels=[<?php 
		while($info=mysqli_fetch_array($data)){
	    	echo '"'.$info['time_check'].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
		}
		?>];
	</script>
	<?php
		mysqli_close($link);
	?>
	<script>
	  	var chartData={
		    "type":"line",
		    "scale-x":{
	    		"min-value":1491927120395, /*uses miliseconds since 1 jan 1972*/
    			"step":86400000,
	    		"transform":{
	       			"type":"date",
	       			"all":"%m.%d.%Y"
	    		}
			},
		    "series":[ 
		        { "values": [7,8,9,8] },
		        { "values": [14,15,14,16]}
		    ]
	  	};
	  	zingchart.render({
		    id:'myChart',
		    data:chartData,
		    height:400,
		    width:400
	  	});
	</script>
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