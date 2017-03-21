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
	    </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right links_bovenaan">
          <li><a href="#">Messages</a></li>
          <li><a href="#">Settings</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </div>
	  </div><!-- /.container-fluid -->
	</nav>

  <div class="container-fluid">
     <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2">
     <div class="BOX">
       <div class="col-md-5 user_foto">
         <img src="IMG/user.png" class="user_foto">
       </div>
       <div class="col-md-7 user_info">
         <ul>
           <li>Name</li>
           <li>Function</li>
           <li>In Building</li>
           <li>Online</li>
         </ul>
       </div>
      <p class="clear_both"></p>
     </div>
     </div>
     <div class="col-xs-12 col-sm-5 col-sm-offset-0 col-md-4 col-md-offset-0 user_search">
     <div class="BOX">
      <p>Settings</p>
      <div class="col-md-12"><hr class="hr"></div>
      <div class="col-md-12">
      <form class="form-horizontal" name="settings" method="post" action="#">
       <div class="form-group">
        <label for="zoeken" class="col-md-3 control-label">National insurance number</label>
        <div class="col-md-9">
         <input type="text" class="form-control" id="nir" name="nir">
        </div>
       </div>
        <div class="form-group">
        <label for="zoeken" class="col-md-3 control-label">Date of birth</label>
        <div class="col-md-9">
         <input type="text" class="form-control" id="dob" name="dob">
        </div>
       </div>
        <div class="form-group">
        <label for="zoeken" class="col-md-3 control-label">Gender</label>
        <div class="col-md-9">
         <label class="radio-inline"><input type="radio" id="nir" name="gender" value="m">M</label>
         <label class="radio-inline"><input type="radio" id="nir" name="gender" value="m">F</label>
        </div>
       </div>
       <div class="form-group">
        <label for="zoeken" class="col-md-3 control-label">Home address</label>
        <div class="col-md-9">
         <input type="text" class="form-control" id="home" name="home">
        </div>
       </div>
       <div class="form-group">
        <label for="zoeken" class="col-md-3 control-label">Martial status</label>
        <div class="col-md-9">
         <input type="text" class="form-control" id="martial" name="martial">
        </div>
       </div>
       <div class="form-group">
        <label for="zoeken" class="col-md-3 control-label">Personal email</label>
        <div class="col-md-9">
         <input type="email" class="form-control" id="email" name="email">
        </div>
       </div>
       <div class="form-group">
        <label for="zoeken" class="col-md-3 control-label">Phone number</label>
        <div class="col-md-9">
         <input type="text" class="form-control" id="phone" name="phone">
        </div>
       </div>
       <div class="form-group">
        <label for="zoeken" class="col-md-3 control-label">Password</label>
        <div class="col-md-9">
         <input type="password" class="form-control" id="password" name="password">
        </div>
       </div>
       <div class="form-group">
        <label for="zoeken" class="col-md-3 control-label">Retype password</label>
        <div class="col-md-9">
         <input type="password" class="form-control" id="repassword" name="repassword">
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



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>