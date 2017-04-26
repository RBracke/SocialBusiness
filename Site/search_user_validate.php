<?php
session_start();

include("functions.php");

if (isset($_SESSION["logged_in"]))
{

	fill_session($_SESSION["user_id"]);



	if (isset($_GET["search_user_page"]))
	{
		$link = connecteren();
		$zoekterm = strip($_GET['search_user_page']);
		mysqli_close($link);

		$users = search_users($zoekterm);

		foreach ($users as $user) 
		{
			$x = NULL;
			$link = connecteren();
			$query_list = "SELECT user.user_id, user.name, user.function, user.online, in_building.in_building_now, in_building.in_building_id FROM user LEFT JOIN in_building on user.user_id = in_building.user_id WHERE user.user_id = " .$user. " ORDER BY user.name ASC, in_building.in_building_id DESC";
			$result_list = mysqli_query($link, $query_list) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_list\"");
			if($result_list->num_rows > 0) 
			{
				while($row = $result_list->fetch_assoc()) 
				{
					if(($row['user_id'] != $_SESSION['user_id']) && ($row['user_id'] != $x))
					{
						echo "<div class='form-group'>
						<div class='col-md-5'><a href=\"colleague_page.php?id=".$row['user_id']."\">".$row['name']."</a></div>
						<div class='col-md-3'>" .$row['function']. "</div>
						<div class='col-md-2'>";

							if ($row["online"] == 1)
							{
								echo "<img src=\"IMG/Green_circle.png\" title=\"Online\" alt=\"Online\" class=\"indicator_online_building\">";
							}
							else
							{
								echo "<img src=\"IMG/Red_circle.png\" title=\"Offline\" alt=\"Offline\" class=\"indicator_online_building\">";
							}

							echo "</div><div class='col-md-2'>";

							if ($row["in_building_now"] == 1)
							{
								echo "<img src=\"IMG/Green_square.png\" id=\"in_building\" title=\"In Building\" alt=\"In Building\" class=\"indicator_online_building\">";
							}
							else
							{
								echo "<img src=\"IMG/Red_square.png\" id=\"in_building\" title=\"Not in Building\" alt=\"Not in building\" class=\"indicator_online_building\">";
							}

							echo "</div>
						</div>
						<p class='clear_both'></p>";
						$x = $row['user_id'];
					}
				}   
			} 
			else 
			{
				echo 'not found';
			}
			mysqli_close($link);
		}

	}

	if (isset($_GET["search_admin_page_manage"]))
	{
		$link = connecteren();
		$zoekterm = strip($_GET['search_admin_page_manage']);
		mysqli_close($link);

		$users = search_users($zoekterm);

		echo "<div class='table-responsive'><table class='table table-hover'><thead><tr><th>ID</th><th>Function</th><th>Name</th><th>Email</th><th>Phone Number</th><th>Address</th><th>Admin</th><th>Rights ID*</th><th>Edit</th><th>Delete</th></tr></thead><tbody>";

		foreach ($users as $user) 
		{
			$link = connecteren();
			$query = "SELECT user_id, name, function, address, email, phone_number, admin, rights_id FROM user WHERE user_id = " .$user. " ORDER BY user_id ASC";
			$result = mysqli_query($link, $query) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query\"");

			$query_rights = "SELECT info, check_in_out, messages FROM user LEFT JOIN rights ON user.rights_id = rights.rights_id WHERE user.user_id = " .$user. "";
			$result_rights = mysqli_query($link, $query_rights) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query_rights \"$query_rights\"");
			
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					if($row['admin'] == 1){
						$admin = "Yes";
					}
					else {$admin = "No";}
					echo "<tr><td>".$row['user_id']."</td><td>".$row['function']."</td><td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['phone_number']."</td><td>".$row['address']."</td><td>".$admin."</td>";
					if ($row_rights = mysqli_fetch_array($result_rights))
					{
						if ($row_rights["info"] != NULL)
						{
							if ($row_rights["info"] == 1)
							{
								$info = "Yes";
							}
							else
							{
								$info = "No";
							}
							if ($row_rights["check_in_out"] == 1)
							{
								$check_in_out = "Yes";
							}
							else
							{
								$check_in_out = "No";
							}
							if ($row_rights["messages"] == 1)
							{
								$messages = "Yes";
							}
							else
							{
								$messages = "No";
							}

					echo "<td><span id=\"label_rights\" data-toggle=\"tooltip\" data-placement=\"top\" data-html=\"true\" title=\"Check info: " .$info. "<br>Check in and out history: " .$check_in_out. "<br>Check messages: " .$messages. "\" class=\"glyphicon glyphicon-question-sign\" aria-hidden=\"true\"></span>&nbsp;".$row['rights_id']."</td>";
						}
						else
						{
							echo "<td></td>";
						}
						
					}
					else
					{
						echo "<td></td>";
					}
			
				echo "<td><a href=\"admin_page_edit_user.php?id=" .$row["user_id"]. "\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span></a></td><td class=\"has-error\"><a href=\"admin_page_delete_user.php?id=" .$row["user_id"]. "\"><span class=\"glyphicon glyphicon-remove\" style=\"color:red\" aria-hidden=\"true\"></span></a></td></tr>";
				}
			}
			mysqli_close($link);
		}
		echo "</tbody></table></div>";


	}

	if (isset($_GET["search_messages"]))
	{
		$link = connecteren();
		$zoekterm = strip($_GET['search_messages']);
		mysqli_close($link);

		$users = search_users($zoekterm);

		$link = connecteren();

		echo "<h4 class=\"text-primary\">Send:</h4><div class='table-responsive'><table class='table table-hover'><thead><tr><th>Date and time</th><th>Topic</th><th>Receipant</th></tr></thead><tbody>";

		foreach ($users as $user) 
		{

			$query_sended = "SELECT message.date_time, message.topic, message.message_id, message.receipant, message.sender FROM message LEFT JOIN user ON message.sender = user.user_id WHERE user.user_id  = " .$_SESSION["user_id"]. " && message.receipant = " .$user. " ORDER BY message.message_id DESC";
			$result_sended = mysqli_query($link, $query_sended) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_sended\"");


			if($result_sended->num_rows > 0) 
			{
				while($row = $result_sended->fetch_assoc()) 
				{
					$query_rec_name = "SELECT name FROM user WHERE user_id  = " .$row["receipant"];
					$result_rec_name = mysqli_query($link, $query_rec_name) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_rec_name\"");

					while($row_rec_name = $result_rec_name->fetch_assoc()) 
					{

						echo "<tr><td>".$row['date_time']."</td><td><form action='actual_message.php' method='POST'><input type='hidden' value='".$row['message_id']."' name='message_id'><input type='hidden' value='".$row['receipant']."' name='id'><input type='submit' value='".$row['topic']."' id='submitlink'/></form></td><td><a href=\"colleague_page.php?id=".$row['receipant']."\">".$row_rec_name['name']."</a></td></tr>";
					}
				}
			}
		}
		echo "</tbody></table></div>";

		

		


		echo "<h4 class=\"text-primary\">Received:</h4><div class='table-responsive'><table class='table table-hover'><thead><tr><th>Date and time</th><th>Topic</th><th>Sender</th></tr></thead><tbody>";

		foreach ($users as $user) 
		{
			$query_sended = "SELECT message.date_time, message.topic, message.message_id, message.receipant, message.sender FROM message LEFT JOIN user ON message.receipant = user.user_id WHERE user.user_id  = " .$_SESSION["user_id"]. " && message.sender = " .$user. " ORDER BY message.message_id DESC";
			$result_sended = mysqli_query($link, $query_sended) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_sended\"");


			if($result_sended->num_rows > 0) 
			{
				while($row = $result_sended->fetch_assoc()) 
				{
					$query_sender_name = "SELECT name FROM user WHERE user_id  = " .$row["sender"];
					$result_sender_name = mysqli_query($link, $query_sender_name) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_sender_name\"");

					while($row_sender_name = $result_sender_name->fetch_assoc()) 
					{

						echo "<tr><td>".$row['date_time']."</td><td><form action='actual_message.php' method='POST'><input type='hidden' value='".$row['message_id']."' name='message_id'><input type='hidden' value='".$row['sender']."' name='id'><input type='submit' value='".$row['topic']."' id='submitlink'/></form></td><td><a href=\"colleague_page.php?id=".$row['sender']."\">".$row_sender_name['name']."</a></td></tr>";
					}
				}
			}
		}
		
		echo "</tbody></table></div>";

		mysqli_close($link);

	}


}


?>
