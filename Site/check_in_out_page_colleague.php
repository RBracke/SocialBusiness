<?php
session_start();

include("functions.php");

if (isset($_SESSION["logged_in"]) && isset($_GET["id"]) && ($_SESSION["rights"]["check_in_out"] == 1))
{

	fill_session($_SESSION["user_id"]);
	get_colleague($_GET["id"]);

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
							<li><a href="messages_page.php">Messages
							<?php 
								$link = connecteren();
								$query = "SELECT * FROM message WHERE receipant = " .$_SESSION["user_id"]. " && gelezen = 0";
								$result = mysqli_query($link, $query) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query\"");
								if($result->num_rows > 0)
								{
									echo "<span class='badge' id='message_aantal'></span>";
								}
								mysqli_close($link);
							?></a></li>
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
							<img src="<?php if($_SESSION["colleague"]["profile_picture"] != NULL) {echo "IMG/users/" .$_SESSION["colleague"]["profile_picture"];} else {echo "IMG/users/default.png";} ?>" alt="Profile picture" class="user_foto">
						</div>
						<div class="col-md-7 user_info">
							<ul>
								<li><?php echo $_SESSION["colleague"]["name"]; ?></li>
								<li><?php echo $_SESSION["colleague"]["function"]; ?></li>
								<li>
									<div class="col-xs-9 col-sm-9 col-md-9 no_pad_left">Online</div>
									<div class="col-xs-3 col-sm-3 col-md-3">


										<?php

										if ($_SESSION["colleague"]["logged_in"] == 1)
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
											if ($_SESSION["colleague"]["in_building"] == 1)
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
								</ul>
							</div>
							<p class="clear_both"></p>
						</div>
						<?php
						if ($_SESSION["rights"]["info"] == 1)
						{
								echo "<div class='BOX margin_15_bottom no_pad_bottom'>
												<div class='col-md-12'>
												<a href=\"info_page_colleague.php?id=" .$_SESSION['colleague']['user_id']. "\" class='h4'>Info</a>
												</div>
											<p class='clear_both'></p>
											</div>";
						}

						if ($_SESSION["rights"]["check_in_out"] == 1)
						{
								echo "<div class='BOX margin_15_bottom no_pad_bottom'>
												<div class='col-md-12'>
												<a href='check_in_out_page_colleague.php?id=" .$_SESSION['colleague']['user_id']. "' class='h4'>Check in and out history</a>
												</div>
											<p class='clear_both'></p>
											</div>";
						}

						if ($_SESSION["rights"]["messages"] == 1)
						{
								echo "<div class='BOX margin_15_bottom no_pad_bottom'>
												<div class='col-md-12'>
												<a href='messages_page_colleague.php?id=" .$_SESSION['colleague']['user_id']. "'' class='h4'>Message and file history</a>
												</div>
											<p class='clear_both'></p>
											</div>";
						}
						?>
					</div>
					<div class="col-xs-12 col-sm-5 col-sm-offset-0 col-md-5 col-md-offset-0 col-lg-4">
				 	<div class="BOX">
				 	 <h4>Check in and out history</h4>
				 	<div id='myChart'></div>	
				 	<?php
					 	$link = connecteren();
					 	$query = "SELECT time_check, in_building_now FROM in_building WHERE user_id = '" .$_SESSION["colleague"]["user_id"]. "' ORDER BY in_building_id ASC";
						$data = mysqli_query($link, $query) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query\"");
						$time3 = NULL;
						$date2 = NULL;
					?>
					<script>
						var myData=[<?php 
						while($info=mysqli_fetch_array($data)){
							$datumtijd = date_create($info['time_check']);
							if($info['in_building_now'] == 1){
								$time1 = $datumtijd->format('H:i:s');
								$time1 = strtotime($time1);
							}
							if($info['in_building_now'] == 0){
								$time2 = $datumtijd->format('H:i:s');
								$time2 = strtotime($time2);
							}
							if(isset($time1)&&isset($time2))
							{
								$time = ($time2 - $time1)/60;
								$time2 = NULL;
								$time1 = NULL;
							}
							if((isset($time))&&($time != $time3)){
							echo idate('i', $time).','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
							$time3 = $time;
							}
						}
						?>];
						<?php
							$query = "SELECT time_check FROM in_building WHERE user_id = '" .$_SESSION["colleague"]["user_id"]. "' ORDER BY in_building_id ASC";
							$data = mysqli_query($link, $query) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query\"");
						?>
						var myLabels=[<?php 
						while($info=mysqli_fetch_array($data)){
							$datumtijd = date_create($info['time_check']);
							$date = $datumtijd->format('Y-m-d');
							if($date != $date2){
					    	echo '"'.(date_format($datumtijd, 'U')*1000).'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
					    	$date2 = $date;
					    	}
						}
						?>];
					</script>
					<?php
						mysqli_close($link);
					?>
					<script>
					  	var chartData={
						    "type":"bar",
						    "plot": {
							    "animation": {
							      "delay": "200",
          						  "effect":"4",
							      "method": "5",
							      "sequence": "1"
							    }
							  },
						      "legend":{
						      	    "x":"20%"

						      },
							"scale-x":{
						        "labels":myLabels,
						        "transform":{
					       			"type":"date",
					       			"all":"%m.%d.%Y"
					    		}
						    },
						    "series":[
						        {
						            "values":myData,
						            "text":"Hours at work"
						        }
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