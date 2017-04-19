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

}

?>