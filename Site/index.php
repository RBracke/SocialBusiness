<?php
if (isset($_POST["email_login"]))
{
  //Testen of deze email gelinkt is aan een account
  if ("ok" == "ok")
  {
    $email_ok = "nok";
  }
  else
  {
    $email_ok = "nok";
  }
}
else
{
  $email_ok = "na";
}

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
	      <a class="navbar-brand" href="#"><span class="so">So</span><span class="bu">bu</span></a>
	    </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right links_bovenaan">
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
	  </div><!-- /.container-fluid -->
	</nav>

  <div class="container-fluid">
     <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
       <div class="login_email mid BOX">
        <h2 class="login_text">Login</h2>

       <?php
       if ($email_ok == "ok")
      {
        ?>
        <form class="form-horizontal" name="login" method="post" action="#">
          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password:</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="password" name="password">
              <input type="hidden" name="email" value="<?php echo $_POST['email_login']; ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <a href="index.php" class="btn btn-default">Back</a>
              <button type="submit" class="btn btn-warning">Login</button>
            </div>
          </div>
        </form>
        <?php
      }
      else if ($email_ok == "nok")
      {
        ?>
        <div class="text-danger">This email isn't linked to an account. Please <a href="contact.html">contact</a> the administrator.</div>
        <form class="form-horizontal" name="login_email" method="post" action="#">
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email:</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" id="email" name="email_login">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-warning">Next</button>
            </div>
          </div>
        </form>

        <?php
      }
      else
      {
        ?>

        <form class="form-horizontal" name="login_email" method="post" action="#">
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email:</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" id="email" name="email_login">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-warning">Next</button>
            </div>
          </div>
        </form>

        <?php
      }


       ?>
     </div>
  </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>