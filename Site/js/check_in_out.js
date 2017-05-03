function check_in_out()
{
	xhr = new XMLHttpRequest();
	if (xhr != null)
	{
		var url="check_in_out_validate.php";  

		xhr.onreadystatechange=refresh_in_building;
		xhr.open("GET",url,true);
		xhr.send(null);
	}
}

function refresh_in_building() {
	var output_icon = document.getElementById("in_building");
	var output_button = document.getElementById("check_in_out_button");
	var output_warning = document.getElementById("check_in_out_warning");
	if (xhr.readyState == 4 && xhr.status == 200)
	{
		if(xhr.responseText)
		{
			if (xhr.responseText == "in")
			{
				output_icon.src = "IMG/Green_square.png";
				output_icon.alt = "In building";
				output_icon.title = "In building";
				output_button.className = "btn btn-danger";
				output_button.innerHTML = "Check out";
				output_warning.innerHTML = "<small>Don't forget to check out when leaving.</small>";
			}
			else if (xhr.responseText == "out")
			{
				output_icon.src = "IMG/Red_square.png";
				output_icon.alt = "Not in building";
				output_icon.title = "Not in building";
				output_button.className = "btn btn-success";
				output_button.innerHTML = "Check in";
				output_warning.innerHTML = "<small>Don't forget to check in when arriving.</small>";
			}
			else if (xhr.responseText == "Over limit")
			{
				output_icon.src = "IMG/Red_square.png";
				output_icon.alt = "Not in building";
				output_icon.title = "Not in building";
				output_button.className = "btn btn-warning";
				output_button.innerHTML = "Over limit";
				output_warning.innerHTML = "<small>You can only check in once a day.</small>";
			}
			else
			{
				output_button.innerHTML = xhr.responseText;
			}
		}
		else
		{
			output_icon.src = "IMG/Red_square.png";
			output_icon.alt = "Not in building";
			output_icon.title = "Not in building";
		}
	}
}