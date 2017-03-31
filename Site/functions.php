<?php

	function connecteren() 
	{
		$host 		= "localhost";
		$user		= "sobu";
		$password	= "r0628842!1S";
		$database	= "sobu";

		$link = mysqli_connect($host, $user, $password) or die("Er kan geen connectie gelegd worden met $host");
		mysqli_select_db($link, $database) or die("databank $database niet beschikbaar");

		return $link;
	}

	function strip($string)
	{
		$link = connecteren();
		$result = mysqli_real_escape_string($link,htmlspecialchars($string));
		mysqli_close($link);
		return $result;
	}

	function check_email_exists($email)
	{
		$link = connecteren();


		$email_login = strip($email);

		$query_email = "SELECT user.email AS email FROM user WHERE email='" . $email . "'";

		$result_email = mysqli_query($link, $query_email) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_email\"");

		if (mysqli_num_rows($result_email) == 1) 
		{
		    $result = "email_ok";
		} 
		elseif (mysqli_num_rows($result_email) > 1) 
		{
		    $result = "error";
		}
		else
		{
			$result = "no_match";
		}

		mysqli_close($link);

		return $result;

	}

	function user_login($email, $password)
	{
		$link = connecteren();


  		$email_login = strip($email);
  		$password_login = md5(strip($password));

		$query_login = "SELECT user_id FROM user WHERE email='" . $email_login . "' && password='" . $password_login . "'";

		$result_login = mysqli_query($link, $query_login) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_login\"");

		if (mysqli_num_rows($result_login) == 1) 
		{
		    $result = "login_ok";
		    $_SESSION["logged_in"] = 1;
		    $result_login = mysqli_fetch_array($result_login);

		    fill_session($result_login["user_id"]);
		} 
		elseif (mysqli_num_rows($result_login) > 1) 
		{
		    $result = "error";
		}
		else
		{
			$result = "no_match";
		}

		mysqli_close($link);

		return $result;
	}

	function fill_session($id)
	{
		$link = connecteren();

		$query_user = "SELECT name, nin, address, gender, email, profile_picture, in_building, date_of_birth, online, martial_status, phone_number, function, rights_id FROM user WHERE user_id = '" .$id. "'";

		$result_user = mysqli_query($link, $query_user) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_user\"");

		if (mysqli_num_rows($result_user) == 1)
		{

			$result_user = mysqli_fetch_array($result_user);

			$_SESSION["user_id"] = $id;
			$_SESSION["name"] = $result_user["name"];
			$_SESSION["nin"] = $result_user["nin"];
			$_SESSION["address"] = $result_user["address"];
			$_SESSION["gender"] = $result_user["gender"];
			$_SESSION["email"] = $result_user["email"];
			$_SESSION["profile_picture"] = $result_user["profile_picture"];
			$_SESSION["in_building"] = $result_user["in_building"];
			$_SESSION["date_of_birth"] = $result_user["date_of_birth"];
			$_SESSION["martial_status"] = $result_user["martial_status"];
			$_SESSION["phone_number"] = $result_user["phone_number"];
			$_SESSION["function"] = $result_user["function"];
			$rights_id = $result_user["rights_id"];
		}



		$query_rights = "SELECT check_in_out, info, messages FROM rights WHERE rights_id = '" .$rights_id. "'";

		    $result_rights = mysqli_query($link, $query_rights) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_rights\"");

		    if (mysqli_num_rows($result_rights) == 1)
		    {
		    	$result_rights = mysqli_fetch_array($result_rights);
		    	if (isset($result_rights['check_in_out']) && $result_rights['check_in_out'] == 1)
		    	{
		    		$_SESSION["rights"]["check_in_out"] = 1;
		    	}
		    	else
		    	{
		    		$_SESSION["rights"]["check_in_out"] = 0;
		    	}
		    	if (isset($result_rights['info']) && $result_rights['info'] == 1)
		    	{
		    		$_SESSION["rights"]["info"] = 1;
		    	}
		    	else
		    	{
		    		$_SESSION["rights"]["info"] = 0;
		    	}
		    	if (isset($result_rights['messages']) && $result_rights['messages'] == 1)
		    	{
		    		$_SESSION["rights"]["messages"] = 1;
		    	}
		    	else
		    	{
		    		$_SESSION["rights"]["messages"] = 0;
		    	}
		    } 


		mysqli_close($link);
	}

	function user_online()
	{
		$link = connecteren();

		$query_online = "UPDATE user SET online = 1 WHERE user_id = " .$_SESSION["user_id"];

		$result_online = mysqli_query($link, $query_online) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_online\"");


		mysqli_close($link);
	}

	function user_offline()
	{
		$link = connecteren();

		$query_online = "UPDATE user SET online = 0 WHERE user_id = " .$_SESSION["user_id"];

		$result_online = mysqli_query($link, $query_online) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_online\"");

		
		mysqli_close($link);
	}

	function user_in_building()
	{
		$link = connecteren();

		$query_online = "UPDATE user SET in_building = 1 WHERE user_id = " .$_SESSION["user_id"];

		$result_online = mysqli_query($link, $query_online) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_online\"");

		
		mysqli_close($link);
	}

	function user_out_building()
	{
		$link = connecteren();

		$query_online = "UPDATE user SET in_building = 0 WHERE user_id = " .$_SESSION["user_id"];

		$result_online = mysqli_query($link, $query_online) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_online\"");

		
		mysqli_close($link);
	}

	
?>