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
		user_online();
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

	$query_user = "SELECT name, nin, address, gender, email, profile_picture, date_of_birth, online, martial_status, phone_number, function, rights_id, admin, start_date FROM user WHERE user_id = '" .$id. "'";

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
		$_SESSION["date_of_birth"] = $result_user["date_of_birth"];
		$_SESSION["martial_status"] = $result_user["martial_status"];
		$_SESSION["phone_number"] = $result_user["phone_number"];
		$_SESSION["function"] = $result_user["function"];
		$rights_id = $result_user["rights_id"];
		$_SESSION["admin"] = $result_user["admin"];
		$_SESSION["start_date"] = $result_user["start_date"];

		$query_in_building = "SELECT in_building_now FROM in_building WHERE user_id = " .$_SESSION["user_id"]." ORDER by time_check DESC";
		$result_in_building = mysqli_query($link, $query_in_building) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_in_building\"");
		$row_in_building = mysqli_fetch_array($result_in_building, MYSQLI_ASSOC);

		$_SESSION["in_building"] = $row_in_building["in_building_now"];
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

	$query_offline = "UPDATE user SET online = 0 WHERE user_id = " .$_SESSION["user_id"];

	$result_offline = mysqli_query($link, $query_offline) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_offline\"");

	
	mysqli_close($link);
}

function user_in_building()
{

	$link = connecteren();

	$query_in_building = "INSERT INTO `in_building` (`user_id`, `in_building_now`) VALUES (" .$_SESSION["user_id"]. ", 1)";

	$result_in_building = mysqli_query($link, $query_in_building) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_in_building\"");

	
	mysqli_close($link);
}

function user_out_building()
{
	$link = connecteren();

	$query_out_building = "INSERT INTO `in_building` (`user_id`, `in_building_now`) VALUES (" .$_SESSION["user_id"]. ", 0)";

	$result_out_building = mysqli_query($link, $query_out_building) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_out_building\"");

	
	mysqli_close($link);
}

function show_member()
{
	$link = connecteren();
	$query_list = "SELECT user.user_id, user.name, user.function, user.online, in_building.in_building_now FROM user LEFT JOIN in_building on user.user_id = in_building.user_id";
	$result_list = mysqli_query($link, $query_list) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_list\"");
	if($result_list->num_rows > 0) {
		while($row = $result_list->fetch_assoc()) {
			if($row['user_id'] != $_SESSION['user_id'])
			{
				echo "<div class='form-group'>
				<div class='col-md-3'><a href=\"colleague_page.php?id=".$row['user_id']."\">".$row['name']."</a></div>
				<div class='col-md-3'>" .$row['function']. "</div>
				<div class='col-md-3'>" .$row['online']. "</div>
				<div class='col-md-3'>" .$row['in_building_now']. "</div>
			</div>
			<p class='clear_both'></p>";
		}
	}   
} 
else 
{
	echo 'not found';
}
mysqli_close($link);
}

function get_colleague($id)
{
	$link = connecteren();

	$query_user = "SELECT name, nin, address, gender, email, profile_picture, date_of_birth, online, martial_status, phone_number, function, rights_id, admin, start_date FROM user WHERE user_id = '" .$id. "'";

	$result_user = mysqli_query($link, $query_user) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_user\"");

	if (mysqli_num_rows($result_user) == 1)
	{

		$result_user = mysqli_fetch_array($result_user);

		$_SESSION["colleague"]["user_id"] = $id;
		$_SESSION["colleague"]["name"] = $result_user["name"];
		$_SESSION["colleague"]["logged_in"] = $result_user["online"];
		$_SESSION["colleague"]["nin"] = $result_user["nin"];
		$_SESSION["colleague"]["address"] = $result_user["address"];
		$_SESSION["colleague"]["gender"] = $result_user["gender"];
		$_SESSION["colleague"]["email"] = $result_user["email"];
		$_SESSION["colleague"]["profile_picture"] = $result_user["profile_picture"];
		$_SESSION["colleague"]["date_of_birth"] = $result_user["date_of_birth"];
		$_SESSION["colleague"]["martial_status"] = $result_user["martial_status"];
		$_SESSION["colleague"]["phone_number"] = $result_user["phone_number"];
		$_SESSION["colleague"]["function"] = $result_user["function"];
		$rights_id = $result_user["rights_id"];
		$_SESSION["colleague"]["admin"] = $result_user["admin"];
		$_SESSION["colleague"]["start_date"] = $result_user["start_date"];

		$query_in_building = "SELECT in_building_now FROM in_building WHERE user_id = " .$_SESSION["colleague"]["user_id"]." ORDER by time_check DESC";
		$result_in_building = mysqli_query($link, $query_in_building) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_in_building\"");
		$row_in_building = mysqli_fetch_array($result_in_building, MYSQLI_ASSOC);

		$_SESSION["colleague"]["in_building"] = $row_in_building["in_building_now"];
	}
	else
	{
		$_SESSION["colleague"]["name"] = "not found";
	}



	$query_rights = "SELECT check_in_out, info, messages FROM rights WHERE rights_id = '" .$rights_id. "'";

	$result_rights = mysqli_query($link, $query_rights) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_rights\"");

	if (mysqli_num_rows($result_rights) == 1)
	{
		$result_rights = mysqli_fetch_array($result_rights);
		if (isset($result_rights['check_in_out']) && $result_rights['check_in_out'] == 1)
		{
			$_SESSION["colleague"]["rights"]["check_in_out"] = 1;
		}
		else
		{
			$_SESSION["colleague"]["rights"]["check_in_out"] = 0;
		}
		if (isset($result_rights['info']) && $result_rights['info'] == 1)
		{
			$_SESSION["colleague"]["rights"]["info"] = 1;
		}
		else
		{
			$_SESSION["colleague"]["rights"]["info"] = 0;
		}
		if (isset($result_rights['messages']) && $result_rights['messages'] == 1)
		{
			$_SESSION["colleague"]["rights"]["messages"] = 1;
		}
		else
		{
			$_SESSION["colleague"]["rights"]["messages"] = 0;
		}
	} 


	mysqli_close($link);

}

?>